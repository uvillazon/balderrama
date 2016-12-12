<?php
//function ListarVentasCredito($start, $limit, $sort, $dir, $callback, $_dc, $return, $consubcategoria = false)
//{
function BuscarEmpresaporCliente($callback, $_dc, $idempresa,$idcliente,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $proveedores =  ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);
    if($proveedores['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $proveedores['resultado'];
    }
    $categorias = ListarEmpresa('', '', '', '', '', '','',true);
    if($categorias['error'] == true)
    {
        $value['empresas'] = "true";
        $value['empresaM'] = $categorias['resultado'];
    }

$sql1 = "SELECT
  e.nombre AS empresa,CONCAT( cl.nombre, '-', cl.apellido ) AS cliente
FROM
  empresas e,clienteempresa cl
WHERE
  e.idempresa='$idempresa' AND cl.idclienteempresa='$idcliente' AND cl.idempresa=e.idempresa
";
        $detalleA = findBySqlReturnCampoUnique($sql1, true, true, "empresa");
        $value['empresa'] =  $detalleA['resultado'];
          $detalleA = findBySqlReturnCampoUnique($sql1, true, true, "cliente");
        $value['cliente'] =  $detalleA['resultado'];
    $dev['mensaje'] = "Se cargo el formulario de Cliente";
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
function listarventasporcliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idempresa,$idcliente)
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

    //$select ="cl.idclienteempresa, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, pc.ventaoriginal AS credito, pc.pago1 AS mes1, SUM( pa.monto ) AS cobro1, pc.pago2 AS mes2, 0 AS cobro2, SUM( pc.pago3 + pc.pago4 + pc.pago5 + pc.pago6 + pc.pago7 ) AS mes3, 0 AS cobro3, 0 AS total, em.codigo AS cobrador";
    $select ="vd.numero,c.idventadetalle,vd.boleta,vd.fecha,c.no_pares AS pares,c.papeleta,montototal AS importe,montototal AS totalventa";
    $from = "credito c,ventasdetalle vd";
    $where = "vd.idventadetalle=c.idventadetalle";
        if($idempresa != null && $idempresa != "")
    {
        $where .= " AND c.idempresa ='$idempresa' ";

    }
if($idcliente != null && $idcliente != "")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $where .= " AND c.idclienteempresa ='$idcliente' ";
    }

    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
          // echo $sql;
    $devT = getTablaToArrayOfSQL($sql);
    $dev['error'] = $devT['error'];
    $dev['mensaje'] = $devT['mensaje'];
    $dev['resultado'] = $devT['resultado'];
    $dev['totalCount'] = $devT['totalCount'];

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
   function ListarVentasCredito($callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

   $sql = "SELECT v.idventadetalle, v.fecha, v.cantidad, cr.montototal AS total, cr.saldo, em.nombre AS nombreempresa, CONCAT( ce.apellido, '-', ce.nombre ) AS nombrecliente, v.boleta, montopapeleta AS papeleta, cr.estado AS estado, cr.tiempocredito
FROM ventasdetalle v, empresas em, clienteempresa ce, credito cr
WHERE v.idventadetalle = cr.idventadetalle
AND cr.idempresa = em.idempresa
AND cr.idclienteempresa = ce.idclienteempresa
AND v.credito = 'SI'
AND cr.observacion = 'Sin Validar'
";
      //  echo $sql;
        //  $value['multivendedor'] =  $_SESSION['idusuario'];
//    $dev['mensaje'] = "Se cargaron los parametros ";
//    $dev['error']   = "true";
//    $dev['resultado'] = $value;
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
function txNewUpdateVenta($resultado, $return)
{ 
        

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $product = $resultado->productos;
 for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
        $idventadetalle = $producto->idventadetalle;
        $empresaA  = $producto->empresa;
        $sql1= "SELECT
              idempresa
            FROM
              empresas
            WHERE
              nombre = '$empresaA'";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempresa");
    $idempresa = $result1['resultado'];
          $clienteA  = $producto->cliente;
         $idsCAr = split("-", $clienteA);
$nom=$idsCAr[1];

$apellido=$idsCAr[0];

$sql2= "SELECT
              idclienteempresa
            FROM
              clienteempresa
            WHERE
              nombre = '$nom' AND apellido='$apellido' AND idempresa='$idempresa'";
    $result2 = findBySqlReturnCampoUnique($sql2, true, true, "idclienteempresa");
    $idclienteempresa = $result2['resultado'];

      
        $totalA  = $producto->total;
        $saldoA  = $producto->saldo;
        $tiempoA  = $producto->tiempocredito;
        $papeletaA  = $producto->papeleta;
        $estadoA  = $producto->estado;

$sql[] = "UPDATE credito SET idempresa='$idempresa',idclienteempresa='$idclienteempresa',montototal='$totalA',estado='$estadoA',saldo='$saldoA',papeleta='$papeletaA',tiempocredito='$tiempoA'WHERE idventadetalle='$idventadetalle'";
 $sql1= "SELECT
              saldoactual
       FROM
              clienteempresa
            WHERE
              idclienteempresa='$idclienteempresa' AND idempresa='$idempresa'";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "saldoactual");
    $saldoactual = $result1['resultado'];
   

$saldonuevo=$saldoactual+$saldoA;

$sql[] = "UPDATE clienteempresa SET saldoanterior='$saldoactual',saldoactual='$saldonuevo'WHERE idempresa='$idempresa'AND idclienteempresa='$idclienteempresa'";

      
    }
        //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se guardo los cambios correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idventadetalle;
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = $idventadetalle;
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

