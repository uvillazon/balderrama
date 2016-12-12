<?php
function getSqlNewKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $saldocantidad, $cantidad, $numero, $talla, $precio1bs, $precio2bs, $precio3bs, $precio1sus, $precio2sus, $precio3sus, $idcalzado, $idoperacion, $codigobarraean13, $return){
    $setC[0]['campo'] = 'idkardextienda';
    $setC[0]['dato'] = $idkardextienda;
    $setC[1]['campo'] = 'idmodelodetalle';
    $setC[1]['dato'] = $idmodelodetalle;
    $setC[2]['campo'] = 'idtienda';
    $setC[2]['dato'] = $idtienda;
    $setC[3]['campo'] = 'codigobarra';
    $setC[3]['dato'] = $codigobarra;
    $setC[4]['campo'] = 'saldocantidad';
    $setC[4]['dato'] = $saldocantidad;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;
    $setC[6]['campo'] = 'numero';
    $setC[6]['dato'] = $numero;
    $setC[7]['campo'] = 'talla';
    $setC[7]['dato'] = $talla;
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
    $setC[14]['campo'] = 'idcalzado';
    $setC[14]['dato'] = $idcalzado;
    $setC[15]['campo'] = 'idoperacion';
    $setC[15]['dato'] = $idoperacion;
    $setC[16]['campo'] = 'codigobarraean13';
    $setC[16]['dato'] = $codigobarraean13;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adicionkardextienda ".$sql2;
}

function getSqlNewMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $numero, $saldocantidad, $return){
    $setC[0]['campo'] = 'idmovimientokardextienda';
    $setC[0]['dato'] = $idmovimientokardextienda;
    $setC[1]['campo'] = 'idkardextienda';
    $setC[1]['dato'] = $idkardextienda;
    $setC[2]['campo'] = 'idtienda';
    $setC[2]['dato'] = $idtienda;
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
    $setC[13]['campo'] = 'numero';
    $setC[13]['dato'] = $numero;
    $setC[14]['campo'] = 'saldocantidad';
    $setC[14]['dato'] = $saldocantidad;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adicionmovimientokardextienda ".$sql2;
}
function getSqlNewCodigonumeracion($idcodigonumeracion, $idcoleccion, $codigobarra, $return){
    $setC[0]['campo'] = 'idcodigonumeracion';
    $setC[0]['dato'] = $idcodigonumeracion;
    $setC[1]['campo'] = 'idcoleccion';
    $setC[1]['dato'] = $idcoleccion;
    $setC[2]['campo'] = 'codigobarra';
    $setC[2]['dato'] = $codigobarra;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO codigonumeracion ".$sql2;
}
function ObtenerCodigoBarraMarcaDetalle($idmarca , $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $sqlMarca = "
SELECT
  mar.codigobarra
FROM
  `marcas` mar
WHERE
  mar.idmarca = '$idmarca'
";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "codigobarra");
    $codigomarca = $codigomarcaA['resultado'];
    $sqlcoleccion = "
SELECT
  cco.idmarca,
  cco.idcoleccion,
  cco.codigobarra
FROM
  `coleccion` cco
WHERE
  cco.idmarca = '$idmarca'AND cco.estado='VIGENTE' order by(cco.idcoleccion) DESC limit 1
";
    $codigocoleccionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "codigobarra");
    $codigocoleccion = $codigocoleccionA['resultado'];
    $idcoleccionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
    $idcoleccion = $idcoleccionA['resultado'];
    $sqlnumeracion = "
SELECT
  con.idcodigonumeracion,
  con.idcoleccion,
  con.codigobarra
FROM
  codigonumeracion con
WHERE
  con.idcoleccion = '$idcoleccion' order by(con.idcodigonumeracion) DESC limit 1
";
    $codigonumeracionA = findBySqlReturnCampoUnique($sqlnumeracion, true, true, "codigobarra");
    $codigonumeracion = $codigonumeracionA['resultado']+1;
    $dato = $codigomarca.$codigocoleccion.$codigonumeracion;
    $sql[] = getSqlNewCodigonumeracion($idcodigonumeracion, $idcoleccion, $codigonumeracion, false);
    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $dato;
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
?>