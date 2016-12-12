<?php 
session_name("balderrama");
session_start();
require_once("impl/VentaCredito.php");
require_once("impl/Planilla.php");
//require_once("impl/ClienteEmpresa.php");
//require_once("impl/Empresa.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//ubadlo
if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarCobrostienda")
    {
        $band = false;
        if($_GET['buscarcliente'] != null)
        {
            if($band == false) {
                $extras .= " mo.codigo LIKE '%".$_GET['buscarmodelo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND mo.codigo LIKE '%".$_GET['buscarmodelo']."%'";
            }
        }
        if($_GET['buscarempresa'] != null)
        {
            if($band == false) {
                $extras .= " co.codigo LIKE '%".$_GET['buscarcoleccion']."%'";
                $band = true;
            }
            else {
                $extras .= " AND co.codigo LIKE '%".$_GET['buscarcoleccion']."%'";
            }
        }
        if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " li.codigo LIKE '%".$_GET['buscarlinea']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND li.codigo LIKE '%".$_GET['buscarlinea']."%'";
            }
        }
        if($_GET['buscartienda'] != null)
        {
            if($band == false) {
                $extras .= " ma.nombre LIKE '%".$_GET['buscarmarca']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }
     
        ListarCobrostienda($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
        else if($funcion == "modificarplanilla"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = modificarplanilla($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}
    else
    if($funcion == "UnirPlanilla"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = UnirPlanilla($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}
    else
     if($funcion == "RecorrerPlanilla"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = RecorrerPlanilla($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}else
    if($funcion == "Registraremisionplanilla"){


    $idempresa = $_GET['idempresa'];
    $planilla = $_GET['planilla'];
    Registraremisionplanilla($idempresa,$planilla,false);
}else
  if($funcion == "Registrarreversionplanilla"){


    $idempresa = $_GET['idempresa'];
    $planilla = $_GET['planilla'];
    Registrarreversionplanilla($idempresa,$planilla,false);
}else
if($funcion == "buscarplanillaempresa"){

    buscarplanillaempresa($_GET['empresa'],$_GET['callback'], $$_GET['dc'],'');
}else
if($funcion == "buscarplanillaempresaanterior"){

    buscarplanillaempresaanterior($_GET['empresa'],$_GET['callback'], $$_GET['dc'],'');
}else
    {
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