function validarcreditos($productos,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
     $estado='validado';
    // echo $productos;

    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $idventadetalle = $producto->idventadetalle;
//echo $idventadetalle;
  //      $itemproducto = verificarValidarText($idproducto, true, "itemcompra", "idproducto");
   $sql1= "SELECT
             idempresa
            FROM
              credito
            WHERE
              idventadetalle = '$idventadetalle'";
        //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idempresa");
    $idempresa = $result['resultado'];
//echo $idempresa;
     $numeroC = findUltimoIDCondicion("empresa_planilla", "numero","idempresa",$idempresa, true);
    $numero = $numeroC['resultado'];
    //echo $numero;
 $sql4= "SELECT
              mes_planillla
            FROM
              empresas
            WHERE
              idempresa = '$idempresa'";
    //    echo $sql4;
    $result = findBySqlReturnCampoUnique($sql4, true, true, "mes_planillla");
    $mesplanilla = $result['resultado'];
        $sql[] = "UPDATE credito SET observacion = '$estado',no_planilla='$mesplanilla' WHERE idventadetalle = '$idventadetalle'";
    $sql1= "SELECT
              idventadetalle,idempresa,idclienteempresa,no_pares,montototal,saldo,papeleta,tiempocredito
            FROM
              credito
            WHERE
              idventadetalle = '$idventadetalle'";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempresa");
    $idempresa = $result1['resultado'];
    $result2 = findBySqlReturnCampoUnique($sql1, true, true, "idclienteempresa");
    $idclienteempresa = $result2['resultado'];
 $result4 = findBySqlReturnCampoUnique($sql1, true, true, "tiempocredito");
    $tiempo = $result4['resultado'];
     $result5 = findBySqlReturnCampoUnique($sql1, true, true, "papeleta");
    $papeleta = $result5['resultado'];
//revisar
 $sql1= "SELECT
              no_planilla,idempresa,idclienteempresa,idplanillaemitida
            FROM
              planillaemitida
            WHERE
              no_planilla = '$mesplanilla' AND idempresa='$idempresa' AND idclienteempresa='$idclienteempresa'";
   // $result = findBySqlReturnCampoUnique($sql1, true, true, "no_planilla");
   // $no_planilla = $result['resultado'];
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "no_planilla");
    $numplanilla = $result1['resultado'];
    //echo $numplanilla;
    $result2 = findBySqlReturnCampoUnique($sql1, true, true, "idplanillaemitida");
    $idplanillaemitida = $result2['resultado'];

     $sql4= "SELECT
              SUM(montototal) AS total
            FROM
              credito
            WHERE
              no_planilla = '$mesplanilla' AND idempresa='$idempresa' AND idclienteempresa='$idclienteempresa'";
    $result1 = findBySqlReturnCampoUnique($sql4, true, true, "total");
    $ventaoriginal = $result1['resultado'];
    $sql6= "SELECT
              SUM(no_pares) AS total
            FROM
              credito
            WHERE
              no_planilla = '$mesplanilla' AND idempresa='$idempresa' AND idclienteempresa='$idclienteempresa'";
    $result22 = findBySqlReturnCampoUnique($sql6, true, true, "total");
    $totalpares = $result22['resultado'];

