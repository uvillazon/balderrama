<?php
function Registraridreporte($productos,$idcliente,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
    $estado='validado';

    $idmarca = '';
    $numeroD = findUltimoID("reportecliente", "numero", true);
    $idnumeracion = $numeroD['resultado'] +1;
    $idnumeracionimpresion = "imp-".$idnumeracion;
    //String $idcliente="0";
    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $idventa = $producto->idventa;
        $idcrecliente = $producto->idcrecliente;

        //    $sql1= "SELECT idcliente FROM creditocliente WHERE idventa = '$idventa' ";
        //    $result = findBySqlReturnCampoUnique($sql1, true, true, "idcliente");
        //    $idcliente = $result['resultado'];

        $sql[] = "UPDATE creditocliente SET observacion ='$idnumeracion' WHERE idventa = '$idventa' and idcrecliente='$idcrecliente' and idcliente='$idcliente';";

    }

    $sql[]=reportecliente($idnumeracion, $idnumeracionimpresion, $idnumeracion,$idcliente, false);
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se valido correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idnumeracion";
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

function GuardarCambioSaldo($resultado, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idtienda =$_SESSION['idtienda'];
    $responsable = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    //"cobro":{"idcliente":"cli-192", "recibo":"111", "idvendedorn":"VENDEDOR-NUEVO"}, "cobrocliente":[{"idventa":"7223", "idcrecliente":"5"}]}

    //   $proforma = $resultado->cobro;
    ////    $numeroventaA = findUltimoID("ventasdetalle", "numero", true);
    ////    $numeroventaj = $numeroventaA['resultado'];
    ////    $numeroventa = $numeroventaj + 1;
    ////    $idventadetalle="ven-id-".$numeroventa;
    //
    //    $idcliente=$proforma->idcliente;
    //    $recibo=$proforma->recibo;
    //    $vendedornuevo=$proforma->idvendedorn;
    //    $formatear1 = explode( '-' , $vendedornuevo);
    //$nombrev = $formatear1[0];
    //$apellidov = $formatear1[1];
    //    $sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev' AND apellidos='$apellidov'";
    //    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
    //    $idvendedornuevo = $result1['resultado'];
    //  $fecha = date("Y-m-d");
    //
    ////$sql[] = getSqlNewDepositocheque1($idcheque, $idpagocredito, $idempresa, $montototal, $chequebanco, $chequecuentabanco, $chequemontoefectivo, $chequemonto, $tipopago, $sus, $bs, $chequebs, $ingresoextra, $totalmontocomision, $gastosbs, $gastossus,$estado, $fecha, $hora,$idcomision, $numero1,$dolaresequivbssus,false);
    //
    //    $product = $resultado->cobrocliente;
    //$totalpares=COUNT($product);
    //  for($i=0;$i<count($product);$i++){
    //       $numeroA = findUltimoID("pagocredito", "numero", true);
    //    $numero = $numeroA['resultado']+1 + $i;
    //    $idpagocredito = "pagcred-".$numero;
    //        $producto = $product[$i];
    //$idventa = $producto->idventa;
    //  $idcrecliente = $producto->idcrecliente;
    //
    //     $sql1= "SELECT *  FROM creditocliente WHERE idcrecliente='$idcrecliente' AND idventa='$idventa' and idcliente='$idcliente'";
    //    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
    //    $idcreditomayor = $result1['resultado'];
    //    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "porpagar");
    //    $porpagar = $result1['resultado'];
    //     $result1 = findBySqlReturnCampoUnique($sql1, true, true, "monto");
    //    $monto = $result1['resultado'];
    //     $result1 = findBySqlReturnCampoUnique($sql1, true, true, "pago");
    //    $pagoa = $result1['resultado'];
    //       $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    //    $idmarca = $result1['resultado'];
    //     $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
    //    $idvendedorold = $result1['resultado'];
    ////  $sql1= "SELECT * FROM creditomayor WHERE idcredito='$idcreditomayor' AND idvendedor='$idvendedorold' and idcliente='$idcliente'";
    // $sql4 = "SELECT * FROM creditomayor WHERE idcredito='$idcreditomayor' AND idvendedor='$idvendedorold' and idcliente='$idcliente'";
    //    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    //   $pagotodo = $paresd['resultado'];
    //      $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventacaja");
    //   $ventacaja = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventapar");
    //   $ventapar = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
    //   $ventasus = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
    //   $saldoact = $paresd['resultado'];
    ////$vcajan=$ventacaja+$tcajas;
    ////$vparn=$ventapar+$totalpares;
    //$ventasusn=$ventasus-$monto;
    //$pagon=$pagotodo-$pagoa;
    ////$pagon=$pagotodo-$pagoa;
    //$saldon=$saldoact-$porpagar;
    //
    // $sql[] = "UPDATE creditomayor SET pago='$pagon',ventasus='$ventasusn',saldoact='$saldon' WHERE idcredito='$idcreditomayor' AND idvendedor='$idvendedorold' and idcliente='$idcliente';";
    ////para nuevo
    // $sql1= "SELECT idcredito FROM creditomayor WHERE idcliente = '$idcliente' AND idmarca='$idmarca' AND idvendedor='$idvendedornuevo'
    // AND estado='ACTIVO' ";
    // $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
    //  $idcreditoexiste = $result1['resultado'];
    //if($idcreditoexiste==null || $idcreditoexiste==""){
    //       $codigobarraA = obteneridcreditocambio($idventa,$idvendedornuevo, $idmarca,$idcliente, true);
    //       $idcredito = $codigobarraA['resultado'];
    ////echo "inserta en creditomayor";
    //
    // $sql[] = "UPDATE creditocliente SET idvendedor='$idvendedornuevo',idcredito='$idcredito' WHERE idcrecliente='$idcrecliente' AND idventa='$idventa' and idcliente='$idcliente';";
    //
    //}else{
    //   //ya existe
    //   $sql[] = "UPDATE creditocliente SET idvendedor='$idvendedornuevo',idcredito='$idcreditoexiste' WHERE idcrecliente='$idcrecliente' AND idventa='$idventa' and idcliente='$idcliente';";
    // $sql4 = "SELECT * FROM creditomayor WHERE idcredito='$idcreditoexiste' AND idvendedor='$idvendedornuevo' and idcliente='$idcliente'";
    //    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    //   $pagotodo = $paresd['resultado'];
    //      $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventacaja");
    //   $ventacaja = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventapar");
    //   $ventapar = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
    //   $ventasus = $paresd['resultado'];
    //     $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
    //   $saldoact = $paresd['resultado'];
    ////$vcajan=$ventacaja+$tcajas;
    ////$vparn=$ventapar+$totalpares;
    //$ventasusn=$ventasus+$monto;
    //$pagon=$pagotodo+$pagoa;
    //$saldon=$saldoact+$porpagar;
    //$sql[] = "UPDATE creditomayor SET pago='$pagon',ventasus='$ventasusn',saldoact='$saldon' WHERE idcredito='$idcreditoexiste' AND idvendedor='$idvendedornuevo' and idcliente='$idcliente';";
    //
    //     }

    //   }

    //echo $sql;
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['mensaje'] = "Se guardo correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idcredito;
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
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
function verificarcierrecobros($fechav, $return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];
    $fecha22= split("-", $fechav);
    $y=$fecha22[0];
    $m=$fecha22[1];
    $d=$fecha22[2];
    $fecha1 = $m.$y;
////    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor where estadomes = 'activo' and idalmacen = '$idalmacen'";
////    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
////    $idcredit = $result['resultado'];

////    $sql1= "SELECT mescierre FROM creditomayor WHERE idcredito = '$idcredit' and idalmacen = '$idalmacen'";
////    $result = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
////    $mescierre = $result['resultado'];
    $sql1= "SELECT periodoactual FROM periodo WHERE estado = 'abierto' and idalmacen = '$idalmacen'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    $mescierre = $result['resultado'];
//echo $mescierre;
    if($mescierre==$fecha1){
        $dev['mensaje'] = "Puede Confirma $mescierre $fecha1";
        $dev['error'] = "true";
        $dev['resultado'] = "true";
    }
    else
    {
        $dev['mensaje'] = "No puede confirmar $mescierre $fecha1";
        $dev['error'] = "false";
        $dev['resultado'] = "false";
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
function Confirmarventasunidad($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $idventa = $resultado->idventa;

    $sql4 = "SELECT * FROM ventas WHERE idventa='$idventa'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idvendedor");
    $idvendedor = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
    $idmarca = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcliente");
    $idcliente = $paresd['resultado'];
    registrarcadacredito($idventa,$idvendedor, $idmarca,$idcliente,false);
    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['mensaje'] = "Se guardo correctamente";
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

function Confirmardevolucionunidad($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $idventa = $resultado->idventa;
    $iddevolucion = $resultado->iddevolucion;
    $sql4 = "SELECT * FROM devolucion WHERE iddevolucion='$iddevolucion'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idvendedor");
    $idvendedor = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
    $idmarca = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcliente");
    $idcliente = $paresd['resultado'];
    registrarcadacreditodevolucion($idventa,$iddevolucion,$idvendedor, $idmarca,$idcliente,false);

    $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
    //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['mensaje'] = "Se guardo la devolucion correctamente";
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

function Confirmarventas($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $fechaventa = $resultado->fecha;

    $sql1= "SELECT fecha FROM ventas WHERE idalmacen = '$idalmacen' and fecha='$fechaventa' AND estado='PENDIENTE'
  GROUP BY fecha";

    $result2 = findBySqlReturnCampoUnique($sql1, true, true, "fecha");
    $planillaemitida = $result2['resultado'];

    if($planillaemitida!=null || $planillaemitida!=''){
        $sql ="
SELECT idventa
FROM ventas
WHERE idalmacen = '$idalmacen' and fecha='$fechaventa' AND estado='PENDIENTE'
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
                                mysql_field_name($re, $i) == "idventa";
                                $idventa = $fi[$i];

                                $sql4 = "SELECT * FROM ventas WHERE idventa='$idventa'  ";
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idvendedor");
                                $idvendedor = $paresd['resultado'];
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
                                $idmarca = $paresd['resultado'];
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcliente");
                                $idcliente = $paresd['resultado'];
                                registrarcadacredito($idventa,$idvendedor, $idmarca,$idcliente,false);
                                // $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
                                $pagocreditonuevo = '0';

                            }

                            //  $ii++;
                        }while($fi = mysql_fetch_array($re));
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $idventa;

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
            $dev['mensaje'] = "Existen resultados";
            $dev['error']   = "true";
            $dev['resultado'] = $idventa;
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
        $dev['mensaje'] = "ok";
        $dev['error'] = "true";
        $dev['resultado'] = "";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }else{

        $dev['mensaje'] = "Ya este dia fue confirmado. Verifique otras fechas";
        $dev['error'] = "false";
        $dev['resultado'] = "";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }

}
function eliminarcredito($idcreditocli,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $sql4 = "SELECT COUNT(cl.idcrecliente) as num FROM creditocliente cl WHERE cl.idcredito ='$idcreditocli'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "num");
    $cuentaspendientes = $paresd['resultado'];

    if($cuentaspendientes == '1' )
    {
        $sql41 = "SELECT * FROM creditocliente cl WHERE cl.idcredito ='$idcreditocli'  ";
        $paresd = findBySqlReturnCampoUnique($sql41, true, true, "boleta");
        $boleta = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql41, true, true, "idcredito");
        $idcredito = $paresd['resultado'];
        if($boleta == 'inicial' )
        {
            $sql[] = "DELETE FROM creditocliente WHERE idcredito ='$idcreditocli';";
            $sql[] = "DELETE FROM creditomayor WHERE idcreditocli ='$idcreditocli';";
        }else{
            $dev['mensaje'] = "Error no se puede eliminar tiene ya historial en movimiento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
    }
    else
    {
        $dev['mensaje'] = "Error no se puede eliminar tiene ya historial en movimiento";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino la cuenta correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al eliminar";
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
function getSqlDeleteCliente($idcliente){
    return "DELETE FROM clienteempresa WHERE idclienteempresa = '$idcliente';";
}
function Confirmardevolucion($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $fechaventa = $resultado->fecha;

    $sql1= "SELECT fecha FROM devolucion WHERE idalmacen = '$idalmacen' and fecha='$fechaventa' AND estadomayor='PENDIENTE'
  GROUP BY fecha";
    $result2 = findBySqlReturnCampoUnique($sql1, true, true, "fecha");
    $planillaemitida = $result2['resultado'];

    if($planillaemitida!=null || $planillaemitida!=''){
        $sql ="
SELECT iddevolucion
FROM devolucion
WHERE idalmacen = '$idalmacen' and fecha='$fechaventa' AND estadomayor='PENDIENTE'
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
                            //while($fi = mysql_fetch_array($re));
                            for($i = 0; $i< mysql_num_fields($re); $i++)
                            {
                                mysql_field_name($re, $i) == "iddevolucion";
                                $iddevolucion = $fi[$i];

                                $sql4 = "SELECT * FROM detalledevolucion WHERE iddevolucion='$iddevolucion' group by iddevolucion  ";

                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idventadetalle");
                                $idventa = $paresd['resultado'];
                                $sql4 = "SELECT * FROM devolucion WHERE iddevolucion='$iddevolucion'  ";
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idvendedor");
                                $idvendedor = $paresd['resultado'];
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
                                $idmarca = $paresd['resultado'];
                                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcliente");
                                $idcliente = $paresd['resultado'];
                                registrarcadacreditodevolucion($idventa,$iddevolucion,$idvendedor, $idmarca,$idcliente,false);

                                $pagocreditonuevo = '0';

                            }

                            //  $ii++;
                        }while($fi = mysql_fetch_array($re));
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $idventa;

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
            $dev['mensaje'] = "Existen resultados";
            $dev['error']   = "true";
            $dev['resultado'] = $idventa;
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
        $dev['mensaje'] = "ok";
        $dev['error'] = "true";
        $dev['resultado'] = "";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }else{

        $dev['mensaje'] = "Ya este dia fue confirmado. Verifique otras fechas";
        $dev['error'] = "false";
        $dev['resultado'] = "";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }

}

function registrarcadacredito($idventa,$idvendedor, $idmarca,$idcliente,$return = false ){
    set_time_limit(0);
    $emitida="1";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    $idalmacen = $_SESSION['idalmacen'];
    $sql4 = "SELECT * FROM ventas WHERE idventa='$idventa'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fechaventa = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalsus");
    $totalsus= $paresd['resultado'];

    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalbs");
    $totalbs = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldo");
    $saldo = $paresd['resultado'];
    $sql3 = " SELECT SUM(vi.cantidad)AS totalpares FROM ventaitem vi WHERE vi.idventa='$idventa' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalpares");
    $totalpares = $cantidadventaA1['resultado'];
    $sql3 = " SELECT (SUM(vi.cantidad)/12)AS cajas FROM ventaitem vi WHERE vi.idventa='$idventa' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cajas");
    $tcajas = $cantidadventaA1['resultado'];

    $sql1= "SELECT idcredito, idcreditocli, mescierre FROM creditomayor WHERE idcliente = '$idcliente' AND idmarca='$idmarca' AND idvendedor='$idvendedor' AND idalmacen = '$idalmacen' AND estadomes = 'activo' ";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
    $idcreditoexiste = $result1['resultado'];
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcreditocli");
    $idcreditocliexiste = $result1['resultado'];
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
    $mescierre = $result1['resultado'];

    if($idcreditoexiste==null || $idcreditoexiste==""){
        $codigobarraA = obteneridcredito($idventa,$idvendedor, $idmarca,$idcliente, true);
        $idcredito = $codigobarraA['resultado'];
        //echo "inserta en creditomayor";
        $sqlA[] =getSqlNewCreditocliente($idcrecliente, $idventa, $idcliente, $idcredito, $fechaventa, $boleta, $idmarca, $idvendedor, $tcajas, $totalpares, $totalsus, $pagonuevo, $rebaja, $pagado, $totalsus, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);
    }else{
        //  echo "ya existe actualizar creditomayor";
        $idcredito=$idcreditoexiste;
        $idcreditocli=$idcreditocliexiste;
        $sql4 = "SELECT * FROM creditomayor WHERE idcredito='$idcredito' AND idalmacen = '$idalmacen'  ;";
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
        $saldoant = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
        $pago = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
        $rebaja = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventacaja");
        $ventacaja = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventapar");
        $ventapar = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
        $ventasus = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
        $saldoact = $paresd['resultado'];
        $ventacaja1=$ventacaja+$tcajas;
        $ventapar1=$ventapar+$totalpares;
        $ventasus1=$ventasus+$totalsus;
        //$saldoact1=$saldoact+$ventasus1;
        $saldoact1 =$saldoant + $ventasus1 - $pago -$rebaja;
        $sqlA[] = "UPDATE creditomayor SET ventacaja='$ventacaja1',ventapar='$ventapar1',ventasus='$ventasus1',saldoact='$saldoact1' WHERE idcredito='$idcredito' AND idcliente = '$idcliente' AND idmarca='$idmarca';";
        $sqlA[] =getSqlNewCreditocliente($idcrecliente, $idventa, $idcliente, $idcreditocli, $fechaventa, $boleta, $idmarca, $idvendedor, $tcajas, $totalpares, $totalsus, $pagonuevo, $rebaja, $pagado, $totalsus, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);
    }
    //MostrarConsulta($sqlA);
    $sql4 = "SELECT * FROM clientes WHERE idmarca='$idmarca' and idalmacen='$idalmacen' and idvendedor='$idvendedor' and tipocliente='incremento'";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcliente");
    $idclienteincremento= $paresd['resultado'];
    //manejo de incremento en ventas
    $sql4 = "SELECT SUM(diferencia) as total FROM ventafinalmodelo WHERE idventa='$idventa'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "total");
    $totaldiferencia = $paresd['resultado'];
    if($totaldiferencia=='0' || $totaldiferencia=='0.00')
    {}else{
        if($idclienteincremento==null || $idclienteincremento==""){
        }else{
            $sql1= "SELECT idcredito,idcreditocli FROM creditomayor WHERE idcliente = '$idclienteincremento' AND idmarca='$idmarca' AND idvendedor='$idvendedor'
                    AND idalmacen = '$idalmacen' AND estadomes='activo' ";
            $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
            $idcreditoexisteinc = $result1['resultado'];
            $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcreditocli");
            $idcreditocliexisteinc = $result1['resultado'];

            if($idcreditoexisteinc==null || $idcreditoexisteinc==""){
                $codigobarraA = registrarincrementonuevoid($idventa,$idvendedor, $idmarca,$idclienteincremento,$totaldiferencia, true);
                $idcredito = $codigobarraA['resultado'];
            }else{
                //  echo "ya existe actualizar creditomayor";
                $idcredito=$idcreditoexisteinc;
                $idcreditocli=$idcreditocliexisteinc;
                $sql4 = "SELECT * FROM creditomayor WHERE idcredito='$idcredito' AND idalmacen = '$idalmacen' ";
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
                $saldoant = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
                $pago = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
                $rebaja = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventacaja");
                $ventacaja = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventapar");
                $ventapar = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
                $ventasus = $paresd['resultado'];
                $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
                $saldoact = $paresd['resultado'];

                $ventasus1=$ventasus+$totaldiferencia;
                //$saldoact1=$saldoact+$ventasus1;
                $saldoact1 =$saldoant + $ventasus1 ;
                $sqlA[] = "UPDATE creditomayor SET ventasus='$ventasus1',saldoact='$saldoact1' WHERE idcredito='$idcredito' AND idcliente = '$idclienteincremento' AND idmarca='$idmarca' and estadomes='activo' ;";
                //$idcliente =  $idclienteincremento;
            }
            $sqlA[] =getSqlNewCreditocliente($idcrecliente, $idventa, $idclienteincremento, $idcreditocli, $fechaventa, $boleta, $idmarca, $idvendedor, $tcajas, $totalpares, $totaldiferencia, $pagonuevo, $rebaja, $pagado, $totaldiferencia, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);
        }
    }
    //fin incrementos
    $nuevafecha = strtotime ( '+1 month' , strtotime ( $fechaventa ) ) ;
    $fechalimite = date ( 'Y-m-j' , $nuevafecha );

    $sqlA[] = "UPDATE ventas SET estado='CONFIRMADO' WHERE idventa='$idventa';";

    //MostrarConsulta($sqlA);

    if($return == true)
    {
        return $sqlA;
    }
    else
    {
        if(ejecutarConsultaSQLBeginCommit($sqlA))
        {
            $dev['mensaje'] = "Se guardo una transaccion correctamente";
            $dev['error'] = "true";
            $dev['resultado'] = "$idplanillaemitida";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idplanillaemitida";
        }
    }
}
function registrarcadacreditodevolucion($idventa,$iddevolucion,$idvendedor, $idmarca,$idcliente,$return = false ){
    set_time_limit(0);
    $emitida="1";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $fechaemitida = date("Y-m-d");
    $idalmacen=$_SESSION['idalmacen'];
    $sql4 = "SELECT * FROM devolucion WHERE iddevolucion='$iddevolucion'";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "dato");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fechaventa = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pares");
    $paresdev= $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "venta");
    $saldo = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "venta");
    $totalsus = $paresd['resultado'];
    $sql3 = " SELECT COUNT(vi.iddetalledevolucion)AS totalpares FROM detalledevolucion vi WHERE vi.iddevolucion='$iddevolucion' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalpares");
    $totalpares = $cantidadventaA1['resultado'];
    $sql3 = " SELECT (COUNT(vi.iddetalledevolucion)/12)AS cajas FROM detalledevolucion vi WHERE vi.iddevolucion='$iddevolucion' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cajas");
    $tcajas = $cantidadventaA1['resultado'];

    $sql1= "SELECT idcredito, idcreditocli FROM creditomayor WHERE idcliente = '$idcliente' AND idmarca='$idmarca' AND idvendedor='$idvendedor'
 AND estadomes='activo' ";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcredito");
    $idcreditoexiste = $result1['resultado'];
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcreditocli");
    $idcreditocliexiste = $result1['resultado'];

    if($idcreditoexiste==null || $idcreditoexiste==""){
        $codigobarraA = obteneridcreditodevolucion($iddevolucion,$idvendedor, $idmarca,$idcliente, true);
        $idcredito = $codigobarraA['resultado'];
        //echo "inserta en creditomayor";
    }else{
        //  echo "ya existe actualizar creditomayor";
        $idcredito=$idcreditoexiste;
        $idcreditocli=$idcreditocliexiste;
        $sql4 = "SELECT * FROM creditomayor WHERE idcredito='$idcredito'  ";
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
        $saldoant = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
        $pago = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
        $rebaja = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventacaja");
        $ventacaja = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventapar");
        $ventapar = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
        $ventasus= $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
        $saldoact = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
        $susdev = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pardev");
        $pardev = $paresd['resultado'];
        //$ventacaja1=$ventacaja-$tcajas;
        $ventapar1=$pardev+$paresdev;
        $susdevt=$susdev+$totalsus;
        //$saldoact1=$saldoact+$ventasus1;
        $saldoact1 =$saldoant + $ventasus - $pago -$rebaja - $susdevt ;
        //$saldoact1 =$saldoant + $ventasus1 - $pago -$rebaja;
        $sqlA[] = "UPDATE creditomayor SET pardev='$ventapar1',susdev='$susdevt',saldoact='$saldoact1' WHERE idcredito='$idcredito' AND idcliente = '$idcliente' AND idmarca='$idmarca';";
        //$sqlA[] = "UPDATE creditomayor SET ventacaja='$ventacaja1',ventapar='$ventapar1',ventasus='$ventasus1',saldoact='$saldoact1' WHERE idcredito='$idcredito' AND idcliente = '$idcliente' AND idmarca='$idmarca';";
        $sql1= "SELECT idcrecliente FROM creditocliente WHERE idcliente = '$idcliente' AND idmarca='$idmarca' AND idvendedor='$idvendedor'
 AND idcredito='$idcreditocli' and idventa='$idventa'";
        $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcrecliente");
        $idcreditoexistecuenta = $result1['resultado'];

        if($idcreditoexistecuenta==null || $idcreditoexistecuenta==""){
            $sql1= "SELECT MAX(idcrecliente) AS num FROM creditocliente";
            $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
            $numeroventaj1 = $result['resultado'];
            $idcrecliente = $numeroventaj1+1;

            $sqlA[] =getSqlNewCreditoclientenuevo($idcrecliente, $idventa, $idcliente, $idcreditocli, $fechaventa, $boleta, $idmarca, $idvendedor, "0",  "0",  "0",  "0",  "0",  "0",  (-$totalsus), $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, $factura, $boletamanual, $totalpares, $totalsus,false);

        }else{
            $sql1= "SELECT * FROM creditocliente WHERE idcliente = '$idcliente' AND idmarca='$idmarca' AND idvendedor='$idvendedor'
 AND idcredito='$idcreditocli' and idcrecliente='$idcreditoexistecuenta'";
            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "sus");
            $ventasus1 = $paresd['resultado'];

            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "pago");
            $pago = $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "rebaja");
            $rebaja = $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "pardev");
            $pardevo = $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "susdev");
            $susdevo= $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql1, true, true, "sus");
            $montoventa= $paresd['resultado'];
            $sumpardev =$pardevo+$totalpares;
            $summontodev=$susdevo+$totalsus;
            //$ventasus1=$ventasus1-$summontodev;
            //$montopagar=$saldoant+$ventasus1 - $pago -$rebaja - $summontodev;
            $montopagar=$ventasus1 - $pago -$rebaja -$summontodev ;

            $sqlA[] = "UPDATE creditocliente SET porpagar='$montopagar',pardev='$sumpardev',susdev='$summontodev' WHERE idcrecliente='$idcreditoexistecuenta';";

        }
    }
    //$fecha = date('Y-m-j');
    $nuevafecha = strtotime ( '+1 month' , strtotime ( $fechaventa ) ) ;
    $fechalimite = date ( 'Y-m-j' , $nuevafecha );

    //function getSqlNewCreditoclientenuevo($idcrecliente, $idventa, $idcliente, $idcredito, $fechaventa, $boleta, $idmarca, $idvendedor, $caja, $par, $sus, $pago, $rebaja, $pagado, $porpagar, $ultimopago, $fechalimite, $morosidad, $estado, $diferencia, $observacion, $factura, $boletamanual, $pardev, $susdev, $return){

    //$sqlA[] =  getSqlNewCreditodevolucion($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion,$factura, $numerof, false);
    $sqlA[] =  getSqlNewCreditodevolucion($idcrecliente, $idventa, $iddevolucion, $fechaventa, $boleta, $idmarca, $idvendedor, $totalsus, $tipopago, $estado, $observacion, $factura, $numero, false);

    $sqlA[] = "UPDATE devolucion SET estadomayor='CONFIRMADO' WHERE iddevolucion='$iddevolucion';";

    //MostrarConsulta($sqlA);

    if($return == true)
    {
        return $sqlA;
    }
    else
    {
        if(ejecutarConsultaSQLBeginCommit($sqlA))
        {
            $dev['mensaje'] = "Se guardo una transaccion correctamente";
            $dev['error'] = "true";
            $dev['resultado'] = "$iddevolucion";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$iddevolucion";
        }
    }
}

