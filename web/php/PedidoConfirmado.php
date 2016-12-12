<?php 
session_name("balderrama");
session_start();
include("impl/PedidosConfirmados.php");
require_once("impl/KardexAlmacen.php");

//include("impl/DetallePedido.php");
//include("impl/Modelo.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
//    sadsakdjhksah
    if($funcion == "ListarPedidosConfirmados"){
        $band = false;
        $idpedido = $_GET['iconfirmardpedido'];
        $extra .="det.idconfirmarpedido = '$idpedido'";
        if($_GET['buscarfactura'] != null)
        {
            if($band == false) {
                $extras .= " pe.numerofactura LIKE '%".$_GET['buscarfactura']."%'";
                $band = true;
            }
            else {
                $extras .= " AND pe.numerofactura LIKE '%".$_GET['buscarfactura']."%'";
            }
        }
         if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " pe.fecha LIKE '%".$_GET['buscarfecha']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.fecha LIKE '%".$_GET['buscarfecha']."%'";
            }
        }
        if($_GET['buscarestado'] != null)
        {
            if($band == false) {
                $extras .= " pe.responsable LIKE '%".$_GET['buscarresponsable']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.responsable LIKE '%".$_GET['buscarresponsable']."%'";
            }
        }

        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }
        
        ListarPedidosConfirmados($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
else
    if($funcion == "ListarIngresosAlmacen"){
        $band = false;
        $idpedido = $_GET['idconfirmarpedido'];
        $extra .="det.idconfirmarpedido = '$idpedido'";
        if($_GET['buscarfactura'] != null)
        {
            if($band == false) {
                $extras .= " pe.numerofactura LIKE '%".$_GET['buscarfactura']."%'";
                $band = true;
            }
            else {
                $extras .= " AND pe.numerofactura LIKE '%".$_GET['buscarfactura']."%'";
            }
        }
         if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " pe.fecha LIKE '%".$_GET['buscarfecha']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.fecha LIKE '%".$_GET['buscarfecha']."%'";
            }
        }
        if($_GET['buscarestado'] != null)
        {
            if($band == false) {
                $extras .= " pe.responsable LIKE '%".$_GET['buscarresponsable']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.responsable LIKE '%".$_GET['buscarresponsable']."%'";
            }
        }

        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }

        ListarIngresosAlmacen($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }


else if($funcion =="RegistrarIngresoAlmacen"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        RegistrarIngresoAlmacen($datos,false);
    }
    else{
        echo "else";
    }


}
else
{
    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
    $dev['error'] = "false";
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}
?>