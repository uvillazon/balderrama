<?php
function ListarModelo($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
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
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ma.nombre AS marca
FROM
  `modelos` mo,
  `marcas` ma,
  `coleccion` co,
  `lineas` li
WHERE
  mo.idmarca = ma.idmarca AND
  mo.idlinea = li.idlinea AND
  mo.idcoleccion = co.idcoleccion ORDER BY `co`.`anio` , `mo`.`codigo` DESC LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
      SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ma.nombre AS marca
FROM
  `modelos` mo,
  `marcas` ma,
  `coleccion` co,
  `lineas` li
WHERE
  mo.idmarca = ma.idmarca AND
  mo.idlinea = li.idlinea AND
  mo.idcoleccion = co.idcoleccion AND $where $order  LIMIT $start,$limit
         ";
      //         MostrarConsulta($sql);
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
function  BuscarLineaColeccionMarca($idmarca,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    //    echo $idmarca;

    $proveedores =  ListarColeccionesPorMarca('', '', 'estado', 'DESC', '', '',$idmarca,true);
    if($proveedores['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $proveedores['resultado'];
    }
    $categorias = ListarLineaPorMarca('', '', '', '', '', '',$idmarca,true);
    if($categorias['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $categorias['resultado'];
    }

    $sql ="
SELECT mar.nombre AS marca, mar.codigo AS codigomarca, mar.idmarca, col.idcoleccion, l.idlinea
FROM marcas mar, `coleccion` col, `lineas` l
WHERE mar.idmarca = '$idmarca'
AND mar.idmarca = l.idmarca
AND col.idcoleccion = l.idcoleccion
AND mar.idmarca = col.idmarca
AND col.estado = 'VIGENTE'
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

function  BuscarMarcaColeccionLinea($return=false){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    //    echo $idmarca;

    $marcas = ListarMarcas('', '', '', '', '', '','',true);
    if($marcas['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marcas['resultado'];
    }

    $proveedores =  ListarColecciones('', '', 'estado', 'DESC', '', '','',true);
    if($proveedores['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $proveedores['resultado'];
    }
    $categorias = ListarTodasLinea('', '', '', '', '', '','',true);
    if($categorias['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $categorias['resultado'];
    }


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

function  BuscarLineaColeccionMarcaPorId($idmodelo,$return=false){

    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    //    echo $idmarca;


    $marcas = ListarMarcas('', '', '', '', '', '','',true);
    if($marcas['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marcas['resultado'];
    }

    $proveedores =  ListarColecciones('', '', 'estado', 'DESC', '', '','',true);
    if($proveedores['error'] == true)
    {
        $value['colecciones'] = "true";
        $value['coleccionM'] = $proveedores['resultado'];
    }
    $categorias = ListarTodasLinea('', '', '', '', '', '','',true);
    if($categorias['error'] == true)
    {
        $value['lineas'] = "true";
        $value['lineaM'] = $categorias['resultado'];
    }

    $sql ="
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  ma.nombre AS marca,
  ma.codigobarra
FROM
  modelos mo,
  marcas ma
WHERE
  mo.idmarca = ma.idmarca AND
  mo.idmodelo = '$idmodelo'
";
    //echo $sql;
    if($idmodelo != null)
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

function getSqlNewModelos($idmodelo, $idmarca, $codigo, $numero, $precio, $stylename, $idcoleccion, $idlinea, $detalle, $imagen, $opciont,$return){
    $setC[0]['campo'] = 'idmodelo';
    $setC[0]['dato'] = $idmodelo;
    $setC[1]['campo'] = 'idmarca';
    $setC[1]['dato'] = $idmarca;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'numero';
    $setC[3]['dato'] = $numero;
    $setC[4]['campo'] = 'precio';
    $setC[4]['dato'] = $precio;
    $setC[5]['campo'] = 'stylename';
    $setC[5]['dato'] = $stylename;
    $setC[6]['campo'] = 'idcoleccion';
    $setC[6]['dato'] = $idcoleccion;
    $setC[7]['campo'] = 'idlinea';
    $setC[7]['dato'] = $idlinea;
    $setC[8]['campo'] = 'detalle';
    $setC[8]['dato'] = $detalle;
    $setC[9]['campo'] = 'imagen';
    $setC[9]['dato'] = $imagen;
    $setC[10]['campo'] = 'opciont';
    $setC[10]['dato'] = $opciont;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO modelos ".$sql2;
}
function getSqlUpdateModelos($idmodelo,$idmarca,$codigo,$numero, $precio, $stylename, $idcoleccion, $idlinea, $detalle, $imagen, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'numero';
    $setC[1]['dato'] = $numero;
    $setC[2]['campo'] = 'precio';
    $setC[2]['dato'] = $precio;
    $setC[3]['campo'] = 'stylename';
    $setC[3]['dato'] = $stylename;
    $setC[4]['campo'] = 'detalle';
    $setC[4]['dato'] = $detalle;
    $setC[5]['campo'] = 'imagen';
    $setC[5]['dato'] = $imagen;
    $setC[6]['campo'] = 'idmarca';
    $setC[6]['dato'] = $idmarca;
    $setC[7]['campo'] = 'idcoleccion';
    $setC[7]['dato'] = $idcoleccion;
    $setC[8]['campo'] = 'idlinea';
    $setC[8]['dato'] = $idlinea;


    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idmodelo';
    $wher[0]['dato'] = $idmodelo;

    $where = generarWhereUpdate($wher);
    return "UPDATE modelos SET ".$set." WHERE ".$where;
}


function GuardarNuevoModelo(){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $codigo = strtoupper($_GET['modelo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el modelo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
     $idmarca = $_GET['idmarca'];
    $stylename = strtoupper($_GET['stylename']);
    $idcoleccion = $_GET['idcoleccion'];

    $idcoleccionA = validarText($idcoleccion, true);
    if($idcoleccionA['error']==false){
        $dev['mensaje'] = "Error el campo coleccion ".$idcoleccionA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idlinea = $_GET['idlinea'];

    $idlineaA = validarText($idlinea, true);
    if($idlineaA['error']==false){
        $dev['mensaje'] = "Error el campo linea ".$idlineaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
      $codigo2 = TamanoPermitido($codigo, 10);
    if($codigo2['error']==false){
        $dev['mensaje'] = "Error en el modelo: ".$codigo2['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $detalle = strtoupper($_GET['descripcion']);
    $imagen = $_GET['imagen'];
    $numeroA = findUltimoID("modelos", "numero", true);
    $numero = $numeroA['resultado'] + 1;
    $idmodelo = "mod-".$numero;

//
//    $codigo1 = verificarValidarText($codigo, false, "modelos", "codigo");
//    if($codigo1['error']==false){
//        $dev['mensaje'] = "Error en el modelo: ".$codigo1['mensaje'];
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
$codigobb = verificarValidarText($codigo, false, "modelos", "codigo");
   if ($codigobb['error']==false){
        $sqlmarca = "
SELECT
   mo.idmodelo,
  mo.codigo,
  mo.idcoleccion,
  mo.idlinea,
mo.idmarca,mo.idcoleccion,mo.idlinea,
  li.codigo AS linea,
  co.codigo AS coleccion,co.anio,
  ma.nombre AS marca
FROM
  `modelos` mo,
  `marcas` ma,
  `coleccion` co,
  `lineas` li
WHERE mo.idmarca = ma.idmarca AND
  mo.idlinea = li.idlinea AND
  mo.idcoleccion = co.idcoleccion AND
  mo.codigo = '$codigo'
";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idcoleccion");
   $idcoleccioncod = $opcionA['resultado'];
        //function verificarValidarTextWithConditionDoble($dato, $existe, $tabla, $campo,$idvalor,$valor,$idvalor1,$valor1)
 //           $sql = "SELECT $campo FROM $tabla WHERE $campo = '$dato' AND $idvalor = '$valor'AND $idvalor1 = '$valor1'";
   $codigoB = verificarValidarTextWithCondition($idcoleccion, false, "modelos", "idcoleccion","codigo",$codigo);

//        $codigoB = verificarValidarTextWithConditionDoble($idcoleccion, false, "modelos", "idcoleccion","codigo",$codigo,"idlinea","$idlinea");

        if($codigoB['error']==false){

        $dev['mensaje'] = "Error en el codigo: ".$codigoB['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
              }
   else{
}
   }
    $sql[] = getSqlNewModelos($idmodelo, $idmarca, $codigo, $numero, $precio, $stylename, $idcoleccion, $idlinea, $detalle,$imagen,$opciont, false);


  


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
function GuardarEditarModelo($idmodelo){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    $codigo = strtoupper($_GET['modelo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el modelo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idmarca = $_GET['idmarca'];
    $codigo1 = verificarValidarTextUnicoEdit("idmodelo", $idmodelo, true, "modelos", "codigo", $codigo);
    if($codigo1['error']==false){
        $dev['mensaje'] = "Error en el modelo: ".$codigo1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    $stylename = strtoupper($_GET['stylename']);
    $idcoleccion = $_GET['idcoleccion'];
    $idcoleccionA = validarText($idcoleccion, true);
    if($idcoleccionA['error']==false){
        $dev['mensaje'] = "Error el campo coleccion ".$idcoleccionA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idlinea = $_GET['idlinea'];

    $idlineaA = validarText($idlinea, true);
    if($idlineaA['error']==false){
        $dev['mensaje'] = "Error el campo linea ".$idlineaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $detalle = strtoupper($_GET['descripcion']);
    $imagen = $_GET['imagen'];

    //             getSqlNewModelos($idmodelo, $idmarca, $codigo, $numero, $precio, $stylename, $idcoleccion, $idlinea, $detalle,$imagen, false);

    $sql[] = getSqlUpdateModelos($idmodelo,$idmarca,$codigo,$numero, $precio, $stylename, $idcoleccion, $idlinea, $detalle, $imagen, $return);



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


function buscarModeloporId($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

     $sqlmarca = "
SELECT
  mad.idmarca
FROM
  `marcas` mad,modelos mo
WHERE
 mo.idmarca=mad.idmarca AND mo.idmodelo = '$codigo'
";
//echo $sqlmarca;
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idmarca");
   $idmarca = $opcionA['resultado'];
  $marca='mar-2';
   if ($idmarca==$marca){

       $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  CONCAT(mo.codigo,' - ',dtp.material) AS codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea
FROM
  `modelos` mo,adiciondetalleingreso dtp,
  `lineas` li
WHERE
 dtp.idmodelo = mo.idmodelo AND mo.idlinea = li.idlinea AND
  mo.idmodelo= '$codigo';
";
  //      echo $sql;
   }else{
      $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea
FROM
  `modelos` mo,
  `lineas` li
WHERE
  mo.idlinea = li.idlinea AND
  mo.idmodelo = '$codigo';
";
   }



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

function buscarModeloporIdtienda($codigo, $idestilo,$idmarca,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

  if($idestilo == null || $idestilo == "")
    {
      $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,0 AS precio,
  li.codigo AS linea,
co.codigo AS coleccion
FROM
  `modelos` mo,
  `lineas` li,`coleccion` co
WHERE
  mo.idlinea = li.idlinea AND mo.idcoleccion = co.idcoleccion AND
  mo.idmodelo = '$codigo';
";
    } else {
        if($idmarca=="mar-2"){
        $sql = "
SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, mo.stylename, ad.totalbs AS precio, ad.material AS color, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, 0 AS linea, co.codigo AS coleccion
FROM `modelos` mo, adiciondetalleingreso ad, `coleccion` co
WHERE mo.idcoleccion = co.idcoleccion
AND ad.idmodelo = mo.idmodelo AND
  ad.iddetalleingreso = '$codigo';
";
    }else{
        $sql = "
SELECT mo.idmodelo, mo.idmarca, mo.codigo, mo.numero, mo.precio, mo.stylename, ad.totalbs AS precio, ad.color, mo.idcoleccion, mo.idlinea, mo.detalle, mo.imagen, 0 AS linea, co.codigo AS coleccion
FROM `modelos` mo, adiciondetalleingreso ad, `coleccion` co
WHERE mo.idcoleccion = co.idcoleccion
AND ad.idmodelo = mo.idmodelo AND
  ad.iddetalleingreso = '$codigo';
";
    }
          
    }
  //  echo $sql;
$dev['mensaje'] = $mensajeproducto;


//echo $sql;
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


                        $dev['mensaje'] = "ya existe";
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
$dev['mensaje'] = "ya existe";

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

function buscarModeloUnion($idmodelo, $opcionmarca,$idmarca,$callback, $_dc, $return= 'true'){
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

 $select ="mo.idmodelo, mo.idmarca, mo.codigo ,dtp.iddetalleingreso,0 AS linea ,1 AS opciont, mo.numero, co.codigo AS coleccion,dtp.color,dtp.material, dtp.totalbs AS precio, dtp.totalpares, 1 AS totalcajas,0 AS totalbs";
    $from = "`modelos` mo, `coleccion` co,`adiciondetalleingreso` dtp";
    $where = "mo.idmodelo=dtp.idmodelo AND mo.idcoleccion = co.idcoleccion AND mo.idmarca = '$idmarca' AND mo.idmodelo ='$idmodelo'";
// if($opcion == "10" || $opcion == "11"|| $opcion == "12")
  //  {
      //  $where .= " AND pc.no_planilla ='$planilla' ";
   //     $select .= " ,0 AS '1', 0 AS '1m', 0 AS '2', 0 AS '2m', 0 AS '3', 0 AS '3m', 0 AS '4', 0 AS '4m', 0 AS '5', 0 AS '5m', 0 AS '6', 0 AS '6m', 0 AS '7',0 AS '7m',0 AS '8',0 AS '8m',0 AS '9',0 AS '9m',0 AS '10',0 AS '10m',0 AS '11',0 AS '11m',0 AS '12', 1 AS totalcajas, 0 AS totalpares ";
   // }
    //    echo $sql;
        $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
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

function buscarModeloporCodigo($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "
SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea
FROM
  `modelos` mo,
  `lineas` li
WHERE
  mo.idlinea = li.idlinea AND
  mo.codigo = '$codigo';
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
function getSqlDeleteModelo($idmarca){
    return "DELETE FROM modelos WHERE idmodelo = '$idmarca';";
}
function getSqlDeleteModeloMuestra($idmarca){
    return "DELETE FROM modelo_muestra WHERE idmodelo = '$idmarca';";
}
function EliminarModelos($idmodelo,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idmarcaA = verificarValidarText($idmodelo, true, "adiciondetalleingreso", "idmodelo");
    if($idmarcaA['error']==true){
        $dev['mensaje'] = "No puede eliminar este Modelo. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    //    $sql[] = getSqlDeleteLinea_marca($idmarca);

    $sql[] = getSqlDeleteModeloMuestra($idmodelo);
    $sql[] = getSqlDeleteModelo($idmodelo);


    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Modelo correctamente";
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
function getSqlDeleteLinea($idlinea){
    return "DELETE FROM lineas WHERE idlinea = '$idlinea';";
}
function EliminarModeloDependencia($idmodelo,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idmarcaA = verificarValidarText($idmodelo, true, "adiciondetalleingreso", "idmodelo");
    if($idmarcaA['error']==true){
        $dev['mensaje'] = "No puede eliminar este Modelo. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
$sqlcolor = "
SELECT
  idlinea
FROM
 modelos
WHERE
  idmodelo= '$idmodelo' ";
    $opcionA3 = findBySqlReturnCampoUnique($sqlcolor, true, true, "idlinea");
   $idlinea= $opcionA3['resultado'];

    //    $sql[] = getSqlDeleteLinea_marca($idmarca);

    //$sql[] = getSqlDeleteModeloMuestra($idmodelo);
    $sql[] = getSqlDeleteModelo($idmodelo);
 // $sql[] = getSqlDeleteLinea($idlinea);


    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Modelo correctamente";
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
function ListarModelosPorMarcaColeccion($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true"){
    //modificar esta funcion segun requerimientos

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
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ma.nombre AS marca
FROM
  `modelos` mo,
  `marcas` ma,
  `coleccion` co,
  `lineas` li
WHERE
  mo.idmarca = ma.idmarca AND
  mo.idlinea = li.idlinea AND
  mo.idcoleccion = co.idcoleccion $order LIMIT $start,$limit;";
        //        MostrarConsulta($sql);
    }
    else
    {
        $sql = "
      SELECT
  mo.idmodelo,
  mo.idmarca,
  mo.codigo AS modelo,
  mo.numero,
  mo.precio,
  mo.stylename,
  mo.idcoleccion,
  mo.idlinea,
  mo.detalle,
  mo.imagen,
  li.codigo AS linea,
  co.codigo AS coleccion,
  ma.nombre AS marca
FROM
  `modelos` mo,
  `marcas` ma,
  `coleccion` co,
  `lineas` li
WHERE
  mo.idmarca = ma.idmarca AND
  mo.idlinea = li.idlinea AND
  mo.idcoleccion = co.idcoleccion AND $where $order LIMIT $start,$limit
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
?>