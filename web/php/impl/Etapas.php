<?php
function GuardarEditarEtapa($idetapa){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];

    $tipos = $_GET['tipos'];
    $nombre = $_GET['nombre'];
    $responsable = $_GET['tipos'];
    $idciudad =$_GET['ciudad'];
    $telefono =$_GET['telefono'];
    if($_GET['tipos']=='ALMACEN'){
    $itemproducto = verificarValidarText($idalmacen, true, "tiendas", "idalmacen");
    $verificatienda = verificarBorrarenTablas($idalmacen,true);
 if($itemproducto['error'] == true){

        $sql[] = "DELETE FROM tiendas WHERE idalmacen = '$idalmacen';";
        }
    else{
         $error[] = " $idalmacen";
    }
    }else{
        $numeroT = findUltimoID("tiendas", "numero", true);
        $numerot = $numeroT['resultado']+1;
        $idtienda = 'tie-'.$numerot;
        $responsable = "usr-1000";
       $sql[] = getSqlNewTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, $return);

        //$sql[] = getSqlUpdateTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, false);

    }
    $sql[] = getSqlUpdateAlmacen($idalmacen,$idciudad,$nombre, $codigo, $direccion, $responsable, $numero, $telefono, $fax, false);

     //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar los datos";
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

function BuscarDatosEtapa($numerofactura,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";

//    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
//    $numero = $numeropa['resultado']+1;
//    $anio = date("Y");
//    $value['numeropedido'] = $numero."/".$anio;
//

    $sql ="
SELECT cp.numerofactura,cp.numeroproforma,cp.totalcajas,cp.totalpares AS cantidad,cp.marca
FROM facturapedido cp
WHERE cp.numerofactura = '$numerofactura'

";
    //echo $sql;
    if($numerofactura != null)
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
function buscaretapasporfactura($start, $limit, $sort, $dir, $callback, $_dc, $return, $numerofactura)
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

    $select = "mae.idetapa,e.nombre,epc.estado,epc.obervacion AS observacion,epc.responsable";
    $from = "facturapedido cp,pedidos pe,etapaspedidosconfirmados epc,etapas e,marcaetapas mae";
    $where = "cp.idpedido=pe.idpedido AND epc.idetapa=e.idetapa AND e.idetapa=mae.idetapa AND mae.existe='si' AND mae.idmarca=pe.idmarca ";
        if($numerofactura != null && $numerofactura != "")
    {
        $where .= " AND cp.numerofactura LIKE '%$numerofactura%' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
            //echo $sql;
    $devT = getTablaToArrayOfSQL($sql);
    $dev['error'] = $devT['error'];
    $dev['mensaje'] = $devT['mensaje'];
    $dev['resultado'] = $devT['resultado'];
    $dev['totalCount'] = $devT['totalCount'];

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
function BuscarEtapa($idetapa,$callback, $_dc, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
   // echo $idetapa;
$numeroB=  findUltimoIDCondicion("etapaspedidosconfirmados", "numero","idetapa",$idetapa, true);
//function findUltimoIDCondicion($tabla, $campo,$condicion,$valor, $return)

//$numeroB=  findUltimoID("etapaspedidosconfirmados", "numero", true);

    $numeroB = $numeroB['resultado'];
   //echo $numeroB;
$numeroant=$numeroB -1;

$sqlprecio = "
SELECT
  kar.estado
FROM
  etapaspedidosconfirmados kar
WHERE
  kar.numero = '$numeroant'";
            $preciomayorV = findBySqlReturnCampoUnique($sqlprecio, true, true, "estado");
            $preciomayorV1 = $preciomayorV['resultado'];
//echo $preciomayorV1;
           if($preciomayorV1 == "PENDIENTE")
            {
                $dev['mensaje'] = "La anterior etapa aun esta pendiente. no se puede cambiar el estado";
               $dev['error']   = "false";
               $json = new Services_JSON();
                $output = $json->encode($dev);
                print($output);
                exit;
            }
else{


    $sql ="
SELECT
  epc.idetapa,epc.estado,e.nombre
FROM
  etapas e,etapaspedidosconfirmados epc
WHERE
  epc.idetapa=e.idetapa AND epc.idetapa = '$idetapa';

";
}
    if($idetapa != null)
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

?>