<?php
session_name("balderrama");
session_start();
function VerPlanificacion($idvendedor,$idalmacen2,$idkardex,$fechainicio,$fechafin, $return)
{   $html = "";
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
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";
      $sql = "SELECT codigo,CONCAT( nombres,'/',apellidos) AS vendedor FROM  empleados WHERE idempleado = '$idvendedor'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'vendedor');
    $vendedor = $idalmacenA2['resultado'];


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
    if($opcionmarca="33-45"){
        $tipo="1";
    }else{
        if($opcionmarca="14-38"){
            $tipo="3";
        }
    }
    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' group by mesrango";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];


    //$html .= "<b><u>INVENTARIO $marcalista</u></b><br>";
    $sqlmarca = " SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";

    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $deptocapital = $opcionkardex['resultado'];

    $html .= "<td style='width:100%;height:50px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<b><u>RESUMEN CAPITAL DE OPERACIONES $vendedor</u></b><br>";
   
    //     $html .= "Tienda $tienda";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "m.idmarca,m.nombre";
    $from = "marcas m,empleadomarca e ";
    $where = "e.idmarca=m.idmarca and e.idempleado='$idvendedor' and e.estado='A'";
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

    for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $nombrecategoria = $codigo['nombre'];
         $idmarca = $codigo['idmarca'];
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

          $select = "idperiodo";
        $from = "periodo";
        $where = "validacion='1' ";


        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;

      $table = tablaplanificacion($idvendedor,$idmarca,$idkar,$sql25,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido);
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


function VerRecapitulacionMarcaVendedor($idvendedor,$idalmacen2,$idkardex,$fechainicio,$fechafin, $return)
{   $html = "";
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
    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";
      $sql = "SELECT codigo,CONCAT( nombres,'/',apellidos) AS vendedor FROM  empleados WHERE idempleado = '$idvendedor'";
    $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'vendedor');
    $vendedor = $idalmacenA2['resultado'];


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
    if($opcionmarca="33-45"){
        $tipo="1";
    }else{
        if($opcionmarca="14-38"){
            $tipo="3";
        }
    }
    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' group by mesrango";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];


    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE  mesrango= '$idkardex' group by mesrango";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];

    }else{
        $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
       }
    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }

    $formatear = explode( '-' , $fechainicio);
    $fechain = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $formatear = explode( '-' , $fechafin);
    $fechaf = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $formatearmes = explode( '/' , $mesrango);
    $mesplani = $formatearmes[0];
    if($mesplani == "01") {
        $mes="ENERO";  }
    if($mesplani == "02") {
        $mes="FEBRERO";   }
    if($mesplani == "03") {
        $mes="MARZO";     }
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
    //$html .= "<b><u>INVENTARIO $marcalista</u></b><br>";
    $sqlmarca = " SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";

    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $deptocapital = $opcionkardex['resultado'];

    $html .= "<td style='width:100%;height:50px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<b><u>RESUMEN CAPITAL DE OPERACIONES $vendedor</u></b><br>";
    $html .= "<b><u>CORRESPONDIENTE AL MES DE $mes :  DEL $fechain AL $fechaf </u></b><br>";
    //     $html .= "Tienda $tienda";
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "origen";
    $from = "marcas ";
    $where = " estado='activo' group by origen ";
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

   // for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $nombrecategoria = $codigo['origen'];
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

        $select = "SUM(saldocantidad) AS Pares";
        $from = "adicionkardextienda k,modelos mdt";
        $where = " k.idmodelodetalle = mdt.idmodelo AND mdt.idmarca = '$idmarca' AND mdt.stylename = '$idestilo' ";
        $sql2121 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
        $almacenA1 =  findBySqlReturnCampoUnique($sql2121, true, true, 'Pares');
        $totalparesestilo = $almacenA1['resultado'];
        $select = "SUM(saldocantidad*precio2bs) AS bs";
        $from = "adicionkardextienda k,modelos mdt";
        $where = " k.idmodelodetalle = mdt.idmodelo AND mdt.idmarca = '$idmarca' AND mdt.stylename = '$idestilo' ";
        $sql2121 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
        $almacenA1 =  findBySqlReturnCampoUnique($sql2121, true, true, 'bs');
        $totalbsestilo = $almacenA1['resultado'];
         $select = "emp.idmarca";
        $from = "empleadomarca emp";
        $where = "emp.idempleado='$idvendedor' and emp.estado='A' ";

        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;

      $table = dibujarTablaOfSQLmarcarecapitulacionvendedorinf($idvendedor,$idkar,$sql25,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido);
      $html .= $table['resultado'];
  //  }


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

