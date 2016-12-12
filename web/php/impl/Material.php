<?php
function ListarMateriales($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
       $sql1= "SELECT
             opcionb
            FROM
              marcas
            WHERE
              idmarca = '$where'";
         //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "opcionb");
    $opcion = $result['resultado'];
    if($opcion == "5"){
$valor = "1";
}else{
    $valor = "0";
}
 //  echo $sql1;
    $sql ="
SELECT idmateria as idmaterial, nombre, descripcion
FROM `materiales`
Where idmarca = '$where' AND descripcion = '$valor'
order by nombre ASC

";
    //    echo $sql;
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

function ListarMaterialesPedido($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
idmateria as idmateria, nombre AS codigo

FROM `materiales`
Where idmarca = '$where'
order by nombre ASC

";
    //    echo $sql;
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




function getSqlNewMateriales($idmateria, $codigo, $nombre, $numero, $descripcion, $idmarca, $return){
    $setC[0]['campo'] = 'idmateria';
    $setC[0]['dato'] = $idmateria;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'nombre';
    $setC[2]['dato'] = $nombre;
    $setC[3]['campo'] = 'numero';
    $setC[3]['dato'] = $numero;
    $setC[4]['campo'] = 'descripcion';
    $setC[4]['dato'] = $descripcion;
    $setC[5]['campo'] = 'idmarca';
    $setC[5]['dato'] = $idmarca;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO materiales ".$sql2;
}
function buscarMaterialid($idmaterial,$return){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT idmateria as idmaterial, codigo, nombre, descripcion
FROM `materiales`
WHERE
  idmateria = '$idmaterial'

";
    //    MostrarConsulta($sql);
    if($idmaterial != null)
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

function GuardarEditarMaterial()
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    //    $codigoA = validarText($codigo, true);
    //    if($codigoA['error']==false){
    //        $dev['mensaje'] = "Error en el codigo de Material: ".$codigoA['mensaje'];
    //        $json = new Services_JSON();
    //        $output = $json->encode($dev);
    //        print($output);
    //        exit;
    //    }
    $idmateria = $_GET['idmaterial'];
    //    echo "gsdg".$idmateria;
    $nombre = $_GET['nombre'];
    //    $codigo=$_GET['codigo'];
    $descripcion = $_GET['descripcion'];
    $numero = $_GET['numero'];
    $sql[] = getSqlUpdateMateriales($idmateria,$codigo, $nombre, $descripcion,$numero, false);
    //       MostrarConsulta($sql);
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

function InsertarNuevoMaterial(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];

    $nombre = $_GET['nombre'];
    //$descripcion = $_GET['descripcion'];
    $numeroA = findUltimoID("materiales", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idmateria = 'mat-'.$numero;
    $idmarca = $_GET['idmarca'];
    $nombre1 = validarText($nombre, true);
    if ($nombre1['error']==false){

        $dev['mensaje'] = "Error en el nombre".$nombre1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombre2 = verificarValidarTextWithCondition($nombre, false, "materiales", "nombre","idmarca",$idmarca);
    if($nombre2['error']==false){
        $dev['mensaje'] = "Error en el nombre: ".$nombre2['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
       $sql1= "SELECT
             opcionb
            FROM
              marcas
            WHERE
              idmarca = '$idmarca'";
        //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "opcionb");
    $opcion = $result['resultado'];
    if ($opcion == "5")
    {$descripcion= "1";}
    else {$descripcion = "0";}
    //    $sql[] = getSqlNewMateriales($idmateria, $codigo, $nombre, $numero, $descripcion, $idmarca,false);
    $sql[] = getSqlNewMateriales($idmateria, $codigo, $nombre, $numero,$descripcion, $idmarca,false);

    //            MostrarConsulta($sql);
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
function getSqlUpdateMateriales($idmateria,$codigo, $nombre, $descripcion, $numero, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'descripcion';
    $setC[2]['dato'] = $descripcion;
    $setC[3]['campo'] = 'numero';
    $setC[3]['dato'] = $numero;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmateria';
    $wher[0]['dato'] = $idmateria;

    $where = generarWhereUpdate($wher);
    return "UPDATE materiales SET ".$set." WHERE ".$where;
}


function EliminarMaterial($idmaterial,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql[] = getSqlDeleteMateria_marca($idmaterial);
    $sql[] = getSqlDeleteMateriales($idmaterial);


    //                    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino la Marca correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar una Marca";
        $dev['error'] = "false";
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
function getSqlDeleteMateriales($idMateriales){
    return "DELETE FROM materiales WHERE idmateria = '$idMateriales'";
}



function ListarMaterialMarcaPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ma.idmateria,
  mat.nombre,
  ma.existe
FROM
  `materia_marca` ma,
  `materiales` mat
WHERE
  ma.idmateria = mat.idmateria AND
  ma.idmarca = '$where' ORDER BY mat.`nombre` ASC

;

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


?>