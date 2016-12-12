<?php 
session_name("balderrama");
session_start();
include("impl/MarcaDetalle.php");
include("impl/Ciudad.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarMarca"){

   
        ListarMarca($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion == "GuardarNuevaMarca"){
       
         InsertarNuevaMarca();
    }
    else if($funcion =="BuscarCiudad"){
       
        BuscarCiudad($_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion =="GuardarEditarMarca"){
        $idmarca=$_GET['idmarca'];
        GuardarEditarMarca($idmarca);
    }
    else if($funcion =="BuscarCiudadPorMarca"){
        $idmarca= $_GET['idmarca'];
        BuscarCiudadPorMarca($idmarca,$_GET['callback'], $_GET['_dc'],false);
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