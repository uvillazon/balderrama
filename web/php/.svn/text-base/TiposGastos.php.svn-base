<?php 
session_name("balderrama");
session_start();
require_once("impl/TiposGastos.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//ubadlo
if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarGastosMayores"){

        ListarGastosMayores($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], "",false);

 }else
	if($funcion == "ListarGastosMenores"){

        ListarGastosMenores($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], "",false);
    }else
 if($funcion == "GuardarNuevoTiposGastos"){
        GuardarNuevoTiposGastos();
    }
    else
 if($funcion == "GuardarNuevoTiposGastosDetalle"){
        GuardarNuevoTiposGastosDetalle();
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