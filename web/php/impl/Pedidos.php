<?php
function getSqlNewNumeropedido($idnumero, $idmarca, $numero, $return){
    $setC[0]['campo'] = 'idnumero';
    $setC[0]['dato'] = $idnumero;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO numeropedido ".$sql2;
}


function getSqlUpdateNumeropedido($idnumero,$idmarca,$numero, $return){
    $setC[0]['campo'] = 'numero';
    $setC[0]['dato'] = $numero;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idnumero';
    $wher[0]['dato'] = $idnumero;
    $wher[1]['campo'] = 'idmarca';
    $wher[1]['dato'] = $idmarca;

    $where = generarWhereUpdate($wher);
    return "UPDATE numeropedido SET ".$set." WHERE ".$where;
}




function getSqlDeleteNumeropedido($idnumeropedido){
    return "DELETE FROM numeropedido WHERE idnumeropedido ='$idnumeropedido';";
}
function getSqlNewPedidos($idpedido, $idmarca, $fecha, $observacion, $totalpares, $totalcajas, $numeropedido, $responsable, $estado, $numero, $hora, $np, $return){
    $setC[0]['campo'] = 'idpedido';
    $setC[0]['dato'] = $idpedido;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'fecha';
    $setC[2]['dato'] = $fecha;
    $setC[3]['campo'] = 'observacion';
    $setC[3]['dato'] = $observacion;
    $setC[4]['campo'] = 'totalpares';
    $setC[4]['dato'] = $totalpares;
    $setC[5]['campo'] = 'totalcajas';
    $setC[5]['dato'] = $totalcajas;
    $setC[6]['campo'] = 'numeropedido';
    $setC[6]['dato'] = $numeropedido;
    $setC[7]['campo'] = 'responsable';
    $setC[7]['dato'] = $responsable;
    $setC[8]['campo'] = 'estado';
    $setC[8]['dato'] = $estado;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;
    $setC[10]['campo'] = 'hora';
    $setC[10]['dato'] = $hora;
    $setC[11]['campo'] = 'np';
    $setC[11]['dato'] = $np;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO pedidos ".$sql2;
}


