<?php
function ListarAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ciu.nombre as ciudad,
  alm.idalmacen,
  alm.nombre,
  alm.codigo,
  alm.direccion,
  alm.numero,
  alm.telefono,
  alm.tipo,
  alm.fax
 FROM
  ciudades ciu,
  almacenes alm
WHERE
  alm.idciudad = ciu.idciudad $order LIMIT $start,$limit

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

function ListarAlmacenTienda($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ciu.nombre as ciudad,
  alm.idalmacen,
  alm.nombre,
  alm.codigo,
  alm.direccion,
  alm.numero,
  alm.telefono,
  alm.tipo,
  alm.fax
 FROM
  ciudades ciu,
  almacenes alm
WHERE
  alm.idciudad = ciu.idciudad  $order LIMIT $start,$limit

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


function ListarCiudadAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ciudades.idciudad,
  ciudades.nombre,
  ciudades.numero
FROM
  ciudades

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

function ListarResponsableAlmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  usuario.idusuario,
  usuario.idrol,
  usuario.idalmacen,
  usuario.nombre,
  usuario.apellido1,
  usuario.apellido2,
  usuario.ci,
  usuario.email,
  usuario.telefono,
  usuario.celular,
  usuario.login,
  usuario.paswd,
  usuario.fechareg,
  usuario.estado,
  usuario.numero
FROM
  usuario

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

function BuscarResponsableCiudad($callback, $_dc, $where = '', $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $responsable = ListarResponsableAlmacen("", "", "", "", "", "", "", true);
    if($responsable['error']==false){
        $dev['mensaje'] = "No se pudo encontrar Tipos";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }

    if(($responsable["error"]==true)&&($ciudad["error"]==true)){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
        $value["responsableM"] = $responsable['resultado'];
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
//
function BuscarResponsableCiudadPorAlmacen($idalmacen,$callback, $_dc, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $ciudad = ListarCiudadAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $value["ciudadM"] = $ciudad['resultado'];
    $dev["resultado"] = $value;

    
    $sql ="
SELECT
  alm.idalmacen,
  alm.idciudad,
  alm.nombre,
  alm.codigo,
  alm.direccion,
  alm.tipo,
  alm.numero,
  alm.telefono,
  alm.fax
FROM
  almacenes alm
WHERE
  alm.idalmacen = '$idalmacen';

";
    if($idalmacen != null)
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


function getSqlUpdateAlmacen($idalmacen,$idciudad,$nombre, $codigo, $direccion, $responsable, $numero, $telefono, $fax, $return){
    $setC[0]['campo'] = 'nombre';
    $setC[0]['dato'] = $nombre;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'direccion';
    $setC[2]['dato'] = $direccion;
    $setC[3]['campo'] = 'tipo';
    $setC[3]['dato'] = $responsable;
    $setC[4]['campo'] = 'numero';
    $setC[4]['dato'] = $numero;
    $setC[5]['campo'] = 'telefono';
    $setC[5]['dato'] = $telefono;
    $setC[6]['campo'] = 'fax';
    $setC[6]['dato'] = $fax;
    $setC[7]['campo'] = 'idciudad';
    $setC[7]['dato'] = $idciudad;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idalmacen';
    $wher[0]['dato'] = $idalmacen;


    $where = generarWhereUpdate($wher);
    return "UPDATE almacenes SET ".$set." WHERE ".$where;
}

function getSqlUpdateTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numero, $estado,$fax, $return){
    $setC[0]['campo'] = 'nombre';
    $setC[0]['dato'] = $nombre;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'direccion';
    $setC[2]['dato'] = $direccion;
    $setC[3]['campo'] = 'tipo';
    $setC[3]['dato'] = $responsable;
    $setC[4]['campo'] = 'numero';
    $setC[4]['dato'] = $numero;
    $setC[5]['campo'] = 'telefono';
    $setC[5]['dato'] = $telefono;
    $setC[6]['campo'] = 'fax';
    $setC[6]['dato'] = $fax;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idtienda';
    $wher[0]['dato'] = $idtienda;


    $where = generarWhereUpdate($wher);
    return "UPDATE tiendas SET ".$set." WHERE ".$where;
}
function GuardarEditarAlmacen($idalmacen){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo del Almacen: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoB = TamanoPermitido($codigo, 6);
    if($codigoB['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoB['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoC = verificarValidarTextUnicoEdit("idalmacen", $idalmacen, true, "almacenes", "codigo", $codigo);
    if($codigoC['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoC['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $tipos = $_GET['tipos'];
    $tiposA = validarText($tipos, true);
    if($tiposA['error']==false){
        $dev['mensaje'] = "Error en el campo tipo: ".$tiposA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    //    $idcliente=$_GET['idcliente'];
    $nombre = $_GET['nombre'];
    $responsable = $_GET['tipos'];
    $idciudad =$_GET['ciudad'];
    $telefono =$_GET['telefono'];
    $fax=$_GET['fax'];
    $direccion=$_GET['direccion'];
    //    $estado=$_GET['estado'];
    //    $email=$_GET['email'];
    if($_GET['tipos']=='ALMACEN'){
    $itemproducto = verificarValidarText($idalmacen, true, "tiendas", "idalmacen");
    $verificatienda = verificarBorrarenTablas($idalmacen,true);
 if($itemproducto['error'] == true){

        $sql[] = "DELETE FROM tiendas WHERE idalmacen = '$idalmacen';";
        }
    else{
         $error[] = " $idalmacen";
    }
    }else{
        $numeroT = findUltimoID("tiendas", "numero", true);
        $numerot = $numeroT['resultado']+1;
        $idtienda = 'tie-'.$numerot;
        $responsable = "usr-1000";
       $sql[] = getSqlNewTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, $return);

        //$sql[] = getSqlUpdateTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, false);

    }
//     if($_GET['tipos']=='TIENDA'){
//        $numeroT = findUltimoID("tiendas", "numero", true);
//        $numerot = $numeroT['resultado']+1;
//        $idtienda = 'tie-'.$numerot;
//        $responsable = "usr-1000";
//        $sql[] = getSqlNewTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, $return);
//    }

    $sql[] = getSqlUpdateAlmacen($idalmacen,$idciudad,$nombre, $codigo, $direccion, $responsable, $numero, $telefono, $fax, false);

     //   MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar los datos";
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

function getSqlNewAlmacen($idalmacen, $idciudad, $nombre, $codigo, $direccion, $responsable, $numero, $telefono, $fax, $return){
    $setC[0]['campo'] = 'idalmacen';
    $setC[0]['dato'] = $idalmacen;
    $setC[1]['campo'] = 'idciudad';
    $setC[1]['dato'] = $idciudad;
    $setC[2]['campo'] = 'nombre';
    $setC[2]['dato'] = $nombre;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $setC[4]['campo'] = 'direccion';
    $setC[4]['dato'] = $direccion;
    $setC[5]['campo'] = 'tipo';
    $setC[5]['dato'] = $responsable;
    $setC[6]['campo'] = 'numero';
    $setC[6]['dato'] = $numero;
    $setC[7]['campo'] = 'telefono';
    $setC[7]['dato'] = $telefono;
    $setC[8]['campo'] = 'fax';
    $setC[8]['dato'] = $fax;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO almacenes ".$sql2;
}

function InsertarNuevoAlmacen(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo de almacen: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $codigoA1 = verificarValidarText($codigo, false, "almacenes", "codigo");
    if($codigoA1['error']==false){
        $dev['mensaje'] = "Error El Codigo ya Existe: ".$codigoA1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoB = TamanoPermitido($codigo, 6);
    if($codigoB['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoB['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    $nombre = strtoupper($_GET['nombre']);
    $nombreA = validarText($nombre, true);
    if($nombreA['error']==false){
        $dev['mensaje'] = "Error en el nombre de almacen: ".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $tipos = $_GET['tipos'];
    $tiposA = validarText($tipos, true);
    if($tiposA['error']==false){
        $dev['mensaje'] = "Error en el campo tipo: ".$tiposA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
  
    $ciudad =$_GET['ciudad'];
    $ciudadA = validarText($ciudad, true);
    if($ciudadA['error']==false){
        $dev['mensaje'] = "Error en la ciudad de almacen: ".$ciudadA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $telefono =$_GET['telefono'];
    $fax=$_GET['fax'];
    $direccion=strtoupper($_GET['direccion']);
    //    $estado=$_GET['estado'];
    //    $email=$_GET['email'];
    $numeroA = findUltimoID("almacenes", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idalmacen = 'alm-'.$numero;
    $sql[] = getSqlNewAlmacen($idalmacen, $ciudad, $nombre, $codigo, $direccion, $tipos, $numero, $telefono, $fax, false);
    //        MostrarConsulta($sql);
// if($_GET['tipos']=='TIENDA'){
//        $sql[]= getSqlNewTiendas($idtienda, $idalmacen, $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numero, $estado, $fax, $return);
//    }
    if($_GET['tipos']=='TIENDA'){
        $numeroT = findUltimoID("tiendas", "numero", true);
        $numerot = $numeroT['resultado']+1;


        $idtienda = 'tie-'.$numerot;
        $responsable = "usr-1000";

        $sql[] = getSqlNewTiendas($idtienda, $idalmacen , $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numerot, "Activo",$fax, $return);
  //     $sql[]= getSqlNewTiendas($idtienda, $idalmacen, $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numero, $estado, $fax, $return);

    }
       //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al  guardar los datos";
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

function getSqlDeleteAlmacen($idalmacen){
    return "DELETE FROM almacenes WHERE idalmacen = '$idalmacen'";
}
function EliminarAlmacen($idalmacen,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";


    $tiendaA1 = verificarValidarText($idalmacen, true, "tienda", "idalmacen");
    $tiendaA = verificarValidarText($idalmacen, true, "clientes", "idalmacen");
    if(($tiendaA["error"]==true)||($tiendaA1["error"]==true)){
        $dev['mensaje'] = "Error no se puede almacenar el almacen porque tiene clientes registrados en este almacen: ".$tiendaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $sql[] = getSqlDeleteAlmacen($idalmacen);

    //            MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Almacen correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar un Almacen";
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
?>