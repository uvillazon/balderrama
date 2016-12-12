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
function poroficinamesreporte($idalmacen, $mescierre, $opcionrep, $return)
{
    // $almacen = $idalmacen;
    $mesproceso = $mescierre;
    $sql[] = "DELETE FROM tempreporte";
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $html = "elimino";
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
    ////    $html .= "Oficina: CBOF Mes: $mescierre";
    $html .= "</td>";
    $html .= "<tr>";
    $html .= "<td style='width:110%;height:100px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    //$html .= "REPORTE<br>";
    if($opcionrep==1){
        $html .= "  COBRO - SUELDO correspondiente al mes $mesproceso<br>";
    }
    else{
        if($opcionrep==2){
            $html .= " COBRO - MOROSIDAD correspondiente al mes $mesproceso<br>";
        }
        else{
            if($opcionrep==3){
                $html .= "RESUMEN COBRO - SUELDO<br>";
            }
            else{
                if($opcionrep==4){
                    $html .= "RESUMEN COBRO - MOROSIDAD correspondiente al mes $mesproceso<br>";
                }
            }
        }
    }
    $html .= "Correspondiente al mes $mesproceso<br>";
    $html .= "OFICINA CBOF <br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";
    $select = "v.idempleado, v.codigo, CONCAT( UPPER(v.nombres), '-', UPPER(v.apellidos) )AS vendedor";
    $from = "empleados v, creditomayor cm";
    $where = "v.idempleado = cm.idvendedor and cm.idalmacen = '$idalmacen' and cm.mescierre = '$mesproceso'";
    $sql2 = "SELECT ".$select." FROM ".$from. " WHERE ".$where." GROUP by cm.idvendedor ORDER BY v.nombres";
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
        if($opcionrep==1 || $opcionrep==2){
            $table = dibujarTablaOficinaMes($sql25,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mesproceso,$idalmacen,$opcionrep);
        }
        else{
            if($opcionrep==3 || $opcionrep==4){
                $table = dibujarTablaOficinaMesResumen($sql25,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mesproceso,$idalmacen,$opcionrep);
            }
        }
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
    if($opcionrep==3){
        $select1 = "'-' AS Totales, SUM(tr.ctascobrar) as CuentasxCobrar, SUM(tr.ventasus) as Ventas, SUM(tr.pago) AS Cobros,
                    SUM(tr.rebaja) as RebajasCobro, SUM(tr.impcalcular) AS ImporteCalcular, SUM(tr.sueldopagar) AS SueldoPagar";
        $from1 = "tempreporte tr, almacenes a";
        $where1 = " tr.idalmacen = a.idalmacen and tr.mescierre = '$mescierre'";
        $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by tr.idalmacen";
        $sqlrutafin = $sqlruta;

        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'CuentasxCobrar');
        $ctascobrar = $idalmacenA['resultado'];
        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Ventas');
        $ventasus = $idalmacenA['resultado'];
        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Cobros');
        $pago= $idalmacenA['resultado'];
        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'RebajasCobro');
        $rebaja = $idalmacenA['resultado'];
        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'ImporteCalcular');
        $impcalcular = $idalmacenA['resultado'];
        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SueldoPagar');
        $sueldopagar = $idalmacenA['resultado'];
        $table = dibujarTablaOficMesTotal($sqlrutafin, $nombrevendedor,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,opcionr);
    }
    else{
        if($opcionrep==4){
            $select1 = "'-' AS Totales, SUM(tr.ctascobrar) as MenorA30Dias, SUM(tr.ventasus) as A30Dias, SUM(tr.rebaja) as A90Dias, SUM(tr.pago) AS A120Dias, SUM(tr.impcalcular) as Total";
            $from1 = "tempreporte tr, almacenes a";
            $where1 = " tr.idalmacen = a.idalmacen and tr.mescierre = '$mescierre'";
            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by tr.idalmacen";
            $sqlrutafin = $sqlruta;

            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'MenorA30Dias');
            $MenorA30Dias = $idalmacenA['resultado'];
            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A30Dias');
            $A30Dias = $idalmacenA['resultado'];
            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A90Dias');
            $A90Dias = $idalmacenA['resultado'];
            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A120Dias');
            $A120Dias= $idalmacenA['resultado'];
            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Total');
            $impcalcular = $idalmacenA['resultado'];
            $sueldopagar = 0;
            $table = dibujarTablaOficMesTotal($sqlrutafin, $nombrevendedor,$MenorA30Dias,$A30Dias,$A90Dias,$A120Dias,$impcalcular,$sueldopagar,opcionr);
        }
    }
    $html .= $table['resultado'];
    $html .= "</tr>";
    $html .= "</tr>";
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


