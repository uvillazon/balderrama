<?php
function getSqlNewDetalleingresoalmacen($iddetalleingresoalmacen, $idmodelo, $totalpares, $totalcajas, $totalbs, $precio1sus, $precio2sus, $precio3sus, $idcliente, $idvendedor, $idingreso, $numero, $idkardexalmacen, $observacion, $return){
$setC[0]['campo'] = 'iddetalleingresoalmacen';
$setC[0]['dato'] = $iddetalleingresoalmacen;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'totalpares';
$setC[2]['dato'] = $totalpares;
$setC[3]['campo'] = 'totalcajas';
$setC[3]['dato'] = $totalcajas;
$setC[4]['campo'] = 'totalbs';
$setC[4]['dato'] = $totalbs;
$setC[5]['campo'] = 'precio1sus';
$setC[5]['dato'] = $precio1sus;
$setC[6]['campo'] = 'precio2sus';
$setC[6]['dato'] = $precio2sus;
$setC[7]['campo'] = 'precio3sus';
$setC[7]['dato'] = $precio3sus;
$setC[8]['campo'] = 'idcliente';
$setC[8]['dato'] = $idcliente;
$setC[9]['campo'] = 'idvendedor';
$setC[9]['dato'] = $idvendedor;
$setC[10]['campo'] = 'idingreso';
$setC[10]['dato'] = $idingreso;
$setC[11]['campo'] = 'numero';
$setC[11]['dato'] = $numero;
$setC[12]['campo'] = 'idkardexalmacen';
$setC[12]['dato'] = $idkardexalmacen;
$setC[13]['campo'] = 'observacion';
$setC[13]['dato'] = $observacion;
$sql2 = generarInsertValues($setC);
return "INSERT INTO detalleingresoalmacen ".$sql2;
}




function getSqlNewIngresoalmacen($idingreso, $numerofactura, $numero, $idpedido, $idconfirmarpedido, $estado, $fecha, $hora, $totalcajas, $totalpares, $totalbs, $totalsus, $montototal, $responsable, $observacion, $idmarca, $idempleado, $idalmacen,$generado, $return){
$setC[0]['campo'] = 'idingreso';
$setC[0]['dato'] = $idingreso;
$setC[1]['campo'] = 'numerofactura';
$setC[1]['dato'] = $numerofactura;
$setC[2]['campo'] = 'numero';
$setC[2]['dato'] = $numero;
$setC[3]['campo'] = 'idpedido';
$setC[3]['dato'] = $idpedido;
$setC[4]['campo'] = 'idconfirmarpedido';
$setC[4]['dato'] = $idconfirmarpedido;
$setC[5]['campo'] = 'estado';
$setC[5]['dato'] = $estado;
$setC[6]['campo'] = 'fecha';
$setC[6]['dato'] = $fecha;
$setC[7]['campo'] = 'hora';
$setC[7]['dato'] = $hora;
$setC[8]['campo'] = 'totalcajas';
$setC[8]['dato'] = $totalcajas;
$setC[9]['campo'] = 'totalpares';
$setC[9]['dato'] = $totalpares;
$setC[10]['campo'] = 'totalbs';
$setC[10]['dato'] = $totalbs;
$setC[11]['campo'] = 'totalsus';
$setC[11]['dato'] = $totalsus;
$setC[12]['campo'] = 'montototal';
$setC[12]['dato'] = $montototal;
$setC[13]['campo'] = 'responsable';
$setC[13]['dato'] = $responsable;
$setC[14]['campo'] = 'observacion';
$setC[14]['dato'] = $observacion;
$setC[15]['campo'] = 'idmarca';
$setC[15]['dato'] = $idmarca;
$setC[16]['campo'] = 'idempleado';
$setC[16]['dato'] = $idempleado;
$setC[17]['campo'] = 'idalmacen';
$setC[17]['dato'] = $idalmacen;
$setC[18]['campo'] = 'generado';
$setC[18]['dato'] = $generado;
$sql2 = generarInsertValues($setC);
return "INSERT INTO ingresoalmacen ".$sql2;
}

