<?php
function Listaringresomuestras($start, $limit, $sort, $dir, $callback, $_dc, $return, $idmarca,$coleccion)
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
//       $formatear = explode( '/' , $fechafin);
//$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];


     $idalmacen = $_SESSION['idalmacen'];
    //$select ="cl.idclienteempresa, CONCAT( cl.nombre, '-', cl.apellido ) AS cliente, pc.ventaoriginal AS credito, pc.pago1 AS mes1, SUM( pa.monto ) AS cobro1, pc.pago2 AS mes2, 0 AS cobro2, SUM( pc.pago3 + pc.pago4 + pc.pago5 + pc.pago6 + pc.pago7 ) AS mes3, 0 AS cobro3, 0 AS total, em.codigo AS cobrador";
    $select ="mu.idmuestra,mu.codigo,mu.detalle,mu.pares,mu.unidades ,mu.almacen1 AS izquierdos,mu.estado";
    $from = "muestra mu";
    $where = "almacen1 LIKE '%$idalmacen'
OR almacen2 LIKE '%$idalmacen' OR almacen3 LIKE '%$idalmacen'";
        if($idmarca != null && $idmarca != "")
    {
        $where .= " AND mu.idmarca ='$idmarca' ";

    }
if($coleccion != null && $coleccion != "")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $where .= " AND mu.coleccion = '$coleccion' ";
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

