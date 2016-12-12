<?php
session_name("balderrama");
session_start();
function VerRecapitulacionMarcaFeria($idalmacen,$idalmacen2,$idkardex,$fechainicio,$fechafin, $return)
{$today = Date("Y-m-d");
    $html = "";
    $html .= "<tr><td colspan='4' align='center'>
    <p>Nova Moda S.R.L.<br />
         <br />
         Telf. 4-258993  Fax: 4-504183
<br />
$today
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
    $sql = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";

    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
    $marcalista = $idalmacenA2['resultado'];
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'talla');
    $opcionmarca = $idalmacenA2['resultado'];
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'opcionb');
    $opcionb = $idalmacenA2['resultado'];
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'pedido');
    $marcapedido = $idalmacenA2['resultado'];
    $idsCAr = split("-", $opcionmarca);
    $rango1=$idsCAr[0];
    $rango2=$idsCAr[1];
    if($opcionmarca="33-45"){         $tipo="1";
    }else{ if($opcionmarca="14-38"){
            $tipo="3";
           }
    }
    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' and idalmacen='$idalmacen' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];

    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin,mesanterior,estado FROM administrakardex WHERE  mesrango= '$idkardex' and idalmacen='$idalmacen'";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];

    }else{
        $sqlmarca = " SELECT * FROM administrakardex WHERE idkardex = '$idkardex' ";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];
    }
    //echo $sqlmarca;
    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }

    $formatear = explode( '-' , $fechainicio);
    $fechain = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $formatear = explode( '-' , $fechafin);
    $fechaf = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $mesplani=substr($mesrango,0,2);
    $anioplani=substr($mesrango,2,5);
    if($mesplani == "01") { $mes="ENERO";  }
    if($mesplani == "02") { $mes="FEBRERO"; }
    if($mesplani == "03") {
        $mes="MARZO";
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
    $sqlmarca = " SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $deptocapital = $opcionkardex['resultado'];
    $html .= "<td style='width:100%;height:50px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<b><u>RESUMEN CAPITAL DE OPERACIONES</u></b><br>";
    if($idalmacen==null || $idalmacen=='null'){
        $html .= "<b><u>TODOS LOS DEPARTAMENTOS</u></b><br>";
    }else{
        $html .= "<b><u>OFICINA $deptocapital</u></b><br>";
    }
    $html .= "<b><u>CORRESPONDIENTE AL MES DE $mes :  DEL $fechain AL $fechaf </u></b><br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "idmarca";
    $from = "marcas ";
    $where = " estado='activo' and origen='BRASIL' ";
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
        $table = dibujarTablaferiarecap($idkardex,$sql25,$sql21,$row1,$idmara,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido);
        $html .= $table['resultado'];
    }

    $sqlrutafin = " SELECT idkardex FROM administrakardex WHERE idalmacen='$idalmacen' and estado='pendiente' ";
    $table = dibujarTablaresumentotalrecapitulacionferia($sqlrutafin,$idkardex, "TOTALES");
    $html .= $table['resultado'];

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

function dibujarTablaresumentotalrecapitulacionferia($sql,$idkardex, $titulo)
{   $idalmacen=$_SESSION['idalmacen'];

    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' and idalmacen='$idalmacen' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT * FROM administrakardex WHERE  mesrango= '$idkardex' and idalmacen='$idalmacen'";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
        $fechainicio = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
        $fechafin = $opcionkardex['resultado'];
    }else{
        $sqlmarca = " SELECT * FROM administrakardex WHERE idkardex = '$idkar' ";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
        $fechainicio = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
        $fechafin = $opcionkardex['resultado'];
    }
    //echo $sqlmarca;
    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }


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
                    $devS .= "<td colspan='3' align='center' style='border:1px solid #000000'>STOCK MERCADERIA</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >RECIBIDOS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP DESP.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP REC.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
                    $devS .= "<td colspan='2' align='center'  style='border:1px solid #000000' >COBROS</td>";
                    //$devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>COBROS</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >STOCK ACTUAL</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Rebajas</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Reb-Inv</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>-</td>";

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
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Reb</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";

                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>-</td>";

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
                    $trebajas =0;
                    $tcuentas =0;
                    $tcajasstact =0;
                    $tparesstact =0;
                    $ttotalbsstact =0;
                    $ttotalbs =0;
                    $trebaja =0;
                    $trebajainventario =0;
                    $tporcentaje =0;
                    do{
                        //           $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                            $iddetalleingreso = $fi[$i]['idempleado'];

                            //  $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$titulo."</td>";
                            if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
                            if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
                            if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

//recibidos total
                            $select = "SUM(k.totalcajas) AS Pares";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= " k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' and k.idalmacen='$idalmacen'";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalcajasrecibido = $almacenA1['resultado'];
                            //  echo $sqlEgreso;
                            $select = "SUM(kp.saldocantidad) AS Pares";
                            $from = "ingresoalmacen i,kardexdetalleparingreso kp";
                            $where = "";
                            { $where .= " i.idingreso=kp.idingreso AND i.fecha >= '$fechainicio' AND
i.fecha <= '$fechafin' and i.idalmacen='$idalmacen'";}
                            $sql25a = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25a, true, true, 'Pares');
                            $totalparesrecibido = $almacenA1['resultado'];

                          $selectm = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario*(6.96)) AS sus ";
                          $fromm = "modelo m,kardexdetallepar kp,modelo as m2,proformas p";
                          $wherem = "kp.idmodelo=m.idmodelo and m.idingreso=p.id_proforma and m2.estadotraspaso=m.idmodelo and p.nombre!='00/2016'";
                           { $wherem .= " AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen'";}
                        //   { $wherem .= " AND p.fecha >= '$fechainicio' AND p.fecha <= '$fechafin'  AND p.idalmacen='$idalmacen'";}

                        $sql251 = "SELECT ".$selectm." FROM ".$fromm." WHERE ".$wherem;
                      //  echo $sql251;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql251, true, true, 'Pares');
                            $totalparesrecibidonuevo = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql251, true, true, 'sus');
                            $totalbsrecibidonuevo = $almacenA1['resultado'];

                           $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario*(6.96)) AS sus";
                            $from1 = "modelo m,kardexdetallepar kp,proformas p";
                            $where1 = "m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and m.estadotraspaso='ninguno' and p.nombre!='00/2016' ";
                          { $where1 .= " AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen' and m.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' and m.boleta=p.id_proforma";}
 //{ $where1 .= " AND p.fecha >= '$fechainicio' AND p.fecha <= '$fechafin'  AND p.idalmacen='$idalmacen' and m.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' and m.boleta=p.id_proforma";}

                            $sql25c = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
                            //echo $sql25c;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25c, true, true, 'Pares');
                            $totalparesrecibidonuevotraspaso = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25c, true, true, 'sus');
                            $totalbsrecibidonuevotraspaso = $almacenA1['resultado'];
                            $totalparesrecibido =$totalparesrecibido + $totalparesrecibidonuevo + $totalparesrecibidonuevotraspaso;

                            $select = "SUM(k.totalbs) AS totalprecio";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= "k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' and k.idalmacen='$idalmacen' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'totalprecio');
                            $totalbsrecibido = $almacenA1['resultado'];
                            $totalbsrecibido = $totalbsrecibido + $totalbsrecibidonuevo + $totalbsrecibidonuevotraspaso;
                            $totalcajasnuevo = $totalparesrecibido/12;
                            $totalcajasrecibido = $totalcajasrecibido + $totalcajasnuevo;
                            $totalcajasrecibido = round($totalcajasrecibido,2);

                            //traspasos entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario*(6.96)) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasenvinterno= $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasenviinterno = $almacenA1['resultado'];

                            $sqlEgresoq ="SELECT SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario*(6.96)) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and t.idalmacen='$idalmacen' and it.idmodeloorigen=mdd.idmodelo and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
   ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgresoq, true, true, 'Pares');
                            $partraspenv = $almacenA1['resultado'];
                            $partraspenv=$partraspenv+$parestrasenvinterno;
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgresoq, true, true, 'TotalBs');
                            $sustraspenv = $almacenA1['resultado'];
                            $sustraspenv=$sustraspenv+$bstrasenviinterno;

                            $ctraspenv = $partraspenv/12;
                            $ctraspenv = round($ctraspenv,2);
                            //fin entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario*(6.96)) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasrecinterno = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasrecinterno= $almacenA1['resultado'];


                            $sqlEgreso ="SELECT  SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario*(6.96)) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and it.idmodelo=mdd.idmodelo and t.idalmacendestino='$idalmacen'
