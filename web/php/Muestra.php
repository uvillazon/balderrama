<?php 
session_name("balderrama");
session_start();
require_once("impl/Muestra.php");
require_once("impl/Proveedor.php");
require_once("impl/Almacen.php");
require_once("impl/Marca.php");

require_once("impl/Linea.php");
require_once("impl/Etapa.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun4000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarMuestra"){
        ListarMuestras($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
    else if($funcion =="BuscarProveedorCategoriaTalla"){

        BuscarProveedorCategoriaTalla(false);
    }
    else if($funcion == "GuardarNuevaMarca"){
        GuardarNuevaMarca();
    }
    else if($funcion =="BuscarProveedorCategoriaTallaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarProveedorCategoriaTallaPorMarca($idmarca,false);
    }
    else if($funcion =="GuardarEditarMarca"){
        $idmarca=$_GET['idmarca'];
        GuardarEditarMarca($idmarca);
    }
    else if($funcion =="EliminarMarca"){
        $idmarca =$_GET['idmarca'];
        EliminarMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="BuscarColorMaterialPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarColorMaterialPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion == "BuscarMaterialPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarMaterialPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion == "BuscarColorPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarColorPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="BuscarLineaColeccionPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarLineaColeccionPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion == "GuardarConfigurarMarca"){
        GuardarConfigurarMarca();
    }
    else if($funcion == "InsertarCodificarMaterialPorMarca"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        InsertarCodificarMaterialPorMarca($datos,false);
        //echo "fsfslkfskaf";
    }
    else if($funcion == "InsertarCodificarColorPorMarca"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        InsertarCodificarColorPorMarca($datos,false);
    }
    else if($funcion =="GuardarCodificarLinea"){
        $idmarca = $_GET['idmarca'];
        GuardarCodificarLinea($idmarca,false);

    }
    else if($funcion =="BuscarLineaColeccionColorMaterialPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarLineaColeccionColorMaterialPorMarca($idmarca, false);
    } else if($funcion =="BuscarMarcaAlmacenColeccion"){
//        $idmarca = $_GET['idmarca'];
        BuscarMarcaAlmacenColeccion();
    } else if($funcion == "Listaringresomuestras")
    {//$idcliente=$_GET['buscarcredito'];
        Listaringresomuestras($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['idmarca'],$_GET['coleccion']);
    }
    else if($funcion =="BuscarModeloLineaPorMarca"){
        $idmarca = $_GET['idmarca'];
        $oficina = $_GET['oficina'];
        $oficina1 = $_GET['oficina1'];
        $oficina2 = $_GET['oficina2'];
        $oficina3 = $_GET['oficina3'];
        $oficina4 = $_GET['oficina4'];
        $oficina5 = $_GET['oficina5'];
        $oficina6 = $_GET['oficina6'];
        $oficina7 = $_GET['oficina7'];

     BuscarModeloLineaPorMarca($idmarca,$oficina,$oficina1,$oficina2,$oficina3,$oficina4,$oficina5,$oficina6,$oficina7, false);
    }else if($funcion =="GuardarNuevoMuestra"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        GuardarNuevoMuestra($datos,false);
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