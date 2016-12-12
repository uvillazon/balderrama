<?php 
session_name("balderrama");
session_start();
include("impl/Tienda.php");
include("impl/Utils.php");
require_once("impl/Almacen.php");
include("impl/UsuariosAdmin.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarTienda"){

        $band = false;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {
                $extras .= " lin.codigo LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND lin.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
       
        ListarTienda($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion =="BuscarAlmacenUsuarioPorTienda"){
        $idcliente = $_GET['idtienda'];
        BuscarAlmacenUsuarioPorTienda($idcliente,$_GET['callback'], $_GET['_dc'],false);
    }
    
    else if($funcion == ""){
       
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