function dibujarTablaOficinaMes($sql,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mescierre,$idalmacen,$opcionr)
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
                            if ($opcionr==1){
                                CargarTablaTemporalReporte1($idmarca,$idvendedor,$idalmacen,$mescierre,$opcionr,false);
                                $select1 = " CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS Cliente, tr.ctascobrar as CuentasxCobrar,
                                            tr.ventasus as Ventas, tr.pago AS Cobros, tr.rebaja as RebajaCobro, tr.impcalcular AS ImporteCalcular, tr.sueldopagar AS SueldoPagar";
                                $from1 = "tempreporte tr, clientes c";
                                $where1 = " tr.idcliente = c.idcliente and tr.idmarca = '$idmarca' and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                                $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ORDER BY c.nombre";
                                $sqlrutafin = $sqlruta;

                                $select = "SUM(tr.ctascobrar) as monto";
                                $select1 = "SUM(tr.ventasus) as monto";
                                $select2 = "SUM(tr.rebaja) as monto";
                                $select3 = "SUM(tr.pago) as monto";
                                $select4 = "SUM(tr.impcalcular) as monto";
                                $select5 = "SUM(tr.sueldopagar) as monto";
                                $from = "tempreporte tr, clientes c";
                                $where = "tr.idcliente = c.idcliente and tr.idmarca = '$idmarca' and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                                $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $ctascobrar = $idalmacenA['resultado'];
                                $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $ventasus = $idalmacenA['resultado'];
                                $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $rebaja = $idalmacenA['resultado'];
                                $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $pago= $idalmacenA['resultado'];
                                $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $impcalcular = $idalmacenA['resultado'];
                                $sql251 = "SELECT ".$select5." FROM ".$from." WHERE ".$where." ";
                                $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                $sueldopagar = $idalmacenA['resultado'];
                                $marcalista = $marcalista."-".$codigoempleado;
                                $table = dibujarTablaOficMes($sqlrutafin,$marcalista,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,$opcionr);
                            }
                            else{
                                if ($opcionr==2){
                                    CargarTablaTemporalReporte2($idmarca,$idvendedor,$idalmacen,$mescierre,false);
                                    $select1 = " CONCAT( UPPER(c.nombre), '-', UPPER(c.apellido) )AS Cliente, SUM(tr.ctascobrar) as MenorA30Dias,
                                                SUM(tr.ventasus) as A30Dias, SUM(tr.rebaja) as A90Dias, SUM(tr.pago) AS A120Dias, SUM(tr.impcalcular) as Total";
                                    $from1 = "tempreporte tr, clientes c";
                                    $where1 = " tr.idcliente = c.idcliente and tr.idmarca = '$idmarca' and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                                    $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." GROUP BY c.nombre, c.apellido ORDER BY c.nombre";
                                    $sqlrutafin = $sqlruta;

                                    $select = "SUM(tr.ctascobrar) as monto";
                                    $select1 = "SUM(tr.ventasus) as monto";
                                    $select2 = "SUM(tr.rebaja) as monto";
                                    $select3 = "SUM(tr.pago) as monto";
                                    $select4 = "SUM(tr.impcalcular) as monto";
                                    $from = "tempreporte tr, clientes c";
                                    $where = "tr.idcliente = c.idcliente and tr.idmarca = '$idmarca' and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                                    $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                    $adias = $idalmacenA['resultado'];
                                    $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                    $a30dias = $idalmacenA['resultado'];
                                    $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                    $a90dias = $idalmacenA['resultado'];
                                    $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                    $a120dias = $idalmacenA['resultado'];
                                    $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                                    $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                                    $impcalcular = $idalmacenA['resultado'];
                                    $sueldopagar = 0;
                                    $marcalista = $marcalista."-".$codigoempleado;
                                    $table = dibujarTablaOficMes($sqlrutafin,$marcalista,$adias,$a30dias,$a90dias,$a120dias,$impcalcular,$sueldopagar,$opcionr);
                                }
                            }
                            $devS .= $table['resultado'];
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    if ($opcionr==1){
                        $select1 = "'-' AS Totales, SUM(tr.ctascobrar) as CuentasxCobrar, SUM(tr.ventasus) as Ventas, SUM(tr.pago) AS Cobros, SUM(tr.rebaja) as RebajaCobro,
                                    SUM(tr.impcalcular) AS ImporteCalcular, SUM(tr.sueldopagar) AS SueldoPagar";
                        $from1 = "tempreporte tr, marcas m";
                        $where1 = " tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                        $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by tr.idvendedor";
                        $sqlrutafin = $sqlruta;

                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'CuentasxCobrar');
                        $ctascobrar = $idalmacenA['resultado'];
                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Ventas');
                        $ventasus = $idalmacenA['resultado'];
                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'RebajaCobro');
                        $rebaja = $idalmacenA['resultado'];
                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Cobros');
                        $pago= $idalmacenA['resultado'];
                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'ImporteCalcular');
                        $impcalcular = $idalmacenA['resultado'];
                        $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'SueldoPagar');
                        $sueldopagar = $idalmacenA['resultado'];
                        $table = dibujarTablaOficMesTotal($sqlrutafin, $nombrevendedor,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,opcionr);
                    }
                    else{
                        if ($opcionr==2){
                            $select1 = "'-' AS Totales, SUM(tr.ctascobrar) as MenorA30Dias, SUM(tr.ventasus) as A30Dias, SUM(tr.rebaja) as A90Dias, SUM(tr.pago) AS A120Dias, SUM(tr.impcalcular) as Total";
                            $from1 = "tempreporte tr, marcas m";
                            $where1 = " tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by tr.idvendedor";
                            $sqlrutafin = $sqlruta;

                            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'MenorA30Dias');
                            $MenorA30Dias = $idalmacenA['resultado'];
                            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A30Dias');
                            $A30Dias = $idalmacenA['resultado'];
                            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A90Dias');
                            $A90Dias = $idalmacenA['resultado'];
                            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'A120Dias');
                            $A120Dias= $idalmacenA['resultado'];
                            $idalmacenA =  findBySqlReturnCampoUnique($sqlruta, true, true, 'Total');
                            $impcalcular = $idalmacenA['resultado'];
                            $sueldopagar = 0;
                            $table = dibujarTablaOficMesTotal($sqlrutafin, $nombrevendedor,$MenorA30Dias,$A30Dias,$A90Dias,$A120Dias,$impcalcular,$sueldopagar,opcionr);
                        }
                    }
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

