<?php 
session_name("balderrama");
session_start();
include("impl/ListaPrecios.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListaPrecios"){


        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        $idcoleccion= $datos->resultado;
        
        ListaPrecios($idcoleccion, $_GET['callback'], $_GET['_dc'], $return);

    }
    else if($funcion == "GuardarNuevaLinea"){
        $idmarca = $_GET['idmarca'];
        InsertarNuevaLinea($idmarca,false);
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