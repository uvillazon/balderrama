<?php 
session_name("balderrama");
session_start();
require_once("impl/Material.php");

include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarMateriales"){
        $extras = $_GET['idmarca'];
        ListarMateriales($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }

    else if($funcion == "insertarMaterial"){
        InsertarNuevoMaterial();
    }
    else if($funcion =="buscarMaterialid"){
        $idmaterial = $_GET['idmaterial'];
        buscarMaterialid($idmaterial,false);
    }
    else if($funcion =="modificarMaterial"){
        GuardarEditarMaterial();
    }
    else if($funcion =="EliminarMaterial"){
        EliminarMaterial($_GET['idmaterial'],$_GET['callback'], $$_GET['dc'],'');
    }
    else if($funcion =="BuscarMaterialPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarMaterialPorMarca($idmarca,false);
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