function VerResumenAlmacen($idkardex,$fechainicio,$fechafin, $return)
{
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

    $html .= "<table cellpadding='1' cellspacing='0' border='0' style='width:100%' font-size:11px; font-family:Tahoma;'>";
    $html .= "<td style='width:100%;height:100%;text-align:right;font-size:12px;font-family:Tahoma;'>";
    $html .= "$fecha  $tipo";
    $html .= "</td>";
    $html .= "<tr>";
    $sql = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido
FROM  `marcas` ma
WHERE ma.idmarca = '$idmarca'";
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
    if($opcionmarca="33-45"){
        $tipo="1";
    }else{
        if($opcionmarca="14-38"){
            $tipo="3";
        }
    }
    $sqlmarca = " SELECT idkardex FROM administrakardex WHERE idkardex = '$idkardex' group by mesrango";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];


    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE  mesrango= '$idkardex' group by mesrango";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];

    }else{
        $sqlmarca = " SELECT idkardex,tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
        $idkar = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
        $tabla = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
        $mesrango = $opcionkardex['resultado'];
        $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
        $idperiodo = $opcionkardex['resultado'];
       }
    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }

    $formatear = explode( '-' , $fechainicio);
    $fechain = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $formatear = explode( '-' , $fechafin);
    $fechaf = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $formatearmes = explode( '/' , $mesrango);
    $mesplani = $formatearmes[0];
    if($mesplani == "01") {
        $mes="ENERO";  }
    if($mesplani == "02") {
        $mes="FEBRERO";   }
    if($mesplani == "03") {
        $mes="MARZO";     }
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
    //$html .= "<b><u>INVENTARIO $marcalista</u></b><br>";
    $sqlmarca = " SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";

    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $deptocapital = $opcionkardex['resultado'];

    $html .= "<td style='width:100%;height:50px;text-align:center;font-size:15px;font-family:Tahoma;'>";
    $html .= "<b><u>RESUMEN CAPITAL DE OPERACIONES POR ALMACEN</u></b><br>";
    $html .= "<b><u>CORRESPONDIENTE AL MES DE $mes :  DEL $fechain AL $fechaf </u></b><br>";
  
    $html .= "</td>";
    $html .= "</tr>";
    $html .= "</table>";
    $html .= "</tr>";
    $html .= "<tr>";
    $html .= "<td colspan='3'>";

    $html .= "<table width='1250' border='0' cellspacing='0' cellpadding='0'><tr>";

    $select = "origen";
    $from = "marcas ";
    $where = " estado='activo' group by origen ";
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

   // for($i=0;$i<=$row15;$i++){
        $codigo = $sql3[$i];
        $nombrecategoria = $codigo['origen'];
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

        $select = "SUM(saldocantidad) AS Pares";
        $from = "adicionkardextienda k,modelos mdt";
        $where = " k.idmodelodetalle = mdt.idmodelo AND mdt.idmarca = '$idmarca' AND mdt.stylename = '$idestilo' ";
        $sql2121 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
        $almacenA1 =  findBySqlReturnCampoUnique($sql2121, true, true, 'Pares');
        $totalparesestilo = $almacenA1['resultado'];
        $select = "SUM(saldocantidad*precio2bs) AS bs";
        $from = "adicionkardextienda k,modelos mdt";
        $where = " k.idmodelodetalle = mdt.idmodelo AND mdt.idmarca = '$idmarca' AND mdt.stylename = '$idestilo' ";
        $sql2121 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
        $almacenA1 =  findBySqlReturnCampoUnique($sql2121, true, true, 'bs');
        $totalbsestilo = $almacenA1['resultado'];

        $select = "idalmacen";
        $from = "almacenes";
        $where = " estado='activo' and tipoalmacen='mayor'";
        $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;

      $table = dibujarTablaOfSQLmarcarecapitulacionalmacen($idkar,$sql25,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido);
      $html .= $table['resultado'];
 //   }


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
function dibujarTablaOfSQLmarcarecapitulacionalmacen($idkardex,$sql,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido)
{   //$idalmacen=$_SESSION['idalmacen'];
    $sqlmarca = " SELECT idperiodo,idkardex FROM administrakardex WHERE idkardex = '$idkardex' group by idkardex";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];

    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT * FROM administrakardex WHERE  mesrango= '$idkardex' group by idkardex";
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
        $sqlmarca = " SELECT * FROM administrakardex WHERE idkardex = '$idkar' group by idkardex";
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
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
                    $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>MARCAS</td>";
                    $devS .= "<td colspan='3' align='center' style='border:1px solid #000000'>STOCK MERCADERIA</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >RECIBIDOS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP REC.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP DESP.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >STOCK ACTUAL</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Rebajas</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Fallas</td>";
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
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>-</td>";
                    $devS .= "</tr>";
                    $ii = 0;
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
                            $iddetalleingreso = $fi[$i]['idalmacen'];
                            $idalmacen =$dato;
                            //ojo

                             $sql = "SELECT nombrecompleto AS marca FROM  almacenes WHERE idalmacen = '$dato'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
                            $marcalista = $idalmacenA2['resultado'];
                            $devS .= "<td style='display:none;'>".$dato."</td>";
                            $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
                            if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
                            if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
                            if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }
                          $select = "SUM(k.totalcajas) AS Pares";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= "k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' and k.idalmacen='$idalmacen'";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalcajasrecibido = $almacenA1['resultado'];
                            //  echo $sqlEgreso;
                            $select = "SUM(kp.saldocantidad) AS Pares";
                            $from = "ingresoalmacen i,kardexdetalleparingreso kp";
                            $where = "";
                            { $where .= " i.idingreso=kp.idingreso and i.idalmacen = '$idalmacen'  AND i.fecha >= '$fechainicio' AND i.fecha <= '$fechafin'";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibido = $almacenA1['resultado'];

                           $select = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from = "kardexdetallepar kp,proformas p,modelo m";
                            $where = "kp.idingreso=p.id_proforma and m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and p.nombre!='00/2016'";
                            { $where .= " AND m.fecha >= '$fechainicio' AND
                                          m.fecha <= '$fechafin' and kp.idalmacen='$idalmacen' and p.idalmacen='$idalmacen'";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibidonuevo = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'sus');
                            $totalbsrecibidonuevo = $almacenA1['resultado'];

                               $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from1 = "kardexdetallepar kp,proformas p,modelo m,traspaso t,traspasodetallepar tr";
                            $where1 = "kp.idkardexunico=tr.idkardexunico and tr.idmodeloorigen=m.idmodelo and
                                       tr.iddetalletraspaso=t.idtraspaso and m.`idingreso`=p.`id_proforma` ";
                            { $where1 .= " AND m.fecha >= '$fechainicio' AND
                                           m.fecha <= '$fechafin'  AND t.idalmacen='$idalmacen' ";}

                            $sql25c = "SELECT ".$select1." FROM ".$from1." WHERE ".$where1;
                            //echo $sql25c;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25c, true, true, 'Pares');
                            $totalparesrecibidonuevotraspaso = $almacenA1['resultado'];
                            $totalparesrecibido =$totalparesrecibido + $totalparesrecibidonuevo + $totalparesrecibidonuevotraspaso;

                            $select = "SUM(k.totalbs) AS totalprecio";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= "k.idalmacen = '$idalmacen' AND k.fecha >= '$fechainicio' AND
                                         k.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'totalprecio');
                            $totalbsrecibido = $almacenA1['resultado'];

                            $totalbsrecibido = $totalbsrecibido + $totalbsrecibidonuevo + $totalbsrecibidonuevotraspaso;
                            $totalcajasnuevo = $totalparesrecibido/12;
                            $totalcajasrecibido = $totalcajasrecibido + $totalcajasnuevo;
                            $totalcajasrecibido = round($totalcajasrecibido,2);

                          //traspasos entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasenvinterno= $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasenviinterno = $almacenA1['resultado'];

                            $sqlEgresoq ="SELECT SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
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
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' and iv.idalmacen='$idalmacen' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasrecinterno = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasrecinterno= $almacenA1['resultado'];


                            $sqlEgreso ="SELECT  SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and it.idmodelo=mdd.idmodelo and t.idalmacendestino='$idalmacen'
AND mdd.idvendedor=t.responsable and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
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
                            $where = " v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idalmacen = '$idalmacen' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');

                            $totalparesventa = $almacenA1['resultado'];
                            $totalcajasventa = $totalparesventa/12;
                            $totalcajasventa = round($totalcajasventa,2);
                            $select = "sUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idalmacen = '$idalmacen'
and v.fecha >= '$fechainicio' AND v.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalbsventa = $almacenA1['resultado'];

                            $select = "COUNT(v.iddetalledevolucion) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
    AND d.idalmacen = '$idalmacen' and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalparesdev = $almacenA1['resultado'];
                            $totalcajasdev = $totalparesdev/12;
                            $totalcajasdev= round($totalcajasdev,2);
                            $select = "SUM(v.valorcalzado) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
     AND d.idalmacen = '$idalmacen' and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin'";
                            $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
                            $totalbsdev = $almacenA1['resultado'];

                            $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
                            $estadoperiodo = $almacenA1['resultado'];

 $sqlmarca = " SELECT * FROM administrakardex WHERE mesrango='$mesrango' group by mesrango";
                                $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
                                $mesanterior = $opcionkardex['resultado'];

                           if($estado=="cerrado"){
                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and
    mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];

                               

                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];

                                $cajasstant = $paresstant/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant =round($cajasstant,2);


                            }else{
                                $select = "SUM(ka.saldocantidad) AS Pares";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = "  ka.idmodelo=m.idmodelo  aND m.idalmacen = '$idalmacen' ";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(ka.saldocantidad*ka.preciounitario) AS Precio";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = " ka.idmodelo=m.idmodelo  aND m.idalmacen = '$idalmacen' ";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and k.mes='$mesanterior'";
                                $sql2p3q = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3q, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];
                                //echo $sql2p3q;
                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idalmacen = '$idalmacen' and mes='$mesanterior'";
                                $sql2p3d = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3d, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant = $paresstant/12;
                                $cajasstant =round($cajasstant,2);

                            }
                     //       echo $estadoperiodo;
 $cajasstact =round($cajasstact,2);
                            if($cajasstact==NULL || $cajasstact =='' || $cajasstact == ""){ $cajasstact="0"; }
                            if($paresstact==NULL || $paresstact =='' || $paresstact == ""){ $paresstact="0"; }
                            if($totalbsstact==NULL || $totalbsstact =='' || $totalbsstact == ""){ $totalbsstact="0"; }

                            $totalbsstant =round($totalbsstant,2);
                            $select = "SUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idalmacen = '$idalmacen' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalbsventa = $almacenA1['resultado'];
                            $select2 = "sum(cp.monto) as monto";
                            $from = "creditopago cp";
                            $where = "cp.idalmacen = '$idalmacen' AND cp.fechapago >= '$fechainicio' AND cp.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cobros = $idalmacenA['resultado'];
