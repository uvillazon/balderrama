<?php
function  BuscarRedondeosus($montobs,$tipocambio,$return=false){
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
$tipocambio='6.96';
     $totalsus = $montobs/$tipocambio;
 //   echo $totalsus;
$cantidadcuota = redondear($totalsus, $_SESSION['usrDigitos']);
//echo $cantidadcuota;
//$modulo= $montobs % $tipocambio;
//echo $modulo;
$nuevovalor = $cantidadcuota * $tipocambio;
$prueba= $montobs - $nuevovalor;
if($prueba > '3.95')
{$pago=$cantidadcuota + 1;

}else{
    $pago= $cantidadcuota + 0;
}


           $value['montosus'] =  "$pago";


  //  echo $sql;
    if($montobs != null)
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
                        $dev['mensaje'] = "El cliente esta observado no se puede dar credito";
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

    $dev['mensaje'] = "Se cargo el formulario ";
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
function GuardarEdicionModeloitem($resultado, $return)
{   $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->ingreso;
    $item = $proforma->item;
    $clienteitem = $proforma->clienteitem;

    $calzados = $resultado->calzados;
    //$sql[] = "UPDATE modelo SET codigo='$modelo',material='$material',color='$color',fechaingreso='$fechaingreso',cliente='$item' where idmodelo='$idmodelo';";
    $totalpares=COUNT($calzados);
    $cantidadminima = '1';

    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;
    $arqueo="0";

    $calzados = $resultado->calzados;

    for($i=0;$i<count($calzados);$i++){
        $calzado = $calzados[$i];
        $iditemventa = $iditemventa + 1 ;
        $idmodelo = $calzado->idmodelo;
        //registraritemventatraspasomodelo($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,false);
        $sql[] = "UPDATE modelo SET cliente='$item' where idmodelo='$idmodelo';";

    }



    //  }
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se modifico correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idmodelo";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";
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

function GuardarEdicionModelo($resultado, $return)
{   $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->ingreso;
    $idmodelo= $proforma->idmodelo;
    $modelo=$proforma->modelo;
    $material=$proforma->material;
    $color = $proforma->color;
    $fechaingreso = $proforma->fechaingreso;
    $item = $proforma->item;
    $clienteitem = $proforma->clienteitem;

    $calzados = $resultado->calzados;
    $sql[] = "UPDATE modelo SET codigo='$modelo',material='$material',color='$color',fechaingreso='$fechaingreso',cliente='$item' where idmodelo='$idmodelo';";
    $totalpares=COUNT($calzados);
    $cantidadminima = '1';

    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;
    $arqueo="0";

    $calzados = $resultado->calzados;

    for($i=0;$i<count($calzados);$i++){
        $calzado = $calzados[$i];
        $iditemventa = $iditemventa + 1 ;
        $idmodelo = $calzado->idmodelo;
        //registraritemventatraspasomodelo($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,false);
    }



    //  }
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se modifico correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idmodelo";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";
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
function listaboletasventa($idvendedor,$idcliente,$idmarca,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $sql = "SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
        v.tipoventa,v.tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
        FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
        WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
        v.idvendedor=em.idempleado AND v.idvendedor='$idvendedor' AND v.idcliente='$idcliente' AND v.idmarca='$idmarca' group by iv.idventa order by v.fecha desc ,v.boleta ";

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

                                //   echo $sqld;
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        do{
                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));
                                    }
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
function Registrarventatraspaso($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //insertanuevo
    $idalmacen =$_SESSION['idalmacen'];
    iniciandoinsercionventa($idalmacen,true);
    $idtraspaso = $resultado->idtraspaso;
    $idmarca = $resultado->idmarca;
    $idempleado = $resultado->idvendedor;
    $idcliente = $resultado->idcliente;
    $codigobarraA1= actualizarplanillaempresainsertaventaidtraspaso($idalmacen, $idmarca,$idempleado,$idcliente,$idtraspaso,false);
    $idventa = $codigobarraA1['idventa'];
    //
    $sql ="
SELECT idkardexunico
FROM traspasodetallepar
WHERE iddetalletraspaso = '$idtraspaso'
";

    //echo $idventa;
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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "idkardexunico";
                            $idkardexunico = $fi[$i];
                            //echo $idclienteempresa;
                            // $idmodelo = $calzado->idmodelo;
                            $sql12 = "SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico' ";
                            $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelo");
                            $idmodelo = $saldocantidadA['resultado'];


                            $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
                            $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
                            $numeroventaj1 = $result['resultado'];
                            $iditemventa = $numeroventaj1 ;
                            $iditemventa =$iditemventa+1;
                            insertarparesventatotal($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,false);
                        }

                    }while($fi = mysql_fetch_array($re));
                    //                    $dev['mensaje'] = "Existen resultados";

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
        //        $dev['mensaje'] = "Existen resultados";
        //                    $dev['error']   = "true";
        //                    $dev['resultado'] = "$idventa";
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    finalizandoinsercionventa($idventa,true);
    recalculatotales($idventa,false);
    // $dev['mensaje'] = "ok";
    $dev['error'] = "true";
    $dev['resultado'] = "$idventa";
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);


}
function insertarparesventatotal($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,$return){
    set_time_limit(0);
    $idalmacen =$_SESSION['idalmacen'];
    $emitido="1";
    //echo $mesplanilla;
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    $fechaventa= date("Y-m-d");
    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
    $saldocantidad = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
    $talla = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
    $idkardex = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
    $preciounitario = $cantidadventaA1['resultado'];

    $cantidad = '1';

    $sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
    $totalcajaprecio = $cantidadventaA1['resultado'];

    $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
    $idvendedororigen = $cantidadventaA1['resultado'];

    if($idempleado==$idvendedororigen){
    }else{
        //insertar como traspaso interno
        $sqlA[] =getSqlNewTraspasosinternos($numero, $fechaventa, $idkardexunico, $idkardex, $idventa, $idempleado, $idmodelo, $cantidad, $talla, $preciounitario, $idalmacen, $idvendedororigen,false);
    }

    $sqlA[] =getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciounitario, $preciounitario, "0", "0", $totalcajaprecio, "P", $devolucion, $tipomuestra, $diferencia,$preciounitario,false);
    actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);
    //MostrarConsulta($sqlA);

    ejecutarConsultaSQLBeginCommit($sqlA);

}


function actualizarplanillaempresainsertaventaidtraspaso($idalmacen, $idmarca,$idempleado,$idcliente,$idtraspaso,$return){
    $emitida="1";

    $fechaventa = date("Y-m-d");
    $horaventa = date("H:i:s");
    $fechareal = Date("Y-m-d");
    $sql1= "SELECT MAX(idventa) AS num FROM ventas";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj = $result['resultado'];
    $idventa = $numeroventaj + 1;
    $sql12= "SELECT MAX(boleta) AS numb FROM ventas where idalmacen='$idalmacen'";
    $resultw = findBySqlReturnCampoUnique($sql12, true, true, "numb");
    $numeroventajw = $resultw['resultado'];
    $boleta = $numeroventajw + 1;
    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;

    //para credito
    $arqueo="0";
    //$clienteitem
    $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $periodo = $result['resultado'];
    $totalbs ="0";
    $sqlA[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, '-', $fechaventa, $horaventa, "CREDITO", $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $arqueo, "N", 'traspaso', $fechacancelacion, "PENDIENTE", $usuario, $dato, false);
    //$sqlA[] = getSqlNewVentaentrega($idventa, $boleta, $fechareal, $hora, "N", $totalcaja, $totalbs, $totalpares, $totalsus, $flota, $guia, $responsable, "P", $observacion, $fechasalida, $fechallegada, $fechacancelacion, $idusuario, $dato, false);

    $sql1= "SELECT MAX(id) AS num FROM clientehistorial where idcliente='$idcliente'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $movanterior = $result['resultado'];
    //$sqlA[] =getSqlNewClientehistorial($id, $idcliente, 'venta', $idventa, $fechaventa, $hora, $boleta, $totalsus, $sussalida, $sussaldo, $totalpares, $paressalida, $paressaldo, $totalcaja, $cajasalida, 'ingreso', $movanterior, $detalle, $dato, false);
    $sqlA[] = "UPDATE traspaso SET codigo='$idventa' where idtraspaso='$idtraspaso';";

    ejecutarConsultaSQLBeginCommit($sqlA);
    //  $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
    //   $dev['error'] = "true";
    //  $dev['resultado'] = $idventa;
    $dev['idventa'] = $idventa;

    return $dev;
}

