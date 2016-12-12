<?php
function listarcliente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{
    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 800;
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
        $sql = "
SELECT
c.idclienteempresa,
c.codigo,
 c.nombre,
 c.apellido,
  c.nit,
  c.estado,
  c.item,
c.saldoactual,
  emp.nombre AS empresa,
  c.idempresa
 
FROM
  clienteempresa c,
  empresas emp
 
WHERE
  c.idempresa = emp.idempresa  $order LIMIT $start,$limit ";

    }
    else
    {
        $sql = "
SELECT
c.idclienteempresa,
c.codigo,
 c.nombre,
 c.apellido,
  c.nit,
  c.estado,
  c.item,
c.saldoactual,
  emp.nombre AS empresa,
  c.idempresa
 
FROM
  clienteempresa c,
  empresas emp
 
WHERE
  c.idempresa = emp.idempresa AND $where $order LIMIT $start,$limit ";
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
function listarempresas($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  tcl.idempresa,
  tcl.nombre
FROM
  `empresas` tcl WHERE tcl.idempresa!='epr-0'

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

//function BuscarEmpresa($start, $limit, $sort, $dir, $callback, $_dc, $return)
function BuscarEmpresa($callback, $_dc, $where = '', $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $empresa = listarempresas("", "", "", "", "", "", "", true);
    if($empresa['error']==false){
        $dev['mensaje'] = "No se pudo encontrar Tipos";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }

    if(($empresa["error"]==true)){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
        $value["empresaM"] = $empresa['resultado'];
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
function buscarempresas($start, $limit, $sort, $dir, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $empresa = listarempresas("", "", "", "", "", "", "", true);

    //$comunidad = listarcomunidad(0, 0, "", "", "", "", true);
    if($empresa['error'] == true)
    {
        $value['empresas'] = "true";
        $value['empresaM'] = $empresa['resultado'];
    }
   
    $dev['error']   = "true";

    $dev['resultado'] = $value;
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
function getSqlNewClienteempresa($idclienteempresa, $codigo, $nombre, $apellido, $nit, $direccion, $telefono, $mail, $referencia, $idempresa, $estado, $item, $numero,$saldoanterior,$saldoactual, $return){
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
$setC[13]['campo'] = 'saldoanterior';
$setC[13]['dato'] = $saldoanterior;
$setC[14]['campo'] = 'saldoactual';
$setC[14]['dato'] = $saldoactual;
$sql2 = generarInsertValues($setC);
return "INSERT INTO clienteempresa ".$sql2;
}

function getSqlNewCuenta($idcuenta, $idcliente, $codigo, $fecha, $hora, $montoinicial, $montoactual, $estado, $idalmacen, $numero, $return){
    $setC[0]['campo'] = 'idcuenta';
    $setC[0]['dato'] = $idcuenta;
    $setC[1]['campo'] = 'idcliente';
    $setC[1]['dato'] = $idcliente;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'fecha';
    $setC[3]['dato'] = $fecha;
    $setC[4]['campo'] = 'hora';
    $setC[4]['dato'] = $hora;
    $setC[5]['campo'] = 'montoinicial';
    $setC[5]['dato'] = $montoinicial;
    $setC[6]['campo'] = 'montoactual';
    $setC[6]['dato'] = $montoactual;
    $setC[7]['campo'] = 'estado';
    $setC[7]['dato'] = $estado;
    $setC[8]['campo'] = 'idalmacen';
    $setC[8]['dato'] = $idalmacen;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO cuenta ".$sql2;
}
function insertnuevocliente($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idcliente = $resultado->idcliente;
    $nombre = $resultado->nombre;
    $apellido = $resultado->apellido;
    $nit = $resultado->nit;
    $telefono = $resultado->telefono;
    $direccion = $resultado->direccion;
    $estado  =$resultado->estado;
    $item =  $resultado->item;
    $idempresa = $resultado->idempresa;
    $fecharegistro = date("Y-m-d");

    $nombresA   = validarTextSpace($nombre, true);
    $apellido1A = validarTextSpace($apellido, true);
    $nitA = validarEntero($nit, false);
    //$telefonoA = validarEntero($telefono, false);

   //$direccionA = validarTextNumericSpace($direccion, true);
    $itemA = validarTextNumericSpace($item, true);

    //    $idalmacen = $_SESSION['idalmacen'];
    $estadoA    = validarText($estado, true);


    // $nombreA = validarText($nombre, true);
    if($nombresA['error'] == false){
        $dev['mensaje'] = "Error en el campo nombres: ".$nombresA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    // $apellido1A =validarText($apellido1, true);
    if($apellido1A['error'] == false){

        $dev['mensaje'] = "Error en el campo apellido paterno: ".$apellido1A['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
//    if($telefonoA['error'] == false)
//    {
//        $dev['mensaje'] = "Error en el campo Telefono: ".$telefonoA['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
//    if($direccionA['error'] == false)
//    {
//        $dev['mensaje'] = "Error en el campo direccion: ".$direccionA['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
    if($nitA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo NIT: ".$nitA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($estadoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Estado: ".$estadoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
   $estado='ACTIVO';
    $email=$_GET['email'];
    $numeroA = findUltimoID("clienteempresa", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idclienteempresa = $numero;
     $idtienda = $_SESSION['idtienda'];
     $codigo = $idtienda.$numero;
    $sql[]=getSqlNewClienteempresa($idclienteempresa, $codigo, $nombre, $apellido, $nit, $direccion, $telefono, $mail, $referencia, $idempresa, $estado, $item, $numero,$saldoanterior,$saldoactual, $return);
//$sql4= "SELECT
//              mes_planillla
//            FROM
//              empresas
//            WHERE
//              idempresa = '$idempresa'";
//    //    echo $sql4;
//    $result = findBySqlReturnCampoUnique($sql4, true, true, "mes_planillla");
//
//    $mesplanilla = $result['resultado'];
//
//    $numeroPla = findUltimoID("planillaemitida", "numero", true);
//                $numeropla = $numeroPla['resultado'] +1;
//                $idplanillaemitida="pe-".$numeropla;
//                 $idsCAr = split("/", $mesplanilla);
//$mesplani=$idsCAr[0];
//$anioplani=$idsCAr[1];
//
//    if($anioplani == $anio) {
// $mes1=$mesplanilla;
//    $mesp=$mesplani+1;
// $mes2="0".$mesp."/".$anio;
//    $mesp2=$mesplani+2;
// $mes3="0".$mesp2."/".$anio;
//    $mesp4=$mesplani+3;
// $mes4="0".$mesp4."/".$anio;
//    $mesp5=$mesplani+4;
// $mes5="0".$mesp5."/".$anio;
//    $mesp6=$mesplani+5;
// $mes6="0".$mesp6."/".$anio;
//    $mesp7=$mesplani+6;
// $mes7="0".$mesp7."/".$anio;
//    }
//   $sql[] = getSqlNewPlanillaemitida($idplanillaemitida, $mesplanilla, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora,"0.00","0", $mes1, "0.00", "0.00", $mes2, "0.00", "0.00", $mes3, "0.00", "0.00", $mes4, "0.00","0.00", $mes5, "0.00", "0.00", $mes6, "0.00", "0.00", $mes7, "0.00", "0.00","0.00", $emitido, "0", "N",$numeropla, false);
//
//$numeroPla1 = findUltimoID("movimientoplanilla", "numero", true);
//                $numero = $numeroPla1['resultado'] +1;
//$sql[] = getSqlNewMovimientoplanilla($numero, $idplanillaemitida, $mesplanilla, $idempresa, $fecha, "registro", $emitido, $tiempo, $ventaoriginal, "SS", "E",  false);

    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardo correctamente el CLIENTE";
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
function buscarclienteporid($idcliente,$callback, $_dc, $return= 'true'){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

$almacen = listarempresas("", "", "", "", "", "", "", true);

    if($almacen["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }

    if($almacen["error"]==true){
        $value['empresas'] = "true";
        $value["empresaM"] = $almacen['resultado'];

    }


    $sql = "SELECT c.idclienteempresa, c.nombre, c.apellido, c.nit, c.telefono, c.mail, c.direccion, c.idempresa, c.estado, c.item, c.numero, emp.nombre AS empresa
FROM clienteempresa c, empresas emp
WHERE c.idempresa = emp.idempresa
AND c.idclienteempresa ='$idcliente' GROUP BY (c.idclienteempresa)";
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
function modificarcliente($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idclienteempresa = $resultado->idclienteempresa;
    $nombre = $resultado->nombre;
    $apellido = $resultado->apellido;
    $nit = $resultado->nit;
    $telefono = $resultado->telefono;
    $direccion = $resultado->direccion;
    $estado  =$resultado->estado;
    $item =  $resultado->item;
    $idempresa = $resultado->idempresa;
    $fecharegistro = date("Y-m-d");

    $nombresA   = validarTextSpace($nombre, true);
    $apellido1A = validarTextSpace($apellido, true);
    $nitA = validarEntero($nit, false);
    $telefonoA  = validarEntero($telefono, false);
    $direccionA = validarTextNumericSpace($direccion, true);
    $estadoA    = validarText($estado, true);


    // $nombreA = validarText($nombre, true);
    if($nombresA['error'] == false){

        $dev['mensaje'] = "Error en el campo nombres: ".$nombresA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    // $apellido1A =validarText($apellido1, true);
    if($apellido1A['error'] == false){
        $dev['mensaje'] = "Error en el campo apellido paterno: ".$apellido1A['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($telefonoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Telefono: ".$telefonoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($direccionA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo direccion: ".$direccionA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($nitA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo NIT: ".$nitA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    
    if($estadoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Estado: ".$estadoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    //    $idultimoclienteA = findUltimoIDalmacen("cliente", "numero",$idalmacen, true);
    //    $numero = $idultimoclienteA['resultado'] +1;
    //    $idcliente = "cli-".$numero;
    // $nombreA = validarText($nombre, true);
//    if($idtipocliente=="tcl-1002"){
//
//        $idultimocuentaA = findUltimoIDalmacen("cuenta", "numero",$idalmacen, true);
//        $numero1 = $idultimocuentaA['resultado'] +1;
//        $idcuenta = "cue-".$numero1;
//        $fecha = Date("Y-m-d");
//        $hora = Date("H:i:s");
//        $montoinicial = 0;
//        $montoactual = 0;
//        $estadoCuenta = "nueva cuenta";
//        $codigo = Date("Y/m").":".$numero1."/".$idalmacen;
//        $sql[]=getSqlNewCuenta($idcuenta, $idcliente, $codigo, $fecha, $hora, $montoinicial, $montoactual, $estadoCuenta, $idalmacen, $numero1, $return);
//    }
//    if($idtipocliente != "tcl-1002"){
//        $sql[]= getSqlDeleteCuenta($idcliente,$idalmacen);
//    }

    $sql[]=getSqlUpdateClienteempresa($idclienteempresa,$codigo,$nombre,$apellido,$nit,$direccion,$telefono,$mail,$referencia,$idempresa,$estado,$item,$numero, $return);

       // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se modifico  correctamente el cliente";
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

function getSqlUpdateClienteempresa($idclienteempresa,$codigo,$nombre,$apellido,$nit,$direccion,$telefono,$mail,$referencia,$idempresa,$estado,$item,$numero, $return){
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
$setC[10]['campo'] = 'idempresa';
$setC[10]['dato'] = $idempresa;
$setC[11]['campo'] = 'numero';
$setC[11]['dato'] = $numero;

$set = generarSetsUpdate($setC);
$wher[0]['campo'] = 'idclienteempresa';
$wher[0]['dato'] = $idclienteempresa;


$where = generarWhereUpdate($wher);
return "UPDATE clienteempresa SET ".$set." WHERE ".$where;
}




function getSqlDeleteCuenta($idcliente,$idalmacen){
    return "DELETE FROM cuenta WHERE idcliente = '$idcliente' AND idalmacen = '$idalmacen';";
}
function eliminarcliente($idcliente,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $sql[] = getSqlDeleteCliente($idcliente);
    //$sql[] =getSqlDeleteCuenta($idcliente,$idalmacen);
    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el usuario correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar un usuario";
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
?>