//ojo no hay almacen
                            $select2 = "sum(cr.monto) as monto";
                            $from = "creditorebaja cr";
                            $where = "cr.fechapago >= '$fechainicio' AND cr.fechapago <= '$fechafin'";
                            $sql251 = "SELECT ".$select2." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $rebajas = $idalmacenA['resultado'];

                            $select = "sum(cl.porpagar) as monto";
                            $from = "creditocliente cl,clientes c";
                            $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and c.idalmacen = '$idalmacen'";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cuentas = $idalmacenA['resultado'];
//no hay almacen
                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v,empleados e WHERE vf.idempleado=e.idempleado and v.idventa=vf.idventa and vf.fecha >= '$fechainicio' AND vf.fecha <= '$fechafin' and e.idalmacen='$idalmacen'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
//                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v WHERE v.idventa=vf.idventa and vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio' AND vf.fecha <= '$fechafin' and v.idalmacen='$idalmacen'";
//                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
                            $rebaja = $idalmacenA2['resultado'];
                            $rebaja = round($rebaja,2);
                            $sql3w = "SELECT SUM(vf.diferencia) as total FROM kardexrebaja vf WHERE vf.fecha >= '$fechainicio' AND vf.fecha <= '$fechafin' and vf.idalmacen='$idalmacen'";
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
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbs."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$porcentaje."&nbsp;</td>";
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
                    $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$nombrecategoria."</td>";
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
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbs."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tporcentaje."&nbsp;</td>";
                    $devS .= "</tr>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td colspan='3' align='center' font-family='Arial' background-color='silver' >CAPITAL DE OPERACION</td>";
                    $cuentasporcobrar= "0.00";
                    $devS .= "<td colspan='1' align='center' font-family='Arial' background-color='silver' >".$cuentasporcobrar."</td>";
                    $devS .= "<td colspan='16' align='center' font-family='Arial' background-color='silver' ></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";

                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    //$devS .= "<td colspan='7' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $cuentasporcobrar= "0.00";

                   // $devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' >MAS LAS 7 MARCAS</td>";
                    //$devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

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

