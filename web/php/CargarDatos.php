<?php
//session_name("balderrama");
session_start();
//include("impl/MarcaDAO.php");
//include("impl/UsuarioDAO.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";
if(permitido("fun2001", $_SESSION['codigo'])==true)
{
    //if ($_FILES["file"]["type"] == "application/vnd.ms-excel")
    if ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
    {
        //         || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
        //&& ($_FILES["file"]["size"] < 20000)
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            //            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            //            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            //            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            //            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
            $enlace = "../configuracion/".$_SESSION['empresa']."/" . $_FILES["file"]["name"];
            if (file_exists($enlace))
            {
                echo $_FILES["file"]["name"] . " Ya existe el archivo ";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], $enlace);
                echo "Se cargo correctamente el archivo";
            }
        }
    }
    else
    {
        echo "El archivo no es valido solo se permiten archivos excel .XLS compatibles con Excel 2003 o inferior";
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