<?php
function listarclientesempresa($start, $limit, $sort, $dir, $callback, $_dc, $idempresa, $return = "true")
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
    if($idempresa != null || $idempresa != "")
    {
        $sql = "SELECT
c.idclienteempresa,
c.codigo,
CONCAT( c.nombre, '-', c.apellido ) AS nombre,
  c.nit,
  c.estado,
  c.item,
  emp.nombre AS empresa,
  c.idempresa

FROM
  clienteempresa c,
  empresas emp

WHERE
  c.idempresa = emp.idempresa AND c.idempresa!='epr-0' AND c.codigo!='Sin Codigo' AND c.idempresa='$idempresa' $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(em.*) AS total FROM empresas em";
    }
    else
    {
        $sql = "SELECT a.idalmacen,a.codigo,a.nombre,a.direccion,a.telefono,a.tipo FROM almacen a WHERE $where $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(a.*) AS total FROM almacen a WHERE $where";
    }
//echo $sql;
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

                $dev['mensaje'] = "No existe un almacen con estos datos";
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

function buscarclientesempresasaldos($start, $limit, $sort, $dir, $callback, $_dc, $return, $idempresa,$idcliente)
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
    $select ="pc.idplanillaemitida,cl.idclienteempresa, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, pc.ventasmes AS credito, pc.pago1 AS mes1, pc.cobro1, pc.pago2 AS mes2,pc.cobro2,  (pc.pago3+pc.pago4+ pc.pago5 + pc.pago6 + pc.pago7 ) AS mes3, pc.cobro3,pc.total, (pc.cobro1+pc.cobro2+pc.cobro3) AS totalcobro,em.codigo AS cobrador,pc.meses";
    $from = "clienteempresa cl, planillaemitida pc, empleados em, empresas e";
    $where = "pc.idclienteempresa = cl.idclienteempresa
AND pc.idempresa = e.idempresa
AND e.idempleado = em.idempleado
AND cl.estado = 'Activo'
AND cl.item != '0' AND pc.emitido='1' AND pc.fechaemitida!='NULL'";
        if($idempresa != null && $idempresa != "")
    {
        $where .= " AND pc.idempresa ='$idempresa' ";

    }
if($idcliente != null && $idcliente != "")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $where .= " AND pc.idclienteempresa = '$idcliente' ";
    }

    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
       //    echo $sql;
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
function buscarclientesempresaplanilla($start, $limit, $sort, $dir, $callback, $_dc, $return, $idempresa,$planilla)
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
    $select ="pc.idplanillaemitida,cl.idclienteempresa, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, pc.ventasmes AS credito, pc.pago1 AS mes1, pc.cobro1, pc.pago2 AS mes2,pc.cobro2,  (pc.pago3+pc.pago4+ pc.pago5 + pc.pago6 + pc.pago7 ) AS mes3, pc.cobro3,pc.total, (pc.cobro1+pc.cobro2+pc.cobro3) AS totalcobro,CONCAT( em.nombres, '-', em.apellidos ) AS cobrador,pc.meses";
    $from = "clienteempresa cl, planillaemitida pc, empleados em, empresas e";
    $where = "pc.idclienteempresa = cl.idclienteempresa
AND pc.idempresa = e.idempresa
AND e.idempleado = em.codigo
AND cl.estado = 'ACTIVO'
";
        if($idempresa != null && $idempresa != "")
    {
        $where .= " AND pc.idempresa ='$idempresa' ";

    }
if($planilla != null && $planilla != "")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $where .= " AND pc.no_planilla = '$planilla' ";
    }

    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
     //   MostrarConsulta($sql);
     //   echo $sql;
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