function obteneridcredito2($idvendedor, $idmarca, $idcliente, $saldoant, $saldoact, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $fecharegistro = date("Y-m-d");
    $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecharegistro ) ) ;
    $fechalimite = date ( 'Y-m-j' , $nuevafecha );
    $hora = date("H:i:s");
    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];
    $idcredit = $numeroventaj1+1;

    $sql1= "SELECT mescierre FROM creditomayor WHERE idcredito = '$numeroventaj1'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
    $mescierre = $result['resultado'];

    //$sql1= "SELECT * FROM periodo WHERE estado='Abierto'";
    //$result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    //$mescierre = $result['resultado'];
    $estadomes='activo';
    $sql[] =getSqlNewCreditomayorproceso($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,$pardev, $susdev, $mescierre, $estadomes, false);

    $sql[] =getSqlNewCreditocliente($idcrecliente, $idcrecliente, $idcliente, $idcredit, $fecharegistro, "inicial", $idmarca, $idvendedor, $tcajas, $totalpares, $saldoant, $pago, $rebaja, $pagado, $saldoant, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredit";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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
    return $dev;
}


function obteneridcreditonegativo($idventa,$iddevolucion,$idvendedor, $idmarca,$idcliente, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql4 = "SELECT * FROM devolucion WHERE iddevolucion='$iddevolucion'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "iddevolucion");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fecharegistro = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $sql411 = "SELECT COUNT(d.iditemventa) as totalpares FROM detalledevolucion d,devolucion dv WHERE
    dv.iddevolucion=d.iddevolucion and dv.idalmacen='$idalmacen' and d.iddevolucion='$iddevolucion'  ";
    $paresd = findBySqlReturnCampoUnique($sql411, true, true, "totalpares");
    $ventapar = $paresd['resultado'];
    $ventapar =(-1)*$ventapar;
    $sql4112 = "SELECT SUM(d.valorcalzado) as totalsus FROM detalledevolucion d,devolucion dv WHERE
    dv.iddevolucion=d.iddevolucion and dv.idalmacen='$idalmacen' and d.iddevolucion='$iddevolucion'  ";
    $paresd = findBySqlReturnCampoUnique($sql4112, true, true, "totalsus");
    $totalsus = $paresd['resultado'];
    $totalsus =(-1)*$totalsus;
    $ventacaja =$totalpares/12;
    $ventacaja =(-1)*$ventacaja;

    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];
    $idcredit = $numeroventaj1+1;
    $sql[] =getSqlNewCreditomayor($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, "0.00", $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $ventasus, $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,false);
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredit";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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
    return $dev;


}

