<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/KardexAlmacenAdmin.php");
include("impl/Utils.php");
require_once("impl/JSON.php");

//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "GuardarControlPrecioPedido"){
      $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    //insertarventa($datos,false);
    GuardarControlPrecioPedido($datos,false);
    }

    else if($funcion =="BuscarMarcaColeccionLinea"){

        BuscarMarcaColeccionLinea(false);
    }
     else if($funcion =="BuscarModeloPorEstilo"){
        $idmarca = $_GET['idestilo'];
        BuscarModeloPorEstilo($idmarca, false);
    }
    else if($funcion =="BuscarMarcaColeccion"){

        BuscarMarcaColeccion(false);
    }
    else if($funcion =="BuscarModeloPorMarcaColeccion"){
        BuscarModeloPorMarcaColeccion($_GET['idmarca'],$_GET['idcoleccion'],false);
    }
    else if($funcion == "ListarProductosKardexAlmacen"){
        $band = false;
       
        if($_GET['buscarnumeropedido'] != null)
        {
            if($band == false) {
                $extras .= "  det.codigo LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND  det.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
        if($_GET['buscarmarca']){
            if($band==false){
                $extras .= "  det.detalle LIKE '%".$_GET['buscarlinea']."%'";
                $band = true;

            }
            else {
                $extras .= " AND  det.detalle LIKE '%".$_GET['buscarlinea']."%'";
            }


        }


        ListarProductosKardexAlmacen($_GET['idmarca'],$_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$extras, false);
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