<?php
function ListarColores($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  col.idcolor,
  col.nombre,
  col.descripcion

FROM
  `colores` col
Where idmarca = '$where'
ORDER BY col.`nombre` ASC

";
//            echo $sql;
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
function ListarColoresPedido($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  col.idcolor,
  col.nombre AS codigo
FROM
  `colores` col
Where idmarca = '$where'
ORDER BY col.`nombre` ASC

";
//            echo $sql;
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
function BuscarColorPorId($idcolor,$return){


    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  col.idcolor,
  col.nombre,
  col.descripcion,
  col.codigo,
  col.codigobarra
FROM
  `colores` col
WHERE col.idcolor = '$idcolor'";
    if($idcolor != null)
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
function getSqlNewColores($idcolor, $nombre, $descripcion, $codigo, $numero, $codigobarra, $idmarca, $return){
    $setC[0]['campo'] = 'idcolor';
    $setC[0]['dato'] = $idcolor;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'descripcion';
    $setC[2]['dato'] = $descripcion;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $setC[4]['campo'] = 'numero';
    $setC[4]['dato'] = $numero;
    $setC[5]['campo'] = 'codigobarra';
    $setC[5]['dato'] = $codigobarra;
    $setC[6]['campo'] = 'idmarca';
    $setC[6]['dato'] = $idmarca;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO Colores ".$sql2;
}

function getSqlUpdateColores($idcolor,$nombre,$descripcion,$codigo,$codigobarra,$return){
    $setC[0]['campo'] = 'idcolor';
    $setC[0]['dato'] = $idcolor;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'descripcion';
    $setC[2]['dato'] = $descripcion;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $setC[4]['campo'] = 'codigobarra';
    $setC[4]['dato'] = $codigobarra;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idcolor';
    $wher[0]['dato'] = $idcolor;

    $where = generarWhereUpdate($wher);
    return "UPDATE colores SET ".$set." WHERE ".$where;
}

function InsertarNuevoColor(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $nombre = strtoupper($_GET['nombre']);
    $nombre1 = validarText($nombre, true);
    $idmarca = $_GET['idmarca'];
    if ($nombre1['error']==false){

        $dev['mensaje'] = "Error en el nombre: ".$nombre1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombre2 = verificarValidarTextWithCondition($nombre, false, "colores", "nombre","idmarca",$idmarca);
    if($nombre2['error']==false){
        $dev['mensaje'] = "Error en el nombre: ".$nombre2['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigobarra = $_GET['codigobarra'];
    $descripcion = $_GET['descripcion'];

    $idcodigoA = findUltimoID("colores", "numero", true);
    $numero1= $idcodigoA['resultado']+1;

    $idcolor = 'col-'.$numero1;
    $sql[] = getSqlNewColores($idcolor,$nombre,$descripcion,$codigo,$numero1,"",$idmarca, false);
    
//                MostrarConsulta($sql);
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
function InsertarNuevoColor2(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $nombremarca = strtoupper($_GET['boleta']);
    $idmarca = $_GET['idmarca'];
    $idcodigoA = findUltimoID("colores", "numero", true);
    $numero1= $idcodigoA['resultado']+1;

    $idcolor = 'col-'.$numero1;
    $nombremarca = strtoupper($nombremarca);
$sql4 = "SELECT COUNT(idcolor)AS num FROM colores WHERE idmarca ='$idmarca' and nombre='$nombremarca'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "num");
   $existecolor = $paresd['resultado'];

// if($existecolor==null || $existecolor==""){
    if($existecolor>0){
   
}else{
 $sql[] = getSqlNewColores($idcolor,$nombremarca,$descripcion,$codigo,$numero1,"",$idmarca, false);

}
    
                MostrarConsulta($sql);
   //     ejecutarConsultaSQLBeginCommit($sql);
   if(ejecutarConsultaSQLBeginCommit($sql))
    {
      //  $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        //$dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
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

function InsertarNuevoMaterial2(){
    
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $nombre = strtoupper($_GET['boleta']);
    $idmarca = $_GET['idmarca'];
    $idcodigoA = findUltimoID("materiales", "numero", true);
    $numero1= $idcodigoA['resultado']+1;

    $idmateria = 'mat-'.$numero1;
    $nombremarca = strtoupper($nombremarca);
$sql4 = "SELECT COUNT(idmaterial)AS num FROM materiales WHERE idmarca ='$idmarca' and nombre='$nombremarca'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "num");
   $existecolor = $paresd['resultado'];

// if($existecolor==null || $existecolor==""){
    if($existecolor>0){

}else{

       $sql[] = getSqlNewMateriales2($idmateria, $codigo, $nombre, $numero1,$descripcion, $idmarca,false);
}

    //            MostrarConsulta($sql);
   //     ejecutarConsultaSQLBeginCommit($sql);
   if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    { $dev['error'] = "false";
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


function GuardarEditarColor(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    //    $codigoA = validarText($codigo, true);
    //    if($codigoA['error']==false){
    //        $dev['mensaje'] = "Error en el codigo de almacen: ".$codigoA['mensaje'];
    //        $json = new Services_JSON();
    //        $output = $json->encode($dev);
    //        print($output);
    //        exit;
    //    }

    $codigo = $_GET['codigo'];
    $nombre = $_GET['nombre'];
    $codigobarra = $_GET['codigobarra'];
    $descripcion = $_GET['descripcion'];
    $idcolor = $_GET['idcolor'];
    $sql[] = getSqlUpdateColores($idcolor,$nombre,$descripcion,$codigo,$codigobarra,false);

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
function getSqlDeleteColor($idcolor){
    return "DELETE FROM colores WHERE idcolor = '$idcolor';" ;
}

function EliminarColor($idcolor,$callback,$_dc,$return='true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    /*$idcolorA = verificarValidarText($idcolor, true,null,"idcolor");
    if($idcolorA['error']==true){
        $dev['mensaje'] = "No puede eliminar este color. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }*/
    $sql[] = "DELETE FROM color_marca WHERE idcolor = '$idcolor';";
    $sql[] = getSqlDeleteColor($idcolor);

    //       MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Color correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar un color";
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
function ListarColorMarcaPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  co.nombre,
  cm.idcolor,
  cm.existe,
  CONCAT(cm.codigo, ' - ', co.nombre) AS codigo
FROM
  color_marca cm,
  `colores` co
WHERE
  cm.idmarca = '$where' AND
  cm.idcolor = co.idcolor ORDER by co.`nombre`;;

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

function getSqlNewMateriales2($idmateria, $codigo, $nombre, $numero, $descripcion, $idmarca, $return){
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


?>