function obteneridcredito($idventa,$idvendedor, $idmarca,$idcliente, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";

    $sql4 = "SELECT * FROM ventas WHERE idventa='$idventa'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fecharegistro = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "tcajas");
    $ventacaja = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalpares");
    $ventapar = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalbs");
    $totalbs = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalsus");
    $ventasus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldo");
    $saldo = $paresd['resultado'];
    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];
    $idcredit = $numeroventaj1+1;

    $sql1= "SELECT mescierre FROM creditomayor WHERE idcredito = '$numeroventaj1'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
    $mescierre = $result['resultado'];

    //    $sql1= "SELECT * FROM periodo WHERE estado = 'Abierto'";
    //    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    //    $mescierre = $result['resultado'];

    $sql[] =getSqlNewCreditomayorproceso($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, "0.00", $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $ventasus, $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,$pardev, $susdev, $mescierre, 'activo',false);
    // getSqlNewCreditomayorproceso($idcredito, $fecha, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion, $idalmacen, $pardev, $susdev, $mescierre, $estadomes, $return){

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredit";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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


    return $dev;
}

function registrarincrementonuevoid($idventa,$idvendedor, $idmarca,$idcliente,$totaldiferencia, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    //ojo incremento monto
    $sql4 = "SELECT * FROM ventas WHERE idventa='$idventa'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fecharegistro = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "tcajas");
    $ventacaja = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalpares");
    $ventapar = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalbs");
    $totalbs = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalsus");
    $ventasus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldo");
    $saldo = $paresd['resultado'];
    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];
    $idcredit = $numeroventaj1+1;

    $sql1= "SELECT mescierre FROM creditomayor WHERE idcredito = '$numeroventaj1'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
    $mescierre = $result['resultado'];

    //    $sql1= "SELECT * FROM periodo WHERE estado='Abierto'";
    //    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    //    $mescierre = $result['resultado'];
    $estadomes='activo';
    $sql[] =getSqlNewCreditomayorproceso($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, "0.00", $ventacaja, $ventapar, $totaldiferencia, $pago, $rebaja, $totaldiferencia, $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,$pardev, $susdev, $mescierre, $estadomes,false);
    //getSqlNewCreditomayorproceso($idcredito, $fecha, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion, $idalmacen, $pardev, $susdev, $mescierre, $estadomes, $return){

    if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredit";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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


    return $dev;
}
function obteneridcreditodevolucion($iddevolucion,$idvendedor, $idmarca,$idcliente, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $idalmacen=$_SESSION['idalmacen'];

    $sql3 = " SELECT COUNT(vi.iddetalledevolucion)AS totalpares FROM detalledevolucion vi WHERE vi.iddevolucion='$iddevolucion' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalpares");
    $totalpares = $cantidadventaA1['resultado'];
    $sql3 = " SELECT (COUNT(vi.iddetalledevolucion)/12)AS cajas FROM detalledevolucion vi WHERE vi.iddevolucion='$iddevolucion' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cajas");
    $tcajas = $cantidadventaA1['resultado'];
    $sql3 = " SELECT  SUM(vi.valorcalzado) as totalsus FROM detalledevolucion vi WHERE vi.iddevolucion='$iddevolucion' ";
    $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalsus");
    $totalsus = $cantidadventaA1['resultado'];

    $sql4 = "SELECT * FROM devolucion WHERE iddevolucion='$iddevolucion'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idalmacen");
    $idalmacen = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "dato");
    $boleta = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "fecha");
    $fecharegistro = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "hora");
    $hora = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pares");
    $ventapar = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "venta");
    $totalsusventa = $paresd['resultado'];

    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];
    $idcredit = $numeroventaj1+1;
    $sql1= "SELECT * FROM periodo WHERE estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "periodoactual");
    $mescierre = $result['resultado'];
    $estadomes='activo';
    $sql[] =getSqlNewCreditomayorproceso($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, "0.00", (-$tcajas), (-$totalpares), (-$totalsusventa), "0.00", "0.00", (-$totalsusventa), $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,$totalpares, $totalsusventa,$mescierre, $estadomes, false);

    if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredit";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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
    return $dev;
}

