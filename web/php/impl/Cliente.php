<?php
function ListarClienteSimple($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  cli.idcliente,
  CONCAT(cli.apellido,'-',cli.nombre) AS codigo
FROM
  `clientes` cli,
  `ciudades` ciu
WHERE
  cli.idciudad = ciu.idciudad
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

function ListarClienteSimpleActivo($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
    $idalmacen =$_SESSION['idalmacen'];
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
    $sql = "SELECT cli.idcliente, CONCAT(cli.apellido,'-',cli.nombre) AS codigo
            FROM clientes cli, ciudades ciu
            WHERE cli.idciudad = ciu.idciudad and cli.idalmacen = '$idalmacen' and cli.estado = 'ACTIVO'";
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

function ListarCliente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen =$_SESSION['idalmacen'];
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
  if($where == null || $where == "")
    {
        $sql ="
SELECT
   cl.codigo,
  UPPER(cl.estado) AS estado,
  cl.direccion,
  cl.telefono,
 UPPER(cl.nombre) AS nombre,
 UPPER(cl.apellido) AS apellido,
  cl.idcliente,
  cl.nit,
  ciu.nombre AS ciudad
FROM
  clientes cl,
  `ciudades` ciu
WHERE
   cl.idciudad = ciu.idciudad and idalmacen='$idalmacen' order by cl.apellido,cl.nombre

";
    }else{
        $sql ="
SELECT
   cl.codigo,
  UPPER(cl.estado) AS estado,
  cl.direccion,
  cl.telefono,
 UPPER(cl.nombre) AS nombre,
 UPPER(cl.apellido) AS apellido,
  cl.idcliente, cl.nit,
  ciu.nombre AS ciudad
FROM
  clientes cl,
  `ciudades` ciu
WHERE
   cl.idciudad = ciu.idciudad and idalmacen='$idalmacen' AND $where order by cl.apellido,cl.nombre

";
       
    }
    
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

function ListarClientePedido($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  cli.idalmacen AS idcliente,
  CONCAT(cli.nombre,'/',ciu.codigo) AS codigo
FROM
  `almacenes` cli,
  `ciudades` ciu
WHERE
  cli.idciudad = ciu.idciudad


";
//      $sql ="
//SELECT
//  cli.idcliente,
//  CONCAT(cli.codigo,'/',ciu.codigo) AS codigo
//FROM
//  `clientes` cli,
//  `ciudades` ciu
//WHERE
//  cli.idciudad = ciu.idciudad
//
//
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
function ListarClienteParaMayor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen =$_SESSION['idalmacen'];
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
SELECT cli.idalmacen AS idcliente,  CONCAT(cli.nombre,'/',ciu.codigo) AS codigo
FROM `almacenes` cli,  `ciudades` ciu
WHERE  cli.idciudad = ciu.idciudad and cli.idalmacen='$idalmacen'
UNION ALL
SELECT cl.idcliente,CONCAT(cl.codigo,'/', ciu.codigo) AS codigo
  FROM clientes cl, `ciudades` ciu
WHERE  cl.idciudad = ciu.idciudad and cl.idalmacen='$idalmacen'
";
 
       //echo $sql;
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

function ListarClienteParaMayorVenta($start, $limit, $sort, $dir, $callback, $_dc, $where = '',$idmarca, $return = false){
 $idalmacen =$_SESSION['idalmacen'];
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
SELECT mdd.cliente AS idcliente, mdd.cliente AS codigo
FROM  modelo mdd,kardexdetallepar kp
WHERE kp.idmodelo=mdd.idmodelo and kp.saldocantidad!='0' AND mdd.idalmacen = '$idalmacen' and mdd.idmarca='$idmarca'
GROUP BY mdd.cliente
";
//  $sql ="
//SELECT cli.idalmacen AS idcliente,  CONCAT(cli.nombre,'/',ciu.codigo) AS codigo
//FROM `almacenes` cli,  `ciudades` ciu
//WHERE  cli.idciudad = ciu.idciudad and cli.idalmacen='$idalmacen'
//UNION ALL
//    SELECT cl.idcliente, CONCAT( cl.apellido, '-', cl.nombre ) AS codigo
//FROM clientes cl, modelo mdd
//WHERE cl.idcliente = mdd.idcliente
//AND mdd.idalmacen = '$idalmacen' and mdd.idmarca='$idmarca'
//GROUP BY cl.idcliente
//";

       //echo $sql;
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

function ListarsoloClientes($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen =$_SESSION['idalmacen'];
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
SELECT cl.idcliente,CONCAT(cl.apellido,'-',cl.nombre,'/', ciu.codigo) AS codigo
  FROM clientes cl, `ciudades` ciu
WHERE  cl.idciudad = ciu.idciudad and cl.idalmacen='$idalmacen'
";

       //echo $sql;and cl.idalmacen='$idalmacen'
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
function ListarsoloClientesActivos($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen =$_SESSION['idalmacen'];
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
SELECT cl.idcliente,CONCAT(cl.apellido,'-',cl.nombre,'/', ciu.codigo) AS codigo
  FROM clientes cl, `ciudades` ciu
WHERE  cl.idciudad = ciu.idciudad and cl.idalmacen='$idalmacen' and cl.estado = 'ACTIVO'
";

       //echo $sql;and cl.idalmacen='$idalmacen'
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

function ListarTipoCliente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  tcl.nombre,
  tcl.descripcion,
  tcl.numero,
  tcl.idtipocliente
FROM
  `tipo_clientes` tcl

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
function BuscarCiudadTipo($callback, $_dc, $where = '', $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $sql4 = "SELECT idciudad FROM almacenes where idalmacen='$idalmacen'";
      $result = findBySqlReturnCampoUnique($sql4, true, true, "idciudad");
    $idciudad = $result['resultado'];


    $sql3="SELECT nombre FROM ciudades WHERE idciudad='$idciudad' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "nombre");
    $ciudad = $result['resultado'];
    $value['ciudad'] = "$ciudad";
    $almacen = ListarCiudad("", "", "", "", "", "", "", true);
    if($almacen["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $tipo = ListarTipoCliente("", "", "", "", "", "", "", true);
    if($tipo['error']==false){
        $dev['mensaje'] = "No se pudo encontrar Tipos";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }

    if(($almacen["error"]==true)&&($tipo["error"]==true)){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
        $value["ciudadM"] = $almacen['resultado'];
        $value["tipoM"] = $tipo['resultado'];
        $dev["resultado"] = $value;
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
function BuscarCiudadTipoPorCliente($idcliente,$callback, $_dc, $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $almacen = ListarCiudad("", "", "", "", "", "", "", true);
  $value["ciudadM"] = $almacen['resultado'];
    $sql ="SELECT * FROM clientes WHERE idcliente = '$idcliente';";
    if($idcliente != null)
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


function BuscarCliente(){
    $categorias = ListarClienteSimple('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $categorias['resultado'];
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

function BuscarClienteActivo(){
    $categorias = ListarClienteSimpleActivo('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $categorias['resultado'];
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

function GuardarEditarCliente($idcliente){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $nombre = strtoupper($_GET['nombre']);
    $apellido = strtoupper($_GET['apellido']);
    $nit = strtoupper($_GET['nit']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo del Cliente: ".$codigoA['mensaje'];
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
    $codigoC = verificarValidarTextUnicoEdit("idcliente", $idcliente, true, "clientes", "codigo", $codigo);
    if($codigoC['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoC['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
  //  $tipo =$_GET['tipo'];
  //  $ciudad =$_GET['ciudad'];
   // $tipoA = validarText($tipo, true);
    //    $idcliente=$_GET['idcliente'];
    $nombre = strtoupper($_GET['nombre']);
    $almacen = $_GET['almacen'];

    $telefono =$_GET['telefono'];
    $nit=$_GET['nit'];
    $direccion=strtoupper($_GET['direccion']);
  
   
    $apellido = $_GET['apellido'];

    $sql[] = "UPDATE clientes set codigo='$codigo',nombre='$nombre',apellido='$apellido',nit='$nit',telefono='$telefono',direccion='$direccion' WHERE idcliente = '$idcliente';";
    
//    $sql[] = getSqlUpdateClientes($idcliente,$tipo,$almacen,$nombre, $telefono, $direccion, $estado, $email, $fax, $numero, $codigo, false);
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
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}

function getSqlNewClientes($idcliente, $codigo, $apellido, $nombre, $nit, $direccion, $telefono, $mail, $referencia, $item, $idalmacen, $estado, $numero, $saldoactual, $idciudad, $return){
$setC[0]['campo'] = 'idcliente';
$setC[0]['dato'] = $idcliente;
$setC[1]['campo'] = 'codigo';
$setC[1]['dato'] = $codigo;
$setC[2]['campo'] = 'apellido';
$setC[2]['dato'] = $apellido;
$setC[3]['campo'] = 'nombre';
$setC[3]['dato'] = $nombre;
$setC[4]['campo'] = 'nit';
$setC[4]['dato'] = $nit;
$setC[5]['campo'] = 'direccion';
$setC[5]['dato'] = $direccion;
$setC[6]['campo'] = 'telefono';
$setC[6]['dato'] = $telefono;
$setC[7]['campo'] = 'mail';
$setC[7]['dato'] = $mail;
$setC[8]['campo'] = 'referencia';
$setC[8]['dato'] = $referencia;
$setC[9]['campo'] = 'item';
$setC[9]['dato'] = $item;
$setC[10]['campo'] = 'idalmacen';
$setC[10]['dato'] = $idalmacen;
$setC[11]['campo'] = 'estado';
$setC[11]['dato'] = $estado;
$setC[12]['campo'] = 'numero';
$setC[12]['dato'] = $numero;
$setC[13]['campo'] = 'saldoactual';
$setC[13]['dato'] = $saldoactual;
$setC[14]['campo'] = 'idciudad';
$setC[14]['dato'] = $idciudad;
$sql2 = generarInsertValues($setC);
return "INSERT INTO clientes ".$sql2;
}




function InsertarNuevoCliente(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
   
    $codigoA1 = verificarValidarText($codigo, false, "clientes", "codigo");
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
    $apellido = strtoupper($_GET['apellido']);
    //$apellido = $_GET['apellido'];
    $ciudad = $_GET['ciudad'];
      
    $telefono =$_GET['telefono'];
    $fax=$_GET['fax'];
    $direccion=strtoupper($_GET['direccion']);
    $estado='ACTIVO';
    $email=$_GET['email'];
    $numeroA = findUltimoID("clientes", "numero", true);
    $numero = $numeroA['resultado']+1;
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $idcliente = 'cli-'.$numero;

       $sql3 = "SELECT idciudad FROM ciudades WHERE idciudad = '$ciudad'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idciudad");
        $codciudad = $cantidadventaA1['resultado'];
        if($codciudad=="" ||$codciudad==null){
             $sql3 = "SELECT idciudad FROM ciudades WHERE nombre = '$ciudad'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idciudad");
        $codciudad = $cantidadventaA1['resultado'];
        $idciudad=$codciudad;
        }
            else
            {
                  $idciudad=$codciudad;
            }

    $codigocompuesto = $apellido."-".$nombre;
//     $sql1= "SELECT MIN(numero) AS primero FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' ";
//    $result = findBySqlReturnCampoUnique($sql1, true, true, "primero");
//    $primero = $result['resultado'];


     $sql3 = "SELECT MIN(numero) AS primero FROM clientes WHERE idciudad = '$idciudad' and idalmacen='$idalmacen' and apellido='$apellido' and nombre='$nombre'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "primero");
        $clienteexiste= $cantidadventaA1['resultado'];
    if($clienteexiste!='' || $clienteexiste!=null) {
            $sql12= "SELECT idcliente FROM clientes where numero='$clienteexiste' ";
    $result = findBySqlReturnCampoUnique($sql12, true, true, "idcliente");
    $idclienteold = $result['resultado'];
     $sql3 = "SELECT * FROM clientes WHERE idcliente='$idclienteold'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "nombre");
        $nombre= $cantidadventaA1['resultado'];
         $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "apellido");
        $apellido= $cantidadventaA1['resultado'];
     $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
       $codigocompuesto = $apellido."-".$nombre;
    }
    else
    {
   $sql[] =getSqlNewClientes($idcliente, $codigo, $apellido, $nombre, $nit, $direccion, $telefono, $mail, $codigocompuesto, $item, $idalmacen, $estado, $numero, $saldoactual, $idciudad, $return);

    }
   //   $sql[] = getSqlNewClientes($idcliente, $tipo, $codigo, $nombre, $telefono, $direccion, $email, $fax, $numero, $estado, $apellido, $ciudad, $return);
 
    //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "$codigocompuesto";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "$codigocompuesto";
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
function InsertarNuevoClienteIngreso(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);

    $codigoA1 = verificarValidarText($codigo, false, "clientes", "codigo");
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
    $apellido = strtoupper($_GET['apellido']);
    //$apellido = $_GET['apellido'];
    $ciudad = $_GET['ciudad'];

    $telefono =$_GET['telefono'];
    $fax=$_GET['fax'];
     $nit=$_GET['nit'];
    $direccion=strtoupper($_GET['direccion']);
    $estado='ACTIVO';
    $email=$_GET['email'];
    $numeroA = findUltimoID("clientes", "numero", true);
    $numero = $numeroA['resultado']+1;
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $idcliente = 'cli-'.$numero;

       $sql3 = "SELECT idciudad,codigo FROM ciudades WHERE idciudad = '$ciudad'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idciudad");
        $codciudad = $cantidadventaA1['resultado'];
          $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "codigo");
        $codigciud = $cantidadventaA1['resultado'];
        if($codciudad=="" ||$codciudad==null){
             $sql3 = "SELECT idciudad,codigo FROM ciudades WHERE nombre = '$ciudad'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idciudad");
        $codciudad = $cantidadventaA1['resultado'];
           $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "codigo");
        $codigciu = $cantidadventaA1['resultado'];
        $idciudad=$codciudad;
        }
            else
            {
                  $idciudad=$codciudad;
                  $codigciu = $codigciud;
            }

    $codigocompuesto = $apellido."-".$nombre;

//     $sql1= "SELECT MIN(numero) AS primero FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' ";
//    $result = findBySqlReturnCampoUnique($sql1, true, true, "primero");
//    $primero = $result['resultado'];


     $sql3 = "SELECT MIN(numero) AS primero FROM clientes WHERE idciudad = '$idciudad' and idalmacen='$idalmacen' and apellido='$apellido' and nombre='$nombre'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "primero");
        $clienteexiste= $cantidadventaA1['resultado'];
    if($clienteexiste!='' || $clienteexiste!=null) {
            $sql12= "SELECT idcliente FROM clientes where numero='$clienteexiste' ";
    $result = findBySqlReturnCampoUnique($sql12, true, true, "idcliente");
    $idclienteold = $result['resultado'];
     $sql3 = "SELECT * FROM clientes WHERE idcliente='$idclienteold'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "nombre");
        $nombre= $cantidadventaA1['resultado'];
         $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "apellido");
        $apellido= $cantidadventaA1['resultado'];
     $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
       $codigocompuesto = $apellido."-".$nombre;
    }
    else
    {
   $sql[] =getSqlNewClientes($idcliente, $codigo, $apellido, $nombre, $nit, $direccion, $telefono, $mail, $codigocompuesto, $item, $idalmacen, $estado, $numero, $saldoactual, $idciudad, $return);

    }
   //   $sql[] = getSqlNewClientes($idcliente, $tipo, $codigo, $nombre, $telefono, $direccion, $email, $fax, $numero, $estado, $apellido, $ciudad, $return);
 $codigocompuesto1= $codigo."/".$codigciu;
    //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "$codigocompuesto1";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "$codigocompuesto";
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

function getSqlDeleteClientes($idclientes){
    return "DELETE FROM clientes WHERE idcliente = '$idclientes'";
}

function EliminarCliente($idcliente,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idclienteA = validarText($idcliente, true);
    if($idclienteA['error']==false){
        $dev['mensaje'] = "No puede eliminar este Cliente. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $sql[] = getSqlDeleteClientes($idcliente);

    //            MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Cliente correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar un Cliente";
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
 function CambiarEstado($idcliente){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];

   $sqlq = "SELECT COUNT(idventa) as ventas FROM ventas WHERE idcliente = '$idcliente' group by idcliente";
  $detalleA = findBySqlReturnCampoUnique($sqlq, true, true, "ventas");
        $idclienteventa =  $detalleA['resultado'];

         $sqlqw = "SELECT COUNT(idcrecliente) as ventas FROM creditocliente WHERE idcliente = '$idcliente' group by idcliente";
  $detalleA = findBySqlReturnCampoUnique($sqlqw, true, true, "ventas");
        $idclienteventacredito =  $detalleA['resultado'];

    if(($idclienteventa > '0')&&($idclienteventacredito > '0') ){
 
        $dev['error'] = "false";
         $dev['resultado'] = "El cliente no puede inactivarse , tiene ventas y credito asignados";
           $dev['mensaje'] = "El cliente no puede inactivarse , tiene ventas y credito asignados";
           $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;


       }else{

 $sql[] = "UPDATE clientes set estado='INACTIVO' WHERE idcliente = '$idcliente';";
 //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['error'] = "true";
 $dev['mensaje'] = "todo ok";
 $dev['cobrosventas'] = "$nopendientes1";
        $dev['mensaje'] = "registro correcto";
        $dev['error'] = "true";
        $dev['resultado'] = "sdsd";
    }
    else
    {   $dev['error'] = "true";
 $dev['mensaje'] = "Existe cobros . no se puede revertir";
 $dev['cobrosventas'] = "$nopendientes1";
        $dev['mensaje'] = "Ocurrio un error";
        $dev['error'] = "false";
        $dev['resultado'] = "sdsd";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {   $dev['error'] = "true";
 $dev['mensaje'] = "Existe cobros . no se puede revertir";
 $dev['cobrosventas'] = "$nopendientes1";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
 }
}
//function CambiarEstado($idcliente,$callback, $_dc, $return= 'true'){
//    $dev['mensaje'] = "";
//    $dev['error']   = "";
//
////    $sql1="SELECT * FROM clientes WHERE idcliente = '$idcliente'";
////    $link=new BD;
////    $link->conectar();
////    $res=$link->consulta($sql1);
//
// //$itemproducto1 = verificarValidarText($idcliente, true, "ventas", "idcliente");
// //   $itemproducto2 = verificarValidarText($idcliente, true, "creditocliente", "idcliente");
////$itemproducto3 = verificarValidarText($idcliente, true, "creditomayor", "idcliente");
// $sqlq = "SELECT COUNT(idventa) as ventas FROM ventas WHERE idcliente = '$idcliente' group by idcliente";
//  $detalleA = findBySqlReturnCampoUnique($sqlq, true, true, "ventas");
//        $idclienteventa =  $detalleA['resultado'];
//
//         $sqlqw = "SELECT COUNT(idcrecliente) as ventas FROM creditocliente WHERE idcliente = '$idcliente' group by idcliente";
//  $detalleA = findBySqlReturnCampoUnique($sqlqw, true, true, "ventas");
//        $idclienteventacredito =  $detalleA['resultado'];
////echo $idcliente;
////if(($itemproducto1['error'] == false)&&($itemproducto2['error'] == false)&&($itemproducto3['error'] == false)){
//
//if(($idclienteventa > '0')&&($idclienteventacredito > '0') ){
//
//           $dev['mensaje'] = "El cliente no puede inactivarse , tiene ventas y credito asignados-"+$idcliente;
//            $json = new Services_JSON();
//            $output = $json->encode($dev);
//            print($output);
//            exit;
//     }
//        else{
//           $sql[] = "UPDATE clientes set estado='INACTIVO' WHERE idcliente = '$idcliente';";
//        }
//
//
////             MostrarConsulta($sql);
//    if(ejecutarConsultaSQLBeginCommit($sql))
//    {
//        $dev['mensaje'] = "Se Elimino el Cliente correctamente";
//        $dev['error'] = "true";
//        $dev['resultado'] = "";
//    }
//    else
//    {
//        $dev['mensaje'] = "Ocurrio un error al elminar un Cliente";
//        $dev['error'] = "false";
//        $dev['resultado'] = "";
//    }
//    if($return == true)
//    {
//        return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//    }
//
//}
?>