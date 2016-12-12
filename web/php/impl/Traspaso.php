<?php
function buscarproductostraspaso($start, $limit, $sort, $dir, $callback, $_dc, $return, $idtraspaso)
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
//select SUM(tp.saldocantidad)AS pares,SUM(tp.preciounitario)AS pares,tp.idmodelo,m.codigo,m.color,m.material from traspasodetallepar tp,modelo m where tp.idmodelo=m.idmodelo and tp.iddetalletraspaso='tra-1015' group by tp.idmodelo

    $select = "SUM(tp.saldocantidad)AS pares,SUM(tp.preciounitario)AS precio,tp.idmodelo,m.codigo,m.color,m.material";
    $from = "traspasodetallepar tp,modelo m";
    $where = "tp.idmodelo=m.idmodelo and tp.iddetalletraspaso='$idtraspaso'";
    $sql = "SELECT ".$select." FROM ".$from." WHERE ".$where." GROUP BY tp.idmodelo";
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

function registraritemventatraspasomodelo($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
// $sql ="
//SELECT idkardexunico
//FROM kardexdetallepar
//WHERE idkardex='$idkardexcaja' and saldocantidad='1' and idmodelo='$idmodelo' ;
 $sql ="
SELECT idkardexunico
FROM kardexdetallepar
WHERE saldocantidad='1' and idmodelo='$idmodelo' ;
";
  //  echo $sql;
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
                                mysql_field_name($re, $i) == "idkardexunico";
                                $idkardexunico = $fi[$i];
                       //         echo $idplanillaemitida;
             $iditemventa =$iditemventa+1;
                  insertarparestraspaso($almacendestino,$idmodelonuevo,$idkardexcaja,$idkardexunico,$idmodelo,$idtraspaso,$idempleado,$idcliente,false);

                     }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}

function GuardarNuevoTraspasoEnvio($resultado, $return)
{$idalmacen =$_SESSION['idalmacen'];
    iniciandoinserciontraspaso($idalmacen,true);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
     $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
   $fecha2=time();
   $hora= date("H:i:s",$fecha2);
   $proforma = $resultado->ingreso;
    // $ingreso = $resultado->ingreso;
    $idmarca= $proforma->idmarca;
    $boleta=$proforma->boleta;
    $fechaventa=$proforma->fecharegistro;
    //$totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;
    $almacendestino= $proforma->almacen;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;
     $tipoingreso = $proforma->tipoingreso;
     $boleta = $proforma->boleta;
     $responsable = $proforma->responsable;
     $transporte = $proforma->transporteguia;
     $idvendedor = $proforma->idvendedor;
      $calzados = $resultado->calzados;
     $sqlmarca = "SELECT idalmacen,CONCAT(nombres, '-', apellidos) AS nombrevendedor FROM empleados WHERE idempleado = '$idvendedor'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idalmacen");
    $almacendestino = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombrevendedor");
    $vendedornombre = $opcionA['resultado'];
$vendedordestino=$idvendedor;
$sql41 = "SELECT MAX(numero) AS ultimos FROM traspaso where idalmacen='$idalmacen'";
      $results = findBySqlReturnCampoUnique($sql41, true, true, "ultimos");
    $mawnumtraspaso = $results['resultado'];
$sql4 = "SELECT boleta FROM traspaso where idalmacen='$idalmacen' and numero='$mawnumtraspaso'";
      $result = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $result['resultado'] +1;

$sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
 $numeroA = findUltimoID("traspaso", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idtraspaso="tra-".$numero;

$totalpares=COUNT($calzados);
 $cantidadminima = '1';

    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;
    $arqueo="0";
    $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $periodo = $result['resultado'];
 
   $codigobarraA1 = registrartraspasoid($idtraspaso, $idalmacenorigen, $detalle, $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $vendedordestino, $transporte, $idmarca, $almacendestino, $completo,true);
                           $idtraspaso = $codigobarraA1['idtraspaso'];
   $numeroD = findUltimoID("traspasomodelo", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $calzados = $resultado->calzados;

    $numeroD = findUltimoID("modelo", "numero", true);
    $numeromodelo = $numeroD['resultado'] +1;

$numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    $numerokardexA = findUltimoID("kardexcajas", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numerokardexAt = findUltimoID("traspasodetalle", "numero", true);
    $numerotraspasodetalle = $numerokardexAt['resultado']+1;

    for($i=0;$i<count($calzados);$i++){
        $calzado = $calzados[$i];
          $iditemventa = $iditemventa + 1 ;
  $idmodelo = $calzado->idmodelo;

         switch($formatomayor){
  case '10':
if($tallakardex=="U"){$tallakardex1="34";}
if($tallakardex=="XS"){$tallakardex1="35";}
if($tallakardex=="S"){$tallakardex1="36";}
if($tallakardex=="P"){$tallakardex1="37";}
if($tallakardex=="M"){$tallakardex1="38";}
if($tallakardex=="L"){$tallakardex1="39";}
if($tallakardex=="XL"){$tallakardex1="40";}
    break;
  default:
$tallakardex1=$tallakardex;
        break;
}


 $idtraspasomodelo = "dtra-".$numerodetalle;
 $idmodelonuevo = "m-".$numeromodelo;

 $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idingreso");
    $idingreso = $saldocantidadA['resultado'];

     $sql125 = "SELECT CONCAT(a.nombre,'/',c.codigo) AS cliente FROM almacenes a,ciudades c WHERE a.idciudad=c.idciudad and a.idalmacen = '$almacendestino' ";
       $saldocantidadA1 = findBySqlReturnCampoUnique($sql125, true, true, "cliente");
    $clientenuevo = $saldocantidadA1['resultado'];
    $tipo="";

//echo "nuevooooooo";
$sql[] = getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelonuevo, $clientenuevo, $numerodetalle, $idtraspaso, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso,false);
       $numerodetalle++;
$sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, "ninguno", $fechaingreso, false);
 $numeromodelo++;

$sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
 $tipo="noexiste";
//    }
  switch($formatomayor){
  case '10':
if($tallakardex=="U"){$tallakardex="34";}
if($tallakardex=="XS"){$tallakardex="35";}
if($tallakardex=="S"){$tallakardex="36";}
if($tallakardex=="P"){$tallakardex="37";}
if($tallakardex=="M"){$tallakardex="38";}
if($tallakardex=="L"){$tallakardex="39";}
if($tallakardex=="XL"){$tallakardex="40";}
$sql12 = "SELECT cantidad FROM kardexdetalle WHERE idmodelo = '$idmodelo' and tallakardex='$tallakardex' ";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex -1;
     $sql[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where idmodelo = '$idmodelo' and tallakardex='$tallakardex';";


    break;
  default:
    $sql12 = "SELECT cantidad FROM kardexdetalle WHERE idmodelo = '$idmodelo' and tallakardex='$tallakardex' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex -1;
     $sql[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where idmodelo = '$idmodelo' and tallakardex='$tallakardex';";
   break;
}


registraritemventatraspasomodelo($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,false);

        }



 //  }
//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {    finalizandoinserciontraspaso($idtraspaso,true);
        updatetraspaso($idtraspaso);
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idtraspaso";
    }
    else
    {
       eliminarfallatraspaso($idtraspaso,false);
       finalizandoyhabilitando("traspaso",$idtraspaso,false);
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";
            
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



function registrartraspasoid($idtraspaso, $idalmacenorigen, $detalle, $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $vendedordestino, $transporte, $idmarca, $almacendestino, $completo, $return){

 $emitida="1";
 $fechareal = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
 $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];

$sql[]=getSqlNewTraspaso($idtraspaso, $idalmacenorigen, $idusuario, $detalle, $fechareal, $hora, "pendiente", $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $vendedordestino, $transporte, $idmarca, $almacendestino, $completo, "DE INVENTARIO",false);


//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
         $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idtraspaso;
          $dev['idtraspaso'] = $idtraspaso;

    }
    else
    {
        eliminarfallatraspaso($idtraspaso,false);
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = $idtraspaso;
         finalizandoyhabilitando("traspaso",$idtraspaso,true);
    }
    if($return == true)
    {   return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
    return $dev;
}
function txSaveTraspasoCaja($resultado, $return)
{   $idalmacen =$_SESSION['idalmacen'];
    iniciandoinserciontraspaso($idalmacen,true);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
     $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
   $fecha2=time()-3600;
   $hora= date("H:i:s",$fecha2);
   $proforma = $resultado->venta;
    $idmarca= $proforma->idmarca;
    $boleta=$proforma->boleta;
    $fechaventa=$proforma->fecharegistro;
    $totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;
    $almacendestino= $proforma->almacen;
    $vendedordestino= $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;

$sql41 = "SELECT MAX(numero) AS ultimos FROM traspaso where idalmacen='$idalmacen'";
      $results = findBySqlReturnCampoUnique($sql41, true, true, "ultimos");
    $mawnumtraspaso = $results['resultado'];
$sql4 = "SELECT boleta FROM traspaso where idalmacen='$idalmacen' and numero='$mawnumtraspaso'";
      $result = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $result['resultado'] +1;
    $sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
    $numeroA = findUltimoID("traspaso", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idtraspaso="tra-".$numero;

$totalpares=COUNT($product);
 $cantidadminima = '1';
if($totalpares < $cantidadminima){
            $dev['mensaje'] = "Debe traspasar por lo menos un producto par";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
        else{
    $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;
    $arqueo="0";
    $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $periodo = $result['resultado'];
    $sql[]=getSqlNewTraspaso($idtraspaso, $idalmacenorigen, $idusuario, $detalle, $fechareal, $hora, "pendiente", $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $vendedordestino, $transporte, $idmarca, $almacendestino, $completo, $observacion,false);
    $numeroD = findUltimoID("traspasomodelo", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $calzados = $resultado->calzados;
    $numeroD = findUltimoID("modelo", "numero", true);
    $numeromodelo = $numeroD['resultado'] +1;

    $numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    $numerokardexA = findUltimoID("kardexcajas", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numerokardexAt = findUltimoID("traspasodetalle", "numero", true);
    $numerotraspasodetalle = $numerokardexAt['resultado']+1;

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
          $iditemventa = $iditemventa + 1 ;
$idkardexcaja = $producto->idkardexunico;
$idmodeloa = $producto->idmodelo;
$idkardex =$idkardexcaja;

$sql12 = "SELECT * FROM kardexdetallepar WHERE idkardex = '$idkardexcaja' and idmodelo='$idmodeloa' and idalmacen='$idalmacen' group by idkardex ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelo");
    $idmodelo = $saldocantidadA['resultado'];


 $idtraspasomodelo = "dtra-".$numerodetalle;
 $idmodelonuevo = "m-".$numeromodelo;
 $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];
$saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idingreso");
    $idingreso = $saldocantidadA['resultado'];

    $sql125 = "SELECT CONCAT(a.nombre,'/',c.codigo) AS cliente FROM almacenes a,ciudades c WHERE a.idciudad=c.idciudad and a.idalmacen = '$almacendestino' ";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql125, true, true, "cliente");
    $clientenuevo = $saldocantidadA1['resultado'];
    $tipo="";
$sql[] = getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelonuevo, $clientenuevo, $numerodetalle, $idtraspaso, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso,false);
       $numerodetalle++;
$sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, "ninguno", $fechaingreso, false);
$numeromodelo++;
//traspasos
$sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
 $tipo="noexiste";
//    }


registraritemventatraspaso($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,$idalmacen,false);

        }

 updatetraspaso($idtraspaso);

   }
//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {finalizandoinserciontraspaso($idtraspaso,true);
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idtraspaso";
    }
    else
    {
        eliminarfallatraspaso($idtraspaso,false);
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";
         finalizandoyhabilitando("traspaso",$idtraspaso,true);
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
function updatetraspaso($idtraspaso){
    set_time_limit(0);
$emitido="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");

    $sql3 = " SELECT COUNT(idkardexunico) as pares FROM traspasodetallepar WHERE iddetalletraspaso='$idtraspaso'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "pares");
        $pares = $cantidadventaA1['resultado'];
        $sql3 = " SELECT (SUM(saldocantidad)/12) as caja FROM traspasodetallepar WHERE iddetalletraspaso='$idtraspaso'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "caja");
        $cajas = $cantidadventaA1['resultado'];

        $sql3 = " SELECT SUM(preciounitario) as sus FROM traspasodetallepar WHERE iddetalletraspaso='$idtraspaso'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "sus");
        $sus = $cantidadventaA1['resultado'];


  $sqlA[] = "UPDATE traspaso SET totalcajas='$cajas',totalpares='$pares',totalsus='$sus' where idtraspaso='$idtraspaso';";

//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sqlA);

}

function eliminarfallatraspaso($idtraspaso,$return = false){
 set_time_limit(0);
$idalmacen =$_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 $sql ="
SELECT tr.idmodelo
FROM traspasodetallepar tr,traspaso t
WHERE tr.iddetalletraspaso=t.idtraspaso and tr.iddetalletraspaso='$idtraspaso' and t.idalmacen='$idalmacen' group by tr.idmodelo ;
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
                                mysql_field_name($re, $i) == "idmodelo";
                                $idmodelo = $fi[$i];
                       //         echo $idplanillaemitida;
             $iditemventa =$iditemventa+1;

                 insertarparesfallaanulacion($idmodelo,$idtraspaso,$idalmacen,false);


               }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}


