<?php 
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/VentaMayor.php");
require_once("impl/Marca.php");
require_once("impl/Cliente.php");
require_once("impl/Empleado.php");
//
include("impl/Utils.php");
require_once("impl/JSON.php");


if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarCambios")
    {
        $band = false;

        if($_GET['buscarboleta'] != null)
        {
            if($band == false) {
                $extras .= " v.boleta ='".$_GET['buscarboleta']."'";
                $band = true;
            }
            else {
                $extras .= " AND v.boleta ='".$_GET['buscarboleta']."'";
            }
        }
        if($_GET['buscarvendedore'] != null)
        {
            if($band == false) {
                $extras .= " em.codigo ='".$_GET['buscarvendedore']."'";
                $band = true;
            }
            else {
                $extras .= " AND em.codigo ='".$_GET['buscarvendedore']."'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mar.nombre ='".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND mar.nombre ='".$_GET['buscarmarca']."'";
            }
        }
        $fechafin = $_GET['buscafecha'];
        $fechaini = $_GET['buscafechaini'];
        ListarCambios($fechaini,$fechafin, $_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
    else if($funcion =="BuscarRedondeosus"){
        $montobs = $_GET['montobs'];
        $tipocambio = $_GET['tipocambio'];
        BuscarRedondeosus($montobs,$tipocambio, false);
    }else
    if($funcion == "ListarVentaMayor")
    {
        $band = false;

        if($_GET['buscarboleta'] != null)
        {
            if($band == false) {
                $extras .= " v.boleta ='".$_GET['buscarboleta']."'";
                $band = true;
            }
            else {
                $extras .= " AND v.boleta ='".$_GET['buscarboleta']."'";
            }
        }
        if($_GET['buscarvendedore'] != null)
        {
            if($band == false) {
                $extras .= " em.codigo ='".$_GET['buscarvendedore']."'";
                $band = true;
            }
            else {
                $extras .= " AND em.codigo ='".$_GET['buscarvendedore']."'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mar.nombre ='".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND mar.nombre ='".$_GET['buscarmarca']."'";
            }
        }
        $fechafin = $_GET['buscafecha'];
        $fechaini = $_GET['buscafechaini'];
        $filtrotodo = $_GET['filtro'];
        if($filtrotodo=="PENDIENTES"){
            ListarVentaMayorfiltrado($filtrotodo,$fechaini,$fechafin, $_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);

        }else{
            ListarVentaMayor($filtrotodo,$fechaini,$fechafin, $_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);

        }

    }
    else
    if($funcion == "ListarVentaanulada")
    {
        $band = false;

        if($_GET['buscarboleta'] != null)
        {
            if($band == false) {
                $extras .= " v.boleta ='".$_GET['buscarboleta']."'";
                $band = true;
            }
            else {
                $extras .= " AND v.boleta ='".$_GET['buscarboleta']."'";
            }
        }
        if($_GET['buscarvendedore'] != null)
        {
            if($band == false) {
                $extras .= " em.codigo ='".$_GET['buscarvendedore']."'";
                $band = true;
            }
            else {
                $extras .= " AND em.codigo ='".$_GET['buscarvendedore']."'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mar.nombre ='".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND mar.nombre ='".$_GET['buscarmarca']."'";
            }
        }
        $fechafin = $_GET['buscafecha'];
        $fechaini = $_GET['buscafechaini'];
        $filtrotodo = $_GET['filtro'];
        ListarVentaanulada($fechaini,$fechafin,$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
        //  ListarVentaanulada($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else
    if($funcion == "ListarVentaDevolucion")
    {
        $band = false;

        if($_GET['buscarboleta'] != null)
        {
            if($band == false) {
                $extras .= " v.boleta ='".$_GET['buscarboleta']."'";
                $band = true;
            }
            else {
                $extras .= " AND v.boleta ='".$_GET['buscarboleta']."'";
            }
        }
        if($_GET['buscarvendedore'] != null)
        {
            if($band == false) {
                $extras .= " em.codigo ='".$_GET['buscarvendedore']."'";
                $band = true;
            }
            else {
                $extras .= " AND em.codigo ='".$_GET['buscarvendedore']."'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mar.nombre ='".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND mar.nombre ='".$_GET['buscarmarca']."'";
            }
        }
        $fechafin = $_GET['buscafecha'];
        $fechaini = $_GET['buscafechaini'];
        $filtrotodo = $_GET['filtro'];
        ListarVentaDevolucion($fechaini,$fechafin,$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    //ListarVentaDevolucion
    else
    if($funcion == "listarmodelosventa"){
        $idmarca = $_GET['idventa'];

        buscarlistamodelomarcaventa($_GET['idventa'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);

        //      listarmodeloscoleccion($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca,$codigo,$extras, false);
    }
    else if($funcion =="ConfirmarBoleta"){

        ConfirmarBoleta();
    }else
    if($funcion =="ConfirmarDevolucion"){

        ConfirmarDevolucion();
    }else
    if($funcion == "buscardatosmarcaventa"){

        buscardatosmarcaventa($_GET['marca'],$_GET['callback'], $$_GET['dc'],'');
    } else if($funcion =="Buscardatosparatraspaso"){
        $idmarca = $_GET['idmarca'];
        Buscardatosparatraspaso($idmarca, false);
    }
    else if($funcion =="BuscarEmpleadotraspaso"){
        $idmarca = $_GET['idmarca'];
        $iddestino = $_GET['iddestino'];
        BuscarEmpleadotraspaso($idmarca, $iddestino,false);
    }else
    if($funcion == "Registrarventatraspaso"){



        $sql3 = "SELECT estado FROM concurrenciaventa";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
            $resultado = $_GET['resultado'];
            $json = new Services_JSON();
            $datos = $json->decode($resultado);
            Registrarventatraspaso($datos,false);

        }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando venta en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
    }
    else if($funcion =="BuscarEmpleadomialmacenAlmacen"){
        $idmarca = $_GET['idmarca'];
        BuscarEmpleadomialmacenAlmacen($idmarca, false);
    }
     else if($funcion =="Buscarclientesmodelo"){
        $idmarca = $_GET['idmodelo'];
        Buscarclientesmodelo($idmarca, false);
    }else if($funcion =="GuardarEdicionModelo"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
         GuardarEdicionModelo($datos,false);

    }else if($funcion =="GuardarEdicionModeloitem"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
         GuardarEdicionModeloitem($datos,false);

    }
    else if($funcion =="BuscarEmpleadoCliente"){
        $idmarca = $_GET['idmarca'];
        BuscarEmpleadoCliente($idmarca, false);
    }
    else if($funcion =="BuscarEmpleadomialmacen"){
        $idmarca = $_GET['idmarca'];
        BuscarEmpleadomialmacen($idmarca, false);
    }
    else if($funcion =="Buscardatosparaventa"){
        $idmarca = $_GET['idmarca'];
        Buscardatosparaventa($idmarca, false);
    }else
    if($funcion =="BuscardatosmarcaProcesar"){
        $idmarca = $_GET['idmarca'];
        BuscardatosmarcaProcesar($idmarca, false);
    }else
    if($funcion =="Buscardatosparadev"){
        $idmarca = $_GET['idmarca'];
        Buscardatosparadev($idmarca, false);
    }else
    if($funcion =="Buscardatosparadevcobro"){
        $idmarca = $_GET['idmarca'];
        Buscardatosparadevcobro($idmarca, false);
    }else
    if($funcion == "BuscarRedondeo"){

        BuscarRedondeo($_GET['idmarca'],$_GET['callback'], $$_GET['dc'],'');
    }
    else
    if($funcion == "actualizarleidos"){
        // $idtienda = $_SESSION['idtienda'];
        actualizarleidos($_GET['callback'], $$_GET['dc'],'');
    }
    else
    if($funcion == "buscarcodigonormal"){
        $idtienda = $_SESSION['idtienda'];
        buscarcodigonormal($_GET['codigo'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "buscarcodigo"){
        // $idtienda = $_SESSION['idtienda'];
        buscarcodigo($_GET['codigo'],$_GET['idmarca'],$_GET['vendedor'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "buscarcodigocaja"){
        // $idtienda = $_SESSION['idtienda'];
        buscarcodigocaja($_GET['codigo'],$_GET['idmarca'],$_GET['vendedor'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "buscarcodigotraspaso"){
        // $idtienda = $_SESSION['idtienda'];
        buscarcodigotraspaso($_GET['codigo'],$_GET['idmarca'],$_GET['vendedor'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "buscarcodigoventa"){
        $idtienda = $_SESSION['idtienda'];
        buscarcodigoventa($_GET['codigo'],$_GET['idmarca'],$_GET['idvendedor'],$_GET['idcliente'],$_GET['boletaventa'],$_GET['callback'], $$_GET['dc'],'');
    }else
    if($funcion == "buscarcodigocajatraspaso"){
        buscarcodigocajaparatraspaso($_GET['codigo'],$_GET['idmarca'],$_GET['vendedor'],$_GET['callback'], $$_GET['dc'],'');

    }
    else if($funcion == "listaboletasventa"){
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
        //    listaProducto = new ListaProductoSimpleDev("php/VentaMayor.php?funcion=listaboletasventa&idvendedor="+vendedor+ "&idcliente="+cliente+ "&idmarca="+marca+ "&boleta="+boleta);

        listaboletasventa($_GET['idvendedor'],$_GET['idcliente'],$_GET['idmarca'],$_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else
 if($funcion == "txSaveestadotraspaso"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSaveestadotraspaso($datos,false);

    }else
    if($funcion == "txSaveestado"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSaveestado($datos,false);

    }else
    if($funcion == "txSaveestado1"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSaveestado1($datos,false);

    }else
    if($funcion == "txSaveVenta"){
        $sql3 = "SELECT estado FROM concurrenciaventa";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        $proforma = $datos->venta;
        $codigocliente = $proforma->cliente;
        $idalmacen =$_SESSION['idalmacen'];
        $formatearcli = explode( '/' , $codigocliente);
        $codigocliente1 = $formatearcli[0];
        $codigocliente2 = $formatearcli[1];
        $formatear1 = explode( '-' , $codigocliente1);
        $apellidocli = $formatear1[0];
        $nombrecli = $formatear1[1];
        $sql1= "SELECT MIN(numero) AS primero FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' ";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "primero");
        $primero = $result['resultado'];

        $sql12= "SELECT idcliente FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' and numero='$primero' ";
        $result = findBySqlReturnCampoUnique($sql12, true, true, "idcliente");
        $idcliente = $result['resultado'];

        if($idcliente =='' || $idcliente==null){
            $dev['mensaje'] = " Por favor verifique el cliente, no escriba  nombre  de cliente usando guion o barra (- o /) genera error ";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{
            if($estadoactual =='libre' || $estadoactual=="libre"){
                txSaveVenta($datos,false);
            }else{
                $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando venta en este momento";
                $json = new Services_JSON();
                $output = $json->encode($dev);
                print($output);
                exit;
            }
        }
    }else

    if($funcion == "txSaveVentaCajas"){
        $sql3 = "SELECT estado FROM concurrenciaventa";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        $proforma = $datos->venta;
        $codigocliente = $proforma->cliente;
        $idalmacen =$_SESSION['idalmacen'];
        $formatearcli = explode( '/' , $codigocliente);
        $codigocliente1 = $formatearcli[0];
        $codigocliente2 = $formatearcli[1];
        $formatear1 = explode( '-' , $codigocliente1);
        $apellidocli = $formatear1[0];
        $nombrecli = $formatear1[1];
        $sql1= "SELECT MIN(numero) AS primero FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' ";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "primero");
        $primero = $result['resultado'];

        $sql12= "SELECT idcliente FROM clientes where apellido='$apellidocli' and nombre='$nombrecli' and idalmacen='$idalmacen' and numero='$primero' ";
        $result = findBySqlReturnCampoUnique($sql12, true, true, "idcliente");
        $idcliente = $result['resultado'];

        if($idcliente =='' || $idcliente==null){
            $dev['mensaje'] = " Por favor verifique el cliente, no escriba  nombre  de cliente usando guion o barra (- o /) genera error ";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{
            if($estadoactual =='libre' || $estadoactual=="libre"){
                txSaveVentaCaja($datos,false);
            }else{
                $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando venta en este momento";
                $json = new Services_JSON();
                $output = $json->encode($dev);
                print($output);
                exit;
            }
        }
    }else

    if($funcion == "txSaveVentaConfirmada"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSaveVentaConfirmada($datos,false);

    }else
    if($funcion == "validarUsuario"){
        $idusuario=$_GET['idusuario'];
        $password=$_GET['password'];
        UsuarioValidar($idusuario,$password,false);
    }else
    if($funcion == "validarUsuarioInventario"){
        $idusuario=$_GET['idusuario'];
        $password=$_GET['password'];
        $idalmacen=$_GET['idalmacen'];
        UsuarioValidarInventario($idusuario,$password,$idalmacen,false);
    }else
    if($funcion =="GuardarNuevoVentaCompleta"){


        $sql3 = "SELECT estado FROM concurrenciaventa";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
            $resultado = $_GET['resultado'];
            $json = new Services_JSON();
            $datos = $json->decode($resultado);
            GuardarNuevoVentaCompleta($datos,false);
        }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando venta en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }


    }else
    if($funcion == "txSavePares"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSavePares($datos,false);

    }else
    if($funcion == "ActualizarVentaModificada"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        ActualizarVentaModificada($datos,false);
    }else
    if($funcion == "EditarVentaPrecio"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        EditarVentaPrecio($datos,false);
    }else
    if($funcion == "txSaveDevo"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        txSaveDevo($datos,false);
    }else
    if($funcion == "txSaveDevoCobro"){
        $idmarca = $_GET['idmarca'];
        $idempleado = $_GET['idempleado'];
        $idcliente = $_GET['idcliente'];
        $boleta = $_GET['boleta'];
        $tipofalla = $_GET['tipofalla'];
        $fecha = $_GET['fecha'];
        $totalpares = $_GET['totalpares'];
        $totalsus = $_GET['totalsus'];
        $observacion = $_GET['observacion'];
        txSaveDevoCobro($idmarca, $idempleado, $idcliente, $boleta, $tipofalla, $fecha, $totalpares, $totalsus, $observacion, false);
    }else if($funcion =="eliminarventa"){
        $idmarca = $_GET['idventa'];
        eliminarventa($idmarca, false);
    }
    else

    if($funcion =="EliminarModeloVenta"){
        $idmodelo = $_GET['idmodelo'];
        $idventa = $_GET['idventa'];
        EliminarModeloVenta($idmodelo, $idventa,false);
    }
    else
    if($funcion == "BuscarEmpresaVendedorCliente"){


        BuscarEmpresaVendedorCliente($_GET['callback'], $_GET['_dc'], false);
    } else if($funcion =="Guardarentrega"){
        $idventa = $_GET['venta'];
        Guardarentrega($idventa);

    }
    else
    if ($funcion == "BuscarDatosVenta"){
        $idventadetalle = $_GET['idventadetalle'];
        BuscarDatosVenta($_GET['callback'], $_GET['_dc'], $idventadetalle, false);

    }else
    if ($funcion == "BuscarDatosFactura"){
        $idventadetalle = $_GET['idventadetalle'];
        BuscarDatosFactura($_GET['callback'], $_GET['_dc'], $idventadetalle, false);

    }else
    if($funcion == "ListarDetalleProductosVenta"){
        $idmarca = $_GET['idventadetalle'];

        ListarDetalleProductosVenta($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca, false);
    }else
    if($funcion == "cambiarestadoparcaja"){
        $idkardexunico = $_GET['idkardexunico'];
        $idkardex = $_GET['idkardex'];
        $idmodelo = $_GET['idmodelo'];
        //echo " codigo $codigo marca $idmarca vendedor $idvendedor ";
        cambiarestadoparcaja($idkardexunico,$idkardex,$idmodelo, false);
    }else
    if($funcion == "VerificarCantidadModelos"){
        VerificarCantidadModelos($_GET['codigo'],$_GET['idmarca'],$_GET['vendedor'], false);
    }else
    if($funcion == "ListarDetalleModelosVenta"){
        $codigo = $_GET['codigo'];
        $idmarca = $_GET['idmarca'];
        $idvendedor = $_GET['idvendedor'];
        //echo " codigo $codigo marca $idmarca vendedor $idvendedor ";
        ListarDetalleModelosVenta($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$codigo,$idmarca,$idvendedor, false);
    }else
    if($funcion == "ListarParesmodelo"){
        $idmarca = $_GET['idmodelo'];
        ListarParesmodelo($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idmarca, false);
    }else
    if($funcion == "BuscarVendedoresMarca"){

        BuscarVendedoresMarca($_GET['callback'], $_GET['_dc'],$_GET['idalmacen'],$_GET['idmarca'],false);
    }else

    //BuscarVendedores

    if($funcion == "BuscarVendedores"){

        $idmarca= $_GET['idmarca'];
        $idalmacen= $_GET['idalmacen'];
        // echo $idempresa;
        Listarvendedoresmarca1($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idalmacen, $idmarca, false);
    }else
    if($funcion == "ListarDetalleEntrega"){
        $idpedido = $_GET['idventamayor'];

        ListarDetalleEntrega($_GET['star'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'],$idpedido, false);
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