function AnularPagoCliente($idcliente, $idcredito, $idcrecliente, $fechapago, $boleta, $vendedor, $montopago, $montorebaja){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $totalpago = 0;
    $pagoacumuladorebaja = 0;
    $totpago = 0;
    $totrebaja = 0;
    $porpagar = 0;
    $porpagartodo = 0;
    $montototal = 0;
    $sql4 = "SELECT * FROM creditocliente WHERE idcrecliente='$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
    $idmarca = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "sus");
    $sus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevo = $paresd['resultado'];

    $sql[] = "DELETE FROM creditopago WHERE idcrecliente = '$idcrecliente' AND fechapago = '$fechapago' and boleta = '$boleta';";

    $sql43 = "SELECT SUM(monto) as total FROM creditopago WHERE idcrecliente='$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql43, true, true, "total");
    $montototalpago = $paresd['resultado'];

    $totalpago = $montototalpago - $montopago;

    $sql[] = "DELETE FROM creditorebaja WHERE idcrecliente = '$idcrecliente' AND fechapago = '$fechapago' and boleta = '$boleta';";

    $sql4 = "SELECT SUM(monto) as total FROM creditorebaja WHERE idcrecliente = '$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "total");
    $montototalrebaja = $paresd['resultado'];
    if($montorebaja>0){
        $totalrebaja = $montototalrebaja - $montorebaja;
        $porpagar = $sus - $totalrebaja - $totalpago - $montodevo;
        $sql[] = "UPDATE creditocliente SET pago = '$totalpago', rebaja = '$totalrebaja', porpagar = '$porpagar' WHERE idcrecliente = '$idcrecliente' AND idcliente = '$idcliente';";
    }
    else{
        $porpagar = $sus - $totalrebaja - $totalpago - $montodevo;
        $sql[] = "UPDATE creditocliente SET pago = '$totalpago', porpagar = '$porpagar' WHERE idcrecliente = '$idcrecliente' AND idcliente = '$idcliente';";
    }

    $sql4 = "SELECT * FROM creditomayor WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo'";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
    $saldoant = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
    $saldoact = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
    $ventasus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    $pago = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
    $rebajas = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevo = $paresd['resultado'];

    $totpago = $pago - $montopago;
    if($montorebaja>0){
        $totrebaja = $rebajas - $montorebaja;
        $porpagartodo = $saldoant + $ventasus - $totpago - $totrebaja - $montodevo;
        $sql[] = "UPDATE creditomayor SET pago = '$totpago', rebaja = '$totrebaja', saldoact = '$porpagartodo' WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo';";
    }
    else{
        $totrebaja = $rebajas;
        $porpagartodo = $saldoant + $ventasus - $totpago - $totrebaja - $montodevo;
        $sql[] = "UPDATE creditomayor SET pago = '$totpago', saldoact = '$porpagartodo' WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo'";
    }
    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente";
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

