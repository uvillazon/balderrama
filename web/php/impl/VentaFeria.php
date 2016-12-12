<?php
function BuscarDatosFacturaFeria($callback, $_dc, $idventadetalle, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuariocaja = $_SESSION['idusuario'];
    $sql1= "SELECT clienteitem,detalle FROM ventas where idventa='$idventadetalle'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "detalle");
    $detalle = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "clienteitem");
    $clienteitem = $result['resultado'];
    $fecha22= split("/", $clienteitem);
    $nit=$fecha22[0];
    $cliente=$fecha22[1];
$marca="FEXPOCRUZ";
    $sql = "SELECT v.idventa,v.hora,v.fecha,v.idalmacen,'$marca' as marca,em.codigo as idusuario,'$idusuariocaja' as idusuariocaja, '$cliente' AS cliente,
SUM(iv.cantidad) as totalpares,v.totalbs as totalsus,v.descuento,v.idalmacen,'$detalle' as tipocalzado,'$nit' as nit
FROM ventas v,ventaitem iv, almacenes a,empleados em
WHERE iv.idventa=v.idventa and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' and iv.idventa='$idventadetalle' group by iv.idventa order by v.fecha desc ,v.hora desc";


 // echo $sql;
    if($idventadetalle != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else
                            {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "El codigo de producto es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }


    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}



function buscarcodigobarra($codigo,$idvendedor,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
//    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
//    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
//    $formatomayor = $result['resultado'];

//$idvendedor='emp-41';
$idvendedor='emp-92';
    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idalmacen='$idalmacen' and kar.idoperacion='no' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idalmacen='$idalmacen' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    $cantidad = "1";

    if($saldoreal !=null || $saldoreal!=""){
        //String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

            $sql = "
            SELECT kar.idkardexunico, kar.talla , kar.preciounitariobs as precio,
            mdd.codigo,CONCAT(mdd.color, '-', mdd.material) AS detalle FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idkardexunico='$idkardexunicopar' and mdd.idalmacen='$idalmacen'";

        // echo $sql;
//        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
//        $value['idmodelo'] =  $detalleA['resultado'];
//        $idmodelo =  $detalleA['resultado'];
        $codigoAd = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
        $value['idkardexunico'] = $codigoAd['resultado'];
        $idkardexunico = $codigoAd['resultado'];
//        $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
//        $value['cantidad'] = $precio2A['resultado'];
                 $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
                 $value['talla'] = $precio2A1['resultado'];
        $value['talla'] = "-";
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "precio");
        $value['preciou'] = $precio2A1['resultado'];
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "modelo");
        $value['modelo'] = $precio2A1['resultado'];
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "detalle");
        $value['detalle'] = $precio2A1['resultado'];
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "item");
        //         $value['item'] = $precio2A1['resultado'];
        $value['item'] = "-";
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciocaja");
        $value['preciocaja'] = "-";
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "idoperacion");
        $idoperacion = $precio2A1['resultado'];

        //          $sql3 = "
        //SELECT CONCAT(em.nombres, '-', em.apellidos) AS cliente from modelo mdd,empleados em
        //WHERE mdd.idvendedor=em.idempleado and mdd.idmodelo='$idmodelo' ";
        //        $detalleA = findBySqlReturnCampoUnique($sql3, true, true, "cliente");
        //        $value['vendedor'] =  $detalleA['resultado'];
        $value['vendedor'] =  "-";
        //echo $sql3;

       // echo $sql;
//        if($idoperacion =='leido' || $idoperacion=="leido"){
//            $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
//            $json = new Services_JSON();
//            $output = $json->encode($dev);
//            print($output);
//            exit;
//        }else{
//
//        }

    }else{
        $dev['mensaje'] = "Error no tiene suficiente inventario y/o no existe el modelo en este almacen Vea sus traspasos pendientes y/o devoluciones";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    if($codigo != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{mysql_field_name($re, $i)}= $fi[$i];

                        }

                       // cambiarestadopar($idkardexunico,true);

                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "Vuelva a ingresar otro dato por que no se encontro datos en la CONSULTA";
                        $dev['error']   = "false";
                        $dev['resultado'] = "por favor ingrese otro dato";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No existe el producto";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    $dev['totalCount'] = 1;

    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}

