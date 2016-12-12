<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
require_once("impl/AdministraInventario.php");
require_once("impl/Cliente.php");
require_once("impl/KardexTienda.php");
require_once("impl/Linea.php");

require_once("impl/Estilo.php");
require_once("impl/Marca.php");
require_once("impl/Tienda.php");
require_once("impl/Pedidos.php");
require_once("impl/Colores.php");
require_once("impl/Modelo.php");
require_once("impl/Cobrosr.php");
require_once("impl/JSON.php");
include("impl/Utils.php");
//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];

    if($funcion == "ListarIngresosAlmacen")
    {
        }

else if($funcion =="GuardarNuevoCredito"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        GuardarNuevoCredito($datos,false);        
   }
else if($funcion =="GuardarNuevoCreditoTemporal"){
        GuardarNuevoCreditoTemporal(false);
   }
    else if($funcion =="GuardarNuevoPagoCliente"){
            $idcliente=$_GET['idcliente'];
            $idventa=$_GET['idventa'];
            $fecha=$_GET['fecha'];
            $idcreditocliente=$_GET['idcreditocliente'];
//idempleado=VENDEDOR-NUEVO&recibo=12313&tipoempresa=Efectivo&monto=400
            $idempleado=$_GET['idempleado'];
            $recibo=$_GET['recibo'];
            $tipopago=$_GET['tipoempresa'];
            $monto=$_GET['monto'];
            $factura=$_GET['factura'];
            $numerof=$_GET['numero'];
            $idcredito=$_GET['idcredito'];
            $rebaja=$_GET['rebaja'];
            GuardarNuevoPagoCliente($idcliente, $idcredito, $idventa, $fecha, $idcreditocliente, $idempleado, $recibo, $tipopago, $monto, $factura, $numerof, $rebaja);
    }
    else if($funcion =="AnularPagoCliente"){
            $idcliente=$_GET['idcliente'];
            $idcredito=$_GET['idcredito'];
            $idcreditocliente = $_GET['idcreditocliente'];
            $fecha = $_GET['fecha'];
            $recibo = $_GET['recibo'];
            $vendedor = $_GET['vendedor'];
            $montopago = $_GET['montopago'];
            $montorebaja = $_GET['montorebaja'];
            AnularPagoCliente($idcliente, $idcredito, $idcreditocliente, $fecha, $recibo, $vendedor, $montopago, $montorebaja);
    }
    else if($funcion =="verificarcierrecobros"){
            $fechav = $_GET['fechav'];
            verificarcierrecobros($fechav, false);
    }
    else if($funcion == "Registraridreporte"){
    $idcliente = $_GET['idcliente'];
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registraridreporte($datos,$idcliente, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

} else if($funcion == "Registraridreportegral"){
    $idcliente = $_GET['idcliente'];
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registraridreportegral($datos,$idcliente, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}
     else if($funcion =="GuardarNuevoRebaja"){
        $idcliente=$_GET['idcliente'];
         $idventa=$_GET['idventa'];
          $fecha=$_GET['fecha'];
          $idcreditocliente=$_GET['idcreditocliente'];
//idempleado=VENDEDOR-NUEVO&recibo=12313&tipoempresa=Efectivo&monto=400
//$idempleado=$_GET['idempleado'];
$recibo=$_GET['recibo'];
$tipopago=$_GET['tipoempresa'];
$monto=$_GET['monto'];

        GuardarNuevoRebaja($idcliente,$idventa,$fecha,$idcreditocliente,$recibo,$tipopago,$monto);
    }
    else
    if($funcion == "Listarcuentascliente"){
        $idcliente = $_GET['idcliente'];
        Listarcuentascliente($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idcliente, false);
   }else
   if($funcion == "Confirmarventas"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Confirmarventas($datos,false);
}else
   if($funcion == "Confirmarventasunidad"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Confirmarventasunidad($datos,false);
}else
 if($funcion == "Confirmardevolucionunidad"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Confirmardevolucionunidad($datos,false);
}else
if($funcion == "Confirmardevolucion"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Confirmardevolucion($datos,false);
}else
if($funcion == "eliminarcredito"){
//ojho funciona
      eliminarcredito($_GET['idcreditocli'],$_GET['callback'], $$_GET['dc'],'');

}else
if($funcion == "GuardarCambioSaldo"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);

    GuardarCambioSaldo($datos,false);
    }
      else if($funcion == "unionitems"){


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