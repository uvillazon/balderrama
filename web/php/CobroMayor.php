<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/CobroMayor.php");
//require_once("impl/Marca.php");
require_once("impl/Cliente.php");
require_once("impl/Empleado.php");

include("impl/Utils.php");
require_once("impl/JSON.php");
//if(permitido("fun1001", $_SESSION['idusuario'])==true)
//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarVentaMayor")
    {
        $band = false;
        if($_GET['buscarfecha'] != null)
           {
            $fechafin=$_GET['buscarfecha'];
            $formatear = explode( '-' , $fechafin);
            $fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
            if($band == false) {
                $extras .= " ved.fecha LIKE '%".$fecha."%'";
                $band = true;
                }
            else {
                $extras .= " AND ved.fecha  LIKE '%".$fecha."%'";
                 }
           }
           if($_GET['buscarcliente'] != null)
           {
            if($band == false) {
                $extras .= " ved.nombrecliente LIKE '%".$_GET['buscarcliente']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ved.nombrecliente LIKE '%".$_GET['buscarcliente']."%'";
            }
           }
      ListarVentaMayor($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
else  if($funcion =="BuscarClienteMarcaReciboTipoCambio"){
//        $idmarca = $_GET['idmarca'];
        BuscarClienteMarcaReciboTipoCambio();
    }
else if($funcion == "RegistrarCobroMayor"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    RegistrarCobroMayor($datos,false);
}
else
     if($funcion =="BuscarCuentasCliente"){
        $idempresa = $_GET['idcliente'];
        $idcuenta = $_GET['idcuenta'];
        BuscarCuentasCliente($_GET['callback'], $_GET['_dc'],$idempresa,$idcuenta, false);
    }
    else
     if($funcion =="CargarPagoCliente"){
        $idcrecliente = $_GET['idcreditocliente'];
        $fecha = $_GET['fecha'];
        $recibo = $_GET['recibo'];
        CargarPagoCliente($_GET['callback'], $_GET['_dc'], $idcrecliente, $fecha, $recibo, false);
    }
    else
  if($funcion == "Listardeudasclientepormarca"){
        $idcliente = $_GET['idcliente'];
  Listardeudasclientepormarca($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idcliente, false);

 }
 else
 if($funcion == "Listardeudasclientepormarcatotal"){
        $idcliente = $_GET['idcliente'];
        $idcuenta = $_GET['idcuenta'];
        Listardeudasclientepormarcatotal($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idcliente,$idcuenta, false);

 }
else if($funcion == "BuscarSaldoClienteporRecibo"){

    BuscarSaldoClienteporRecibo($_GET['recibo'],$_GET['idcliente'],$_GET['callback'], $$_GET['dc'],'');
}
else  if($funcion == "listarDeudasCliente")
    {
        $band = false;
        if($_GET['buscarfecha'] != null)
        {
            $fechafin=$_GET['buscarfecha'];
            $formatear = explode( '-' , $fechafin);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];

if($band == false) {
                $extras .= " ved.fecha LIKE '%".$fecha."%'";
              //  echo $extras;
                $band = true;
            }
            else {
                $extras .= " AND ved.fecha  LIKE '%".$fecha."%'";
            }
        }
        if($_GET['buscarcliente'] != null)
        {
            if($band == false) {
                $extras .= " ved.nombrecliente LIKE '%".$_GET['buscarcliente']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ved.nombrecliente LIKE '%".$_GET['buscarcliente']."%'";
            }
        }
        listarDeudasCliente($_GET['idcliente'],$_GET['idmarca'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }


else
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