function insertarparesfallaanulacion($idmodelo,$idtraspaso,$idalmacen,$return){
    set_time_limit(0);

$emitido="1";
//echo $mesplanilla;
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");

   $sqlcol = "SELECT * from traspasodetallepar where idmodelo='$idmodelo' and iddetalletraspaso='$idtraspaso' group by idmodelo";
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idmodeloorigen");
    $idmodeloorigen = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardexunico");
    $idkardexunico = $opcionA['resultado'];
    $sqlcol = "SELECT * from kardexdetallepar where idmodelo='$idmodelo' and idkardexunico='$idkardexunico'";
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardex");
    $idkardex = $opcionA['resultado'];
$sqlA[] = "UPDATE kardexdetallepar kp,traspasodetallepar tr SET kp.idmodelo='$idmodeloorigen',kp.idalmacen='$idalmacen' where kp.idkardexunico=tr.idkardexunico and kp.idmodelo='$idmodelo' and tr.iddetalletraspaso='$idtraspaso' ;";
$sqlA[] ="DELETE FROM traspasodetallepar WHERE idmodelo='$idmodelo' and iddetalletraspaso='$idtraspaso';";
$sqlA[] = "UPDATE traspaso SET estado='ANULADO',completo='$idusuario' WHERE idtraspaso = '$idtraspaso' ;";

       //MostrarConsulta($sql);
             ejecutarConsultaSQLBeginCommit($sqlA);


}
function registraritemventatraspaso($almacendestino,$idmodelonuevo,$idmodelo,$idkardexcaja,$idtraspaso,$idempleado,$idcliente,$idalmacen,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 $sql ="
SELECT idkardexunico
FROM kardexdetallepar
WHERE idkardex='$idkardexcaja' and saldocantidad='1' and idmodelo='$idmodelo' and idalmacen='$idalmacen' ;
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
                                mysql_field_name($re, $i) == "idkardexunico";
                                $idkardexunico = $fi[$i];
                       //         echo $idplanillaemitida;
             $iditemventa =$iditemventa+1;
                  insertarparestraspaso($almacendestino,$idmodelonuevo,$idkardexcaja,$idkardexunico,$idmodelo,$idtraspaso,$idempleado,$idcliente,false);

                     }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}
function insertarparestraspaso($almacendestino,$idmodelonuevo,$idkardexcaja,$idkardexunico,$idmodelo,$idtraspaso,$idempleado,$idcliente,$return){
    set_time_limit(0);

$emitido="1";
//echo $mesplanilla;
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");

    $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico' and idmodelo='$idmodelo'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
        $idmodelo = $cantidadventaA1['resultado'];
           $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
        $saldocantidad = $cantidadventaA1['resultado'];
           $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
        $talla = $cantidadventaA1['resultado'];
            $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
        $idkardex = $cantidadventaA1['resultado'];
         $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
        $preciounitario = $cantidadventaA1['resultado'];

        $cantidad = '1';

$sql3 = "SELECT k.precioventa FROM kardexcajas k WHERE k.idkardex = '$idkardex'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
        $totalcajaprecio = $cantidadventaA1['resultado'];

 $sqlA[] =getSqlNewTraspasodetallepar($idkardexunico, $idkardex, $idtraspaso, $idmodelonuevo, '1', $talla, "0", $preciounitario, 'no', '0', $idperiodo, $almacendestino, $idmodelo, false);
 $sqlA[] = "UPDATE kardexdetallepar SET idmodelo='$idmodelonuevo',idalmacen='$almacendestino' where idkardexunico='$idkardexunico' and idmodelo='$idmodelo';";

//$sqlA[] =getSqlNewVentaitem($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciounitario, $preciounitario, "0", "0", $totalcajaprecio, "P", $devolucion, $tipomuestra, $diferencia,$preciounitario,false);
//actualizarSaldoMovimientotiendatraspaso($idkardexunico,$idmodelo,$idkardex,$fecha,$hora, false);
//MostrarConsulta($sqlA);
   if(ejecutarConsultaSQLBeginCommit($sqlA))
    {
       $dev['mensaje'] = "";
        $dev['error'] = "true";
        $dev['resultado'] = "$iditemventa";
    }
    else
    {
        $dev['mensaje'] = "";
        $dev['error'] = "false";
        $dev['resultado'] = "$iditemventa";
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
function actualizarSaldoMovimientotiendatraspaso($idkardexunico,$idmodelo, $idkardex,$fecha,$hora = '00:00:01' ,$return = false ){

     $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
        $idmodelo = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
        $idkardex = $cantidadventaA1['resultado'];
         $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
        $talla = $cantidadventaA1['resultado'];
           $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "saldocantidad");
        $saldocantidad = $cantidadventaA1['resultado'];

$cantidad1='1';
       $saldoActual = $saldocantidad - $cantidad1;
//        $saldoActualBs = $saldoActualBs  + $res1['ingreso'] - $res1['egreso'];
//        $idmovimientokardex = $res1['idmovimientokardexalmacen'];
 $sql3 = " SELECT * FROM kardexcajas WHERE idkardex = '$idkardex' and idmodelo='$idmodelo' ";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "totalparescaja");
        $saldocantidadpa = $cantidadventaA1['resultado'];
        $saldoActualpares= $saldocantidadpa - $cantidad1;
         $sql3 = " SELECT * FROM kardexdetalle WHERE idkardex = '$idkardex' and tallakardex='$talla'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "iddetalle");
        $iddetallekardex = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "cantidad");
        $cantidadkardex = $cantidadventaA1['resultado'];
$cantidadkardex =$cantidadkardex -1;

$sqlA[] = "UPDATE kardexdetalle SET cantidad = '$cantidadkardex' WHERE iddetalle = '$iddetallekardex';";
$sqlA[] = "UPDATE kardexdetallepar SET saldocantidad = '$saldoActual' WHERE idkardexunico = '$idkardexunico';";
$sqlA[] = "UPDATE kardexcajas SET totalparescaja = '$saldoActualpares' WHERE idkardex = '$idkardex' and idmodelo='$idmodelo';";
 MostrarConsulta($sqlA);