function getSqlNewKardexalmacen($idkardexalmacen, $idmodelo, $idmarca, $codigobarra, $saldocantidadcaja, $cantidadcaja, $cantidadpares, $numero, $precio1bs, $precio2bs, $precio3bs, $precio1sus, $precio2sus, $precio3sus, $idoperacion, $codigobarraean13,$generado, $return){
$setC[0]['campo'] = 'idkardexalmacen';
$setC[0]['dato'] = $idkardexalmacen;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'codigobarra';
$setC[3]['dato'] = $codigobarra;
$setC[4]['campo'] = 'saldocantidadcaja';
$setC[4]['dato'] = $saldocantidadcaja;
$setC[5]['campo'] = 'cantidadcaja';
$setC[5]['dato'] = $cantidadcaja;
$setC[6]['campo'] = 'cantidadpares';
$setC[6]['dato'] = $cantidadpares;
$setC[7]['campo'] = 'numero';
$setC[7]['dato'] = $numero;
$setC[8]['campo'] = 'precio1bs';
$setC[8]['dato'] = $precio1bs;
$setC[9]['campo'] = 'precio2bs';
$setC[9]['dato'] = $precio2bs;
$setC[10]['campo'] = 'precio3bs';
$setC[10]['dato'] = $precio3bs;
$setC[11]['campo'] = 'precio1sus';
$setC[11]['dato'] = $precio1sus;
$setC[12]['campo'] = 'precio2sus';
$setC[12]['dato'] = $precio2sus;
$setC[13]['campo'] = 'precio3sus';
$setC[13]['dato'] = $precio3sus;
$setC[14]['campo'] = 'idoperacion';
$setC[14]['dato'] = $idoperacion;
$setC[15]['campo'] = 'codigobarraean13';
$setC[15]['dato'] = $codigobarraean13;
$setC[16]['campo'] = 'generado';
$setC[16]['dato'] = $generado;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexalmacen ".$sql2;
}
function getSqlNewMovimientokardexalmacen($idmovimientokardexalmacen, $idkardexalmacen, $idoficina, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $operacion, $numero, $saldocantidad, $return){
$setC[0]['campo'] = 'idmovimientokardexalmacen';
$setC[0]['dato'] = $idmovimientokardexalmacen;
$setC[1]['campo'] = 'idkardexalmacen';
$setC[1]['dato'] = $idkardexalmacen;
$setC[2]['campo'] = 'idoficina';
$setC[2]['dato'] = $idoficina;
$setC[3]['campo'] = 'entrada';
$setC[3]['dato'] = $entrada;
$setC[4]['campo'] = 'salida';
$setC[4]['dato'] = $salida;
$setC[5]['campo'] = 'saldo';
$setC[5]['dato'] = $saldo;
$setC[6]['campo'] = 'costounitario';
$setC[6]['dato'] = $costounitario;
$setC[7]['campo'] = 'ingreso';
$setC[7]['dato'] = $ingreso;
$setC[8]['campo'] = 'egreso';
$setC[8]['dato'] = $egreso;
$setC[9]['campo'] = 'saldobs';
$setC[9]['dato'] = $saldobs;
$setC[10]['campo'] = 'fecha';
$setC[10]['dato'] = $fecha;
$setC[11]['campo'] = 'hora';
$setC[11]['dato'] = $hora;
$setC[12]['campo'] = 'descripcion';
$setC[12]['dato'] = $descripcion;
$setC[13]['campo'] = 'operacion';
$setC[13]['dato'] = $operacion;
$setC[14]['campo'] = 'numero';
$setC[14]['dato'] = $numero;
$setC[15]['campo'] = 'saldocantidad';
$setC[15]['dato'] = $saldocantidad;
$sql2 = generarInsertValues($setC);
return "INSERT INTO movimientokardexalmacen ".$sql2;
}

function getSqlNewDetallepedido($iddetallepedido, $numerocajas, $numeropares, $cliente, $vendedor, $idmodelo, $numero, $color, $material, $totalSus, $costounitario, $stylename, $linea, $idpedido, $codigo, $idconfirmarpedido, $idfacturapedido, $return){
    $setC[0]['campo'] = 'iddetallepedido';
    $setC[0]['dato'] = $iddetallepedido;
    $setC[1]['campo'] = 'numerocajas';
    $setC[1]['dato'] = $numerocajas;
    $setC[2]['campo'] = 'numeropares';
    $setC[2]['dato'] = $numeropares;
    $setC[3]['campo'] = 'cliente';
    $setC[3]['dato'] = $cliente;
    $setC[4]['campo'] = 'vendedor';
    $setC[4]['dato'] = $vendedor;
    $setC[5]['campo'] = 'idmodelo';
    $setC[5]['dato'] = $idmodelo;
    $setC[6]['campo'] = 'numero';
    $setC[6]['dato'] = $numero;
    $setC[7]['campo'] = 'color';
    $setC[7]['dato'] = $color;
    $setC[8]['campo'] = 'material';
    $setC[8]['dato'] = $material;
    $setC[9]['campo'] = 'totalSus';
    $setC[9]['dato'] = $totalSus;
    $setC[10]['campo'] = 'costounitario';
    $setC[10]['dato'] = $costounitario;
    $setC[11]['campo'] = 'stylename';
    $setC[11]['dato'] = $stylename;
    $setC[12]['campo'] = 'linea';
    $setC[12]['dato'] = $linea;
    $setC[13]['campo'] = 'idpedido';
    $setC[13]['dato'] = $idpedido;
    $setC[14]['campo'] = 'codigo';
    $setC[14]['dato'] = $codigo;
    $setC[15]['campo'] = 'idconfirmarpedido';
    $setC[15]['dato'] = $idconfirmarpedido;
    $setC[16]['campo'] = 'idfacturapedido';
    $setC[16]['dato'] = $idfacturapedido;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO detallepedido ".$sql2;
}


