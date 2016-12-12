<?php 
session_name("balderrama");
session_start();
require_once("impl/Etapas.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//ubadlo
if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "buscaretapasporfactura")
    {//$idcliente=$_GET['buscarcredito'];
        buscaretapasporfactura($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['numerofactura']);
    } 

    else if($funcion =="BuscarDatosEtapa")
    {
        $numerofactura = $_GET['numerofactura'];
        BuscarDatosEtapa($numerofactura, false);
    }
    else if($funcion =="BuscarEtapa"){
        $idetapa = $_GET['idetapa'];
        BuscarEtapa($idetapa,$_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion =="GuardarEditarEtapa"){
        $idetapa=$_GET['idetapa'];
        GuardarEditarEtapa($idetapa);
    }

   else
   {
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