//if{ $no_planilla==NULL || $no_planilla==""}
 if($numplanilla == null || $numplanilla == "")
    {
$cantidadcuota= $ventaoriginal/$tiempo;
 $cantidadcuota = redondear($cantidadcuota, $_SESSION['usrDigitos']);

$modulo= $ventaoriginal % $tiempo;
if($tiempo== "1")
{$pago1=$cantidadcuota;
$pago2= "0.00";
$pago3="0.00";
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "2")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota + $modulo;
$pago3="0.00";
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "3")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota + $modulo;
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "4")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota + $modulo;
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "5")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota + $modulo;
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "6")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota;
$pago6=$cantidadcuota + $modulo;
$pago7="0.00";
}
if($tiempo== "7")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota;
$pago6=$cantidadcuota;
$pago7=$cantidadcuota + $modulo;
}
 $numeroC = findUltimoID("planillacredito", "numero", true);
                $numero = $numeroC['resultado'] +1;
                $idplanilla="plac-".$idventadetalle;
$hora = date("H:i:s");
 $fecha = date("Y-m-d");

//$sql[] = getSqlNewPlanillacredito($idplanilla, $mesplanilla, $codigo, $idventadetalle, $idempresa, $idclienteempresa, $fecha, $hora, $ventaoriginal, $pago1, $pago2, $pago3, $pago4, $pago5, $pago6, $pago7, $numero, $emitido, false);

$numeroPla = findUltimoID("planillaemitida", "numero", true);
                $numeropla = $numeroPla['resultado'] +1;
                $idplanillaemitida="pe-".$numeropla;
    $anio = date("Y");
    $mes = date("m");
    $mes_actual = $mes."/".$anio;
 $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];

    if($anioplani == $anio) {
 $mes1=$mesplanilla;
    $mesp=$mesplani+1;
 $mes2="0".$mesp."/".$anio;
    $mesp2=$mesplani+2;
 $mes3="0".$mesp2."/".$anio;
    $mesp4=$mesplani+3;
 $mes4="0".$mesp4."/".$anio;
    $mesp5=$mesplani+4;
 $mes5="0".$mesp5."/".$anio;
    $mesp6=$mesplani+5;
 $mes6="0".$mesp6."/".$anio;
    $mesp7=$mesplani+6;
 $mes7="0".$mesp7."/".$anio;
    }
    $saldototal=$ventaoriginal-$papeleta;
$sql[] = getSqlNewPlanillaemitida($idplanillaemitida, $mesplanilla, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora,$ventaoriginal,$totalpares, $mes1, $pago1, $papeleta, $mes2, $pago2, $cobro2, $mes3, $pago3, $cobro3, $mes4, $pago4, $cobro4, $mes5, $pago5, $cobro5, $mes6, $pago6, $cobro6, $mes7, $pago7, $cobro7,$saldototal, $emitido, $tiempo, "N",$numeropla, false);
 $numeroPla = findUltimoID("movimientoplanilla", "numero", true);
                $numero = $numeroPla['resultado'] +1;
$sql[] = getSqlNewMovimientoplanilla($numero, $idplanillaemitida, $mesplanilla, $idempresa, $fecha, "registro", $emitido, $tiempo, $ventaoriginal, "SS", "E",  false);

    }

    
