<?php
function getSqlNewCiudades($idciudad, $nombre, $numero, $codigo, $return){
    $setC[0]['campo'] = 'idciudad';
    $setC[0]['dato'] = $idciudad;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO ciudades ".$sql2;
}


function getSqlUpdateCiudades($idciudad,$nombre,$numero,$codigo, $return){
    $setC[0]['campo'] = 'nombre';
    $setC[0]['dato'] = $nombre;
    $setC[1]['campo'] = 'numero';
    $setC[1]['dato'] = $numero;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idciudad';
    $wher[0]['dato'] = $idciudad;

    $where = generarWhereUpdate($wher);
    return "UPDATE ciudades SET ".$set." WHERE ".$where;
}




function getSqlDeleteCiudades($idciudades){
    return "DELETE FROM ciudades WHERE idciudad ='$idciudades';";
}



function ListarCiudad($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  ciu.idciudad,
  ciu.nombre,
  ciu.codigo
FROM
  `ciudades` ciu

";
    //        echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function GuardarNuevaCiudad(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoA1 = verificarValidarText($codigo, false, "ciudades", "codigo");
    if($codigoA1['error']==false){
        $dev['mensaje'] = "Error en el campo CODIGO: ".$codigoA1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoB = TamanoPermitido($codigo, 6);
    if($codigoB['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoB['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombre = strtoupper($_GET['nombre']);
    $nombreA = validarText($nombre, true);
    if($nombreA['error']==false){
        $dev['mensaje'] = "error en el campo nombre :".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $numeroA = findUltimoID("ciudades", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idciudad = 'ciu-'.$numero;
    $sql[] = getSqlNewCiudades($idciudad, $nombre, $numero, $codigo, $return);
    //    $sql[] = getSqlNewTipoempleado($idtipoempleado, $nombre, $codigo, $numero, $return);


    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
function BuscarCiudadPorId($idciudad,$return){


    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
ciu.idciudad,
  ciu.nombre,
  ciu.codigo
FROM
  `ciudades` ciu
WHERE
  ciu.idciudad = '$idciudad'
";
    if($idciudad != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else
                            {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "El codigo de producto es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function GuardarEditarCiudad(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo de almacen: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idciudad = $_GET['idciudad'];
    $codigoA1 = verificarValidarTextUnicoEdit("idciudad", $idciudad, false, "ciudades", "codigo", $codigo);
    if($codigoA1['error']==false){
        $dev['mensaje'] = "Error en el campo CODIGO: ".$codigoA1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombre = $_GET['nombre'];
    $nombre = strtoupper($_GET['nombre']);
    $nombreA = validarText($nombre, true);
    if($nombreA['error']==false){
        $dev['mensaje'] = "error en el campo nombre :".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $sql[] = getSqlUpdateCiudades($idciudad,$nombre,$numero,$codigo, $return);
//    $sql[] = getSqlUpdateTipoempleado($idciudad,$nombre,$codigo, $return);
    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
function EliminarCiudad($idciudad,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    //    $sql[] = getSqlDeleteLinea_marca($idlinea);
    $sql[] =  getSqlDeleteCiudades($idciudad);

    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "No se puede Eliminar...  Existe el valor en alguna tabla";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }

}

?>