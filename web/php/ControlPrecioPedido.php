<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/ControlPrecioPedido.php");
include("impl/Marca.php");
include("impl/Pedidos.php");
include("impl/Utils.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarModelosPedido"){
        $idpedido = $_GET['idpedido'];
        $extras .= "det.idpedido = '$idpedido'";
        $band = true;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {
                $extras .= " det.codigo LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND det.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
         if($_GET['buscarlinea'] != null)
        {
            if($band == false) {
                $extras .= " det.linea LIKE '%".$_GET['buscarlinea']."%'";
                $band = true;
            }
            else {
                $extras .= " AND det.linea LIKE '%".$_GET['buscarlinea']."%'";
            }
        }


        ListarModelosPedido($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);

    }

    else if($funcion =="BuscarMarcaPedido"){

        BuscarMarcaPedido(false);
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