else{


    $saldofin= $ventaoriginal;
    $sql2 = "
            SELECT
  mdt.tiempo
FROM
  `parametroplanilla` mdt
WHERE
   '$saldofin' <= mdt.parametro2
AND '$saldofin' >= mdt.parametro1
";
 $ventaf= findBySqlReturnCampoUnique($sql2, true, true, "tiempo");
        $value['tiempo'] =  $ventaf['resultado'];
        $tiempo= $value['tiempo'];
$cantidadcuota= $saldofin/$tiempo;
 $cantidadcuota = redondear($cantidadcuota, $_SESSION['usrDigitos']);

$modulo= $saldofin % $tiempo;
if($tiempo== "1")
{$pago1=$cantidadcuota;
$pago2= "0.00";
$pago3="0.00";
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "2")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota + $modulo;
$pago3="0.00";
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "3")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota + $modulo;
$pago4="0.00";
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "4")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota + $modulo;
$pago5="0.00";
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "5")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota + $modulo;
$pago6="0.00";
$pago7="0.00";
}
if($tiempo== "6")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota;
$pago6=$cantidadcuota + $modulo;
$pago7="0.00";
}
if($tiempo== "7")
{$pago1=$cantidadcuota;
$pago2= $cantidadcuota;
$pago3=$cantidadcuota;
$pago4=$cantidadcuota;
$pago5=$cantidadcuota;
$pago6=$cantidadcuota;
$pago7=$cantidadcuota + $modulo;
}

$sql44= "SELECT
              SUM(monto) AS totalpago
            FROM
              pagocredito
            WHERE
              idcredito = '$mesplanilla' AND idempresa='$idempresa' AND idcliente='$idclienteempresa'";
   // $result = findBySqlReturnCampoUnique($sql1, true, true, "no_planilla");
   // $no_planilla = $result['resultado'];
   //echo $sql44;
    $result1 = findBySqlReturnCampoUnique($sql44, true, true, "totalpago");
 //   $totalcobros = $result1['resultado'];
$value['totalpago'] =  $result1['resultado'];
      $totalcobros= $value['totalpago'];
if($totalcobros>$pago1){
$cobro1=$pago1;
$cobro21=$totalcobros-$pago1;
$cobro2=$totalcobros-$pago1;}

else{
    $cobro1=$totalcobros;
}
if($cobro2>$pago2){
$cobro2=$pago2;
$cobro3=$cobro2-$pago2;}
else{
    $cobro2=$cobro21;
}
if($cobro3>$pago3){
$cobro3=$pago3;
$cobro4=$cobro3-$pago3;}

$cobro5="0.00";
$cobro6="0.00";
$cobro7="0.00";

 $totalsaldo1=$pago1+$pago2+$pago3+$pago4+$pago5+$pago6+$pago7;
$totalsaldo=$totalsaldo1-$totalcobros;
 //$sql[] = "UPDATE planillacredito SET ventaoriginal = '$saldofin', pago1='$pago1',pago2='$pago2',pago3='$pago3',pago4='$pago4',pago5='$pago5',pago6='$pago6',pago7='$pago7' WHERE idplanillacredito = '$idplanillacredito' AND no_planilla='$mesplanilla'";
