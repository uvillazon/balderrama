<?php
function ProcesarDatosLectorKardex($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idempresa = $resultado->idempresa;
  $mesplanilla = $resultado->planilla;
  $pagopendiente = $resultado->pagopendiente;


 $sql ="
SELECT codigobarra
FROM validacioncodigo GROUP BY codigobarra
";

//validarcreditosanteriores($idempresa, $mesplanilla,false);

 // $res= actualizarplanillaempresa($idempresa, $mesplanilla,false);
  //      $idmovimientoplanilla = $res['resultado'];
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
                                mysql_field_name($re, $i) == "codigobarra";
                                $codigobarra = $fi[$i];
                                //echo $idclienteempresa;
                                 
                                  $sql4 = "SELECT count(codigobarra) AS par FROM validacioncodigo WHERE codigobarra ='$codigobarra'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "par");
   $conteopares = $paresd['resultado'];

actualizarkardextiendalector($codigobarra,$conteopares,$marca,"-",false);


                        }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}

function actualizarkardextiendalector($codigobarra,$conteopares,$marca,$detalle,$return){
$emitido="1";
//echo $mesplanilla;
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
//
//$sql1 = "SELECT *
//  FROM adicionkardextienda WHERE codigobarra= '$codigobarra'";
//    //echo $sql1;
//    $result1d = findBySqlReturnCampoUnique($sql1, true, true, "idclienteempresa");
//    $idclienteempresa = $result1d['resultado'];
//       $result1 = findBySqlReturnCampoUnique($sql1, true, true, "meses");
//    $meses = $result1['resultado'];
//     $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempresa");
//    $idempresa = $result1['resultado'];
// $sqlA[] = "UPDATE adicionkardextienda SET cantidadlector= '$conteopares' WHERE codigobarra= '$codigobarra' and unido ='no';";

 $sqlA[] = "UPDATE adicionkardextienda SET cantidadlector= '$conteopares',validacionnike='existe' WHERE codigobarra= '$codigobarra'  and unido='no';";
// $sqlA[] = "UPDATE validacioncodigo SET cantidad= '$conteopares' WHERE codigobarra= '$codigobarra' ;";

// $sqlA[] = "UPDATE historialkardextienda SET cantidadlector= '$conteopares' WHERE codigobarra= '$codigobarra' and unido ='no' and idperiodo='3';";

//$idplanillaemitida
MostrarConsulta($sqlA);
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
function buscarModeloporIdUnion($codigo,$idmarca, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //echo $opcion;WESTCOAST
   $sql ="
SELECT dtp.idmodelo,dtp.iddetalleingreso,mdd.codigo AS codigo, dtp.totalpares, dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.idmarca='$idmarca' AND mdd.idmodelo='$codigo' AND dtp.unido='no'
";

            //  echo $sql;observa
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
//LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla

$sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";

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

function ObtenerColorNuevo($idmarca,$colorbuscar , $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
    $idcodigoA = findUltimoID("colores", "numero", true);
    $numero1= $idcodigoA['resultado']+1;
    $idcolor = 'col-'.$numero1;

    $sql[] = getSqlNewColores($idcolor,$colorbuscar,$descripcion,$codigo,$numero1,"",$idmarca, false);
     $sql[] = getSqlNewColor_marca($idcolor, $idmarca, "0", "si", false);
     $sqllinea = "
SELECT
  nombre
FROM
  colores
WHERE
  idmarca = '$idmarca' AND idcolor='$idcolor'
";
    $opcionA = findBySqlReturnCampoUnique($sqllinea, true, true, "nombre");
   $colornuevo = $opcionA['resultado'];

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idcolor;
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
function ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigobuscar,$colorbuscar ,$idestilo, $opciont,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   //$numeroA = findUltimoID("modelos", "numero", true);
    $sql1 = "SELECT MAX(numero) AS ultimo FROM modelos";
     $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "ultimo");
   $numero = $opcionA['resultado']+1;
    $idmodelo = "mod-".$numero;

    //$codigonumeracion = $codigonumeracionA['resultado']+1;
  $sql[] = getSqlNewModelos($idmodelo, $idmarca, $codigobuscar, $numero, $precio, $idestilo, $idcoleccion, $idlinea, $colorbuscar,$imagen,$opciont, false);
//MostrarConsulta($sql);
 //echo $sql;
    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idmodelo";
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
function BuscarModeloPorIdtiendaRegistrar($codigocompleto, $idestilo,$idmarca,$callback, $_dc, $return= 'true'){
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
  idmarca = '$idmarca' AND idcoleccion='$idcoleccion' AND idestilo='$idestilo'
";
    $opcionA = findBySqlReturnCampoUnique($sqllinea, true, true, "idlinea");
   $idlinea = $opcionA['resultado'];
     //  echo $idlinea;
       
$codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigobuscar,$colorbuscar ,$idestilo,$opciont, true);
       $idmodelo = $codigobarraA['resultado'];
//echo $idmodelo;

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

//echo $idmarca;
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

 $dev['mensaje'] = $mensajeproducto;
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
function ObtenerLineaNuevo($idmarca,$lineabuscar,$idestilo,$idcoleccion, $return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   $numeroA = findUltimoID("lineas", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idlinea = 'lin-'.$numero;
    $sql[] = getSqlNewLineas($idlinea, $lineabuscar, $descripcion, $numero, $idmarca, $idestilo, $idcoleccion, false);
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
}//kidy
function BuscarModeloPorIdtiendaRegistrarLinea($codigocompleto, $idestilo,$idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $codigocolor= split("-",$codigocompleto);
 //$idsCAr = split("/", $mesplanilla);
$lineabuscar=$codigocolor[0];
$codigobuscar=$codigocolor[1];
$colorbuscar=$codigocolor[2];
$opciont=$codigocolor[3];
//echo $lineabuscar;
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
     //     $sql = "SELECT $campo FROM $tabla WHERE $campo = '$dato' AND $idvalor = '$valor'AND $idvalor1 = '$valor1'";
 $sqllineas = "
SELECT
  idlinea
FROM
  lineas
WHERE
  idmarca = '$idmarca' AND codigo='$lineabuscar' AND idestilo='$idestilo' AND idcoleccion='$idcoleccion'
";
    $opcionA = findBySqlReturnCampoUnique($sqllineas, true, true, "idlinea");
   $idlineabusca= $opcionA['resultado'];
  //$codigoB1 = verificarValidarTextWithCondition($lineabuscar, true, "lineas", "codigo","idmarca",$idmarca);
//      if($codigoB1['error']==false){
  if($idlineabusca=='' ||$idlineabusca==null ||$idlineabusca=='NULL' ){

$codigobarraA1 = ObtenerLineaNuevo($idmarca,$lineabuscar,$idestilo,$idcoleccion, true);
       $idlinea = $codigobarraA1['resultado'];
        $lineabuscar=$codigocolor[0];
      }else {
         $lineabuscar=$codigocolor[0];
         $idlinea=$idlineabusca;
      }
     // echo $idlinea;
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
      $sqllineas = "
SELECT
  idmodelo
FROM
  modelos
WHERE
  idmarca = '$idmarca' AND codigo='$codigobuscar' AND stylename='$idestilo'
 AND idcoleccion='$idcoleccion' AND opciont='$opciont' AND idlinea='$idlinea'
";
    //echo $sqllineas,
    $opcionA = findBySqlReturnCampoUnique($sqllineas, true, true, "idmodelo");
   $codigobuscare= $opcionA['resultado'];
  // echo $codigobuscare;
  if($codigobuscare=='' ||$codigobuscare==null ||$codigobuscare=='NULL' ){
 // echo "existe";
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

$codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigobuscar,$colorbuscar ,$idestilo,$opciont, true);
       $idmodelo = $codigobarraA['resultado'];
 // echo $idmodelo;
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
   mo.stylename,'$lineabuscar' AS linea,$opciont AS opciont,
  '$colorencontrado' AS color,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.idmodelo = '$idmodelo' ;
";

      }else {

  // echo "esnuevo";
   $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
   mo.stylename,'$lineabuscar'  AS linea,$opciont AS opciont,
'$colorencontrado' AS color,0 AS precio
FROM
  `modelos` mo 
WHERE
  mo.idmodelo = '$codigobuscare' AND idlinea='$idlinea' ;
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
function BuscarModeloPorIdtiendaRegistrarModelo($codigocompleto, $idestilo,$idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

//echo $colorbuscar;

 //  echo $idcoleccion;
$idestiloregistro = $idestilo;
$sqlcoleccion1 = "
SELECT
  idcoleccion,codigo
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "codigo");
   $coleccionv = $opcionA1['resultado'];

 //  echo $idcoleccion;
$codigobarraA1 = ObtenerLineaNuevo($idmarca,$lineabuscar,$idestilo,$idcoleccion, true);
       $idlinea = $codigobarraA1['resultado'];
       // $lineabuscar = $lineabuscar[0];

//function verificarValidarTextWithCondition($dato, $existe, $tabla, $campo,$idvalor,$valor){
$sqllineas = "
SELECT
  idmodelo
FROM
  modelos
WHERE
  idmarca = '$idmarca' AND codigo='$codigocompleto' AND stylename='$idestilo' AND idcoleccion='$idcoleccion'
";
    $opcionA = findBySqlReturnCampoUnique($sqllineas, true, true, "idmodelo");
   $idlineabusca= $opcionA['resultado'];
  // echo $sqllineas;
  if($idlineabusca=='' ||$idlineabusca==null ||$idlineabusca=='NULL' ){

  $mensajeproducto="es nuevo";
// $codigoB = verificarValidarTextWithCondition($codigocompleto, false, "modelos", "codigo","idmarca",$idmarca);
//      if($codigoB['error']==true){

  $codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigocompleto,$colorbuscar ,$idestiloregistro,$opciont, true);
       $idmodelo = $codigobarraA['resultado'];
    //   echo $idmarca;

$sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
'$codigocompleto' AS codigo,
'$coleccionv' AS coleccion,
  mo.numero,
  mo.precio,
   mo.stylename,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.idmodelo = '$idmodelo';
";

      }else {
 $mensajeproducto="ya existe";
   //echo $mensajeproducto;
//      $sql = "
//SELECT
//  mo.idmodelo,
//  mo.idmarca,
//'$coleccionv' AS coleccion,
//  mo.codigo,'$codigocompleto' AS codigo,
//  mo.numero,
//  mo.precio,
//   mo.stylename AS idestilo,0 AS precio
//FROM
//  `modelos` mo
//WHERE
//  mo.codigo = '$codigocompleto';
//";
//
         $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
'$coleccionv' AS coleccion,
  mo.codigo,'$codigocompleto' AS codigo,
  mo.numero,
  mo.precio,
   mo.stylename AS idestilo,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.idmodelo = '$idlineabusca';
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


                        $dev['mensaje'] = $mensajeproducto;
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
  $dev['mensaje'] = $mensajeproducto;

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

function BuscarMarcaEmpleado(){
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
    $empleado = ListarVEndedorMarcaS('', '', '', '', '', '',"",true);
   if($empleado['error'] == true)
    {
        $value['vendedores'] = "true";
        $value['vendedorM'] = $empleado['resultado'];
    }
    $dev['mensaje'] = "Se cargo el formulario";
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
function ListarVendedorfin($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

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
 $idalmacen=$_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="SELECT emp.idempleado, CONCAT( emp.nombres, '-', emp.apellidos,'/',a.codigo ) AS nombre
FROM almacenes a, empleados emp
WHERE emp.idalmacen=a.idalmacen and emp.estado='Activo' order by emp.idalmacen,emp.nombres DESC

";

   //      echo $sql;
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

function ListarVEndedorMarcaS($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

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
 $idalmacen=$_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="SELECT m.idmarca, CONCAT( emp.nombres, '-', emp.apellidos ) AS nombre,
emp.idempleado
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen' group by em.idempleado order by emp.nombres DESC

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

function BuscarMFMarcaVendedorCliente(){
    $idalmacen = $_SESSION['idalmacen'];
    $empleado = ListarAlmacenes('', '', '', '', '', '',"",true);
    if($empleado['error'] == true)
    {
        $value['almacen'] = "true";
        $value['almacenM'] = $empleado['resultado'];
    }
   
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }

    $empleado = ListarVEndedorMarcaS('', '', '', '', '', '',"",true);
    if($empleado['error'] == true)
    {
        $value['vendedores'] = "true";
        $value['vendedorM'] = $empleado['resultado'];
    }

    $categorias = ListarClienteSimple('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $categorias['resultado'];
    }

    $fechatoday = Date("Y-m-d");
    $sqlcol = "SELECT mescierre, idalmacen FROM creditomayor where estadomes = 'activo' and idalmacen = '$idalmacen' group by mescierre, idalmacen";

    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "mescierre");
    $mesactual = $opcionA['resultado'];
    $fechaini = $fechatoday;
    $fechafin = $fechatoday;

    $value['mescierre'] = "$mesactual";
    $value['fechaini'] = "$fechaini";
    $value['fechafin'] = "$fechafin";

    $dev['mensaje'] = "Se cargo el formulario";
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

function BuscarMarcaEstiloinventario(){
$idalmacen=$_SESSION['idalmacen'];
      $categorias1 = ListarKardex('', '', '', '', '', '',"",true);
    if($categorias1['error'] == true)
    {
        $value['kardex'] = "true";
        $value['kardexM'] = $categorias1['resultado'];
    }

    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
   $empleado = ListarAlmacenes('', '', '', '', '', '',"",true);
   if($empleado['error'] == true)
    {
        $value['almacen'] = "true";
        $value['almacenM'] = $empleado['resultado'];
    }
    $fechatoday = Date("Y-m-d");
     $sqlcol = "
SELECT idkardex,mesrango,fechainicio,'$fechatoday' AS fechafin FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";
    
    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "mesrango");
   $mesactual = $opcionA['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechainicio");
   $fechaini = $opcionA1['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechafin");
   $fechafin = $opcionA1['resultado'];

     $value['mesrango'] ="$mesactual";
      $value['fechaini'] ="$fechaini";
       $value['fechafin'] ="$fechafin";
    $dev['mensaje'] = "Se cargo el formulario";
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
function BuscarInventarioVendedor(){
$idalmacen=$_SESSION['idalmacen'];
      $categorias1 = ListarKardex('', '', '', '', '', '',"",true);
    if($categorias1['error'] == true)
    {
        $value['kardex'] = "true";
        $value['kardexM'] = $categorias1['resultado'];
    }

     $empleado = ListarVendedorfin('', '', '', '', '', '',"",true);
   if($empleado['error'] == true)
    {
        $value['empleados'] = "true";
        $value['empleadoM'] = $empleado['resultado'];
    }
    $fechatoday = Date("Y-m-d");
     $sqlcol = "
SELECT idkardex,mesrango,fechainicio,'$fechatoday' AS fechafin FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";

    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "mesrango");
   $mesactual = $opcionA['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechainicio");
   $fechaini = $opcionA1['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechafin");
   $fechafin = $opcionA1['resultado'];

     $value['mesrango'] ="$mesactual";
      $value['fechaini'] ="$fechaini";
       $value['fechafin'] ="$fechafin";
    $dev['mensaje'] = "Se cargo el formulario";
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

function BuscarMarcaEstiloinventariocierre(){
$idalmacen=$_SESSION['idalmacen'];
    $categorias1 = ListarKardexmes('', '', '', '', '', '',"",true);
    if($categorias1['error'] == true)
    {
        $value['kardex'] = "true";
        $value['kardexM'] = $categorias1['resultado'];
    }
    
    $fechatoday = Date("Y-m-d");
     $sqlcol = "
SELECT idkardex,mesrango,fechainicio,'$fechatoday' AS fechafin FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";

    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "mesrango");
   $mesactual = $opcionA['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechainicio");
   $fechaini = $opcionA1['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcol, true, true, "fechafin");
   $fechafin = $opcionA1['resultado'];

     $value['mesrango'] ="$mesactual";
      $value['fechaini'] ="$fechaini";
       $value['fechafin'] ="$fechafin";
    $dev['mensaje'] = "Se cargo el formulario";
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
function ListarKardexmes($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    $fechatoday = Date("Y-m-d");
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
   $idalmacen=$_SESSION['idalmacen'];

$fechatoday = Date("Y-m-d");
     $sql = "
SELECT a.idalmacen,am.nombre,a.idkardex,a.mesrango  FROM
     administrakardex a,almacenes am where a.idalmacen=am.idalmacen and a.estado='pendiente'
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

function BuscarMarcaEstilodatos(){
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
$empleado = ListarEstiloMarca('', '', '', '', '', '',"",true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
    
     $value['codigo'] ="prueba";
      $value['nombre'] ="prueba";
       $value['responsable'] ="prueba";
    $dev['mensaje'] = "Se cargo el formulario";
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
function ListarKardex($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    $fechatoday = Date("Y-m-d");
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
   $idalmacen=$_SESSION['idalmacen'];

$fechatoday = Date("Y-m-d");
     $sql = "
(SELECT
      idkardex,mesrango,fechainicio,fechafin
    FROM
     administrakardex where idalmacen='$idalmacen' and estado!='pendiente' )
  UNION
  (
SELECT
      idkardex,mesrango,fechainicio,'$fechatoday'fechafin
    FROM
     administrakardex where idalmacen='$idalmacen' and estado='pendiente'
  )

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

function BuscarEstilo($idmarca){

$empleado = ListarEstiloPorMarca('', '', '', '', '', '',$idmarca,true);

    if($empleado['error'] == true)
    {
        $value['estilos'] = "true";
        $value['estiloM'] = $empleado['resultado'];


    }
    $dev['mensaje'] = "Se cargo el formulario";
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
//west

function BuscarModeloPorIdtiendaRegistrarwest($codigocompleto, $idestilo,$idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

//echo $colorbuscar;

 //  echo $idcoleccion;
$codigocolor= split("-",$codigocompleto);
$codigofin=$codigocolor[0];
$materialfin=$codigocolor[1];
$sqlcoleccion1 = "
SELECT
  idcoleccion,codigo
FROM
  coleccion
WHERE
  idmarca = '$idmarca' AND estado='VIGENTE'
";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlcoleccion1, true, true, "codigo");
   $coleccionv = $opcionA1['resultado'];

 //  echo $idcoleccion;
$codigobarraA1 = ObtenerLineaNuevo($idmarca,$lineabuscar,$idestilo,$idcoleccion, true);
       $idlinea = $codigobarraA1['resultado'];
   $codigoB = verificarValidarTextWithCondition($codigofin, false, "modelos", "codigo","idmarca",$idmarca);
      if($codigoB['error']==true){
  $codigobarraA = ObtenerCodigoNuevomodelo($idmarca,$idcoleccion,$idlinea,$codigofin,$colorbuscar ,$idestilo,$opciont, true);
       $idmodelo = $codigobarraA['resultado'];
    //   echo $idmarca;

$sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
'$codigofin' AS codigo,
'$materialfin' AS material,
'$coleccionv' AS coleccion,
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
mo.codigo AS modelo,
 '$codigofin' AS codigo,
'$materialfin' AS material,
'$coleccionv' AS coleccion,
  mo.numero,
  mo.precio,
   mo.stylename,0 AS precio
FROM
  `modelos` mo
WHERE
  mo.codigo = '$codigofin';
";

      }
    //echo $sql;
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

function buscarlistamodelos($idmarca,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
  $sqlmarca = "
SELECT
  mad.opcion
FROM
  `marcas` mad
WHERE
  mad.idmarca = '$idmarca'
";

    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
   $opcion = $opcionA['resultado'];
        $sql = "
SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, co.codigo AS coleccion,mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea, 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares
FROM `modelos` mo, `lineas` li,`coleccion` co
WHERE mo.idlinea = li.idlinea AND mo.idcoleccion = co.idcoleccion
AND mo.idmarca = '$idmarca';
";
 $select ="mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, co.codigo AS coleccion, mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea";
    $from = "`modelos` mo, `lineas` li,`coleccion` co";
    $where = "mo.idlinea = li.idlinea AND mo.idcoleccion = co.idcoleccion AND mo.idmarca = '$idmarca'";
        if($opcion == "1" || $opcion == "2"|| $opcion == "3"|| $opcion == "4")
    {
        $select .= ",0 AS '14',0 AS '15',0 AS '16',0 AS '17',0 AS '18',0 AS '19',0 AS '20',0 AS '21',0 AS '22',0 AS '23',0 AS '24',0 AS '25',0 AS '26',0 AS '27',0 AS '28',0 AS '29',0 AS '30',0 AS '31',0 AS '32', 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 1 AS totalcajas, 0 AS totalpares";

    }
if($opcion == "5" || $opcion == "6"|| $opcion == "7"|| $opcion == "8")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares ";
    }
  if($opcion == "10" || $opcion == "11"|| $opcion == "12")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '1', 0 AS '1m', 0 AS '2', 0 AS '2m', 0 AS '3', 0 AS '3m', 0 AS '4', 0 AS '4m', 0 AS '5', 0 AS '5m', 0 AS '6', 0 AS '6m', 0 AS '7',0 AS '7m',0 AS '8',0 AS '8m',0 AS '9',0 AS '9m',0 AS '10',0 AS '10m',0 AS '11',0 AS '11m',0 AS '12', 1 AS totalcajas, 0 AS totalpares ";
    }
    //    echo $sql;
 if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
          // echo $sql;
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
function buscarlistamodelo($idmarca,$idmodelo,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
//           $sql = "
//SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea, 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares
//FROM `modelos` mo, `lineas` li
//WHERE mo.idlinea = li.idlinea
//AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%'";
 $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
  $sqlmarca = "
SELECT
  mad.opcion
FROM
  `marcas` mad
WHERE
  mad.idmarca = '$idmarca'
";

    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
   $opcion = $opcionA['resultado'];
//        $sql = "
//SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea, 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares
//FROM `modelos` mo, `lineas` li
//WHERE mo.idlinea = li.idlinea
//AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%';
//";
 $select ="mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio,co.codigo AS coleccion, mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea";
    $from = "`modelos` mo, `lineas` li,`coleccion` co";
    $where = "mo.idlinea = li.idlinea AND mo.idcoleccion = co.idcoleccion AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%'";
        if($opcion == "1" || $opcion == "2"|| $opcion == "3"|| $opcion == "4")
    {
        $select .= ",0 AS '14',0 AS '15',0 AS '16',0 AS '17',0 AS '18',0 AS '19',0 AS '20',0 AS '21',0 AS '22',0 AS '23',0 AS '24',0 AS '25',0 AS '26',0 AS '27',0 AS '28',0 AS '29',0 AS '30',0 AS '31',0 AS '32', 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 1 AS totalcajas, 0 AS totalpares";

    }
if($opcion == "5" || $opcion == "6"|| $opcion == "7"|| $opcion == "8")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares ";
    }
  if($opcion == "10" || $opcion == "11"|| $opcion == "12")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '1', 0 AS '1m', 0 AS '2', 0 AS '2m', 0 AS '3', 0 AS '3m', 0 AS '4', 0 AS '4m', 0 AS '5', 0 AS '5m', 0 AS '6', 0 AS '6m', 0 AS '7',0 AS '7m',0 AS '8',0 AS '8m',0 AS '9',0 AS '9m',0 AS '10',0 AS '10m',0 AS '11',0 AS '11m',0 AS '12', 1 AS totalcajas, 0 AS totalpares ";
    }
    //    echo $sql;
 if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
          // echo $sql;
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
function buscarlistaestilo($idmarca,$idestilo,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
//           $sql = "
//SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea, 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares
//FROM `modelos` mo, `lineas` li
//WHERE mo.idlinea = li.idlinea
//AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%'";
 $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
  $sqlmarca = "
SELECT
  mad.opcionb
FROM
  `marcas` mad
WHERE
  mad.idmarca = '$idmarca'
";

    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
   $opcion = $opcionA['resultado'];

 $select ="mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, co.codigo AS coleccion,mo.stylename, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, li.codigo AS linea, 0 AS precio";
    $from = "`modelos` mo, `lineas` li,`coleccion` co";
    $where = "mo.idlinea = li.idlinea AND mo.idcoleccion = co.idcoleccion AND mo.idmarca = '$idmarca' AND mo.stylename = '$idestilo'";
        if($opcion == "5" || $opcion == "2"|| $opcion == "3"|| $opcion == "4")
    {
        $select .= ",0 AS '14',0 AS '15',0 AS '16',0 AS '17',0 AS '18',0 AS '19',0 AS '20',0 AS '21',0 AS '22',0 AS '23',0 AS '24',0 AS '25',0 AS '26',0 AS '27',0 AS '28',0 AS '29',0 AS '30',0 AS '31',0 AS '32', 0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 1 AS totalcajas, 0 AS totalpares";

    }
if($opcion == "6"|| $opcion == "7"|| $opcion == "8")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '33', 0 AS '34', 0 AS '35', 0 AS '36', 0 AS '37', 0 AS '38', 0 AS '39', 0 AS '40', 0 AS '41', 0 AS '42', 0 AS '43', 0 AS '44', 0 AS '45', 1 AS totalcajas, 0 AS totalpares ";
    }
  if($opcion == "10" || $opcion == "11"|| $opcion == "12")
    {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
        $select .= " ,0 AS '1', 0 AS '1m', 0 AS '2', 0 AS '2m', 0 AS '3', 0 AS '3m', 0 AS '4', 0 AS '4m', 0 AS '5', 0 AS '5m', 0 AS '6', 0 AS '6m', 0 AS '7',0 AS '7m',0 AS '8',0 AS '8m',0 AS '9',0 AS '9m',0 AS '10',0 AS '10m',0 AS '11',0 AS '11m',0 AS '12', 1 AS totalcajas, 0 AS totalpares ";
    }
    //    echo $sql;
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
function Buscarmodelos($callback, $_dc,$idestilo, $return = false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

$ciudad =  ListarModelosporEstilofin('', '', '', '', '', '', $idestilo, true);
   // $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar ";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }


     if($ciudad["error"]==true){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
      // $value['empleadoM'] = $cliente['resultado'];
        $value["modeloM"] = $ciudad['resultado'];
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
function ListarModelosporEstilofin($start, $limit, $sort, $dir, $callback, $_dc, $idestilo, $return = false){

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
  ad.idcalzado AS idmodelo,
CONCAT( mo.codigo,'-',ad.precio3bs,'-',ad.precio1bs,'-',ad.precio2bs,'-',SUM(ad.saldocantidad)) AS nombre
FROM
  `modelos` mo,`adicionkardextienda` ad
WHERE ad.idmodelodetalle=mo.idmodelo AND mo.stylename='$idestilo' AND ad.unido='no'
GROUP by ad.idcalzado ORDER by mo.codigo ASC
";

   //       echo $sql;
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
function AnularIngreso($idingreso, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
  // $proforma = $resultado->venta;
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");

// $sqlmarca = " SELECT idingreso FROM modelo WHERE idmodelo = '$idmodelo' ";
//    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idingreso");
////    $idingreso = $opcionkardex['resultado'];
//   //verificarValidarText
//   $codigobbc = verificarValidarText($idmodelo, false, "ventaitem", "idmodelo");
// $codigotrasp = verificarValidarText($idmodelo, false, "traspasodetallepar", "idmodelo");
//   // if(($codigobbc['error']) || ($codigobbc['error'])){
//
//  if(($codigobbc['error'] == false) ||($codigotrasp['error']== false)){
//        $dev['mensaje'] = "No se puede anular el modelo esta vinculado a otro proceso: venta o traspaso ";
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }else{
$nuevoes = "INACTIVO";
    $sql[] = "UPDATE ingresoalmacen SET  estado= '$nuevoes'WHERE idingreso='$idingreso' AND estado='ACTIVO'";

$sql[] ="DELETE FROM ingresoalmacen WHERE idingreso='$idingreso' ;";
$sql[] ="DELETE FROM modelo WHERE idingreso='$idingreso' ;";
$sql[] ="DELETE FROM modelodetalle WHERE idingreso='$idingreso' ;";
$sql[] ="DELETE FROM kardexcajas WHERE idoperacion='$idingreso' ;";

$sql[] ="DELETE FROM kardexdetalle WHERE idingreso='$idingreso' ;";

$sql[] ="DELETE FROM kardexdetalleingreso WHERE idingreso='$idingreso' ;";
$sql[] ="DELETE FROM kardexdetallepar WHERE idingreso='$idingreso' ;";
$sql[] ="DELETE FROM kardexdetalleparingreso WHERE idingreso='$idingreso' ;";
$respuesta=$idingreso;

// }
        // MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {

       $dev['mensaje'] = "Se anulo correctamente";
        $dev['error'] = "true";
        $dev['resultado'] ="";
        //$dev['resultado'] = $planilla;

    }
    else
    {
        $dev['mensaje'] = "La planilla puede haber sido ya emitida, intente la reimpresion";
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

function EliminarModelo($idmodelo, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
  // $proforma = $resultado->venta;
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $sqlmarca = " SELECT idingreso FROM modelo WHERE idmodelo = '$idmodelo' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idingreso");
    $idingreso = $opcionkardex['resultado'];
   //verificarValidarText
   $codigobbc = verificarValidarText($idmodelo, false, "ventaitem", "idmodelo");
 $codigotrasp = verificarValidarText($idmodelo, false, "traspasodetallepar", "idmodelo");
   // if(($codigobbc['error']) || ($codigobbc['error'])){

//  if(($codigobbc['error'] == false) ||($codigotrasp['error']== false)){
//        $dev['mensaje'] = "No se puede anular el modelo esta vinculado a otro proceso: venta o traspaso ";
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }else{
$nuevoes = "INACTIVO";
  // $sql[] = "UPDATE ingresoalmacen SET  observacion= 'anulado'WHERE idingreso='$idingreso'";

//$sql[] ="DELETE FROM modelo WHERE idmodelo='$idmodelo' ;";
//$sql[] ="DELETE FROM modelodetalle WHERE idmodelo='$idmodelo' ;";

//$sql[] ="DELETE FROM kardexcajas WHERE idmodelo='$idmodelo' ;";

//$sql[] ="DELETE FROM kardexdetalle WHERE idmodelo='$idmodelo' ;";

//$sql[] ="DELETE FROM kardexdetalleingreso WHERE idmodelo='$idmodelo' ;";
//$sql[] ="DELETE FROM kardexdetallepar WHERE idmodelo='$idmodelo' ;";
$sql[] = "UPDATE kardexdetallepar SET saldocantidad='0'WHERE idmodelo='$idmodelo';";
$respuesta=$idingreso;

//echo "borrado";
// }
    //       MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {   $dev['mensaje'] = "Se anulo correctamente el modelo";
        $dev['error'] = "true";
        $dev['resultado'] ="";
        //$dev['resultado'] = $planilla;

    }
    else
    {
        $dev['mensaje'] = "La planilla puede haber sido ya emitida, intente la reimpresion";
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

function ListarIngresosAlmacenExtra($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{$idalmacen = $_SESSION['idalmacen'];
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
$fechatoday = Date("Y-m-d");
  $sqld = "
SELECT 'pares'  AS pares,IFNULL(SUM(kd.cantidad),0)AS cantidad
FROM kardexdetalleingreso kd,ingresoalmacen i,modelo m
WHERE kd.idmodelo=m.idmodelo and kd.idingreso=i.idingreso and i.idmarca='$idmarca' and m.idvendedor='$idempleado' AND i.idalmacen = '$idalmacen' and i.boleta='0' and i.fecha >= '$fecha1' AND i.fecha <= '$fecha2'
UNION ALL
SELECT 'sus'  AS sus,IFNULL(SUM(kd.cantidad*kd.preciounitario),0) AS cantidad
FROM kardexdetalleingreso kd,ingresoalmacen i,modelo m
WHERE kd.idmodelo=m.idmodelo and kd.idingreso=i.idingreso and i.idmarca='$idmarca' and m.idvendedor='$idempleado' AND i.idalmacen = '$idalmacen' and i.boleta='0' and i.fecha >= '$fecha1' AND i.fecha <= '$fecha2'

  ";

    if($where == null || $where == "")
    {
        $sql = "
 SELECT ing.idingreso, ing.boleta, ing.numero, ing.estado,  ing.fecha,  ing.hora, SUM(kp.saldocantidad) as totalpares,
 ing.totalcajas, SUM(kp.saldocantidad*kp.preciounitario) as totalbs,
  ing.responsable,  ing.observacion,
  ing.idmarca,
  ing.idalmacen,
  alm.nombre AS almacen,
  ing.responsable,
  mad.nombre AS marca
FROM
  ingresoalmacen ing,
  marcas mad,almacenes alm,kardexdetalleparingreso kp
WHERE
 ing.estado='ACTIVO' and ing.idingreso=kp.idingreso AND ing.idalmacen=alm.idalmacen and
  ing.idmarca = mad.idmarca and ing.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' and ing.fecha='$fechatoday' GROUP BY kp.idingreso ORDER BY ing.fecha DESC,mad.nombre DESC,ing.hora LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
        
    }
    else
    {
        $sql = "
    SELECT
  ing.idingreso,
  ing.boleta,
  ing.numero,
  ing.estado,
  ing.fecha,
  ing.hora,
 SUM(kp.saldocantidad) as totalpares,
ing.totalcajas,
 SUM(kp.saldocantidad*kp.preciounitario) as totalbs,
  ing.responsable,
  ing.observacion,
  ing.idmarca,
  ing.idalmacen,
alm.nombre AS almacen,
  ing.responsable,
  mad.nombre AS marca
FROM
  ingresoalmacen ing,
  marcas mad,almacenes alm,kardexdetalleparingreso kp
WHERE
 ing.estado='ACTIVO' and ing.idingreso=kp.idingreso AND ing.idalmacen=alm.idalmacen and
  ing.idmarca = mad.idmarca and ing.idalmacen='$idalmacen' and kp.idalmacen='$idalmacen' AND $where   GROUP BY kp.idingreso ORDER BY ing.fecha DESC,mad.nombre DESC,ing.hora LIMIT $start,$limit
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
function ActualizarMovimientoItemsEntrada($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idmarca = $resultado->idmarca;
  $idestilo = $resultado->idestilo;
  $idkardex = $resultado->idkardex;
 $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
  // echo $tabla;
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
//echo $fechainicio;
 if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}
if($tabla=="historialkardextienda"){
     $sql ="
SELECT h.idcalzado
FROM  historialkardextienda h,modelos m ,adiciondetalleingreso dtp,adicioningresotienda ad
WHERE ad.idingreso=dtp.idingreso and dtp.iddetalleingreso=h.idcalzado AND ad.fecha >= '$fechainicio' AND ad.fecha <= '$fechafin' and h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.stylename='$idestilo' AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado
";
}else{
     $sql ="
SELECT h.idcalzado
FROM  adicionkardextienda h,modelos m ,adiciondetalleingreso dtp,adicioningresotienda ad
WHERE ad.idingreso=dtp.idingreso and dtp.iddetalleingreso=h.idcalzado AND ad.fecha >= '$fechainicio' AND ad.fecha <= '$fechafin' and h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.stylename='$idestilo' GROUP BY h.idcalzado
";
}
 

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
                                mysql_field_name($re, $i) == "idcalzado";
                                $idcalzado = $fi[$i];

        $sql4 = "SELECT COUNT(i.cantidad) AS numero FROM adiciondetalleingresotalla i,adiciondetalleingreso dtp ,adicioningresotienda adi WHERE
i.iddetalleingreso='$idcalzado'  AND i.iddetalleingreso=dtp.iddetalleingreso and dtp.idingreso=adi.idingreso and adi.fecha >= '$fechainicio'
    AND adi.fecha <= '$fechafin' ";
   $ventas = findBySqlReturnCampoUnique($sql4, true, true, "numero");
   $numeroingresados = $ventas['resultado'];//SOBRESALDO
      //      echo $sql4;
if($numeroingresados > 0){
anadirpareskardexactual($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);

}else{
anadirpareskardexactual($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}

                        }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}

function Actualizartrasprecib($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idmarca = $resultado->idmarca;
  $idestilo = $resultado->idestilo;
  $idkardex = $resultado->idkardex;
 $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
  // echo $tabla;
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
//echo $fechainicio;
 if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}
if($tabla=="historialkardextienda"){
     $sql ="
SELECT h.idcalzado
FROM  historialkardextienda h,modelos m ,adiciondetalleingreso dtp,adicioningresotienda ad
WHERE ad.idingreso=dtp.idingreso and dtp.iddetalleingreso=h.idcalzado AND ad.fecha >= '$fechainicio' AND ad.fecha <= '$fechafin' and h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.stylename='$idestilo' AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado
";
}else{
     $sql ="
SELECT h.idcalzado
FROM  adicionkardextienda h,modelos m ,ingresos i
WHERE i.idkardextienda=h.idkardextienda and h.idmodelodetalle=m.idmodelo AND i.fecha >= '$fechainicio' AND i.fecha <= '$fechafin' and m.idmarca = '$idmarca' AND m.stylename='$idestilo' GROUP BY h.idcalzado
";
}

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
                                mysql_field_name($re, $i) == "idcalzado";
                                $idcalzado = $fi[$i];

                               $sql4 = "SELECT COUNT(i.cantidad) AS numero FROM ingresos i,adicionkardextienda dtp WHERE
dtp.iddetalleingreso='$idcalzado'  AND i.idkardextienda=dtp.idkardextienda and i.fecha >= '$fechainicio'
    AND i.fecha <= '$fechafin' ";

   $ventas = findBySqlReturnCampoUnique($sql4, true, true, "numero");
   $numeroingresados = $ventas['resultado'];//SOBRESALDO
      //      echo $sql4;
if($numeroingresados > 0){
anadirpareskardexactualingresos($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}else{
anadirpareskardexactualingresos($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}

                        }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}

function anadirpares($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM historialkardextienda
WHERE idcalzado = '$idcalzado' and idperiodo='$idperiodo';
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallaanadir($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
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
//}
}
function anadirpareskardexactual($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM adicionkardextienda
WHERE idcalzado = '$idcalzado';
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallaanadirkardex($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
                //   actualizarparestallaanadir($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);

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
//}
}

function anadirpareskardexactualingresos($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM adicionkardextienda
WHERE idcalzado = '$idcalzado';
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallaanadirkardexingresos($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
            
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
//}
}


function ActualizarKardexHistorial($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idmarca = $resultado->idmarca;
  $idestilo = $resultado->idestilo;
  $idkardex = $resultado->idkardex;
 $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
  // echo $tabla;
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
 $res= actualizarplanillaempresa($idempresa, $mesplanilla,false);
        $idmovimientoplanilla = $res['resultado'];
//    $sql ="
//SELECT h.idcalzado,m.numero
//FROM  historialkardextienda h,modelos m
//WHERE h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.numero >= '237' and m.numero <='242' AND m.stylename='$idestilo'AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado order by m.numero desc
//";
      $sql ="
SELECT h.idcalzado,m.numero
FROM  historialkardextienda h,modelos m
WHERE h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.stylename='$idestilo'AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado order by m.numero desc
";

//validarcreditosanteriores($idempresa, $mesplanilla,false);
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
                                mysql_field_name($re, $i) == "idcalzado";
                                $idcalzado = $fi[$i];

actualizarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
                             }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}
function ActualizarKardexActual($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idmarca = $resultado->idmarca;
  $idestilo = $resultado->idestilo;
  $idkardex = $resultado->idkardex;
 $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
  // echo $tabla;
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];

//    $sql ="
//SELECT h.idcalzado,m.numero
//FROM  adicionkardextienda h,modelos m
//WHERE h.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca' AND m.numero >= '237' and m.numero <='242' AND m.stylename='$idestilo'AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado order by m.numero desc
//";
      $sql ="
SELECT ad.idcalzado,m.numero
FROM  historialkardextienda h,modelos m,adicionkardextienda ad
WHERE ad.idkardextienda=h.idkardextienda and h.idperiodo='1' and ad.idmodelodetalle=m.idmodelo and m.idmarca = '$idmarca'
AND m.stylename='$idestilo' GROUP BY ad.idcalzado order by m.numero desc
";

//validarcreditosanteriores($idempresa, $mesplanilla,false);
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
                                mysql_field_name($re, $i) == "idcalzado";
                                $idcalzado = $fi[$i];

actualizarpareskardexactual($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);

//actualizarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
                             }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}
function Cambiogestioninventario($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
 //si cambio fecha actualizo datos
//actualizarmesperiodo($idkardex,$idalmacen,false);
    $mesrango = $resultado->mesrango;
    $idalmacen = $resultado->idalmacen;
    $sql1= "SELECT idkardex FROM administrakardex WHERE mesrango = '$mesrango' AND idalmacen='$idalmacen' AND estado='cerrado' ";
    $result2 = findBySqlReturnCampoUnique($sql1, true, true, "idkardex");
    $planillaemitida = $result2['resultado'];

    if($planillaemitida==null || $planillaemitida==''){
//select kp.idmodelo, SUM(kp.saldocantidad) as pares,m.idvendedor,m.idmarca,kp.idalmacen,'022016' as mes,'0' as preciototal  from kardexdetallepar kp,modelo m where
//kp.idmodelo=m.idmodelo  and m.fecha!='2016-03-01' and kp.idalmacen='alm-3' and kp.saldocantidad!='0' group by kp.idmodelo
$sql ="SELECT kp.idmodelo
FROM kardexdetallepar kp,modelo m
WHERE kp.idmodelo=m.idmodelo and kp.idalmacen = '$idalmacen' and kp.saldocantidad!='0' group by kp.idmodelo";


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
                                $idcalzado = $fi[$i];
               actualizarparestallakardexhistorial($idcalzado,$idalmacen,$mesrango,false);
                        }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $mesplanilla;

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
//        $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;
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
       actualizarmesperiodo($mesrango,$idalmacen,false);
}else{
//verificar con estado
   $dev['mensaje'] = "Mes ya cerrado";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);
}

}
//ini cambio gestion inventario


function actualizarparestallakardexhistorial($idmodelo,$idalmacen,$rango,$return = false ){
$fechatoday = Date("Y-m-d");
//select kp.idmodelo, SUM(kp.saldocantidad) as pares,m.idvendedor,m.idmarca,kp.idalmacen,'022016' as mes,'0' as preciototal  from kardexdetallepar kp,modelo m where
//kp.idmodelo=m.idmodelo  and m.fecha!='2016-03-01' and kp.idalmacen='alm-3' and kp.saldocantidad!='0' group by kp.idmodelo
$sql1= "SELECT SUM(saldocantidad) as pares FROM kardexdetallepar WHERE idmodelo = '$idmodelo'  ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "pares");
  $pares = $result1['resultado'];
  $sql1= "SELECT SUM(saldocantidad*preciounitario) as sus FROM kardexdetallepar WHERE idmodelo = '$idmodelo'  ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "sus");
  $preciototal = $result1['resultado'];
 
  $sql1= "SELECT * FROM modelo WHERE idmodelo = '$idmodelo'  ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
  $idmarca = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idvendedor");
  $idvendedor = $result1['resultado'];
//datos variables
//function getSqlNewKardexresumen($idmodelo, $pares, $idvendedor, $idmarca, $idlamacen, $mes, $preciototal, $return){
$sqlA[] =getSqlNewKardexresumen($idmodelo, $pares, $idvendedor, $idmarca, $idalmacen, $rango, $preciototal, false);
//fin normal

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);


}

    function ultimo_dia($m,$y)
{return strftime("%d", mktime(0, 0, 0, $m+1, 0, $y));}

function actualizarmesperiodo($mesrango,$idalmacen,$return = false ){
    $idusuario = $_SESSION['idusuario'];
        $fechatoday = Date("Y-m-d");
         $hora = date("H:i:s");

 $sqlmarca = " SELECT * FROM administrakardex WHERE idalmacen='$idalmacen' and mesrango='$mesrango'  ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkardex = $opcionkardex['resultado'];

//echo $fechainicionuevo;
//echo date("d-m-Y", strtotime("+1 day"));
 $m=substr($mesrango,0,2);
$y=substr($mesrango,2,5);
$dia ="01";
//$fechaini=$d."-".$m."-".$y;
$ultimo_dia= ultimo_dia($m,$y);
$dia1="01";
//$fechain=$dia1."-".$m."-".$y;
//$fechafin=$ultimo_dia."-".$m."-".$y;
$fechaini=$y."-".$m."-".$dia1;
$fechafinn=$y."-".$m."-".$ultimo_dia;
$date=$m."/".$dia1."/".$y;
//$date='12/17/2011';
//echo $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
$fechamasunmes= date("m/d/Y", strtotime("$date +1 month"));
//echo $fechamasunmes;
 $formatear11 = explode( '/' , $fechamasunmes);
$m2 = $formatear11[0];
$d2 = $formatear11[1];
$y2 = $formatear11[2];
$mesrangonuevo=$m2."".$y2;
//echo $mesrangonuevo;
$fechainicio = $y2."-".$m2."-".$dia1;
$sqlA[] = "UPDATE administrakardex SET estado='cerrado', fechafin='$fechafinn' WHERE idkardex='$idkardex';";
   $sqlInv = "SELECT MAX(numero)AS ind FROM administrakardex ";
           $almacenA1 =  findBySqlReturnCampoUnique($sqlInv, true, true, 'ind');
    $mayor = $almacenA1['resultado'];
    $numero = $mayor + 1;
    $idkardex= $numero;
$sqlA[] = getSqlNewAdministrakardex($idkardex, "pendiente", $numero, $fechatoday, $hora, $fechainicio, "", $idalmacen, "usr-1000", "kardexdetallepar", $mesrangonuevo, $idperiodo, $mesrango, false);

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);


}

function actualizarpareskardexactual($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $sql ="
SELECT talla
FROM adicionkardextienda
WHERE idcalzado = '$idcalzado';
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
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallakardexactual($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
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
//}
}
function actualizarparestallakardexactual($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,$return = false ){

$sql1= "SELECT
             idkardextienda
            FROM
             adicionkardextienda
            WHERE
              idcalzado = '$idcalzado' AND talla='$talla' ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idkardextienda");
  $idkardextienda = $result1['resultado'];

   $sqlInv = "SELECT MAX(idperiodo)AS numero
FROM administrakardex where tabla='historialkardextienda'";
           $almacenA1 =  findBySqlReturnCampoUnique($sqlInv, true, true, 'numero');
    $idperiodoant = $almacenA1['resultado'];
 $idper = $idperiodoant;

       $select = "SUM(saldocantidad) AS Pares";
    $from = "historialkardextienda k,modelos mdt";
    $where = " k.idmodelodetalle = mdt.idmodelo and k.idcalzado='$idcalzado' and k.talla='$talla' AND k.idperiodo='$idper' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $stockanterior = $almacenA1['resultado'];
//echo $sql2p;
$nuevacantidad= $stockanterior;
 $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$nuevacantidad' WHERE idkardextienda='$idkardextienda' AND idcalzado='$idcalzado' and talla='$talla';";

// $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$nuevacantidad' WHERE idkardextienda='$idkardextienda' AND idcalzado='$idcalzado' and talla='$talla' and idperiodo='$idperiodo';";

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);
}
function actualizarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM historialkardextienda
WHERE idcalzado = '$idcalzado' and idperiodo='$idperiodo';
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallakardex($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);

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
//}
}
function actualizarparestallakardex($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,$return = false ){
$emitida="1";
$sql1= "SELECT
             idkardextienda
            FROM
             historialkardextienda
            WHERE
              idcalzado = '$idcalzado' AND talla='$talla' AND idperiodo='$idperiodo' ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idkardextienda");
  $idkardextienda = $result1['resultado'];

   $sqlInv = "SELECT MAX(idperiodo)AS numero
FROM administrakardex where tabla='historialkardextienda'";
           $almacenA1 =  findBySqlReturnCampoUnique($sqlInv, true, true, 'numero');
    $idperiodoant = $almacenA1['resultado'];
 $idper = $idperiodoant - 1;

       $select = "SUM(saldocantidad) AS Pares";
    $from = "historialkardextienda k,modelos mdt";
    $where = " k.idmodelodetalle = mdt.idmodelo and k.idcalzado='$idcalzado' and k.talla='$talla' AND k.idperiodo='$idper' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $stockanterior = $almacenA1['resultado'];

$nuevacantidad= $stockanterior;

 $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$nuevacantidad' WHERE idkardextienda='$idkardextienda' AND idcalzado='$idcalzado' and talla='$talla' and idperiodo='$idperiodo';";
//ayudahelp
//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);


}
function ActualizarMovimientoItems($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    //$idtienda = $_SESSION['idtienda'];
    $idmarca = $resultado->idmarca;
  $idestilo = $resultado->idestilo;
  $idkardex = $resultado->idkardex;
 $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
  // echo $tabla;
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
    if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}
if($tabla=="historialkardextienda"){
     $sql ="
SELECT h.idcalzado
FROM  historialkardextienda h,modelos m,itemventa i ,ventasdetalle v
WHERE i.idkardextienda=h.idkardextienda and h.idmodelodetalle=m.idmodelo ANd i.estado!='cambiado' and i.idventa=v.idventadetalle and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and m.idmarca = '$idmarca' AND m.stylename='$idestilo' AND h.idperiodo='$idperiodo' GROUP BY h.idcalzado
";
}else{
      $sql ="
SELECT h.idcalzado
FROM  adicionkardextienda h,modelos m,itemventa i ,ventasdetalle v
WHERE i.idkardextienda=h.idkardextienda and h.idmodelodetalle=m.idmodelo ANd i.estado='vendido' and i.idventa=v.idventadetalle and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin' and m.idmarca = '$idmarca' AND m.stylename='$idestilo' GROUP BY h.idcalzado
";
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
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "idcalzado";
                                $idcalzado = $fi[$i];
                              
  if($tabla=="historialkardextienda"){
       $sql4 = "SELECT COUNT(i.cantidad)AS numero FROM itemventa i,ventasdetalle v WHERE i.idcalzado='$idcalzado' ANd i.estado!='cambiado' and i.idventa=v.idventadetalle and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin'";
   $ventas = findBySqlReturnCampoUnique($sql4, true, true, "numero");
   $numerovendidos = $ventas['resultado'];//SOBRESALDO
if($numerovendidos > 0){
descontarpares($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}else{
 descontarpares($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}
  }else{
        $sql4 = "SELECT COUNT(i.cantidad)AS numero FROM itemventa i,ventasdetalle v WHERE i.idcalzado='$idcalzado' ANd i.estado!='cambiado' and i.idventa=v.idventadetalle and v.fecha >= '$fechainicio'
    AND v.fecha <= '$fechafin'";
   $ventas = findBySqlReturnCampoUnique($sql4, true, true, "numero");
   $numerovendidos = $ventas['resultado'];//SOBRESALDO
if($numerovendidos > 0){
descontarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);

}else{
 descontarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,false);
}
  }
       
    
                        }

                      //  $ii++;
                              }while($fi = mysql_fetch_array($re));
//                    $dev['mensaje'] = "Existen resultados";
//                    $dev['error']   = "true";
//                    $dev['resultado'] = $mesplanilla;

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
  $dev['mensaje'] = "Se registro correctamente ";
        $dev['error'] = "true";
        $dev['resultado'] = "";
            $json = new Services_JSON();
        $output = $json->encode($dev);
       print($output);

}
function descontarpares($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM historialkardextienda
WHERE idcalzado = '$idcalzado' and idperiodo='$idperiodo';
";
   //echo $sql;
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestalla($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
//e
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
//}
}
function descontarpareskardex($idcalzado,$idmarca, $idestilo,$idkardex,$idperiodo,$fechainicio,$fechafin,$return = false)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
$sql ="
SELECT talla
FROM adicionkardextienda
WHERE idcalzado = '$idcalzado';
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
                                mysql_field_name($re, $i) == "talla";
                                $talla = $fi[$i];
                   actualizarparestallakardexactualactual($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);
//                   actualizarparestalla($talla,$idcalzado,$idperiodo,$fechainicio,$fechafin,false);

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
//}
}
//nada recapitula
function Listaragrupadorecapitula($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idkardex,$idtienda, $return = false){
$idalmacen=$_SESSION['idalmacen'];
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

//SELECT idcheque AS id,date_format(fecha,'%d/%m/%Y') AS fecha,fecha AS fechacheque,bs AS cobrosbs,sus AS cobrossus,chequebs AS chequesbs,'0' AS otrosingresos,'0' AS comisiones,'0' AS gastosbs,'0' AS gastossus,'0' AS depositosbs,'0' AS depositossus,'0' AS totales,estado
$fecha1 = $fechaini;
$fecha2 = $fechafin;
//$sql ="
//SELECT idcheque AS id,date_format(fecha,'%d/%m/%Y') AS fecha,fecha AS fechacheque,'0' AS gastossus,'0' AS depositossus,'0' AS totales,estado
//FROM depositocheque
//WHERE fecha >= '$fechaini' AND fecha <= '$fechafin' GROUP BY fecha
//";
      // echo $sql;
 $sqlmarca = " SELECT * FROM administrakardex WHERE estado = 'pendiente' and idalmacen='$idalmacen'";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechaini = $opcionkardex['resultado'];
     $fechatoday = Date("Y-m-d");
    $fecha1 = $fechaini;
$fecha2 = $fechatoday;
$idalmacen=$_SESSION['idalmacen'];
 $sql ="
SELECT m.idmarca, m.nombre AS marcavendedor, CONCAT( m.idmarca, '/', emp.idempleado ) AS marcaempleado, CONCAT( emp.nombres, '-', emp.apellidos ) AS marca, '0' AS tcajas, '0' AS tpares, '0' AS tsus, '0' AS tecajas, '0' AS tepares, '0' AS tesus, '0' AS vcajas, '0' AS vpares, '0' AS vsus, '0' AS cobrosus, '0' AS cuentasporcobrar, '0' AS scajas, '0' AS spares, '0' AS ssus, '0' AS rebajas, '0' AS fallas, '0' AS precion
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen' order by m.nombre DESC

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

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "marcaempleado"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $marcaempelado = $fi[$i];
  $planillaanterior= split("/",$marcaempelado);
$idmarca=$planillaanterior[0];
$idempleado=$planillaanterior[1];
//  String[] nombreCaso5Columns = {"idmarca", "marca", "cajas", "pares", "sus", "reccajas", "recpares", "recsus", "tcajas", "tpares", "tsus","tecajas", "tepares", "tesus", "vcajas", "vpares", "vsus", "cobrosus", "cuentasporcobrar","scajas", "spares", "ssus","rebajas", "fallas", "precion","marcavendedor"};
 $sqlmarca = "SELECT FROM WHERE mar.idmarca = '$idmarca'";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
                                 $sqld = "
SELECT 'pares'  AS pares,IFNULL(SUM(kd.cantidad),0)AS cantidad
FROM kardexdetalleingreso kd,ingresoalmacen i,modelo m
WHERE kd.idmodelo=m.idmodelo and kd.idingreso=i.idingreso and i.idmarca='$idmarca' and m.idvendedor='$idempleado' AND i.idalmacen = '$idalmacen' and i.boleta='0' and i.fecha >= '$fecha1' AND i.fecha <= '$fecha2'
UNION ALL
SELECT 'sus'  AS sus,IFNULL(SUM(kd.cantidad*kd.preciounitario),0) AS cantidad
FROM kardexdetalleingreso kd,ingresoalmacen i,modelo m
WHERE kd.idmodelo=m.idmodelo and kd.idingreso=i.idingreso and i.idmarca='$idmarca' and m.idvendedor='$idempleado' AND i.idalmacen = '$idalmacen' and i.boleta='0' and i.fecha >= '$fecha1' AND i.fecha <= '$fecha2'
   
  ";

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

function Listaragrupadorecapitula2($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idkardex,$idtienda, $return = false){
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

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
 $sqlmarca = " SELECT mar.opcionb FROM marcas mar WHERE mar.idmarca = '$idmarca' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "totalpares");
    $totalpares = $opcionA1['resultado'];
// String[] nombreCaso5Columns = {"idmarca", "marca", "cajas", "pares", "sus", "reccajas", "recpares", "recsus", "tcajas", "tpares",
// "tsus","tecajas", "tepares", "tesus", "vcajas", "vpares", "vsus", "cobrosus", "cuentasporcobrar","scajas", "spares"
//, "ssus","rebajas", "fallas", "precion","marcavendedor"}; CONCAT( m.codigo, '-', emp.nombres ) AS marca,
$idalmacen=$_SESSION['idalmacen'];
    $sql ="
SELECT m.idmarca, m.nombre AS marcavendedor,CONCAT( emp.nombres, '-', emp.apellidos ) AS marca,
'0' as cajas,'0' as pares,'0' as sus,'0' as reccajas,'0' as recpares,'0' as recsus,'0' as tcajas,'0' as tpares,
'0' as tsus,'0' as tecajas,'0' as tepares,'0' as tesus,'0' as vcajas,'0' as vpares,'0' as vsus,'0' as cobrosus,
'0' as cuentasporcobrar,'0' as scajas,'0' as spares,'0' as ssus,'0' as rebajas,'0' as fallas,'0' as precion
FROM marcas m, empleadomarca em, empleados emp
WHERE em.idmarca = m.idmarca
AND em.idempleado = emp.idempleado
AND em.idalmacen = '$idalmacen'

";


//      echo $sql;
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
                            if(mysql_field_name($re, $i) == "idmarca"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                  set_time_limit(0);
// $sqld = "  SELECT ta.talla, ad.saldocantidad
//FROM tallasdetalle ta,adicionkardextienda ad
//where ta.talla = ad.talla
//AND ad.idcalzado = '$iddetalleingreso' and ad.unido='no' AND ad.idtienda='$idtienda'
//";

//                                                   //          echo   $sqld;
//                                if($re1 = $link->consulta($sqld))
//                                {
//
//                                    if($fi1 = mysql_fetch_array($re1))
//                                    {
//                                        //                                         echo "jla";
//                                        //                                        $tallas = mysql_num_rows($re1)."ll";
//                                        //                                        echo $tallas;
//                                        do{
//
//                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
//                                            {
//                                                //                                                echo ".".$j;
//                                                $value{$ii}{$fi1[0]}= $fi1[1];
//                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
//                                            }
//                                        }while($fi1 = mysql_fetch_array($re1));
//
//
//
//                                    }
//                                    //                            $id
//                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';
//
//                                }
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

//registro
function GuardarNuevoIngresoExtra($resultado,$return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
   $idalmacen=$_SESSION['idalmacen'];
    iniciandoinsercion($idalmacen,true);

   $numeroA = findUltimoID("ingresoalmacen", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idingreso="ing-".$numero;
    $ingreso = $resultado->ingreso;
     $numeroregistro = $ingreso->numeropedido;
 $boleta = $ingreso->boleta;
 $responsable = $ingreso->encargado;
    $estado = "ACTIVO";
    //$hora = date("H:i:s");
       $hora = date("H:i:s");
   $fecha2=time()-3600;
   $hora= date("H:i:s",$fecha2);
    $fechareal = date("Y-m-d");
 $fecha = $ingreso->fecharegistro;
$totalpares = $ingreso->totalpares;
     $totalbs = $ingreso->totalbs;
    $totalcajas = $ingreso->totalcaja;
    $usuario = $_SESSION['idusuario'];
    $idmarca = $ingreso->idmarca;
    $observacion = $ingreso->descripcion;
    //$idtienda = $_SESSION['idtienda'];
 $formatear11 = explode( '-' , $responsable);
$nombrev1 = $formatear11[0];
$apellidov1 = $formatear11[1];
$sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev1' AND apellidos='$apellidov1'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
  $usuario = $result1['resultado'];
  
$idalmacensesion = $idalmacen;
   // $idtienda ='tie-2';
    $fecharegistro = Date("Y-m-d");
  $sql[]=getSqlNewIngresoalmacen($idingreso, $numeroregistro, $boleta, $encargado, $numero, $estado, $fecharegistro, $hora, $totalcajas, $totalpares, $totalbs, $totalsus, $montototal, $responsable, $observacion, $idmarca, $usuario, $idalmacen, $generado, false);
  $numeropedidoA = findUltimoNumeroPedidoMarca($idmarca, true);
    $numero1 = $numeropedidoA['resultado']+1;
    $sql[] =getSqlNewNumeropedido($idnumero, $idmarca, $numero1, $return);
$sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
    $numeroD = findUltimoID("modelo", "numero", true);
    $numeromodelo = $numeroD['resultado'] +1;
    $numerokardexA = findUltimoID("modelodetalle", "numero", true);
    $numeromodelodetalle = $numerokardexA['resultado']+1;
    $idoperacion=$idingreso;
    $calzados = $resultado->calzados;
    $numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    $numerokardexA = findUltimoID("kardexcajas", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $talla = $calzado->talla;
        $codigo = $calzado->codigo;
        $color = $calzado->color;
        $material = $calzado->material;
         $cliente = $calzado->cliente;
           $vendedor = $calzado->vendedor;
       $fechaingreso = $calzado->fechai;
        $precioventa = $calzado->precio;
        $preciounitario = $calzado->preciounitario;
         $preciototalcaja = $calzado->totalparesbs;
        $numeroparesfila = $calzado->totalpares;
        $totalparescaja = $calzado->totalparescaja;
        $numerocajas = $calzado->totalcajas;
       //echo $numerocajas;
  $formatear1 = explode( '-' , $vendedor);
$nombrev = $formatear1[0];
$apellidov = $formatear1[1];
$sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev' AND apellidos='$apellidov'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
  $idvendedor = $result1['resultado'];
        if($numeroparesfila < "10"){$numeroparesfila = "0".$numeroparesfila;}else{$numeroparesfila=$numeroparesfila;}
        $idmodelo = "m-".$numeromodelo;
                $iddetalleingreso =$iddetalleingresonuevo;
                 $tiporegistro = "nuevo";
                 if($idmarca=="mar-1"){
             $planillaanterior= split("-",$codigo);
$coleccion=$planillaanterior[0];
$codigo=$planillaanterior[1];

  if($idcoleccion==null || $idcoleccion==""){
      $anio="2014";
    $sql1 ="SELECT MAX(col.codigobarra1) AS codigobarra FROM coleccion col WHERE col.idmarca = '$idmarca' AND col.anio = '$anio'";
    $codigobarraA = findBySqlReturnCampoUnique($sql1, true, true, 'codigobarra');
    if ($codigobarraA['resultado']=="null" || $codigobarraA['resultado']==''){
    $numerob= $codigobarraA['resultado']= '1';
    }else {
        $numerob=$codigobarraA['resultado'] + 1;
    }
    $codigob = $anio%100;
    if ($codigob < '10'){
 $codigobar="0".$codigob;
}else{
    $codigobar = $codigob;
}
    $codigobarra = $numerob.$codigobar;

  $numeroA = findUltimoID("coleccion", "numero", true);
    $numero = $numeroA['resultado']+1;
    $estado = "VIGENTE";
    $sql[] = "UPDATE coleccion SET estado = 'PASADO' WHERE idmarca = '$idmarca';";
    $idcoleccion = 'col-'.$numero;
    $sql[] = getSqlNewColeccion($idcoleccion, $anio, $coleccion, $numero, $codigo1, $idmarca, $estado, $codigobarra, $numerob, false);
}else{
  $sql1= "SELECT idcoleccion FROM coleccion WHERE detalle='$coleccion' AND idmarca='$idmarca' group by  detalle";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcoleccion");
  $idcoleccion = $result1['resultado'];
}
             }else{


$sqlcoleccion = "SELECT idcoleccion FROM coleccion WHERE idmarca = '$idmarca' AND estado='VIGENTE'";
    $opcionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
   $idcoleccion = $opcionA['resultado'];
                 $codigo= $codigo;
               //  }
                 }
       
           if($numerocajas == "1"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "2"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "3"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "4"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "5"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "6"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "7"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "8"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "9"){$numerocajas = "0".$numerocajas;}
           if($numerocajas == "10"){$numerocajas = $numerocajas;}
           if($numerocajas == "11"){$numerocajas = $numerocajas;}

  $idmodelodetalle = "mod-".$numeromodelodetalle;
  $planillaanterior= split("/",$cliente);
 $almacen=$planillaanterior[0];
$codciudad=$planillaanterior[1];

$sqlMarca = "SELECT * FROM almacenes WHERE nombre = '$almacen'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idalmacen");
    $iddestinoalmacen = $codigomarcaA['resultado'];
  if($iddestinoalmacen==null || $iddestinoalmacen==''){
   
  $sqlMarca = "SELECT idcliente FROM clientes WHERE codigo = '$almacen'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idcliente");
    $iddestinoalmacen = $codigomarcaA['resultado'];
  $idcliente = $iddestinoalmacen;
}else{
   $idcliente = $iddestinoalmacen; 
}

$codigo = strtoupper($codigo);
$color = strtoupper($color);
$material = strtoupper($material);
 $sql[] =getSqlNewModelo($idmodelo, $idmodelodetalle, $idmarca,$idvendedor, $codigo, $color, $material, $linea, $cliente, $numeromodelo, $idingreso, $fecha, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion,$modificar,$talla,$idalmacensesion,$estadotraspaso, $fechaingreso, false);

 //$sql[] =getSqlNewModelodetalle($idmodelodetalle, $codigo, $idmarca, $idingreso, $color, $material, $linea, $idcoleccion, $cliente, $numeromodelodetalle, $unido, $inventario, $rebaja, $estado, $numeracion,  false);

        $numeromodelo++;
        $numeromodelodetalle++;
                 

switch($numerocajas){
    case '0':
    $numerocajasa = '1';
    break;
     case '0.20':
    $numerocajasa = '1';
    break;
     case '0.25':
    $numerocajasa = '1';
    break;
     case '0.30':
    $numerocajasa = '1';
    break;
    case '0.5':
    $numerocajasa = '1';
    break;
     case '0.50':
    $numerocajasa = '1';
    break;
     case '0.75':
    $numerocajasa = '1';
    break;
       case '1.5':
    $numerocajasa = '1';
    break;
      case '1.50':
    $numerocajasa = '1';
    break;
    default:
        $numerocajasa =$numerocajas;
        break;
}


 for($k=1;$k<=$numerocajasa;$k++){
       $idkardex = "kar-".$numerokardex;
    $codigobarraA = ObtenerCodigoBarraMarcaCaja($idmarca ,$idcoleccion, true);
    $codigobarracaja = $codigobarraA['resultado'];
    $codigobarraprevio =$codigobarracaja.$k;
    $codigobarraean13 = $codigobarraprevio.$numeroparesfila;
    
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
            if($numerocajas>='1'){$numerocajas="1";}else{}
        $sql[] = getSqlNewKardexcajas($idkardexunico,$idkardex, $idmodelo, $idalmacen, $codigobarra, $numerocajas, $numerokardex, $numeroparesfila, $numeroparesfila, $numerocajas, $precioventa, $preciounitario, $preciototalcaja, $idingresoetalle, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $cantidadlector, false);
         if($opcionb == '4'){//tipo nike
            for($i=1;$i<=14;$i++){
                 $cantidad1 = $calzado->$i;
            $numeroparesfila = $calzado->totalpares;
            $totalparescaja = $calzado->totalparescaja;
            $numerocajas = $calzado->totalcajas;

                $tallakardex = $i;
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;

                if($cantidad1 !=0){
                    $talla = $i;
                  if($talla == '1'){$tallab ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$tallab ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$tallab ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$tallab ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$tallab ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$tallab ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$tallab ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$tallab ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$tallab ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$tallab ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$tallab ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$tallab ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$tallab ='13'; $tallamm ='13';$tallammm ='13';}
                  $tallafin = $tallab;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
                  $tallakardex = $tallafinal;
 $idkardexdetalle = "k-".$numerokardexdetalle;
 $numerokardexdetalle = $numerokardexdetalle;
 $numparesindividual = $cantidad1;
$sql[]= getSqlNewKardexdetalle($iddetalle, $idmodelo, $idkardex, $cantidad1, $numparesindividual, $tallakardex, $idingreso, $idadicional, $preciounitario,$idkardexdetalle,$numerokardexdetalle,false);
$sql[]= getSqlNewKardexdetalleingreso($iddetalle, $idmodelo, $idkardex, $numparesindividual, $cantidad1, $tallakardex, $idingreso, $idadicional, $preciounitario,false);

registrarparesportalla($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$i,$numparesindividual,true);
$numerokardexdetalle ++;

                }
                if($cantidadm !=0){
                    $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                $talla1 = $tallan;
                $tallakardex = $tallam;
                $cantidad1 =$cantidadm;
                $tallafin = $talla2;
                $idkardexdetalle = "k-".$numerokardexdetalle;
 $numerokardexdetalle = $numerokardexdetalle;
  $numparesindividual = $cantidad1;
 //$sql[]= getSqlNewKardexdetalle($iddetalle, $idmodelo, $idkardex, $cantidad1, $numparesindividual, $tallakardex, $idingreso, $idadicional, $preciounitario,$idkardexdetalle,$numerokardexdetalle,false);
   $sql[]= getSqlNewKardexdetalleingreso($iddetalle, $idmodelo, $idkardex, $cantidad1, $numparesindividual, $tallakardex, $idingreso, $idadicional, $preciounitario,false);
registrarparesportalla($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$i,$numparesindividual,true);
$numerokardexdetalle ++;

                }
            }

        }
        else{//tipo 14-38
            for($i=14;$i<=45;$i++){
            $cantidad1 = $calzado->$i;
            $numeroparesfila = $calzado->totalpares;
            $totalparescaja = $calzado->totalparescaja;
            $numerocajas = $calzado->totalcajas;
          if($cantidad1 !=0){
            $tallakardex = $i;
     $idkardexdetalle = "k-".$numerokardexdetalle;
 $numerokardexdetalle = $numerokardexdetalle;
 $numparesindividual = $cantidad1;

$sql[]= getSqlNewKardexdetalle($iddetalle, $idmodelo, $idkardex, $cantidad1, $numparesindividual, $tallakardex, $idingreso, $idadicional, $preciounitario,$idkardexdetalle,$numerokardexdetalle,false);
    $sql[]= getSqlNewKardexdetalleingreso($iddetalle, $idmodelo, $idkardex, $numparesindividual, $cantidad1, $tallakardex, $idingreso, $idadicional, $preciounitario,false);

$tallafin =$tallakardex;
registrarparesportalla($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$i,$numparesindividual,true);
$numerokardexdetalle ++;
    }
            }
        }
//fin caja

        $numerokardex++;
  }
    $numerokardex++;
    }

//MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){
           finalizandoinsercion(true);
        $dev['mensaje'] = "Se registro el ingreso correctamente.";
        $dev['error'] = "true";
        $dev['resultado'] = "$idingreso";
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

function finalizandoinsercion($return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   $sql[] = "UPDATE concurrencia SET estado='libre' ;";
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);
}
function iniciandoinsercion($idalmacen,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   $idalmacen=$_SESSION['idalmacen'];
   $sql[] = "UPDATE concurrencia SET estado='ocupado',idalmacen='$idalmacen' ;";
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);
}
function registrarparesportalla($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$i,$cantidad1,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";

for($l=1;$l<=$cantidad1;$l++){
 $codigoregistrado = registrarcodigoporpar($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$l,true);
    $codigoregistrado = $codigoregistrado['resultado'];

}

    $sql[] = "UPDATE colores SET codigo='1' WHERE idcolor = 'col-1';";
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);
}
function registrarcodigoporpar($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$l,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
$tallaverifica=$tallakardex;
$idalmacen=$_SESSION['idalmacen'];
 $codigobarraA = ObtenerCodigoBarraMarcaPar($idmarca ,$idcoleccion,$tallafin,$idmodelo,$idkardex, true);
    $codigobarracaja = $codigobarraA['resultado'];
    $codigobarraprevio =$codigobarracaja;
    //echo $codigobarraprevio;
     $sqlMarca = "SELECT idgrupo,opcionb frOM marcas WHERE idmarca = '$idmarca'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idgrupo");
    $idgrupo = $codigomarcaA['resultado'];
 $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "opcionb");
    $opcionb = $codigomarcaA['resultado'];
    if($idgrupo=='1'){
     $codigobarraean13 = $codigobarraprevio.$tallakardex;
      }else{
        $codigobarraean13 = $codigobarraprevio.$tallafin;
      }
   
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                if($opcionb=="2"){
                  switch ($tallakardex){
    case "34" :
     $order = "U";
    break;
   case "35" :
    $order = "XS";
    break;
      case "36" :
    $order = "S";
    break;
    case "37" :
    $order = "P";
    break;
    case "38" :
    $order = "M";
    break;
    case "39" :
    $order = "L";
    break;
     case "40" :
    $order = "XL";
    break;
    default:
      $order = $tallakardex;
        }
 $tallakardex=$order;
                }
            else{
                $tallakardex=$tallakardex;
            }
//  nction getSqlNewKardexdetallepar($idkardexunico, $idkardex, $idkardexdetalle, $idmodelo, $idingreso, $codigobarra, $saldocantidad, $talla, $numero, $preciounitario, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $idimpresion, $idalmacen, $return){
 $sqlnumeracion = "SELECT MAX(idkardexunico) AS codigobarra FROM kardexdetallepar ";
            $opcionA = findBySqlReturnCampoUnique($sqlnumeracion, true, true, "codigobarra");
   $idkardexu = $opcionA['resultado'] +1;

 $sql[] =getSqlNewKardexdetallepar($idkardexunico, $idkardex, $idkardexdetalle, $idmodelo, $idingreso, $codigobarra, $i, $tallakardex, $numero, $preciounitario, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $idimpresion,$idalmacen,false);

     $sqlcol = "SELECT idkardex FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";

    $opcionA = findBySqlReturnCampoUnique($sqlcol, true, true, "idkardex");
   $idkardexgestion = $opcionA['resultado'];
$sql[] =getSqlNewKardexdetalleparingreso($idkardexu, $idkardexgestion, $idingreso, $saldocantidad, $talla, $preciounitario, $idalmacen,false);

//$sql[] = getSqlNewHistorialkardex($idkardexu, $saldocantidad, $preciounitario, $talla, $idalmacen, $idkardexgestion, $idmarca, '0', $saldocantidad, '0', '0', '0', '0', '0', false);
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);
}

function ObtenerCodigoBarraMarcaPar($idmarca , $idcoleccion,$lcant,$idmodelo,$idkardex,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";

$numeraciontalla =$lcant;
    $sqlMarca = "SELECT mar.codigobarra FROM `marcas` mar WHERE mar.idmarca = '$idmarca'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "codigobarra");
    $codigomarca = $codigomarcaA['resultado'];

    $sqlnumeracion = "SELECT MAX(con.codigobarra) AS codigobarra FROM
  codigonumeraciontalla con WHERE con.idmarca = '$idmarca'";
//    $sqlnumeracion = "SELECT MAX(con.codigobarra) AS codigobarra FROM
//  codigonumeraciontalla con WHERE con.idmodelo= '$idmodelo' AND con.idmarca = '$idmarca'";
//
   $codigonumeracionA = findBySqlReturnCampoUnique($sqlnumeracion, true, true, "codigobarra");
    if($codigonumeracionA['resultado'] == null || $codigonumeracionA['resultado'] == 'null' || $codigonumeracionA['resultado'] == '') {
            $codigonumeracion = 10000000;
        }
        else {
    $codigonumeracion = $codigonumeracionA['resultado']+1;
        }
        if($codigonumeracion==null||$codigonumeracion=='')
        {$minimo=10000000;
             $maximo = 99999999;
            $numero = Math.floor(Math.random()*($maximo-$minimo+1))+$minimo;
            $codigonumeracion = $numero;
         }
        else {
    $codigonumeracion = $codigonumeracion;
        }
    //$dato = $codigomarca.$codigocoleccion.$codigonumeracion.$numeraciontalla;
    $dato = $codigomarca.$codigonumeracion;
$sql[] =getSqlNewCodigonumeraciontalla($idcodigonumeracion, $numeraciontalla, $idmarca, $codigonumeracion,$idmodelo, false);


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
function ObtenerCodigoBarraMarcaCaja($idmarca , $idcoleccion,$return){
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
  cco.idcoleccion = '$idcoleccion' AND cco.idmarca = '$idmarca'
";
    $codigocoleccionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "codigobarra");
    $codigocoleccion = $codigocoleccionA['resultado'];
    $idcoleccionA = findBySqlReturnCampoUnique($sqlcoleccion, true, true, "idcoleccion");
    $idcoleccion = $idcoleccionA['resultado'];

    $sqlnumeracion = "
SELECT
  MAX(con.codigobarra) AS codigobarra
FROM
  codigonumeracioncaja con
WHERE
  con.idcoleccion = '$idcoleccion' AND con.idmarca = '$idmarca'";
    $codigonumeracionA = findBySqlReturnCampoUnique($sqlnumeracion, true, true, "codigobarra");
    if($codigonumeracionA['resultado'] == null || $codigonumeracionA['resultado'] == 'null' || $codigonumeracionA['resultado'] == '') {
            $codigonumeracion = 1000;
        }
        else {
            //$num_hoja = $mayor['mayor']+1;
    $codigonumeracion = $codigonumeracionA['resultado']+1;
        }
    //$codigonumeracion = $codigonumeracionA['resultado']+1;


    $dato = $codigomarca.$codigocoleccion.$codigonumeracion;
  //  echo $dato;
        $sql[] = getSqlNewCodigonumeracioncaja($idcodigonumeracion, $idcoleccion, $idmarca,$codigonumeracion, false);
// MostrarConsulta($sql);
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
function getSqlNewCodigonumeracioncaja($idcodigonumeracion, $idcoleccion, $idmarca, $codigobarra, $return){
$setC[0]['campo'] = 'idcodigonumeracion';
$setC[0]['dato'] = $idcodigonumeracion;
$setC[1]['campo'] = 'idcoleccion';
$setC[1]['dato'] = $idcoleccion;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'codigobarra';
$setC[3]['dato'] = $codigobarra;
$sql2 = generarInsertValues($setC);
return "INSERT INTO codigonumeracioncaja ".$sql2;
}
function registrarpares($idkardextienda,$numerokardex,$numerokardex16,$idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1,  $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingreso, $idingreso, $codigobarraean13,$return){
//$numerokardexA = findUltimoID("ingresokardextienda", "numero", true);
 //  $numerokardex1 = $numerokardexA['resultado']+1;
  //    $idkardextienda = "kar-".$numerokardex;
 $dev['error'] = "false";
    $dev['mensaje'] = "";
  //  echo $numerokardex;
     $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingreso, $idingreso, $codigobarraean13,$generado,false);
                                $numerokardex++;
 $fechatoday = Date("Y-m-d");
$sql1 = "SELECT MAX(numero) AS ultimo FROM ingresokardextienda";
     $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "ultimo");
   $numeroingreso = $opcionA['resultado']+1;
   $sql[] = getSqlNewIngresoKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numeroingreso, $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $fechatoday, $iddetalleingreso, $idingreso, $codigobarraean13,$generado,false);
                                 $numerokardex1++;

  
    //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idmodelo;
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

function actualizarpares($idmodelo,$iddetalleingreso, $idingreso,$tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $precio3sus,$cantidad1,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
   $numeroA = findUltimoID("modelos", "numero", true);
    $numero = $numeroA['resultado'] + 1;
    $idmodelo = "mod-".$numero;
     $sqld = "SELECT dtpt.idkardextienda ,dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='$tallafinal' ANd dtpt.unido='no'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $paresexistentes =  $tallaA['resultado'];
           $tallaA1 = findBySqlReturnCampoUnique($sqld, true, true, "idkardextienda");
          $idkardextienda =  $tallaA1['resultado'];
           $nuevacantidad= $paresexistentes+$cantidad1;
     $sql[] = "UPDATE adiciondetalleingreso SET  color='$color' WHERE iddetalleingreso = '$iddetalleingreso';";
  $sql[] = "UPDATE adicionkardextienda SET saldocantidad ='$nuevacantidad',precio2bs='$precio',precio3bs='$color' WHERE idcalzado = '$iddetalleingreso' AND talla='$tallafinal' ;";
  $numerokardexA1 = findUltimoID("ingresokardextienda", "numero", true);
    $numerokardex1 = $numerokardexA1['resultado']+1;
 $fechatoday = Date("Y-m-d");
 $sql1 = "SELECT MAX(numero) AS ultimo FROM ingresokardextienda";
     $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "ultimo");
   $numeroingreso = $opcionA['resultado']+1;
$sql[] = getSqlNewIngresoKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numeroingreso, $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $fechatoday, $iddetalleingreso, $idingreso, $codigobarraean13,$generado,false);
                 $numerokardex1++;
// MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idmodelo;
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
function unirparesdemodelos($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 //echo $resultado;
    $numeroA = findUltimoID("adicioningresotienda", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idingreso="ing-".$numero;

 //echo $idingreso;
    $ingreso = $resultado->ingreso;
    // echo $ingreso;
    $modelonuevo = $ingreso->modelonuevo;
     $idmarca = $ingreso->idmarca;
//echo $modelonuevo;
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
   
    $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb,mar.talla
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
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
//echo $sqlmarca;

    $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;

$sumador ="0";
$talla1ma ="0";
$talla2ma ="0";
$talla3ma ="0";
$talla4ma ="0";
$talla5ma ="0";
$talla6ma ="0";
$talla7ma ="0";
$talla8ma ="0";
$talla9ma ="0";
$talla10ma ="0";
$talla11ma ="0";
$talla12ma ="0";
$talla13ma ="0";
$talla1a ="0";
$talla2a ="0";
$talla3a ="0";
$talla4a ="0";
$talla5a ="0";
$talla6a ="0";

$talla7a ="0";
$talla8a ="0";
$talla9a ="0";
$talla10a ="0";
$talla11a ="0";
$talla12a ="0";
$talla13a ="0";
$talla14a ="0";
$talla15a ="0";
$talla16a ="0";
$talla17a ="0";
$talla18a ="0";
$talla19a ="0";
$talla20a ="0";
$talla21a ="0";
$talla22a ="0";
$talla23a ="0";
$talla24a ="0";
$talla25a ="0";
$talla26a ="0";
$talla27a ="0";
$talla28a ="0";
$talla29a ="0";
$talla30a ="0";
$talla31a ="0";
$talla32a ="0";


$talla33a ="0";
$talla34a ="0";
$talla35a ="0";
$talla36a ="0";
$talla37a ="0";
$talla38a ="0";
$talla39a ="0";
$talla40a ="0";
$talla41a ="0";
$talla42a ="0";
$talla43a ="0";
$talla44a ="0";
$talla45a ="0";

//$idbuscarejemplo="";
 $idbuscarejemplo = $modelonuevo;

    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $iddetalleingreso = $calzado->iddetalleingreso;
       // $idbuscarejemplo = $iddetalleingreso;
       $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='1m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla1m =  $tallaA['resultado'];
           $talla1ma= $talla1ma+$talla1m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='2m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla2m=  $tallaA['resultado'];
       $talla2ma= $talla2ma+$talla2m;
          $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='3m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla3m =  $tallaA['resultado'];
           $talla3a= $talla3a+$talla3m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='4m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla4m=  $tallaA['resultado'];
       $talla4ma= $talla4ma+$talla4m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='5m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla5m =  $tallaA['resultado'];
       $talla5ma= $talla5ma+$talla5m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='6m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla6m =  $tallaA['resultado'];
     $talla6ma= $talla6ma+$talla6m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='7m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $talla7m =  $tallaA['resultado'];
        $talla7ma= $talla7ma+$talla7m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='8m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla8m =  $tallaA['resultado'];
       $talla8ma= $talla8ma+$talla8m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='9m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla9m =  $tallaA['resultado'];
       $talla9ma= $talla9ma+$talla9m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='10m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla10m =  $tallaA['resultado'];
     $talla10ma= $talla10ma+$talla10m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='11m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla11m =  $tallaA['resultado'];
         $talla11ma= $talla11ma+$talla11m;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='12m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla12m =  $tallaA['resultado'];
         $talla12ma= $talla12ma+$talla12m;
          $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='13m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla13m =  $tallaA['resultado'];
         $talla13ma= $talla13ma+$talla13m;
/////////////////////////////////////////////////
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='1'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla1 =  $tallaA['resultado'];
           $talla1a= $talla1a+$talla1;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='2'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla2=  $tallaA['resultado'];
       $talla2a= $talla2a+$talla2;
          $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='3'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla3 =  $tallaA['resultado'];
           $talla3a= $talla3a+$talla3;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='4'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla4=  $tallaA['resultado'];
       $talla4a= $talla4a+$talla4;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='5'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla5 =  $tallaA['resultado'];
       $talla5a= $talla5a+$talla5;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='6'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla6 =  $tallaA['resultado'];
     $talla6a= $talla6a+$talla6;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='7'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $talla7 =  $tallaA['resultado'];
        $talla7a= $talla7a+$talla7;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='8'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla8 =  $tallaA['resultado'];
       $talla8a= $talla8a+$talla8;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='9'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla9 =  $tallaA['resultado'];
       $talla9a= $talla9a+$talla9;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='10'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla10 =  $tallaA['resultado'];
     $talla10a= $talla10a+$talla10;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='11'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla11 =  $tallaA['resultado'];
         $talla11a= $talla11a+$talla11;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='12'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla12 =  $tallaA['resultado'];
         $talla12a= $talla12a+$talla12;
/////////////////////////////////////////////////
          $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='13'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla13 =  $tallaA['resultado'];
           $talla13a= $talla13a+$talla13;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='14'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla14=  $tallaA['resultado'];
       $talla14a= $talla14a+$talla14;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='15'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla15 =  $tallaA['resultado'];
       $talla15a= $talla15a+$talla15;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='16'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla16 =  $tallaA['resultado'];
     $talla16a= $talla16a+$talla16;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='17'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $talla17 =  $tallaA['resultado'];
        $talla17a= $talla17a+$talla17;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='18'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla18 =  $tallaA['resultado'];
       $talla18a= $talla18a+$talla18;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='19'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla19 =  $tallaA['resultado'];
       $talla19a= $talla19a+$talla19;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='20'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla20 =  $tallaA['resultado'];
     $talla20a= $talla20a+$talla20;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='21'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla21 =  $tallaA['resultado'];
         $talla21a= $talla21a+$talla21;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='22'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla22 =  $tallaA['resultado'];
         $talla22a= $talla22a+$talla22;
//////////////////////////////////////////////
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='23'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla23 =  $tallaA['resultado'];
           $talla23a= $talla23a+$talla23;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='24'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla24=  $tallaA['resultado'];
       $talla24a= $talla24a+$talla24;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='25'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla25 =  $tallaA['resultado'];
       $talla25a= $talla25a+$talla25;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='26'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla26 =  $tallaA['resultado'];
     $talla26a= $talla26a+$talla26;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='27'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $talla27 =  $tallaA['resultado'];
        $talla27a= $talla27a+$talla27;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='28'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla28 =  $tallaA['resultado'];
       $talla28a= $talla28a+$talla28;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='29'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla29 =  $tallaA['resultado'];
       $talla29a= $talla29a+$talla29;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='30'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla30 =  $tallaA['resultado'];
     $talla30a= $talla30a+$talla30;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='31'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla31 =  $tallaA['resultado'];
         $talla31a= $talla31a+$talla31;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='32'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla32 =  $tallaA['resultado'];
         $talla32a= $talla32a+$talla32;

        //////////////////////////////////////
      $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='33'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
          $talla33 =  $tallaA['resultado'];
           $talla33a= $talla33a+$talla33;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='34'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla34=  $tallaA['resultado'];
       $talla34a= $talla34a+$talla34;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='35'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla35 =  $tallaA['resultado'];
       $talla35a= $talla35a+$talla35;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='36'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla36 =  $tallaA['resultado'];
     $talla36a= $talla36a+$talla36;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='37'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $talla37 =  $tallaA['resultado'];
        $talla37a= $talla37a+$talla37;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='38'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla38 =  $tallaA['resultado'];
       $talla38a= $talla38a+$talla38;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='39'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla39 =  $tallaA['resultado'];
       $talla39a= $talla39a+$talla39;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='40'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
     $talla40 =  $tallaA['resultado'];
     $talla40a= $talla40a+$talla40;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='41'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla41 =  $tallaA['resultado'];
         $talla41a= $talla41a+$talla41;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='42'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla42 =  $tallaA['resultado'];
         $talla42a= $talla42a+$talla42;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='43'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla43 =  $tallaA['resultado'];
         $talla43a= $talla43a+$talla43;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='44'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla44 =  $tallaA['resultado'];
         $talla44a= $talla44a+$talla44;
         $sqld = "SELECT dtpt.saldocantidad AS cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='45'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
       $talla45 =  $tallaA['resultado'];
  $talla45a= $talla45a+$talla45;
       
        $numeropares = $calzado->totalpares;
        //$idmodelolok
         $sqlmarca = "
SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelo' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idcoleccion");
    $idcoleccion = $opcionA1['resultado'];
    $codigobarramcn = $codigobarraA['resultado'];
      
    }
 $value['33'] =  "$talla33a";

 if($talla == "14-38"){
        $value['14'] = "$talla14a";
        $value['15'] =  "$talla15a";
        $value['16'] =  "$talla16a";
        $value['17'] = "$talla17a";
        $value['18'] =  "$talla18a";

         $value['19'] = "$talla19a";
        $value['20'] =  "$talla20a";
        $value['21'] =  "$talla21a";
        $value['22'] = "$talla22a";
        $value['23'] =  "$talla23a";
         $value['24'] = "$talla24a";
        $value['25'] =  "$talla25a";
        $value['26'] =  "$talla26a";
        $value['27'] = "$talla27a";
        $value['28'] =  "$talla28a";

         $value['29'] = "$talla29a";
        $value['30'] =  "$talla30a";
        $value['31'] =  "$talla31a";
        $value['32'] = "$talla32a";
        $value['33'] =  "$talla33a";
       $value['34'] = "$talla34a";
        $value['35'] =  "$talla35a";
        $value['36'] =  "$talla36a";
        $value['37'] = "$talla37a";
        $value['38'] =  "$talla38a";

        $sumapares= $talla14a+$talla15a +$talla16a+$talla17a+$talla18a+$talla19a+$talla20a+$talla21a+$talla22a+$talla23a+$talla24a+$talla25a +$talla26a+$talla27a+$talla28a+$talla29a+$talla30a+$talla31a+$talla32a+$talla33a+$talla34a+$talla35a+$talla36a+$talla37a+$talla38a;

    }
      if($talla == "33-45"){
        $value['34'] = "$talla34a";
        $value['35'] =  "$talla35a";
        $value['36'] =  "$talla36a";
        $value['37'] = "$talla37a";
        $value['38'] =  "$talla38a";
        $value['39'] =  "$talla39a";
        $value['40'] =  "$talla40a";
        $value['41'] =  "$talla41a";
        $value['42'] =  "$talla42a";
        $value['43'] =  "$talla43a";
        $value['44'] = "$talla44a";
        $value['45'] =  "$talla45a";
        $sumapares= $talla33a+$talla34a+$talla35a+$talla36a+$talla37a+$talla38a+$talla39a+$talla40a+$talla41a+$talla42a+$talla43a+$talla44a+$talla45a;
    }
      if($talla == "1-12"){
        $value['1'] = "$talla1a";
        $value['2'] =  "$talla2a";
        $value['3'] =  "$talla3a";
        $value['4'] = "$talla14a";
        $value['5'] =  "$talla5a";

         $value['6'] = "$talla6a";
        $value['7'] =  "$talla7a";
        $value['8'] =  "$talla8a";
        $value['9'] = "$talla9a";
        $value['10'] =  "$talla10a";
         $value['11'] = "$talla11a";
        $value['12'] =  "$talla12a";
        $value['13'] =  "$talla13a";
            $value['1m'] = "$talla1ma";
        $value['2m'] =  "$talla2ma";
        $value['3m'] =  "$talla3ma";
        $value['4m'] = "$talla4ma";
        $value['5m'] =  "$talla5ma";

         $value['6m'] = "$talla6ma";
        $value['7m'] =  "$talla7ma";
        $value['8m'] =  "$talla8ma";
        $value['9m'] = "$talla9ma";
        $value['10m'] =  "$talla10ma";
         $value['11m'] = "$talla11ma";
        $value['12m'] =  "$talla12ma";
        $value['13m'] =  "$talla13ma";

        $sumapares= $talla1a+$talla2a +$talla3a+$talla4a+$talla5a+$talla6a+$talla7a+$talla8a+$talla9a+$talla10a+$talla11a+$talla12a +$talla13a +$talla1ma+$talla2ma+$talla3ma+$talla4ma+$talla5ma+$talla6ma+$talla7ma+$talla8ma+$talla9ma+$talla10ma+$talla11ma+$talla12ma+$talla13ma;

    }
       
    $preciopromedio="0.00";
    $sql ="
SELECT mdd.idmodelo,dtp.iddetalleingreso, mdd.codigo AS codigo, '$sumapares' AS totalpares, '$preciopromedio' AS precio, dtp.material, dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo AND dtp.unido='no' AND dtp.iddetalleingreso='$idbuscarejemplo'
";
         $tallaA = findBySqlReturnCampoUnique($sql, true, true, "idmodelo");
        $value['idmodelo'] =  $tallaA['resultado'];
      $tallaA = findBySqlReturnCampoUnique($sql, true, true, "codigo");
        $value['codigo'] =  $tallaA['resultado'];
        $tallaA = findBySqlReturnCampoUnique($sql, true, true, "color");
        $value['color'] =  $tallaA['resultado'];
        $tallaA = findBySqlReturnCampoUnique($sql, true, true, "precio");
        $value['precio'] =  $tallaA['resultado'];
         $tallaA = findBySqlReturnCampoUnique($sql, true, true, "totalpares");
        $value['totalpares'] =  $tallaA['resultado'];
      //   $tallaA = findBySqlReturnCampoUnique($sql, true, true, "iddetalleingreso");
       // $iddetalleingreso =  $tallaA['resultado'];
    $tallaA = findBySqlReturnCampoUnique($sql, true, true, "coleccion");
        $value['coleccion'] =  $tallaA['resultado'];


       
//    MostrarConsulta($sql);

    if($modelonuevo != null)
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
                        $dev['mensaje'] = "No se encontro datos en la consulta ";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta d";
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
function GuardarNuevoIngresoUnido($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 //echo $resultado;
 $numeroA = findUltimoID("adicioningresotienda", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idingreso="ing-".$numero;
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
   
    $ingreso = $resultado->ingreso;
    // echo $ingreso;
    $idmarca = $ingreso->idmarca;
$idestilo = $ingreso->idestilo;
    $totalpares = $ingreso->totalpares;
    $totalpares2 = $ingreso->totalpares2;
    $responsable = $_SESSION['idusuario'];
    $observacion = $ingreso->descripcion;
    //$idtienda = $_SESSION['idtienda'];
      $idtienda ='tie-2';
  //  $sql[]=getSqlNewAdicionIngresotienda($idingreso, $codigo, $numero, $estado, $fecha, $hora, $totalpares, $totalbs, $responsable, $idestilo, $idmarca, $idtienda, false);

    $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
    $calzados = $resultado->calzados;
  $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";

    $numeropedidoA = findUltimoNumeroPedidoMarca($idmarca, true);
    $numero1 = $numeropedidoA['resultado']+1;
    $sql[] =getSqlNewNumeropedido($idnumero, $idmarca, $numero1, $return);
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

    $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;
$calzadoseliminar = $resultado->calzadoseliminar;
  $calzados = $resultado->calzados;
  $iddetallefinal ="";
  $numeroD = findUltimoID("numeracionimpresion", "numero", true);
    $numeroimpresion = $numeroD['resultado'] +1;
     $idimpresion = "imp-".$numeroimpresion;
$iddetalleingresonuevo = "";
$calzados = $resultado->calzados;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $iddetalleingreso = $calzado->iddetalleingreso;
         $iddetalleingresonuevo = $calzado->iddetalleingreso;
      //  echo $codigocalzado;
        $codigo = $calzado->codigo;
        $colornuevo = $calzado->color;
        $materialnuevo = $calzado->material;
        $precionuevo = $calzado->precio;
        $precio  = $calzado->precio;
        $lineanuevo = $calzado->linea;
        $numeroparesnuevo = $calzado->totalpares;
        $numerocajasnuevo = $calzado->totalcajas;
        $stylenamenuevo = $calzado->stylename;
 $coleccion = $calzado->coleccion;
 $opciont = $calzado->opciont;

// $codigocalzado = $calzado->codigo;
 //   $coleccion = $calzado->coleccion;
  //      $color = $calzado->color;

     //   $material = $calzado->material;
     //   $precio = $calzado->precio;
     //$linea = $calzado->linea;
      //  $numeropares = $calzado->totalpares;
        $numerocajas = "1";
       // $stylename = $calzado->stylename;
        //$iddetalleingreso = $calzado->iddetalleingreso;


$sql1= "SELECT
             iddetalleingreso,color,material,totalpares,totalbs,idmodelo,idingreso,generado
            FROM
              adiciondetalleingreso
            WHERE
              iddetalleingreso = '$iddetalleingreso'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "iddetalleingreso");
  $iddetalleingreso = $result1['resultado'];
  $result2 = findBySqlReturnCampoUnique($sql1, true, true, "color");
  $color = $result2['resultado'];
  $result3 = findBySqlReturnCampoUnique($sql1, true, true, "material");
  $material = $result3['resultado'];
  $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "idmodelo");
   $idmodelodetalle = $opcionA['resultado'];
  $opcionA1 = findBySqlReturnCampoUnique($sql1, true, true, "idingreso");
   $idoperacion = $opcionA1['resultado'];
 //  echo $sql1;
   $sql1= "SELECT codigo,idcoleccion FROM modelos WHERE idmodelo='$idmodelodetalle' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "codigo");
  $modeloanterior = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcoleccion");
  $idcoleccion = $result1['resultado'];
$sql1= "SELECT codigo FROM coleccion WHERE idcoleccion='$idcoleccion' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "codigo");
  $idcoleccionant = $result1['resultado'];
    //    $sql[] = getSqlDeleteLinea_marca($idmarca);
    if($colornuevo==null || $colornuevo=='' ){$tipo ="1"; }
    if($materialnuevo==null || $materialnuevo=='' ){$tipo ="2"; }
    if($coleccion==null || $coleccion=='' ){$tipo ="3"; }
//    echo $opcionpedido;
if($opcionpedido=="CODIGO"){
   $busqueda = "1";
   if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}

}
if($opcionpedido=="CODIGO-COLOR"){
   $busqueda = "2";
   if($colornuevo==null || $colornuevo==''){
       if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
   }else{
   if(($codigo ==$modeloanterior)&&($colornuevo==$color))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
   }
}
if($opcionpedido=="CODIGO-COLOR-MATERIAL"){
     if($materialnuevo==null || $materialnuevo=='' ){
           if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
       }else{
   if(($codigo ==$modeloanterior)&&($colornuevo==$color)&&($materialnuevo==$material))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
       }
}
if($opcionpedido=="CODIGO-COLOR-STYLENAME"){
  if(($codigo ==$modeloanterior)&&($colornuevo==$color)&&($materialnuevo==$material))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}

}
if($opcionpedido=="LINEA-CODIGO-COLOR"){
   if(($codigo ==$modeloanterior)&&($colornuevo==$color))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}

}
$verificaopcion="existe";
if($verificaopcion=="existe"){
// echo "esta";
//if($colornuevo==$color && $materialnuevo==$material && $codigo ==$modeloanterior && $coleccion==$idcoleccionant){
 if($materialnuevo==null ||$materialnuevo==''){$materialnuevo="-";}
      if($colornuevo==null ||$colornuevo==''){$colornuevo="-";}
      if($opciont==null || $opciont == ""){$opciontalla="0";}else{$opciontalla=$opciont;}
   $sql[] = "UPDATE adiciondetalleingreso SET totalpares='$numeroparesnuevo',totalbs='$precionuevo',opciont='$opciontalla' WHERE iddetalleingreso = '$iddetalleingreso'; ";
     $sql[] = "UPDATE adicionkardextienda SET precio2bs='$precionuevo' WHERE idcalzado = '$iddetalleingreso'; ";

      $codigobarraA = ObtenerCodigoBarraMarcaDetalleAdicion($idmarca ,$idcoleccion, true);
       $codigobarramcn = $codigobarraA['resultado'];
         if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){

            for($i=1;$i<=14;$i++){
                 $precio = $calzado->precio;
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;
               // echo $cantidad1;
                if($cantidad1 >=0){

                    $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                   if($talla == '14'){$talla ='14'; $tallamm ='14';$tallammm ='14';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
$sql3 =" SELECT COUNT(idkardextienda) AS num FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
$result1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
  $paresrepetidos = $result1['resultado'];

  if($paresrepetidos > '1'){
              borrarrepetidos($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafinal,$tallafinal1,false);
$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
 //echo "hay repetido";
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
 $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{

           actualizarsoloparesmvalores($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
  }else{
   //  echo "no hay repetido";
    $sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
//  echo $sql3;
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
 $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{
     //      echo "ya existe el par";
           actualizarsoloparesmvalores($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }

  }
//  ss

                }else{
      //               echo "entr";

  $cantidad1 = $calzado->$i;
     //         echo $cantidad1;
          $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                      if($talla == '14'){$talla ='14'; $tallamm ='14';$tallammm ='14';}
                         // if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
 actualizarsoloparesnulossinm($tallafinal,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,false);
               }

              //  para tallas m numeros;
                if($cantidadm >=0){
                    $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                 if ($tallam =='14m'){$talla2= "19";$tallan = "140";}
                $talla1 = $tallan;
                $tallafin = $tallam;
                  $tallafinal = $talla2;
                  $tallafinal1 = $tallan;

                $precio = $calzado->precio;
             //$sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
//$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1') ";
$sql3 =" SELECT COUNT(idkardextienda) AS num FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1') ";
$result1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
  $paresrepetidos = $result1['resultado'];
  if($paresrepetidos > '1'){
     borrarrepetidosvalores($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafin,$tallafinal1,$talla1,false);
$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1')";

$result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];

  if($existepar==null || $existepar ==''){
// insertarparnuevo();
   $talla1 = $tallan;

                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{


           // $tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,
     actualizarsoloparesm($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }

  }else{


$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1')";

$result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];

  if($existepar==null || $existepar ==''){
// insertarparnuevo();
   $talla1 = $tallan;

                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{


           // $tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,
     actualizarsoloparesm($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
                }
                }else{
              $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                 if ($tallam =='14m'){$talla2= "19";$tallan = "140";}

                // echo $tallam;
                $talla1 = $tallan;
                $tallafin = $tallam;
                  $tallafinal = $talla2;
                  $tallafinal1 = $tallan;
                  //echo "paresnulos talla m";
 actualizarsoloparesnulosm($tallafin,$tallafinal1,$cantidadm,$iddetalleingreso,$idmodelodetalle,false);

     }

            }
//fin tallas m
        }

     else{



 for($i=14;$i<=45;$i++){

                $cantidad1 = $calzado->$i;
                
                if($cantidad1 !=0){
                    $talla = $i;
                   // echo $talla;
    $sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
  
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
    $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1, $talla,false);

              $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $talla, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{
           actualizarsolopares($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);

   }
         }else{
                //here
          $talla = $i;
 actualizarsoloparesnulos($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,false);
                }

 }
}
//   actualizarsolopares($calzado,$opcionb,$idmarca,$iddetalleingreso,$idmodelodetalle, $idoperacion,$precionuevo,$codigo,$lineanuevo,$numeroparesnuevo,$numerocajasnuevo,false);
//diferentes
}else{
   // echo "diferentes";
       $sql[] = getSqlDeleteAdiciondetalleingreso($iddetalleingreso);
    $sql[] = getSqlDeleteAdiciondetalleingresotalla($iddetalleingreso);
    $sql[] = getSqlDeleteAdicionkardextienda($iddetalleingreso,$idmodelodetalle);

//echo $coleccion;
if($coleccion==NULL || $coleccion =="" || $coleccion ==''){

}else{
$planillaanterior= split("-",$coleccion);
 //$idsCAr = split("/", $mesplanilla);
$detalle=$planillaanterior[0];
$anio=$planillaanterior[1];
  $sql1= "SELECT idcoleccion FROM coleccion WHERE codigo='$coleccion' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcoleccion");
  $idcoleccionn = $result1['resultado'];

  if($idcoleccionn=='' ||$idcoleccionn =="" || $idcoleccionn ==NULL){
      insertarnuevacoleccion($coleccion,$idmarca,false);
      $idcoleccionnn = $res['resultado'];
  }else{
      $idcoleccionnn = $idcoleccionn;
  }
   $res= actualizarcoleccion($idmodelodetalle, $idcoleccionnn,false);
   $idcolecc = $res['resultado'];
}
  $res= actualizarcodigo($idmodelodetalle, $codigo,false);
   $codigoff = $res['resultado'];
//$sql[] = "UPDATE adiciondetalleingreso SET color='$color' ,material='$fecha' WHERE iddetalleingreso = '$iddetalleingreso' AND codigo='$codigo' ";

        if ( $color =='' || $color == null || $color == ""){
            $variablecolor = $material;
        }else{
             $variablecolor = $color;
        }

    //   function getSqlNewAdiciondetalleingreso($idmodelo, $totalpares, $totalbs, $idingreso, $iddetalleingreso, $color, $material, $numero, $return){
       $sql[] =getSqlNewAdicionDetalleingreso($idmodelodetalle, $numeroparesnuevo, $precionuevo, $idoperacion, $iddetalleingresonuevo,  $colornuevo, $materialnuevo,$numerodetalle,$generado,$opciont, false);
        $numerodetalle++;
        $sqlmarca = "
SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelodetalle' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idcoleccion");
    $idcoleccion = $opcionA1['resultado'];

        $codigobarraA = ObtenerCodigoBarraMarcaDetalleAdicion($idmarca ,$idcoleccion, true);
      //ojito

       $codigobarramcn = $codigobarraA['resultado'];
         if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){
            for($i=1;$i<=14;$i++){
                 $precio = $calzado->precio;
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;
                if($cantidad1 !=0){
                    $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidad1, 0, $cantidad1, $precio, $precio*$cantidad1, 0, $precio*$cantidad1, $fecha, $hora, $idingreso, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
                if($cantidadm !=0){
                    $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                $talla1 = $tallan;
                $talla22 = $talla2;
//s
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidadm, 0, $cantidadm, $precio, $precio*$cantidad1, 0, $precio*$cantidad1, $fecha, $hora, $idingreso, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
            }

        }

        else{


            for($i=14;$i<=45;$i++){
                $cantidad1 = $calzado->$i;
                if($cantidad1 !=0){

                    $talla = $i;
                  //  $sql[]= getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidad1, $iddetallepedido, $return);
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$talla, false);

              $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $talla, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                //                $sql[] = getSqlNewMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $numero, $saldocantidad, false);
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidad1, 0, $cantidad1, $precionuevo, $precionuevo*$cantidad1, 0, $precionuevo*$cantidad1, $fecha, $hora, $idoperacion, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
            }
        }

    }

}
//  aqui  a los marcados

 $sql1= "SELECT MAX(idunion) AS num FROM unionprecio";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj = $result['resultado'];
    $idcambio = $numeroventaj + 1;
   if($fecha == "")
    {        $fecha = date("Y-m-d");  }
  //  $sql[] =getSqlNewVentasdetalle($idventadetalle, $idtienda, $idempresa, $boleta, $numeroventa, $idclienteempresa, $nit, $nombrecliente, $apellidocliente, $fecha, $hora, $tipoventa, $numerofactura, $responsable, $credito, $totalbs, $totalpares, $montoapagar, $descuento, $montocancelado, $devuelto,$montocanceladosus, $ingresoventabs, $ingresoventasus, $montopapeleta, $tipocambio, $observacion,$arqueo, false);
 $numeropares = $numeroparesnuevo;

 $sql[] =getSqlNewUnionprecio($idcambio, $iddetalleingreso, $idtienda, $fecha, $hora, $numeropares, $precio, ($numeropares*$precio), $diferencia, $concepto, false);
//function getSqlNewUnionprecio($idunion, $idmarca, $idtienda, $fecha, $hora, $cantidadpares, $montoanterior, $montonuevo, $diferencia, $concepto, $return){

$precionuevo=$precio;
    $iddetallefinal =$iddetalleingreso;
for($j=0;$j<count($calzadoseliminar);$j++){
    $calzadoe = $calzadoseliminar[$j];
       $iddetalleingreso = $calzadoe->iddetalleingreso;
        $codigocalzadoe = $calzadoe->codigo;
         $totalpares = $calzadoe->totalpares;
         //en construccion eliminacion
         //echo $iddetalleingreso;

  $sql[] = "UPDATE adiciondetalleingreso SET unido ='$iddetallefinal' WHERE iddetalleingreso = '$iddetalleingreso' and iddetalleingreso!='$iddetallefinal';";
  $sql[] = "UPDATE adicionkardextienda SET unido ='$iddetallefinal' WHERE idcalzado = '$iddetalleingreso' and idcalzado!='$iddetallefinal';";
  $sql4 = "SELECT * FROM adiciondetalleingreso WHERE iddetalleingreso ='$iddetalleingreso'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "totalbs");
   $precioanterior = $paresd['resultado'];
   $iddetalletraspasoA = findUltimoID("unionpreciodetalle", "numero",true );
            $numerodetalletraspaso = $iddetalletraspasoA['resultado'] + 1 +$j;
            $idcambiodetalle = "un-".$numerodetalletraspaso;
$sql4 = "SELECT idmodelo FROM adiciondetalleingreso WHERE iddetalleingreso ='$iddetalleingreso'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmodelo");
   $idmodelo = $paresd['resultado'];
   $sql[] =getSqlNewUnionpreciodetalle($idcambiodetalle, $idcambio, $iddetalleingreso, $idmodelo, $totalpares, $precioanterior, ($totalpares*$precioanterior), $precionuevo, ($precionuevo*$totalpares), (($precionuevo*$totalpares)-($totalpares*$precioanterior)), $numerodetalletraspaso,false);


}


//  MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se registro la union correctamente.";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
        $dev['error'] = "false";
        $dev['resultado'] = "$idimpresion";
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

function GuardarNuevoIngreso($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";


    $numeroA = findUltimoID("adicioningresotienda", "numero", true);
    $numero = $numeroA['resultado'] +1;
    $idingreso="ing-".$numero;
    $ingreso = $resultado->ingreso;
    $codigo = $ingreso->numeropedido;
    $estado = "Activo";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $totalpares = $ingreso->totalpares;
    $totalbs = $ingreso->totalcaja;
    $responsable = $_SESSION['idusuario'];
    $idmarca = $ingreso->idmarca;
    $observacion = $ingreso->descripcion;
    $idtienda = $_SESSION['idtienda'];
    $sql[]=getSqlNewIngresotienda($idingreso, $codigo, $numero, $estado, $fecha, $hora, $totalpares, $totalbs, $responsable, $observacion, $idmarca, $idtienda, false);
    //    echo $idventa;

    $sqlmarca = "
SELECT
  mad.opcion
FROM
  `marcadetalle` mad
WHERE
  mad.idmarcadetalle = '$idmarca'
";
    $calzados = $resultado->calzados;
    $numeropedidoA = findUltimoNumeroPedidoMarca($idmarca, true);
    $numero1 = $numeropedidoA['resultado']+1;
    $sql[] =getSqlNewNumeropedido($idnumero, $idmarca, $numero1, $return);

    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;

    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $codigocalzado = $calzado->codigo;
        $idmodelo = $calzado->idmodelo;
        $totalpar = $calzado->totalpares;
        $totalbs1 = $calzado->totalbs;
        $precio = $calzado->precio;
        $iddetalleingreso = "din-".$numerodetalle;
        $sql[] =getSqlNewDetalleingreso($idmodelo, $totalpar, $totalbs1, $idingreso, $iddetalleingreso, $numerodetalle, false);
        $numerodetalle++;
        $codigobarraA = ObtenerCodigoBarraMarcaDetalle($idmarca , true);
        $codigobarramcn = $codigobarraA['resultado'];
        //        echo $codigobarramcn;

        for($i=14;$i<=45;$i++){
            $cantidad1 = $calzado->$i;
            if($cantidad1 !=0){

                $talla = $i;

                $sql[]= getSqlNewDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad1, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                //                $codigobarra = $codigobarra1['restulado'];
                $sql[] = getSqlNewKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $talla, $precio1bs, $precio2bs, $precio3bs, $precio1sus, $precio2sus, $precio3sus, $idcalzado, $idingreso, $codigobarraean13,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                //                $sql[] = getSqlNewMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $numero, $saldocantidad, false);
                $sql[] = getSqlNewMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidad1, 0, $cantidad1, $precio, $precio*$cantidad1, 0, $precio*$cantidad1, $fecha, $hora, $idingreso, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
            }
        }

    }

    //    MostrarConsulta($sql);

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

function ListarIngresosAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
SELECT
  ing.idingreso,
  ing.codigo,
  ing.numero,
  ing.estado,
  ing.fecha,
  ing.hora,
  ing.totalpares,
  ing.totalbs,
  ing.responsable,
  ing.observacion,
  ing.idmarca,
  ing.idtienda,
  tie.codigo AS tienda,
  usu.nombre AS responsable,
  mad.nombre AS marca
FROM
  adicioningresotienda ing,
  tiendas tie,
  usuario usu,
  marcadetalle mad
WHERE
  ing.idtienda = tie.idtienda AND
  ing.responsable = usu.idusuario AND
  ing.idmarca = mad.idmarcadetalle $order LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
    SELECT
  ing.idingreso,
  ing.codigo,
  ing.numero,
  ing.estado,
  ing.fecha,
  ing.hora,
  ing.totalpares,
  ing.totalbs,
  ing.responsable,
  ing.observacion,
  ing.idmarca,
  ing.idtienda,
  tie.codigo AS tienda,
  usu.nombre AS responsable,
  mad.nombre AS marca
FROM
  adicioningresotienda ing,
  tiendas tie,
  usuario usu,
  marcadetalle mad
WHERE
  ing.idtienda = tie.idtienda AND
  ing.responsable = usu.idusuario AND
  ing.idmarca = mad.idmarcadetalle AND $where $order LIMIT $start,$limit
         ";
        //        MostrarConsulta($sql);
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
function BuscarTiendaMarca($callback, $_dc, $where = '', $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $proveedores =  ListarTienda('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['tiendas'] = "true";
        $value['tiendaM'] = $proveedores['resultado'];
    }
    $categorias = ListarMarcaDetalle('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
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
function BuscarModeloDetallePorMarca($idmarca , $idtienda,$callback, $_dc, $where = '', $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $_SESSION['idtienda'] = $idtienda;


    $proveedores =  ListarModeloDetalle('', '', '', '', '', '',$idmarca,true);
    if($proveedores['error'] == true)
    {
        $value['modelos'] = "true";
        $value['modeloM'] = $proveedores['resultado'];
    }
    $numeropa= findUltimoNumeroPedidoMarca($idmarca, true);
    $numero = $numeropa['resultado']+1;
    $anio = date("Y");
    $value['numerodoc'] = $numero."/".$anio;


    $sql ="
SELECT
  mad.idmarcadetalle AS idmarca,
  mad.codigo,
  mad.nombre AS marca,
  mad.codigobarra,
  mad.imagen,
  mad.talla,
  mad.idciudad,
  mad.numero,
  mad.opcion
FROM
  marcadetalle mad
WHERE
  mad.idmarcadetalle = '$idmarca';

";
    //    echo $sql;
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
function getSqlNewIngresotienda($idingreso, $codigo, $numero, $estado, $fecha, $hora, $totalpares, $totalbs, $responsable, $observacion, $idmarca, $idtienda, $return){
    $setC[0]['campo'] = 'idingreso';
    $setC[0]['dato'] = $idingreso;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'estado';
    $setC[3]['dato'] = $estado;
    $setC[4]['campo'] = 'fecha';
    $setC[4]['dato'] = $fecha;
    $setC[5]['campo'] = 'hora';
    $setC[5]['dato'] = $hora;
    $setC[6]['campo'] = 'totalpares';
    $setC[6]['dato'] = $totalpares;
    $setC[7]['campo'] = 'totalbs';
    $setC[7]['dato'] = $totalbs;
    $setC[8]['campo'] = 'responsable';
    $setC[8]['dato'] = $responsable;
    $setC[9]['campo'] = 'observacion';
    $setC[9]['dato'] = $observacion;
    $setC[10]['campo'] = 'idmarca';
    $setC[10]['dato'] = $idmarca;
    $setC[11]['campo'] = 'idtienda';
    $setC[11]['dato'] = $idtienda;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adicioningresotienda ".$sql2;
}
function getSqlNewDetalleingreso($idmodelo, $totalpares, $totalbs, $idingreso, $iddetalleingreso, $numero, $return){
    $setC[0]['campo'] = 'idmodelo';
    $setC[0]['dato'] = $idmodelo;
    $setC[1]['campo'] = 'totalpares';
    $setC[1]['dato'] = $totalpares;
    $setC[2]['campo'] = 'totalbs';
    $setC[2]['dato'] = $totalbs;
    $setC[3]['campo'] = 'idingreso';
    $setC[3]['dato'] = $idingreso;
    $setC[4]['campo'] = 'iddetalleingreso';
    $setC[4]['dato'] = $iddetalleingreso;
    $setC[5]['campo'] = 'numero';
    $setC[5]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adiciondetalleingreso ".$sql2;
}
function getSqlNewDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad, $return){
    $setC[0]['campo'] = 'iddetalleingresotalla';
    $setC[0]['dato'] = $iddetalleingresotalla;
    $setC[1]['campo'] = 'talla';
    $setC[1]['dato'] = $talla;
    $setC[2]['campo'] = 'idmodelo';
    $setC[2]['dato'] = $idmodelo;
    $setC[3]['campo'] = 'iddetalleingreso';
    $setC[3]['dato'] = $iddetalleingreso;
    $setC[4]['campo'] = 'cantidad';
    $setC[4]['dato'] = $cantidad;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adiciondetalleingresotalla ".$sql2;
}

function getSqlNewIngresoalmacen($idingreso, $numeroregistro, $boleta, $encargado, $numero, $estado, $fecha, $hora, $totalcajas, $totalpares, $totalbs, $totalsus, $montototal, $responsable, $observacion, $idmarca, $idempleado, $idalmacen, $generado, $return){
$setC[0]['campo'] = 'idingreso';
$setC[0]['dato'] = $idingreso;
$setC[1]['campo'] = 'numeroregistro';
$setC[1]['dato'] = $numeroregistro;
$setC[2]['campo'] = 'boleta';
$setC[2]['dato'] = $boleta;
$setC[3]['campo'] = 'encargado';
$setC[3]['dato'] = $encargado;
$setC[4]['campo'] = 'numero';
$setC[4]['dato'] = $numero;
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
function getSqlNewAdiciondetalleingreso($idmodelo, $totalpares, $totalbs, $idingreso, $iddetalleingreso, $color, $material, $numero, $generado,$opciont, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'totalpares';
$setC[1]['dato'] = $totalpares;
$setC[2]['campo'] = 'totalbs';
$setC[2]['dato'] = $totalbs;
$setC[3]['campo'] = 'idingreso';
$setC[3]['dato'] = $idingreso;
$setC[4]['campo'] = 'iddetalleingreso';
$setC[4]['dato'] = $iddetalleingreso;
$setC[5]['campo'] = 'color';
$setC[5]['dato'] = $color;
$setC[6]['campo'] = 'material';
$setC[6]['dato'] = $material;
$setC[7]['campo'] = 'numero';
$setC[7]['dato'] = $numero;
$setC[8]['campo'] = 'generado';
$setC[8]['dato'] = $generado;
$setC[9]['campo'] = 'opciont';
$setC[9]['dato'] = $opciont;
$sql2 = generarInsertValues($setC);
return "INSERT INTO adiciondetalleingreso ".$sql2;
}
function getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad, $tallakardex,$return){
    $setC[0]['campo'] = 'iddetalleingresotalla';
    $setC[0]['dato'] = $iddetalleingresotalla;
    $setC[1]['campo'] = 'talla';
    $setC[1]['dato'] = $talla;
    $setC[2]['campo'] = 'idmodelo';
    $setC[2]['dato'] = $idmodelo;
    $setC[3]['campo'] = 'iddetalleingreso';
    $setC[3]['dato'] = $iddetalleingreso;
    $setC[4]['campo'] = 'cantidad';
    $setC[4]['dato'] = $cantidad;
     $setC[5]['campo'] = 'tallakardex';
    $setC[5]['dato'] = $tallakardex;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adiciondetalleingresotalla ".$sql2;
}

function getSqlNewAdiciondetalleingresotmp($idmodelo, $totalpares, $totalbs, $idingreso, $iddetalleingreso, $color, $material, $numero, $generado,$opciont,$nueva, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'totalpares';
$setC[1]['dato'] = $totalpares;
$setC[2]['campo'] = 'totalbs';
$setC[2]['dato'] = $totalbs;
$setC[3]['campo'] = 'idingreso';
$setC[3]['dato'] = $idingreso;
$setC[4]['campo'] = 'iddetalleingreso';
$setC[4]['dato'] = $iddetalleingreso;
$setC[5]['campo'] = 'color';
$setC[5]['dato'] = $color;
$setC[6]['campo'] = 'material';
$setC[6]['dato'] = $material;
$setC[7]['campo'] = 'numero';
$setC[7]['dato'] = $numero;
$setC[8]['campo'] = 'generado';
$setC[8]['dato'] = $generado;
$setC[9]['campo'] = 'opciont';
$setC[9]['dato'] = $opciont;
$setC[10]['campo'] = 'nueva';
$setC[10]['dato'] = $nueva;
$sql2 = generarInsertValues($setC);
return "INSERT INTO adiciondetalleingresotmp ".$sql2;
}
function getSqlNewAdicionDetalleingresotallatmp($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad, $return){
    $setC[0]['campo'] = 'iddetalleingresotalla';
    $setC[0]['dato'] = $iddetalleingresotalla;
    $setC[1]['campo'] = 'talla';
    $setC[1]['dato'] = $talla;
    $setC[2]['campo'] = 'idmodelo';
    $setC[2]['dato'] = $idmodelo;
    $setC[3]['campo'] = 'iddetalleingreso';
    $setC[3]['dato'] = $iddetalleingreso;
    $setC[4]['campo'] = 'cantidad';
    $setC[4]['dato'] = $cantidad;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO adiciondetalleingresotallatmp ".$sql2;
}
function CargarConfirmarIngreso($callback, $_dc, $idmarca,$idestilo, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

$proveedores = ListarColoresPedido('', '', '', '', '', '',"$idmarca",true);
    if($proveedores['error'] == true)
    {
        $value['colores'] = "true";
        $value['colorM'] = $proveedores['resultado'];
    }
 $sqlmarca = "
SELECT
 SUM( dtp.totalpares ) AS totalpares
FROM
 adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE
  dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND dtp.unido='no' AND mdd.idmarca='$idmarca' AND mdd.stylename = es.idestilo AND mdd.stylename = '$idestilo'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "totalpares");
    $totalpares = $opcionA1['resultado'];
     $sqlmarca1 = "
SELECT
 SUM( dtp.totalbs * dtp.totalpares ) AS totalbs
FROM
 adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE
  dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND dtp.unido='no' AND mdd.idmarca='$idmarca' AND mdd.stylename = es.idestilo AND mdd.stylename = '$idestilo'
";
      $opcionA11 = findBySqlReturnCampoUnique($sqlmarca1, true, true, "totalbs");
    $totalbs = $opcionA11['resultado'];
    $sql ="
SELECT ma.idmarca, e.nombre AS estilo, e.idestilo,e.tipoestilo, ma.codigo, ma.nombre AS marca, ma.opcion, ma.opcionb, '$totalpares' AS totalpares, '$totalbs' AS totalbs
FROM marcas ma, estilos e
WHERE ma.idmarca = '$idmarca'
AND e.descripcion = ma.idmarca
AND e.idestilo = '$idestilo'
";

    // echo $sql;
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
function ListarDetallePedido($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }

   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, dtp.totalpares, dtp.totalbs AS precio, dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col,  estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.unido='no' ORDER BY `mdd`.`codigo` ASC,`col`.`anio`
";

    //            echo $sql;
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                 $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";

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

function ListarDetallePedidoMaterial($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //echo $opcion;WESTCOAST


   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, dtp.totalpares, dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.unido='no' ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
//AND mdd.stylename = '$idestilo' ORDER BY `col`.`anio` , `mdd`.`codigo` DESC

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

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
//LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla

$sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";
//$sqld = "
//SELECT ta.talla, 0 AS cantidad
//FROM tallasdetalle ta
//LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
//AND ad.iddetalleingreso = '$iddetalleingreso'
//WHERE ta.idmodelo = '$opcion'
//    ";

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

function ListarDetallePedidoLineaModeloColor($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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

 $sqlmarca = "
SELECT
  mar.talla,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
         $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";

    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
   if($opcionb=="3"){
$sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea,dtp.opciont,dtp.totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.unido='no' ORDER BY l.codigo ASC,CAST( `mdd`.`codigo` AS SIGNED) ASC
";
   }else{
   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea,dtp.totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.unido='no' ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
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
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
//    SELECT 'bs1'  AS talla,IFNULL(SUM(bs),0) AS cantidad
//FROM depositoefectivoventa
//WHERE fecha = '$fechacobro' AND idtienda='$idtienda1'
//UNION ALL
//                                $sqld = "
////SELECT ta.talla, IFNULL(ad.cantidad,0) As cantidad
////FROM tallasdetalle ta
////STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
////AND ad.iddetalleingreso = '$iddetalleingreso'
////
////     ";
                                $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";


                                //                                 $value{$ii}{mysql_field_name($re, $i)}= '222';

                                  //                            echo   $sqld;
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
function ListarDetallePedidoMaterialColor($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $return = false){

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

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }

$sql ="
SELECT dtp.iddetalleingreso, mdd.codigo AS codigo, dtp.totalpares, dtp.totalbs AS precio, dtp.material, dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.unido='no' ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
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

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
    $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";


                                        //                      echo   $sqld;
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

function ListarDetalleIngreso($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$codigo,$where = '',$opcionb,$formatomayor, $return = false){
$idalmacen = $_SESSION['idalmacen'];
    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 300;
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
//
//AND mdd.stylename = '$idestilo'
if($codigo == 'KARDEX'){$generado = "1";}
if($codigo == 'SIN_CODIGO'){$generado = "0";}
$sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "33-42"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }

//ORDER BY `col`.`anio` , `mdd`.`codigo` DESC

     if($where == null || $where == "")
    {   if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql="SELECT CONCAT( c.detalle, '-', mdd.codigo) AS codigo,k.idkardex,mdd.idmodelo,mdd.color,mdd.material,mdd.cliente,mdd.precioventa AS precio,
mdd.preciounitario, SUM(karp.saldocantidad) AS totalpares, SUM(karp.saldocantidad) AS totalparescaja,k.saldocantidad AS totalcajas, SUM(karp.preciounitario*karp.saldocantidad) As totalparesbs
FROM `modelo` mdd,kardexdetallepar karp,coleccion c,kardexcajas k
WHERE mdd.idmodelo=k.idmodelo and mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo
AND mdd.idmarca = '$idmarca'  and mdd.idalmacen='$idalmacen' GROUP by k.idkardex
ORDER BY c.detalle,mdd.codigo desc,mdd.color asc,mdd.material asc
";
            
}else{
$sql="SELECT mdd.codigo,karp.idkardex,mdd.idmodelo,mdd.color,mdd.material,CONCAT(em.nombres,'/',mdd.cliente)AS cliente,mdd.precioventa AS precio,
mdd.preciounitario, SUM(karp.saldocantidad) AS totalpares,SUM(karp.saldocantidad) AS totalparescaja,ROUND((SUM(karp.saldocantidad)/12),2) AS totalcajas, SUM(karp.preciounitario*karp.saldocantidad) As totalparesbs
FROM `modelo` mdd,kardexdetallepar karp,empleados em
WHERE karp.idmodelo = mdd.idmodelo and mdd.idvendedor=em.idempleado
AND mdd.idmarca = '$idmarca'  and mdd.idalmacen='$idalmacen' GROUP by karp.idmodelo
ORDER BY mdd.idvendedor,mdd.codigo desc,mdd.color asc,mdd.material asc
";
}
    }

    else
    {
        if($formatomayor=="1"){//ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC,, CAST(mdd.codigo as signed) ASC
    $sql="SELECT CONCAT( c.detalle, '-', mdd.codigo) AS codigo,k.idkardex,mdd.idmodelo,mdd.color,mdd.material,mdd.cliente,mdd.precioventa AS precio,
mdd.preciounitario, SUM(karp.saldocantidad) AS totalpares, SUM(karp.saldocantidad) AS totalparescaja,k.saldocantidad AS totalcajas, SUM(karp.preciounitario*karp.saldocantidad) As totalparesbs
FROM `modelo` mdd,kardexdetallepar karp,coleccion c,kardexcajas k,ingresoalmacen i
WHERE mdd.idingreso=i.idingreso and mdd.idmodelo=k.idmodelo and mdd.idcoleccion=c.idcoleccion and karp.idmodelo = mdd.idmodelo
AND mdd.idmarca = '$idmarca'  and mdd.idalmacen='$idalmacen' and $where GROUP by k.idkardex
ORDER BY c.detalle,mdd.codigo desc,mdd.color asc,mdd.material asc
";
            //AND $where
}else{

    $sql="SELECT mdd.codigo,karp.idkardex,mdd.idmodelo,mdd.color,mdd.material,mdd.cliente,mdd.precioventa AS precio,
mdd.preciounitario, SUM(karp.saldocantidad) AS totalpares,SUM(karp.saldocantidad) AS totalparescaja,'1' AS totalcajas, SUM(karp.preciounitario*karp.saldocantidad) As totalparesbs
FROM `modelo` mdd,kardexdetallepar karp,ingresoalmacen i
WHERE   mdd.idingreso=i.idingreso and karp.idmodelo = mdd.idmodelo
AND mdd.idmarca = '$idmarca' and mdd.idalmacen='$idalmacen' and $where GROUP by karp.idmodelo
ORDER BY mdd.codigo desc,mdd.color asc,mdd.material asc
";
             //AND $where
}
    }


    //        MostrarConsulta($sql);
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

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "idmodelo"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];

  if($opcion=="1"){
    $sqlmarca = " SELECT talla FROM modelo WHERE idmodelo = '$fi[$i]' ";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
$sqld = "  SELECT ta.idtalla AS tallakardex, SUM(ad.saldocantidad) as cantidad
FROM tallasdetallem ta
STRAIGHT_JOIN kardexdetallepar ad ON ta.tallakardex = ad.talla
AND ad.idmodelo = '$fi[$i]' GROUP BY ad.tallakardex
UNION ALL
SELECT ta.idtalla AS tallakardex, 0 AS cantidad
FROM tallasdetallem ta
LEFT OUTER JOIN kardexdetallepar ad ON ta.tallakardex = ad.talla
AND ad.idmodelo = '$fi[$i]'
WHERE  ad.cantidad IS NULL
";
}else{
      $sqld = "SELECT
                                dtpt.talla as tallakardex,
                                SUM(dtpt.saldocantidad) as cantidad
                                FROM
                               `kardexdetallepar` dtpt
                                WHERE
                                dtpt.idmodelo = '$iddetalleingreso' group by dtpt.talla
                                ";
}
//echo $sqld;
//                                  $sqld = "SELECT
//                                dtpt.tallakardex,
//                                dtpt.cantidad
//                                FROM
//                               `kardexdetalle` dtpt
//                                WHERE
//                                dtpt.idkardex = '$iddetalleingreso'
//                                ";

                                //                                 $value{$ii}{mysql_field_name($re, $i)}= '222';

                                          //                   echo   $sqld;
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
function ListarDetalleIngresoTalla($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$where = '', $modelocodigo,$return = false){
   $idalmacen=$_SESSION['idalmacen'];
   if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 300;
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
if($codigo == 'KARDEX'){$generado = "1";}
if($codigo == 'SIN_CODIGO'){$generado = "0";}
 $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb,mar.formatomayor
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
 //ORDER BY `col`.`anio` , `mdd`.`codigo` DESC
     if($where == null || $where == "")
    {  if($formatomayor=="1"){
             $sql = "
SELECT kar.idkardexdetalle, kar.idkardexunico, kar.saldocantidad AS cantidad, kar.talla AS tallakardex, kar.preciounitario, kar.codigobarra,
CONCAT( c.detalle, '-', mdd.codigo) AS modelo,mdd.material ,mdd.color, kar.talla as tallakardex
FROM kardexdetallepar kar, modelo mdd,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and kar.idmodelo=mdd.idmodelo and mdd.idalmacen='$idalmacen' and mdd.idmarca = '$idmarca' ORDER BY mdd.codigo desc,c.anio,mdd.color asc,mdd.material asc";
   
             }else{
               $sql = "
SELECT kar.idkardexdetalle, kar.idkardexunico, kar.saldocantidad AS cantidad, kar.talla AS tallakardex, kar.preciounitario, kar.codigobarra,
 mdd.codigo AS modelo,mdd.material ,mdd.color, kar.talla as tallakardex
FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and mdd.idmarca = '$idmarca' and mdd.idalmacen='$idalmacen' ORDER BY mdd.codigo desc,mdd.color asc,mdd.material asc";
      
             }
     
    }
    else
    
    {//"iddetalleingreso", "idmodelo", "iddetalleingresotalla","modelo","detalle", "precio", "talla", "cantidad",codigobarra
     if($formatomayor=="1"){

     $planillaanterior= split("-",$modelocodigo);
$colecc=$planillaanterior[0];
$codigo=$planillaanterior[1];
             $sql = "
SELECT kar.idkardexdetalle, kar.idkardexunico, kar.saldocantidad AS cantidad, kar.talla AS tallakardex, kar.preciounitario, kar.codigobarra,
CONCAT( c.detalle, '-', mdd.codigo) AS modelo,mdd.material ,mdd.color, kar.talla as tallakardex
FROM kardexdetallepar kar, modelo mdd,coleccion c
WHERE mdd.idcoleccion=c.idcoleccion and kar.idmodelo=mdd.idmodelo and mdd.idalmacen='$idalmacen' and mdd.idmarca = '$idmarca' and mdd.codigo='$codigo' ORDER BY mdd.codigo desc,c.anio,mdd.color asc,mdd.material asc";

             }else{
               $sql = "
SELECT kar.idkardexdetalle, kar.idkardexunico, kar.saldocantidad AS cantidad, kar.talla AS tallakardex, kar.preciounitario, kar.codigobarra,
 mdd.codigo AS modelo,mdd.material ,mdd.color, kar.talla as tallakardex
FROM kardexdetallepar kar, modelo mdd
WHERE kar.idmodelo=mdd.idmodelo and mdd.idmarca = '$idmarca' and mdd.idalmacen='$idalmacen' and mdd.codigo='$modelocodigo' ORDER BY mdd.codigo desc,mdd.color asc,mdd.material asc";

             }
  
    }
    ///echo $sql;
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                             
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
function Registrarcodigo($productos,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
     $estado='validado';
    // echo $productos;
    $idmarca = '';
 $numeroD = findUltimoID("numeracionimpresion", "numero", true);
    $numeroimpresion = $numeroD['resultado'] +1;
     $idimpresion = "imp-".$numeroimpresion;
    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $iddetalleingreso = $producto->idmodelo;
   $sql1= "SELECT
             idmarca
            FROM
              modelo
            WHERE
              idmodelo = '$iddetalleingreso'";
        //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];
    $nuevogenerado = "1";
    $sql[] = "UPDATE modelo SET generado ='$nuevogenerado' WHERE idmodelo = '$iddetalleingreso';";
    $sql[] = "UPDATE kardexcajas SET generado ='$nuevogenerado',idimpresion ='$idimpresion' WHERE idmodelo = '$iddetalleingreso';";

    }

$sql[]=getSqlNewNumeracionimpresion($idnumeracion, $idimpresion, $numeroimpresion,$idmarca, false);
     //   MostrarConsulta($sql);


       if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se valido correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idimpresion";
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
function Registrarcodigoporparbarra($productos,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
     $estado='validado';
    // echo $productos;
    $idmarca = '';
 $numeroD = findUltimoID("numeracionimpresion", "numero", true);
    $idnumeracion = $numeroD['resultado'] +1;
    $idnumeracionimpresion = "imp-".$idnumeracion;
    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $iddetalleingreso = $producto->idmodelo;
        $idkardex = $producto->idkardex;
  $sql1= "SELECT idmarca FROM modelo WHERE idmodelo = '$iddetalleingreso' ";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];
   $nuevogenerado = "1";
//ojo david
     $sql[] = "UPDATE kardexdetallepar SET idimpresion ='$idnumeracion' WHERE idmodelo = '$iddetalleingreso' ;";
//     $sql[] = "UPDATE kardexdetallepar SET idimpresion ='$idnumeracion' WHERE idmodelo = '$iddetalleingreso' and idkardex='$idkardex';";

$sql[] = "UPDATE kardexcajas SET generado ='1',idimpresion ='$idnumeracion' WHERE idmodelo = '$iddetalleingreso' and idkardex='$idkardex';";

    }

$sql[]=getSqlNewNumeracionimpresion($idnumeracion, $idnumeracionimpresion, $idnumeracion,$idmarca, false);
     //   MostrarConsulta($sql);
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

function Registrarcodigounion($productos,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
     $estado='validado';
    // echo $productos;
     $sql1= "SELECT MAX(numero) AS num FROM unionmodelo";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $idnumeracion = $result['resultado'];
    $idnumeracionimpresion = $idnumeracion+1;
// $numeroD = findUltimoID("unionmodelo", "numero", true);
//    $idnumeracion = $numeroD['resultado'] +1;
//    $idnumeracionimpresion = $idnumeracion;
 
    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $idmodelo = $producto->idmodelo;
       // $idkardex = $producto->idkardex;
  $sql1= "SELECT idmarca FROM modelo WHERE idmodelo = '$idmodelo' ";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];
   $nuevogenerado = "1";
//UPDATE `adminmayor`.`modelo` SET `union` = '1' WHERE CONVERT( `modelo`.`idmodelo` USING utf8 ) = 'm-41439' LIMIT 1
     $sql[] = "UPDATE modelo SET unidomodelo = '$idnumeracionimpresion' WHERE idmodelo = '$idmodelo' ;";

    }
  $sql[]=getSqlNewUnionmodelo($idnumeracions, $idmodelo, $idnumeracionimpresion, $idmodelo, false);

//$sql[]=getSqlNewNumeracionimpresion($idnumeracion, $idnumeracionimpresion, $idnumeracion,$idmarca, false);
 //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se valido correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "$idnumeracionimpresion";
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

function Registrarunionmodelos($resultado,$return){
    set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $itemunion= $resultado->itemunion;
 $sql2 = "SELECT * FROM unionmodelo
WHERE  numero= '$itemunion'";
$result1 = findBySqlReturnCampoUnique($sql2, true, true, "idmodelounido");
    $idmodelonuevo = $result1['resultado'];

$sql ="
SELECT idmodelo
FROM modelo
WHERE unidomodelo='$itemunion'
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
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "idmodelo";
                                $idmodelo = $fi[$i];
         descontarcobrosaplanilla($idmodelo,$idmodelonuevo, false);

                        }
                    
                              }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $mesplanilla;

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
                    $dev['resultado'] = $mesplanilla;
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


}


function descontarcobrosaplanilla($idmodelo,$idmodelonuevo,$return = false ){
 set_time_limit(0);
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");


 $sqlA[] = "UPDATE kardexdetallepar SET idmodelo='$idmodelonuevo' WHERE idmodelo ='$idmodelo' and idmodelo!='$idmodelonuevo';";

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);
//   if($return == true)
//    {
//        return $sqlA;
//    }
//    else
//    {
//        if(ejecutarConsultaSQLBeginCommit($sqlA))
//        {
//            $dev['mensaje'] = "Se guardo una transaccion correctamente";
//            $dev['error'] = "true";
//            $dev['resultado'] = "$idplanillaemitida";
//        }
//        else
//        {
//            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
//            $dev['error'] = "false";
//            $dev['resultado'] = "$idplanillaemitida";
//        }
//    }
}

function getSqlNewNumeracionimpresion($idnumeracion, $idnumeracionimpresion, $numero, $idmarca,$return){

$setC[0]['campo'] = 'idnumeracion';
$setC[0]['dato'] = $idnumeracion;
$setC[1]['campo'] = 'idnumeracionimpresion';
$setC[1]['dato'] = $idnumeracionimpresion;
$setC[2]['campo'] = 'numero';
$setC[2]['dato'] = $numero;
$setC[3]['campo'] = 'idmarca';
$setC[3]['dato'] = $idmarca;
$sql2 = generarInsertValues($setC);
return "INSERT INTO numeracionimpresion ".$sql2;
}


function Eliminardetalle($idmodelodetalle,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
     $sqlmarca = "SELECT * FROM kardexcajas k WHERE idmodelo = '$idmodelodetalle'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
   $idkardex = $opcionA['resultado'];
  $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idoperacion");
   $idingreso = $opcionA1['resultado'];
     $sqlmarca = "SELECT * FROM modelo k WHERE idmodelo = '$idmodelodetalle'";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmodelodetalle");
   $idmodelodetalledd = $opcionA1['resultado'];
    $sql1 = "SELECT
  COUNT(it.cantidad)AS existe
FROM
  `itemventa` it
WHERE
  it.idcalzado = '$iddetallepedido' 
";
     $saldocantidadA = findBySqlReturnCampoUnique($sql1, true, true, "existe");
    $generado = $saldocantidadA['resultado'];
   // $idmarcaA = verificarValidarText($idmarca, true, "modelos", "idmarca");
    //echo $generado;
   if($generado > "0"){
        $dev['mensaje'] = "No puede eliminar este Item,existe una venta relacionada";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
else{
    //$sql[] = getSqlDeleteAdiciondetalleingreso($iddetallepedido);
    $sql[] = deletekardexcajas($idkardex,$idmodelodetalle);
    $sql[] = deletekardexdetalle($idkardex,$idmodelodetalle);
    $sql[] = deletekardexdetalleingreso($idkardex,$idmodelodetalle);
    $sql[] = deletemodelo($idmodelodetalle,$idmodelodetalledd);
    $sql[] = deletemodelodetalle($idmodelodetalle,$idingreso);

}
//    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar una Marca";
        $dev['error'] = "false";
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


function getSqlDeleteAdiciondetalleingreso($idadiciondetalleingreso){
return "DELETE FROM ingresoalmacen WHERE idingreso ='$idadiciondetalleingreso';";
}

function deletekardexcajas($idkardex,$idmodelodetalle){
return "DELETE FROM kardexcajas WHERE idkardex ='$idkardex' AND idmodelo ='$idmodelodetalle';";
}
function deletekardexdetalle($idkardex,$idmodelodetalle){
return "DELETE FROM kardexdetalle WHERE idkardex ='$idkardex' AND idmodelo ='$idmodelodetalle';";
}
function deletekardexdetalleingreso($idkardex,$idmodelodetalle){
return "DELETE FROM kardexdetalleingreso WHERE idkardex ='$idkardex' AND idmodelo ='$idmodelodetalle';";
}
function deletemodelo($idmodelodetalle,$idmdelodetalledd){
return "DELETE FROM modelo WHERE idmodelo ='$idmodelodetalle' AND idmodelodetalle ='$idmdelodetalledd';";
}
function deletemodelodetalle($idmodelo,$idingreso){
return "DELETE FROM modelodetalle WHERE idmodelo ='$idmodelo' AND idingreso ='$idingreso';";
}
function ListarMarcaDetalle($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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

    if($where == null || $where == "")
    {
        $sql ="
SELECT
  mad.idmarcadetalle AS idmarca,
  mad.codigo,
  mad.nombre,
  mad.codigobarra,
  mad.imagen,
  mad.talla,
  mad.idciudad,
  mad.numero,
  ciu.nombre AS ciudad
FROM
  `marcadetalle` mad,
  `ciudades` ciu
WHERE
  mad.idciudad = ciu.idciudad $order LIMIT $start,$limit

";
    }else{
        $sql ="
SELECT
  mad.idmarcadetalle,
  mad.codigo,
  mad.nombre,
  mad.codigobarra,
  mad.imagen,
  mad.talla,
  mad.idciudad,
  mad.numero,
  ciu.nombre AS ciudad
FROM
  `marcadetalle` mad,
  `ciudades` ciu
WHERE
  mad.idciudad = ciu.idciudad AND $where $order LIMIT $start,$limit

";
    }
    //            echo $sql;
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
function ListarModeloDetalle($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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

    if($where == null || $where == "")
    {
        $sql ="
SELECT
  mad.nombre AS marca,
  mdt.idmodelodetalle AS idmodelo,
  mdt.codigo,
  mdt.stylename,
  mdt.detalle,
  mdt.imagen,
  mdt.precio1,
  mdt.precio2,
  mdt.precio3

FROM
  marcadetalle mad,
  modelodetalle mdt
WHERE
  mad.idmarcadetalle = mdt.idmarcadetalle $order LIMIT $start,$limit

";
    }else{
        $sql ="
SELECT
  mad.nombre AS marca,
  mdt.idmodelodetalle AS idmodelo,
  mdt.codigo,
  mdt.stylename,
  mdt.detalle,
  mdt.imagen,
  mdt.precio1,
  mdt.precio2,
  mdt.precio3
FROM
  marcadetalle mad,
  modelodetalle mdt
WHERE
  mad.idmarcadetalle = mdt.idmarcadetalle AND mad.idmarcadetalle ='$where' $order LIMIT $start,$limit

";
    }
//                echo $sql;
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
function BuscarModeloDetalleporId($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "
SELECT
  md.idmodelodetalle,
  md.idmarcadetalle,
  md.codigo,
  md.stylename,
  md.color,
  md.material,
  md.detalle,
  md.imagen,
  md.numero,
  md.precio1,
  md.precio2,
  md.precio3
FROM
  modelodetalle md
WHERE
  md.idmodelodetalle = '$codigo';
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
//agregar codbarra
function txNewIngresoCodigoBarra($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    $idestilo = $ingreso->idestilo;

    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idtienda = $_SESSION['idtienda'];
  
    $calzados = $resultado->calzados;
      for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];

        $iddetalleingreso = $calzado->iddetalleingreso;
        $iddetalleingresotalla = $calzado->iddetalleingresotalla;

         $idmodelo = $calzado->idmodelo;
        $precio = $calzado->precio;

        $cantidad = $calzado->cantidad;
           $codigobarra = $calzado->codigobarra;

        $fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
 $idtienda='tie-2';

$sql1 = "SELECT
  it.saldocantidad,it.idkardextienda
FROM
  `adicionkardextienda` it
WHERE
  it.codigobarra = '$codigobarra' AND it.idtienda='$idtienda' AND it.idcalzado='$iddetalleingreso' AND it.idmodelodetalle='$idmodelo'
";
   // echo $sql1;
     $saldocantidadA = findBySqlReturnCampoUnique($sql1, true, true, "saldocantidad");
    $saldoc = $saldocantidadA['resultado'];
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql1, true, true, "idkardextienda");
    $idkardextienda = $saldocantidadA1['resultado'];

       $saldoActual = $cantidad;
     //   $saldoActualBs = $saldobs  + $ingreso;
      //  $idmovimientokardex = $res1['idmovimientokardextienda'];
   // }

    $sql[]="UPDATE adicionkardextienda SET saldocantidad = '$saldoActual' ,cantidad= '$saldoc' WHERE idkardextienda='$idkardextienda' AND idtienda = '$idtienda';";
    $sql[]="UPDATE adiciondetalleingresotalla SET cantidad = '$saldoActual' WHERE iddetalleingresotalla='$iddetalleingresotalla' AND iddetalleingreso = '$iddetalleingreso';";

  // $sqlA[]="UPDATE movimientokardextienda SET saldocantidad = '$saldoActual' WHERE idmovimientokardextienda = '$idmovimientokardex' AND idkardextienda = '$idkardextienda' AND idtienda = '$idtienda'";
 
                }
//  MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = $idkardextienda;
    }
    else
    {
        $dev['mensaje'] = "No existen cambios para guardar";
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
function txNewIngresoCodigoBarraNuevo($resultado,$return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    $idestilo = $ingreso->idestilo;

    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idtienda = $_SESSION['idtienda'];
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
 $idtienda='tie-2';

 $sqlmarca = "
SELECT
  mar.opcion,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

    $calzados = $resultado->calzados;
     $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
    $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;

      for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];

        $iddetalleingreso = $calzado->iddetalleingreso;
       // $iddetalleingresotalla = $calzado->iddetalleingresotalla;

         $idmodelo = $calzado->idmodelo;
        $precio = $calzado->precio;
$tallad = $calzado->talla;
        $cantidad = $calzado->cantidad;
        //   $codigobarra = $calzado->codigobarra;
      $sqlmarca = "
SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelo' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idcoleccion");
    $idcoleccion = $opcionA1['resultado'];
//lol
        $codigobarraA = ObtenerCodigoBarraMarcaDetalleAdicion($idmarca ,$idcoleccion, true);
       // $codigobarraA = ObtenerCodigoBarraMarcaDetalle($idmarca , true);

       $codigobarramcn = $codigobarraA['resultado'];
        if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){
                $precio = $calzado->precio;
                $cantidad = $calzado->cantidad;

                if($cantidad !=0){

                    $talla = $tallad;
                  if($talla == '1'){$talla2 ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '02'){$talla2 ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '03'){$talla2 ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '04'){$talla2 ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '05'){$talla2 ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '06'){$talla2 ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '07'){$talla2 ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '08'){$talla2 ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '09'){$talla2 ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla2 ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla2 ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla2 ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla2 ='13'; $tallamm ='13';$tallammm ='13';}
                  if($talla == '01'|| $talla =='1m' || $talla =='1M'){$talla2 ='01'; $tallamm ='1m';$tallammm ='01';}
                  if($talla == '20' || $talla =='2m' || $talla =='2M'){$talla2 ='20'; $tallamm ='2';$tallammm ='20';}
                  if($talla == '30' || $talla =='3m' || $talla =='3M'){$talla2 ='30'; $tallamm ='3m';$tallammm ='30';}
                  if($talla == '40' || $talla =='4m' || $talla =='4M'){$talla2 ='40'; $tallamm ='4m';$tallammm ='40';}
                  if($talla == '50' || $talla =='5m' || $talla =='5M'){$talla2 ='50'; $tallamm ='5m';$tallammm ='50';}
                  if($talla == '60' || $talla =='6m' || $talla =='6M'){$talla2 ='60'; $tallamm ='6m';$tallammm ='60';}
                  if($talla == '70' || $talla =='7m' || $talla =='7M'){$talla2 ='70'; $tallamm ='7m';$tallammm ='70';}
                  if($talla == '80' || $talla =='8m' || $talla =='8M'){$talla2 ='80'; $tallamm ='8m';$tallammm ='80';}
                  if($talla == '90' || $talla =='9m' || $talla =='9M'){$talla2 ='90'; $tallamm ='9m';$tallammm ='90';}
                  if($talla == '100' || $talla =='10m' || $talla =='10M'){$talla2 ='15'; $tallamm ='10m';$tallammm ='100';}
                  if($talla == '110' || $talla =='11m' || $talla =='11M'){$talla2 ='16'; $tallamm ='11m';$tallammm ='110';}
                  if($talla == '120' || $talla =='12m' || $talla =='12M'){$talla2 ='17'; $tallamm ='12m';$tallammm ='120';}
                  if($talla == '130' || $talla =='13m' || $talla =='13M'){$talla2 ='18'; $tallamm ='13m';$tallammm ='130';}

              
                  $tallafin = $talla2;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
$sqlmarca = "
SELECT
precio1bs,precio3bs,precio1sus,precio2sus,precio3sus,idoperacion
FROM
 adicionkardextienda
WHERE
  idcalzado = '$iddetalleingreso' AND idmodelodetalle='$idmodelo' Group By idoperacion
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio1bs");
    $material = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio3bs");
    $color = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio1sus");
    $precio1sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio2sus");
    $precio2sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio3sus");
    $precio3sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idoperacion");
    $idingreso = $opcionA['resultado'];
    
//echo $sqlmarca;
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelo, $iddetalleingreso, $cantidad,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad, $cantidad, $numerokardex, $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingreso, $idingreso, $codigobarraean13,$generado,false);
                $numerokardex++;
           
                }
              
            

        }
        else{

  if($cantidad !=0){

                    $talla = $tallad;
//                  if($talla == '1'){$talla2 ='91'; $tallamm ='1';$tallammm ='1';}
//                  if($talla == '2'){$talla2 ='02'; $tallamm ='2';$tallammm ='02';}
//                  if($talla == '3'){$talla2 ='03'; $tallamm ='3';$tallammm ='03';}
//                  if($talla == '4'){$talla2 ='04'; $tallamm ='4';$tallammm ='04';}
//                  if($talla == '5'){$talla2 ='05'; $tallamm ='5';$tallammm ='05';}
//                  if($talla == '6'){$talla2 ='06'; $tallamm ='6';$tallammm ='06';}
//                  if($talla == '7'){$talla2 ='07'; $tallamm ='7';$tallammm ='07';}
//                  if($talla == '8'){$talla2 ='08'; $tallamm ='8';$tallammm ='08';}
//                  if($talla == '9'){$talla2 ='09'; $tallamm ='9';$tallammm ='09';}
//                  if($talla == '10'){$talla2 ='10'; $tallamm ='10';$tallammm ='10';}
//                  if($talla == '11'){$talla2 ='11'; $tallamm ='11';$tallammm ='11';}
//                  if($talla == '12'){$talla2 ='12'; $tallamm ='12';$tallammm ='12';}
//                  if($talla == '13'){$talla2 ='13'; $tallamm ='13';$tallammm ='13';}
//                  if($talla == '14'|| $talla =='1m' || $talla =='1M'){$talla2 ='01'; $tallamm ='1m';$tallammm ='01';}
//                  if($talla == '' || $talla =='2m' || $talla =='2M'){$talla2 ='20'; $tallamm ='2';$tallammm ='20';}
//                  if($talla == '30' || $talla =='3m' || $talla =='3M'){$talla2 ='30'; $tallamm ='3m';$tallammm ='30';}
//                  if($talla == '40' || $talla =='4m' || $talla =='4M'){$talla2 ='40'; $tallamm ='4m';$tallammm ='40';}
//                  if($talla == '50' || $talla =='5m' || $talla =='5M'){$talla2 ='50'; $tallamm ='5m';$tallammm ='50';}
//                  if($talla == '60' || $talla =='6m' || $talla =='6M'){$talla2 ='60'; $tallamm ='6m';$tallammm ='60';}
//                  if($talla == '70' || $talla =='7m' || $talla =='7M'){$talla2 ='70'; $tallamm ='7m';$tallammm ='70';}
//                  if($talla == '80' || $talla =='8m' || $talla =='8M'){$talla2 ='80'; $tallamm ='8m';$tallammm ='80';}
//                  if($talla == '90' || $talla =='9m' || $talla =='9M'){$talla2 ='90'; $tallamm ='9m';$tallammm ='90';}
//                  if($talla == '100' || $talla =='10m' || $talla =='10M'){$talla2 ='15'; $tallamm ='10m';$tallammm ='100';}
//                  if($talla == '110' || $talla =='11m' || $talla =='11M'){$talla2 ='16'; $tallamm ='11m';$tallammm ='110';}
//                  if($talla == '120' || $talla =='12m' || $talla =='12M'){$talla2 ='17'; $tallamm ='12m';$tallammm ='120';}
//                  if($talla == '130' || $talla =='13m' || $talla =='13M'){$talla2 ='18'; $tallamm ='13m';$tallammm ='130';}
$tallafin = $talla;
                  $tallafinal = $talla;
                  $tallafinal1 = $talla;
$sqlmarca = "
SELECT
precio1bs,precio3bs,precio1sus,precio2sus,precio3sus,idoperacion
FROM
 adicionkardextienda
WHERE
  idcalzado = '$iddetalleingreso' AND idmodelodetalle='$idmodelo' Group By idoperacion
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio1bs");
    $material = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio3bs");
    $color = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio1sus");
    $precio1sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio2sus");
    $precio2sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio3sus");
    $precio3sus = $opcionA['resultado'];
     $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idoperacion");
    $idingreso = $opcionA['resultado'];
                  

                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelo, $iddetalleingreso, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelo, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $material, $precio, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingreso, $idingreso, $codigobarraean13,$generado,false);
                $numerokardex++;

                }
        }
//   lol
                }
// MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = $idkardextienda;
    }
    else
    {
        $dev['mensaje'] = "No existen cambios para guardar";
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

//editar
function txNewUpdateDatosDetalleIngreso($resultado,$return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

 $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;

    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idtienda = $_SESSION['idtienda'];
      $idtienda ='tie-2';
    $sqlmarca = " SELECT mar.opcion,mar.opcionb,mar.pedido FROM marcas mar WHERE mar.idmarca = '$idmarca' ";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];

$calzados = $resultado->calzados;
 $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
     $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;
$calzados = $resultado->calzados;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $iddetalleingreso = $calzado->iddetalleingreso;
         $iddetalleingresonuevo = $calzado->iddetalleingreso;
      //  echo $codigocalzado;
        $codigo = $calzado->codigo;
        $colornuevo = $calzado->color;
        $materialnuevo = $calzado->material;
        $precionuevo = $calzado->precio;
        $precio  = $calzado->precio;
        $lineanuevo = $calzado->linea;
        $numeroparesnuevo = $calzado->totalpares;
        $numerocajasnuevo = $calzado->totalcajas;
        $stylenamenuevo = $calzado->stylename;
 $coleccion = $calzado->coleccion;
 $opciont = $calzado->opciont;
$sql1= "SELECT
             iddetalleingreso,color,material,totalpares,totalbs,idmodelo,idingreso,generado
            FROM
              adiciondetalleingreso
            WHERE
              iddetalleingreso = '$iddetalleingreso'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "iddetalleingreso");
  $iddetalleingreso = $result1['resultado'];
  $result2 = findBySqlReturnCampoUnique($sql1, true, true, "color");
  $color = $result2['resultado'];
  $result3 = findBySqlReturnCampoUnique($sql1, true, true, "material");
  $material = $result3['resultado'];
  $opcionA = findBySqlReturnCampoUnique($sql1, true, true, "idmodelo");
   $idmodelodetalle = $opcionA['resultado'];
  $opcionA1 = findBySqlReturnCampoUnique($sql1, true, true, "idingreso");
   $idoperacion = $opcionA1['resultado'];
 //  echo $sql1;
   $sql1= "SELECT codigo,idcoleccion FROM modelos WHERE idmodelo='$idmodelodetalle' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "codigo");
  $modeloanterior = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcoleccion");
  $idcoleccion = $result1['resultado'];
$sql1= "SELECT codigo FROM coleccion WHERE idcoleccion='$idcoleccion' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "codigo");
  $idcoleccionant = $result1['resultado']; 
    //    $sql[] = getSqlDeleteLinea_marca($idmarca);
    if($colornuevo==null || $colornuevo=='' ){$tipo ="1"; }
    if($materialnuevo==null || $materialnuevo=='' ){$tipo ="2"; }
    if($coleccion==null || $coleccion=='' ){$tipo ="3"; }
//    echo $opcionpedido;
if($opcionpedido=="CODIGO"){
   $busqueda = "1";
   if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}

}
if($opcionpedido=="CODIGO-COLOR"){
   $busqueda = "2";
   if($colornuevo==null || $colornuevo==''){
       if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
   }else{
   if(($codigo ==$modeloanterior)&&($colornuevo==$color))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
   }
}
if($opcionpedido=="CODIGO-COLOR-MATERIAL"){
     if($materialnuevo==null || $materialnuevo=='' ){
           if($codigo ==$modeloanterior)
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
       }else{
   if(($codigo ==$modeloanterior)&&($colornuevo==$color)&&($materialnuevo==$material))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
       }
}
if($opcionpedido=="CODIGO-COLOR-STYLENAME"){
  if(($codigo ==$modeloanterior)&&($colornuevo==$color)&&($materialnuevo==$material))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}

}
if($opcionpedido=="LINEA-CODIGO-COLOR"){
   if(($codigo ==$modeloanterior)&&($colornuevo==$color))
   {$verificaopcion="existe";}else{$verificaopcion="noexiste";}
  
}

if($verificaopcion=="existe"){
// echo "esta";
//if($colornuevo==$color && $materialnuevo==$material && $codigo ==$modeloanterior && $coleccion==$idcoleccionant){
 if($materialnuevo==null ||$materialnuevo==''){$materialnuevo="-";}
      if($colornuevo==null ||$colornuevo==''){$colornuevo="-";}
      if($opciont==null || $opciont == ""){$opciontalla="0";}else{$opciontalla=$opciont;}
   $sql[] = "UPDATE adiciondetalleingreso SET totalpares='$numeroparesnuevo',totalbs='$precionuevo',opciont='$opciontalla' WHERE iddetalleingreso = '$iddetalleingreso'; ";
     $sql[] = "UPDATE adicionkardextienda SET precio2bs='$precionuevo' WHERE idcalzado = '$iddetalleingreso'; ";

      $codigobarraA = ObtenerCodigoBarraMarcaDetalleAdicion($idmarca ,$idcoleccion, true);
       $codigobarramcn = $codigobarraA['resultado'];
         if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){
         
            for($i=1;$i<=14;$i++){
                 $precio = $calzado->precio;
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;
               // echo $cantidad1;
                if($cantidad1 >=0){
                   
                    $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                   if($talla == '14'){$talla ='14'; $tallamm ='14';$tallammm ='14';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
$sql3 =" SELECT COUNT(idkardextienda) AS num FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
$result1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
  $paresrepetidos = $result1['resultado'];

  if($paresrepetidos > '1'){
              borrarrepetidos($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafinal,$tallafinal1,false);
$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
 //echo "hay repetido";
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
 $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{

           actualizarsoloparesmvalores($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
  }else{
   //  echo "no hay repetido";
    $sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
//  echo $sql3;
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
 $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{
     //      echo "ya existe el par";
           actualizarsoloparesmvalores($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }

  }
//  ss

                }else{
      //               echo "entr";
                
  $cantidad1 = $calzado->$i;
     //         echo $cantidad1;
          $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                      if($talla == '14'){$talla ='14'; $tallamm ='14';$tallammm ='14';}
                         // if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
 actualizarsoloparesnulossinm($tallafinal,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,false);
               }

              //  para tallas m numeros;
                if($cantidadm >=0){
                    $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                 if ($tallam =='14m'){$talla2= "19";$tallan = "140";}
                $talla1 = $tallan;
                $tallafin = $tallam;
                  $tallafinal = $talla2;
                  $tallafinal1 = $tallan;

                $precio = $calzado->precio;
             //$sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
//$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1') ";
$sql3 =" SELECT COUNT(idkardextienda) AS num FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1') ";
$result1 = findBySqlReturnCampoUnique($sql3, true, true, "num");
  $paresrepetidos = $result1['resultado'];
  if($paresrepetidos > '1'){
     borrarrepetidosvalores($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafin,$tallafinal1,$talla1,false);
$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1')";

$result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];

  if($existepar==null || $existepar ==''){
// insertarparnuevo();
   $talla1 = $tallan;

                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{


           // $tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,
     actualizarsoloparesm($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
      
  }else{
      
 
$sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1')";

$result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];

  if($existepar==null || $existepar ==''){
// insertarparnuevo();
   $talla1 = $tallan;

                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{


           // $tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,
     actualizarsoloparesm($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
                }
                }else{
              $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                 if ($tallam =='14m'){$talla2= "19";$tallan = "140";}

                // echo $tallam;
                $talla1 = $tallan;
                $tallafin = $tallam;
                  $tallafinal = $talla2;
                  $tallafinal1 = $tallan;
                  //echo "paresnulos talla m";
 actualizarsoloparesnulosm($tallafin,$tallafinal1,$cantidadm,$iddetalleingreso,$idmodelodetalle,false);

     }

            }
//fin tallas m
        }

     else{

 for($i=14;$i<=45;$i++){

                $cantidad1 = $calzado->$i;
                if($cantidad1 !=0){
                    $talla = $i;
                   // echo $talla;
    $sql3 =" SELECT idkardextienda FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla' ";
                  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardextienda");
  $existepar = $result1['resultado'];
  if($existepar==null || $existepar ==''){
 //insertarparnuevo();
    $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1, $talla,false);

              $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $talla, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
       }else{
           actualizarsolopares($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,false);
        }
         }else{
                //here
          $talla = $i;
 actualizarsoloparesnulos($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,false);
                }

 }
}
//   actualizarsolopares($calzado,$opcionb,$idmarca,$iddetalleingreso,$idmodelodetalle, $idoperacion,$precionuevo,$codigo,$lineanuevo,$numeroparesnuevo,$numerocajasnuevo,false);
//diferentes
}else{
  //  echo "diferentes";
       $sql[] = getSqlDeleteAdiciondetalleingreso($iddetalleingreso);
    $sql[] = getSqlDeleteAdiciondetalleingresotalla($iddetalleingreso);
    $sql[] = getSqlDeleteAdicionkardextienda($iddetalleingreso,$idmodelodetalle);

//echo $coleccion;
if($coleccion==NULL || $coleccion =="" || $coleccion ==''){

}else{
$planillaanterior= split("-",$coleccion);
 //$idsCAr = split("/", $mesplanilla);
$detalle=$planillaanterior[0];
$anio=$planillaanterior[1];
  $sql1= "SELECT idcoleccion FROM coleccion WHERE codigo='$coleccion' AND idmarca='$idmarca'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idcoleccion");
  $idcoleccionn = $result1['resultado'];

  if($idcoleccionn=='' ||$idcoleccionn =="" || $idcoleccionn ==NULL){
      insertarnuevacoleccion($coleccion,$idmarca,false);
      $idcoleccionnn = $res['resultado'];
  }else{
      $idcoleccionnn = $idcoleccionn;
  }
   $res= actualizarcoleccion($idmodelodetalle, $idcoleccionnn,false);
   $idcolecc = $res['resultado'];
}
  $res= actualizarcodigo($idmodelodetalle, $codigo,false);
   $codigoff = $res['resultado'];
//$sql[] = "UPDATE adiciondetalleingreso SET color='$color' ,material='$fecha' WHERE iddetalleingreso = '$iddetalleingreso' AND codigo='$codigo' ";

        if ( $color =='' || $color == null || $color == ""){
            $variablecolor = $material;
        }else{
             $variablecolor = $color;
        }

    //   function getSqlNewAdiciondetalleingreso($idmodelo, $totalpares, $totalbs, $idingreso, $iddetalleingreso, $color, $material, $numero, $return){
       $sql[] =getSqlNewAdicionDetalleingreso($idmodelodetalle, $numeroparesnuevo, $precionuevo, $idoperacion, $iddetalleingresonuevo,  $colornuevo, $materialnuevo,$numerodetalle,$generado,$opciont, false);
        $numerodetalle++;
        $sqlmarca = "
SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelodetalle' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idcoleccion");
    $idcoleccion = $opcionA1['resultado'];

        $codigobarraA = ObtenerCodigoBarraMarcaDetalleAdicion($idmarca ,$idcoleccion, true);
      //ojito

       $codigobarramcn = $codigobarraA['resultado'];
         if(($opcionb == '4')||($opcionb == '14')||($opcionb == '15')){
            for($i=1;$i<=14;$i++){
                 $precio = $calzado->precio;
                $cantidad1 = $calzado->$i;
                $im = $i."m";
                $cantidadm = $calzado->$im;
                if($cantidad1 !=0){
                    $talla = $i;
                  if($talla == '1'){$talla ='91'; $tallamm ='1';$tallammm ='1';}
                  if($talla == '2'){$talla ='02'; $tallamm ='2';$tallammm ='02';}
                  if($talla == '3'){$talla ='03'; $tallamm ='3';$tallammm ='03';}
                  if($talla == '4'){$talla ='04'; $tallamm ='4';$tallammm ='04';}
                  if($talla == '5'){$talla ='05'; $tallamm ='5';$tallammm ='05';}
                  if($talla == '6'){$talla ='06'; $tallamm ='6';$tallammm ='06';}
                  if($talla == '7'){$talla ='07'; $tallamm ='7';$tallammm ='07';}
                  if($talla == '8'){$talla ='08'; $tallamm ='8';$tallammm ='08';}
                  if($talla == '9'){$talla ='09'; $tallamm ='9';$tallammm ='09';}
                  if($talla == '10'){$talla ='10'; $tallamm ='10';$tallammm ='10';}
                  if($talla == '11'){$talla ='11'; $tallamm ='11';$tallammm ='11';}
                  if($talla == '12'){$talla ='12'; $tallamm ='12';$tallammm ='12';}
                  if($talla == '13'){$talla ='13'; $tallamm ='13';$tallammm ='13';}
                  $tallafin = $talla;
                  $tallafinal = $tallamm;
                  $tallafinal1 = $tallammm;
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $tallafinal1, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$tallafinal, false);
                $idkardextienda = "kar-".$numerokardex;
            $codigobarraean13 = $codigobarramcn.$tallafin;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
                          $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $tallafinal, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidad1, 0, $cantidad1, $precio, $precio*$cantidad1, 0, $precio*$cantidad1, $fecha, $hora, $idingreso, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
                if($cantidadm !=0){
                    $tallam = $im;
                if ($tallam =='1m'){$talla2= "01";$tallan="01";}
                if ($tallam =='2m'){$talla2= "20";$tallan = "20";}
                if ($tallam =='3m'){$talla2= "30";$tallan = "30";}
                if ($tallam =='4m'){$talla2= "40";$tallan = "40";}
                if ($tallam =='5m'){$talla2= "50";$tallan = "50";}
                if ($tallam =='6m'){$talla2= "60";$tallan = "60";}
                if ($tallam =='7m'){$talla2= "70";$tallan = "70";}
                if ($tallam =='8m'){$talla2= "80";$tallan = "80";}
                if ($tallam =='9m'){$talla2= "90";$tallan = "90";}
                if ($tallam =='10m'){$talla2= "15";$tallan = "100";}
                if ($tallam =='11m'){$talla2= "16";$tallan = "110";}
                if ($tallam =='12m'){$talla2= "17";$tallan = "120";}
                if ($tallam =='13m'){$talla2= "18";$tallan = "130";}
                $talla1 = $tallan;
                $talla22 = $talla2;
//s
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla1, $idmodelodetalle, $iddetalleingreso, $cantidadm,$tallam, false);
                $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla2;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $precio = $calzado->precio;
             $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidadm, $cantidadm, $numerokardex, $tallam, $material, $precionuevo, $color, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidadm, 0, $cantidadm, $precio, $precio*$cantidad1, 0, $precio*$cantidad1, $fecha, $hora, $idingreso, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
            }

        }

        else{


            for($i=14;$i<=45;$i++){
                $cantidad1 = $calzado->$i;
                if($cantidad1 !=0){

                    $talla = $i;
                  //  $sql[]= getSqlNewDetallepedidotalla($iddetallepedidotalla, $idmodelo, $talla, $cantidad1, $iddetallepedido, $return);
                  $sql[]= getSqlNewAdicionDetalleingresotalla($iddetalleingresotalla, $talla, $idmodelodetalle, $iddetalleingresonuevo, $cantidad1,$talla, false);

              $idkardextienda = "kar-".$numerokardex;
                $codigobarraean13 = $codigobarramcn.$talla;
                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                $sql[] = getSqlNewAdicionKardextienda($idkardextienda, $idmodelodetalle, $idtienda, $codigobarra, $cantidad1, $cantidad1, $numerokardex, $talla, $materialnuevo, $precionuevo, $colornuevo, $precio1sus, $precio2sus, $precio3sus, $iddetalleingresonuevo, $idoperacion, $codigobarraean13,$generado,false);
                $numerokardex++;
                $idmovimientokardextienda = "mkt-".$numeromovimientokardex;
                //                $sql[] = getSqlNewMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $numero, $saldocantidad, false);
                $sql[] = getSqlNewAdicionMovimientokardextienda($idmovimientokardextienda, $idkardextienda, $idtienda, $cantidad1, 0, $cantidad1, $precionuevo, $precionuevo*$cantidad1, 0, $precionuevo*$cantidad1, $fecha, $hora, $idoperacion, $numeromovimientokardex, $cantidad1, false);
                $numeromovimientokardex++;
                }
            }
        }

}
 
    }
 $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
//MostrarConsulta($sql);

    if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = $iddetalleingreso;
    }
    else
    {
        $dev['mensaje'] = "No existen cambios para guardar";
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

function borrarrepetidos($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafin,$tallafinal1,$return = false ){
 $sqlA[] ="DELETE FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafin';";
$sqlA[] ="DELETE FROM adiciondetalleingresotalla WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";

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
function borrarrepetidosvalores($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafin,$tallafinal1,$talla1,$return = false ){
 $sqlA[] ="DELETE FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1');";
//$sqlA[] ="DELETE FROM adiciondetalleingresotalla WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla1';";

//MostrarConsulta($sqlA);
  ejecutarConsultaSQLBeginCommit($sqlA);
}
function actualizarsoloparesm($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){

 $select = "SUM(saldocantidad) AS Pares";
    $from = "adicionkardextienda k,modelos mdt";
    $where = " k.idmodelodetalle = mdt.idmodelo and k.idcalzado='$iddetalleingreso' and (k.talla='$tallafinal1' OR k.talla='$tallafinal') ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $stockanterior = $almacenA1['resultado'];
         if($stockanterior==NULL || $stockanterior =='' || $stockanterior == ""){ $stockanterior="0"; }
$nuevacantidad= $stockanterior+$cantidad1;
  $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$nuevacantidad',cantidad='$nuevacantidad',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";

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

function actualizarsoloparesmvalores($tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,
 $select = "SUM(saldocantidad) AS Pares";
    $from = "adicionkardextienda k,modelos mdt";
    $where = " k.idmodelodetalle = mdt.idmodelo and k.idcalzado='$iddetalleingreso' and k.talla='$tallafinal1' ";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
//echo $sql2p;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $stockanterior = $almacenA1['resultado'];
         if($stockanterior==NULL || $stockanterior =='' || $stockanterior == ""){ $stockanterior="0"; }
$nuevacantidad= $stockanterior+$cantidad1;


//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$nuevacantidad' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$nuevacantidad',cantidad='$nuevacantidad',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";

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

function actualizarsoloparesnulosm($tallafin,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
  //  echo "entroooooo";

//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='0', WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1');";
//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);

}

function actualizarsoloparesnulossinm($tallafinal,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='0', WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafinal' OR talla='$tallafinal1');";
//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);
}
function actualizarsoloparesnulos($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";

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
            $dev['resultado'] = "$talla";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idplanillaemitida";
        }
    }
}

function actualizarsoloparesregistro($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla';";
$sql1= "SELECT
             idkardextienda
            FROM
             adicionkardextienda
            WHERE
              idcalzado = '$iddetalleingreso' AND talla='$talla' ";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idkardextienda");
  $idkardextienda = $result1['resultado'];

      $select = "SUM(saldocantidad) AS Pares";
    $from = "adicionkardextienda k,modelos mdt";
    $where = " k.idmodelodetalle = mdt.idmodelo and k.idcalzado='$iddetalleingreso' and k.talla='$talla'";
    $sql2p = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
//echo $sql2p;
     $almacenA1 =  findBySqlReturnCampoUnique($sql2p, true, true, 'Pares');
    $stockanterior = $almacenA1['resultado'];
         if($stockanterior==NULL || $stockanterior =='' || $stockanterior == ""){ $stockanterior="0"; }
         $numeroingresados= $cantidad1;
           if($numeroingresados==NULL || $numeroingresados =='' || $numeroingresados == ""){ $numeroingresados="0"; }
$nuevacantidad= $stockanterior+$numeroingresados;
$sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$nuevacantidad',cantidad='$nuevacantidad',precio2bs='$precionuevo',precio3bs='$colornuevo',precio1bs='$materialnuevo',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
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
function actualizarsolopares($talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla';";

$sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',precio2bs='$precionuevo',precio3bs='$colornuevo',precio1bs='$materialnuevo',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
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


function actualizarcodigo($idmodelo, $modelo,$return = false ){
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
//SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelodetalle'
$sqlA[] = "UPDATE modelos SET codigo='$modelo' WHERE idmodelo = '$idmodelo';";

//    $sqlA[] = "UPDATE planillaemitida SET cobro1='$cobro1',cobro2='$cobro2',cobro3='$cobro3',porcobrar='$porcobrar' WHERE idclienteempresa='$idcliente' AND idplanillaemitida='$idplanillaemitida';";
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
            $dev['resultado'] = "$idcredito";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idcredito";
        }
    }
}
function insertarnuevacoleccion($coleccion, $idmarca,$return = false ){
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
  $codigocolor= split("-",$coleccion);
 //$idsCAr = split("/", $mesplanilla);
$mes=$codigocolor[0];
$anio=$codigocolor[1];
//SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelodetalle'
 $sql1 ="
SELECT
  MAX(col.codigobarra1) AS codigobarra
FROM
  coleccion col
WHERE
  col.idmarca = '$idmarca' AND col.anio = '$anio'
";
    $codigobarraA = findBySqlReturnCampoUnique($sql1, true, true, 'codigobarra');
    if ($codigobarraA['resultado']=="null" || $codigobarraA['resultado']==''){
    $numerob= $codigobarraA['resultado']= '1';
    }else {
        $numerob=$codigobarraA['resultado'] + 1;
    }

   //  $numerobarra="0".$numerob;
    $codigob = $anio%100;
    if ($codigob < '10'){
 $codigobar="0".$codigob;
}else{
    $codigobar = $codigob;
}
    $codigobarra = $numerob.$codigobar;

  $numeroA = findUltimoID("coleccion", "numero", true);
    $numero = $numeroA['resultado']+1;
    $estado = "PASADO";
  //  $sql[] = "UPDATE coleccion SET estado = 'PASADO' WHERE idmarca = '$idmarca';";


    $idcoleccion = 'col-'.$numero;
  //    $estado = $_GET['estado'];
    $sqlA[] = getSqlNewColeccion($idcoleccion, $anio, $mes, $numero, $coleccion, $idmarca, $estado, $codigobarra, $numerob, $return);
//    $sqlA[] = "UPDATE planillaemitida SET cobro1='$cobro1',cobro2='$cobro2',cobro3='$cobro3',porcobrar='$porcobrar' WHERE idclienteempresa='$idcliente' AND idplanillaemitida='$idplanillaemitida';";
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
            $dev['resultado'] = "$idcoleccion";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idcoleccion";
        }
    }
}
function actualizarcoleccion($idmodelo, $idcoleccion,$return = false ){
$emitida="1";
$fecha = date("Y-m-d");
 $hora = date("H:i:s");
 $fechaemitida = date("Y-m-d");
//SELECT idcoleccion FROM modelos WHERE idmodelo = '$idmodelodetalle'
$sqlA[] = "UPDATE  modelos SET idcoleccion='$idcoleccion' WHERE idmodelo = '$idmodelo';";

//    $sqlA[] = "UPDATE planillaemitida SET cobro1='$cobro1',cobro2='$cobro2',cobro3='$cobro3',porcobrar='$porcobrar' WHERE idclienteempresa='$idcliente' AND idplanillaemitida='$idplanillaemitida';";
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
            $dev['resultado'] = "$idcredito";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idcredito";
        }
    }
}

function ListarItemsPedido($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$recibo,$idestilo, $return = false){
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
 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //idmodelo,codigo,color,material,precio
   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo,dtp.idmodelo, dtp.totalpares, dtp.totalbs AS precio, 1 AS totalcajas
FROM detalleingreso dtp, modelos mdd
WHERE dtp.idmodelo = mdd.idmodelo
AND mdd.idmarca='$idmarca' ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";

    //            echo $sql;
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                 $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";

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
function listarmodeloscoleccion($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$codigo,$where = '', $return = false){

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
//LIKE '".$_GET['buscarcoleccion']."'

if($codigo == null || $codigo == "")
    {
    if($where == null || $where == "")
    {
        $sql = "
SELECT mdd.idmodelo,dtp.iddetalleingreso,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND AND mdd.stylename = es.idestilo
 AND mdd.idmarca = '$idmarca' AND dtp.unido='no'
ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC  LIMIT $start,$limit;";
        //        MostrarConsulta($sql);AND mdd.stylename = '$idestilo' ORDER BY `mdd`.`codigo` ASC,`col`.`anio`


    }
    else
    {
        $sql = "
SELECT mdd.idmodelo,dtp.iddetalleingreso,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col,  estilos es
WHERE dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND mdd.stylename = es.idestilo AND
 mdd.idmarca = '$idmarca' AND dtp.unido='no' AND $where ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC LIMIT $start,$limit
         ";
    }
}else{
   if($where == null || $where == "")
    {
        $sql = "
SELECT mdd.idmodelo,dtp.iddetalleingreso,mdd.idmarca,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col,  estilos es
WHERE dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca' AND dtp.unido='no' AND mdd.codigo = '".$codigo."'";
            // LIKE '".$codigo."'
             //LIKE '%".$codigo."%'
        //        MostrarConsulta($sql);ojo
    }
    else
    {
        $sql = "
SELECT mdd.idmodelo,dtp.iddetalleingreso,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es
WHERE dtp.idmodelo = mdd.idmodelo AND mdd.idcoleccion = col.idcoleccion AND mdd.stylename = es.idestilo AND dtp.unido='no' AND mdd.idmarca = '$idmarca' AND mdd.codigo LIKE '%$codigo%' AND $where ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC LIMIT $start,$limit
         ";
    }

}

 //        MostrarConsulta($sql);
     //          echo $sql;
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

function unionitems($resultado,$return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
     $estado='validado';
  $nt14="0.00";
     $nt16='0';$nt17='0';$nt18='0';$nt19='0';$nt20='0';$nt21='0';$nt22='0';$nt23='0';$nt24='0';$nt25='0';$nt26='0';
     $nt27='0';$nt28='0';$nt29='0';$nt30='0';$nt31='0';$nt32='0';$nt33='0';$nt34='0';$nt35='0';$nt36='0';$nt37='0';$nt38='0';

$productos = $resultado->calzados;

  for($i = 0; $i< count($productos); $i++)
    {
//echo "hola";
        $producto = $productos[$i];
$idmodelo = $producto->idmodelo;

         $sql1= "SELECT
             idmarca,opcionb
            FROM
              marcas
            WHERE
              idmodelo = '$idmodelo'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idmarca");
    $idmarca = $result['resultado'];
     $result1 = findBySqlReturnCampoUnique($sql1, true, true, "opcionb");
    $opcionb = $result1['resultado'];

     $sql2= "SELECT
             idmarca,stylename,idcoleccion,idlinea,
            FROM
              modelos
            WHERE
              idmodelo = '$idmodelo'";
    $result = findBySqlReturnCampoUnique($sql2, true, true, "idmarca");
    $idmarca = $result['resultado'];
     $result1 = findBySqlReturnCampoUnique($sql2, true, true, "stylename");
    $idestilo = $result1['resultado'];
      $result1 = findBySqlReturnCampoUnique($sql2, true, true, "idcoleccion");
    $idcoleccion = $result1['resultado'];
      $result1 = findBySqlReturnCampoUnique($sql2, true, true, "idlinea");
    $idlinea = $result1['resultado'];

        $codigo = $producto->codigo;
        $colores = $producto->color;
       // $color= "/".$t14[i];
      //  echo $color;
        $precio = $producto->precio;
      //  echo $precio;
        $totalpares = $producto->totalpares;
        $t14 = $producto->t14;
    $t15 = $producto->t15;
    //echo $t15;
    $t16 = $producto->t16;

    $t17 = $producto->t17;
     //   echo $t17;
    $t18 = $producto->t18;
    $t19 = $producto->t19;
    $t20 = $producto->t20;
    $t21 = $producto->t21;
    $t22 = $producto->t22;
    $t23 = $producto->t23;
    $t24 = $producto->t24;
    $t25 = $producto->t25;
    $t26 = $producto->t26;
    $t27 = $producto->t27;
    $t28 = $producto->t28;
    $t29 = $producto->t29;
    $t30 = $producto->t30;
$t31 = $producto->t31;
$t32 = $producto->t32;
$t33 = $producto->t33;
$t34 = $producto->t34;
$t35 = $producto->t35;
$t36 = $producto->t36;
$t37 = $producto->t37;
$t38 = $producto->t38;
if($i=='0'){$color1=$colores;}
if($i=='1'){$color2=$colores;}
if($i=='2'){$color3=$colores;}
if($i=='3'){$color4=$colores;}
if($i=='4'){$color5=$colores;}

  
    $iddetalleespecial="esp-1";


$iddetalleespecial="esp-1";
if($i=='0'){$sql[] = "UPDATE especialtmp SET  color1= '$color1',precio='$precio',modelo='$codigo'WHERE iddetalleespecial='$iddetalleespecial'";}
if($i=='1'){$sql[] = "UPDATE especialtmp SET  color2= '$color2',precio='$precio',modelo='$codigo'WHERE iddetalleespecial='$iddetalleespecial'";}
if($i=='2'){$sql[] = "UPDATE especialtmp SET  color3= '$color3',precio='$precio',modelo='$codigo'WHERE iddetalleespecial='$iddetalleespecial'";}
if($i=='3'){$sql[] = "UPDATE especialtmp SET  color4= '$color4',precio='$precio',modelo='$codigo'WHERE iddetalleespecial='$iddetalleespecial'";}
if($i=='4'){$sql[] = "UPDATE especialtmp SET  color5= '$color5',precio='$precio',modelo='$codigo'WHERE iddetalleespecial='$iddetalleespecial'";}
   //  }
if( $t14 < "10") { $nt14+=$t14[i]; }
 $ntotalpares+=$totalpares[i]; 
 if( $t15 < "10") { $nt15+=$t15[i]; }
if( $t16 < "10") { $nt16+=$t16[i]; }
if( $t17 < "10") { $nt17+=$t17[i]; }
if( $t18 < "10") { $nt18+=$t18[i]; }
if( $t19 < "10") { $nt19+=$t19[i]; }
if( $t20 < "10") { $nt20+=$t20[i]; }
if( $t21 < "10") { $nt21+=$t21[i]; }
if( $t22 < "10") { $nt22+=$t22[i]; }
if( $t23 < "10") { $nt23+=$t23[i]; }
if( $t24 < "10") { $nt24+=$t24[i]; }
if( $t25 < "10") { $nt25+=$t25[i]; }
if( $t26 < "10") { $nt26+=$t26[i]; }
if( $t27 < "10") { $nt27+=$t27[i]; }
if( $t28 < "10") { $nt28+=$t28[i]; }
if( $t29 < "10") { $nt29+=$t29[i]; }
if( $t30 < "10") { $nt30+=$t30[i]; }
if( $t31 < "10") { $nt31+=$t31[i]; }
if( $t32 < "10") { $nt32+=$t32[i]; }
if( $t33 < "10") { $nt33+=$t33[i]; }
if( $t34 < "10") { $nt34+=$t34[i]; }
if( $t35 < "10") { $nt35+=$t35[i]; }
if( $t36 < "10") { $nt36+=$t36[i]; }
if( $t37 < "10") { $nt37+=$t37[i]; }
if( $t38 < "10") { $nt38+=$t38[i]; }
$ntotalprecio = "/".$precio[$i];
 }
//$nt15 =  $t15[i] + "/" + $t15[i+1]+ "/" +$t15[i+2]+ "/" +$t15[i+3]+ "/" +$t15[i+4] ;
$numeroD = findUltimoID("adiciondetalleingresotmp", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
     $iddetalleingreso = "din-".$numerodetalle;
  $idmodelo = "mod-".$numerodetalle;

        $sqlmarca = "
SELECT
iddetalleespecial,color1,color2,color3,color4,color5,precio,modelo
FROM
especialtmp
WHERE
 iddetalleespecial = '$iddetalleespecial'
";
  // echo $sqlmarca;
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color1");
    $color1 = $opcionA1['resultado'];
      $opcionA2 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color2");
    $color2 = $opcionA2['resultado'];
      $opcionA3 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color3");
    $color3 = $opcionA3['resultado'];
      $opcionA4 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color4");
    $color4 = $opcionA4['resultado'];
      $opcionA5 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color5");
    $color5 = $opcionA5['resultado'];
      $opcionAp = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio");
    $precio = $opcionAp['resultado'];
      $opcionA1m = findBySqlReturnCampoUnique($sqlmarca, true, true, "modelo");
    $modelo = $opcionA1m['resultado'];
   // echo $color1;
   $colornuevoe= $color1."/".$color2."/".$color3."/".$color4."/".$color5;
//   $resultado = $colornuevoe."-".$precio."-".$modelo;
//
//       $res2= split("-",$resultado);
//$colornuevo=$res2[0];
//$precionuevo=$res2[1];
//$modelonuevo=$res2[2];
   $sql[] =getSqlNewAdicionDetalleingresotmp($idmodelo, $ntotalpares, $precio, $idingreso, $iddetalleingreso,  $colornuevoe, $material,$numerodetalle,$generado,$opciont,$iddetalleespecial, false);
 //$codigobarraA1 = ObtenerValorestmp($iddetalleespecial, true);
  //     $resultado = $codigobarraA1['resultado'];
 
//$sql[] = "UPDATE adiciondetalleingresotmp SET color= '$colornuevoe',totalbs='$precionuevo'WHERE iddetalleingreso='$iddetalleingreso'";

 for($i = "14"; $i< "39"; $i++)
    {
$talla = $i;
if ($talla=='14'){$cantidad1 = $nt14;}
if ($talla=='15'){$cantidad1 = $nt15;}
if ($talla=='16'){$cantidad1 = $nt16;}
if ($talla=='17'){$cantidad1 = $nt17;}
if ($talla=='18'){$cantidad1 = $nt18;}
if ($talla=='19'){$cantidad1 = $nt19;}
if ($talla=='20'){$cantidad1 = $nt20;}
if ($talla=='21'){$cantidad1 = $nt21;}
if ($talla=='22'){$cantidad1 = $nt22;}
if ($talla=='23'){$cantidad1 = $nt23;}
if ($talla=='24'){$cantidad1 = $nt24;}
if ($talla=='25'){$cantidad1 = $nt25;}
if ($talla=='26'){$cantidad1 = $nt26;}
if ($talla=='27'){$cantidad1 = $nt27;}
if ($talla=='28'){$cantidad1 = $nt28;}
if ($talla=='29'){$cantidad1 = $nt29;}
if ($talla=='30'){$cantidad1 = $nt30;}
if ($talla=='31'){$cantidad1 = $nt31;}
if ($talla=='32'){$cantidad1 = $nt32;}
if ($talla=='33'){$cantidad1 = $nt33;}
if ($talla=='34'){$cantidad1 = $nt34;}
if ($talla=='35'){$cantidad1 = $nt35;}
if ($talla=='36'){$cantidad1 = $nt36;}
if ($talla=='37'){$cantidad1 = $nt37;}
if ($talla=='38'){$cantidad1 = $nt38;}
                  $sql[]= getSqlNewAdicionDetalleingresotallatmp($iddetalleingresotalla, $talla, $idmodelo, $iddetalleingreso, $cantidad1, false);

                //}
           // }
    }
      //  }
      //   }
 //MostrarConsulta($sql);
     if(ejecutarConsultaSQLBeginCommit($sql)){

        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = $iddetalleingreso;
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
function buscarlistanuevomodelo($start, $limit, $sort, $dir, $callback, $_dc, $iddetalleingreso, $return = false){
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
 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //idmodelo,codigo,color,material,precio
   $sql ="
SELECT dtp.iddetalleingreso,0  AS codigo,0 AS linea,0 AS opciont,dtp.idmodelo, dtp.totalpares, dtp.totalbs AS precio, 1 AS totalcajas,dtp.color
FROM adiciondetalleingresotmp dtp
WHERE dtp.iddetalleingreso='$iddetalleingreso'
";

    //            echo $sql;
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                 $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotallatmp ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotallatmp ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";

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
function ObtenerValorestmp($iddetalletmp,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
  //$sql[] = getSqlNewModelos($idmodelo, $idmarca, $codigobuscar, $numero, $precio, $idestilo, $idcoleccion, $idlinea, $colorbuscar,$imagen,$opciont, false);
$sqlmarca = "
SELECT
iddetalleespecial,color1,color2,color3,color4,color5,precio,modelo
FROM
especialtmp
WHERE
 iddetalleespecial = '$iddetalletmp'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color1");
    $color1 = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color2");
    $color2 = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color3");
    $color3 = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color4");
    $color4 = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "color5");
    $color5 = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "precio");
    $precio = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "modelo");
    $modelo = $opcionA1['resultado'];
   // echo $color1;
   $colornuevo= $color1."/".$color2."/".$color3."/".$color4."/".$color5;
   $res = $colornuevo."-".$precio."-".$modelo;
   // if(ejecutarConsultaSQLBeginCommit($sqlmarca)){
//echo $res;
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $res;
   // }
//    else
//    {
//        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar datos";
//        $dev['error'] = "false";
//        $dev['resultado'] = "";
//    }
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
function buscarlistamodelomarca($idmarca,$idmodelo,$start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
     $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
  $sqlmarca = "
SELECT
  mad.opcion
FROM
  `marcas` mad
WHERE
  mad.idmarca = '$idmarca'
";

    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
   $opcionmar = $opcionA['resultado'];
   // SELECT mdd.idmodelo,dtp.iddetalleingreso,col.codigo AS coleccion,mdd.codigo AS modelo,dtp.color,dtp.material, dtp.totalbs , dtp.totalpares,es.nombre AS estilo


 $select ="mo.idmodelo, mo.idmarca, mo.codigo ,dtp.iddetalleingreso,0 AS linea ,1 AS opciont, mo.numero, co.codigo AS coleccion,dtp.color,dtp.material, dtp.totalbs AS precio, dtp.totalpares, 1 AS totalcajas";
    $from = "`modelos` mo, `coleccion` co,`adiciondetalleingreso` dtp";
    $where = "mo.idmodelo=dtp.idmodelo AND mo.idcoleccion = co.idcoleccion AND dtp.unido='no' AND mo.idmarca = '$idmarca' AND mo.codigo LIKE '%".$idmodelo."%'";

    //    echo $sql;
 if($star == 0 && $limit == 0)
    {
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    }
    else
    {
        $sql = "SELECT DISTINCT ".$select." FROM ".$from. " WHERE ".$where." ".$order." LIMIT $start,$limit ";
    }
           echo $sql;
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
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
                                 $sqld = "
SELECT ta.talla, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
AND ad.iddetalleingreso = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";
                             //   echo $sqld;
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        do{
                for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));
                                   }
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
//uniones

function buscarmodeloinsertar($iddetalleingreso, $callback, $_dc, $return= false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idtienda = $_SESSION['idtienda'];

    $sqlmarca = "
SELECT idmodelo FROM adiciondetalleingreso WHERE iddetalleingreso = '$iddetalleingreso'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmodelo");
    $idmodelo = $opcionA1['resultado'];
    
$sqlmarca = "
SELECT idmarca FROM modelos WHERE idmodelo = '$idmodelo'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmarca");
    $idmarca = $opcionA1['resultado'];

$sqlmarca = "
SELECT
  mar.talla,mar.opcionb,mar.pedido
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];
    
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
if($opcionpedido=="CODIGO-COLOR"){
$detalle="dtp.color";
}
if($opcionpedido=="CODIGO"){
$detalle="'-' AS color";
}
if(($opcionpedido=="CODIGO-COLOR-MATERIAL")&&($opcionb=="6")){
  $detalle =  "CONCAT(dtp.color,'-',dtp.material) AS color";
}
if(($opcionpedido=="CODIGO-COLOR-STYLENAME")&&($opcionb=="4")){
  $detalle =  "CONCAT(dtp.color,'-',dtp.material) AS color";
        }
        if(($opcionpedido=="CODIGO-MATERIAL")&&($opcionb=="7")){
 $detalle="dtp.material AS color";
        }
if($opcionpedido=="LINEA-CODIGO-COLOR"){
$detalle="dtp.color";
      }
if($opcionb=="3"){
$detalle="dtp.color";
   }
//SELECT mdd.idmodelo,dtp.iddetalleingreso, mdd.codigo AS codigo, SUM(ad.saldocantidad) AS totalpares, dtp.totalbs AS precio, dtp.material, dtp.color, col.codigo AS coleccion, 1 AS totalcajas

$sql ="
SELECT mdd.idmodelo,dtp.iddetalleingreso, mdd.codigo AS codigo, SUM(ad.saldocantidad) AS totalpares, dtp.totalbs AS precio,$detalle, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, adicionkardextienda ad
WHERE ad.idcalzado=dtp.iddetalleingreso AND ad.idmodelodetalle=mdd.idmodelo AND dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND dtp.unido='no'
AND mdd.idmarca = '$idmarca'
AND dtp.iddetalleingreso = '$iddetalleingreso'
group by dtp.iddetalleingreso;
";


$sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='1m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['1m'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='2m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['2m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='3m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['3m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='4m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['4m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='5m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['5m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='6m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['6m'] =  $tallaA['resultado'];

         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='7m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['7m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='8m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['8m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='9m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['9m'] =  $tallaA['resultado'];
        $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='10m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['10m'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='11m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['11m'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='12m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['12m'] =  $tallaA['resultado'];
        $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='13m'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['13m'] =  $tallaA['resultado'];


$sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='1'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['1'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='2'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['2'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='3'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['3'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='4'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['4'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='5'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['5'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='6'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['6'] =  $tallaA['resultado'];

         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='7'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['7'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='8'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['8'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='9'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['9'] =  $tallaA['resultado'];

 $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='10'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['10'] =  $tallaA['resultado'];
$sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='11'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['11'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='12'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['12'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='13'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['13'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='14'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['14'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='15'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['15'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='16'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['16'] =  $tallaA['resultado'];

         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='17'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['17'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='18'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['18'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='19'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['19'] =  $tallaA['resultado'];
  $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='20'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['20'] =  $tallaA['resultado'];
$sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='21'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['21'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='22'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['22'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='23'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['23'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='24'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['24'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='25'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['25'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='26'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['26'] =  $tallaA['resultado'];

         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='27'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['27'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='28'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['28'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='29'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['29'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='30'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['30'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='31'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['31'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='32'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['32'] =  $tallaA['resultado'];

     $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='33'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
             $value['33'] =  $tallaA['resultado'];
      $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='34'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['34'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='35'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['35'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='36'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['36'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='37'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['37'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='38'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['38'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='39'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['39'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='40'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['40'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='41'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['41'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='42'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['42'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='43'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['43'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='44'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['44'] =  $tallaA['resultado'];
         $sqld = "SELECT dtpt.saldocantidad As cantidad FROM `adicionkardextienda` dtpt  WHERE dtpt.idcalzado = '$iddetalleingreso' and dtpt.talla='45'";
          $tallaA = findBySqlReturnCampoUnique($sqld, true, true, "cantidad");
        $value['45'] =  $tallaA['resultado'];
//ojito
      if($iddetalleingreso != null)
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
                        $dev['mensaje'] = "No se encontro datos en la consulta ";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta d";
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


function buscarmodeloinsertarprecio($iddetalleingreso, $callback, $_dc, $return= false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idtienda = $_SESSION['idtienda'];

    $sqlmarca = "
SELECT idmodelo FROM adiciondetalleingreso WHERE iddetalleingreso = '$iddetalleingreso'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmodelo");
    $idmodelo = $opcionA1['resultado'];
$sqlmarca = "
SELECT idmarca FROM modelos WHERE idmodelo = '$idmodelo'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmarca");
    $idmarca = $opcionA1['resultado'];

$sqlmarca = "
SELECT
  mar.talla,mar.opcionb,mar.pedido
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
     $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    if($opcionpedido=="CODIGO"){
$detalle="'-' AS color";
}
if($opcionpedido=="CODIGO-COLOR"){
$detalle="dtp.color";
}
if(($opcionpedido=="CODIGO-COLOR-MATERIAL")&&($opcionb=="6")){
  $detalle =  "CONCAT(dtp.color,'-',dtp.material) AS color";
}
if(($opcionpedido=="CODIGO-COLOR-STYLENAME")&&($opcionb=="4")){
  $detalle =  "CONCAT(dtp.color,'-',dtp.material) AS color";
        }
        if(($opcionpedido=="CODIGO-MATERIAL")&&($opcionb=="7")){
 $detalle="dtp.material AS color";
        }
if($opcionpedido=="LINEA-CODIGO-COLOR"){
$detalle="dtp.color";
      }
if($opcionb=="3"){
$detalle="dtp.color";
   }
   
//SELECT mdd.idmodelo,dtp.iddetalleingreso, mdd.codigo AS codigo, SUM(ad.saldocantidad) AS totalpares, dtp.totalbs AS precio, dtp.material, dtp.color, col.codigo AS coleccion, 1 AS totalcajas

$sql ="
SELECT mdd.idmodelo,dtp.iddetalleingreso, mdd.codigo AS codigo, SUM(ad.saldocantidad) AS cantidadpares,(SUM(ad.saldocantidad)*dtp.totalbs) As totalbs, dtp.totalbs AS precio,$detalle, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, adicionkardextienda ad
WHERE ad.idcalzado=dtp.iddetalleingreso AND ad.idmodelodetalle=mdd.idmodelo AND dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND dtp.unido='no'
AND mdd.idmarca = '$idmarca'
AND dtp.iddetalleingreso = '$iddetalleingreso'
group by dtp.iddetalleingreso;
";

//echo $sql;
//ojito
      if($iddetalleingreso != null)
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
                        $dev['mensaje'] = "No se encontro datos en la consulta ";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta d";
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
function GuardarNuevoPrecio($resultado, $return)
{

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idtienda =$_SESSION['idtienda'];
    $responsable = $_SESSION['idusuario'];
   $hora = date("H:i:s");

$fecha2=time()-3600;
//$fecha2=time();
$hora= date("H:i:s",$fecha2);
   $proforma = $resultado->venta;
//    $numeroventaA = findUltimoID("ventasdetalle", "numero", true);
//    $numeroventaj = $numeroventaA['resultado'];

     $sql1= "SELECT MAX(idcambio) AS num FROM cambioprecio";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "num");
    $numeroventaj = $result['resultado'];

    $idcambio = $numeroventaj + 1;
    //$idventadetalle="c-".$numeroventa;
   
    $fecha = $proforma->fecha;
   if($fecha == "")
    {        $fecha = date("Y-m-d");  }
   $idmarca = $proforma->idmarca;
   
    $cantidadpares = $proforma ->totalpares;
    $montoanterior = $proforma ->totalbsanterior;
    $montonuevo = $proforma ->totalbsnuevo;
$diferencia= $proforma ->diferencia;
$totalpares=COUNT($product);
  $product = $resultado->productos;
$totalpares=COUNT($product);
     $sql1= "SELECT cli.idtipocambio,cli.estado,valor FROM tipocambio cli WHERE cli.estado = 'activado'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "valor");
    $tipocambio = $result['resultado'];
    $montoapagarsus = $montoapagar/$tipocambio;


//  $sql[] =getSqlNewVentasdetalle($idventadetalle, $idtienda, $idempresa, $boleta, $numeroventa, $idclienteempresa, $nit, $nombrecliente, $apellidocliente, $fecha, $hora, $tipoventa, $numerofactura, $responsable, $credito, $totalbs, $totalpares, $montoapagar, $descuento, $montocancelado, $devuelto,$montocanceladosus, $ingresoventabs, $ingresoventasus, $montopapeleta, $tipocambio, $observacion,$arqueo, false);
 $sql[] =getSqlNewCambioprecio($idcambio, $idmarca, $idtienda, $fecha, $hora, $cantidadpares, $montoanterior, $montonuevo, $diferencia, $concepto, false);


// $sql[] =getSqlNewVentasdetalle($idventadetalle, $idtienda, $idempresa, $boleta, $numeroventa, $idclienteempresa, $nit, $nombrecliente, $apellidocliente, $fecha, $hora, $tipoventa, $numerofactura, $responsable, $credito, $totalbs, $totalpares, $montoapagar, $descuento, $montocancelado, $devuelto,$montocanceladosus, $ingresoventabs, $ingresoventasus, $montopapeleta, $tipocambio, $observacion,$arqueo, $montoapagar,$validadocredito,$validacionarqueo,$cambiocredito,$tipopagocambio,$tipofactura,false);

    for($i=0;$i<count($product);$i++){
        $producto = $product[$i];
 $iddetalletraspasoA = findUltimoID("cambiopreciodetalle", "numero",true );
            $numerodetalletraspaso = $iddetalletraspasoA['resultado'] + 1 +$i;
            $idcambiodetalle = "cam-".$numerodetalletraspaso;

$iddetalleingreso = $producto->iddetalleingreso;
        $precio = $producto->precionuevo;
        $cantidad = $producto->cantidad;
 $precioanterior = $producto->precio;
 $totalbs = $producto->totalbs;
        $cantidadpares = $producto->cantidadpares;
 $totalbsnuevo = $producto->totalbsnuevo;
        $diferencia = $producto->diferencia;
    $sql4 = "SELECT idmodelo FROM adiciondetalleingreso WHERE iddetalleingreso ='$iddetalleingreso'";
   $paresd = findBySqlReturnCampoUnique($sql4, true, true, "idmodelo");
   $idmodelo = $paresd['resultado'];
   $sql[] =getSqlNewCambiopreciodetalle($idcambiodetalle, $idcambio, $iddetalleingreso, $idmodelo, $cantidadpares, $precioanterior, $totalbs, $precio, $totalbsnuevo, $diferencia, $numerodetalletraspaso,false);
   
 //$sql[] =getSqlNewItemventa($iditemventa, $cantidad, $preciokardex, $tipocambio, $descuentounidad, $descuentoporcentaje, $total, $numerodetalletraspaso, $idcalzado, $idventadetalle, $idempleado, $idkardextienda, "0.00",$estado,$devolucion,$varvendedor,$idparametro,$muestras,$tipoventaitem,$tipoventadetalle,$montoreintegro,$tipomuestra, $incremento,$diferencia,false);
 $sql[] = "UPDATE adicionkardextienda SET precio2bs= '$precio' WHERE idcalzado= '$iddetalleingreso' and unido ='no';";
$sql[] = "UPDATE adiciondetalleingreso SET totalbs= '$precio',rebaja='$idcambio' WHERE iddetalleingreso= '$iddetalleingreso' and unido ='no';";


           }

  

    //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {



        $dev['mensaje'] = "Se registraron los nuevos precios correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = $idcambio;
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

function getSqlNewCambioprecio($idcambio, $idmarca, $idtienda, $fecha, $hora, $cantidadpares, $montoanterior, $montonuevo, $diferencia, $concepto, $return){
$setC[0]['campo'] = 'idcambio';
$setC[0]['dato'] = $idcambio;
$setC[1]['campo'] = 'idmarca';
$setC[1]['dato'] = $idmarca;
$setC[2]['campo'] = 'idtienda';
$setC[2]['dato'] = $idtienda;
$setC[3]['campo'] = 'fecha';
$setC[3]['dato'] = $fecha;
$setC[4]['campo'] = 'hora';
$setC[4]['dato'] = $hora;
$setC[5]['campo'] = 'cantidadpares';
$setC[5]['dato'] = $cantidadpares;
$setC[6]['campo'] = 'montoanterior';
$setC[6]['dato'] = $montoanterior;
$setC[7]['campo'] = 'montonuevo';
$setC[7]['dato'] = $montonuevo;
$setC[8]['campo'] = 'diferencia';
$setC[8]['dato'] = $diferencia;
$setC[9]['campo'] = 'concepto';
$setC[9]['dato'] = $concepto;
$sql2 = generarInsertValues($setC);
return "INSERT INTO cambioprecio ".$sql2;
}
function getSqlNewEspecialtmp($idmodelo, $iddetalleespecial, $color1, $color2, $color3, $color4, $color5, $precio, $modelo, $numero, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'iddetalleespecial';
$setC[1]['dato'] = $iddetalleespecial;
$setC[2]['campo'] = 'color1';
$setC[2]['dato'] = $color1;
$setC[3]['campo'] = 'color2';
$setC[3]['dato'] = $color2;
$setC[4]['campo'] = 'color3';
$setC[4]['dato'] = $color3;
$setC[5]['campo'] = 'color4';
$setC[5]['dato'] = $color4;
$setC[6]['campo'] = 'color5';
$setC[6]['dato'] = $color5;
$setC[7]['campo'] = 'precio';
$setC[7]['dato'] = $precio;
$setC[8]['campo'] = 'modelo';
$setC[8]['dato'] = $modelo;
$setC[9]['campo'] = 'numero';
$setC[9]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO especialtmp ".$sql2;
}
function getSqlNewColeccion($idcoleccion, $anio, $detalle, $numero, $codigo, $idmarca, $estado, $codigobarra, $codigobarra1, $return){
    $setC[0]['campo'] = 'idcoleccion';
    $setC[0]['dato'] = $idcoleccion;
    $setC[1]['campo'] = 'anio';
    $setC[1]['dato'] = $anio;
    $setC[2]['campo'] = 'detalle';
    $setC[2]['dato'] = $detalle;
    $setC[3]['campo'] = 'numero';
    $setC[3]['dato'] = $numero;
    $setC[4]['campo'] = 'codigo';
    $setC[4]['dato'] = $codigo;
    $setC[5]['campo'] = 'idmarca';
    $setC[5]['dato'] = $idmarca;
    $setC[6]['campo'] = 'estado';
    $setC[6]['dato'] = $estado;
    $setC[7]['campo'] = 'codigobarra';
    $setC[7]['dato'] = $codigobarra;
    $setC[8]['campo'] = 'codigobarra1';
    $setC[8]['dato'] = $codigobarra1;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO coleccion ".$sql2;
}

function getSqlNewCambiopreciodetalle($idcambiodetalle, $idcambio, $iddetalleingreso, $idmodelo, $cantidadpares, $precioanterior, $totalbs, $precionuevo, $totalbsnuevo, $diferencia, $numero, $return){
$setC[0]['campo'] = 'idcambiodetalle';
$setC[0]['dato'] = $idcambiodetalle;
$setC[1]['campo'] = 'idcambio';
$setC[1]['dato'] = $idcambio;
$setC[2]['campo'] = 'iddetalleingreso';
$setC[2]['dato'] = $iddetalleingreso;
$setC[3]['campo'] = 'idmodelo';
$setC[3]['dato'] = $idmodelo;
$setC[4]['campo'] = 'cantidadpares';
$setC[4]['dato'] = $cantidadpares;
$setC[5]['campo'] = 'precioanterior';
$setC[5]['dato'] = $precioanterior;
$setC[6]['campo'] = 'totalbs';
$setC[6]['dato'] = $totalbs;
$setC[7]['campo'] = 'precionuevo';
$setC[7]['dato'] = $precionuevo;
$setC[8]['campo'] = 'totalbsnuevo';
$setC[8]['dato'] = $totalbsnuevo;
$setC[9]['campo'] = 'diferencia';
$setC[9]['dato'] = $diferencia;
$setC[10]['campo'] = 'numero';
$setC[10]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO cambiopreciodetalle ".$sql2;
}
function getSqlNewUnionpreciodetalle($idcambiodetalle, $idunion, $iddetalleingreso, $idmodelo, $cantidadpares, $precioanterior, $totalbs, $precionuevo, $totalbsnuevo, $diferencia, $numero, $return){
$setC[0]['campo'] = 'idcambiodetalle';
$setC[0]['dato'] = $idcambiodetalle;
$setC[1]['campo'] = 'idunion';
$setC[1]['dato'] = $idunion;
$setC[2]['campo'] = 'iddetalleingreso';
$setC[2]['dato'] = $iddetalleingreso;
$setC[3]['campo'] = 'idmodelo';
$setC[3]['dato'] = $idmodelo;
$setC[4]['campo'] = 'cantidadpares';
$setC[4]['dato'] = $cantidadpares;
$setC[5]['campo'] = 'precioanterior';
$setC[5]['dato'] = $precioanterior;
$setC[6]['campo'] = 'totalbs';
$setC[6]['dato'] = $totalbs;
$setC[7]['campo'] = 'precionuevo';
$setC[7]['dato'] = $precionuevo;
$setC[8]['campo'] = 'totalbsnuevo';
$setC[8]['dato'] = $totalbsnuevo;
$setC[9]['campo'] = 'diferencia';
$setC[9]['dato'] = $diferencia;
$setC[10]['campo'] = 'numero';
$setC[10]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO unionpreciodetalle ".$sql2;
}
function getSqlNewUnionprecio($idunion, $idmarca, $idtienda, $fecha, $hora, $cantidadpares, $montoanterior, $montonuevo, $diferencia, $concepto, $return){
$setC[0]['campo'] = 'idunion';
$setC[0]['dato'] = $idunion;
$setC[1]['campo'] = 'idmarca';
$setC[1]['dato'] = $idmarca;
$setC[2]['campo'] = 'idtienda';
$setC[2]['dato'] = $idtienda;
$setC[3]['campo'] = 'fecha';
$setC[3]['dato'] = $fecha;
$setC[4]['campo'] = 'hora';
$setC[4]['dato'] = $hora;
$setC[5]['campo'] = 'cantidadpares';
$setC[5]['dato'] = $cantidadpares;
$setC[6]['campo'] = 'montoanterior';
$setC[6]['dato'] = $montoanterior;
$setC[7]['campo'] = 'montonuevo';
$setC[7]['dato'] = $montonuevo;
$setC[8]['campo'] = 'diferencia';
$setC[8]['dato'] = $diferencia;
$setC[9]['campo'] = 'concepto';
$setC[9]['dato'] = $concepto;
$sql2 = generarInsertValues($setC);
return "INSERT INTO unionprecio ".$sql2;
}
//nuevomayor
function getSqlNewModelo($idmodelo, $idmodelodetalle, $idmarca, $idvendedor, $codigo, $color, $material, $linea, $cliente, $numero, $idingreso, $fecha, $hora, $generado, $opciont, $unido, $inventario, $rebaja, $estado, $idcoleccion, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $modificar, $talla, $idalmacen, $estadotraspaso, $fechaingreso, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'idmodelodetalle';
$setC[1]['dato'] = $idmodelodetalle;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'idvendedor';
$setC[3]['dato'] = $idvendedor;
$setC[4]['campo'] = 'codigo';
$setC[4]['dato'] = $codigo;
$setC[5]['campo'] = 'color';
$setC[5]['dato'] = $color;
$setC[6]['campo'] = 'material';
$setC[6]['dato'] = $material;
$setC[7]['campo'] = 'linea';
$setC[7]['dato'] = $linea;
$setC[8]['campo'] = 'cliente';
$setC[8]['dato'] = $cliente;
$setC[9]['campo'] = 'numero';
$setC[9]['dato'] = $numero;
$setC[10]['campo'] = 'idingreso';
$setC[10]['dato'] = $idingreso;
$setC[11]['campo'] = 'fecha';
$setC[11]['dato'] = $fecha;
$setC[12]['campo'] = 'hora';
$setC[12]['dato'] = $hora;
$setC[13]['campo'] = 'generado';
$setC[13]['dato'] = $generado;
$setC[14]['campo'] = 'opciont';
$setC[14]['dato'] = $opciont;
$setC[15]['campo'] = 'unido';
$setC[15]['dato'] = $unido;
$setC[16]['campo'] = 'inventario';
$setC[16]['dato'] = $inventario;
$setC[17]['campo'] = 'rebaja';
$setC[17]['dato'] = $rebaja;
$setC[18]['campo'] = 'estado';
$setC[18]['dato'] = $estado;
$setC[19]['campo'] = 'idcoleccion';
$setC[19]['dato'] = $idcoleccion;
$setC[20]['campo'] = 'idcliente';
$setC[20]['dato'] = $idcliente;
$setC[21]['campo'] = 'precioventa';
$setC[21]['dato'] = $precioventa;
$setC[22]['campo'] = 'preciounitario';
$setC[22]['dato'] = $preciounitario;
$setC[23]['campo'] = 'preciototalcaja';
$setC[23]['dato'] = $preciototalcaja;
$setC[24]['campo'] = 'numerocajas';
$setC[24]['dato'] = $numerocajas;
$setC[25]['campo'] = 'numeroparesfila';
$setC[25]['dato'] = $numeroparesfila;
$setC[26]['campo'] = 'totalparescaja';
$setC[26]['dato'] = $totalparescaja;
$setC[27]['campo'] = 'numeracion';
$setC[27]['dato'] = $numeracion;
$setC[28]['campo'] = 'modificar';
$setC[28]['dato'] = $modificar;
$setC[29]['campo'] = 'talla';
$setC[29]['dato'] = $talla;
$setC[30]['campo'] = 'idalmacen';
$setC[30]['dato'] = $idalmacen;
$setC[31]['campo'] = 'estadotraspaso';
$setC[31]['dato'] = $estadotraspaso;
$setC[32]['campo'] = 'fechaingreso';
$setC[32]['dato'] = $fechaingreso;
$sql2 = generarInsertValues($setC);
return "INSERT INTO modelo ".$sql2;
}



function getSqlNewKardexcajas($idkardexunico, $idkardex, $idmodelo, $idtienda, $codigobarra, $saldocantidad, $numero, $numeroparesfila, $totalparescaja, $numerocajas, $precioventa, $preciounitario, $preciototalcaja, $idingresoetalle, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $cantidadlector, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'idkardex';
$setC[1]['dato'] = $idkardex;
$setC[2]['campo'] = 'idmodelo';
$setC[2]['dato'] = $idmodelo;
$setC[3]['campo'] = 'idtienda';
$setC[3]['dato'] = $idtienda;
$setC[4]['campo'] = 'codigobarra';
$setC[4]['dato'] = $codigobarra;
$setC[5]['campo'] = 'saldocantidad';
$setC[5]['dato'] = $saldocantidad;
$setC[6]['campo'] = 'numero';
$setC[6]['dato'] = $numero;
$setC[7]['campo'] = 'numeroparesfila';
$setC[7]['dato'] = $numeroparesfila;
$setC[8]['campo'] = 'totalparescaja';
$setC[8]['dato'] = $totalparescaja;
$setC[9]['campo'] = 'numerocajas';
$setC[9]['dato'] = $numerocajas;
$setC[10]['campo'] = 'precioventa';
$setC[10]['dato'] = $precioventa;
$setC[11]['campo'] = 'preciounitario';
$setC[11]['dato'] = $preciounitario;
$setC[12]['campo'] = 'preciototalcaja';
$setC[12]['dato'] = $preciototalcaja;
$setC[13]['campo'] = 'idingresoetalle';
$setC[13]['dato'] = $idingresoetalle;
$setC[14]['campo'] = 'idoperacion';
$setC[14]['dato'] = $idoperacion;
$setC[15]['campo'] = 'codigobarraean13';
$setC[15]['dato'] = $codigobarraean13;
$setC[16]['campo'] = 'generado';
$setC[16]['dato'] = $generado;
$setC[17]['campo'] = 'unido';
$setC[17]['dato'] = $unido;
$setC[18]['campo'] = 'fallado';
$setC[18]['dato'] = $fallado;
$setC[19]['campo'] = 'idperiodo';
$setC[19]['dato'] = $idperiodo;
$setC[20]['campo'] = 'cantidadlector';
$setC[20]['dato'] = $cantidadlector;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexcajas ".$sql2;
}
//$sql[]= getSqlNewKardexdetalle($iddetalle, $idmodelo, $idkardex, $cantidad1, $cantidad1*$numerocajas, $tallakardex, $idingreso, $idadicional, $preciounitario,$idkardexdetalle,$numerokardexdetalle,false);

function getSqlNewKardexdetalle($iddetalle, $idmodelo, $idkardex, $cantidad, $cantidadcaja, $tallakardex, $idingreso, $idadicional, $preciounitario, $idkardexdetalle,$numero,$return){

$setC[0]['campo'] = 'iddetalle';
$setC[0]['dato'] = $iddetalle;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'idkardex';
$setC[2]['dato'] = $idkardex;
$setC[3]['campo'] = 'cantidad';
$setC[3]['dato'] = $cantidad;
$setC[4]['campo'] = 'cantidadcaja';
$setC[4]['dato'] = $cantidadcaja;
$setC[5]['campo'] = 'tallakardex';
$setC[5]['dato'] = $tallakardex;
$setC[6]['campo'] = 'idingreso';
$setC[6]['dato'] = $idingreso;
$setC[7]['campo'] = 'idadicional';
$setC[7]['dato'] = $idadicional;
$setC[8]['campo'] = 'preciounitario';
$setC[8]['dato'] = $preciounitario;
$setC[9]['campo'] = 'idkardexdetalle';
$setC[9]['dato'] = $idkardexdetalle;
$setC[10]['campo'] = 'numero';
$setC[10]['dato'] = $numero;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexdetalle ".$sql2;
}
function getSqlNewKardexdetalleingreso($iddetalle, $idmodelo, $idkardex, $cantidad, $cantidadcaja, $tallakardex, $idingreso, $idadicional, $preciounitario, $return){
$setC[0]['campo'] = 'iddetalle';
$setC[0]['dato'] = $iddetalle;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'idkardex';
$setC[2]['dato'] = $idkardex;
$setC[3]['campo'] = 'cantidad';
$setC[3]['dato'] = $cantidad;
$setC[4]['campo'] = 'cantidadcaja';
$setC[4]['dato'] = $cantidadcaja;
$setC[5]['campo'] = 'tallakardex';
$setC[5]['dato'] = $tallakardex;
$setC[6]['campo'] = 'idingreso';
$setC[6]['dato'] = $idingreso;
$setC[7]['campo'] = 'idadicional';
$setC[7]['dato'] = $idadicional;
$setC[8]['campo'] = 'preciounitario';
$setC[8]['dato'] = $preciounitario;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexdetalleingreso ".$sql2;
}

function getSqlNewKardexdetallepar($idkardexunico, $idkardex, $idkardexdetalle, $idmodelo, $idingreso, $codigobarra, $saldocantidad, $talla, $numero, $preciounitario, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $idimpresion, $idalmacen, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'idkardex';
$setC[1]['dato'] = $idkardex;
$setC[2]['campo'] = 'idkardexdetalle';
$setC[2]['dato'] = $idkardexdetalle;
$setC[3]['campo'] = 'idmodelo';
$setC[3]['dato'] = $idmodelo;
$setC[4]['campo'] = 'idingreso';
$setC[4]['dato'] = $idingreso;
$setC[5]['campo'] = 'codigobarra';
$setC[5]['dato'] = $codigobarra;
$setC[6]['campo'] = 'saldocantidad';
$setC[6]['dato'] = $saldocantidad;
$setC[7]['campo'] = 'talla';
$setC[7]['dato'] = $talla;
$setC[8]['campo'] = 'numero';
$setC[8]['dato'] = $numero;
$setC[9]['campo'] = 'preciounitario';
$setC[9]['dato'] = $preciounitario;
$setC[10]['campo'] = 'idoperacion';
$setC[10]['dato'] = $idoperacion;
$setC[11]['campo'] = 'codigobarraean13';
$setC[11]['dato'] = $codigobarraean13;
$setC[12]['campo'] = 'generado';
$setC[12]['dato'] = $generado;
$setC[13]['campo'] = 'unido';
$setC[13]['dato'] = $unido;
$setC[14]['campo'] = 'fallado';
$setC[14]['dato'] = $fallado;
$setC[15]['campo'] = 'idperiodo';
$setC[15]['dato'] = $idperiodo;
$setC[16]['campo'] = 'idimpresion';
$setC[16]['dato'] = $idimpresion;
$setC[17]['campo'] = 'idalmacen';
$setC[17]['dato'] = $idalmacen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexdetallepar ".$sql2;
}


function ListarAlmacenes($start, $limit, $sort, $dir, $callback, $_dc, $where, $return = false){

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
    SELECT * FROM almacenes 
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
function getSqlNewCodigonumeraciontalla($idcodigonumeracion, $talla, $idmarca, $codigobarra, $idmodelo, $return){
$setC[0]['campo'] = 'idcodigonumeracion';
$setC[0]['dato'] = $idcodigonumeracion;
$setC[1]['campo'] = 'talla';
$setC[1]['dato'] = $talla;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'codigobarra';
$setC[3]['dato'] = $codigobarra;
$setC[4]['campo'] = 'idmodelo';
$setC[4]['dato'] = $idmodelo;
$sql2 = generarInsertValues($setC);
return "INSERT INTO codigonumeraciontalla ".$sql2;
}
function getSqlNewHistorialkardex($idkardexunico, $saldocantidad, $preciounitario, $talla, $idalmacen, $idkardex, $idmarca, $ant, $rec, $trec, $tenv, $dev, $venta, $rebaja, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'saldocantidad';
$setC[1]['dato'] = $saldocantidad;
$setC[2]['campo'] = 'preciounitario';
$setC[2]['dato'] = $preciounitario;
$setC[3]['campo'] = 'talla';
$setC[3]['dato'] = $talla;
$setC[4]['campo'] = 'idalmacen';
$setC[4]['dato'] = $idalmacen;
$setC[5]['campo'] = 'idkardex';
$setC[5]['dato'] = $idkardex;
$setC[6]['campo'] = 'idmarca';
$setC[6]['dato'] = $idmarca;
$setC[7]['campo'] = 'ant';
$setC[7]['dato'] = $ant;
$setC[8]['campo'] = 'rec';
$setC[8]['dato'] = $rec;
$setC[9]['campo'] = 'trec';
$setC[9]['dato'] = $trec;
$setC[10]['campo'] = 'tenv';
$setC[10]['dato'] = $tenv;
$setC[11]['campo'] = 'dev';
$setC[11]['dato'] = $dev;
$setC[12]['campo'] = 'venta';
$setC[12]['dato'] = $venta;
$setC[13]['campo'] = 'rebaja';
$setC[13]['dato'] = $rebaja;
$sql2 = generarInsertValues($setC);
return "INSERT INTO historialkardex ".$sql2;
}
function getSqlNewAdministrakardex($idkardex, $estado, $numero, $fecharegistro, $hora, $fechainicio, $fechafin, $idalmacen, $idusuario, $tabla, $mesrango, $idperiodo, $mesanterior, $return){
$setC[0]['campo'] = 'idkardex';
$setC[0]['dato'] = $idkardex;
$setC[1]['campo'] = 'estado';
$setC[1]['dato'] = $estado;
$setC[2]['campo'] = 'numero';
$setC[2]['dato'] = $numero;
$setC[3]['campo'] = 'fecharegistro';
$setC[3]['dato'] = $fecharegistro;
$setC[4]['campo'] = 'hora';
$setC[4]['dato'] = $hora;
$setC[5]['campo'] = 'fechainicio';
$setC[5]['dato'] = $fechainicio;
$setC[6]['campo'] = 'fechafin';
$setC[6]['dato'] = $fechafin;
$setC[7]['campo'] = 'idalmacen';
$setC[7]['dato'] = $idalmacen;
$setC[8]['campo'] = 'idusuario';
$setC[8]['dato'] = $idusuario;
$setC[9]['campo'] = 'tabla';
$setC[9]['dato'] = $tabla;
$setC[10]['campo'] = 'mesrango';
$setC[10]['dato'] = $mesrango;
$setC[11]['campo'] = 'idperiodo';
$setC[11]['dato'] = $idperiodo;
$setC[12]['campo'] = 'mesanterior';
$setC[12]['dato'] = $mesanterior;
$sql2 = generarInsertValues($setC);
return "INSERT INTO administrakardex ".$sql2;
}

function getSqlNewKardexdetalleparingreso($idkardexunico, $idkardex, $idingreso, $saldocantidad, $talla, $preciounitario, $idalmacen, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'idkardex';
$setC[1]['dato'] = $idkardex;
$setC[2]['campo'] = 'idingreso';
$setC[2]['dato'] = $idingreso;
$setC[3]['campo'] = 'saldocantidad';
$setC[3]['dato'] = $saldocantidad;
$setC[4]['campo'] = 'talla';
$setC[4]['dato'] = $talla;
$setC[5]['campo'] = 'preciounitario';
$setC[5]['dato'] = $preciounitario;
$setC[6]['campo'] = 'idalmacen';
$setC[6]['dato'] = $idalmacen;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexdetalleparingreso ".$sql2;
}
function getSqlNewUnionmodelo($idnumeracion, $idmodelo, $numero, $idmodelounido, $return){
$setC[0]['campo'] = 'idnumeracion';
$setC[0]['dato'] = $idnumeracion;
$setC[1]['campo'] = 'idmodelo';
$setC[1]['dato'] = $idmodelo;
$setC[2]['campo'] = 'numero';
$setC[2]['dato'] = $numero;
$setC[3]['campo'] = 'idmodelounido';
$setC[3]['dato'] = $idmodelounido;
$sql2 = generarInsertValues($setC);
return "INSERT INTO unionmodelo ".$sql2;
}
function getSqlNewKardexresumen($idmodelo, $pares, $idvendedor, $idmarca, $idalmacen, $mes, $preciototal, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'pares';
$setC[1]['dato'] = $pares;
$setC[2]['campo'] = 'idvendedor';
$setC[2]['dato'] = $idvendedor;
$setC[3]['campo'] = 'idmarca';
$setC[3]['dato'] = $idmarca;
$setC[4]['campo'] = 'idalmacen';
$setC[4]['dato'] = $idalmacen;
$setC[5]['campo'] = 'mes';
$setC[5]['dato'] = $mes;
$setC[6]['campo'] = 'preciototal';
$setC[6]['dato'] = $preciototal;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexresumen ".$sql2;
}

?>