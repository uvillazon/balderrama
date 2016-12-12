<?php 
session_name("balderrama");
session_start();
include("impl/Estilo.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarEstilo"){
        $band = false;
        if($_GET['buscarmodelo'] != null)
        {
            if($band == false) {
                $extras .= " est.descripcion LIKE '%".$_GET['buscarmarca']."%'";
                $band = true;
            }
            else {
                $extras .= " AND est.descripcion LIKE '%".$_GET['buscarmarca']."%'";
            }
        }

        ListarEstilo($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,$_GET['buscarmarca'], false);
    //    ListarModelo($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);

 }
    else if($funcion == "GuardarEstilo"){
        GuardarEstilo();
    }
    else if($funcion == "GuardarNuevoEstilo"){
        GuardarNuevoEstilo();
    }
    else if($funcion == "GuardarEditarEstilo"){
        GuardarEditarEstilo();
    }
    else if($funcion == "CargarNuevoEstilo"){
        CargarNuevoEstilo($_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="CargarDatosEstiloMarca"){
        $idestilo = $_GET['idestilo'];
        CargarDatosEstiloMarca($idestilo,$_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="EliminarEstilo"){
        $idestilo = $_GET['idestilo'];
        EliminarEstilo($idestilo, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion = ""){
        $idproveedor = $_GET['idproveedor'];
        BuscarProveedorPorId($idproveedor,false);
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