function dibujarTablaOficinaMesResumen($sql,$idcliente,$idvendedor,$nombrevendedor,$codigoempleado,$mescierre,$idalmacen,$opcionr)
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
                            if ($opcionr==3){
                                CargarTablaTemporalReporte1($idmarca,$idvendedor,$idalmacen,$mescierre,$opcionr,false);
                            }
                            else{
                                if ($opcionr==4){
                                    CargarTablaTemporalReporte2($idmarca,$idvendedor,$idalmacen,$mescierre,false);
                                }
                            }
                        }
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    if ($opcionr==3){
                        $select1 = "m.nombre AS NombreMarcas, tr.ctascobrar as CuentasxCobrar, tr.ventasus as Ventas,
                                    tr.pago AS Cobros, tr.rebaja as RebajaCobro, tr.impcalcular AS ImporteCalcular, tr.sueldopagar AS SueldoPagar";
                        $from1 = "tempreporte tr, marcas m";
                        $where1 = " tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                        $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." ORDER BY m.nombre";
                        $sqlrutafin = $sqlruta;

                        $select = "SUM(tr.ctascobrar) as monto";
                        $select1 = "SUM(tr.ventasus) as monto";
                        $select2 = "SUM(tr.rebaja) as monto";
                        $select3 = "SUM(tr.pago) as monto";
                        $select4 = "SUM(tr.impcalcular) as monto";
                        $select5 = "SUM(tr.sueldopagar) as monto";
                        $from = "tempreporte tr, marcas m";
                        $where = "tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                        $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        $ctascobrar = $idalmacenA['resultado'];
                        $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        $ventasus = $idalmacenA['resultado'];
                        $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        $rebaja = $idalmacenA['resultado'];
                        $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        $pago= $idalmacenA['resultado'];
                        $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');

                        $impcalcular = $idalmacenA['resultado'];
                        $sql251 = "SELECT ".$select5." FROM ".$from." WHERE ".$where." ";
                        $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        $sueldopagar = $idalmacenA['resultado'];
                        //$marcalista = $marcalista."-".$codigoempleado;
                        $table = dibujarTablaOficMes($sqlrutafin,$marcalista,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,$opcionr);
                        $devS .= $table['resultado'];
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                        $devS .= "</tr>";
                    }
                    else{
                        if ($opcionr==4){
                            $select1 = "m.nombre AS NombreMarcas, SUM(tr.ctascobrar) as MenorA30Dias, SUM(tr.ventasus) as A30Dias,
                                        SUM(tr.rebaja) as A90Dias, SUM(tr.pago) AS A120Dias, SUM(tr.impcalcular) as Total";
                            $from1 = "tempreporte tr, marcas m";
                            $where1 = " tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." GROUP BY m.nombre ORDER BY m.nombre";
                            $sqlrutafin = $sqlruta;

                            $select = "SUM(tr.ctascobrar) as monto";
                            $select1 = "SUM(tr.ventasus) as monto";
                            $select2 = "SUM(tr.rebaja) as monto";
                            $select3 = "SUM(tr.pago) as monto";
                            $select4 = "SUM(tr.impcalcular) as monto";
                            $from = "tempreporte tr, marcas m";
                            $where = "tr.idmarca = m.idmarca and tr.idvendedor = '$idvendedor' and tr.idalmacen = '$idalmacen' and tr.mescierre = '$mescierre'";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $adias = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select1." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $a30dias = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $a90dias = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select3." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $a120dias = $idalmacenA['resultado'];
                            $sql251 = "SELECT ".$select4." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $impcalcular = $idalmacenA['resultado'];
                            $sueldopagar = 0;
                            //$marcalista = $marcalista."-".$codigoempleado;
                            $table = dibujarTablaOficMes($sqlrutafin,$marcalista,$adias,$a30dias,$a90dias,$a120dias,$impcalcular,$sueldopagar,$opcionr);
                            $devS .= $table['resultado'];
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";
                            $devS .= "</tr>";
                        }
                    }
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