function buscarlistamodelomarcaventa($idventa,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    //echo $idventa;
    //String[] nombreCaso4Columns = {"idmodelo", "iditemventa","codigo", "cajas","preciosus",  "totalpares","totalsus"};

    $sqlmarca = "SELECT idmarca FROM ventas WHERE idventa = '$idventa'";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmarca");
    $idmarca = $opcionA1['resultado'];

    $sqlmarca = " SELECT mad.formatomayor FROM `marcas` mad WHERE mad.idmarca = '$idmarca' ";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA['resultado'];
    // SELECT mdd.idmodelo,dtp.iddetalleingreso,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo
    $select = "vi.idmodelo,vi.iditemventa,SUM(vi.cantidad)AS totalpares,(SUM(vi.cantidad)/12)AS cajas,vi.precioventa as preciosus,SUM(vi.precioventa * vi.cantidad) as totalsus";
    $from = " modelo mdd,ventaitem vi";
    $where = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' ";

    if($formatomayor=='1'){
        $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
        $from .= ",coleccion c";
        $where .= " and mdd.idcoleccion=c.idcoleccion";
    }else{
        $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
    }
    //    $select = "vi.idmodelo";
    //$from = "ventaitem vi";
    //$where = "idventa='$idventa' Group by vi.idmodelo";
    //
    // $select ="mo.idmodelo, mo.idmarca, mo.codigo ,dtp.iddetalleingreso,0 AS linea ,1 AS opciont, mo.numero, co.codigo AS coleccion,dtp.color,dtp.material, dtp.totalbs AS precio, dtp.totalpares, 1 AS totalcajas";
    //    $from = "`modelos` mo, `coleccion` co,`adiciondetalleingreso` dtp";
    //    $where = "mo.idmodelo=dtp.idmodelo AND mo.idcoleccion = co.idcoleccion AND dtp.unido='no' AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%'";

    //    echo $sql;
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by vi.idmodelo ".$order;
    //     echo $sql;
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
                                $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";
                                //   echo $sqld;
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        do{
                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));
                                    }
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
function BuscarDatosVenta($callback, $_dc, $idventadetalle, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $sql1= "SELECT idmarca FROM ventas where idventa='$idventadetalle'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];

    //$proveedores =  ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);
    $categoriasa =  Listarvendedoresmarca1('', '', '', '', '', '', $idalmacen,$idmarca, true);
    if($categoriasa['error'] == true)
    {
        $value['vendedores'] = "true";
        $value['vendedoresM'] = $categoriasa['resultado'];
    }

    $proveedores =  Listarcleintesalmacen('', '', '', '', '', '', $idalmacen, true);
    if($proveedores['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $proveedores['resultado'];
    }
    // s
    $sql = "SELECT '0' as tipopagocambio,'0' as fechalimite,v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,v.idvendedor,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
v.tipoventa,v.idcliente,v.tcajas as totalcajas,SUM(iv.cantidad) as totalpares,ROUND(SUM(iv.montoventafinal),2) as totalsus,v.descuento,v.tipocambio,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion as fechalimite,v.estado
FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado  and v.idalmacen='$idalmacen' and iv.idventa='$idventadetalle' group by iv.idventa order by v.fecha desc ,v.hora desc";


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

function BuscarDatosFactura($callback, $_dc, $idventadetalle, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
     $idusuariocaja = $_SESSION['idusuario'];
    $sql1= "SELECT idmarca FROM ventas where idventa='$idventadetalle'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];
    $sql1= "SELECT categoria FROM marcas where idmarca='$idmarca'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "categoria");
    $categoria = $result['resultado'];
    //     String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
    // String monto = Utils.getStringOfJSONObject(marcaO, "totalsus");
    //String cliente = Utils.getStringOfJSONObject(marcaO, "cliente");
    //   String marca = Utils.getStringOfJSONObject(marcaO, "marca");
    //   String tipocalzado = Utils.getStringOfJSONObject(marcaO, "tipocalzado");
    //      String idalmacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
    // String idusuario = Utils.getStringOfJSONObject(marcaO, "idusuario");

    //$proveedores =  ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);

    $sql = "SELECT v.idventa,v.hora,v.fecha,v.idalmacen,mar.nombre as marca,em.codigo as idusuario,'$idusuariocaja' as idusuariocaja, UPPER(cli.apellido) AS cliente,
SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,v.idalmacen,'$categoria' as tipocalzado,cli.nit
FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado  and v.idalmacen='$idalmacen' and iv.idventa='$idventadetalle' group by iv.idventa order by v.fecha desc ,v.hora desc";


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


function ListarDetalleProductosVenta($start, $limit, $sort, $dir, $callback, $_dc, $idventa, $return = false){

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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql3="SELECT idmarca FROM ventas WHERE idventa = '$idventa' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "idmarca");
    $idmarca = $result['resultado'];

    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $select = "vi.idventa,SUM(vi.cantidad)AS pares,(SUM(vi.cantidad)/12)AS cajas,vi.idmodelo,vi.precioventa,vi.total,mdd.precioventa as preciodocena,SUM(vi.cantidad*vi.precioventa)AS ventapar,SUM(vi.cantidad*vi.montoventafinal) as precioventafinal";
    $from = " modelo mdd,ventaitem vi";
    $where = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' ";

    if($formatomayor=='1'){
        $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
        $from .= ",coleccion c";
        $where .= " and mdd.idcoleccion=c.idcoleccion";
    }else{
        $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
    }
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
    //echo $sql2p1;
    //   echo $sql;

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
                            //echo " fi $fi[$i]";
                            if(mysql_field_name($re, $i) == "pares"){
                                $cantidad12 = $fi[$i];
                            }else{
                                if((mysql_field_name($re, $i) == "preciodocena")&&($cantidad12 == '12')){
                                    $preciod = $fi[$i];
                                }else{
                                    if((mysql_field_name($re, $i) == "ventapar")&&($cantidad12 == '12')){
                                        $value{$ii}{mysql_field_name($re, $i)}= $preciod;
                                    }
                                }
                            }
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                if($re1 = $link->consulta($sqld))
                                {
                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        do{
                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));
                                    }

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
function ListarParesmodelo($start, $limit, $sort, $dir, $callback, $_dc, $idmodelo, $return = false){

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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $select = "idkardexunico,idmodelo,codigobarra,saldocantidad,talla";
    $from = " kardexdetallepar";
    $where = "idmodelo='$idmodelo' ";


    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " ORDER BY idkardex,talla";
    // $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " ";

    //  echo $sql;

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

                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }

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

function BuscarVendedoresMarca($callback, $_dc,$idalmacen,$idmarca, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $ciudad =  Listarvendedoresmarca1('', '', '', '', '', '', $idalmacen,$idmarca, true);
    // $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar vendedores";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }


    if($ciudad["error"]==true){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
        // $value['empleadoM'] = $cliente['resultado'];
        $value["clienteM"] = $ciudad['resultado'];
        $dev["resultado"] = $value;
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
function Listarvendedoresmarca1($start, $limit, $sort, $dir, $callback, $_dc, $idalmacen,$idmarca, $return = false){

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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    //  echo $idempresa;

    $sql ="
SELECT
  cle.idempleado,

CONCAT( cle.nombres,'-',cle.apellidos) AS nombre

FROM
  empleados cle,empleadomarca em
WHERE
cle.idempleado=em.idempleado and cle.idalmacen='$idalmacen' and em.idmarca='$idmarca'

";



    //   echo $sql;
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
function Listarcleintesalmacen($start, $limit, $sort, $dir, $callback, $_dc, $idalmacen, $return = false){

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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    //  echo $idempresa;

    $sql ="
SELECT
  cle.idcliente,

CONCAT( cle.nombre,'-',cle.apellido) AS nombre

FROM
  clientes cle
WHERE
cle.idalmacen='$idalmacen'

";



    //    echo $sql;
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

function txSaveDevo($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;

    //  $boleta=$proforma->boleta;
    $boletaventa=$proforma->boletaventa;
    $fecha=$proforma->fecharegistro;
    $tipofalla=$proforma->tipofalla;
    $totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;
    $codigocliente = $proforma->cliente;
    $idempleado = $proforma->vendedor;
    $idvendedorregistro= $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $tipofalla = $proforma->tipofalla;
    $idmarca = $proforma->idmarca;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;
    $sql4 = "SELECT MAX(numerorecibo) AS ultimo FROM detalledevolucion where idalmacen='$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql4, true, true, "ultimo");
    $boleta = $result['resultado'] +1;

    $totalpares=COUNT($product);
    $cantidadminima = '1';
    if($totalpares < $cantidadminima){
        $dev['mensaje'] = "Debe devolver por lo menos un producto par";
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
        $sql1= "SELECT MAX(dato) AS num FROM devolucion";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $numeroventaj = $result['resultado'];
        $iddevolucion = $numeroventaj + 1;//estado = boleta
        $sql[] =getSqlNewDevolucion($iddevolucion, $idventadetalle, $idalmacen, $fecha, $hora, $totalpares, $totalsus, $idempleado, $idmarca, $codigocliente, $boleta, $idusuario, $iddevolucion,$observacion,false);
        $numeroD = findUltimoID("modelo", "numero", true);
        $numeromodelo = $numeroD['resultado'] +1;

        for($i=0;$i<count($product);$i++){
            $producto = $product[$i];

            $idkardexunico = $producto->idkardexunico;
            $iditemventa = $producto->iditemventa;
            $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
            $idmodelo = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
            $saldocantidad = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
            $talla = $cantidadventaA1['resultado'];
            $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
            $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idvendedor");
            $idvendedororigen= $saldocantidadA['resultado'];
            $sqlcol = "SELECT idkardex FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";
            $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardex");
            $idkardexgestionorigen = $opcionA['resultado'];
            $preciounitariokardex = $producto->preciou;
            $sql3 = " SELECT * FROM ventaitem WHERE iditemventa = '$iditemventa' and idkardexunico='$idkardexunico'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idventa");
            $idventa = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "valorcalzado");
            $valorcalzado = $cantidadventaA1['resultado'];
            $sql3 = " SELECT * FROM ventas WHERE idventa = '$idventa' ";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idcliente");
            $idcliente = $cantidadventaA1['resultado'];
            $cantidad = '1';

            $sql[] =getSqlNewDetalledevolucion($iddetalledevolucion, $idventa, $iditemventa, $idkardexunico, $idalmacen, $idusuario, $boleta, $fecha, $hora, $preciounitariokardex, $montodevuelto, $observacion, $saldocantidad, $tipodevolucion, $tipoventa, $idkardex, $tipofalla,$iddevolucion,false);
            if($idvendedororigen==$idempleado) {
                $sql[] = "UPDATE kardexdetallepar SET saldocantidad='1' where idkardexunico='$idkardexunico';";
            }else {
                $codigobarraA1 = registroparesdetallekardexcambio($formatomayor,$idtraspaso,$idkardexunico, $idmodelooriginal,$numerodetalle,$numeromodelo,$almacendestino,$idvendedorregistro,$tallakardex,true);
                $idmodelon = $codigobarraA1['idmodelonuevo'];
                $idkardexunicoold = $codigobarraA1['idkardexunico'];
                $esvalor = $codigobarraA1['tipovalor'];

                $numeromodelo ++;
                $numerodetalle++;
                if($esvalor=="existe" || $esvalor=='existe')
                {
                    $idmodelonuevo=$idmodelonuevo;
                    $sql[] = "UPDATE kardexdetallepar SET saldocantidad='1' where idkardexunico='$idkardexunico';";
                }else {
                    $sql[] = "UPDATE kardexdetallepar SET saldocantidad='1',idmodelo='$idmodelon' where idkardexunico='$idkardexunico';";
                }
            }
        }
    }

     MostrarConsulta($sql);
//    if(ejecutarConsultaSQLBeginCommit($sql))
//    {
//        $dev['mensaje'] = "Se registro correctamente";
//        $dev['error'] = "true";
//        $dev['resultado'] = "$iddevolucion";
//    }
//    else
//    {
//        $dev['mensaje'] = "Ocurrio un error en el registro";
//        $dev['error'] = "false";
//        $dev['resultado'] = "$iddevolucion";
//    }
//    if($return == true)
//    {
//        return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//    }
}

function txSaveDevoCobro($idmarca, $idempleado, $idcliente, $boleta, $tipofalla, $fecha, $totalpares, $totalsus, $observacion, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    if($totalpares==0){
        $dev['mensaje'] = "Debe devolver por lo menos un producto par" + totalpares;
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else{
        $dev['mensaje'] = "Entra al proceso";
        $sql1 = "SELECT idcredito, saldoact, pardev, susdev FROM creditomayor where idmarca = '$idmarca' AND idvendedor = '$idempleado'
                AND idcliente = '$idcliente' AND idalmacen = '$idalmacen' AND estadomes = 'activo'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
        $idcreditomay = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql1, true, true, "saldoact");
        $saldoactmay = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql1, true, true, "pardev");
        $pardevmay = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql1, true, true, "susdev");
        $susdevmay = $result['resultado'];
        $dev['resultado'] = "$saldoactmay";
        if($saldoactmay<$totalsus){
            $dev['mensaje'] = "No existe un registro con importe mayor a la devolucion";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
        else{
            $sql1 = "SELECT idcrecliente, idventa, porpagar, pardev, susdev FROM creditocliente where idmarca = '$idmarca' AND idvendedor = '$idempleado'
                    AND idcliente = '$idcliente' AND idalmacen = '$idalmacen' AND porpagar >= '$totalsus' AND estado = 'pendiente'";
            $sql12 = getTablaToArrayOfSQL($sql);
            $sql13 = $sql12['resultado'];
            $row1 = NumeroTuplas($sql1);
            $row12= $row1['resultado'];
            for($i=0;$i<=$row12;$i++){
                $codigo = $sql13[$i];
                $idcreclientecre = $codigo['idcrecliente'];
                $idventacre = $codigo['idventa'];
                $porpagarcre = $codigo['porpagar'];
                $pardevcre = $codigo['pardev'];
                $susdevcre = $codigo['susdev'];
                $i = $row12;
            }
            $pardevtotal = $pardevcre + $totalpares;
            $susdevtotal = $susdevcre + $totalsus;
            $porpagartotal = $porpagar - $totalsus;
            $sql[] = "UPDATE creditocliente SET porpagar = '$porpagartotal', pardev = '$pardevtotal', susdev = '$susdevtotal' WHERE idcrecliente = '$idcreclientecre'
                     AND idcliente = '$idcliente' AND idalmacen = '$idalmacen' AND estado = 'pendiente';";

            $pardevtotal = $pardevmay + $totalpares;
            $susdevtotal = $susdevmay + $totalsus;
            $saldoacttotal = $saldoactmay - $totalsus;
            $sql[] = "UPDATE creditomayor SET saldoact = '$saldoacttotal', pardev = '$pardevtotal', susdev = '$susdevtotal' WHERE idcredito = '$idcreditomay'
                     AND idcliente = '$idcliente' AND idalmacen = '$idalmacen' AND estadomes = 'activo';";

            $sql1 = "SELECT MAX(dato) AS num FROM devolucion";
            $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
            $numeroventaj = $result['resultado'];
            $iddevolucion = $numeroventaj + 1;

            $sql[] =getSqlNewCreditodevolucion($idcreclientecre, $idventacre, $iddevolucion, $fecha, $hora, $idmarca, $idvendedor, $totalsus, $totalpares, 'activo', $observacion, 'SinFactura', 3, false);
            MostrarConsulta($sql);

            if(ejecutarConsultaSQLBeginCommit($sql))
            {
                $dev['mensaje'] = "Se registro correctamente";
                $dev['error'] = "true";
                $dev['resultado'] = "$iddevolucion";
            }
            else
            {
                $dev['mensaje'] = "Ocurrio un error en el registro";
                $dev['error'] = "false";
                $dev['resultado'] = "$iddevolucion";
            }
        }
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

function registroparesdetallekardexcambio($formatomayor,$idtraspaso,$idkardexunico, $idmodelo,$numerodetalle,$numeromodelo,$almacendestino,$vendedordestino,$tallakardex, $return){


    $emitida="1";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    //echo $mesplanilla;
    $idalmacen=$_SESSION['idalmacen'];
    $idmodelonuevo = "m-".$numeromodelo;
    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];
    //echo $idmodelo;
    $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idingreso");
    $idingreso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cliente");
    $cliente = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcliente");
    $idcliente = $saldocantidadA['resultado'];


    $tipo="";

    //echo $sql12;
    if($estadotraspaso!="ninguno" || $estadotraspaso!='ninguno')
    {
        //hasta aqui por si falla
        $idmodelonuevo=$estadotraspaso;
        $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";

    }
    else{
        //unction getSqlNewModelo($idmodelo, $idmodelodetalle, $idmarca, $idvendedor, $codigo, $color, $material, $linea, $cliente, $numero, $idingreso, $fecha, $hora, $generado, $opciont, $unido, $inventario, $rebaja, $estado, $idcoleccion, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $modificar, $talla, $idalmacen, $estadotraspaso, $fechaingreso, $return){

        $sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $cliente, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $idalmacen, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $idalmacen, "ninguno", $fechaingreso, false);
        $numeromodelo++;

        $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
        $tipo="noexiste";
    }

    $sql[] = "UPDATE kardexdetallepar SET idmodelo='$idmodelonuevo' where idkardexunico='$idkardexunico';";
    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
    MostrarConsulta($sql);
//    if(ejecutarConsultaSQLBeginCommit($sql)){
//        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
//        $dev['error'] = "true";
//        $dev['resultado'] = $idmodelonuevo;
//        $dev['idmodelonuevo'] = $idmodelonuevo;
//        $dev['idmodeloantiguo'] = $idmodelo;
//        $dev['idkardexunico'] = $idkardexunico;
//        $dev['tipovalor'] = $tipo;
//    }
//    else
//    {
//        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
//        $dev['error'] = "false";
//        $dev['resultado'] = $idventadetalle;
//    }
//    if($return == true)
//    {   return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//    }
//    return $dev;
}

function finalizandoinsercionventa($idventa,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE concurrenciaventa SET estado='libre',idventa='$idventa' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function iniciandoinsercionventa($idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $sql[] = "UPDATE concurrenciaventa SET estado='ocupado',idalmacen='$idalmacen' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}

function GuardarNuevoVentaCompleta($resultado,$return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $fechaventa= date("Y-m-d");
    $idalmacen = $_SESSION['idalmacen'];

    iniciandoinsercionventa($idalmacen,true);
    $numeroA = findUltimoID("ingresoalmacen", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idingreso="ing-".$numero;
    $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    $idalmacen = $_SESSION['idalmacen'];
    $idempleado = $ingreso->idvendedor;
    $idcliente = $ingreso->idcliente;
    $boletamanual = $ingreso->boletamanual;
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $fechareal = date("Y-m-d");
    $fecha = $ingreso->fecha;
    $usuario = $_SESSION['idusuario'];
    $idalmacenorigen = $_SESSION['idalmacen'];
    $fechareal = Date("Y-m-d");
    $sql1= "SELECT MAX(idventa) AS num FROM ventas";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj = $result['resultado'];
    $idventa = $numeroventaj + 1;
    $sql12= "SELECT MAX(boleta) AS numb FROM ventas where idalmacen='$idalmacen'";
    $resultw = findBySqlReturnCampoUnique($sql12, true, true, "numb");
    $numeroventajw = $resultw['resultado'];
    $boleta = $numeroventajw + 1;
    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;

    //para credito
    $arqueo="0";
    //$clienteitem
    $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $periodo = $result['resultado'];
    $totalbs ="0";
    $sql[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $clienteitem, $fecha, $hora, "CREDITO", $totalcaja, $totalbs, "0", "0", "0", $descuento, $totalsus, "0", "0", "0", "0","0", "0", "N", $observacion, $fechacancelacion, "PENDIENTE", $usuario, $dato, false);
    //$sql[] = getSqlNewVentaentrega($idventa, $boleta, $fechareal, $hora, "N", $totalcaja, $totalbs, $totalpares, $totalsus, $flota, $guia, $responsable, "P", $observacion, $fechasalida, $fechallegada, $fechacancelacion, $idusuario, $dato, false);

    $sql1= "SELECT MAX(id) AS num FROM clientehistorial where idcliente='$idcliente'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $movanterior = $result['resultado'];
    //$sql[] =getSqlNewClientehistorial($id, $idcliente, 'venta', $idventa, $fechaventa, $hora, $boleta, $totalsus, $sussalida, $sussaldo, $totalpares, $paressalida, $paressaldo, $totalcaja, $cajasalida, 'ingreso', $movanterior, $detalle, $dato, false);

    $calzados = $resultado->calzados;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $idmodelo = $calzado->idmodelo;
        $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
        $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
        $idmodelodetalle = $saldocantidadA['resultado'];

        $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $numeroventaj1 = $result['resultado'];
        $iditemventa = $numeroventaj1 ;
        registraritemventa($iditemventa,$idmodelo,$idventa,$idempleado,$idcliente,false);
        $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
        $idvendedororigen = $cantidadventaA1['resultado'];
        $sql[] = "UPDATE modelo SET idvendedor='$idempleado' where idmodelo='$idmodelo';";

    }
    $sql[] = "UPDATE ventas SET boletamanual='$boletamanual' where idventa='$idventa';";

    MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){
       recalculatotales($idventa,false);
        finalizandoinsercionventa($idventa,true);
        $dev['mensaje'] = "Se registro la venta correctamente.";
        $dev['error'] = "true";
        $dev['resultado'] = "$idventa";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = "$idventa";
         finalizandoyhabilitando("venta",$idventa,true);
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
function registraritemventacaja($iditemventa,$idkardexcaja,$idmodelo,$idventa,$idempleado,$idcliente,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $sql31 = " SELECT idmodelo FROM kardexdetallepar WHERE idkardex='$idkardexcaja' AND idmodelo='$idmodelo' group by idkardex";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];

    $sql ="
SELECT idkardexunico
FROM kardexdetallepar
WHERE idkardex='$idkardexcaja' AND idmodelo='$idmodelo' and saldocantidad='1';
";
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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "idkardexunico";
                            $idkardexunico = $fi[$i];
                            //         echo $idplanillaemitida;
                            $iditemventa =$iditemventa+1;
                            insertarparesventa($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,false);

                        }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            // print($output);
        }


    }

}
function registraritemventa($iditemventa,$idmodelo,$idventa,$idempleado,$idcliente,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //   echo $mesplanilla;
    //agrupar solo primera caja
    $sql3 = " SELECT Min(idkardexunico) as num FROM kardexdetallepar WHERE idmodelo = '$idmodelo' and saldocantidad!='0' group by idmodelo";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunico = $cantidadventaA1['resultado'];

    $sql31 = " SELECT idkardex FROM kardexdetallepar WHERE idmodelo = '$idmodelo' and idkardexunico='$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idkardex");
    $idkardex = $cantidadventaA1['resultado'];
    //$sql ="
    //SELECT idkardexunico
    //FROM kardexdetallepar
    //WHERE idmodelo = '$idmodelo';
    //";
    $sql ="
SELECT idkardexunico
FROM kardexdetallepar
WHERE idmodelo = '$idmodelo' and idkardex='$idkardex' and saldocantidad='1';
";
    //WHERE idempresa = '$idempresa' AND idclienteempresa='$idclienteempresa'AND no_planilla !='$no_planillaactual' AND no_planilla ='$no_planillaanterior' AND emitido='1' AND unido='0';

    //echo $sql;
    //  echo $idplanillas;
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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "idkardexunico";
                            $idkardexunico = $fi[$i];
                            //         echo $idplanillaemitida;
                            $iditemventa =$iditemventa+1;
                            insertarparesventa($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,false);

                        }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            // print($output);
        }


    }

}
function insertarparesventa($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,$return){
    set_time_limit(0);
    $fechaventa = Date("Y-m-d");
    $idalmacen =$_SESSION['idalmacen'];
    $emitido="1";
    //echo $mesplanilla;
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");

    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
    $saldocantidad = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
    $talla = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
    $idkardex = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
    $preciounitario = $cantidadventaA1['resultado'];

    $cantidad = '1';

    $sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
    $totalcajaprecio = $cantidadventaA1['resultado'];
    $sqlA[] =getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciounitario, $preciounitario, "0", "0", $totalcajaprecio, "P", $devolucion, $tipomuestra, $diferencia,$preciounitario,false);
    //para traspasos
    $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
    $idvendedororigen = $cantidadventaA1['resultado'];

    if($idempleado==$idvendedororigen){
    }else{
        //insertar como traspaso interno
        $sqlA[] =getSqlNewTraspasosinternos($numero, $fechaventa, $idkardexunico, $idkardex, $idventa, $idempleado, $idmodelo, $cantidad, $talla, $preciounitario, $idalmacen, $idvendedororigen,false);
    }
    //fin traspasos
    actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);
//MostrarConsulta($sqlA);
    if(ejecutarConsultaSQLBeginCommit($sqlA))
    {
        $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = "$iditemventa";
    }
    else
    {
        $dev['mensaje'] = "";
        $dev['error'] = "false";
        $dev['resultado'] = "$iditemventa";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        // print($output);
    }
}