//    if($return == true)
//    {
//        return $sqlA;
//    }
//    else
//
//    {
//         //                           MostrarConsulta($sqlA);
//        if(ejecutarConsultaSQLBeginCommit($sqlA))
//        {
//            $dev['mensaje'] = "Se guardo una transaccion correctamente";
//            $dev['error'] = "true";
//            $dev['resultado'] = "";
//        }
//        else
//        {
//            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
//            $dev['error'] = "false";
//            $dev['resultado'] = "";
//        }
//
//    }

}
function txSaveTraspaso($resultado, $return)
{$idalmacen =$_SESSION['idalmacen'];
    iniciandoinserciontraspaso($idalmacen,true);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
   $fecha2=time()-3600;
   $hora= date("H:i:s",$fecha2);
   $proforma = $resultado->venta;
    $idmarca= $proforma->idmarca;
    //$boleta=$proforma->boleta;
    $fechaventa=$proforma->fecharegistro;
    $totalpares = $proforma->totalpares;
    $totalbs = $proforma->totalbs;
    $totalcaja = $proforma->totalcaja;
    $totalsus = $proforma->totalsus;
    $observacion = $proforma->descripcion;
    $almacendestino= $proforma->almacen;
    $vendedordestino= $proforma->vendedor;
    $tipocambio = $proforma->tipocambio;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;
$sql41 = "SELECT MAX(numero) AS ultimos FROM traspaso where idalmacen='$idalmacen'";
      $results = findBySqlReturnCampoUnique($sql41, true, true, "ultimos");
    $mawnumtraspaso = $results['resultado'];
$sql4 = "SELECT boleta FROM traspaso where idalmacen='$idalmacen' and numero='$mawnumtraspaso'";
      $result = findBySqlReturnCampoUnique($sql4, true, true, "boleta");
    $boleta = $result['resultado'] +1;
    $sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
    $numeroA = findUltimoID("traspaso", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idtraspaso="tra-".$numero;

 $totalpares=COUNT($product);
 $cantidadminima = '1';
if($totalpares < $cantidadminima){
            $dev['mensaje'] = "Debe traspasar por lo menos un producto par";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
        else{
     $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;
    $arqueo="0";

    $sql1= "SELECT idperiodo FROM periodo where estado='Abierto'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idperiodo");
    $periodo = $result['resultado'];
 $sql[]=getSqlNewTraspaso($idtraspaso, $idalmacenorigen, $idusuario, $detalle, $fechareal, $hora, "pendiente", $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $vendedordestino, $transporte, $idmarca, $almacendestino, $completo,$observacion, false);

$numeroD = findUltimoID("traspasomodelo", "numero", true);
$numerodetalle = $numeroD['resultado'] +1;
 $calzados = $resultado->calzados;
 $numeroD = findUltimoID("modelo", "numero", true);
    $numeromodelo = $numeroD['resultado'] +1;

$numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    $numerokardexA = findUltimoID("kardexcajas", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numerokardexAt = findUltimoID("traspasodetalle", "numero", true);
    $numerotraspasodetalle = $numerokardexAt['resultado']+1;

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
          $iditemventa = $iditemventa + 1 ;
//
         $idkardexunico = $producto->idkardexunico;
         $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
        $idmodelo = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
        $idmodelooriginal = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idingreso");
        $idingreso = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idalmacen");
        $idalmacen = $cantidadventaA1['resultado'];
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "talla");
        $tallakardex = $cantidadventaA1['resultado'];
        $preciounitario = $producto->preciou;
        $cantidad = '1';
   $codigobarraA1 = registroparesdetalletraspaso($formatomayor,$idtraspaso,$idkardexunico, $idmodelooriginal,$numerodetalle,$numeromodelo,$almacendestino,$vendedordestino,$tallakardex,true);
                           $idmodelon = $codigobarraA1['idmodelonuevo'];
                           $idkardexunicoold = $codigobarraA1['idkardexunico'];
                           $esvalor = $codigobarraA1['tipovalor'];
       $numeromodelo ++;
     $numerodetalle++;


        }
   }
//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        finalizandoinserciontraspaso($idtraspaso,true);
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idtraspaso";
    }
    else
    {
 eliminarfallatraspaso($idtraspaso,false);
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";

        finalizandoyhabilitando("traspaso",$idtraspaso,true);
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


function txanularTraspaso($resultado, $return)
{//anulacion
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacenorigen =$_SESSION['idalmacen'];
     $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
   $fecha2=time()-3600;
   $hora= date("H:i:s",$fecha2);
   $proforma = $resultado->venta;
    $idtraspaso= $proforma->idmarca;
    $fechareal = date("Y-m-d");
    $product = $resultado->productos;
 $cantidadminima = '1';
 for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
        $iditemventa = $iditemventa + 1 ;
        $idmodelo = $producto->idmodelo;
        $cantidad = '1';
//select * from kardexdetallepar where idmodelo='m-1'
    $sqlcol = "SELECT * from traspasodetallepar where idmodelo='$idmodelo' and iddetalletraspaso='$idtraspaso' group by idmodelo";
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idmodeloorigen");
    $idmodeloorigen = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardexunico");
    $idkardexunico = $opcionA['resultado'];
    $sqlcol = "SELECT * from kardexdetallepar where idmodelo='$idmodelo' and idkardexunico='$idkardexunico'";
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardex");
    $idkardex = $opcionA['resultado'];
$sql[] = "UPDATE kardexdetallepar kp,traspasodetallepar tr SET kp.idmodelo='$idmodeloorigen',kp.idalmacen='$idalmacen' where kp.idkardexunico=tr.idkardexunico and kp.idmodelo='$idmodelo' and tr.iddetalletraspaso='$idtraspaso' ;";
$sql[] ="DELETE FROM traspasodetallepar WHERE idmodelo='$idmodelo' and iddetalletraspaso='$idtraspaso';";
      }
  // }

//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {anulaciontraspaso($idtraspaso, false);
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idtraspaso";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error en el registro";
        $dev['error'] = "false";
        $dev['resultado'] = "$idtraspaso";
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
function anulaciontraspaso($idtraspaso,$return = false ){
$idusuario = $_SESSION['idusuario'];
$sqlA[] = "UPDATE traspaso SET estado='ANULADO',completo='$idusuario' WHERE idtraspaso = '$idtraspaso' ;";
ejecutarConsultaSQLBeginCommit($sqlA);
 }
function totaltraspaso($idtraspaso,$return = false ){

   $sql3 = "SELECT SUM(saldocantidad) as pares FROM traspasodetallepar WHERE iddetalletraspaso = '$idtraspaso' ";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'pares');
   $totalpares = $idalmacenA2['resultado'];
    $sql3 = "SELECT SUM(preciounitario) as sus FROM traspasodetallepar WHERE iddetalletraspaso = '$idtraspaso' ";
   $idalmacenA2 =  findBySqlReturnCampoUnique($sql3, true, true, 'sus');
   $totalNeto = $idalmacenA2['resultado'];
  $totalNeto = round($totalNeto,2);
$totalcaja =$totalpares/12;
     $sqlA[] = "UPDATE traspaso SET totalcajas='$totalcaja',totalpares='$totalpares',totalsus='$totalNeto' WHERE idtraspaso = '$idtraspaso' ;";

ejecutarConsultaSQLBeginCommit($sqlA);
 }