and mdd.idvendedor=t.responsable and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
   ";
                            //ojo
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $partrasrec = $almacenA1['resultado'];
                            $partrasrec=$partrasrec+$parestrasrecinterno;
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $sustrasrec = $almacenA1['resultado'];
                            $sustrasrec=$sustrasrec+$bstrasrecinterno;
                            $ctrasprec = $partrasrec/12;
                            $ctrasprec = round($ctrasprec,2);
                            //fin  recibidos




                            $select = "SUM(vi.cantidad) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');

                            $totalparesventa = $almacenA1['resultado'];
                            $totalcajasventa = $totalparesventa/12;
                            $totalcajasventa = round($totalcajasventa,2);
//                            $select = "sUM(vi.montoapagar) AS Pares";
//                            $from = "ventas v,modelo mo,ventaitem vi";
//                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and v.fecha >= '$fechainicio'
//    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
//                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
//                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//                            $totalbsventa = $almacenA1['resultado'];

 $select4 = "SUM(vi.montoapagar) AS sus";
                            $from = "ventas v,ventaitem vi, marcas mar, clientes cli, almacenes a, empleados em";
                            $where = "v.idventa=vi.idventa AND v.idmarca = mar.idmarca and v.idcliente = cli.idcliente and v.idalmacen = a.idalmacen and
                                      v.idvendedor = em.idempleado and v.idalmacen = '$idalmacen' and v.idmodelo = '$idmodelo'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}


                            $select = "COUNT(v.iddetalledevolucion) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
    and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalparesdev = $almacenA1['resultado'];
                            $totalcajasdev = $totalparesdev/12;
                            $totalcajasdev= round($totalcajasdev,2);
                            $select = "SUM(v.valorcalzado*(6.96)) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
     and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
                            $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
                            $totalbsdev = $almacenA1['resultado'];

                            $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
                            $estadoperiodo = $almacenA1['resultado'];


                            if($estado=="cerrado"){
                                //   echo $mesanterior;
                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    m.idalmacen='$idalmacen' and mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario*(6.96)) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    m.idalmacen='$idalmacen' and mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];

                                $sqlmarca = " SELECT * FROM administrakardex WHERE idalmacen = '$idalmacen' and mesrango='$mesrango' ";
                                $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
                                $mesanterior = $opcionkardex['resultado'];

                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    m.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];

                                $cajasstant = $paresstant/12;
                                $select = "SUM(k.pares*m.preciounitario*(6.96)) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    m.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant =round($cajasstant,2);


                            }else{
                                $select = "SUM(ka.saldocantidad) AS Pares";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = "  ka.idmodelo=m.idmodelo and m.idalmacen='$idalmacen'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(ka.saldocantidad*ka.preciounitario) AS Precio";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = " ka.idmodelo=m.idmodelo  and ka.idalmacen='$idalmacen'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    k.idalmacen='$idalmacen' and k.mes='$mesanterior'";
                                $sql2p3q = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3q, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];
                                //echo $sql2p3q;
                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario*(6.96)) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo and
    k.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3d = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3d, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant = $paresstant/12;
                                $cajasstant =round($cajasstant,2);

                            }
                            if($cajasstact==NULL || $cajasstact =='' || $cajasstact == ""){ $cajasstact="0"; }
                            if($paresstact==NULL || $paresstact =='' || $paresstact == ""){ $paresstact="0"; }
                            if($totalbsstact==NULL || $totalbsstact =='' || $totalbsstact == ""){ $totalbsstact="0"; }

                            $totalbsstant =round($totalbsstant,2);
                         
                            $select2 = "sum(cp.monto) as monto";
                            $from = "creditopago cp";
                            $where = "cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cobros = $idalmacenA['resultado'];

                            $select2 = "sum(cr.monto) as monto";
                            $from = "creditorebaja cr";
                            $where = "cr.fechapago >= '$fechainicio' AND cr.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $rebajas = $idalmacenA['resultado'];

                            $select = "sum(cl.porpagar) as monto";
                            $from = "creditocliente cl,clientes c";
                            $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idalmacen = '$idalmacen' ";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cuentas = $idalmacenA['resultado'];

                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v WHERE v.idventa=vf.idventa and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and v.idalmacen='$idalmacen' ";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
                            $rebaja = $idalmacenA2['resultado'];
                            $rebaja = round($rebaja,2);
                            if($rebaja==0){
                            }else{
                                $rebaja = $rebaja*(-1);
                            }
                            $sql3w = "SELECT SUM(vf.diferencia) as total FROM kardexrebaja vf WHERE vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idalmacen='$idalmacen'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3w, true, true, 'total');
                            $rebajainventario = $idalmacenA2['resultado'];
                            $rebajainventario = round($rebajainventario,2);
                            //fin rehice
                            $tcajasstant =$tcajasstant+$cajasstant;

                            $tparesstant =$tparesstant+$paresstant;
                            $ttotalbsstant =$ttotalbsstant+$totalbsstant;
                            $ttotalcajasrecibido =$ttotalcajasrecibido+$totalcajasrecibido;
                            $ttotalparesrecibido =$ttotalparesrecibido+$totalparesrecibido;
                            $ttotalbsrecibido =$ttotalbsrecibido+$totalbsrecibido;

                            $tcajastrasrec =$tcajastrasrec+$ctraspenv;
                            $tparestrasrec =$tparestrasrec+$partraspenv;
                            $ttotalbstrasrec =$ttotalbstrasrec+$sustraspenv;
                            $tcajastraspdesp =$tcajastraspdesp+$ctrasprec;
                            $tparestraspdesp =$tparestraspdesp+$partrasrec;
                            $ttotalbstraspdesp =$ttotalbstraspdesp+$sustrasrec;
                            $ttotalcajasventa =$ttotalcajasventa+$totalcajasventa;
                            $ttotalparesventa =$ttotalparesventa+$totalparesventa;
                            $ttotalbsventa =$ttotalbsventa+$totalbsventa;
                            $ttotalcajasdev =$ttotalcajasdev+$totalcajasdev;
                            $ttotalparesdev =$ttotalparesdev+$totalparesdev;
                            $ttotalbsdev =$ttotalbsdev+$totalbsdev;
                            $tcobros =$tcobros+$cobros;
                            $trebajas =$trebajas+$rebajas;
                            $tcuentas =$tcuentas+$cuentas;
                            $tcajasstact =$tcajasstact+$cajasstact;
                            $tcajasstact =round($tcajasstact,2);

                            $tparesstact =$tparesstact+$paresstact;
                            $ttotalbsstact =$ttotalbsstact+$totalbsstact;
                            $ttotalbs =$ttotalbs+$totalbs;
                            $trebaja =$trebaja+$rebaja;
                            $trebajainventario =$trebajainventario+$rebajainventario;
                            $tporcentaje =$tporcentaje+$porcentaje;
                        }
                        //   $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    //$devS .= "<tr><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalparesestilo</td><td style='border:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>$totalbsestilo</td>";
                    $devS .= "<tr style='background-color:silver;'><td style='border: 1px solid #000000;font-weight:bold;font-size:12px;text-align:center;background-color:silver;font-family:Arial;'></td>";
                    $devS .= "<td style='display:none;'></td>";

                    $fechatoday = Date("d-m-Y");
                    //font-weight:bold;font-size:12px;
                    $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTALES </td>";
                    //totalesagru


                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajastrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparestrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbstrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajastraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparestraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbstraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsdev."&nbsp;</td>";

                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcobros."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajainventario."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tporcentaje."&nbsp;</td>";


                    $devS .= "</tr>";

                    $devS .= "</tr>";
                    $devS .= "<br />";

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