function txSaveVenta($resultado, $return)
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
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;

    $codigocliente = $proforma->cliente;
    $idempleado = $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;

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
       $codigobarraA1 = registrarventaid($idventa, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $fechaventa, $hora, $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $fechacancelacion,true);
                           $idventa = $codigobarraA1['idventa'];

      // $sql[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $clienteitem, $fechaventa, $hora, "CREDITO", $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $arqueo, "N", $observacion, $fechacancelacion, "PENDIENTE", $idusuario, $dato, false);

        $sql1= "SELECT MAX(id) AS num FROM clientehistorial where idcliente='$idcliente'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $movanterior = $result['resultado'];

        $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $numeroventaj1 = $result['resultado'];
        $iditemventa = $numeroventaj1 ;

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
            $preciounitario = $producto->preciou;
            $cantidad = '1';
            //para traspasos
            $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
            $idvendedororigen = $cantidadventaA1['resultado'];

            if($idempleado==$idvendedororigen){
            }else{
                //insertar como traspaso interno
                $sql[] =getSqlNewTraspasosinternos($numero, $fechaventa, $idkardexunico, $idkardex, $idventa, $idempleado, $idmodelo, $cantidad, $talla, $preciounitario, $idalmacen, $idvendedororigen,false);
            }
            //fin traspasos
            $sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
            $totalcajaprecio = $cantidadventaA1['resultado'];


            $sql[] =getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciounitario, $preciounitario, "0", "0", $totalcajaprecio, "P", $devolucion, $tipomuestra, $diferencia,$preciounitario,false);
            if($idcliente=="cli-1239" || $idcliente=='cli-1239'){
                $sql[] = "UPDATE kardexdetallepar SET idalmacen='alm-10',saldocantidad='1' where idkardexunico='$idkardexunico' and idmodelo='$idmodelo';";
                $sql[] = "UPDATE modelo SET idalmacen='alm-10',idvendedor='emp-73' where idmodelo='$idmodelo';";
            }

            $sqlcol = "SELECT idkardex FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";
            $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardex");
            $idkardexgestionorigen = $opcionA['resultado'];
            $sql[] = "UPDATE historialkardex SET venta='1',saldocantidad='0'
 where idkardexunico='$idkardexunico' and idkardex='$idkardexgestionorigen';";

            actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);
        }
        $sql[] = "UPDATE ventas SET boletamanual='$boletamanual' where idventa='$idventa';";

    }
    //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {    finalizandoinsercionventa($idventa,true);
        recalculatotales($idventa,false);
        $dev['mensaje'] = "Se guardo la venta correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idventa";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idventa";
          finalizandoyhabilitando("venta",$idventa,true);
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
function registrarventaid($idventa, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $fechaventa, $hora, $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $fechacancelacion, $return){
// $codigobarraA1 = registrarventaid($idventa, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $fechaventa, $hora, $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $fechacancelacion,true);
 //                          $idventa = $codigobarraA1['idventa'];
 $emitida="1";
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
 $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
  $sql[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $clienteitem, $fechaventa, $hora, "CREDITO", $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, "0", "N", "NORMAL", $fechacancelacion, "PENDIENTE", $idusuario, $dato, false);



//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
         $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idventa;
          $dev['idventa'] = $idventa;

    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = $idventa;

    }
    if($return == true)
    {   return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
    return $dev;
}
function UsuarioValidar($idusuario, $password, $idalmacen, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $pass = md5($password);

    $sql = "SELECT u.idusuario, u.login,u.estado,u.paswd FROM usuario u WHERE u.login = '$idusuario' AND u.paswd = '$pass'";
    //echo $sql;
    $link = new BD;
    $link->conectar();
    if($re = $link->consulta($sql))
    {
        if($fi = mysql_fetch_array($re))
        {
            if($idusuario == $fi['login'])
            {
                if($fi['estado'] == 'Activo')
                {
                    $dev['mensaje'] = "SE valido correctamente al usuario";
                    $dev['error'] = "true";
                }
                else
                {
                    $dev['mensaje'] = "Este usuario no esta activo";
                    $dev['error'] = "false";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe el usuario";
                $dev['error'] = "false";
            }
        }
        else
        {
            $dev['mensaje'] = "No existe este usuario";
            $dev['error'] = "false";
        }
    }
    else
    {
        $dev['mensaje'] = "Error al validar el usuario";
        $dev['error'] = "false";
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
function UsuarioValidarInventario($idusuario, $password, $idalmacen, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $pass = md5($password);

    $sql = "SELECT u.idusuario, u.login,u.estado,u.paswd FROM usuario u WHERE u.login = '$idusuario' AND u.paswd = '$pass' AND u.idalmacen = '$idalmacen'";
    //echo $sql;
    $link = new BD;
    $link->conectar();
    if($re = $link->consulta($sql))
    {
        if($fi = mysql_fetch_array($re))
        {
            if($idusuario == $fi['login'])
            {
                if($fi['estado'] == 'Activo')
                {
                    $dev['mensaje'] = "SE valido correctamente al usuario";
                    $dev['error'] = "true";
                }
                else
                {
                    $dev['mensaje'] = "Este usuario no esta activo";
                    $dev['error'] = "false";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe el usuario";
                $dev['error'] = "false";
            }
        }
        else
        {
            $dev['mensaje'] = "No existe este usuario";
            $dev['error'] = "false";
        }
    }
    else
    {
        $dev['mensaje'] = "Error al validar el usuario";
        $dev['error'] = "false";
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

function txSaveestado($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $estado = $resultado->estado;
 $fecha = date("Y-m-d");
$sql1= "SELECT * FROM concurrenciaventa";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idventa");
        $idventa = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idalmacen");
        $idalmacen = $result['resultado'];
  $sql[] =getSqlNewBitacoraforzar($idusuario, $fecha, $hora, "venta", $idventa, $idalmacen,false);

 $sql[] = "UPDATE concurrenciaventa SET estado='libre' ;";

    // actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);




    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se habilito correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "estado";
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

function txSaveestadotraspaso($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $estado = $resultado->estado;
 $fecha = date("Y-m-d");
$sql1= "SELECT * FROM concurrenciatraspaso";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idventa");
        $idventa = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idalmacen");
        $idalmacen = $result['resultado'];
  $sql[] =getSqlNewBitacoraforzar($idusuario, $fecha, $hora, "traspaso", $idventa, $idalmacen,false);


  $sql[] = "UPDATE concurrenciatraspaso SET estado='libre' ;";
    // MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se habilito correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "estado";
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
function txSaveestado1($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $estado = $resultado->estado;


    //$clienteitem
 $sql1= "SELECT * FROM concurrencia";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idalmacen");
        $idalmacen= $result['resultado'];
  $sql[] =getSqlNewBitacoraforzar($idusuario, $fecha, $hora, "registro", "-", $idalmacen,false);

    $sql[] = "UPDATE concurrencia SET estado='libre' ;";


    // actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);




    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se habilito correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "estado";
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

function txSaveVentaCaja($resultado, $return)
{  $idalmacen =$_SESSION['idalmacen'];
    iniciandoinsercionventa($idalmacen,true);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;
    $idmarca= $proforma->idmarca;
    $boletanuevo=$proforma->boleta;
    $boletamanual=$proforma->boletamanual;
    $fechaventa=$proforma->fecharegistro;
    $totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;

    $codigocliente = $proforma->cliente;
    $idempleado = $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;

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

        //para credito
        $arqueo="0";
        //$clienteitem
        $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
        $periodo = $result['resultado'];
//        $sql[] =getSqlNewVentas($idventa, $idalmacen, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $clienteitem, $fechaventa, $hora, "CREDITO", $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $arqueo, "N", $observacion, $fechacancelacion, "PENDIENTE", $idusuario, $dato, false);
 $codigobarraA1 = registrarventaid($idventa, $idempleado, $idmarca,$periodo, $boleta, $idcliente, $fechaventa, $hora, $totalcaja, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $totalsus, $montocanceladosus, $ingresoventasus, $montopagado, $totalsus,$tipocambio, $fechacancelacion,true);
                           $idventa = $codigobarraA1['idventa'];

        $sql1= "SELECT MAX(id) AS num FROM clientehistorial where idcliente='$idcliente'";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $movanterior = $result['resultado'];
        //$sql[] =getSqlNewClientehistorial($id, $idcliente, 'venta', $idventa, $fechaventa, $hora, $boleta, $totalsus, $sussalida, $sussaldo, $totalpares, $paressalida, $paressaldo, $totalcaja, $cajasalida, 'ingreso', $movanterior, $detalle, $dato, false);
        //  $numerokardexA = findUltimoID("itemventa", "iditemventa", true);
        //    $iditemventa = $numerokardexA['resultado']+1;
        $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
        $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        $numeroventaj1 = $result['resultado'];
        $iditemventa = $numeroventaj1 ;

        for($i=0;$i<count($product);$i++){
            $producto = $product[$i];
            $iditemventa = $iditemventa + 1 ;
            //
            $idkardexcaja = $producto->idkardexunico;
            $idmodelo = $producto->idmodelo;
            $preciounitario = $producto->preciou;
            $cantidad = '1';

            $sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
            $totalcajaprecio = $cantidadventaA1['resultado'];

            $sql1= "SELECT MAX(iditemventa) AS num FROM ventaitem";
            $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
            $numeroventaj1 = $result['resultado'];
            $iditemventa = $numeroventaj1 ;
            registraritemventacaja($iditemventa,$idkardexcaja,$idmodelo,$idventa,$idempleado,$idcliente,false);
            if($idcliente=="cli-1239" || $idcliente=='cli-1239'){
                registrarcajaparacatalogos($iditemventa,$idkardexcaja,$idventa,$idempleado,$idcliente,false);
            }else{
            }
        }
        //$sql[] = "UPDATE creditocliente SET boletamanual='$boletamanual'where idventa='$idventa';";
        $sql[] = "UPDATE ventas SET boletamanual='$boletamanual' where idventa='$idventa';";
    }

    //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        finalizandoinsercionventa($idventa,true);
        recalculatotales($idventa,false);

        $dev['mensaje'] = "Se guardo la venta correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idventa";
    }
    else
    {
        // eliminarfallaventa($idventa,false);
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idventa";
          finalizandoyhabilitando("venta",$idventa,true);
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

function eliminarfallaventa($idventa,$return = false){
 set_time_limit(0);
$idalmacen =$_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

// $sql ="
//SELECT tr.idmodelo
//FROM traspasodetallepar tr,traspaso t
//WHERE tr.iddetalletraspaso=t.idtraspaso and tr.iddetalletraspaso='$idtraspaso' and t.idalmacen='$idalmacen' group by tr.idmodelo ;
//";

     $sql ="
SELECT vi.idkardexunico
FROM ventaitem vi ,ventas v WHERE vi.idventa=v.idventa and vi.idventa='$idventa' and v.idalmacen='$idalmacen' ;
";

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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "idkardexunico";
                                $idkardexunico = $fi[$i];
                       //         echo $idplanillaemitida;
             $iditemventa =$iditemventa+1;

                 insertarparesfallaanulacionventa($idkardexunico,$idventa,$idalmacen,false);


               }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}

function insertarparesfallaanulacionventa($idkardexunico,$idventa,$idalmacen,$return){
    set_time_limit(0);

$emitido="1";
//echo $mesplanilla;
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");

//$sqlA[] = "UPDATE kardexdetallepar kp,ventaitem tr SET kp.idmodelo='$idmodeloorigen',kp.idalmacen='$idalmacen' where kp.idkardexunico=tr.idkardexunico and kp.idmodelo='$idmodelo' and tr.iddetalletraspaso='$idtraspaso' ;";
//$sqlA[] ="DELETE FROM ventaitem WHERE idmodelo='$idmodelo' and iddetalletraspaso='$idtraspaso';";
//$sqlA[] = "UPDATE traspaso SET estado='ANULADO',completo='$idusuario' WHERE idtraspaso = '$idtraspaso' ;";

             //MostrarConsulta($sql);
             ejecutarConsultaSQLBeginCommit($sqlA);

}


function registrarcajaparacatalogos($iditemventa,$idkardexcaja,$idventa,$idempleado,$idcliente,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $sql31 = " SELECT idmodelo FROM kardexdetallepar WHERE idkardex='$idkardexcaja' group by idkardex";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];

    // $sql ="
    //SELECT idkardexunico
    //FROM kardexdetallepar
    //WHERE idkardex='$idkardexcaja' and saldocantidad='1';
    //";
    $sql ="
SELECT kp.idkardexunico
FROM kardexdetallepar kp,ventaitem v
WHERE kp.idkardex='$idkardexcaja' AND kp.idkardexunico=v.idkardexunico and v.idventa='$idventa';
";
    //echo $sql;
    //  echo $idplanillas;
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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "idkardexunico";
                            $idkardexunico = $fi[$i];
                            //         echo $idplanillaemitida;
                            $iditemventa =$iditemventa+1;
                            insertaencatalogos($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,false);

                        }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            // print($output);
        }


    }

}

function insertaencatalogos($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,$return){
    set_time_limit(0);

    $emitido="1";
    //echo $mesplanilla;
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");

    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];

    $cantidad = '1';

    $sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
    $totalcajaprecio = $cantidadventaA1['resultado'];

    $sqlA[] = "UPDATE kardexdetallepar SET idalmacen='alm-10',saldocantidad='1' where idkardexunico='$idkardexunico' and idmodelo='$idmodelo';";
    $sqlA[] = "UPDATE modelo SET idalmacen='alm-10',idvendedor='emp-73' where idmodelo='$idmodelo';";


    if(ejecutarConsultaSQLBeginCommit($sqlA))
    {
        $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = "$iditemventa";
    }
    else
    {
        $dev['mensaje'] = "";
        $dev['error'] = "false";
        $dev['resultado'] = "$iditemventa";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        // print($output);
    }
}

function txSaveVentaConfirmada($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;
    $idventa= $proforma->idventa;
    $montototal=$proforma->montototal;

    $fechareal = date("Y-m-d");
    $product = $resultado->productos;


    $boleta = $numeroventajw + 1;
    $totalpares=COUNT($product);
    $cantidadminima = '1';
    $sql1= "SELECT * FROM ventas where idventa = '$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "totalsus");
    $totalant = $result['resultado'];
    $diferencia =$totalant - $montototal;

    //$sql[] = "UPDATE ventas SET totalsus = '$montototal' ,descuento ='$diferencia' WHERE idventa = '$idventa'";

    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
        $idmodelo = $producto->idmodelo;
        $precioventa = $producto->ventapar;
        $precioventamayor = $producto->precioventa;
        $precioventafinal = $producto->ventapar;
        $paresventa= $producto->pares;
        $sql3 = " SELECT precioventa FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
        $precioanterior = $cantidadventaA1['resultado'];
        $nuevoprecio =$precioventa/$paresventa;
        $diferenciapar =($precioanterior-$precioventa) /$paresventa;
        $cantidad = '1';
        if($nuevoprecio=='0' || $nuevoprecio ==0){
            $nuevoprecio = $precioanterior;
        }
        else
        {$nuevoprecio = $nuevoprecio;
        }

        $sql[] = "UPDATE ventaitem SET montoventafinal='$nuevoprecio',descuento='$diferenciapar' where idmodelo = '$idmodelo' and idventa='$idventa';";
        $sql31 = " SELECT * FROM ventas WHERE idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "fecha");
        $fecha = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmarca");
        $idmarca = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idvendedor");
        $idvendedor= $cantidadventaA1['resultado'];
        $sql31 = " SELECT SUM(cantidad) as pares FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "pares");
        $pares = $cantidadventaA1['resultado'];
        $precioventafinal = $precioventafinal;
        $precioventamayorcaja = $precioventamayor*$pares;
        $diferencia =$precioventafinal-$precioventamayorcaja;
        //$diferenciadato

        //$sql[] = getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayorcaja, $diferencia, $diferenciadato, false);

        $sql31 = " SELECT idmodelo FROM ventafinalmodelo WHERE idventa='$idventa' and idmodelo='$idmodelo'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
        $modelofinal = $cantidadventaA1['resultado'];
        if($modelofinal!=null){
            $sql[] = "UPDATE ventafinalmodelo SET precioventafinal='$precioventafinal',diferencia='$diferencia' where idmodelo='$idmodelo' and idventa='$idventa';";

        }else{
            $sql[] = getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayorcaja, $diferencia, $diferenciadato, false);

            //   $sql[] = getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayorcaja, $diferencia, $diferenciadato, false);
        }


        //$sql[] = getSqlNewVentapago($idventa, $fechareal, $hora, "CR", $montoapagar, $montocancelado, $factura, $reciboefectivo, $responsable, $estado, $observacion, false);

        actualizarSaldoMovimientotienda($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);

    }
    totalventa($idventa, false);
    //   }
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        recalculatotales($idventa,false);
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

function recalculatotales($idventa ,$return = false ){

    $sql3 = " SELECT COUNT(iditemventa)as pares FROM ventaitem WHERE idventa = '$idventa'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "pares");
    $pares = $cantidadventaA1['resultado'];
    $sql3 = " SELECT SUM(montoventafinal)as bs FROM ventaitem WHERE idventa = '$idventa'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "bs");
    $montosus = $cantidadventaA1['resultado'];
    $cajas =$pares/12;
    $sql3 = "SELECT SUM(precioventafinal) as total FROM ventafinalmodelo WHERE idventa = '$idventa' ";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
    $totalNeto = $idalmacenA2['resultado'];
    $totalNeto = round($totalNeto,2);


    $sqlA[] = "UPDATE ventas SET tcajas = '$cajas',totalbs='$montosus',totalpares='$pares',totalsus='$montosus',montoapagar='$montosus',saldo='$montosus' WHERE idventa = '$idventa';";

    ejecutarConsultaSQLBeginCommit($sqlA);
}
function txSavePares($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;
    $idmodelo= $proforma->idmodelo;
    //$montototal=$proforma->montototal;

    $fechareal = date("Y-m-d");
    $product = $resultado->productos;


    $boleta = $numeroventajw + 1;
    $totalpares=COUNT($product);
    $cantidadminima = '1';


    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];


        $idkardexunico = $producto->idkardexunico;
        $saldocantidad = $producto->saldocantidad;
        $talla = $producto->talla;
  if($saldocantidad >'1' || $saldocantidad>"1"){
        $cantidadmodelo = 0;
      $dev['mensaje'] = "Error la cantidad de edicion solo puede ser 1, no mayor por favor revise";
        $dev['error']   = "false";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }else{
        //validar estado del modelo
              $sql[] = "UPDATE kardexdetallepar set saldocantidad='$saldocantidad' where idmodelo = '$idmodelo' and idkardexunico='$idkardexunico';";

    }
      //fin saldocantidad   }
    }
    //   }

   //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se registro correctamente";
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

function ActualizarVentaModificada($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;

    $idventa= $proforma->idventa;
    $idvendedor=$proforma->idempresa;
    $idcliente=$proforma->idcliente;
    $sus=$proforma->sus;
    $cajas=$proforma->cajas;
    $pares=$proforma->pares;
    $fechareal = date("Y-m-d");
    $product = $resultado->calzados;

    $sql[] = "UPDATE ventas SET idcliente = '$idcliente' ,idvendedor='$idvendedor',tcajas='$cajas',totalpares='$pares',totalsus='$sus',montoapagar='$sus',saldo='$sus' WHERE idventa = '$idventa'";

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];

        //
        $idmodelo = $producto->idmodelo;
 $sql3 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
    $idvendedororigen = $cantidadventaA1['resultado'];
     //   $sql[] = "UPDATE modelo SET talla='-' where idmodelo='$idmodelo';";
     $sql312 = " SELECT * FROM ventas WHERE idventa='$idventa'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql312, true, true, "fecha");
    $fechaventa = $cantidadventaA1['resultado'];
      $cantidadventaA1 = findBySqlReturnCampoUnique($sql312, true, true, "idalmacen");
    $idalmacen = $cantidadventaA1['resultado'];

    $sql31 = " SELECT * FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa' group by idmodelo";
     $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "precioventa");
     $preciounitario = $cantidadventaA1['resultado'];
//ojo modificar venta
  $sql3 = " SELECT Min(idkardexunico) as num FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunico = $cantidadventaA1['resultado'];
    $sql312 = " SELECT SUM(cantidad) as pares FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql312, true, true, "pares");
    $cantidad = $cantidadventaA1['resultado'];
//echo $sql312;

 if($idvendedor==$idvendedororigen){
    }else{
        //insertar como traspaso interno
        $sql[] =getSqlNewTraspasosinternos($numero, $fechaventa, $idkardexunico, $idkardex, $idventa, $idvendedor, $idmodelo, $cantidad, "0", $preciounitario, $idalmacen, $idvendedororigen,false);
    }

}

  //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

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


function EditarVentaPrecio($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $proforma = $resultado->venta;

    $idventa= $proforma->idventa;

    $fechareal = date("Y-m-d");
    $product = $resultado->productos;
    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
        $idmodelo = $producto->idmodelo;
        $idventa = $producto->idventa;
        $precioventafinal = $producto->precioventafinal;
        $sql3 = " SELECT COUNT(iditemventa) as totalpares FROM ventaitem WHERE idmodelo='$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalpares");
        $paressum = $cantidadventaA1['resultado'];
        $precionuevo = $precioventafinal/$paressum;

        $sql[] = "UPDATE ventaitem SET montoventafinal='$precionuevo' where idmodelo='$idmodelo' and idventa='$idventa';";
        $sql3 = " SELECT precioventa FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
        $precioanterior = $cantidadventaA1['resultado'];

        $nuevoprecio =$precioventafinal/$paressum;
        $diferenciapar =($precioanterior-$precioventafinal) /$paressum;
        $cantidad = '1';
        if($nuevoprecio=='0' || $nuevoprecio ==0){
            $nuevoprecio = $precioanterior;
        }
        else
        {$nuevoprecio = $nuevoprecio;
        }

        $sql[] = "UPDATE ventaitem SET montoventafinal='$nuevoprecio',descuento='$diferenciapar' where idmodelo = '$idmodelo' and idventa='$idventa';";
        $sql31 = " SELECT * FROM ventas WHERE idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "fecha");
        $fecha = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmarca");
        $idmarca = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idvendedor");
        $idvendedor= $cantidadventaA1['resultado'];
        $sql3 = " SELECT SUM(preciofinal) as monto FROM ventaitem WHERE idmodelo='$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "monto");
        $precioventamayor = $cantidadventaA1['resultado'];

        $sql31 = " SELECT SUM(cantidad) as pares FROM ventaitem WHERE idmodelo = '$idmodelo' and idventa='$idventa'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "pares");
        $pares = $cantidadventaA1['resultado'];
        $precioventafinal = $precioventafinal;
        $precioventamayorcaja = $precioventamayor;
        $diferencia =$precioventafinal-$precioventamayorcaja;
        //$diferenciadato
        //$sql[] = getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayorcaja, $diferencia, $diferenciadato, false);
        $sql31 = " SELECT idmodelo FROM ventafinalmodelo WHERE idventa='$idventa' and idmodelo='$idmodelo'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
        $modelofinal = $cantidadventaA1['resultado'];
        if($modelofinal!=null){
            $sql[] = "UPDATE ventafinalmodelo SET precioventafinal='$precioventafinal',diferencia='$diferencia' where idmodelo='$idmodelo' and idventa='$idventa';";

        }else{
            $sql[] = getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayorcaja, $diferencia, $diferenciadato, false);
        }


    }

    totalventa($idventa, false);
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        recalculatotales($idventa,false);
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
function actualizarSaldoMovimientotienda($idkardexunico,$idmodelo, $idkardex,$fecha,$hora = '00:00:01' ,$return = false ){

    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
    $idmodelo = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
    $idkardex = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
    $talla = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
    $saldocantidad = $cantidadventaA1['resultado'];

    $cantidad1='1';
    $saldoActual = $saldocantidad - $cantidad1;
    //        $saldoActualBs = $saldoActualBs  + $res1['ingreso'] - $res1['egreso'];
    //        $idmovimientokardex = $res1['idmovimientokardexalmacen'];
    $sql3 = " SELECT * FROM kardexcajas WHERE idkardex = '$idkardex' and idmodelo='$idmodelo' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalparescaja");
    $saldocantidadpa = $cantidadventaA1['resultado'];
    $saldoActualpares= $saldocantidadpa - $cantidad1;
    $sql3 = " SELECT * FROM kardexdetalle WHERE idkardex = '$idkardex' and tallakardex='$talla'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "iddetalle");
    $iddetallekardex = $cantidadventaA1['resultado'];
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cantidad");
    $cantidadkardex = $cantidadventaA1['resultado'];
    $cantidadkardex =$cantidadkardex -1;

    $sqlA[] = "UPDATE kardexdetalle SET cantidad = '$cantidadkardex' WHERE iddetalle = '$iddetallekardex';";
    $sqlA[] = "UPDATE kardexdetallepar SET saldocantidad = '$saldoActual' WHERE idkardexunico = '$idkardexunico';";
    $sqlA[] = "UPDATE kardexcajas SET totalparescaja = '$saldoActualpares' WHERE idkardex = '$idkardex' and idmodelo='$idmodelo';";
    ejecutarConsultaSQLBeginCommit($sqlA);
}

