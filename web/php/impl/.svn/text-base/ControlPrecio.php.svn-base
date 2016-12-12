<?php
function GuardarControlPrecioPedido($resultado, $return)
{


    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $product = $resultado->productos;
 for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
        $iddetallepedido = $producto->iddetallepedido;
        $costounitario  = $producto->costounitario;
        $preciooficina  = $producto->preciooficina;
        $preciomayor  = $producto->preciomayor;
        $observacion  = $producto->observacion;
     $sql2= "SELECT
              idkardexalmacen
            FROM
              detallepedido
            WHERE
              iddetallepedido = '$iddetallepedido'";
    $result2 = findBySqlReturnCampoUnique($sql2, true, true, "idkardexalmacen");
    $idkardexalmacen = $result2['resultado'];



$sql[] = "UPDATE detallepedido SET costounitario='$costounitario' WHERE iddetallepedido='$iddetallepedido'";

$sql[] = "UPDATE kardexalmacen SET precio1sus='$costounitario',precio2sus='$preciooficina',precio3sus='$preciomayor' WHERE idkardexalmacen='$idkardexalmacen'";

$sql[] = "UPDATE detalleingresoalmacen SET precio1sus='$costounitario',precio2sus='$preciooficina',precio3sus='$preciomayor',observacion='$observacion' WHERE idkardexalmacen='$idkardexalmacen'";

    }
        //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se guardo los cambios correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $iddetallepedido;
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = $iddetallepedido;
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

function BuscarMarcaColeccionLinea($return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $proveedores =  ListarMarcas('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['Marcas'] = "true";
        $value['MarcaM'] = $proveedores['resultado'];
    }
    $categorias = ListarColeccion('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $categorias['resultado'];
    }

    $linea = ListarTodasLinea('', '', '', '', '', '',"",true);
    if($linea['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $linea['resultado'];
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
function BuscarMarcaColeccion($return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $proveedores =  ListarMarcaEmergente('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $proveedores['resultado'];
    }
    $categorias = ListarColeccionesEmergente('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $categorias['resultado'];
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

function ListarControlPrecioPedido($idpedido,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
    if(($where == null)||($where =="")){
        $sql = "
        SELECT
  det.iddetallepedido,
  det.codigo,

  CONCAT(COALESCE(det.color,'C'), ' ', COALESCE(det.material,'M'),' ', COALESCE(det.stylename,'S'),' ',COALESCE(det.linea,'L')) AS detalle,
  det.costounitario AS precio
FROM
  detallepedido det,
  pedidos ped,
  marcas mar
WHERE
  det.idpedido = ped.idpedido AND
  ped.idmarca = mar.idmarca AND det.idpedido = '$idpedido'
        $order
";
    }
    else{
        $sql ="
SELECT
  det.iddetallepedido,
  det.codigo,

  CONCAT(COALESCE(det.color,'C'), ' ', COALESCE(det.material,'M'),' ', COALESCE(det.stylename,'S'),' ',COALESCE(det.linea,'L')) AS detalle,
  det.costounitario AS precio
FROM
  detallepedido det,
  pedidos ped,
  marcas mar
WHERE
  det.idpedido = ped.idpedido AND
  ped.idmarca = mar.idmarca AND det.idpedido = '$idpedido' AND $where $order
";
    }

    //                echo $sql;
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