function getSqlUpdatePedidos($idpedido,$idmarca,$fecha,$observacion,$totalpares,$totalcajas,$numeropedido,$responsable,$estado,$numero,$hora,$np, $return){
    $setC[0]['campo'] = 'fecha';
    $setC[0]['dato'] = $fecha;
    $setC[1]['campo'] = 'observacion';
    $setC[1]['dato'] = $observacion;
    $setC[2]['campo'] = 'totalpares';
    $setC[2]['dato'] = $totalpares;
    $setC[3]['campo'] = 'totalcajas';
    $setC[3]['dato'] = $totalcajas;
    $setC[4]['campo'] = 'numeropedido';
    $setC[4]['dato'] = $numeropedido;
    $setC[5]['campo'] = 'responsable';
    $setC[5]['dato'] = $responsable;
    $setC[6]['campo'] = 'estado';
    $setC[6]['dato'] = $estado;
    $setC[7]['campo'] = 'numero';
    $setC[7]['dato'] = $numero;
    $setC[8]['campo'] = 'hora';
    $setC[8]['dato'] = $hora;
    $setC[9]['campo'] = 'np';
    $setC[9]['dato'] = $np;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idpedido';
    $wher[0]['dato'] = $idpedido;
    $wher[1]['campo'] = 'idmarca';
    $wher[1]['dato'] = $idmarca;

    $where = generarWhereUpdate($wher);
    return "UPDATE pedidos SET ".$set." WHERE ".$where;
}
function buscarPedidoPorId($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "
SELECT
  ped.idpedido,
  ped.idmarca,
  ped.fecha,
  ped.observacion,
  ped.totalpares,
  ped.totalcajas,
  ped.numeropedido,
  ped.responsable,
  ped.estado,
  ped.numero,
  ped.hora,
  ped.np,
  mar.nombre,
mar.opcion
FROM
  `pedidos` ped,
  `marcas` mar
WHERE
  ped.idpedido = '$codigo' AND
  ped.idmarca = mar.idmarca
";


    if($codigo != null)
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
                        $dev['mensaje'] = "Vuelva a ingresar otro dato por que no se encontro datos en la CONSULTA";
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



function getSqlDeletePedidos($idpedidos){
    return "DELETE FROM pedidos WHERE idpedidos ='$idpedidos';";
}
function ListarPedidos($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
    else{
        $sort = "fecha";
        $dir = "DESC";
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
     SELECT pe.idpedido, pe.fecha, pe.observacion, SUM( dp.numerocajas ) AS totalcajas, SUM( dp.numeropares ) AS totalpares, pe.responsable, pe.numeropedido, pe.hora, pe.estado, us.nombre AS responsable, ma.nombre AS marca
FROM `pedidos` pe, detallepedido dp, `marcas` ma, `usuario` us
WHERE pe.idpedido = dp.idpedido
AND pe.responsable = us.idusuario
AND pe.idmarca = ma.idmarca
AND pe.estado != 'COMPLETADO' AND dp.idconfirmarpedido IS NULL GROUP BY pe.idpedido $order LIMIT $start,$limit ";



    }
    else
    {
        $sql = "
SELECT pe.idpedido, pe.fecha, pe.observacion, SUM( dp.numerocajas ) AS totalcajas, SUM( dp.numeropares ) AS totalpares, pe.responsable, pe.numeropedido, pe.hora, pe.estado, us.nombre AS responsable, ma.nombre AS marca
FROM `pedidos` pe, detallepedido dp, `marcas` ma, `usuario` us
WHERE pe.idpedido = dp.idpedido
AND pe.responsable = us.idusuario
AND pe.idmarca = ma.idmarca AND $where
        GROUP BY pe.idpedido $order LIMIT $start,$limit";

    }
    //        echo $sql;
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
    $dev1 = NumeroTuplas($sql);
    $dev['totalCount'] = $dev1['resultado'];
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
function BuscarModeloPorIdtiendaRegistrarColorPedido($codigocompleto,$idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $codigocolor= split("-",$codigocompleto);
 //$idsCAr = split("/", $mesplanilla);
$codigobuscar=$codigocolor[0];
$colorbuscar=$codigocolor[1];
//function verificarValidarTextWithCondition($dato, $existe, $tabla, $campo,$idvalor,$valor){
$codigoB = verificarValidarTextWithCondition($colorbuscar, false, "colores", "nombre","idmarca",$idmarca);
      if($codigoB['error']==true){

$codigobarraA = ObtenerColorNuevo($idmarca,$colorbuscar , true);
       $idcolor = $codigobarraA['resultado'];
        $colorbuscar = $codigocolor[1];

      }else {
          $colorbuscar = $codigocolor[1];
      }
 $codigoB = verificarValidarTextWithCondition($codigobuscar, false, "modelos", "codigo","idmarca",$idmarca);
      if($codigoB['error']==true){
  $sqlcoleccion = "
SELECT
  idcoleccion
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
    $sqllinea = "
SELECT
  idlinea
FROM
  lineas
WHERE
  idmarca = '$idmarca' AND idcoleccion='$idcoleccion'
";
    $opcionA = findBySqlReturnCampoUnique($sqllinea, true, true, "idlinea");
   $idlinea = $opcionA['resultado'];

$codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigobuscar,$colorbuscar ,"est-0", true);
       $idmodelo = $codigobarraA['resultado'];

$sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  '$colorbuscar' AS color,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.idmodelo = '$idmodelo';
";

      }else {
      $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  '$colorbuscar' AS color,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.codigo = '$codigobuscar';
";

      }
   //   echo $sql;
    if($codigocompleto != null)
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
                        $dev['mensaje'] = "Vuelva a ingresar otro dato por que no se encontro datos en la CONSULTA";
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
function BuscarModeloPorIdtiendaRegistrarModeloPedido($codigocompleto, $idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

//echo $colorbuscar;

 //  echo $idcoleccion;

$sqlcoleccion1 = "
SELECT
  idcoleccion
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
 //  echo $idcoleccion;
$codigobarraA1 = ObtenerLineaNuevo($idmarca,$lineabuscar,'est-0',$idcoleccion, true);
       $idlinea = $codigobarraA1['resultado'];
       // $lineabuscar = $lineabuscar[0];

//function verificarValidarTextWithCondition($dato, $existe, $tabla, $campo,$idvalor,$valor){

 $codigoB = verificarValidarTextWithCondition($codigocompleto, false, "modelos", "codigo","idmarca",$idmarca);
      if($codigoB['error']==true){
  $codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigocompleto,$colorbuscar ,'est-0', true);
       $idmodelo = $codigobarraA['resultado'];
    //   echo $idmarca;
// $sql = "
//SELECT
//  mo.idmodelo,
//  mo.idmarca,
//  CONCAT(mo.codigo,' - ',dtp.material) AS codigo,
//  mo.numero,
//  mo.precio,
//  mo.stylename,
//  mo.idcoleccion,
//  mo.idlinea,
//  mo.detalle,
//  mo.imagen,
//  li.codigo AS linea
//FROM
//  `modelos` mo,adiciondetalleingreso dtp,
//  `lineas` li
//WHERE
// dtp.idmodelo = mo.idmodelo AND mo.idlinea = li.idlinea AND
//  mo.idmodelo= '$codigo';

$sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
'$codigocompleto' AS codigo,
  mo.numero,
  mo.precio,
   mo.stylename,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.idmodelo = '$idmodelo';
";

      }else {

   //echo $colorencontrado;
      $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,'$codigocompleto' AS codigo,
  mo.numero,
  mo.precio,
   mo.stylename,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.codigo = '$codigocompleto';
";

      }
    // echo $sql;
    if($codigocompleto != null)
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
                        $dev['mensaje'] = "Vuelva a ingresar otro dato por que no se encontro datos en la CONSULTA";
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

function BuscarModeloPorIdtiendaRegistrarLineaPedido($codigocompleto, $idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $codigocolor= split("-",$codigocompleto);
 //$idsCAr = split("/", $mesplanilla);
$lineabuscar=$codigocolor[0];
$codigobuscar=$codigocolor[1];
$colorbuscar=$codigocolor[2];
//$opciont=$codigocolor[3];
//echo $colorbuscar;
$sqlcolor = "
SELECT
  idcolor
FROM
  colores
WHERE
  idmarca = '$idmarca' AND nombre= '$colorbuscar'
";
    $opcionA3 = findBySqlReturnCampoUnique($sqlcolor, true, true, "idcolor");
   $idcolor= $opcionA3['resultado'];
  $codigoB1 = verificarValidarTextWithCondition($lineabuscar, false, "lineas", "codigo","idmarca",$idmarca);
      if($codigoB1['error']==true){
$sqlcoleccion1 = "
SELECT
  idcoleccion
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
$codigobarraA1 = ObtenerLineaNuevoPedido($idmarca,$lineabuscar,"est-0",$idcoleccion, true);
       $idlinea = $codigobarraA1['resultado'];
        $lineabuscar=$codigocolor[0];
      }else {
         $lineabuscar=$codigocolor[0];
      }
//function verificarValidarTextWithCondition($dato, $existe, $tabla, $campo,$idvalor,$valor){
$codigoB = verificarValidarTextWithCondition($colorbuscar, false, "colores", "nombre","idmarca",$idmarca);
      if($codigoB['error']==true){

$codigobarraA = ObtenerColorNuevo($idmarca,$colorbuscar , true);
       $idcolor = $codigobarraA['resultado'];
$sqllinea = "
SELECT
  nombre
FROM
  colores
WHERE
  idmarca = '$idmarca' AND idcolor='$idcolor'
";
    $opcionA = findBySqlReturnCampoUnique($sqllinea, true, true, "nombre");
   $colorbuscar= $opcionA['resultado'];
      }else {
          $sqlcolor = "
SELECT
  idcolor,nombre
FROM
  colores
WHERE
  idmarca = '$idmarca' AND nombre= '$colorbuscar'
";
    $opcionA3 = findBySqlReturnCampoUnique($sqlcolor, true, true, "idcolor");
   $idcolor= $opcionA3['resultado'];
    $opcionA31 = findBySqlReturnCampoUnique($sqlcolor, true, true, "nombre");
   $colorencontrado= $opcionA31['resultado'];

      }
 $codigoB = verificarValidarTextWithCondition($codigobuscar, false, "modelos", "codigo","idmarca",$idmarca);
      if($codigoB['error']==true){
  $sqlcoleccion = "
SELECT
  idcoleccion
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];

$codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigobuscar,$colorbuscar ,"est-0", true);
       $idmodelo = $codigobarraA['resultado'];
    //   echo $idmarca;
$sqlcolor = "
SELECT
  nombre
FROM
  colores
WHERE
  idmarca = '$idmarca' AND idcolor= '$idcolor'
";
    $opcionA3 = findBySqlReturnCampoUnique($sqlcolor, true, true, "nombre");
   $colorencontrado= $opcionA3['resultado'];
$sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
   mo.stylename,lin.codigo AS linea,
  '$colorencontrado' AS color,0 AS precio, 0 AS opciont
FROM
  `modelos` mo,`lineas` lin
WHERE
  mo.idmodelo = '$idmodelo' AND mo.idlinea=lin.idlinea;
";

      }else {

   //echo $colorencontrado;
      $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
   mo.stylename,lin.codigo  AS linea,
'$colorencontrado' AS color,0 AS precio,0 AS opciont
FROM
  `modelos` mo ,`lineas` lin
WHERE
  mo.codigo = '$codigobuscar'AND mo.idlinea=lin.idlinea;
";

      }
 //    echo $sql;
    if($codigocompleto != null)
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
                        $dev['mensaje'] = "Vuelva a ingresar otro dato por que no se encontro datos en la CONSULTA";
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
function ObtenerLineaNuevoPedido($idmarca,$lineabuscar,$idestilo,$idcoleccion, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   $numeroA = findUltimoID("lineas", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idlinea = 'lin-'.$numero;
    $sql[] = getSqlNewLineas($idlinea, $lineabuscar, $descripcion, $numero, $idmarca, 'est-0', $idcoleccion, false);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idlinea;
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
function GuardarNuevoPedido($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $numeroA = findUltimoID("pedidos", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idpedido="ped-".$numero;
    $ingreso = $resultado->ingreso;
    $numeropedido = $ingreso->numeropedido;
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $totalpares = $ingreso->totalpares;
    $totalcajas = $ingreso->totalcaja;
    $responsable = $_SESSION['idusuario'];
    $idmarca = $ingreso->idmarca;
    $observacion = $ingreso->descripcion;

    $sql[]=getSqlNewPedidos($idpedido, $idmarca, $fecha, $observacion, $totalpares, $totalcajas, $numeropedido, $responsable, $estado, $numero, $hora, $np, $return);
    //    $sql[]=getSqlNewIngresotienda($idingreso, $codigo, $numero, $estado, $fecha, $hora, $totalpares, $totalbs, $responsable, $observacion, $idmarca, $idtienda, false);
    //    echo $idventa;

    $sqlmarca = "
SELECT
  mar.opcion
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
    $calzados = $resultado->calzados;
    $numeropedidoA = findUltimoNumeroPedidoMarca($idmarca, true);
    $numero1 = $numeropedidoA['resultado']+1;
    $sql[] =getSqlNewNumeropedido($idnumero, $idmarca, $numero1, $return);
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $numeroD = findUltimoID("detallepedido", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;


    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $codigocalzado = $calzado->codigo;
        $idmodelo = $calzado->idmodelo;
        $color = $calzado->color;
        $material = $calzado->material;
        $cliente = $calzado->cliente;
        $vendedor = $calzado->vendedor;
        $linea = $calzado->linea;
        $numeropares = $calzado->totalpares;
        $numerocajas = $calzado->totalcajas;
        $stylename = $calzado->stylename;
        //        $precio = $calzado->precio;
        $iddetallepedido = "dpe-".$numerodetalle;
        $sql[] = getSqlNewDetallepedido($iddetallepedido, $numerocajas, $numeropares, $cliente, $vendedor, $idmodelo, $numerodetalle, $color, $material, 0, 0, $stylename, $linea,$idpedido,$codigocalzado,"","", $return);
        //        $sql[] =getSqlNewDetalleingreso($idmodelo, $numeropares, $numerocajas, $idingreso, $iddetalleingreso, $numerodetalle, false);
        $numerodetalle++;
        //        $codigobarraA = ObtenerCodigoBarraMarcaDetalle($idmarca , true);
        //        $codigobarramcn = $codigobarraA['resultado'];
        //        echo $codigobarramcn;
        $americano = $calzado->opcion;
        if($americano == 'americano'){
            for($i=1;$i<=12;$i++){
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;

                if($cantidad1 !=0){

                    $talla = $i;
                    $sql[]= getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidad1, $iddetallepedido, $return);
                    //
                    //               $sql[]= getSqlNewDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad1, false);

                }
                if($cantidadm !=0){

                    $talla = $i."m";
                    $sql[]= getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidadm, $iddetallepedido, $return);
                    //
                    //               $sql[]= getSqlNewDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad1, false);

                }
            }

        }
        else{


            for($i=14;$i<=45;$i++){
                $cantidad1 = $calzado->$i;
                if($cantidad1 !=0){

                    $talla = $i;
                    $sql[]= getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidad1, $iddetallepedido, $return);
                    //                $sql[]= getSqlNewDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad1, false);

                }
            }
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

function ListarPedidoEmergente($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ped.idpedido,
  ped.numeropedido,
  ped.idmarca
FROM
  `pedidos` ped
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
?>