function GuardarNuevoPagoCliente($idcliente,$idcredito,$idventa,$fechapago,$idcrecliente,$vendedor,$boleta,$tipopago,$monto,$factura,$numerof,$rebaja){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //idempleado=VENDEDOR-NUEVO&recibo=12313&tipoempresa=Efectivo&monto=400
    $pagoacumulado = 0;
    $pagoacumuladorebaja = 0;
    $pagoacumuladotodo = 0;
    $totalrebaja = 0;
    $porpagar = 0;
    $porpagartodo = 0;
    $montototal = 0;
    $sql4 = "SELECT * FROM creditocliente WHERE idcrecliente='$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
    $idmarca = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "sus");
    $montoventa = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevolucion= $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    $pagos = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
    $rebajas = $paresd['resultado'];

    $formatear1 = explode( '-' , $vendedor);
    $nombrev = $formatear1[0];
    $apellidov = $formatear1[1];
    $sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev' AND apellidos='$apellidov'";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
    $idvendedor = $result1['resultado'];

    $sql43 = "SELECT SUM(monto) as total FROM creditopago WHERE idcrecliente='$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql43, true, true, "total");
    $montototal = $paresd['resultado'];
    $pagoacumulado = $montototal + $monto;
    
    $sql[] =  getSqlNewCreditopago($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion,$factura, $numerof, false);

    $sql4 = "SELECT SUM(monto) as total FROM creditorebaja WHERE idcrecliente='$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "total");
    $totalrebaja = $paresd['resultado'];
