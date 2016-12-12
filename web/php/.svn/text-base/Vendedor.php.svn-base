<?php 
session_name("balderrama");
session_start();
require_once("impl/Vendedor.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarVendedor"){
       
        ListarVendedor($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
    
    else if ($funcion == "GuardarNuevoVendedor"){
        InsertarNuevoVendedor();
    }
    else if($funcion == "GuardarEditarVendedor"){
        $idvendedor = $_GET['idvendedor'];
        GuardarEditarVendedor($idvendedor);
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