function registroparesdetalletraspaso($formatomayor,$idtraspaso,$idkardexunico, $idmodelo,$numerodetalle,$numeromodelo,$almacendestino,$vendedordestino,$tallakardex, $return){
 $emitida="1";
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
 $idtraspasomodelo = "dtra-".$numerodetalle;
 $idmodelonuevo = "m-".$numeromodelo;
        $sql3 = " SELECT * FROM kardexdetallepar WHERE idkardexunico = '$idkardexunico'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql3, true, true, "idmodelo");
        $idmodelo = $cantidadventaA1['resultado'];
    $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];
      $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idingreso");
    $idingreso = $saldocantidadA['resultado'];

    $tipo="";
   if($estadotraspaso!="ninguno" || $estadotraspaso!='ninguno')
    {

    $sql1224 = "SELECT t.idmodelo FROM traspasodetallepar t,modelo m WHERE t.idmodelo=m.idmodelo and t.idimpresion='$almacendestino' and t.idmodeloorigen = '$idmodelo' and m.idvendedor='$vendedordestino' group by t.idmodeloorigen ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql1224, true, true, "idmodelo");
    $idmodelonuevotraspaso = $saldocantidadA['resultado'];

     $sql122 = "SELECT idmodelo FROM kardexdetallepar WHERE idmodelo = '$idmodelonuevotraspaso' and idalmacen='$almacendestino' group by idmodelo ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql122, true, true, "idmodelo");
    $idmodeloexiste = $saldocantidadA['resultado'];

    if($idmodeloexiste == null || $idmodeloexiste == ""){
       $sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, $idmodelonuevo, $fechaingreso, false);
       $numeromodelo++;
       $idmodelonuevo = $idmodelonuevo;
       $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
       $tipo="noexiste";
         }
        else{
       $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
       $idmodelonuevo = $idmodeloexiste;
   }
  // echo $idmodelonuevo;
  $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
    }
else{
//
//$sql[] = getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelonuevo, $clientenuevo, $numerodetalle, $idtraspaso, $idalmaceningreso, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso,false);
//       $numerodetalle++;
$sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, $idmodelonuevo, $fechaingreso, false);
 $numeromodelo++;

   $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
 $tipo="noexiste";
    }

 $sql[] =getSqlNewTraspasodetallepar($idkardexunico, $idkardex, $idtraspaso, $idmodelonuevo, '1', $tallakardex, "0", $preciounitario, 'no', '0', $idperiodo, $almacendestino, $idmodelo, false);
 $sql[] = "UPDATE kardexdetallepar SET idmodelo='$idmodelonuevo',idalmacen='$almacendestino' where idkardexunico='$idkardexunico';";
 $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
//$sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
//echo $idmodelonuevo;
//echo $idkardexunico;
//MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){
         $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idmodelonuevo;
          $dev['idmodelonuevo'] = $idmodelonuevo;
             $dev['idmodeloantiguo'] = $idmodelo;
            $dev['idkardexunico'] = $idkardexunico;
          $dev['tipovalor'] = $tipo;
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = $idventadetalle;
    }
    if($return == true)
    {   return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
    return $dev;
}

function verificarmodelostraspaso($idvendedor,$idtraspaso,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
 //   echo $mesplanilla;

$sql ="
SELECT idmodelo
FROM traspasodetallepar
WHERE iddetalletraspaso = '$idtraspaso' group by idmodelo;
";
//WHERE idempresa = '$idempresa' AND idclienteempresa='$idclienteempresa'AND no_planilla !='$no_planillaactual' AND no_planilla ='$no_planillaanterior' AND emitido='1' AND unido='0';
//echo $sql;
//  echo $idplanillas;
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
                                mysql_field_name($re, $i) == "idmodelo";
                                $idmodelo = $fi[$i];
                       //         echo $idplanillaemitida;
                   registreactualizacion($idmodelo,$idtraspaso,$idvendedor,false);
//

                     }
                    }while($fi = mysql_fetch_array($re));
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}
function registreactualizacion($idmodelo,$idtraspaso,$idvendedor,$return){
    set_time_limit(0);
$idalmacen=$_SESSION['idalmacen'];
$idusuario = $_SESSION['idusuario'];
$emitido="1";
//echo $mesplanilla;
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
$sql2 = "SELECT * FROM modelo WHERE idmodelo='$idmodelo'";
$result1 = findBySqlReturnCampoUnique($sql2, true, true, "idvendedor");
    $idvendedorold = $result1['resultado'];

 $sqlA[] = "UPDATE modelo SET idvendedor= '$idvendedor' WHERE idmodelo='$idmodelo' ;";
$sqlA[] = getSqlNewBitacoraupdate($idmodelo, $idtraspaso, "CAMBIO VENDEDOR", $idusuario, $oldidmodelo, $idvendedorold, $estado, $fecha, $hora, $usuario, $idalmacen, $idvendedor, false);

//$sqlA[] = getSqlNewPlanillaemitida($idplanillaemitidanueva, $no_planillaactual, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora,$ventasmes,$pares, $mesanio1p, $pagoa1, "0.00", $mesanio2p, $pagoa2, "0.00", $mesanio3p, $pagoa3, "0.00", $mesanio4p, $pagoa4, "0.00", $mesanio5p, $pagoa5, "0.00", $mesanio6p, $pagoa6, "0.00", $mesa7p, $pagoa7, "0.00",$saldototal, $emitido, $meses, "N",$numeropla, $porcobrar,$idmovimientoplanilla,$planillaempresa,$uni,$datounido,$planillaanterior,$pagadopendiente,false);
//$sqlA[] = getSqlNewPlanillaemitida($idplanillaemitidanueva, $no_planillaactual, $idempresa, $idclienteempresa, $fechaemitida, $fechamodifica, $fechareimpresion, $hora,$ventasmes,$pares, $mesanio1p, $pagoa1, "0.00", $mesanio2p, $pagoa2, "0.00", $mesanio3p, $pagoa3, "0.00", $mesanio4p, $pagoa4, "0.00", $mesanio5p, $pagoa5, "0.00", $mesanio6p, $pagoa6, "0.00", $mesa7p, $pagoa7, "0.00",$saldototal, $emitido, $meses, "N",$numeropla, $porcobrar,$idmovimientoplanilla,$planillaempresa,$uni,$datounido,$planillaanterior,$pagadopendiente,false);
ejecutarConsultaSQLBeginCommit($sqlA);
//ll
//$idplanillaemitida
//MostrarConsulta($sqlA);
//   if(ejecutarConsultaSQLBeginCommit($sqlA))
//    {
//       $dev['mensaje'] = "";
//        $dev['error'] = "true";
//        $dev['resultado'] = "$idplanillaemitidanueva";
//    }
//    else
//    {
//        $dev['mensaje'] = "";
//        $dev['error'] = "false";
//        $dev['resultado'] = "$idplanillaemitidanueva";
//    }
//    if($return == true)
//    {
//        return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//       // print($output);
//    }
}