function CargarTablaTemporalReporte1($idmarca,$idvendedor,$idalmacen,$mescierre,$opcionr,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    if($opcionr==3){
        $sql1 = "SELECT cm.idmarca, SUM(cm.saldoact+cm.ventasus) as ctascobrar, SUM(cm.ventasus) as ventasus, SUM(cm.rebaja) as rebaja, SUM(cm.pago) as pago FROM creditomayor cm, marcas m
                 WHERE cm.idmarca = m.idmarca and cm.idmarca = '$idmarca' and cm.idvendedor = '$idvendedor' and cm.idalmacen = '$idalmacen' and cm.mescierre = '$mescierre' GROUP BY cm.idmarca";
    }
    else{
        $sql1 = "SELECT cm.idcliente, (cm.saldoact+cm.ventasus) as ctascobrar, cm.ventasus, cm.rebaja, cm.pago FROM creditomayor cm, clientes c
                 WHERE cm.idcliente = c.idcliente and cm.idmarca = '$idmarca' and cm.idvendedor = '$idvendedor' and cm.idalmacen = '$idalmacen' and cm.mescierre = '$mescierre'";
    }
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $row1 = NumeroTuplas($sql1);
    $row11 = $row1['resultado'];
    for($i=0; $i<=$row11; $i++){
        $paresd = $sql3[$i];
        if($opcionr==3){
            $idcliente = 0;
        }
        else{
            $idcliente = $paresd['idcliente'];
        }
        $ctascobrar = $paresd['ctascobrar'];
        $ventasus = $paresd['ventasus'];
        $rebaja = $paresd['rebaja'];
        $pago = $paresd['pago'];
        $cobromes = $pago + $rebaja;
        $porcentaje = 0.05;
        if($idmarca=='mar-33'||$idmarca=='mar-34'||$idmarca=='mar-35'||$idmarca=='mar-46'||$idmarca=='mar-48'){
            $porcentaje = 0.04;
        }
        else{
            $porcentaje = 0.05;
        }
        if($idmarca=='mar-45'||$idmarca=='mar-3'||$idmarca=='mar-32'){
            $impcalcular = $pago;
            $sueldopagar = $impcalcular * $porcentaje;
        }
        else{
            if($ventasus==$cobromes){
                $impcalcular = $pago;
                $sueldopagar = $impcalcular * $porcentaje;
            }
            if($ventasus>$cobromes){
                $impcalcular = $pago-($ventasus-$cobromes);
                $sueldopagar = $impcalcular * $porcentaje;
            }
            if($cobromes>$ventasus){
                $impcalcular = $pago;
                $sueldopagar = $impcalcular * $porcentaje;
            }
            if($ventasus==0&&$cobromes==0){
                $impcalcular = 0;
                $sueldopagar = 0;
            }
        }
        if($ctascobrar==0){
        }
        else{
            $sql[] =getSqlNewReporteinsert($idalmacen, $idvendedor, $idmarca, $idcliente, $ctascobrar, $ventasus, $rebaja, $pago, $impcalcular, $sueldopagar, $mescierre, false);
            //mostrarconsulta($sql);
        }
    }
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se proceso correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    //    else
    //    {
    //        $dev['mensaje'] = "Ocurrio un error";
    //        $dev['error'] = "false";
    //        $dev['resultado'] = "";
    //    }
    if($return == true)
    {
        return $dev;
    }
    //    else
    //    {
    //        $json = new Services_JSON();
    //        $output = $json->encode($dev);
    //        print($output);
    //    }
}