//echo" pagos $pagos montototal $montototal monto $monto pagoacumulado $pagoacumulado totalrebaja $totalrebaja montoventa $montoventa montodevolucion $montodevolucion";
    if($rebaja>0){
        $sql[] =  getSqlNewCreditorebaja($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $rebaja, $tipopago, $estado, $observacion, false);

        $totalrebaja = $rebajas + $rebaja;
        $porpagar = $montoventa - $totalrebaja - $pagoacumulado - $montodevolucion;
        $porpagar = number_format($porpagar,2,'.','');
        $sql[] = "UPDATE creditocliente SET pago = '$pagoacumulado', rebaja = '$totalrebaja', porpagar = '$porpagar', ultimopago = '$fechapago' WHERE idcrecliente = '$idcrecliente' AND idcliente = '$idcliente';";
    }
    else{
        $porpagar = $montoventa - $totalrebaja - $pagoacumulado - $montodevolucion;
        $porpagar = number_format($porpagar,2,'.','');
        $sql[] = "UPDATE creditocliente SET pago = '$pagoacumulado', porpagar = '$porpagar', ultimopago = '$fechapago', factura = '$factura' WHERE idcrecliente = '$idcrecliente' AND idcliente = '$idcliente';";
    }
    $sql4 = "SELECT * FROM creditomayor WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes='activo' ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
    $saldoant = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
    $saldoact = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
    $ventasus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    $pago = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
    $rebajas = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevo = $paresd['resultado'];

    $pagoacumuladotodo = $pago + $monto;
    if($rebaja>0){
        $pagoacumuladorebaja = $rebaja + $rebajas;
        $porpagartodo = $saldoant + $ventasus - $pagoacumuladotodo - $pagoacumuladorebaja - $montodevo;
        $porpagartodo = number_format($porpagartodo,2,'.','');
        $sql[] = "UPDATE creditomayor SET pago = '$pagoacumuladotodo', rebaja = '$pagoacumuladorebaja', saldoact = '$porpagartodo' WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo';";
    }
    else{
        $pagoacumuladorebaja = $rebajas;
        $porpagartodo = $saldoant + $ventasus - $pagoacumuladotodo - $pagoacumuladorebaja - $montodevo;
        $porpagartodo = number_format($porpagartodo,2,'.','');
        $sql[] = "UPDATE creditomayor SET pago = '$pagoacumuladotodo', saldoact = '$porpagartodo' WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo';";
    }
//echo" pago $pago monto $monto pagoacumuladotodo $pagoacumuladotodo rebajas $rebajas saldoant $saldoant ventasus $ventasus montodevo $montodevo";
  //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente";
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

function GuardarNuevoRebaja($idcliente,$idventa,$fechapago,$idcrecliente,$boleta,$tipopago,$monto){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $sql4 = "SELECT * FROM creditocliente WHERE idcrecliente = '$idcrecliente'  ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmarca");
    $idmarca = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcredito");
    $idcredito = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idvendedor");
    $idvendedor = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "sus");
    $montoventa = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevolucion= $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    $pago = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
    $rebajas = $paresd['resultado'];

    $sql[] =  getSqlNewCreditorebaja($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion, false);

    $totalrebaja = $rebajas + $monto;
    $porpagar = $montoventa - $totalrebaja - $pago - $montodevolucion;
    $sql[] = "UPDATE creditocliente SET rebaja = '$totalrebaja', porpagar = '$porpagar', ultimopago = '$fechapago' WHERE idcrecliente = '$idcrecliente' AND idcliente = '$idcliente';";

    $sql4 = "SELECT * FROM creditomayor WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo' ";
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
    $saldoant = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
    $saldoact = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "ventasus");
    $ventasus = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "pago");
    $pago = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "rebaja");
    $rebajas = $paresd['resultado'];
    $paresd = findBySqlReturnCampoUnique($sql4, true, true, "susdev");
    $montodevo = $paresd['resultado'];

    $pagoacumuladotodo = $monto + $rebajas;
    $porpagartodo = $saldoant + $ventasus - $pago - $pagoacumuladotodo - $montodevo;
    $sql[] = "UPDATE creditomayor SET rebaja = '$pagoacumuladotodo', saldoact = '$porpagartodo' WHERE idcreditocli = '$idcredito' AND idcliente = '$idcliente' and estadomes = 'activo'";

    // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente";
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