function registrarcambiotraspaso(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
     $idvendedornuevo = $_GET['idvendedor'];
     $idtraspaso = $_GET['idtraspaso'];
   //  echo $idvendedornuevo;
    verificarmodelostraspaso($idvendedornuevo,$idtraspaso,false);

  //  $sql[] = getSqlNewColores($idcolor,$nombre,$descripcion,$codigo,$numero1,"",$idmarca, false);
    $sql[] = "UPDATE traspaso SET responsable='$idvendedornuevo' WHERE idtraspaso = '$idtraspaso';";

 //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
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

function registrarcambiovendedor(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
     $idvendedornuevo = $_GET['idvendedor'];
     $idmodelo = $_GET['idmodelo'];
      $idmarca = $_GET['idmarca'];
   //  echo $idvendedornuevo;
  //  verificarmodelostraspaso($idvendedornuevo,$idtraspaso,false);

  //  $sql[] = getSqlNewColores($idcolor,$nombre,$descripcion,$codigo,$numero1,"",$idmarca, false);
    $sql[] = "UPDATE modelo SET idvendedor='$idvendedornuevo' WHERE idmodelo = '$idmodelo';";

 //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
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



function getSqlNewTraspasodetalle($iddetalletraspaso, $idmovimiento, $idmodelo, $idalmacenorigen, $idalmacendestino, $numero, $estado, $fecharegistro, $fechareal, $usuario, $pares, $cajas, $totalsus, $return){
$setC[0]['campo'] = 'iddetalletraspaso';
$setC[0]['dato'] = $iddetalletraspaso;
$setC[1]['campo'] = 'idmovimiento';
$setC[1]['dato'] = $idmovimiento;
$setC[2]['campo'] = 'idmodelo';
$setC[2]['dato'] = $idmodelo;
$setC[3]['campo'] = 'idalmacenorigen';
$setC[3]['dato'] = $idalmacenorigen;
$setC[4]['campo'] = 'idalmacendestino';
$setC[4]['dato'] = $idalmacendestino;
$setC[5]['campo'] = 'numero';
$setC[5]['dato'] = $numero;
$setC[6]['campo'] = 'estado';
$setC[6]['dato'] = $estado;
$setC[7]['campo'] = 'fecharegistro';
$setC[7]['dato'] = $fecharegistro;
$setC[8]['campo'] = 'fechareal';
$setC[8]['dato'] = $fechareal;
$setC[9]['campo'] = 'usuario';
$setC[9]['dato'] = $usuario;
$setC[10]['campo'] = 'pares';
$setC[10]['dato'] = $pares;
$setC[11]['campo'] = 'cajas';
$setC[11]['dato'] = $cajas;
$setC[12]['campo'] = 'totalsus';
$setC[12]['dato'] = $totalsus;
$sql2 = generarInsertValues($setC);
return "INSERT INTO traspasodetalle ".$sql2;
}

function DescontarParesModelo($idmarca ,$idmodelo,$numerocajassalida, $talla,$idmarca,$numeroparesfila,$totalparescajasalida,$idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
       $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numerocajas");
    $numerocajas = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "totalparescaja");
    $totalparescaja = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $talla = $saldocantidadA['resultado'];


for($l=1;$l<=$numerocajassalida;$l++){
  $sql12 = "SELECT Min(idkardexunico) AS menor FROM kardexcajas WHERE idmodelo = '$idmodelo' AND numerocajas!='0' ";
   $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "menor");
    $menor = $saldocantidadA['resultado'];

    $sql12 = "SELECT * FROM kardexcajas WHERE idkardexunico = '$menor' ";
   $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardex");
    $idkardex = $saldocantidadA['resultado'];

      $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "totalparescaja");
    $totalparesencaja = $saldocantidadA['resultado'];
    $saldopares = $totalparesencaja - $numeroparesfila;
    $sql[] = "UPDATE kardexcajas SET totalparescaja='$saldopares',numerocajas='0' WHERE idkardex = '$idkardex' ANd idkardexunico='$menor';";
retirarparesporcaja($idkardex,$idmodelo,$numeroparesfila,$totalparescajasalida,$idalmacen,$l,true);
}
$numcajasresta = $numerocajas - $numerocajassalida;
$numparesresta = $totalparescaja - $totalparescajasalida;
    $sql[] = "UPDATE modelo SET numerocajas='$numcajasresta',totalparescaja='$numparesresta' WHERE idmodelo = '$idmodelo' ANd idalmacen='$idalmacen';";
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);
}
function retirarparesporcaja($idkardex,$idmodelo,$numeroparesfila,$totalparescajasalida,$idalmacen,$l,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";

 //$sql[] =getSqlNewKardexdetallepar($idkardexunico, $idkardex, $idkardexdetalle, $idmodelo, $idingreso, $codigobarra, $i, $tallakardex, $numero, $preciounitario, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $idimpresion,false);
    $sql[] = "UPDATE kardexdetalle SET cantidad='0' WHERE idkardex = '$idkardex' ANd idmodelo='$idmodelo';";
$sql[] = "UPDATE kardexdetallepar SET saldocantidad='0' WHERE idkardex = '$idkardex' ANd idmodelo='$idmodelo';";

//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);

}

