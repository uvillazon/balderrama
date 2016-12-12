<?php
function BuscarClienteplanilla($idclientempresa,$planilla,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

//    $categorias = ListarTraspasoporId('', '', '', '', '', '',"$idtraspaso",true);
//    if($categorias['error'] == true)
//    {
//        $value['material'] = "true";
//        $value['materialM'] = $categorias['resultado'];
//    }
//$iddestino = $_SESSION['idtienda'];
//echo $idclientempresa;
    $sql ="
SELECT
  ma.idclienteempresa,ma.no_planilla AS planilla
FROM
  `planillacredito` ma
WHERE
   ma.idclienteempresa= '$idclientempresa'

";
     $value['idclienteempresa'] = $idclientempresa;
      $value['planilla'] = $planilla;
// t.idtienda =ma.idtienda AND ma.tiendadestino= '$iddestino' AND ma.idtraspaso = '$idtraspaso'

 // echo $sql;
    if($idclienteempresa != null)
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

function buscarventasporcliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idcliente)
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

    $select = "vd.idventadetalle,t.nombre AS tienda,vd.fecha,vd.boleta,vd.numerofactura,vd.cantidad,vd.montopapeleta,vd.montoapagar,vd.ingresoventabs";
    $from = "ventasdetalle vd, tiendas t";
    $where = "vd.credito='SI' AND vd.idtienda = t.idtienda";
        if($idcliente != null && $idcliente != "")
    {
        $where .= " AND vd.idclienteempresa LIKE '%$idcliente%' ";
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

function buscarplanillaporcliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idcliente)
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

    $select = "cl.no_planilla,cl.idventadetalle,cl.idclienteempresa,cl.fecha,cl.pago1,cl.pago2,cl.pago3,cl.pago4,cl.pago5,cl.pago6,cl.pago7 ";
    $from = "planillacredito cl,clienteempresa ce";
    $where = "ce.idclienteempresa=cl.idclienteempresa ";
        if($idcliente != null && $idcliente != "")
    {
        $where .= " AND cl.idclienteempresa LIKE '%$idcliente%' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
    //        echo $sql;
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

function buscarpagoplanillacliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idcliente,$planilla)
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

    $select = "cl.idcliente AS idclienteempresa,cl.fecha,cl.recibo,cl.monto AS importe,cl.cobroempresa,CONCAT( ce.nombres,'-',ce.apellidos) AS cobrador ";
    $from = "pagocredito cl,empleados ce";
    $where = "cl.idempleado=ce.idempleado AND cl.tipopago='ingreso' ";
        if($idcliente != null && $idcliente != "")
    {
        $where .= " AND cl.idcliente LIKE '%$idcliente%'AND cl.idcredito='$planilla' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
       //     echo $sql;
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

function buscarpagosporcliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idcliente)
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

    $select = "pc.idcliente,pc.idpagocredito,pc.monto,pc.fecha,pc.observacion,t.nombre AS tienda,CONCAT( e.nombre, '-', e.apellido1) AS encargado ";
    $from = "pagocredito pc,tiendas t,usuario e";
    $where = "pc.idtienda=t.idtienda AND pc.idempleado=e.idusuario AND pc.tipopago='ingreso'";
        if($idcliente != null && $idcliente != "")
    {
        $where .= " AND pc.idcliente LIKE '%$idcliente%' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
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

function findAllCreditosCliente($start, $limit, $sort, $dir, $callback, $_dc, $return, $idcliente)
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

    $select = " cl.idclienteempresa,cr.idcredito, cr.no_planilla AS planilla, cr.no_pares AS pares,cr.saldo AS porpagar,0 AS pagado, cr.montototal AS credito, e.nombre AS empresa, CONCAT( cl.nombre, '-', cl.apellido, '-', cl.item ) AS cliente, ci.nombre AS ciudad, t.nombre AS tienda";
    $from = "credito cr, empresas e, clienteempresa cl, ciudades ci, ventasdetalle vd, tiendas t";
    $where = "cr.idempresa = e.idempresa AND cr.idclienteempresa = cl.idclienteempresa AND e.idciudad = ci.idciudad AND cr.idventadetalle = vd.idventadetalle AND vd.idtienda = t.idtienda AND cr.estado = 'Activo'";
        if($idcliente != null && $idcliente != "")
    {
        $where .= " AND cl.idclienteempresa LIKE '%$idcliente%' ";
    }



    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
    //        echo $sql;
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
function  BuscarDatosCliente($idcliente,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";

//    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
//    $numero = $numeropa['resultado']+1;
//    $anio = date("Y");
//    $value['numeropedido'] = $numero."/".$anio;
//

    $sql ="
SELECT cl.idclienteempresa AS idcliente, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, em.nombre AS empresa, SUM(cr.montototal) AS saldopagar, SUM(cr.saldo) AS pagado, CONCAT( emp.nombres, '-', emp.apellidos ) AS cobrador, cl.estado, cl.nit, cl.telefono, cl.item, cl.direccion
FROM empresas em, clienteempresa cl, credito cr, empleados emp
WHERE cl.idempresa = em.idempresa
AND cl.idclienteempresa = cr.idclienteempresa
AND em.idempleado = emp.idempleado
AND cl.idclienteempresa = '$idcliente' GROUP BY cl.idclienteempresa

";
    echo $sql;
    if($idcliente != null)
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
function  ConsultaClienteEmpresa($idcliente,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";

//    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
//    $numero = $numeropa['resultado']+1;
//    $anio = date("Y");
//    $value['numeropedido'] = $numero."/".$anio;
//

    $sql ="
SELECT cl.idclienteempresa AS idcliente, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, em.nombre AS empresa,pe.ventasmes AS totalventa,
pe.pares,pe.no_planilla AS mesplanilla, pe.pago1 AS mes1,pe.pago2 AS mes2,pe.pago3 AS mes3,pe.pago4 AS mes4,pe.pago5 AS mes5,pe.pago6 AS mes6,0 AS mesplanilla2,0 AS totalventa2, 0 AS mes11,0 AS mes22,0 AS mes33,
0 AS mes44,0 AS mes55,0 AS mes66
FROM empresas em, clienteempresa cl, planillaemitida pe
WHERE cl.idempresa = em.idempresa
AND cl.idclienteempresa = pe.idclienteempresa
AND cl.idclienteempresa = '$idcliente' AND pe.emitido='1' GROUP BY cl.idclienteempresa

";
    //echo $sql;
    if($idcliente != null)
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
function findAllProductoConCondiciones($start, $limit, $sort, $dir, $callback, $_dc, $return, $ciudad,  $tienda, $empresa, $cliente, $codigo)
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

    $select = " cr.idcredito, cr.no_planilla AS planilla, cr.no_pares AS pares,cr.saldo, cr.montototal AS credito, e.nombre AS empresa, CONCAT( cl.nombre, '-', cl.apellido, '-', cl.item ) AS cliente, ci.nombre AS ciudad, t.nombre AS tienda";
    $from = "credito cr, empresas e, clienteempresa cl, ciudades ci, ventasdetalle vd, tiendas t";
    $where = "cr.idempresa = e.idempresa AND cr.idclienteempresa = cl.idclienteempresa AND e.idciudad = ci.idciudad AND cr.idventadetalle = vd.idventadetalle AND vd.idtienda = t.idtienda AND cr.estado = 'Activo'";
    if($ciudad != "Todos" && $ciudad != null && $ciudad != "")
    {

                            //$from .= ", almacen a, productoalmacen pa";
                $where .= " AND ci.idciudad = '$ciudad'";

     }
if($tienda != "Todos" && $tienda != null && $tienda != "")
            {
                //$from .= ", almacen a, productoalmacen pa";
                $where .= " AND t.idtienda = '$tienda'";

            }
    if($empresa != "Todos" && $empresa != null && $empresa != "")
    {
           // $from .= ", subcategoria sb, categoria ct";
            $where .= " AND e.idempresa = '$empresa'";
       
    }
     if($cliente != "Todos" && $cliente != null && $cliente != "")
        {
            //$from .= ", subcategoria sb";
            $where .= " AND cl.idclienteempresa = '$cliente'";
        }
    if($codigo != null && $codigo != "")
    {
        $where .= " AND cr.no_pares LIKE '%$codigo%' ";
    }
    


    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
         //  echo $sql;
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


function BuscarEmpresaCobradorClienteTienda($idempresa)
{
    $categoria = ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);
    $subcategoria =  Listarempresas('', '', '', '', '', '',"",true);
   // $carac  =  findAllCaracteristica(0, 0, "nombre", "ASC", "", "", true, true);

    $dev['error'] = "true";
    $dev['mensaje'] = "Se recuperaron correctamente los objetos";
    $dev['clienteM'] = $categoria['resultado'];
    $dev['empresaM'] = $subcategoria['resultado'];
    //$dev['caracteristicaM'] = $carac['resultado'];
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}

function BuscarEmpresaCobradorClienteTienda2($callback, $_dc,$idempresa,$planilla, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

$cliente = ListarEmpleadosCobrador('', '', '', '', '', '','',true);
    $empleado = ListarTiendas('', '', '', '', '', '','',true);
       //  $value['usuariosM'] = $usr["resultado"];
        $value['empleadoM'] = $cliente['resultado'];
        $value['tiendaM'] = $empleado['resultado'];
   // $anio = date("Y");
   // $mes = date("m");
    $value['planilla'] = $planilla;


     $sql ="
SELECT e.idempresa, e.codigo, e.nombre, CONCAT( c.nombre, '-', c.apellido ) AS responsable, e.comision, e.estado
FROM empresas e,clienteempresa c
WHERE e.estado = 'Activo' AND  e.responsable=c.idclienteempresa AND c.referencia='responsable'
AND e.idempresa = '$idempresa'
";
        $detalleA = findBySqlReturnCampoUnique($sql, true, true, "codigo");
        $value['codigo'] =  $detalleA['resultado'];
     $detalleA1 = findBySqlReturnCampoUnique($sql, true, true, "nombre");
        $value['nombre'] =  $detalleA1['resultado'];
         $detalleA2 = findBySqlReturnCampoUnique($sql, true, true, "responsable");
        $value['responsable'] =  $detalleA2['resultado'];
         $detalleA5 = findBySqlReturnCampoUnique($sql, true, true, "comision");
        $value['comision'] =  $detalleA5['resultado'];
         $detalleA7 = findBySqlReturnCampoUnique($sql, true, true, "estado");
        $value['estado'] =  $detalleA7['resultado'];
 $sql = "SELECT SUM(pago1)AS mes1,SUM(pago2)AS mes2
FROM
 planillaemitida
WHERE
  idempresa = '$idempresa' AND no_planilla='$planilla'
";
        $detalleA9 = findBySqlReturnCampoUnique($sql, true, true, "mes1");
        $value['mes1'] =  $detalleA9['resultado'];
        $detalleA90 = findBySqlReturnCampoUnique($sql, true, true, "mes2");
        $value['mes2'] =  $detalleA90['resultado'];

        $sql = "SELECT SUM(pago3+pago4+pago5+pago6+pago7)AS mes3
FROM
 planillaemitida
WHERE
  idempresa = '$idempresa' AND no_planilla='$planilla'
";
        $detalleA91 = findBySqlReturnCampoUnique($sql, true, true, "mes3");
        $value['mes3'] =  $detalleA91['resultado'];
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
function GuardarCobros($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
   $proforma = $resultado->venta;
    $numeroventaA = findUltimoID("ventasdetalle", "numero", true);
    $numeroventaj = $numeroventaA['resultado'];
    $numeroventa = $numeroventaj + 1;
    $idventadetalle="ven-id-".$numeroventa;

    $nit= $proforma->nit;

   $nombrecliente=$proforma->nombre;

    $fecha = $proforma->fecha;
   if($fecha == "")
    {
        $fecha = date("Y-m-d");
    }
   $idempresa = $proforma->idempresa;

    $montoapagar = $proforma->montoapagar;
    $idtienda =$_SESSION['idtienda'];
    $responsable = $_SESSION['idusuario'];
   $hora = date("H:i:s");

    $product = $resultado->productos;
$totalpares=COUNT($product);
 $cantidadminima = '1';

    $sql1= "SELECT
              cli.idtipocambio,cli.estado,valor
            FROM
              tipocambio cli
            WHERE
              cli.estado = 'activado'";

      $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $ingresoventabs=$montocancelado-$devuelto;
    $montoapagarsus = $montoapagar/$tipocambio;
    $ingresoventasus=$montocanceladosus-$devueltosus;
   // $descuento = $proforma->descuento;
    $arqueo="0";
       $sql[] =getSqlNewVentasdetalle($idventadetalle, $idtienda, $idempresa, $boleta, $numeroventa, $idclienteempresa, $nit, $nombrecliente, $apellidocliente, $fecha, $hora, $tipoventa, $numerofactura, $responsable, $credito, $totalbs, $totalpares, $montoapagar, $descuento, $montocancelado, $montocanceladosus, $ingresoventabs, $ingresoventasus, $montopapeleta, $tipocambio, $observacion,$arqueo, false);



//$productos = "2";
  //       echo $TOTAL;

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];

 $iddetalletraspasoA = findUltimoID("itemventa", "numero",true );
            $numerodetalletraspaso = $iddetalletraspasoA['resultado'] + 1 +$i;
            //                echo $numerodetalletraspaso;
            $numerodetalletraspaso;
            $iditemventa = "ivt-".$numerodetalletraspaso;

$idkardextienda = $producto->idkardextienda;
        $precio = $producto->precio2;
        $cantidad = $producto->cantidad;


         $sql1 = "
SELECT
  kar.saldocantidad
FROM
  `adicionkardextienda` kar
WHERE
  kar.idkardextienda = '$idkardextienda'
 AND kar.idtienda = '$idtienda';
";
        $saldocantidadA = findBySqlReturnCampoUnique($sql1,true, true, 'saldocantidad');
        if($saldocantidadA['resultado'] <= $cantidad){
            $dev['mensaje'] = "Error no tiene suficiente inventario para realizar la venta ";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
        else
        {
            //  $total=$producto->total;
              $idempleado1=$producto->idempleado;
       $sql3 = "
SELECT
  k.idempleado,k.codigo
FROM
  empleados k
WHERE
  k.codigo = '$idempleado1'

";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idempleado");
        $idempleado = $cantidadventaA1['resultado'];

        $sql3 = "
SELECT
  k.saldocantidad
FROM
  adicionkardextienda k
WHERE
  k.idkardextienda = '$idkardextienda' AND
  k.idtienda = '$idtienda'

";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
        $cantidadventa1 = $cantidadventaA1['resultado'];

        $cantidad1 = $cantidad - $cantidadventa1;
  //      echo $cantidad1;
// if($cantidad1 > 0){
      //  $iditemventa="itv-".$numeroit;

$descuentoporcentaje=(($descuento*100)/$totalbs);
  //    $descuento = $proforma ->descuento;
  $descuentounidad=(($precio*$descuentoporcentaje)/100);
  $total=$precio-$descuentounidad;
    // $descuentop ="0.00";
        $sql4 = "
SELECT
  k.idcalzado
FROM
  adicionkardextienda k
WHERE
  k.idkardextienda = '$idkardextienda' AND
  k.idtienda = '$idtienda'

";
        $cantidadventaA12 = findBySqlReturnCampoUnique($sql4, true, true, "idcalzado");
        $idcalzado = $cantidadventaA12['resultado'];

        // echo $cantidad."=>";
    //   function getSqlNewItemventa($iditemventa, $cantidad, $precio, $tipocambio, $descuento, $descuentoporcentaje, $total, $numero, $idcalzado, $idventa, $idempleado, $idkardextienda, $saldo, $return){

 $sql[] =getSqlNewItemventa($iditemventa, $cantidad, $precio, $tipocambio, $descuentounidad, $descuentoporcentaje, $total, $numerodetalletraspaso, $idcalzado, $idventadetalle, $idempleado, $idkardextienda, "0.00",$estado, false);

      //  $sql[] =getSqlNewItemventa($iditemventa, $cantidad, $precio,"0.00" , $descuento, $descuentoporcentaje, $total, $numeroit, $idcalzado, $idventa, $idempleado, $idkardextienda, "0.00", false);
       // $numeroit = $numeroit + 1 +$i;

        $movimiento[$i]["idkardextienda"]=$idkardextienda;
        $movimiento[$i]["idtienda"]=$idtienda;

        $movimiento[$i]["cantidad"]=$cantidad;
        $movimiento[$i]["precio"] = $precio;

        $movimiento[$i]["fecha"]=$fecha;
        $movimiento[$i]["hora"]=$hora;

           }
        }

  //            MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {


        for ($k = 0 ; $k < count($movimiento) ; $k++) {

            $movimiento[$k]["idkardextienda"];
            $movimiento[$k]["idtienda"];
            $movimiento[$k]["cantidad"];
           // $movimiento[$k]["precio"];
            $movimiento[$k]["fecha"];
            $movimiento[$k]["hora"];


            salidamovientomoventaalmacen($movimiento[$k]["idtienda"],$movimiento[$k]['idkardextienda'],$movimiento[$k]['cantidad'],$movimiento[$k]['fecha'],$movimiento[$k]['hora'],$idventadetalle,false);

            //
            actualizarSaldoMovimientoalmacen($idtienda,$movimiento[$k]['idkardextienda'],$movimiento[$k]['fecha'],$movimiento[$k]['hora'], false);

        }

        $dev['mensaje'] = "Se guardo la venta correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idventadetalle;
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

function  BuscarEmpresaCobradorClienteTienda2ojo($idempresa, $return = false){

   

   // $proveedores = ListarClientePorId('', '', '', '', '', '',"$idempresa",true);
       
   
    //$categorias = ListarCreditosPorId('', '', '', '', '', '',"$idempresa",true);
       
    
    $cliente = ListarEmpleadosCobrador('', '', '', '', '', '','',true);
    $empleado = ListarTiendas('', '', '', '', '', '','',true);
         
        $dev['empleadoM'] = $cliente['resultado'];
        $dev['tiendaM'] = $empleado['resultado'];
$value['usuariosM'] = $usr["resultado"];
    
    $anio = date("Y");
    $mes = date("m")-1;
    $dev['planilla'] = $mes."/".$anio;
   
    $dev['error'] = "true";
    $dev['mensaje'] = "Se recuperaron correctamente los objetos";
$json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
    $sql ="
SELECT e.idempresa, e.codigo, e.nombre, e.responsable,e.telefono,e.direccion, e.comision, c.nombre AS ciudad, e.estado
FROM empresas e, ciudades c
WHERE e.idciudad = c.idciudad
AND e.estado = 'Activo'
AND e.idempresa = '$idempresa'

";
    //echo $sql;
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
                        $dev['mensaje'] = "La empresa no se encuentar activa";
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

function ListarTiendas($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  emp.idtienda,
  emp.nombre
FROM
  `tiendas` emp
 $order LIMIT $start,$limit

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

function ListarClientePorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
 idclienteempresa AS idcliente,
codigo,
nombre,apellido,
item
FROM
  clienteempresa
WHERE
  idempresa = '$where'
AND estado='Activo';

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
function ListarCreditosPorId($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
 idpagocredito,idcliente,idempresa,monto

FROM
  pagocredito
WHERE
  idempresa = '$where'
AND validado='SI';

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
function GuardarComision($idempresa){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $comision = $_GET['comision'];

//    $codigoB = TamanoPermitido($codigo, 6);
//    if($codigoB['error']==false){
//        $dev['mensaje'] = "error en el campo Codigo :".$codigoB['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
    $recibo=$_GET['recibo'];
$sql1 = "
SELECT
  responsable,comision,idempleado,mes_planillla
FROM
  empresas
WHERE
  idempresa = '$idempresa'

";
        $empleadoA1 = findBySqlReturnCampoUnique($sql1, true, true, "responsable");
        $idcliente = $empleadoA1['resultado'];
        $empleadoA2 = findBySqlReturnCampoUnique($sql1, true, true, "comision");
        $porcentajecomision = $empleadoA2['resultado'];
        $empleadoA3 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
        $idempleado = $empleadoA3['resultado'];
        $empleadoA4 = findBySqlReturnCampoUnique($sql1, true, true, "mes_planillla");
        $mes_planilla = $empleadoA4['resultado'];
        $numeroT = findUltimoID("comisiones", "numero", true);
        $numero = $numeroT['resultado']+1;
        $idcomision = 'com-'.$numero;
        $fecharegistro = date("Y-m-d");

 $sql[] = getSqlNewComisiones($idcomision, $idempresa, $idcliente, $idempleado, $mes_planilla, $numero, $comision, $recibo,$porcentajecomision, $fecharegistro, $observacion, $return);

     //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro la comision correctamente";
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


function finddatoscredito()
{
    $ciudad = findAllCiudad(0, 0, "nombre", "ASC", "", "", true, true);
   // $sucursal = findAllSucursal(0, 0, "nombre", "ASC", "", "", true, true);
    $almacen = ListarTiendas('', '', '', '', '', '','',true);
    $categoria = ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);
    $subcategoria =  Listarempresas('', '', '', '', '', '',"",true);
   // $carac  =  findAllCaracteristica(0, 0, "nombre", "ASC", "", "", true, true);

    $dev['error'] = "true";
    $dev['mensaje'] = "Se recuperaron correctamente los objetos";
    $dev['ciudadM'] = $ciudad['resultado'];
    //$dev['sucursalM'] = $sucursal['resultado'];
    $dev['tiendaM'] = $almacen['resultado'];
    $dev['clienteM'] = $categoria['resultado'];
    $dev['empresaM'] = $subcategoria['resultado'];
    //$dev['caracteristicaM'] = $carac['resultado'];
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}
function buscarciudad($callback, $_dc, $where = '', $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $cliente = ListarEmpleadosCobrador('', '', '', '', '', '','',true);
    if($cliente["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }



     if(($ciudad["error"]==true)||($cliente["error"]==true)){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
       $value['empleadoM'] = $cliente['resultado'];
        $value["ciudadM"] = $ciudad['resultado'];
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
function  BuscarEmpleadoEmmpresaop()
{
    $categoria = ListarClienteEmpresaActivo('', '', '', '', '', '', '', true);
    $subcategoria =  Listarempresas('', '', '', '', '', '',"",true);
   // $carac  =  findAllCaracteristica(0, 0, "nombre", "ASC", "", "", true, true);

    $dev['error'] = "true";
    $dev['mensaje'] = "Se recuperaron correctamente los objetos";
    $dev['clienteM'] = $categoria['resultado'];
    $dev['empresaM'] = $subcategoria['resultado'];
    //$dev['caracteristicaM'] = $carac['resultado'];
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}
function BuscarEmpresa(){
    $categorias = Listarempresas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['empresas'] = "true";
        $value['empresaM'] = $categorias['resultado'];
    }

    $dev['mensaje'] = "Se cargo el formulario de empresa";
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
function findAllCiudad($start, $limit, $sort, $dir, $callback, $_dc, $return, $consucursal = false)
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
    if($consucursal == "true")
    {
        if($star == 0 && $limit == 0)
        {
            $sql = "SELECT c.* FROM ciudades c $order";
        }
        else
        {
            $sql = "SELECT c.* FROM ciudades c $order LIMIT $start,$limit ";
        }
    }
    else
    {
        if($star == 0 && $limit == 0)
        {
            $sql = "SELECT * FROM ciudades $order";
        }
        else
        {
            $sql = "SELECT * FROM ciudades $order LIMIT $start,$limit ";
        }
    }
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    //$dev['totalCount'] = mysql_num_rows($re);
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
function ConsultaEmpresa(){
    $categorias = Listarempresas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['empresas'] = "true";
        $value['empresaM'] = $categorias['resultado'];
    }
    $anio = date("Y");
    $mes = date("m");
    $planilla = $mes."/".$anio;



$value['planilla'] = $planilla;
    $dev['mensaje'] = "Se cargo el formulario de empresa";
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
function Listarempresas($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  idempresa,codigo,nombre AS nombreempresa,responsable,comision,idciudad,estado
FROM
  empresas
WHERE
  estado='Activo' AND idempresa!='epr-0' AND codigo!='Sin Codigo'
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
function ListarCobrostienda($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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

    if($where == null || $where == "")
    {
        $sql = "
SELECT pc.idpagocredito, pc.fecha,t.nombre AS tienda, e.nombre AS empresa, CONCAT( ce.nit, '-', ce.nombre, '-', ce.apellido ) AS cliente, CONCAT( em.nombres, '-', em.apellidos ) AS encargado, pc.monto, pc.observacion
FROM `pagocredito` pc, `tiendas` t, `empresas` e, `clienteempresa` ce, `empleados` em
WHERE pc.idtienda = t.idtienda
AND pc.idempresa = e.idempresa
AND e.idempresa = ce.idempresa
AND pc.idcliente = ce.idclienteempresa
AND pc.idempleado = em.idempleado AND pc.arqueo='0'$order LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
    SELECT pc.idpagocredito, pc.fecha,t.nombre AS tienda, e.nombre AS empresa, CONCAT( ce.nit, '-', ce.nombre, '-', ce.apellido ) AS cliente, CONCAT( em.nombres, '-', em.apellidos ) AS encargado, pc.monto, pc.observacion
FROM `pagocredito` pc, `tiendas` t, `empresas` e, `clienteempresa` ce, `empleados` em
WHERE pc.idtienda = t.idtienda
AND pc.idempresa = e.idempresa
AND e.idempresa = ce.idempresa
AND pc.idcliente = ce.idclienteempresa
AND pc.idempleado = em.idempleado AND pc.arqueo='1' AND $where $order LIMIT $start,$limit
         ";
        //        MostrarConsulta($sql);
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

function findAllAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $return)
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
    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT * FROM tiendas $order";
    }
    else
    {
        $sql = "SELECT * FROM tiendas $order LIMIT $start,$limit ";
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
function BuscarClienteEmpresa($callback, $_dc, $return)
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

function getSqlNewComisiones($idcomision, $idempresa, $idresponsable, $idempleado, $mes_planilla, $numero, $montocomision, $recibo, $porcentajecomision, $fecharegistro, $observacion, $return){
$setC[0]['campo'] = 'idcomision';
$setC[0]['dato'] = $idcomision;
$setC[1]['campo'] = 'idempresa';
$setC[1]['dato'] = $idempresa;
$setC[2]['campo'] = 'idresponsable';
$setC[2]['dato'] = $idresponsable;
$setC[3]['campo'] = 'idempleado';
$setC[3]['dato'] = $idempleado;
$setC[4]['campo'] = 'mes_planilla';
$setC[4]['dato'] = $mes_planilla;
$setC[5]['campo'] = 'numero';
$setC[5]['dato'] = $numero;
$setC[6]['campo'] = 'montocomision';
$setC[6]['dato'] = $montocomision;
$setC[7]['campo'] = 'recibo';
$setC[7]['dato'] = $recibo;
$setC[8]['campo'] = 'porcentajecomision';
$setC[8]['dato'] = $porcentajecomision;
$setC[9]['campo'] = 'fecharegistro';
$setC[9]['dato'] = $fecharegistro;
$setC[10]['campo'] = 'observacion';
$setC[10]['dato'] = $observacion;
$sql2 = generarInsertValues($setC);
return "INSERT INTO comisiones ".$sql2;
}

?>