function buscarclientesempresa($start, $limit, $sort, $dir, $callback, $_dc, $return, $idempresa)
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

    $select ="cl.idclienteempresa,cl.numero AS codigo,CONCAT( cl.nombre, '-', cl.apellido) AS cliente,cl.nit,cl.item, 0 AS credito,0 AS cuota,0 AS monto";
    $from = "clienteempresa cl,empresas e";
    $where = "cl.idempresa=e.idempresa AND cl.estado='Activo'AND cl.item!='0'";
        if($idempresa != null && $idempresa != "")
    {
        $where .= " AND cl.idempresa LIKE '%$idempresa%' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
            //echo $sql;
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

function txSaveEmpresa($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
   $proforma = $resultado->empresa;

  // echo $proforma;
    $codigoemp= $proforma->codigo;
    
    $nombreemp=$proforma->nombre;
    $diremp=$proforma->direccion;
    $telemp = $proforma->telefono;
    $idempleado = $proforma->idempleado;
    $fax = $proforma->fax;
    $fecha = $proforma->fecha;
    $fecha1 = $proforma->fecha1;
     $estado = $proforma->estado;
      $idciudad = $proforma->idciudad;
       $nombreresp = $proforma->nombreresp;
        $aperesp = $proforma->aperesp;
        $nitresp = $proforma->nitresp;
     $telefresp = $proforma->telefresp;
      $celresp = $proforma->celresp;
    $mailresp = $proforma->mailresp;
     $dirresp = $proforma->dirresp;
      $comisresp = $proforma->comisresp;
       $saldoant = $proforma->saldoant;
        $saldoact = $proforma->saldoact;
     $mes_planilla = $proforma->planilla;
      $tipo_planilla = $proforma->tipoplanilla;
      $empasig = $proforma->empasig;
       if($tipo_planilla == null || $tipo_planilla == "")
    {

    $tipo_planilla="P";
    }

      if($fecha == "")
    {
        $fecha = date("Y-m-d");
    }
      if($mes_planilla == null || $mes_planilla == "")
    {

    $anio = date("Y");
    $mes = date("m");
    $mes_planilla = $mes."/".$anio;
    }

     $idtienda =$_SESSION['idtienda'];
    //$responsable = $_SESSION['idusuario'];
   $hora = date("H:i:s");
 //$descuentoporcentaje=(($descuento*100)/$totalbs);
 
    
    $numeroventaA = findUltimoID("empresas", "numero", true);
    $numeroventaj = $numeroventaA['resultado'];
    $numeroempresa = $numeroventaj + 1;
    //$idempresa="epr-".$numeroempresa;
    $responsable= $nombreresp."-".$aperesp;
    $telefono= $telefresp."-".$celresp;
   // $mes_planilla
   if($nombreresp != null || $nombreresp != "")
    {
$numeroclie2 = findUltimoID("clienteempresa", "numero", true);
    $numerocliea2 = $numeroclie2['resultado'];
    $numerocliei2 = $numerocliea2 + 1;
    $idclienteempresa2=$numerocliei2;
     $idtienda = $_SESSION['idtienda'];
     $codigo = $idtienda.$numerocliei2;
    $sql[] = getSqlNewClienteempresa($idclienteempresa2, $codigo, $nombreresp, $aperesp, $nitresp,$dirresp, $telefono, $mailresp, "responsable", $idempresa, $estado, $item, $numerocliei, false);
    }

    $sql[] =  getSqlNewEmpresas($codigoemp, $codigoemp, $nombreemp, $diremp, $telemp, $fax, $idclienteempresa2, $numeroempresa, $comisresp, $fecha, $fecha1, $fecha, $mailresp, $idciudad, $observacion, $tipo_planilla, $idempleado, $mes_planilla, $estado, false);
$numeroinf = findUltimoID("inf_empresa", "numero", true);
    $numeroinfa = $numeroinf['resultado'];
    $numeroinfo = $numeroinfa + 1;
    $idinfempresa="inf-".$numeroinfo;
$sql[] = getSqlNewInf_empresa($idinfempresa, $codigoemp, $mes_planilla, "0", "0", "0","0", "0", "0", "0", "0", "0", "0", $estado, $numeroinfo, $fecha, $numeroinfo,  false);
$numeropla = findUltimoID("empresa_planilla", "numero", true);
    $numeroplaa = $numeropla['resultado'];
    $numeroplani = $numeroplaa + 1;
    $idempplanilla="pla-".$numeroplani;
    $no_planillaant=$numeroplani-1;
$sql[] = getSqlNewEmpresa_planilla($idempplanilla, $codigoemp, $mes_planilla, $numeroplani, $no_planillaant, $mes_planilla, false);


   // $sql1[] =getSqlNewPlanillaCredito($idplanilla, $no_planilla,$codigo,$idventadetalle,$idclienteempresa,$fecha,$hora,$pago1,$pago2,$pago3,$pago4,$pago5,$pago6,$pago7,$numero, false);
//$sql[] =getSqlNewPlanillacredito($idplanilla, $no_planilla,$codigo,$idventadetalle,$idempresa,$idclienteempresa,$fecha,$hora,$pago1,$pago2,$pago3,$pago4,$pago5,$pago6,$pago7,$numero, false);
//$sql[] = getSqlNewPlanillacredito($idplanilla, $mes_planilla, $codigo, $idventadetalle, $idempresa, $idclienteempresa, $fecha, $hora, $ventaoriginal, $pago1, $pago2, $pago3, $pago4, $pago5, $pago6, $pago7, $numero, $emitido, false);


$numeroclie = findUltimoID("clienteempresa", "numero", true);
    $numerocliea = $numeroclie['resultado'];
    $numerocliei = $numerocliea + 2;
    $idclienteempresa=$numerocliei;
$sql[] = getSqlNewClienteempresa($idclienteempresa, "Sin Codigo", "No existe", "el Cliente", "-","-", "-", "-", "empresa", $codigoemp, $estado, "0", $numerocliei, false);


//MostrarConsulta($sql);
            if(ejecutarConsultaSQLBeginCommit($sql))
    {

        $dev['mensaje'] = "Se guardo la empresa";
        $dev['error'] = "true";
        $dev['resultado'] = $codigoemp;
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

function modificarempresa($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idempresa = $resultado->idempresa;
    $codigo = $resultado->codigo;
    $nombre = $resultado->nombre;
    $direccion = $resultado->direccion;
    $telefono = $resultado->telefono;
    $idcobrador = $resultado->idcobrador;
    $fax = $resultado->fax;
    $fecha = $resultado->fecha;
    $fecha1 = $resultado->fecha1;
    $estado = $resultado->estado;
    $idciudad = $resultado->idciudad;
    $responsable = $resultado->responsable;
    $apellidores = $resultado->apellidores;
    $nitres = $resultado->nitres;
    $telefres = $resultado->telefres;
    $celres = $resultado->celres;
    $mailres = $resultado->mailres;
    $dirres = $resultado->dirres;
    $comision = $resultado->comision;
    $saldoant = $resultado->saldoant;
    $saldoactual = $resultado->saldoactual;
    $planillaactual = $resultado->planillaactual;
    $tipoplanilla = $resultado->tipoplanilla;
   	$fecharegistro = date("Y-m-d");
$sql1= "SELECT
            e.codigo,e.nombre,e.comision,e.tipo_planilla,e.mes_planillla,e.estado,inf.saldo_empresa
            FROM
              empresas e,inf_empresa inf
            WHERE
              e.idempresa=inf.idempresa AND e.idempresa = '$idempresa' ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "codigo");
  $codigoant = $result1['resultado'];
$result2 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
  $nombreant = $result2['resultado'];
  $result222 = findBySqlReturnCampoUnique($sql1, true, true, "comision");
  $comisionant = $result222['resultado'];
  $result2222 = findBySqlReturnCampoUnique($sql1, true, true, "tipo_planilla");
  $tipo_planillaant = $result2222['resultado'];
   $result3 = findBySqlReturnCampoUnique($sql1, true, true, "mes_planillla");
  $mesplanillaant = $result3['resultado'];
   $result4 = findBySqlReturnCampoUnique($sql1, true, true, "estado");
  $estadoant = $result4['resultado'];
   $result5 = findBySqlReturnCampoUnique($sql1, true, true, "saldo_empresa");
  $saldoempresaant = $result5['resultado'];
if($estado == 'INACTIVO'){
   if($saldoempresaant > '0'){
       $dev['mensaje'] = "La empresa tiene saldo pendiente no se puede inactivar ".$saldoempresaant;
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
       }   else
       {
           $estado="INACTIVO";
       } 
        }
      
//$planillaactual
  if( $planillaactual != $mesplanillaant)
    {
         $planillaanterior= split("/",$planillaactual);
 $mesplani=$planillaanterior[0];
$anioplani=$planillaanterior[1];

$anio = date("Y");
    $mes = date("m");
    $mes_actual = $mes."/".$anio;

    if($anioplani == $anio) {
 $mes1p=$mesplani +1;
 $mes1="0".$mes1p."/".$anio;
    $mesp=$mesplani+2;
 $mes2="0".$mesp."/".$anio;
    $mesp2=$mesplani+3;
 $mes3="0".$mesp2."/".$anio;
    $mesp4=$mesplani+4;
 $mes4="0".$mesp4."/".$anio;
    $mesp5=$mesplani+5;
 $mes5="0".$mesp5."/".$anio;
    $mesp6=$mesplani+6;
 $mes6="0".$mesp6."/".$anio;
    $mesp7=$mesplani+7;
 $mes7="0".$mesp7."/".$anio;
    }
    $mesplanilla=$mes1;
$pago1=$pago11+$pago22-$cobro1;
$pago2=$pago33-$cobro2;
$pago3=$pago44-$cobro3;
$pago4=$pago55-$cobro4;
$pago5=$pago66-$cobro5;
$pago6=$pago77-$cobro6;
$pago7="0.00";

$sql[] = getSqlNewPlanillaemitida($idplanillaemitida, $mesplanilla, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora,$ventasmes,$pares, $mes1, $pago1, "0.00", $mes2, $pago2, "0.00", $mes3, $pago3, "0.00", $mes4, $pago4, "0.00", $mes5, $pago5, "0.00", $mes6, $pago6, "0.00", $mes7, $pago7, "0.00",$saldototal, $emitido, $tiempo, "P",$numeropla, false);
    }else{
        $planillanueva=$planillaactual;
    }


    //$sql[]=getSqlUpdateCliente($idcliente,$nit,$nombre, $direccion, $telefono, $ciudad, $tipo, $estado, $numero, $fechanacimiento, $email, $idalmacen, $codigo, $fecharegistro, $idcredito, $celular,  $return);
$sql[]=getSqlUpdateEmpresas($idempresa,$codigo,$nombre,$direccion,$telefono,$fax,$responsable,$numero,$comision,$fecha,$fechacontrato,$fechafin,$email,$idciudad,$observacion,$tipo_planilla,$idempleado,$mes_planillla,$estado,  $return);
$sql[]=getSqlUpdateInf_empresa($idinfempresa,$idempresa,$mes_planillla,$saldo_anterior,$importe_boleta,$importe_cobro,$importe_devolucion,$importe_castigo,$importe_descuento,$comision,$diferencia,$saldo_empresa,$saldo_planilla,$estado,$planilla,$fecha_planilla,$numero, $return);
$sql[] = getSqlNewEmpresa_planilla($idempplanilla, $idempresa, $mes_planilla, $numeroplani, $no_planillaant, $mes_planilla, false);
 if($nombreresp != null || $nombreresp != "")
    {
$numeroclie2 = findUltimoID("clienteempresa", "numero", true);
    $numerocliea2 = $numeroclie2['resultado'];
    $numerocliei2 = $numerocliea2 + 1;
    $idclienteempresa2=$numerocliei2;
     $idtienda = $_SESSION['idtienda'];
     $codigo = $idtienda.$numerocliei2;
    $sql[] = getSqlNewClienteempresa($idclienteempresa2, $codigo, $nombreresp, $aperesp, $nitresp,$dirresp, $telefono, $mailresp, "responsable", $idempresa, $estado, $item, $numerocliei, false);
    }

   $sql[] =getSqlUpdateClienteempresa($idclienteempresa,$codigo,$nombre,$apellido,$nit,$direccion,$telefono,$mail,$referencia,$idempresa,$estado,$item,$numero,$saldoanterior,$saldoactual, $return);

      // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se modifico  correctamente la empresa";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error guardar el usuario";
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
function getSqlUpdateClienteempresa($idclienteempresa,$codigo,$nombre,$apellido,$nit,$direccion,$telefono,$mail,$referencia,$idempresa,$estado,$item,$numero,$saldoanterior,$saldoactual, $return){
$setC[0]['campo'] = 'codigo';
$setC[0]['dato'] = $codigo;
$setC[1]['campo'] = 'nombre';
$setC[1]['dato'] = $nombre;
$setC[2]['campo'] = 'apellido';
$setC[2]['dato'] = $apellido;
$setC[3]['campo'] = 'nit';
$setC[3]['dato'] = $nit;
$setC[4]['campo'] = 'direccion';
$setC[4]['dato'] = $direccion;
$setC[5]['campo'] = 'telefono';
$setC[5]['dato'] = $telefono;
$setC[6]['campo'] = 'mail';
$setC[6]['dato'] = $mail;
$setC[7]['campo'] = 'referencia';
$setC[7]['dato'] = $referencia;
$setC[8]['campo'] = 'estado';
$setC[8]['dato'] = $estado;
$setC[9]['campo'] = 'item';
$setC[9]['dato'] = $item;
$setC[10]['campo'] = 'numero';
$setC[10]['dato'] = $numero;
$setC[11]['campo'] = 'saldoanterior';
$setC[11]['dato'] = $saldoanterior;
$setC[12]['campo'] = 'saldoactual';
$setC[12]['dato'] = $saldoactual;

$set = generarSetsUpdate($setC);
$wher[0]['campo'] = 'idclienteempresa';
$wher[0]['dato'] = $idclienteempresa;
$wher[1]['campo'] = 'idempresa';
$wher[1]['dato'] = $idempresa;

$where = generarWhereUpdate($wher);
return "UPDATE clienteempresa SET ".$set." WHERE ".$where;
}




function getSqlUpdateEmpresas($idempresa,$codigo,$nombre,$direccion,$telefono,$fax,$responsable,$numero,$comision,$fecha,$fechacontrato,$fechafin,$email,$idciudad,$observacion,$tipo_planilla,$idempleado,$mes_planillla,$estado, $return){
$setC[0]['campo'] = 'codigo';
$setC[0]['dato'] = $codigo;
$setC[1]['campo'] = 'nombre';
$setC[1]['dato'] = $nombre;
$setC[2]['campo'] = 'direccion';
$setC[2]['dato'] = $direccion;
$setC[3]['campo'] = 'telefono';
$setC[3]['dato'] = $telefono;
$setC[4]['campo'] = 'fax';
$setC[4]['dato'] = $fax;
$setC[5]['campo'] = 'responsable';
$setC[5]['dato'] = $responsable;
$setC[6]['campo'] = 'numero';
$setC[6]['dato'] = $numero;
$setC[7]['campo'] = 'comision';
$setC[7]['dato'] = $comision;
$setC[8]['campo'] = 'fecha';
$setC[8]['dato'] = $fecha;
$setC[9]['campo'] = 'fechacontrato';
$setC[9]['dato'] = $fechacontrato;
$setC[10]['campo'] = 'fechafin';
$setC[10]['dato'] = $fechafin;
$setC[11]['campo'] = 'email';
$setC[11]['dato'] = $email;
$setC[12]['campo'] = 'observacion';
$setC[12]['dato'] = $observacion;
$setC[13]['campo'] = 'tipo_planilla';
$setC[13]['dato'] = $tipo_planilla;
$setC[14]['campo'] = 'mes_planillla';
$setC[14]['dato'] = $mes_planillla;
$setC[15]['campo'] = 'estado';
$setC[15]['dato'] = $estado;

$set = generarSetsUpdate($setC);
$wher[0]['campo'] = 'idempresa';
$wher[0]['dato'] = $idempresa;
$wher[1]['campo'] = 'idciudad';
$wher[1]['dato'] = $idciudad;
$wher[2]['campo'] = 'idempleado';
$wher[2]['dato'] = $idempleado;

$where = generarWhereUpdate($wher);
return "UPDATE empresas SET ".$set." WHERE ".$where;
}
function getSqlUpdateInf_empresa($idinfempresa,$idempresa,$mes_planillla,$saldo_anterior,$importe_boleta,$importe_cobro,$importe_devolucion,$importe_castigo,$importe_descuento,$comision,$diferencia,$saldo_empresa,$saldo_planilla,$estado,$planilla,$fecha_planilla,$numero, $return){
$setC[0]['campo'] = 'mes_planillla';
$setC[0]['dato'] = $mes_planillla;
$setC[1]['campo'] = 'saldo_anterior';
$setC[1]['dato'] = $saldo_anterior;
$setC[2]['campo'] = 'importe_boleta';
$setC[2]['dato'] = $importe_boleta;
$setC[3]['campo'] = 'importe_cobro';
$setC[3]['dato'] = $importe_cobro;
$setC[4]['campo'] = 'importe_devolucion';
$setC[4]['dato'] = $importe_devolucion;
$setC[5]['campo'] = 'importe_castigo';
$setC[5]['dato'] = $importe_castigo;
$setC[6]['campo'] = 'importe_descuento';
$setC[6]['dato'] = $importe_descuento;
$setC[7]['campo'] = 'comision';
$setC[7]['dato'] = $comision;
$setC[8]['campo'] = 'diferencia';
$setC[8]['dato'] = $diferencia;
$setC[9]['campo'] = 'saldo_empresa';
$setC[9]['dato'] = $saldo_empresa;
$setC[10]['campo'] = 'saldo_planilla';
$setC[10]['dato'] = $saldo_planilla;
$setC[11]['campo'] = 'estado';
$setC[11]['dato'] = $estado;
$setC[12]['campo'] = 'planilla';
$setC[12]['dato'] = $planilla;
$setC[13]['campo'] = 'fecha_planilla';
$setC[13]['dato'] = $fecha_planilla;
$setC[14]['campo'] = 'numero';
$setC[14]['dato'] = $numero;

$set = generarSetsUpdate($setC);
$wher[0]['campo'] = 'idinfempresa';
$wher[0]['dato'] = $idinfempresa;
$wher[1]['campo'] = 'idempresa';
$wher[1]['dato'] = $idempresa;

$where = generarWhereUpdate($wher);
return "UPDATE inf_empresa SET ".$set." WHERE ".$where;
}

function ListarEmpresa($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 1000;
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

    if($where == null || $where == "")
    {
        $sql ="
SELECT em.idempresa, em.codigo, em.nombre, em.direccion, em.telefono, em.fax, em.responsable, em.estado, em.numero, em.comision, em.fecha, em.fechacontrato, em.email, ci.nombre AS ciudad
FROM empresas em, `ciudades` ci
WHERE em.idciudad = ci.idciudad $order LIMIT $start,$limit

";
    }else{
        $sql ="
SELECT em.idempresa, em.codigo, em.nombre, em.direccion, em.telefono, em.fax, em.responsable, em.estado, em.numero, em.comision, em.fecha, em.fechacontrato, em.email, ci.nombre AS ciudad
FROM empresas em, `ciudades` ci
WHERE em.idciudad = ci.idciudad
AND $where $order LIMIT $start,$limit

";
    }
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
function getSqlNewEmpresas($idempresa, $codigo, $nombre, $direccion, $telefono, $fax, $responsable, $numero, $comision, $fecha, $fechacontrato, $fechafin, $email, $idciudad, $observacion, $tipo_planilla, $idempleado, $mes_planillla, $estado, $return){
$setC[0]['campo'] = 'idempresa';
$setC[0]['dato'] = $idempresa;
$setC[1]['campo'] = 'codigo';
$setC[1]['dato'] = $codigo;
$setC[2]['campo'] = 'nombre';
$setC[2]['dato'] = $nombre;
$setC[3]['campo'] = 'direccion';
$setC[3]['dato'] = $direccion;
$setC[4]['campo'] = 'telefono';
$setC[4]['dato'] = $telefono;
$setC[5]['campo'] = 'fax';
$setC[5]['dato'] = $fax;
$setC[6]['campo'] = 'responsable';
$setC[6]['dato'] = $responsable;
$setC[7]['campo'] = 'numero';
$setC[7]['dato'] = $numero;
$setC[8]['campo'] = 'comision';
$setC[8]['dato'] = $comision;
$setC[9]['campo'] = 'fecha';
$setC[9]['dato'] = $fecha;
$setC[10]['campo'] = 'fechacontrato';
$setC[10]['dato'] = $fechacontrato;
$setC[11]['campo'] = 'fechafin';
$setC[11]['dato'] = $fechafin;
$setC[12]['campo'] = 'email';
$setC[12]['dato'] = $email;
$setC[13]['campo'] = 'idciudad';
$setC[13]['dato'] = $idciudad;
$setC[14]['campo'] = 'observacion';
$setC[14]['dato'] = $observacion;
$setC[15]['campo'] = 'tipo_planilla';
$setC[15]['dato'] = $tipo_planilla;
$setC[16]['campo'] = 'idempleado';
$setC[16]['dato'] = $idempleado;
$setC[17]['campo'] = 'mes_planillla';
$setC[17]['dato'] = $mes_planillla;
$setC[18]['campo'] = 'estado';
$setC[18]['dato'] = $estado;
$sql2 = generarInsertValues($setC);
return "INSERT INTO empresas ".$sql2;
}

function getSqlNewInf_empresa($idinfempresa, $idempresa, $mes_planillla, $saldo_anterior, $importe_boleta, $importe_cobro, $importe_devolucion, $importe_castigo, $importe_descuento, $comision, $diferencia, $saldo_empresa, $saldo_planilla, $estado, $planilla, $fecha_planilla, $numero, $return){
$setC[0]['campo'] = 'idinfempresa';
$setC[0]['dato'] = $idinfempresa;
$setC[1]['campo'] = 'idempresa';
$setC[1]['dato'] = $idempresa;
$setC[2]['campo'] = 'mes_planillla';
$setC[2]['dato'] = $mes_planillla;
$setC[3]['campo'] = 'saldo_anterior';
$setC[3]['dato'] = $saldo_anterior;
$setC[4]['campo'] = 'importe_boleta';
$setC[4]['dato'] = $importe_boleta;
$setC[5]['campo'] = 'importe_cobro';
$setC[5]['dato'] = $importe_cobro;
$setC[6]['campo'] = 'importe_devolucion';
$setC[6]['dato'] = $importe_devolucion;
$setC[7]['campo'] = 'importe_castigo';
$setC[7]['dato'] = $importe_castigo;
$setC[8]['campo'] = 'importe_descuento';
$setC[8]['dato'] = $importe_descuento;
$setC[9]['campo'] = 'comision';
$setC[9]['dato'] = $comision;
$setC[10]['campo'] = 'diferencia';
$setC[10]['dato'] = $diferencia;
$setC[11]['campo'] = 'saldo_empresa';
$setC[11]['dato'] = $saldo_empresa;
$setC[12]['campo'] = 'saldo_planilla';
$setC[12]['dato'] = $saldo_planilla;
$setC[13]['campo'] = 'estado';
$setC[13]['dato'] = $estado;
$setC[14]['campo'] = 'planilla';
$setC[14]['dato'] = $planilla;
$setC[15]['campo'] = 'fecha_planilla';
$setC[15]['dato'] = $fecha_planilla;
$setC[16]['campo'] = 'numero';
$setC[16]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO inf_empresa ".$sql2;
}
function getSqlNewEmpresa_planilla($idempplanilla, $idempresa, $mes_planillla, $numero, $no_planillaant, $no_planilla, $return){
$setC[0]['campo'] = 'idempplanilla';
$setC[0]['dato'] = $idempplanilla;
$setC[1]['campo'] = 'idempresa';
$setC[1]['dato'] = $idempresa;
$setC[2]['campo'] = 'mes_planillla';
$setC[2]['dato'] = $mes_planillla;
$setC[3]['campo'] = 'numero';
$setC[3]['dato'] = $numero;
$setC[4]['campo'] = 'no_planillaant';
$setC[4]['dato'] = $no_planillaant;
$setC[5]['campo'] = 'no_planilla';
$setC[5]['dato'] = $no_planilla;
$sql2 = generarInsertValues($setC);
return "INSERT INTO empresa_planilla ".$sql2;
}
function getSqlNewClienteempresa($idclienteempresa, $codigo, $nombre, $apellido, $nit, $direccion, $telefono, $mail, $referencia, $idempresa, $estado, $item, $numero, $return){
$setC[0]['campo'] = 'idclienteempresa';
$setC[0]['dato'] = $idclienteempresa;
$setC[1]['campo'] = 'codigo';
$setC[1]['dato'] = $codigo;
$setC[2]['campo'] = 'nombre';
$setC[2]['dato'] = $nombre;
$setC[3]['campo'] = 'apellido';
$setC[3]['dato'] = $apellido;
$setC[4]['campo'] = 'nit';
$setC[4]['dato'] = $nit;
$setC[5]['campo'] = 'direccion';
$setC[5]['dato'] = $direccion;
$setC[6]['campo'] = 'telefono';
$setC[6]['dato'] = $telefono;
$setC[7]['campo'] = 'mail';
$setC[7]['dato'] = $mail;
$setC[8]['campo'] = 'referencia';
$setC[8]['dato'] = $referencia;
$setC[9]['campo'] = 'idempresa';
$setC[9]['dato'] = $idempresa;
$setC[10]['campo'] = 'estado';
$setC[10]['dato'] = $estado;
$setC[11]['campo'] = 'item';
$setC[11]['dato'] = $item;
$setC[12]['campo'] = 'numero';
$setC[12]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO clienteempresa ".$sql2;
}
function eliminarempresa($idempresa,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";

    $sql1="
SELECT
 v.idempresa,v.codigo,v.nombre
FROM
  empresas v
WHERE
  v.idcliente = '$idempresa'
";
    $link=new BD;
    $link->conectar();
    $res=$link->consulta($sql1);
    $itemproducto1 = verificarValidarText($idempresa, true, "ventasdetalle", "idempresa");
    $itemproducto2 = verificarValidarText($idempresa, true, "credito", "idempresa");
$itemproducto3 = verificarValidarText($idempresa, true, "planillaemitida", "idempresa");


if(($itemproducto1['error'] == false)&&($itemproducto2['error'] == false)&&($itemproducto3['error'] == false)){
            $sql[] = "DELETE FROM ventasdetalle WHERE idempresa = '$idempresa';";
    $sql[] = "DELETE FROM planillaemitida WHERE idempresa = '$idempresa';";
    $sql[] = "DELETE FROM movimientoplanilla WHERE idempresa = '$idempresa';";
$sql[] = "DELETE FROM inf_empresa WHERE idempresa = '$idempresa';";
$sql[] = "DELETE FROM clienteempresa WHERE idempresa = '$idempresa';";
$sql[] = "DELETE FROM empresas WHERE idempresa = '$idempresa';";



        }
        else{
            $dev['mensaje'] = "La empresa no se puede eliminar tiene, planillas emitidas y/o dependencias";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
//    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino la empresa correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar ";
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
function BuscarEmpresaPorId($idempresa,$callback, $_dc, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $cliente = ListarEmpleadosCobrador('', '', '', '', '', '','',true);
    if($cliente["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
 $value['empleadoM'] = $cliente['resultado'];
    $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar informacion";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $value["ciudadM"] = $ciudad['resultado'];
   $dev["resultado"] = $value;

     $sql ="
SELECT e.idempresa, e.codigo, e.nombre, e.direccion, e.telefono, e.fax, e.fecha, e.fechacontrato, e.estado, ci.nombre AS ciudad,
 e.responsable AS nombre, e.comision, inf.saldo_anterior AS saldoanterior, inf.saldo_empresa AS saldoactual,
inf.mes_planillla AS planillaactual, e.tipo_planilla AS tipoplanilla, CONCAT( emp.nombres, '-', emp.apellidos ) AS empleadoasignado
FROM empresas e, inf_empresa inf, ciudades ci, empleados emp
WHERE e.idempresa = inf.idempresa
AND e.idciudad = ci.idciudad
AND e.idempleado=emp.codigo
AND e.idempresa like '%$idempresa%';

";
    //LIKE '%".$_GET['buscarcodigo']."%'";
   // echo $sql;
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


?>