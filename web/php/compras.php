<?php
session_start();

include("impl/Utils.php");
include("impl/ListarCompras.php");
include("impl/ListarProductoProveedor.php");
include("impl/Producto.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";
//if(permitido($_SESSION['idrol'],"")==false) // enviar en el segundo parametro vendedor.
//{

$funcion = $_GET['funcion'];

if($funcion == "listarcompras")
{
    $band = false;
    if($_GET['buscarcodigo'] != null)
    {
        if($band == false) {
            $extras .= " c.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.codigo LIKE '%".$_GET['buscarcodigo']."%'";
        }
    }
    if($_GET['buscarfecha'] != null)
    {
        if($band == false) {
            $extras .= " c.fecha LIKE '%".$_GET['buscarfecha']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.fecha LIKE '%".$_GET['buscarfecha']."%'";
        }
    }

    if($_GET['buscarproveedor'] != null)
    {
        if($band == false) {
            $extras .= " p.nombre LIKE '%".$_GET['buscarproveedor']."%'";
            $band = true;
        }
        else {
            $extras .= " AND p.nombre LIKE '%".$_GET['buscarproveedor']."%'";
        }
    }
 
    listarcompras($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
}
else if($funcion == "listarcomprasentrega")
{
    $band = false;
    if($_GET['buscarid'] != null)
    {
        if($band == false) {
            $extras .= " c.idcompra LIKE '%".$_GET['buscarid']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.idcompra LIKE '%".$_GET['buscarid']."%'";
        }
    }
    if($_GET['buscarfecha'] != null)
    {
        if($band == false) {
            $extras .= " c.fecha LIKE '%".$_GET['buscarfecha']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.fecha LIKE '%".$_GET['buscarfecha']."%'";
        }
    }

    if($_GET['buscarproveedor'] != null)
    {
        if($band == false) {
            $extras .= " p.nombre LIKE '%".$_GET['buscarproveedor']."%'";
            $band = true;
        }
        else {
            $extras .= " AND p.nombre LIKE '%".$_GET['buscarproveedor']."%'";
        }
    }
    if($_GET['buscartipo'] != null)
    {
        if($band == false) {
            $extras .= " c.tipo LIKE '%".$_GET['buscartipo']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.tipo LIKE '%".$_GET['buscartipo']."%'";
        }
    }
    listarcomprasentrega($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
}
else if($funcion == "listarmonedaydoc"){

    listarmonedaydoc($_GET['start'], $_GET['limit'], $_GET['$sort'], $_GET['dir'],$_GET['callback'], $_GET['dc'], false);
}
else if($funcion == "insertarcompradirecta"){

    $resultado = $_POST['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    insertarcompradirecta($datos,false);
}
else if($funcion == "insertarcompraconcuenta"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    insertarcompraconcuenta($datos,false);
}
else if($funcion == "insertarcompraentregas"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    insertarcompraentregas($datos,false);
}

else if($funcion =="buscarcompraporid"){
    $idcompra = $_GET['idcompra'];
    buscarcompraporid($idcompra,$_GET['callback'], $$_GET['dc'],'');
}

else if($funcion == "eliminarcompra"){

    eliminarcompra($_GET['idcompra'],$_GET['callback'], $$_GET['dc'],'');

}
else if($funcion == "insertarnuevotipo"){

    insertartipocambio($_GET['tipocambio'],$_GET['callback'], $$_GET['dc'],'');

}

//}
else
{
    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
    $dev['error'] = "false";
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}

?>