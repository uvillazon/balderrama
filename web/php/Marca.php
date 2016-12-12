<?php 
session_name("balderrama");
session_start();
require_once("impl/Marca.php");
require_once("impl/Linea.php");
require_once("impl/Coleccion.php");
require_once("impl/Colores.php");
require_once("impl/Material.php");
require_once("impl/Estilo.php");
require_once("impl/Proveedor.php");
require_once("impl/Almacen.php");
require_once("impl/Etapa.php");
require_once("impl/Cliente.php");
require_once("impl/Empleado.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarMarcas"){
        ListarMarcas($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);

 }else
  if($funcion == "ListarMarcasPedido"){
        ListarMarcasPedido($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);

 }
    else
     if($funcion == "ListarMarcasTienda"){
        ListarMarcasTienda($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);

 }
    else
    if($funcion =="BuscarProveedorCategoriaTalla"){

        BuscarProveedorCategoriaTalla(false);
    }
    else if($funcion == "GuardarNuevaMarca"){
        GuardarNuevaMarca();
    }
    else if($funcion =="BuscarDatosMarca"){
        $codigo = $_GET['codigo'];
        BuscarDatosMarcas($codigo, false);
    }
    else if($funcion =="BuscarLineaColeccionPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarLineaColeccionPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
      else if($funcion == "GuardarNuevaMarcaTienda"){
        GuardarNuevaMarcaTienda();
    }
    else if($funcion =="BuscarProveedorCategoriaTallaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarProveedorCategoriaTallaPorMarca($idmarca,false);
    }
     else if($funcion =="BuscarCategoriaTallaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarCategoriaTallaPorMarca($idmarca,false);
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
   
    else if($funcion =="BuscarColeccionModeloPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarColeccionModeloPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="BuscarColeccionPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarColeccionPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion == "GuardarConfigurarMarca"){
        GuardarConfigurarMarca();
    }
    else if($funcion == "GuardarConfigurarMarcaColor"){
        GuardarConfigurarMarcaColor();
    }
    else if($funcion == "GuardarConfigurarMarcaMaterial"){
        GuardarConfigurarMarcaMaterial();
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
    else if($funcion == "BuscarClienteVendedorColorMarcaPorMarca"){
        $idmarca = $_GET['idmarca'];
        ClienteVendedorColorMarcaPorMarca($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="GuardarCodificarLinea"){
        $idmarca = $_GET['idmarca'];
        GuardarCodificarLinea($idmarca,false);

    }
    else if($funcion =="BuscarClienteVendedorColorMaterialModeloLineaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarClienteVendedorColorMaterialModeloPorMarca($idmarca, false);
    }
    else if($funcion =="BuscarClienteEstiloColorMaterialModeloLineaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarClienteEstiloColorMaterialModeloPorMarca($idmarca, false);
    }
     else if($funcion =="BuscarMarcaModelos"){
        $idmarca = $_GET['idmarca'];
        BuscarMarcaModelos($idmarca, false);
    }
      else if($funcion =="BuscarMarcaModelosKardex"){
        $idmarca = $_GET['idmarca'];
        BuscarMarcaModelosKardex($idmarca, false);
    }
    else if($funcion =="BuscarMarcaModelosKardex2"){
        $idmarca = $_GET['idmarca'];
        BuscarMarcaModelosKardex2($idmarca, false);
    }
      else if($funcion =="BuscarEstiloMaterialPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarEstiloMaterialPorMarca($idmarca, false);
    }
    else if($funcion =="BuscarEstiloColorPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarEstiloColorPorMarca($idmarca, false);
    }
      else if($funcion =="BuscarEstiloPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarEstiloPorMarca($idmarca, false);
    }

     else if($funcion =="BuscarModeloLineaPorMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarModeloLineaPorMarca($idmarca, false);
    }
    else if($funcion =="BuscarModeloPorMarcaColeccionVigente"){
        $idmarca = $_GET['idmarca'];
        BuscarModeloPorMarcaColeccionVigente($idmarca,false);
    }
    else if($funcion =="BuscarMarca"){
        BuscarMarca();
    }
    else if($funcion =="BuscarMarcaProcesar"){
        BuscarMarcaProcesar();
    }
     else if($funcion =="BuscarMarcaSola"){
        $idmarca = $_GET['idmarca'];

        BuscarMarcasola($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="BuscarMarcaPedido"){
//        $idmarca = $_GET['idmarca'];
        BuscarMarcaPedido();
    }
     else if($funcion =="buscardatosmarca"){
        $idestilo = $_GET['idmarca'];
        buscardatosmarca($idestilo,$_GET['callback'],$_GET['_dc'],false);
    }
    else if($funcion =="BuscarMarcaLineaColeccion"){
//        $idmarca = $_GET['idmarca'];
        BuscarMarcaLineaColeccionEstilo();
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