<?php 
session_name("balderrama");
session_start();
require_once("impl/Almacen.php");
require_once("impl/Tienda.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

//if(permitido("fun1000", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarAlmacen"){
       
        ListarAlmacen($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], "",false);
    }
   else if($funcion == "BuscarResponsableCiudad"){
        BuscarResponsableCiudad($_GET['callback'], $_GET['_dc'], "",false);
    }
    else if($funcion =="BuscarResponsableCiudadPorAlmacen"){
        $idalmacen = $_GET['idalmacen'];
        BuscarResponsableCiudadPorAlmacen($idalmacen,$_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion == "GuardarNuevoAlmacen"){
        InsertarNuevoAlmacen();
    }
    else if($funcion =="GuardarEditarAlmacen"){
        $idalmacen=$_GET['idalmacen'];
        GuardarEditarAlmacen($idalmacen);
    }
    else if($funcion =="EliminarAlmacen"){
        $idalmacen = $_GET['idalmacen'];
        EliminarAlmacen($idalmacen, $_GET['callback'],$_GET['_dc'],false);
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