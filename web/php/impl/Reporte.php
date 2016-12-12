<?php
if (isset($_POST['button']))
 {

$loc = "saveddata.php?IDNumber=" . $IDNumber;
		echo "<script LANGUAGE='JavaScript'>";
		echo "window.open($loc,'mywin','left=20,top=20,width=500,height=500,toolbar=0,resizable=1')";
		echo "</script>";
}
?>
<?php

?>
<?php
session_name("balderrama");
session_start();
function reportegeneralmarcaresumen($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
 //$idalmacen=$_SESSION['idalmacen'];
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN SISTEMA POR MARCA TOTAL<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "idalmacen,codigo,nombrecompleto";
    $from = "almacenes";
    $where = "tipoalmacen='mayor' ";

    $sql2 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
   for($i=0;$i<=$row15;$i++){
     $codigo = $sql3[$i];
     $idalmacen = $codigo['idalmacen'];
     $nombrevendedor= $codigo['nombrecompleto'];
     $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
     $html .=" </td> ";
     $html .= "</tr>";
      $html .= "<tr>";
     $html .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:18px;'>$nombrevendedor</td>";
 $html .= "</tr>";
     $html .= "<tr>";

//
$sqlruta ="
SELECT m.idmarca
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen' and m.estado='activo' and m.origen!='MUESTRA' GROUP BY m.idmarca
";
    $sqlrutafin = $sqlruta;
  // echo $sqlrutafin;
  
    $table = dibujarTablarresumenventas($fechainicio,$fechafin,$sqlrutafin, $idmarca,$idalmacen,$nombrevendedor,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
    $html .= $table['resultado'];
$html .= "</tr>";
   $html .= "</tr>";
   }
    $html .= "</tr>";
    $html .= "</table>";



 $html .= "<tr>";
 $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";

    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function reportegeneralmarca($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
 //$idalmacen=$_SESSION['idalmacen'];
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN SISTEMA POR MARCA<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "idalmacen,codigo,nombrecompleto";
    $from = "almacenes";
    $where = "tipoalmacen='mayor' ";

    $sql2 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
   for($i=0;$i<=$row15;$i++){
     $codigo = $sql3[$i];
     $idalmacen = $codigo['idalmacen'];
     $nombrevendedor= $codigo['nombrecompleto'];
     $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
     $html .=" </td> ";
     $html .= "</tr>";
      $html .= "<tr>";

      $html .= "<h1>";
     $html .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:15px;'>$nombrevendedor</td>";
     $html .= "</h1>";
 $html .= "</tr>";
     $html .= "<tr>";
     $select = "m.idmarca";
     $from = "marcas m";
     $where = "m.estado='activo' and origen!='MUESTRA' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
 //echo $sql25;
$table = dibujarTablaalmacenmarca($sql25,$idcliente,$idalmacen,$nombrevendedor,$codigoempleado,$fechainicio,$fechafin);
$html .= $table['resultado'];
   $html .= "</tr>";
   $html .= "</tr>";
      $html .= "<tr>";

$select = "SUM(vi.cantidad) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//echo $sql2p;
$totalparesventa = $almacenA1['resultado'];
$totalcajasventa = $totalparesventa/12;
$totalcajasventa = round($totalcajasventa,2);
   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

    $select = "COUNT(v.iddetalledevolucion) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion AND d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
     $totalparesdev = $almacenA1['resultado'];
     $totalcajasdev = $totalparesdev/12;
     $totalcajasdev= round($totalcajasdev,2);
      $select = "SUM(v.valorcalzado) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion AND d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
     $totalbsdev = $almacenA1['resultado'];

   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];
 $select2 = "sum(cp.monto) as monto";
   $from = "creditopago cp,empleados e";
   $where = "cp.idvendedor=e.idempleado and cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin' and e.idalmacen='$idalmacen'";
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cobros = $idalmacenA['resultado'];
$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c,empleados e";
   $where = "cl.idcliente=c.idcliente and cl.idvendedor=e.idempleado and cl.estado='pendiente' and e.idalmacen='$idalmacen'";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cuentas = $idalmacenA['resultado'];

$select1 = "SUM(k.saldocantidad) AS pares";
    $from = "kardexdetallepar k,modelo m";
   $where = "k.idmodelo=m.idmodelo and m.estado='Activo' and k.idalmacen='$idalmacen'  ";


 $select2 = " SUM(k.saldocantidad*k.preciounitario) AS sus";

  $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
   $paresstact = $creditoA111['resultado'];
   $cajasstact = $paresstact/12;
$cajasstact = round($cajasstact);
    $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
   $totalbsstact = $creditoA111['resultado'];
$totalbsstact = round($totalbsstact);

    $select1 = "nombrecompleto AS Totales,'$totalcajasventa' as vcaja,'$totalparesventa' as vpar,'$totalbsventa' as vsus,'$totalcajasdev' as devcaja,'$totalparesdev' as devpar,'$totalbsdev' as devsus,'$cobros' as cobro,'$cuentas' as porcobrar,'$cajasstact' as cajasst,'$paresstact' as paresst,'$totalbsstact' as susst";
    $from1 = "almacenes";
    $where1 = " tipoalmacen='mayor' and idalmacen='$idalmacen'";
    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by idalmacen";
    $sqlrutafin = $sqlruta;

    $table2 = dibujarTablaresumentotal($sqlrutafin, $nombrevendedor,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
   $html .= $table2['resultado'];
    $html .= "</tr>";
 }
    $html .= "</tr>";
    $html .= "</table>";



 $html .= "<tr>";
 $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";

    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function reportegeneral($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
 $idalmacen=$_SESSION['idalmacen'];
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN SISTEMA POR VENDEDOR<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "idalmacen,codigo,nombrecompleto";
    $from = "almacenes";
    $where = "tipoalmacen='mayor' ";

    $sql2 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
   for($i=0;$i<=$row15;$i++){
     $codigo = $sql3[$i];
     $idalmacen = $codigo['idalmacen'];
     $nombrevendedor= $codigo['nombrecompleto'];
     $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
     $html .=" </td> ";
     $html .= "</tr>";
      $html .= "<tr>";
       $html .= "<h1>";
     $html .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombrevendedor</td>";
         $html .= "</h1>";
 $html .= "</tr>";
     $html .= "<tr>";
     //fin parte 1

     $select = "m.idempleado";
     $from = "empleados m";
     $where = "m.idalmacen='$idalmacen' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";

$table = dibujarTablaalmacenvendedor($sql25,$idcliente,$idalmacen,$nombrevendedor,$codigoempleado,$fechainicio,$fechafin);
$html .= $table['resultado'];
   $html .= "</tr>";
//finnuevo
   $html .= "</tr>";
      $html .= "<tr>";

$select = "SUM(vi.cantidad) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//echo $sql2p;
$totalparesventa = $almacenA1['resultado'];
$totalcajasventa = $totalparesventa/12;
$totalcajasventa = round($totalcajasventa,2);
   $select = "sUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

    $select = "COUNT(v.iddetalledevolucion) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion AND d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
     $totalparesdev = $almacenA1['resultado'];
     $totalcajasdev = $totalparesdev/12;
     $totalcajasdev= round($totalcajasdev,2);
      $select = "SUM(v.valorcalzado) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion AND d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
     $totalbsdev = $almacenA1['resultado'];

   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];
 $select2 = "sum(cp.monto) as monto";
   $from = "creditopago cp,empleados e";
   $where = "cp.idvendedor=e.idempleado and cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin' and e.idalmacen='$idalmacen'";
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cobros = $idalmacenA['resultado'];
$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c,empleados e";
   $where = "cl.idcliente=c.idcliente and cl.idvendedor=e.idempleado and cl.estado='pendiente' and e.idalmacen='$idalmacen'";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cuentas = $idalmacenA['resultado'];

$select1 = "SUM(k.saldocantidad) AS pares";
    $from = "kardexdetallepar k,modelo m";
   $where = "k.idmodelo=m.idmodelo and m.estado='Activo' and k.idalmacen='$idalmacen'  ";


 $select2 = " SUM(k.saldocantidad*k.preciounitario) AS sus";

  $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
   $paresstact = $creditoA111['resultado'];
   $cajasstact = $paresstact/12;
$cajasstact = round($cajasstact);
    $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
   $totalbsstact = $creditoA111['resultado'];
$totalbsstact = round($totalbsstact);

    $select1 = "nombrecompleto AS Totales,'$totalcajasventa' as vcaja,'$totalparesventa' as vpar,'$totalbsventa' as vsus,'$totalcajasdev' as devcaja,'$totalparesdev' as devpar,'$totalbsdev' as devsus,'$cobros' as cobro,'$cuentas' as porcobrar,'$cajasstact' as cajasst,'$paresstact' as paresst,'$totalbsstact' as susst";
    $from1 = "almacenes";
    $where1 = " tipoalmacen='mayor' and idalmacen='$idalmacen'";
    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by idalmacen";
    $sqlrutafin = $sqlruta;
  
    $table2 = dibujarTablaresumentotal($sqlrutafin, $nombrevendedor,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
   $html .= $table2['resultado'];
    $html .= "</tr>";
 }
    $html .= "</tr>";
    $html .= "</table>";



 $html .= "<tr>";
 $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";

    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function dibujarTablaalmacenmarca($sql,$idcliente,$idalmacen,$nombre,$codigo,$fechainicio,$fechafin)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idmarca = $dato;
                   //  echo $idvendedor;

$sqlw = "SELECT ma.nombre AS marca
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sqlw, true, true, 'marca');
   $marcanombre = $idalmacenA2['resultado'];
//
$sqlruta ="
SELECT em.idempleado
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen' and em.idmarca='$idmarca' and m.estado='activo' and m.origen!='MUESTRA'
";
    $sqlrutafin = $sqlruta;
   //echo $sqlrutafin;
    $table = dibujarTablaresumennuevomarca($fechainicio,$fechafin,$sqlrutafin, $idmarca,$idalmacen,$marcanombre,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
    $devS .= $table['resultado'];
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "</br>";
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaalmacenvendedor($sql,$idcliente,$idalmacen,$nombre,$codigo,$fechainicio,$fechafin)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idvendedor = $dato;
                   //  echo $idvendedor;
 $sql = "SELECT CONCAT( UPPER(c.nombres), '-', UPPER(c.apellidos) )AS vendedor
FROM  empleados c
WHERE c.idempleado='$idvendedor'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'vendedor');
   $vendedornombre = $idalmacenA2['resultado'];
//$sqlw = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido
//FROM  `marcas` ma
//WHERE ma.idmarca = '$idmarca'";
// $idalmacenA2 =  findBySqlReturnCampoUnique($sqlw, true, true, 'marca');
//   $marcas = $idalmacenA2['resultado'];
//
$sqlruta ="
SELECT m.idmarca
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen' and em.idempleado='$idvendedor' and m.estado='activo' and m.origen!='MUESTRA'
";
    $sqlrutafin = $sqlruta;
    $table = dibujarTablaresumennuevovendedor($fechainicio,$fechafin,$sqlrutafin, $idvendedor,$idalmacen,$vendedornombre,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
    $devS .= $table['resultado'];
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "</br>";
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
 //$table = dibujarTablaresumennuevovendedor($sqlrutafin, $idvendedor,$idalmacen,$vendedornombre,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
 function dibujarTablaresumennuevovendedor($fechainicio,$fechafin,$sql, $idempleado,$idalmacen,$titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{

   

 $sqlw = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sqlw, true, true, 'marca');
   $marcas = $idalmacenA2['resultado'];

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    //tamano $html .= "<tr><td colspan='4' align='center' font-family='Arial'>


                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                   $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>$titulo</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >Stock Actual</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";

                    $devS .= "</tr>";
                  $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>#</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
$devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'></td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";

$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $tcajasstant =0;
                    $tparesstant =0;
                    $ttotalbsstant =0;
                    $ttotalcajasrecibido =0;
                    $ttotalparesrecibido =0;
                    $ttotalbsrecibido =0;
                    $tcajastrasrec =0;
                    $tparestrasrec =0;
                    $ttotalbstrasrec =0;
                    $tcajastraspdesp =0;
                    $tparestraspdesp =0;
                    $ttotalbstraspdesp =0;
                    $ttotalcajasventa =0;
                    $ttotalparesventa =0;
                    $ttotalbsventa =0;
                      $ttotalcajasdev =0;
                    $ttotalparesdev =0;
                    $ttotalbsdev =0;
                    $tcobros =0;
                    $tcuentas =0;
                    $tcajasstact =0;
                    $tparesstact =0;
                    $ttotalbsstact =0;
                    $ttotalbs =0;
                    $trebaja =0;
                    $tporcentaje =0;
               do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmarca'];
     $idmarca =$dato;
 $sql = "SELECT ma.nombre AS marca FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";


    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
     $devS .= "<td style='display:none;'>".$dato."</td>";

    $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
 if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
  if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
   if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

   
//ojo invertir almacenes
//ini recibidos


$select = "SUM(vi.cantidad) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//echo $sql2p;
$totalparesventa = $almacenA1['resultado'];
$totalcajasventa = $totalparesventa/12;
$totalcajasventa = round($totalcajasventa,2);
   $select = "sUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

    $select = "COUNT(v.iddetalledevolucion) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
     $totalparesdev = $almacenA1['resultado'];
     $totalcajasdev = $totalparesdev/12;
     $totalcajasdev= round($totalcajasdev,2);
      $select = "SUM(v.valorcalzado) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
     $totalbsdev = $almacenA1['resultado'];

       $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
         $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
    $estadoperiodo = $almacenA1['resultado'];

   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

 $select2 = "sum(cp.monto) as monto";
   $from = "creditopago cp,empleados e";
   $where = "cp.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cp.idvendedor='$idempleado' and cp.idmarca='$idmarca' AND cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cobros = $idalmacenA['resultado'];
$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c,empleados e";
   $where = "cl.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca' and cl.idvendedor='$idempleado'";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cuentas = $idalmacenA['resultado'];

$select1 = "SUM(k.saldocantidad) AS pares";
    $from = "kardexdetallepar k,modelo m";
   $where = "k.idmodelo=m.idmodelo and m.estado='Activo' and k.idalmacen='$idalmacen'  and m.idvendedor='$idempleado'";

 if($idmarca != null && $idmarca != "")
  { $where .= " AND m.idmarca ='$idmarca' ";}
 $select2 = " SUM(k.saldocantidad*k.preciounitario) AS sus";

  $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
   $paresstact = $creditoA111['resultado'];
   $cajasstact = $paresstact/12;
$cajasstact = round($cajasstact);
    $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
   $totalbsstact = $creditoA111['resultado'];
$totalbsstact = round($totalbsstact);

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsventa."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsdev."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
$cajasstact =round($cajasstact,2);
                       $tcajasstant =$tcajasstant+$cajasstant;

                    $tparesstant =$tparesstant+$paresstant;
                    $ttotalbsstant =$ttotalbsstant+$totalbsstant;
                    $ttotalcajasrecibido =$ttotalcajasrecibido+$totalcajasrecibido;
                    $ttotalparesrecibido =$ttotalparesrecibido+$totalparesrecibido;
                    $ttotalbsrecibido =$ttotalbsrecibido+$totalbsrecibido;
                    $tcajastrasrec =$tcajastrasrec+$cajastrasrec;
                    $tparestrasrec =$tparestrasrec+$parestrasrec;
                    $ttotalbstrasrec =$ttotalbstrasrec+$totalbstrasrec;
                    $tcajastraspdesp =$tcajastraspdesp+$cajastraspdesp;
                    $tparestraspdesp =$tparestraspdesp+$parestraspdesp;
                    $ttotalbstraspdesp =$ttotalbstraspdesp+$totalbstraspdesp;
                    $ttotalcajasventa =$ttotalcajasventa+$totalcajasventa;
                    $ttotalparesventa =$ttotalparesventa+$totalparesventa;
                    $ttotalbsventa =$ttotalbsventa+$totalbsventa;
                    $ttotalcajasdev =$ttotalcajasdev+$totalcajasdev;
                    $ttotalparesdev =$ttotalparesdev+$totalparesdev;
                    $ttotalbsdev =$ttotalbsdev+$totalbsdev;
                    $tcobros =$tcobros+$cobros;
                    $tcuentas =$tcuentas+$cuentas;
                    $tcajasstact =$tcajasstact+$cajasstact;
                    $tparesstact =$tparesstact+$paresstact;
                    $ttotalbsstact =$ttotalbsstact+$totalbsstact;
                    $ttotalbs =$ttotalbs+$totalbs;
                    $trebaja =$trebaja+$rebaja;
                    $tporcentaje =$tporcentaje+$porcentaje;
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;font-family:Arial;'></td>";
       $devS .= "<td style='display:none;'></td>";

      $fechatoday = Date("d-m-Y");
      //font-weight:bold;font-size:12px;
       $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$titulo."</td>";
        //totalesagru
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsdev."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";


             $devS .= "</tr>";

                          $devS .= "</tr>";

                  
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

 function dibujarTablarresumenventas($fechainicio,$fechafin,$sql, $idmarca,$idalmacen,$titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{



 $sqlw = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sqlw, true, true, 'marca');
   $marcas = $idalmacenA2['resultado'];

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    //tamano $html .= "<tr><td colspan='4' align='center' font-family='Arial'>


                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                   $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>$titulo</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";

                    $devS .= "</tr>";
                  $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>#</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
$devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'></td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";

$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $tcajasstant =0;
                    $tparesstant =0;
                    $ttotalbsstant =0;
                    $ttotalcajasrecibido =0;
                    $ttotalparesrecibido =0;
                    $ttotalbsrecibido =0;
                    $tcajastrasrec =0;
                    $tparestrasrec =0;
                    $ttotalbstrasrec =0;
                    $tcajastraspdesp =0;
                    $tparestraspdesp =0;
                    $ttotalbstraspdesp =0;
                    $ttotalcajasventa =0;
                    $ttotalparesventa =0;
                    $ttotalbsventa =0;
                      $ttotalcajasdev =0;
                    $ttotalparesdev =0;
                    $ttotalbsdev =0;
                    $tcobros =0;
                    $tcuentas =0;
                    $tcajasstact =0;
                    $tparesstact =0;
                    $ttotalbsstact =0;
                    $ttotalbs =0;
                    $trebaja =0;
                    $tporcentaje =0;
               do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmarca'];
     $idmarca =$dato;
 $sql2 = " SELECT nombre FROM marcas WHERE idmarca = '$idmarca' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
  $marcalista = $idalmacenA['resultado'];
     $devS .= "<td style='display:none;'>".$dato."</td>";

    $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
 if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
  if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
   if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }


//ojo invertir almacenes
//ini recibidos


$select = "SUM(vi.cantidad) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//echo $sql2p;
$totalparesventa = $almacenA1['resultado'];
$totalcajasventa = $totalparesventa/12;
$totalcajasventa = round($totalcajasventa,2);
   $select = "sUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

    $select = "COUNT(v.iddetalledevolucion) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
     $totalparesdev = $almacenA1['resultado'];
     $totalcajasdev = $totalparesdev/12;
     $totalcajasdev= round($totalcajasdev,2);
      $select = "SUM(v.valorcalzado) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
     $totalbsdev = $almacenA1['resultado'];

       $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
         $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
    $estadoperiodo = $almacenA1['resultado'];

   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";

    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

$select2 = "sum(cp.monto) as monto";
   $from = "creditopago cp,empleados e";
   $where = "cp.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cp.idmarca='$idmarca' AND
 cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cobros = $idalmacenA['resultado'];
$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c,empleados e";
   $where = "cl.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cl.idcliente=c.idcliente and
 cl.estado='pendiente' and cl.idmarca='$idmarca' ";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cuentas = $idalmacenA['resultado'];


 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsventa."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsdev."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
$cajasstact =round($cajasstact,2);
                       $tcajasstant =$tcajasstant+$cajasstant;

                    $tparesstant =$tparesstant+$paresstant;
                    $ttotalbsstant =$ttotalbsstant+$totalbsstant;
                    $ttotalcajasrecibido =$ttotalcajasrecibido+$totalcajasrecibido;
                    $ttotalparesrecibido =$ttotalparesrecibido+$totalparesrecibido;
                    $ttotalbsrecibido =$ttotalbsrecibido+$totalbsrecibido;
                    $tcajastrasrec =$tcajastrasrec+$cajastrasrec;
                    $tparestrasrec =$tparestrasrec+$parestrasrec;
                    $ttotalbstrasrec =$ttotalbstrasrec+$totalbstrasrec;
                    $tcajastraspdesp =$tcajastraspdesp+$cajastraspdesp;
                    $tparestraspdesp =$tparestraspdesp+$parestraspdesp;
                    $ttotalbstraspdesp =$ttotalbstraspdesp+$totalbstraspdesp;
                    $ttotalcajasventa =$ttotalcajasventa+$totalcajasventa;
                    $ttotalparesventa =$ttotalparesventa+$totalparesventa;
                    $ttotalbsventa =$ttotalbsventa+$totalbsventa;
                    $ttotalcajasdev =$ttotalcajasdev+$totalcajasdev;
                    $ttotalparesdev =$ttotalparesdev+$totalparesdev;
                    $ttotalbsdev =$ttotalbsdev+$totalbsdev;
                    $tcobros =$tcobros+$cobros;
                    $tcuentas =$tcuentas+$cuentas;
                    $tcajasstact =$tcajasstact+$cajasstact;
                    $tparesstact =$tparesstact+$paresstact;
                    $ttotalbsstact =$ttotalbsstact+$totalbsstact;
                    $ttotalbs =$ttotalbs+$totalbs;
                    $trebaja =$trebaja+$rebaja;
                    $tporcentaje =$tporcentaje+$porcentaje;
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;font-family:Arial;'></td>";
       $devS .= "<td style='display:none;'></td>";

      $fechatoday = Date("d-m-Y");
      //font-weight:bold;font-size:12px;
       $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$titulo."</td>";
        //totalesagru
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsdev."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";

             $devS .= "</tr>";

                          $devS .= "</tr>";


                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
 function dibujarTablaresumennuevomarca($fechainicio,$fechafin,$sql, $idmarca,$idalmacen,$titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{
 $sqlw = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sqlw, true, true, 'marca');
   $marcas = $idalmacenA2['resultado'];

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    //tamano $html .= "<tr><td colspan='4' align='center' font-family='Arial'>


                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                   $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>$titulo</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
 $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
  $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >Stock actual</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";

                    $devS .= "</tr>";
                  $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>#</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
$devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'></td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";

$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $tcajasstant =0;
                    $tparesstant =0;
                    $ttotalbsstant =0;
                    $ttotalcajasrecibido =0;
                    $ttotalparesrecibido =0;
                    $ttotalbsrecibido =0;
                    $tcajastrasrec =0;
                    $tparestrasrec =0;
                    $ttotalbstrasrec =0;
                    $tcajastraspdesp =0;
                    $tparestraspdesp =0;
                    $ttotalbstraspdesp =0;
                    $ttotalcajasventa =0;
                    $ttotalparesventa =0;
                    $ttotalbsventa =0;
                      $ttotalcajasdev =0;
                    $ttotalparesdev =0;
                    $ttotalbsdev =0;
                    $tcobros =0;
                    $tcuentas =0;
                    $tcajasstact =0;
                    $tparesstact =0;
                    $ttotalbsstact =0;
                    $ttotalbs =0;
                    $trebaja =0;
                    $tporcentaje =0;
               do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idempleado'];
     $idempleado =$dato;
 $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idempleado' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $marcalista = $idalmacenA['resultado'];
     $devS .= "<td style='display:none;'>".$dato."</td>";

    $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
 if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
  if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
   if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

$select = "SUM(vi.cantidad) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//echo $sql2p;
$totalparesventa = $almacenA1['resultado'];
$totalcajasventa = $totalparesventa/12;
$totalcajasventa = round($totalcajasventa,2);
   $select = "sUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];

    $select = "COUNT(v.iddetalledevolucion) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
     $totalparesdev = $almacenA1['resultado'];
     $totalcajasdev = $totalparesdev/12;
     $totalcajasdev= round($totalcajasdev,2);
      $select = "SUM(v.valorcalzado) AS Pares";
    $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
    $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
     $totalbsdev = $almacenA1['resultado'];

       $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
         $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
    $estadoperiodo = $almacenA1['resultado'];

   $select = "SUM(vi.precioventa) AS Pares";
    $from = "ventas v,modelo mo,ventaitem vi";
    $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $totalbsventa = $almacenA1['resultado'];


 $select2 = "sum(cp.monto) as monto";
   $from = "creditopago cp,empleados e";
   $where = "cp.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cp.idvendedor='$idempleado' and cp.idmarca='$idmarca' AND cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cobros = $idalmacenA['resultado'];
$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c,empleados e";
   $where = "cl.idvendedor=e.idempleado and e.idalmacen='$idalmacen' and cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca' and cl.idvendedor='$idempleado'";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $cuentas = $idalmacenA['resultado'];
$select1 = "SUM(k.saldocantidad) AS pares";
    $from = "kardexdetallepar k,modelo m";
   $where = "k.idmodelo=m.idmodelo and m.estado='Activo' and k.idalmacen='$idalmacen'  and m.idvendedor='$idempleado'";

 if($idmarca != null && $idmarca != "")
  { $where .= " AND m.idmarca ='$idmarca' ";}
 $select2 = " SUM(k.saldocantidad*k.preciounitario) AS sus";

  $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
   $paresstact = $creditoA111['resultado'];
   $cajasstact = $paresstact/12;
$cajasstact = round($cajasstact);
    $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
 $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
   $totalbsstact = $creditoA111['resultado'];
$totalbsstact = round($totalbsstact);


 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsventa."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsdev."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
$cajasstact =round($cajasstact,2);
                       $tcajasstant =$tcajasstant+$cajasstant;

                    $tparesstant =$tparesstant+$paresstant;
                    $ttotalbsstant =$ttotalbsstant+$totalbsstant;
                    $ttotalcajasrecibido =$ttotalcajasrecibido+$totalcajasrecibido;
                    $ttotalparesrecibido =$ttotalparesrecibido+$totalparesrecibido;
                    $ttotalbsrecibido =$ttotalbsrecibido+$totalbsrecibido;
                    $tcajastrasrec =$tcajastrasrec+$cajastrasrec;
                    $tparestrasrec =$tparestrasrec+$parestrasrec;
                    $ttotalbstrasrec =$ttotalbstrasrec+$totalbstrasrec;
                    $tcajastraspdesp =$tcajastraspdesp+$cajastraspdesp;
                    $tparestraspdesp =$tparestraspdesp+$parestraspdesp;
                    $ttotalbstraspdesp =$ttotalbstraspdesp+$totalbstraspdesp;
                    $ttotalcajasventa =$ttotalcajasventa+$totalcajasventa;
                    $ttotalparesventa =$ttotalparesventa+$totalparesventa;
                    $ttotalbsventa =$ttotalbsventa+$totalbsventa;
                    $ttotalcajasdev =$ttotalcajasdev+$totalcajasdev;
                    $ttotalparesdev =$ttotalparesdev+$totalparesdev;
                    $ttotalbsdev =$ttotalbsdev+$totalbsdev;
                    $tcobros =$tcobros+$cobros;
                    $tcuentas =$tcuentas+$cuentas;
                    $tcajasstact =$tcajasstact+$cajasstact;
                    $tparesstact =$tparesstact+$paresstact;
                    $ttotalbsstact =$ttotalbsstact+$totalbsstact;
                    $ttotalbs =$ttotalbs+$totalbs;
                    $trebaja =$trebaja+$rebaja;
                    $tporcentaje =$tporcentaje+$porcentaje;
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;font-family:Arial;'></td>";
       $devS .= "<td style='display:none;'></td>";

      $fechatoday = Date("d-m-Y");
      //font-weight:bold;font-size:12px;
       $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$titulo."</td>";
        //totalesagru
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasventa."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasdev."&nbsp;</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesdev."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsdev."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcobros."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";

             $devS .= "</tr>";

                          $devS .= "</tr>";


                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
////////////////////////////////////////////////////
function verboletacambio($idventadetalle, $return)
{
   $idtienda = $_SESSION['idtienda'];
   $html = "";
   $sql1 = " SELECT * FROM ventas WHERE idventa = '$idventadetalle' "  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
 $idalmacen=$ven[0]['idalmacen'];
 $idcliente=$ven[0]['idcliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['boleta'];
 $totalbs=$ven[0]['totalbs'];
 $totalcajas=$ven[0]['tcajas'];
 $totalsus=$ven[0]['totalsus'];
 $descuentopor=$ven[0]['descporcentaje'];
 $descuento=$ven[0]['descuento'];
 $totalNeto=$ven[0]['montoapagar'];

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];
 if($idmarca=="mar-32"){
   $sql3 = "SELECT idmodelo FROM ventaitem WHERE idventa = '$idventadetalle' group by idventa";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelo = $idalmacenA2['resultado'];

      $sql3 = "SELECT m.idmodelo FROM modelo m,ingresoalmacen i WHERE m.idmodelo = '$idmodelo' and m.idingreso=i.idingreso and i.fecha>='2014-12-11'";
   $idalmacenA21 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelos = $idalmacenA21['resultado'];

        if($idmodelos!=''  ){
                  $tipo="2";
          $idgrupo = $idgrupo;
                         }else{
                         //con cambio en las presentaciones
                          $idgrupo = "1";

           $tipo="3";
        $rango1="33";
$rango2="45";

         }

}else{
    $idgrupo = $idgrupo;
    $rango1=$rango1;
$rango2=$rango2;
          if($opcionmarca="33-45"){
        $tipo="1";
        }else{
        if($opcionmarca="14-38"){
        $tipo="3";
        }else{
        if($opcionmarca="47-70"){
        $tipo="2";
        }else{
        $tipo="1";
        }
        }
        }
}


 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipoalm = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Traspasado a :</td><td>".$vendedornombre."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipoalm</td></tr>";
   $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>TRASPASO:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";

    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
//echo $rango1;
$select = "vi.idmodelo";
$from = "traspasosinternos vi";
$where = "idventa='$idventadetalle' Group by vi.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
   // $producto = dibujarTablaitemventa($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);

    $producto = dibujarTablaitemventacambio($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";


$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function porclientescobro($idcliente, $return)
{
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $fechahoy = Date("Y-m-d");
  $fecha22= split("-", $fechahoy);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechahoy=$d."-".$m."-".$y;

 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fechahoy";
    $html .= "</td>";
    $html .= "<tr>";

     $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
   $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN<br>";
    $html .= " POR CLIENTES al $fechahoy<br>";
    if($idcliente == "null")
    {
    }else{  $html .= "$clientenombre<br>";
    }
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

$select = "cl.idcliente,CONCAT(m.apellido, '-',m.nombre ) as cliente";
    $from = "clientes m,creditocliente cl";
   $where = "cl.idcliente=m.idcliente and cl.porpagar!='0.00' ";


    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by cl.idcliente";

    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idcliente = $codigo['idcliente'];
    $nombrecliente= $codigo['cliente'];
      $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
              $html .=" </td> ";
              $html .= "</tr>";
              $html .= "<tr>";

    $select = "c.idmarca";
    $from = "creditocliente c";
   $where = "c.porpagar!='0.00' AND c.idcliente='$idcliente' ";


    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY c.idmarca";
//echo $sql25;
//$table = dibujarTablaOfCobros($sql25,$idmarca,$codigoempleado,$nombremarca,$idcliente);
$table = dibujarTablaOfCobroscliente($sql25,$idmarca,$codigoempleado,$nombrecliente,$idcliente);
$html .= $table['resultado'];
   $html .= "</tr>";
 }

 $html .= "</tr>";

    $html .= "</table>";





 $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
 $sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
   $totalcobradoacuenta = $creditoA111['resultado'];

    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function pormarcavendedorcobro($idcliente, $return)
{
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $fechahoy = Date("Y-m-d");
  $fecha22= split("-", $fechahoy);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechahoy=$d."-".$m."-".$y;

 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fechahoy";
    $html .= "</td>";
    $html .= "<tr>";

     $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
   $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN<br>";
    $html .= " POR MARCA VENDEDOR al $fechahoy<br>";
    if($idcliente == "null")
    {
    }else{  $html .= "$clientenombre<br>";
    }
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";


$select = "m.idmarca,m.nombre,m.codigo";
    $from = "marcas m,creditocliente cl";
   $where = "m.idmarca=cl.idmarca and m.estado='activo' ";

//    $select1 = "emp.idtienda AS idempleado,emp.codigotienda as codigo,emp.nombre";
//    $from1 = "tiendas emp";
//   $where1 = "emp.nombre!='-' group by emp.codigotienda";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by m.idmarca";
// $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where."  UNION ALL SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ";


    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idmarca = $codigo['idmarca'];
    $nombremarca= $codigo['nombre'];
      $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
              $html .=" </td> ";
              $html .= "</tr>";
              $html .= "<tr>";

    $select = "c.idvendedor";
    $from = "creditocliente c";
   $where = "c.idmarca='$idmarca' ";

     if($idcliente == "null")
    {
    }else{ $where .= " AND c.idcliente='$idcliente' ";
    }

    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY c.idvendedor";

$table = dibujarTablaOfCobros($sql25,$idmarca,$codigoempleado,$nombremarca,$idcliente);
$html .= $table['resultado'];
   $html .= "</tr>";
 }

 $html .= "</tr>";

    $html .= "</table>";





 $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
 $sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
   $totalcobradoacuenta = $creditoA111['resultado'];

    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function pormarcavendedorcobroresumen($idcliente, $return)
{
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $fechahoy = Date("Y-m-d");
  $fecha22= split("-", $fechahoy);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechahoy=$d."-".$m."-".$y;

 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fechahoy";
    $html .= "</td>";
    $html .= "<tr>";

     $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
   $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN<br>";
    $html .= " POR MARCA CLIENTE al $fechahoy<br>";
    if($idcliente == "null")
    {
    }else{  $html .= "$clientenombre<br>";
    }
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "m.idmarca,m.nombre,m.codigo";
    $from = "marcas m,creditocliente cl";
    $where = "m.idmarca=cl.idmarca and m.estado='activo' ";

//    $select1 = "emp.idtienda AS idempleado,emp.codigotienda as codigo,emp.nombre";
//    $from1 = "tiendas emp";
//   $where1 = "emp.nombre!='-' group by emp.codigotienda";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by m.idmarca";
// $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where."  UNION ALL SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ";


    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
     $codigo = $sql3[$i];
     $idmarca = $codigo['idmarca'];
     $nombremarca= $codigo['nombre'];
     $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
              $html .=" </td> ";
              $html .= "</tr>$nombremarca";
              $html .= "<tr>";


//CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS
  $select1 = " CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS Cliente,SUM(cl.saldoant) as SaldoAnterior,SUM(cl.ventacaja) as Caja,SUM(cl.ventapar) AS Par,SUM(cl.ventasus) as Sus,SUM(cl.rebaja) as Rebajas,SUM(cl.pago) AS Pagos,SUM(cl.saldoact) AS SaldoActual";
   $from1 = "creditomayor cl,clientes c";
    $where1 = " cl.idcliente=c.idcliente and cl.idmarca='$idmarca' and cl.estadomes='activo' ";

$sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by cl.idcliente";
$sqlrutafin = $sqlruta;
//echo $sqlrutafin;

$select = "sum(cl.saldoant) as monto";
$select1 = "sum(cl.ventacaja) as monto";
$select2 = "sum(cl.ventapar) as monto";
$select3 = "sum(cl.ventasus) as monto";
$select4 = "sum(cl.rebaja) as monto";
$select5 = "sum(cl.pago) as monto";
$select6 = "sum(cl.saldoact) as monto";

    $from = "creditomayor cl,clientes c";
    $where = "cl.idcliente=c.idcliente and cl.idmarca='$idmarca' and cl.estadomes='activo'";

    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $saldoant = $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $ventacaja = $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $ventapar = $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $ventasus = $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $rebaja = $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select5." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $pago= $idalmacenA['resultado'];
    $sql251 = "SELECT ".$select6." FROM ".$from." WHERE ".$where." ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $pagoactual = $idalmacenA['resultado'];



$table = dibujarTablaresumen($sqlrutafin, $nombremarca,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
   $html .= $table['resultado'];
   $html .= "</tr>";
 }

 $html .= "</tr>";

    $html .= "</table>";





 $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
 $sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
   $totalcobradoacuenta = $creditoA111['resultado'];

    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function ProcesarCierreCobro($mesproceso, $return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $fechahoy = Date("Y-m-d");
    $fecha22= split("-", $fechahoy);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechaini = $y."-".$m."-"."01";
    $ultimodia = strftime("%d", mktime(0, 0, 0, $m+1, 0, $y));
    $fechafin = $y."-".$m."-".$ultimodia;
    $idalmacen = $_SESSION['idalmacen'];
    $sql1 = "SELECT * FROM creditomayor WHERE estadomes = 'activo' and idalmacen = '$idalmacen'";
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $row1 = NumeroTuplas($sql1);
    $row11 = $row1['resultado'];
    $sql1 = "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numerocredito = $result['resultado'];
    $sql1 = "SELECT idperiodo, periodoactual FROM periodo WHERE estado = 'abierto' and idalmacen = '$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $idperiodo = $result['resultado'];
    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    $periodoactual = $result['resultado'];
    //echo " idperiodo $idperiodo periodoactual $periodoactual ";
    $sql1 = "SELECT MAX(idperiodo) as num FROM periodo";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroidperiodo = $result['resultado'];
    $numeroidperiodo = $numeroidperiodo + 1;
    for($i=0; $i<=$row11; $i++){
        $paresd = $sql3[$i];
        $idcredit = $numerocredito + 1;
        $numerocredito = $idcredit;
        $idcreditom = $paresd['idcredito'];
        $fecham = $paresd['fecha'];
        $horam = $paresd['hora'];
        $idclientem = $paresd['idcliente'];
        $idmarcam = $paresd['idmarca'];
        $idvendedorm = $paresd['idvendedor'];
        $saldoactm = $paresd['saldoact'];
        $morosidadm = $paresd['morosidad'];
        $estadom = $paresd['estado'];
        $diferenciam = $paresd['diferencia'];
        $observacionm = $paresd['observacion'];
        $idalmacenm = $paresd['idalmacen'];
        $mescierrem = $paresd['mescierre'];
        $estadomesm = $paresd['estadomes'];
        $idcreditoclim = $paresd['idcreditocli'];
        //$estadomescierre = 'cerrado';

//    $sql1= "SELECT * FROM periodo WHERE estado='Abierto'";
//    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
//    $mescierre = $result['resultado'];

        $sql[] =getSqlNewCreditomayorinsert($idcredit, $fecham, $hora, $idclientem, $idmarcam, $idvendedorm, $saldoactm, "0.00", "0.00", "0.00", "0.00", "0.00", $saldoactm, $morosidadm, "ACTIVO", $diferenciam, $observacionm,$idalmacenm,"0.00", "0.00",$mesproceso, $estadomesm, $idcreditoclim, false);

        $sql[] = "UPDATE creditomayor SET estadomes = 'cerrado' WHERE idcredito = '$idcreditom' and estadomes = 'activo';";
    }
    $sql[] =getSqlNewPeriodoinsert($numeroidperiodo, $fechahoy, $mesproceso, $fechaini, $hora, "abierto", $fechafin, $periodoactual, $idperiodo, "1", $idalmacen, $idusuario, false);

    $sql[] = "UPDATE periodo SET estado = 'cerrado' WHERE idperiodo = '$idperiodo' and estado = 'abierto' and idalmacen = '$idalmacen';";
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se proceso correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error";
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

function getSqlNewCreditomayorinsert($idcredito, $fecha, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion, $idalmacen, $pardev, $susdev, $mescierre, $estadomes, $idcreditocli, $return){
$setC[0]['campo'] = 'idcredito';
$setC[0]['dato'] = $idcredito;
$setC[1]['campo'] = 'fecha';
$setC[1]['dato'] = $fecha;
$setC[2]['campo'] = 'hora';
$setC[2]['dato'] = $hora;
$setC[3]['campo'] = 'idcliente';
$setC[3]['dato'] = $idcliente;
$setC[4]['campo'] = 'idmarca';
$setC[4]['dato'] = $idmarca;
$setC[5]['campo'] = 'idvendedor';
$setC[5]['dato'] = $idvendedor;
$setC[6]['campo'] = 'saldoant';
$setC[6]['dato'] = $saldoant;
$setC[7]['campo'] = 'ventacaja';
$setC[7]['dato'] = $ventacaja;
$setC[8]['campo'] = 'ventapar';
$setC[8]['dato'] = $ventapar;
$setC[9]['campo'] = 'ventasus';
$setC[9]['dato'] = $ventasus;
$setC[10]['campo'] = 'pago';
$setC[10]['dato'] = $pago;
$setC[11]['campo'] = 'rebaja';
$setC[11]['dato'] = $rebaja;
$setC[12]['campo'] = 'saldoact';
$setC[12]['dato'] = $saldoact;
$setC[13]['campo'] = 'morosidad';
$setC[13]['dato'] = $morosidad;
$setC[14]['campo'] = 'estado';
$setC[14]['dato'] = $estado;
$setC[15]['campo'] = 'diferencia';
$setC[15]['dato'] = $diferencia;
$setC[16]['campo'] = 'observacion';
$setC[16]['dato'] = $observacion;
$setC[17]['campo'] = 'idalmacen';
$setC[17]['dato'] = $idalmacen;
$setC[18]['campo'] = 'pardev';
$setC[18]['dato'] = $pardev;
$setC[19]['campo'] = 'susdev';
$setC[19]['dato'] = $susdev;
$setC[20]['campo'] = 'mescierre';
$setC[20]['dato'] = $mescierre;
$setC[21]['campo'] = 'estadomes';
$setC[21]['dato'] = $estadomes;
$setC[22]['campo'] = 'idcreditocli';
$setC[22]['dato'] = $idcreditocli;
$sql2 = generarInsertValues($setC);
return "INSERT INTO creditomayor ".$sql2;
}
function getSqlNewPeriodoinsert($idperiodo, $fecharegistro, $periodoactual, $fechainicio, $hora, $estado, $fechafin, $periodoanterior, $idperiodoanterior, $validacion, $idalmacen, $idusuario, $return){
    $setC[0]['campo'] = 'idperiodo';
    $setC[0]['dato'] = $idperiodo;
    $setC[1]['campo'] = 'fecharegistro';
    $setC[1]['dato'] = $fecharegistro;
    $setC[2]['campo'] = 'periodoactual';
    $setC[2]['dato'] = $periodoactual;
    $setC[3]['campo'] = 'fechainicio';
    $setC[3]['dato'] = $fechainicio;
    $setC[4]['campo'] = 'hora';
    $setC[4]['dato'] = $hora;
    $setC[5]['campo'] = 'estado';
    $setC[5]['dato'] = $estado;
    $setC[6]['campo'] = 'fechafin';
    $setC[6]['dato'] = $fechafin;
    $setC[7]['campo'] = 'periodoanterior';
    $setC[7]['dato'] = $periodoanterior;
    $setC[8]['campo'] = 'idperiodoanterior';
    $setC[8]['dato'] = $idperiodoanterior;
    $setC[9]['campo'] = 'validacion';
    $setC[9]['dato'] = $validacion;
    $setC[10]['campo'] = 'idalmacen';
    $setC[10]['dato'] = $idalmacen;
    $setC[11]['campo'] = 'idusuario';
    $setC[11]['dato'] = $idusuario;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO periodo ".$sql2;
}
function pormarcavendedorcobroresumenvendedor($idalmacen, $mescierre, $return)
{
    $mesproceso = $mescierre;
    if(($idalmacen==null)||($idalmacen=='')){
        $idalmacen = $_SESSION['idalmacen'];
    }
    $html = "";
    $html .= "<tr><td colspan='4' align='center'>
             <p>NOVA MODA SRL<br />
                 Telf. 4-258993  Fax: 4-504183
             </p>
             </td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    //$html .= "$opcion";
    $html .= "$mescierre";
    $html .= "</td>";
    $html .= "<tr>";

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN<br>";
    $html .= " POR MARCA CLIENTE - VENDEDOR de $mesproceso OFICINA $idalmacen<br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "v.idempleado, v.codigo, CONCAT( UPPER(v.nombres), '-', UPPER(v.apellidos) )AS vendedor";
    $from = "empleados v, creditomayor cm";
    $where = "v.idempleado = cm.idvendedor and cm.mescierre = '$mesproceso' and cm.idalmacen = '$idalmacen'";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by cm.idvendedor ORDER BY v.nombres, v.apellidos";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
    for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $idvendedor = $codigo['idempleado'];
        $nombrevendedor= $codigo['vendedor'];
        $codigoempleado = $codigo['codigo'];
        $html .= "<tr style='width:100%; font-size:11px;'>";
        $html .=" </td> ";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombrevendedor</td>";
        $html .= "</tr>";
        $html .= "<tr>";
     //fin parte 1

        $select = "m.idmarca";
        $from = "marcas m, creditomayor cm";
        $where = "m.idmarca = cm.idmarca and cm.idvendedor = '$idvendedor' ";
        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY m.idmarca";
        $table = dibujarTablaOfCobroporvendedor($sql25,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mesproceso,$idalmacen);
        $html .= $table['resultado'];
        $html .= "</tr>";
//finnuevo
        $html .= "</tr>";
    }
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
    $html .= "<tr>";
    $select1 = "'-' AS Totales, SUM(cm.saldoant) as SaldoAnterior, SUM(cm.ventacaja) as Caja, SUM(cm.ventapar) AS Par, SUM(cm.ventasus) as Sus,
               SUM(cm.rebaja) as Rebajas, SUM(cm.pago) AS Pagos, SUM(cm.pardev) AS ParDev, SUM(cm.susdev) AS SusDev, SUM(cm.saldoact) AS SaldoActual";
    $from1 = "creditomayor cm, clientes c, empleados e";
    $where1 = " cm.idcliente = c.idcliente and cm.idvendedor = e.idempleado and cm.mescierre = '$mescierre' and cm.idalmacen = '$idalmacen'";
    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by cm.idalmacen";
    $sqlrutafin = $sqlruta;

    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SaldoAnterior');
    $saldoant = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Caja');
    $ventacaja = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Par');
    $ventapar = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Sus');
    $ventasus = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Rebajas');
    $rebaja = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Pagos');
    $pago= $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SaldoActual');
    $pagoactual = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'ParDev');
    $paresdev = $idalmacenA['resultado'];
    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SusDev');
    $susdev = $idalmacenA['resultado'];
    $html .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
    $html .= "<td style='display:none;'></td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTALES </td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$saldoant."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventacaja."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventapar."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$paresdev."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$susdev."&nbsp;</td>";
    $html .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pagoactual."&nbsp;</td>";
    $html .= "<td></td>";
    $html .= "</tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function pormarcavendedorcobrodetallevendedor($idcliente, $fecha1, $fecha2, $return)
{
    $empresa=strtoupper($empresa1);
    $fecha22= split("-", $fechainicio);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechaini=$d."-".$m."-".$y;

    $fecha221= split("-", $fechafin);
    $y2=$fecha221[0];
    $m2=$fecha221[1];
    $d2=$fecha221[2];
    $fechafinn=$d2."-".$m2."-".$y2;
    $fechahoy = Date("Y-m-d");
    $fecha22= split("-", $fechahoy);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechahoy=$d."-".$m."-".$y;
    $mesproceso = "032016";

    $html = "";
    $html .= "<tr><td colspan='4' align='center'>
        <p>NOVA MODA SRL<br />
            Telf. 4-258993  Fax: 4-504183
        </p>
    </td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$opcion";
    $html .= "$fecha1 - $fecha2";
    $html .= "</td>";
    $html .= "<tr>";

    $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
    $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
    $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN<br>";
    $html .= " POR MARCA CLIENTE - VENDEDOR de $fecha1 - $fecha2<br>";
    if($idcliente == "null")
    {
    }else{  $html .= "$clientenombre<br>";
    }
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "v.idempleado, v.codigo, CONCAT( UPPER(v.nombres), '-', UPPER(v.apellidos) )AS vendedor";
    $from = "empleados v, creditocliente cl";
    $where = "v.idempleado = cl.idvendedor ";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by cl.idvendedor";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
    for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $idvendedor = $codigo['idempleado'];
        $nombrevendedor= $codigo['vendedor'];
        $codigoempleado = $codigo['codigo'];
        $html .= "<tr style='width:100%; font-size:11px;'>";
        $html .=" </td> ";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombrevendedor</td>";
        $html .= "</tr>";
        $html .= "<tr>";
     //fin parte 1

        $select = "m.idmarca";
        $from = "marcas m, creditocliente cl";
        $where = "m.idmarca = cl.idmarca and cl.idvendedor = '$idvendedor' ";
        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY m.idmarca";
        $table = dibujarTablaOfCobroporvendedordetalle($sql25,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$fecha1,$fecha2);
        $html .= $table['resultado'];
        $html .= "</tr>";
//finnuevo
        $html .= "</tr>";
    }
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
    //$sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
    //$creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    //$totalcobradoacuenta = $creditoA111['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    //$html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL:</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function verventalistaconfirmada($idmarca,$idvendedor,$fecha1,$fecha2, $return)
{
    //$fecha1 = $fechainicio;
    //$fecha2 = $fechafin;
    $empresa=strtoupper($empresa1);
    $fecha22= split("-", $fechainicio);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechaini=$d."-".$m."-".$y;

    $fecha221= split("-", $fechafin);
    $y2=$fecha221[0];
    $m2=$fecha221[1];
    $d2=$fecha221[2];
    $fechafinn=$d2."-".$m2."-".$y2;
    $fechahoy = Date("Y-m-d");
    $fecha22= split("-", $fechahoy);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechahoy=$d."-".$m."-".$y;

    $html = "";
    $html .= "<tr><td colspan='4' align='center'>
              <p>NOVA MODA SRL<br />
               Telf. 4-258993  Fax: 4-504183
              </p>
              </td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha1 - $fecha2";
    $html .= "</td>";
    $html .= "<tr>";

    //$sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
    //$creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
    //$clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "VENTAS CONFIRMADAS<br>";
    $html .= " MES VIGENTE al $fecha2<br>";
    //if($idcliente == "null")
    //{
    //}else{  $html .= "$clientenombre<br>";
    //}
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "m.idmarca, m.nombre, m.codigo";
    $from = "ventas v, creditocliente cl, marcas m";
    $where = "cl.idventa = v.idventa";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by m.idmarca ORDER BY m.nombre";

    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    //$html .= "Filas $row15<br>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
    for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $idmarca = $codigo['idmarca'];
        $nombremarca= $codigo['nombre'];
        $codigoempleado = $codigo['codigo'];
        $html .= "<tr style='width:100%; font-size:11px;'>";
        $html .=" </td> ";
        $html .= "</tr>";
        $html .= "<tr>";

        $sqlCar = "SELECT cl.boleta, cl.fechaventa, CONCAT(cli.apellido, '-',cli.nombre) as Cliente, mar.nombre AS marca, CONCAT( UPPER(e.nombres), '-', UPPER(e.apellidos) )AS vendedor,
                  cl.caja, cl.par, cl.sus FROM creditocliente cl, ventas v, clientes cli, marcas mar, empleados e WHERE cl.idventa = v.idventa and cl.idcliente = cli.idcliente 
                  and cl.idmarca = mar.idmarca and cl.idvendedor = e.idempleado and cl.idmarca = '$idmarca' AND cl.fechaventa >='$fecha1' AND cl.fechaventa <='$fecha2' ORDER BY cli.apellido, e.nombres";
        $carac = dibujarTablaOfSQLNormal($sqlCar, "Ventas Confirmadas");
        $html .= $carac['resultado'];
        $html .= "</tr>";
        $codigo1 = $sql3[$i+1];
        $idmarca1 = $codigo1['idmarca'];        
        if ($idmarca != $idmarca1)
        {
            $sqlCar = "SELECT SUM(cl.sus) as TotalVenta FROM creditocliente cl, ventas v WHERE cl.idventa = v.idventa and cl.idcliente = v.idcliente
                      and cl.idmarca = v.idmarca and cl.idvendedor = v.idvendedor and cl.idmarca = '$idmarca' AND cl.fechaventa >='$fecha1' AND cl.fechaventa <='$fecha2'";
            $ventasA = findBySqlReturnCampoUnique($sqlCar, true, true, "TotalVenta");
            $totalventas = $ventasA['resultado'];
            $html .= "      $totalventas";
            //$table = dibujarTablaOfSQLNormaltotales($sqlCar, "Ventas Confirmadas",$totalventas);
        }
    }
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
    //$sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
    //$creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    //$totalcobradoacuenta = $creditoA111['resultado'];

    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    //$html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";


    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";

    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function verresumenCXC($idmarca,$idvendedor,$fecha1,$fecha2, $return)
{
$fecha1 = $fechainicio;
$fecha2 = $fechafin;
      $empresa=strtoupper($empresa1);
      $fecha22= split("-", $fechainicio);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechaini=$d."-".$m."-".$y;

 $fecha221= split("-", $fechafin);
$y2=$fecha221[0];
$m2=$fecha221[1];
$d2=$fecha221[2];
$fechafinn=$d2."-".$m2."-".$y2;
 $fechahoy = Date("Y-m-d");
  $fecha22= split("-", $fechahoy);
$y=$fecha22[0];
$m=$fecha22[1];
$d=$fecha22[2];
$fechahoy=$d."-".$m."-".$y;

 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
     <p>NOVA MODA SRL<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fechahoy";
    $html .= "</td>";
    $html .= "<tr>";

     $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
   $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN CUENTAS POR COBRAR<br>";
    $html .= " MES VIGENTE al $fechahoy<br>";
    if($idcliente == "null")
    {
    }else{  $html .= "$clientenombre<br>";
    }
        $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
$select = "m.idmarca,m.nombre,m.codigo";
    $from = "marcas m,creditomayor cl";
   $where = "m.idmarca=cl.idmarca and m.estado='ACTIVO' ";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by m.idmarca";


    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idmarca = $codigo['idmarca'];
    $nombremarca= $codigo['nombre'];
      $codigoempleado = $codigo['codigo'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
              $html .=" </td> ";
              $html .= "</tr>";
              $html .= "<tr>";

    $select = "c.idvendedor";
    $from = "creditomayor c";
   $where = "c.idmarca='$idmarca' ";


    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY c.idvendedor";

$table = dibujarTablaOfCobrosmayor($sql25,$idmarca,$codigoempleado,$nombremarca,$idcliente);
$html .= $table['resultado'];
   $html .= "</tr>";
 }

 $html .= "</tr>";

    $html .= "</table>";





 $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
 $sql4112 = "SELECT SUM(montoacuenta) AS totaldeuda FROM acuentaempresa WHERE tipopago='P' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
   $totalcobradoacuenta = $creditoA111['resultado'];

    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "</table>";
    $html .= "</td></tr>";


   $html .= "</tr>";
   $html .= "</table>";
    $html .= "</td></tr>";

   $html .= "</table>";
    $html .= "</td></tr>";
$html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
        if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function verresumen($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
    $fecha1 = $fechainicio;
    $fecha2 = $fechafin;
    $empresa=strtoupper($empresa1);
    $fecha22= split("-", $fechainicio);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechaini=$d."-".$m."-".$y;

    $fecha221= split("-", $fechafin);
    $y2=$fecha221[0];
    $m2=$fecha221[1];
    $d2=$fecha221[2];
    $fechafinn=$d2."-".$m2."-".$y2;
    $fechahoy = Date("Y-m-d");
    $fecha22= split("-", $fechahoy);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fechahoy=$d."-".$m."-".$y;

    $html = "";
    $html .= "<tr><td colspan='4' align='center'>
            <p>NOVA MODA SRL<br />
                Telf. 4-258993  Fax: 4-504183
            </p>
            </td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:110%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:110%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fechahoy";
    $html .= "</td>";
    $html .= "<tr>";

//     $sql4112 = "select CONCAT(apellido, '-',nombre ) as Cliente FROM clientes WHERE idcliente='$idcliente'";
//     $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "Cliente");
//   $clientenombre = $creditoA111['resultado'];

    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "RESUMEN COBROS<br>";
    $html .= " $fechaini al $fechafinn<br>";
//    if($idcliente == "null")
//    {
//    }else{  $html .= "$clientenombre<br>";
//    }
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
//$sql2 = "SELECT cp.idvendedor,e.nombres,e.codigo FROM empleados e,creditocliente cl,clientes c,creditopago cp
//WHERE
//  cl.idcliente=c.idcliente and cp.idvendedor=e.idempleado and cl.idcrecliente=cp.idcrecliente AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2'
//UNION ALL
//SELECT cp.idvendedor,e.nombres,e.codigo FROM empleados e,creditocliente cl,clientes c,creditorebaja cp
//WHERE
//  cl.idcliente=c.idcliente and cp.idvendedor=e.idempleado and cl.idcrecliente=cp.idcrecliente AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2' GROUP by cp.idvendedor
//";
//echo $sql2;
    $select = "cp.idvendedor, e.nombres, e.codigo";
    $from = "empleados e, creditocliente cl, creditopago cp";
    $where = "cl.idcrecliente = cp.idcrecliente and cp.idvendedor = e.idempleado AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2' ";

    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by cp.idvendedor";

    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);

    $sql3 = $sql21['resultado'];

    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
    for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $idvendedor = $codigo['idvendedor'];
        $nombremarca= $codigo['nombres'];
        $codigoempleado = $codigo['codigo'];
        $html .= "<tr style='width:100%; font-size:11px;'>";
        $html .=" </td> ";
        $html .= "</tr>";
        $html .= "<tr>";
//$select = "cp.idvendedor,e.nombres,e.codigo";
//    $from = "empleados e,creditocliente cl,creditopago cp";
//   $where = "cl.idcrecliente=cp.idcrecliente and cp.idvendedor=e.idempleado ";
//$sql11 = "SELECT c.idmarca FROM creditopago c
//WHERE
//  c.idvendedor='$idvendedor' AND c.fechapago >= '$fecha1' AND c.fechapago <= '$fecha2'
//UNION ALL
//SELECT
//  '$concepto1' AS Concepto,c.monto AS Pago,date_format(c.fechapago,'%d/%m/%Y') AS FechaPago,CONCAT(e.nombres, '-', e.apellidos) AS vendedor,m.nombre as marca
//FROM
//creditorebaja c,marcas m,empleados e
//WHERE
//  c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa'";

        $select = "c.idmarca";
        $from = "creditopago c";
        $where = "c.idvendedor = '$idvendedor' AND c.fechapago >= '$fecha1' AND c.fechapago <= '$fecha2' ";

        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY c.idmarca";
        $table = dibujarTablaCOBRADO($sql25,$idvendedor,$codigoempleado,$nombremarca,$idcliente,$fecha1,$fecha2);
        $html .= $table['resultado'];
        $html .= "</tr>";
    }
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:center;font-size:12px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:1px solid #000000;font-size:14px;text-align:center'>";
    $sql4112 = "SELECT SUM(monto) AS totaldeuda FROM creditopago WHERE fechapago >= '$fechainicio' AND fechapago <= '$fechafin'";
    $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    $totalcobradoacuenta = $creditoA111['resultado'];
    $sql4112 = "SELECT SUM(monto) AS totaldeuda FROM creditorebaja WHERE fechapago >= '$fechainicio' AND fechapago <= '$fechafin'";
    $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    $totalrebaja = $creditoA111['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL COBRADO :</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcobradoacuenta."</td></tr>";
    $html .= "<tr><td style='width:85%;font-weight:bold;'>TOTAL REBAJA:</td><td style='width:20%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalrebaja."</td></tr>";

    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";

    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function dibujarTablaOfCobrosmayor($sql,$idmarca,$codigoempleado,$nombremarca,$idcliente)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCont = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idvendedor = $dato;


$sql2 = "SELECT CONCAT( UPPER(nombres), '-', UPPER(apellidos) )AS nombre FROM empleados WHERE idempleado = '$idvendedor'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);
     //$iddetalleingreso = $fi[$i]['idempresa'];
       $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
   // $select1 = " date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago,cl.pagado,cl.porpagar,cl.ultimopago,cl.fechalimite";
   $select1 = " CONCAT( c.apellido, '-', c.nombre ) as Cliente,cl.saldoant AS SaldoAnterior,cl.ventacaja AS VentaCaja,cl.ventapar as VentaPar,cl.ventasus As VentaSus,cl.pago AS Pago,cl.rebaja as Rebaja,cl.saldoact AS SaldoActual";
   $from1 = "creditomayor cl,clientes c";
    $where1 = " cl.idcliente=c.idcliente AND cl.idvendedor='$idvendedor' and cl.idmarca='$idmarca' and cl.estadomes='activo'";



   $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1."";

$sqlrutafin = $sqlruta;



$select2 = "sum(cl.saldoact) as monto";
    $from = "creditomayor cl,clientes c";
   $where = "cl.idcliente=c.idcliente AND cl.idvendedor='$idvendedor' and cl.idmarca='$idmarca' cl.estadomes='activo' ";

       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporpagar = $idalmacenA['resultado'];

$table = dibujarTablaparacobro($sqlrutafin, $empresa,$totalventa,$totalpago,$totalporpagar1,$totalporpagar,$codigoempleado);
   $devS .= $table['resultado'];

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));



$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c";
   $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporcobrar = $idalmacenA['resultado'];

$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:25px;text-align:center;background-color:silver;'>TOTAL SALDO:</td>";
       $devS .= "<td style='display:none;'></td>";

       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombremarca</td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporcobrar."&nbsp;</td>";

       $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfCobroporvendedor($sql,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mescierre,$idalmacen)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
                        $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {   $dato = $fi[$i];
                            $idmarca = $dato;
                            $sql = "SELECT ma.nombre AS marca
                                    FROM  `marcas` ma
                                    WHERE ma.idmarca = '$idmarca'";

                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
                            $marcalista = $idalmacenA2['resultado'];
                            $select1 = " CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS Cliente, cm.saldoant as SaldoAnterior,
                                        cm.ventacaja as Caja, cm.ventapar AS Par, cm.ventasus as Sus, cm.pago AS Pagos, cm.rebaja as Rebajas,
                                        cm.pardev AS ParDev, cm.susdev AS SusDev, cm.saldoact AS SaldoActual";
                            $from1 = "creditomayor cm, clientes c";
                            $where1 = " cm.idcliente = c.idcliente and cm.idmarca = '$idmarca' and cm.idvendedor = '$idvendedor' and cm.mescierre = '$mescierre' and cm.idalmacen = '$idalmacen'";
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ORDER BY c.nombre";
                            $sqlrutafin = $sqlruta;

                            $select = "SUM(cm.saldoant) as monto";
                            $select1 = "SUM(cm.ventacaja) as monto";
                            $select2 = "SUM(cm.ventapar) as monto";
                            $select3 = "SUM(cm.ventasus) as monto";
                            $select4 = "SUM(cm.rebaja) as monto";
                            $select5 = "SUM(cm.pago) as monto";
                            $select6 = "SUM(cm.saldoact) as monto";
                            $select7 = "SUM(cm.pardev) as monto";
                            $select8 = "SUM(cm.susdev) as monto";
                            $from = "creditomayor cm, clientes c";
                            $where = "cm.idcliente = c.idcliente and cm.idmarca = '$idmarca' and cm.idvendedor = '$idvendedor' and cm.mescierre = '$mescierre' and cm.idalmacen = '$idalmacen'";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $saldoant = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $ventacaja = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $ventapar = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $ventasus = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $rebaja = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select5." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $pago= $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select6." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $pagoactual = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select7." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $paresdev = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select8." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $susdev = $idalmacenA['resultado'];
                            $marcalista = $marcalista."-".$codigoempleado;
                            $table = dibujarTablaresumen($sqlrutafin, $marcalista,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $select1 = "'-' AS Totales, SUM(cm.saldoant) as SaldoAnterior, SUM(cm.ventacaja) as Caja, SUM(cm.ventapar) AS Par, SUM(cm.ventasus) as Sus,
                               SUM(cm.pago) AS Pagos, SUM(cm.rebaja) as Rebajas, SUM(cm.pardev) AS ParDev, SUM(cm.susdev) AS SusDev, SUM(cm.saldoact) AS SaldoActual";
                    $from1 = "creditomayor cm, clientes c";
                    $where1 = " cm.idcliente = c.idcliente and cm.idvendedor = '$idvendedor' and cm.mescierre = '$mescierre' and cm.idalmacen = '$idalmacen'";
                    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by cm.idvendedor";
                    $sqlrutafin = $sqlruta;

                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SaldoAnterior');
                    $saldoant = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Caja');
                    $ventacaja = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Par');
                    $ventapar = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Sus');
                    $ventasus = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Rebajas');
                    $rebaja = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Pagos');
                    $pago= $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SaldoActual');
                    $pagoactual = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'ParDev');
                    $paresdev = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SusDev');
                    $susdev = $idalmacenA['resultado'];
                    $table = dibujarTablaresumentotal($sqlrutafin, $nombrevendedor,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev);
                    $devS .= $table['resultado'];
                    $devS .= "</br>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfCobroporvendedordetalle($sql,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$fechai,$fechaf)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
                    ////$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$codigoempleado</td></tr>";
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {   $dato = $fi[$i];
                            $idmarca = $dato;
                            $sql = "SELECT ma.nombre AS marca
                                    FROM  `marcas` ma
                                    WHERE ma.idmarca = '$idmarca'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
                            $marcalista = $idalmacenA2['resultado'];
                            $select1 = " CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS Cliente, cl.boleta as Boleta,
                                        cl.caja as Caja, cl.par AS Par, cl.sus as Sus, cl.rebaja as Rebajas, cl.pago AS Pagos,
                                        cl.pardev AS ParDev, cl.susdev AS SusDev, cl.porpagar AS PorPagar";
                            $from1 = "creditocliente cl, clientes c";
                            $where1 = " cl.idcliente = c.idcliente and cl.idmarca = '$idmarca' and cl.idvendedor = '$idvendedor' and cl.fechaventa >='$fechai' and cl.fechaventa <='$fechaf'";
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ORDER BY c.nombre";
                            $sqlrutafin = $sqlruta;

                            //$select = "cl.boleta as monto";
                            $select1 = "sum(cl.caja) as monto";
                            $select2 = "sum(cl.par) as monto";
                            $select3 = "sum(cl.sus) as monto";
                            $select4 = "sum(cl.rebaja) as monto";
                            $select5 = "sum(cl.pago) as monto";
                            $select6 = "sum(cl.porpagar) as monto";
                            $select7 = "sum(cl.pardev) as monto";
                            $select8 = "sum(cl.susdev) as monto";
                            $from = "creditocliente cl, clientes c";
                            $where = "cl.idcliente = c.idcliente and cl.idmarca = '$idmarca' and cl.idvendedor = '$idvendedor' and cl.fechaventa >='$fechai' and cl.fechaventa <='$fechaf'";
                            //$sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            //$idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'Boleta');
                            $boleta = "-"; //$idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $caja = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $par = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $sus = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $rebaja = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select5." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $pago= $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select6." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $porpagar = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select7." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $paresdev = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select8." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $susdev = $idalmacenA['resultado'];
                            $marcalista = $marcalista."-".$codigoempleado;

                            $table = dibujarTablaresumen($sqlrutafin, $marcalista,$boleta,$caja,$par,$sus,$rebaja,$pago,$porpagar,$paresdev,$susdev);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $select1 = "'-' AS Totales, '--', SUM(cl.caja) as Caja, SUM(cl.par) AS Par, SUM(cl.sus) as Sus,
                               SUM(cl.rebaja) as Rebajas, SUM(cl.pago) AS Pagos, SUM(cl.pardev) AS ParDev, SUM(cl.susdev) AS SusDev, SUM(cl.porpagar) AS PorPagar";
                    $from1 = "creditocliente cl, clientes c";
                    $where1 = " cl.idcliente = c.idcliente and cl.idvendedor = '$idvendedor' and cl.fechaventa >='$fechai' and cl.fechaventa <='$fechaf'";
                    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by cl.idvendedor";
                    $sqlrutafin = $sqlruta;

                    //$idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, '');
                    $boleta = "-";//$idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Caja');
                    $caja = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Par');
                    $par = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Sus');
                    $sus = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Rebajas');
                    $rebaja = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Pagos');
                    $pago= $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'PorPagar');
                    $porpagar = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'ParDev');
                    $paresdev = $idalmacenA['resultado'];
                    $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SusDev');
                    $susdev = $idalmacenA['resultado'];
                    $table = dibujarTablaresumentotal($sqlrutafin, $nombrevendedor,$boleta,$caja,$par,$sus,$rebaja,$pago,$porpagar,$paresdev,$susdev);
                    $devS .= $table['resultado'];
                    $devS .= "</br>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaCOBRADO($sql,$idvendedor,$codigoempleado,$nombremarca,$idcliente,$fecha1,$fecha2)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {   $dato = $fi[$i];
                            $idmarca = $dato;
                            $sql2 = "SELECT  ma.nombre FROM marcas ma WHERE ma.idmarca= '$idmarca'";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($empresa1);
                            $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
                            $sqlruta = "SELECT date_format(cp.fechapago,'%d/%m/%Y') AS Fecha, cl.boleta, cp.boleta as Recibo, CONCAT( c.apellido, '-', c.nombre ) as Cliente,
                                        cl.sus As VentaSus, cp.monto as Montopagado, 0 as Rebaja FROM creditocliente cl, clientes c, creditopago cp
                                        WHERE cl.idcliente = c.idcliente and cl.idcrecliente = cp.idcrecliente AND cp.idvendedor = '$idvendedor' and cp.idmarca = '$idmarca' AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2'
                                        UNION ALL
                                        SELECT date_format(cp.fechapago,'%d/%m/%Y') AS Fecha, cl.boleta, cp.boleta as Recibo, CONCAT( c.apellido, '-', c.nombre ) as Cliente,
                                        cl.sus As VentaSus, 0 as Montopagado, cp.monto as Rebaja FROM creditocliente cl,clientes c, creditorebaja cp
                                        WHERE cl.idcliente = c.idcliente and cl.idcrecliente = cp.idcrecliente AND cp.idvendedor = '$idvendedor' and cp.idmarca = '$idmarca' AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2'";
                            $sqlrutafin = $sqlruta;
                            $select2 = "sum(cp.monto) as monto";
                            $from = "creditopago cp";
                            $where = "cp.idvendedor='$idvendedor' and cp.idmarca='$idmarca' AND cp.fechapago >= '$fecha1' AND cp.fechapago <= '$fecha2'";

                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $totalpago = $idalmacenA['resultado'];
                            $from1 = "creditorebaja cp";
                            $sql2512 = "SELECT ".$select2." FROM ".$from1." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2512, true, true, 'monto');
                            $totalrebaja = $idalmacenA['resultado'];
//function dibujarTablaparacobrocobrado($sql, $titulo,$totalventa,$totalpago,$totalventa,$totalrebaja,$codigoempleado)
                            $table = dibujarTablaparacobrocobrado($sqlrutafin, $empresa,$totalventa,$totalpago,$totalventa,$totalrebaja,$codigoempleado);
                            $devS .= $table['resultado'];
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));

                    $select = "sum(c.monto) as monto";
                    $from = "creditopago c";
                    $where = "c.idvendedor='$idvendedor' AND c.fechapago >= '$fecha1' AND c.fechapago <= '$fecha2' ";
                    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                    $totalporcobrar = $idalmacenA['resultado'];
                    $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:25px;text-align:center;background-color:silver;'>TOTAL COBRADO:</td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombremarca</td>";
                    $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
                    $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporcobrar."&nbsp;</td>";
                    $devS .= "</tr>";
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaOfCobros($sql,$idmarca,$codigoempleado,$nombremarca,$idcliente)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idvendedor = $dato;


$sql2 = "SELECT CONCAT( UPPER(nombres), '-', UPPER(apellidos) )AS nombre FROM empleados WHERE idempleado = '$idvendedor'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);
     //$iddetalleingreso = $fi[$i]['idempresa'];
       $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
   // $select1 = " date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago,cl.pagado,cl.porpagar,cl.ultimopago,cl.fechalimite";
   $select1 = " CONCAT( c.apellido, '-', c.nombre ) as Cliente,date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago AS Cobro,cl.rebaja,cl.porpagar AS SALDO,cl.ultimopago,cl.fechalimite,cl.factura";
   $from1 = "creditocliente cl,clientes c";
    $where1 = " cl.idcliente=c.idcliente and cl.estado='pendiente' AND cl.idvendedor='$idvendedor' and cl.idmarca='$idmarca'  ";

  if($idcliente == "null")
    {
    }else{ $where1 .= " AND cl.idcliente='$idcliente' ";
    }


   $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1."";

$sqlrutafin = $sqlruta;


$select = "sum(cl.sus) as monto";
$select1 = "sum(cl.pago) as monto";
$select2 = "sum(cl.porpagar) as monto";
$select3 = "sum(cl.rebaja) as monto";
    $from = "creditocliente cl,clientes c";
   $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' AND cl.idvendedor='$idvendedor' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalventa = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalpago = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporpagar = $idalmacenA['resultado'];
   $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalrebaja = $idalmacenA['resultado'];
$table = dibujarTablaparacobro($sqlrutafin, $empresa,$totalventa,$totalpago,$totalporpagar,$totalrebaja,$codigoempleado);
   $devS .= $table['resultado'];

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));



$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c";
   $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporcobrar = $idalmacenA['resultado'];

$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:25px;text-align:center;background-color:silver;'>TOTAL SALDO:</td>";
       $devS .= "<td style='display:none;'></td>";

       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombremarca</td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporcobrar."&nbsp;</td>";

       $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfCobrosresumen($sql,$idmarca,$codigoempleado,$nombremarca,$idcliente)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idvendedor = $dato;
 $idcliente = $dato;


     //$iddetalleingreso = $fi[$i]['idempresa'];
       $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
   // $select1 = " date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago,cl.pagado,cl.porpagar,cl.ultimopago,cl.fechalimite";
   $select1 = " CONCAT( c.apellido, '-', c.nombre ) as Cliente,0 as SaldoAnterior,cl.caja,cl.par,cl.sus,cl.rebaja as Rebajas,cl.pago AS Pagos,cl.porpagar AS SaldoActual";
   $from1 = "creditocliente cl,clientes c";
    $where1 = " cl.idcliente=c.idcliente and cl.estado='pendiente' AND cl.idcliente='$idcliente' and cl.idmarca='$idmarca'  ";



   $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1."";

$sqlrutafin = $sqlruta;


$select = "sum(cl.sus) as monto";
$select1 = "sum(cl.pago) as monto";
$select2 = "sum(cl.porpagar) as monto";
$select3 = "sum(cl.rebaja) as monto";
    $from = "creditocliente cl,clientes c";
   $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' AND cl.idvendedor='$idvendedor' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalventa = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalpago = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporpagar = $idalmacenA['resultado'];
   $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalrebaja = $idalmacenA['resultado'];
$table = dibujarTablaparacobro($sqlrutafin, $empresa,$totalventa,$totalpago,$totalporpagar,$totalrebaja,$codigoempleado);
   $devS .= $table['resultado'];

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));



$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl,clientes c";
   $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporcobrar = $idalmacenA['resultado'];

$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:25px;text-align:center;background-color:silver;'>TOTAL SALDO:</td>";
       $devS .= "<td style='display:none;'></td>";

       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombremarca</td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporcobrar."&nbsp;</td>";

       $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaresumenvendedor($sql, $titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:20px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";

                    }
                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                      for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                   $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
//$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual

   $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$saldoant."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventacaja."&nbsp;</td>";

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventapar."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$paresdev."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$susdev."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pagoactual."&nbsp;</td>";


  $devS .= "<td></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";


                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfCobroscliente($sql,$idmarca,$codigoempleado,$nombremarca,$idcliente)
{

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:18px;'>";
$devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombremarca</td></tr>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                       $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
               // $devS .= "<tr><td style='text-align:left'>".$z."</td>";
               $porcobrar=0;
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                     $idmarca= $dato;

$sql1 = "SELECT  ma.nombre FROM marcas ma WHERE ma.idmarca= '$idmarca' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'nombre');
   $marca = $idalmacenA['resultado'];
   $empresa=strtoupper($marca);

   $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
   // $select1 = " date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago,cl.pagado,cl.porpagar,cl.ultimopago,cl.fechalimite";
   $select1 = " CONCAT( c.nombres, '-', c.apellidos ) as Vendedor,date_format(cl.fechaventa,'%d/%m/%Y') AS Fecha,cl.boleta,cl.caja,cl.par,cl.sus,cl.pago AS Cobro,cl.rebaja,cl.porpagar AS SALDO,cl.ultimopago,cl.fechalimite,cl.factura";
   $from1 = "creditocliente cl,empleados c";
    $where1 = " cl.idvendedor=c.idempleado and cl.estado='pendiente' AND cl.idcliente='$idcliente' and cl.idmarca='$idmarca'  ";

  if($idcliente == "null")
    {
    }else{ $where1 .= " AND cl.idcliente='$idcliente' ";
    }

   $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1."";

$sqlrutafin = $sqlruta;


$select = "sum(cl.sus) as monto";
$select1 = "sum(cl.pago) as monto";
$select2 = "sum(cl.porpagar) as monto";
$select3 = "sum(cl.rebaja) as monto";
    $from = "creditocliente cl,empleados c";
   $where = "cl.idvendedor=c.idempleado and cl.estado='pendiente' AND cl.idcliente='$idcliente' and cl.idmarca='$idmarca'";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalventa = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalpago = $idalmacenA['resultado'];
       $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporpagar = $idalmacenA['resultado'];
   $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalrebaja = $idalmacenA['resultado'];
$table = dibujarTablaparacobro($sqlrutafin, $empresa,$totalventa,$totalpago,$totalporpagar,$totalrebaja,$codigoempleado);
   $devS .= $table['resultado'];

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));



$select = "sum(cl.porpagar) as monto";
    $from = "creditocliente cl";
   $where = "cl.estado='pendiente' AND cl.idcliente='$idcliente' ";
     if($idcliente == "null")
    {
    }else{ $where .= " AND cl.idcliente='$idcliente' ";
    }
    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
      $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
    $totalporcobrar = $idalmacenA['resultado'];

$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:25px;text-align:center;background-color:silver;'>TOTAL SALDO:</td>";
       $devS .= "<td style='display:none;'></td>";

       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;font-size:12px;'>$nombremarca</td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporcobrar."&nbsp;</td>";

       $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaparacobro($sql, $titulo,$totalventa,$totalpago,$totalporpagar,$totalrebaja,$codigoempleado)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:20px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";

                    }
                 //                  $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";

                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                      for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                   $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL</td>";

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

 $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalventa."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpago."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalrebaja."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalporpagar."&nbsp;</td>";

 $devS .= "<td></td>";
  $devS .= "<td></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";


                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaresumen($sql, $titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:20px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";
                    }
                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                    $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
                    //$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$saldoant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventacaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventapar."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$paresdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$susdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pagoactual."&nbsp;</td>";
                    $devS .= "<td></td>";
     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";
                    $devS .= "</tr>";
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablageneral($sql, $titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:20px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";

                    }
                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                      for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                               // $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".$dato."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                   $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
//$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual

   $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$saldoant."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventacaja."&nbsp;</td>";

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventapar."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$paresdev."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$susdev."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pagoactual."&nbsp;</td>";


  $devS .= "<td></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";


                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaresumentotal($sql, $titulo,$saldoant,$ventacaja,$ventapar,$ventasus,$rebaja,$pago,$pagoactual,$paresdev,$susdev)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:24px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";

                    }
                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                      for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaparacobrocobrado($sql, $titulo,$totalventa,$totalpago,$totalventa,$totalrebaja,$codigoempleado)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:75%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:20px;text-align:left;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";
                    }
                 //                  $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";

                    $devS .= "<tr><td style='line-height:150%;border-bottom:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Nro</td>";
                      for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='line-height:150%;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='line-height:150%; text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='line-height:150%;text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                    $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
                    $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpago."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalrebaja."&nbsp;</td>";
                    $devS .= "<td></td>";
                    $devS .= "<td></td>";
     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";
                    $devS .= "</tr>";
                    $devS .= "</table>";
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function reporteEmpresaHTML($idempresa, $return)
{
    $sql2 = "SELECT
 nombre,mes_planillla
FROM
  empresas
WHERE
  idempresa = '$idempresa'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);

       $idalmacenA1 =  findBySqlReturnCampoUnique($sql2, true, true, 'mes_planillla');
    $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
if($mesplani == "01") {
 $mes="ENERO";
 $mesred="Ene";

 }
if($mesplani == "02") {
 $mes="FEBRERO";
 $mesred="Feb";
 }
if($mesplani == "03") {
 $mes="MARZO";
 $mesred="Mar";
 }
if($mesplani == "04") {
 $mes="ABRIL";}
if($mesplani == "05") {
 $mes="MAYO";}
if($mesplani == "06") {
 $mes="JUNIO";}
if($mesplani == "07") {
 $mes="JULIO";}
if($mesplani == "08") {
 $mes="AGOSTO";}
if($mesplani == "09") {
 $mes="SEPTIEMBRE";}
if($mesplani == "10") {
 $mes="OCTUBRE";}
if($mesplani == "11") {
 $mes="NOVIEMBRE";}
if($mesplani == "12") {
 $mes="DICIEMBRE";}
    //    echo $idalmacen;

$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;
    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>AGENCIA DE CALZADOS<br />
         BALDERRAMA<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "Empresa ".$empresa." <br>";
    $html .= "MES PLANILLA  $mes  $anioplani";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
   $html .= "<tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT e.direccion,e.telefono,e.mes_planillla AS MesPlanilla,CONCAT( c.nombre, '-', c.apellido ) AS responsable,inf.saldo_empresa
FROM empresas e,clienteempresa c,inf_empresa inf
WHERE e.idempresa=inf.idempresa AND e.idempresa=c.idempresa AND c.referencia='responsable' AND e.idempresa!='epr-0' AND e.idempresa = '$idempresa' ";
    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    $sqlCar = "SELECT saldo_anterior, importe_boleta,importe_cobro,importe_devolucion,importe_castigo,importe_descuento,comision,diferencia,saldo_empresa,saldo_planilla,fecha_planilla
FROM inf_empresa WHERE idempresa = '$idempresa'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Movimiento");
    $html .= $carac['resultado'];
    $html .="<br>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);

$sql5 = "SELECT
 vd.boleta
FROM
  ventasdetalle vd, credito c
WHERE
  vd.idventadetalle=c.idventadetalle AND c.idempresa = '$idempresa' AND c.no_planilla ='$planilla'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql5, true, true, 'boleta');
    $tipo = $idalmacenA['resultado'];
  //	$sql2="SELECT i.numero_registro from ingreso i, tipo_ingreso ti where i.id_tipo_ingreso = ti.id_tipo_ingreso and i.fecha_ingreso>='".$_GET['fechaingreso7']."' and i.fecha_ingreso<='".$_GET['fechaingreso8']."' and i.id_tipo_ingreso='10'";
  $res2= consultaDB($sql5);
 // $r2=mysql_fetch_array($res2);
  //$numero = mysql_num_fields($res2);
  //echo $numero;
 // mysql_fetch_array
//echo "$r2[0]";
//$numero="3";
 for ($i = 0; $i <= $numero; $i++) {
 $r2[0];

$r2= mysql_fetch_array($res2);
 }
$re2=$r2[0]."-".$r2[1]."-".$r2[2];
//echo $sql5;

$recibo="1";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
  $sqlCar = "SELECT CONCAT( ce.nombre, '-', ce.apellido ) AS NombreyApellido, ce.item,'$re2' AS NumeroRecibo, ventasmes AS VentaOriginal, pago1 AS '$mes1',pago2 AS '$mes2',(pago3+pago4+pago5+pago6+pago7) AS '$mes3',pe.total AS Total
FROM planillaemitida pe, clienteempresa ce WHERE pe.idclienteempresa=ce.idclienteempresa AND pe.idempresa = '$idempresa' AND pe.no_planilla ='$planilla' ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Creditos");
    $html .= $carac['resultado'];


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function reportesclienteHTML($idempresa, $return)
{
    $sql2 = "SELECT
 nombre,mes_planillla
FROM
  empresas
WHERE
  idempresa = '$idempresa'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);

       $idalmacenA1 =  findBySqlReturnCampoUnique($sql2, true, true, 'mes_planillla');
    $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
if($mesplani == "01") {
 $mes="ENERO";
 $mesred="Ene";

 }
if($mesplani == "02") {
 $mes="FEBRERO";
 $mesred="Feb";
 }
if($mesplani == "03") {
 $mes="MARZO";
 $mesred="Mar";
 }
if($mesplani == "04") {
 $mes="ABRIL";}
if($mesplani == "05") {
 $mes="MAYO";}
if($mesplani == "06") {
 $mes="JUNIO";}
if($mesplani == "07") {
 $mes="JULIO";}
if($mesplani == "08") {
 $mes="AGOSTO";}
if($mesplani == "09") {
 $mes="SEPTIEMBRE";}
if($mesplani == "10") {
 $mes="OCTUBRE";}
if($mesplani == "11") {
 $mes="NOVIEMBRE";}
if($mesplani == "12") {
 $mes="DICIEMBRE";}
    //    echo $idalmacen;
$fecha1 = date("Y-m-d");
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;
    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>AGENCIA DE CALZADOS<br />
         BALDERRAMA<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "Empresa ".$empresa." <br>";
    $html .= "MES PLANILLA  $mesplanilla";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
   $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT e.direccion,e.telefono,e.mes_planillla AS MesPlanilla, e.responsable,inf.saldo_empresa
FROM empresas e,inf_empresa inf
WHERE e.idempresa=inf.idempresa  AND e.idempresa!='epr-0' AND e.idempresa = '$idempresa' ";
    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    $sqlCar = "SELECT  apellido AS Apellido,nombre AS Nombre,nit AS Nit,item AS Item,saldoactual AS SaldoCliente FROM clienteempresa WHERE codigo!='Sin Codigo'  AND idempresa = '$idempresa'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "CLIENTES");
    $html .= $carac['resultado'];
    $html .="<br>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);

$sql5 = "SELECT
 vd.boleta
FROM
  ventasdetalle vd, credito c
WHERE
  vd.idventadetalle=c.idventadetalle AND c.idempresa = '$idempresa' AND c.no_planilla ='$planilla'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql5, true, true, 'boleta');
    $tipo = $idalmacenA['resultado'];
  //	$sql2="SELECT i.numero_registro from ingreso i, tipo_ingreso ti where i.id_tipo_ingreso = ti.id_tipo_ingreso and i.fecha_ingreso>='".$_GET['fechaingreso7']."' and i.fecha_ingreso<='".$_GET['fechaingreso8']."' and i.id_tipo_ingreso='10'";
  $res2= consultaDB($sql5);
 // $r2=mysql_fetch_array($res2);
  //$numero = mysql_num_fields($res2);
  //echo $numero;
 // mysql_fetch_array
//echo "$r2[0]";
//$numero="3";
 for ($i = 0; $i <= $numero; $i++) {
 $r2[0];

$r2= mysql_fetch_array($res2);
 }
$re2=$r2[0]."-".$r2[1]."-".$r2[2];
//echo $sql5;

$recibo="1";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
  $sqlCar = "SELECT CONCAT( ce.nombre, '-', ce.apellido ) AS NombreyApellido, ce.item,'$re2' AS NumeroRecibo, ventasmes AS VentaOriginal, pago1 AS '$mes1',pago2 AS '$mes2',(pago3+pago4+pago5+pago6+pago7) AS '$mes3',pe.total AS Total
FROM planillaemitida pe, clienteempresa ce WHERE pe.idclienteempresa=ce.idclienteempresa AND pe.idempresa = '$idempresa' AND pe.no_planilla ='$planilla' ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Creditos");
    $html .= $carac['resultado'];


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}
function planillareemitidaHTML($idempresa,$planilla, $return)
{
    $sql2 = "SELECT
 nombre,mes_planillla
FROM
  empresas
WHERE
  idempresa = '$idempresa'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);

       $idalmacenA1 =  findBySqlReturnCampoUnique($sql2, true, true, 'mes_planillla');
    $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
if($mesplani == "01") {
 $mes="ENERO";
 $mesred="Ene";

 }
if($mesplani == "02") {
 $mes="FEBRERO";
 $mesred="Feb";
 }
if($mesplani == "03") {
 $mes="MARZO";
 $mesred="Mar";
 }
if($mesplani == "04") {
 $mes="ABRIL";}
if($mesplani == "05") {
 $mes="MAYO";}
if($mesplani == "06") {
 $mes="JUNIO";}
if($mesplani == "07") {
 $mes="JULIO";}
if($mesplani == "08") {
 $mes="AGOSTO";}
if($mesplani == "09") {
 $mes="SEPTIEMBRE";}
if($mesplani == "10") {
 $mes="OCTUBRE";}
if($mesplani == "11") {
 $mes="NOVIEMBRE";}
if($mesplani == "12") {
 $mes="DICIEMBRE";}
    //    echo $idalmacen;
 $sql3 = "SELECT
 tiporegistro
FROM
  movimientoplanilla
WHERE
  idempresa = '$idempresa' AND no_planilla ='$planilla' AND detalle ='reemision' AND emitido='1'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql3, true, true, 'tiporegistro');
    $tipo = $idalmacenA['resultado'];
   // echo $sql3;
    $sql2 = "SELECT
 fechaemitida
FROM
  planillaemitida
WHERE
  idempresa = '$idempresa' AND no_planilla ='$planilla' ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'fechaemitida');
    $fecha1 = $idalmacenA['resultado'];
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;
    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>AGENCIA DE CALZADOS<br />
         BALDERRAMA<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";
$tipo1="-R";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo1";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "CREDITOS OTORGADOS A ".$empresa." <br>";
    $html .= "CORRESPONDIENTES AL MES DE  $mes  $anioplani";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";

    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
 if($mesplani == "01") {
 $mesred="Ene";
 $mes1=$mesred-$anioplani;
$mes2="Feb"-$anioplani;
$mes3="Mar"-$anioplani;
 }
if($mesplani == "02") {
 $mesred="Feb";
$mes1=$mesred."-".$anioplani ;
$mes2="Mar"."-".$anioplani;
$mes3="Abr"."-".$anioplani;
 }
if($mesplani == "03") {
 $mesred="Mar";
$mes1=$mesred."-".$anioplani ;
$mes2="Abr"."-".$anioplani;
$mes3="May"."-".$anioplani;

 }
if($mesplani == "04") {
$mesred="Abr";
$mes1=$mesred."-".$anioplani ;
$mes2="May"."-".$anioplani;
$mes3="Jun"."-".$anioplani;
}
if($mesplani == "05") {
    $mesred="May";
$mes1=$mesred."-".$anioplani ;
$mes2="Jun"."-".$anioplani;
$mes3="Jul"."-".$anioplani;

}
if($mesplani == "06") {
 $mesred="Jun";
$mes1=$mesred."-".$anioplani ;
$mes2="Jul"."-".$anioplani;
$mes3="Agos"."-".$anioplani;

 }
if($mesplani == "07") {
 $mesred="Jul";
$mes1=$mesred."-".$anioplani ;
$mes2="Agos"."-".$anioplani;
$mes3="Sept"."-".$anioplani;
 }
if($mesplani == "08") {
 $mesred="Agos";
$mes1=$mesred."-".$anioplani ;
$mes2="Sept"."-".$anioplani;
$mes3="Oct"."-".$anioplani;

 }
if($mesplani == "09") {
 $mesred="Sept";
$mes1=$mesred."-".$anioplani ;
$mes2="Oct"."-".$anioplani;
$mes3="Nov"."-".$anioplani;

 }
if($mesplani == "10") {
 $mesred="Oct";
$mes1=$mesred."-".$anioplani ;

 }
if($mesplani == "11") {
 $mesred="Nov";
$mes1=$mesred."-".$anioplani ;
$mes2="Dic"."-".$anioplani;
$mes3="Ene"."-".$anioplani;

 }
if($mesplani == "12") {
 $mesred="Dic";
$mes1=$mesred."-".$anioplani ;
$mes2="Ene"."-".$anioplani;
$mes3="Feb"."-".$anioplani;
 }
$sql5 = "SELECT
 vd.boleta
FROM
  ventasdetalle vd, credito c
WHERE
  vd.idventadetalle=c.idventadetalle AND c.idempresa = '$idempresa' AND c.no_planilla ='$planilla'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql5, true, true, 'boleta');
    $tipo = $idalmacenA['resultado'];
  //	$sql2="SELECT i.numero_registro from ingreso i, tipo_ingreso ti where i.id_tipo_ingreso = ti.id_tipo_ingreso and i.fecha_ingreso>='".$_GET['fechaingreso7']."' and i.fecha_ingreso<='".$_GET['fechaingreso8']."' and i.id_tipo_ingreso='10'";
  $res2= consultaDB($sql5);
 // $r2=mysql_fetch_array($res2);
  //$numero = mysql_num_fields($res2);
  //echo $numero;
 // mysql_fetch_array
//echo "$r2[0]";
//$numero="3";
 for ($i = 0; $i <= $numero; $i++) {
 $r2[0];

$r2= mysql_fetch_array($res2);
 }
$re2=$r2[0]."-".$r2[1]."-".$r2[2];
//echo $sql5;

$recibo="1";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
  $sqlCar = "SELECT CONCAT( ce.nombre, '-', ce.apellido ) AS NombreyApellido, ce.item,'$re2' AS NumeroRecibo, ventasmes AS VentaOriginal, pago1 AS '$mes1',pago2 AS '$mes2',(pago3+pago4+pago5+pago6+pago7) AS '$mes3',pe.total AS Total
FROM planillaemitida pe, clienteempresa ce WHERE pe.idclienteempresa=ce.idclienteempresa AND pe.idempresa = '$idempresa' AND pe.no_planilla ='$planilla' ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Creditos");
    $html .= $carac['resultado'];


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}
function planillaemitidaHTML($idempresa,$planilla, $return)
{
    $sql2 = "SELECT
 nombre,mes_planillla
FROM
  empresas
WHERE
  idempresa = '$idempresa'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
    $empresa1 = $idalmacenA['resultado'];
      $empresa=strtoupper($empresa1);

       $idalmacenA1 =  findBySqlReturnCampoUnique($sql2, true, true, 'mes_planillla');
    $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
if($mesplani == "01") {
 $mes="ENERO";
 $mesred="Ene";

 }
if($mesplani == "02") {
 $mes="FEBRERO";
 $mesred="Feb";
 }
if($mesplani == "03") {
 $mes="MARZO";
 $mesred="Mar";
 }
if($mesplani == "04") {
 $mes="ABRIL";}
if($mesplani == "05") {
 $mes="MAYO";}
if($mesplani == "06") {
 $mes="JUNIO";}
if($mesplani == "07") {
 $mes="JULIO";}
if($mesplani == "08") {
 $mes="AGOSTO";}
if($mesplani == "09") {
 $mes="SEPTIEMBRE";}
if($mesplani == "10") {
 $mes="OCTUBRE";}
if($mesplani == "11") {
 $mes="NOVIEMBRE";}
if($mesplani == "12") {
 $mes="DICIEMBRE";}
    //    echo $idalmacen;
 $sql3 = "SELECT
 tiporegistro
FROM
  movimientoplanilla
WHERE
  idempresa = '$idempresa' AND no_planilla ='$planilla' AND detalle ='emision' AND emitido='1'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql3, true, true, 'tiporegistro');
    $tipo = $idalmacenA['resultado'];
   // echo $sql3;
    $sql2 = "SELECT
 fechaemitida
FROM
  planillaemitida
WHERE
  idempresa = '$idempresa' AND no_planilla ='$planilla' ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'fechaemitida');
    $fecha1 = $idalmacenA['resultado'];
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;
    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>AGENCIA DE CALZADOS<br />
         BALDERRAMA<br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    //$html .= "<tr style='width:100%height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "CREDITOS OTORGADOS A ".$empresa." <br>";
    $html .= "CORRESPONDIENTES AL MES DE  $mes  $anioplani";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";

    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);
$mesplani=$idsCAr[0];
$anioplani=$idsCAr[1];
 if($mesplani == "01") {
 $mesred="Ene";
 $mes1=$mesred-$anioplani;
$mes2="Feb"-$anioplani;
$mes3="Mar"-$anioplani;
 }
if($mesplani == "02") {
 $mesred="Feb";
$mes1=$mesred."-".$anioplani ;
$mes2="Mar"."-".$anioplani;
$mes3="Abr"."-".$anioplani;
 }
if($mesplani == "03") {
 $mesred="Mar";
$mes1=$mesred."-".$anioplani ;
$mes2="Abr"."-".$anioplani;
$mes3="May"."-".$anioplani;

 }
if($mesplani == "04") {
$mesred="Abr";
$mes1=$mesred."-".$anioplani ;
$mes2="May"."-".$anioplani;
$mes3="Jun"."-".$anioplani;
}
if($mesplani == "05") {
    $mesred="May";
$mes1=$mesred."-".$anioplani ;
$mes2="Jun"."-".$anioplani;
$mes3="Jul"."-".$anioplani;

}
if($mesplani == "06") {
 $mesred="Jun";
$mes1=$mesred."-".$anioplani ;
$mes2="Jul"."-".$anioplani;
$mes3="Agos"."-".$anioplani;

 }
if($mesplani == "07") {
 $mesred="Jul";
$mes1=$mesred."-".$anioplani ;
$mes2="Agos"."-".$anioplani;
$mes3="Sept"."-".$anioplani;
 }
if($mesplani == "08") {
 $mesred="Agos";
$mes1=$mesred."-".$anioplani ;
$mes2="Sept"."-".$anioplani;
$mes3="Oct"."-".$anioplani;

 }
if($mesplani == "09") {
 $mesred="Sept";
$mes1=$mesred."-".$anioplani ;
$mes2="Oct"."-".$anioplani;
$mes3="Nov"."-".$anioplani;

 }
if($mesplani == "10") {
 $mesred="Oct";
$mes1=$mesred."-".$anioplani ;

 }
if($mesplani == "11") {
 $mesred="Nov";
$mes1=$mesred."-".$anioplani ;
$mes2="Dic"."-".$anioplani;
$mes3="Ene"."-".$anioplani;

 }
if($mesplani == "12") {
 $mesred="Dic";
$mes1=$mesred."-".$anioplani ;
$mes2="Ene"."-".$anioplani;
$mes3="Feb"."-".$anioplani;
 }
$sql5 = "SELECT
 vd.boleta
FROM
  ventasdetalle vd, credito c
WHERE
  vd.idventadetalle=c.idventadetalle AND c.idempresa = '$idempresa' AND c.no_planilla ='$planilla'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql5, true, true, 'boleta');
    $tipo = $idalmacenA['resultado'];
  //	$sql2="SELECT i.numero_registro from ingreso i, tipo_ingreso ti where i.id_tipo_ingreso = ti.id_tipo_ingreso and i.fecha_ingreso>='".$_GET['fechaingreso7']."' and i.fecha_ingreso<='".$_GET['fechaingreso8']."' and i.id_tipo_ingreso='10'";
  $res2= consultaDB($sql5);
 // $r2=mysql_fetch_array($res2);
  //$numero = mysql_num_fields($res2);
  //echo $numero;
 // mysql_fetch_array
//echo "$r2[0]";
//$numero="3";
 for ($i = 0; $i <= $numero; $i++) {
 $r2[0];

$r2= mysql_fetch_array($res2);
 }
$re2=$r2[0]."-".$r2[1]."-".$r2[2];
//echo $sql5;

$recibo="1";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
  $sqlCar = "SELECT CONCAT( ce.nombre, '-', ce.apellido ) AS NombreyApellido, ce.item,'$re2' AS NumeroRecibo, ventasmes AS VentaOriginal, pago1 AS '$mes1',pago2 AS '$mes2',(pago3+pago4+pago5+pago6+pago7) AS '$mes3',pe.total AS Total
FROM planillaemitida pe, clienteempresa ce WHERE pe.idclienteempresa=ce.idclienteempresa AND pe.idempresa = '$idempresa' AND pe.no_planilla ='$planilla' ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Creditos");
    $html .= $carac['resultado'];


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}

function  reporteComprasTotales($almacenV,$fechainiV,$fechafinV,$return = true)
{
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    if($fechainiV == "" || $fechainiV == null)
    {
        $fechainiV = date("Y-m-d");
    }
    if($fechafinV == "" || $fechafinV == null)
    {
        $fechafinV = date("Y-m-d");
    }

    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $select = " comp.fecha,
  comp.idcompra,
  comp.montoapagar Neto,
  itm.cantidad,
  itm.precio,
  prod.nombre as producto ";
    $from = " `compra` comp,
  `items` itm,
  `productos` prod ";
    $where = " itm.idcompra = comp.idcompra AND
  prod.idproducto = itm.idproducto ";



    if($fechainiV != null && $fechainiV != "")
    {
        $where .= " AND comp.fecha >= '$fechainiV'";
    }

    if($fechafinV != null && $fechafinV != "")
    {
        $where .= " AND comp.fecha <= '$fechafinV'";
    }

    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE TOTAL <br>DE<br> COMPRAS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";lorg
    $html .= "<tr>";
    $html .= "<th >Factura:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tfacturaV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Almacen:</th>";
    //    if($almacenV != "Todos" && $almacenV != null && $almacenV != "")
    //    {
    //        $sql6= " SELECT nombre,idalmacen FROM almacen WHERE idalmacen= '$almacenV'
    //  ";
    //        $datosa = getTablaToArrayOfSQL($sql6);
    //        $vena = $datosa["resultado"];
    //        //      $almacenV = $vena[0]['nombre'];
    //    }


  /*$sqlid= "SELECT
  alm.nombre
FROM
  almacen alm
WHERE
  alm.idalmacen = '$idalmacenV'";

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "nombre");
    $almacen= $res['resultado'];*/


    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$almacenV</th>";
    //    $html .= "<th >Moneda:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$monedaV</th>";
    $html .= "<th >Fecha Ini:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechainiV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Vendedor:</th>";
    //    $vendedorV =$_SESSION['idusuario'];
    //    echo $_SESSION['idusuario'];
    ////    $vendedor1 = $_SESSION['apellido1'];
    ////    if($vendedorV != "Todos" && $vendedorV != null && $vendedorV != "")
    ////    {
    //    $sql5[]= " SELECT nombre,apellido1,idusuario FROM usuario WHERE idusuario= '$vendedorV'
    //  ";
    //    MostrarConsulta($sql5);
    //$datosb = getTablaToArrayOfSQL($sql5);
    //        $venb = $datosb["resultado"];
    //        $vendedorV = $venb[0]['nombre'];
    //	$vendedor1 = $venb[0]['apellido1'];
    ////	}
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$vendedorV-$vendedor1</th>";
    //    $html .= "<th >Tipo:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tipoV</th>";
    $html .= "<th >Fecha Fin</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechafinV</th>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<th >Cliente</th>";
    //    if($clienteV != "Todos" && $clienteV != null && $clienteV != "")
    //    {
    //        $sql4= " SELECT nombre,idcliente,nit FROM cliente WHERE nit= '$clienteV'
    //  ";
    //        $datosc = getTablaToArrayOfSQL($sql4);
    //        $venc = $datosc["resultado"];
    //        $clienteV = $venc[0]['nombre'];
    //    }
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$clienteV</th>";
    $html .= "</tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $table = dibujarTablaOfSQL($sql, $tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

////////////////////////////////////////////////////

function  reporteComprasTotales1($almacenV,$fechainiV,$fechafinV,$return = true)
{
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    if($fechainiV == "" || $fechainiV == null)
    {
        $fechainiV = date("Y-m-d");
    }
    if($fechafinV == "" || $fechafinV == null)
    {
        $fechafinV = date("Y-m-d");
    }

    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $select = " comp.fecha,
  comp.idcompra,
  comp.montoapagar Neto,
  itm.cantidad,
  itm.precio,
  prod.nombre as producto ";
    $from = " `compra` comp,
  `items` itm,
  `productos` prod ";
    $where = " itm.idcompra = comp.idcompra AND
  prod.idproducto = itm.idproducto ";



    if($fechainiV != null && $fechainiV != "")
    {
        $where .= " AND comp.fecha >= '$fechainiV'";
    }

    if($fechafinV != null && $fechafinV != "")
    {
        $where .= " AND comp.fecha <= '$fechafinV'";
    }

    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE TOTAL <br>MERMAS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";lorg
    $html .= "<tr>";
    $html .= "<th >Factura:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tfacturaV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Almacen:</th>";
    //    if($almacenV != "Todos" && $almacenV != null && $almacenV != "")
    //    {
    //        $sql6= " SELECT nombre,idalmacen FROM almacen WHERE idalmacen= '$almacenV'
    //  ";
    //        $datosa = getTablaToArrayOfSQL($sql6);
    //        $vena = $datosa["resultado"];
    //        //      $almacenV = $vena[0]['nombre'];
    //    }


  /*$sqlid= "SELECT
  alm.nombre
FROM
  almacen alm
WHERE
  alm.idalmacen = '$idalmacenV'";

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "nombre");
    $almacen= $res['resultado'];*/


    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$almacenV</th>";
    //    $html .= "<th >Moneda:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$monedaV</th>";
    $html .= "<th >Fecha Ini:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechainiV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Vendedor:</th>";
    //    $vendedorV =$_SESSION['idusuario'];
    //    echo $_SESSION['idusuario'];
    ////    $vendedor1 = $_SESSION['apellido1'];
    ////    if($vendedorV != "Todos" && $vendedorV != null && $vendedorV != "")
    ////    {
    //    $sql5[]= " SELECT nombre,apellido1,idusuario FROM usuario WHERE idusuario= '$vendedorV'
    //  ";
    //    MostrarConsulta($sql5);
    //$datosb = getTablaToArrayOfSQL($sql5);
    //        $venb = $datosb["resultado"];
    //        $vendedorV = $venb[0]['nombre'];
    //	$vendedor1 = $venb[0]['apellido1'];
    ////	}
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$vendedorV-$vendedor1</th>";
    //    $html .= "<th >Tipo:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tipoV</th>";
    $html .= "<th >Fecha Fin</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechafinV</th>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<th >Cliente</th>";
    //    if($clienteV != "Todos" && $clienteV != null && $clienteV != "")
    //    {
    //        $sql4= " SELECT nombre,idcliente,nit FROM cliente WHERE nit= '$clienteV'
    //  ";
    //        $datosc = getTablaToArrayOfSQL($sql4);
    //        $venc = $datosc["resultado"];
    //        $clienteV = $venc[0]['nombre'];
    //    }
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$clienteV</th>";
    $html .= "</tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $table = dibujarTablaOfSQL($sql, $tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
///////////////////////////////////////////////////

function  reporteClientesTotales($almacenV,$fechainiV,$fechafinV,$return = true)
{
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    if($fechainiV == "" || $fechainiV == null)
    {
        $fechainiV = date("Y-m-d");
    }
    if($fechafinV == "" || $fechafinV == null)
    {
        $fechafinV = date("Y-m-d");
    }

    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $select = " CONCAT(cli.nombre, ' ', cli.apellido1, ' ', cli.apellido2) AS Cliente,
  ven.idventa,
  ven.fecha,
  ven.montoapagar AS Efectivo,
  itve.cantidad,
  prod.nombre AS producto,
  usr.nombre as atendio ";
    $from = " ventas ven,
  itemventa itve,
  productos prod,
  cliente cli,
  almacenes alm,
  `usuario` usr";
    $where = " cli.idcliente = ven.idcliente AND
  ven.idventa = itve.idventa AND
  itve.idproducto = prod.idproducto AND
  cli.idalmacen = alm.idalmacen AND
  alm.nombre = '$almacenV' AND
  ven.responsable = usr.idusuario ";



    if($fechainiV != null && $fechainiV != "")
    {
        $where .= " AND ven.fecha >= '$fechainiV'";
    }

    if($fechafinV != null && $fechafinV != "")
    {
        $where .= " AND ven.fecha <= '$fechafinV'";
    }

    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //        MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE TOTAL <br>DE<br> COMPRAS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";lorg
    $html .= "<tr>";
    $html .= "<th >Factura:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tfacturaV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Almacen:</th>";
    //    if($almacenV != "Todos" && $almacenV != null && $almacenV != "")
    //    {
    //        $sql6= " SELECT nombre,idalmacen FROM almacen WHERE idalmacen= '$almacenV'
    //  ";
    //        $datosa = getTablaToArrayOfSQL($sql6);
    //        $vena = $datosa["resultado"];
    //        //      $almacenV = $vena[0]['nombre'];
    //    }


  /*$sqlid= "SELECT
  alm.nombre
FROM
  almacen alm
WHERE
  alm.idalmacen = '$idalmacenV'";

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "nombre");
    $almacen= $res['resultado'];*/


    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$almacenV</th>";
    //    $html .= "<th >Moneda:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$monedaV</th>";
    $html .= "<th >Fecha Ini:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechainiV</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Vendedor:</th>";
    //    $vendedorV =$_SESSION['idusuario'];
    //    echo $_SESSION['idusuario'];
    ////    $vendedor1 = $_SESSION['apellido1'];
    ////    if($vendedorV != "Todos" && $vendedorV != null && $vendedorV != "")
    ////    {
    //    $sql5[]= " SELECT nombre,apellido1,idusuario FROM usuario WHERE idusuario= '$vendedorV'
    //  ";
    //    MostrarConsulta($sql5);
    //$datosb = getTablaToArrayOfSQL($sql5);
    //        $venb = $datosb["resultado"];
    //        $vendedorV = $venb[0]['nombre'];
    //	$vendedor1 = $venb[0]['apellido1'];
    ////	}
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$vendedorV-$vendedor1</th>";
    //    $html .= "<th >Tipo:</th>";
    //    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$tipoV</th>";
    $html .= "<th >Fecha Fin</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechafinV</th>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<th >Cliente</th>";
    //    if($clienteV != "Todos" && $clienteV != null && $clienteV != "")
    //    {
    //        $sql4= " SELECT nombre,idcliente,nit FROM cliente WHERE nit= '$clienteV'
    //  ";
    //        $datosc = getTablaToArrayOfSQL($sql4);
    //        $venc = $datosc["resultado"];
    //        $clienteV = $venc[0]['nombre'];
    //    }
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$clienteV</th>";
    $html .= "</tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $table = dibujarTablaOfSQL($sql, $tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

/////////////////////
function reporteProducto($idproducto,$idalmacen, $return)
{
    $sqlruta = "
        SELECT
          ima.ruta
        FROM
          `imagenes` ima
        WHERE
          ima.idproducto = '$idproducto'
        ";

    //$idalmacen = $_SESSION['idalmacen'];

    //    echo "el ide es".$idalmacen;
    $res= findBySqlReturnCampoUnique($sqlruta, true,true, "ruta");
    $ruta= $res['resultado'];

    //    echo $ruta;
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";

    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";

    $html .= "REPORTE <br>DE<br> PRODUCTO";
    $html .= "</td>";
    $html .= "<td style='border-bottom:1px solid #000000;'><img src='images/jpg.php?name=../php/".$ruta."&size=100'>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT p.codigo AS Codigo,  p.nombre AS Nombre, p.detalle AS Descripcion ,
  p.stockminimo AS StockMinimo, k.precio1bs AS PrecioBS, k.precio1sus AS PrecioSUS, c.nombre AS Categoria,
  k.precio2bs AS PrecioMinimo, k.fechamodificacion AS FechaReg, pv.nombre AS Proveedor, p.unidad AS Unidad
FROM productos p, kardexalmacen k, categorias c, proveedores pv
WHERE p.idproveedor = pv.idproveedor AND p.idcategoria = c.idcategoria AND p.idproducto =k.idproducto  AND p.idproducto = '$idproducto' and k.idalmacen = '$idalmacen'";
    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del producto");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    $sqlCar = "SELECT pv.nombre, pv.representante FROM productos p,proveedores pv WHERE  p.idproveedor = pv.idproveedor AND p.idproducto = '$idproducto'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Proveedor");
    $html .= $carac['resultado'];
    $html .="<br>";
    $sqlKar = "SELECT k.saldocantidad AS Cantidad, k.costounitario AS Costo, k.fechamodificacion AS Fecha FROM kardexalmacen k WHERE k.idproducto = '$idproducto' and k.idalmacen = '$idalmacen' ";
    //    MostrarConsulta($sqlKar);
    $kardex = dibujarTuplaOfSQLNormal($sqlKar, "Kardex");
    $html .= $kardex['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";
    $sqlInv = "
(SELECT
  a.nombre AS almacen,
  ka.saldocantidad as cantidad,
  a.direccion AS ubicacion,

  ka.precio1bs AS precioBS,
  ka.precio1sus AS precioSUS
FROM
  kardexalmacen ka,
  almacenes a
WHERE
  ka.idalmacen = a.idalmacen AND
  ka.idproducto = '$idproducto')
  UNION
  (
SELECT
  a.nombre AS almacen,
  ka.saldocantidad as cantidad,
  a.direccion AS ubicacion,

  ka.precio1bs AS precioBS,
  ka.precio1sus AS precioSUS
FROM
  kardexalmacen ka,
  almacenes a
WHERE
  a.idalmacen = 'alm-1000' AND
  ka.idproducto = '$idproducto'
  )

";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}

function reporteMarcaProductos($idmarca, $return)
{
    //    $sqlruta = "
    //        SELECT
    //  ma.idmarca,
    //  ma.codigo,
    //  ma.nombre,
    //  ma.imagen,
    //  ca.nombre AS categoria,
    //  pr.nombre AS proveedor
    //FROM
    //  `marcas` ma,
    //  `categorias` ca,
    //  `proveedores` pr
    //WHERE
    //  ma.idproveedor = pr.idproveedor AND
    //  ma.idcategoria = ca.idcategoria
    //  ma.idmarca = $idmarca
    //        ";

    //$idalmacen = $_SESSION['idalmacen'];

    //    echo "el ide es".$idalmacen;
    //    $res= findBySqlReturnCampoUnique($sqlruta, true,true, "ruta");
    //    $ruta= $res['resultado'];

    //    echo $ruta;
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";

    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";

    $html .= "REPORTE <br>DE<br> PRODUCTO";
    $html .= "</td>";
    $html .= "<td style='border-bottom:1px solid #000000;'><img src='images/jpg.php?name=../php/".$ruta."&size=100'>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql=" SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.imagen,
  ca.nombre AS categoria,
  pr.nombre AS proveedor
FROM
  marcas ma,
  categorias ca,
  proveedores pr
WHERE
  ma.idproveedor = pr.idproveedor AND
  ma.idcategoria = ca.idcategoria AND
  ma.idmarca = '$idmarca'

";
    //    MostrarConsulta($sql);
    $carac1 = dibujarTablaOfSQLNormal($sql, "Informacion Prouctos");
    $html .= $carac1['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    //    $sqlCar = "SELECT pv.nombre, pv.representante FROM productos p,proveedores pv WHERE  p.idproveedor = pv.idproveedor AND p.idproducto = '$idproduct'";
    //    $carac = dibujarTablaOfSQLNormal($sqlCar, "Proveedor");
    //    $html .= $carac['resultado'];
    $html .="<br>";
    //    $sqlKar = "SELECT k.saldocantidad AS Cantidad, k.costounitario AS Costo, k.fechamodificacion AS Fecha FROM kardexalmacen k WHERE k.idproducto = '$idproduct' and k.idalmacen = '$idalmacen' ";
    //    //    MostrarConsulta($sqlKar);
    //    $kardex = dibujarTuplaOfSQLNormal($sqlKar, "Kardex");
    //    $html .= $kardex['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";
    //    $sqlInv = "
    //(SELECT
    //  a.nombre AS almacen,
    //  ka.saldocantidad as cantidad,
    //  a.direccion AS ubicacion,
    //
    //  ka.precio1bs AS precioBS,
    //  ka.precio1sus AS precioSUS
    //FROM
    //  kardexalmacen ka,
    //  almacenes a
    //WHERE
    //  ka.idalmacen = a.idalmacen AND
    //  ka.idproducto = '$idproduct')
    //  UNION
    //  (
    //SELECT
    //  a.nombre AS almacen,
    //  ka.saldocantidad as cantidad,
    //  a.direccion AS ubicacion,
    //
    //  ka.precio1bs AS precioBS,
    //  ka.precio1sus AS precioSUS
    //FROM
    //  kardexalmacen ka,
    //  almacenes a
    //WHERE
    //  a.idalmacen = 'alm-1000' AND
    //  ka.idproducto = '$idproduct'
    //  )
    //
    //";
    //    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
    //    $html .= $inventario['resultado'];
    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}



function reporteMuestra($idmuestra, $return)
{
    $sql ="
    SELECT
  mar.pedido
FROM
  marcas mar,
  muestras mue
WHERE
  mar.idmarca = mue.idmarca AND
  mue.idmuestra = '$idmuestra'
    ";
    $res =findBySqlReturnCampoUnique($sql,true,true, "pedido");
    $pedido = $res['resultado'];
    if($pedido == "1")
    {
        $sql1 = "
            SELECT
              mo.codigo,
              mo.material,
              mo.color,
              mo.cantidad,
              mue.preciooficina

            FROM
              modelos mo,
              modelo_muestra mue
            WHERE
              mue.idmuestra = '$idmuestra' AND
              mue.idmodelo = mo.idmodelo
            ";
    }
    else
    {
        $sql1 ="
                SELECT
                  mo.codigo,
                  mo.cantidad,
                  mo.coleccion,
                  mue.preciooficina,
                  mo.stylename
                FROM
                  modelos mo,
                  modelo_muestra mue
                WHERE
                  mue.idmuestra = '$idmuestra' AND
                  mue.idmodelo = mo.idmodelo
                ";
    }

    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .="</tr>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "<h2>REPORTE <BR> MUESTRA </h2><br>";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //        $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $sql = "SELECT idmateria as idmaterial, codigo, nombre, descripcion
    //FROM `materiales`
    //where idmateria = '$idmaterial'
    //";
    $table = dibujarTablaOfSQLNormal($sql1, "MUESTRAS");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $html .= "</td></tr>";
  /*$html .= "<tr><td colspan='3'>";
    $sqlInv = "SELECT
 mka.fecha,mka.hora,mka.descripcion, p.idproducto AS codigo,p.nombre AS producto,p.estado,mka.entrada,mka.salida,mka.saldo,mka.ingreso,mka.egreso,mka.saldobs
FROM
  almacenes a,
  productos p,
  movimientokardexalmacen mka
WHERE
  mka.idproducto=p.idproducto AND
  mka.idalmacen = a.idalmacen AND
  mka.idalmacen = '$idalmacen' ";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Movimientos de Almacen");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";
    */

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }



}




function reporteColeccion($idcoleccion, $return)
{


    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "<h2>REPORTE <BR> COLECCION </h2><br>";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT
  col.anio,
  col.colecion,
  col.codigo
FROM
  coleccion col
WHERE
  col.idcoleccion = '$idcoleccion'
";
    $table = dibujarTablaOfSQLNormal($sql, "COLECCIONES");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }



}

function verpagos($idcrecliente, $return)
{
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "<h2> PAGOS <BR> </h2><br>";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $sql = "SELECT date_format(c.fechapago,'%d/%m/%Y') AS FechaPago, c.boleta, c.monto, c.tipopago, CONCAT(e.nombres, '-', e.apellidos) AS vendedor, m.nombre as marca
            FROM creditopago c, marcas m, empleados e
            WHERE c.idmarca = m.idmarca and c.idvendedor = e.idempleado AND c.idcrecliente = '$idcrecliente'";
    $sql4112 = "SELECT SUM(c.monto) AS totaldeuda FROM creditopago c WHERE c.idcrecliente = '$idcrecliente'";
    $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    $totalcobradoacuenta = $creditoA111['resultado'];
//MostrarConsulta($sql);
    $table = dibujarTablaOfSQLNormaltotales($sql, "PAGOS", $totalcobradoacuenta);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql1 = "SELECT date_format(c.fechapago,'%d/%m/%Y') AS FechaPago, c.boleta, c.monto, c.tipopago, m.nombre as marca
            FROM creditorebaja c, marcas m
            WHERE c.idmarca = m.idmarca AND c.idcrecliente = '$idcrecliente'";
//echo $sql1;
    $sql4112 = "SELECT SUM(c.monto) AS totaldeuda FROM creditorebaja c WHERE c.idcrecliente = '$idcrecliente'";
    $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "totaldeuda");
    $totalcobradoacuenta = $creditoA111['resultado'];
    $table = dibujarTablaOfSQLNormaltotales($sql1, "REBAJAS", $totalcobradoacuenta);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
            <p>NovaModa SRL<br />
            Cochabamba - Bolivia<br />
    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function reporteLinea($idlinea, $return)
{


    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "<h2>REPORTE <BR> LINEA </h2><br>";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT
  lin.nombre,
  lin.descripcion,
  lin.codigo,
  lin.idlinea
FROM
  `lineas` lin
WHERE
  lin.idlinea = '$idlinea'
";
    $table = dibujarTablaOfSQLNormal($sql, "LINEAS");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $html .= "</td></tr>";
  /*$html .= "<tr><td colspan='3'>";
    $sqlInv = "SELECT
 mka.fecha,mka.hora,mka.descripcion, p.idproducto AS codigo,p.nombre AS producto,p.estado,mka.entrada,mka.salida,mka.saldo,mka.ingreso,mka.egreso,mka.saldobs
FROM
  almacenes a,
  productos p,
  movimientokardexalmacen mka
WHERE
  mka.idproducto=p.idproducto AND
  mka.idalmacen = a.idalmacen AND
  mka.idalmacen = '$idalmacen' ";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Movimientos de Almacen");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";
    */

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }



}


function reporteCajero($idusuario,$fechaInicio,$fechaFin, $return)
{
    $html = "";


    $sql = "SELECT
  SUM(ven.montoapagar) AS caja
FROM
  ventas ven,
  usuario usr
WHERE
  ven.cajero = usr.idusuario AND
  ven.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND
  usr.idusuario = '$idusuario'

";
    //    MostrarConsulta($sql);
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe ventas en esa fecha ...............";
        exit;
    }
    else
    {


        $ven1 = $datos["resultado"];
        $totalMonto = $ven1[0]['caja'];


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "REPORTE <br>DE<br> VENTAS";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven1[0]['idventa']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;</td><td></td><td style='font-size:11px;font-weight:bold;'> </td><td></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".date("Y-m-d")."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
        $html .= "</br>";
        $html .= "</table>";
        $html .= "</br>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "
SELECT
  concat(usr.nombre,' ',usr.apellido1,' ',usr.apellido2) as cajero,
  ven.fecha,
  ven.idventa,
  prod.nombre as producto,
  ven.montoapagar as ingreso
FROM
  usuario usr,
  ventas ven,
  `itemventa` itv,
  `productos` prod
WHERE
  usr.idusuario = ven.cajero AND
  usr.idusuario = '$idusuario' AND
  ven.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND
  itv.idventa = ven.idventa AND
  itv.idproducto = prod.idproducto
GROUP BY

  ven.idventa
                  ";
        //         $totalDescuento = $ven[0]['descuento'];
        //        $table = dibujarTablaOfSQL($sqlIV, "productos");
        $table=dibujarTablaOfSQLNormal($sqlIV, "Productos");
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:450px;'></td><td style='width:125px;font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'> </td><td style='width:75px;text-align:right;'></td></tr>";
        //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "</br>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Ventas :</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }
}



function reporteStok( $return)
{
    $html = "";


    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>STOCK";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
    $html .= "</table>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar1 = "SELECT
  prod.codigo,
  prod.nombre AS producto,
  prod.marca,
  cat.nombre as categoria,
  prod.estado,
  (krd.cantidad + kal.cantidad) AS cantidad,
  prov.nombre AS proveedor,
  krd.precio2bs AS precioMenor,
  krd.precio1bs AS precioMayor

FROM
  productos prod,
  proveedores prov,
  kardex krd,
  kardexalmacen kal,
  `categorias` cat
WHERE
  prod.idproducto = krd.idproducto AND
  prod.idproducto = kal.idproducto AND
  prod.idproveedor = prov.idproveedor AND
  prod.idcategoria = cat.idcategoria
GROUP BY
  prod.codigo";
    //AND c.idcompra = '$idcompra'";
    $carac1 = dibujarTablaOfSQLNormal($sqlCar1, "STOCK");
    $html .= $carac1['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function reporteProductoVendido( $return)
{
    $html = "";


    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>PRODUCTO <BR> VENDIDO";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
    $html .= "</table>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar1 = "SELECT
  COUNT(prod.nombre) AS numero,
  prod.codigo,
  prod.nombre AS producto,
  ven.fecha,
  CONCAT(usr.nombre, ' ', usr.apellido1, ' ', usr.apellido2) AS nombre,
  CONCAT(cli.nombre, ' ', cli.apellido1, ' ', cli.apellido2) AS cliente
FROM
  productos prod,
  ventas ven,
  itemventa itv,
  usuario usr,
  cliente cli
WHERE
  ven.idventa = itv.idventa AND
  itv.idproducto = prod.idproducto AND
  ven.cajero = usr.idusuario AND
  ven.idcliente = cli.idcliente
GROUP BY
  prod.codigo,
  prod.nombre,
  ven.fecha,
  CONCAT(usr.nombre, ' ', usr.apellido1, ' ', usr.apellido2),
  CONCAT(cli.nombre, ' ', cli.apellido1, ' ', cli.apellido2)
ORDER BY
  numero DESC
";
    //AND c.idcompra = '$idcompra'";
    $carac1 = dibujarTablaOfSQLNormal($sqlCar1, "PRODUCTOS VENDIDOS");
    $html .= $carac1['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function reporteGeneralModelo( $return)
{
    $html = "";


    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>MODELOS";
    $html .= "<br>";
    $html .= "fecha >";
    $html .= Date("Y-m-d");
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
    $html .= "</table>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    //    $sqlCar = "SELECT c.codigo, c.fecha, c.hora, c.montototal, c.descuento
    //                FROM compra c ORDER BY `c`.`idcompra` ASC";
    //    $carac = dibujarTablaOfSQLNormal($sqlCar, "COMPRAS");
    //    $html .= $carac['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar1 = "
       SELECT
  md.codigo,
  md.linea,
  md.color,
  md.material,
  md.imagen,
  md.cantidad,
  col.colecion,
  mar.nombre
FROM
  modelos md,
  marcas mar,
  `coleccion` col
WHERE
  md.idmarca = mar.idmarca AND
  md.idcoleccion = col.idcoleccion";
    //AND c.idcompra = '$idcompra'";
    $carac1 = dibujarTablaOfSQLNormal($sqlCar1, "MODELOS");
    $html .= $carac1['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}

function reporteKardex($idproducto,$idalmacen, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";

    $html .= "REPORTE <br>KARDEX";
    $html .= "</td>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT p.codigo AS Codigo, p.codigofrabrica AS CodFab, p.nombre AS Nombre, p.detalle AS Descripcion ,
  p.stockminimo AS StockMinimo, k.precio1bs AS PrecioBS, k.precio1sus AS PrecioSUS, c.nombre AS Categoria,
  k.precio2bs AS PrecioMinimo, k.fechamodificacion AS FechaReg, pv.nombre AS Proveedor, p.unidad AS Unidad
FROM productos p, kardex k, categorias c, proveedores pv
WHERE p.idproveedor = pv.idproveedor AND p.idcategoria = c.idcategoria AND p.idproducto =k.idproducto AND p.idkardex=k.idkardex AND p.idproducto = '$idproducto'";
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del producto");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    $sqlCar = "SELECT pv.nombre, pv.representante FROM productos p,proveedores pv WHERE  p.idproveedor = pv.idproveedor AND p.idproducto = '$idproducto'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Proveedor");
    $html .= $carac['resultado'];
    $html .="<br>";
    $sqlKar = "SELECT k.saldocantidad AS Cantidad, k.costounitario AS Costo, k.fechamodificacion AS Fecha FROM kardex k WHERE k.idproducto = '$idproducto'";
    $kardex = dibujarTuplaOfSQLNormal($sqlKar, "Kardex");
    $html .= $kardex['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";
    $sqlid= "SELECT
  alm.idalmacen
FROM
  almacenes alm
WHERE
  alm.idalmacen = '$idalmacen'";

    //    $result = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
    //    $tipocliente = $result['resultado'];

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "idalmacen");
    $almacenid= $res['resultado'];
    //echo $almacenid;
    //    if($tipocliente == "Regular" || $tipocliente == "Exclusivo")
    //    {
    //echo "regular";
    if($almacenid=="alm-1000")
    {
        //echo "es el almacen".$almacenid;
        $sqlInv="
               SELECT
          CONCAT(mok.fecha, mok.hora) AS fecha,
          mok.descripcion,
          mok.entrada,
          mok.salida,
          mok.saldo,
          mok.preciounitario,
          mok.ingreso,
          mok.egreso,
          mok.saldobs as saldo
        FROM
          movimientokardex mok
        WHERE
          mok.idproducto = '$idproducto'
        ";
        $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
        $html .= $inventario['resultado'];
    }
    else
    {
        // echo "no es el mismo";
        $sqlInv="
               SELECT
          CONCAT(mkal.fecha, mkal.hora) AS fecha,
          mkal.descripcion AS detalle,
          mkal.entrada,
          mkal.salida,
          mkal.saldo,
          mkal.costounitario,
          mkal.ingreso,
          mkal.egreso,
          mkal.saldobs as saldo
        FROM
          movimientokardexalmacen mkal
        WHERE
          mkal.idproducto = '$idproducto'
        ";
        $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
        $html .= $inventario['resultado'];

    }


    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function reporteVentaDiaria($idalmacen,$return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE <br>VENTAS DIARIAS  ";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";
    // echo $idalmacen;
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT a.idalmacen,c.nombre AS comunidad,a.nombre,a.direccion,a.telefono,a.estado,a.tipo
FROM almacenes a, comunidades c
WHERE a.idcomunidad=c.idcomunidad AND a.idalmacen = '$idalmacen'";
    //MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del Almacen");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $sqlid= "SELECT
  alm.idalmacen
FROM
  almacenes alm
WHERE
  alm.idalmacen = '$idalmacen'";

    //    $result = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
    //    $tipocliente = $result['resultado'];

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "idalmacen");
    $almacenid= $res['resultado'];
    //echo $almacenid;
    //echo $idalmacen;

    if($almacenid=="alm-1000")
    {
        $fecha1 = date("Y-m-d");
        //  echo "es el almacen".$almacenid;
        //         echo $fecha1;
        $sqlInv ="
               SELECT
                  prod.codigo,
                  prod.nombre as producto,
                  prod.idproveedor as proveedor,
                  mkd.fecha,
                  mkd.salida,
                  mkd.egreso AS ingreso

                FROM
                  productos prod,
                  movimientokardex mkd
                WHERE
                  mkd.idproducto = prod.idproducto AND
                  mkd.salida NOT LIKE '0' and
                  date(mkd.fecha) BETWEEN '$fecha1' AND '$fecha1'
                        ";
        //        MostrarConsulta($sqlInv);
        $inventario = dibujarTablaOfSQLNormal($sqlInv, "VENTAS");
        $html .= $inventario['resultado'];
    }
    else
    {
        //        echo "no es el mismo";
        $fecha2 = date("Y-m-d");
        $sqlInv="
               SELECT
                  prod.codigo,
                  prod.nombre as producto,
                  prod.idproveedor as proveedor,
                  mkda.fecha,
                  mkda.salida,
                  mkda.egreso AS ingreso

                FROM
                  productos prod,
                  movimientokardexalmacen mkda
                WHERE
                  mkda.idproducto = prod.idproducto AND
                  mkda.salida NOT LIKE '0' and
                  date(mkda.fecha) BETWEEN '$fecha2' AND '$fecha2'
        ";
        $inventario = dibujarTablaOfSQLNormal($sqlInv, "VENTAS");
        $html .= $inventario['resultado'];

    }


    $html .= "</td></tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }


}

function verventasferia($idalmacen,$return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE <br>VENTAS DIARIAS  ";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";
    // echo $idalmacen;
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT a.idalmacen,c.nombre AS comunidad,a.nombre,a.direccion,a.telefono,a.estado,a.tipo
FROM almacenes a, comunidades c
WHERE a.idcomunidad=c.idcomunidad AND a.idalmacen = '$idalmacen'";
    //MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del Almacen");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";

    $sqlid= "SELECT
  alm.idalmacen
FROM
  almacenes alm
WHERE
  alm.idalmacen = '$idalmacen'";

    //    $result = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
    //    $tipocliente = $result['resultado'];

    $res= findBySqlReturnCampoUnique($sqlid, true,true, "idalmacen");
    $almacenid= $res['resultado'];
    //echo $almacenid;
    //echo $idalmacen;

        $fecha1 = date("Y-m-d");
        //  echo "es el almacen".$almacenid;
        //         echo $fecha1;
        $sqlInv ="
               SELECT
m.codigo as modelo,ma.nombre as marca,v.boleta,v.cliente,v.fecha,v.totalpares as cantidad
                FROM
                 ventaferia v,modelo m,marcas ma
                WHERE
                 v.idmodelo=m.idmodelo and v.idmarca=ma.idmarca
                        ";
        //        MostrarConsulta($sqlInv);
        $inventario = dibujarTablaOfSQLNormal($sqlInv, "VENTAS");
        $html .= $inventario['resultado'];


    $html .= "</td></tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Novamoda SRL<br />
         Bolivia<br />

    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }


}


function generarCompra($idcompra, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";
    $sql = "SELECT
  c.idcompra,
  c.numero,
 c.idproveedor,
 c.fecha,
 c.idmoneda,
 c.montototal,
 c.montoapagar,
 c.observacion,
 c.descuento,
 c.tipo AS tipocompra,
 c.idtipodocumento,
  p.nombre AS nombreproveedor,
 --ciu.idciudad,
ciu.nombre AS ciudad,
 p.representante,
 ic.cantidad,
 ic.preciobs,
 ic.preciosus,
 ic.total

FROM
  compra c, proveedores p, items ic, ciudades ciu
WHERE
  c.idcompra = '$idcompra'

 AND ic.idcompra = c.idcompra
AND c.idproveedor = p.idproveedor";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta compra ...............";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la moneda */
        $totalMonto = $ven[0]['montototal'];
        //  $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['montoapagar'];
        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;
        //funcionnnnnn

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        //$totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "COMPRA<br>DE<br> PRODUCTOS";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numero']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Ciudad:</td><td>".$ven[0]['ciudad']."</td><td style='font-size:11px;font-weight:bold;'> ".$ven[0]['abreviacion']."</td><td>".$tc."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Representante:</td><td>".$ven[0]['representante']."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT p.codigo,  p.nombre,p.detalle,pv.nombre AS proveedor,c.nombre AS categoria ,ic.cantidad, ic.preciobs, ic.cantidad*ic.preciobs AS importe  FROM categorias c,items ic, productos p, proveedores pv WHERE p.idcategoria=c.idcategoria AND p.idproveedor=pv.idproveedor AND ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio :</td><td style='width:75px;text-align:right;'>".$ven[0]['montototal']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:11px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";
        //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Compra :</td><td style='width:75px;text-align:right;'>".$ven[0]['montoapagar']."</td></tr>";
        //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}


function reporteEntregaItemsHTML($identregacompra, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";
    $sql = "
SELECT
  com.montoapagar,
  com.numero,
  com.fecha,
  com.montocancelado,
  com.idcompra
FROM
  `compra` com,
  `entregacompra` ecp
WHERE
  com.idcompra = ecp.idcompra AND
  ecp.identregacompra = '$identregacompra'
";


    //    $sql = "SELECT
    //  c.idcompra,
    //  c.numero,
    // c.idproveedor,
    // c.fecha,
    // c.idmoneda,
    // c.montototal,
    // c.montoapagar,
    // c.observacion,
    // c.descuento,
    // c.tipo AS tipocompra,
    // c.idtipodocumento,
    //  p.nombre AS nombreproveedor,
    // ciu.idciudad,
    //ciu.nombre AS ciudad,
    // p.representante,
    // ic.cantidad,
    // ic.preciobs,
    // ic.preciosus,
    // ic.total
    //
    //FROM
    //  compra c, proveedores p, items ic, ciudades ciu
    //WHERE
    //  c.idcompra = '$idcompra'
    //
    // AND ic.idcompra = c.idcompra
    //AND c.idproveedor = p.idproveedor
    //AND p.idciudad = ciu.idciudad";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta compra ...............";
        exit;
    }
    else
    {
        $entrega = $datos["resultado"];
        /*aqui modificamos los campos segun la moneda */
        $totalMonto = $entrega[0]['montototal'];
        //  $totalCredito = $ven[0]['credito'];
        $totalDescuento = $entrega[0]['montocancelado'];
        $totalNeto = $entrega[0]['montoapagar'];

        $deuda = $entrega[0]['montoapagar']-$entrega[0]['montocancelado'];
        //echo $deuda;
        $tc = $entrega[0]['numero'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;
        //funcionnnnnn

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        //$totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //  $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "ENTREGA";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$entrega[0]['identregacompra']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$entrega[0]['numero']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>De la compra:</td><td>".$entrega[0]['idcompra']."</td><td style='font-size:11px;font-weight:bold;'> ".$entrega[0]['abreviacion']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Monto a Pagar:</td><td>".$entrega[0]['montoapagar']."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$entrega[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Monto Cancelado:</td><td>".$entrega[0]['montocancelado']."</td><td style='font-size:11px;font-weight:bold;'></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Deuda:</td><td>".$deuda."</td><td style='font-size:11px;font-weight:bold;'></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "
               SELECT DISTINCT
  prod.codigo,
  prov.nombre as proveedor,
  prod.detalle,
  enit.cantidad,
  enit.preciobs AS precio
FROM
  productos prod,
  proveedores prov,
  entregaitems enit
WHERE
  enit.idproducto = prod.idproducto AND
  prov.idproveedor = prod.idproveedor AND
  enit.identregacompra = '$identregacompra'     ";

        $sql2 = "

        SELECT DISTINCT
          SUM(enit.cantidad) AS cantidad,
          SUM(enit.preciobs) AS precio
        FROM
          entregaitems enit
        WHERE
          enit.identregacompra = '$identregacompra'
            ";
        $result = findBySqlReturnCampoUnique($sql2, true, true, "cantidad");
        $cantidad = $result['resultado'];
        $result = findBySqlReturnCampoUnique($sql2, true, true, "precio");
        $precio = $result['resultado'];

        //echo $cantidad;
        //echo $precio;

        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $entrega[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio :</td><td style='width:75px;text-align:right;'>".$precio."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>0</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Entrega (".$cantidad."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        // $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Compra :</td><td style='width:75px;text-align:right;'>".$entrega[0]['montoapagar']."</td></tr>";
        // $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
        $html .= "</table>";
        $htmls .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}




function compraconcuentaHTML($idcompra, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";
    $sql = "SELECT
  c.idcompra,
 c.idproveedor,
 c.fecha,
 c.idmoneda,
 c.montototal,
 c.montoapagar,
 c.observacion,
 c.descuento,
 c.tipo AS tipocompra,
 c.idtipodocumento,
  p.nombre AS nombreproveedor,
 ciu.idciudad,
ciu.nombre AS ciudad,
 p.representante,
 ic.cantidad,
 ic.preciobs,
 ic.preciosus,
 ic.total,
 tpv.saldo,
 cpr.codigo

FROM
  compra c, proveedores p, items ic, ciudades ciu, tipoproveedor tp, cuentaproveedor cpr, transaccionproveedor tpv
WHERE
  c.idcompra = '$idcompra'
  AND p.idtipoproveedor=tp.idtipoproveedor
 AND  p.idproveedor=cpr.idproveedor
  AND cpr.idcuentaproveedor=tpv.idcuentaproveedor
 AND ic.idcompra = c.idcompra
AND c.idproveedor = p.idproveedor
AND p.idciudad = ciu.idciudad";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta compra ...............";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la moneda */
        $totalMonto = $ven[0]['montototal'];
        //  $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['montoapagar'];
        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;
        //funcionnnnnn

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        //$totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        //$html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "COMPRA<br>DE<br> PRODUCTOS";
        //$html .= "</td>";
        //$html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        //$html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
        //$html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
        // $html .= "</table>";
        //$html .= "</td>";
        //$html .= "</tr>";
        //$html .= "<tr>";
        //        $html .= "<td colspan='3'>";
        //        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        //        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Proveedor:</td><td style='width:500px;' >".$ven[0]['nombreproveedor']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numero']."</td></tr>";
        //        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Ciudad:</td><td>".$ven[0]['ciudad']."</td><td style='font-size:11px;font-weight:bold;'>T/C (Bs/".$ven[0]['abreviacion'].")</td><td>".$tc."</td></tr>";
        //        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Representante:</td><td>".$ven[0]['representante']."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        //        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        //        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT p.codigo,  p.nombre, ic.cantidad, p.unidad AS unidad, ic.preciobs, ic.cantidad*ic.preciobs AS importe  FROM items ic, productos p WHERE ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total saldo (".$ven[0]['saldo']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Compra (".$ven[0]['total']."):</td><td style='width:75px;text-align:right;'></td></tr>";
        //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}

function reporteCompras( $return)
{
    //hoooooooooooooooooooooooo
    $html = "";


    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<BR> COMPRAS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idcompra']."<td><tr>";
    $html .= "</table>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar = "SELECT c.codigo, c.fecha, c.hora, c.montototal, c.descuento
                FROM compra c ORDER BY `c`.`idcompra` ASC";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "COMPRAS");
    $html .= $carac['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar1 = "SELECT i.idcompra, i.nombre AS nombre, pp.nombre AS Producto, p.nombre AS Proveedor, ci.nombre AS Ciudad, i.cantidad, i.total, i.preciobs
        FROM compra c, items i, proveedores p, ciudades ci, productos pp
        WHERE c.idproveedor = p.idproveedor
        AND i.idproducto = pp.idproducto
        AND i.idcompra = c.idcompra
        AND p.idciudad = ci.idciudad
        ORDER BY `i`.`idcompra` ASC";
    //AND c.idcompra = '$idcompra'";
    $carac1 = dibujarTablaOfSQLNormal($sqlCar1, "PRODUCTOS");
    $html .= $carac1['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }


}




function reporteEstadodeResultados($return)
{

    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$producto[0]['link']."'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "ESTADO <br>DE<br> RESULTADOS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql4 = " SELECT SUM( e.montoapagar ) AS VentasNetas
FROM venta e";
    $producto4 = dibujarTuplaOfSQLNormal($sql4, "Ventas Netas");
    $html .= $producto4['resultado'];
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql6 = " SELECT SUM(ic.total) AS InventarioInicial
FROM compra c,`items` ic
WHERE ic.idcompra=c.idcompra ";
    $producto6 = dibujarTuplaOfSQLNormal($sql6, "Inventario Inicial en Mercaderia");
    $html .= $producto6['resultado'];
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql5 = " SELECT SUM(ic.total) AS Compras
FROM compra c,`items` ic
WHERE ic.idcompra=c.idcompra ";
    $producto5 = dibujarTuplaOfSQLNormal($sql5, "Compras + Fletes");
    $datos5 = getTablaToArrayOfSQL($sql5);
    $ven5 = $datos5["resultado"];
    $comprastotal = $ven5[0]['Compras'];

    $html .= $producto5['resultado'];
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql7 = " SELECT SUM( mk.saldobs ) AS inventariofinal
FROM productos p, `movimientokardexalmacen` mk
WHERE p.idproducto = mk.idproducto
AND mk.fecha = (
SELECT MAX( mk.fecha )
FROM `movimientokardexalmacen` mk, productos p
WHERE p.idproducto = mk.idproducto ) ";
    $producto7 = dibujarTuplaOfSQLNormal($sql7, "Inventario Final de Mercaderia");
    $html .= $producto7['resultado'];
    $html .= "</tr>";
    $datos4 = getTablaToArrayOfSQL($sql4);
    $ven4 = $datos4["resultado"];
    $ventasnetas = $ven4[0]['VentasNetas'];

    $datos6 = getTablaToArrayOfSQL($sql6);
    $ven6 = $datos6["resultado"];
    $inventarioinicial = $ven6[0]['InventarioInicial'];
    $datos7 = getTablaToArrayOfSQL($sql7);
    $ven7 = $datos7["resultado"];
    $inventariofinal = $ven7[0]['inventariofinal'];


    $costoventas=($inventarioinicial + $comprastotal)-$inventariofinal;
    $html .= "<tr>";

    $html .= "<td style='text-align:left;'>Costo de Ventas</td>";
    $html .= "<td style='text-align:left;'>$costoventas</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $utilidadbruta=$ventasnetas- $costoventas;
    $html .= "<td style='text-align:left;'>Utilidad Bruta en Ventas</td>";
    $html .= "<td style='text-align:left;'>$utilidadbruta</td>";
    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $sql = " SELECT ce.nombre, SUM( ie.total ) AS total
FROM egreso e, itemegreso ie, cuentaegreso ce
WHERE ie.idegreso = e.idegreso
AND ie.idcuentaegreso = ce.idcuentaegreso
GROUP BY ce.idcuentaegreso";
    $producto = dibujarTablaOfSQLNormal($sql, "GASTOS DE OPERACION");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql2 = " SELECT SUM( e.montototal ) AS totalGastos
FROM egreso e
";
    $producto2 = dibujarTuplaOfSQLSimple($sql2);
    $html .= $producto2['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $datosc = getTablaToArrayOfSQL($sql2);
    $venc = $datosc["resultado"];
    $totalgastos = $venc[0]['totalGastos'];
    $html .= "<tr>";
    $html .= "<td style='text-align:left;'>Total Gastos de Operacion</td>";
    $html .= "<td style='text-align:left;'>$totalgastos</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $utilidadoperacion= $utilidadbruta-$totalgastos;
    $html .= "<td style='text-align:left;'>Utilidad de Operacion</td>";
    $html .= "<td style='text-align:left;'>$utilidadoperacion</td>";
    $html .= "</tr>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "<table>";
    $html .= "<tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $sql = " SELECT p.codigo, p.nombre, mk.saldo, mk.saldobs, mk.fecha
FROM `productos` p, `movimientokardexalmacen` mk
WHERE p.idproducto = mk.idproducto
AND mk.fecha = (
SELECT MAX( mk.fecha )
FROM `movimientokardexalmacen` mk, `productos` p
WHERE p.idproducto = mk.idproducto ) ";
    $producto = dibujarTablaOfSQLNormal($sql, "DETALLE DE INVENTARIO FINAL");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}




function reporteEntregaHTML($idventamayor, $return)
{
 $idtienda = $_SESSION['idtienda'];
     // echo "codigo".$idventadetalle;
    $html = "";
$sql1 = "
      SELECT
ved.idventamayor,ved.boleta,mar.nombre AS marca,ved.idcliente,cli.nombre AS cliente,cre.fecha AS fechaventa,cre.fechamoroso,
 ved.totalprecio,ved.totalcajas,ved.totalpares,ved.observacion
FROM
   `ventamayor` ved,`marcas` mar, clientes cli,creditomayor cre
WHERE
   ved.idalmacen=mar.idmarca AND ved.idcliente=cli.idcliente AND ved.idventamayor=cre.idventamayor AND ved.idventamayor = '$idventamayor' ";


//    $sql1 = " SELECT ved.numero,ved.fecha, ved.observacion,ved.nit,ved.hora,CONCAT( ved.nombrecliente, '-', ved.apellidocliente ) AS cliente,ved.idclienteempresa,ved.tipoventa, ved.cantidad, ved.totalbs AS total, ved.descuento, ved.montocancelado,ved.montoapagar, ved.montocanceladosus
//FROM ventasdetalle ved
//WHERE ved.idventadetalle = '$idventadetalle' "
//    ;
//               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
     $numrecibo = $ven[0]['boleta'];
     $idclienteempresa=$ven[0]['idcliente'];

$sql2 ="
SELECT cli.idcliente, CONCAT(cli.codigo,'/',ciu.codigo) AS cliente FROM `clientes` cli, `ciudades` ciu
WHERE cli.idciudad = ciu.idciudad AND cli.idcliente= '$idclienteempresa'
";

  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'cliente');
    $clienteempresa = $idalmacenA['resultado'];

   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>";
 $html .= "CALZADOS BALDERRAMA CBBA<br>";
  $html .= "Dir. San Martin esq.  Uruguay N 0699<br>";
   $html .= "Tel 4504183  Fax 4128833<br>";
    $html .= "e-mail: calzaba@supernet.com.bo";
$html .= "</td>";
$html .= "<td style='width:100px;font-size:11px;font-weight:bold;'></td>";
//$html .= "<td align:'left'; style='width:10px;height:100px;border-bottom:0px solid #000000;text-align:left;font-size:20px;font-family:Tahoma;'>";
//    $html .= "NOTA   DE ENTREGA";
//   $html .= "</td>";
  $html .= "<td style='width:200px;'>";
  $html .= "NOTA   DE ENTREGA";
   $html .= "</td>";
  $html .= "</tr>";

  $html .= "<td style='width:200px;height:100px;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>";
    $html .= "<tr>";
    $html .= "<td>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;'></td><td style='width:75px;font-size:11px;font-weight:bold;'>Nro:</td><td style='width:75px;'>".$numrecibo."</td></tr>";
   //$cliente=$ven[0]['cliente'];
//$clienteempresa= $ven1[0]['clienteempresa'];
   if($ven[0]['nit']==NULL || $ven[0]['nit']==''){
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clienteempresa."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td>".$tc."</td></tr>";
   }

   $fecha1=$ven[0]['fechaventa'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<td></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
$html .= "<td style='font-size:11px;font-weight:bold;'>Por lo siguiente.....</td></tr>";
    $html .= "</table><br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sql2 ="
SELECT idventamayordetalle
FROM ventamayordetalle
WHERE idventamayor = '$idventamayor'
";

  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'idventamayordetalle');
    $idventamayordetalle = $idalmacenA['resultado'];
 $sqlIV = "
(SELECT
CONCAT(COALESCE(det.color,'C'), ' ', COALESCE(det.material,'M'),' ', COALESCE(det.stylename,'S'),' ',COALESCE(det.linea,'L')) AS detalle,
mo.codigo AS modelo, dtp.preciooficina AS PrecioSus,emp.codigo AS vendedor,
   dtp.cantidad,
    dtp.totalcajas AS Cajas,
  dtp.totalpares AS Pares,
  dtp.precioventa AS TotalSus,emp.codigo AS vendedor

FROM
  `ventamayordetalle` dtp,`empleados` emp,`modelos` mo,kardexalmacen kar,detallepedido det
WHERE
  det.idkardexalmacen = dtp.idkardexalmacen AND dtp.idempleado= emp.idempleado AND dtp.idkardexalmacen=kar.idkardexalmacen AND
kar.idmodelo=mo.idmodelo AND dtp.idempleado=emp.idempleado AND dtp.idventamayor = '$idventamayor')


";
   // $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
    //$html .= $inventario['resultado'];

     $sqlV = " SELECT
                                dtpt.talla,
                                dtpt.cantidad
                                FROM
                               `detalleventamayortalla` dtpt
                                WHERE
                                dtpt.idventamayordetalle = '$idventamayordetalle'
                                ";

    //         $totalDescuento = $ven[0]['descuento'];
    $table =
      // MostrarConsulta($sqlIV);
     // dibujarTablaOfSQLNormal

        $table = dibujarTablaOfSQLNormal($sqlIV, "Detalle de Entrega");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "<tr>";
    $html .= "<td colspan='3'>";
     $sqlV = " SELECT
                                dtpt.talla,
                                dtpt.cantidad
                                FROM
                               `detalleventamayortalla` dtpt
                                WHERE
                                dtpt.idventamayordetalle = '$idventamayordetalle'
                                ";
    echo $idventamayor;
 $table1 =
           $table1 = dibujarTablaOfSQL($sqlV, "Tallas");
         //  $table1 =  dibujarTuplaOfSQLNormal($sqlV, $titulo = "ninguno");

    $html .= $table1['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'><br>";
  //  $html .= "<td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($ven[0]['total'], $ven[0]['abreviacion'])."</td>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:11px;font-weight:bold;'> Descuento:</td><td style='width:75px;text-align:right;'>".$ven1[0]['descuento']."</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta :</td><td style='width:75px;text-align:right;'>".$montoapagar."</td></tr>";
    //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
 $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cantidad:</td><td>".$ven[0]['cantidad']."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td>".$tc."</td></tr>";
    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Monto Total Bs:</td><td>".$ven[0]['total']."</td></tr>";
    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Descuento:</td><td>".$ven[0]['descuento']."</td></tr>";
    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Monto Cancelado Bs:</td><td>".$ven[0]['montocancelado']."</td></tr>";
 $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";
        $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$ven[0]['montoapagar']."</td></tr>";

   // $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente.....</td>";
    $html .= "</table><br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}



function reporteEntrega($identrega, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";

    $sql1="SELECT
*
FROM
  ventamayor ent,

WHERE
  ent.idventamayor= '$identrega'
";
    $dato = getTablaToArrayOfSQL($sql1);
    $ven1 = $dato["resultado"];
    if($dato['error'] == "false")
    {
        echo "No existe esta entrega ...............";
        exit;
    }
    $identreg = $ven1[0]['identrega'];
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>ENTREGA";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$identreg."<td><tr>";
    $html .= "</table>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar = "SELECT
  ent.idventa AS venta,
  ent.fecha,
  CONCAT(cli.nombre ,' ',
  cli.apellido1,' ',
  cli.apellido2) as cliente,
  ent.montocancelado AS cancelado,
  alm.nombre AS almacen


FROM
  entregas ent,
  almacenes alm,
  cliente cli,
  ventas ven
WHERE
  ent.idalmacen = alm.idalmacen AND
  ent.identrega = '$identrega' AND
  ent.idventa = ven.idventa AND
  ven.idcliente = cli.idcliente
                ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "ENTREGAS");
    $html .= $carac['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlCar1 = "SELECT
                  prod.nombre,
                  ive.cantidad,
                  ent.fecha,
                  ent.responsable,
                  alm.nombre AS almacen
                FROM
                  productos prod,
                  itementregaventa ive,
                  entregas ent,
                  almacenes alm
                WHERE
                  ent.identrega = '$identrega' AND
                  ent.idventa = ive.idventa AND
                  ive.idproducto = prod.idproducto AND
                  ent.idalmacen = alm.idalmacen
                ";
    //AND c.idcompra = '$idcompra'";
    $carac1 = dibujarTablaOfSQLNormal($sqlCar1, "PRODUCTOS");
    $html .= $carac1['resultado'];
    $html .="<HR>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
    </div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }


}



function reporteProveedor($idproveedor, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";

    $html .= "REPORTE <br>DE<br> PROVEEDOR";
    $html .= "</td>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT
              prov.codigo,
              prov.nombre,
              prov.telefono,
              prov.representante,
              prov.ciudad,
              prov.pais,
              prov.direccion
            FROM
              proveedores prov
            WHERE
              prov.idproveedor = '$idproveedor'
";
    //    dibujarTablaOfSQLNormal
    $producto = dibujarTablaOfSQLNormal($sql, "Informacion del proveedor");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    //    $sqlCar = "SELECT pv.nombre, pv.representante FROM productos p,proveedores pv WHERE  p.idproveedor = pv.idproveedor AND p.idproducto = '$idproducto'";
    //    $carac = dibujarTablaOfSQLNormal($sqlCar, "Proveedor");
    //    $html .= $carac['resultado'];
    $html .="<br>";
    //    $sqlKar = "SELECT
    //  tp.fecha,
    //  tp.hora,
    //  tp.deposito,
    //  tp.retiro,
    //  tp.saldo
    //FROM
    //  transaccionproveedor tp,
    //  proveedores pv
    //WHERE
    //  tp.idproveedor = pv.idproveedor AND
    //  tp.idproveedor = '$idproveedor'";
    //    $kardex = dibujarTuplaOfSQLNormal($sqlKar, "Movimiento del proveedor");
    //    $html .= $kardex['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='3'>";
    $sqlInv = "
SELECT
  tp.fecha,
  tp.hora,
  tp.deposito,
  tp.retiro,
  tp.saldo
FROM
  transaccionproveedor tp,
  proveedores pv
WHERE
  tp.idproveedor = pv.idproveedor AND
  tp.idproveedor = '$idproveedor'
";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Movimiento del proveedor");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";


    $html .= "<tr><td colspan='3'>";
    $sqlInv = "
SELECT
  prod.nombre,
  prod.codigo,
  prod.codigobarra
FROM
  `productos` prod,
  `proveedores` prov
WHERE
  prov.idproveedor = prod.idproveedor AND
  prov.idproveedor = '$idproveedor'
";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Compras del proveedor ");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }


}

function bolatadePago($idempleado,$retuen)
{
    //echo "esta em el metodo";
    $idemp = $idempleado;
    //   $idultimosueldo = findUltimoID("sueldo","numero",true);
    ////    $idultimosueldo = findUltimoID("sueldo", "numero", true);
    //    $numeroSueldo = $idultimosueldo['resultado']+1;
    //    ////    echo $idultimoempleadoA['resultado'];
    //    $fecha = date("Y-m-d");
    //    $usuario = $_SESSION['login'];
    //    $idsueldo = "sue-".$numeroSueldo;
    //
    //    $sql = "
    //SELECT
    //  SUM(ant.monto) AS anticipos,
    //  sue.sueldo
    //FROM
    //  anticipo ant,
    //  empleado sue
    //WHERE
    //
    //  sue.idempleado = '$idempleado'
    //  and ant.idmes = '$val'
    //GROUP BY
    //  sue.sueldo
    //";
    //
    //           // MostrarConsulta($sql);
    //
    //    $entrega = getTablaToArrayOfSQL($sql);
    //
    //    $restante = $entrega[0]['sueldo'] - $entrega[0]['anticipos'];
    //    getSqlNewSueldo($idsueldo, $idemp, $numeroSueldo, $sueldo, $fecha, $usuario, $return);
    reporteBoletaEmpleadoHTML($idemp, $return);
}

function getSqlNewSueldo($idsueldo, $idempleado, $numero, $sueldo, $fecha, $usuario, $return){
    $setC[0]['campo'] = 'idsueldo';
    $setC[0]['dato'] = $idsueldo;
    $setC[1]['campo'] = 'idempleado';
    $setC[1]['dato'] = $idempleado;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'sueldo';
    $setC[3]['dato'] = $sueldo;
    $setC[4]['campo'] = 'fecha';
    $setC[4]['dato'] = $fecha;
    $setC[5]['campo'] = 'usuario';
    $setC[5]['dato'] = $usuario;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO sueldo ".$sql2;
}

function reporteEmpleadoHTML($idempleado, $return)
{

    $val = Date("m");


    $sql = "
SELECT
  SUM(ant.monto) AS anticipos,
  sue.sueldo
FROM
  anticipo ant,
  empleado sue
WHERE

  sue.idempleado = '$idempleado'
  and ant.idmes = '$val'
GROUP BY
  sue.sueldo
";

    //        MostrarConsulta($sql);

    $datos = getTablaToArrayOfSQL($sql);
    //            echo $datos['error'];
    if($datos['error'] == "false")
    {
        $sql3 = "
SELECT

  sue.sueldo
FROM

  empleado sue
WHERE
  sue.idempleado = '$idempleado'
GROUP BY
  sue.sueldo
";
        //        MostrarConsulta($sql3);
        $datoss = getTablaToArrayOfSQL($sql3);
        $entrega = $datoss["resultado"];
        //                 $totalAnticipos = $entrega[0]['anticipos'];

        $sueldo = $entrega[0]['sueldo'];

        $restante = $entrega[0]['sueldo'] - 0;
        //
        $tc = $entrega[0]['numero'];


        $html = "";
        $fecha = Date("Y-m-d");
        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "<h2>ANTICIPO <BR> EMPLEADO</h2><br>";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idproforma']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>$fecha </td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Sueldo...</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "

SELECT
  emp.nombre,
  emp.apellidos,
  emp.sueldo,
  usr.nombre AS usuario,
  CONCAT(mes.mes, '-', anio.anio) AS gestion
FROM
  empleado emp,

  usuario usr,
  anio,
  gestion_mes ges,
  mes
WHERE

  emp.idempleado = '$idempleado' AND
  anio.idanio = ges.idanio AND
  mes.idmes = ges.idmes and ges.idmes = '$val'
";
        //        MostrarConsulta($sqlIV);
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:450px;'></td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Anticipos ():</td><td style='width:75px;text-align:right;'>0</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>Proforma Valida Con Sello y Firma.</td><td style='font-size:11px;font-weight:bold;'>Sueldo ():</td><td style='width:75px;text-align:right;'>".$sueldo."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$_SESSION['login']."</td><td style='font-size:11px;font-weight:bold;'>Saldo a Pagar ():</td><td style='width:75px;text-align:right;'>".$restante."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }
    else
    {
        $entrega = $datos["resultado"];
        /*aqui modificamos los campos segun la moneda */
        $totalAnticipos = $entrega[0]['anticipos'];
        //  $totalCredito = $ven[0]['credito'];
        $sueldo = $entrega[0]['sueldo'];
        $restante = $entrega[0]['sueldo'] - $entrega[0]['anticipos'];
        $tc = $entrega[0]['numero'];


        $html = "";
        $fecha = Date("Y-m-d");
        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "<h2>ANTICIPO <BR> EMPLEADO</h2><br>";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idproforma']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>$fecha </td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Anticipos...</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "

SELECT
  emp.nombre,
  emp.apellidos,
  ant.monto AS anticipo,
  ant.fecha,
  usr.nombre AS usuario,
  CONCAT(mes.mes,'-',
  anio.anio) as gestion
FROM
  empleado emp,

  anticipo ant,
  usuario usr,
  `anio` anio,
  `gestion_mes` ges,
  `mes` mes
WHERE


  emp.idempleado = '$idempleado' AND
  ant.usuario = usr.idusuario AND
  anio.idanio = ges.idanio AND
  mes.idmes = ges.idmes AND
  ant.idmes = ges.idmes AND
  ant.idanio = ges.idanio
and ant.idmes = '$val'
";
        //        MostrarConsulta($sqlIV);
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:450px;'></td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Anticipos ():</td><td style='width:75px;text-align:right;'>".$totalAnticipos."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>Proforma Valida Con Sello y Firma.</td><td style='font-size:11px;font-weight:bold;'>Sueldo ():</td><td style='width:75px;text-align:right;'>".$sueldo."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$_SESSION['login']."</td><td style='font-size:11px;font-weight:bold;'>Saldo a Pagar ():</td><td style='width:75px;text-align:right;'>".$restante."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}

//============================================

function reporteBoletaEmpleadoHTML($idempleado, $return)
{

    $hoy = Date("m");
    //    echo $hoy;
    $hoys = $hoy - 1;
    //    echo $hoys;
    if ($hoys <= 9)
    {
        $val = "0".$hoys;
    }
    else{
        $val = $hoys;
    }
    //  echo $val;
    $sql = "
SELECT
  SUM(ant.monto) AS anticipos,
  sue.sueldo
FROM
  anticipo ant,
  empleado sue
WHERE

  sue.idempleado = '$idempleado' AND ant.idempleado = '$idempleado' and
  ant.idmes = '$val'
GROUP BY
  sue.sueldo
";

    //MostrarConsulta($sql);

    $datos = getTablaToArrayOfSQL($sql);
    //            echo $datos['error'];
    if($datos['error'] == "false")
    {

        //    echo "entro cumpliendo";

        $sql3 = "
                SELECT

                  sue.sueldo
                FROM

                  empleado sue
                WHERE
                  sue.idempleado = '$idempleado'
                GROUP BY
                  sue.sueldo
                ";
        //        MostrarConsulta($sql3);
        $datoss = getTablaToArrayOfSQL($sql3);
        $entrega = $datoss["resultado"];
        //         $totalAnticipos = $entrega[0]['anticipos'];

        $sueldo = $entrega[0]['sueldo'];

        $restante = $entrega[0]['sueldo'] - 0;

        $tc = $entrega[0]['numero'];

        $numeroA = findUltimoID("gestion_mes", "numero", true);

        $numero = $numeroA['resultado'];
        $numeroB = $numero - 1;
        //echo $numeroB;
        if($numeroB ==0)
        {
            //echo "entro";
            $html = "";
            $fecha = Date("Y-m-d");
            $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
            $html .= "<html>";
            $html .= "<head>";
            $html .= "<title></title>";
            $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
            $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
            //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
            $html .= "</head>";
            $html .= "<body>";
            $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
            $html .= "<tr>";
            //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
            $html .= "</td>";
            $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
            $html .= "<h2>BOLETAS <BR> EMPLEADO</h2><br>";
            $html .= "</td>";
            $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
            $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
            $html .= "<tr><td align='right'><td><tr>";
            $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idproforma']."<td><tr>";
            $html .= "</table>";
            $html .= "</td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td colspan='3'>";
            $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
            $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'></td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>$fecha </td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Sueldo...</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
            $html .= "</table>";
            $html .= "</td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td colspan='3'>";
            $sqlIV = "

            SELECT
              emp.nombre,
              emp.apellidos,
              emp.sueldo,
              usr.nombre AS usuario,
              CONCAT(mes.mes, '-', anio.anio) AS gestion,
              emp.idalmacen
            FROM
              empleado emp,

              usuario usr,
              anio,
              mes,
              gestion_mes ges
            WHERE
              emp.idempleado = '$idempleado' AND

              ges.idmes = mes.idmes AND
              ges.idanio = anio.idanio AND
              ges.idmes = '$val'
            ";
            //                    MostrarConsulta($sqlIV);
            $table = dibujarTablaOfSQL($sqlIV, $tc);
            $html .= $table['resultado'];
            $html .= "</td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td colspan='3'>";
            $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
            $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:450px;'></td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Anticipos ():</td><td style='width:75px;text-align:right;'>0</td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>Proforma Valida Con Sello y Firma.</td><td style='font-size:11px;font-weight:bold;'>Sueldo ():</td><td style='width:75px;text-align:right;'>".$sueldo."</td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$_SESSION['login']."</td><td style='font-size:11px;font-weight:bold;'>Saldo a Pagar ():</td><td style='width:75px;text-align:right;'>".$restante."</td></tr>";
            $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
            $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
                <p>Importadora Asia<br />
                     Cochabamba - Bolivia<br />
                     Telf. 4555651
                </p>
            </div></td></tr>";
            $html .= "</table>";
            $html .= "</td>";
            $html .= "</tr>";
            $html .= "</table>";
            $html .= "</body>";
            $html .= "</html>";
            if($return == true)
            {
                return $html;
            }
            else
            {
                echo $html;
            }
        }
        echo "no se puede generar reporte del mes anterior";
    }
    else
    {
        if($datos['error'] != "false")
        {

            //                echo "hola";
            $entrega = $datos["resultado"];
        /*aqui modificamos los campos segun la moneda */
            $totalAnticipos = $entrega[0]['anticipos'];
            //  $totalCredito = $ven[0]['credito'];
            $sueldo = $entrega[0]['sueldo'];
            $restante = $entrega[0]['sueldo'] - $entrega[0]['anticipos'];
            $tc = $entrega[0]['numero'];


            $numeroA = findUltimoID("gestion_mes", "numero", true);
            $numero = $numeroA['resultado'];
            $numeroB = $numero - 1;
            if($numeroB !=0)
            {
                $html = "";
                $fecha = Date("Y-m-d");
                $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
                $html .= "<html>";
                $html .= "<head>";
                $html .= "<title></title>";
                $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
                $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
                //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
                $html .= "</head>";
                $html .= "<body>";
                $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
                $html .= "<tr>";
                //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
                $html .= "</td>";
                $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
                $html .= "<h2>BOLETA <BR> EMPLEADO</h2><br>";
                $html .= "</td>";
                $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
                $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
                $html .= "<tr><td align='right'><td><tr>";
                $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idproforma']."<td><tr>";
                $html .= "</table>";
                $html .= "</td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td colspan='3'>";
                $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
                $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'></td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>$fecha </td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Sueldo...</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
                $html .= "</table>";
                $html .= "</td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td colspan='3'>";
                $sqlIV = "

            SELECT
              emp.nombre,
              emp.apellidos,
              emp.sueldo,
              usr.nombre AS usuario,
              CONCAT(mes.mes, '-', anio.anio) AS gestion,
              emp.idalmacen,
              ant.monto,
              ant.fecha
            FROM
              empleado emp,

              usuario usr,
              anio,
              mes,
              gestion_mes ges,
              `anticipo` ant
            WHERE
              emp.idempleado = '$idempleado' AND

              ges.idmes = mes.idmes AND
              ges.idanio = anio.idanio AND

              ant.idmes = ges.idmes AND
              ant.idanio = ges.idanio and
              ges.idmes = '$val'
            ";
                //                    MostrarConsulta($sqlIV);
                $table = dibujarTablaOfSQL($sqlIV, $tc);
                $html .= $table['resultado'];
                $html .= "</td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td colspan='3'>";
                $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
                $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:450px;'></td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Anticipos ():</td><td style='width:75px;text-align:right;'>$totalAnticipos</td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>Proforma Valida Con Sello y Firma.</td><td style='font-size:11px;font-weight:bold;'>Sueldo ():</td><td style='width:75px;text-align:right;'>".$sueldo."</td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$_SESSION['login']."</td><td style='font-size:11px;font-weight:bold;'>Saldo a Pagar ():</td><td style='width:75px;text-align:right;'>".$restante."</td></tr>";
                $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
                $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
                <p>Importadora Asia<br />
                     Cochabamba - Bolivia<br />
                     Telf. 4555651
                </p>
            </div></td></tr>";
                $html .= "</table>";
                $html .= "</td>";
                $html .= "</tr>";
                $html .= "</table>";
                $html .= "</body>";
                $html .= "</html>";
                if($return == true)
                {
                    return $html;
                }
                else
                {
                    echo $html;
                }
            }

        }

    }


}

function verboletaventacompleta($idventadetalle, $return)
{
   $idtienda = $_SESSION['idtienda'];
   $html = "";
   $sql1 = " SELECT * FROM ventas WHERE idventa = '$idventadetalle' "  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
 $idalmacen=$ven[0]['idalmacen'];
 $idcliente=$ven[0]['idcliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['boleta'];
 $totalbs=$ven[0]['totalbs'];
 $totalcajas=$ven[0]['tcajas'];
 $totalsus=$ven[0]['totalsus'];
 $descuentopor=$ven[0]['descporcentaje'];
 $descuento=$ven[0]['descuento'];
 $totalNeto=$ven[0]['montoapagar'];

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];
 if($idmarca=="mar-32"){
   $sql3 = "SELECT idmodelo FROM ventaitem WHERE idventa = '$idventadetalle' group by idventa";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelo = $idalmacenA2['resultado'];

      $sql3 = "SELECT m.idmodelo FROM modelo m,ingresoalmacen i WHERE m.idmodelo = '$idmodelo' and m.idingreso=i.idingreso and i.fecha>='2014-12-11'";
   $idalmacenA21 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelos = $idalmacenA21['resultado'];

        if($idmodelos!=''  ){
                  $tipo="2";
          $idgrupo = $idgrupo;
                         }else{
                         //con cambio en las presentaciones
                          $idgrupo = "1";

           $tipo="3";
        $rango1="33";
$rango2="45";

         }

}else{
    $idgrupo = $idgrupo;
    $rango1=$rango1;
$rango2=$rango2;
          if($opcionmarca="33-45"){
        $tipo="1";
        }else{
        if($opcionmarca="14-38"){
        $tipo="3";
        }else{
        if($opcionmarca="47-70"){
        $tipo="2";
        }else{
        $tipo="1";
        }
        }
        }
}


 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipoalm = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipoalm</td></tr>";
   $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";

    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
//echo $rango1;
$select = "vi.idmodelo";
$from = "ventaitem vi";
$where = "idventa='$idventadetalle' Group by vi.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
    $producto = dibujarTablaitemventacompleto($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);

    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";
// $select1 = "SUM(vi.cantidad*vi.precioventa)AS pares";
  $select1 = "SUM(vi.cantidad*vi.montoventafinal)AS pares";
 $from1 = " modelo mdd,ventaitem vi";
   $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventadetalle' ";
$sql2p1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.idventa";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $totalNeto = $almacenA1['resultado'];
   // echo $sql2p1;
  $totalNeto = round($totalNeto,2);
//$totalNeto =$totalNeto.".00";
  //$totalNeto

 if($descuentopor=='0'){

  $html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
}else{
  $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Descuento %:</td><td style='width:75px;text-align:right;'>".$ven[0]['descporcentaje']."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
   }

$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function verboletaventa($idventadetalle, $return)
{
    $idtienda = $_SESSION['idtienda'];
    $html = "";
    $sql1 = " SELECT * FROM ventas WHERE idventa = '$idventadetalle' "  ;
               //MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
    $idalmacen=$ven[0]['idalmacen'];
    $idcliente=$ven[0]['idcliente'];
    $idvendedor=$ven[0]['idvendedor'];
    $idmarca=$ven[0]['idmarca'];
    $fechaventa=$ven[0]['fecha'];
    $boleta=$ven[0]['boleta'];
    $totalbs=$ven[0]['totalbs'];
    $totalcajas=$ven[0]['tcajas'];
    $totalsus=$ven[0]['totalsus'];
    $descuentopor=$ven[0]['descporcentaje'];
    $descuento=$ven[0]['descuento'];
    $totalNeto=$ven[0]['montoapagar'];

    $totalNeto = round($totalNeto);
    $totalNeto =$totalNeto.".00";
    $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
    $clientenombre = $idalmacenA['resultado'];
    $clientenombre=strtoupper($clientenombre);
    $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
    $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
    $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];
// if($idmarca=="mar-32"){
//   $sql3 = "SELECT idmodelo FROM ventaitem WHERE idventa = '$idventadetalle' group by idventa";
//   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
//   $idmodelo = $idalmacenA2['resultado'];
//
//      $sql3 = "SELECT m.idmodelo FROM modelo m,ingresoalmacen i WHERE m.idmodelo = '$idmodelo' and m.idingreso=i.idingreso and i.fecha>='2014-12-11'";
//   $idalmacenA21 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
//   $idmodelos = $idalmacenA21['resultado'];
//
//        if($idmodelos!=''  ){
//                  $tipo="2";
//          $idgrupo = $idgrupo;
//                         }else{
//                         //con cambio en las presentaciones
//                          $idgrupo = "1";
//
//           $tipo="3";
//        $rango1="33";
//$rango2="45";
//
//         }
//
//}else{
    $idgrupo = $idgrupo;
    $rango1=$rango1;
$rango2=$rango2;
          if($opcionmarca="33-45"){
        $tipo="1";
        }else{
        if($opcionmarca="14-38"){
        $tipo="3";
        }else{
        if($opcionmarca="47-70"){
        $tipo="2";
        }else{
        $tipo="1";
        }
        }
        }
//}


 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipoalm = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipoalm</td></tr>";
   $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";

    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
//echo $rango1;
$select = "vi.idmodelo";
$from = "ventaitem vi";
$where = "idventa='$idventadetalle' Group by vi.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
   
    $producto = dibujarTablaitemventa($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";

//  $select1 = "SUM(vi.cantidad*vi.montoventafinal)AS pares";
// $from1 = " modelo mdd,ventaitem vi";
//   $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventadetalle' ";
//$sql2p1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.idventa";
//   $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
//    $totalNeto = $almacenA1['resultado'];
   $sql3 = "SELECT SUM(precioventafinal) as total FROM ventafinalmodelo WHERE idventa = '$idventadetalle' ";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
   $totalNeto = $idalmacenA2['resultado'];
  $totalNeto = round($totalNeto,2);
//echo $sql3;
$observaciond =$ven[0]['observacion'];
 if($descuentopor=='0'){
     if($observaciond=='NORMAL'){
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
     }else{
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td style='background-image: url(img/fondocasilla.jpg);'><img src='img/fondocasilla.jpg'  width='100' height='25'>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
         }

}else{
     if($observaciond=='NORMAL'){
           $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Descuento %:</td><td style='width:75px;text-align:right;'>".$ven[0]['descporcentaje']."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";

   $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
     }else{
           $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Descuento %:</td><td style='width:75px;text-align:right;'>".$ven[0]['descporcentaje']."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";

   $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td style='background-image: url(img/fondocasilla.jpg);'><img src='img/fondocasilla.jpg' width='100' height='25'>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
     }

   }
$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:LEFT;'>ENTREGUE CONFORME</td><td style='font-size:12px;font-weight:bold;border-top:1px solid #000000;text-align:LEFT;'>V.B.</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:CENTER;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function ventasimpleHTML($idventadetalle, $return)
{
   $idtienda = $_SESSION['idtienda'];
   $html = "";
   $sql1 = " SELECT * FROM ventaferia WHERE idventa = '$idventadetalle' group by idventa"  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
 $idalmacen=$ven[0]['idalmacen'];
 $idcliente=$ven[0]['cliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['idventa'];

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
//  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($idcliente);
//  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
//  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
   //$vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($idvendedor);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

   $sql3 = "SELECT idmodelo FROM ventaitem WHERE idventa = '$idventadetalle' group by idventa";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelo = $idalmacenA2['resultado'];

      $sql3 = "SELECT m.idmodelo FROM modelo m,ingresoalmacen i WHERE m.idmodelo = '$idmodelo' and m.idingreso=i.idingreso and i.fecha>='2014-12-11'";
   $idalmacenA21 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelos = $idalmacenA21['resultado'];



 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipoalm = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipoalm</td></tr>";
   $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'></td></tr>";

    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
    }

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
//echo $rango1;
$select = "vi.idkardexunico";
$from = "ventaferia vi";
$where = "idventa='$idventadetalle' ";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
    $producto = dibujarTablaitemventaferia($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);
  //  $producto = dibujarTablaitemventa($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventadetalle,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";
// $select1 = "SUM(vi.cantidad*vi.precioventa)AS pares";
  $select1 = "SUM(vi.totalpares*vi.totalsus)AS pares";
 $from1 = " modelo mdd,ventaferia vi";
   $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventadetalle' ";
$sql2p1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.idventa";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $totalNeto = $almacenA1['resultado'];
   // echo $sql2p1;
  $totalNeto = round($totalNeto,2);
//$totalNeto =$totalNeto.".00";
  //$totalNeto dd
  // $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
  //background: C:\Users\Pedro\Desktop\webpageee;
 /// <td style="background-image:url('http://www.palimpalem.com/1/222/userfiles/ElPais.jpg');">celda 1</td>
 $observaciond =$ven[0]['observacion'];
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$totalNeto."</td></tr><br />";
   $html .= "</table>";
$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function verboletaventadevolucion($iddevolucion, $return)
{
   $idtienda = $_SESSION['idtienda'];
   $html = "";
  $sql2 = " SELECT * FROM devolucion WHERE iddevolucion = '$iddevolucion'  "  ;
     $dato = getTablaToArrayOfSQL($sql2);
    $ven1 = $dato["resultado"];
 $idalmacen=$ven1[0]['idalmacen'];
  $boletadev=$ven1[0]['estado'];
 $idcliente=$ven1[0]['idcliente'];
 $idvendedor=$ven1[0]['idvendedor'];
$idmarca=$ven1[0]['idmarca'];
 $fechaventa=$ven1[0]['fecha'];
 $boleta=$ven1[0]['boleta'];
 $totalbs=$ven1[0]['totalbs'];
 $totalcajas=$ven1[0]['tcajas'];
 $totalsus=$ven1[0]['totalsus'];
 $descuentopor=$ven1[0]['descporcentaje'];
 $descuento=$ven1[0]['descuento'];
 $totalNeto=$ven1[0]['montoapagar'];
  $observacion=$ven1[0]['observacion'];


$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

 if($idmarca=="mar-32"){

   $sql3 = "SELECT k.idmodelo from detalledevolucion d, kardexdetallepar k,devolucion dv where d.idkardexunico = k.idkardexunico and d.iddevolucion=dv.iddevolucion
AND dv.iddevolucion ='$iddevolucion' Group by k.idmodelo";
//$where = "d.idkardexunico = k.idkardexunico and d.iddevolucion=dv.iddevolucion
//AND dv.iddevolucion ='$iddevolucion' Group by k.idmodelo";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelo = $idalmacenA2['resultado'];
//echo $sql3;
      $sql3 = "SELECT m.idmodelo FROM modelo m,ingresoalmacen i WHERE m.idmodelo = '$idmodelo' and m.idingreso=i.idingreso and i.fecha>='2014-12-11'";
   $idalmacenA21 =  findBySqlReturnCampoUnique($sql3, true, true, 'idmodelo');
   $idmodelos = $idalmacenA21['resultado'];

        if($idmodelos!=''  ){
                  $tipo="2";
          $idgrupo = $idgrupo;
                         }else{
                         //con cambio en las presentaciones
                          $idgrupo = "1";

           $tipo="3";
        $rango1="33";
$rango2="45";

         }

}else{
    $idgrupo = $idgrupo;
    $rango1=$rango1;
$rango2=$rango2;
          if($opcionmarca="33-45"){
        $tipo="1";
        }else{
        if($opcionmarca="14-38"){
        $tipo="3";
        }else{
        if($opcionmarca="47-70"){
        $tipo="2";
        }else{
        $tipo="1";
        }
        }
        }
}

 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fechaventa);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
       $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";
       $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td></tr>";
       $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";

   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$boletadev."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca./DEVOLUCION</td></tr>";
    $html .= "</table>";
    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";

    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];

   $select = "k.idmodelo";
$from = "detalledevolucion d, kardexdetallepar k,devolucion dv";
$where = "d.idkardexunico = k.idkardexunico and d.iddevolucion=dv.iddevolucion
AND dv.iddevolucion ='$iddevolucion' Group by k.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
   //ojo
  // echo $sql25;
    $producto = dibujarTablaitemdevolucion($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$iddevolucion,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";


    $select1 = "SUM(d.idkardexunico*vi.precioventa)AS pares";
 $from1 = " modelo mdd,ventaitem vi,detalledevolucion d";
   $where1 = "d.iditemventa=vi.iditemventa and mdd.idmodelo = vi.idmodelo AND d.idventadetalle='$idventadetalle' ";
$sql2p1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.idventa";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $totalNeto = $almacenA1['resultado'];
   // echo $sql2p1;
  $totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";

$html .= "</br>";
  $html .= "</br>";

 if($observacion=='-'){
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
     $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$observacion."</td></tr><br />";
   $html .= "</table>";
     }else{
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td style='background-image: url(img/fondocasilla.jpg);'><img src='img/fondocasilla.jpg'  width='100' height='25'>".$observacion."</td></tr><br />";
   $html .= "</table>";
         }
$html .= "</br>";
  $html .= "</br>";
 $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:LEFT;'>ENTREGUE CONFORME</td><td style='font-size:12px;font-weight:bold;border-top:1px solid #000000;text-align:LEFT;'>V.B.</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:CENTER;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function verboletaventaanulacion($boleta, $return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
   $sql2 = " SELECT * FROM bitacoradeleteventa WHERE idalmacen = '$idalmacen' and dato='$boleta' "  ;
     $dato = getTablaToArrayOfSQL($sql2);
    $ven1 = $dato["resultado"];
// $idalmacen=$ven1[0]['idalmacen'];
 $idcliente=$ven1[0]['diferencia'];
 $idvendedor=$ven1[0]['usuario'];
//$idmarca=$ven1[0]['diferencia'];
 $fechaventa=$ven1[0]['fechadelete'];
// $boleta=$ven1[0]['boleta'];
// $totalbs=$ven1[0]['totalbs'];
// $totalcajas=$ven1[0]['tcajas'];
// $totalsus=$ven1[0]['totalsus'];
// $descuentopor=$ven1[0]['descporcentaje'];
// $descuento=$ven1[0]['descuento'];
// $totalNeto=$ven1[0]['montoapagar'];
//

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);

$sqld = "SELECT mo.idmarca FROM  bitacoradeleteventa v, modelo mo WHERE v.idmodelo = mo.idmodelo and v.idalmacen = '$idalmacen' and v.dato='$boleta' group by v.dato";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sqld, true, true, 'idmarca');
   $idmarca = $idalmacenA2['resultado'];
 //  echo $sqld;
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}
 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fechaventa);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td></tr>";

  //  $html .= "<td style='width:500px;height:100px;border-bottom:0px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
  //   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca./ANULADOS</td></tr>";
//$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";

    $html .= "</table>";
   // $html .= "</td>";
    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";

    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}
//echo $sql21;
    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];

   $select = "k.idmodelo";
$from = "bitacoradeleteventa v, kardexdetallepar k";
$where = "v.idkardexunico = k.idkardexunico
and v.idalmacen = '$idalmacen' and v.dato='$boleta' Group by k.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
   //ojo

    $producto = dibujarTablaitemanulado($sql25,$sql21,$boleta,$idalmacen,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$iddevolucion,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";


    $select1 = "SUM(d.idkardexunico*vi.precioventa)AS pares";
 $from1 = " modelo mdd,ventaitem vi,detalledevolucion d";
   $where1 = "d.iditemventa=vi.iditemventa and mdd.idmodelo = vi.idmodelo AND d.idventadetalle='$idventadetalle' ";
$sql2p1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.idventa";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $totalNeto = $almacenA1['resultado'];
   // echo $sql2p1;
  $totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";

$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function verboletatraspaso($idtraspaso, $return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
   $sql1 = " SELECT * FROM traspaso WHERE idtraspaso = '$idtraspaso' "  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];

//$idalmacen=$ven[0]['idalmacen'];
$idalmacenorigen=$ven[0]['idalmacen'];
 $idalmacendestino=$ven[0]['idalmacendestino'];
 $responsable=$ven[0]['responsable'];
 $idcliente=$ven[0]['idcliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['boleta'];
 $totalbs=$ven[0]['totalbs'];
 $totalcajas=$ven[0]['tcajas'];
 $totalsus=$ven[0]['totalsus'];
 $descuentopor=$ven[0]['descporcentaje'];
 $descuento=$ven[0]['descuento'];
 $totalNeto=$ven[0]['montoapagar'];

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$responsable' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}

$sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacendestino'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacendestino = $idalmacenA2['resultado'];
 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacenorigen = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
  if($idalmacen==$idalmacendestino){
//recibidos
$sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacenorigen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacenorigen2 = $idalmacenA2['resultado'];
 $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>ENVIADO POR</td><td>".$almacenorigen2."</td></tr>";

}else{
  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>ENVIADO POR</td><td>".$almacenorigen."</td></tr>";

}
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td></tr>";

  //  $html .= "<td style='width:500px;height:100px;border-bottom:0px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
  //   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td></tr>";


$html .= "<tr><td style='font-size:11px;font-weight:bold;'>ENVIADO A:</td><td>".$almacendestino."/".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";
//$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";

    $html .= "</table>";
   // $html .= "</td>";
    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];

$select = "vi.idmodelo";
$from = "traspasodetallepar vi";
$where = "iddetalletraspaso='$idtraspaso' Group by vi.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
    $producto = dibujarTablaitemtraspaso($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idtraspaso,$formatomayor);

   $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";

   // $html .= "<tr>";

$html .= "</br>";
  $html .= "</br>";
  $observaciond=$ven[0]['observacion'];
  if($observaciond=='-'){
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
    //$html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    //$html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td></tr><br />";
   $html .= "</table>";
     }else{
$html .= "<table cellpadding='0' cellspacing='0' border='0'  style='width:750px; font-size:11px; font-family:Tahoma; line-height:12pt;'>";
  //  $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
   // $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."  Dolares Americanos</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td style='background-image: url(img/fondocasilla.jpg);'><img src='img/fondocasilla.jpg'  width='100' height='25'>".$ven[0]['observacion']."</td></tr><br />";
   $html .= "</table>";
         }
   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function vercodigostraspaso($idtraspaso, $return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
   $sql1 = " SELECT * FROM traspaso WHERE idtraspaso = '$idtraspaso' "  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];

//$idalmacen=$ven[0]['idalmacen'];
 $idalmacendestino=$ven[0]['idalmacendestino'];
 $responsable=$ven[0]['responsable'];
 $idcliente=$ven[0]['idcliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['boleta'];
 $totalbs=$ven[0]['totalbs'];
 $totalcajas=$ven[0]['tcajas'];
 $totalsus=$ven[0]['totalsus'];
 $descuentopor=$ven[0]['descporcentaje'];
 $descuento=$ven[0]['descuento'];
 $totalNeto=$ven[0]['montoapagar'];

$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$responsable' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}

$sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacendestino'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacendestino = $idalmacenA2['resultado'];
 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacenorigen = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>ENVIADO POR</td><td>".$almacenorigen."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td></tr>";

  //  $html .= "<td style='width:500px;height:100px;border-bottom:0px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
  //   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>ENVIADO A:</td><td>".$almacendestino."/".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";
//$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";

    $html .= "</table>";
   // $html .= "</td>";
    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
  $select = "vi.idkardexunico,k.codigobarra,vi.saldocantidad AS pares,vi.idmodelo,vi.preciounitario as precio,SUM(vi.preciounitario) as total,mdd.cliente";
 $from = " modelo mdd,traspasodetallepar vi,kardexdetallepar k";
   $where = "vi.idkardexunico=k.idkardexunico and mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato'";

$select = "vi.idkardexunico,k.codigobarra,vi.saldocantidad AS pares,vi.idmodelo,CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo,vi.idmodeloorigen";
$from = "modelo mdd,traspasodetallepar vi,kardexdetallepar k";
$where = "vi.idkardexunico=k.idkardexunico and mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' ";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
 //   $producto = dibujarTabladetalalcodigo($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idtraspaso,$formatomayor);
 //  $html .= $producto['resultado'];

    $table = dibujarTablaOfSQL($sql25, "Detalle");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";

   // $html .= "<tr>";

$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function vercodigoanuladosventa($boleta, $return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
   $sql2 = " SELECT * FROM bitacoradeleteventa WHERE idalmacen = '$idalmacen' and dato='$boleta' "  ;
     $dato = getTablaToArrayOfSQL($sql2);
    $ven1 = $dato["resultado"];
// $idalmacen=$ven1[0]['idalmacen'];
 $idcliente=$ven1[0]['diferencia'];
 $idvendedor=$ven1[0]['usuario'];
//$idmarca=$ven1[0]['diferencia'];
 $fechaventa=$ven1[0]['fechadelete'];
// $boleta=$ven1[0]['boleta'];
$totalNeto = round($totalNeto);
$totalNeto =$totalNeto.".00";
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $clientenombre=strtoupper($clientenombre);
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$responsable' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
    $vendedornombre=strtoupper($vendedornombre);
 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}

$sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacendestino'";
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacendestino = $idalmacenA2['resultado'];
 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombre');
   $almacenorigen = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
     $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
 //   <IMG src="mifoto.jpg" width="100" height="100"/>
    $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>ENVIADO POR</td><td>".$almacenorigen."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td></tr>";

  //  $html .= "<td style='width:500px;height:100px;border-bottom:0px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:650px;'>";
  //   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>ENVIADO A:</td><td>".$almacendestino."/".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td><td style='font-size:24px;font-weight:bold;'>$nombremarca</td></tr>";
//$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";

    $html .= "</table>";
   // $html .= "</td>";
    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
//  $select = "vi.idkardexunico,k.codigobarra,vi.saldocantidad AS pares,vi.idmodelo,vi.preciounitario as precio,SUM(vi.preciounitario) as total,mdd.cliente";
// $from = " modelo mdd,traspasodetallepar vi,kardexdetallepar k";
//   $where = "vi.idkardexunico=k.idkardexunico and mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato'";
//$select = "COUNT(v.idkardexunico)AS pares,v.idmodelo,v.preciofinal as precio,mdd.cliente";
// $from = " modelo mdd,bitacoradeleteventa v";
// $where = " mdd.idmodelo = v.idmodelo and v.idalmacen='$idalmacen' and v.dato='$boleta' and v.idmodelo='$dato'";

$select = "v.idkardexunico,k.codigobarra,v.cantidad AS pares,v.idmodelo,CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
$from = "modelo mdd,bitacoradeleteventa v,kardexdetallepar k";
$where = "v.idkardexunico=k.idkardexunico and mdd.idmodelo = v.idmodelo AND v.idalmacen='$idalmacen' and v.dato='$boleta' ";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
 //   $producto = dibujarTabladetalalcodigo($sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idtraspaso,$formatomayor);
 //  $html .= $producto['resultado'];

    $table = dibujarTablaOfSQL($sql25, "Detalle");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";

   // $html .= "<tr>";

$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
//<?php
//if (!function_exists("GetSQLValueString")) {
//function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
//{
//  if (PHP_VERSION < 6) {
//    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
//  }
//
//  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
//
//  switch ($theType) {
//    case "text":
//      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//      break;
//    case "long":
//    case "int":
//      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//      break;
//    case "double":
//      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
//      break;
//    case "date":
//      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//      break;
//    case "defined":
//      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//      break;
//  }
//  return $theValue;
//}
//}
//
//$editFormAction = $_SERVER['PHP_SELF'];
//if (isset($_SERVER['QUERY_STRING'])) {
//  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
//}
//
//if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
//	$tipo_prod = $_POST["lstTipo"];
//
////Guardar imagen
//	if(is_uploaded_file($_FILES['fleImagen']['tmp_name'])) { // verifica haya sido cargado el archivo
//		$ruta= "images/$tipo_prod/".$_FILES['fleImagen']['name'];
//		move_uploaded_file($_FILES['fleImagen']['tmp_name'], $ruta);
//	}
//
//  $insertSQL = sprintf("INSERT INTO catalogo (Referencia, Imagen, Tipo, Precio, Nombre, Descripcion) VALUES (%s, %s, %s, %s, %s, %s)",
//                       GetSQLValueString($_POST['txtReferencia'], "int"),
//                       GetSQLValueString($ruta, "text"),
//                       GetSQLValueString($_POST['lstTipo'], "text"),
//                       GetSQLValueString($_POST['txtPrecio'], "double"),
//                       GetSQLValueString($_POST['txtNombre'], "text"),
//                       GetSQLValueString($_POST['txtDescripcion'], "text"));
//
//  mysql_select_db($database_con_imag, $con_imag);
//  $Result1 = mysql_query($insertSQL, $con_imag) or die(mysql_error());
//
//  $insertGoTo = "ingreso_exitoso.php";
//  if (isset($_SERVER['QUERY_STRING'])) {
//    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
//    $insertGoTo .= $_SERVER['QUERY_STRING'];
//  }
//  header(sprintf("Location: %s", $insertGoTo));
//}
//
function verimagendelmodelo($idmodelo,$modelo, $return)
{
   $idtienda = $_SESSION['idtienda'];
   $html = "";
  $sql2 = " SELECT * FROM modelo WHERE idmodelo = '$idmodelo' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'idmarca');
  $idmarca = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $modelo = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'color');
  $color = $idalmacenA['resultado'];
     $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'material');
  $material = $idalmacenA['resultado'];
  $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}

$sql2 = "SELECT Imagen FROM catalogo WHERE codigo='camisetas' ";
 //mo.idcoleccion = co.idcoleccion ORDER BY `co`.`anio` , `mo`.`codigo` DESC LIMIT $start,$limit;";
$query = mysql_query($sql2);

$result=mysql_query("SELECT Imagen FROM catalogo WHERE codigo='camisetas'");

//$result=mysql_query("SELECT * FROM `imagephp` WHERE id=".$_GET["id"],$link);
$row=mysql_fetch_array($result);
$enlacef = $row["Imagen"];

# Mostramos la imagen
//header("Content-type:".$row["tipo"]);
//echo $row["Imagen"];


   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    // $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
// $html .= "<tr><td style='width:500px;'><img src='img/logobalderrama.jpg' width='750' height='78'><td><tr>";
  // $enlacef ="marca/361/admin.jpg";
    $html .= "<tr><td style='width:500px;'><img src='".$enlacef."' width='250' height='250'><td><tr>";

   $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' font-family=Tahoma width='700' >";
    $html .= "<tr>";
     $html .= "<tr><td>Marca: </td><td style='font-size:20px;font-weight:bold;'>$nombremarca</td><td style='font-size:11px;font-weight:bold;'></td></tr>";
    $html .= "<tr><td>Modelo :</td><td style='font-size:20px;font-weight:bold;'>$modelo</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
   $html .= "<tr><td>Color: </td><td style='font-size:13px;font-weight:bold;'>$color</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
   $html .= "<tr><td>Material: </td><td style='font-size:13px;font-weight:bold;'>$material</td></tr>";

    $html .= "</tr>";

     $html .= "<table style='width:100%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td>";
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "</table>";

   // $html .= "<tr>";


$html .= "</br>";
  $html .= "</br>";

   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px; line-height:10pt;'>";
    $html .= "<tr>";
    $html .= "<td>";
 $html .= "<form method='POST' enctype='multipart/form-data' name='form1' id='form1'>";
 // <table width="626" border="1">
 $html .= "<table width='626' border='1'>";

 $html .= "<tr>";
    //<tr>
     $html .= "<td><strong>Imagen:</strong></td>";
     // <td><strong>Imagen:</strong></td>
         $html .= "<td><label for='fleImagen'></label>";
     // <td><label for="fleImagen"></label>
     $html .= "<input type='file' name='fleImagen' id='fleImagen' /></td>";
    //  <input type="file" name="fleImagen" id="fleImagen" /></td>
   // </tr>

 $html .= "</tr>";

 $html .= "</table>";
   // <input type="submit" name="button" id="button" value="Enviar" />
     $html .= "<input type='submit' onclick = 'this.form.action = 'php/ingresoexitoso.php'' name='button' id='button' value='Enviar' />";
 //    <input type="submit" onclick = "this.form.action = 'pagina1.php'" value="accion 1" />
 // </p>
 // <input type="hidden" name="MM_insert" value="form1" />
   $html .= "<input type='hidden' name='MM_insert' value='form1' />";
//</form>
 $html .= "</form>";

    //     </form>
   $html .= "</td>";
    $html .= "</tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$tipo_prod = $_POST["lstTipo"];
//Guardar imagen
	if(is_uploaded_file($_FILES['fleImagen']['tmp_name'])) { // verifica haya sido cargado el archivo
		$ruta= "marca/361/".$_FILES['fleImagen']['name'];
       // $ruta= "images/$tipo_prod/".$_FILES['fleImagen']['name'];
        // $enlacef ="marca/361/admin.jpg";
		move_uploaded_file($_FILES['fleImagen']['tmp_name'], $ruta);
	}

//  $insertSQL = sprintf("INSERT INTO catalogo (idcatalogo, Imagen, codigo, color, material, marca,idmarca) VALUES (%s, %s, %s, %s, %s, %s, %s)",
//$sql[] = getSqlNewMarcas($idmarca, $idproveedor, $codigo, $codigobarra, $nombre, $imagen, $numero, $idalmacen, $pedido, $origen,$talla,$opcion,$opcionb,$tipo,false);
//$sql[] = getSqlNewCatalogo( $idcatalogo, $Imagen, $codigo, $color, $material, $marca, $idmarca,false);

//                     GetSQLValueString($_POST['txtReferencia'], "int"),
//                       GetSQLValueString($ruta, "text"),
//                       GetSQLValueString($_POST['lstTipo'], "text"),
//                       GetSQLValueString($_POST['txtPrecio'], "double"),
//                       GetSQLValueString($_POST['txtNombre'], "text"),
//                       GetSQLValueString($_POST['txtDescripcion'], "text"),
//                       GetSQLValueString($_POST['txtDescripcion'], "text"));
//  mysql_select_db($database_con_imag, $con_imag);
//  $Result1 = mysql_query($insertSQL, $con_imag) or die(mysql_error());
//ejecutarConsultaSQLBeginCommit($sql);
//  $insertGoTo = "ingreso_exitoso.php";
//  if (isset($_SERVER['QUERY_STRING'])) {
//    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
//    $insertGoTo .= $_SERVER['QUERY_STRING'];
//  }
 // header(sprintf("Location: %s", $insertGoTo));
}
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function getSqlNewCatalogo($idcatalogo, $Imagen, $codigo, $color, $material, $marca, $idmarca, $return){
$setC[0]['campo'] = 'idcatalogo';
$setC[0]['dato'] = $idcatalogo;
$setC[1]['campo'] = 'Imagen';
$setC[1]['dato'] = $Imagen;
$setC[2]['campo'] = 'codigo';
$setC[2]['dato'] = $codigo;
$setC[3]['campo'] = 'color';
$setC[3]['dato'] = $color;
$setC[4]['campo'] = 'material';
$setC[4]['dato'] = $material;
$setC[5]['campo'] = 'marca';
$setC[5]['dato'] = $marca;
$setC[6]['campo'] = 'idmarca';
$setC[6]['dato'] = $idmarca;
$sql2 = generarInsertValues($setC);
return "INSERT INTO catalogo ".$sql2;
}


function dibujarTablaitemventa($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];
                               $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";

$select = "SUM(vi.cantidad)AS pares,vi.idmodelo,vi.total,mdd.cliente,mdd.idvendedor";
$from = " modelo mdd,ventaitem vi";
  $where = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$dato'";
 $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    }
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
 
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
     $totalSus = $preciou*$pares;
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'idvendedor');
    $idempleado = $almacenA1['resultado'];
//    echo $idempleado;
//$select1 = "SUM(vi.montoventafinal) as precio";
//    $from1 = "modelo mdd,ventaitem vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$dato'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. "";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'precio');
//    $preciomodelo = $almacenA1['resultado'];

 $sqlmarca = " SELECT SUM(vi.precioventafinal) as total FROM ventafinalmodelo vi  WHERE vi.idventa='$idventa' and vi.idmodelo='$dato'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "total");
    $preciomodelo = $opcionkardex['resultado'];
//echo ;
//$totalSus = round($totalSus);
//$totalSus =$totalSus.".00";

$select1 = "codigo";
    $from1 = "empleados";
    $where1 = "idempleado='$idempleado'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. "";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'codigo');
    $itemvendedor = $almacenA1['resultado'];
  
   $preciomodelo=round($preciomodelo,2);
  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $preciomodelo;
//$totalsus =$totalsus.".00";
$totalsus =$totalsus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciomodelo."&nbsp;</td>";
//echo $sql3;
for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];

$select1 = "SUM(vi.cantidad)AS pares";
    $from1 = "modelo mdd,ventaitem vi";
    $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$itemvendedor."&nbsp;</td>";

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaitemventacambio($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];
  $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }
  $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];

                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
//SELECT SUM( iv.saldocantidad ) AS pares, iv.idmodelo, SUM( iv.preciounitario ) AS precio, md.cliente, md.idvendedor, CONCAT( md.codigo, '-', md.color, '-', md.material ) AS codigo
//FROM traspasosinternos iv, modelo md
//WHERE iv.idmodelo = md.idmodelo
//AND iv.idventa = '7264'
//AND iv.idmodelo = 'm-47937'
//GROUP BY iv.idmodelo

$select = "SUM( iv.saldocantidad ) AS pares, iv.idmodelo, SUM( iv.preciounitario ) AS precio, md.cliente, md.idvendedor, CONCAT( md.codigo, '-', md.color, '-', md.material ) AS codigo";
  $from = " traspasosinternos iv, modelo md";
  $where = "iv.idmodelo=md.idmodelo AND iv.idventa='$idventa' and iv.idmodelo='$dato'";
 $select .= ",CONCAT(md.codigo, '-',md.color, '-', md.material) AS codigo";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', md.codigo, '-',md.color, '-', md.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and md.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(md.codigo, '-',md.color, '-', md.material) AS codigo";
//    }
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  iv.idmodelo";

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
     $totalSus = $preciou*$pares;
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'idvendedor');
    $idempleado = $almacenA1['resultado'];
//    echo $idempleado;
//echo ;
//$totalSus = round($totalSus);
//$totalSus =$totalSus.".00";

$select1 = "codigo";
    $from1 = "empleados";
    $where1 = "idempleado='$idempleado'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. "";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'codigo');
    $itemvendedor = $almacenA1['resultado'];

  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
//$totalsus =$totalsus.".00";
$totalsus =$totalsus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
  //      $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];
//$select = "SUM(iv.saldocantidad)AS pares,iv.idmodelo,SUM(iv.preciounitario) as precio,vi.total,mdd.cliente,mdd.idvendedor";
// $from = " traspasosinternos iv,modelo md";
//   $where = "iv.idmodelo=md.idmodelo AND iv.idventa='$idventa' and iv.idmodelo='$dato'";

$select1 = "SUM(iv.saldocantidad)AS pares";
    $from1 = "traspasosinternos iv,modelo md";
    $where1 = "iv.idmodelo=md.idmodelo AND iv.idventa='$idventa' and iv.idmodelo='$dato' AND iv.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  iv.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$itemvendedor."&nbsp;</td>";

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaitemventaferia($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Marca</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>Talla</td>";


                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idkardexunico'];

                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
//      $select = "SUM(vi.cantidad)AS pares,vi.idmodelo,vi.precioventa as precio,vi.total,mdd.cliente";
//echo $dato;
 $sqlmarca = " SELECT * FROM ventaferia WHERE  idkardexunico= '$dato' and idventa='$idventa'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmodelo");
    $idmodelo = $opcionkardex['resultado'];

$select = "SUM(vi.totalpares)AS pares,CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo,vi.idmodelo,vi.totalsus as precio,vi.totalsus,mdd.cliente,mdd.idvendedor";
 $from = " modelo mdd,ventaferia vi";
   $where = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$idmodelo'";


    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
     $totalSus = $preciou*$pares;
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'idvendedor');
    $idempleado = $almacenA1['resultado'];
     $sqlmarca = " SELECT k.talla FROM ventaferia v,kardexdetallepar k WHERE v.idkardexunico=k.idkardexunico and v.idkardexunico= '$dato' and v.idventa='$idventa'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionkardex['resultado'];
     $sqlmarca = " SELECT ma.nombre FROM marcas ma,modelo m WHERE m.idmarca=ma.idmarca and m.idmodelo='$idmodelo' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $marca = $opcionkardex['resultado'];
//    echo $idempleado;
//echo ;
//$totalSus = round($totalSus);
//$totalSus =$totalSus.".00";

$select1 = "codigo";
    $from1 = "empleados";
    $where1 = "idempleado='$idempleado'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. "";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'codigo');
    $itemvendedor = $almacenA1['resultado'];

  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
//$totalsus =$totalsus.".00";
$totalsus =$totalsus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$marca."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
  //      $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";


    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$talla."&nbsp;</td>";

 // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$itemvendedor."&nbsp;</td>";

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

$devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
//$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}



function dibujarTablaitemventacompleto($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];

                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
//      $select = "SUM(vi.cantidad)AS pares,vi.idmodelo,vi.precioventa as precio,vi.total,mdd.cliente";
//echo $dato;
$select = "SUM(vi.cantidad)AS pares,vi.idmodelo,vi.montoventafinal as precio,vi.total,mdd.cliente";
 $from = " modelo mdd,ventaitem vi";
   $where = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$dato'";
 $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    }
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
     $totalSus = $preciou*$pares;
//echo ;
//$totalSus = round($totalSus);
//$totalSus =$totalSus.".00";

  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
//$totalsus =$totalsus.".00";
$totalsus =$totalsus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciot."&nbsp;</td>";
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];

$select1 = "SUM(vi.cantidad)AS pares";
    $from1 = "modelo mdd,ventaitem vi";
    $where1 = "mdd.idmodelo = vi.idmodelo AND vi.idventa='$idventa' and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}


function dibujarTablaitemdevolucion($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];


$devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
//    $select = "COUNT(d.idkardexunico)AS pares,vi.idmodelo,vi.precioventa as precio,vi.total,mdd.cliente";
// $from = " modelo mdd,ventaitem vi,detalledevolucion d";
// $where = "d.iditemventa=vi.iditemventa and mdd.idmodelo = vi.idmodelo AND d.iddevolucion='$idventa' and mdd.idmodelo='$dato'";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//     }
//    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
//    $select1 = "COUNT(d.idkardexunico)AS pares";
//    $from1 = "modelo mdd,detalledevolucion d,kardexdetallepar kp";
//    $where1 = " d.idkardexunico=kp.idkardexunico and mdd.idmodelo = kp.idmodelo AND d.iddevolucion='$idventa' and kp.idmodelo='$dato' AND kp.talla='$idmmarca'";

$select = "COUNT(d.idkardexunico)AS pares,mdd.idmodelo,d.valorcalzado as precio,SUM(d.valorcalzado) as total,mdd.cliente";
 $from = " modelo mdd,detalledevolucion d,kardexdetallepar kp";
 $where = "d.idkardexunico=kp.idkardexunico and mdd.idmodelo = kp.idmodelo AND d.iddevolucion='$idventa' and kp.idmodelo='$dato'";
 $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";

    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  mdd.idmodelo";
  //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];

     $sql1="SELECT SUM(d.valorcalzado) as total FROM modelo mdd,detalledevolucion d,kardexdetallepar kp WHERE
 d.idkardexunico=kp.idkardexunico and mdd.idmodelo = kp.idmodelo AND d.iddevolucion='$idventa' and kp.idmodelo='$dato'";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'total');
   $totalSus = $idalmacenA['resultado'];

     //$totalSus = $preciou*$pares;
$totalSus = round($totalSus,2);
//$totalSus =$totalSus.".00";
  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
   $totalpares =$totalpares + $pares;
   $totalsus =$totalsus + $totalSus;
   $totalsus =$totalsus.".00";
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
    $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciot."&nbsp;</td>";
    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];

$select1 = "COUNT(d.idkardexunico)AS pares";
    $from1 = "modelo mdd,detalledevolucion d,kardexdetallepar kp";
    $where1 = " d.idkardexunico=kp.idkardexunico and mdd.idmodelo = kp.idmodelo AND d.iddevolucion='$idventa' and kp.idmodelo='$dato' AND kp.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  kp.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];
   // echo $sql21;
    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaitemanulado($sql,$sql21,$boleta,$idalmacen,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idventa,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];


$devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";


$select = "COUNT(v.idkardexunico)AS pares,v.idmodelo,v.preciofinal as precio,mdd.cliente";
 $from = " modelo mdd,bitacoradeleteventa v";
 $where = " mdd.idmodelo = v.idmodelo and v.idalmacen='$idalmacen' and v.dato='$boleta' and v.idmodelo='$dato'";
$select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    }
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  v.idmodelo";

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
     $totalSus = $preciou*$pares;
$totalSus = round($totalSus);
$totalSus =$totalSus.".00";
  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
$totalsus =$totalsus.".00";
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciot."&nbsp;</td>";
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];

$select1 = "COUNT(v.idkardexunico)AS pares";
    $from1 = "modelo mdd,bitacoradeleteventa v";
    $where1 = " mdd.idmodelo = v.idmodelo and v.idalmacen='$idalmacen' and v.dato='$boleta' and v.idmodelo='$dato' AND v.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  v.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];
   // echo $sql21;
    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaitemtraspaso($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idtraspaso,$formatomayor)
{set_time_limit(0);

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}

    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
  switch($formatomayor){
  case '10':
          $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>U</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XS</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>S</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>P</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>M</td>";

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>L</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XL</td>";


    break;
  default:
for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }
break;
}
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";


                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];

                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                                $select = "SUM(vi.saldocantidad)AS pares,vi.idmodelo,vi.preciounitario as precio,SUM(vi.preciounitario) as total,mdd.cliente,vi.idmodeloorigen";
 $from = " modelo mdd,traspasodetallepar vi";
   $where = "mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato'";
$select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    }
    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
    $preciot = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $item = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $preciou = $almacenA1['resultado'];
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'idmodeloorigen');
    $idmodeloorigen = $almacenA1['resultado'];


$select1s = "idvendedor";
    $from1s = "modelo";
    $where1s = "idmodelo='$idmodeloorigen'";
    $sql21s = "SELECT ".$select1s." FROM ".$from1s. " WHERE ".$where1s. "";
 $almacenA1 =  findBySqlReturnCampoUnique($sql21s, true, true, 'idvendedor');
    $idempleado = $almacenA1['resultado'];

$select1 = "codigo";
    $from1 = "empleados";
    $where1 = "idempleado='$idempleado'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. "";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'codigo');
    $itemvendedor = $almacenA1['resultado'];

     $totalSus = $preciou*$pares;
//echo $sql2p1;
$totalSus = round($totalSus);
$totalSus =$totalSus.".00";
//  $totalSus = $totalSus * 1.0;
//$totalSus=round($totalSus,2);
 // echo $totalSus;
  $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
$totalsus =$totalsus.".00";
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciot."&nbsp;</td>";
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";
 switch($formatomayor){

  case '10':
$select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='U'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XS'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares2 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='S'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares3 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='P'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares4 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='M'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares5 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='L'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares6 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XL'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares7 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares2."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares3."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares4."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares5."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares6."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares7."&nbsp;</td>";

    break;
  default:
for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];

$select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,traspasodetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }
        break;
}

 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$itemvendedor."&nbsp;</td>";

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";
 switch($formatomayor){
  case '10':

$select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='U'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XS'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares2 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='S'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares3 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='P'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares4 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='M'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares5 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='L'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares6 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XL'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares7 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares2."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares3."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares4."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares5."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares6."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares7."&nbsp;</td>";

    break;
  default:
for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }
        break;
}
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'></td>";



     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

//function dibujarTabladetalalcodigo($sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idtraspaso,$formatomayor)
//{set_time_limit(0);
//
//if($fechafin==null ||$fechafin == ""){
//    $fechafin = Date("Y-m-d");
//}
//
//    $sql211 = getTablaToArrayOfSQL($sql21);
//    $sql3 = $sql211['resultado'];
//    if($link=new BD)
//    {
//        if($link->conectar())
//        {
//            if($re = $link->consulta($sql))
//            {
//                //echo mysql_num_rows($re);
//                if($fi = mysql_fetch_array($re))
//                {
//                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
//
////                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
//                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
//       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
// // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Sus</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
////$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
//$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";
//  switch($formatomayor){
//  case '10':
//          $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>U</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XS</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>S</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>P</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>M</td>";
//
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>L</td>";
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XL</td>";
//
//
//    break;
//  default:
//for($hi=0;$hi<$row1;$hi++){
//       $codigo = $sql3[$hi];
//        $idmmarca = $codigo['codigo'];
//
// $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
//            $ji++;
//        }
//break;
//}
//
//
//                    $devS .= "</tr>";
//                    $ii = 0;
//                    //$totalCount = mysql_num_rows($re);
//                    $z = 1;
//                     $totalcajas=0;
//                 $totalpares=0;
//                  $totalsus=0;
//                    do{
//                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
//
//                        for($i = 0; $i< mysql_num_fields($re); $i++)
//                        {$dato = $fi[$i];
//     $iddetalleingreso = $fi[$i]['idmodelo'];
//
//                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
//                                $select = "vi.idkardexunico,k.codigobarra,vi.saldocantidad AS pares,vi.idmodelo,vi.preciounitario as precio,SUM(vi.preciounitario) as total,mdd.cliente";
// $from = " modelo mdd,traspasodetallepar vi,kardexdetallepar k";
//   $where = "vi.idkardexunico=k.idkardexunico and mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato'";
//
//    if($formatomayor=='1'){
//         $select .= ",CONCAT(c.detalle, '-', mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//          $from .= ",coleccion c";
//          $where .= " and mdd.idcoleccion=c.idcoleccion";
//     }else{
//         $select .= ",CONCAT(mdd.codigo, '-',mdd.color, '-', mdd.material) AS codigo";
//    }
//    $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where. " group by  vi.idmodelo";
//  //echo $sql2p1;
//   $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'idkardexunico');
//    $idkardexunico = $almacenA1['resultado'];
//     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigobarra');
//    $codigobarra = $almacenA1['resultado'];
//     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
//    $modelo = $almacenA1['resultado'];
//     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'pares');
//    $pares = $almacenA1['resultado'];
//    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'total');
//    $preciot = $almacenA1['resultado'];
//     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
//    $item = $almacenA1['resultado'];
//     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
//    $preciou = $almacenA1['resultado'];
//     $totalSus = $preciou*$pares;
////echo $sql2p1;
//$totalSus = round($totalSus);
//$totalSus =$totalSus.".00";
////  $totalSus = $totalSus * 1.0;
////$totalSus=round($totalSus,2);
// // echo $totalSus;
//  $cajas = $pares/12;
//   $cajas=round($cajas,2);
//   $totalcajas =$totalcajas + $cajas;
//     $totalpares =$totalpares + $pares;
//       $totalsus =$totalsus + $totalSus;
//$totalsus =$totalsus.".00";
//    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
//    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$idkardexunico."&nbsp;</td>";
//    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$codigobarra."&nbsp;</td>";
//
//    $devS .= "<td style='font-size:9px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
// $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$preciot."&nbsp;</td>";
//        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
//       //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$item."&nbsp;</td>";
//         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";
// switch($formatomayor){
//
//  case '10':
//$select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='U'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares1 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XS'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares2 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='S'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares3 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='P'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares4 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='M'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares5 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='L'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares6 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XL'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares7 = $almacenA1['resultado'];
//
//    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares2."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares3."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares4."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares5."&nbsp;</td>";
//$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares6."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares7."&nbsp;</td>";
//
//    break;
//  default:
//for($h=0;$h<$row1;$h++){
//       $codigo = $sql3[$h];
//        $idmmarca = $codigo['codigo'];
//
//$select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,traspasodetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo AND vi.iddetalletraspaso='$idtraspaso' and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " ";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares1 = $almacenA1['resultado'];
//
//    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
//            $j++;
//        }
//        break;
//}
//
//
//   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }
//
//                        }
//                        $devS .= "</tr>";
//                        $ii++;
//                        $z ++;
//                    }while($fi = mysql_fetch_array($re));
////$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
//$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
//       $devS .= "<td style='display:none;'></td>";
//        $fechatoday = Date("d-m-Y");
//       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
//  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
// //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>SUS</td>";
// $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";
// switch($formatomayor){
//  case '10':
//
//$select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='U'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares1 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XS'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares2 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='S'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares3 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='P'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares4 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='M'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares5 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='L'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares6 = $almacenA1['resultado'];
//    $select1 = "SUM(vi.saldocantidad)AS pares";
//    $from1 = "modelo mdd,kardexdetallepar vi";
//    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XL'";
//    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
//$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
//    $pares7 = $almacenA1['resultado'];
//
//    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares2."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares3."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares4."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares5."&nbsp;</td>";
//$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares6."&nbsp;</td>";
//       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares7."&nbsp;</td>";
//
//    break;
//  default:
//for($h=0;$h<$row1;$h++){
//       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
//            $j++;
//        }
//        break;
//}
//
//
//
//     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";
//
//             $devS .= "</tr>";
//
//                    $devS .= "</table>";
//
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $devS;
//
//                }
//                else
//                {
//                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
//                    $dev['error']   = "false";
//                    $dev['resultado'] = "";
//                }
//            }
//            else
//            {
//                $dev['mensaje'] = "Error en la consulta";
//                $dev['error']   = "false";
//                $dev['resultado'] = "";
//            }
//        }
//        else
//        {
//            $dev['mensaje'] = "No se pudo conectar a la BD";
//            $dev['error']   = "false";
//            $dev['resultado'] = "";
//        }
//    }
//    else
//    {
//        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
//        $dev['error']   = "false";
//        $dev['resultado'] = "";
//    }
//    return $dev;
//}
//para inventario resultado
function dibujarTablaitemingreso($idkardex,$sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idingreso,$formatomayor)
{set_time_limit(0);
 $idalmacen = $_SESSION['idalmacen'];
 $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
  if($idkar==null || $idkar==''){
   $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,estado FROM administrakardex WHERE  mesrango= '$idkardex' and idalmacen='$idalmacen'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
    $estadokardex = $opcionkardex['resultado'];
}else{
 $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,estado FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
    $estadokardex = $opcionkardex['resultado'];
}
if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}


    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";
 switch($formatomayor){
  case '5':
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Color</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Material</td>";
  
  break;
  case '7':
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Talla</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Color</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Material</td>";
  break;
  default:
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Color</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Material</td>";
  break;
}
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Vendedor</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Ingreso</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Cajas</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Venta</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Unitario</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";

        switch($formatomayor){
  case '10':
          $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>U</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XS</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>S</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>P</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>M</td>";

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>L</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>XL</td>";


    break;
  default:

for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }
break;
}
//ojo tallas
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>Proforma</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>Almacen</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;

                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];

       $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";

switch($formatomayor){
  case '7':
         $select =" mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,kp.almacen,mdd.cliente,mdd.talla ,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja, SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' and kp.idmodelo='$dato' GROUP by kp.idmodelo";
   break;
 case '11':
          $select =" mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla, mdd.precioventa AS precio, mdd.numerocajas as totalcajas,SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja, SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.idalmacen='$idalmacen' and kp.idmodelo='$dato' GROUP by kp.idmodelo";
   break;
//aqui
   default:
       $select =" mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,
SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja,
 SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.idalmacen='$idalmacen' and kp.idmodelo='$dato' GROUP by kp.idmodelo";
  break;
}
 $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

//echo $sql2p1;
    $sqlmarca = " SELECT CONCAT( i.boleta, '-', a.codigo) AS boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
AND mdd.idmarca = '$idmarca' and kp.idmodelo='$dato' GRoup by kp.idmodelo";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
    $boletaalmacen = $opcionkardex['resultado'];
    if($boletaalmacen !=null || $boletaalmacen!=""){
$boleta = $boletaalmacen;
     }else{
   $sqlmarca = " SELECT CONCAT( i.nombre, '-', a.codigo) AS boleta FROM modelo mdd,kardexdetallepar kp,proformas i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.id_proforma and i.idalmacen=a.idalmacen
AND mdd.idmarca = '$idmarca' and kp.idmodelo='$dato' GRoup by kp.idmodelo";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
    $boletaalmacen = $opcionkardex['resultado'];
$boleta = $boletaalmacen;
      }
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'color');
    $color = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'material');
    $material = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'vendedor');
    $vendedor = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $cliente = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'talla');
    $talla = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'fecha');
    $fechaingreso = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'totalpares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $precioventa = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'preciounitario');
    $unitario = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'totalparesbs');
    $totalSus = $almacenA1['resultado'];

$sqlmarca1 = " SELECT c.codigo FROM modelo mdd, clientes c WHERE mdd.idcliente=c.idcliente
AND mdd.idmarca = '$idmarca' and mdd.idmodelo='$dato'";
  $almacenA1 =  findBySqlReturnCampoUnique($sqlmarca1, true, true, 'codigo');
    $almacen= $almacenA1['resultado'];
   //  $totalSus = $preciou*$pares;
//echo $sql2p1;
   $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

    $devS .= "<td style='font-size:12px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
  switch($formatomayor){
  case '7':
      $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$talla."&nbsp;</td>";

$devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$color."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$material."&nbsp;</td>";

    break;
  default:
//$devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$talla."&nbsp;</td>";

$devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$color."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$material."&nbsp;</td>";
       break;
}
  $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cliente."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$vendedor."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$fechaingreso."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precioventa."&nbsp;</td>";

 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$unitario."&nbsp;</td>";
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";
  switch($formatomayor){
 case '10':

$select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='U'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XS'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares2 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='S'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares3 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='P'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares4 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='M'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares5 = $almacenA1['resultado'];
    $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='L'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares6 = $almacenA1['resultado'];

   $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='XL'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
    $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares7 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares2."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares3."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares4."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares5."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares6."&nbsp;</td>";
       $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares7."&nbsp;</td>";

    break;

  default:
for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];
         $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }
        break;
}

        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$boleta."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$almacen."&nbsp;</td>";

   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  switch($formatomayor){
  case '7':
      $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

    break;
  default:
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
   $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
       break;
     
}
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

 $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
//para inventario resultado

function dibujarTablareportemodelo($idkardex,$sql,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idingreso,$formatomayor)
{set_time_limit(0);
// $idalmacen = $_SESSION['idalmacen'];

 $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}


    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                     $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";

//                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:10px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>iD</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Almacen</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Marca</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Modelo</td>";

$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Color</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Material</td>";

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Item</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Vendedor</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Ingreso</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>Precio Venta</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Unitario</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares o U</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total Sus</td>";

      for($hi=0;$hi<$row1;$hi++){
       $codigo = $sql3[$hi];
        $idmmarca = $codigo['codigo'];

 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'>$idmmarca</td>";
            $ji++;
        }

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;

                     $totalcajas=0;
                 $totalpares=0;
                  $totalsus=0;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idmodelo'];
//echo $iddetalleingreso;
$devS .= "<td style='font-size:12px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$dato."&nbsp;</td>";
$sql1 = "SELECT ma.nombre FROM modelo m,marcas ma WHERE m.idmarca=ma.idmarca AND m.idmodelo='$dato' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'nombre');
   $marca = $idalmacenA['resultado'];
     //  $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
$select =" a.nombre as almacen,mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,
SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja,
 SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e,almacenes a";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.estado ='Activo' and kp.idalmacen=a.idalmacen and kp.idmodelo='$dato' GROUP by kp.idmodelo";

 $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

//echo $sql2p1;
 $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'almacen');
    $almacen = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $modelo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'color');
    $color = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'material');
    $material = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'vendedor');
    $vendedor = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cliente');
    $cliente = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'talla');
    $talla = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'fecha');
    $fechaingreso = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'totalpares');
    $pares = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precio');
    $precioventa = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'preciounitario');
    $unitario = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'totalparesbs');
    $totalSus = $almacenA1['resultado'];
   //  $totalSus = $preciou*$pares;
//echo $sql2p1;
   $cajas = $pares/12;
   $cajas=round($cajas,2);
   $totalcajas =$totalcajas + $cajas;
     $totalpares =$totalpares + $pares;
       $totalsus =$totalsus + $totalSus;
    //  $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
$devS .= "<td style='font-size:12px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$almacen."&nbsp;</td>";
     $devS .= "<td style='font-size:12px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$marca."&nbsp;</td>";
     $devS .= "<td style='font-size:12px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$modelo."&nbsp;</td>";
  $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$color."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$material."&nbsp;</td>";

  $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cliente."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$vendedor."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$fechaingreso."&nbsp;</td>";
 //$devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajas."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precioventa."&nbsp;</td>";

 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$unitario."&nbsp;</td>";
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalSus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $codigo = $sql3[$h];
        $idmmarca = $codigo['codigo'];
  $select1 = "SUM(vi.saldocantidad)AS pares";
    $from1 = "modelo mdd,kardexdetallepar vi";
    $where1 = "mdd.idmodelo = vi.idmodelo  and vi.idmodelo='$dato' AND vi.talla='$idmmarca'";
    $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1. " group by  vi.talla";
$almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'pares');
    $pares1 = $almacenA1['resultado'];

//echo $sql21;
    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$pares1."&nbsp;</td>";
            $j++;
        }



   //  if($trasdesp==NULL || $trasdesp =='' || $trasdesp == ""){ $trasdesp="0"; }

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  switch($formatomayor){
  case '5':
    break;
  default:
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
       break;
}
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

 $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;background-color:silver;'>TOTAL</td>";
  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcajas."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>PARES</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalsus."&nbsp;</td>";

for($h=0;$h<$row1;$h++){
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
            $j++;
        }


     // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalbsactual."&nbsp;</td>";

             $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function reporteVentaHTML222($idventa, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";



    $sql = "
SELECT DISTINCT
  ven.codigo,
  ven.fecha,
  ven.hora,
  ven.nit,
  ven.montototal,
  ven.montoapagar,
  ven.montocancelado,
  cli.nombre as cliente,
 ven.responsable,
  ven.observacion
FROM
  `ventas` ven,
  `cliente` cli
WHERE
  ven.idventa = '$idventa' AND
  ven.idcliente = cli.idcliente
";
    //    MostrarConsulta($sql);
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta venta ...............";
        exit;
    }
    //    else
    //    {
    $sql1=" SELECT DISTINCT
  ven.codigo,
  ven.fecha,
  ven.hora,
  ven.nit,
  ven.montototal,
  ven.montoapagar,
  ven.montocancelado,
  cli.nombre
FROM
  `ventas` ven,
  `cliente` cli
WHERE
  ven.idventa = '$idventa' AND
  ven.idcliente = cli.idcliente"
    ;

    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];

    $montoapagar = $ven[0]['montoapagar'];

    $montototal = $ven[0]['montototal'];
    //
    $dato = getTablaToArrayOfSQL($sql);
    $ven1 = $dato["resultado"];
    $totalMonto = $ven1[0]['montototal'];
    $precio = $ven1[0]['precio'];
    $cantidad = $ven1[0]['cantidad'];
    $obsevacion = $ven1[0]['observacion'];
    $tc = $ven1[0]['monto'];
    $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);

    $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
     $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> DETALLE PEDIDO";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven1[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['codigo']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$ven1[0]['cliente']."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td>".$tc."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Usuario:</td><td>".$ven1[0]['responsable'] ."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven1[0]['fecha']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlIV = "
              SELECT
 pro.codigo AS Codigo,
 pro.nombre AS Producto,
it.precio AS Precio,
  it.cantidad AS Cantidad,
  it.total AS Total

FROM
  itemventa it,
  `productos` pro
WHERE
  it.idventa = '$idventa' AND
  it.idproducto = pro.idproducto
                ";
    //         $totalDescuento = $ven[0]['descuento'];
    $table =
    //    MostrarConsulta($sqlIV);
    $table = dibujarTablaOfSQL($sqlIV, "Detalle");
    $html .= $table['resultado'];

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Montototal</td><td style='width:75px;text-align:right;'>".$montototal."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven1[0]['observacion']."</td><td style='font-size:11px;font-weight:bold;'> Descuento:</td><td style='width:75px;text-align:right;'>".$ven1[0]['descuento']."</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta :</td><td style='width:75px;text-align:right;'>".$montoapagar."</td></tr>";
    //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}


function dibujarTablaOfSQL($sql, $tc = 1)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:11px;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function reportealmacenHTML($idalmacen, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> ALMACEN";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT a.idalmacen,a.nombre,a.direccion,a.telefono,a.estado
FROM almacenes a
WHERE  a.idalmacen = '$idalmacen'";
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del Almacen");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";
    $sqlInv2 = "SELECT
  p.idproducto AS codigo,p.nombre AS producto,pv.nombre AS proveedor,p.estado,k.saldocantidad,k.precio1bs AS precio,k.precio1sus AS Dolar,k.costounitario
FROM
  kardexalmacen ka,
  almacenes a,
  productos p,
  kardexalmacen k,
  proveedores pv
WHERE
  p.idproducto=k.idproducto AND
  p.idproveedor=pv.idproveedor AND
  ka.idproducto=p.idproducto AND
  ka.idalmacen = a.idalmacen AND
  ka.idalmacen = 'alm-1000' ORDER BY p.idproveedor ASC";
    $inventario2 = dibujarTablaOfSQLNormal($sqlInv2, "Inventario de Productos");
    $html .= $inventario2['resultado'];
    $html .= "</td></tr>";
  /*$html .= "<tr><td colspan='3'>";
    $sqlInv = "SELECT
 mka.fecha,mka.hora,mka.descripcion, p.idproducto AS codigo,p.nombre AS producto,p.estado,mka.entrada,mka.salida,mka.saldo,mka.ingreso,mka.egreso,mka.saldobs
FROM
  almacenes a,
  productos p,
  movimientokardexalmacen mka
WHERE
  mka.idproducto=p.idproducto AND
  mka.idalmacen = a.idalmacen AND
  mka.idalmacen = '$idalmacen' ";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Movimientos de Almacen");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";
    */

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}



function arqueoDiarioHTML($almacen,$fecha,$efectivo_bs,$efectivo_sus, $return)
{

    if($fecha == null)
    {
        $fecha = Date("Y-m-d");
    }
    if($efectivo_sus == null)
    {
        $efectivo_sus = 0;
    }
    //echo $fecha;
    $sql2 = "SELECT
  alm.idalmacen
FROM
  `almacenes` alm
WHERE
  alm.nombre = '$almacen'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'idalmacen');
    $idalmacen = $idalmacenA['resultado'];
    //    echo $idalmacen;
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "ARQUEO <br>DE<br> ".$almacen."<br>";
    $html .=$fecha;
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    //    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    //    $html .= "</table>";
    //    $html .= "</td>";
    //    $html .= "</tr>";
    $html .= "<tr>";
    //    $html .= "<td>";
    $html .= "</td>";
    //

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT
  SUM(vent.montoapagar) AS ventasTotales
FROM
  ventas vent
WHERE
  vent.idalmacen = '$idalmacen' AND
  vent.fecha = '$fecha'
";
    $ventaA=findBySqlReturnCampoUnique($sql, true, true, 'ventasTotales');
    $venta = $ventaA['resultado'];
    //    echo $venta;
    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "Detalle Arqueo");

    $html .= $producto['resultado'];
    $html .= "</td>";
    // $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";

    $sqlA = "SELECT
  alm.fondocaja as FondoCaja
FROM
  `almacenes` alm
WHERE
  alm.nombre = '$almacen'";

    $cajaA =  findBySqlReturnCampoUnique($sqlA, true, true, 'fondocaja');
    $caja = $cajaA['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $productoA = dibujarTuplaOfSQLNormal($sqlA, "");

    $html .= $productoA['resultado'];
    $html .= "</td></tr>";




    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sqlInv = "SELECT
  egr.montototal AS Gastos,
  cueg.nombre as por
FROM
  egreso egr,
  almacenes alm,
  `itemegreso` iteg,
  `cuentaegreso` cueg
WHERE
  egr.fecha = '$fecha' AND
  alm.idalmacen = egr.idalmacen AND
  alm.nombre = '$almacen' AND
  egr.idegreso = iteg.idegreso AND
  cueg.idcuentaegreso = iteg.idcuentaegreso";
    //    MostrarConsulta($sqlInv);
    $inventario = dibujarTuplaOfSQLNormal($sqlInv, "");
    $html .= $inventario['resultado'];
    //    $html .= ;
    $sqlInv1 = "SELECT
  SUM(egr.montototal) AS Gastos_Totales
FROM
  egreso egr,
  almacenes alm,
  `itemegreso` iteg,
  `cuentaegreso` cueg
WHERE
  egr.fecha = '$fecha' AND
  alm.idalmacen = egr.idalmacen AND
  alm.nombre = '$almacen' AND
  egr.idegreso = iteg.idegreso AND
  cueg.idcuentaegreso = iteg.idcuentaegreso";
    $inventario1 = dibujarTuplaOfSQLNormal($sqlInv1, "");

    $html .= $inventario1['resultado'];
    $html .= "</td></tr>";


    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $tipo = findUltimoID("tipocambio", "valor", true);
    $cambio = $tipo['resultado'];

    $sqlInv = "SELECT
  max(ticam.valor)as TipoCambio
FROM
  tipocambio ticam";
    //    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Movimientos de Almacen");
    //    $html .= $inventario['resultado'];
    $inventario = dibujarTuplaOfSQLNormal($sqlInv, "");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";

    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";

    //    $html .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";

    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".$efectivo_bs."&nbsp;</td></tr>";

    //    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td>";

    //    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";




    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";

    //    $html .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";

    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Sus:</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".$efectivo_sus."&nbsp;</td></tr>";

    //    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td>";

    //    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";

    $sqlInv1 = "SELECT
  SUM(egr.montototal) AS Gastos_Totales
FROM
  egreso egr,
  almacenes alm,
  `itemegreso` iteg,
  `cuentaegreso` cueg
WHERE
  egr.fecha = '$fecha' AND
  alm.idalmacen = egr.idalmacen AND
  alm.nombre = '$almacen' AND
  egr.idegreso = iteg.idegreso AND
  cueg.idcuentaegreso = iteg.idcuentaegreso";

    $gastosA = findBySqlReturnCampoUnique($sqlInv1, true, true, 'Gastos_Totales');
    $gastos = $gastosA['resultado'];
    $total1 = $efectivo_bs+($efectivo_sus*$cambio);
    $total = $total1 + $gastos;
    //    echo "gastos".$gastos;
    //    echo "bs".$efectivo_bs;
    //    echo "sus".$efectivo_sus;
    //    echo "cambio".$cambio;
    //    echo "t".$total1;
    //    echo $total;
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";

    //    $html .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";

    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;TotalEfectivo:</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".$total."&nbsp;</td></tr>";

    //    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td>";

    //    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $sobrante1 = $venta - $total;
    if($sobrante1 >0)
    {
        $sobrante = "-".$sobrante1;
        $html .= "<tr>";
        $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";

        //    $html .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";

        $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Faltante :</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".$sobrante."&nbsp;</td></tr>";

        //    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td>";

        //    $html .= "</tr>";
        $html .= "</table>";
        $html .= "</td></tr>";
    }
    else
    {

        $faltante1 = $venta-$total;
        $faltante = $faltante1*-1;
        $html .= "<tr>";
        $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";

        //    $html .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";

        $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Sobrante:</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".$faltante."&nbsp;</td></tr>";

        //    $html .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;Efectivo Bs:</td>";

        //    $html .= "</tr>";
        $html .= "</table>";
        $html .= "</td></tr>";
    }
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";

    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function reporteCliente($idcliente, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> CLIENTE";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    // $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT
              ticli.nombre AS tipo,
              alm.nombre AS almacen,
              cli.nombre,
              cli.telefono,
              cli.direccion,
              cli.estado
            FROM
              tipo_clientes ticli,
              almacenes alm,
              clientes cli
            WHERE
              cli.idtipocliente = ticli.idtipocliente AND
              cli.idalmacen = alm.idalmacen AND
              cli.idcliente = '$idcliente'";
    $producto = dibujarTablaOfSQLNormal($sql, "Informacion Cliente");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    $sqlCar = "SELECT
  kc.observacion,
  kc.fecha,
  kc.deposito,
  kc.retiro,
  kc.saldo
FROM
  kardexcliente kc,
  cliente c
WHERE
  c.idcliente = kc.idcliente AND
  kc.idcliente = '$idcliente'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Kardex de Cliente");
    $html .= $carac['resultado'];
    $html .="<br>";
    /*$sqlKar = "SELECT cu.codigo AS codigo,cu.montoactual AS monto Actual,cu.fecha,a.nombre AS almacen FROM cuenta cu,almacenes a,cliente c
    WHERE cu.idcliente=c.idcliente AND cu.idalmacen=a.idalmacen AND cu.idcliente = '$idcliente'";
    $kardex = dibujarTablaOfSQLNormal($sqlKar, "Cuenta");
    $html .= $kardex['resultado'];*/
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='3'>";
    $sqlInv = "SELECT
  a.nombre AS Almacen,
  v.fecha,
  v.hora,
  v.cajero AS vendedor,
  tv.nombre AS Tipo,
  v.montototal AS Monto
FROM
  almacenes a,
  ventas v,
  tipoventa tv,
  cliente c
WHERE
  v.idalmacen = a.idalmacen AND
  c.idcliente = v.idcliente AND
  v.idcliente = 'cli-1000'
ORDER BY
  v.fecha DESC";
    $inventario = dibujarTablaOfSQLNormal($sqlInv, "Compras Realizadas por el Cliente");
    $html .= $inventario['resultado'];
    $html .= "</td></tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}


function detalleColeccion($idcoleccion, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";


    $sql1= "SELECT
  col.codigo,
  mar.imagen
FROM
  coleccion col,
  marcas mar
WHERE
  col.idmarca = mar.idmarca AND
  col.idcoleccion = '$idcoleccion'";
    //            MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
    $codigo = $ven[0]['codigo'];
    $imagen = $ven[0]['imagen'];
    $fecha = Date("Y-m-d");
    $time = date("h:i:s");
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "DETALLE <br>DE<br> COLECCION";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven1[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Codigo Coleccion:<dd>".$codigo."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Fecha:<dd>".$fecha."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Hora: <dd>".$time."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Imagen:</td><td style='width:450px;'>".$imagen."</td></tr>";
    $html .="<br>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $sqlIV = "
               SELECT
  carac.descripcionmaterial,
  carac.descripcioncolor,
  mode.stylename,
  li.numero
FROM
  caracteristicas carac,
  modelos mode,
  lineas li,
  calzados calz,
  coleccion cole
WHERE
  calz.idcaracteristica = carac.idcaracteristica AND
  mode.idlinea = li.idlinea AND
  calz.idmodelo = mode.idmodelo AND
  mode.idcoleccion = cole.idcoleccion AND
  cole.idcoleccion = '$idcoleccion'
                ";
    //         $totalDescuento = $ven[0]['descuento'];
    // $table =
    //    MostrarConsulta($sqlIV);
    $table = dibujarTablaOfSQL($sqlIV, $tc);
    //    $table = dibujarTablaOfSQL($sqlIV, "Productos");
    //    $table = dibujarTuplaOfSQLNormal($sqlIV, "Informacion del producto");
    $html .="<br>";
    $html .="<br>";
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td></tr>";
    // $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
    // $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta :</td><td style='width:75px;text-align:right;'>".$montoapagar."</td></tr>";
    //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}



function detalleModelo($idmarca, $return)
{
    //hoooooooooooooooooooooooo
    $html = "";


    $sql1= "SELECT

  mar.imagen
FROM

  marcas mar
WHERE
  mar.idmarca  = '$idmarca'";
    //            MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];

    $imagen = $ven[0]['imagen'];
    $fecha = Date("Y-m-d");
    $time = date("h:i:s");
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "DETALLE <br>DE<br> COLECCION";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven1[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Codigo Coleccion:<dd>".$codigo."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Fecha:<dd>".$fecha."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Hora: <dd>".$time."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Imagen:</td><td style='width:450px;'>".$imagen."</td></tr>";
    $html .="<br>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $sqlIV = "
          SELECT
  mo.codigo,
  mo.stylename,
  mo.detalle,
  li.codigo AS linea,
  co.codigo AS coleccion
FROM
  modelos mo,
  `coleccion` co,
  `lineas` li
WHERE
  mo.idcoleccion = co.idcoleccion AND
  mo.idlinea = li.idlinea AND
  mo.idmarca = '$idmarca'
                ";
    //         $totalDescuento = $ven[0]['descuento'];
    // $table =
    //    MostrarConsulta($sqlIV);
    $table = dibujarTablaOfSQL($sqlIV, $tc);
    //    $table = dibujarTablaOfSQL($sqlIV, "Productos");
    //    $table = dibujarTuplaOfSQLNormal($sqlIV, "Informacion del producto");
    $html .="<br>";
    $html .="<br>";
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    //$html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td></tr>";
    // $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
    // $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta :</td><td style='width:75px;text-align:right;'>".$montoapagar."</td></tr>";
    //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}
function DetalleIngresoHTML($idingreso, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> INGRESO A ALMACEN";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT pe.numerofactura, pe.fecha, pe.observacion, pe.totalpares, pe.totalcajas, pe.montototal, pe.estado, ma.opcion, ma.nombre AS marca, u.nombre AS responsable
FROM `ingresoalmacen` pe, `pedidos` ped, `marcas` ma, `usuario` u
WHERE pe.idpedido = ped.idpedido
AND ped.idmarca = ma.idmarca
AND pe.responsable = u.idusuario AND pe.idingreso = '$idingreso'";
    $proveedor = dibujarTuplaOfSQLNormal($sql, "Informacion del Ingreso");
    $html .= $proveedor['resultado'];

    $sql = "
SELECT mar.nombre AS marca, mdd.codigo AS modelo, kar.totalpares AS pares, kar.totalcajas AS cajas, kar.totalbs AS montototal,kar.idcliente AS cliente,kar.idvendedor AS vendedor
FROM `detalleingresoalmacen` kar, `modelos` mdd, `marcas` mar
WHERE kar.idmodelo = mdd.idmodelo
AND mdd.idmarca = mar.idmarca
AND kar.idingreso ='$idingreso'
";

    $proveedor = dibujarTablaOfSQLNormal($sql, "Detalle");
    $html .= $proveedor['resultado'];
    //    $html .= "</td>";
    //    $html .= "</tr>";
    //
    //    $html .= "<tr>";
    //
    //    $html .= "<td>";
    //    $html .= "</td>";
    //
    //    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />
         Telf.
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}

function reporteClienteCredito($idcliente, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> CREDITO";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT c.numero, cm.nombre AS comunidad, t.nombre AS tipo, c.nombre, c.apellido1, c.apellido2, c.nit, c.telefono, c.celular, c.email,
     c.direccion, a.nombre AS almacen FROM cliente c, comunidades cm, tipocliente t,almacenes a WHERE c.idcomunidad = cm.idcomunidad AND c.idalmacen=a.idalmacen
     AND c.idtipocliente = t.idtipocliente AND c.idcliente = '$idcliente'";
    $producto = dibujarTuplaOfSQLNormal($sql, "Informacion del Cliente");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";
    //$sqlCar = "SELECT  kc.observacion, kc.fecha,kc.deposito, kc.retiro,kc.saldo FROM cliente c, kardexcliente kc WHERE c.idcliente = kc.idcliente AND kc.idcliente  = '$idcliente'";
    //$carac = dibujarTablaOfSQLNormal($sqlCar, "Kardex de Cliente");
    //$html .= $carac['resultado'];
    //$html .="<br>";here
    $sqlKar = "SELECT

                  cr.idcredito AS codigo,
                  cr.idventa AS venta,
                  cr.fecha,
                  cr.hora,
                  cr.tiempo AS plazo,
                  cr.montototal,
                  mc.saldo
                FROM
                  credito cr,
                  movimientocredito mc,
                  cliente c,
                  ventas v
                WHERE
                  c.idcliente = cr.idcliente AND
                  cr.idventa = v.idventa AND
                  mc.idcredito = cr.idcredito AND
                  cr.idcliente = '$idcliente'
            ";
    $kardex = dibujarTablaOfSQLNormal($sqlKar, "Creditos");
    $html .= $kardex['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}



function reporteTraspaso($idtraspaso, $return)
{
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "REPORTE <br>DE<br> TRASPASO";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT a.codigo AS Codigo,a.nombre AS AlmacenOrigen, t.almacendestino AS AlmacenDestino ,t.fecha, t.numerodocumento AS documento
    FROM almacenes a, traspaso t  WHERE t.idalmacen=a.idalmacen AND t.idtraspaso = '$idtraspaso'";
    $proveedor = dibujarTuplaOfSQLNormal($sql, "Informacion del Traspaso");
    $html .= $proveedor['resultado'];

    $sql = "
SELECT
  prod.nombre,
  prod.codigo,
  dtr.cantidad,
  tra.almacendestino,
  tra.fecha
FROM
  traspaso tra,
  detalletraspaso dtr,
  productos prod
WHERE
  prod.idproducto = dtr.idproducto AND
  tra.idtraspaso = dtr.idtraspaso AND
  tra.idtraspaso = '$idtraspaso'
";

    $proveedor = dibujarTablaOfSQLNormal($sql, "Detalle");
    $html .= $proveedor['resultado'];
    //    $html .= "</td>";
    //    $html .= "</tr>";
    //
    //    $html .= "<tr>";
    //
    //    $html .= "<td>";
    //    $html .= "</td>";
    //
    //    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />
         Telf.
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}




function reporteProforma($idproforma, $return)
{

    $html = "";
    $sql = "
SELECT
  pr.idproforma,
  pr.fecha,
  pr.nombre,
  pr.nit,
  pr.montototal,
  pr.descuento,
  pr.montoapagar,
  pr.validez,
  pr.referencia,
  pr.numero,
  CONCAT(usr.nombre,' ', usr.apellido1,' ',usr.apellido2) AS cajero

FROM
  proforma pr,
  usuario usr
WHERE
  pr.idproforma = '$idproforma' AND
  pr.idusuario = usr.idusuario
";


    $datos = getTablaToArrayOfSQL($sql);



    if($datos['error'] == "false")
    {
        echo "No existe esta ventaA";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la monedad */
        $totalMonto = $ven[0]['montototal'];
        //        $totalCredito = $ven[0]['descuento'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['montoapagar'];
        $fecha = $ven[0]['fecha'];
        $cajero = $ven[0]['cajero'];



        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        $totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "<h2>PROFORMA</h2><br>";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idproforma']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Cliente:</td><td style='width:500px;' >".$ven[0]['nombre']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numero']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Nit o CI:</td><td>".$ven[0]['nit']."</td><td style='font-size:11px;font-weight:bold;'>Validez</td><td>".$ven[0]['validez']." Dias.</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Telefono:</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "

SELECT
  itm.cantidad,
  itm.precio,
  pro.nombre,
  prv.nombre As proveedor,
  itm.total
FROM
  itemproforma itm,
  productos pro,
  proveedores prv
WHERE
  itm.idproducto = pro.idproducto AND
  pro.idproveedor = prv.idproveedor AND
  itm.idproforma = '$idproforma'
";

        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>Proforma Valida Con Sello y Firma.</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>$cajero</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalNeto."</td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}

function dibujarTablaOfSQLNormaltotales($sql, $titulo = "ninguno", $tmonto)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras
                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    if($pie != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Totales</td><td></td><td></td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tmonto</td><td></td><td></td><td></td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tcajas</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tpares</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-center:right;background-color:silver;'>$tsus</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tdesc</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'></td>";
                    $devS .= "</tr>";
                    //$devS .= "</table>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaOfSQLNormal($sql, $titulo = "ninguno")
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
 if($pie != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Totales</td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tcajas</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tpares</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-center:right;background-color:silver;'>$tsus</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tdesc</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tmonto</td>";
                    $devS .= "</tr>";

                    //$devS .= "</table>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfSQLNormalSimple($sql, $titulo = "ninguno")
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
 if($pie != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";
                    }
                    //$devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Totales</td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tcajas</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tpares</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-center:right;background-color:silver;'>$tsus</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tdesc</td><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:15px;text-align:center;background-color:silver;'>$tmonto</td>";
                    //$devS .= "</tr>";

                    //$devS .= "</table>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}


function dibujarTablatotalOfSQLNormal($sql, $titulo = "ninguno",$pie = "ninguno")
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                        //           $devvS .= "<td><td colspan='".(mysql_num_fields($re)-1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$total</td></tr>";

                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";
                    //                   $devvS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //dibujamos pie
                    if($pie != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function generarSalidaMaterialMediaCartaChorro($idalmacen, $return)
{
    $html = "";
    $sql = "SELECT
  v.idalmacen,
  v.codigo,
  v.nombre,
  v.responsable,
  v.direccion,
  v.telefono
FROM
  almacenes v
WHERE
  v.idalmacen = '$idalmacen'";
    $datos = getTablaToArrayOfSQL($sql);
    //echo $datos['error'];
    if($datos['error'] == "false")
    {
        echo "No existe esta venta";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la monedad */
        $totalMonto = $ven[0]['bruta'];
        $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['neto'];
        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        $totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "SALIDA <br>DE<br> MATERIAL";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/logo/codigo.png'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idalmacen']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Cliente:</td><td style='width:500px;' >".$ven[0]['nomCliente']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numeroimpresion']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Direccion:</td><td>".$ven[0]['direccion']."</td><td style='font-size:11px;font-weight:bold;'>T/C (Bs/".$ven[0]['codigo'].")</td><td>".$tc."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Telefono:</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['nombre']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['telefono']."</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT v.idalmacen, v.codigo,v.nombre AS nomCliente,v.responsable,v.direccion,v.telefono FROM almacenes v WHERE v.idalmacen = '$idalamcen'";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observaciones']."</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalNeto."</td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Balderrama V 1.0 Kernel SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}

function generarCompraMediaCartaChorro($idventa, $return)
{
    $html = "";
    $sql = "SELECT
  v.idventa,
  v.observaciones,
  v.nombre AS nomCliente,
  u.login,
  v.numeroimpresion,
  ci.idpiepagina,
  v.idcliente,
  p.idpago,
  p.bruta,
  p.descuento,
  p.neto,
  p.credito,
  m.nombre AS moneda,
  m.abreviacion,
  v.fecha,
  v.hora,
  tcm.monto,
  men.link
FROM
  venta v,
  usuario u,
  configimpresion ci,
  pago p,
  moneda m,
  tipocambio_moneda tcm,
  tipocambio tc,
  `membrete` men
WHERE
  v.idventa = '$idventa' AND
  v.idcajero = u.idusuario AND
  v.idreport = ci.idconfjasper AND
  v.idpago = p.idpago AND
  p.idmoneda = m.idmoneda AND
  p.idtipocambio = tc.idtipocambio AND
  tc.idtipocambio = tcm.idtipocambio AND
  tcm.idmoneda = m.idmoneda AND
  ci.idmembrete = men.idmembrete";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta compra";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la monedad */
        $totalMonto = $ven[0]['bruta'];
        $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['neto'];
        $tc = $ven[0]['monto'];;

        $totalMonto = $totalMonto/$tc;
        $totalCredito = $totalCredito/$tc;
        $totalDescuento = $totalDescuento/$tc;
        $totalNeto = $totalNeto/$tc;

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        $totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

        /*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "SALIDA <br>DE<br> MATERIAL";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Cliente:</td><td style='width:500px;' >".$ven[0]['nomCliente']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numeroimpresion']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Direccion:</td><td>".$ven[0]['direccion']."</td><td style='font-size:11px;font-weight:bold;'>T/C (Bs/".$ven[0]['abreviacion'].")</td><td>".$tc."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Telefono:</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";

        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT p.codigo,  p.nombre, iv.cantidad, u.nombre AS unidad, iv.precio, iv.cantidad*iv.precio AS importe  FROM itemventa iv, producto p, unidad u WHERE iv.idventa = '$idventa' AND iv.idproducto = p.idproducto AND p.idunidad = u.idunidad";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observaciones']."</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalNeto."</td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Selkis V 1.0 Kernel SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }
}
function PreventaMediaCartaChorro($idventa, $return)
{
    $html = "";
    $sql = "SELECT
  v.idventa,
  v.observaciones,
  v.nombre AS nomCliente,
  u.login,
  v.numeroimpresion,
  ci.idpiepagina,
  v.idcliente,
  p.idpago,
  p.bruta,
  p.descuento,
  p.neto,
  p.credito,
  m.nombre AS moneda,
  m.abreviacion,
  v.fecha,
  v.hora,
  tcm.monto,
  men.link
FROM
  venta v,
  usuario u,
  configimpresion ci,
  pago p,
  moneda m,
  tipocambio_moneda tcm,
  tipocambio tc,
  `membrete` men
WHERE
  v.idventa = '$idventa' AND
  v.idusuario = u.idusuario AND
  v.idreport = ci.idconfjasper AND
  v.idpago = p.idpago AND
  p.idmoneda = m.idmoneda AND
  p.idtipocambio = tc.idtipocambio AND
  tc.idtipocambio = tcm.idtipocambio AND
  tcm.idmoneda = m.idmoneda AND
  ci.idmembrete = men.idmembrete";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta venta";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la monedad */
        $totalMonto = $ven[0]['bruta'];
        $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['neto'];
        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        $totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "PREVENTA";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Cliente:</td><td style='width:500px;' >".$ven[0]['nomCliente']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numeroimpresion']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Direccion:</td><td>".$ven[0]['direccion']."</td><td style='font-size:11px;font-weight:bold;'>T/C (Bs/".$ven[0]['abreviacion'].")</td><td>".$tc."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Telefono:</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT p.codigo,  p.nombre, iv.cantidad, u.nombre AS unidad, iv.precio, iv.cantidad*iv.precio AS importe  FROM itemventa iv, producto p, unidad u WHERE iv.idventa = '$idventa' AND iv.idproducto = p.idproducto AND p.idunidad = u.idunidad";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observaciones']."</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalNeto."</td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Selkis V 1.0 Kernel SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}
function CompraMediaCartaChorro($idcompra, $return)
{
    $html = "";
    $sql = "SELECT
  c.idcompra,
  c.observaciones,
  c.nombre AS nomCliente,
  u.login,
  c.numeroimpresion,
  ci.idpiepagina,
  c.idproveedor,
  p.idpago,
  p.bruta,
  p.descuento,
  p.neto,
  p.credito,
  m.nombre AS moneda,
  m.abreviacion,
  c.fecha,
  c.hora,
  tcm.monto,
  men.link
FROM
  compra c,
  usuario u,
  configimpresion ci,
  pago p,
  moneda m,
  tipocambio_moneda tcm,
  tipocambio tc,
  `membrete` men
WHERE
  c.idcompra = '$idcompra' AND
  c.idusuario = u.idusuario AND
  c.idreport = ci.idconfjasper AND
  c.idpago = p.idpago AND
  p.idmoneda = m.idmoneda AND
  p.idtipocambio = tc.idtipocambio AND
  tc.idtipocambio = tcm.idtipocambio AND
  tcm.idmoneda = m.idmoneda AND
  ci.idmembrete = men.idmembrete";
    $datos = getTablaToArrayOfSQL($sql);
    if($datos['error'] == "false")
    {
        echo "No existe esta venta";
        exit;
    }
    else
    {
        $ven = $datos["resultado"];
        /*aqui modificamos los campos segun la monedad */
        $totalMonto = $ven[0]['bruta'];
        $totalCredito = $ven[0]['credito'];
        $totalDescuento = $ven[0]['descuento'];
        $totalNeto = $ven[0]['neto'];
        $tc = $ven[0]['monto'];;

        //        $totalMonto = $totalMonto/$tc;
        //        $totalCredito = $totalCredito/$tc;
        //        $totalDescuento = $totalDescuento/$tc;
        //        $totalNeto = $totalNeto/$tc;

        $totalMonto = redondear($totalMonto, $_SESSION['usrDigitos']);
        $totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);
        $totalNeto = redondear($totalNeto, $_SESSION['usrDigitos']);

/*aqui modificamos los campos segun la monedad */


        $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= "<title></title>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
        $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
        //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr>";
        $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
        $html .= "</td>";
        $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
        $html .= "COMPRA <br>DE<br> PRODUCTOS";
        $html .= "</td>";
        $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
        $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
        $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Proveedor:</td><td style='width:500px;' >".$ven[0]['nomCliente']."</td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven[0]['numeroimpresion']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Direccion:</td><td>".$ven[0]['direccion']."</td><td style='font-size:11px;font-weight:bold;'>T/C (Bs/".$ven[0]['abreviacion'].")</td><td>".$tc."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Telefono:</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$ven[0]['fecha']."</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $sqlIV = "SELECT p.codigo,  p.nombre, ic.cantidad, u.nombre AS unidad, ic.precio, ic.cantidad*ic.precio AS importe  FROM itemcompra ic, producto p, unidad u WHERE ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto AND p.idunidad = u.idunidad";
        $table = dibujarTablaOfSQL($sqlIV, $tc);
        $html .= $table['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='3'>";
        $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
        $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Total Precio (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalMonto."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observaciones']."</td><td style='font-size:11px;font-weight:bold;'>Total Desc (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalDescuento."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Comprado por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
        $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta (".$ven[0]['abreviacion']."):</td><td style='width:75px;text-align:right;'>".$totalNeto."</td></tr>";
        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Selkis V 1.0 Kernel SRL</td></tr>";
        $html .= "</table>";
        $html .= "</td>";
        $html .= "</tr>";

        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";
        if($return == true)
        {
            return $html;
        }
        else
        {
            echo $html;
        }
    }

}
function reporteMovimientoProducto($idproductos, $codigoIni, $codigoFin, $ciudad, $sucursal, $almacen, $categoria, $usuario, $tipo, $fechaIni, $fechaFin, $return)
{
    $select = " m.fecha, p.nombre, m.detalle, m.cantidadentrada AS entr, m.cantidadsalida AS salid, m.cantidadsaldo AS saldo, u.login, a.nombre, m.costounitario AS costo, m.valoradoingreso AS ventra, m.valoradoegreso AS vsalid, m.valoradosaldo AS vsaldo ";
    $from = " movimiento m, usuario u, almacen a, kardex k, producto p ";
    $where = "  m.idusuario = u.idusuario AND m.idalmacen = a.idalmacen AND m.idkardex = k.idkardex AND k.idproducto = p.idproducto ";
    if($idproductos != null && $idproductos != "")
    {
        $ids = split(",", $idproductos);
        $where .= " AND ( ";
        for($i = 1; $i< count($ids); $i++)
        {
            if($i == 1)
            {
                $where .= " k.idproducto = '".$ids[$i]."' ";
            }
            else
            {
                $where .= " OR k.idproducto = '".$ids[$i]."' ";
            }
        }
        $where .= " ) ";
    }
    else
    {
        if($ciudad != "Todos")
        {
            if($sucursal != "Todos")
            {
                if($almacen != "Todos")
                {
                    $where .= " AND a.idalmacen = '$almacen' ";
                }
                else
                {
                    $from .= " , sucursal s ";
                    $where .= " AND a.idsucursal = s.idsucursal AND s.idsucursal = '$sucursal' ";
                }
            }
            else
            {
                $from .= " , sucursal s, ciudad c ";
                $where .= " AND a.idsucursal = s.idsucursal AND s.idciudad = c.idciudad AND c.idciudad = '$ciudad' ";
            }
        }
        if($categoria != "Todos")
        {
            if($subcategoria != "Todos")
            {
                $from .= " , subcategoria sub ";
                $where .= " AND p.idsubcategoria = sub.idsubcategoria AND sub.idsubcategoria = '$subcategoria' ";
            }
            else
            {
                $from .= " , categoria cat, subcategoria sub ";
                $where .= " AND p.idsubcategoria = sub.idsubcategoria AND sub.idcategoria = cat.idcategoria AND cat.idcategoria = '$categoria' ";
            }
        }
    }
    if($usuario != "Todos")
    {
        $where .= " AND m.idusuario = '$usuario' ";
    }
    if($tipo == "Salidas")
    {
        $where .= " AND m.cantidadsalida > 0 ";
    }
    if($tipo == "Entradas")
    {
        $where .= " AND m.cantidadentrada > 0 ";
    }
    if($fechaIni != null && $fechaIni != "")
    {
        $where .= " AND m.fecha >= '$fechaIni' ";
    }

    if($fechaFin != null && $fechaFin != "")
    {
        $where .= " AND m.fecha <= '$fechaFin' ";
    }
    $sql = "SELECT $select FROM $from WHERE $where ORDER BY p.nombre ASC, m.fecha DESC";
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "MOVIMIENTO <br>DE<br> PRODUCTOS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlIV = "SELECT p.codigo,  p.nombre, ic.cantidad, u.nombre AS unidad, ic.precio, ic.cantidad*ic.precio AS importe  FROM itemcompra ic, producto p, unidad u WHERE ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto AND p.idunidad = u.idunidad";
    $table = dibujarTablaOfSQL($sql, $tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function reporteKardexProducto($idproductos, $codigoIni, $codigoFin, $ciudad, $sucursal, $almacen, $categoria, $subcategoria, $usuario, $tipo, $fechaIni, $fechaFin, $return)
{
    $select = " m.fecha, p.nombre, m.detalle, m.cantidadentrada AS entr, m.cantidadsalida AS salid, m.cantidadsaldo AS saldo, u.login, a.nombre, m.costounitario AS costo, m.valoradoingreso AS ventra, m.valoradoegreso AS vsalid, m.valoradosaldo AS vsaldo ";
    $from = " movimiento m, usuario u, almacen a, kardex k, producto p ";
    $where = "  m.idusuario = u.idusuario AND m.idalmacen = a.idalmacen AND m.idkardex = k.idkardex AND k.idproducto = p.idproducto ";
    if($idproductos != null && $idproductos != "")
    {
        $ids = split(",", $idproductos);
        $where .= " AND ( ";
        for($i = 1; $i< count($ids); $i++)
        {
            if($i == 1)
            {
                $where .= " k.idproducto = '".$ids[$i]."' ";
            }
            else
            {
                $where .= " OR k.idproducto = '".$ids[$i]."' ";
            }
        }
        $where .= " ) ";
    }
    else
    {
        if($ciudad != "Todos")
        {
            if($sucursal != "Todos")
            {
                if($almacen != "Todos")
                {
                    $where .= " AND a.idalmacen = '$almacen' ";
                }
                else
                {
                    $from .= " , sucursal s ";
                    $where .= " AND a.idsucursal = s.idsucursal AND s.idsucursal = '$sucursal' ";
                }
            }
            else
            {
                $from .= " , sucursal s, ciudad c ";
                $where .= " AND a.idsucursal = s.idsucursal AND s.idciudad = c.idciudad AND c.idciudad = '$ciudad' ";
            }
        }
        if($categoria != "Todos")
        {
            if($subcategoria != "Todos")
            {
                $from .= " , subcategoria sub ";
                $where .= " AND p.idsubcategoria = sub.idsubcategoria AND sub.idsubcategoria = '$subcategoria' ";
            }
            else
            {
                $from .= " , categoria cat, subcategoria sub ";
                $where .= " AND p.idsubcategoria = sub.idsubcategoria AND sub.idcategoria = cat.idcategoria AND cat.idcategoria = '$categoria' ";
            }
        }
    }
    if($usuario != "Todos")
    {
        $where .= " AND m.idusuario = '$usuario' ";
    }
    if($tipo == "Salidas")
    {
        $where .= " AND m.cantidadsalida > 0 ";
    }
    if($tipo == "Entradas")
    {
        $where .= " AND m.cantidadentrada > 0 ";
    }
    if($fechaIni != null && $fechaIni != "")
    {
        $where .= " AND m.fecha >= '$fechaIni' ";
    }

    if($fechaFin != null && $fechaFin != "")
    {
        $where .= " AND m.fecha <= '$fechaFin' ";
    }
    $sql = "SELECT $select FROM $from WHERE $where ORDER BY p.nombre ASC, m.fecha DESC";
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "MOVIMIENTO <br>DE<br> PRODUCTOS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sqlIV = "SELECT p.codigo,  p.nombre, ic.cantidad, u.nombre AS unidad, ic.precio, ic.cantidad*ic.precio AS importe  FROM itemcompra ic, producto p, unidad u WHERE ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto AND p.idunidad = u.idunidad";
    $table = dibujarTablaOfSQL($sql, $tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}



function  reporteProductos($categoria, $subcategoria, $codigo, $nombre,$marca, $medida,$cantidad,$almacen, $sucursal, $ciudad,$return = true)
{

    //http:localhost/web/php/dao/ReporteHTML.php?function=reporteProductos&categoria=Todos&subcategoria=Todos&codigo=""&nombre=""&marca=""&medida=""&cantidad=""&almacen=Todos&sucursal=Todos&ciudad=Todos

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

    $select = "p.idproducto, p.codigo, p.codigofabrica, p.nombre, m.nombre AS marca, ps.nombre AS pais, p.preciobs1, p.preciosus1, u.nombre AS unidad ";
    $from = " producto p, marca m, pais ps, unidad u ";
    $where = " p.idmarca = m.idmarca AND p.idpais = ps.idpais AND p.idunidad = u.idunidad ";
    if($ciudad != "Todos" && $ciudad != null && $ciudad != "")
    {
        if($sucursal != "Todos" && $sucursal != null && $sucursal != "")
        {
            if($almacen != "Todos" && $almacen != null && $almacen != "")
            {
                $from .= ", almacen a, productoalmacen pa";
                $where .= " AND a.idalmacen = pa.idalmacen AND pa.idproducto = p.idproducto AND a.idalmacen = '$almacen'";
                if($cantidad != NULL && $cantidad != "")
                {
                    $where .= " AND (pa.cantidad $cantidad)";
                }
                $select .= ", pa.cantidad AS cantidad ";
            }
            else
            {
                if($cantidad != NULL && $cantidad != "")
                {
                    // $where .= " AND (SELECT SUM(pa.cantidad) AS cantidad FROM productoalmacen ppa, almacen aaa
                    //WHERE ppa.idalmacen = aaa.idalmacen AND aaa.idsucursal = s.idsucursal) $cantidad ";
                    $where .= " AND cantidad $cantidad";
                }
                $select .= ", (SELECT SUM(ppa.cantidad) AS cantidad FROM productoalmacen ppa, almacen aaa
 WHERE ppa.idalmacen = aaa.idalmacen AND aaa.idsucursal = '$sucursal') AS cantidad  ";
                $from .= ", almacen a, sucursal s, productoalmacen pa";
                $where .= " AND a.idalmacen = pa.idalmacen AND pa.idproducto = p.idproducto AND a.idsucursal = s.idsucursal AND s.idsucursal = '$sucursal'";
            }
        }
        else
        {
            if($cantidad != NULL && $cantidad != "")
            {
                // $where .= " AND (SELECT SUM(pa.cantidad) AS cantidad FROM productoalmacen ppa, almacen aaa
                //WHERE ppa.idalmacen = aaa.idalmacen AND aaa.idsucursal = s.idsucursal) $cantidad ";
                $where .= " AND cantidad $cantidad";
            }
            $select .= ", (SELECT SUM(ppa.cantidad) AS cantidad FROM productoalmacen ppa, almacen aaa, sucursal sss
 WHERE ppa.idalmacen = aaa.idalmacen AND aaa.idsucursal = sss.idsucursal AND sss.idciudad = '$ciudad') AS cantidad  ";
            $from .= ", almacen a, sucursal s, ciudad c, productoalmacen pa";
            $where .= " AND a.idalmacen = pa.idalmacen AND pa.idproducto = p.idproducto AND a.idsucursal = s.idsucursal AND s.idciudad = c.idciudad AND c.idciudad = '$ciudad'";
        }
    }
    else
    {
        if($cantidad != NULL && $cantidad != "")
        {
            // $where .= " AND (SELECT SUM(pa.cantidad) AS cantidad FROM productoalmacen ppa, almacen aaa
            //WHERE ppa.idalmacen = aaa.idalmacen AND aaa.idsucursal = s.idsucursal) $cantidad ";
            $where .= " AND k.cantidadsaldo $cantidad";
        }
        $select .= ", k.cantidadsaldo AS cantidad ";
        $from .= ", kardex k ";
        $where .= " AND p.idkardex = k.idkardex ";
    }
    if($categoria != "Todos" && $categoria != null && $categoria != "")
    {
        if($subcategoria != "Todos" && $subcategoria != null && $subcategoria != "")
        {
            $from .= ", subcategoria sb";
            $where .= " AND p.idsubcategoria = sb.idsubcategoria AND sb.idsubcategoria = '$subcategoria'";
        }
        else
        {
            $from .= ", subcategoria sb, categoria ct";
            $where .= " AND p.idsubcategoria = sb.idsubcategoria AND sb.idcategoria = ct.idcategoria AND ct.idcategoria = '$categoria'";
        }
    }
    if($codigo != null && $codigo != "")
    {
        $where .= " AND p.codigo LIKE '%$codigo%' ";
    }
    if($nombre != null && $nombre != "")
    {
        $where .= " AND p.nombre LIKE '%$nombre%' ";
    }

    if($marca != null && $marca != "")
    {
        $where .= " AND m.nombre LIKE '%$marca%' ";
    }

    //    if($star == 0 && $limit == 0)
    //    {
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    }
    //    else
    //    {
    //        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    //    }

    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "LISTA <br>DE<br> PRODUCTOS";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";

    $html .= "<tr>";
    $html .= "<th >Ciudad:</td>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$ciudad</th>";
    $html .= "<th >Almacen:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$almacen</th>";
    $html .= "<th >Subcat:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$subcategoria</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Cantidad:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$cantidad</th>";
    $html .= "<th >Marca:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$marca</th>";
    $html .= "<th >Sucursal:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$sucursal</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Categoria:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$categoria</th>";
    $html .= "<th >Codigo:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$codigo</th>";
    $html .= "<th >Nombre:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$nombre</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >Medida:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$medida</th>";
    $html .= "</tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $table = dibujarTablaOfSQL($sql,$tc);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function reporteLibroMayor($idcuenta, $codigoIni, $codigoFin, $fechaIni, $fechaFin, $idmoneda, $opcion, $glosa, $return)
{
    $sql = "SELECT $select FROM $from WHERE $where ORDER BY v.fecha ASC ";
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION["empresa"]."/".$ven[0]['link']."'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $html .= "LIBRO MAYOR <br> DETALLADO";
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    $html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/dao/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>".$ven[0]['idventa']."<td><tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";

    $html .= "<tr>";
    $html .= "<th >Desde:</td>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$codigoIni</th>";
    $html .= "<th >Hasta:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$codigoFin</th>";
    $html .= "<th >Fecha Ini:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechaIni</th>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<th >FechaFin:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechaFin</th>";
    $html .= "<th >Moneda:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$nombreMoneda</th>";
    $html .= "<th >Opcion:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$opcion</th>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Importadora Asia<br />
         Cochabamba - Bolivia<br />
         Telf. 4555651
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<td colspan='3'>";
    if($idcuenta != null && $idcuenta != "")
    {
        $ids = split(",", $idcuenta);
        for($i = 1; $i< count($ids); $i++)
        {
            $html .= reporteLibroMayorCuenta($ids[$i], $fechaIni, $fechaFin, $idmoneda, $opcion, $glosa, true);
        }
    }
    else
    {
        $sqlA = "SELECT idcuenta FROM cuenta c";
        $link = new BD;
        $link->conectar();
        $re = $link->consulta($sqlA);
        if($fi = mysql_fetch_array($re))
        {
            do{
                $html .= reporteLibroMayorCuenta($fi['idcuenta'], $fechaIni, $fechaFin, $idmoneda, $opcion, $glosa, true);
            }while($fi = mysql_fetch_array($re));
        }

    }
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";

    if($return == true)
    {
        return $html;
    }
    else
    {

        echo $html;
    }
}
function reporteLibroMayorCuenta($idcuenta, $fechaIni, $fechaFin, $idmoneda, $opcion, $glosa, $return)
{
    if($opcion != null && $opcion != "")
    {
        if($opcion== "detallado"){

            $select =" v.fecha, v.codigo, c.nombre, v.debe, v.haber, v.saldo ";
            $from = "vislibromayor v, cuenta c ";
            $where = " v.idcuenta = c.idcuenta ";
        }
        if($opcion== "mensual"){

            $select = "id.fecha, c.codigo, id.glosa, id.debe, id.haber, id.saldo";
            $from = "cuenta c, itemdocumento id, moneda m";
            $where = "c.idcuenta = id.idcuenta AND c.idcuenta='$idcuenta' ";
        }
    }
    if($fechaIni != null && $fechaIni != "")
    {
        $where .= " AND v.fecha >= '$fechaIni' ";
    }
    if($fechaFin != null && $fechaFin != "")
    {
        $where .= " AND v.fecha <= '$fechaFin' ";
    }


    $sql = "SELECT $select FROM $from WHERE v.idcuenta = '$idcuenta' AND $where ORDER BY v.fecha ASC ";
    $html = "";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;font-size:11px;font-weight:0;'>";
    //$html .= "<table border='1' width='100'>";

    $html .= "<tr>";
    $html .= "<th >Fecha Ini:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechaIni</th>";
    $html .= "<th >FechaFin:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$fechaFin</th>";
    $html .= "<th >Moneda:</th>";
    $html .= "<th style='text-align:left;border-left: 1px solid #000000;'>$nombreMoneda</th>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<td colspan='3'>";
    //$sqlIV = "SELECT p.codigo,  p.nombre, ic.cantidad, u.nombre AS unidad, ic.precio, ic.cantidad*ic.precio AS importe  FROM itemcompra ic, producto p, unidad u WHERE ic.idcompra = '$idcompra' AND ic.idproducto = p.idproducto AND p.idunidad = u.idunidad";
    $table = dibujarTablaOfSQL($sql, 1);
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";

    if($table['resultado'] == "")
    {
        $html = "";
    }


    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function dibujarTuplaOfSQLNormal($sql, $titulo = "ninguno")
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='2' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $dato = $fi[$i];
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $devS .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;".mysql_field_name($re, $i)."</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td></tr>";
                            }
                            else
                            {
                                $devS .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;".mysql_field_name($re, $i)."</td><td style='text-align:left;border-left: 1px solid #000000;'>&nbsp;".$dato."&nbsp;</td></tr>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function  CodigoBarraIngreso($idingreso,$return = true)
{


    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
    $sql1="
SELECT
  kar.idkardextienda,
  kar.idmodelodetalle,
  kar.idtienda,
  kar.codigobarra,
  kar.saldocantidad,
  kar.cantidad,
  kar.numero,
  kar.talla,
  mdd.codigo,
  mdd.stylename,
  mdd.color,
  mdd.material,
  kar.codigobarraean13
FROM
  `adicionkardextienda` kar,
  `modelodetalle` mdd
WHERE
  kar.idmodelodetalle = mdd.idmodelodetalle AND
  kar.idoperacion = '$idingreso'
";
//    echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
        $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];

        $codigomodelo = $codigo['codigo'];
        $stylename = $codigo['stylename'];
        $saldocantidad = $codigo['saldocantidad'];
        for($h=0;$h<$saldocantidad;$h++){
            if($j==3){
                $html .="</tr><tr>";
                $j=0;
            }

            $html .="
    <td width='33%'><div align='center'>
      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='></p>
      <p>Codigo : ".$codigomodelo."</p>
      <p>SytleName : ".$stylename." </p>
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function revisarreimpresion($idingreso, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
  // $proforma = $resultado->venta;
$emitida="1";
$sql2 = "SELECT
 generado
FROM
  ingresoalmacen
WHERE
  idingreso = '$idingreso'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'generado');
    $generado = $idalmacenA['resultado'];
    $nuevogenerado="1";
    if($generado=="0"){
        $sql[] = "UPDATE ingresoalmacen SET generado='$nuevogenerado' WHERE idingreso='$idingreso'";
       $sql[] = "UPDATE kardexalmacen SET generado='$nuevogenerado' WHERE idoperacion='$idingreso'";

    }
          // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

       $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = $respuesta;
        //$dev['resultado'] = $planilla;

    }
    else
    {
        $dev['mensaje'] = "";
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
       // print($output);
    }


}
function actualizardiferencia($idingreso,$return = false )
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
  // $proforma = $resultado->venta;
     $sql[] = "UPDATE modelo SET generado='1' WHERE idingreso='$idingreso';";
    // MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);

}


function  AdicionCodigoBarraIngreso($idingreso,$return = true)
{

actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql1 = "SELECT  ma.codigo,ma.formatomayor FROM ingresoalmacen i,marcas ma WHERE i.idmarca=ma.idmarca AND i.idingreso = '$idingreso' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
    $sql1="
SELECT kar.idkardexunico,kar.idkardex, kar.idmodelo, kar.idtienda, kar.codigobarra, kar.saldocantidad,
  kar.numero, mdd.codigo, kar.codigobarraean13,mdd.color,mdd.material,mdd.linea,col.detalle AS coleccion,kar.numerocajas
FROM `kardexcajas` kar, `modelo` mdd,`coleccion` col
WHERE kar.idmodelo = mdd.idmodelo and mdd.idcoleccion=col.idcoleccion
AND kar.idoperacion = '$idingreso'
";
  //  echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
        $idkardexunico = $codigo['idkardexunico'];
        $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
        $coleccion = $codigo['coleccion'];
       $color = $codigo['color'];
       $material = $codigo['material'];
       $linea = $codigo['linea'];
 $saldocantidad = $codigo['numerocajas'];
 $sql1 = "SELECT numeroparesfila FROM kardexcajas WHERE idkardexunico = '$idkardexunico' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'numeroparesfila');
   $numparesencaja = $idalmacenA['resultado'];
 $det1="";
switch($formatomayor){
    case '1':
        $dato1 = $coleccion."-".$codigomodelo;
        $dato2 = $material."-".$color;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="Dt";
        $det3="#pares";
    break;
    case '2':
         $det2="Md";
        //$det2="Dt";
        $det1="#pares";
        $dato2 = $codigomodelo."-".$material;
       $dato3 = $numparesencaja;
    break;
     case '3':
        $dato1 = $codigomodelo;
        $dato3 = $material."-".$color;
         $dato2 = $numparesencaja;
        $det1="Md";
        $det3="Dt";
        $det2="#pares";
    break;
       case '4':
            $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";

    break;
       case '5':
        $dato2 = $linea."-".$codigomodelo."-".$color;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '6':
        $dato2 = $linea."-".$codigomodelo."-".$color;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '7':
        $modelo = $codigomodelo."-".$color;
          $detalle = $material;
          $dato1 =$codigomodelo;
        $dato2 = $material;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="";
        $det3="#pares";
    break;
       case '8':
         $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '9':
         $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";

    break;
       case '10':
        $modelo = $codigomodelo."-".$color;
          $detalle = $material;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="";
        $det3="#pares";
    break;
}


        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
   ".$codmarca."
".$det1." : ".$dato1."<br />
".$det2.": ".$dato2."
".$det3." :".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function  AdicionCodigoBarraIngresoNike($idingreso,$return = true)
{
actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ingresoalmacen i,marcas ma WHERE i.idmarca=ma.idmarca AND i.idingreso = '$idingreso' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'opcionb');
   $opcionb = $idalmacenA['resultado'];

if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND karp.idingreso = '$idingreso' ORDER BY CAST(mdd.codigo as signed) asc,karp.idkardex asc,karp.talla asc
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp
WHERE karp.idmodelo = mdd.idmodelo AND karp.idingreso = '$idingreso' ORDER BY CAST(mdd.codigo as signed) asc,karp.idkardex asc,karp.talla asc
";
}
//echo $sql1;josue
//WHERE karp.idmodelo = mdd.idmodelo AND karp.idingreso = '$idingreso' ORDER BY CAST(mdd.codigo as signed) asc,karp.idkardex,mdd.color asc,mdd.material ASC

//MODIFICAR ORDEN DE INGRESO
   //echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
       $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
       $color = $codigo['color'];
       $material = $codigo['material'];
 $talla = $codigo['talla'];
 $tipotalla = $codigo['tipotalla'];
  $saldocantidad = $codigo['saldocantidad'];
   $clientecompleto = $codigo['cliente'];
      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
//codigo cliente
 $material=substr($material,0,11);
  $color=substr($color,0,11);
//$anioplani=substr($planilla,2,5);

 $det1="";
switch($formatomayor){
     case '1':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
  case '6':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
   case '7':
       $marca=$codmarca;
          $dato1 =$codigomodelo."#".$talla;
        $dato2 = $material;
        // $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="";
         $det4=$cliente;
    break;
     case '10':
         $marca=$codmarca;
          $dato1 =$codigomodelo;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
      case '11':
          $marca=$codmarca;
          $dato1 =$codigomodelo."-".$tipotalla;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '16':
      $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
 case '4':
     $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '8':
         $marca="";
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '12':
         $marca=$codmarca;
           $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="";
        $det2="";
        $det3="#";
         $det4=$cliente;

    break;
   default:
       $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
       break;
}


        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
 ".$marca."
".$det1.":".$dato1."<br />
".$det2.":".$dato2."/".$det4."
".$det3.":".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function  vercodigobarra($idventa,$return = true)
{
//actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ventas i,marcas ma WHERE i.idmarca=ma.idmarca AND i.idventa = '$idventa' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'opcionb');
   $opcionb = $idalmacenA['resultado'];

if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, vi.cantidad as saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c,ventaitem vi
WHERE karp.idkardexunico=vi.idkardexunico and mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND vi.idventa = '$idventa' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra,  vi.cantidad as saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,ventaitem vi
WHERE karp.idkardexunico=vi.idkardexunico and karp.idmodelo = mdd.idmodelo AND vi.idventa = '$idventa' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}
//echo $sql1;

//MODIFICAR ORDEN DE INGRESO
   //echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
       $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
       $color = $codigo['color'];
       $material = $codigo['material'];
 $talla = $codigo['talla'];
 $tipotalla = $codigo['tipotalla'];
  $saldocantidad = $codigo['saldocantidad'];
   $clientecompleto = $codigo['cliente'];
      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
//codigo cliente
 $material=substr($material,0,11);
  $color=substr($color,0,11);
//$anioplani=substr($planilla,2,5);

 $det1="";
switch($formatomayor){

     case '1':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
  case '6':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
   case '7':
       $marca=$codmarca;
          $dato1 =$codigomodelo."#".$talla;
        $dato2 = $material;
        // $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="";
         $det4=$cliente;
    break;
     case '10':
         $marca=$codmarca;
          $dato1 =$codigomodelo;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
      case '11':
          $marca=$codmarca;
          $dato1 =$codigomodelo."-".$tipotalla;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '16':
      $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
 case '4':
     $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '8':
         $marca="";
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '12':
         $marca=$codmarca;
           $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="";
        $det2="";
        $det3="#";
         $det4=$cliente;

    break;
   default:
       $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
       break;
}


        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
 ".$marca."
".$det1.":".$dato1."<br />
".$det2.":".$dato2."/".$det4."
".$det3.":".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function  vercodigobarratraspaso($idtraspaso,$return = true)
{
//actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ventas i,marcas ma WHERE i.idmarca=ma.idmarca AND i.idventa = '$idventa' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'opcionb');
   $opcionb = $idalmacenA['resultado'];

if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, vi.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c,traspasodetallepar vi
WHERE karp.idkardexunico=vi.idkardexunico and mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND vi.iddetalletraspaso = '$idtraspaso' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra,  vi.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,traspasodetallepar vi
WHERE karp.idkardexunico=vi.idkardexunico and karp.idmodelo = mdd.idmodelo AND vi.iddetalletraspaso = '$idtraspaso' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}
//echo $sql1;

//MODIFICAR ORDEN DE INGRESO
   //echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
       $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
       $color = $codigo['color'];
       $material = $codigo['material'];
 $talla = $codigo['talla'];
 $tipotalla = $codigo['tipotalla'];
  $saldocantidad = $codigo['saldocantidad'];
   $clientecompleto = $codigo['cliente'];
      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
//codigo cliente
 $material=substr($material,0,11);
  $color=substr($color,0,11);
//$anioplani=substr($planilla,2,5);

 $det1="";
switch($formatomayor){

     case '1':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
  case '6':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
   case '7':
       $marca=$codmarca;
          $dato1 =$codigomodelo."#".$talla;
        $dato2 = $material;
        // $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="";
         $det4=$cliente;
    break;
     case '10':
         $marca=$codmarca;
          $dato1 =$codigomodelo;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
      case '11':
          $marca=$codmarca;
          $dato1 =$codigomodelo."-".$tipotalla;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '16':
      $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
 case '4':
     $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '8':
         $marca="";
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '12':
         $marca=$codmarca;
           $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="";
        $det2="";
        $det3="#";
         $det4=$cliente;

    break;
   default:
       $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
       break;
}


        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
 ".$marca."
".$det1.":".$dato1."<br />
".$det2.":".$dato2."/".$det4."
".$det3.":".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function AdicionDetalleIngresoHTML($idingreso, $return)
{
 $idtienda = $_SESSION['idtienda'];
     // echo "codigo".$idventadetalle;
    $html = "";
$sql1 = "
      SELECT
ved.codigo,ved.fecha,ved.totalpares,mar.nombre AS marca
FROM
   adicioningresotienda ved, marcas mar
WHERE
   ved.idmarca=mar.idmarca AND ved.idingreso = '$idingreso' ";

 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $numrecibo = $idalmacenA['resultado'];
   $idalmacenA1 =  findBySqlReturnCampoUnique($sql1, true, true, 'fecha');
   $fecha = $idalmacenA1['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql1, true, true, 'marca');
   $marca = $idalmacenA2['resultado'];
      $idalmacenA23 =  findBySqlReturnCampoUnique($sql1, true, true, 'totalpares');
   $totalpares = $idalmacenA23['resultado'];

//    $sql1 = " SELECT ved.numero,ved.fecha, ved.observacion,ved.nit,ved.hora,CONCAT( ved.nombrecliente, '-', ved.apellidocliente ) AS cliente,ved.idclienteempresa,ved.tipoventa, ved.cantidad, ved.totalbs AS total, ved.descuento, ved.montocancelado,ved.montoapagar, ved.montocanceladosus
//FROM ventasdetalle ved
//WHERE ved.idventadetalle = '$idventadetalle' "
//    ;
//               // MostrarConsulta($sql1);
    //$dato = getTablaToArrayOfSQL($sql1);
    //$ven = $dato["resultado"];
    // $numrecibo = $ven[0]['codigo'];


   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>";
 $html .= "CALZADOS BALDERRAMA CBBA<br>";
  $html .= "Dir. San Martin esq.  Uruguay N 0699<br>";
   $html .= "Tel 4504183  Fax 4128833<br>";
    $html .= "e-mail: calzaba@supernet.com.bo";
$html .= "</td>";
$html .= "<td style='width:100px;font-size:11px;font-weight:bold;'></td>";
//$html .= "<td align:'left'; style='width:10px;height:100px;border-bottom:0px solid #000000;text-align:left;font-size:20px;font-family:Tahoma;'>";
//    $html .= "NOTA   DE ENTREGA";
//   $html .= "</td>";
  $html .= "<td style='width:200px;'>";
  $html .= "NOTA   DE REGISTRO";
   $html .= "</td>";
  $html .= "</tr>";

  $html .= "<td style='width:200px;height:100px;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:200px;'>";
    //$html .= "<tr><td align='right'><img src='".$_SESSION["ruta"]."php/impl/codigo.jpg'><td><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'>";
    $html .= "<tr>";
    $html .= "<td>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;'></td><td style='width:75px;font-size:11px;font-weight:bold;'>Nro:</td><td style='width:75px;'>".$numrecibo."</td></tr>";



   $formatear = explode( '-' , $fecha);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<td></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
$html .= "<td style='font-size:11px;font-weight:bold;'>Marca:</td><td>".$marca."</td></tr>";

$html .= "<td style='font-size:11px;font-weight:bold;'>Por lo siguiente.....</td></tr>";
    $html .= "</table><br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $sql2 ="
SELECT iddetalleingreso
FROM adiciondetalleingreso
WHERE idingreso = '$idingreso'
";

  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'iddetalleingreso');
    $iddetalleingreso = $idalmacenA['resultado'];

 $sqlIV = "
SELECT mdd.codigo AS modelo, dtp.totalpares, dtp.totalbs AS Precio, dtp.color, col.codigo AS coleccion, es.nombre AS estilo
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND dtp.idingreso  = '$idingreso'


";
   // $inventario = dibujarTablaOfSQLNormal($sqlInv, "Inventario");
    //$html .= $inventario['resultado'];

     $sqlV = " SELECT
                                dtpt.talla,
                                dtpt.cantidad
                                FROM
                               `detalleventamayortalla` dtpt
                                WHERE
                                dtpt.idventamayordetalle = '$idventamayordetalle'
                                ";

    //         $totalDescuento = $ven[0]['descuento'];
    $table =
      // MostrarConsulta($sqlIV);
     // dibujarTablaOfSQLNormal

        $table = dibujarTablaOfSQLNormal($sqlIV, "Detalle de Ingreso");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
     $html .= "<tr>";
    $html .= "<td colspan='3'>";
     $sqlV = " SELECT
                                dtpt.talla,
                                dtpt.cantidad
                                FROM
                               `detalleventamayortalla` dtpt
                                WHERE
                                dtpt.idventamayordetalle = '$idventamayordetalle'
                                ";
   // echo $idventamayor;
 $table1 =
           $table1 = dibujarTablaOfSQL($sqlV, "Tallas");
         //  $table1 =  dibujarTuplaOfSQLNormal($sqlV, $titulo = "ninguno");

    $html .= $table1['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'><br>";
  //  $html .= "<td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($ven[0]['total'], $ven[0]['abreviacion'])."</td>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:11px;font-weight:bold;'> Descuento:</td><td style='width:75px;text-align:right;'>".$ven1[0]['descuento']."</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Total Venta :</td><td style='width:75px;text-align:right;'>".$montoapagar."</td></tr>";
    //        $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'>Foreground SRL</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
 $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cantidad Pares:</td><td>".$totalpares."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td>".$tc."</td></tr>";
//    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Monto Total Bs:</td><td>".$ven[0]['total']."</td></tr>";
//    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Descuento:</td><td>".$ven[0]['descuento']."</td></tr>";
//    $html .= "<td></td><td style='font-size:11px;font-weight:bold;'>Monto Cancelado Bs:</td><td>".$ven[0]['montocancelado']."</td></tr>";
// $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";
        $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$ven[0]['montoapagar']."</td></tr>";

   // $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente.....</td>";
    $html .= "</table><br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />

    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}

function verIngresosMarcaHTML($idmarca, $return)
{
    $select = "col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs AS Precio, dtp.totalpares AS StockActual, es.nombre As estilo";
    $from = "adiciondetalleingreso dtp, modelos mdd, coleccion col,estilos es";
    $where = "dtp.idmodelo = mdd.idmodelo AND mdd.stylename=es.idestilo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.idmarca='$idmarca' ";
//        $order .= " `col`.`anio` , `mdd`.`codigo` DESC";
     $order .= "idestilo";

 if($idestilo == null ||$idestilo == "null" )
    {

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
  }else {
   // $select .= " ,es.nombre ";

   $from .= " , estilos es ";
    $where .= " AND mdd.stylename = es.idestilo AND mdd.stylename = '$idestilo' ";
    }
   $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."order BY ".$order;

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
//echo $sqldetalle;
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $sql = "SELECT ma.nombre AS marca
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
   $sql1 = "SELECT  es.nombre AS estilo
FROM  estilos es
WHERE es.idestilo = '$idestilo'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'estilo');
   $estilolista = $idalmacenA['resultado'];
 if($idestilo == null ||$idestilo == "null" )
    {
$html .= "INVENTARIO $marcalista<br> Ingreso por marca";

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
  }else {
$html .= "INVENTARIO $marcalista<br> Ingreso por estilo $estilolista";

  }
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    //echo $sqldetalle;

    $proveedor = dibujarTablaOfSQLNormal($sqldetalle, "Detalle");
    $html .= $proveedor['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
  $select1 .= "SUM( dtp.totalpares ) AS TOTALPARES ";
  $from1 = "adiciondetalleingreso dtp, modelos mdd, coleccion col";
    $where1 = "dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND mdd.idmarca='$idmarca'";
if($idestilo == null ||$idestilo == "null" )
    {
//  $select .= "SUM( dtp.totalpares ) AS totalPares ";
  }else {
    $from1 .= " , estilos es ";
    $where1 .= " AND mdd.stylename = es.idestilo AND mdd.stylename = '$idestilo'";
    }
   $sqltotalpares = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
    $producto2 = dibujarTuplaOfSQLSimple($sqltotalpares);
    $html .= $producto2['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
        $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
  $select2 .= "SUM( dtp.totalbs * dtp.totalpares ) AS TOTALBS ";
   $sqltotalbs = "SELECT ".$select2." FROM ".$from1. " WHERE ".$where1;
    $producto21 = dibujarTuplaOfSQLSimple($sqltotalbs);
    $html .= $producto21['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
	 // $datosc = getTablaToArrayOfSQL($sql2);
      //  $venc = $datosc["resultado"];
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />
         Telf.
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}



function reporterebajasHTML($idmarca, $return)
{

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
//echo $sqldetalle;
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $sql = "SELECT ma.nombre AS marca
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
   $sql1 = "SELECT  es.nombre AS estilo
FROM  estilos es
WHERE es.idestilo = '$idestilo'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'estilo');
   $estilolista = $idalmacenA['resultado'];
 if($idestilo == null ||$idestilo == "null" )
    {
$html .= "Rebaja $marcalista<br> ";

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
  }else {
$html .= "Rebaja $marcalista<br> Ingreso por estilo $estilolista";

  }
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    //echo $sqldetalle;

   // $proveedor = dibujarTablaOfSQLNormal($sqldetalle, "Detalle");
    //$html .= $proveedor['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
//  $select1 .= "SUM( dtp.totalpares ) AS TOTALPARES ";
//  $from1 = "adiciondetalleingreso dtp, modelos mdd, coleccion col";
//    $where1 = "dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND mdd.idmarca='$idmarca'";
//if($idmarca == null ||$idmarca == "null" )
//    {
////  $select .= "SUM( dtp.totalpares ) AS totalPares ";
//  }else {
//    $from1 .= " , estilos es ";
//    $where1 .= " AND mdd.stylename = es.idestilo AND mdd.stylename = '$idestilo'";
//    }
//   $sqltotalpares = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
//    $producto2 = dibujarTuplaOfSQLSimple($sqltotalpares);
//    $html .= $producto2['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
        $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
  $sqlCar = "SELECT fecha,hora,cantidadpares,montoanterior,montonuevo,diferencia
FROM cambioprecio WHERE idmarca = '$idmarca'";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Detalle");
    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";

	 // $datosc = getTablaToArrayOfSQL($sql2);
      //  $venc = $datosc["resultado"];
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />
         Telf.
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}
function verRebajas($idmarca,$idestilo,$fechain,$fechaf, $return)
//function verIngresosMarcaEstiloHTMLInventario2Ventas($idmarca,$idestilo,$idkardex, $return)
{
    $fechaactual = Date("Y-m-d");
$formatear1 = explode( '-' , $fechaactual);
$fechaact = $formatear1[2].'-'.$formatear1[1].'-' .$formatear1[0];
       $fecha = Date("Y-m-d");
         $formatear = explode( '-' , $fechaf);
$fechafin = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
        $fechaa = Date("Y-m-d");
         $formatear = explode( '-' , $fechain);
$fechainic = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>Nova Moda S.RL.<br />
         <br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";
$formatear = explode( '-' , $fecha);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";


$sql = "SELECT ma.nombre AS marca
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
   $sql1 = "SELECT  es.nombre AS estilo
FROM  estilos es
WHERE es.idestilo = '$idestilo'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'estilo');
   $estilolista = $idalmacenA['resultado'];
 if($idestilo == null ||$idestilo == "null" )
    {
$html .= "Reporte de Rebajas $marcalista<br> ";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
  }else {
$html .= "Reporte de Rebajas $marcalista<br> Ingreso por estilo $estilolista";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";

  }
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

$html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql2 = "SELECT ma.idmarca,ma.nombre
FROM  `marcas` ma,cambioprecio c
WHERE ma.idmarca=c.idmarca AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf' group by ma.idmarca";
//echo $sql2;
////
////$select = "idmarca,nombre";
////    $from = "marcas";
//////  $where .= " descripcion = '$idmarca' ORDER BY CAST( nombre AS SIGNED) ASC";
////    $sql2 = "SELECT ".$select." FROM ".$from;
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
  $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
  $sqlCar = "SELECT fecha,hora,ma.nombre as marca,cantidadpares,montoanterior,montonuevo,diferencia
FROM cambioprecio c,marcas ma WHERE c.idmarca=ma.idmarca AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf' ";
    $carac = dibujarTablaOfSQLNormalrebajas($sqlCar, "Totales" ,$fechain,$fechaf);
    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";

$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idmarca = $codigo['idmarca'];
    $nombremarca = $codigo['nombre'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
           $html .=" <td style='font-size:11px;text-align:left'>".$nombremarca."";
               $html .=" </td> ";
 $html .= "</tr>";
$html .= "<tr>";

$select = "dtp.idcambiodetalle";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
   $where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND mo.idmarca='$idmarca' AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf'";
    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";

$table = dibujarTablaofrebajaspormarca($sql25,$row1,$idmarca,$idestilo,$fechain,$fechaf,$totalparesestilo,$totalbsestilo);

$html .= $table['resultado'];
   $html .= "</tr>";
//       ss
 }
//totales de totales
 $html .= "</tr>";
    $html .= "</table>";


    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function dibujarTablaOfSQLNormalrebajas($sql, $titulo = "ninguno",$fechainicio,$fechafin)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>TOTAL</td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
        $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
$select = "SUM(dtp.cantidadpares)AS pares";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];

$select = "SUM(dtp.cantidadpares*dtp.precionuevo)AS bs";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $preciobs = $almacenA1['resultado'];
$select = "SUM(dtp.diferencia)AS bs";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $dif = $almacenA1['resultado'];

         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";

  $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$preciobs."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$dif."&nbsp;</td>";
         $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaofrebajaspormarca($sql,$row1,$idmarca,$idestilo,$fechainicio,$fechafin,$total1,$total2)
{


    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
     $select = "c.fecha,mar.nombre AS marca,es.nombre as estilo ,mo.codigo,CONCAT( ad.color, '-', ad.material ) AS detalle,dtp.cantidadpares,dtp.precioanterior,dtp.precionuevo,dtp.diferencia";

                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:11px;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Fecha</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Estilo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Detalle</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Pares</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Precio Ant</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Precio Nuevo</td>";

$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Diferencia</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['idcambiodetalle'];
                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
$select = "c.fecha,es.nombre as estilo ,mo.codigo,CONCAT( ad.color, '-', ad.material ) AS detalle,dtp.cantidadpares,dtp.precioanterior,dtp.precionuevo,(dtp.cantidadpares*dtp.precionuevo)AS bs,dtp.diferencia";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND dtp.idcambiodetalle='$dato' ";
    $sql2p1 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   //echo $sql2p1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'fecha');
    $fecha = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'estilo');
    $estilo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $codigo = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'detalle');
    $detalle = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cantidadpares');
    $cantidadpares = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precioanterior');
    $precioanterior = $almacenA1['resultado'];
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'precionuevo');
    $precionuevo = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'bs');
    $bs = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'diferencia');
    $diferencia = $almacenA1['resultado'];
    $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$fecha."&nbsp;</td>";
 $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$estilo."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$codigo."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$detalle."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cantidadpares."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precioanterior."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precionuevo."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$bs."&nbsp;</td>";

        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$diferencia."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>TOTAL</td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
$select = "SUM(dtp.cantidadpares)AS pares";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND mo.idmarca='$idmarca' AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];

$select = "SUM(dtp.cantidadpares*dtp.precionuevo)AS bs";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND mo.idmarca='$idmarca' AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $preciobs = $almacenA1['resultado'];
$select = "SUM(dtp.diferencia)AS bs";
$from = "cambiopreciodetalle dtp, cambioprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
$where = "c.idcambio = dtp.idcambio
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo AND mo.idmarca='$idmarca' AND c.fecha >= '$fechainicio' AND c.fecha <= '$fechafin' ";
     $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $dif = $almacenA1['resultado'];

         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";

 $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
  $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$preciobs."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$dif."&nbsp;</td>";
         $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function verTraspasosporFecha($idmarca,$idestilo,$fechain,$fechaf, $return)
{
    $fechaactual = Date("Y-m-d");
$formatear1 = explode( '-' , $fechaactual);
$fechaact = $formatear1[2].'-'.$formatear1[1].'-' .$formatear1[0];
       $fecha = Date("Y-m-d");
         $formatear = explode( '-' , $fechaf);
$fechafin = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
        $fechaa = Date("Y-m-d");
         $formatear = explode( '-' , $fechain);
$fechainic = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
 $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>Nova Moda S.RL.<br />
         <br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";
$formatear = explode( '-' , $fecha);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";

    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
$sql = "SELECT ma.nombre
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
   $sql1 = "SELECT  es.nombre AS estilo
FROM  estilos es
WHERE es.idestilo = '$idestilo'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'estilo');
   $estilolista = $idalmacenA['resultado'];
 if($idestilo == null ||$idestilo == "null" )
    {
$html .= "Reporte de Traspasos $marcalista<br> ";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";
  }else {
$html .= "Reporte de Traspasos $marcalista<br> Ingreso por estilo $estilolista";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";

  }
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

$html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

$sql2 = "SELECT ma.idmarca,ma.nombre
FROM  `marcas` ma,detalletraspaso dt,adicionkardextienda k,modelos mo,traspaso c
WHERE ma.idmarca=mo.idmarca and mo.idmodelo=k.idmodelodetalle and k.idkardextienda=dt.idkardextienda and dt.idtraspaso = c.idtraspaso AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf' group by ma.idmarca";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
  $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
    $sqlCar = "
SELECT tra.fecha,SUM(dtr.cantidad)As pares ,ma.nombre as marca
FROM traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, estilos e,empleados em,marcas ma
WHERE prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.stylename=e.idestilo and mdt.idmarca=ma.idmarca
AND tra.fecha >= '$fechain' AND tra.fecha <= '$fechaf' group by ma.idmarca
";
    $carac = dibujarTablaOfSQLNormaltraspasos($sqlCar, "Totales Enviados" ,$fechain,$fechaf);
    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";

$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idmarca = $codigo['idmarca'];
    $nombremarca = $codigo['nombre'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
           $html .=" <td style='font-size:11px;text-align:left'>".$nombremarca."";
               $html .=" </td> ";
 $html .= "</tr>";
$html .= "<tr>";
$sql25 = "
SELECT dtr.iddetalletraspaso
FROM traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, estilos e,empleados em
WHERE prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.stylename=e.idestilo
AND tra.fecha >= '$fechain' AND tra.fecha <= '$fechaf' and mdt.idmarca='$idmarca'
";
$table = dibujarTablaoftraspasospormarca($sql25,$row1,$idmarca,$idestilo,$fechain,$fechaf,$totalparesestilo,$totalbsestilo);
$html .= $table['resultado'];
   $html .= "</tr>";
 }
//totales de totales
 $html .= "</tr>";
    $html .= "</table>";

//recibidos

$html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

$sql2 = "SELECT ma.idmarca,ma.nombre
FROM  `marcas` ma,detalletraspaso dt,adicionkardextienda k,modelos mo,traspaso c
WHERE ma.idmarca=mo.idmarca and mo.idmodelo=k.idmodelodetalle and k.idkardextienda=dt.idkardextienda and dt.idtraspaso = c.idtraspaso AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf' group by ma.idmarca";
    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
 //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
  $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
    $sqlCar = "
SELECT dtr.fecha,SUM(dtr.cantidad) AS pares,m.nombre as marca
FROM ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e
WHERE prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.fecha >= '$fechain' AND dtr.fecha <= '$fechaf' AND dtr.detalle2 !='ingresoalmacen' group by m.idmarca
";


    $carac = dibujarTablaOfSQLNormaltraspasosrecibido($sqlCar, "Totales Recibidos" ,$fechain,$fechaf);
    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";

$html .= "<tr>";
for($i=0;$i<=$row15;$i++){
$codigo = $sql3[$i];
  $idmarca = $codigo['idmarca'];
    $nombremarca = $codigo['nombre'];
     $html .= "<tr style='width:100%; font-size:11px;'>";
           $html .=" <td style='font-size:11px;text-align:left'>".$nombremarca."";
               $html .=" </td> ";
 $html .= "</tr>";
$html .= "<tr>";

$sql25 = "
SELECT dtr.numero
FROM ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e
WHERE prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.fecha >= '$fechain' AND dtr.fecha <= '$fechaf' AND dtr.detalle2 !='ingresoalmacen' and mdt.idmarca='$idmarca'
";
$table = dibujarTablaoftraspasospormarcarecibido($sql25,$row1,$idmarca,$idestilo,$fechain,$fechaf,$totalparesestilo,$totalbsestilo);
$html .= $table['resultado'];
   $html .= "</tr>";
 }
//totales de totales
 $html .= "</tr>";
    $html .= "</table>";
//fin2
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function dibujarTablaOfSQLNormaltraspasosrecibido($sql, $titulo = "ninguno",$fechainicio,$fechafin)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>TOTAL</td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
$select = "sum(dtr.cantidad)as pares";
$from = "ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e";
$where = "prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.detalle2 !='ingresoalmacen'
AND dtr.fecha >= '$fechainicio' AND dtr.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];


         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

         $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaoftraspasospormarcarecibido($sql,$row1,$idmarca,$idestilo,$fechainicio,$fechafin,$total1,$total2)
{


    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {

                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:11px;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Fecha</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Obs</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Talla</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>responsable</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Precio</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cantidad</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['numero'];
                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;
$sql2p1 = "
SELECT dtr.fecha,mdt.codigo, CONCAT( m.nombre, '-', e.nombre, '-', prod.precio3bs, '-', prod.precio1bs ) AS Detalle, prod.talla,
dtr.cantidad,prod.precio2bs AS Precio,dtr.detalle
FROM ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e
WHERE prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.numero='$dato' AND dtr.detalle2 !='ingresoalmacen'
";

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'fecha');
    $fecha = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $codigo = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Detalle');
    $detalle = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'talla');
    $cantidadpares = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Precio');
    $precioanterior = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'detalle');
    $precionuevo = $almacenA1['resultado'];
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cantidad');
    $cantidad = $almacenA1['resultado'];

    $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$fecha."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$codigo."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$detalle."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cantidadpares."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precionuevo."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precioanterior."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cantidad."&nbsp;</td>";


                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>TOTAL</td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";

$select = "sum(dtr.cantidad)as pares";
$from = "ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e";
$where = "prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.detalle2 !='ingresoalmacen'
AND mdt.idmarca='$idmarca' AND dtr.fecha >= '$fechainicio' AND dtr.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];


 $select = "sum(dtr.cantidad *prod.precio2bs)as bs";
$from = "ingresos dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e";
$where = "prod.idkardextienda = dtr.idkardextienda AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.detalle2 !='ingresoalmacen'
AND mdt.idmarca='$idmarca' AND dtr.fecha >= '$fechainicio' AND dtr.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $preciobs = $almacenA1['resultado'];



         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$preciobs."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
         $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaOfSQLNormaltraspasos($sql, $titulo = "ninguno",$fechainicio,$fechafin)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:11px;'>";
                    if($titulo != "ninguno")
                    {
                        $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$titulo</td></tr>";
                    }
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;width:5px;text-align:center;background-color:silver;'>Nro</td>";

                    //dibjamos las cabeceras



                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr><td style='text-align:center'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                                $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'>TOTAL</td>";

$select = "sum(dtr.cantidad)as pares";
$from = "traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e,empleados em";
$where = "prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND  tra.fecha >= '$fechainicio' AND tra.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];

         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

         $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function dibujarTablaoftraspasospormarca($sql,$row1,$idmarca,$idestilo,$fechainicio,$fechafin,$total1,$total2)
{


    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
     $select = "c.fecha,mar.nombre AS marca,es.nombre as estilo ,mo.codigo,CONCAT( ad.color, '-', ad.material ) AS detalle,dtp.cantidadpares,dtp.precioanterior,dtp.precionuevo,dtp.diferencia";

                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:11px;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Nro</td>";
       $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
 // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Fecha</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Modelo</td>";
 $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Detalle</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Talla</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>responsable</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Precio</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cantidad</td>";

                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
     $iddetalleingreso = $fi[$i]['iddetalletraspaso'];
                                $devS .= "<td style='display:none;'>&nbsp;".$dato."&nbsp;</td>";
                               // echo $marcapedido;

$select = "tra.fecha,mdt.codigo, dtr.cantidad,CONCAT( m.nombre, '-', e.nombre, '-', prod.precio3bs, '-', prod.precio1bs ) AS Detalle, prod.talla,
dtr.cantidad,prod.precio2bs AS Precio,em.codigo AS responsable";
$from = "traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e,empleados em";
$where = "prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND dtr.iddetalletraspaso='$dato' ";
    $sql2p1 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'fecha');
    $fecha = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'codigo');
    $codigo = $almacenA1['resultado'];
    $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Detalle');
    $detalle = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'talla');
    $cantidadpares = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Precio');
    $precioanterior = $almacenA1['resultado'];
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'responsable');
    $precionuevo = $almacenA1['resultado'];
      $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'cantidad');
    $cantidad = $almacenA1['resultado'];

    $devS .= "<td style='text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$fecha."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$codigo."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$detalle."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cantidadpares."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precionuevo."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$precioanterior."&nbsp;</td>";
         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cantidad."&nbsp;</td>";


                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
//$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
$devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>TOTAL</td>";
       $devS .= "<td style='display:none;'></td>";
        $fechatoday = Date("d-m-Y");
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $devS .= "<td style='text-align:center;border-bottom: 1px solid #000000;'></td>";
       $select = "sum(dtr.cantidad)as pares";
$from = "traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e,empleados em";
$where = "prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND mdt.idmarca='$idmarca' AND tra.fecha >= '$fechainicio' AND tra.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'pares');
    $totalpares = $almacenA1['resultado'];


 $select = "sum(dtr.cantidad *prod.precio2bs)as bs";
$from = "traspaso tra, detalletraspaso dtr, adicionkardextienda prod, modelos mdt, marcas m, estilos e,empleados em";
$where = "prod.idkardextienda = dtr.idkardextienda AND tra.idempleado = em.idempleado
AND tra.idtraspaso = dtr.idtraspaso AND
prod.idmodelodetalle = mdt.idmodelo AND mdt.idmarca=m.idmarca AND mdt.stylename=e.idestilo
AND mdt.idmarca='$idmarca' AND tra.fecha >= '$fechainicio' AND tra.fecha <= '$fechafin'";
          $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ORDER BY fecha DESC";
   $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'bs');
    $preciobs = $almacenA1['resultado'];


         $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'></td>";

$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$preciobs."&nbsp;</td>";
 $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalpares."&nbsp;</td>";
         $devS .= "</tr>";

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}

function verUniones($idmarca,$idestilo,$fechain,$fechaf, $return)
{
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
    $html .= "</td>";
 //   $fechafin = $fechaf;
//$fechainic = $fechain;
$fechaactual = Date("Y-m-d");
$formatear1 = explode( '-' , $fechaactual);
$fechaact = $formatear1[2].'-'.$formatear1[1].'-' .$formatear1[0];
       $fecha = Date("Y-m-d");
         $formatear = explode( '-' , $fechaf);
$fechafin = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
        $fechaa = Date("Y-m-d");
         $formatear = explode( '-' , $fechain);
$fechainic = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];

    $html .= "<td style='width:150px;height:100px;border-bottom:1px solid #000000;text-align:center;font-size:20px;font-family:Tahoma;'>";
    $sql = "SELECT ma.nombre AS marca
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $marcalista = $idalmacenA2['resultado'];
   $sql1 = "SELECT  es.nombre AS estilo
FROM  estilos es
WHERE es.idestilo = '$idestilo'";
    $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'estilo');
   $estilolista = $idalmacenA['resultado'];
 if($idestilo == null ||$idestilo == "null" )
    {
$html .= "Uniones $marcalista<br> ";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";

//  $sqldetalle = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY ".$order;
  }else {
$html .= "Uniones $marcalista<br> Ingreso por estilo $estilolista";
$html .= "<br>Del ".$fechainic." Al ".$fechafin."";

  }
    $html .= "</td>";
    $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

    //echo $sqldetalle;

   // $proveedor = dibujarTablaOfSQLNormal($sqldetalle, "Detalle");
    //$html .= $proveedor['resultado'];
    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";

      $html .= "</td>";
	  $html .= "</tr>";
        $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
  $sqlCar = "SELECT fecha,hora,mo.codigo,CONCAT( ad.color, '-', ad.material ) AS detalle,cantidadpares,montoanterior AS Precio,montonuevo AS Totalbs
FROM unionprecio c,adiciondetalleingreso ad ,modelos mo WHERE c.idmarca=ad.iddetalleingreso and ad.idmodelo=mo.idmodelo AND c.fecha >= '$fechain' AND c.fecha <= '$fechaf' ";
    $carac = dibujarTablaOfSQLNormal($sqlCar, "Totales");

    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";


    $html .= "<tr>";
    $html .= "<td style='width:33%;text-align:right;font-size:15px;font-family:Tahoma;'>";
    $select = "c.fecha,mar.nombre AS marca,es.nombre as estilo ,mo.codigo,CONCAT( ad.color, '-', ad.material ) AS detalle,dtp.cantidadpares,dtp.precioanterior,dtp.precionuevo,dtp.diferencia";
    $from = " unionpreciodetalle dtp, unionprecio c, adiciondetalleingreso ad, modelos mo, marcas mar, estilos es";
    $where = "c.idunion = dtp.idunion
AND dtp.iddetalleingreso = ad.iddetalleingreso
AND dtp.idmodelo = mo.idmodelo
AND dtp.idmodelo = ad.idmodelo
AND mo.idmarca = mar.idmarca
AND mo.stylename = es.idestilo ";
      if($idmarca == null || $idmarca == "" || $idmarca=="null")
      {}else
    {$where .= " AND mo.idmarca='$idmarca' "; }
     if($idestilo == null ||$idestilo == "null" )
    {
    }else{
        $where .= " AND mo.stylename='$idestilo' ";
    }
   // {$where .= " AND mo.stylename='$idestilo' "; }
     if($fechain != null && $fechain != "")
    {$where .= " AND c.fecha >= '$fechain'";  }
  if($fechaf != null && $fechaf != "")
    { $where .= " AND c.fecha <= '$fechaf'"; }


$sqlcodbarra = "SELECT ".$select." FROM ".$from. " WHERE ".$where."ORDER BY fecha DESC";
//echo $sqlcodbarra;
    $carac = dibujarTablaOfSQLNormal($sqlcodbarra, "Modelos");
    $html .= $carac['resultado'];
      $html .= "</td>";
	  $html .= "</tr>";
	 // $datosc = getTablaToArrayOfSQL($sql2);
      //  $venc = $datosc["resultado"];
    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>
    <p>Calzados Balderrama<br />
         Cochabamba - Bolivia<br />
         Telf.
    </p>
</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}



function imprimirmodeloestilotalla($datos, $return)
{
   // echo "hoooooooooooooooooooooooo";
    $html = "";


    $venta = $datos->v;
    $marca = $venta->mar;
    //        echo "julio".$ven;
    //        $totalDescuento = $ven[0]['descuento'];
    ////        $totalDescuento = $ven[0]['descuento'];
    $estilo = $venta->est;
    $tipoCambio1 = "
                    select tipcam.valor
                    from tipocambio tipcam
                    where estado = 'activado'
               ";
    //        MostrarConsulta($tipoCambio1);
    $cambio1 = getTablaToArrayOfSQL($tipoCambio1);
    $cambio = $cambio1['resultado'];
    $cambioNuevo = $cambio[0]['valor'];
    $dolares = $montoapagar/$cambioNuevo;

    //        echo "hola".$montoapagar;
    $pares = $venta->par;

    //


    $montototal =  $venta->bs;
     $opciondibujo =  $venta->opcion;

    $tc = $ven1[0]['monto'];
    $totalMonto = redondear($montototal, $_SESSION['usrDigitos']);
    //$totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
    //        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);


    $almacen = $_SESSION['nombrealmacen'];
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>REPORTE DE VENTAS $titulo  - Almacen : $almacen";
    $html .= "<tr>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>Desde: $fecha_Ini Hasta:$fecha_Fin";
    $html .= "</td>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Marca:</td><td>".$marca."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td></td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Estilo:</td><td>".$estilo."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".date("d-m-Y")."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Monto Total:</td><td>".$totalMonto."</td><td style='font-size:11px;font-weight:bold;'>Pares:</td><td>".$pares."</td></tr>";

   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    //         $totalDescuento = $ven[0]['descuento'];

    //    MostrarConsulta($sqlIV);
    $productos = $datos->p;
    $table = dibujarTablaObjectoOfSQL($productos, $tc);
    //    $table = dibujarTablaOfSQL($sqlIV, "Productos");
    //    $table = dibujarTuplaOfSQLNormal($sqlIV, "Informacion del producto");
    $html .= $table['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Montototal</td><td style='width:75px;text-align:right;'>".$montototal."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Total Pares:</td><td>".$pares."</td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'>0</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>

</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}
function imprimirmodeloestilotalladetalle($datos, $return)
{
   // echo "hoooooooooooooooooooooooo";
    $html = "";

echo "entra";
    $venta = $datos->v;
    $marca = $venta->mar;
    //        echo "julio".$ven;
    //        $totalDescuento = $ven[0]['descuento'];
    ////        $totalDescuento = $ven[0]['descuento'];
    //$estilo = $venta->est;
    $tipoCambio1 = "
                    select tipcam.valor
                    from tipocambio tipcam
                    where estado = 'activado'
               ";
    //        MostrarConsulta($tipoCambio1);
    $cambio1 = getTablaToArrayOfSQL($tipoCambio1);
    $cambio = $cambio1['resultado'];
    $cambioNuevo = $cambio[0]['valor'];
    $dolares = $montoapagar/$cambioNuevo;

    //        echo "hola".$montoapagar;
    //$pares = $venta->par;

    //


    //$montototal =  $venta->bs;
     //opciondibujo =  $venta->opcion;

    $tc = $ven1[0]['monto'];
    $totalMonto = redondear($montototal, $_SESSION['usrDigitos']);
    //$totalCredito = redondear($totalCredito, $_SESSION['usrDigitos']);
    //        $totalDescuento = redondear($totalDescuento, $_SESSION['usrDigitos']);


    $almacen = $_SESSION['nombrealmacen'];
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>REPORTE DE VENTAS $titulo  - Almacen : $almacen";
    $html .= "<tr>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>Desde: $fecha_Ini Hasta:$fecha_Fin";
    $html .= "</td>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$ven1[0]['numerodocumento']."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Marca:</td><td>".$marca."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td></td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Estilo:</td><td>".$estilo."</td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".date("d-m-Y")."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Monto Total:</td><td>".$totalMonto."</td><td style='font-size:11px;font-weight:bold;'>Pares:</td><td>".$pares."</td></tr>";

   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    //         $totalDescuento = $ven[0]['descuento'];

    //    MostrarConsulta($sqlIV);
    $productos = $datos->p;
    //    $table = dibujarTablaObjectoOfSQL($productos, $tc);
    //$html .= $table['resultado'];
     if($fi = mysql_fetch_array($productos))
                {
                    $dev['totalCount'] = mysql_num_rows($productos);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($productos, $i)}= $fi[$i];
                            if(mysql_field_name($productos, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                $sqld = "SELECT
                                dtpt.talla,
                                dtpt.cantidad
                                FROM
                               `adiciondetalleingresotalla` dtpt
                                WHERE
                                dtpt.iddetalleingreso = '$iddetalleingreso'
                                ";

                                //                                 $value{$ii}{mysql_field_name($re, $i)}= '222';

                                //                              echo   $sqld;
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


    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Montototal</td><td style='width:75px;text-align:right;'>".$montototal."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Total Pares:</td><td>".$pares."</td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'>0</td></tr>";
    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>

</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}
//aquis
function imprimirlistacodigos($datos, $return)
{
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$datosmarca = $datos->v;

    $productos = $datos->p;
    $total = count($productos);

 $j=0;
    for($i=0;$i<(count($productos));$i++){
        $producto = $productos[$i];
      //  $iddetalleingresotalla = $producto->iddetalleingresotalla;
        $cantidad =  $producto->cantidad;
       $talla =  $producto->talla;
  //   $iddetalleingreso = $producto->iddetalleingreso;
$idkardexdetalle = $producto->idkardexdetalle;
$idkardexunico = $producto->idkardexunico;
$sql1 = "SELECT idmarca FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico' ";
$idmodelo =  findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
   $idmarca = $idalmacenA['resultado'];
 //  echo $sql1;
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ingresoalmacen i,marcas ma WHERE i.idmarca=ma.idmarca AND ma.idmarca = '$idmarca' ";
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp
WHERE karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigobarra');
    $codigoBarra = $idalmacenA['resultado'];
     $idalmacenA1=  findBySqlReturnCampoUnique($sql1, true, true, 'codigobarraean13');
    $codigo1 = $idalmacenA1['resultado'];
  //   $codigo1 = $codigo['codigobarraean13'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql1, true, true, 'idkardexdetalle');
    $idkardexdetalle = $idalmacenA2['resultado'];
      $idalmacenA3 =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
    $codigomodelo = $idalmacenA3['resultado'];
      $idalmacenA4 =  findBySqlReturnCampoUnique($sql1, true, true, 'marca');
    $marca = $idalmacenA4['resultado'];

      $idalmacenA6 =  findBySqlReturnCampoUnique($sql1, true, true, 'color');
    $color = $idalmacenA6['resultado'];
      $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'material');
    $material = $idalmacenA7['resultado'];
          $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'talla');
    $talla = $idalmacenA7['resultado'];
       $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'tipotalla');
    $tipotalla = $idalmacenA7['resultado'];

        $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'saldocantidad');
    $saldocantidad= $idalmacenA7['resultado'];
      $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'cliente');
    $clientecompleto= $idalmacenA7['resultado'];

      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
/////////////////
  $html .= "<table cellpadding='1' cellspacing='0' border='1' style='width:100%' font-size:11px; font-family:Tahoma;'>";

    $html .= "<tr>";
    $html .= "<td><img src='php/imagen.php?text=".$codigo1."'><br />
</td>";


     $html .= "<td style='width:20%;height:20px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "$codigomodelo<br>";
    $html .= "</td>";
     $html .= "<td style='width:20%;height:20px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "$color<br>";
    $html .= "</td>";
      $html .= "<td style='width:20%;height:20px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "$material<br>";
    $html .= "</td>";
          $html .= "<td style='width:20%;height:20px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "$codigoBarra<br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";

    }


  $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function imprimirmodeloestilotallabarra($datos, $return)
{
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$datosmarca = $datos->v;
$idmarca = $datosmarca->idmarca;
$idestilo = $datosmarca->idestilo;

$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ingresoalmacen i,marcas ma WHERE i.idmarca=ma.idmarca AND i.idingreso = '$idingreso' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'opcionb');
   $opcionb = $idalmacenA['resultado'];

    $productos = $datos->p;
    $total = count($productos);

 $j=0;
    for($i=0;$i<(count($productos));$i++){
        $producto = $productos[$i];
      //  $iddetalleingresotalla = $producto->iddetalleingresotalla;
        $cantidad =  $producto->cantidad;
       $talla =  $producto->talla;
  //   $iddetalleingreso = $producto->iddetalleingreso;
$idkardexdetalle = $producto->idkardexdetalle;
$idkardexunico = $producto->idkardexunico;

if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp
WHERE karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigobarra');
    $codigoBarra = $idalmacenA['resultado'];
     $idalmacenA1=  findBySqlReturnCampoUnique($sql1, true, true, 'codigobarraean13');
    $codigo1 = $idalmacenA1['resultado'];
  //   $codigo1 = $codigo['codigobarraean13'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql1, true, true, 'idkardexdetalle');
    $idkardexdetalle = $idalmacenA2['resultado'];
      $idalmacenA3 =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
    $codigomodelo = $idalmacenA3['resultado'];
      $idalmacenA4 =  findBySqlReturnCampoUnique($sql1, true, true, 'marca');
    $marca = $idalmacenA4['resultado'];

      $idalmacenA6 =  findBySqlReturnCampoUnique($sql1, true, true, 'color');
    $color = $idalmacenA6['resultado'];
      $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'material');
    $material = $idalmacenA7['resultado'];
          $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'talla');
    $talla = $idalmacenA7['resultado'];
       $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'tipotalla');
    $tipotalla = $idalmacenA7['resultado'];

        $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'saldocantidad');
    $saldocantidad= $idalmacenA7['resultado'];
      $idalmacenA7 =  findBySqlReturnCampoUnique($sql1, true, true, 'cliente');
    $clientecompleto= $idalmacenA7['resultado'];

      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
/////////////////
 $det1="";
 $material=substr($material,0,11);
  $color=substr($color,0,11);
switch($formatomayor){
      case '1':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '6':
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
   case '7':
         $dato1 =$codigomodelo."#".$talla;
        $dato2 = $material;
        // $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="";
         $det4=$cliente;
    break;
     case '10':
          $dato1 =$codigomodelo;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
      case '11':
          $dato1 =$codigomodelo."-".$tipotalla;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '16':
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="M";
        $det2="";
        $det3="#";
        $det4="";
    break;
 case '4':
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '12':
           $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="";
        $det2="";
        $det3="#";
         $det4=$cliente;

    break;
 case '16':
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
   default:
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="Md";
        $det2="Dt";
        $det3="#";
         $det4=$cliente;
       break;
}

        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
 ".$codmarca."
".$det1.":".$dato1."<br />
".$det2.":".$dato2."/".$det4."
".$det3.":".$dato3."
    </div></td>
";
            $j++;

        }

    }


  $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function imprimirmodeloestilotalladetalletraspaso($datos, $return)
{
   // echo "hoooooooooooooooooooooooo";
    $html = "";

    $venta = $datos->detalle;
    $boleta = $venta->boleta;
    $responsable = $venta->responsable;
    $transporte = $venta->transporte;
    $marca = $venta->marca;
    $fecha = $venta->fecha;
     $almacenorigen = $_SESSION['nombrealmacen'];

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>Envio de Traspaso $titulo  - Almacen : $almacenorigen";
    $html .= "<tr>";
    //    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>Desde: $fecha_Ini Hasta:$fecha_Fin";
    $html .= "</td>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'>Numero:</td><td style='width:75px;'>".$boleta."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Marca:</td><td>".$marca."</td><td style='font-size:11px;font-weight:bold;'> ".$ven1[0]['abreviacion']."</td><td></td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Responsable:</td><td>".$responsable."</td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Detalle transporte:</td><td>".$transporte."</td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";

   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Por lo siguiente...</td><td></td><td style='font-size:11px;font-weight:bold;'></td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    //         $totalDescuento = $ven[0]['descuento'];

    //    MostrarConsulta($sqlIV);
    $productos = $datos->productos;
        $table = dibujarTablaObjectoOfSQLNike($productos, $tc);
    $html .= $table['resultado'];



    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
//    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
//    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($montoapagar, $ven[0]['abreviacion'])."</td><td style='width:125px;font-size:11px;font-weight:bold;'>Montototal</td><td style='width:75px;text-align:right;'>".$montototal."</td></tr>";
//    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Total Pares:</td><td>".$pares."</td><td style='font-size:11px;font-weight:bold;'></td><td style='width:75px;text-align:right;'>0</td></tr>";
//    //$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Emitido por:</td><td>".$ven[0]['login']."</td><td style='font-size:11px;font-weight:bold;'>Total credito (".$ven[0]['descuento']."):</td><td style='width:75px;text-align:right;'>".$totalCredito."</td></tr>";
//    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";

    $html .= "<tr><td colspan='4' align='center' style='border-top:solid 1px #000000;'><div id='pie'>

</div></td></tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

    //    }
}
function dibujarTablaObjectoOfSQL($producto, $tc = 1)
{
    //echo mysql_num_rows($re);
//lol
    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:14px;'>";
    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Nro</td>";

    //dibjamos las cabeceras
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Col</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Modelo</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Color</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Precio</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>33</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>34</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>35</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>36</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>37</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>38</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>39</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>40</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>41</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>42</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>43</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>44</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>45</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Pares</td>";

    $devS .= "</tr>";
    $ii = 0;
    $z = 1;
    for($j=0;$j<count($producto);$j++){
        $col = $producto[$j]->coleccion;
        $mod = $producto[$j]->codigo;
        $colo = $producto[$j]->color;
        $pre = $producto[$j]->precio;
        $t33 = $producto[$j]->t33;
        $t34 = $producto[$j]->t34;
        $t35 = $producto[$j]->t35;
        $t36 = $producto[$j]->t36;
        $t37 = $producto[$j]->t37;
        $t38 = $producto[$j]->t38;
        $t39 = $producto[$j]->t39;
        $t40 = $producto[$j]->t40;
        $t41 = $producto[$j]->t41;
        $t42 = $producto[$j]->t42;
        $t43 = $producto[$j]->t43;
        $t44 = $producto[$j]->t44;
        $t45 = $producto[$j]->t45;
        $pares = $producto[$j]->totalpares;
        $devS .= "<tr><td style='text-align:center'>".$z."</td>";


        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$col&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$mod&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$colo&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$pre&nbsp;</td>";
 $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t33&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t34&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t35&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t36&nbsp;</td>";
         $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t37&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t38&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t39&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t40&nbsp;</td>";
         $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t41&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t42&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t43&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t44&nbsp;</td>";

        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t45&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$pares&nbsp;</td>";
        $devS .= "</tr>";
        $ii++;
        $z ++;
    }
    $devS .= "</table>";

    $dev['mensaje'] = "Existen resultados";
    $dev['error']   = "true";
    $dev['resultado'] = $devS;




    return $dev;
}
function dibujarTablaObjectoOfSQLNike($producto, $tc = 1)
{
    //echo mysql_num_rows($re);
//lol
    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px;border:1px solid #000000;font-size:14px;'>";
    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Nro</td>";

    //dibjamos las cabeceras
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Modelo</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Stylename</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Item</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Num  Cajas</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Precio Venta</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Precio unitario</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Talla</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Total Pares</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Total caja</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Total sus</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>36</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>37</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>38</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>39</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>40</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>41</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>42</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>43</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>44</td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>45</td>";


    $devS .= "</tr>";
    $ii = 0;
    $z = 1;
    $numcajas=0;
    $totpares=0;
    $totsus=0;
 //        String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};
    for($j=0;$j<count($producto);$j++){
         $idmodelo = $producto[$j]->idmodelo;
        $col = $producto[$j]->codigo;
        $mod = $producto[$j]->material;
        $colo = $producto[$j]->cliente;
        $pre = $producto[$j]->totalcajas;
        $t33 = $producto[$j]->precio;
        $t34 = $producto[$j]->preciounitario;
        $t35 = $producto[$j]->talla;
        $t36 = $producto[$j]->totalpares;
        $t37 = $producto[$j]->totalparescaja;
        $t38 = $producto[$j]->totalparesbs;
        $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='36' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a36 = $idalmacenA['resultado'];
  $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='37' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a37 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='38' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a38 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='39' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a39 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='40' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a40 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='41' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a41 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='42' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a42 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='43' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a43 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='44' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a44 = $idalmacenA['resultado'];
     $sql1="SELECT SUM(karp.saldocantidad) AS cantidad FROM `modelo` mdd,kardexdetallepar karp WHERE
 karp.idmodelo = mdd.idmodelo AND karp.idmodelo = '$idmodelo' and karp.talla='45' group by karp.talla";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'cantidad');
   $a45 = $idalmacenA['resultado'];
         $devS .= "<tr><td style='text-align:center'>".$z."</td>";
     $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$col&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$mod&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$colo&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$pre&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t33&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t34&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t35&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t36&nbsp;</td>";
         $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t37&nbsp;</td>";
        $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$t38&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a36&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a37&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a38&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a39&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a40&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a41&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a42&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a43&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a44&nbsp;</td>";
              $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;$a45&nbsp;</td>";


        $devS .= "</tr>";
        $ii++;
        $z ++;
        $numcajas = $numcajas + $pre;
        $totpares =$totpares + $t36;
        $totsus =$totsus + $t38;
    }
    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'></td>";

    //dibjamos el pie
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;background-color:silver;'>Totales</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;background-color:silver;'></td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;background-color:silver;'></td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>$numcajas</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'></td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'></td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;background-color:silver;'></td>";
$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>$totpares</td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'></td>";
    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;'>$totsus</td>";

    $devS .= "</tr>";
    $devS .= "</table>";

    $dev['mensaje'] = "Existen resultados";
    $dev['error']   = "true";
    $dev['resultado'] = $devS;




    return $dev;
}

function  AdicionCodigoBarraIngresoDetalleHTML($idimpresion,$return = true)
{

//actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
    $sql1 = "SELECT  idmarca FROM numeracionimpresion WHERE idnumeracionimpresion = '$idimpresion' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
   $idmarca = $idalmacenA['resultado'];
  // echo $sql1;
$sql1 = "SELECT  ma.codigo,ma.formatomayor FROM marcas ma WHERE ma.idmarca= '$idmarca' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];

    $sql1="
SELECT kar.idkardexunico,kar.idkardex, kar.idmodelo, kar.idtienda, kar.codigobarra, kar.saldocantidad,
  kar.numero, mdd.codigo, kar.codigobarraean13,mdd.color,mdd.material,mdd.linea,col.detalle AS coleccion,kar.numerocajas
FROM `kardexcajas` kar, `modelo` mdd,`coleccion` col
WHERE kar.idmodelo = mdd.idmodelo and mdd.idcoleccion=col.idcoleccion
AND kar.idimpresion = '$idimpresion'
";
  //  echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
        $idkardexunico = $codigo['idkardexunico'];
        $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
        $coleccion = $codigo['coleccion'];
       $color = $codigo['color'];
       $material = $codigo['material'];
       $linea = $codigo['linea'];
 $saldocantidad = $codigo['numerocajas'];
 $sql1 = "SELECT numeroparesfila FROM kardexcajas WHERE idkardexunico = '$idkardexunico' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'numeroparesfila');
   $numparesencaja = $idalmacenA['resultado'];
 $det1="";
 $material=substr($material,0,11);
  $color=substr($color,0,11);
switch($formatomayor){
    case '1':
        $dato1 = $coleccion."-".$codigomodelo;
        $dato2 = $material."-".$color;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="Dt";
        $det3="#pares";
    break;
    case '2':
         $det2="Md";
        //$det2="Dt";
        $det1="#pares";
        $dato2 = $codigomodelo."-".$material;
       $dato3 = $numparesencaja;
    break;
     case '3':
        $dato1 = $codigomodelo;
        $dato3 = $material."-".$color;
         $dato2 = $numparesencaja;
        $det1="Md";
        $det3="Dt";
        $det2="#pares";
    break;
       case '4':
            $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";

    break;
       case '5':
        $dato2 = $linea."-".$codigomodelo."-".$color;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '6':
        $dato2 = $linea."-".$codigomodelo."-".$color;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '7':
        $modelo = $codigomodelo."-".$color;
          $detalle = $material;
          $dato1 =$codigomodelo;
        $dato2 = $material;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="";
        $det3="#pares";
    break;
       case '8':
         $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";
    break;
       case '9':
         $dato2 = $codigomodelo;

         $dato1 = $numparesencaja;
        $det2="Md";
        //$det3="Dt";
        $det1="#pares";

    break;
       case '10':
        $modelo = $codigomodelo."-".$color;
          $detalle = $material;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $numparesencaja;
        $det1="Md";
        $det2="Dt";
        $det3="#pares";
    break;
}


        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
    Marca : ".$codmarca."
".$det1." : ".$dato1."<br />
".$det2.": ".$dato2."
".$det3." :".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function  codbarraporpar($idingreso,$return = true)
{
actualizardiferencia($idingreso,false);
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";

    $html .= "<table width='750' border='0' cellspacing='0' cellpadding='0'><tr>";
$sql1 = "SELECT idmarca FROM numeracionimpresion  WHERE idnumeracion = '$idingreso' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
   $idmarca = $idalmacenA['resultado'];
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
 $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'codigo');
   $codmarca = $idalmacenA['resultado'];
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
   $idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'opcionb');
   $opcionb = $idalmacenA['resultado'];

if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND karp.idimpresion = '$idingreso'  ORDER BY CAST(mdd.codigo as signed) asc,karp.idkardex asc,karp.talla asc
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp
WHERE karp.idmodelo = mdd.idmodelo AND karp.idimpresion = '$idingreso' ORDER BY CAST(mdd.codigo as signed) asc,karp.idkardex asc,karp.talla asc
";
}
//echo $sql1;

//MODIFICAR ORDEN DE INGRESO
   //echo $sql1;
    $row = NumeroTuplas($sql1);
    $row1= $row['resultado'];
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $j=0;
    for ($i=0;$i<$row1;$i++){

        $codigo = $sql3[$i];
       $codigoBarra = $codigo['codigobarra'];
        $codigo1 = $codigo['codigobarraean13'];
        $idmodelo = $codigo['idmodelo'];
        $codigomodelo = $codigo['codigo'];
       $color = $codigo['color'];
       $material = $codigo['material'];
//       $linea = $codigo['linea'];
 $talla = $codigo['talla'];
 $tipotalla = $codigo['tipotalla'];
  $saldocantidad = $codigo['saldocantidad'];
   $clientecompleto = $codigo['cliente'];
      $formatear = explode( '/' , $clientecompleto);
$cliente = $formatear[0];
//codigo cliente
 $material=substr($material,0,11);
  $color=substr($color,0,11);
 $det1="";
switch($formatomayor){
     case '1':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="M";
        $det2="D";
        $det3="#";
         $det4=$cliente;
    break;
  case '6':
      $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="Md";
        $det2="Dt";
        $det3="#";
         $det4=$cliente;
    break;
   case '7':
       $marca=$codmarca;
        $dato1 =$codigomodelo."#".$talla;
        $dato2 = $material;
       //  $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="";
         $det4=$cliente;
    break;
     case '10':
         $marca=$codmarca;
          $dato1 =$codigomodelo;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
      case '11':
          $marca=$codmarca;
          $dato1 =$codigomodelo."-".$tipotalla;
        $dato2 = $color;
         $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
         $det4=$cliente;
    break;
  case '16':
      $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
 case '4':
     $marca=$codmarca;
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color."-".$material;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '8':
         $marca="";
        $dato1 =$codigomodelo."/".$cliente;
        $dato2 =$color;
        $dato3 = $talla;
        $det1="Md";
        $det2="";
        $det3="#";
        $det4="";
    break;
     case '12':
         $marca=$codmarca;
           $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="";
        $det2="";
        $det3="#";
         $det4=$cliente;

    break;
   default:
       $marca=$codmarca;
          $dato1 =$codigomodelo."-".$color;
        $dato2 = $material;
         $dato3 = $talla;
        $det1="Md";
        $det2="Dt";
        $det3="#";
         $det4=$cliente;
       break;
}

        for($h=0;$h<$saldocantidad;$h++){
            if($j==4){
                $html .="</tr><tr>";
                $j=0;
            }
          $html .="
    <td style='width:25%;text-align:center;padding-bottom: 40px;padding-top: 0px; margin-top: -35px;font-size:12px;font-family:Tahoma;'>

      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=1&amp;t=50&amp;r=1&amp;text=".$codigo1."&amp;f=3&amp;a1=&amp;a2='><br />
 ".$marca."
".$det1.":".$dato1."<br />
".$det2.":".$dato2."/".$det4."
".$det3.":".$dato3."
    </div></td>
";
            $j++;

        }

    }
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function extractocliente($productos,$idcliente, $return)
{
    $html = "";
    $html .= "<tr>";
    $html .= "<tr><td align='right'><img src='img/logosistema.jpg'><td><tr>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:25px;font-family:Tahoma;'>
            <p style='font-size:21px; font-weight:bold;font-family:comic sans ms;'>Distribuidora de Calzados</p>
             Telf. 4-258993  Fax: 4-504183
            </td></tr>";
    $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' ";
    $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
    $clientenombre = $idalmacenA['resultado'];

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:17px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:15px;font-family:Tahoma;'>";
            $fechatoday = Date("Y-m-d");
    $html .= "$fechatoday " ;

    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:27px;font-family:Times New Roman;'>";
    $html .= "EXTRACTO DE CLIENTE <br>";

    $recibo="1";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Times New Roman; text-align:center;font-weight:bold;'><td><tr>";
   // $html .= "<tr><td></td><td></td><td></td><td style='font-size:11px;font-weight:bold;'>Empresa:</td><td>".$empresa."</td></tr>";
    $html .= "<tr><td></td><td></td><td></td><td style='font-size:16px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td></tr>";
    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Times New Roman; text-align:center;font-weight:bold;'><td><tr>";

    $html .= "<table cellpadding='0' cellspacing='0' border='1' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";
    $sumaventas=0;
    $sumacobro=0;
    for($i = 0; $i< count($productos); $i++)
    {
        $codigo = $productos[$i];
        $idventa = $codigo->idventa;
        $idcrecliente = $codigo->idcrecliente;
//echo $sqlc1;
        $sql21 = "SELECT m.nombre, SUM(c.sus) as monto FROM creditocliente c, marcas m WHERE c.idmarca = m.idmarca and c.idventa = '$idventa' and c.idcrecliente = '$idcrecliente' GROUP BY m.nombre";
        $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'nombre');
        $nombremarca = $almacenA1['resultado'];
        $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'monto');
        $totalventa = $almacenA1['resultado'];
        $sumaventas = $sumaventas + $totalventa;
        $html .= "<td cellpadding='0' cellspacing='0' border='0' style='width:750px;'>";
        if($i==0){
            $html .= "<tr><td style='border-bottom:1px solid #000000;font-size:12px;text-align:left;'>$nombremarca</td></tr>";
        }
        $sqlc1 = "SELECT date_format(fechaventa,'%d/%m/%Y') AS fechaventa, boleta, caja as cajas, par as pares , sus as montodeuda,
                 porpagar, date_format(ultimopago,'%d/%m/%Y') AS fechaultimopago, date_format(fechalimite,'%d/%m/%Y') AS fechamaxima
                 FROM creditocliente WHERE idventa = '$idventa'  and idcrecliente = '$idcrecliente' ";

        $carac1 = dibujarTablaOfSQLreporte($sqlc1,$no_planillaactual, $idventa,$idcrecliente);
//echo $sqlc1;
        $html .= $carac1['resultado'];
        $html .= "<td cellpadding='0' cellspacing='0' border='0' style='width:400px;'>";
//ini
     //echo $sql;
        $concepto="PAGO";
        $concepto1="REBAJA";
        $sql11 = "SELECT
        '$concepto' AS Concepto, date_format(c.fechapago,'%d/%m/%Y') AS FechaPago, c.monto AS Pago, c.boleta AS Recibo, CONCAT(e.nombres, '-', e.apellidos) AS vendedor
                  FROM creditopago c,marcas m,empleados e
                  WHERE  c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa' and c.idcrecliente = '$idcrecliente'
                  UNION ALL
                  SELECT
                  '$concepto1' AS Concepto, date_format(c.fechapago,'%d/%m/%Y') AS FechaPago, c.monto AS Pago, c.boleta AS Recibo, CONCAT(e.nombres, '-', e.apellidos) AS vendedor
                  FROM creditorebaja c,marcas m,empleados e
                  WHERE c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa' and c.idcrecliente = '$idcrecliente'
                  UNION ALL
                  SELECT
                  'DEVOLUCION' AS Concepto, date_format(c.fechapago,'%d/%m/%Y') AS FechaPago, c.monto AS Pago, c.boleta AS Recibo, CONCAT(e.nombres, '-', e.apellidos) AS vendedor
                  FROM creditodevolucion c,marcas m,empleados e
                  WHERE c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa'";
//echo $sql11;
        $sql21 = "SELECT SUM(c.monto) as monto FROM creditopago c,marcas m,empleados e WHERE c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa' and c.idcrecliente = '$idcrecliente'";
        $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'monto');
        $totalcobro1 = $almacenA1['resultado'];
        $sql21 = "SELECT SUM(c.monto) as monto FROM creditorebaja c,marcas m,empleados e WHERE c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa' and c.idcrecliente = '$idcrecliente'";
        $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'monto');
        $totalcobro2 = $almacenA1['resultado'];
        $sql21 = "SELECT SUM(c.monto) as monto FROM creditodevolucion c,marcas m,empleados e WHERE c.idmarca=m.idmarca and c.idvendedor =e.idempleado AND c.idventa = '$idventa'";
        $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'monto');
        $totalcobro3 = $almacenA1['resultado'];
        $totalcobromes = $totalcobro1 + $totalcobro2 + $totalcobro3;
        $sumacobro = $sumacobro + $totalcobromes;
        $carac1 = dibujarTablaOfSQLcontotalessimple($sql11,$tc,$sumaventames,$totalcobromes,$idcliente,$venta1,$totalpapeleta);
        $html .= $carac1['resultado'];
        $html .= "</td>";
        $html .= "</tr>";
    }
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<br />";
    $html .= "</table>";
    $html .= "<table>";
       //PIE
    $html .= "</table>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
    $saldo = $sumaventas - $sumacobro ;
    $html .= "<tr style='height:30px;text-align:left;font-family:Times New Roman;'>";
    $html .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Total Venta: $sumaventas</td>";
    $html .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>Total Pagado: $sumacobro</td>";
    $html .= "</tr>";
    $html .= "<tr style='height:30px;text-align:left;font-family:Times New Roman;'>";

    $html .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>DEUDA</td>";
    $html .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:14px;text-align:center;background-color:silver;'>$saldo</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

function dibujarTablaOfSQLcontotalessimple($sql, $tc = 1,$ventasmes,$totalcobro,$idcliente,$planilla,$totalpapeleta)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                   $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
                   $devS .= "<tr>";
                   $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Concepto</td>";
                   $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Fecha</td>";
                   $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Monto</td>";
                   $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Recibo</td>";
                   $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobrado Por</td>";
                   $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "monto")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "monto" || mysql_field_name($re, $i) == "monto")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                }
                               // $devS .= "<td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                               $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "<tr>";
                    $devS .= "<td>Total</td>";
                    $devS .= "<td></td>";
                    $devS .= "<td style='text-align:right;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$totalcobro."&nbsp;</td>";
                    $devS .= "<td></td>";
                    $devS .= "<td></td>";
                    $devS .= "<td></td>";
                    $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;
                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTablaOfSQLreporte($sql, $mesplanilla,$idventa,$idcrecliente)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;text-align:center;font-size:13px;'>";
                   $devS .= "<tr>";
                    //dibjamos las cabeceras
                    for($zz = 0; $zz < mysql_num_fields($re); $zz++)
                    {
                        $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>".mysql_field_name($re, $zz)."</td>";
                    }
                    $devS .= "</tr>";
                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        $devS .= "<tr>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $dato = $fi[$i];
                                if(mysql_field_name($re, $i) == "precio" || mysql_field_name($re, $i) == "importe")
                                {
                                    //                                    $dato = $fi[$i]/$tc;
                                    $dato = $fi[$i];
                                  //  echo $dato;
                                }

                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td>";
                            }
                            else
                            {
                                $devS .= "<td style='border-left: 1px solid #000000;'>&nbsp;".$fi[$i]."&nbsp;</td>";
                            }
                        }

                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "<tr><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Total</td>";
                    $devS .= "<td></td>";
                    $sql21 = "SELECT SUM(par) AS Pares, SUM(sus) AS Sus, SUM(porpagar) AS Porpagar FROM creditocliente WHERE idventa = '$idventa' and idcrecliente = '$idcrecliente'";
                    $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'Pares');
                    $pares = $almacenA1['resultado'];
                    $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'Sus');
                    $monto = $almacenA1['resultado'];
                    $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'Porpagar');
                    $saldo = $almacenA1['resultado'];

                    $devS .= "<td></td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pares."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$monto."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$saldo."&nbsp;</td>";

                    $devS .= "</tr>";
                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function dibujarTuplaOfSQLSimple($sql)
{
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:15px;'>";

                    $ii = 0;
                    //$totalCount = mysql_num_rows($re);
                    $z = 1;
                    do{
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $dato = $fi[$i];
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $devS .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;".mysql_field_name($re, $i)."</td><td style='text-align:right;border-left: 1px solid #000000;'>&nbsp;".redondear($dato)."&nbsp;</td></tr>";
                            }
                            else
                            {
                                $devS .= "<tr><td style='font-weight:bold;'>&nbsp;&nbsp;".mysql_field_name($re, $i)."</td><td style='text-align:left;border-left: 1px solid #000000;'>&nbsp;".$dato."&nbsp;</td></tr>";
                            }
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));

                    $devS .= "</table>";

                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $devS;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta2".mysql_error();
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "Error en la consulta";
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
    return $dev;
}
function imprimirlistacodigospormodelo($idmarca,$modelo, $return)
{

    $html = "";
 $html .= "<tr><td colspan='4' align='center'>

</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";


    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
   $html .= "<tr>";



    $html .= "</tr>";


$recibo="1";
    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
     $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";

// $sql1 = "SELECT idmarca FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico' ";
//$idmodelo =  findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
//   $idmarca = $idalmacenA['resultado'];
 //  echo $sql1;
$sql1 = "SELECT  ma.codigo,ma.formatomayor,ma.opcionb FROM ingresoalmacen i,marcas ma WHERE i.idmarca=ma.idmarca AND ma.idmarca = '$idmarca' ";
$idalmacenA =  findBySqlReturnCampoUnique($sql1, true, true, 'formatomayor');
   $formatomayor = $idalmacenA['resultado'];
if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo, mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, CONCAT( c.detalle, '-', mdd.codigo) AS codigo, karp.codigobarraean13,mdd.color,mdd.material,karp.talla
FROM `modelo` mdd,kardexdetallepar karp,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}else{
   $sql1="SELECT karp.idkardex,mdd.cliente, karp.idmodelo,  mdd.talla as tipotalla, karp.codigobarra, karp.saldocantidad,
  karp.numero, mdd.codigo, karp.codigobarraean13,mdd.color,mdd.material,mdd.linea,karp.talla
FROM `modelo` mdd,kardexdetallepar karp
WHERE karp.idmodelo = mdd.idmodelo AND karp.idkardexunico='$idkardexunico' ORDER BY CAST(mdd.codigo as signed) asc,mdd.color asc,mdd.material ASC
";
}
    $carac = dibujarTablaOfSQLNormal($sql1, "Modelos");
    $html .= $carac['resultado'];
    $html .="<br>";
    $html .= "</td>";
    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}
function ListaInventarioMarca($idmarca,$proforma,$rango,$idvendedor, $modelo,$idkardex,$return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
 $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
   if($idkar==null || $idkar==''){
    $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,estado FROM administrakardex WHERE  mesrango= '$idkardex' and idalmacen='$idalmacen'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
     }else{
    $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,estado FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
   }
 $mesdetalle =$mesrango;
  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];
   $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";
 }

}
}

 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
   // $html .= "<tr><td align='right'><img src='img/logobalderrama.jpg'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td><td></td><td></td><td></td></tr>";
    $html .= "<tr><td style='font-size:25px;font-weight:bold;'>$nombremarca/$mesdetalle</td><td></td><td></td><td></td></tr>";

   $html .= "</tr>";
       $html .= "<tr>";
    $html .= "<td>";

    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];
    $select = "kp.idmodelo";

 $material=substr($material,0,11);
  $color=substr($color,0,11);
switch($formatomayor){
  case '7':
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' ";
  if($proforma!=null || $proforma!=""){
     $sqlmarca = " SELECT i.boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
     AND mdd.idmarca = '$idmarca' and i.boleta='$proforma' GRoup by i.idingreso";
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
     $boletaalmacen = $opcionkardex['resultado'];
     if($boletaalmacen !=null || $boletaalmacen!=""){
     $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$proforma'";
     }else{
     $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$proforma'";
      }
  }
 if($idcliente!=null || $idcliente!=""){ $where .= "and mdd.idcliente='$idcliente'";  }
 if($idvendedor!=null || $idvendedor!=""){ $where .= "and mdd.idvendedor='$idvendedor'"; }
 if($modelo!=null || $modelo!=""){$where .= "and mdd.codigo LIKE '".$modelo."%'";  }
 $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER by mdd.talla,mdd.codigo,mdd.color ASC";
   break;

   case '11':
   $from = "modelo mdd,kardexdetallepar kp,empleados e ,ingresoalmacen i";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca' and mdd.idingreso=i.idingreso
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen'";
//if($proforma!=null || $proforma!=""){$where .= "and i.boleta='$proforma'";  }
 if($proforma!=null || $proforma!=""){
     $sqlmarca = " SELECT i.boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
     AND mdd.idmarca = '$idmarca' and i.boleta='$proforma' GRoup by i.idingreso";
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
     $boletaalmacen = $opcionkardex['resultado'];
     if($boletaalmacen !=null || $boletaalmacen!=""){
     $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$proforma'";
     }else{
     $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$proforma'";
      }
  }
if($idcliente!=null || $idcliente!=""){$where .= "and mdd.idcliente='$idcliente'";  }
    if($idvendedor!=null || $idvendedor!=""){$where .= "and mdd.idvendedor='$idvendedor'";  }
    if($gestion!=null || $gestion!=""){$where .= "and mdd.fechaingreso='$gestion'";  }
    if($modelo!=null || $modelo!=""){$where .= "and mdd.codigo LIKE '".$modelo."%'";  }
   $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER BY mdd.talla,mdd.codigo,mdd.color ASC";
    break;
//aqui
   default:
 $from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' ";
 if($proforma!=null || $proforma!=""){
     $sqlmarca = " SELECT i.boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
     AND mdd.idmarca = '$idmarca' and i.boleta='$proforma' GRoup by i.idingreso";
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
     $boletaalmacen = $opcionkardex['resultado'];
     if($boletaalmacen !=null || $boletaalmacen!=""){
     $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$proforma'";
     }else{
     $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$proforma'";
      }
  }
 if($idcliente!=null || $idcliente!=""){$where .= "and mdd.idcliente='$idcliente'";  }
    if($idvendedor!=null || $idvendedor!=""){$where .= "and mdd.idvendedor='$idvendedor'";  }
    if($gestion!=null || $gestion!=""){$where .= "and mdd.fechaingreso='$gestion'";  }
    if($modelo!=null || $modelo!=""){$where .= "and mdd.codigo LIKE '".$modelo."%'";  }
    $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER BY mdd.codigo ASC";
    //CAST( `mdd`.`codigo` AS SIGNED) ASC //ojo
       break;
}
 $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
//echo $sql25;
   $producto = dibujarTablaitemingreso($idkardex,$sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idingreso,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
      $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function verConsultamodelo($idalmacen, $modelo,$return)
{//echo $modelo;
       if($idalmacen=="null" || $idalmacen=="" || $idalmacen=='null'  ){
           $idalmacen = $_SESSION['idalmacen'];
           $variable="todos";
       }else{
       $idalmacen = $idalmacen;
       $variable="uno";   }

    $sql12 = "SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "nombre");
    $tiendasesion = $saldocantidadA['resultado'];
    
$fecha1 = date("Y-m-d");
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;

    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>Nova Moda S.R.L.<br />
         <br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha";
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "CONSULTA";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";

  

 

    //ver otros pares
     $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
  $select1 = "kp.idmodelo";
 $from1 = "modelo mdd,kardexdetallepar kp,empleados e";
 $where1 = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.estado ='Activo' and mdd.idalmacen='$idalmacen' and mdd.codigo LIKE '".$modelo."%' ";
// //   if($idalmacen=="null"){}else{$where .= "and mdd.idalmacen='$idalmacen'";  }
//    if($modelo=="null"){}else{$where .= "and mdd.codigo LIKE '".$modelo."%'";  }
    $order1 = " GROUP by kp.idmodelo ORDER BY mdd.codigo ASC,mdd.idalmacen";
 $sql25 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ".$order1;


   $producto = dibujarTablareportemodelo($idkardex,$sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idingreso,$formatomayor);
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";

    $html .="<br>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);

    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function verDetalleCapitalMarca($idmarca,$idkardex,$return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";


 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}

 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
   // $html .= "<tr><td align='right'><img src='img/logobalderrama.jpg'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td><td></td><td></td><td></td></tr>";
    $html .= "<tr><td style='font-size:25px;font-weight:bold;'>$nombremarca / $idkardex</td><td></td><td></td><td></td></tr>";

   $html .= "</tr>";
       $html .= "<tr>";
    $html .= "<td>";
  $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "idmarca";
    $from = "marcas ";
    $where = " estado='activo' and idmarca='$idmarca' ";
    //  $sql2 = "SELECT ".$select." FROM ".$from;
    $sql2 = "SELECT ".$select." FROM ".$from." WHERE ".$where;

    $row = NumeroTuplas($sql2);
    $row1= $row['resultado'];
    $sql21 = getTablaToArrayOfSQL($sql2);
    $sql3 = $sql21['resultado'];
    $row5 = NumeroTuplas($sql2);
    $row15= $row5['resultado'];
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:0px solid #000000;font-size:13px;text-align:center'>";
    $html .= "<tr>";

    for($i=0;$i<=$row15-1;$i++){
        $codigo = $sql3[$i];
        $idmara = $codigo['idmarca'];
        $html .= "<tr style='width:100%; font-size:13px;'>";
        $html .=" <td style='font-size:14px;text-align:left'>";
        $html .=" </td> ";
        $html .= "</tr>";
        $html .= "<tr>";
        $select1 = "talla,idmodelo";
        $from1 = "tallasdetalle";
        $where1 = "talla >='$rango1' AND talla <='$rango2' AND idmodelo='2' ORDER BY talla ASC";
        $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
        $row = NumeroTuplas($sql21);
        $row1= $row['resultado'];

        $select = "idempleado";
        $from = "empleadomarca";
        $where = "idmarca='$idmara' AND idalmacen='$idalmacen' and estado='A'";
        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
        //echo $sql25;
        $table = dibujarTablaOfSQLmarcarecapitulacionvendedor($idkardex,$sql25,$sql21,$row1,$idmara,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido);
        $html .= $table['resultado'];
    }

  
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</td></tr>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}


function Listaparesingreso($idingreso, $return)
{
   $idalmacen = $_SESSION['idalmacen'];
   $html = "";
   $sql1 = " SELECT * FROM ingresoalmacen WHERE idingreso = '$idingreso' "  ;
               // MostrarConsulta($sql1);
    $dato = getTablaToArrayOfSQL($sql1);
    $ven = $dato["resultado"];
 $idalmacen=$ven[0]['idalmacen'];
 $idcliente=$ven[0]['idcliente'];
 $idvendedor=$ven[0]['idvendedor'];
 $idmarca=$ven[0]['idmarca'];
 $fechaventa=$ven[0]['fecha'];
 $boleta=$ven[0]['boleta'];
 $totalbs=$ven[0]['totalbs'];
 $totalcajas=$ven[0]['tcajas'];
 $totalsus=$ven[0]['totalsus'];
 $descuentopor=$ven[0]['descporcentaje'];
 $descuento=$ven[0]['descuento'];
 $totalNeto=$ven[0]['montoapagar'];

  $sql2 = " SELECT CONCAT(nombre, '-', apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $clientenombre = $idalmacenA['resultado'];
  $sql2 = " SELECT CONCAT(nombres, '-', apellidos) AS codigo FROM empleados WHERE idempleado = '$idvendedor' "  ;
  $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'codigo');
  $vendedornombre = $idalmacenA['resultado'];

 $sql = "SELECT ma.nombre AS marca,ma.talla,ma.idgrupo,ma.opcionb,ma.pedido,ma.numero,ma.formatomayor FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
   $nombremarca = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'formatomayor');
   $formatomayor = $idalmacenA2['resultado'];
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
   $opcionmarca = $idalmacenA2['resultado'];
 $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'idgrupo');
   $idgrupo = $idalmacenA2['resultado'];
       $idsCAr = split("-", $opcionmarca);
$rango1=$idsCAr[0];
$rango2=$idsCAr[1];

if($opcionmarca="33-45"){
$tipo="1";
//echo $tipo;
}else{
if($opcionmarca="14-38"){
$tipo="3";
}else{
if($opcionmarca="47-70"){
$tipo="2";
}else{
$tipo="1";

}

}
}
 $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,estado FROM administrakardex WHERE estado = 'pendiente' and idalmacen='$idalmacen' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkardex = $opcionkardex['resultado'];
 $sql = "SELECT *
FROM almacenes
WHERE idalmacen = '$idalmacen'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'direccion');
   $direccion = $idalmacenA2['resultado'];
      $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'telefono');
   $telefono = $idalmacenA2['resultado'];
       $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'tipo');
   $tipo = $idalmacenA2['resultado'];
   $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
   // $html .= "<tr><td align='right'><img src='img/logobalderrama.jpg'><td><tr>";
    $html .= "<tr><td style='font-size:11px;'></td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
    $html .= "<body>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr>";
    $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$direccion</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$telefono</td><td></td><td style='font-size:11px;font-weight:bold;'></td><td></td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>$tipo</td><td style='font-size:25px;font-weight:bold;'>$nombremarca</td></tr>";

    $html .= "<td style='width:500px;height:100px;border-bottom:0px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:350px;'>";
     $html .= "<tr><td style='font-size:11px;font-weight:bold;'>BOLETA:</td><td>".$ven[0]['boleta']."</td></tr>";
   $html .= "<tr><td style='font-size:11px;font-weight:bold;'>Cliente:</td><td>".$clientenombre."</td></tr>";
$html .= "<tr><td style='font-size:11px;font-weight:bold;'>Vendedor</td><td>".$vendedornombre."</td></tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='2'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:11px;font-weight:bold;'></td><td style='width:500px;' ></td><td style='width:75px;font-size:11px;font-weight:bold;'></td><td style='width:75px;'>".$ven[0]['numero']."</td></tr>";

   $fecha1=$ven[0]['fecha'];
   $formatear = explode( '-' , $fecha1);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
   $html .= "<td></td><td></td><td style='font-size:11px;font-weight:bold;'>Fecha:</td><td>".$fecha."</td></tr>";

    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    if($idgrupo=='2'){
   $select1 = "numero as codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}else{
       $select1 = "codigo,idtalla";
    $from1 = "tallas";
     $where1 = "idtalla >='$rango1' AND idtalla <='$rango2' ORDER BY idtalla ASC";
    $sql21 = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
}

    $row = NumeroTuplas($sql21);
    $row1= $row['resultado'];

$select = "vi.idmodelo";
$from = "modelo vi";
$where = "idingreso='$idingreso' Group by vi.idmodelo";
   $sql25 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
    $producto = dibujarTablaitemingreso($idkardex,$sql25,$sql21,$row1,$idmarca,$rango1,$rango2,$total1,$total2,$idingreso,$formatomayor);
     $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
 if($descuentopor=='0'){
  $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'></td><td style='width:75px;text-align:right;'></td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$ven[0]['montoapagar']."</td></tr><br />";
   $html .= "</table>";
}else{
  $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:750px; font-size:11px; font-family:Tahoma;'>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'></td><td style='width:450px;'>".convertir_a_letras($t, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Descuento %:</td><td style='width:75px;text-align:right;'>".$ven[0]['descporcentaje']."</td></tr>";
    $html .= "<tr><td style='width:100px;font-size:15px;font-weight:bold;'>Son:</td><td style='width:450px;'>".convertir_a_letras($totalNeto, $ven[0]['abreviacion'])."</td><td style='font-size:15px;font-weight:bold;'>Total Descuento:</td><td style='width:75px;text-align:right;'>".$ven[0]['descuento']."</td></tr>";
    $html .= "<tr><td style='font-size:15px;font-weight:bold;'>Observaciones:</td><td>".$ven[0]['observacion']."</td><td style='font-size:15px;font-weight:bold;'>Total Venta :</td><td style='font-size:15px;font-weight:bold;text-align:right;'>".$ven[0]['montoapagar']."</td></tr><br />";
   $html .= "</table>";
   }

$html .= "</br>";
  $html .= "</br>";
  $html .= "</br>";


   $html .= "<table cellpadding='0' cellspacing='0' border-bottom=1 style='width:750px;'>";
 $html .= "<tr><td style='font-size:15px;border-bottom:1px solid #000000;font-weight:bold;'></td><td style='font-size:15px;font-weight:bold;border-top:1px solid #000000;text-align:CENTER;'>ENTREGUE CONFORME</td><td style='font-size:15px;font-weight:bold;'></td><td style='font-size:15px;border-top:1px solid #000000;font-weight:bold;text-align:LEFT;'>RECIBI CONFORME</td></tr>";


    $html .= "</table>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "<tr>";


    $html .= "</table>";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
function verdetallemodelo($idmodelo, $return)
{
     $idalmacen = $_SESSION['idalmacen'];
    $sql12 = "SELECT nombre
FROM
  almacenes
WHERE
  idalmacen = '$idalmacen'
";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "nombre");
    $tiendasesion = $saldocantidadA['resultado'];

    //    echo $idalmacen;
$fecha1 = date("Y-m-d");
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;
    $html = "";

    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "Reporte Modelo<br>";
  //  $html .= "MES PLANILLA  $mesplanilla";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
   $html .= "</tr>";
   $html .= "<tr>";
     $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql1 = "SELECT i.boleta AS proforma, i.fecha AS fechaingreso
FROM modelo m, ingresoalmacen i
WHERE m.idmodelo = '$idmodelo'
AND m.idingreso = i.idingreso ";
    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql1, "IInf registro");
    $html .= $producto['resultado'];
    $html .= "</td>";
$html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql1 = "SELECT i.*
FROM modelo m, proformas i
WHERE m.idmodelo = '$idmodelo'
AND m.idingreso = i.id_proforma";
    //    MostrarConsulta($sql);
    
    $producto = dibujarTuplaOfSQLNormal($sql1, "Inf registro proforma");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
 $sql3 = "SELECT mdd.idmarca,kar.idmodelo,kar.idalmacen,kar.idkardexunico,kar.almacen FROM kardexdetallepar kar, modelo mdd
    WHERE kar.idmodelo=mdd.idmodelo and mdd.idmodelo = '$idmodelo' group by mdd.idmodelo";

         $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmarca');
         $idmarca = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
         $idalmacen = $saldocantidadA1['resultado'];
             $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardexunico');
         $idkardexunico = $saldocantidadA1['resultado'];
           $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'almacen');
         $almaceno = $saldocantidadA1['resultado'];
$sql3="SELECT ma.formatomayor,ma.nombre FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];
     $result = findBySqlReturnCampoUnique($sql3, true, true, "nombre");
    $marca = $result['resultado'];
    $sql31="SELECT nombre FROM almacenes WHERE idalmacen= '$idalmacen' ";
    $result = findBySqlReturnCampoUnique($sql31, true, true, "nombre");
    $almacenubicacion = $result['resultado'];
            $sql = "
            SELECT '$marca' as marca,'$almacenubicacion' as UbicacionActual, SUM(kar.saldocantidad) AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle,CONCAT(emp.nombres, '-', emp.apellidos) as itemvendedor, kar.talla , mdd.cliente as item,mdd.precioventa as preciocaja,mdd.idmodelo,mdd.idmarca,mdd.idvendedor,'$almaceno' as almacen
            FROM kardexdetallepar kar, modelo mdd,empleados emp
            WHERE kar.idmodelo=mdd.idmodelo and mdd.idvendedor=emp.idempleado and mdd.idmodelo = '$idmodelo' and mdd.idmarca='$idmarca' group by kar.idmodelo";

//          if($formatomayor=='1'){
//                    $sql = "
//            SELECT '$marca' as marca,'$almacenubicacion' as UbicacionActual, SUM(kar.saldocantidad)AS cantidad,
//            kar.talla , kar.preciounitario as preciou,
//            CONCAT(c.detalle, '-', mdd.codigo) AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle,
//            CONCAT(emp.nombres, '-', emp.apellidos) as itemvendedor, kar.talla ,
//            mdd.cliente as item,mdd.precioventa as preciocaja,kar.idoperacion,mdd.idmodelo,mdd.idmarca,mdd.idvendedor,'$almaceno' as almacen
//            FROM kardexdetallepar kar, modelo mdd,coleccion c,empleados emp
//            WHERE kar.idmodelo=mdd.idmodelo and mdd.idvendedor=emp.idempleado and mdd.idcoleccion=c.idcoleccion and mdd.idmodelo = '$idmodelo'  and mdd.idmarca='$idmarca' group by kar.idmodelo";
//                 }else{
//                    $sql = "
//            SELECT '$marca' as marca,'$almacenubicacion' as UbicacionActual, SUM(kar.saldocantidad) AS cantidad,
//            kar.talla , kar.preciounitario as preciou,
//            mdd.codigo AS modelo,CONCAT(mdd.color, '-', mdd.material) AS detalle,CONCAT(emp.nombres, '-', emp.apellidos) as itemvendedor, kar.talla , mdd.cliente as item,mdd.precioventa as preciocaja,mdd.idmodelo,mdd.idmarca,mdd.idvendedor,'$almaceno' as almacen
//            FROM kardexdetallepar kar, modelo mdd,empleados emp
//            WHERE kar.idmodelo=mdd.idmodelo and mdd.idvendedor=emp.idempleado and mdd.idmodelo = '$idmodelo' and mdd.idmarca='$idmarca' group by kar.idmodelo";
//
//                }


    //    MostrarConsulta($sql);
    $producto = dibujarTuplaOfSQLNormal($sql, "INFORMACION DEL MODELO");
    $html .= $producto['resultado'];
    $html .= "</td>";

        $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT t.fecha,emp.codigo as vendedor,SUM(tr.cantidad) as pares,SUM(tr.precioventa) as precioventa,a.nombre as AlmacenVenta,t.boleta,CONCAT( c.nombre, '-', c.apellido ) AS cliente
FROM ventaitem tr,ventas t,almacenes a,clientes c,empleados emp
WHERE a.idalmacen=t.idalmacen and t.idcliente=c.idcliente and t.idvendedor=emp.idempleado and tr.idventa=t.idventa and tr.idmodelo = '$idmodelo' group by tr.idmodelo";
    $producto = dibujarTablaOfSQLNormalSimple($sql, "VENTAS");
    $html .= $producto['resultado'];
    $html .= "</td>";
      $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT tr.fecha,COUNT(tr.iddetalledevolucion) as pares,SUM(tr.valorcalzado) as monto,a.nombre as AlmacenVenta
FROM detalledevolucion tr,ventas t,almacenes a,ventaitem it
WHERE a.idalmacen=tr.idalmacen and tr.idventadetalle=t.idventa and tr.iditemventa=it.iditemventa and it.idmodelo = '$idmodelo' GRoup by it.idmodelo";
    $producto = dibujarTablaOfSQLNormalSimple($sql, "DEVOLUCION");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";

  $sql = "
SELECT tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
tra.totalcajas as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspasodetallepar tr,traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tr.iddetalletraspaso=tra.idtraspaso and tr.idmodelo = '$idmodelo' and tra.idalmacendestino = des.idalmacen  AND tra.responsable=emp.idempleado and tra.idalmacen ='$idalmacen' group by tra.idtraspaso
union all
SELECT tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
tra.totalcajas as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'RECIBIDOS' AS tipotraspaso,tra.codigo
FROM
traspasodetallepar tr,traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tr.iddetalletraspaso=tra.idtraspaso and tr.idmodelo = '$idmodelo' and tra.idalmacendestino = des.idalmacen AND tra.responsable=emp.idempleado and tra.idalmacendestino ='$idalmacen' group by tra.idtraspaso

         ";


//$sql = "SELECT t.fecha,a.nombre as AlmacenOrigen
//FROM traspasodetallepar tr,traspaso t,almacenes a
//WHERE a.idalmacen=t.idalmacen and tr.iddetalletraspaso=t.idtraspaso and tr.idmodelo = '$idmodelo' group by tr.idmodelo";

   $producto = dibujarTablaOfSQLNormalSimple($sql, "TRASPASOS");
    $html .= $producto['resultado'];
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";

    $html .="<br>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);

    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }

}
function verConsultamodeloBarra($codigobarra,$idalmacen,$return)
{

       if($idalmacen=="null" || $idalmacen==""  ){
           $idalmacen = $_SESSION['idalmacen'];
           $variable="todos";
       }else{
       $idalmacen = $idalmacen;
       $variable="uno";   }

    $sql12 = "SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "nombre");
    $tiendasesion = $saldocantidadA['resultado'];
    //    echo $idalmacen;
$fecha1 = date("Y-m-d");
$fecha2= split("-", $fecha1);
$y=$fecha2[0];
$m=$fecha2[1];
$d=$fecha2[2];
$fecha=$d."-".$m."-".$y;

    $html = "";
 $html .= "<tr><td colspan='4' align='center'>
    <p>Nova Moda S.R.L.<br />
         <br />
         Telf. 4-258993  Fax: 4-504183
    </p>
</td></tr>";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<body>";
    $html .= "<tr>";

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha";
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:100%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "CONSULTA";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
$sql3 = "SELECT mdd.idmarca,kar.idmodelo,kar.idalmacen,kar.idkardexunico,kar.idkardex,kar.idmodelo FROM
kardexdetallepar kar, modelo mdd WHERE kar.idmodelo=mdd.idmodelo and kar.codigobarra = '$codigobarra' group by kar.codigobarra";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmarca');

         $idmarca = $saldocantidadA1['resultado'];
//         $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
//         $idalmacen = $saldocantidadA1['resultado'];
         $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardexunico');
         $idkardexunico = $saldocantidadA1['resultado'];
         $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardex');
         $idkardexcaja = $saldocantidadA1['resultado'];
         $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmodelo');
         $idmodelo = $saldocantidadA1['resultado'];

$sql3="SELECT ma.formatomayor,ma.nombre FROM marcas ma WHERE ma.idmarca = '$idmarca' ";
    $result = findBySqlReturnCampoUnique($sql3, true, true, "formatomayor");
    $formatomayor = $result['resultado'];
     $result = findBySqlReturnCampoUnique($sql3, true, true, "nombre");
    $marca = $result['resultado'];
    $sql31="SELECT nombre FROM almacenes WHERE idalmacen= '$idalmacen' ";
    $result = findBySqlReturnCampoUnique($sql31, true, true, "nombre");
    $almacenubicacion = $result['resultado'];

//    $sql1 = "SELECT i.* FROM modelo m, proformas i WHERE m.idmodelo = '$idmodelo' AND m.idingreso = i.id_proforma";
//    //    sMostrarConsulta($sql);
//    $producto = dibujarTuplaOfSQLNormal($sql1, "Inf registro proforma");
//    $html .= $producto['resultado'];
    $html .= "</td>";
$html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $select = "i.id_proforma,i.nombre,i.fecha,i.almacen,i.marca";
    $from = "modelo m, proformas i,kardexdetallepar kp";
    $where = "kp.idmodelo=m.idmodelo and m.idingreso = i.id_proforma and i.id_proforma=kp.idingreso and kp.codigobarra = '$codigobarra' AND kp.idalmacen = '$idalmacen'";
   $sql1 = "SELECT $select FROM $from WHERE $where GROUP BY kp.idingreso ";
 
//    $producto = dibujarTuplaOfSQLNormal($sql1, "Inf registro proforma");
//    $html .= $producto['resultado'];
     $productoa = dibujarTablaOfSQLNormalSimple($sql1, "Inf registro proforma");
     $html .= $productoa['resultado'];
    $html .= "</td>";
   $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";


         $sql4 = "
            SELECT '$marca' as marca,alm.nombre as UbicacionActual, SUM(kar.saldocantidad) AS cantidad,
            kar.talla , kar.preciounitario as preciou,
            mdd.codigo AS modelo,emp.nombres as vendedor,CONCAT(mdd.color, '-', mdd.material) AS detalle, kar.talla , mdd.cliente as item,mdd.precioventa as preciocaja,mdd.fechaingreso,kar.idmodelo
            FROM kardexdetallepar kar, modelo mdd,empleados emp,almacenes alm
            WHERE  mdd.idvendedor=emp.idempleado and kar.idmodelo=mdd.idmodelo and kar.idalmacen=alm.idalmacen and kar.codigobarra = '$codigobarra' and mdd.idmarca='$idmarca' and kar.idalmacen='$idalmacen' group by kar.idmodelo";

    //  echo $sql4;
    $producto = dibujarTablaOfSQLNormalSimple($sql4, "INFORMACION DEL MODELO");
   // $producto = dibujarTuplaOfSQLNormal($sql, "INFORMACION DEL MODELO");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
//   $select = "i.id_proforma,i.nombre,i.fecha,i.almacen,i.marca";
//    $from = "modelo m, proformas i,kardexdetallepar kp";
//    $where = "kp.idmodelo=m.idmodelo and m.idingreso = i.id_proforma and i.id_proforma=kp.idingreso and kp.codigobarra = '$codigobarra' AND kp.idalmacen = '$idalmacen'";
//   $sql1 = "SELECT $select FROM $from WHERE $where GROUP BY kp.idingreso ";
//$sql = "SELECT t.fecha,tr.precioventa,a.nombre as AlmacenVenta,t.boleta,CONCAT( c.nombre, '-', c.apellido ) AS cliente,CONCAT( em.nombres, '-', em.apellidos ) AS vendedor
//FROM ventaitem tr,ventas t,almacenes a,clientes c,empleados em
//WHERE a.idalmacen=t.idalmacen and t.idcliente=c.idcliente and t.idvendedor=em.idempleado and tr.idventa=t.idventa and tr.idkardexunico = '$idkardexunico' ";


$sql4 = "SELECT t.fecha,tr.precioventa,a.nombre as AlmacenVenta,t.boleta,CONCAT( c.nombre, '-', c.apellido ) AS cliente,CONCAT( em.nombres, '-', em.apellidos ) AS vendedor
FROM ventaitem tr,ventas t,almacenes a,clientes c,empleados em,kardexdetallepar kp
WHERE a.idalmacen=t.idalmacen and kp.idkardexunico=tr.idkardexunico and t.idcliente=c.idcliente and t.idvendedor=em.idempleado and tr.idventa=t.idventa and kp.codigobarra = '$codigobarra' AND kp.idalmacen = '$idalmacen' group by tr.idventa";

    $producto = dibujarTablaOfSQLNormalSimple($sql4, "VENTAS");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT tr.fecha,CONCAT( em.nombres, '-', em.apellidos ) AS vendedor,d.dato as Boleta,tr.valorcalzado,a.nombre as AlmacenVenta
     FROM detalledevolucion tr,ventas t,almacenes a,kardexdetallepar kp,devolucion d,empleados em
     WHERE d.iddevolucion=tr.iddevolucion and a.idalmacen=tr.idalmacen and d.idvendedor=em.idempleado and kp.idkardexunico=tr.idkardexunico and tr.idventadetalle=t.idventa and kp.codigobarra = '$codigobarra' AND kp.idalmacen = '$idalmacen' group by tr.iddevolucion";
    $producto = dibujarTablaOfSQLNormalSimple($sql, "DEVOLUCION");
    $html .= $producto['resultado'];
    $html .= "</td>";

    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $sql = "SELECT t.fecha,a.nombre as AlmacenOrigen
FROM traspasodetallepar tr,traspaso t,almacenes a,kardexdetallepar kp
WHERE a.idalmacen=t.idalmacen and tr.iddetalletraspaso=t.idtraspaso and kp.idkardexunico=tr.idkardexunico and kp.codigobarra = '$codigobarra' AND kp.idalmacen = '$idalmacen' group by tr.iddetalletraspaso";
     $sql = "
SELECT tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
tra.totalcajas as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspasodetallepar tr,traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des,kardexdetallepar kp
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tr.iddetalletraspaso=tra.idtraspaso and kp.idkardexunico=tr.idkardexunico and kp.codigobarra = '$codigobarra' and tra.idalmacendestino = des.idalmacen  and tra.idalmacen ='$idalmacen' AND tra.responsable=emp.idempleado group by tra.idtraspaso
union all
SELECT tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
tra.totalcajas as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'RECIBIDOS' AS tipotraspaso,tra.codigo
FROM
traspasodetallepar tr,traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des,kardexdetallepar kp
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tr.iddetalletraspaso=tra.idtraspaso and kp.idkardexunico=tr.idkardexunico and kp.codigobarra = '$codigobarra' and tra.idalmacendestino = des.idalmacen and tra.idalmacendestino ='$idalmacen' AND tra.responsable=emp.idempleado group by tra.idtraspaso

         ";

    $producto = dibujarTablaOfSQLNormalSimple($sql, "TRASPASOS");
    $html .= $producto['resultado'];
    $html .= "</td>";

    //ver otros pares
     $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;'>";
  $sql = "SELECT idmodelo,codigobarra,talla,saldocantidad
FROM kardexdetallepar
WHERE codigobarra = '$codigobarra' and idalmacen='$idalmacen' order by idmodelo";
    $producto = dibujarTablaOfSQLNormalSimple($sql, "PARES adicionales de la misma caja");
    $html .= $producto['resultado'];
    $html .= "</td>";
    $html .= "<td style='width:33%;text-align:right;font-size:11px;font-family:Tahoma;' valign='top'>";

    $html .="<br>";
    $html .= "</td>";
    $html .= "<td style='width:33%;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";

    $html .= "</td>";
    $html .= "</tr>";
    //$html .= "<tr>";
    //    $html .= "<td>";
     $mesplanilla = $idalmacenA1['resultado'];
     $idsCAr = split("/", $mesplanilla);

    //$html .= "<td style='width:400px;height:100px;border-bottom:1px solid #000000;'><img style='height:100px;' src='logo.jpg'>";
   // $html .= "<td style='width:200px;height:100px;border-bottom:1px solid #000000;text-align:right;font-size:11px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;'>";
   // $html .= "<tr><tr>";
    $html .= "<tr><td align='right' style='font-size:11px; font-family:Tahoma; text-align:center;font-weight:bold;'><td><tr>";


    $html .= "</table>";
   // $html .= "</td>";
  //  $html .= "</tr>";

    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}
