<?php
session_name("balderrama");
session_start();
set_time_limit(0);
include("impl/Reporte.php");
include("impl/ReporteInventario.php");
include("impl/ReporteFeria.php");
include("impl/ReporteGeneral.php");
include("impl/ReporteCobros.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//error_reporting(0);
$dev['mensaje'] = "";
$dev['error']   = "";
$dev['resultado'] = "";
//if(permitido("fun1024", $_SESSION['codigo'])==true)nofunciona//reportecuentaproveedorHTML
//{
$funcion = $_GET['funcion'];
$idventa = $_GET['idventa'];
$idcompra = $_GET['idcompra'];
if($funcion == "reportegeneralmarcaresumen")
{     reportegeneralmarcaresumen( $_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}else
if($funcion == "reportegeneralmarca")
{     reportegeneralmarca( $_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}else
if($funcion == "reportegeneral")
{ //verventalistavendedor($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
    reportegeneral( $_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);

}else
if($funcion == "pormarcavendedorcobroresumenvendedor")
{//resumen creditomayor
    pormarcavendedorcobroresumenvendedor($_GET['idalmacen'], $_GET['mescierre'],false);

}else
if($funcion == "poroficinamesreporte1")
{//resumen creditomayor para sueldos
    $opcionrep = 1;
    poroficinamesreporte($_GET['idalmacen'], $_GET['mescierre'], $opcionrep,false);

}else
if($funcion == "poroficinamesreporte2")
{//resumen creditomayor para sueldos
    $opcionrep = 2;
    poroficinamesreporte($_GET['idalmacen'], $_GET['mescierre'], $opcionrep,false);

}else
if($funcion == "poroficinamesreportesueldo")
{//resumen creditomayor para sueldos
    $opcionrep = 3;
    poroficinamesreporte($_GET['idalmacen'], $_GET['mescierre'], $opcionrep,false);

}else
if($funcion == "poroficinamesreportemorosidad")
{//resumen creditomayor para sueldos
    $opcionrep = 4;
    poroficinamesreporte($_GET['idalmacen'], $_GET['mescierre'], $opcionrep,false);

}else
if($funcion == "ProcesarCierreCobro")
{
    ProcesarCierreCobro($_GET['mesproceso'],false);
}else
if($funcion == "pormarcavendedorcobrodetallevendedor")
{//detalle creditocliente
    pormarcavendedorcobrodetallevendedor( $_GET['idcliente'],$_GET['fecha1'],$_GET['fecha2'],false);

}else
if($funcion == "pormarcavendedorcobroresumen")
{
    pormarcavendedorcobroresumen( $_GET['idcliente'],false);

}else
if($funcion == "pormarcavendedorcobro")
{//saldocredito por boleta
    pormarcavendedorcobro( $_GET['idcliente'],false);

}else
if($funcion == "porclientescobro")
{
    porclientescobro( $_GET['idcliente'],false);

}else

if($funcion == "porcobrostodo")
{//porclientescobro
    //porcobrostodo( $_GET['idcliente'],false);

}else
if($funcion == "reportemarcaProductoHTML")
{//hooooo
    reporteMarcaProductos($_GET['idmarca'],false);

}
if($funcion == "reportecoleccionHTML")
{
    //reporteBalanceGeneral(false);
    reporteColeccion($_GET['idcoleccion'],false);
}
else
if($funcion == "verpagos")
{
    verpagos($_GET['idcrecliente'], false);

}
else
if($funcion == "reportesclienteHTML")
{
    reportesclienteHTML($_GET['idempresa'], false);

}else
if($funcion == "reporteEmpresaHTML")
{
    reporteEmpresaHTML($_GET['idempresa'], false);

}else
if($funcion == "reportekardexHTML")
{
    reporteKardex($_GET['idproducto'],$_GET['idalmacen'], false);

}
else if($funcion == "reporteclienteHTML")
{
    reporteCliente($_GET['idcliente'], false);

}
else if($funcion == "reportecreditoHTML")
{
    reporteClienteCredito2($_GET['idcredito'], false);

}

else if($funcion == "detalleColeccionHTML")
{
    detalleColeccion($_GET['idcoleccion'], false);

}

else if($funcion == "detalleModeloHTML")
{
    detalleModelo($_GET['idmarca'], false);

}


else if($funcion == "reporteclientecreditoHTML")
{
    reporteClienteCredito($_GET['idcliente'], false);

} 
else if($funcion == "reporteproveedorHTML")
{
    reporteProveedor($_GET['idproveedor'], false);

}
else if($funcion == "reporteempleadoHTML")
{
    reporteEmpleadoHTML($_GET['idempleado'],false);
}
else if($funcion == "reporteboletaempleadoHTML")
{
    reporteBoletaEmpleadoHTML($_GET['idempleado'],false);
}
else if($funcion == "DetalleIngresoHTML")
{
    DetalleIngresoHTML($_GET['idingreso'], false);

}
else if($funcion == "verIngresosMarcaEstiloHTML")
{$idmarca= $_GET['idmarca'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];
    if($opcionb=="4"||$opcionb=="14"||$opcionb=="15"){
        verIngresosMarcaEstiloHTMLtallam($_GET['idmarca'],$_GET['idestilo'], false);
    }else{
        verIngresosMarcaEstiloHTML($_GET['idmarca'],$_GET['idestilo'], false);
    }
}
//totales fin modificacion
else if($funcion == "verIngresosMarcaEstiloHTMLInventario")
{   

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventariotallam($_GET['idmarca'],$_GET['idestilo'], false);
        }else{
            verIngresosMarcaEstiloHTMLtallam($_GET['idmarca'],$_GET['idestilo'], false);
        }

    }else{
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventario2($_GET['idmarca'],$_GET['idestilo'], false);
        }else{
            verIngresosMarcaEstiloHTML($_GET['idmarca'],$_GET['idestilo'], false);
        }

    }
}
else if($funcion == "verIngresosMarcaEstiloModeloHTML")
{

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $modelo= $_GET['modelo'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="3"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLModelo($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'],"2", false);
        }else{
            verIngresosMarcaEstiloModelo($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'], "2",false);
        }
    }else{
        if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
            if($idestilo=="" || $idestilo=null || $idestilo=='null'){
                verIngresosMarcaEstiloHTMLModelotallam($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'], false);
            }else{
                verIngresosMarcaEstiloHTMLModelotallamestilo($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'], false);
            }

        }else{
            if($idestilo=="" || $idestilo=null || $idestilo=='null'){
                verIngresosMarcaEstiloHTMLModelo($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'],"1", false);
                //verIngresosMarcaEstiloHTMLInventario2Ventas($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);

            }else{
                verIngresosMarcaEstiloModelo($_GET['idmarca'],$_GET['idestilo'],$_GET['modelo'],"1", false);
            }
        }
    }
}
else if($funcion == "verIngresosMarcaEstiloHTMLInventarioVentas")
{

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventariotallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{
            verIngresosMarcaEstiloHTMLtallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }else{
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventario2Ventas($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{

            verIngresosMarcaEstiloHTMLVentas($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }
}

else if($funcion == "verIngresosMarcaEstiloHTMLInventarioVentasToma")
{

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verdibujotablainventariotallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{
            verdibujotablainventarioestilotallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }
    }else{
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verdibujotablainventario($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{
            verdibujotablainventarioestilo($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }
}
else if($funcion == "verIngresosMarcaEstiloHTMLInventarioVentasVacio")
{

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventariotallaVacio($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{
            // verIngresosMarcaEstiloHTMLtallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }else{
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verIngresosMarcaEstiloHTMLInventario2VentasVacio($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{

            // verIngresosMarcaEstiloHTMLVentas($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }
}

else if($funcion == "verIngresosDiferenciaLector")
{

    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];

    if($opcionb=="4"||$opcionb=='14'||$opcionb=="15"){
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verDetalleLectortallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{
            //  verIngresosMarcaEstiloHTMLtallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
            verDetalleTotalesDiferenciatallam($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }else{
        if($idestilo=="" || $idestilo=null || $idestilo=='null'){
            verDetalleLector($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }else{

            verDetalleTotalesDiferencia($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
        }

    }
}
//VerResumenAlmacen
else if($funcion == "VerResumenAlmacen")
{//por almacen general

    //$idmarca= $_GET['idmarca'];
    //$idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    VerResumenAlmacen($_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}
else if($funcion == "VerRecapitulacion")
{//por marca general
    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    VerRecapitulacion($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}
else if($funcion == "VerPlanificacion")
{//planificacion
    $idvendedor= $_GET['idvendedor'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    VerPlanificacion($_GET['idvendedor'],$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}

else if($funcion == "VerRecapitulacionMarcaVendedor")
{//por vendedor con marcas
    $idvendedor= $_GET['idvendedor'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    VerRecapitulacionMarcaVendedor($_GET['idvendedor'],$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}
else if($funcion == "VerRecapitulacionMarca")
{   //recapitulacion principal
    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    $idalmacen=$_SESSION['idalmacen'];
    VerRecapitulacionMarca($idalmacen,$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}
else if($funcion == "VerRecapitulacionMarcaFeria")
{   //recapitulacion principal
    $idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    $idalmacen=$_SESSION['idalmacen'];
    VerRecapitulacionMarcaFeria($idalmacen,$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}

else if($funcion == "VerRecapitulacionMarcaAlmacen")
{    $idalmacen= $_GET['idalmacen'];
    $idestilo= $_GET['idestilo'];
    $idkardex= $_GET['idkardex'];
    $fechainicio= $_GET['fechainicio'];
    $fechafin= $_GET['fechafin'];
    VerRecapitulacionMarca($_GET['idalmacen'],$_GET['idestilo'],$_GET['idkardex'],$_GET['fechainicio'],$_GET['fechafin'], false);
}

else if($funcion == "verIngresosMarcaEstiloHTMLInventarioTotales"){
    verIngresosMarcaEstiloHTMLInventarioTotales($_GET['idmarca'],$_GET['idestilo'], false);
}
else if($funcion == "verIngresosMarcaEstiloHTMLInventarioTotalesVentas"){
    verIngresosMarcaEstiloHTMLInventarioTotales($_GET['idmarca'],$_GET['idestilo'],$_GET['idkardex'], false);
}
else if($funcion == "verIngresosMarcaEstiloFechatallaHTML")
{$idmarca= $_GET['idmarca'];
    $sql = "SELECT ma.opcionb
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];
    if($opcionb=="4"||$opcionb=="14"||$opcionb=="15"){
        verIngresosMarcaEstiloFechatallaHTMLamericano($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }else{
        verIngresosMarcaEstiloFechatallaHTML($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }
}

//para ingresos  talla
else if($funcion == "verIngresosKardexMarcaEstiloFechatallaHTML")
{$idmarca= $_GET['idmarca'];
    $idestilo= $_GET['idestilo'];
    if($idmarca=="" || $idmarca=null || $idmarca=='null'){
        verIngresosKardexMarcaEstiloFechatallaHTML($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }else{
        verIngresosKardexMarcaEstiloFechatallaHTMLpormarca($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }
}
else if($funcion == "verventalista")
{ verventalista($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verDevoluciones")
{ verDevoluciones($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventalistavendedor")
{ verventalistavendedor($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventaferiavendedor")
{ verventaferiavendedor($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventaferiamarca")
{ verventaferiamarca($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventaferiamodelo")
{ verventaferiamodelo($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}else
if($funcion == "veringresomarcavendedor")
{ veringresomarcavendedor($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "veringresolistamarca")
{ veringresolistamarca($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}

else if($funcion == "verventalistamarcamodelo")
{ verventalistamarcamodelo($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventalistamarca")
{ verventalistagral($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verresumen")
{ verresumen($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verresumenCXC")
{ verresumenCXC($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verventalistaconfirmada")
{ verventalistaconfirmada($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}

else if($funcion == "vertraspasomarca")
{ vertraspasomarca($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "vertraspasomarcarecib")
{ vertraspasomarcarecib($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "vertraspasointerno")
{ vertraspasointerno($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "vertraspasointernoenviado")
{ vertraspasointernoenviado($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "habilitaciones")
{ habilitaciones($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "eliminacionesbit")
{ eliminacionesbit($_GET['idmarca'],$_GET['idvendedor'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verCambiosproductoentradasalida")
{
    $idmarca= $_GET['idmarca'];
    if($idmarca !=null || $idmarca !="null" || $idmarca !=''){
        verCambiosproductoentradasalida($idmarca,$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }else{
        verCambiosproductoentradasalida("",$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
    }
}
else if($funcion == "verIngresosMarcaHTML")
{
    verIngresosMarcaHTML($_GET['idmarca'], false);
}
else if($funcion == "reporterebajasHTML")
{
    reporterebajasHTML($_GET['idmarca'], false);
}
else if($funcion == "verRebajas")
{
    verRebajas($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verTraspasosporFecha")
{
    verTraspasosporFecha($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else if($funcion == "verUniones")
{
    verUniones($_GET['idmarca'],$_GET['idestilo'],$_GET['fecha1'],$_GET['fecha2'], false);
}
else
if($funcion =="imprimirmodeloestilotalla"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    imprimirmodeloestilotalla($datos,false);
}else

if($funcion =="imprimirmodeloestilotalladetalle"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);

    imprimirmodeloestilotalladetalle($datos,false);
}else
if($funcion =="imprimirmodeloestilotalladetalletraspaso"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    imprimirmodeloestilotalladetalletraspaso($datos,false);
}else

if($funcion == "verproductoHTML")
{
    reporteProducto($_GET['idkardexunico'], false);

}
else  if($funcion == "reporteproformaHTML")
{
    reporteProforma($_GET['idproforma'], false);

}

else 
if($funcion == "compraconcuentaHTML")
{
    compraconcuentaHTML($_GET['idcompra'], false);
}
else
if($funcion == "reportealmacenHTML")
{
    reportealmacenHTML($_GET['idalmacen'], false);
}
else
if($funcion == "ArqueoDiarioHTML")
{
    arqueoDiarioHTML($_GET['idalmacen'],$_GET['fecha'],$_GET['efec_bs'],$_GET['efec_sus'],false);
}
else if($funcion == "reporteEntregaItemsHTML")
{
    reporteEntregaItemsHTML($_GET['identregacompra'], false);
}


else if($funcion == "reporteventasdiarias")
{
    reporteVentaDiaria($_GET['idalmacen'],false);//falta terminar
} 
else if($funcion == "verboletaventa")
{  verboletaventa($_GET['idventa'], false);
}
else if($funcion == "verboletacambio")
{  verboletacambio($_GET['idventa'], false);
}
else if($funcion == "verventasferia")
{  verventasferia(false);
}
else if($funcion == "ventasimpleHTML")
{  ventasimpleHTML($_GET['idventa'], false);
}
else if($funcion == "verboletaventacompleta")
{  verboletaventacompleta($_GET['idventa'], false);
}
else if($funcion == "verboletaventadevolucion")
{ verboletaventadevolucion($_GET['idventa'], false);
}
else if($funcion == "verboletaventaanulacion")
{ verboletaventaanulacion($_GET['boleta'], false);
}

else if($funcion == "verboletadevolucion")
{ verboletadevolucion($_GET['idventa'], false);
}
else if($funcion == "verboletatraspaso")
{
    verboletatraspaso($_GET['idtraspaso'], false);
}
else if($funcion == "vercodigostraspaso")
{
    vercodigostraspaso($_GET['idtraspaso'], false);
}
else if($funcion == "vercodigoanuladosventa")
{
    vercodigoanuladosventa($_GET['boleta'], false);
}
else if($funcion == "verimagendelmodelo")
{
    verimagendelmodelo($_GET['idmodelo'],$_GET['modelo'], false);
}

else  if($funcion == "reporteEntrega")
{
    reporteEntregaHTML($_GET['identrega'], false);
}
else if($funcion == "reporteGeneralModelo")
{
    reporteGeneralModelo(false);
}

else if($funcion == "reportestokHTML")
{
    reporteStok( false);
}

else if($funcion == "reportecajeroHTML")
{
    reporteCajero($_GET['idusuario'],$_GET['fechaInicio'],$_GET['fechaFin'],false);
}
else if($funcion == "reporteProductoVendido")
{
    reporteProductoVendido(false);
}
else if($funcion == "clienteDeuda")
{    clienteDeuda($_GET['idcliente'],false);

}
else if($funcion == "reporteEstadodeResultados")
{
    reporteEstadodeResultados( false);
}
else if($funcion == "ventasTotales")
{ reporteVentasTotales($_GET['almacenV'],$_GET['fechainiV'],$_GET['fechafinV'],false);
}

else if($funcion == "comprasTotales")
{

    reporteComprasTotales($_GET['almacenV'],$_GET['fechainiV'],$_GET['fechafinV'],false);

}

else if($funcion == "clientesTotales")
{

    reporteClientesTotales($_GET['almacenV'],$_GET['fechainiV'],$_GET['fechafinV'],false);

}
else if($funcion == "reportemuestraHTML")
{

    reporteMuestra($_GET['idmuestra'],false);

}
else if($funcion == "reportelineaHTML")
{

    reporteLinea($_GET['idlinea'],false);

}
else if($funcion =="CodigoBarraIngresoHTML")
{
    CodigoBarraIngreso($_GET['idingreso'],false);
}
else if($funcion =="AdicionCodigoBarraIngresoHTML")
{//mayor
    $idingreso= $_GET['idingreso'];
    $sql1 = "SELECT  idmarca FROM ingresoalmacen WHERE idingreso = '$idingreso' ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
    $idmarca = $idalmacenA['resultado'];
    if($idmarca=='mar-3'){
        AdicionCodigoBarraIngresoNike($_GET['idingreso'],false);
    }else{

        AdicionCodigoBarraIngreso($_GET['idingreso'],false);
    }

}else

if($funcion =="imprimirlistacodigos"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    imprimirlistacodigos($datos,false);
}else
if($funcion =="imprimirmodeloestilotallabarra"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    imprimirmodeloestilotallabarra($datos,false);
}
if($funcion == "imprimirlistacodigospormodelo")
{
    imprimirlistacodigospormodelo($_GET['idmarca'],$_GET['modelo'], false);
}
else if($funcion =="vercodigobarra")
{//mayor
    //pares
    vercodigobarra($_GET['idventa'],false);
}
else if($funcion =="vercodigobarratraspaso")
{//mayor
    //pares
    vercodigobarratraspaso($_GET['idtraspaso'],false);
}
else if($funcion =="AdicionCodigoBarraIngresoHTMLNike")
{
    AdicionCodigoBarraIngresoNike($_GET['idingreso'],false);
}
else if($funcion =="CodigoBarraIngresoAlmacenHTML")
{
    CodigoBarraIngresoAlmacen($_GET['idingreso'],false);
}
else  if($funcion == "AdicionDetalleIngresoHTML")
{
    AdicionDetalleIngresoHTML($_GET['idingreso'], false);
}
else if($funcion =="AdicionCodigoBarraIngresoDetalleHTML")
{
    AdicionCodigoBarraIngresoDetalleHTML($_GET['idimpresion'],false);
}

else if($funcion =="Listaparesingreso")
{
    Listaparesingreso($_GET['idingreso'],false);

}
else if($funcion =="ListaInventarioMarca")
{
    ListaInventarioMarca($_GET['idmarca'],$_GET['idcliente'],$_GET['rango'],$_GET['idvendedor'],$_GET['modelo'],$_GET['idkardex'],false);
}
else if($funcion =="verDetalleCapitalMarca")
{
    verDetalleCapitalMarca($_GET['idmarca'],$_GET['idkardex'],false);
}
else if($funcion =="codbarraporpar")
{
    codbarraporpar($_GET['idimpresion'],false);
}
else if($funcion =="extractocliente")
{
    $idcliente = $_GET['idcliente'];
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    extractocliente($datos,$idcliente,false);
}

else if($funcion =="verdetallemodelo")
{//mayor u
    verdetallemodelo($_GET['idmodelo'],false);
}
else if($funcion =="verConsultamodeloBarra")
{//mayor u
    verConsultamodeloBarra($_GET['codigobarra'],$_GET['idalmacen'],false);
}
else if($funcion =="verConsultamodelo")
{//ListaInventarioMarca($_GET['idmarca'],$_GET['idcliente'],$_GET['rango'],$_GET['idvendedor'],$_GET['modelo'],$_GET['idkardex'],false);
    verConsultamodelo($_GET['idalmacen'],$_GET['modelo'],false);
}
?>