function tablaplanificacion($idempleado,$idmarca,$idkardex,$sql,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido)
{   
  $sql4 = "select * from empleados where idempleado='$idempleado'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql4, true, true, 'idalmacen');
                            $idalmacen = $idalmacenA2['resultado'];
    
    $sql211 = getTablaToArrayOfSQL($sql21);
    $sql3 = $sql211['resultado'];
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
                    $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>$nombrecategoria</td>";
                    $devS .= "<td colspan='3' align='center' style='border:1px solid #000000'>STOCK MERCADERIA</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >RECIBIDOS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP REC.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP DESP.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >STOCK ACTUAL</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Rebajas</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Fallas</td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>-</td>";
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
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                  //  $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>-</td>";
                    $devS .= "</tr>";

                    $ii = 0;
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
                            $iddetalleingreso = $fi[$i]['idperiodo'];
                            $idperido =$dato;
                            //ojo
                            $sql = "SELECT periodoactual,estado FROM  periodo WHERE idperiodo = '$dato'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'periodoactual');
                            $periodo = $idalmacenA2['resultado'];
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'estado');
                            $estadoperiodo = $idalmacenA2['resultado'];
                        
                           $mesplani=substr($periodo,0,2);
                            $anioplani=substr($periodo,2,5);

  $mes1="Enero";
 $mes2="Febrero";
 $mes3="Marzo";
 $mes4="Abril";
 $mes5="Mayo";
 $mes6="Junio";
 $mes7="Julio";
 $mes8="Agosto";
 $mes9="Septiembre";
 $mes10="Octubre";
 $mes11="Noviembre";
 $mes12="Diciembre";