function CargarTablaTemporalReporte2($idmarca,$idvendedor,$idalmacen,$mescierre,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $fechatoday = Date("Y-m-d");
    $sql1 = "SELECT cm.idcliente, datediff('$fechatoday',cl.fechaventa) as dias, cl.porpagar FROM creditomayor cm, creditocliente cl
            WHERE cm.idcreditocli = cl.idcredito and cm.idcliente = cl.idcliente and cm.idmarca = cl.idmarca and cm.idvendedor = cl.idvendedor
            and cm.idmarca = '$idmarca' and cm.idvendedor = '$idvendedor' and cm.idalmacen = '$idalmacen' and cm.mescierre = '$mescierre' and cl.estado = 'pendiente'";
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $row1 = NumeroTuplas($sql1);
    $row11 = $row1['resultado'];
    for($i=0; $i<=$row11; $i++){
        $paresd = $sql3[$i];
        $idcliente = $paresd['idcliente'];
        $dias = $paresd['dias'];
        $porpagar = $paresd['porpagar'];
        $adias = 0;
        $a30dias = 0;
        $a90dias = 0;
        $a120dias = 0;
        $Total = 0;
        if($dias<30){
            $adias = $porpagar;
        }
        if($dias>=30 && $dias<90){
            $a30dias = $porpagar;
        }
        if($dias>=90 && $dias<120){
            $a90dias = $porpagar;
        }
        if($dias>=120){
            $a120dias = $porpagar;
        }
        $total = $adias + $a30dias + $a90dias + $a120dias;
        $sql[] =getSqlNewReporteinsert($idalmacen, $idvendedor, $idmarca, $idcliente, $adias, $a30dias, $a90dias, $a120dias, $total, 0, $mescierre, false);
        //mostrarconsulta($sql);
    }
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se proceso correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    //    else
    //    {
    //        $dev['mensaje'] = "Ocurrio un error";
    //        $dev['error'] = "false";
    //        $dev['resultado'] = "";
    //    }
    if($return == true)
    {
        return $dev;
    }
    //    else
    //    {
    //        $json = new Services_JSON();
    //        $output = $json->encode($dev);
    //        print($output);
    //    }
}

