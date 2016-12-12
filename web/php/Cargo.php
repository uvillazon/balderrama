<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/Utils.php");
include("impl/Cargo.php");
require_once("impl/JSON.php");

//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarCargo"){

        ListarCargo($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], "",false);
    }

    else if($funcion == "GuardarNuevoCargo"){
        GuardarNuevoCargo();
    }
    else if($funcion =="CargarDatosCargoPorId"){
        $idcargo = $_GET['idcargo'];
        BuscarCargoPorId($idcargo,false);
    }
    else if($funcion =="GuardarEditarCargo"){
        GuardarEditarCargo();
    }
    else if($funcion == "EliminarCargo"){
        $idcargo=$_GET['idcargo'];
        EliminarCargo($idcargo, $_GET['callback'],$_GET['_dc'],false);
    }
    else{
        echo "else";
    }


//}
//else
//{
//    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
//    $dev['error'] = "false";
//    $json = new Services_JSON();
//    $output = $json->encode($dev);
//    print($output);
//}
?>