$sql[] = "UPDATE planillaemitida SET ventasmes = '$saldofin', pago1='$pago1',cobro1='$cobro1',pago2='$pago2',cobro2='$cobro2',pago3='$pago3',cobro3='$cobro3',pago4='$pago4',cobro4='$cobro4',pago5='$pago5',cobro5='$cobro5',pago6='$pago6',cobro6='$cobro6',pago7='$pago7',cobro7='$cobro7',total='$totalsaldo',meses='$tiempo' WHERE no_planilla = '$mesplanilla' AND idempresa='$idempresa' AND idclienteempresa='$idclienteempresa' AND emitido='0' ";



}
    }
    //sumas totales



    //  MostrarConsulta($sql);


       if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se valido correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error ";
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
function getSqlNewPlanillacredito($idplanillacredito, $no_planilla, $codigo, $idventadetalle, $idempresa, $idclienteempresa, $fecha, $hora, $ventaoriginal, $pago1, $pago2, $pago3, $pago4, $pago5, $pago6, $pago7, $numero, $emitido, $return){
$setC[0]['campo'] = 'idplanillacredito';
$setC[0]['dato'] = $idplanillacredito;
$setC[1]['campo'] = 'no_planilla';
$setC[1]['dato'] = $no_planilla;
$setC[2]['campo'] = 'codigo';
$setC[2]['dato'] = $codigo;
$setC[3]['campo'] = 'idventadetalle';
$setC[3]['dato'] = $idventadetalle;
$setC[4]['campo'] = 'idempresa';
$setC[4]['dato'] = $idempresa;
$setC[5]['campo'] = 'idclienteempresa';
$setC[5]['dato'] = $idclienteempresa;
$setC[6]['campo'] = 'fecha';
$setC[6]['dato'] = $fecha;
$setC[7]['campo'] = 'hora';
$setC[7]['dato'] = $hora;
$setC[8]['campo'] = 'ventaoriginal';
$setC[8]['dato'] = $ventaoriginal;
$setC[9]['campo'] = 'pago1';
$setC[9]['dato'] = $pago1;
$setC[10]['campo'] = 'pago2';
$setC[10]['dato'] = $pago2;
$setC[11]['campo'] = 'pago3';
$setC[11]['dato'] = $pago3;
$setC[12]['campo'] = 'pago4';
$setC[12]['dato'] = $pago4;
$setC[13]['campo'] = 'pago5';
$setC[13]['dato'] = $pago5;
$setC[14]['campo'] = 'pago6';
$setC[14]['dato'] = $pago6;
$setC[15]['campo'] = 'pago7';
$setC[15]['dato'] = $pago7;
$setC[16]['campo'] = 'numero';
$setC[16]['dato'] = $numero;
$setC[17]['campo'] = 'emitido';
$setC[17]['dato'] = $emitido;
$sql2 = generarInsertValues($setC);
return "INSERT INTO planillacredito ".$sql2;
}
function getSqlNewPlanillaemitida($idplanillaemitida, $no_planilla, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora, $ventasmes, $pares, $mes1, $pago1, $cobro1, $mes2, $pago2, $cobro2, $mes3, $pago3, $cobro3, $mes4, $pago4, $cobro4, $mes5, $pago5, $cobro5, $mes6, $pago6, $cobro6, $mes7, $pago7, $cobro7, $total, $emitido, $meses, $tipo, $numero, $return){
$setC[0]['campo'] = 'idplanillaemitida';
$setC[0]['dato'] = $idplanillaemitida;
$setC[1]['campo'] = 'no_planilla';
$setC[1]['dato'] = $no_planilla;
$setC[2]['campo'] = 'idempresa';
$setC[2]['dato'] = $idempresa;
$setC[3]['campo'] = 'idclienteempresa';
$setC[3]['dato'] = $idclienteempresa;
$setC[4]['campo'] = 'fechaemitida';
$setC[4]['dato'] = $fechaemitida;
$setC[5]['campo'] = 'fechamodifica';
$setC[5]['dato'] = $fechamodifica;
$setC[6]['campo'] = 'fechareimpresion';
$setC[6]['dato'] = $fechareimpresion;
$setC[7]['campo'] = 'hora';
$setC[7]['dato'] = $hora;
$setC[8]['campo'] = 'ventasmes';
$setC[8]['dato'] = $ventasmes;
$setC[9]['campo'] = 'pares';
$setC[9]['dato'] = $pares;
$setC[10]['campo'] = 'mes1';
$setC[10]['dato'] = $mes1;
$setC[11]['campo'] = 'pago1';
$setC[11]['dato'] = $pago1;
$setC[12]['campo'] = 'cobro1';
$setC[12]['dato'] = $cobro1;
$setC[13]['campo'] = 'mes2';
$setC[13]['dato'] = $mes2;
$setC[14]['campo'] = 'pago2';
$setC[14]['dato'] = $pago2;
$setC[15]['campo'] = 'cobro2';
$setC[15]['dato'] = $cobro2;
$setC[16]['campo'] = 'mes3';
$setC[16]['dato'] = $mes3;
$setC[17]['campo'] = 'pago3';
$setC[17]['dato'] = $pago3;
$setC[18]['campo'] = 'cobro3';
$setC[18]['dato'] = $cobro3;
$setC[19]['campo'] = 'mes4';
$setC[19]['dato'] = $mes4;
$setC[20]['campo'] = 'pago4';
$setC[20]['dato'] = $pago4;
$setC[21]['campo'] = 'cobro4';
$setC[21]['dato'] = $cobro4;
$setC[22]['campo'] = 'mes5';
$setC[22]['dato'] = $mes5;
$setC[23]['campo'] = 'pago5';
$setC[23]['dato'] = $pago5;
$setC[24]['campo'] = 'cobro5';
$setC[24]['dato'] = $cobro5;
$setC[25]['campo'] = 'mes6';
$setC[25]['dato'] = $mes6;
$setC[26]['campo'] = 'pago6';
$setC[26]['dato'] = $pago6;
$setC[27]['campo'] = 'cobro6';
$setC[27]['dato'] = $cobro6;
$setC[28]['campo'] = 'mes7';
$setC[28]['dato'] = $mes7;
$setC[29]['campo'] = 'pago7';
$setC[29]['dato'] = $pago7;
$setC[30]['campo'] = 'cobro7';
$setC[30]['dato'] = $cobro7;
$setC[31]['campo'] = 'total';
$setC[31]['dato'] = $total;
$setC[32]['campo'] = 'emitido';
$setC[32]['dato'] = $emitido;
$setC[33]['campo'] = 'meses';
$setC[33]['dato'] = $meses;
$setC[34]['campo'] = 'tipo';
$setC[34]['dato'] = $tipo;
$setC[35]['campo'] = 'numero';
$setC[35]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO planillaemitida ".$sql2;
}


