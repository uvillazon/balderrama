<?php
session_name("balderrama");
session_start();
require_once("impl/JSON.php");
error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";

$resultado = $_POST['resultado'];
$json = new Services_JSON();
$datos = $json->decode($resultado);

$dest = "uvillazon@doptima.com";
$head = "From: uvillazon@doptima.com\r\n";
$head .= "To: uvillazon@doptima.com\r\n";
// Ahora creamos el cuerpo del mensaje
$msg = "------------------------------- \n";
$msg.= "         Errores del Sistema            \n";
$msg.= "------------------------------- \n";

$msg.= "TITULO:   ".$datos->titulo."\n";
$msg.= "NOMBRE:   ".$_SESSION["user"]."\n";
$msg.= "EMPRESA:  ".$_SESSION["empresa"]."\n";
$msg.= "HORA:     ".date("H:i:s")."\n";
$msg.= "FECHA:    ".date("Y-m-d")."\n";
$msg.= "IP:       ".getRealIpAddr()."\n";
$msg.= "------------------------------- \n\n";
$msg.= $datos->detalle."\n\n";
$msg.= "------------------------------- \n";
// Finalmente enviamos el mensaje
if (mail($dest, "[SelkisWeb]", $msg, $head)) {
    $dev['mensaje'] = "Se envio correctamente el reporte de errores";
    $dev['error'] = "true";
} else {
    $dev['mensaje'] = "Ocurrio un error al enviar el reporte..";
    $dev['error'] = "false";
}
$json = new Services_JSON();
$output = $json->encode($dev);
print($output);
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>