function dibujarTablaferiarecap($idkardex,$sql,$sql21,$row1,$idmarca,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido)
{   $idalmacen=$_SESSION['idalmacen'];
    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' and idalmacen='$idalmacen' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT * FROM administrakardex WHERE  mesrango= '$idkardex' and idalmacen='$idalmacen'";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
        $fechainicio = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
        $fechafin = $opcionkardex['resultado'];
    }else{
        $sqlmarca = " SELECT * FROM administrakardex WHERE idkardex = '$idkar' ";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
        $mesanterior = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "estado");
        $estado = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
        $fechainicio = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
        $fechafin = $opcionkardex['resultado'];
    }
    //echo $sqlmarca;
    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }

    $sqlw = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido FROM  `marcas` ma WHERE ma.idmarca = '$idmarca'";
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
                    $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>$marcas</td>";
                    $devS .= "<td colspan='3' align='center' style='border:1px solid #000000'>STOCK MERCADERIA</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >RECIBIDOS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP DESP.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP REC.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
                    $devS .= "<td colspan='2' align='center'  style='border:1px solid #000000' >COBROS</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >STOCK ACTUAL</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Rebajas</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Reb-Inv</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>-</td>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>#</td>";
                    $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
                    $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Reb</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs.</td>";

                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Bs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>-</td>";


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
                    $trebajas= 0;
                    $tcuentas =0;
                    $tcajasstact =0;
                    $tparesstact =0;
                    $ttotalbsstact =0;
                    $ttotalbs =0;
                    $trebaja =0;
                    $trebajainventario =0;
                    $tporcentaje =0;
                    do{
                        $devS .= "<tr><td style='text-align:left'>".$z."</td>";
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                            $iddetalleingreso = $fi[$i]['idempleado'];
                            $idempleado =$dato;
                            $sql = "SELECT * FROM  empleados WHERE idempleado = '$dato' and estado!='Inactivo'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'nombres');
                            $marcalista = $idalmacenA2['resultado'];
                            $devS .= "<td style='display:none;'>".$dato."</td>";

                            $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
                            if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
                            if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
                            if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

                            $select = "SUM(k.totalcajas) AS Pares";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= " k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' and k.idalmacen='$idalmacen'";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalcajasrecibido = $almacenA1['resultado'];
                            //  echo $sqlEgreso;
                            $select = "SUM(kp.saldocantidad) AS Pares";
                            $from = "ingresoalmacen i,kardexdetalleparingreso kp";
                            $where = "";
                            { $where .= " i.idingreso=kp.idingreso and i.idempleado='$idempleado' AND i.idmarca = '$idmarca'  AND i.fecha >= '$fechainicio' AND
i.fecha <= '$fechafin' and i.idalmacen='$idalmacen'";}
                            $sql25a = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25a, true, true, 'Pares');
                            $totalparesrecibido = $almacenA1['resultado'];
//ojo modificar fechas para recibido pipe
//                          $selectm = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus ";
//                          $fromm = "modelo m,kardexdetallepar kp,modelo as m2,proformas p";
//                          $wherem = "kp.idmodelo=m.idmodelo and m.idingreso=p.id_proforma and m2.estadotraspaso=m.idmodelo and p.nombre!='00/2016'";
//                           { $wherem .= " and m2.idvendedor='$idempleado' AND m.idmarca = '$idmarca' AND (DATE_FORMAT(m.fechamodelo, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(m.fechamodelo, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen'";}
//
                        $selectm = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitariobs) AS sus ";
                          $fromm = "modelo m,kardexdetallepar kp,modelo as m2,proformas p";
                          $wherem = "kp.idmodelo=m.idmodelo and m.idingreso=p.id_proforma and m2.estadotraspaso=m.idmodelo and p.nombre!='00/2016'";
                           { $wherem .= " and m2.idvendedor='$idempleado' AND m.idmarca = '$idmarca' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen'";}

                           $sql251 = "SELECT ".$selectm." FROM ".$fromm." WHERE ".$wherem;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql251, true, true, 'Pares');
                            $totalparesrecibidonuevo = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql251, true, true, 'sus');
                            $totalbsrecibidonuevo = $almacenA1['resultado'];

