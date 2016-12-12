<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");

require_once("impl/Modelo.php");
require_once("impl/VentaFeria.php");
require_once("impl/VentaMayor.php");
require_once("impl/JSON.php");
include("impl/Utils.php");
//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];

    if($funcion == "ListarIngresosAlmacen")
    {
        }
        else if($funcion == "BuscarClientesespecial"){
        BuscarClientesespecial($_GET['callback'], $_GET['_dc'], false);
    }else
if($funcion == "listarproductosalmacen"){
        $modelo = $_GET['modelo'];
   $vendedor = $_GET['vendedor'];
     $codigo = $_GET['buscarcodigo'];
      $marca = $_GET['buscarnombre'];
      $talla = $_GET['buscarcategoria'];
      $porbuscador = $_GET['porbuscador'];
//             listarproductosalmacen2($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$codigo,$marca,$talla, false);

     if($porbuscador=="true"){
    
       listarproductosalmacen2($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$codigo,$marca,$talla, false);

      }else{


 }
//          if($modelo==null || $modelo==''){
//           echo "nooo";
//      }else{
//  listarproductosalmacen2($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$codigo,$marca,$talla, false);
//echo "sii";
//      }

    // echo "es falso";
    //  }
    }else

    if($funcion == "buscarcodigobarra"){
        // $idtienda = $_SESSION['idtienda'];
        buscarcodigobarra($_GET['codigo'],$_GET['vendedor'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "guardarventasferia"){
        $sql3 = "SELECT estado FROM concurrenciaventa";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        $proforma = $datos->venta;
        //$codigocliente = $proforma->cliente;
        $idalmacen =$_SESSION['idalmacen'];
       
            if($estadoactual =='libre' || $estadoactual=="libre"){
                guardarventasferia($datos,false);
            }else{
                $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando venta en este momento";
                $json = new Services_JSON();
                $output = $json->encode($dev);
                print($output);
                exit;
            }
       
    }else
if ($funcion == "BuscarDatosFacturaFeria"){
        $idventadetalle = $_GET['idventadetalle'];
        BuscarDatosFacturaFeria($_GET['callback'], $_GET['_dc'], $idventadetalle, false);

    }else

   if($funcion =="GuardarNuevoCredito"){

     $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        GuardarNuevoCredito($datos,false);
        
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

} else if($funcion == "Registraridreporte"){
    $idcliente = $_GET['idcliente'];
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registraridreporte($datos,$idcliente, false);
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
if($funcion == "Confirmardevolucion"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Confirmardevolucion($datos,false);
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