function verificarsumatoria($nuevoprecio,$idmodelo,$montofinal,$idventa,$return = false ){

    $sql3 = " SELECT SUM(montoventafinal) as total FROM ventaitem WHERE idventa = '$idventa' and idmodelo='$idmodelo'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "total");
    $totalmodelo = $cantidadventaA1['resultado'];

    $sql31 = " SELECT MAX(iditemventa) as ultimo FROM ventaitem WHERE idventa = '$idventa' and idmodelo='$idmodelo' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "ultimo");
    $unparmodifica = $cantidadventaA1['resultado'];


    if($montofinal != $totalmodelo)
    {
        if($montofinal > $totalmodelo)
        {
            $saldodif = $montofinal - $totalmodelo;
            $nuevoprecio = $nuevoprecio +$saldodif;
            $sqlA[] = "UPDATE ventaitem SET montoventafinal = '$nuevoprecio' WHERE iditemventa = '$unparmodifica' and idventa = '$idventa' and idmodelo='$idmodelo';";

        }else
        {
            $saldodif = $totalmodelo - $montofinal;

            $nuevoprecio = $nuevoprecio -$saldodif;

            $sqlA[] = "UPDATE ventaitem SET montoventafinal = '$nuevoprecio' WHERE iditemventa = '$unparmodifica' and idventa = '$idventa' and idmodelo='$idmodelo';";


        }

    }else
    {


    }

    //MostrarConsulta($sqlA);
    //$sqlA[] = "UPDATE ventaitem SET precioventafinal = '$precionuevo' WHERE idkardexunico = '$idkardexunico' idventa = '$idventa' and idmodelo='$idmodelo';";

    ejecutarConsultaSQLBeginCommit($sqlA);

}

function totalventa($idventa,$return = false ){

    $sql3 = "SELECT SUM(precioventafinal) as total FROM ventafinalmodelo WHERE idventa = '$idventa' ";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
    $totalNeto = $idalmacenA2['resultado'];
    $totalNeto = round($totalNeto,2);

    $sqlA[] = "UPDATE ventas SET totalsus='$totalNeto',ingresoventasus='$totalNeto' WHERE idventa = '$idventa' ;";

    ejecutarConsultaSQLBeginCommit($sqlA);
}

