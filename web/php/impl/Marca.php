<?php
function ListarMarcasTienda($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ma.idmarca,
  ma.codigo,ma.codigobarra,
  ma.nombre,
  ma.imagen,
  ma.origen
FROM
  `marcas` ma
WHERE
   ma.tipo='tienda'
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
                            if(mysql_field_name($re, $i)=="idmarca"){
                                $idmarca = $fi[$i];
                                $sql2 = "
SELECT
  col.idmarca,
  col.codigo
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' AND
  col.estado = 'VIGENTE'
";
                                $coleccionA = findBySqlReturnCampoUnique($sql2, true, true, "codigo");
                                if($coleccionA["error"]=="false"){
                                     $value{$ii}{"coleccion"}= "no Tiene Coleccion Vigente";
                                }
                                else{
                                     $value{$ii}{"coleccion"}= $coleccionA['resultado'];
                                }

                            }

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
function ListarMarcas($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
 *
FROM
  `marcas` ma
WHERE
  estado='Activo'  order by formatomayor asc
";
    //        echo $sql;   estado='Activo' and formatomayor!='0' order by formatomayor asc

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
                            if(mysql_field_name($re, $i)=="idmarca"){
                                $idmarca = $fi[$i];
                                $sql2 = "
SELECT
  col.idmarca,
  col.codigo
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' AND
  col.estado = 'VIGENTE'
";
                                $coleccionA = findBySqlReturnCampoUnique($sql2, true, true, "codigo");
                                if($coleccionA["error"]=="false"){
                                     $value{$ii}{"coleccion"}= "no Tiene Coleccion Vigente";
                                }
                                else{
                                     $value{$ii}{"coleccion"}= $coleccionA['resultado'];
                                }
                               
                            }

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
function ListarMarcasBrasil($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
    $sql ="SELECT idmarca, nombre FROM marcas ma WHERE estado = 'activo' and origen = 'BRASIL'";
//echo" sql $sql";
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
                    //echo " re $re fi $fi ";
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            //echo" idmarca $fi[$i] ";
                            if(mysql_field_name($re, $i)=="idmarca"){
                                $idmarca = $fi[$i];
                                $sql2 = "SELECT col.idmarca, col.codigo FROM coleccion` col WHERE col.idmarca = '$idmarca' AND col.estado = 'VIGENTE'";
                                $coleccionA = findBySqlReturnCampoUnique($sql2, true, true, "codigo");
                                if($coleccionA["error"]=="false"){
                                     $value{$ii}{"coleccion"}= "no Tiene Coleccion Vigente";
                                }
                                else{
                                     $value{$ii}{"coleccion"}= $coleccionA['resultado'];
                                }

                            }

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

function ListarMarcasPedido($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
 *
FROM
  `marcas` ma
WHERE
  ma.estado='activo'  order by ma.origen,ma.numeroorden ASC
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
                            if(mysql_field_name($re, $i)=="idmarca"){
                                $idmarca = $fi[$i];
                                $sql2 = "
SELECT
  col.idmarca,
  col.codigo
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' AND
  col.estado = 'VIGENTE'
";
                                $coleccionA = findBySqlReturnCampoUnique($sql2, true, true, "codigo");
                                if($coleccionA["error"]=="false"){
                                     $value{$ii}{"coleccion"}= "no Tiene Coleccion Vigente";
                                }
                                else{
                                     $value{$ii}{"coleccion"}= $coleccionA['resultado'];
                                }

                            }

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
function ListarMarcaEmergente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  marcas mar
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
function ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  cat.idcategoria,
  cat.nombre,
  cat.codigo
FROM
  `categorias` cat


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
function ListarColeccion($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  col.idcoleccion,
  col.anio,
  col.codigo,
  col.numero
FROM
  `coleccion` col
ORDER by col.anio DESC

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
function ListarTalla($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ta.idtalla,
  ta.codigo
FROM
  `tallas` ta

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
function ListarLineaMarcaColeccionPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  lm.idlinea,
  CONCAT(l.nombre,' - ',lm.codigo, ' - ', cl.codigo) AS codigo

FROM
  linea_marca lm,
  coleccion cl,
  `lineas` l
WHERE
  lm.idmarca = '$where' AND
  lm.idcoleccion = cl.idcoleccion AND
  lm.idlinea = l.idlinea

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
    function ListarColorPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  color_marca cm,
  colores col
WHERE
  cm.idcolor = col.idcolor AND
  cm.idmarca = '$where' AND
  cm.existe = 'si';
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


function ListarMaterialPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  mat.idmateria,
   mat.nombre AS codigo

FROM
  materiales mat,
  materia_marca mm
WHERE
  mm.idmateria = mat.idmateria AND
  mm.idmarca = '$where'
AND mm.existe='si';

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
function ListarLineaMarcaPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  CONCAT(`ln`.codigo,' - ',l.nombre) AS codigo,
  `ln`.idlinea
FROM
  linea_marca `ln`,
  `lineas` l
WHERE
  `ln`.idmarca = '$where' AND
  `ln`.idlinea = l.idlinea


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
function ListarLineas($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  l.idlinea,
  l.nombre,
  l.codigo
FROM
  lineas l

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

function ListarColeccionMarcaPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  `ln`.codigo,
  `ln`.idlinea
FROM
  linea_marca `ln`
WHERE
  `ln`.idmarca = '$where'

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

function ListarTallaPorMarca($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  tm.idtalla,
  tm.idtalla AS codigo,
  tm.existe
FROM
  `talla_marca` tm
where tm.idmarca ='$where';

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
function BuscarProveedorCategoriaTalla($return = false){


    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $proveedores = ListarProveedor('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['proveedores'] = "true";
        $value['proveedorM'] = $proveedores['resultado'];
    }

    $tallas = ListarTalla('', '', '', '', '', '',"",true);
    if($tallas['error'] == true)
    {
        $value['tallas'] = "true";
        $value['tallaM'] = $tallas['resultado'];
    }
    $almacenes =  ListarAlmacenTienda("","","","","","", "",true);
    if($almacenes['error']== true){
        $value['almacenes'] = true;
        $value['almacenM'] = $almacenes['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function getSqlNewMarcas($idmarca, $idproveedor, $codigo, $codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen, $talla,$opcion,$opcionb,$tipo,$return){
    $setC[0]['campo'] = 'idmarca';
    $setC[0]['dato'] = $idmarca;
    $setC[1]['campo'] = 'idproveedor';
    $setC[1]['dato'] = $idproveedor;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'codigobarra';
    $setC[3]['dato'] = $codigobarra;
    $setC[4]['campo'] = 'nombre';
    $setC[4]['dato'] = $nombre;
    $setC[5]['campo'] = 'imagen';
    $setC[5]['dato'] = $imagen;
    $setC[6]['campo'] = 'numero';
    $setC[6]['dato'] = $numero;
    $setC[7]['campo'] = 'idalmacen';
    $setC[7]['dato'] = $idalmacen;
    $setC[8]['campo'] = 'pedido';
    $setC[8]['dato'] = $pedido;
    $setC[9]['campo'] = 'origen';
    $setC[9]['dato'] = $origen;
    $setC[10]['campo'] = 'talla';
    $setC[10]['dato'] = $talla;
    $setC[11]['campo'] = 'opcion';
    $setC[11]['dato'] = $opcion;
     $setC[12]['campo'] = 'opcionb';
    $setC[12]['dato'] = $opcionb;
      $setC[13]['campo'] = 'tipo';
    $setC[13]['dato'] = $tipo;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO marcas ".$sql2;
}
function getSqlNewTalla_marca($idtalla, $idmarca, $existe, $return){
    $setC[0]['campo'] = 'idtalla';
    $setC[0]['dato'] = $idtalla;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'existe';
    $setC[2]['dato'] = $existe;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO talla_marca ".$sql2;
}
function getSqlNewColor_marca($idcolor, $idmarca, $codigo, $existe, $return){
    $setC[0]['campo'] = 'idcolor';
    $setC[0]['dato'] = $idcolor;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'existe';
    $setC[3]['dato'] = $existe;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO color_marca ".$sql2;
}
function getSqlNewMateria_marca($idmarca, $idmateria, $codigo, $existe, $return){
    $setC[0]['campo'] = 'idmarca';
    $setC[0]['dato'] = $idmarca;
    $setC[1]['campo'] = 'idmateria';
    $setC[1]['dato'] = $idmateria;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'existe';
    $setC[3]['dato'] = $existe;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO materia_marca ".$sql2;
}
function getSqlNewMarcaetapas($idetapa, $idmarca, $existe, $nivel, $return){
    $setC[0]['campo'] = 'idetapa';
    $setC[0]['dato'] = $idetapa;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'existe';
    $setC[2]['dato'] = $existe;
    $setC[3]['campo'] = 'nivel';
    $setC[3]['dato'] = $nivel;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO marcaetapas ".$sql2;
}



function GuardarNuevaMarca(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
     $codigobbc = verificarValidarText($codigo, false, "marcas", "codigo");
    if($codigobbc['error'] == false){
        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobbc['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
       $codigobarraA = validarText($codigo, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $codigobarra = $_GET['codigobarra'];

    $codigobarraA = validarText($codigobarra, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo barra de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $codigobbb = verificarValidarText($codigobarra, false, "marcas", "codigobarra");
   if ($codigobbb['error']==false){
       $dev['mensaje'] = "Error en el codigo de barra: ".$codigobbb['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;}

    $nombre = strtoupper($_GET['nombre']);
    $codigobb = verificarValidarText($nombre, false, "marcas", "nombre");
   if ($codigobb['error']==false){
       $dev['mensaje'] = "Error en el codigo: ".$codigobb['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;}

   
    $idproveedor = $_GET['proveedor'];
      $codigoprovee = validarText($idproveedor, true);
    if($codigoprovee['error'] == false){
        $dev['mensaje'] = "Error en el proveedor: ".$codigoprovee['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idcategoria = $_GET['categoria'];
    $imagen = $_GET['imagen'];
    $numeroA = findUltimoID("marcas", "numero", true);
    $numero = $numeroA['resultado']+1;
    $idmarca = "mar-".$numero;
    $idalmacen = $_GET['almacen'];
    $pedido = $_GET['mostrar'];
    
    $origen = strtoupper($_GET['origen']);
    $talla = $_GET['talla'];
    //echo $talla;
    if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 1;
          $opcionb = 9;
    } else if(($pedido == "CODIGO")&&($talla == "33-45")){
        $opcion = 5;
      //  echo $opcion;
         $opcionb= 2;
        // echo $opcionb;
    }
    else if(($pedido == "CODIGO")&&($talla == "33-41")){
        $opcion = 5;
        $opcionb= 2;
    }
    else if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 5;
        $opcionb= 9;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 9;
    }
      else if(($pedido == "CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 2;
        $opcionb = 10;
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 5;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 3;
        $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "14-38")){
        $opcion = 4;
        $opcionb = 5;
    }
   
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "33-45")){
        $opcion = 6;
        $opcionb = 8;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 7;
         $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "33-45")){
        $opcion = 8;
    }
    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 9;
        //$opcionb = 4;
        if($idmarca== 'mar-3'){
            $opcionb= 4;
        }else{
            $opcionb = 14;
        }
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb = 4;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 4;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "1-12")){
        $opcion = 12;
        $opcionb = 4;
    }

    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb= 14;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 15;
    }
if (($nombre== "WESTCOAST")||($nombre== "WEST COAST"))
{ $opcionb = 7;}
else if ($nombre== "RAMARIN")
{$opcionb = 6;}
    $sql[] = getSqlNewMarcas($idmarca, $idproveedor, $codigo, $codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen,$talla,$opcion,$opcionb,$tipo,false);
    if($origen =="BRAZIL"){
        $sql[] = getSqlNewMarcaetapas("eta-1", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-2", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-4", $idmarca, "si", "3", false);
        $sql[] = getSqlNewMarcaetapas("eta-5", $idmarca, "si", "4", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "5", false);

    }
    else{
        $sql[] = getSqlNewMarcaetapas("eta-3", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-6", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "3", false);

    }
    //    $sql[] = getSqlNewMarcas($idmarca, $idproveedor, $idcategoria, $codigo, $codigobarra, $nombre, $imagen, $numero, false);


    if($talla =="14-38"){

        for($i = 14 ; $i<=38 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla == "33-45"){
        for($i = 33 ; $i<=45 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla =="1-12"){
        for($i = 47 ; $i<=69 ;$i++){
            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    $sql1="
 SELECT
  col.idcolor,
  col.nombre,
  col.descripcion,
  col.codigo,
  col.codigobarra,
  col.numero
FROM
  `colores` col
";
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    for ($i=0;$i<$row1;$i++){
        $color = $sql3[$i];
        $idcolor = $color['idcolor'];
        $sql[] = getSqlNewColor_marca($idcolor, $idmarca, "0", "no", false);


    }
    $sql11="
SELECT
  mat.idmateria,
  mat.codigo,
  mat.nombre,
  mat.descripcion,
  mat.numero
FROM
  `materiales` mat
";
    $rowR = NumeroTuplas($sql11);
    $row1R= $rowR['resultado'];
    $sql2R = getTablaToArrayOfSQL($sql11);
    $sql3R= $sql2R['resultado'];
    for ($i=0;$i<$row1R;$i++){
        $material = $sql3R[$i];
        $idmaterial = $material['idmateria'];
        $sql[] =getSqlNewMateria_marca($idmarca, $idmaterial, "0", "no", false);


    }
    $sql12="
SELECT
  es.idestilo,
  es.nombre,
  es.descripcion,
  es.numero
FROM
  `estilos` es
";
    $rowR1 = NumeroTuplas($sql12);
    $row1R1= $rowR1['resultado'];
    $sql2R1 = getTablaToArrayOfSQL($sql12);
    $sql3R1= $sql2R1['resultado'];
//    for ($i=0;$i<$row1R1;$i++){
//        $estilo = $sql3R1[$i];
//        $idestilo = $estilo['idestilo'];
//        $sql[] =getSqlNewEstilomarca($idmarca, $idestilo, "no", false);
//
//
//    }

    //   MostrarConsulta($sql);
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
function GuardarNuevaMarcaTienda(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
   $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
     $codigobbc = verificarValidarText($codigo, false, "marcas", "codigo");
    if($codigobbc['error'] == false){
        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobbc['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
       $codigobarraA = validarText($codigo, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $codigobarra = $_GET['codigobarra'];

    $codigobarraA = validarText($codigobarra, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo barra de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $codigobbb = verificarValidarText($codigobarra, false, "marcas", "codigobarra");
   if ($codigobbb['error']==false){
       $dev['mensaje'] = "Error en el codigo de barra: ".$codigobbb['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;}

    $nombre = strtoupper($_GET['nombre']);
    $codigobb = verificarValidarText($nombre, false, "marcas", "nombre");
   if ($codigobb['error']==false){
       $dev['mensaje'] = "Error en el codigo: ".$codigobb['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;}

  //  $idproveedor = $_GET['proveedor'];
    $idcategoria = $_GET['categoria'];
    $imagen = $_GET['imagen'];
    $numeroA = findUltimoID("marcas", "numero", true);
    $numero = $numeroA['resultado']+1;
    $idmarca = "mar-".$numero;
    $idalmacen = $_GET['almacen'];
    $pedido = $_GET['mostrar'];

    $origen = strtoupper($_GET['origen']);
    $talla = $_GET['talla'];
    //echo $talla;
     if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 1;
          $opcionb = 9;
    } else if(($pedido == "CODIGO")&&($talla == "33-45")){
        $opcion = 5;
      //  echo $opcion;
         $opcionb= 2;
        // echo $opcionb;
    }
    else if(($pedido == "CODIGO")&&($talla == "33-41")){
        $opcion = 5;
        $opcionb= 2;
    }
    else if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 5;
        $opcionb= 9;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 9;
    }
      else if(($pedido == "CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 2;
        $opcionb = 10;
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 5;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 3;
        $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "14-38")){
        $opcion = 4;
        $opcionb = 5;
    }

    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "33-45")){
        $opcion = 6;
        $opcionb = 8;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 7;
         $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "33-45")){
        $opcion = 8;
    }
    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 9;
        //$opcionb = 4;
        if($idmarca== 'mar-3'){
            $opcionb= 4;
        }else{
            $opcionb = 14;
        }
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb = 4;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 4;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "1-12")){
        $opcion = 12;
        $opcionb = 4;
    }

    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb= 14;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 15;
    }
if (($nombre== "WESTCOAST")||($nombre== "WEST COAST"))
{ $opcionb = 7;}
else if ($nombre== "RAMARIN")
{$opcionb = 6;}
$idproveedor = 'prv-0';
$idalmacen =$_SESSION['idalmacen'];
    $sql[] = getSqlNewMarcas($idmarca, $idproveedor, $codigo, $codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen,$talla,$opcion,$opcionb,"tienda",false);
    if($origen =="BRAZIL"){
        $sql[] = getSqlNewMarcaetapas("eta-1", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-2", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-4", $idmarca, "si", "3", false);
        $sql[] = getSqlNewMarcaetapas("eta-5", $idmarca, "si", "4", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "5", false);

    }
    else{
        $sql[] = getSqlNewMarcaetapas("eta-3", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-6", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "3", false);

    }
    //    $sql[] = getSqlNewMarcas($idmarca, $idproveedor, $idcategoria, $codigo, $codigobarra, $nombre, $imagen, $numero, false);


    if($talla =="14-38"){

        for($i = 14 ; $i<=38 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla == "33-45"){
        for($i = 33 ; $i<=45 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla =="1-12"){
        for($i = 47 ; $i<=69 ;$i++){
            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    $sql1="
 SELECT
  col.idcolor,
  col.nombre,
  col.descripcion,
  col.codigo,
  col.codigobarra,
  col.numero
FROM
  `colores` col
";
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    for ($i=0;$i<$row1;$i++){
        $color = $sql3[$i];
        $idcolor = $color['idcolor'];
        $sql[] = getSqlNewColor_marca($idcolor, $idmarca, "0", "no", false);


    }
    $sql11="
SELECT
  mat.idmateria,
  mat.codigo,
  mat.nombre,
  mat.descripcion,
  mat.numero
FROM
  `materiales` mat
";
    $rowR = NumeroTuplas($sql11);
    $row1R= $rowR['resultado'];
    $sql2R = getTablaToArrayOfSQL($sql11);
    $sql3R= $sql2R['resultado'];
    for ($i=0;$i<$row1R;$i++){
        $material = $sql3R[$i];
        $idmaterial = $material['idmateria'];
        $sql[] =getSqlNewMateria_marca($idmarca, $idmaterial, "0", "no", false);


    }

//      MostrarConsulta($sql);
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
function InsertarCodificarColorPorMarca($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idmarca =$resultado->idmarca;
    $colores = $resultado->colores;
    $con = count($colores);
    for($i=0;$i<$con;$i++){
        $color  = $colores[$i];
        $idcolor = $color->idcolor;
        $codigo = $color->codigo;
        $sql[] = getSqlUpdateColor_marca_configurar($idcolor,$idmarca,$codigo, "si", false);
    }


    //                      MostrarConsulta($sql);
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
function getSqlNewLinea_marca($idlinea, $idmarca, $codigo, $return){
    $setC[0]['campo'] = 'idlinea';
    $setC[0]['dato'] = $idlinea;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;

    $sql2 = generarInsertValues($setC);
    return "INSERT INTO linea_marca ".$sql2;
}
function GuardarCodificarLinea($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idmarca = $resultado;
    $idlinea = $_GET['linea'];
    $idcoleccion = $_GET['coleccion'];
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $sql[]=getSqlNewLinea_marca($idlinea, $idmarca, $codigo, false);

    //                      MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos Posiblemente ya existen esos datos en la base de datos no puede volver a repetirlos";
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
function InsertarCodificarMaterialPorMarca($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idmarca =$resultado->idmarca;
    //    echo $idmarca;
    $materiales = $resultado->materiales;
    $con = count($materiales);
    for($i=0;$i<$con;$i++){
        $materia = $materiales[$i];
        $idmateria = $materia->idmateria;

        $codigo = $materia->codigo;

        $sql[] = getSqlUpdateMateria_marca_configurar($idmarca, $idmateria, $codigo, false);
    }
    //                      MostrarConsulta($sql);
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
function getSqlUpdateMarcas($idmarca,$idproveedor,$codigo,$codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen, $talla, $opcion,$opcionb, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'codigobarra';
    $setC[1]['dato'] = $codigobarra;
    $setC[2]['campo'] = 'nombre';
    $setC[2]['dato'] = $nombre;
    $setC[3]['campo'] = 'imagen';
    $setC[3]['dato'] = $imagen;
    $setC[4]['campo'] = 'numero';
    $setC[4]['dato'] = $numero;
    $setC[5]['campo'] = 'pedido';
    $setC[5]['dato'] = $pedido;
    $setC[6]['campo'] = 'origen';
    $setC[6]['dato'] = $origen;
    $setC[7]['campo'] = 'talla';
    $setC[7]['dato'] = $talla;
    $setC[8]['campo'] = 'opcion';
    $setC[8]['dato'] = $opcion;
    $setC[9]['campo'] = 'idproveedor';
    $setC[9]['dato'] = $idproveedor;
    $setC[10]['campo'] = 'idalmacen';
    $setC[10]['dato'] = $idalmacen;
      $setC[11]['campo'] = 'opcionb';
    $setC[11]['dato'] = $opcionb;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmarca';
    $wher[0]['dato'] = $idmarca;


    $where = generarWhereUpdate($wher);
    return "UPDATE marcas SET ".$set." WHERE ".$where;
}
function getSqlUpdateTalla_marca($idtalla,$idmarca,$existe, $return){
    $setC[0]['campo'] = 'existe';
    $setC[0]['dato'] = $existe;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idtalla';
    $wher[0]['dato'] = $idtalla;
    $wher[1]['campo'] = 'idmarca';
    $wher[1]['dato'] = $idmarca;

    $where = generarWhereUpdate($wher);
    return "UPDATE talla_marca SET ".$set." WHERE ".$where;
}
function GuardarEditarMarca($idmarca){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
   $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
//     $codigobbc = verificarValidarText($codigo, false, "marcas", "codigo");
//    if($codigobbc['error'] == false){
//        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobbc['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
       $codigobarraA = validarText($codigo, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $codigobarra = $_GET['codigobarra'];

    $codigobarraA = validarText($codigobarra, true);
    if($codigobarraA['error'] == false){
        $dev['mensaje'] = "Error en el codigo barra de marca: ".$codigobarraA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
//     $codigobbb = verificarValidarText($codigobarra, false, "marcas", "codigobarra");
//   if ($codigobbb['error']==false){
//       $dev['mensaje'] = "Error en el codigo de barra: ".$codigobbb['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;}

    $nombre = strtoupper($_GET['nombre']);
//    $codigobb = verificarValidarText($nombre, false, "marcas", "nombre");
//   if ($codigobb['error']==false){
//       $dev['mensaje'] = "Error en el codigo: ".$codigobb['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;}

    $idproveedor = $_GET['proveedor'];
    $idcategoria = $_GET['categoria'];
    $imagen = $_GET['imagen'];

    $idalmacen = $_GET['almacen'];
    $pedido = $_GET['mostrar'];
    $origen = $_GET['origen'];
    $talla = $_GET['talla'];
    $sql[] = "DELETE FROM marcaetapas WHERE idmarca = '$idmarca';";
//    if(($pedido == "CODIGO")&&($talla == "14-38")){
//        $opcion = 1;
//    }
//    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "14-38")){
//        $opcion = 2;
//    }
//    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "14-38")){
//        $opcion = 3;
//    }
//    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "14-38")){
//        $opcion = 4;
//    }
//    else if(($pedido == "CODIGO")&&($talla == "33-45")){
//        $opcion = 5;
//    }
//    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "33-45")){
//        $opcion = 6;
//    }
//    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "33-45")){
//        $opcion = 7;
//    }
//    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "33-45")){
//        $opcion = 8;
//    }
//    else if(($pedido == "CODIGO")&&($talla == "1-12")){
//        $opcion = 9;
//    }
//    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "1-12")){
//        $opcion = 10;
//    }
//    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "1-12")){
//        $opcion = 11;
//    }
//    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "1-12")){
//        $opcion = 12;
//    }
  if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 1;
          $opcionb = 9;
    } else if(($pedido == "CODIGO")&&($talla == "33-45")){
        $opcion = 5;
      //  echo $opcion;
         $opcionb= 2;
        // echo $opcionb;
    }
    else if(($pedido == "CODIGO")&&($talla == "33-41")){
        $opcion = 5;
        $opcionb= 2;
    }
    else if(($pedido == "CODIGO")&&($talla == "14-38")){
        $opcion = 5;
        $opcionb= 9;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 9;
    }
      else if(($pedido == "CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 2;
        $opcionb = 10;
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "14-38")){
        $opcion = 2;
        $opcionb = 5;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "14-38")){
        $opcion = 3;
        $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "14-38")){
        $opcion = 4;
        $opcionb = 5;
    }

    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "33-45")){
        $opcion = 6;
        $opcionb = 8;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "33-45")){
        $opcion = 7;
         $opcionb = 3;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "33-45")){
        $opcion = 8;
    }
    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 9;
        //$opcionb = 4;
        if($idmarca== 'mar-3'){
            $opcionb= 4;
        }else{
            $opcionb = 14;
        }
    }
    else if(($pedido == "CODIGO-COLOR-MATERIAL")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb = 4;
    }
    else if(($pedido == "LINEA-CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 4;
    }
    else if(($pedido == "CODIGO-COLOR-STYLENAME")&&($talla == "1-12")){
        $opcion = 12;
        $opcionb = 4;
    }

    else if(($pedido == "CODIGO")&&($talla == "1-12")){
        $opcion = 10;
        $opcionb= 14;
    }
     else if(($pedido == "CODIGO-COLOR")&&($talla == "1-12")){
        $opcion = 11;
        $opcionb = 15;
    }
if (($nombre== "WESTCOAST")||($nombre== "WEST COAST"))
{ $opcionb = 7;}
else if ($nombre== "RAMARIN")
{$opcionb = 6;}
    $sql[] = getSqlUpdateMarcas($idmarca,$idproveedor,$codigo,$codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen, $talla, $opcion,$opcionb, $return);
    if($origen =="BRAZIL"){
        $sql[] = getSqlNewMarcaetapas("eta-1", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-2", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-4", $idmarca, "si", "3", false);
        $sql[] = getSqlNewMarcaetapas("eta-5", $idmarca, "si", "4", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "5", false);

    }
    else{
        $sql[] = getSqlNewMarcaetapas("eta-3", $idmarca, "si", "1", false);
        $sql[] = getSqlNewMarcaetapas("eta-6", $idmarca, "si", "2", false);
        $sql[] = getSqlNewMarcaetapas("eta-7", $idmarca, "si", "3", false);

    }
    //    $sql[] = getSqlNewMarcas($idmarca, $idproveedor, $idcategoria, $codigo, $codigobarra, $nombre, $imagen, $numero, false);

    $sql[] = "DELETE FROM talla_marca WHERE idmarca = '$idmarca'";
    if($talla =="14-38"){

        for($i = 14 ; $i<=38 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla == "33-45"){
        for($i = 33 ; $i<=45 ;$i++){

            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }
    if($talla =="1-12"){
        for($i = 47 ; $i<=69 ;$i++){
            $sql[] = getSqlNewTalla_marca($i, $idmarca, "si", false);
        }
    }


    //    $sql[] = getSqlUpdateMarcas($idmarca, $idproveedor, $idcategoria, $codigo, $codigobarra, $nombre, $imagen, false);


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
function BuscarMarcaPorId($idmarca,$return){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.imagen,
  ma.idproveedor,
  ma.idcategoria,
  ma.codigobarra,
  ma.numero
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";

    if($idmarca != null)
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
function  BuscarProveedorCategoriaTallaPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $proveedores = ListarProveedor('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['proveedores'] = "true";
        $value['proveedorM'] = $proveedores['resultado'];
    }
    $almacenes =  ListarAlmacen("","","","","","", "",true);
    if($almacenes['error']== true){
        $value['almacenes'] = true;
        $value['almacenM'] = $almacenes['resultado'];
    }


    $sql ="
SELECT 
  ma.idmarca,
  ma.idproveedor,
  ma.codigo,
  ma.codigobarra,
  ma.nombre,
  ma.imagen,
  ma.numero,
  ma.idalmacen,
  ma.pedido,
  ma.origen,
  ma.talla,
  ma.opcion
FROM
  `marcas` ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarCategoriaTallaPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT
  ma.idmarca,
  ma.idproveedor,
  ma.codigo,
  ma.codigobarra,
  ma.nombre,
  ma.imagen,
  ma.numero,
  ma.idalmacen,
  ma.pedido,
  ma.origen,
  ma.talla,
  ma.opcion
FROM
  `marcas` ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function getSqlDeleteMarcas($idmarca){
    return "DELETE FROM marcas WHERE idmarca = '$idmarca';";
}
function getSqlDeleteTalla_marca($idmarca){
    return "DELETE FROM talla_marca WHERE idmarca = '$idmarca';";
}
function getSqlDeleteEstilo_marca($idmarca){
    return "DELETE FROM estilomarca WHERE idmarca = '$idmarca';";
}
function getSqlDeleteLinea_marca($idmarca){
    return "DELETE FROM linea_marca WHERE idmarca = '$idmarca';";
}
function getSqlDeleteColor_marca($idmarca){
    return "DELETE FROM color_marca WHERE idmarca = '$idmarca';";
}
function getSqlDeleteMateria_marca($idmarca){
    return "DELETE FROM materia_marca WHERE idmarca = '$idmarca';";
}
function getSqlDeleteMarcaetapas($idmarca){
    return "DELETE FROM marcaetapas WHERE idmarca = '$idmarca';";
}
function getSqlUpdateMateria_marca($idmarca,$idmateria, $existe, $return){

    $setC[0]['campo'] = 'existe';
    $setC[0]['dato'] = $existe;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmarca';
    $wher[0]['dato'] = $idmarca;
    $wher[1]['campo'] = 'idmateria';
    $wher[1]['dato'] = $idmateria;

    $where = generarWhereUpdate($wher);
    return "UPDATE materia_marca SET ".$set." WHERE ".$where;
}
function getSqlUpdateMateria_marca_configurar($idmarca,$idmateria, $codigo, $return){

    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmarca';
    $wher[0]['dato'] = $idmarca;
    $wher[1]['campo'] = 'idmateria';
    $wher[1]['dato'] = $idmateria;

    $where = generarWhereUpdate($wher);
    return "UPDATE materia_marca SET ".$set." WHERE ".$where;
}
function getSqlUpdateColor_marca_configurar($idcolor,$idmarca,$codigo, $return){

    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idcolor';
    $wher[0]['dato'] = $idcolor;
    $wher[1]['campo'] = 'idmarca';
    $wher[1]['dato'] = $idmarca;

    $where = generarWhereUpdate($wher);
    return "UPDATE color_marca SET ".$set." WHERE ".$where;
}
function getSqlDeleteColeccionMarca($idmarca){
    return "DELETE FROM coleccion WHERE idmarca = '$idmarca';";
}
function getSqlDeleteLineaMarca($idmarca){
    return "DELETE FROM lineas WHERE idmarca = '$idmarca';";
}
function EliminarMarca($idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idmarcaA = verificarValidarText($idmarca, true, "modelos", "idmarca");
    if($idmarcaA['error']==true){
        $dev['mensaje'] = "No puede eliminar este Marca. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    //    $sql[] = getSqlDeleteLinea_marca($idmarca);
    $sql[] = getSqlDeleteColor_marca($idmarca);
    $sql[] = getSqlDeleteTalla_marca($idmarca);
    $sql[] = getSqlDeleteEstilo_marca($idmarca);
    $sql[] = getSqlDeleteMateria_marca($idmarca);
    $sql[] = getSqlDeleteMarcaetapas($idmarca);
    $sql[] = getSqlDeleteLineaMarca($idmarca);
    $sql[] = getSqlDeleteColeccionMarca($idmarca);

    $sql[] = getSqlDeleteMarcas($idmarca);
    //    MostrarConsulta($sql);
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
function  BuscarColorMaterialPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $proveedores = ListarColorMarcaPorId('', '', '', '', '', '',"$idmarca",true);
    if($proveedores['error'] == true)
    {
        $value['colores'] = "true";
        $value['colorM'] = $proveedores['resultado'];
    }
    $categorias = ListarMaterialMarcaPorId('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['material'] = "true";
        $value['materialM'] = $categorias['resultado'];
    }

    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.imagen,
  ma.idproveedor,
  ma.idcategoria,
  ma.codigobarra,
  ma.numero
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarMaterialPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $material = ListarMaterialPorId('', '', '', '', '', '',$idmarca,true);
    $value = $material['resultado'];
    //echo $sql;


    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarColorPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $color = ListarColorPorId('', '', '', '', '', '',$idmarca,true);
    if($color['error'] == true)
    {
        $value3['color'] = "true";
        $value = $color['resultado'];
    }
    //echo $sql;


    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarMarcasola($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

   
    $sql ="
SELECT
*
FROM
  `marcas` mar
WHERE
  mar.idmarca = '$idmarca'
";
 //  echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  BuscarColeccionModeloPorMarca($idmarca, $callback, $_dc, $return = false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

 $empleado = ListarModelosSimple('', '', '', '', '', '',"$idmarca",true);
    if($empleado['error'] == true)
    {
        $value['modelos'] = "true";
        $value['modeloM'] = $empleado['resultado'];
    }

    $sql ="
SELECT
  mar.nombre AS marca
FROM
  `marcas` mar
WHERE
  mar.idmarca='$idmarca'
";
   //   echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function ListarModelosSimple($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
$sqlmarca = "SELECT mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
    if($formatomayor=="1"){
      $select = "ka.idkardex,mdd.idmodelo,CONCAT( c.detalle, '-', mdd.codigo) AS codigo";
$from = "modelo mdd,kardexdetalle ka,coleccion c";
 $where = "mdd.idcoleccion=c.idcoleccion and ka.idmodelo=mdd.idmodelo and mdd.idmarca = '$idmarca' ";

    }else{
    $select = "ka.idkardex,mdd.idmodelo,mdd.codigo ";
$from = "modelo mdd,kardexdetalle ka";
 $where = "ka.idmodelo=mdd.idmodelo and mdd.idmarca = '$idmarca' ";

    }
  //$sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." group by mdd.idmodelo ";
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." group by mdd.codigo";

   //  echo $sql;
   
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

function ListarModelosporEstiloPedido($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
    switch ($idmarca){
    case "mar-2" :
     $order = "mdd.numeracion DESC,CAST(mdd.codigo AS SIGNED) ASC,mdd.material ASC";
    break;
   case "mar-1" :
    $order = "mdd.numeracion DESC,CAST(mdd.codigo AS SIGNED) ASC,mdd.color ASC";
    break;
   case "mar-5" :
     $from .= ",lineas l";
                     $where .= "AND mdd.idlinea = l.idlinea";
                    $order = " l.codigo ASC ,mdd.codigo ASC";
    break;
    case "mar-28" :
    $order = "CAST(mdd.codigo AS SIGNED) ASC ,mdd.color ASC";
    break;
    case "mar-6" :
    $order = "mdd.numeracion ASC,CAST(mdd.codigo AS SIGNED) ASC ,mdd.color ASC";
    break;
    
     case "mar-7" :
    $order = "mdd.numeracion ASC, CAST(mdd.codigo AS SIGNED) ASC";
    break;
    case "mar-4" :
     $from .= ",lineas l";
                     $where .= "AND mdd.idlinea = l.idlinea";
                    $order = " l.codigo ASC ,mdd.codigo ASC";
    break;
    
     case "mar-25" :
    $order = "mdd.numeracion ASC, mdd.codigo ASC,mdd.color ASC";
    break;
    
    case "mar-3" :
    $order = "CAST(mdd.codigo AS SIGNED) ASC ,mdd.color ASC";
    break;
    default:
      $order = "CAST(mdd.codigo AS SIGNED) ASC";
}

//update lorgio UPDATE lineas SET codigo = (UPPER(codigo))
//UPDATE adiciondetalleingreso SET color = (UPPER(color))
$select = "ka.idkardexdetalle,kar.idkardexunico,mdd.idmodelodetalle,mdd.idmodelo,mdd.codigo AS nombre";
$from = "modelo mdd,kardexdetalle ka,kardexdetallepar kar";
 $where = "kar.idkardexdetalle=ka.idkardexdetalle and ka.idmodelo=mdd.idmodelo and mdd.idmarca = '$idmarca' GROUP by mdd.idmodelo ";
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ORDER BY ".$order;

  
        //  echo $sql;
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

function ListarModelosporEstiloTallla($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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
//    String[] nombreCaso7Columns = {"iddetalleingreso", "idmodelo", "iddetalleingresotalla","modelo","detalle", "precio", "talla", "cantidad","codigobarra"};
   
$sql = "
   SELECT 0 AS iddetalleingresotalla, dtp.iddetalleingreso, mdd.codigo AS modelo, mdd.idmodelo,0 AS cantidad, 0 AS talla, CONCAT( dtp.color, '-', dtp.material) AS detalle, dtp.totalbs AS precio, 0 AS codigobarra
FROM adiciondetalleingreso dtp, modelos mdd
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo'

";
//    $sql = "
//   SELECT dtpt.iddetalleingresotalla, dtp.idcalzado AS iddetalleingreso, CONCAT(mdd.codigo,'-',dtp.talla ) AS modelo, dtp.idmodelodetalle AS idmodelo, dtp.saldocantidad AS cantidad, dtp.talla, CONCAT( dtp.precio1bs, '-', dtp.precio3bs ) AS detalle, dtp.precio2bs AS precio, dtp.codigobarra
//FROM adicionkardextienda dtp, modelos mdd, coleccion col, adiciondetalleingresotalla dtpt
//WHERE dtp.idmodelodetalle = mdd.idmodelo
//AND mdd.idcoleccion = col.idcoleccion
//AND dtp.idcalzado = dtpt.iddetalleingreso
//AND mdd.idmarca = '$idmarca'
//AND mdd.stylename = '$idestilo'
//
//";
          //  echo $sql;
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
 
function ListarTallass($start, $limit, $sort, $dir, $callback, $_dc,$idmarca, $return = false){

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
//    String[] nombreCaso7Columns = {"iddetalleingreso", "idmodelo", "iddetalleingresotalla","modelo","detalle", "precio", "talla", "cantidad","codigobarra"};
 $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    
     if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){
$sql = "
   SELECT ta.iddetalleingresotalla AS idtalla,ta.tallakardex as talla
FROM tallasdetalle ta WHERE ta.idmodelo='1' AND ta.iddetalleingreso='din-579'";

}else{
$sql = "
   SELECT ta.iddetalleingresotalla AS idtalla,ta.tallakardex as talla
FROM tallasdetalle ta WHERE ta.idmodelo='2'";


     }


     //       echo $sql;
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


function  BuscarColeccionPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $categorias = ListarColeccionesPorMarca('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['coleccion'] = "true";
        $value['coleccionM'] = $categorias['resultado'];
    }
    $sql ="
SELECT
  mar.idmarca,
  mar.idproveedor,
  mar.codigo,
  mar.codigobarra,
  mar.nombre,
  mar.imagen,
  mar.numero,
  mar.idalmacen,
  mar.pedido,
  mar.origen,
  mar.talla,
  mar.opcion,mar.opcionb
FROM
  `marcas` mar
WHERE
  mar.idmarca = '$idmarca'
";
    //    echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  ClienteVendedorColorMarcaPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $proveedores = ListarLineas('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['linea'] = "true";
        $value['lineaM'] = $proveedores['resultado'];
    }

    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.imagen,
  ma.idproveedor,
  ma.idcategoria,
  ma.codigobarra,
  ma.numero
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function getSqlUpdateColor_marca($idcolor,$idmarca,$existe, $return){

    $setC[0]['campo'] = 'existe';
    $setC[0]['dato'] = $existe;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idcolor';
    $wher[0]['dato'] = $idcolor;
    $wher[1]['campo'] = 'idmarca';
    $wher[1]['dato'] = $idmarca;

    $where = generarWhereUpdate($wher);
    return "UPDATE color_marca SET ".$set." WHERE ".$where;
}

function GuardarConfigurarMarca(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idmarca = $_GET['idmarca'];
    if($idmarca){
        $sql1="
        SELECT
  co.idcolor
FROM
  colores co
";
        $sql2="
       SELECT
         mm.idmateria
        FROM
          materia_marca mm
";
        $row1 = NumeroTuplas($sql1);
        $row2 = $row1['resultado'];
        $row3 = getTablaToArrayOfSQL($sql1);
        $row4 = $row3['resultado'];
        //agarramos de material
        $row5 = NumeroTuplas($sql2);
        $row6 = $row5['resultado'];
        $row7 = getTablaToArrayOfSQL($sql2);
        $row8 = $row7['resultado'];

        for($i=0;$i<$row2;$i++){
            $color = $row4[$i];
            $idcolor = $color['idcolor'];
            if($_GET[$idcolor])
            {

                $sql[] =  getSqlUpdateColor_marca($idcolor,$idmarca,"si", false);

            }
            else
            {
                $sql[] =  getSqlUpdateColor_marca($idcolor,$idmarca,"no", false);
            }
        }
        for($j=0;$j<$row6;$j++){
            $material= $row8[$j];
            $idmaterial = $material['idmateria'];
            if($_GET[$idmaterial]){

                $sql[] =  getSqlUpdateMateria_marca($idmarca,$idmaterial,"si", false);
            }
            else{
                $sql[] =  getSqlUpdateMateria_marca($idmarca,$idmaterial,"no", false);
            }
        }

    }
    //      MostrarConsulta($sql);

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

function GuardarConfigurarMarcaMaterial(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idmarca = $_GET['idmarca'];
    if($idmarca){

        $sql2="
       SELECT
         mm.idmateria
        FROM
          materia_marca mm
";

        //agarramos de material
        $row5 = NumeroTuplas($sql2);
        $row6 = $row5['resultado'];
        $row7 = getTablaToArrayOfSQL($sql2);
        $row8 = $row7['resultado'];


        for($j=0;$j<$row6;$j++){
            $material= $row8[$j];
            $idmaterial = $material['idmateria'];
            if($_GET[$idmaterial]){

                $sql[] =  getSqlUpdateMateria_marca($idmarca,$idmaterial,"si", false);
            }
            else{
                $sql[] =  getSqlUpdateMateria_marca($idmarca,$idmaterial,"no", false);
            }
        }

    }
    //      MostrarConsulta($sql);

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
function GuardarConfigurarMarcaColor(){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idmarca = $_GET['idmarca'];
    if($idmarca){
        $sql1="
        SELECT
  co.idcolor
FROM
  colores co
";

        $row1 = NumeroTuplas($sql1);
        $row2 = $row1['resultado'];
        $row3 = getTablaToArrayOfSQL($sql1);
        $row4 = $row3['resultado'];
        //agarramos de material

        for($i=0;$i<$row2;$i++){
            $color = $row4[$i];
            $idcolor = $color['idcolor'];
            if($_GET[$idcolor])
            {

                $sql[] =  getSqlUpdateColor_marca($idcolor,$idmarca,"si", false);

            }
            else
            {
                $sql[] =  getSqlUpdateColor_marca($idcolor,$idmarca,"no", false);
            }
        }

    }
    //      MostrarConsulta($sql);

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
function  BuscarClienteVendedorColorMaterialModeloPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $proveedores = ListarColoresPedido('', '', '', '', '', '',"$idmarca",true);
    if($proveedores['error'] == true)
    {
        $value['colores'] = "true";
        $value['colorM'] = $proveedores['resultado'];
    }
    $categorias = ListarMaterialesPedido('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['material'] = "true";
        $value['materialM'] = $categorias['resultado'];
    }

    $cliente = ListarClientePedido('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];

    }
    $empleado = ListarEmpleadosPedido('', '', '', '', '', '','',true);
    if($empleado['error'] == true)
    {
        $value['vendedores'] = "true";
        $value['vendedorM'] = $empleado['resultado'];


    }
    $linea = ListarLineaPedido('', '', '', '', '', '',"$idmarca",true);
    if($linea['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $linea['resultado'];


    }
    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];

    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarClienteEstiloColorMaterialModeloPorMarca($idmarca,$return=false){
$idalmacen =$_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $proveedores = ListarColoresPedido('', '', '', '', '', '',"$idmarca",true);
    if($proveedores['error'] == true)
    {
        $value['colores'] = "true";
        $value['colorM'] = $proveedores['resultado'];
    }
    $categorias = ListarMaterialesPedido('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['material'] = "true";
        $value['materialM'] = $categorias['resultado'];
    }

    $cliente = ListarClienteParaMayor('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];

    }
    
   $cliente = ListarEmpleadoparamarca('', '', '', '', '', '',"$idmarca",true);
    if($cliente['error'] == true)
    {    $value['empleados'] = "true";
        $value['empleadoM'] = $cliente['resultado'];

    }

    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);
$sqlcoleccion12 ="SELECT MAX(emp.numero)AS num
FROM
  empleados emp,empleadomarca em
WHERE
  emp.idempleado=em.idempleado  and em.idmarca='$idmarca' and em.idalmacen='$idalmacen' 
";
 $opcionA = findBySqlReturnCampoUnique($sqlcoleccion12, true, true, "num");
   $maxempl = $opcionA['resultado'];
$sqlcoleccion1 ="SELECT  CONCAT(emp.nombres,'-',emp.apellidos) AS codigo
FROM
  empleados emp,empleadomarca em
WHERE
  emp.idempleado=em.idempleado and em.idmarca='$idmarca' and emp.numero='$maxempl'
";
 $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "codigo");
   $encargado = $opcionA['resultado'];
  // echo $sqlcoleccion12;
    $value['encargado'] = "$encargado";
    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb,ma.formatomayor
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarMarcaModelos($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];

    }



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  BuscarMarcaModelosKardex($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $modelo = BuscarModelosIngresadosAlmacen($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];

    }
$empleado = ListarEstiloPorMarca('', '', '', '', '', '',$idmarca,true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }


    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  BuscarMarcaModelosKardex2($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $modelo = BuscarModelosIngresadosAlmacen2($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];

    }

    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarEstiloMaterialPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";



    $categorias = ListarMaterialesPedido('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['material'] = "true";
        $value['materialM'] = $categorias['resultado'];
    }


    //$empleado = ListarEmpleadosPedido('', '', '', '', '', '','',true);
    $empleado = ListarEstiloPorMarca('', '', '', '', '', '',"$idmarca",true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
//  
//    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
//    if($modelo['error'] == true){
//        $value['modelos'] = "true";
//        $value['modeloM'] = $modelo['resultado'];
//
//    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarEstiloColorPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";



    $proveedores = ListarColoresPedido('', '', '', '', '', '',"$idmarca",true);
    if($proveedores['error'] == true)
    {
        $value['colores'] = "true";
        $value['colorM'] = $proveedores['resultado'];
    }

    //$empleado = ListarEmpleadosPedido('', '', '', '', '', '','',true);
    $empleado = ListarEstiloPorMarca('', '', '', '', '', '',"$idmarca",true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
//
//    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
//    if($modelo['error'] == true){
//        $value['modelos'] = "true";
//        $value['modeloM'] = $modelo['resultado'];
//
//    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarEstiloPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";

$sqlcoleccion1 = "
SELECT
  idcoleccion
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];

    if($idcoleccion=='' || $idcoleccion=="" ||$idcoleccion==null ||$idcoleccion==NULL){
 $dev['mensaje'] = "Error no existe coleccion vigente de la marca: ";
                        $dev['error']   = "true";
                        $dev['resultado'] = "falta coleccion";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;

      }else {
    //$empleado = ListarEmpleadosPedido('', '', '', '', '', '','',true);
    $empleado = ListarEstiloPorMarca('', '', '', '', '', '',"$idmarca",true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
//
//    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
//    if($modelo['error'] == true){
//        $value['modelos'] = "true";
//        $value['modeloM'] = $modelo['resultado'];
//
//    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion,ma.opcionb
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
      } //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarModelosIngresadosAlmacen($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $sql ="
SELECT
  dtp.idmodelo,
  CONCAT( mo.codigo,'-',dtp.color,'-',dtp.totalpares,'-',dtp.totalbs) AS codigo,CONCAT( mo.codigo,'-',dtp.color,'-',dtp.totalpares,'-',dtp.totalbs) AS nombre
FROM
  `modelos` mo,`adiciondetalleingreso` dtp
WHERE mo.idmarca = '$idmarca' AND dtp.idmodelo=mo.idmodelo
ORDER by mo.codigo ASC
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  BuscarModelosIngresadosAlmacen2($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";

    $sql ="
SELECT
  ad.idcalzado AS idmodelo,
CONCAT( mo.codigo,'-',ad.precio3bs,'-',ad.precio1bs,'-',ad.precio2bs,'-',SUM(ad.saldocantidad)) AS nombre
FROM
  `modelos` mo,`adicionkardextienda` ad
WHERE ad.idmodelodetalle=mo.idmodelo AND mo.idmarca='$idmarca' AND ad.unido='no'
GROUP by ad.idcalzado ORDER by mo.codigo ASC
";

//    $sql ="
//SELECT
//  dtp.iddetaleingreso AS idmodelo,
//  CONCAT( mo.codigo,'-',dtp.color,'-',dtp.totalpares,'-',dtp.totalbs) AS codigo,CONCAT( mo.codigo,'-',dtp.color,'-',dtp.totalpares,'-',dtp.totalbs) AS nombre
//FROM
//  `modelos` mo,`adiciondetalleingreso` dtp
//WHERE mo.idmarca = '$idmarca' AND dtp.idmodelo=mo.idmodelo
//ORDER by dtp.iddetalleingreso ASC
//";
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarModeloPorMarcaColeccionVigente($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";




    $sql ="
SELECT
  mo.idmodelo,li.idestilo,
  mo.codigo
FROM
  `modelos` mo,`lineas` li,
  `coleccion` co
WHERE mo.idlinea=li.idlinea AND
  mo.idcoleccion = co.idcoleccion AND
  mo.idmarca = '$idmarca' 
ORDER by mo.codigo ASC
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function BuscarMarca(){

    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function BuscarMarcaProcesar(){

    $categorias = ListarMarcasBrasil('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function BuscarMarcaPedido(){
    $categorias = ListarMarcasPedido('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function BuscarMarcaLineaColeccionEstilo(){
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
$colecciones = ListarColeccion('', '', '', '', '', '',"",true);
 if($colecciones['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $colecciones['resultado'];
    }

  $lineas = ListarLineasimple('', '', '', '', '', '',"",true);
 if($lineas['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $lineas['resultado'];
    }
  $estilo = ListarEstilo('', '', '', '', '', '',"",true);
 if($estilo['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $estilo['resultado'];
    }


$dev['mensaje'] = "Se cargo el formulario";
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
function  BuscarModeloLineaPorMarca1($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $linea = ListarLineaPedido('', '', '', '', '', '',"$idmarca",true);
    if($linea['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $linea['resultado'];


    }
    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];

    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //    $lineas = ListarLineaMarcaColeccionPorId('', '', '', '', '', '',"$idmarca",true);
    //`   $lineas = ListarCategoria($start, $limit, $sort, $dir, $callback, $_dc);



    $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarDatosMarcas($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
   // echo $idmarca;

       $sql ="
SELECT
  est.idmarca,est.codigo,
  est.opcion,
  est.opcionb
FROM
  `marcas` est
WHERE
  est.codigo='$idmarca'";


    //echo $sql;
    if($idmarca != null)
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
                        $dev['mensaje'] = "El cliente no tiene cuentas pendientes";
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

    $dev['mensaje'] = "Se cargo el formulario ";
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
function buscardatosmarca($idmarca, $callback, $_dc, $return = false){


    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT
  est.idmarca,
  est.opcion,
  est.opcionb
FROM
  `marcas` est
WHERE
  est.idmarca = '$idmarca'

";
//            echo $sql;
    if($idmarca != null)
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
function  BuscarLineaColeccionPorMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $proveedores = ListarLineas('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['linea'] = "true";
        $value['lineaM'] = $proveedores['resultado'];
    }
    //function ListarColeccionesPorMarca($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

    $categorias = ListarColeccionesPorMarca('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {
        $value['coleccion'] = "true";
        $value['coleccionM'] = $categorias['resultado'];
    }
 $empleado = ListarEstiloPorMarca('', '', '', '', '', '',"$idmarca",true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
    $sql ="
SELECT
  mar.idmarca,
  mar.idproveedor,
  mar.codigo,
  mar.codigobarra,
  mar.nombre,
  mar.imagen,
  mar.numero,
  mar.idalmacen,
  mar.pedido,
  mar.origen,
  mar.talla,
  mar.opcion,mar.opcionb
FROM
  `marcas` mar
WHERE
  mar.idmarca = '$idmarca'
";
    //   echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

?>