<?php
session_name("balderrama");
session_start();
include("impl/codigobarra.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";
//if(permitido("fun1024", $_SESSION['codigo'])==true)nofunciona//reportecuentaproveedorHTML
//{
$funcion = $_GET['funcion'];
$idventa = $_GET['idventa'];
$idcompra = $_GET['idcompra'];

if($funcion == "generarcodigoBarra")
{//hooooo

    generarcodigo(false);

}

else if($funcion == "reporteAlmacenHTML")
{
    reporteAlmacen($_GET['idalmacen'], false);

}

?>
