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
require_once("impl/IngresoAlmacen.php");
require_once("impl/JSON.php");
include("impl/Utils.php");
//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];

    if($funcion == "ListarIngresosAlmacen")
    {
        $band = false;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {
                $extras .= " ing.codigo LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ing.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
        if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " ing.fecha LIKE '%".$_GET['buscarfecha']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ing.fecha LIKE '%".$_GET['buscarfecha']."%'";
            }
        }
        if($_GET['buscartienda'] != null)
        {
            if($band == false) {
                $extras .= " tie.codigo LIKE '%".$_GET['buscartienda']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND tie.codigo LIKE '%".$_GET['buscartienda']."%'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mad.nombre LIKE '%".$_GET['buscarmarca']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND mad.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }
       
        ListarIngresosAlmacen($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else
      if($funcion == "ListarIngresosAlmacenExtra")
    {
        $band = false;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {
                $extras .= " ing.boleta LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ing.boleta LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
        if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " ing.fecha LIKE '%".$_GET['buscarfecha']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ing.fecha LIKE '%".$_GET['buscarfecha']."%'";
            }
        }
        if($_GET['buscartienda'] != null)
        {
            if($band == false) {
                $extras .= " alm.nombre LIKE '%".$_GET['buscartienda']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND alm.nombre LIKE '%".$_GET['buscartienda']."%'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mad.nombre LIKE '%".$_GET['buscarmarca']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND mad.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }

        ListarIngresosAlmacenExtra($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion == "BuscarTiendaMarca"){
        BuscarTiendaMarca($_GET['callback'], $_GET['_dc'], "",false);
    }
    else if($funcion =="BuscarModeloDetallePorMarca"){
        $idmarca = $_GET['idmarca'];
        $idtienda = $_GET['idtienda'];
        BuscarModeloDetallePorMarca($idmarca,$idtienda,$_GET['callback'], $_GET['_dc'], "",false);

    }else
      if ($funcion == "CargarConfirmarIngreso"){
        $idmarca = $_GET['idmarca'];
          $idestilo = $_GET['idestilo'];
        CargarConfirmarIngreso($_GET['callback'], $_GET['_dc'], $idmarca,$idestilo, false);

    }else
    if ($funcion == "CargarInventarioActual"){
        $idmarca = $_GET['idmarca'];
          $idestilo = $_GET['idalmacen'];
          $idkardex = $_GET['idkardex'];
            $modelo = $_GET['modelo'];
             $cliente = $_GET['cliente'];
              $vendedor = $_GET['vendedor'];
        CargarInventarioActual($_GET['callback'], $_GET['_dc'], $idmarca,$idestilo, $idkardex,$modelo,$cliente,$vendedor,false);

    }else
    if ($funcion == "Cargardatoscliente"){
        $idcliente = $_GET['idmarca'];
        Cargardatoscliente($_GET['callback'], $_GET['_dc'], $idcliente,false);

    }else
     if($funcion == "ListarDetallePedidoColorinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
    $idkardex = $_GET['idkardex'];
        ListarDetallePedidoColorinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo,$idkardex, false);
    }else
    if($funcion == "ListarDetallePedidoMaterialColorinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idalmacen'];
   $idkardex = $_GET['idkardex'];
   $gestion = $_GET['gestion'];
      $idcliente = $_GET['idcliente'];
       $idvendedor = $_GET['idvendedor'];
       $item = $_GET['item'];
  ListarDetallePedidoMaterialColorinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo,$idkardex,$gestion,$idcliente,$idvendedor,$item, false);

}
 else if($funcion == "buscarplanillaempresa"){

    buscarplanillaempresa($_GET['empresa'],$_GET['callback'], $$_GET['dc'],'');
}
 else if($funcion =="HabilitarPar"){
        $codigobarra=$_GET['codigo'];
         $idvendedor=$_GET['idvendedor'];
         HabilitarPar($codigobarra,$idvendedor);
    }
 else if($funcion =="HabilitarParCaja"){
        $codigobarra=$_GET['codigo'];
         $idvendedor=$_GET['idvendedor'];
         HabilitarParCaja($codigobarra,$idvendedor);
    }

 else

    if($funcion == "ListarDetallePedido"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];

        ListarDetallePedido($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);
    }else
 if($funcion == "ListarDetallePedidoinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
  $idkardex = $_GET['idkardex'];
        ListarDetallePedidoinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo,$idkardex, false);
    }
     else if($funcion =="BuscarModeloPorIdUnion"){

        buscarModeloporIdUnion($_GET['idmodelo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
    }else
    if($funcion == "ListarItemsPedido"){
        $idmarca = $_GET['idmarca'];
       $recibo = $_GET['recibo'];
   $idestilo = $_GET['idestilo'];

        ListarItemsPedido($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$recibo,$idestilo, false);
    }
    else
      if($funcion == "ListarDetallePedidoMaterialinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
//ojo
//ListarDetallePedidoMaterialinventario
        ListarDetallePedidoMaterialinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);
//        ListarDetallePedidoMaterial($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);

    }else

      if($funcion == "ListarDetallePedidoMaterialinventarioinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
   $idkardex = $_GET['idkardex'];
//ojo
//ListarDetallePedidoMaterialinventario
        ListarDetallePedidoMaterialinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo,$idkardex, false);
//        ListarDetallePedidoMaterial($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);

    }else

      if($funcion == "ListarDetallePedidoColor"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];

        ListarDetallePedidoMaterial($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);
    }else

    if($funcion == "ListarDetallePedidoMaterialColor"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];

        ListarDetallePedidoMaterialColor($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);
    }else
    if($funcion == "ListarDetallePedidoLineaModeloColor"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
//modificasteaqui
        ListarDetallePedidoLineaModeloColor($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo, false);
    }else
    if($funcion == "ListarDetallePedidoLineaModeloColorinventario"){
        $idmarca = $_GET['idmarca'];
   $idestilo = $_GET['idestilo'];
    $idkardex = $_GET['idkardex'];
//modificasteaqui
        ListarDetallePedidoLineaModeloColorinventario($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idestilo,$idkardex, false);
    }
    else if($funcion =="BuscarModeloDetallePorId"){

        BuscarModeloDetalleporId($_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
    }
    else  if($funcion == "Buscarmodelos"){
       // echo "looll";
        Buscarmodelos($_GET['callback'], $_GET['_dc'],$_GET['idempresa'],false);
    }else
    if($funcion == "AnularIngreso"){


    //$idempresa = $_GET['idempresa'];
    $idingreso = $_GET['idingreso'];
    AnularIngreso($idingreso,false);
}else if($funcion =="buscarlistamodelos"){

      //  buscarlistamodelo($_GET['idmarca'],$_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
        buscarlistamodelos($_GET['idmarca'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);


 }
  else if($funcion =="BuscarMarcaEmpleado"){
//        $idmarca = $_GET['idmarca'];
        BuscarMarcaEmpleado();
    }
    else if($funcion =="BuscarMFMarcaVendedorCliente"){
        BuscarMFMarcaVendedorCliente();
    }
    else if($funcion =="BuscarMarcaEstiloinventario"){
        BuscarMarcaEstiloinventario();
    }
    else if($funcion =="BuscarMarcaAlmaceninventario"){
        BuscarMarcaEstiloinventario();
    }
    else if($funcion =="BuscarInventarioVendedor"){
        BuscarInventarioVendedor();
    }
    else if($funcion =="BuscarMarcaEstiloinventariocierre"){
        BuscarMarcaEstiloinventariocierre();
    }
    else if($funcion =="BuscarMarcaEstilodatos"){
//        $idmarca = $_GET['idmarca'];
        BuscarMarcaEstilodatos();
    }
  else if($funcion =="BuscarEstilo"){
        $idmarca = $_GET['idmarca'];
        BuscarEstilo($idmarca);
    }
 else if($funcion =="buscarlistamodelo"){

      //  buscarlistamodelo($_GET['idmarca'],$_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
        buscarlistamodelo($_GET['idmarca'],$_GET['idmodelo'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
 }
else
  if($funcion == "buscarlistanuevomodelo"){
        $iddetalleingreso = $_GET['iddetalleingreso'];
        buscarlistanuevomodelo($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$iddetalleingreso, false);
    }

 else if($funcion =="buscarlistaestilo"){

      //  buscarlistamodelo($_GET['idmarca'],$_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
        buscarlistaestilo($_GET['idmarca'],$_GET['idestilo'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);


 } else if($funcion =="EliminarMarca"){
        $idmarca =$_GET['iddetalleingreso'];
        //echo $idmarca;
        Eliminardetalle($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }else

    if($funcion =="EliminarModelo"){
        $idmarca =$_GET['idmodelo'];
        //echo $idmarca;
        EliminarModelo($idmarca, $_GET['callback'],$_GET['_dc'],false);
    }else
    if($funcion == "buscarmodeloinsertar"){

        buscarmodeloinsertar($_GET['modelo'],$_GET['callback'], $_GET['dc'],'');
    }
    else
    if($funcion == "buscarmodeloinsertarprecio"){

        buscarmodeloinsertarprecio($_GET['modelo'],$_GET['callback'], $_GET['dc'],'');
    }
    else
    if($funcion =="GuardarNuevoIngreso"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        GuardarNuevoIngreso($datos,false);
    }else if($funcion =="txNewUpdateDatosDetalleIngreso"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        txNewUpdateDatosDetalleIngreso($datos,false);
    }else if($funcion =="txNewUpdateDatosDetalleIngresoInventario"){
//editar modelo
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txNewUpdateDatosDetalleIngresoInventario($datos,false);
    }else if($funcion =="txNewUpdateDatosDetalleIngresoInventarioFeria"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txNewUpdateDatosDetalleIngresoInventarioFeria($datos,false);
    }



    else if($funcion =="txNewEliminarModelo"){
//eliminar modelo
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
         txNewEliminarModelo($datos,false);
    }
     else if($funcion =="txNewIngresoCodigoBarra"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        txNewIngresoCodigoBarra($datos,false);
    }
    else if($funcion =="txNewIngresoCodigoBarraNuevo"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        txNewIngresoCodigoBarraNuevo($datos,false);
    }
    else if($funcion =="ProcesarDatosLectorKardex"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
       // echo $datos;
        ProcesarDatosLectorKardex($datos,false);
    }
    
    else if($funcion =="BuscarModeloPorIdtiendaRegistrar"){
       $opcionmarca = $_GET['opcionmarca'];
        if ($opcionmarca=='8'){
        BuscarModeloPorIdtiendaRegistrar($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
         if ($opcionmarca=='10'){
        BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
         if ($opcionmarca=='2'){
         BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
        }
        if ($opcionmarca=='9'){
         BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
        }
        if ($opcionmarca=='15'){
         BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
        }
        if ($opcionmarca=='14'){
         BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
        }
          if ($opcionmarca=='4'){
        BuscarModeloPorIdtiendaRegistrar($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
     if ($opcionmarca=='3'){
        BuscarModeloPorIdtiendaRegistrarLinea($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
         if ($opcionmarca=='31'){
        BuscarModeloPorIdtiendaRegistrar($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
           if ($opcionmarca=='7'){
        BuscarModeloPorIdtiendaRegistrarwest($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
           if ($opcionmarca=='6'){
               //ramarin
        BuscarModeloPorIdtiendaRegistrarModelo($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
    }else if($funcion == "Listaragrupadorecapitula"){
        $idmarca = $_GET['idmarca'];
   $idkardex = $_GET['idkardex'];
   $idtienda = $_GET['idtienda'];
  Listaragrupadorecapitula($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$idkardex,$idtienda, false);

 }
else if($funcion =="GuardarNuevoIngresoExtra"){
//registro
$idalmacen = $_SESSION['idalmacen'];
if($idalmacen==null  || $idalmacen == ""){
 $dev['mensaje'] = "Error en la sesion: porfavor en otra ventana abra nuevamente su sesion";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }else{
      //para verificar
     $sql3 = "SELECT estado FROM concurrencia";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
         $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        GuardarNuevoIngresoExtra($datos,false);
       }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }


    }

        
    }
    else if($funcion =="GuardarNuevoIngresoUnido"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        GuardarNuevoIngresoUnido($datos,false);
    }
    else if($funcion =="unirparesdemodelos"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        unirparesdemodelos($datos,false);
    }
    else
 if($funcion == "ActualizarMovimientoItems"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    ActualizarMovimientoItems($datos,false);
}
    else
 if($funcion == "ActualizarMovimientoItemsEntrada"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    ActualizarMovimientoItemsEntrada($datos,false);
}else
 if($funcion == "Actualizartrasprecib"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Actualizartrasprecib($datos,false);
}
else
if($funcion == "ActualizarKardexHistorial"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    ActualizarKardexHistorial($datos,false);
}else
if($funcion == "ActualizarKardexActual"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    ActualizarKardexActual($datos,false);
}
 else
if($funcion == "GuardarNuevoPrecio"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    //insertarventa($datos,false);
    GuardarNuevoPrecio($datos,false);
}
else
if($funcion == "Cambiogestioninventario"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Cambiogestioninventario($datos,false);
}
    else if($funcion == "Registrarcodigo"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registrarcodigo($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}
   else if($funcion == "Registrarcodigoporpar"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registrarcodigoporparbarra($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}
 else if($funcion == "Registrarcodigounion"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = Registrarcodigounion($datos, false);
    $dev['mensaje'] = $da['mensaje'];
    $dev['error'] = $da['error'];
    $dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');

}else
 if($funcion == "Registrarunionmodelos"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    Registrarunionmodelos($datos,false);
}
  else if($funcion == "ListarDetalleIngreso"){
        $idmarca = $_GET['idmarca'];
   $codigo = $_GET['codigo'];
     $opcionb = $_GET['opcionb'];
   $formato = $_GET['formatomayor'];
$band = false;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {

                $extras .= " mdd.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            //     $extras .= " mdd.codigo = '".$_GET['buscarcodigo']."'";
                $band = true;
            }
            else {
                $extras .= " AND mdd.codigo LIKE '%".$_GET['buscarcodigo']."%'";
             //   $extras .= " AND mdd.codigo = '".$_GET['buscarcodigo']."'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " i.boleta LIKE '%".$_GET['buscarmarca']."%'";
               // $extras .= " i.boleta = '".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND i.boleta LIKE '%".$_GET['buscarmarca']."%'";
               //  $extras .= " AND i.boleta = '".$_GET['buscarmarca']."'";
            }
        }

        ListarDetalleIngreso($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$codigo,$extras,$opcionb,$formato, false);
    }
    else if($funcion == "ListarDetalleIngresoTalla"){
        $idmarca = $_GET['idmarca'];
$band = false;
    
         if($_GET['buscarmodelo'] != null)
        {
            if($band == false) {
                $extras .= " modelo = '".$_GET['buscarmodelo']."'";
                $band = true;
            }
            else {
                $extras .= " AND modelo = '".$_GET['buscarmodelo']."'";
            }
        }

        ListarDetalleIngresoTalla($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$extras,$_GET['buscarmodelo'], false);
    }
     else if($funcion == "listarmodeloscoleccion"){
        $idmarca = $_GET['idmarca'];
   $codigo = $_GET['modelo'];
$band = false;
        if($_GET['buscarcoleccion'] != null)
        {
            if($band == false) {
                $extras .= " col.idcoleccion LIKE '".$_GET['buscarcoleccion']."'";
                $band = true;
            }
            else {
                $extras .= " AND col.idcoleccion LIKE '".$_GET['buscarcoleccion']."'";
            }
        }
        if($_GET['buscarestilo'] != null)
        {
            if($band == false) {
                $extras .= " l.idestilo LIKE '".$_GET['buscarestilo']."'";
                $band = true;
            }
            else {
                $extras .= " AND l.idestilo LIKE '".$_GET['buscarestilo']."'";
            }
        }
    buscarlistamodelomarca($_GET['idmarca'],$_GET['modelo'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);

  //      listarmodeloscoleccion($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$codigo,$extras, false);
    }
      else if($funcion == "unionitems"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    $da = unionitems($datos, false);
   // $dev['mensaje'] = $da['mensaje'];
    //$dev['error'] = $da['error'];
    //$dev['resultado'] = $da['resultado'];
    //eliminarproductos($productos,$_GET['callback'], $$_GET['dc'],'');


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