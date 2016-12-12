<?php
function BuscarCuentasCliente($callback, $_dc, $idcliente, $idcuenta, $return)
{//echo $idcuenta;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $cliente = ListarVendedor('', '', '', '', '', '','',true);
    $value['empleadoM'] = $cliente['resultado'];

    $select1 ="SUM(c.porpagar) as total ";
    $from1 = "creditocliente c";
    $where1 = "c.idcliente = '$idcliente' and c.estado = 'pendiente' ";
    if($idcuenta!="todo"){ $where1 .= "and c.idcredito = '$idcuenta'"; }
    $sql1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "total");
    $porpagar = $result1['resultado'];
    $value['porpagar'] =  "$porpagar";
//echo " sql1 $sql1 idcuenta $idcuenta ";
// $sql2 = "SELECT SUM(pe.saldo)as total FROM ventas pe, clientes ol WHERE pe.idcliente = ol.idcliente AND pe.idcliente = '$idcliente' ";
//$result1 = findBySqlReturnCampoUnique($sql2, true, true, "total");
//    $porpagar = $result1['resultado'];
//     $value['porpagar'] =  "$porpagar";
    $select12 ="SUM(c.sus) as total1 ";
//$from1 = "creditocliente c";
//$where1 = "c.idcliente = '$idcliente' ";
//if($idcuenta!="todo"){ $where1 .= "and c.idcredito ='$idcuenta'"; }
    $sql12 = "SELECT ".$select12." FROM ".$from1. " WHERE ".$where1;
    $result12 = findBySqlReturnCampoUnique($sql12, true, true, "total1");
    $montoventa = $result12['resultado'];
    $value['montoventa'] =  "$montoventa";
 
// $sql2 = "SELECT SUM(pe.totalsus)as totald FROM ventas pe, clientes ol WHERE pe.idcliente = ol.idcliente AND pe.idcliente = '$idcliente' and pe.dato='devolucion' ";
//$result1 = findBySqlReturnCampoUnique($sql2, true, true, "totald");
//    $montodevo = $result1['resultado'];
    $select121 ="SUM(c.susdev) as total1 ";
    $sql121 = "SELECT ".$select121." FROM ".$from1. " WHERE ".$where1;
    $result121 = findBySqlReturnCampoUnique($sql121, true, true, "total1");
    $montodevo = $result121['resultado'];
    $value['devolucion'] =  "$montodevo";
    $select121 ="SUM(c.rebaja) as total1 ";
    $sql121 = "SELECT ".$select121." FROM ".$from1. " WHERE ".$where1;
    $result121 = findBySqlReturnCampoUnique($sql121, true, true, "total1");
    $montorebaja = $result121['resultado'];
    $value['rebaja'] =  "$montorebaja";

    $select1212 ="SUM(c.pago) as total1 ";
    $sql1212 = "SELECT ".$select1212." FROM ".$from1. " WHERE ".$where1;
    $result1212 = findBySqlReturnCampoUnique($sql1212, true, true, "total1");
    $pagado = $result1212['resultado'];
    $value['pagado'] = "$pagado";
 
    $value['porcobrar'] =  "$porpagar";

    $sql ="SELECT cli.idcliente as codigo,  CONCAT(cli.apellido,'-',cli.nombre) AS nombrecliente
           FROM `clientes` cli, `ciudades` ciu WHERE cli.idciudad = ciu.idciudad and cli.idcliente = '$idcliente'";
    $detalleA = findBySqlReturnCampoUnique($sql, true, true, "codigo");
    $value['codigo'] =  $detalleA['resultado'];
    $detalleA1 = findBySqlReturnCampoUnique($sql, true, true, "nombrecliente");
    $value['nombrecliente'] =  $detalleA1['resultado'];
       
    $dev['mensaje'] = "Se cargaron los parametros";
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