function getSqlUpdateDetallepedido($iddetallepedido,$numerocajas,$numeropares,$cliente,$vendedor,$idmodelo,$numero,$color,$material,$totalSus,$costounitario,$stylename,$linea,$idpedido,$codigo,$idconfirmarpedido,$idfacturapedido,$idkardexalmacen,$return){
    $setC[0]['campo'] = 'numerocajas';
    $setC[0]['dato'] = $numerocajas;
    $setC[1]['campo'] = 'numeropares';
    $setC[1]['dato'] = $numeropares;
    $setC[2]['campo'] = 'cliente';
    $setC[2]['dato'] = $cliente;
    $setC[3]['campo'] = 'vendedor';
    $setC[3]['dato'] = $vendedor;
    $setC[4]['campo'] = 'numero';
    $setC[4]['dato'] = $numero;
    $setC[5]['campo'] = 'color';
    $setC[5]['dato'] = $color;
    $setC[6]['campo'] = 'material';
    $setC[6]['dato'] = $material;
    $setC[7]['campo'] = 'totalSus';
    $setC[7]['dato'] = $totalSus;
    $setC[8]['campo'] = 'costounitario';
    $setC[8]['dato'] = $costounitario;
    $setC[9]['campo'] = 'stylename';
    $setC[9]['dato'] = $stylename;
    $setC[10]['campo'] = 'linea';
    $setC[10]['dato'] = $linea;
    $setC[11]['campo'] = 'codigo';
    $setC[11]['dato'] = $codigo;
    $setC[12]['campo'] = 'idmodelo';
    $setC[12]['dato'] = $idmodelo;
    $setC[13]['campo'] = 'idpedido';
    $setC[13]['dato'] = $idpedido;
    $setC[14]['campo'] = 'idconfirmarpedido';
    $setC[14]['dato'] = $idconfirmarpedido;
    $setC[15]['campo'] = 'idfacturapedido';
    $setC[15]['dato'] = $idfacturapedido;
    $setC[16]['campo'] = 'idkardexalmacen';
    $setC[16]['dato'] = $idkardexalmacen;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'iddetallepedido';
    $wher[0]['dato'] = $iddetallepedido;


    $where = generarWhereUpdate($wher);
    return "UPDATE detallepedido SET ".$set." WHERE ".$where;
}




function getSqlDeleteDetallepedido($iddetallepedido){
    return "DELETE FROM detallepedido WHERE iddetallepedido ='$iddetallepedido';";
}
function getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidad, $iddetallepedido, $return){
    $setC[0]['campo'] = 'iddetallepedidotalla';
    $setC[0]['dato'] = $iddetallepedidotalla;
    $setC[1]['campo'] = 'idmodelo';
    $setC[1]['dato'] = $idmodelo;
    $setC[2]['campo'] = 'talla';
    $setC[2]['dato'] = $talla;
    $setC[3]['campo'] = 'cantidad';
    $setC[3]['dato'] = $cantidad;
    $setC[4]['campo'] = 'iddetallepedido';
    $setC[4]['dato'] = $iddetallepedido;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO detallepedidotalla ".$sql2;
}


function getSqlUpdateDetallepedidotalla($iddetallepedidotalla,$idmodelo,$talla,$cantidad,$iddetallepedido, $return){
    $setC[0]['campo'] = 'talla';
    $setC[0]['dato'] = $talla;
    $setC[1]['campo'] = 'cantidad';
    $setC[1]['dato'] = $cantidad;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'iddetallepedidotalla';
    $wher[0]['dato'] = $iddetallepedidotalla;
    $wher[1]['campo'] = 'idmodelo';
    $wher[1]['dato'] = $idmodelo;
    $wher[2]['campo'] = 'iddetallepedido';
    $wher[2]['dato'] = $iddetallepedido;

    $where = generarWhereUpdate($wher);
    return "UPDATE detallepedidotalla SET ".$set." WHERE ".$where;
}




function getSqlDeleteDetallepedidotalla($iddetallepedidotalla){
    return "DELETE FROM detallepedidotalla WHERE iddetallepedidotalla ='$iddetallepedidotalla';";
}
function getSqlDeleteDetallepedidotallaByDetallePedido($iddetallepedidotalla){
    return "DELETE FROM detallepedidotalla WHERE iddetallepedido ='$iddetallepedidotalla';";
}
?>