function getSqlNewReporteinsert($idalmacen, $idvendedor, $idmarca, $idcliente, $ctascobrar, $ventasus, $rebaja, $pago, $impcalcular, $sueldopagar, $mescierre, $return){
    $setC[0]['campo'] = 'idalmacen';
    $setC[0]['dato'] = $idalmacen;
    $setC[1]['campo'] = 'idvendedor';
    $setC[1]['dato'] = $idvendedor;
    $setC[2]['campo'] = 'idmarca';
    $setC[2]['dato'] = $idmarca;
    $setC[3]['campo'] = 'idcliente';
    $setC[3]['dato'] = $idcliente;
    $setC[4]['campo'] = 'ctascobrar';
    $setC[4]['dato'] = $ctascobrar;
    $setC[5]['campo'] = 'ventasus';
    $setC[5]['dato'] = $ventasus;
    $setC[6]['campo'] = 'rebaja';
    $setC[6]['dato'] = $rebaja;
    $setC[7]['campo'] = 'pago';
    $setC[7]['dato'] = $pago;
    $setC[8]['campo'] = 'impcalcular';
    $setC[8]['dato'] = $impcalcular;
    $setC[9]['campo'] = 'sueldopagar';
    $setC[9]['dato'] = $sueldopagar;
    $setC[10]['campo'] = 'mescierre';
    $setC[10]['dato'] = $mescierre;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO tempreporte ".$sql2;
}

function dibujarTablaOficMes($sql, $titulo,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,$opcionr)
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
                    if($opcionr==1){
                        $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                        $devS .= "<td style='display:none;'></td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ctascobrar."&nbsp;</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$impcalcular."&nbsp;</td>";
                        $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$sueldopagar."&nbsp;</td>";
                    }
                    else{
                        if($opcionr==2){
                            $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                            $devS .= "<td style='display:none;'></td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ctascobrar."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$impcalcular."&nbsp;</td>";
                        }
                        else{
                            if($opcionr==3){
                                $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                                $devS .= "<td style='display:none;'></td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ctascobrar."&nbsp;</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$impcalcular."&nbsp;</td>";
                                $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$sueldopagar."&nbsp;</td>";
                            }
                            else{
                                if($opcionr==4){
                                    $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                                    $devS .= "<td style='display:none;'></td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>TOTAL $titulo</td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ctascobrar."&nbsp;</td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ventasus."&nbsp;</td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$pago."&nbsp;</td>";
                                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$impcalcular."&nbsp;</td>";
                                }
                            }
                        }
                    }
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

function dibujarTablaOficMesTotal($sql, $titulo,$ctascobrar,$ventasus,$rebaja,$pago,$impcalcular,$sueldopagar,$opcionr)
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

