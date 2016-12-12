<?php
function listarproductoNOproveedor($idproveedor,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    if($where == null || $where == "")
    {
        $sql = "SELECT
  p.codigo,
  p.idproducto,
  p.nombre,
  k.saldocantidad AS cantidad,
  p.unidad,
  c.nombre AS categoria
FROM
  productos p,
  kardex k,
  categorias c
WHERE
  p.idproducto = k.idproducto AND
  c.idcategoria = p.idcategoria AND
  p.idproducto NOT IN
(SELECT pp.idproducto FROM productoproveedor pp where pp.idproveedor = '$idproveedor')  $order LIMIT $start,$limit ";

    }
    else
    {
        $sql = "SELECT
  p.codigo,
  p.nombre,
  p.idproducto,
  k.saldocantidad AS cantidad,
  p.unidad,
  c.nombre AS categoria
FROM
  productos p,
  kardex k,
  categorias c
WHERE
  p.idproducto = k.idproducto AND
  c.idcategoria = p.idcategoria AND $where AND
  p.idproducto NOT IN (SELECT pp.idproducto FROM productoproveedor pp where pp.idproveedor = '$idproveedor')
        $order LIMIT $start,$limit ";

    }
    //        echo $sql;
    $de1= NumeroTuplas($sql);
    $dev['totalCount']= $de1['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
                    $dev['mensaje'] = "El proveedor tiene todos los productos de la base de datos";
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
function listarproductoproveedor($idproveedor,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    if($where == null || $where == "")
    {
        $sql = "SELECT
  p.codigo,
  p.idproducto,
  p.nombre,
  k.saldocantidad AS cantidad,
  p.unidad,
  c.nombre AS categoria
FROM
  productos p,
  kardex k,
  categorias c
WHERE
  p.idproducto = k.idproducto AND
  c.idcategoria = p.idcategoria AND
  p.idproducto IN
(SELECT pp.idproducto FROM productoproveedor pp where pp.idproveedor = '$idproveedor')  $order LIMIT $start,$limit ";

    }
    else
    {
        $sql = "SELECT
  p.codigo,
  p.nombre,
  p.idproducto,
  k.saldocantidad AS cantidad,
  p.unidad,
  c.nombre AS categoria
FROM
  productos p,
  kardex k,
  categorias c
WHERE
  p.idproducto = k.idproducto AND
  c.idcategoria = p.idcategoria AND $where
  p.idproducto IN (SELECT pp.idproducto FROM productoproveedor pp where pp.idproveedor = '$idproveedor')
        $order LIMIT $start,$limit ";

    }
    //    echo $sql;
    $de1= NumeroTuplas($sql);
    $dev['totalCount']= $de1['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
                    $dev['mensaje'] = "El proveedor tiene todos los productos de la base de datos";
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
function getSqlNewProductoproveedor($idproducto, $idproveedor, $return){
    $setC[0]['campo'] = 'idproducto';
    $setC[0]['dato'] = $idproducto;
    $setC[1]['campo'] = 'idproveedor';
    $setC[1]['dato'] = $idproveedor;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO productoproveedor ".$sql2;
}


function agregaraproveedor($idproveedor,$resultado){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    for($i=0;$i<count($resultado);$i++){

        $producto = $resultado[$i];
        $idproducto = $producto->idproducto;
        $sql[]=getSqlNewProductoproveedor($idproducto, $idproveedor, false);
    }
    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql) == true)
    {
        $dev['mensaje'] = "Se guardo correctamente la asignacion de productos a proveedores ";
        $dev['error']   = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Error al asignar a  los proveedores - productos";
        $dev['error']   = "false";
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
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }
}
function getSqlDeleteProductoproveedor($idproducto,$idproveedor,$return){
    return "DELETE FROM productoproveedor WHERE idproducto = '$idproducto' AND idproveedor='$idproveedor'";
}

function eliminardeproveedor($idproveedor,$resultado){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    for($i=0;$i<count($resultado);$i++){

        $producto = $resultado[$i];
        $idproducto = $producto->idproducto;
        $sql[]=getSqlDeleteProductoproveedor($idproducto, $idproveedor, false);
    }
//    MostrarConsulta($sql);
         if(ejecutarConsultaSQLBeginCommit($sql) == true)
        {
            $dev['mensaje'] = "Se guardo correctamente la asignacion de productos a proveedores ";
            $dev['error']   = "true";
            $dev['resultado'] = "";
        }
        else
        {
            $dev['mensaje'] = "Error al asignar a  los proveedores - productos";
            $dev['error']   = "false";
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
            //$output = substr($output, 1);
            //$output = "$callback({".$output.");";
            print($output);
        }
}
?>