//   $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
//                            $from1 = "modelo m,kardexdetallepar kp,proformas p";
//                            $where1 = "m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and m.estadotraspaso='ninguno' and p.nombre!='00/2016' ";
//                            { $where1 .= "and m.idvendedor='$idempleado' AND m.idmarca = '$idmarca' AND (DATE_FORMAT(m.fechamodelo, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(m.fechamodelo, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen' and m.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' and m.boleta=p.id_proforma";}

                           $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitariobs) AS sus";
                            $from1 = "modelo m,kardexdetallepar kp,proformas p";
                            $where1 = "m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and m.estadotraspaso='ninguno' and p.nombre!='00/2016' ";
                            { $where1 .= "and m.idvendedor='$idempleado' AND m.idmarca = '$idmarca' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) >= '$fechainicio' AND (DATE_FORMAT(p.fecha, '%Y-%m-%d')) <= '$fechafin' AND p.idalmacen='$idalmacen' and m.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' and m.boleta=p.id_proforma";}

                            $sql25c = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
                            //echo $sql25c;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25c, true, true, 'Pares');
                            $totalparesrecibidonuevotraspaso = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25c, true, true, 'sus');
                            $totalbsrecibidonuevotraspaso = $almacenA1['resultado'];

                           //ojo sumatoria
                           $totalparesrecibido =$totalparesrecibido + $totalparesrecibidonuevo + $totalparesrecibidonuevotraspaso;

                            $select = "SUM(k.totalbs) AS totalprecio";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= "k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND
                                         k.fecha <= '$fechafin' and k.idalmacen='$idalmacen' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'totalprecio');
                            $totalbsrecibido = $almacenA1['resultado'];

                            $totalbsrecibido = $totalbsrecibido + $totalbsrecibidonuevo + $totalbsrecibidonuevotraspaso;
                            $totalcajasnuevo = $totalparesrecibido/12;
                            $totalcajasrecibido = $totalcajasrecibido + $totalcajasnuevo;
                            $totalcajasrecibido = round($totalcajasrecibido,2);

                            //traspasos entregados

                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM((iv.preciounitario)*(6.96)) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedororigen='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasenvinterno= $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasenviinterno = $almacenA1['resultado'];

                            $sqlEgresoq ="SELECT SUM(it.saldocantidad) AS Pares, SUM((it.preciounitario)*(6.96)) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and t.idalmacen='$idalmacen' and mdd.idvendedor='$idempleado' and it.idmodeloorigen=mdd.idmodelo AND mdd.idmarca = '$idmarca' and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
   ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgresoq, true, true, 'Pares');
                            $partraspenv = $almacenA1['resultado'];
                            $partraspenv=$partraspenv+$parestrasenvinterno;
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgresoq, true, true, 'TotalBs');
                            $sustraspenv = $almacenA1['resultado'];
                            $sustraspenv=$sustraspenv+$bstrasenviinterno;

                            $ctraspenv = $partraspenv/12;
                            $ctraspenv = round($ctraspenv,2);
                            //fin entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM((iv.preciounitario)*(6.96)) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedor='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasrecinterno = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasrecinterno= $almacenA1['resultado'];


                            $sqlEgreso ="SELECT  SUM(it.saldocantidad) AS Pares, SUM((it.preciounitario)*(6.96)) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and it.idmodelo=mdd.idmodelo and t.idalmacendestino='$idalmacen'