function guardarventasferia($resultado, $return)
{ $idalmacen =$_SESSION['idalmacen'];
   iniciandoinsercionventa($idalmacen,true);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time();
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;
    $idmarca= $proforma->idmarca;
    $boletanuevo=$proforma->boleta;
    $boletamanual=$proforma->boletamanual;
    $fechaventa=$proforma->fecharegistro;
    $totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
     $totalfinal = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;
$vendedor = $proforma->vendedor;
$vendedorferia = $proforma->vendedorferia;
    $codigocliente = $proforma->cliente;
    $codigocliente = strtoupper($codigocliente);
    $nit = $proforma->nit;
   // $idempleado = $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;

  $idempleado = "emp-92";

   $idcliente = "cli-1429";
$itemcli=$nit."/".$codigocliente;

    $sql1= "SELECT MAX(idventa) AS num FROM ventas";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj = $result['resultado'];
    $idventa = $numeroventaj + 1;
    $sql12= "SELECT MAX(boleta) AS numb FROM ventas where idalmacen='$idalmacen'";
    $resultw = findBySqlReturnCampoUnique($sql12, true, true, "numb");
    $numeroventajw = $resultw['resultado'];
    $boleta = $numeroventajw + 1;
    $totalpares=COUNT($product);
    $cantidadminima = '1';
    if($totalpares < $cantidadminima){
        $dev['mensaje'] = "Debe vender por lo menos un producto par";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else{
        $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
        $tipocambio = $result['resultado'];
        $montoapagarsus = $montoapagar/$tipocambio;
        $arqueo="0";
        //$clienteitem
        $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
        $periodo = $result['resultado'];
        $sql[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $itemcli, $fechaventa, $hora, "CREDITO", $totalcaja, $totalfinal, $totalpares, $totalfinal, $descporcentaje, $descuento, $totalfinal, $totalfinal, $totalfinal, $totalfinal, $totalfinal,$tipocambio, $arqueo, "N", $observacion, $fechacancelacion, "PENDIENTE", $idusuario, $dato, false);
        
        $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $numeroventaj1 = $result['resultado'];
        $iditemventa = $numeroventaj1 ;
$detallepares="CALZADOS";
        for($i=0;$i<count($product);$i++){
            $producto = $product[$i];

            //$iddetalletraspasoA = findUltimoID("ventaitem", "iditemventa",true );
            $iditemventa = $iditemventa + 1 ;
            //
            $idkardexunico = $producto->idkardexunico;
            $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
            $idmodelo = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
            $saldocantidad = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
            $talla = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
            $idkardex = $cantidadventaA1['resultado'];
            $preciounitariobs = $producto->preciou;
            $cantidad = '1';
           
    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
    $preciounitario = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];
    $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmarca");
    $idmarcareal = $cantidadventaA1['resultado'];
      $sql3 = " SELECT * FROM marcas WHERE idmodelo = '$idmarcareal'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "codigo");
    $codmarca = $cantidadventaA1['resultado'];
$sql[] =getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciounitario, $preciounitario, "0", "0", $totalcajaprecio, "P", $devolucion, $tipomuestra, $diferencia,$preciounitario,false);
  
// $sql[] =getSqlNewVentaferia($numerointerno, $idventa, $idalmacen, $idvendedor, $idmarcareal, $idkardexunico, $idmodelo, $idventa, $cliente, $fecha, $hora, $tipoventa, $tcajas, $cantidad, $precio, $rebaja, $montopagado, $observacion,  false);
$sql[] =getSqlNewVentaferia($numerointerno, $idventa, $idalmacen, $vendedorferia, $idmarcareal, $idkardexunico, $idmodelo, $boleta, $codigocliente, $nit, $fechaventa, $hora, "CF", $tcajas, $cantidad, $preciounitariobs, $rebaja, $totalbs, $observacion, false);

            actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);
           $detallepares = $detallepares+$codmarca;
        }
      $sql[] = "UPDATE ventas SET detalle='CALZADOS' where idventa='$idventa';";

    }
//    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {    finalizandoinsercionventa($idventa,true);
        //recalculatotales($idventa,false);
        $dev['mensaje'] = "Se guardo la venta correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idventa";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idventa";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
