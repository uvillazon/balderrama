<?php 
session_name("balderrama");
session_start();
require_once("impl/Cliente.php");
require_once("impl/Ciudad.php");
require_once("impl/Almacen.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//echo "ubadlo";
//if(permitido("fun1000", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarCliente"){
$band = false;
    if($_GET['buscarcodigo'] != null)
    {
        if($band == false) {
            $extras .= " cl.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            $band = true;
        }
        else {
            $extras .= " AND cl.codigo LIKE '%".$_GET['buscarcodigo']."%'";
        }
    }
    if($_GET['buscarresponsable'] != null)
    {
        if($band == false) {
            $extras .= " cl.apellido LIKE '%".$_GET['buscarresponsable']."%'";
            $band = true;
        }
        else {
            $extras .= " AND cl.apellido LIKE '%".$_GET['buscarresponsable']."%'";
        }
    }
    if($_GET['buscarestado'] != null)
    {
        if($band == false) {
            $extras .= " cl.nombre LIKE '%".$_GET['buscarestado']."%'";
            $band = true;
        }
        else {
            $extras .= " AND cl.nombre LIKE '%".$_GET['buscarestado']."%'";

        }
    }
	
        ListarCliente($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
    else if($funcion == "BuscarCiudadTipo"){
  
        BuscarCiudadTipo($_GET['callback'], $_GET['_dc'], "",false);
    }
    else if($funcion =="BuscarCiudadTipoPorCliente"){
        $idcliente = $_GET['idcliente'];
        BuscarCiudadTipoPorCliente($idcliente,$_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion == "GuardarNuevoCliente"){
        InsertarNuevoCliente();
    }
    else if($funcion == "GuardarNuevoClienteIngreso"){
        InsertarNuevoClienteIngreso();
    }
    else if($funcion =="GuardarEditarCliente"){
        $idcliente=$_GET['idcliente'];
        GuardarEditarCliente($idcliente);
    }
     else if($funcion =="BuscarCliente"){
        BuscarCliente();
    }
     else if($funcion =="BuscarClienteActivo"){
        BuscarClienteActivo();
    }
    else if($funcion =="EliminarCliente"){
//        $idcliente = $_GET['idcliente'];
  //    EliminarCliente($idcliente, $_GET['callback'],$_GET['_dc'],false);
    }
     else if($funcion =="CambiarEstado"){
        $idcliente = $_GET['idcliente'];
        CambiarEstado($idcliente);
    }
    else{
        echo "else";
    }


?>