if($mesplani=="01"){ $mesgestion=$mes1."-".$anioplani;}
if($mesplani=="02"){ $mesgestion=$mes2."-".$anioplani;}
if($mesplani=="03"){ $mesgestion=$mes3."-".$anioplani;}
if($mesplani=="04"){ $mesgestion=$mes4."-".$anioplani;}
if($mesplani=="05"){ $mesgestion=$mes5."-".$anioplani;}
if($mesplani=="06"){ $mesgestion=$mes6."-".$anioplani;}
if($mesplani=="07"){ $mesgestion=$mes7."-".$anioplani;}
if($mesplani=="08"){ $mesgestion=$mes8."-".$anioplani;}
if($mesplani=="09"){ $mesgestion=$mes9."-".$anioplani;}
if($mesplani=="10"){ $mesgestion=$mes10."-".$anioplani;}
if($mesplani=="11"){ $mesgestion=$mes11."-".$anioplani;}
if($mesplani=="12"){ $mesgestion=$mes12."-".$anioplani;}
$sqlmarca = " SELECT * FROM administrakardex WHERE  mesrango= '$periodo' and idalmacen='$idalmacen'";
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
       if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }
                            $devS .= "<td style='display:none;'>".$dato."</td>";
                            $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$mesgestion."</td>";
                            if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
                            if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
                            if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

                             $select = "SUM(k.totalcajas) AS Pares";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= " k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalcajasrecibido = $almacenA1['resultado'];
                            //  echo $sqlEgreso;
                            $select = "SUM(kp.saldocantidad) AS Pares";
                            $from = "ingresoalmacen i,kardexdetalleparingreso kp";
                            $where = "";
                            { $where .= " i.idingreso=kp.idingreso and i.idempleado='$idempleado' AND i.idmarca = '$idmarca'  AND i.fecha >= '$fechainicio' AND
i.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibido = $almacenA1['resultado'];

                            $select = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from = "kardexdetallepar kp,proformas p,modelo m";
                            $where = "kp.idingreso=p.id_proforma and m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and p.nombre!='00/2016'";
                            { $where .= " AND m.idvendedor='$idempleado' AND p.idmarca = '$idmarca'  AND m.fecha >= '$fechainicio' AND
                                          m.fecha <= '$fechafin' and kp.idalmacen='$idalmacen' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                          //  echo $sql25;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibidonuevo = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'sus');
                            $totalbsrecibidonuevo = $almacenA1['resultado'];

                            $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from1 = "kardexdetallepar kp,proformas p,modelo m,traspaso t,traspasodetallepar tr";
                            $where1 = "kp.idkardexunico=tr.idkardexunico and tr.idmodeloorigen=m.idmodelo AND m.idvendedor='$idempleado' and
                                       tr.iddetalletraspaso=t.idtraspaso and m.`idingreso`=p.`id_proforma` ";
                            { $where1 .= " AND p.idmarca = '$idmarca' AND m.fecha >= '$fechainicio' AND
                                           m.fecha <= '$fechafin' ";}

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
                            { $where .= "k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND
                                         k.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'totalprecio');
                            $totalbsrecibido = $almacenA1['resultado'];

                            $totalbsrecibido = $totalbsrecibido + $totalbsrecibidonuevo + $totalbsrecibidonuevotraspaso;
                            $totalcajasnuevo = $totalparesrecibido/12;
                            $totalcajasrecibido = $totalcajasrecibido + $totalcajasnuevo;
                            $totalcajasrecibido = round($totalcajasrecibido,2);

                            //traspasos entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedororigen='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin'";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasenvinterno= $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasenviinterno = $almacenA1['resultado'];

                            $sqlEgresoq ="SELECT SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and mdd.idvendedor='$idempleado' and it.idmodeloorigen=mdd.idmodelo AND mdd.idmarca = '$idmarca' and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
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
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedor='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasrecinterno = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasrecinterno= $almacenA1['resultado'];


                            $sqlEgreso ="SELECT  SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and it.idmodelo=mdd.idmodelo
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
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');

                            $totalparesventa = $almacenA1['resultado'];
                            $totalcajasventa = $totalparesventa/12;
                            $totalcajasventa = round($totalcajasventa,2);
                            $select = "sUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado' ";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalbsventa = $almacenA1['resultado'];

                            $select = "COUNT(v.iddetalledevolucion) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
    AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalparesdev = $almacenA1['resultado'];
                            $totalcajasdev = $totalparesdev/12;
                            $totalcajasdev= round($totalcajasdev,2);
                            $select = "SUM(v.valorcalzado) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
     AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' ";
                            $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
                            $totalbsdev = $almacenA1['resultado'];

                            $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
                            $estadoperiodo = $almacenA1['resultado'];
  $sqlmarca = " SELECT * FROM administrakardex WHERE mesrango='$mesrango' group by mesrango";
                                $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
                                $mesanterior = $opcionkardex['resultado'];

                            if($estado=="cerrado"){


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesrango'";

                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and m.idvendedor='$idempleado' and
  mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];



                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];

                                $cajasstant = $paresstant/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant =round($cajasstant,2);


                            }else{
                                $select = "SUM(ka.saldocantidad) AS Pares";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = "  ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and m.idvendedor='$idempleado'
    ";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(ka.saldocantidad*ka.preciounitario) AS Precio";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = " ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and m.idvendedor='$idempleado'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    k.mes='$mesanterior'";
                                $sql2p3q = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3q, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];
                                //echo $sql2p3q;
                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
   mes='$mesanterior'";
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
                            $select = "SUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado' ";
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
                            $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca' and cl.idvendedor='$idempleado' ";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                        //    $cuentas = $idalmacenA['resultado'];
//verificas cuentas por cobrar
                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v WHERE v.idventa=vf.idventa and vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idvendedor='$idempleado'  ";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
                            $rebaja = $idalmacenA2['resultado'];
                            $rebaja = round($rebaja,2);
                            $sql3w = "SELECT SUM(vf.diferencia) as total FROM kardexrebaja vf WHERE vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idvendedor='$idempleado'  ";
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
                            //$devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebajas."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
                            $cajasstact =round($cajasstact,2);
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebajainventario."&nbsp;</td>";
                          //  $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$porcentaje."&nbsp;</td>";



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
                    $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$nombrecategoria."</td>";

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
                   // $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajainventario."&nbsp;</td>";
              //      $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tporcentaje."&nbsp;</td>";



                   $devS .= "</tr>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td colspan='3' align='center' font-family='Arial' background-color='silver' >CAPITAL DE OPERACION</td>";
                    $cuentasporcobrar= "0.00";
                    $devS .= "<td colspan='1' align='center' font-family='Arial' background-color='silver' >".$cuentasporcobrar."</td>";
                    $devS .= "<td colspan='16' align='center' font-family='Arial' background-color='silver' ></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";

                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    //$devS .= "<td colspan='7' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $cuentasporcobrar= "0.00";

                   // $devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' >MAS LAS 7 MARCAS</td>";
                    //$devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

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

function dibujarTablaOfSQLmarcarecapitulacionvendedorinf($idempleado,$idkardex,$sql,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido)
{   $idalmacen=$_SESSION['idalmacen'];
    $sqlmarca = " SELECT idperiodo,idkardex FROM administrakardex WHERE idkardex = '$idkardex' group by idkardex";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkar = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];

    if($idkar==null || $idkar==''){
        $sqlmarca = " SELECT * FROM administrakardex WHERE  mesrango= '$idkardex' group by idkardex";
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
        $sqlmarca = " SELECT * FROM administrakardex WHERE idkardex = '$idkar' group by idkardex";
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
                if($fi = mysql_fetch_array($re))
                {
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:1250px;border:1px solid #000000;font-size:13px;font-family:Arial;'>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'>".mysql_field_name($re, $zz)."</td>";
                    $devS .= "<td style='width:120px;border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:13px;text-align:center;'>MARCAS</td>";
                    $devS .= "<td colspan='3' align='center' style='border:1px solid #000000'>STOCK MERCADERIA</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >RECIBIDOS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP REC.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000'>TRASP DESP.</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >VENTAS</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >DEVOLUCION</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cobros</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Cuentas</td>";
                    $devS .= "<td colspan='3' align='center'  style='border:1px solid #000000' >STOCK ACTUAL</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Rebajas</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>Fallas</td>";
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
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>P/C</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Cjs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Prs</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>Sus.</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "</tr>";

                    $ii = 0;
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
                            $iddetalleingreso = $fi[$i]['idmarca'];
                            $idmarca =$dato;
                            //ojo
                            $sql = "SELECT ma.nombre AS marca,ma.talla,ma.opcionb,ma.pedido FROM  `marcas` ma WHERE ma.idmarca = '$dato'";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql, true, true, 'marca');
                            $marcalista = $idalmacenA2['resultado'];
                            $devS .= "<td style='display:none;'>".$dato."</td>";
                            $devS .= "<td style='width:120px;text-align:left;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>".$marcalista."</td>";
                            if($cajasstant==NULL || $cajasstant =='' || $cajasstant == ""){ $cajasstant="0"; }
                            if($paresstant==NULL || $paresstant =='' || $paresstant == ""){ $paresstant="0"; }
                            if($totalbsstant==NULL || $totalbsstant =='' || $totalbsstant == ""){ $totalbsstant="0"; }

                             $select = "SUM(k.totalcajas) AS Pares";
                            $from = "ingresoalmacen k";
                            $where = "";
                            { $where .= " k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND k.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalcajasrecibido = $almacenA1['resultado'];
                            //  echo $sqlEgreso;
                            $select = "SUM(kp.saldocantidad) AS Pares";
                            $from = "ingresoalmacen i,kardexdetalleparingreso kp";
                            $where = "";
                            { $where .= " i.idingreso=kp.idingreso and i.idempleado='$idempleado' AND i.idmarca = '$idmarca'  AND i.fecha >= '$fechainicio' AND
i.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibido = $almacenA1['resultado'];

                            $select = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from = "kardexdetallepar kp,proformas p,modelo m";
                            $where = "kp.idingreso=p.id_proforma and m.idingreso=p.id_proforma and kp.idmodelo=m.idmodelo and p.nombre!='00/2016'";
                            { $where .= " AND m.idvendedor='$idempleado' AND p.idmarca = '$idmarca'  AND m.fecha >= '$fechainicio' AND
                                          m.fecha <= '$fechafin' and kp.idalmacen='$idalmacen' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'Pares');
                            $totalparesrecibidonuevo = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'sus');
                            $totalbsrecibidonuevo = $almacenA1['resultado'];

                            $select1 = "COUNT(kp.idkardexunico) AS Pares, SUM(kp.preciounitario) AS sus";
                            $from1 = "kardexdetallepar kp,proformas p,modelo m,traspaso t,traspasodetallepar tr";
                            $where1 = "kp.idkardexunico=tr.idkardexunico and tr.idmodeloorigen=m.idmodelo AND m.idvendedor='$idempleado' and
                                       tr.iddetalletraspaso=t.idtraspaso and m.`idingreso`=p.`id_proforma` ";
                            { $where1 .= " AND p.idmarca = '$idmarca' AND m.fecha >= '$fechainicio' AND
                                           m.fecha <= '$fechafin' ";}

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
                            { $where .= "k.idempleado='$idempleado' AND k.idmarca = '$idmarca'  AND k.fecha >= '$fechainicio' AND
                                         k.fecha <= '$fechafin' ";}
                            $sql25 = "SELECT ".$select." FROM ".$from." WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql25, true, true, 'totalprecio');
                            $totalbsrecibido = $almacenA1['resultado'];

                            $totalbsrecibido = $totalbsrecibido + $totalbsrecibidonuevo + $totalbsrecibidonuevotraspaso;
                            $totalcajasnuevo = $totalparesrecibido/12;
                            $totalcajasrecibido = $totalcajasrecibido + $totalcajasnuevo;
                            $totalcajasrecibido = round($totalcajasrecibido,2);

                            //traspasos entregados
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedororigen='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin'";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasenvinterno= $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasenviinterno = $almacenA1['resultado'];

                            $sqlEgresoq ="SELECT SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and mdd.idvendedor='$idempleado' and it.idmodeloorigen=mdd.idmodelo AND mdd.idmarca = '$idmarca' and t.fecha >= '$fechainicio' AND t.fecha <= '$fechafin'
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
                            $sqlEgreso ="SELECT SUM(iv.saldocantidad) AS Pares, SUM(iv.preciounitario) AS TotalBs
FROM traspasosinternos iv,modelo md,ventas v, empleados em,empleados emo
WHERE iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and iv.idvendedor='$idempleado' AND md.idmarca = '$idmarca'
AND iv.fecha >= '$fechainicio' AND iv.fecha <= '$fechafin' ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'Pares');
                            $parestrasrecinterno = $almacenA1['resultado'];
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'TotalBs');
                            $bstrasrecinterno= $almacenA1['resultado'];


                            $sqlEgreso ="SELECT  SUM(it.saldocantidad) AS Pares, SUM(it.preciounitario) AS TotalBs
FROM traspaso t,traspasodetallepar it,modelo mdd
WHERE t.idtraspaso=it.iddetalletraspaso and it.idmodelo=mdd.idmodelo
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
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');

                            $totalparesventa = $almacenA1['resultado'];
                            $totalcajasventa = $totalparesventa/12;
                            $totalcajasventa = round($totalcajasventa,2);
                            $select = "sUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca'
and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado' ";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalbsventa = $almacenA1['resultado'];

                            $select = "COUNT(v.iddetalledevolucion) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = " v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
    AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin'";
                            $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
                            $totalparesdev = $almacenA1['resultado'];
                            $totalcajasdev = $totalparesdev/12;
                            $totalcajasdev= round($totalcajasdev,2);
                            $select = "SUM(v.valorcalzado) AS Pares";
                            $from = "detalledevolucion v,devolucion d,kardexdetallepar k";
                            $where = "v.idkardexunico=k.idkardexunico and v.iddevolucion=d.iddevolucion
     AND d.idmarca = '$idmarca' and d.idvendedor='$idempleado'  and d.fecha >= '$fechainicio' AND d.fecha <= '$fechafin' ";
                            $sql2p1 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                            $almacenA1 =  findBySqlReturnCampoUnique($sql2p1, true, true, 'Pares');
                            $totalbsdev = $almacenA1['resultado'];

                            $sqlEgreso ="SELECT  estado FROM periodo WHERE idperiodo= '$idperiodo'    ";
                            $almacenA1 =  findBySqlReturnCampoUnique($sqlEgreso, true, true, 'estado');
                            $estadoperiodo = $almacenA1['resultado'];
  $sqlmarca = " SELECT * FROM administrakardex WHERE mesrango='$mesrango' group by mesrango";
                                $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesanterior");
                                $mesanterior = $opcionkardex['resultado'];

                            if($estado=="cerrado"){


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesrango'";

                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and m.idvendedor='$idempleado' and
  mes='$mesrango'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];

                          

                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];

                                $cajasstant = $paresstant/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    mes='$mesanterior'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstant = $almacenA1['resultado'];
                                $cajasstant =round($cajasstant,2);


                            }else{
                                $select = "SUM(ka.saldocantidad) AS Pares";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = "  ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and m.idvendedor='$idempleado'
    ";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Pares');
                                $paresstact = $almacenA1['resultado'];

                                $cajasstact = $paresstact/12;
                                $select = "SUM(ka.saldocantidad*ka.preciounitario) AS Precio";
                                $from = "modelo m,kardexdetallepar ka";
                                $where = " ka.idmodelo=m.idmodelo  aND m.idmarca = '$idmarca' and m.idvendedor='$idempleado'";
                                $sql2p3 = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3, true, true, 'Precio');
                                $totalbsstact = $almacenA1['resultado'];


                                $select = "SUM(k.pares) AS Pares";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
    k.mes='$mesanterior'";
                                $sql2p3q = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
                                $almacenA1 =  findBySqlReturnCampoUnique($sql2p3q, true, true, 'Pares');
                                $paresstant = $almacenA1['resultado'];
                                //echo $sql2p3q;
                                $cajasstact = $paresstact/12;
                                $select = "SUM(k.pares*m.preciounitario) AS Precio";
                                $from = "kardexresumen k,modelo m";
                                $where = " k.idmodelo=m.idmodelo AND k.idmarca = '$idmarca' and k.idvendedor='$idempleado' and
   mes='$mesanterior'";
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
                            $select = "SUM(vi.precioventa) AS Pares";
                            $from = "ventas v,modelo mo,ventaitem vi";
                            $where = "v.idventa=vi.idventa AND vi.idmodelo=mo.idmodelo and mo.idmarca = '$idmarca' and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and v.idvendedor='$idempleado' ";
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
                            $where = "cl.idcliente=c.idcliente and cl.estado='pendiente' and cl.idmarca='$idmarca' and cl.idvendedor='$idempleado' ";
                            $sql251 = "SELECT ".$select." FROM ".$from." WHERE ".$where." ";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql251, true, true, 'monto');
                            $cuentas = $idalmacenA['resultado'];

                            $sql3 = "SELECT SUM(vf.diferencia) as total FROM ventafinalmodelo vf, ventas v WHERE v.idventa=vf.idventa and vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idvendedor='$idempleado'  ";
                            $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'total');
                            $rebaja = $idalmacenA2['resultado'];
                            $rebaja = round($rebaja,2);
                            $sql3w = "SELECT SUM(vf.diferencia) as total FROM kardexrebaja vf WHERE vf.idmarca = '$idmarca' and vf.fecha >= '$fechainicio'
    AND vf.fecha <= '$fechafin' and vf.idvendedor='$idempleado'  ";
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
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cuentas."&nbsp;</td>";
                            $cajasstact =round($cajasstact,2);
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$cajasstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$paresstact."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$totalbsstact."&nbsp;</td>";
                            
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebaja."&nbsp;</td>";
                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$rebajainventario."&nbsp;</td>";
                            


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
                    $devS .= "<td style='width:120px;text-align:center;border-bottom: 1px solid #000000;font-weight:bold;font-size:12px;'>TOTAL -".$nombrecategoria."</td>";

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
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcuentas."&nbsp;</td>";

                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tcajasstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$tparesstact."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$ttotalbsstact."&nbsp;</td>";
                    
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebaja."&nbsp;</td>";
                    $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border: 1px solid #000000;'>&nbsp;".$trebajainventario."&nbsp;</td>";



                   $devS .= "</tr>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    $devS .= "<td colspan='3' align='center' font-family='Arial' background-color='silver' >CAPITAL DE OPERACION</td>";
                    $cuentasporcobrar= "0.00";
                    $devS .= "<td colspan='1' align='center' font-family='Arial' background-color='silver' >".$cuentasporcobrar."</td>";
                    $devS .= "<td colspan='16' align='center' font-family='Arial' background-color='silver' ></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";

                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

                    $devS .= "</tr>";
                    $devS .= "<tr><td style='border-bottom:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'></td>";
                    $devS .= "<td style='display:none;'></td>";
                    //$devS .= "<td colspan='7' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $cuentasporcobrar= "0.00";

                   // $devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' >MAS LAS 7 MARCAS</td>";
                    //$devS .= "<td colspan='2' align='center' font-family='Arial' background-color='silver' ></td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                   // $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'>".$cuentasporcobrar."</td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";
                    $devS .= "<td style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;'></td>";

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
function tablatraspasosinternos($idempleado,$idmarca,$idkardex,$sql,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido,$fechainicio,$fechafin)
{

$idalmacen=$_SESSION['idalmacen'];
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
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:13px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombrecategoria</td></tr>";
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
                            $sql2 = "SELECT nombres FROM empleados WHERE idempleado = '$idvendedor'";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombres');
                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($empresa1);

$select1 = " iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade";
$from1 = "traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo";
$where1 = " iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and v.idmarca='$idmarca' and v.idvendedor='$idvendedor'";

                            if($fechainicio != null && $fechainicio != "")
                            { $where1 .= " AND iv.fecha >='$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where1 .= " AND iv.fecha <='$fechafin' ";}
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." Group by iv.idmodelo order by em.nombres ";

$select12 = " SUM(iv.preciounitario) as totalsus";
$from12 = "traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo";
$where12 = " iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and v.idmarca='$idmarca' and v.idvendedor='$idvendedor'";
                            if($fechainicio != null && $fechainicio != "")
                            { $where12 .= " AND iv.fecha >='$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where12 .= " AND iv.fecha <='$fechafin' ";}
                            $sqlruta2 = "SELECT ".$select12." FROM ".$from12. " WHERE ".$where12." ";
  $idalmacenA2 =  findBySqlReturnCampoUnique($sqlruta2, true, true, 'totalsus');
    $tsus = $idalmacenA2['resultado'];
$select121 = " SUM(iv.saldocantidad) as totalpares";
 $sqlruta21 = "SELECT ".$select121." FROM ".$from12. " WHERE ".$where12." ";
$idalmacenA2 =  findBySqlReturnCampoUnique($sqlruta21, true, true, 'totalpares');
    $tpares = $idalmacenA2['resultado'];

                        //  function dibujarTablasimplesintotales($sql, $titulo,$tcajas,$tpares,$tsus,$tpares,$tsus)
                            $table = dibujarTablasimplesintotales($sqlruta, $empresa,$tdesc,$tpares,$tsus,$tpares,$tsus);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

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

function tablatraspasosinternosenviado($idempleado,$idmarca,$idkardex,$sql,$sql21,$row1,$nombrecategoria,$porcentajecat,$parestotalactualcategoria,$idalmacen,$rango1,$rango2,$totalparesestilo,$totalbsestilo, $tipo,$marcapedido,$fechainicio,$fechafin)
{

$idalmacen=$_SESSION['idalmacen'];
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
                    $devS .= "<table cellpadding='0' cellspacing='0' border='0' style='width:100%;border:1px solid #000000;font-size:13px;'>";
                    $devS .= "<tr><td colspan='".(mysql_num_fields($re)+1)."' style='border-bottom:1px solid #000000;font-weight:bold;font-size:16px;text-align:left;'>$nombrecategoria</td></tr>";
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
                            $sql2 = "SELECT nombres FROM empleados WHERE idempleado = '$idvendedor'";
                            $idalmacenA =  findBySqlReturnCampoUnique($sql2, true, true, 'nombres');
                            $empresa1 = $idalmacenA['resultado'];
                            $empresa=strtoupper($empresa1);

// $select = "emo.idempleado as idvendedor";
//    $from = "traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo";
//    $where = "iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
//iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and v.idmarca='$idmarca'";
//    { $where .= " AND iv.fecha >='$fechainicio' ";}
//    if($fechafin != null && $fechafin != "")
//    { $where .= " AND iv.fecha <='$fechafin' ";}

$select1 = " iv.idventa,iv.fecha,mar.nombre as marca,md.codigo as modelo,
SUM(iv.saldocantidad) as totalpares,SUM(iv.preciounitario) as totalsus,em.nombres as vendidopor,emo.nombres as mercaderiade";
$from1 = "traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo";
$where1 = " iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and v.idmarca='$idmarca' and iv.idvendedororigen='$idvendedor'";

                            if($fechainicio != null && $fechainicio != "")
                            { $where1 .= " AND iv.fecha >='$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where1 .= " AND iv.fecha <='$fechafin' ";}
                            $sqlruta = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1." Group by iv.idmodelo order by em.nombres ";

$select12 = " SUM(iv.preciounitario) as totalsus";
$from12 = "traspasosinternos iv,modelo md,ventas v,`marcas` mar, empleados em,empleados emo";
$where12 = " iv.idventa=v.idventa and iv.idmodelo=md.idmodelo and v.idmarca=mar.idmarca and
iv.idvendedor=em.idempleado and iv.idvendedororigen=emo.idempleado and v.idalmacen='$idalmacen' and v.idmarca='$idmarca' and iv.idvendedororigen='$idvendedor'";
                            if($fechainicio != null && $fechainicio != "")
                            { $where12 .= " AND iv.fecha >='$fechainicio' ";}
                            if($fechafin != null && $fechafin != "")
                            { $where12 .= " AND iv.fecha <='$fechafin' ";}
                            $sqlruta2 = "SELECT ".$select12." FROM ".$from12. " WHERE ".$where12." ";
  $idalmacenA2 =  findBySqlReturnCampoUnique($sqlruta2, true, true, 'totalsus');
    $tsus = $idalmacenA2['resultado'];
$select121 = " SUM(iv.saldocantidad) as totalpares";
 $sqlruta21 = "SELECT ".$select121." FROM ".$from12. " WHERE ".$where12." ";
$idalmacenA2 =  findBySqlReturnCampoUnique($sqlruta21, true, true, 'totalpares');
    $tpares = $idalmacenA2['resultado'];

                        //  function dibujarTablasimplesintotales($sql, $titulo,$tcajas,$tpares,$tsus,$tpares,$tsus)
                            $table = dibujarTablasimplesintotales($sqlruta, $empresa,$tdesc,$tpares,$tsus,$tpares,$tsus);
                            $devS .= $table['resultado'];

                            $devS .= "<td style='text-align:center;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>&nbsp;".$stockanterior."&nbsp;</td>";

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

  ?>