function getSqlNewVentaferia($numero, $idventa, $idalmacen, $idvendedor, $idmarca, $idkardexunico, $idmodelo, $boleta, $cliente, $nit, $fecha, $hora, $tipoventa, $tcajas, $totalpares, $totalsus, $rebaja, $montopagado, $observacion, $return){
$setC[0]['campo'] = 'numero';
$setC[0]['dato'] = $numero;
$setC[1]['campo'] = 'idventa';
$setC[1]['dato'] = $idventa;
$setC[2]['campo'] = 'idalmacen';
$setC[2]['dato'] = $idalmacen;
$setC[3]['campo'] = 'idvendedor';
$setC[3]['dato'] = $idvendedor;
$setC[4]['campo'] = 'idmarca';
$setC[4]['dato'] = $idmarca;
$setC[5]['campo'] = 'idkardexunico';
$setC[5]['dato'] = $idkardexunico;
$setC[6]['campo'] = 'idmodelo';
$setC[6]['dato'] = $idmodelo;
$setC[7]['campo'] = 'boleta';
$setC[7]['dato'] = $boleta;
$setC[8]['campo'] = 'cliente';
$setC[8]['dato'] = $cliente;
$setC[9]['campo'] = 'nit';
$setC[9]['dato'] = $nit;
$setC[10]['campo'] = 'fecha';
$setC[10]['dato'] = $fecha;
$setC[11]['campo'] = 'hora';
$setC[11]['dato'] = $hora;
$setC[12]['campo'] = 'tipoventa';
$setC[12]['dato'] = $tipoventa;
$setC[13]['campo'] = 'tcajas';
$setC[13]['dato'] = $tcajas;
$setC[14]['campo'] = 'totalpares';
$setC[14]['dato'] = $totalpares;
$setC[15]['campo'] = 'totalsus';
$setC[15]['dato'] = $totalsus;
$setC[16]['campo'] = 'rebaja';
$setC[16]['dato'] = $rebaja;
$setC[17]['campo'] = 'montopagado';
$setC[17]['dato'] = $montopagado;
$setC[18]['campo'] = 'observacion';
$setC[18]['dato'] = $observacion;
$sql2 = generarInsertValues($setC);
return "INSERT INTO ventaferia ".$sql2;


}

function getSqlNewNumeracionventa($idnumeracion, $idventa, $idalmacen, $return){
$setC[0]['campo'] = 'idnumeracion';
$setC[0]['dato'] = $idnumeracion;
$setC[1]['campo'] = 'idventa';
$setC[1]['dato'] = $idventa;
$setC[2]['campo'] = 'idalmacen';
$setC[2]['dato'] = $idalmacen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO numeracionventa ".$sql2;
}

function BuscarClientesespecial($callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
$categorias =  ListarClienteEmpresaActivoempresapornombre('', '', '', '', '', '', $idempresa, true);

   // $categorias = ListarEmpresaVenta('', '', '', '', '', '','',true);
    if($categorias['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $categorias['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario";
    $dev['error']   = "true";
    $dev['resultado'] = $value;
    if($return == true)
    {
        return $dev;
    }
    else
    {
        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }
    }
}

function ListarClienteEmpresaActivoempresapornombre($start, $limit, $sort, $dir, $callback, $_dc, $idempresa, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
  //  echo $idempresa;
set_time_limit(0);
                    $sql ="
SELECT numero AS idcliente,
cliente AS nombrecliente
FROM
 ventaferia GROUP by cliente
";
   // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function listarproductosalmacen2($start, $limit, $sort, $dir, $callback, $_dc, $codigo,$marca,$talla,$return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
 $idalmacen =$_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


 

$select ="k.idkardexunico,m.codigo,CONCAT( m.color, '-', m.material) AS detalle,ma.nombre as marca,k.talla,'1' as cantidad,k.preciounitariobs as precio";
$from = "kardexdetallepar k,modelo m,marcas ma";
$where = " m.idmarca=ma.idmarca AND k.idmodelo=m.idmodelo AND k.idalmacen='$idalmacen'  and k.saldocantidad>='1'";
 if($codigo!=null || $codigo!=""){
         $from .= "";
         $where .= " AND m.codigo  LIKE '%".$codigo."%'";
  }
  if($marca!=null || $marca!=""){
         $from .= "";
         $where .= " AND ma.nombre  LIKE '%".$marca."%'";
  }
  if($talla!=null || $talla!=""){
         $from .= "";
         $where .= " AND k.talla ='$talla'";
  }
 $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
 //echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
//LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla

              if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}




?>