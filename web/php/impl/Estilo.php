<?php
//function ListarModelo($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")

function ListarEstilo($start, $limit, $sort, $dir, $callback, $_dc, $where = '',$buscarmarca, $return = "true"){

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

//     $sql ="
//SELECT est.idestilo, est.descripcion AS idmarca, m.nombre AS descripcion, est.nombre, est.numero
//FROM `estilos` est, `marcas` m
//WHERE est.descripcion = m.idmarca
//ORDER BY est.descripcion ASC
//";
//        
    if($buscarmarca == null || $buscarmarca == "")
    {
        //echo $buscarmarca;
        $sql = "
SELECT est.idestilo, est.descripcion AS idmarca, m.nombre AS descripcion, est.nombre, est.numero
FROM `estilos` est, `marcas` m
WHERE est.descripcion = m.idmarca 
ORDER BY est.descripcion ASC LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
      SELECT est.idestilo, est.descripcion AS idmarca, m.nombre AS descripcion, est.nombre, est.numero
FROM `estilos` est, `marcas` m
WHERE est.descripcion = m.idmarca AND est.descripcion='$buscarmarca' $order  LIMIT $start,$limit
         ";
      //         MostrarConsulta($sql);
    }
        //   echo $sql;
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


function ListarEstiloPorMarca($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
SELECT est.nombre, est.descripcion AS idmarca, est.idestilo
FROM `estilos` est
WHERE est.descripcion = '$idmarca'

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

function ListarModelosporEstilo($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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
    SELECT m.idmodelo,m.codigo AS nombre
    FROM modelos m
    WHERE m.idmarca = '$idmarca' AND m.stylename='$idestilo'

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


//function ListarEstiloPorMarca($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

function ListarEstiloMarca($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

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
      est.nombre,
      est.descripcion AS idmarca,
      est.idestilo
    FROM
      `estilos` est
    ORDER by est.nombre DESC

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

function ListarMarcaIM($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  mar.idmarca,
  mar.nombre
FROM
  `marcas` mar

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
function ListarMarcaEstilo($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  esm.idmarca,
  mar.nombre,
  esm.existe
FROM
  `marcas` mar,
  `estilomarca` esm
WHERE
  esm.idmarca = mar.idmarca AND
  esm.idestilo = '$where'

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

function CargarNuevoEstilo( $callback, $_dc, $return = false){


    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $marca = ListarMarcaIM('', '', '', '', '', '',"",true);
    if($marca['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marca['resultado'];
    }
    $dev['mensaje'] = "Se cargo el formulario de Estilo";
    $dev['error']   = "true";
    $dev['resultado'] = $value;
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

function CargarDatosEstiloMarca($idestilo, $callback, $_dc, $return = false){


    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $marca = ListarMarcaEstilo('', '', '', '', '', '',$idestilo,true);
    if($marca['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marca['resultado'];
    }

    $sql ="
SELECT
  est.idestilo,
  est.nombre,
  est.descripcion,
  est.numero
FROM
  `estilos` est
WHERE
  est.idestilo = '$idestilo'

";
//            echo $sql;
    if($idestilo != null)
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
function getSqlNewEstilomarca($idmarca, $idestilo, $existe, $return){
    $setC[0]['campo'] = 'idmarca';
    $setC[0]['dato'] = $idmarca;
    $setC[1]['campo'] = 'idestilo';
    $setC[1]['dato'] = $idestilo;
    $setC[2]['campo'] = 'existe';
    $setC[2]['dato'] = $existe;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO estilomarca ".$sql2;
}
function getSqlNewEstilos($idestilo, $nombre, $descripcion, $numero, $return){
    $setC[0]['campo'] = 'idestilo';
    $setC[0]['dato'] = $idestilo;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'descripcion';
    $setC[2]['dato'] = $descripcion;
    $setC[3]['campo'] = 'numero';
    $setC[3]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO estilos ".$sql2;
}
function GuardarEstilo(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $sql1="
        SELECT
  ma.idmarca
FROM
  `marcas` ma
";
    $nombre = strtoupper($_GET['nombre']);
    $idmarca1 = $_GET['idmarca'];
     $sql1="
        SELECT
  ma.idmarca
FROM
  `marcas` ma
WHERE ma.nombre= '$idmarca1'
";
      $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
   $idmarca = $opcionA['resultado'];
    $descripcion = strtoupper($_GET['descripcion']);
    $numeroA = findUltimoID("estilos", "numero", true);
    $numero = $numeroA['resultado'] + 1;
    $idestilo = "est-".$numero;
    $sql[] = getSqlNewEstilos($idestilo, $nombre, $idmarca, $numero, $return);
    $row1 = NumeroTuplas($sql1);
    $row2 = $row1['resultado'];
    $row3 = getTablaToArrayOfSQL($sql1);
    $row4 = $row3['resultado'];
    //agarramos de material

//    for($i=0;$i<$row2;$i++){
//        $color = $row4[$i];
//        $idmarca = $color['idmarca'];
//        if($_GET[$idmarca])
//        {
//
//            $sql[] = getSqlNewEstilomarca($idmarca, $idestilo, "si", $return);
//
//        }
//        else
//        {
//            $sql[] = getSqlNewEstilomarca($idmarca, $idestilo, "no", $return);
//        }
//    }



    //         MostrarConsulta($sql);

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

function GuardarNuevoEstilo(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

  
 $nombre = strtoupper($_GET['nombre']);
    $idmarca1 = $_GET['idmarca'];
     $sql1="
        SELECT
  ma.idmarca
FROM
  `marcas` ma
WHERE ma.nombre= '$idmarca1'
";
      $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
   $idmarca = $opcionA['resultado'];
    $descripcion = strtoupper($_GET['descripcion']);
    $numeroA = findUltimoID("estilos", "numero", true);
    $numero = $numeroA['resultado'] + 1;
    $idestilo = "est-".$numero;
    $sql[] = getSqlNewEstilos($idestilo, $nombre, $idmarca, $numero, $return);

    //          MostrarConsulta($sql);

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

function getSqlUpdateEstilos($idestilo,$nombre,$descripcion, $return){
    $setC[0]['campo'] = 'nombre';
    $setC[0]['dato'] = $nombre;
    $setC[1]['campo'] = 'descripcion';
    $setC[1]['dato'] = $descripcion;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idestilo';
    $wher[0]['dato'] = $idestilo;

    $where = generarWhereUpdate($wher);
    return "UPDATE estilos SET ".$set." WHERE ".$where;
}

function getSqlUpdateEstilomarca($idmarca,$idestilo,$existe, $return){
    $setC[0]['campo'] = 'existe';
    $setC[0]['dato'] = $existe;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmarca';
    $wher[0]['dato'] = $idmarca;
    $wher[1]['campo'] = 'idestilo';
    $wher[1]['dato'] = $idestilo;

    $where = generarWhereUpdate($wher);
    return "UPDATE estilomarca SET ".$set." WHERE ".$where;
}
function GuardarEditarEstilo(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idestilo = $_GET['idestilo'];


    $sql1="
        SELECT
  ma.idmarca
FROM
  `marcas` ma
";
    $nombre = strtoupper($_GET['nombre']);
    $descripcion = strtoupper($_GET['descripcion']);

    $sql[] = getSqlUpdateEstilos($idestilo,$nombre,$descripcion, $return);
    $row1 = NumeroTuplas($sql1);
    $row2 = $row1['resultado'];
    $row3 = getTablaToArrayOfSQL($sql1);
    $row4 = $row3['resultado'];
    //agarramos de material

    for($i=0;$i<$row2;$i++){
        $color = $row4[$i];
        $idmarca = $color['idmarca'];
        if($_GET[$idmarca])
        {

            $sql[] = getSqlUpdateEstilomarca($idmarca,$idestilo,"si", $return);

        }
        else
        {
            $sql[] = getSqlUpdateEstilomarca($idmarca,$idestilo,"no", $return);
        }
    }



    //          MostrarConsulta($sql);

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


function getSqlDeleteEstilomarca($idEstilomarca){
    return "DELETE FROM estilomarca WHERE idestilo = '$idEstilomarca' ";
}
function getSqlDeleteEstilos($idEstilos){
    return "DELETE FROM estilos WHERE idestilo = '$idEstilos'";
}

function EliminarEstilo($idestilo,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

$COLECCION=verificarValidarText($idestilo, true, "lineas", "idestilo");
    if($COLECCION['error'] ==true )
    {
        $dev['mensaje'] = "No es posible eliminar el estilo /ya fue utilizado en alguna linea ";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else
    {
    $sql[] = getSqlDeleteEstilomarca($idestilo);
    $sql[] = getSqlDeleteEstilos($idestilo);
    }
    //        MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Estilo correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ese Estilo esta siendo Utilizado por alguna linea por favor eliminar la linea primero";
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