function cambiarestadopartodos($idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE kardexdetallepar SET idoperacion='no',fallado='0' where idalmacen='$idalmacen' and saldocantidad='1' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function actualizarleidos($callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $codigo="1";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    cambiarestadopartodos($idalmacen,true);

    $cantidad = "1";
    $sql = "SELECT kar.idkardexunico FROM kardexdetallepar kar, modelo mdd
       WHERE kar.idmodelo=mdd.idmodelo and kar.idkardexunico = '1' ";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql,true, true, 'idkardexunico');
    $idkardexunico = $saldocantidadA1['resultado'];
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
function cambiarestadoparnormal($idkardexunico,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE kardexdetallepar SET idoperacion='no'  where idkardexunico='$idkardexunico';";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function buscarcodigonormal($codigo,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    cambiarestadoparnormal($codigo,true);

    $cantidad = "1";
    $sql = "SELECT kar.idkardexunico FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.idkardexunico = '$codigo' and mdd.idalmacen='$idalmacen' ";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardexunico');
    $idkardexunico = $saldocantidadA1['resultado'];



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

function buscarcodigo($codigo,$idmarca,$idvendedor,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idalmacen='$idalmacen' and kar.idoperacion='no' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    $cantidad = "1";

    if($saldoreal !=null || $saldoreal!=""){
        //String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

        if($formatomayor=='1'){
            $sql = "
            SELECT kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            CONCAT(c.detalle, '-', mdd.codigo) AS modelo,CONCAT(mdd.color, '-', mdd.material,'#',kar.talla) AS detalle, kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd,coleccion c
            WHERE kar.idmodelo=mdd.idmodelo and mdd.idcoleccion=c.idcoleccion and kar.idkardexunico='$idkardexunicopar' and kar.codigobarra = '$codigobarra' and kar.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' ";
        }else{

            $sql = "
            SELECT kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material,'#',kar.talla) AS detalle,kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idkardexunico='$idkardexunicopar' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca'";

        }
        // echo $sql;
        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
        $value['idmodelo'] =  $detalleA['resultado'];
        $idmodelo =  $detalleA['resultado'];
        $codigoAd = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
        $value['idkardexunico'] = $codigoAd['resultado'];
        $idkardexunico = $codigoAd['resultado'];
        $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
        $value['cantidad'] = $precio2A['resultado'];
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
        //         $value['talla'] = $precio2A1['resultado'];
        $value['talla'] = "-";
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciou");
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

        //echo $sql;
        if($idoperacion =='leido' || $idoperacion=="leido"){
            $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{

        }

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

                        cambiarestadopar($idkardexunico,true);

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
function VerificarCantidadModelos($codigo, $idmarca, $idvendedor, $return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    $sql3="SELECT ma.opcionb FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "opcionb");
    $value['opcionb'] = $result['resultado'];

    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and kar.idoperacion='no' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    if($saldoreal!=null || $saldoreal!=""){
        $cantidadmodelo = 0;
        $sql = "SELECT kar.idmodelo FROM kardexdetallepar kar, modelo mdd
               WHERE kar.idmodelo = mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen = '$idalmacen'
               and mdd.idmarca = '$idmarca' and kar.idoperacion = 'no' and mdd.idvendedor = '$idvendedor' and kar.saldocantidad = '1'
               group by kar.idmodelo";
        $row1 = NumeroTuplas($sql);
        $row11 = $row1['resultado'];
        $cantidadmodelo = $row11;
        $value['cantidadmodelo'] = "$cantidadmodelo";
    }else{
        //validar estado del modelo
        $dev['mensaje'] = "Error no tiene suficiente inventario y/o no existe el modelo en este almacen Vea sus traspasos pendientes y/o devoluciones";
        $dev['error']   = "false";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    //echo $value['cantidadmodelo'];
    if($cantidadmodelo>0){
        $dev['mensaje'] = "Existen modelos";
        $dev['error']   = "true";
        $dev['resultado'] = $value;
       // echo $dev['resultado'];
    }
    else
    {
        $dev['mensaje'] = "Error no tiene suficiente inventario y/o no existe el modelo en este almacen Vea sus traspasos pendientes y/o devoluciones";
        $dev['error']   = "false";
        $dev['resultado'] = "";
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

function ListarDetalleModelosVenta($start, $limit, $sort, $dir, $callback, $_dc, $codigo, $idmarca, $idvendedor, $return=false){
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    //echo " codigo $codigobarra almacen $idalmacen marca $idmarca vendedor $idvendedor ";
    $sql3="SELECT ma.formatomayor, ma.idgrupo FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql3, true, true, "idgrupo");
    $idgrupo = $result['resultado'];

    $cantidad = "1";
    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and kar.idoperacion='no' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    if($saldoreal !=null || $saldoreal!=""){
        $sql = "SELECT kar.idmodelo FROM kardexdetallepar kar, modelo mdd
               WHERE kar.idmodelo = mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen = '$idalmacen'
               and mdd.idmarca = '$idmarca' and kar.idoperacion = 'no' and mdd.idvendedor = '$idvendedor' and kar.saldocantidad = '1'
               group by kar.idmodelo";
        //echo " sql $sql ";

    }else{
        //validar estado del modelo
        $dev['mensaje'] = "Error no tiene suficiente inventario y/o no existe el modelo en este almacen Vea sus traspasos pendientes y/o devoluciones";
        $dev['error']   = "false";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    //MostrarConsulta($sql);

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
                            //echo " value mysql_field_name($re, $i) modelo $fi[$i] ";
                            //if(mysql_field_name($re, $i) == "idmodelo"){
                            //$value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            $iddetalleingreso = $fi[$i];
                            if($formatomayor=='1'){
                                $sqld = "SELECT kar.idmodelo, kar.idkardex, mdd.codigo, mdd.color, mdd.material, mdd.cliente, mdd.talla,
                                            mdd.precioventa as precio, mdd.numerocajas as totalcajas, SUM(kar.preciounitario * kar.saldocantidad) AS totalparesbs,
                                            SUM(kar.saldocantidad) AS totalparescaja, SUM( kar.saldocantidad ) AS totalpares, kar.preciounitario,
                                            mdd.fechaingreso as fecha
                                            FROM kardexdetallepar kar, modelo mdd,coleccion c
                                            WHERE kar.idmodelo = mdd.idmodelo and mdd.idcoleccion = c.idcoleccion
                                            and kar.idmodelo = '$fi[$i]' and mdd.idalmacen = '$idalmacen' and mdd.idmarca = '$idmarca'
                                            AND kar.saldocantidad = '1' group by kar.idkardex";
                            }else{
                                $sqld = "SELECT kar.idmodelo, kar.idkardex, mdd.codigo, mdd.color, mdd.material, mdd.cliente, mdd.talla,
                                            mdd.precioventa as precio, mdd.numerocajas as totalcajas, SUM(kar.preciounitario * kar.saldocantidad) AS totalparesbs,
                                            SUM(kar.saldocantidad) AS totalparescaja, SUM( kar.saldocantidad ) AS totalpares, kar.preciounitario,
                                            mdd.fechaingreso as fecha
                                            FROM kardexdetallepar kar, modelo mdd
                                            WHERE kar.idmodelo = mdd.idmodelo and kar.idmodelo = '$fi[$i]' and mdd.idalmacen = '$idalmacen'
                                            and mdd.idmarca = '$idmarca' AND kar.saldocantidad = '1' group by kar.idkardex";
                            }
                            //echo " sqld $sqld ";
                            if($re1 = $link->consulta($sqld))
                            {
                                if($fi1 = mysql_fetch_array($re1))
                                {
                                    do{
                                        for($j = 0; $j< mysql_num_fields($re1); $j++)
                                        {
                                            //$value{$ii}{$fi1[0]}= $fi1[1];
                                            $value{$ii}{mysql_field_name($re1, $j)}= $fi1[$j];
                                            $sqle = "SELECT SUM(kar.saldocantidad) AS totalpares FROM modelo mdd, kardexdetallepar kar
                                                        WHERE kar.idmodelo = mdd.idmodelo and mdd.idmodelo = '$iddetalleingreso' ";
                                            $opcionA1 = findBySqlReturnCampoUnique($sqle, true, true, "totalpares");
                                            $pares= $opcionA1['resultado'];
                                            //echo " sqle $sqle pares $pares ";
                                            $sqle="SELECT mdd.numerocajas FROM modelo mdd WHERE mdd.idmodelo = '$iddetalleingreso' ";
                                            $opcionA1 = findBySqlReturnCampoUnique($sqle, true, true, "numerocajas");
                                            $cajasram= $opcionA1['resultado'];
                                            //echo " sqle $sqle cajas $cajasram ";
                                            if($idmarca == "mar-1"){
                                                $cajas = $cajasram;
                                                $caja = $cajas;
                                                if($pares > 9){
                                                    $caja = $cajas;
                                                }else{
                                                    $caja = '1';
                                                }
                                            }else{
                                                $cajas = $pares /12;
                                                if($pares > 12){
                                                    $caja = $cajas;
                                                }else{
                                                    $caja = '1';
                                                }
                                            }
                                            if($idgrupo=="2"){
                                                $sqle = "SELECT ad.talla as tallakardex, ROUND((SUM(ad.saldocantidad)/$caja)) AS cantidad
                                                            FROM kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla";
                                            }else{
                                                if($idmarca=="mar-1"){
                                                    $sqle = "SELECT ad.talla as tallakardex, (SUM(ad.saldocantidad)/$caja) AS cantidad
                                                                 FROM kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla ";
                                                }else{
                                                    $sqle = "SELECT ad.talla as tallakardex, ROUND((SUM(ad.saldocantidad)/$caja)) AS cantidad
                                                                FROM kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla";
                                                }
                                            }
                                            //echo " sqle $sqle ";
                                            if($re2 = $link->consulta($sqle))
                                            {
                                                if($fi2 = mysql_fetch_array($re2))
                                                {
                                                    do{
                                                        for($k = 0; $k< mysql_num_fields($re2); $k++)
                                                        {
                                                            $value{$ii}{$fi2[0]}= $fi2[1];
                                                            //echo " fi2 $fi2[1]";
                                                        }
                                                    }while($fi2 = mysql_fetch_array($re2));
                                                }
                                            }
                                        }
                                    }while($fi1 = mysql_fetch_array($re1));
                                }
                            }
                            // }
                        }
                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;
                    //echo" value $value";
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

function buscarcodigocaja($codigo,$idmarca,$idvendedor,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $cantidad = "1";
    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and kar.idoperacion='no' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    //  echo $sql3;
    $sql3 = "SELECT idkardex,idmodelo FROM kardexdetallepar kar
WHERE kar.codigobarra = '$codigobarra' and kar.idkardexunico='$idkardexunicopar' and kar.idalmacen='$idalmacen'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardex');
    $idkardexcajas = $saldocantidadA1['resultado'];
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmodelo');
    $idmodeloor = $saldocantidadA1['resultado'];
    // echo $sql3;
    if($saldoreal !=null || $saldoreal!=""){
        //String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

        if($formatomayor=='1'){

            $sql = "SELECT kar.idmodelo,kar.idkardex as idkardexunico,SUM(kar.saldocantidad) as cantidad,mdd.precioventa,SUM(kar.preciounitario) as preciou,
                    CONCAT(c.detalle,'-',mdd.codigo) AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.idoperacion
                    FROM kardexdetallepar kar, modelo mdd,coleccion c
                    WHERE kar.idmodelo=mdd.idmodelo and mdd.idcoleccion=c.idcoleccion and kar.idkardex ='$idkardexcajas' and kar.idmodelo='$idmodeloor'
                    and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' AND kar.saldocantidad='1' group by kar.idkardex";
        }else{
            $sql = "SELECT kar.idmodelo,kar.idkardex as idkardexunico,SUM(kar.saldocantidad) as cantidad,mdd.precioventa,SUM(kar.preciounitario) as preciou,
                    mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.idoperacion
                    FROM kardexdetallepar kar, modelo mdd
                    WHERE kar.idmodelo=mdd.idmodelo and kar.idkardex ='$idkardexcajas' and kar.idmodelo='$idmodeloor' and mdd.idalmacen='$idalmacen'
                    and mdd.idmarca='$idmarca'  AND kar.saldocantidad='1' group by kar.idkardex";
        }
        // echo $sql;
        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
        $value['idmodelo'] =  $detalleA['resultado'];
        $idmodelo =  $detalleA['resultado'];
        $codigoAd = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
        $value['idkardexunico'] = $codigoAd['resultado'];
        $idkardexunico = $codigoAd['resultado'];
        $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
        $value['cantidad'] = $precio2A['resultado'];
        $cantidad12 = $precio2A['resultado'];
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
        //         $value['talla'] = $precio2A1['resultado'];
        $value['talla'] = "-";
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

        $value['vendedor'] =  "-";
        //echo $sql3;

        //echo $sql;
        if($idoperacion =='leido' || $idoperacion=="leido"){
            $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{

        }

    }else{
        //validar estado del modelo
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
                            //echo " fi $fi[$i] i $i re $re ";
                            if(mysql_field_name($re, $i) == "cantidad"){
                                $cantidad12 = $fi[$i];
                            }else{
                                if((mysql_field_name($re, $i) == "precioventa")&&($cantidad12 == '12')){
                                    $preciov = $fi[$i];
                                }else{
                                    if((mysql_field_name($re, $i) == "preciou")&&($cantidad12 == '12')){
                                        $value{mysql_field_name($re, $i)}= $preciov;
                                    }
                                }
                            }
                        }

                        cambiarestadoparcaja($idkardexunico,$idkardexcajas,$idmodeloor,true);

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
function buscarcodigocajaparatraspaso($codigo,$idmarca,$idvendedor,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);
    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $cantidad = "1";
    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and kar.idoperacion='no' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    //  echo $sql3;
    $sql3 = "SELECT idkardex,idmodelo FROM kardexdetallepar kar
WHERE kar.codigobarra = '$codigobarra' and kar.idkardexunico='$idkardexunicopar' and kar.idalmacen='$idalmacen'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardex');
    $idkardexcajas = $saldocantidadA1['resultado'];
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmodelo');
    $idmodeloor = $saldocantidadA1['resultado'];
    // echo $sql3;
    if($saldoreal !=null || $saldoreal!=""){
        //String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

        if($formatomayor=='1'){

            $sql = "
            SELECT kar.idmodelo,kar.idkardex as idkardexunico,SUM(kar.saldocantidad) as cantidad,
SUM(kar.preciounitario) as preciou,
            CONCAT(c.detalle,'-',mdd.codigo) AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd,coleccion c
            WHERE kar.idmodelo=mdd.idmodelo and mdd.idcoleccion=c.idcoleccion
and kar.idkardex ='$idkardexcajas' and kar.idmodelo='$idmodeloor' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' AND kar.saldocantidad='1' group by kar.idkardex";
        }else{
            $sql = "
                     SELECT kar.idmodelo,kar.idkardex as idkardexunico,SUM(kar.saldocantidad) as cantidad,
SUM(kar.preciounitario) as preciou,mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.idkardex ='$idkardexcajas' and kar.idmodelo='$idmodeloor' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca'  AND kar.saldocantidad='1' group by kar.idkardex";
        }
        // echo $sql;
        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
        $value['idmodelo'] =  $detalleA['resultado'];
        $idmodelo =  $detalleA['resultado'];
        $codigoAd = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
        $value['idkardexunico'] = $codigoAd['resultado'];
        $idkardexunico = $codigoAd['resultado'];
        $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
        $value['cantidad'] = $precio2A['resultado'];
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
        //         $value['talla'] = $precio2A1['resultado'];
        $value['talla'] = "-";
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciou");
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

        $value['vendedor'] =  "-";
        //echo $sql3;

        //echo $sql;
        if($idoperacion =='leido' || $idoperacion=="leido"){
            $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{

        }

    }else{
        //validar estado del modelo
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

                        cambiarestadoparcaja($idkardexunico,$idkardexcajas,$idmodeloor,true);

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

function buscarcodigotraspaso($codigo,$idmarca,$idvendedor,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen =$_SESSION['idalmacen'];
    $codigobarra = trim($codigo);

    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $cantidad = "1";

    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and kar.idoperacion='no' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.saldocantidad='1'";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql3 = "SELECT kar.saldocantidad FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and mdd.idvendedor='$idvendedor' and kar.idkardexunico='$idkardexunicopar' and kar.saldocantidad='1'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'saldocantidad');
    $saldoreal = $saldocantidadA1['resultado'];
    $cantidad = "1";

    if($saldoreal !=null || $saldoreal!=""){
        //String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

        if($formatomayor=='1'){

            $sql = "
            SELECT kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            CONCAT(c.detalle, '-', mdd.codigo) AS modelo,CONCAT(mdd.color, '-', mdd.material,'#',kar.talla) AS detalle, kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd,coleccion c
            WHERE kar.idmodelo=mdd.idmodelo and mdd.idcoleccion=c.idcoleccion and kar.idkardexunico='$idkardexunicopar' and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' ";
        }else{
            //                              $sql = "
            //            SELECT kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
            //            kar.talla , kar.preciounitario as preciou,
            //            mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material,'#',kar.talla) AS detalle,kar.idoperacion
            //            FROM kardexdetallepar kar, modelo mdd
            //            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca'";
            //
            $sql = "
            SELECT kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material,'#',kar.talla) AS detalle,kar.idoperacion
            FROM kardexdetallepar kar, modelo mdd
            WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' and kar.idkardexunico='$idkardexunicopar' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca'";

        }
        // echo $sql;
        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
        $value['idmodelo'] =  $detalleA['resultado'];
        $idmodelo =  $detalleA['resultado'];
        $codigoAd = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
        $value['idkardexunico'] = $codigoAd['resultado'];
        $idkardexunico = $codigoAd['resultado'];
        $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
        $value['cantidad'] = $precio2A['resultado'];
        //         $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
        //         $value['talla'] = $precio2A1['resultado'];
        $value['talla'] = "-";
        $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciou");
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

        //echo $sql;
        if($idoperacion =='leido' || $idoperacion=="leido"){
            $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }else{

        }

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

                        cambiarestadopar($idkardexunico,true);

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

function cambiarestadoparcaja($idkardexunico,$idkardexcajas,$idmodeloor,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE kardexdetallepar SET idoperacion='leido'  where idkardex='$idkardexcajas' and idmodelo='$idmodeloor' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function cambiarestadopar($idkardexunico,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE kardexdetallepar SET idoperacion='leido'  where idkardexunico='$idkardexunico';";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function buscarcodigoventa($codigobarra,$idmarca,$idvendedor,$idcliente,$boletaventa,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $codigobarra = trim($codigobarra);
    $idalmacen =$_SESSION['idalmacen'];
    $sql3="SELECT ma.formatomayor FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];

    $cantidad = "1";
    $sql3 = " SELECT Min(kar.idkardexunico) as num FROM kardexdetallepar kar, modelo mdd,ventaitem iv,ventas v
WHERE kar.idmodelo=mdd.idmodelo and kar.idkardexunico=iv.idkardexunico and
iv.idventa=v.idventa and kar.codigobarra = '$codigobarra' and mdd.idalmacen='$idalmacen'
and mdd.idmarca='$idmarca' and v.idvendedor='$idvendedor' AND v.idcliente='$idcliente' and v.boleta='$boletaventa' and kar.saldocantidad='0' and kar.fallado='0' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
    $idkardexunicopar = $cantidadventaA1['resultado'];

    $sql = "
SELECT kar.fallado,v.fecha as fechasalida,iv.iditemventa,CONCAT(cl.nombre, '-', cl.apellido) AS cliente,kar.idmodelo, kar.idkardexunico, kar.saldocantidad AS cantidad,
kar.talla , iv.montoventafinal as preciou,'1' as cantidad,
mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.talla , mdd.cliente as item,mdd.precioventa as preciocaja
FROM kardexdetallepar kar, modelo mdd,ventaitem iv,ventas v,clientes cl
WHERE kar.idmodelo=mdd.idmodelo and kar.idkardexunico=iv.idkardexunico and v.idcliente=cl.idcliente and
iv.idventa=v.idventa and kar.codigobarra = '$codigobarra' and v.boleta='$boletaventa' and iv.idkardexunico='$idkardexunicopar' and mdd.idalmacen='$idalmacen' and mdd.idmarca='$idmarca' and kar.saldocantidad='0' order by v.fecha desc";

    $detalleA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
    $value['idmodelo'] =  $detalleA['resultado'];
    $detalleA = findBySqlReturnCampoUnique($sql, true, true, "iditemventa");
    $value['iditemventa'] =  $detalleA['resultado'];
    $codigoA = findBySqlReturnCampoUnique($sql, true, true, "idkardexunico");
    $value['idkardexunico'] = $codigoA['resultado'];
    $precio2A = findBySqlReturnCampoUnique($sql, true, true, "cantidad");
    $value['cantidad'] = $precio2A['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "talla");
    $value['talla'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciou");
    $value['preciou'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "modelo");
    $value['modelo'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "detalle");
    $value['detalle'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "item");
    $value['item'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "preciocaja");
    $value['preciocaja'] = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "fallado");
    $fallado = $precio2A1['resultado'];
    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "fechasalida");
    $value['fechasalida'] = $precio2A1['resultado'];

    $precio2A1 = findBySqlReturnCampoUnique($sql, true, true, "cliente");
    $value['cliente'] = $precio2A1['resultado'];

    if($fallado =='1' || $fallado=="1"){
        $dev['mensaje'] = " El modelo ya fue registrado por el lector Por favor pase al siguiente PAR";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }else{

    }
    if($codigobarra != null)
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
                        cambiarestadodev($idkardexunicopar,true);

                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "El par ya fue devuelto o no corresponde a la boleta que indica";
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
function cambiarestadodev($idkardexunico,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE kardexdetallepar SET fallado='1' where idkardexunico='$idkardexunico';";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function actualizarllegadossistemanuevo($idalmacen,$idmarca,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql3="SELECT idcoleccion FROM coleccionvigente WHERE idmarca='$idmarca' and estado='vigente' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "idcoleccion");
    $colvigente = $result['resultado'];

    $sql[] = "UPDATE modelo m,proformas p SET m.idcoleccion='$colvigente' where m.idingreso=p.id_proforma and p.idmarca='$idmarca' and m.idalmacen='$idalmacen' and m.idmarca='$idmarca'  ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function  Buscardatosparaventa($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    if($idmarca=="mar-1"){
        actualizarllegadossistemanuevo($idalmacen,$idmarca,true);
    }

    cambiarestadopartodos($idalmacen,true);
    $categorias = ListarVendedor('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $categorias['resultado'];
    }

    $cliente = ListarsoloClientesActivos('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];
    }


    $sql4 = "SELECT MAX(boleta) AS ultimo FROM ventas where idalmacen='$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql4, true, true, "ultimo");
    $boleta = $result['resultado'] +1;
    $value['boleta'] = "$boleta";
    $sql3="SELECT t.valor FROM tipocambio t WHERE t.estado = 'activado' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "valor");
    $valor = $result['resultado'];
    $value['tipocambio'] = $valor;

    $sql3="SELECT ma.nombre as marca,encargado FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "marca");
    $nombremarca = $result['resultado'];
    $value['marca'] = $nombremarca;
    $result = findBySqlReturnCampoUnique($sql3, true, true, "encargado");
    $encargado = $result['resultado'];
    $value['vendedor'] = $encargado;
    $value['almacen'] =  $_SESSION['idalmacen'];

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscardatosmarcaProcesar($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $sql3="SELECT ma.nombre as marca FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "marca");
    $nombremarca = $result['resultado'];
    $value['marca'] = $nombremarca;
    $dev['mensaje'] = "Se cargo la Marca";
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
function cambiarestadopartodosdev($idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql12= "SELECT COUNT(idkardexunico) as devueltos FROM kardexdetallepar where idalmacen='$idalmacen' and saldocantidad='0' and fallado!='0' ";
        $result = findBySqlReturnCampoUnique($sql12, true, true, "devueltos");
        $devueltos = $result['resultado'];

        if($devueltos =='0' || $devueltos=="0"){
            $sql[] = "UPDATE color_marca SET existe='A' WHERE idcolor='col-308';";
            }else{
               $sql[] = "UPDATE kardexdetallepar SET fallado='0' where idalmacen='$idalmacen' and saldocantidad='0' and fallado!='0';";
        
        }
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}

function Buscardatosparadev($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
   cambiarestadopartodosdev($idalmacen,true);

    $categoriasw = ListaMarcas(true);
    if($categoriasw['error'] == true)
    {   $value['marcas'] = "true";
        $value['marcaM'] = $categoriasw['resultado'];
    }
 $categorias = ListarVendedor('', '', '', '', '', '',"$idmarca",true);
  //  $categorias = ListarVendedor("$idmarca",true);
    if($categorias['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $categorias['resultado'];
    }

      $cliente = ListarsoloClientes('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];
    }

    $idalmacen =$_SESSION['idalmacen'];
    $sql4 = "SELECT MAX(numerorecibo) AS ultimo FROM detalledevolucion where idalmacen='$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql4, true, true, "ultimo");
    $boleta = $result['resultado'] +1;
    $value['boleta'] = "$boleta";
    $sql3="SELECT t.valor FROM tipocambio t WHERE t.estado = 'activado' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "valor");
    $valor = $result['resultado'];
    $value['tipocambio'] = $valor;

    $sql3="SELECT ma.nombre as marca,encargado FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "marca");
    $nombremarca = $result['resultado'];
    $value['marca'] = $nombremarca;
    $result = findBySqlReturnCampoUnique($sql3, true, true, "encargado");
    $encargado = $result['resultado'];
    $value['vendedor'] = $encargado;
    $value['almacen'] =  $_SESSION['idalmacen'];

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
//    echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  Buscardatosparadevcobro($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    //cambiarestadopartodosdev($idalmacen,true);

    $categoriasw = ListaMarcas(true);
    if($categoriasw['error'] == true)
    {   $value['marcas'] = "true";
        $value['marcaM'] = $categoriasw['resultado'];
    }

    $categorias = ListarVendedor('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $categorias['resultado'];
    }

    $cliente = ListarsoloClientes('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];
    }

    $idalmacen =$_SESSION['idalmacen'];
    $sql4 = "SELECT MAX(numerorecibo) AS ultimo FROM detalledevolucion where idalmacen='$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql4, true, true, "ultimo");
    $boleta = $result['resultado'] +1;
    $value['boleta'] = "$boleta";
    $sql3="SELECT t.valor FROM tipocambio t WHERE t.estado = 'activado' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "valor");
    $valor = $result['resultado'];
    $value['tipocambio'] = $valor;

    $sql3="SELECT ma.nombre as marca,encargado FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "marca");
    $nombremarca = $result['resultado'];
    $value['marca'] = $nombremarca;
    $result = findBySqlReturnCampoUnique($sql3, true, true, "encargado");
    $encargado = $result['resultado'];
    $value['vendedor'] = $encargado;
    $value['almacen'] =  $_SESSION['idalmacen'];

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function ListaMarcas($return = false){

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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    // CONCAT(emp.nombres,'-',emp.apellidos) AS codigo,
    $idalmacen =$_SESSION['idalmacen'];
    $sql ="
SELECT
  idmarca,nombre
FROM
 marcas
WHERE
  estado='activo' $order LIMIT $start,$limit

";
    //    echo $sql;
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

function  BuscarEmpleadotraspaso($idmarca,$idalmdestino,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";


    $cliente = ListarsoloVendedortraspaso('', '', '', '', '', '','',$idmarca,$idalmdestino,true);

    //  $cliente = ListarsoloVendedor('', '', '', '', '', '','',$idmarca,$idalmdestino,true);
    if($cliente['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $cliente['resultado'];
    }

    $idalmacen =$_SESSION['idalmacen'];

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function  BuscarEmpleadomialmacen($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacenn =$_SESSION['idalmacen'];

    $cliente = ListarsoloVendedortraspaso('', '', '', '', '', '','',$idmarca,$idalmacenn,true);

    //  $cliente = ListarsoloVendedor('', '', '', '', '', '','',$idmarca,$idalmdestino,true);
    if($cliente['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $cliente['resultado'];
    }


    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarEmpleadomialmacenAlmacen($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacenn =$_SESSION['idalmacen'];

    $cliente = ListarsoloVendedortraspaso2('', '', '', '', '', '','',$idmarca,true);
    if($cliente['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $cliente['resultado'];
    }

    $cliente1 = ListarsoloAlmacen('', '', '', '', '', '','',true);
    if($cliente1['error'] == true)
    {   $value['almacen'] = "true";
        $value['almacenM'] = $cliente1['resultado'];
    }

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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


function  Buscarclientesmodelo($idmodelo,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacenn =$_SESSION['idalmacen'];
    $cliente = ListarsoloClientes('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];
    }


    $sql ="
SELECT idmodelo,codigo,color,material,cliente,idcliente,fechaingreso,'0' as nombrecliente FROM modelo
WHERE idmodelo = '$idmodelo'
";
    //  echo $sql;
    if($idmodelo != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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
function  BuscarEmpleadoCliente($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];

    cambiarestadopartodos($idalmacen,true);

    $categorias = ListarVendedor('', '', '', '', '', '',"$idmarca",true);
    if($categorias['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $categorias['resultado'];
    }

    $cliente = ListarsoloClientesActivos('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];
    }



    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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


function  Buscardatosparatraspaso($idmarca,$return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    if($idmarca=="mar-1"){
        actualizarllegadossistemanuevo($idalmacen,$idmarca,true);
    }
    cambiarestadopartodos($idalmacen,true);

    $cliente = ListarsoloAlmacen('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {   $value['almacen'] = "true";
        $value['almacenM'] = $cliente['resultado'];
    }

    $cliente = ListarsoloVendedor('', '', '', '', '', '','',$idmarca,true);
    if($cliente['error'] == true)
    {   $value['vendedor'] = "true";
        $value['vendedorM'] = $cliente['resultado'];
    }


    $sql4 = "SELECT MAX(boleta) AS ultimo FROM traspaso where idalmacen='$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql4, true, true, "ultimo");
    $boleta = $result['resultado'] +1;
    $value['boleta'] = "$boleta";
    $sql3="SELECT t.valor FROM tipocambio t WHERE t.estado = 'activado' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "valor");
    $valor = $result['resultado'];
    $value['tipocambio'] = $valor;

    $sql3="SELECT ma.nombre as marca,encargado FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "marca");
    $nombremarca = $result['resultado'];
    $value['marca'] = $nombremarca;
    $result = findBySqlReturnCampoUnique($sql3, true, true, "encargado");
    $encargado = $result['resultado'];
    $value['vendedor'] = $encargado;
    $value['almacen'] =  $_SESSION['idalmacen'];

    $sql ="
SELECT ma.nombre as marca FROM  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    echo $sql;
    if($idmarca != null)
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

    $dev['mensaje'] = "Se cargo el formulario de Marca";
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

function BuscarRedondeo($idempresa,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $idempresa="mar-1";
    $sql = "SELECT c.idmarca as idempresa FROM marcas c WHERE c.idmarca= '$idempresa'";

    if($idempresa != null)
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
        $dev['mensaje'] = "El codigo de usuario es nulo";
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

function buscardatosmarcaventa($idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "SELECT * FROM marcas WHERE idmarca= '$idmarca'";

    if($idmarca != null)
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
        $dev['mensaje'] = "El codigo de usuario es nulo";
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

function Guardarentrega($idventa){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $descuento = strtoupper($_GET['descuento']);
    $recibo = $_GET['recibo'];
    $reciboefectivo = $_GET['reciboefectivo'];
    $flota = strtoupper($_GET['flota']);
    $guia = $_GET['guia'];
    $responsable = $_GET['responsable'];
    $montocancelado= $_GET['montocancelado'];
    $montoapagar=$montocancelado - $descuento;
    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
    $idcliente = $result['resultado'];
    $fechareal = date("Y-m-d");
    if($descuento=='0' || $descuento=="0"){

    }else{
        //    $sql1= "SELECT MAX(id) AS num FROM clientehistorial where idcliente='$idcliente'";
        //    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
        //    $movanterior = $result['resultado'];
        //$sql[] =getSqlNewClientehistorial($id, $idcliente, 'descuento', $idventa, $fechareal, $hora, $boleta, $totalsus, $descuento, $sussaldo, $totalpares, $paressalida, $paressaldo, $totalcaja, $cajasalida, 'egreso', $movanterior, $detalle, $dato, false);

    }

    if($reciboefectivo!='0'){
        //registrarpago
        $sql[] = getSqlNewVentapago($idventa, $fechareal, $hora, "CR", $montoapagar, $montocancelado, $factura, $reciboefectivo, $responsable, $estado, $observacion, false);

        $tipoentrega='EFECTIVO';
    }else{
        if($guia!="-"){
            $tipoentrega='ENVIO';
        }else{
            $tipoentrega='CREDITO';
        }
    }
    // $sql[] = "UPDATE ventaentrega SET flota = '$flota',guia='$guia',responsable='$responsable',tipo='$tipoentrega' WHERE idventa = '$idventa'";
    $sql[] = "UPDATE ventas SET estado = 'CONFIRMADO' ,montoapagar='$montoapagar' WHERE idventa = '$idventa'";

    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
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

function ListarVentaanulada($fechainiz,$fechafinz,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{

    $idalmacen =$_SESSION['idalmacen'];
    $fechafinza=$fechafinz;
    $fechainiza=$fechainiz;
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $fecha22= split("-", $fechatoday);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];

    $ultimo_dia= ultimo_dia($m,$y);
    $dia1="01";
    $fechain=$y."-".$m."-".$dia1;
    $fechafin=$y."-".$m."-".$ultimo_dia;
    if($fechainiza==null || $fechainiza == "")
    {
        if($where == null || $where == "")
        {
            $sql = "SELECT v.hora, v.fechacompra AS fechaventa, v.idmodelo, v.fechadelete AS fecha, v.dato AS boleta,
        em.codigo AS vendedor, mar.nombre AS marca, CONCAT( cli.nombre, '-', cli.apellido ) AS cliente,
        SUM( v.cantidad ) AS totalpares, SUM( v.preciofinal ) AS totalsus
FROM bitacoradeleteventa v, clientes cli, empleados em, modelo mo, marcas mar
WHERE v.diferencia = cli.idcliente
AND v.idmodelo = mo.idmodelo
AND mo.idmarca = mar.idmarca
AND v.usuario = em.idempleado and v.idalmacen='$idalmacen' and v.fechadelete >='$fechain' AND v.fechadelete <='$fechafin' GROUP by v.dato order by v.fechadelete desc ,v.hora desc";

        }
        else
        {
            $sql = "
SELECT v.hora, v.fechacompra AS fechaventa, v.idmodelo, v.fechadelete AS fecha, v.dato AS boleta,
        em.codigo AS vendedor, mar.nombre AS marca, CONCAT( cli.nombre, '-', cli.apellido ) AS cliente,
        SUM( v.cantidad ) AS totalpares, SUM( v.preciofinal ) AS totalsus
FROM bitacoradeleteventa v, clientes cli, empleados em, modelo mo, marcas mar
WHERE v.diferencia = cli.idcliente
AND v.idmodelo = mo.idmodelo
AND mo.idmarca = mar.idmarca
AND v.usuario = em.idempleado and v.idalmacen='$idalmacen' and $where GROUP by v.dato order by v.fechadelete desc ,v.hora desc ";

        }

    }
    else
    {
        if($where == null || $where == "")
        {

            $sql = "SELECT v.hora, v.fechacompra AS fechaventa, v.idmodelo, v.fechadelete AS fecha, v.dato AS boleta,
        em.codigo AS vendedor, mar.nombre AS marca, CONCAT( cli.nombre, '-', cli.apellido ) AS cliente,
        SUM( v.cantidad ) AS totalpares, SUM( v.preciofinal ) AS totalsus
FROM bitacoradeleteventa v, clientes cli, empleados em, modelo mo, marcas mar
WHERE v.diferencia = cli.idcliente
AND v.idmodelo = mo.idmodelo
AND mo.idmarca = mar.idmarca
AND v.usuario = em.idempleado and v.idalmacen='$idalmacen' and v.fechadelete >='$fechainiza' AND v.fechadelete <='$fechafinza' GROUP by v.dato order by v.fechadelete desc ,v.hora desc";

        }

        else
        {

            $sql = "
SELECT v.hora, v.fechacompra AS fechaventa, v.idmodelo, v.fechadelete AS fecha, v.dato AS boleta,
        em.codigo AS vendedor, mar.nombre AS marca, CONCAT( cli.nombre, '-', cli.apellido ) AS cliente,
        SUM( v.cantidad ) AS totalpares, SUM( v.preciofinal ) AS totalsus
FROM bitacoradeleteventa v, clientes cli, empleados em, modelo mo, marcas mar
WHERE v.diferencia = cli.idcliente
AND v.idmodelo = mo.idmodelo
AND mo.idmarca = mar.idmarca
AND v.usuario = em.idempleado and v.idalmacen='$idalmacen' and v.fechadelete >='$fechainiza' AND v.fechadelete <='$fechafinza' AND $where
 group by iv.idventa order by v.fecha desc ,v.boleta ";

        }
    }

    //    echo $sql;

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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

function ListarCambios($fechainiz,$fechafinz,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{   $idalmacen =$_SESSION['idalmacen'];
    $fechafinza=$fechafinz;
    $fechainiza=$fechainiz;

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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $fecha22= split("-", $fechatoday);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];

    $ultimo_dia= ultimo_dia($m,$y);
    $dia1="01";
    $fechain=$y."-".$m."-".$dia1;
    $fechafin=$y."-".$m."-".$ultimo_dia;



    if($fechainiza==null || $fechainiza == "")
    {
        if($where == null || $where == "")
        {
            $sql = "SELECT iv.numero,iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade
FROM traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and iv.fecha >='$fechain' AND iv.fecha <='$fechafin'  group by iv.idmodelo order by iv.fecha desc";
        }

        else
        {
            $sql = "
SELECT iv.numero,iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade
FROM traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' AND $where
 group by iv.idmodelo order by iv.fecha desc ";

        }

    }
    else
    {
        if($where == null || $where == "")
        {
            $sql = "
SELECT iv.numero,iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade
FROM traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' AND iv.fecha >='$fechainiza' AND iv.fecha <='$fechafinza'
group by iv.idmodelo order by iv.fecha desc ";
        }

        else
        {
            $sql = "
SELECT iv.numero,iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade
FROM traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' AND $where
group by iv.idmodelo order by iv.fecha desc";

        }
    }


    // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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

function ListarVentaMayor($filtrotodo,$fechainiz,$fechafinz,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{


    $idalmacen =$_SESSION['idalmacen'];
    $fechafinza=$fechafinz;
    $fechainiza=$fechainiz;
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $fecha22= split("-", $fechatoday);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];

    $ultimo_dia= ultimo_dia($m,$y);
    $dia1="01";
    $fechain=$y."-".$m."-".$dia1;
    $fechafin=$y."-".$m."-".$ultimo_dia;


  if($idalmacen!='alm-13' || $idalmacen != "alm-13")
    {
   if($fechainiza==null || $fechainiza == "")
    {
        if($where == null || $where == "")
        {
            $sql = "SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
        v.tipoventa,v.tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
        FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
        WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
        v.idvendedor=em.idempleado  and v.idalmacen='$idalmacen' and v.fecha >='$fechain' AND v.fecha <='$fechafin'  group by iv.idventa order by v.fecha desc ,v.hora desc";
        }
        else
        {
            $sql = "
        SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
        v.tipoventa,v.tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
        FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
        WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
        v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' AND $where
         group by iv.idventa order by v.fecha desc ,v.boleta ";
        }

    }
    else
    {
        if($where == null || $where == "")
        {
            $sql = "
SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
v.tipoventa,(SUM(iv.cantidad)/12)AS tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' AND v.fecha >='$fechainiza' AND v.fecha <='$fechafinza'
group by iv.idventa order by v.fecha desc ,v.boleta ";
        }

        else
        {
            $sql = "
SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
v.tipoventa,(SUM(iv.cantidad)/12)AS tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
FROM ventas v,`marcas` mar, clientes cli,almacenes a,empleados em,ventaitem iv
WHERE  iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' AND v.fecha >='$fechainiza' AND v.fecha <='$fechafinza' AND $where
group by iv.idventa order by v.fecha desc ,v.boleta ";
        }
    }
 }else  {
$sql = "
select v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,vf.nit as marca,vf.cliente AS cliente,vf.idvendedor as vendedor,
v.tipoventa,'1' AS tcajas,SUM(ve.cantidad) as totalpares,vf.totalsus,v.descuento,vf.totalsus as montoapagar,v.fechacancelacion,v.estado,v.boletamanual from
ventaferia vf,ventas v,ventaitem ve,almacenes a where vf.idventa=v.idventa and ve.idventa=v.idventa and v.idalmacen=a.idalmacen and v.idalmacen='$idalmacen' AND
 v.fecha >='$fechain' AND v.fecha <='$fechafin' group by ve.idventa order by v.fecha desc ,v.boleta ";

     }

  //  echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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
function ListarVentaMayorfiltrado($filtrotodo,$fechainiz,$fechafinz,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{   $idalmacen =$_SESSION['idalmacen'];
    $fechafinza=$fechafinz;
    $fechainiza=$fechainiz;
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $fecha22= split("-", $fechatoday);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];

    $ultimo_dia= ultimo_dia($m,$y);
    $dia1="01";
    $fechain=$y."-".$m."-".$dia1;
    $fechafin=$y."-".$m."-".$ultimo_dia;
    if($fechainiza==null || $fechainiza == "")
    {
        //ROUND(column_name,decimals)
        if($where == null || $where == "")
        {
            $sql = "SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
        v.tipoventa,v.tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
        FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
        WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
        v.idvendedor=em.idempleado  and v.idalmacen='$idalmacen' and v.fecha >='$fechain' AND v.fecha <='$fechafin' and v.estado='PENDIENTE' group by iv.idventa order by v.fecha desc ,v.hora desc";
        }
        else
        {
            $sql = "
        SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
        v.tipoventa,v.tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
        FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
        WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
        v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' and v.estado='PENDIENTE' AND $where
         group by iv.idventa order by v.fecha desc ,v.boleta ";

        }

    }
    else
    {
        if($where == null || $where == "")
        {

            $sql = "
SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
v.tipoventa,(SUM(iv.cantidad)/12)AS tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento, ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
FROM ventas v,ventaitem iv,`marcas` mar, clientes cli,almacenes a,empleados em
WHERE iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' and v.estado='PENDIENTE' AND v.fecha >='$fechainiza' AND v.fecha <='$fechafinza'
group by iv.idventa order by v.fecha desc ,v.boleta ";
        }

        else
        {

            $sql = "
SELECT v.idventa,v.boleta,v.hora,v.fecha,a.codigo as almacen,mar.nombre as marca,em.codigo as vendedor,CONCAT(cli.nombre, '-', cli.apellido) AS cliente,
v.tipoventa,(SUM(iv.cantidad)/12)AS tcajas,SUM(iv.cantidad) as totalpares,v.totalsus,v.descuento,ROUND(SUM(iv.montoventafinal),2) as montoapagar,v.fechacancelacion,v.estado,v.boletamanual
FROM ventas v,`marcas` mar, clientes cli,almacenes a,empleados em,ventaitem iv
WHERE  iv.idventa=v.idventa and v.idmarca=mar.idmarca and v.idcliente=cli.idcliente and v.idalmacen=a.idalmacen and
v.idvendedor=em.idempleado and v.idalmacen='$idalmacen' and v.estado='PENDIENTE' AND v.fecha >='$fechainiza' AND v.fecha <='$fechafinza' AND $where
 group by iv.idventa order by v.fecha desc ,v.boleta ";

        }
    }


    // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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

function ultimo_dia($m,$y)
{return strftime("%d", mktime(0, 0, 0, $m+1, 0, $y));}
function ListarVentaDevolucion($fechainiz,$fechafinz,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{
    $idalmacen =$_SESSION['idalmacen'];
    $fechafinza=$fechafinz;
    $fechainiza=$fechainiz;
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $fecha22= split("-", $fechatoday);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];

    $ultimo_dia= ultimo_dia($m,$y);
    $dia1="01";
    $fechain=$y."-".$m."-".$dia1;
    $fechafin=$y."-".$m."-".$ultimo_dia;
    //ojo


    //$sql = "SELECT dv.iddevolucion,d.idventadetalle as idventa,dv.estado as boleta,dv.idalmacen,dv.fecha,dv.hora,mar.nombre as marca,em.codigo as vendedor,
    //CONCAT(cli.nombre, '-', cli.apellido) AS cliente,COUNT(d.iditemventa) as totalpares,SUM(d.valorcalzado) as totalsus,dv.estadomayor
    //FROM `marcas` mar, clientes cli,almacenes a,empleados em,detalledevolucion d,devolucion dv
    //WHERE dv.iddevolucion=d.iddevolucion and dv.idmarca=mar.idmarca and dv.idcliente=cli.idcliente and dv.idalmacen=a.idalmacen and
    //dv.idvendedor=em.idempleado  and dv.idalmacen='$idalmacen' and dv.fecha >='$fechain' AND dv.fecha <='$fechafin'
    //group by dv.iddevolucion order by dv.fecha desc ,d.hora desc";

    if($fechainiza==null || $fechainiza == "")
    {
        if($where == null || $where == "")
        {
            $sql = "SELECT dv.iddevolucion,d.idventadetalle as idventa,dv.estado as boleta,dv.idalmacen,dv.fecha,dv.hora,mar.nombre as marca,em.codigo as vendedor,
CONCAT(cli.nombre, '-', cli.apellido) AS cliente,dv.pares as totalpares,dv.venta as totalsus,dv.estadomayor
FROM `marcas` mar, clientes cli,almacenes a,empleados em,detalledevolucion d,devolucion dv
WHERE dv.iddevolucion=d.iddevolucion and dv.idmarca=mar.idmarca and dv.idcliente=cli.idcliente and dv.idalmacen=a.idalmacen and
dv.idvendedor=em.idempleado  and dv.idalmacen='$idalmacen' and dv.fecha >='$fechain' AND dv.fecha <='$fechafin'
group by dv.iddevolucion order by dv.fecha desc ,d.hora desc";
        }
        else
        {
            $sql = "SELECT dv.iddevolucion,d.idventadetalle as idventa,dv.estado as boleta,dv.idalmacen,dv.fecha,dv.hora,mar.nombre as marca,em.codigo as vendedor,
CONCAT(cli.nombre, '-', cli.apellido) AS cliente,dv.pares as totalpares,dv.venta as totalsus,dv.estadomayor
FROM `marcas` mar, clientes cli,almacenes a,empleados em,detalledevolucion d,devolucion dv
WHERE dv.iddevolucion=d.iddevolucion and dv.idmarca=mar.idmarca and dv.idcliente=cli.idcliente and dv.idalmacen=a.idalmacen and
dv.idvendedor=em.idempleado  and dv.idalmacen='$idalmacen' AND $where
group by dv.iddevolucion order by dv.fecha desc ,d.hora desc";
        }

    }
    else
    {
        if($where == null || $where == "")
        {

            $sql = "SELECT dv.iddevolucion,d.idventadetalle as idventa,dv.estado as boleta,dv.idalmacen,dv.fecha,dv.hora,mar.nombre as marca,em.codigo as vendedor,
CONCAT(cli.nombre, '-', cli.apellido) AS cliente,dv.pares as totalpares,dv.venta as totalsus,dv.estadomayor
FROM `marcas` mar, clientes cli,almacenes a,empleados em,detalledevolucion d,devolucion dv
WHERE dv.iddevolucion=d.iddevolucion and dv.idmarca=mar.idmarca and dv.idcliente=cli.idcliente and dv.idalmacen=a.idalmacen and
dv.idvendedor=em.idempleado  and dv.idalmacen='$idalmacen' and dv.fecha >='$fechainiza' AND dv.fecha <='$fechafinza'
group by dv.iddevolucion order by dv.fecha desc ,d.hora desc";
        }

        else
        {

            $sql = "
SELECT dv.iddevolucion,d.idventadetalle as idventa,dv.estado as boleta,dv.idalmacen,dv.fecha,dv.hora,mar.nombre as marca,em.codigo as vendedor,
CONCAT(cli.nombre, '-', cli.apellido) AS cliente,dv.pares as totalpares,dv.venta as totalsus,dv.estadomayor
FROM `marcas` mar, clientes cli,almacenes a,empleados em,detalledevolucion d,devolucion dv
WHERE dv.iddevolucion=d.iddevolucion and dv.idmarca=mar.idmarca and dv.idcliente=cli.idcliente and dv.idalmacen=a.idalmacen and
dv.idvendedor=em.idempleado  and dv.idalmacen='$idalmacen' and dv.fecha >='$fechainiza' AND dv.fecha <='$fechafinza' AND $where
 group by iv.idventa order by v.fecha desc ,v.boleta ";

        }
    }

    // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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
function ObtenerNumeroRecibo(){
    //  $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $sql = "
SELECT
  MAX(con.numerorecibo) AS numerorecibo
FROM
  numerorecibo con
WHERE
  con.variable= '1'";
    $codigonumeracionA = findBySqlReturnCampoUnique($sql, true, true, "numerorecibo");
    //  echo $codigonumeracionA['resultado'];
    if($codigonumeracionA['resultado'] == null || $codigonumeracionA['resultado'] == 'null' || $codigonumeracionA['resultado'] == '') {
        $valor1 = "10000";
        //    echo $valor;
    }
    else
    {
        //$num_hoja = $mayor['mayor']+1;
        $valor1 = $codigonumeracionA['resultado']+1;
        //   echo $valor1;
    }
    $valor = "$valor1";
    // $valor = $result['resultado'];
    return $valor;
}
function ObtenerTipocambio(){
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql="
SELECT
  t.valor
FROM
  tipocambio t
WHERE
  t.estado = 'activado'
";
    $result = findBySqlReturnCampoUnique($sql, true, true, "valor");
    $valor = $result['resultado'];
    return $valor;
}
function BuscarEmpresaVendedorCliente($callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $cliente = ListarClientePedido('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {
        $value['vendedor'] = "true";
        $value['vendedorM'] = $cliente['resultado'];

    }
    //    $proveedores =  ListarEmpleadosVendedor('', '', '', '', '', '', '', true);
    //    if($proveedores['error'] == true)
    //    {
    //        $value['vendedor'] = "true";
    //        $value['vendedorM'] = $proveedores['resultado'];
    //    }

    $usr = findAllUsuario(0, 0, "login", "ASC", "", "","", true);
    if($usr['error'] == true)
    {
        $value['usuarios'] = "true";
        $value['usuariosM'] = $usr["resultado"];
    }

    $sql1 = "
            SELECT
  valor AS cambio
FROM
  `tipocambio` c
WHERE
  c.idmoneda = 'mon-1001' AND c.estado = 'activado'
";
    $detalleA = findBySqlReturnCampoUnique($sql1, true, true, "cambio");
    $value['cambio'] =  $detalleA['resultado'];
    //  $value['multivendedor'] =  $_SESSION['idusuario'];
    $dev['mensaje'] = "Se cargaron los parametros de venta";
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


function findAllUsuario($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $password = md5($password);
    if($where == null || $where == "")
    {
        $sql = "SELECT u.idusuario, u.nombre, u.login, u.paswd FROM usuario u,
rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(u.*) AS total FROM usuario u, rol r, almacen a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen";
    }
    else
    {
        $sql = "SELECT u.idusuario, u.nombre, u.login, u.paswd FROM usuario u,
rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen AND $where $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(u.*) AS total FROM usuario u, rol r, almacen a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen AND $where";
    }

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev['totalCount'] = allBySql($sql);
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

function eliminarventa($idventa){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
    $idcliente = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idalmacen");
    $idalmacen = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
    $idvendedor = $result['resultado'];

    //  actualizarentradaparventa($idventa,$idmodelo,$idkardex,$fecha,$hora, false);
    $fechareal = date("Y-m-d");
    //
    $codigobarraA1 = anularventasdetalle($idventa,$idcliente,true);
    $idmodelon = $codigobarraA1['idmodelonuevo'];

    $sql[] ="DELETE FROM ventas WHERE idventa='$idventa' ;";
    $sql[] ="DELETE FROM ventaitem WHERE idventa='$idventa' ;";
    //$sql[] ="DELETE FROM ventaentrega WHERE idventa='$idventa' ;";
    $sql[] ="DELETE FROM clientehistorial WHERE idmovimiento='$idventa' ;";
    $sql[] ="DELETE FROM ventafinalmodelo WHERE idventa='$idventa' ;";
     $sql[] ="DELETE FROM ventaferia WHERE idventa='$idventa' ;";
      $sql[] ="DELETE FROM traspasosinternos WHERE idventa='$idventa' ;";
     
    // $sql[] = "UPDATE ventaentrega SET flota = '$flota',guia='$guia',responsable='$responsable',tipo='$tipoentrega' WHERE idventa = '$idventa'";
    //$sql[] = "UPDATE ventas SET estado = 'CONFIRMADO' ,montoapagar='$montoapagar' WHERE idventa = '$idventa'";

    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "No se puede anular ventas confirmadas";
        $dev['error'] = "false";
        $dev['resultado'] = "";
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
function EliminarModeloVenta($idmodelo,$idventa){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
    $idcliente = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idalmacen");
    $idalmacen = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
    $idvendedor = $result['resultado'];
    $fechareal = date("Y-m-d");
    $codigobarraA1 = anularventasdetallemodelo($idventa,$idmodelo,true);
    $idmodelon = $codigobarraA1['idmodelonuevo'];
    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "fecha");
    $fechacompra = $result['resultado'];
    $sql[] ="DELETE FROM ventaitem WHERE idventa='$idventa' and idmodelo='$idmodelo' ;";
    $sql[] ="DELETE FROM ventafinalmodelo WHERE idventa='$idventa' and idmodelo='$idmodelo' ;";

    if(ejecutarConsultaSQLBeginCommit($sql))
    {    actualizartotalesventa($idventa, false);

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "No se puede anular ventas confirmadas";
        $dev['error'] = "false";
        $dev['resultado'] = "";
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
function actualizartotalesventa($idventa ,$return = false ){

    $sql3 = " SELECT SUM(vi.cantidad)AS totalpares FROM ventaitem vi WHERE vi.idventa='$idventa' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalpares");
    $totalpares = $cantidadventaA1['resultado'];
    $sql3 = " SELECT (SUM(vi.cantidad)/12)AS cajas FROM ventaitem vi WHERE vi.idventa='$idventa' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cajas");
    $totalcajas = $cantidadventaA1['resultado'];

    $sql3 = " SELECT  SUM(vi.montoventafinal * vi.cantidad) as totalsus FROM ventaitem vi WHERE vi.idventa='$idventa' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalsus");
    $totalsus = $cantidadventaA1['resultado'];
    $sqlA[] = "UPDATE ventas SET tcajas = '$totalcajas',totalpares='$totalpares',totalsus='$totalsus',montoapagar='$totalsus',saldo='$totalsus' WHERE idventa = '$idventa';";
    ejecutarConsultaSQLBeginCommit($sqlA);

}


//ini anula por modelo
function anularventasdetallemodelo($idventa,$idmodelo, $return){

    $emitida="1";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    //echo $mesplanilla;

    veritemsmodelo($idventa,$idmodelo,false);
    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";

    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idmodelonuevo;
        $dev['idmodelonuevo'] = $idventa;

    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = $idventadetalle;
    }
    if($return == true)
    {   return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
    return $dev;
}

function veritemsmodelo($idventa,$idmodelo,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $sql ="
SELECT iditemventa
FROM ventaitem
WHERE idventa = '$idventa' and idmodelo='$idmodelo' ;
";
    //WHERE idempresa = '$idempresa' AND idclienteempresa='$idclienteempresa'AND no_planilla !='$no_planillaactual' AND no_planilla ='$no_planillaanterior' AND emitido='1' AND unido='0';

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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "iditemventa";
                            $itemventa = $fi[$i];

                            //         echo $idplanillaemitida;
                            actualizardatosdeletemodelo($itemventa,$idventa,$idmodelo,false);
                            //e
                        }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            // print($output);
        }


    }
    //}
}
function actualizardatosdeletemodelo($iditemventa,$idventa,$idmodelo,$return){
    set_time_limit(0);
    $idalmacen =$_SESSION['idalmacen'];
      $idusuario = $_SESSION['idusuario'];
    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "fecha");
    $fechacompra = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "boleta");
    $boleta = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
    $idvendedor = $result['resultado'];

    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
    $idcliente = $result['resultado'];
    $emitido="1";
    //echo $mesplanilla;
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    $sql12 = "SELECT * FROM ventaitem WHERE iditemventa = '$iditemventa' ";
    //echo $sql12;
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "iditemventa");
    $iditemventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idventa");
    $idventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelo");
    $idmodelo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardex");
    $idkardex = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardexunico");
    $idkardexunico = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $talla = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $cantidad = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "montoventafinal");
    $preciofinal = $saldocantidadA['resultado'];

    $sqlA[] = "UPDATE kardexdetallepar SET saldocantidad='1' WHERE idkardexunico='$idkardexunico';";

    $sql12 = "SELECT * FROM kardexdetalle WHERE idmodelo = '$idmodelo' and idkardex='$idkardex' and tallakardex='$talla'";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "iddetalle");
    $iddetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex +1;
    $sqlA[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where iddetalle = '$iddetalle';";


    $sqlA[] =getSqlNewBitacoradeleteventa($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $idcliente, $fechacompra, $fecha, $hora, $idvendedor, $idalmacen, $boleta, $idusuario, false);
    $sqlA[] ="DELETE FROM ventaitem WHERE idventa='$idventa' and idmodelo='$idmodelo' and iditemventa='$iditemventa' ;";

    //MostrarConsulta($sqlA);
    if(ejecutarConsultaSQLBeginCommit($sqlA))
    {
        $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = "$idplanillaemitidanueva";
    }
    else
    {
        $dev['mensaje'] = "";
        $dev['error'] = "false";
        $dev['resultado'] = "$idplanillaemitidanueva";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        // print($output);
    }
}


//fin anula por modelo
function anularventasdetalle($idventa,$idcliente, $return){

    $emitida="1";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    //echo $mesplanilla;

    veritems($idventa,false);
    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";

    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idmodelonuevo;
        $dev['idmodelonuevo'] = $idventa;

    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = $idventadetalle;
    }
    if($return == true)
    {   return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
    return $dev;
}

function veritems($idventa,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $sql ="
SELECT iditemventa
FROM ventaitem
WHERE idventa = '$idventa' ;
";
    //WHERE idempresa = '$idempresa' AND idclienteempresa='$idclienteempresa'AND no_planilla !='$no_planillaactual' AND no_planilla ='$no_planillaanterior' AND emitido='1' AND unido='0';

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
                        //while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            mysql_field_name($re, $i) == "iditemventa";
                            $itemventa = $fi[$i];
                            //         echo $idplanillaemitida;
                            actualizardatosdelete($itemventa,$idventa,false);
                            //e
                        }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            // print($output);
        }


    }
    //}
}
function actualizardatosdelete($iditemventa,$idventa,$return){
    set_time_limit(0);
    $idalmacen =$_SESSION['idalmacen'];
      $idusuario = $_SESSION['idusuario'];
    $sql1= "SELECT * FROM ventas where idventa='$idventa'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "fecha");
    $fechacompra = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "boleta");
    $boleta = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
    $idvendedor = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
    $idcliente = $result['resultado'];
    $emitido="1";
    //echo $mesplanilla;
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    $sql12 = "SELECT * FROM ventaitem WHERE iditemventa = '$iditemventa' ";
    //echo $sql12;
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "iditemventa");
    $iditemventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idventa");
    $idventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelo");
    $idmodelo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardex");
    $idkardex = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardexunico");
    $idkardexunico = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $talla = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $cantidad = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "montoventafinal");
    $preciofinal = $saldocantidadA['resultado'];
    //$sqlA[] = "UPDATE kardexdetallepar SET saldocantidad='0',idoperacion='no' WHERE idkardexunico='$idkardexunico';";
    $sqlA[] = "UPDATE kardexdetallepar SET saldocantidad='1',idoperacion='no' WHERE idkardexunico='$idkardexunico';";

    $sql12 = "SELECT * FROM kardexdetalle WHERE idmodelo = '$idmodelo' and idkardex='$idkardex' and tallakardex='$talla'";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "iddetalle");
    $iddetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex +1;

    $sqlA[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where iddetalle = '$iddetalle';";

    $sqlA[] =getSqlNewBitacoradeleteventa($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $idcliente, $fechacompra, $fecha, $hora, $idvendedor, $idalmacen, $boleta, $idusuario, false);

    //MostrarConsulta($sqlA);
    if(ejecutarConsultaSQLBeginCommit($sqlA))
    {
        $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = "$idplanillaemitidanueva";
    }
    else
    {
        $dev['mensaje'] = "";
        $dev['error'] = "false";
        $dev['resultado'] = "$idplanillaemitidanueva";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        // print($output);
    }
}

function ConfirmarBoleta(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $boletamanual = $_GET['boleta'];
    $idventa = $_GET['idventa'];
    $montofinalventa = $_GET['montoventa'];
    $sql[] = "UPDATE creditocliente SET boletamanual='$boletamanual'where idventa='$idventa';";
    $sql[] = "UPDATE ventas SET boletamanual='$boletamanual',totalsus='$montofinalventa' where idventa='$idventa';";
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
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

function ConfirmarDevolucion(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $boletamanual = $_GET['monto'];
    $iddev = $_GET['iddevolucion'];
    $sql[] = "UPDATE devolucion SET venta='$boletamanual'where iddevolucion='$iddev';";



    //          MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
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
function getSqlNewBitacoradeleteventa($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $diferencia, $fechacompra, $fechadelete, $hora, $usuario, $idalmacen, $dato,$idusuario, $return){
    $setC[0]['campo'] = 'iditemventa';
    $setC[0]['dato'] = $iditemventa;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'idkardex';
    $setC[2]['dato'] = $idkardex;
    $setC[3]['campo'] = 'idkardexunico';
    $setC[3]['dato'] = $idkardexunico;
    $setC[4]['campo'] = 'idmodelo';
    $setC[4]['dato'] = $idmodelo;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;
    $setC[6]['campo'] = 'talla';
    $setC[6]['dato'] = $talla;
    $setC[7]['campo'] = 'preciofinal';
    $setC[7]['dato'] = $preciofinal;
    $setC[8]['campo'] = 'precioventa';
    $setC[8]['dato'] = $precioventa;
    $setC[9]['campo'] = 'descuento';
    $setC[9]['dato'] = $descuento;
    $setC[10]['campo'] = 'descuentoporcentaje';
    $setC[10]['dato'] = $descuentoporcentaje;
    $setC[11]['campo'] = 'total';
    $setC[11]['dato'] = $total;
    $setC[12]['campo'] = 'estado';
    $setC[12]['dato'] = $estado;
    $setC[13]['campo'] = 'devolucion';
    $setC[13]['dato'] = $devolucion;
    $setC[14]['campo'] = 'tipomuestra';
    $setC[14]['dato'] = $tipomuestra;
    $setC[15]['campo'] = 'diferencia';
    $setC[15]['dato'] = $diferencia;
    $setC[16]['campo'] = 'fechacompra';
    $setC[16]['dato'] = $fechacompra;
    $setC[17]['campo'] = 'fechadelete';
    $setC[17]['dato'] = $fechadelete;
    $setC[18]['campo'] = 'hora';
    $setC[18]['dato'] = $hora;
    $setC[19]['campo'] = 'usuario';
    $setC[19]['dato'] = $usuario;
    $setC[20]['campo'] = 'idalmacen';
    $setC[20]['dato'] = $idalmacen;
    $setC[21]['campo'] = 'dato';
    $setC[21]['dato'] = $dato;
    $setC[22]['campo'] = 'idusuario';
    $setC[22]['dato'] = $idusuario;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO bitacoradeleteventa ".$sql2;
}


function ListarsoloAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
    $idalmacen =$_SESSION['idalmacen'];
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT cl.idalmacen,CONCAT(cl.codigo,'/', ciu.codigo) AS codigo
  FROM almacenes cl, `ciudades` ciu
WHERE  cl.idciudad = ciu.idciudad
";

    //echo $sql;and cl.idalmacen='$idalmacen'
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

function ListarsoloVendedor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $idmarca,$return = false){
    $idalmacen =$_SESSION['idalmacen'];
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT
  cle.idempleado ,
  cle.codigo,
CONCAT( cle.apellidos,'-',cle.nombres,'/',c.codigo) AS nombre,cle.idciudad

FROM
  empleados cle,empleadomarca em,ciudades c
WHERE
  cle.idempleado=em.idempleado and cle.idciudad=c.idciudad and em.idmarca='$idmarca' and cle.idalmacen='$idalmacen'

";
    //echo $sql;
    //echo $sql;and cl.idalmacen='$idalmacen'
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

function ListarsoloVendedortraspaso($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $idmarca,$idalmacen,$return = false){
    // $idalmacen =$_SESSION['idalmacen'];
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT
  cle.idempleado ,
  cle.codigo,
CONCAT( cle.apellidos,'-',cle.nombres,'/',c.codigo) AS nombre,cle.idciudad

FROM
  empleados cle,empleadomarca em,ciudades c
WHERE
  cle.idempleado=em.idempleado and cle.idciudad=c.idciudad and
 em.idmarca='$idmarca' and cle.idalmacen='$idalmacen'

";
    //   echo $sql;
    //echo $sql;and cl.idalmacen='$idalmacen'
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

function ListarsoloVendedortraspaso2($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $idmarca,$return = false){
    // $idalmacen =$_SESSION['idalmacen'];
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT
  cle.idempleado ,
  cle.codigo,
CONCAT( cle.nombres,'-',cle.apellidos,'/',c.codigo) AS nombre,cle.idciudad

FROM
  empleados cle,empleadomarca em,ciudades c
WHERE
  cle.idempleado=em.idempleado and cle.idciudad=c.idciudad and
 em.idmarca='$idmarca'

";
    //   echo $sql;
    //echo $sql;and cl.idalmacen='$idalmacen'
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

function getSqlNewVentas($idventa, $idalmacen, $idvendedor, $idmarca, $periodo, $boleta, $idcliente, $clienteitem, $fecha, $hora, $tipoventa, $tcajas, $totalbs, $totalpares, $totalsus, $descporcentaje, $descuento, $montoapagar, $montocanceladosus, $ingresoventasus, $montopagado, $saldo, $tipocambio, $arqueo, $validado, $observacion, $fechacancelacion, $estado, $idusuario, $dato, $return){
    $setC[0]['campo'] = 'idventa';
    $setC[0]['dato'] = $idventa;
    $setC[1]['campo'] = 'idalmacen';
    $setC[1]['dato'] = $idalmacen;
    $setC[2]['campo'] = 'idvendedor';
    $setC[2]['dato'] = $idvendedor;
    $setC[3]['campo'] = 'idmarca';
    $setC[3]['dato'] = $idmarca;
    $setC[4]['campo'] = 'periodo';
    $setC[4]['dato'] = $periodo;
    $setC[5]['campo'] = 'boleta';
    $setC[5]['dato'] = $boleta;
    $setC[6]['campo'] = 'idcliente';
    $setC[6]['dato'] = $idcliente;
    $setC[7]['campo'] = 'clienteitem';
    $setC[7]['dato'] = $clienteitem;
    $setC[8]['campo'] = 'fecha';
    $setC[8]['dato'] = $fecha;
    $setC[9]['campo'] = 'hora';
    $setC[9]['dato'] = $hora;
    $setC[10]['campo'] = 'tipoventa';
    $setC[10]['dato'] = $tipoventa;
    $setC[11]['campo'] = 'tcajas';
    $setC[11]['dato'] = $tcajas;
    $setC[12]['campo'] = 'totalbs';
    $setC[12]['dato'] = $totalbs;
    $setC[13]['campo'] = 'totalpares';
    $setC[13]['dato'] = $totalpares;
    $setC[14]['campo'] = 'totalsus';
    $setC[14]['dato'] = $totalsus;
    $setC[15]['campo'] = 'descporcentaje';
    $setC[15]['dato'] = $descporcentaje;
    $setC[16]['campo'] = 'descuento';
    $setC[16]['dato'] = $descuento;
    $setC[17]['campo'] = 'montoapagar';
    $setC[17]['dato'] = $montoapagar;
    $setC[18]['campo'] = 'montocanceladosus';
    $setC[18]['dato'] = $montocanceladosus;
    $setC[19]['campo'] = 'ingresoventasus';
    $setC[19]['dato'] = $ingresoventasus;
    $setC[20]['campo'] = 'montopagado';
    $setC[20]['dato'] = $montopagado;
    $setC[21]['campo'] = 'saldo';
    $setC[21]['dato'] = $saldo;
    $setC[22]['campo'] = 'tipocambio';
    $setC[22]['dato'] = $tipocambio;
    $setC[23]['campo'] = 'arqueo';
    $setC[23]['dato'] = $arqueo;
    $setC[24]['campo'] = 'validado';
    $setC[24]['dato'] = $validado;
    $setC[25]['campo'] = 'observacion';
    $setC[25]['dato'] = $observacion;
    $setC[26]['campo'] = 'fechacancelacion';
    $setC[26]['dato'] = $fechacancelacion;
    $setC[27]['campo'] = 'estado';
    $setC[27]['dato'] = $estado;
    $setC[28]['campo'] = 'idusuario';
    $setC[28]['dato'] = $idusuario;
    $setC[29]['campo'] = 'dato';
    $setC[29]['dato'] = $dato;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO ventas ".$sql2;
}
//function getSqlNewVentaentrega($idventa, $boleta, $fecha, $hora, $tipo, $tcajas, $totalbs, $totalpares, $totalsus, $flota, $guia, $responsable, $estado, $observacion, $fechasalida, $fechallegada, $fechacancelacion, $idusuario, $dato, $return){
//
//$setC[0]['campo'] = 'idventa';
//$setC[0]['dato'] = $idventa;
//$setC[1]['campo'] = 'boleta';
//$setC[1]['dato'] = $boleta;
//$setC[2]['campo'] = 'fecha';
//$setC[2]['dato'] = $fecha;
//$setC[3]['campo'] = 'hora';
//$setC[3]['dato'] = $hora;
//$setC[4]['campo'] = 'tipo';
//$setC[4]['dato'] = $tipo;
//$setC[5]['campo'] = 'tcajas';
//$setC[5]['dato'] = $tcajas;
//$setC[6]['campo'] = 'totalbs';
//$setC[6]['dato'] = $totalbs;
//$setC[7]['campo'] = 'totalpares';
//$setC[7]['dato'] = $totalpares;
//$setC[8]['campo'] = 'totalsus';
//$setC[8]['dato'] = $totalsus;
//$setC[9]['campo'] = 'flota';
//$setC[9]['dato'] = $flota;
//$setC[10]['campo'] = 'guia';
//$setC[10]['dato'] = $guia;
//$setC[11]['campo'] = 'responsable';
//$setC[11]['dato'] = $responsable;
//$setC[12]['campo'] = 'estado';
//$setC[12]['dato'] = $estado;
//$setC[13]['campo'] = 'observacion';
//$setC[13]['dato'] = $observacion;
//$setC[14]['campo'] = 'fechasalida';
//$setC[14]['dato'] = $fechasalida;
//$setC[15]['campo'] = 'fechallegada';
//$setC[15]['dato'] = $fechallegada;
//$setC[16]['campo'] = 'fechacancelacion';
//$setC[16]['dato'] = $fechacancelacion;
//$setC[17]['campo'] = 'idusuario';
//$setC[17]['dato'] = $idusuario;
//$setC[18]['campo'] = 'dato';
//$setC[18]['dato'] = $dato;
//$sql2 = generarInsertValues($setC);
//return "INSERT INTO ventaentrega ".$sql2;
//}
function getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $diferencia, $preciounitario,$return){
    $setC[0]['campo'] = 'iditemventa';
    $setC[0]['dato'] = $iditemventa;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'idkardex';
    $setC[2]['dato'] = $idkardex;
    $setC[3]['campo'] = 'idkardexunico';
    $setC[3]['dato'] = $idkardexunico;
    $setC[4]['campo'] = 'idmodelo';
    $setC[4]['dato'] = $idmodelo;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;
    $setC[6]['campo'] = 'talla';
    $setC[6]['dato'] = $talla;
    $setC[7]['campo'] = 'preciofinal';
    $setC[7]['dato'] = $preciofinal;
    $setC[8]['campo'] = 'precioventa';
    $setC[8]['dato'] = $precioventa;
    $setC[9]['campo'] = 'descuento';
    $setC[9]['dato'] = $descuento;
    $setC[10]['campo'] = 'descuentoporcentaje';
    $setC[10]['dato'] = $descuentoporcentaje;
    $setC[11]['campo'] = 'total';
    $setC[11]['dato'] = $total;
    $setC[12]['campo'] = 'estado';
    $setC[12]['dato'] = $estado;
    $setC[13]['campo'] = 'devolucion';
    $setC[13]['dato'] = $devolucion;
    $setC[14]['campo'] = 'tipomuestra';
    $setC[14]['dato'] = $tipomuestra;
    $setC[15]['campo'] = 'diferencia';
    $setC[15]['dato'] = $diferencia;
    $setC[16]['campo'] = 'montoventafinal';
    $setC[16]['dato'] = $montoventafinal;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO ventaitem ".$sql2;
}
function getSqlNewClientehistorial($id, $idcliente, $movimiento, $idmovimiento, $fecha, $hora, $boleta, $susentrada, $sussalida, $sussaldo, $paresentrada, $paressalida, $paressaldo, $cajaentrada, $cajasalida, $estado, $movanterior, $detalle, $dato, $return){
    $setC[0]['campo'] = 'id';
    $setC[0]['dato'] = $id;
    $setC[1]['campo'] = 'idcliente';
    $setC[1]['dato'] = $idcliente;
    $setC[2]['campo'] = 'movimiento';
    $setC[2]['dato'] = $movimiento;
    $setC[3]['campo'] = 'idmovimiento';
    $setC[3]['dato'] = $idmovimiento;
    $setC[4]['campo'] = 'fecha';
    $setC[4]['dato'] = $fecha;
    $setC[5]['campo'] = 'hora';
    $setC[5]['dato'] = $hora;
    $setC[6]['campo'] = 'boleta';
    $setC[6]['dato'] = $boleta;
    $setC[7]['campo'] = 'susentrada';
    $setC[7]['dato'] = $susentrada;
    $setC[8]['campo'] = 'sussalida';
    $setC[8]['dato'] = $sussalida;
    $setC[9]['campo'] = 'sussaldo';
    $setC[9]['dato'] = $sussaldo;
    $setC[10]['campo'] = 'paresentrada';
    $setC[10]['dato'] = $paresentrada;
    $setC[11]['campo'] = 'paressalida';
    $setC[11]['dato'] = $paressalida;
    $setC[12]['campo'] = 'paressaldo';
    $setC[12]['dato'] = $paressaldo;
    $setC[13]['campo'] = 'cajaentrada';
    $setC[13]['dato'] = $cajaentrada;
    $setC[14]['campo'] = 'cajasalida';
    $setC[14]['dato'] = $cajasalida;
    $setC[15]['campo'] = 'estado';
    $setC[15]['dato'] = $estado;
    $setC[16]['campo'] = 'movanterior';
    $setC[16]['dato'] = $movanterior;
    $setC[17]['campo'] = 'detalle';
    $setC[17]['dato'] = $detalle;
    $setC[18]['campo'] = 'dato';
    $setC[18]['dato'] = $dato;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO clientehistorial ".$sql2;
}

function getSqlNewVentapago($idventa, $fecha, $hora, $tipoventa, $monto, $totalsus, $factura, $recibo, $responsable, $estado, $observacion, $return){
    $setC[0]['campo'] = 'idventa';
    $setC[0]['dato'] = $idventa;
    $setC[1]['campo'] = 'fecha';
    $setC[1]['dato'] = $fecha;
    $setC[2]['campo'] = 'hora';
    $setC[2]['dato'] = $hora;
    $setC[3]['campo'] = 'tipoventa';
    $setC[3]['dato'] = $tipoventa;
    $setC[4]['campo'] = 'monto';
    $setC[4]['dato'] = $monto;
    $setC[5]['campo'] = 'totalsus';
    $setC[5]['dato'] = $totalsus;
    $setC[6]['campo'] = 'factura';
    $setC[6]['dato'] = $factura;
    $setC[7]['campo'] = 'recibo';
    $setC[7]['dato'] = $recibo;
    $setC[8]['campo'] = 'responsable';
    $setC[8]['dato'] = $responsable;
    $setC[9]['campo'] = 'estado';
    $setC[9]['dato'] = $estado;
    $setC[10]['campo'] = 'observacion';
    $setC[10]['dato'] = $observacion;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO ventapago ".$sql2;
}
function getSqlNewDetalledevolucion($iddetalledevolucion, $idventadetalle, $iditemventa, $idkardexunico, $idalmacen, $idusuario, $numerorecibo, $fecha, $hora, $valorcalzado, $montodevuelto, $observacion, $saldocantidad, $tipodevolucion, $tipoventa, $idkardex, $tipofalla, $iddevolucion, $return){
    $setC[0]['campo'] = 'iddetalledevolucion';
    $setC[0]['dato'] = $iddetalledevolucion;
    $setC[1]['campo'] = 'idventadetalle';
    $setC[1]['dato'] = $idventadetalle;
    $setC[2]['campo'] = 'iditemventa';
    $setC[2]['dato'] = $iditemventa;
    $setC[3]['campo'] = 'idkardexunico';
    $setC[3]['dato'] = $idkardexunico;
    $setC[4]['campo'] = 'idalmacen';
    $setC[4]['dato'] = $idalmacen;
    $setC[5]['campo'] = 'idusuario';
    $setC[5]['dato'] = $idusuario;
    $setC[6]['campo'] = 'numerorecibo';
    $setC[6]['dato'] = $numerorecibo;
    $setC[7]['campo'] = 'fecha';
    $setC[7]['dato'] = $fecha;
    $setC[8]['campo'] = 'hora';
    $setC[8]['dato'] = $hora;
    $setC[9]['campo'] = 'valorcalzado';
    $setC[9]['dato'] = $valorcalzado;
    $setC[10]['campo'] = 'montodevuelto';
    $setC[10]['dato'] = $montodevuelto;
    $setC[11]['campo'] = 'observacion';
    $setC[11]['dato'] = $observacion;
    $setC[12]['campo'] = 'saldocantidad';
    $setC[12]['dato'] = $saldocantidad;
    $setC[13]['campo'] = 'tipodevolucion';
    $setC[13]['dato'] = $tipodevolucion;
    $setC[14]['campo'] = 'tipoventa';
    $setC[14]['dato'] = $tipoventa;
    $setC[15]['campo'] = 'idkardex';
    $setC[15]['dato'] = $idkardex;
    $setC[16]['campo'] = 'tipofalla';
    $setC[16]['dato'] = $tipofalla;
    $setC[17]['campo'] = 'iddevolucion';
    $setC[17]['dato'] = $iddevolucion;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO detalledevolucion ".$sql2;
}
function getSqlNewDevolucion($iddevolucion, $idventadetalle, $idalmacen, $fecha, $hora, $pares, $venta, $idvendedor, $idmarca, $idcliente, $estado, $idusuario, $dato,$observacion, $return){
    $setC[0]['campo'] = 'iddevolucion';
    $setC[0]['dato'] = $iddevolucion;
    $setC[1]['campo'] = 'idventadetalle';
    $setC[1]['dato'] = $idventadetalle;
    $setC[2]['campo'] = 'idalmacen';
    $setC[2]['dato'] = $idalmacen;
    $setC[3]['campo'] = 'fecha';
    $setC[3]['dato'] = $fecha;
    $setC[4]['campo'] = 'hora';
    $setC[4]['dato'] = $hora;
    $setC[5]['campo'] = 'pares';
    $setC[5]['dato'] = $pares;
    $setC[6]['campo'] = 'venta';
    $setC[6]['dato'] = $venta;
    $setC[7]['campo'] = 'idvendedor';
    $setC[7]['dato'] = $idvendedor;
    $setC[8]['campo'] = 'idmarca';
    $setC[8]['dato'] = $idmarca;
    $setC[9]['campo'] = 'idcliente';
    $setC[9]['dato'] = $idcliente;
    $setC[10]['campo'] = 'estado';
    $setC[10]['dato'] = $estado;
    $setC[11]['campo'] = 'idusuario';
    $setC[11]['dato'] = $idusuario;
    $setC[12]['campo'] = 'dato';
    $setC[12]['dato'] = $dato;
    $setC[13]['campo'] = 'observacion';
    $setC[13]['dato'] = $observacion;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO devolucion ".$sql2;
}
function getSqlNewCreditodevolucion($idcrecliente, $idventa, $iddevolucion, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion, $factura, $numero, $return){
    $setC[0]['campo'] = 'idcrecliente';
    $setC[0]['dato'] = $idcrecliente;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'iddevolucion';
    $setC[2]['dato'] = $iddevolucion;
    $setC[3]['campo'] = 'fechapago';
    $setC[3]['dato'] = $fechapago;
    $setC[4]['campo'] = 'boleta';
    $setC[4]['dato'] = $boleta;
    $setC[5]['campo'] = 'idmarca';
    $setC[5]['dato'] = $idmarca;
    $setC[6]['campo'] = 'idvendedor';
    $setC[6]['dato'] = $idvendedor;
    $setC[7]['campo'] = 'monto';
    $setC[7]['dato'] = $monto;
    $setC[8]['campo'] = 'tipopago';
    $setC[8]['dato'] = $tipopago;
    $setC[9]['campo'] = 'estado';
    $setC[9]['dato'] = $estado;
    $setC[10]['campo'] = 'observacion';
    $setC[10]['dato'] = $observacion;
    $setC[11]['campo'] = 'factura';
    $setC[11]['dato'] = $factura;
    $setC[12]['campo'] = 'numero';
    $setC[12]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditodevolucion ".$sql2;
}
function getSqlNewTraspasosinternos($numero, $fecha, $idkardexunico, $idkardex, $idventa, $idvendedor, $idmodelo, $saldocantidad, $talla, $preciounitario, $idalmacen, $idvendedororigen, $return){
    $setC[0]['campo'] = 'numero';
    $setC[0]['dato'] = $numero;
    $setC[1]['campo'] = 'fecha';
    $setC[1]['dato'] = $fecha;
    $setC[2]['campo'] = 'idkardexunico';
    $setC[2]['dato'] = $idkardexunico;
    $setC[3]['campo'] = 'idkardex';
    $setC[3]['dato'] = $idkardex;
    $setC[4]['campo'] = 'idventa';
    $setC[4]['dato'] = $idventa;
    $setC[5]['campo'] = 'idvendedor';
    $setC[5]['dato'] = $idvendedor;
    $setC[6]['campo'] = 'idmodelo';
    $setC[6]['dato'] = $idmodelo;
    $setC[7]['campo'] = 'saldocantidad';
    $setC[7]['dato'] = $saldocantidad;
    $setC[8]['campo'] = 'talla';
    $setC[8]['dato'] = $talla;
    $setC[9]['campo'] = 'preciounitario';
    $setC[9]['dato'] = $preciounitario;
    $setC[10]['campo'] = 'idalmacen';
    $setC[10]['dato'] = $idalmacen;
    $setC[11]['campo'] = 'idvendedororigen';
    $setC[11]['dato'] = $idvendedororigen;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO traspasosinternos ".$sql2;
}
function getSqlNewModelo($idmodelo, $idmodelodetalle, $idmarca, $idvendedor, $codigo, $color, $material, $linea, $cliente, $numero, $idingreso, $fecha, $hora, $generado, $opciont, $unido, $inventario, $rebaja, $estado, $idcoleccion, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $modificar, $talla, $idalmacen, $estadotraspaso, $fechaingreso, $return){
    $setC[0]['campo'] = 'idmodelo';
    $setC[0]['dato'] = $idmodelo;
    $setC[1]['campo'] = 'idmodelodetalle';
    $setC[1]['dato'] = $idmodelodetalle;
    $setC[2]['campo'] = 'idmarca';
    $setC[2]['dato'] = $idmarca;
    $setC[3]['campo'] = 'idvendedor';
    $setC[3]['dato'] = $idvendedor;
    $setC[4]['campo'] = 'codigo';
    $setC[4]['dato'] = $codigo;
    $setC[5]['campo'] = 'color';
    $setC[5]['dato'] = $color;
    $setC[6]['campo'] = 'material';
    $setC[6]['dato'] = $material;
    $setC[7]['campo'] = 'linea';
    $setC[7]['dato'] = $linea;
    $setC[8]['campo'] = 'cliente';
    $setC[8]['dato'] = $cliente;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;
    $setC[10]['campo'] = 'idingreso';
    $setC[10]['dato'] = $idingreso;
    $setC[11]['campo'] = 'fecha';
    $setC[11]['dato'] = $fecha;
    $setC[12]['campo'] = 'hora';
    $setC[12]['dato'] = $hora;
    $setC[13]['campo'] = 'generado';
    $setC[13]['dato'] = $generado;
    $setC[14]['campo'] = 'opciont';
    $setC[14]['dato'] = $opciont;
    $setC[15]['campo'] = 'unido';
    $setC[15]['dato'] = $unido;
    $setC[16]['campo'] = 'inventario';
    $setC[16]['dato'] = $inventario;
    $setC[17]['campo'] = 'rebaja';
    $setC[17]['dato'] = $rebaja;
    $setC[18]['campo'] = 'estado';
    $setC[18]['dato'] = $estado;
    $setC[19]['campo'] = 'idcoleccion';
    $setC[19]['dato'] = $idcoleccion;
    $setC[20]['campo'] = 'idcliente';
    $setC[20]['dato'] = $idcliente;
    $setC[21]['campo'] = 'precioventa';
    $setC[21]['dato'] = $precioventa;
    $setC[22]['campo'] = 'preciounitario';
    $setC[22]['dato'] = $preciounitario;
    $setC[23]['campo'] = 'preciototalcaja';
    $setC[23]['dato'] = $preciototalcaja;
    $setC[24]['campo'] = 'numerocajas';
    $setC[24]['dato'] = $numerocajas;
    $setC[25]['campo'] = 'numeroparesfila';
    $setC[25]['dato'] = $numeroparesfila;
    $setC[26]['campo'] = 'totalparescaja';
    $setC[26]['dato'] = $totalparescaja;
    $setC[27]['campo'] = 'numeracion';
    $setC[27]['dato'] = $numeracion;
    $setC[28]['campo'] = 'modificar';
    $setC[28]['dato'] = $modificar;
    $setC[29]['campo'] = 'talla';
    $setC[29]['dato'] = $talla;
    $setC[30]['campo'] = 'idalmacen';
    $setC[30]['dato'] = $idalmacen;
    $setC[31]['campo'] = 'estadotraspaso';
    $setC[31]['dato'] = $estadotraspaso;
    $setC[32]['campo'] = 'fechaingreso';
    $setC[32]['dato'] = $fechaingreso;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO modelo ".$sql2;
}

function getSqlNewVentafinalmodelo($idventa, $fecha, $idmodelo, $idkardexunico, $idmarca, $idvendedor, $pares, $precioventafinal, $precioventamayor, $diferencia, $diferenciadato, $return){
    $setC[0]['campo'] = 'idventa';
    $setC[0]['dato'] = $idventa;
    $setC[1]['campo'] = 'fecha';
    $setC[1]['dato'] = $fecha;
    $setC[2]['campo'] = 'idmodelo';
    $setC[2]['dato'] = $idmodelo;
    $setC[3]['campo'] = 'idkardexunico';
    $setC[3]['dato'] = $idkardexunico;
    $setC[4]['campo'] = 'idmarca';
    $setC[4]['dato'] = $idmarca;
    $setC[5]['campo'] = 'idvendedor';
    $setC[5]['dato'] = $idvendedor;
    $setC[6]['campo'] = 'pares';
    $setC[6]['dato'] = $pares;
    $setC[7]['campo'] = 'precioventafinal';
    $setC[7]['dato'] = $precioventafinal;
    $setC[8]['campo'] = 'precioventamayor';
    $setC[8]['dato'] = $precioventamayor;
    $setC[9]['campo'] = 'diferencia';
    $setC[9]['dato'] = $diferencia;
    $setC[10]['campo'] = 'diferenciadato';
    $setC[10]['dato'] = $diferenciadato;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO ventafinalmodelo ".$sql2;
}
function getSqlNewBitacoraforzar($idusuario, $fecha, $hora, $accion, $idaccion, $idalmacen, $return){
$setC[0]['campo'] = 'idusuario';
$setC[0]['dato'] = $idusuario;
$setC[1]['campo'] = 'fecha';
$setC[1]['dato'] = $fecha;
$setC[2]['campo'] = 'hora';
$setC[2]['dato'] = $hora;
$setC[3]['campo'] = 'accion';
$setC[3]['dato'] = $accion;
$setC[4]['campo'] = 'idaccion';
$setC[4]['dato'] = $idaccion;
$setC[5]['campo'] = 'idalmacen';
$setC[5]['dato'] = $idalmacen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO bitacoraforzar ".$sql2;
}

?>