and mdd.idvendedor='$idempleado' AND mdd.idvendedor=t.responsable AND mdd.idmarca = '$idmarca' and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
   ";
                            //ojo
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $partrasrec = $almacenA1['resultado'];
                            $partrasrec=$partrasrec+$parestrasrecinterno;
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $sustrasrec = $almacenA1['resultado'];
                            $sustrasrec=$sustrasrec+$bstrasrecinterno;
                            $ctrasprec = $partrasrec/12;
                            $ctrasprec = round($ctrasprec,2);
                            //fin  recibidos
                            $select = "SUM(vi.cantidad) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');

                            $totalparesventa = $almacenA1['resultado'];
                            $totalcajasventa = $totalparesventa/12;
                            $totalcajasventa = round($totalcajasventa,2);
//                            $select = "SUM(vi.totalsus) AS Pares";
//                            $from = "ventas v,modelo mo,ventaferia vi";
//                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
//and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
//
//                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
//                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
//                            $totalbsventa = $almacenA1['resultado'];

                            $selecta = "COUNT(v.iddetalledevolucion) AS Pares";
                            $froma = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $wherea = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
    AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
                            $sql2p = "SELECT ".$selecta." FROM ".$froma. " WHERE ".$wherea;

                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalparesdev = $almacenA1['resultado'];
                            $totalcajasdev = $totalparesdev/12;
                            $totalcajasdev= round($totalcajasdev,2);

                            $selectb = "SUM((v.valorcalzado)*(6.96)) AS Pares";
                            $fromb = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $whereb = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
     AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' and d.idalmacen='$idalmacen'";
                            $sql2p1 = "SELECT ".$selectb." FROM ".$fromb. " WHERE ".$whereb;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
                            $totalbsdev = $almacenA1['resultado'];

                            $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
                            $estadoperiodo = $almacenA1['resultado'];


                            if($estado=="cerrado"){
                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    m.idalmacen='$idalmacen' and mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and m.idvendedor='$idempleado' and
    m.idalmacen='$idalmacen' and mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];

                                $sqlmarca = " SELECT * FROM administrakardex WHERE idalmacen = '$idalmacen' and mesrango='$mesrango' ";
                                $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
                                $mesanterior = $opcionkardex['resultado'];

                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    m.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];

                                $cajasstant = $paresstant/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    m.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant =round($cajasstant,2);


                            }else{
                                $select = "SUM(ka.saldocantidad) AS Pares";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = "  ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and m.idalmacen='$idalmacen' and m.idvendedor='$idempleado'
    ";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(ka.saldocantidad*ka.preciounitario*(6.96)) AS Precio";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = " ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and ka.idalmacen='$idalmacen' and m.idvendedor='$idempleado'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    k.idalmacen='$idalmacen' and k.mes='$mesanterior'";
                                $sql2p3q = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3q, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];
                                //echo $sql2p3q;
                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario*(6.96)) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    k.idalmacen='$idalmacen' and mes='$mesanterior'";
                                $sql2p3d = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3d, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant = $paresstant/12;
                                $cajasstant =round($cajasstant,2);

                            }
                            if($cajasstact==NULL || $cajasstact =='' || $cajasstact == ""){ $cajasstact="0"; }
                            if($paresstact==NULL || $paresstact =='' || $paresstact == ""){ $paresstact="0"; }
                            if($totalbsstact==NULL || $totalbsstact =='' || $totalbsstact == ""){ $totalbsstact="0"; }

                            $totalbsstant =round($totalbsstant,2);
                          $select = "SUM(vi.totalsus) AS Pares";
                          //$select = "SUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaferia vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and v.idvendedor='$idempleado' ";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalbsventa = $almacenA1['resultado'];
                            
                            $select2 = "sum(cp.monto) as monto";
                            $from = "creditopago cp";
                            $where = "cp.idvendedor='$idempleado' and cp.idmarca='$idmarca' AND cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cobros = $idalmacenA['resultado'];

                            $select2 = "sum(cr.monto) as monto";
                            $from = "creditorebaja cr";
                            $where = "cr.idvendedor='$idempleado' and cr.idmarca='$idmarca' AND cr.fechapago >= '$fechainicio' AND cr.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $rebajas = $idalmacenA['resultado'];

                            $select = "sum(cl.porpagar) as monto";
                            $from = "creditocliente cl,clientes c";
                            $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca' and cl.idvendedor='$idempleado' and cl.idalmacen = '$idalmacen'";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cuentas = $idalmacenA['resultado'];

                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v WHERE v.idventa=vf.idventa and vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and v.idalmacen='$idalmacen' and vf.idvendedor='$idempleado'  ";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
                            $rebaja = $idalmacenA2['resultado'];
                            $rebaja = round($rebaja,2);
                            if($rebaja==0){
                            }else{
                                $rebaja = $rebaja*(-1);
                            }

                            $sql3w = "SELECT SUM(vf.diferencia) as total FROM kardexrebaja vf WHERE vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idalmacen='$idalmacen' and vf.idvendedor='$idempleado'  ";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3w, true, true, 'total');
                            $rebajainventario = $idalmacenA2['resultado'];
                            $rebajainventario = round($rebajainventario,2);

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstant."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstant."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstant."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasrecibido."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesrecibido."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsrecibido."&nbsp;</td>";

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$ctraspenv."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$partraspenv."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$sustraspenv."&nbsp;</td>";

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$ctrasprec."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$partrasrec."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$sustrasrec."&nbsp;</td>";

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasventa."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesventa."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsventa."&nbsp;</td>";

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalcajasdev."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalparesdev."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsdev."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cobros."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebajas."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
                            $cajasstact =round($cajasstact,2);
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebajainventario."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$porcentaje."&nbsp;</td>";
                            $tcajasstant =$tcajasstant+$cajasstant;

                            $tparesstant =$tparesstant+$paresstant;
                            $ttotalbsstant =$ttotalbsstant+$totalbsstant;
                            $ttotalcajasrecibido =$ttotalcajasrecibido+$totalcajasrecibido;
                            $ttotalparesrecibido =$ttotalparesrecibido+$totalparesrecibido;
                            $ttotalbsrecibido =$ttotalbsrecibido+$totalbsrecibido;

                            $tcajastrasrec =$tcajastrasrec+$ctraspenv;
                            $tparestrasrec =$tparestrasrec+$partraspenv;
                            $ttotalbstrasrec =$ttotalbstrasrec+$sustraspenv;
                            $tcajastraspdesp =$tcajastraspdesp+$ctrasprec;
                            $tparestraspdesp =$tparestraspdesp+$partrasrec;
                            $ttotalbstraspdesp =$ttotalbstraspdesp+$sustrasrec;

                            $ttotalcajasventa =$ttotalcajasventa+$totalcajasventa;
                            $ttotalparesventa =$ttotalparesventa+$totalparesventa;
                            $ttotalbsventa =$ttotalbsventa+$totalbsventa;
                            $ttotalcajasdev =$ttotalcajasdev+$totalcajasdev;
                            $ttotalparesdev =$ttotalparesdev+$totalparesdev;
                            $ttotalbsdev =$ttotalbsdev+$totalbsdev;
                            $tcobros =$tcobros+$cobros;
                            $trebajas =$trebajas+$rebajas;
                            $tcuentas =$tcuentas+$cuentas;
                            $tcajasstact =$tcajasstact+$cajasstact;
                            $tparesstact =$tparesstact+$paresstact;
                            $ttotalbsstact =$ttotalbsstact+$totalbsstact;
                            $ttotalbs =$ttotalbs+$totalbs;
                            $trebaja =$trebaja+$rebaja;
                            $trebajainventario =$trebajainventario+$rebajainventario;
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
                    $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$nombrecategoria."</td>";
                    //totalesagru


                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstant."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsrecibido."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajastrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparestrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbstrasrec."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajastraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparestraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbstraspdesp."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsventa."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalcajasdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalparesdev."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsdev."&nbsp;</td>";

                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcobros."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajainventario."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tporcentaje."&nbsp;</td>";


                    $devS .= "</tr>";

                    $devS .= "</tr>";
                    $devS .= "<br />";

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

