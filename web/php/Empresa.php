<?php 
session_name("balderrama");
session_start();
include("impl/Empresa.php");
require_once("impl/Empleado.php");
require_once("impl/Almacen.php");
require_once("impl/VentaCredito.php");

include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarEmpresa"){
 $band = false;
    if($_GET['buscarcodigo'] != null)
    {
        if($band == false) {
            $extras .= " em.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            $band = true;
        }
        else {
            $extras .= " AND em.codigo LIKE '%".$_GET['buscarcodigo']."%'";
        }
    }
    if($_GET['buscarempresa'] != null)
    {
        if($band == false) {
            $extras .= " em.nombre LIKE '%".$_GET['buscarempresa']."%'";
            $band = true;
        }
        else {
            $extras .= " AND em.nombre LIKE '%".$_GET['buscarempresa']."%'";
        }
    }
    if($_GET['buscarresponsable'] != null)
    {
        if($band == false) {
            $extras .= " em.responsable LIKE '%".$_GET['buscarresponsable']."%'";
            $band = true;
        }
        else {
            $extras .= " AND em.responsable LIKE '%".$_GET['buscarresponsable']."%'";

        }
    }
	if($_GET['buscarestado'] != null)
    {
        if($band == false) {
            $extras .= " em.estado LIKE '%".$_GET['buscarestado']."%'";
            $band = true;
        }
        else {
            $extras .= " AND em.estado LIKE '%".$_GET['buscarestado']."%'";

        }
    }
      
        ListarEmpresa($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion == "GuardarNuevaEmpresa"){
   $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    //insertarventa($datos,false);
    txSaveEmpresa($datos,false);
     }
    else if($funcion == "BuscarEmpresaPorId"){
$idempresa = $_GET['idempresa'];
        BuscarEmpresaPorId($idempresa,$_GET['callback'], $_GET['_dc'],false);
}else if($funcion == "modificarempresa"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    modificarempresa($datos,false);
}else
     if($funcion == "EliminarEmpresa"){

      eliminarempresa($_GET['idempresa'],$_GET['callback'], $$_GET['dc'],'');

} else
    if($funcion == "buscarclientesempresa")
    {//$idcliente=$_GET['buscarcredito'];
        buscarclientesempresa($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['idempresa']);
    } else
    if($funcion == "buscarclientesempresaplanilla")
    {//$idcliente=$_GET['buscarcredito'];
        buscarclientesempresaplanilla($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['idempresa'],$_GET['planilla']);
    } else
    if($funcion == "buscarclientesempresasaldos")
    {//$idcliente=$_GET['buscarcredito'];
        buscarclientesempresasaldos($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['idempresa'],$_GET['idcliente']);
    } else
    if($funcion == "listarclientesempresa")
    {
    listarclientesempresa($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$_GET['idempresa'], false);


}else
    {
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