<?php
session_name("balderrama");
session_start();
//include("impl/UsuarioDAO.php");
//include("impl/RolDAO.php");
//include("impl/SucursalDAO.php");
//include("impl/AlmacenDAO.php");
include("impl/CargarDatosDAO.php");
include("impl/Colores.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
require_once 'impl/ExcelReader.php';
//error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";
if(permitido("fun2001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['function'];

    if($funcion == "findAllFiles")
    {
        $callback = $_GET['callback'];
        findAllFiles($callback, false);
    } else if ($funcion == "findVistaPrevia")
    {
        findVistaPrevia($_GET['file'], false);
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