function verventaferiamarca($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
    //echo "hola";
    $idalmacen=$_SESSION['idalmacen'];
    $fecha1 = $fechainicio;

    $fecha2 = $fechafin;

    //echo $fechainicio;
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
    $html .= "VENTAS POR MARCA<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";

    $html .= "<tr style='width:100%; font-size:11px;'>";
    $html .=" </td> ";
    $html .= "</tr>";
    $html .= "<tr>";

    $select = "m.idmarca";
    $from = "ventaferia p,modelo m";
    $where = "p.idmodelo=m.idmodelo and p.idalmacen='$idalmacen' ";
    { $where .= " AND p.fecha >='$fechainicio' ";}
    if($fechafin != null && $fechafin != "")
    { $where .= " AND p.fecha <='$fechafin' ";}
    if($idmarca == null || $idmarca == 'null')
    { }
    else{$where .= " AND m.idmarca ='$idmarca' "; }
//    if($idvendedor == null || $idvendedor == 'null')
//    { }else{$where .= " AND p.idvendedor ='$idvendedor' "; }
    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY m.idmarca";

    $table = dibujarTablaOfmarcaferia($sql25,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin);

    $html .= $table['resultado'];
    $html .= "</tr>";
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
function verventaferiavendedor($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
    //echo "hola";
    $idalmacen=$_SESSION['idalmacen'];
    $fecha1 = $fechainicio;

    $fecha2 = $fechafin;

    //echo $fechainicio;
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
    $html .= "VENTAS POR VENDEDOR<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";

    $html .= "<tr style='width:100%; font-size:11px;'>";
    $html .=" </td> ";
    $html .= "</tr>";
    $html .= "<tr>";

    $select = "p.idvendedor";
    $from = "ventaferia p";
    $where = "p.idalmacen='$idalmacen' ";
    { $where .= " AND p.fecha >='$fechainicio' ";}
    if($fechafin != null && $fechafin != "")
    { $where .= " AND p.fecha <='$fechafin' ";}
    if($idmarca == null || $idmarca == 'null')
    { }
    else{$where .= " AND p.idmarca ='$idmarca' "; }
//    if($idvendedor == null || $idvendedor == 'null')
//    { }else{$where .= " AND p.idvendedor ='$idvendedor' "; }
    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY p.idvendedor";

    $table = dibujarTablaOfvendedorferia($sql25,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin);

    $html .= $table['resultado'];
    $html .= "</tr>";
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

function dibujarTablaOfmarcaferia($sql,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin)
{
    $idalmacen=$_SESSION['idalmacen'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:13px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombreempleado</td></tr>";
                    $devS .= "</tr>";
                    $ii = 0;
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                            $idmarca = $dato;
                            $sql2 = "SELECT UPPER(cli.nombre) AS nombre FROM marcas cli WHERE cli.idmarca = '$idmarca'";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($empresa1);
                            //oodfjodf

                             $select1 = " date_format(v.fecha,'%d/%m/%Y') AS Fecha, v.boleta,mar.nombre as marca,m.codigo,
                                         v.totalpares,v.totalsus as monto,m.color,m.material ,v.cliente,v.nit,v.idvendedor as Vendedor";
                            $from1 = "ventaferia v, modelo m ,`marcas` mar";
                            $where1 = " v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and m.idmarca = '$idmarca' ";
                            { $where1 .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where1 .= " AND v.fecha <= '$fechafin' ";}
//                            if($idmarca == null || $idmarca == 'null')
//                            { }
//                            else{$where1 .= " AND m.idmarca = '$idmarca' "; }

                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by v.numero ORDER by Fecha";
                           // echo $sqlruta;
                            $select1 = "SUM(v.totalpares) AS pares";
                            $from = "ventaferia v, modelo m ,`marcas` mar";
                            $where = "v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and m.idmarca = '$idmarca'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
//                            if($idmarca == null || $idmarca == 'null')
//                            { }
//                            else{$where .= " AND m.idmarca ='$idmarca' "; }
                            $select2 = "SUM(v.totalsus) AS sus";

                            $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
                            $tpares = $creditoA111['resultado'];

                            $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
                            $tsus = $creditoA111['resultado'];

                           $select4 = "SUM(v.montoapagar) AS sus";
                            $from = "ventas v, marcas mar, clientes cli, almacenes a, empleados em";
                            $where = "v.idmarca = mar.idmarca and v.idcliente = cli.idcliente and v.idalmacen = a.idalmacen and
                                      v.idvendedor = em.idempleado and v.idalmacen = '$idalmacen' and m.idmarca = '$idmarca'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
//                            if($idmarca == null || $idmarca == 'null')
//                            { }
//                            else{$where .= " AND v.idmarca ='$idmarca' "; }
                            $sql4 = "SELECT ".$select4." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4, true, true, "sus");
                            $tmonto = $creditoA111['resultado'];
                            $tdesc = round(($tmonto-$tsus),2);
                            $tcajas = $tpares/12;
                            $tcajas = round($tcajas,2);
                            $totalcajas = $totalcajas + $tcajas;
                            $totalpares = $totalpares + $tpares;
                            $totalsus = $totalsus + $tsus;
                            $table = dibujarTablaparaventascredito($sqlruta, $empresa,'',$tpares,$tsus,'',$tmonto);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "<tr>";
                    $devS .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
                    $devS .= "<tr><td style='width:10%;font-weight:bold;'>TOTAL CAJAS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcajas."</td><td style='width:10%;font-weight:bold;'>TOTAL PARES:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalpares."</td><td style='width:10%;font-weight:bold;'>TOTAL SUS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalsus."</td></tr>";
                    $devS .= "</table>";
                    $devS .= "</td></tr>";
                    $devS .= "</tr>";

                    //$sql4111 = "SELECT SUM(monto) AS totaldeuda FROM pagocredito WHERE tipopago='ingreso' AND idtienda='$idempleado' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
                    //$creditoA1111 = findBySqlReturnCampoUnique($sql4111, true, true, "totaldeuda");
                    //$totalcomisioncobrado = $creditoA1111['resultado'];

                    //if($totalcomisioncobrado==NULL || $totalcomisioncobrado =='' || $totalcomisioncobrado == ""){ $totalcomisioncobrado="0.00"; }

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
function dibujarTablaOfvendedorferia($sql,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin)
{
    $idalmacen=$_SESSION['idalmacen'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:13px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombreempleado</td></tr>";
                    $devS .= "</tr>";
                    $ii = 0;
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                            $idvendedor = $dato;
//                            $sql2 = "SELECT CONCAT( UPPER(cli.nombres), '-', UPPER(cli.apellidos) )AS nombre FROM empleados cli WHERE cli.idempleado = '$idvendedor'";
//                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
//                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($idvendedor);
                            //oodfjodf

                             $select1 = " date_format(v.fecha,'%d/%m/%Y') AS Fecha, v.boleta,mar.nombre as marca,m.codigo,
                                         v.totalpares,v.totalsus as monto,m.color,m.material ,v.cliente,v.nit";
                            $from1 = "ventaferia v, modelo m ,`marcas` mar";
                            $where1 = " v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and v.idvendedor = '$idvendedor' ";
                            { $where1 .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where1 .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where1 .= " AND m.idmarca = '$idmarca' "; }

                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by v.numero ORDER by Fecha";
                           // echo $sqlruta;
                            $select1 = "SUM(v.totalpares) AS pares";
                            $from = "ventaferia v, modelo m ,`marcas` mar";
                            $where = "v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and v.idvendedor = '$idvendedor'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where .= " AND m.idmarca ='$idmarca' "; }
                            $select2 = "SUM(v.totalsus) AS sus";
                  
                            $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
                            $tpares = $creditoA111['resultado'];

                            $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
                            $tsus = $creditoA111['resultado'];

                           $select4 = "SUM(v.montoapagar) AS sus";
                            $from = "ventas v, marcas mar, clientes cli, almacenes a, empleados em";
                            $where = "v.idmarca = mar.idmarca and v.idcliente = cli.idcliente and v.idalmacen = a.idalmacen and
                                      v.idvendedor = em.idempleado and v.idalmacen = '$idalmacen' and v.idvendedor = '$idvendedor'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where .= " AND v.idmarca ='$idmarca' "; }
                            $sql4 = "SELECT ".$select4." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4, true, true, "sus");
                            $tmonto = $creditoA111['resultado'];
                            $tdesc = round(($tmonto-$tsus),2);
                            $tcajas = $tpares/12;
                            $tcajas = round($tcajas,2);
                            $totalcajas = $totalcajas + $tcajas;
                            $totalpares = $totalpares + $tpares;
                            $totalsus = $totalsus + $tsus;
                            $table = dibujarTablaparaventascredito($sqlruta, $empresa,'',$tpares,$tsus,'',$tmonto);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "<tr>";
                    $devS .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
                    $devS .= "<tr><td style='width:10%;font-weight:bold;'>TOTAL CAJAS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcajas."</td><td style='width:10%;font-weight:bold;'>TOTAL PARES:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalpares."</td><td style='width:10%;font-weight:bold;'>TOTAL SUS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalsus."</td></tr>";
                    $devS .= "</table>";
                    $devS .= "</td></tr>";
                    $devS .= "</tr>";

                    //$sql4111 = "SELECT SUM(monto) AS totaldeuda FROM pagocredito WHERE tipopago='ingreso' AND idtienda='$idempleado' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
                    //$creditoA1111 = findBySqlReturnCampoUnique($sql4111, true, true, "totaldeuda");
                    //$totalcomisioncobrado = $creditoA1111['resultado'];

                    //if($totalcomisioncobrado==NULL || $totalcomisioncobrado =='' || $totalcomisioncobrado == ""){ $totalcomisioncobrado="0.00"; }

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
function verventaferiamodelo($idmarca,$idvendedor,$fechainicio,$fechafin, $return)
{
    //echo "hola";
    $idalmacen=$_SESSION['idalmacen'];
    $fecha1 = $fechainicio;

    $fecha2 = $fechafin;

    //echo $fechainicio;
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
    $html .= "VENTAS POR MODELO<br>";
    $html .= " DEL $fechaini AL $fechafinn<br>";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";
    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    //    $html .= "<td style='width:100%;text-align:center;font-size:1px;font-family:Tahoma;'>";
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:0px solid #000000;font-size:11px;text-align:center'>";
    $html .= "<tr>";

    $html .= "<tr style='width:100%; font-size:11px;'>";
    $html .=" </td> ";
    $html .= "</tr>";
    $html .= "<tr>";

    $select = "p.idmodelo";
    $from = "ventaferia p";
    $where = "p.idalmacen='$idalmacen' ";
    { $where .= " AND p.fecha >='$fechainicio' ";}
    if($fechafin != null && $fechafin != "")
    { $where .= " AND p.fecha <='$fechafin' ";}
    if($idmarca == null || $idmarca == 'null')
    { }
    else{$where .= " AND p.idmarca ='$idmarca' "; }
//    if($idvendedor == null || $idvendedor == 'null')
//    { }else{$where .= " AND p.idvendedor ='$idvendedor' "; }
    $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY p.idmodelo";

    $table = dibujarTablaOfmodeloferia($sql25,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin);

    $html .= $table['resultado'];
    $html .= "</tr>";
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
function dibujarTablaOfmodeloferia($sql,$idtienda,$idvendedor,$idmarca,$codigoempleado,$nombreempleado,$fechainicio,$fechafin)
{
    $idalmacen=$_SESSION['idalmacen'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                //echo mysql_num_rows($re);
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:13px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombreempleado</td></tr>";
                    $devS .= "</tr>";
                    $ii = 0;
                    $z = 1;
                    $totalcajas=0;
                    $totalpares=0;
                    $totalsus=0;
                    do{
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {$dato = $fi[$i];
                            $idmodelo = $dato;
                            $sql2 = "SELECT CONCAT( UPPER(codigo), '-', (color), '-', (material) )AS nombre FROM modelo WHERE idmodelo = '$idmodelo'";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombre');
                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($empresa1);
                            //oodfjodf

                             $select1 = " date_format(v.fecha,'%d/%m/%Y') AS Fecha, v.boleta,mar.nombre as marca,m.codigo,
                                         v.totalpares,v.totalsus as monto,m.color,m.material ,v.cliente,v.nit";
                            $from1 = "ventaferia v, modelo m ,`marcas` mar";
                            $where1 = " v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and v.idmodelo = '$idmodelo' ";
                            { $where1 .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where1 .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where1 .= " AND m.idmarca = '$idmarca' "; }

                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." group by v.numero ORDER by Fecha";
                           // echo $sqlruta;
                            $select1 = "SUM(v.totalpares) AS pares";
                            $from = "ventaferia v, modelo m ,`marcas` mar";
                            $where = "v.idmodelo = m.idmodelo and m.idmarca = mar.idmarca and v.idalmacen = '$idalmacen' and v.idmodelo = '$idmodelo'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where .= " AND m.idmarca ='$idmarca' "; }
                            $select2 = "SUM(v.totalsus) AS sus";

                            $sql4112 = "SELECT ".$select1." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4112, true, true, "pares");
                            $tpares = $creditoA111['resultado'];

                            $sql12 = "SELECT ".$select2." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql12, true, true, "sus");
                            $tsus = $creditoA111['resultado'];

                           $select4 = "SUM(v.montoapagar) AS sus";
                            $from = "ventas v, marcas mar, clientes cli, almacenes a, empleados em";
                            $where = "v.idmarca = mar.idmarca and v.idcliente = cli.idcliente and v.idalmacen = a.idalmacen and
                                      v.idvendedor = em.idempleado and v.idalmacen = '$idalmacen' and v.idmodelo = '$idmodelo'";
                            { $where .= " AND v.fecha >= '$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where .= " AND v.fecha <= '$fechafin' ";}
                            if($idmarca == null || $idmarca == 'null')
                            { }
                            else{$where .= " AND v.idmarca ='$idmarca' "; }
                            $sql4 = "SELECT ".$select4." FROM ".$from. " WHERE ".$where." ";
                            $creditoA111 = findBySqlReturnCampoUnique($sql4, true, true, "sus");
                            $tmonto = $creditoA111['resultado'];
                            $tdesc = round(($tmonto-$tsus),2);
                            $tcajas = $tpares/12;
                            $tcajas = round($tcajas,2);
                            $totalcajas = $totalcajas + $tcajas;
                            $totalpares = $totalpares + $tpares;
                            $totalsus = $totalsus + $tsus;
                            $table = dibujarTablaparaventascredito($sqlruta, $empresa,'',$tpares,$tsus,'',$tmonto);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

                        }
                        $devS .= "</tr>";
                        $ii++;
                        $z ++;
                    }while($fi = mysql_fetch_array($re));
                    $devS .= "<tr>";
                    $devS .= "<td style='width:100%;text-align:left;font-size:14px;font-family:Tahoma;'>";
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:14px;'>";
                    $devS .= "<tr><td style='width:10%;font-weight:bold;'>TOTAL CAJAS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalcajas."</td><td style='width:10%;font-weight:bold;'>TOTAL PARES:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalpares."</td><td style='width:10%;font-weight:bold;'>TOTAL SUS:</td><td style='width:10%;text-align:center;border-left: 1px solid #000000;font-weight:bold;'>".$totalsus."</td></tr>";
                    $devS .= "</table>";
                    $devS .= "</td></tr>";
                    $devS .= "</tr>";

                    //$sql4111 = "SELECT SUM(monto) AS totaldeuda FROM pagocredito WHERE tipopago='ingreso' AND idtienda='$idempleado' AND fecha >='$fechainicio' AND fecha <='$fechafin'";
                    //$creditoA1111 = findBySqlReturnCampoUnique($sql4111, true, true, "totaldeuda");
                    //$totalcomisioncobrado = $creditoA1111['resultado'];

                    //if($totalcomisioncobrado==NULL || $totalcomisioncobrado =='' || $totalcomisioncobrado == ""){ $totalcomisioncobrado="0.00"; }

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
 ?>