function getSqlNewMovimientoplanilla($numero, $idplanillaemitida, $no_planilla, $idempresa, $fecha, $detalle, $emitido, $meses, $saldototal, $tipoplanilla, $tiporegistro, $return){
$setC[0]['campo'] = 'numero';
$setC[0]['dato'] = $numero;
$setC[1]['campo'] = 'idplanillaemitida';
$setC[1]['dato'] = $idplanillaemitida;
$setC[2]['campo'] = 'no_planilla';
$setC[2]['dato'] = $no_planilla;
$setC[3]['campo'] = 'idempresa';
$setC[3]['dato'] = $idempresa;
$setC[4]['campo'] = 'fecha';
$setC[4]['dato'] = $fecha;
$setC[5]['campo'] = 'detalle';
$setC[5]['dato'] = $detalle;
$setC[6]['campo'] = 'emitido';
$setC[6]['dato'] = $emitido;
$setC[7]['campo'] = 'meses';
$setC[7]['dato'] = $meses;
$setC[8]['campo'] = 'saldototal';
$setC[8]['dato'] = $saldototal;
$setC[9]['campo'] = 'tipoplanilla';
$setC[9]['dato'] = $tipoplanilla;
$setC[10]['campo'] = 'tiporegistro';
$setC[10]['dato'] = $tiporegistro;
$sql2 = generarInsertValues($setC);
return "INSERT INTO movimientoplanilla ".$sql2;
}


function txConfirmaCredito($productos, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $estado='validado';
    for($i = 0; $i< count($productos); $i++)
    {
        $sql[] = "UPDATE credito SET observacion = '$estado' WHERE idventadetalle = '".$productos[$i]."'";
  
    }
    //MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql) == true)
    {
        $dev['mensaje'] = "Se valido correctamente los creditos ";
        $dev['error']   = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Error al Validar";
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
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }

}

function ClienteempresaActivo($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  cle.idclienteempresa AS idcliente,
  cle.codigo,
CONCAT(cle.nombre,'-',cle.apellido) AS nombre,
  cle.idempresa,
  cle.estado
FROM
  clienteempresa cle
WHERE
  cle.estado = 'Activo' $order LIMIT $start,$limit

";
    //        echo $sql;
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


?>