function CargarPagoCliente($callback, $_dc, $idcrecliente, $fecha, $recibo, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $fecha1= split("-", $fecha);
    $y=$fecha1[0];
    $m=$fecha1[1];
    $d=$fecha1[2];
    //$mesproceso = $m.$y;
    //$sql1 = "SELECT mescierre FROM creditomayor WHERE estadomes = 'activo'";
    //$result1 = findBySqlReturnCampoUnique($sql1, true, true, "mescierre");
    //$mescierre = $result1['resultado'];
    //if($mesproceso == $mescierre){
    $select1 ="CONCAT( e.nombres, '-', e.apellidos) AS vendedor, cp.monto as montopago";
    $from1 = "creditopago cp, empleados e";
    $where1 = "cp.idvendedor = e.idempleado and cp.idcrecliente = '$idcrecliente' and cp.fechapago = '$fecha' and cp.boleta = '$recibo'";
    $sql1 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "vendedor");
    $vendedor = $result1['resultado'];
    $value['vendedor'] =  "$vendedor";
    $result1 = findBySqlReturnCampoUnique($sql1, true, true, "montopago");
    $montopago = $result1['resultado'];
    $value['montopago'] =  "$montopago";

    $select12 ="monto";
    $from12 = "creditorebaja";
    $where12 = "idcrecliente = '$idcrecliente' and fechapago = '$fecha' and boleta = '$recibo'";
    $sql12 = "SELECT ".$select12." FROM ".$from12. " WHERE ".$where12;
    $result12 = findBySqlReturnCampoUnique($sql12, true, true, "monto");
    $montorebaja = $result12['resultado'];
    $value['montorebaja'] =  "$montorebaja";

    if($vendedor==""){
        $dev['mensaje'] = "No se puede anular cobros pasados";
        $dev['error']   = "false";
        $dev['resultado'] = $value;
    }else{
        $dev['mensaje'] = "Se cargaron los parametros";
        $dev['error']   = "true";
        $dev['resultado'] = $value;
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

function Listardeudasclientepormarca($start, $limit, $sort, $dir, $callback, $_dc, $idcliente, $return = false){
    set_time_limit(0);
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
//   $sql ="
//SELECT v.idventa,v.idmarca,m.nombre as marca,date_format(v.fecha,'%d/%m/%Y') AS fechaventa,v.boleta,
//v.tcajas as cajas,v.totalpares as pares ,v.totalsus as montodeuda,v.descuento as rebaja,v.montopagado as pagado,
//v.saldo as porpagar, 0  as fechaultimopago, v.fechacancelacion as fechamaxima,v.estado,0 as detalle
//FROM ventas v,marcas m
//WHERE v.idmarca=m.idmarca and v.idcliente = '$idcliente'
//";

//creditocliente
    $sql ="
SELECT v.idventa,v.idmarca,m.nombre as marca,date_format(v.fecha,'%d/%m/%Y') AS fechaventa,v.boleta,
v.tcajas as cajas,v.totalpares as pares ,v.totalsus as montodeuda,v.descuento as rebaja,v.montopagado as pagado,
v.saldo as porpagar, 0  as fechaultimopago, v.fechacancelacion as fechamaxima,v.estado,0 as detalle
FROM ventas v,marcas m
WHERE v.idmarca=m.idmarca and v.idcliente = '$idcliente'
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
                            if(mysql_field_name($re, $i) == "idventa"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                  set_time_limit(0);

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


function Listardeudasclientepormarcatotal($start, $limit, $sort, $dir, $callback, $_dc, $idcliente, $idcuenta, $return = false){
    set_time_limit(0);
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
    $idalmacen = $_SESSION['idalmacen'];
    $select ="c.idcrecliente, c.idventa, c.idmarca, m.nombre as marca, date_format(c.fechaventa,'%d/%m/%Y') AS fechaventa, c.boleta,
              c.caja as cajas, c.par as pares , c.sus as montodeuda, c.rebaja, c.pardev, c.susdev, c.pago as pagado,
              c.porpagar, date_format(c.ultimopago,'%d/%m/%Y') AS fechaultimopago, date_format(c.fechalimite,'%d/%m/%Y') AS fechamaxima,
              c.estado,c.observacion as detalle";
    $from = "marcas m, creditocliente c";
    $where = "c.idmarca = m.idmarca and c.idcliente = '$idcliente' and c.idalmacen = '$idalmacen' and c.estado = 'pendiente' ";
    if($idcuenta!="todo"){
        $where .= "and c.idcredito = '$idcuenta'";
    }
    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
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
                            if(mysql_field_name($re, $i) == "idventa"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                set_time_limit(0);
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

function RegistrarCobroMayor($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $tipocambio = $resultado->tipocambio;
    $marca = $resultado->marca;
       $formatear = explode( '-' , $fecha);
$fechaarqueo = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
    $idcliente  =$resultado->idcliente;

    $factura = $resultado->factura;
    $fecha = $resultado->fecha;
    $recibo = $resultado->recibo;
    $monto = $resultado->monto;
    $observacion = $resultado->observacion;
    $fecharegistro = date("Y-m-d");
$estado='activado';
$numeroA = findUltimoID("caja", "numero", true);
    $numero = $numeroA['resultado']+1;
$idcaja = 'cuec-'.$numero;

$idtienda = $_SESSION['idtienda'];
     $idusuario = $_SESSION['idusuario'];

 $numeromo = findUltimoID("movimientocreditocliente", "numero", true);
 $numeromov = $numeromo['resultado'] +1;
 $idmovimientocreditocliente = 'mov-'.$numeromov;
   // echo $numeroB;

$sqlprecio = "
SELECT
  kar.estado
FROM
  caja kar
WHERE
  kar.numero = '$numeroB'";
            $preciomayorV = findBySqlReturnCampoUnique($sqlprecio, true, true, "estado");
            $preciomayorV1 = $preciomayorV['resultado'];
//echo $preciomayorV1;
        
//    $sql[]=getSqlNewCaja($idcaja, $cajaanterior, $estado, $numero, $efecbs, $efecsus, $efecmonedas, $depbs, $depsus, $cajanueva, $pagadoregistro, $fechaarqueo, $fecharegistro,$idtienda, $idusuario,$turno, $return);


// MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente el arqueo";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al guardar";
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
function BuscarClienteMarcaReciboTipoCambio(){
    $categoriasA = ListarCliente('', '', '', '', '', '',"",true);
    if($categoriasA['error'] == true)
    {
        $value['cliente'] = "true";
        $value['clienteM'] = $categoriasA['resultado'];
    }
     $categorias = ListarMarcasCredito('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
   
    $categoriasrA = ListarReciboCliente('', '', '', '', '', '',"",true);
    if($categoriasrA['error'] == true)
    {
        $value['recibo'] = "true";
        $value['reciboM'] = $categoriasrA['resultado'];
    }
 $sql1= "SELECT
              cli.idtipocambio,cli.estado,valor
            FROM
              tipocambio cli
            WHERE
              cli.estado = 'activado'";

      $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
$value['tipocambio'] = $tipocambio;
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
function ListarMarcasCredito($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ma.idmarca,
  ma.idcliente,
  mar.nombre
FROM
  `marcas` mar,
  `clientemarca` ma
WHERE
  ma.idmarca = mar.idmarca AND ma.estado='VIGENTE'
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
                            if(mysql_field_name($re, $i)=="idmarca"){
                                $idmarca = $fi[$i];
                                $sql2 = "
SELECT
  col.idmarca,
  col.codigo
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' AND
  col.estado = 'VIGENTE'
";
                                $coleccionA = findBySqlReturnCampoUnique($sql2, true, true, "codigo");
                                if($coleccionA["error"]=="false"){
                                     $value{$ii}{"coleccion"}= "no Tiene Coleccion Vigente";
                                }
                                else{
                                     $value{$ii}{"coleccion"}= $coleccionA['resultado'];
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
function ListarReciboCliente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  c.idcredito,c.idmarca,c.factura,c.idcliente
FROM
  creditomayor c
WHERE
  c.saldo != '0.00' and c.estadomes = 'activo'

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
function listarDeudasCliente($idcliente,$idmarca,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
      if($idmarca != null && $idmarca != "")
    {

$sql ="
SELECT
  c.idcredito,c.factura,c.idcliente,c.saldo,c.fechacredito,c.fechamoroso,c.preciototal,ma.nombre AS marca
FROM
  creditomayor c, marcas ma
WHERE
  c.idmarca=ma.idmarca AND c.saldo != '0.00' AND c.idcliente='$idcliente' AND c.estadomes = 'activo'

";
    }else
    {
       $sql ="
SELECT
  c.idcredito,c.factura,c.idcliente,c.saldo,c.fechacredito,c.fechamoroso,c.preciototal,ma.nombre AS marca
FROM
  creditomayor c, marcas ma
WHERE
  c.idmarca=ma.idmarca AND c.saldo != '0.00' AND c.idcliente='$idcliente' AND c.idmarca ='$idmarca' AND c.estadomes = 'activo'
";
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
function BuscarSaldoClienteporRecibo($recibo,$idcliente,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "SELECT
  c.idcredito,c.factura,c.idcliente,c.saldo,c.fechacredito,c.fechamoroso,c.preciototal AS codigo,ma.nombre AS marca
FROM
  creditomayor c, marcas ma
WHERE
  c.idmarca=ma.idmarca AND c.factura ='$recibo'AND c.idcliente='$idcliente' AND c.estadomes = 'activo'";
    //echo $sql;
    if($recibo != null)
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
?>