function Listarempleadosmarca($callback, $_dc,$idalmacen,$idmarca, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
$ciudad =  Listarempleadospormarca('', '', '', '', '', '', $idalmacen,$idmarca, true);
   // $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }


     if($ciudad["error"]==true){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
      // $value['empleadoM'] = $cliente['resultado'];
        $value["empleadoM"] = $ciudad['resultado'];
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
function Listarempleadosmarca2($callback, $_dc,$idalmacen,$idmarca, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
$ciudad =  Listarempleadostodo( $idalmacen,$idmarca, true);
//$ciudad =  Listarempleadospormarca('', '', '', '', '', '', $idalmacen,$idmarca, true);

  if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }


     if($ciudad["error"]==true){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
      // $value['empleadoM'] = $cliente['resultado'];
        $value["empleadoM"] = $ciudad['resultado'];
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


function Listarempleadospormarca($start, $limit, $sort, $dir, $callback, $_dc, $idalmacen,$idmarca, $return = "true") //funcion
//function Listarempleadospormarca($start, $limit, $idalmacen, $return = false)
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
  //  echo $idempresa;

$sql ="
SELECT
  cle.idempleado ,
  cle.codigo,
CONCAT( cle.nombres,'-',cle.apellidos) AS nombre,cle.idalmacen

FROM
  empleados cle,empleadomarca em
WHERE
  cle.idempleado=em.idempleado and cle.idalmacen = '$idalmacen' and em.idmarca='$idmarca'

";



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
function Listarempleadostodo($idalmacen,$idmarca, $return = "true") //funcion
//function Listarempleadospormarca($start, $limit, $idalmacen, $return = false)
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
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
  //  echo $idempresa;

$sql ="
SELECT
  cle.idempleado ,
  cle.codigo,
CONCAT( cle.nombres,'-',cle.apellidos) AS nombre,cle.idalmacen

FROM
  empleados cle where cle.idalmacen = '$idalmacen'

";



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

function listartraspasos($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true") //funcion
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
     $fecha = date("Y-m-d");

    $idalmacen = $_SESSION['idalmacen'];
    $sql12 = "SELECT nombre
FROM
  almacenes
WHERE
  idalmacen = '$idalmacen'
";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "nombre");
    $tiendasesion = $saldocantidadA['resultado'];

   $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


//tra.tiendadestino = des.idtienda AND tra.idempleado = em.idempleado AND ori.idtienda = '$idalmacen'

//recibidopor
   if($where == null || $where == "")
    {
//x
  $sql = "
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen  AND tra.responsable=emp.idempleado and tra.idalmacen ='$idalmacen' group by tra.idtraspaso
union all
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'RECIBIDOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen AND tra.responsable=emp.idempleado and tra.idalmacendestino ='$idalmacen' group by tra.idtraspaso

        ORDER BY fechareal desC LIMIT $start,$limit ";

    }
    else
    {
        $sql = "
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen  AND tra.responsable=emp.idempleado and tra.idalmacen ='$idalmacen' and $where group by tra.idtraspaso
union all
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'RECIBIDOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen AND tra.responsable=emp.idempleado and tra.idalmacendestino ='$idalmacen' and $where group by tra.idtraspaso

        ORDER BY fechareal desc LIMIT $start,$limit ";

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
    //    echo $sql;
    $numtuplas = NumeroTuplas($sql);
    $dev['totalCount'] = $numtuplas['resultado'];
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
function listartraspasos2($start, $limit, $sort, $dir, $callback, $_dc, $where = '',$tipotraspaso, $return = "true") //funcion
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
     $fecha = date("Y-m-d");

    $idalmacen = $_SESSION['idalmacen'];
    $sql12 = "SELECT nombre
FROM
  almacenes
WHERE
  idalmacen = '$idalmacen'
";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "nombre");
    $tiendasesion = $saldocantidadA['resultado'];

   $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


if($tipotraspaso=="ENVIADOS"){
        $sql = "
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
tra.boleta,
date_format(tra.fecha,'%d/%m/%Y') AS fecha,
tra.hora,
tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
ori.nombre AS tiendaorigen,
des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen  AND tra.responsable=emp.idempleado and tra.idalmacen ='$idalmacen'  group by tra.idtraspaso

        ORDER BY fechareal desC LIMIT $start,$limit ";
    }else{
        $sql = "
SELECT
tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'RECIBIDOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen AND tra.responsable=emp.idempleado and tra.idalmacendestino ='$idalmacen'  group by tra.idtraspaso

        ORDER BY fechareal desC LIMIT $start,$limit ";
    }


 // }
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
    //    echo $sql;
    $numtuplas = NumeroTuplas($sql);
    $dev['totalCount'] = $numtuplas['resultado'];
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


function BuscarMaterialPorTraspaso($idtraspaso,$return=false){
$idalmacen =$_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="
SELECT tra.idtraspaso,tra.idmarca,tra.idalmacendestino,tra.fecha as fechareal,
  tra.boleta,
  date_format(tra.fecha,'%d/%m/%Y') AS fecha,
  tra.hora,
  tra.estado,mar.nombre as marca,
ROUND(tra.totalpares/12) as cajas,tra.totalpares as pares,tra.totalsus AS precio,emp.nombres as responsable,'-' as recibidopor,
  ori.nombre AS tiendaorigen,
  des.nombre AS tiendadestino,
 '$tiendasesion' AS tiendasesion,'ENVIADOS' AS tipotraspaso,tra.codigo
FROM
traspaso tra,marcas mar,empleados emp,
  almacenes ori,
  almacenes des
WHERE tra.idmarca=mar.idmarca and
 tra.idalmacen = ori.idalmacen and tra.idalmacendestino = des.idalmacen  AND tra.responsable=emp.idempleado and tra.idalmacen ='$idalmacen' and tra.idtraspaso='$idtraspaso'

";

// echo $sql;
    if($idtraspaso != null)
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
        $dev['mensaje'] = "El codigo es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }

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

function getSqlNewTraspaso($idtraspaso, $idalmacen, $idusuario, $codigo, $fecha, $hora, $estado, $numero, $totalcajas, $totalpares, $totalbs, $totalsus, $boleta, $responsable, $transporte, $idmarca, $idalmacendestino, $completo, $observacion,$return){
$setC[0]['campo'] = 'idtraspaso';
$setC[0]['dato'] = $idtraspaso;
$setC[1]['campo'] = 'idalmacen';
$setC[1]['dato'] = $idalmacen;
$setC[2]['campo'] = 'idusuario';
$setC[2]['dato'] = $idusuario;
$setC[3]['campo'] = 'codigo';
$setC[3]['dato'] = $codigo;
$setC[4]['campo'] = 'fecha';
$setC[4]['dato'] = $fecha;
$setC[5]['campo'] = 'hora';
$setC[5]['dato'] = $hora;
$setC[6]['campo'] = 'estado';
$setC[6]['dato'] = $estado;
$setC[7]['campo'] = 'numero';
$setC[7]['dato'] = $numero;
$setC[8]['campo'] = 'totalcajas';
$setC[8]['dato'] = $totalcajas;
$setC[9]['campo'] = 'totalpares';
$setC[9]['dato'] = $totalpares;
$setC[10]['campo'] = 'totalbs';
$setC[10]['dato'] = $totalbs;
$setC[11]['campo'] = 'totalsus';
$setC[11]['dato'] = $totalsus;
$setC[12]['campo'] = 'boleta';
$setC[12]['dato'] = $boleta;
$setC[13]['campo'] = 'responsable';
$setC[13]['dato'] = $responsable;
$setC[14]['campo'] = 'transporte';
$setC[14]['dato'] = $transporte;
$setC[15]['campo'] = 'idmarca';
$setC[15]['dato'] = $idmarca;
$setC[16]['campo'] = 'idalmacendestino';
$setC[16]['dato'] = $idalmacendestino;
$setC[17]['campo'] = 'completo';
$setC[17]['dato'] = $completo;
$setC[18]['campo'] = 'observacion';
$setC[18]['dato'] = $observacion;
$sql2 = generarInsertValues($setC);
return "INSERT INTO traspaso ".$sql2;
}

function getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelodetalle, $cliente, $numero, $idtraspaso, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso, $return){
$setC[0]['campo'] = 'idtraspasomodelo';
$setC[0]['dato'] = $idtraspasomodelo;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'idmodelodetalle';
$setC[2]['dato'] = $idmodelodetalle;
$setC[3]['campo'] = 'cliente';
$setC[3]['dato'] = $cliente;
$setC[4]['campo'] = 'numero';
$setC[4]['dato'] = $numero;
$setC[5]['campo'] = 'idtraspaso';
$setC[5]['dato'] = $idtraspaso;
$setC[6]['campo'] = 'idcliente';
$setC[6]['dato'] = $idcliente;
$setC[7]['campo'] = 'precioventa';
$setC[7]['dato'] = $precioventa;
$setC[8]['campo'] = 'preciounitario';
$setC[8]['dato'] = $preciounitario;
$setC[9]['campo'] = 'preciototalcaja';
$setC[9]['dato'] = $preciototalcaja;
$setC[10]['campo'] = 'numerocajas';
$setC[10]['dato'] = $numerocajas;
$setC[11]['campo'] = 'numeroparesfila';
$setC[11]['dato'] = $numeroparesfila;
$setC[12]['campo'] = 'totalparescaja';
$setC[12]['dato'] = $totalparescaja;
$setC[13]['campo'] = 'numeracion';
$setC[13]['dato'] = $numeracion;
$setC[14]['campo'] = 'talla';
$setC[14]['dato'] = $talla;
$setC[15]['campo'] = 'idalmacen';
$setC[15]['dato'] = $idalmacen;
$setC[16]['campo'] = 'estadotraspaso';
$setC[16]['dato'] = $estadotraspaso;
$sql2 = generarInsertValues($setC);
return "INSERT INTO traspasomodelo ".$sql2;
}

function getSqlNewTraspasodetallepar($idkardexunico, $idkardex, $iddetalletraspaso, $idmodelo, $saldocantidad, $talla, $numero, $preciounitario, $unido, $fallado, $idperiodo, $idimpresion, $idmodeloorigen, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'idkardex';
$setC[1]['dato'] = $idkardex;
$setC[2]['campo'] = 'iddetalletraspaso';
$setC[2]['dato'] = $iddetalletraspaso;
$setC[3]['campo'] = 'idmodelo';
$setC[3]['dato'] = $idmodelo;
$setC[4]['campo'] = 'saldocantidad';
$setC[4]['dato'] = $saldocantidad;
$setC[5]['campo'] = 'talla';
$setC[5]['dato'] = $talla;
$setC[6]['campo'] = 'numero';
$setC[6]['dato'] = $numero;
$setC[7]['campo'] = 'preciounitario';
$setC[7]['dato'] = $preciounitario;
$setC[8]['campo'] = 'unido';
$setC[8]['dato'] = $unido;
$setC[9]['campo'] = 'fallado';
$setC[9]['dato'] = $fallado;
$setC[10]['campo'] = 'idperiodo';
$setC[10]['dato'] = $idperiodo;
$setC[11]['campo'] = 'idimpresion';
$setC[11]['dato'] = $idimpresion;
$setC[12]['campo'] = 'idmodeloorigen';
$setC[12]['dato'] = $idmodeloorigen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO traspasodetallepar ".$sql2;
}
function getSqlNewBitacoraupdate($idmodelo, $idoperacion, $detalle, $idusuario, $oldidmodelo, $oldidvendedor, $estado, $fecharegistro, $hora, $usuario, $idalmacen, $dato, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'idoperacion';
$setC[1]['dato'] = $idoperacion;
$setC[2]['campo'] = 'detalle';
$setC[2]['dato'] = $detalle;
$setC[3]['campo'] = 'idusuario';
$setC[3]['dato'] = $idusuario;
$setC[4]['campo'] = 'oldidmodelo';
$setC[4]['dato'] = $oldidmodelo;
$setC[5]['campo'] = 'oldidvendedor';
$setC[5]['dato'] = $oldidvendedor;
$setC[6]['campo'] = 'estado';
$setC[6]['dato'] = $estado;
$setC[7]['campo'] = 'fecharegistro';
$setC[7]['dato'] = $fecharegistro;
$setC[8]['campo'] = 'hora';
$setC[8]['dato'] = $hora;
$setC[9]['campo'] = 'usuario';
$setC[9]['dato'] = $usuario;
$setC[10]['campo'] = 'idalmacen';
$setC[10]['dato'] = $idalmacen;
$setC[11]['campo'] = 'dato';
$setC[11]['dato'] = $dato;
$sql2 = generarInsertValues($setC);
return "INSERT INTO bitacoraupdate ".$sql2;
}
function finalizandoinserciontraspaso($idventa,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sql[] = "UPDATE concurrenciatraspaso SET estado='libre',idventa='$idventa' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}

function finalizandoyhabilitando($tipohabilita,$idventa,$return = false){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen =$_SESSION['idalmacen'];
    $idusuario = $_SESSION['idusuario'];
    $hora = date("H:i:s");
    $fecha2=time()-3600;
    $hora= date("H:i:s",$fecha2);
    $fecha = date("Y-m-d");

    if($tipohabilita=="traspaso" || $tipohabilita=='traspaso'){
         $sql[] =getSqlNewBitacoraforzar($idusuario, $fecha, $hora, "traspaso-error", $idventa, $idalmacen,false);
    $sql[] = "UPDATE concurrenciatraspaso SET estado='libre',idventa='$idventa' ;";

    } else{
         $sql[] =getSqlNewBitacoraforzar($idusuario, $fecha, $hora, "venta-error", $idventa, $idalmacen,false);
    $sql[] = "UPDATE concurrenciaventa SET estado='libre',idventa='$idventa' ;";

    }
  //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}
function iniciandoinserciontraspaso($idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $sql[] = "UPDATE concurrenciatraspaso SET estado='ocupado',idalmacen='$idalmacen' ;";
    //MostrarConsulta($sql);
    ejecutarConsultaSQLBeginCommit($sql);
}

function getSqlNewBitacoraforzar($idusuario, $fecha, $hora, $accion, $idaccion, $idalmacen, $return){
$setC[0]['campo'] = 'idusuario';
$setC[0]['dato'] = $idusuario;
$setC[1]['campo'] = 'fecha';
$setC[1]['dato'] = $fecha;
$setC[2]['campo'] = 'hora';
$setC[2]['dato'] = $hora;
$setC[3]['campo'] = 'accion';
$setC[3]['dato'] = $accion;
$setC[4]['campo'] = 'idaccion';
$setC[4]['dato'] = $idaccion;
$setC[5]['campo'] = 'idalmacen';
$setC[5]['dato'] = $idalmacen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO bitacoraforzar ".$sql2;
}
?>