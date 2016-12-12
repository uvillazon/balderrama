<?php
function ListarColecciones($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  col.idcoleccion,
  col.anio,
  col.codigo,
  col.estado,
  mar.codigobarra,
  col.detalle,
  col.idmarca,
  mar.nombre AS marca
FROM
  `coleccion` col,
  `marcas` mar
WHERE
  col.idmarca = mar.idmarca ORDER BY `col`.`anio` DESC LIMIT $start,$limit

";
    }else {
        $sql ="
SELECT
  col.idcoleccion,
  col.anio,
  col.codigo,
  col.estado,
  mar.codigobarra,
  col.detalle,
 col.idmarca,
  mar.nombre AS marca
FROM
  `coleccion` col,
  `marcas` mar
WHERE
  col.idmarca = mar.idmarca AND $where $order LIMIT $start,$limit

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


function ListarColeccionesPorMarca($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
  col.idcoleccion,
  col.anio,
  col.detalle,
  col.numero,
  col.codigo,
  col.idmarca,
  col.estado,
  col.codigobarra,
  col.codigobarra1
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' $order LIMIT $start,$limit
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
function ListarColeccionesPorMarcaSimple($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
  col.idcoleccion,
  col.codigo AS nombre
FROM
  `coleccion` col
WHERE
  col.idmarca = '$idmarca' $order LIMIT $start,$limit
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

function ListarColeccionesEmergente($start, $limit, $sort, $dir, $callback, $_dc, $idmarca, $return = false){

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
  col.idcoleccion,
  col.codigo,
  col.idmarca
FROM
  `coleccion` col $order LIMIT $start,$limit
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


function BuscarMarcaAnio($callback, $_dc, $where = '', $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $proveedores =  ListarAnio('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['anios'] = "true";
        $value['anioM'] = $proveedores['resultado'];
    }
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
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


function BuscarMarcaAnioPorId($idcolecion,$return){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $proveedores =  ListarAnio('', '', '', '', '', '',"",true);
    if($proveedores['error'] == true)
    {
        $value['anios'] = "true";
        $value['anioM'] = $proveedores['resultado'];
    }
    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }


    $sql ="
SELECT
  col.idcoleccion,
  col.anio,
  col.detalle,
  col.numero,
  col.codigo ,
  col.idmarca,
  col.estado,
  col.codigobarra,
  col.codigobarra1
FROM
  `coleccion` col
WHERE
  col.idcoleccion = '$idcolecion'
";
       $detalleA = findBySqlReturnCampoUnique($sql, true, true, "codigo");
       $codigos =  $detalleA['resultado'];
        $planillaanterior= split("-",$codigos);
 //$idsCAr = split("/", $mesplanilla);
$mesplani=$planillaanterior[0];
$anioplani=$planillaanterior[1];
 $value['codigo'] = $mesplani;
       $detalleA1 = findBySqlReturnCampoUnique($sql, true, true, "idcoleccion");
       $value['idcoleccion']  =  $detalleA1['resultado'];
 $detalleA11 = findBySqlReturnCampoUnique($sql, true, true, "anio");
       $value['anio']  =  $detalleA11['resultado'];
 $detalleA12 = findBySqlReturnCampoUnique($sql, true, true, "detalle");
       $value['detalle']  =  $detalleA12['resultado'];
 $detalleA13 = findBySqlReturnCampoUnique($sql, true, true, "idmarca");
       $value['idmarca']  =  $detalleA13['resultado'];
 $detalleA14 = findBySqlReturnCampoUnique($sql, true, true, "estado");
       $value['estado']  =  $detalleA14['resultado'];
 $detalleA15 = findBySqlReturnCampoUnique($sql, true, true, "codigobarra");
       $value['codigobarra']  =  $detalleA15['resultado'];

    //    MostrarConsulta($sql);
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
function getSqlUpdateColeccion($idcoleccion,$anio,$detalle, $numero, $codigo, $idmarca, $estado, $codigobarra, $codigobarra1, $return){
    $setC[0]['campo'] = 'anio';
    $setC[0]['dato'] = $anio;
    $setC[1]['campo'] = 'detalle';
    $setC[1]['dato'] = $detalle;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $setC[4]['campo'] = 'estado';
    $setC[4]['dato'] = $estado;
    $setC[5]['campo'] = 'codigobarra';
    $setC[5]['dato'] = $codigobarra;
    $setC[6]['campo'] = 'codigobarra1';
    $setC[6]['dato'] = $codigobarra1;
    $wher[7]['campo'] = 'idmarca';
    $wher[7]['dato'] = $idmarca;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idcoleccion';
    $wher[0]['dato'] = $idcoleccion;


    $where = generarWhereUpdate($wher);
    return "UPDATE coleccion SET ".$set." WHERE ".$where;
}

function GuardarEditarColeccion()
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo de Material: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idcoleccion = $_GET['idcoleccion'];
    //    echo "gsdg".$idmateria;
    $coleccion = $_GET['nombre'];
    $codigo=$_GET['codigo'];
    $detalle = $_GET['detalle'];
    $anio=$_GET['anio'];
     $estado = $_GET['estado'];
//     $COLECCION=verificarValidarText($idcoleccion, true, "modelos", "idcoleccion");
//    if($COLECCION['error'] ==true )
//    {
//        $dev['mensaje'] = "No es posible editar la coleccion/ya fue utilizada en un modelo";
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
//    else
//    {

     $codigo1 = $codigo."-".$anio;
   //  function verificarValidarTextWithCondition($dato, $existe, $tabla, $campo,$idvalor,$valor){
   // $sql = "SELECT $campo FROM $tabla WHERE $campo = '$dato' AND $idvalor = '$valor'";
   //    $nombre2 = verificarValidarTextWithCondition($nombre, false, "colores", "nombre","idmarca",$idmarca);ojo
 $sql1 ="
SELECT
  col.idmarca,col.estado
FROM
  coleccion col
WHERE
  col.idcoleccion = '$idcoleccion'
";
    $codigobarraA = findBySqlReturnCampoUnique($sql1, true, true, 'idmarca');
    $idmarca= $codigobarraA['resultado'];
    $codigobarraA2 = findBySqlReturnCampoUnique($sql1, true, true, 'estado');
    $estadoactual= $codigobarraA2['resultado'];
 //  $COLECCION1=verificarValidarTextWithConditionDoble("VIGENTE", false, "coleccion","estado","idmarca",$idmarca,"idcoleccion",$idcoleccion);
  $sql2 ="
SELECT
  col.estado,col.idcoleccion
FROM
  coleccion col
WHERE
  col.estado = 'VIGENTE' AND col.idmarca='$idmarca'
";
    $codigobarraA1 = findBySqlReturnCampoUnique($sql2, true, true, 'estado');
    $estadocol= $codigobarraA1['resultado'];
    $codigobarraA15 = findBySqlReturnCampoUnique($sql2, true, true, 'idcoleccion');
    $idcoleccionvigente= $codigobarraA15['resultado'];
      $COLECCION1=verificarValidarTextWithCondition("VIGENTE", true, "coleccion","estado","idmarca",$idmarca);

if($COLECCION1['error'] ==true )
    {
        if($idcoleccion == $idcoleccionvigente)
        {
               $sql[] = getSqlUpdateColeccion($idcoleccion,$anio,$detalle, $numero, $codigo1, $idmarca, $estado, $codigobarra, $codigobarra1, $return);

        }else{

        $dev['mensaje'] = "Existe una coleccion vigente. cambiela a pasado antes de modificar";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
        }
    }
    else {
  //      $numerob=$codigobarraA['resultado'] + 1;
      $sql[] = getSqlUpdateColeccion($idcoleccion,$anio,$detalle, $numero, $codigo1, $idmarca, $estado, $codigobarra, $codigobarra1, $return);


    }

  //  $sql[] = getSqlUpdateColeccion($idcoleccion,$anio,$detalle, $numero, $codigo1, $idmarca, $estado, $codigobarra, $codigobarra1, $return);
     //   MostrarConsulta($sql);
  //  }
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



function InsertarNuevoColeccion(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $anio = $_GET['anio'];
    $anoA =  validarText($anio, true);
    if($anoA['error']==false){
        $dev['mensaje'] = "Error en el Anio: ".$anoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoB = TamanoPermitido($codigo, "6");
    if($codigoB == false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoB['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigo1 = $codigo."-".$anio;

  $detalle = $_GET['detalle'];

    $idmarca = $_GET['idmarca'];
    
   $COLECCION=verificarValidarTextWithCondition($codigo1, true, "coleccion", "codigo","idmarca",$idmarca);

   //$COLECCION=verificarValidarText($codigo1, true, "coleccion", "codigo");
    if($COLECCION['error'] ==true )
    {
        $dev['mensaje'] = "El codigo de coleccion /anio ya existe. modifiquelo por favor";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

        else{


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
    $estado = "VIGENTE";
    $sql[] = "UPDATE coleccion SET estado = 'PASADO' WHERE idmarca = '$idmarca';";


    $idcoleccion = 'col-'.$numero;
  //    $estado = $_GET['estado'];
    $sql[] = getSqlNewColeccion($idcoleccion, $anio, $detalle, $numero, $codigo1, $idmarca, $estado, $codigobarra, $numerob, $return);
}
//            MostrarConsulta($sql);
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


function BuscarModeloPorIdColeccion($idcolecion,$callback, $_dc, $return= 'true')
{

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $sql ="
SELECT
  md.idmodelo,
  CONCAT(md.codigo, ' - ', md.color, ' - ', md.material, ' - ', md.linea) AS codigo,
  md.precio AS precio1,
  0 AS precio2
FROM
  modelos md
WHERE
  md.idcoleccion = '$idcolecion'

";
       // MostrarConsulta($sql);
    if($idcolecion != null)
    {
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


function EliminarColeccion($idcoleccion,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
 $sql1 ="
 SELECT MAX( col.numero ) AS numero FROM
  coleccion col
WHERE
  col.idcoleccion = '$idcoleccion'
";
    $codigobarraA = findBySqlReturnCampoUnique($sql1, true, true, 'numero');
    $numero= $codigobarraA['resultado'];
   // echo $sql1;
     $sql3 ="
SELECT
  col.estado,col.idmarca FROM
  coleccion col
WHERE
  col.idcoleccion = '$idcoleccion' AND col.numero='$numero'
";
    $codigobarraA = findBySqlReturnCampoUnique($sql3, true, true, 'estado');
    $estado= $codigobarraA['resultado'];
      $codigobarraA1 = findBySqlReturnCampoUnique($sql3, true, true, 'idmarca');
    $idmarca= $codigobarraA1['resultado'];
    //echo $estado;
    $COLECCION=verificarValidarText($idcoleccion, true, "modelos", "idcoleccion");
    if($COLECCION['error'] ==true )
    {
        $dev['mensaje'] = "No es posible eliminar la coleccion/ya fue utilizada en un modelo";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else
    {
    if($estado == 'VIGENTE'){

    $sql2="SELECT MAX( col.numero ) AS numero
FROM coleccion col
WHERE col.idmarca = '$idmarca'
AND col.estado = 'PASADO'";
  $codigobarraA = findBySqlReturnCampoUnique($sql2, true, true, 'numero');
    $numero= $codigobarraA['resultado'];
//     $sql[] = "UPDATE coleccion SET estado = 'PASADO' WHERE idmarca = '$idmarca';";

    $sql[] = "UPDATE coleccion SET  estado= 'VIGENTE'WHERE idmarca='$idmarca' AND estado='PASADO' AND numero='$numero'";

 //  $dev['mensaje'] = "Al eliminar la coleccion vigente/la coleccion pasada pasara a vigente2";
$mensaje= "Al eliminar la coleccion vigente/la coleccion pasada pasara a vigente";
$sql[] = getSqlDeleteColeccion($idcoleccion);

      }
        else
        {
         $sql[] = getSqlDeleteColeccion($idcoleccion);

        }

    }


  

                  //      MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Eliminado-".$mensaje;
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar";
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
function GuardarListaDePrecios($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $modelos =  $resultado->modelos;
    //                      MostrarConsulta($sql);
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
function getSqlDeleteColeccion($idcoleccion){
    return "DELETE FROM coleccion WHERE idcoleccion = '$idcoleccion'";
}


?>