function GuardarNuevoMuestra($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $numeroA = findUltimoID("muestras", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idmuestraprincipal="mu-".$numero;

  $ingreso = $resultado->ingreso;
  $idmarca = $ingreso->idmarca;
  $marca = $ingreso->marca;
 $fecha = $ingreso->fecha;
$coleccion = $ingreso->coleccion;
 $sqlcoleccion = "
SELECT
  mar.idcoleccion
FROM
 coleccion mar
WHERE
  mar.idmarca = '$idmarca' AND mar.estado='VIGENTE'
";
 $opcionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
    $idcoleccion = $opcionA['resultado'];
 $numeropedido = $ingreso->nuevomodelo;
    $estado = "ACTIVO";
    $hora = date("H:i:s");
   // $fecha = date("Y-m-d");
    $totalpares = $ingreso->totalpares;
    $totalunidades = $ingreso->totalunidades;
    $observacion = $ingreso->descripcion;
    $contador = $ingreso->contador;
    $idempleado = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
$idoficina = $ingreso->idoficina;//izquierdo
$idoficina1 = $ingreso->idoficina1;//derecho
$idoficina2 = $ingreso->idoficina2;
$idoficina3 = $ingreso->idoficina3;
$idoficina4 = $ingreso->idoficina4;
$idoficina5 = $ingreso->idoficina5;
$idoficina6 = $ingreso->idoficina6;
$idoficina7 = $ingreso->idoficina7;

    $responsable = $_SESSION['idusuario'];
   $sql[]=getSqlNewMuestras($idmuestraprincipal, $idmarca, $idcoleccion, $idalmacen, $idempleado, $observacion, $totalpares, $totalunidades, $contador, $fecha, $hora, $numero, $estado, $coleccion, $return);

  //  $sql[]=getSqlNewPedidos($idpedido, $idmarca, $fecha, $observacion, $totalpares, $totalcajas, $numeropedido, $responsable, $estado, $numero, $hora, $np, $return);
    //    $sql[]=getSqlNewIngresotienda($idingreso, $codigo, $numero, $estado, $fecha, $hora, $totalpares, $totalbs, $responsable, $observacion, $idmarca, $idtienda, false);
    //    echo $idventa;

    $calzados = $resultado->calzados;
    $numeroD = findUltimoID("muestra", "numero", true);
    $numeromuestra = $numeroD['resultado'] +1;

   $numeroD2 = findUltimoID("imparkar_alm_1", "numero", true);
    $numerokardex2 = $numeroD2['resultado'] +1;

$numeroD3 = findUltimoID("imparkar_alm_2", "numero", true);
    $numerokardex3 = $numeroD3['resultado'] +1;

$numeroD4 = findUltimoID("imparkar_alm_3", "numero", true);
    $numerokardex4 = $numeroD4['resultado'] +1;

for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $codigocalzado = $calzado->codigo;
        $idmodelo = $calzado->idmodelo;
        $detalle = $calzado->detalle;
        $pares = $calzado->pares;
        $unidades = $calzado->unidades;
        $cantoficina = $calzado->oficina;
        $cantoficina1 = $calzado->oficina1;
        $cantoficina2 = $calzado->oficina2;
        $cantoficina3 = $calzado->oficina3;
        $cantoficina4 = $calzado->oficina4;
        $cantoficina5 = $calzado->oficina5;
        $cantoficina6 = $calzado->oficina6;
        $cantoficina7 = $calzado->oficina7;
        //        $precio = $calzado->precio;
        $idmuestradetalle = "mue-".$numeromuestra;
       $sql[] = getSqlNewMuestra($idmuestradetalle, $idmuestraprincipal, $idcoleccion, $coleccion, $responsable, $codigo, $cantidadcaja, $cantidadpares, $numeromuestra, $cantoficina/$idoficina, $cantoficina1/$idoficina1, $cantoficina2/$idoficina2, $cantoficina3/$idoficina3, $cantoficina4/$idoficina4, $cantoficina5/$idoficina5, $cantoficina6/$idoficina6, $cantoficina7/$idoficina7, $cantoficina8/$idoficina8,$return);

       // $sql[] = getSqlNewDetallepedido($iddetallepedido, $numerocajas, $numeropares, $cliente, $vendedor, $idmodelo, $numerodetalle, $color, $material, 0, 0, $stylename, $linea,$idpedido,$codigocalzado,"","", $return);
        //        $sql[] =getSqlNewDetalleingreso($idmodelo, $numeropares, $numerocajas, $idingreso, $iddetalleingreso, $numerodetalle, false);
        $numeromuestra++;
        //        $codigobarraA = ObtenerCodigoBarraMarcaDetalle($idmarca , true);
        //        $codigobarramcn = $codigobarraA['resultado'];
        //        echo $codigobarramcn;
       // $americano = $calzado->opcion;
//       $formatear = explode( '/' , $fechafin);
//$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];

        if($idoficina == 'alm-2'){//izq
  $saldocantidadunidad=$cantoficina;
   $saldocantidadizq=$cantoficina;
   $izquierdos=$cantoficina;
$idkardexalmacen = "kar-".$numerokardex2;
$sql[] =  getSqlNewImparkar_alm_1($idkardexalmacen, $idmodelo, $idmarca, $detalle, $saldocantidadunidad, $saldocantidadizq, $saldocantidadder, $izquierdos, $derechos, $numero, $idmuestradetalle, $confirmado, $return);
$numerokardex2++;

$numeroKardexA = findUltimoIDforanyway("movimientokardex", "numero", "idproducto", $idproducto, true);
        $numerokardex = $numeroKardexA['resultado'] +1;
        $idmovimientokardex = "mok-".$numerokardex;
$sql[] = getSqlNewMovimientokardex($idmovimientokardex, $idproducto, $cantidad, 0, 0, $total*$cambio ,0 , 0, $idcompra, $fecha, $hora , $numerokardex, $preciosusu2*$cambio, $tipo, $cantidad,false);

		$movimiento[$i]["idproducto"] = $idproducto;
        $movimiento[$i]["fecha"] = $fecha;

        $movimiento[$i]["hora"] = $hora;
        $kardex[$i]["idproducto"] = $fecha;
        $movimiento[$i]["idalmacen"] = $idalmacen;
        $movimiento[$i]["cantidad"] = $cantidad;
        $movimiento[$i]['precio1'] = $preciosusu2;
        $movimiento[$i]['precio2'] = $preciocomprabs;

        }
           if($idoficina1 == 'alm-3'){//izq
  $saldocantidadunidad=$cantoficina1;
   $saldocantidadder=$cantoficina1;
   $derechos=$cantoficina1;
$idkardexalmacen = "kar-".$numerokardex3;
$sql[] =  getSqlNewImparkar_alm_1($idkardexalmacen, $idmodelo, $idmarca, $detalle, $saldocantidadunidad, $saldocantidadizq, $saldocantidadder, $izquierdos, $derechos, $numero, $idmuestradetalle, $confirmado, $return);
$numerokardex3++;
        }

    }

    //        MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = $idingreso;
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
function  BuscarModeloLineaPorMarca($idmarca,$oficina,$oficina1,$oficina2,$oficina3,$oficina4,$oficina5,$oficina6,$oficina7,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "false";
    $dev['resultado'] = "";
    $modelo = BuscarModeloPorMarcaColeccionVigente($idmarca, true);
    if($modelo['error'] == true){
        $value['modelos'] = "true";
        $value['modeloM'] = $modelo['resultado'];
    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numeropedido'] = $numero."/".$anio;
    //String cont = "";
   
    $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina' ";
      $detalleA = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina =  $detalleA['resultado'];
      
      $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina1' ";
      $detalleA1 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina1 =  $detalleA1['resultado'];

       $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina2' ";
      $detalleA2 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina2 =  $detalleA2['resultado'];

         $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina3' ";
      $detalleA3 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina3 =  $detalleA3['resultado'];

       $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina4' ";
      $detalleA4 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina4 =  $detalleA4['resultado'];

       $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina5' ";
      $detalleA5 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina5 =  $detalleA5['resultado'];

        $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina6' ";
      $detalleA6 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina6 =  $detalleA6['resultado'];

       $sql1 ="SELECT ma.codigo AS nombre,ma.idalmacen FROM almacenes ma WHERE ma.idalmacen = '$oficina7' ";
      $detalleA7 = findBySqlReturnCampoUnique($sql1, true, true, "nombre");
        $nomoficina7 =  $detalleA7['resultado'];

   if($nomoficina != null || $nomoficina != "")
   { $contador="1"; }else {$nomoficina="alm-1"; }
   if($nomoficina1 != null || $nomoficina1 != "")
   { $contador="2"; }
     if($nomoficina2 != null || $nomoficina2 != "")
   { $contador="3"; }else {$nomoficina2="-"; }
 if($nomoficina3 != null || $nomoficina3 != "")
   { $contador="4"; }else {$nomoficina3="-"; }
    if($nomoficina4 != null || $nomoficina4 != "")
   { $contador="5"; }else {$nomoficina4="-"; }
    if($nomoficina5 != null || $nomoficina5 != "")
   { $contador="6"; }else {$nomoficina5="-"; }
    if($nomoficina6 != null || $nomoficina6 != "")
   { $contador="7"; }else {$nomoficina6="-"; }
   if($nomoficina7 != null || $nomoficina7 != "")
   { $contador="8"; }else {$nomoficina7="-"; }
 //$contador="1";
   //   echo $nomoficina;
 $value['contador'] = $contador;
       $value['nomofi'] =  $nomoficina;
      $value['nomofi1'] =  $nomoficina1;
$value['nomofi2'] =  $nomoficina2;
$value['nomofi3'] = $nomoficina3;
$value['nomofi4'] = $nomoficina4;
$value['nomofi5'] = $nomoficina5;
$value['nomofi6'] = $nomoficina6;
$value['nomofi7'] =  $nomoficina7;

   $sql ="
SELECT
  ma.idmarca,
  ma.codigo,
  ma.nombre,
  ma.opcion
FROM
  marcas ma
WHERE
  ma.idmarca = '$idmarca'

";
    //echo $sql;
    if($idmarca != null)
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
function BuscarMarcaAlmacenColeccion(){
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
    $categoriasA = ListarAlmacen('', '', '', '', '', '',"",true);
    if($categoriasA['error'] == true)
    {
        $value['almacen'] = "true";
        $value['almacenM'] = $categoriasA['resultado'];
    }
$sqlcoleccion = "
SELECT
  mar.codigo
FROM
 coleccion mar
WHERE
  mar.idmarca = '$idmarca' AND mar.estado='VIGENTE'
";
 $opcionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "codigo");
    $idcoleccion = $opcionA['resultado'];
$anio = date("Y");
    $mes = date("m");
    $planilla = $mes."-".$anio;
$value['coleccion'] = $planilla;
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
function ListarMuestras($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
SELECT mue.idmuestra, ma.nombre AS marca, mue.totalpares AS pares, mue.totalcalzados AS unidades, mue.estado, usr.nombre AS responsable, col.codigo AS coleccion
FROM muestras mue, marcas ma, usuario usr, coleccion col
WHERE mue.idmarca = ma.idmarca
AND mue.responsable = usr.idusuario
AND mue.idcoleccion = col.idcoleccion
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
function getSqlNewMuestras($idmuestra, $idmarca, $idcoleccion, $idalmacen, $idusuario, $observacion, $totalpares, $totalcalzados, $responsable, $fecha, $hora, $numero, $estado, $coleccion, $return){
$setC[0]['campo'] = 'idmuestra';
$setC[0]['dato'] = $idmuestra;
$setC[1]['campo'] = 'idmarca';
$setC[1]['dato'] = $idmarca;
$setC[2]['campo'] = 'idcoleccion';
$setC[2]['dato'] = $idcoleccion;
$setC[3]['campo'] = 'idalmacen';
$setC[3]['dato'] = $idalmacen;
$setC[4]['campo'] = 'idusuario';
$setC[4]['dato'] = $idusuario;
$setC[5]['campo'] = 'observacion';
$setC[5]['dato'] = $observacion;
$setC[6]['campo'] = 'totalpares';
$setC[6]['dato'] = $totalpares;
$setC[7]['campo'] = 'totalcalzados';
$setC[7]['dato'] = $totalcalzados;
$setC[8]['campo'] = 'responsable';
$setC[8]['dato'] = $responsable;
$setC[9]['campo'] = 'fecha';
$setC[9]['dato'] = $fecha;
$setC[10]['campo'] = 'hora';
$setC[10]['dato'] = $hora;
$setC[11]['campo'] = 'numero';
$setC[11]['dato'] = $numero;
$setC[12]['campo'] = 'estado';
$setC[12]['dato'] = $estado;
$setC[13]['campo'] = 'coleccion';
$setC[13]['dato'] = $coleccion;
$sql2 = generarInsertValues($setC);
return "INSERT INTO muestras ".$sql2;
}


function getSqlNewMuestra($idmuestra, $idmuestrageneral, $idcoleccion, $coleccion, $responsable, $codigo, $cantidadcaja, $cantidadpares, $numero, $almacen1, $almacen2, $almacen3, $almacen4, $almacen5, $almacen6, $almacen7, $almacen8, $almacen9, $return){
$setC[0]['campo'] = 'idmuestra';
$setC[0]['dato'] = $idmuestra;
$setC[1]['campo'] = 'idmuestrageneral';
$setC[1]['dato'] = $idmuestrageneral;
$setC[2]['campo'] = 'idcoleccion';
$setC[2]['dato'] = $idcoleccion;
$setC[3]['campo'] = 'coleccion';
$setC[3]['dato'] = $coleccion;
$setC[4]['campo'] = 'responsable';
$setC[4]['dato'] = $responsable;
$setC[5]['campo'] = 'codigo';
$setC[5]['dato'] = $codigo;
$setC[6]['campo'] = 'cantidadcaja';
$setC[6]['dato'] = $cantidadcaja;
$setC[7]['campo'] = 'cantidadpares';
$setC[7]['dato'] = $cantidadpares;
$setC[8]['campo'] = 'numero';
$setC[8]['dato'] = $numero;
$setC[9]['campo'] = 'almacen1';
$setC[9]['dato'] = $almacen1;
$setC[10]['campo'] = 'almacen2';
$setC[10]['dato'] = $almacen2;
$setC[11]['campo'] = 'almacen3';
$setC[11]['dato'] = $almacen3;
$setC[12]['campo'] = 'almacen4';
$setC[12]['dato'] = $almacen4;
$setC[13]['campo'] = 'almacen5';
$setC[13]['dato'] = $almacen5;
$setC[14]['campo'] = 'almacen6';
$setC[14]['dato'] = $almacen6;
$setC[15]['campo'] = 'almacen7';
$setC[15]['dato'] = $almacen7;
$setC[16]['campo'] = 'almacen8';
$setC[16]['dato'] = $almacen8;
$setC[17]['campo'] = 'almacen9';
$setC[17]['dato'] = $almacen9;
$sql2 = generarInsertValues($setC);
return "INSERT INTO muestra ".$sql2;
}
function getSqlNewImparkar_alm_1($idkardexalmacen, $idmodelo, $idmarca, $detalle, $saldocantidadunidad, $saldocantidadizq, $saldocantidadder, $izquierdos, $derechos, $numero, $idoperacion, $confirmado, $return){
$setC[0]['campo'] = 'idkardexalmacen';
$setC[0]['dato'] = $idkardexalmacen;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'detalle';
$setC[3]['dato'] = $detalle;
$setC[4]['campo'] = 'saldocantidadunidad';
$setC[4]['dato'] = $saldocantidadunidad;
$setC[5]['campo'] = 'saldocantidadizq';
$setC[5]['dato'] = $saldocantidadizq;
$setC[6]['campo'] = 'saldocantidadder';
$setC[6]['dato'] = $saldocantidadder;
$setC[7]['campo'] = 'izquierdos';
$setC[7]['dato'] = $izquierdos;
$setC[8]['campo'] = 'derechos';
$setC[8]['dato'] = $derechos;
$setC[9]['campo'] = 'numero';
$setC[9]['dato'] = $numero;
$setC[10]['campo'] = 'idoperacion';
$setC[10]['dato'] = $idoperacion;
$setC[11]['campo'] = 'confirmado';
$setC[11]['dato'] = $confirmado;
$sql2 = generarInsertValues($setC);
return "INSERT INTO imparkar_alm_1 ".$sql2;
}


?>