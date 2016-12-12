<?php
function ListarCalzado($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
        $sql = "
SELECT
  ca.idcalzado,
  mo.codigo AS modelo,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ca.imagen,
  car.descripcionmaterial AS material,
  car.descripcioncolor AS color,
  mar.nombre AS marca
FROM
  `calzados` ca,
  `modelos` mo,
  `lineas` li,
  `coleccion` co,
  `caracteristicas` car,
  `marcas` mar
WHERE
  ca.idmodelo = mo.idmodelo AND
  ca.idcaracteristica = car.idcaracteristica AND
  mar.idmarca = mo.idmarca AND
  mo.idcoleccion = co.idcoleccion AND
  mo.idlinea = li.idlinea $order LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
     SELECT
  ca.idcalzado,
  mo.codigo AS modelo,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ca.imagen,
  car.descripcionmaterial AS material,
  car.descripcioncolor AS color,
  mar.nombre AS marca
FROM
  `calzados` ca,
  `modelos` mo,
  `lineas` li,
  `coleccion` co,
  `caracteristicas` car,
  `marcas` mar
WHERE
  ca.idmodelo = mo.idmodelo AND
  ca.idcaracteristica = car.idcaracteristica AND
  mar.idmarca = mo.idmarca AND
  mo.idcoleccion = co.idcoleccion AND
  mo.idlinea = li.idlinea AND $where $order LIMIT $start,$limit
         ";
        //        MostrarConsulta($sql);
    }
    //    echo $sql;

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
    $dev['totalCount'] = allBySql($sql);
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