function GuardarNuevoCredito($resultado,$return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];
    //$numeroA = findUltimoID("ingresoalmacen", "numero", true);
    //$numero = $numeroA['resultado'] +1;
    //$idingreso = "ing-".$numero;
    $ingreso = $resultado->ingreso;
    $idcliente = $ingreso->idcliente;
    $fecharegistro = $ingreso->fecharegistro;
    $descripcion = $ingreso->descripcion;
    $vendedor = $ingreso->vendedor;
    $marca = $ingreso->marca;
    $montoinicial = $ingreso->monto;
    $estado = "ACTIVO";
    $nuevafecha = strtotime ( '+1 month' , strtotime ( $fecharegistro ) ) ;
    $fechalimite = date ( 'Y-m-j' , $nuevafecha );
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $fechareal = date("Y-m-d");
    $usuario = $_SESSION['idusuario'];
    //$sql1= "SELECT idempleado FROM empleados WHERE nombres = '$nombrev1' AND apellidos = '$apellidov1'";
    //$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
    //$usuario = $result1['resultado'];
    $calzados = $resultado->calzados;
    $sql1= "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj1 = $result['resultado'];

    //echo "marca $marca";
    if(($montoinicial>0)||($montoinicial<0)){
        $formatear1 = explode( '-' , $vendedor);
        $nombrev = $formatear1[0];
        $apellidov = $formatear1[1];
        $idcredito = $numeroventaj1+1;
        $saldoant= $montoinicial;
        $saldoact = $montoinicial;

        $sql1= "SELECT idempleado FROM empleados WHERE nombres = '$nombrev' AND apellidos = '$apellidov'";
        $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
        $idvendedor = $result1['resultado'];

        $sql1= "SELECT idmarca FROM marcas WHERE nombre = '$marca' ";
        $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
        $idmarca = $result1['resultado'];

        $sql4 = "SELECT * FROM creditomayor WHERE idcliente = '$idcliente' and idmarca = '$idmarca' and idvendedor = '$idvendedor' and idalmacen = '$idalmacen' and estadomes = 'activo' ";
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcredito");
        $idcreditoexiste = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
        $saldoantexiste = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
        $saldoactexiste = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "mescierre");
        $mescierre = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "estadomes");
        $estadomes = $paresd['resultado'];
        $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcreditocli");
        $idcreditocli = $paresd['resultado'];
        if($idcreditoexiste==null || $idcreditoexiste==""){
            $codigobarraA = obteneridcredito2($idvendedor, $idmarca, $idcliente, $saldoant, $saldoact, true);
            $idcredito = $codigobarraA['resultado'];
        }else{
            $sql[] =getSqlNewCreditocliente($idcrecliente, $idcrecliente, $idcliente, $idcreditocli, $fecharegistro, "inicial", $idmarca, $idvendedor, $tcajas, $totalpares, $saldoant, $pago, $rebaja, $pagado, $saldoant, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);

            $saldoanttotal = $saldoant + $saldoantexiste;
            $saldoacttotal = $saldoact + $saldoactexiste;
            $sql[] = "UPDATE creditomayor SET saldoant = '$saldoanttotal', saldoact = '$saldoacttotal' WHERE idcredito = '$idcreditoexiste' AND idcliente = '$idcliente' AND idmarca = '$idmarca' and idvendedor='$idvendedor' and estadomes = 'activo'";
        }
        //$sql[] =getSqlNewCreditomayor($idcredito, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion,$idalmacen,false);
        //$idcredito++;
        $idcredito++;
    }
    else{
        for($j=0;$j<count($calzados);$j++){
            $calzado = $calzados[$j];
            $idcredito = $numeroventaj1+1;
            $marca = $calzado->marca;
            $vendedor = $calzado->vendedor;
            $saldoant= $calzado->saldoant;
            $saldoact = $calzado->saldoact;
            $formatear1 = explode( '-' , $vendedor);
            $nombrev = $formatear1[0];
            $apellidov = $formatear1[1];

            $sql1= "SELECT idempleado FROM empleados WHERE nombres = '$nombrev' AND apellidos = '$apellidov'";
            $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
            $idvendedor = $result1['resultado'];

            $sql1= "SELECT idmarca FROM marcas WHERE nombre = '$marca' ";
            $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
            $idmarca = $result1['resultado'];

            //$sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev' AND apellidos='$apellidov'";
            //$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
            //$idvendedor = $result1['resultado'];

            $sql4 = "SELECT * FROM creditomayor WHERE idcliente = '$idcliente' and idmarca = '$idmarca' and idvendedor = '$idvendedor' and idalmacen = '$idalmacen' and estadomes = 'activo' ";
            $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idcredito");
            $idcreditoexiste = $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoant");
            $saldoantexiste = $paresd['resultado'];
            $paresd = findBySqlReturnCampoUnique($sql4, true, true, "saldoact");
            $saldoactexiste = $paresd['resultado'];
            if($idcreditoexiste==null || $idcreditoexiste==""){
                $codigobarraA = obteneridcredito2($idvendedor, $idmarca, $idcliente, $saldoant, $saldoact, true);
                $idcredito = $codigobarraA['resultado'];
            }else{
                $saldoanttotal = $saldoant + $saldoantexiste;
                $saldoacttotal = $saldoact + $saldoactexiste;
                $sql[] = "UPDATE creditomayor SET saldoant = '$saldoanttotal', saldoact = '$saldoacttotal' WHERE idcredito = '$idcreditoexiste' AND idcliente = '$idcliente' AND idmarca = '$idmarca' and idvendedor='$idvendedor' and estadomes = 'activo'";
            }
            //$sql[] =getSqlNewCreditomayor($idcredito, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion,$idalmacen,false);
            //$idcredito++;
            $idcredito++;
        }
    }
    //MostrarConsulta($sql);
    $sql[] = "UPDATE color_marca SET existe = '$estado' WHERE idcolor = 'col-308'";

    if(ejecutarConsultaSQLBeginCommit($sql)){
        //           finalizandoinsercion(true);
        $dev['mensaje'] = "Se registro el ingreso correctamente.";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredito";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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

function GuardarNuevoCreditoTemporal($return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = 'alm-5';
    $estadomes = 'activo';
    $sql1 = "SELECT * FROM tempcrecliente";
    $sql2 = getTablaToArrayOfSQL($sql1);
    $sql3 = $sql2['resultado'];
    $row1 = NumeroTuplas($sql1);
    $row11 = $row1['resultado'];
    $sql1 = "SELECT MAX(idcredito) AS num FROM creditomayor";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numerocredito = $result['resultado'];
    for($i=0; $i<=$row11; $i++){
        $paresd = $sql3[$i];
        $idcredit = $numerocredito + 1;
        $numerocredito = $idcredit;
        $idcliente = $paresd['idcliente'];
        $idmarca = $paresd['idmarca'];
        $idvendedor = $paresd['idvendedor'];
        $porpagar = $paresd['porpagar'];
        $saldoant = $porpagar;
        $saldoact = $porpagar;
        $fecharegistro = "2016-04-01";
        $mescierre = "042016";
        $sql[] =getSqlNewCreditomayorproceso($idcredit, $fecharegistro, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, "ACTIVO", $diferencia, $observacion,$idalmacen,$pardev, $susdev, $mescierre, 'activo', false);

        $sql[] =getSqlNewCreditocliente($idcrecliente, $idcrecliente, $idcliente, $idcredit, $fecharegistro, "inicial", $idmarca, $idvendedor, $tcajas, $totalpares, $saldoant, $pago, $rebaja, $pagado, $saldoant, $ultimopago, $fechalimite, $morosidad, 'pendiente', $diferencia, $observacion, 'SinFactura', Null, 0, 0.00, $mescierre, 'activo', $idalmacen, false);
    }
    if(ejecutarConsultaSQLBeginCommit($sql)){
        //           finalizandoinsercion(true);
        $dev['mensaje'] = "Se registro el ingreso correctamente.";
        $dev['error'] = "true";
        $dev['resultado'] = "$idcredito";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
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

function Listarcuentascliente($start, $limit, $sort, $dir, $callback, $_dc, $idcliente, $return = false){
    //echo $idmarca;
    $idalmacen = $_SESSION['idalmacen'];
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
    //$gestion,$idcliente,$idvendedor,

    $idalmacen = $_SESSION['idalmacen'];
    //  String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio",yy "-" MM "-" DD "preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};
    // String[] nombreCaso5Columns = {"idcuenta", "marca", "vendedor","saldoant","vencaja","venpar", "vensus","pagos","rebajas","saldoact","rebaja"};
    $select ="cm.idcreditocli, cm.saldoant, cm.ventacaja as vencaja, cm.ventapar as venpar, cm.ventasus as vensus, cm.pago as pagos, cm.rebaja as rebajas, cm.pardev, cm.susdev, cm.saldoact, cm.estado, m.nombre as marca, CONCAT( e.nombres, '-', e.apellidos) AS vendedor";
    $from = "creditomayor cm, marcas m, empleados e";
    $where = "cm.idmarca = m.idmarca and cm.idvendedor = e.idempleado AND cm.idalmacen = '$idalmacen' and cm.estadomes = 'activo' ";
    if($idcliente!=null || $idcliente!=""){
        $from .= "";
        $where .= "and cm.idcliente ='$idcliente'";
    }
    //$sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
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
                            if(mysql_field_name($re, $i) == "idcredito"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $idcreditocli = $fi[$i];
                                //echo "entra ",$idcreditocli;
                                //       echo   $sqld; 6     (SUM(ad.saldocantidad)/$caja) AS cantidad
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
function reportecliente($idnumeracion, $idnumeracionimpresion, $numero, $idcliente,$return){

    $setC[0]['campo'] = 'idnumeracion';
    $setC[0]['dato'] = $idnumeracion;
    $setC[1]['campo'] = 'idnumeracionimpresion';
    $setC[1]['dato'] = $idnumeracionimpresion;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'idcliente';
    $setC[3]['dato'] = $idcliente;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO reportecliente ".$sql2;
}
function getSqlNewCreditomayor($idcredito, $fecha, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion, $idalmacen, $return){
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
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditomayor ".$sql2;
}

function getSqlNewCreditomayorproceso($idcredito, $fecha, $hora, $idcliente, $idmarca, $idvendedor, $saldoant, $ventacaja, $ventapar, $ventasus, $pago, $rebaja, $saldoact, $morosidad, $estado, $diferencia, $observacion, $idalmacen, $pardev, $susdev, $mescierre, $estadomes, $return){
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
    $setC[22]['dato'] = $idcredito;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditomayor ".$sql2;
}

function getSqlNewCreditocliente($idcrecliente, $idventa, $idcliente, $idcredito, $fechaventa, $boleta, $idmarca, $idvendedor, $caja, $par, $sus, $pago, $rebaja, $pagado, $porpagar, $ultimopago, $fechalimite, $morosidad, $estado, $diferencia, $observacion, $factura, $boletamanual, $pardev, $susdev, $mescierre, $estadomes, $idalmacen, $return){
    $setC[0]['campo'] = 'idcrecliente';
    $setC[0]['dato'] = $idcrecliente;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'idcliente';
    $setC[2]['dato'] = $idcliente;
    $setC[3]['campo'] = 'idcredito';
    $setC[3]['dato'] = $idcredito;
    $setC[4]['campo'] = 'fechaventa';
    $setC[4]['dato'] = $fechaventa;
    $setC[5]['campo'] = 'boleta';
    $setC[5]['dato'] = $boleta;
    $setC[6]['campo'] = 'idmarca';
    $setC[6]['dato'] = $idmarca;
    $setC[7]['campo'] = 'idvendedor';
    $setC[7]['dato'] = $idvendedor;
    $setC[8]['campo'] = 'caja';
    $setC[8]['dato'] = $caja;
    $setC[9]['campo'] = 'par';
    $setC[9]['dato'] = $par;
    $setC[10]['campo'] = 'sus';
    $setC[10]['dato'] = $sus;
    $setC[11]['campo'] = 'pago';
    $setC[11]['dato'] = $pago;
    $setC[12]['campo'] = 'rebaja';
    $setC[12]['dato'] = $rebaja;
    $setC[13]['campo'] = 'pagado';
    $setC[13]['dato'] = $pagado;
    $setC[14]['campo'] = 'porpagar';
    $setC[14]['dato'] = $porpagar;
    $setC[15]['campo'] = 'ultimopago';
    $setC[15]['dato'] = $ultimopago;
    $setC[16]['campo'] = 'fechalimite';
    $setC[16]['dato'] = $fechalimite;
    $setC[17]['campo'] = 'morosidad';
    $setC[17]['dato'] = $morosidad;
    $setC[18]['campo'] = 'estado';
    $setC[18]['dato'] = $estado;
    $setC[19]['campo'] = 'diferencia';
    $setC[19]['dato'] = $diferencia;
    $setC[20]['campo'] = 'observacion';
    $setC[20]['dato'] = $observacion;
    $setC[21]['campo'] = 'factura';
    $setC[21]['dato'] = $factura;
    $setC[22]['campo'] = 'boletamanual';
    $setC[22]['dato'] = $boletamanual;
    $setC[23]['campo'] = 'pardev';
    $setC[23]['dato'] = $pardev;
    $setC[24]['campo'] = 'susdev';
    $setC[24]['dato'] = $susdev;
    $setC[25]['campo'] = 'mescierre';
    $setC[25]['dato'] = $mescierre;
    $setC[26]['campo'] = 'estadomes';
    $setC[26]['dato'] = $estadomes;
    $setC[27]['campo'] = 'idalmacen';
    $setC[27]['dato'] = $idalmacen;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditocliente ".$sql2;
}
function getSqlNewCreditoclientenuevo($idcrecliente, $idventa, $idcliente, $idcredito, $fechaventa, $boleta, $idmarca, $idvendedor, $caja, $par, $sus, $pago, $rebaja, $pagado, $porpagar, $ultimopago, $fechalimite, $morosidad, $estado, $diferencia, $observacion, $factura, $boletamanual, $pardev, $susdev, $return){
    $setC[0]['campo'] = 'idcrecliente';
    $setC[0]['dato'] = $idcrecliente;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'idcliente';
    $setC[2]['dato'] = $idcliente;
    $setC[3]['campo'] = 'idcredito';
    $setC[3]['dato'] = $idcredito;
    $setC[4]['campo'] = 'fechaventa';
    $setC[4]['dato'] = $fechaventa;
    $setC[5]['campo'] = 'boleta';
    $setC[5]['dato'] = $boleta;
    $setC[6]['campo'] = 'idmarca';
    $setC[6]['dato'] = $idmarca;
    $setC[7]['campo'] = 'idvendedor';
    $setC[7]['dato'] = $idvendedor;
    $setC[8]['campo'] = 'caja';
    $setC[8]['dato'] = $caja;
    $setC[9]['campo'] = 'par';
    $setC[9]['dato'] = $par;
    $setC[10]['campo'] = 'sus';
    $setC[10]['dato'] = $sus;
    $setC[11]['campo'] = 'pago';
    $setC[11]['dato'] = $pago;
    $setC[12]['campo'] = 'rebaja';
    $setC[12]['dato'] = $rebaja;
    $setC[13]['campo'] = 'pagado';
    $setC[13]['dato'] = $pagado;
    $setC[14]['campo'] = 'porpagar';
    $setC[14]['dato'] = $porpagar;
    $setC[15]['campo'] = 'ultimopago';
    $setC[15]['dato'] = $ultimopago;
    $setC[16]['campo'] = 'fechalimite';
    $setC[16]['dato'] = $fechalimite;
    $setC[17]['campo'] = 'morosidad';
    $setC[17]['dato'] = $morosidad;
    $setC[18]['campo'] = 'estado';
    $setC[18]['dato'] = $estado;
    $setC[19]['campo'] = 'diferencia';
    $setC[19]['dato'] = $diferencia;
    $setC[20]['campo'] = 'observacion';
    $setC[20]['dato'] = $observacion;
    $setC[21]['campo'] = 'factura';
    $setC[21]['dato'] = $factura;
    $setC[22]['campo'] = 'boletamanual';
    $setC[22]['dato'] = $boletamanual;
    $setC[23]['campo'] = 'pardev';
    $setC[23]['dato'] = $pardev;
    $setC[24]['campo'] = 'susdev';
    $setC[24]['dato'] = $susdev;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditocliente ".$sql2;
}


function getSqlNewCreditopago($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion, $factura, $numero, $return){
    $setC[0]['campo'] = 'idcrecliente';
    $setC[0]['dato'] = $idcrecliente;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'fechapago';
    $setC[2]['dato'] = $fechapago;
    $setC[3]['campo'] = 'boleta';
    $setC[3]['dato'] = $boleta;
    $setC[4]['campo'] = 'idmarca';
    $setC[4]['dato'] = $idmarca;
    $setC[5]['campo'] = 'idvendedor';
    $setC[5]['dato'] = $idvendedor;
    $setC[6]['campo'] = 'monto';
    $setC[6]['dato'] = $monto;
    $setC[7]['campo'] = 'tipopago';
    $setC[7]['dato'] = $tipopago;
    $setC[8]['campo'] = 'estado';
    $setC[8]['dato'] = $estado;
    $setC[9]['campo'] = 'observacion';
    $setC[9]['dato'] = $observacion;
    $setC[10]['campo'] = 'factura';
    $setC[10]['dato'] = $factura;
    $setC[11]['campo'] = 'numero';
    $setC[11]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditopago ".$sql2;
}
function getSqlNewCreditorebaja($idcrecliente, $idventa, $fechapago, $boleta, $idmarca, $idvendedor, $monto, $tipopago, $estado, $observacion, $return){
    $setC[0]['campo'] = 'idcrecliente';
    $setC[0]['dato'] = $idcrecliente;
    $setC[1]['campo'] = 'idventa';
    $setC[1]['dato'] = $idventa;
    $setC[2]['campo'] = 'fechapago';
    $setC[2]['dato'] = $fechapago;
    $setC[3]['campo'] = 'boleta';
    $setC[3]['dato'] = $boleta;
    $setC[4]['campo'] = 'idmarca';
    $setC[4]['dato'] = $idmarca;
    $setC[5]['campo'] = 'idvendedor';
    $setC[5]['dato'] = $idvendedor;
    $setC[6]['campo'] = 'monto';
    $setC[6]['dato'] = $monto;
    $setC[7]['campo'] = 'tipopago';
    $setC[7]['dato'] = $tipopago;
    $setC[8]['campo'] = 'estado';
    $setC[8]['dato'] = $estado;
    $setC[9]['campo'] = 'observacion';
    $setC[9]['dato'] = $observacion;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO creditorebaja ".$sql2;
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

?>