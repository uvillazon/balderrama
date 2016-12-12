<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
require_once("impl/JSON.php");
require_once("impl/LineaLocal.php");
require_once("impl/MarcaDetalle.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarLineaLocal"){
        ListarLineaLocal($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
 else if($funcion == "BuscarMarcalocal"){
        BuscarMarcalocal($_GET['callback'], $_GET['_dc'], "",false);
    }
     else if($funcion == "GuardarNuevoLinea"){
        InsertarNuevoLinea();
    }
    else if($funcion = "BuscarEstiloMarcaColeccionPorId"){

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