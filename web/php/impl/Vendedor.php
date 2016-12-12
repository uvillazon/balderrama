<?php
function ListarVendedorMayor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false) {

    if($start == null) {
        $start = 0;
    }
    if($limit == null) {
        $limit = 100;
    }
    if($sort != null) {
        $order = "ORDER BY $sort ";
        if($dir != null) {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  usu.nombre AS usuario,
  ven.idvendedor,
  tie.codigo AS tienda,
  ven.codigo,
  ven.nombre,
  ven.apellido1 AS apellido,
  ven.telefono,
  ven.direccion,
  ven.fecha,
  ven.estado
FROM
  usuario usu,
  vendedores ven,
  tiendas tie
WHERE
  ven.idtienda = tie.idtienda AND
  ven.responsable = usu.idusuario
 

";
//        echo $sql;
    if($link=new BD) {
        if($link->conectar()) {
            if($re = $link->consulta($sql)) {

                if($fi = mysql_fetch_array($re)) {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do {

                        for($i = 0; $i< mysql_num_fields($re); $i++) {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true) {
        return $dev;
    }
    else {

        if($callback == null || $callback == "") {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function ListarVendedor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false) {

    if($start == null) {
        $start = 0;
    }
    if($limit == null) {
        $limit = 100;
    }
    if($sort != null) {
        $order = "ORDER BY $sort ";
        if($dir != null) {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  usu.nombre AS usuario,
  ven.idvendedor,
  tie.codigo AS tienda,
  ven.codigo,
  ven.nombre,
  ven.apellido1 AS apellido,
  ven.telefono,
  ven.direccion,
  ven.fecha,
  ven.estado
FROM
  usuario usu,
  vendedores ven,
  tiendas tie
WHERE
  ven.idtienda = tie.idtienda AND
  ven.responsable = usu.idusuario
 

";
//        echo $sql;
    if($link=new BD) {
        if($link->conectar()) {
            if($re = $link->consulta($sql)) {

                if($fi = mysql_fetch_array($re)) {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do {

                        for($i = 0; $i< mysql_num_fields($re); $i++) {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true) {
        return $dev;
    }
    else {

        if($callback == null || $callback == "") {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function BuscarProveedorPorId($idvendedor,$return) {
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  ve.idvendedor,
  ve.idtienda,
  ve.codigo,
  ve.nombre,
  ve.apellido1,
  ve.apellido2,
  ve.telefono,
  ve.direccion,
  ve.numero,
  ve.fecha,
  ve.responsable,
  ve.estado
FROM
  vendedores ve
WHERE
  ve.idvendedor = '$idvendedor';
            ";
    if($idproveedor != null) {
        if($link=new BD) {
            if($link->conectar()) {
                if($re = $link->consulta($sql)) {
                    if($fi = mysql_fetch_array($re)) {
                        for($i = 0; $i< mysql_num_fields($re); $i++) {
                            if(mysql_field_type($re, $i) == "real") {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else {
        $dev['mensaje'] = "El codigo de producto es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true) {
        return $dev;
    }
    else {

        if($callback == null || $callback == "") {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function getSqlUpdateVendedores($idvendedor,$idtienda,$codigo, $nombre, $apellido1, $apellido2, $telefono, $direccion, $numero, $fecha, $responsable, $estado, $return) {
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'apellido1';
    $setC[2]['dato'] = $apellido1;
    $setC[3]['campo'] = 'apellido2';
    $setC[3]['dato'] = $apellido2;
    $setC[4]['campo'] = 'telefono';
    $setC[4]['dato'] = $telefono;
    $setC[5]['campo'] = 'direccion';
    $setC[5]['dato'] = $direccion;
    $setC[6]['campo'] = 'numero';
    $setC[6]['dato'] = $numero;
    $setC[7]['campo'] = 'fecha';
    $setC[7]['dato'] = $fecha;
    $setC[8]['campo'] = 'responsable';
    $setC[8]['dato'] = $responsable;
    $setC[9]['campo'] = 'estado';
    $setC[9]['dato'] = $estado;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idvendedor';
    $wher[0]['dato'] = $idvendedor;
    $wher[1]['campo'] = 'idtienda';
    $wher[1]['dato'] = $idtienda;

    $where = generarWhereUpdate($wher);
    return "UPDATE vendedores SET ".$set." WHERE ".$where;
}
function getSqlNewVendedores($idvendedor, $idtienda, $codigo, $nombre, $apellido1, $apellido2, $telefono, $direccion, $numero, $fecha, $responsable, $estado, $return) {
    $setC[0]['campo'] = 'idvendedor';
    $setC[0]['dato'] = $idvendedor;
    $setC[1]['campo'] = 'idtienda';
    $setC[1]['dato'] = $idtienda;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'nombre';
    $setC[3]['dato'] = $nombre;
    $setC[4]['campo'] = 'apellido1';
    $setC[4]['dato'] = $apellido1;
    $setC[5]['campo'] = 'apellido2';
    $setC[5]['dato'] = $apellido2;
    $setC[6]['campo'] = 'telefono';
    $setC[6]['dato'] = $telefono;
    $setC[7]['campo'] = 'direccion';
    $setC[7]['dato'] = $direccion;
    $setC[8]['campo'] = 'numero';
    $setC[8]['dato'] = $numero;
    $setC[9]['campo'] = 'fecha';
    $setC[9]['dato'] = $fecha;
    $setC[10]['campo'] = 'responsable';
    $setC[10]['dato'] = $responsable;
    $setC[11]['campo'] = 'estado';
    $setC[11]['dato'] = $estado;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO vendedores ".$sql2;
}
function InsertarNuevoVendedor() {
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false) {
        $dev['mensaje'] = "Error en el codigo de almacen: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $telefono = $_GET['telefono'];
    $direccion = $_GET['direccion'];
    $estado = $_GET['estado'];
    $idtienda = $_SESSION['idtienda'];
    $idvendedorA = findUltimoID("vendedores", "numero", true);
    $numero = $idvendedorA['resultado']+1;
    $responsable = $_SESSION['idusuario'];
    $idvendedor = 'prv-'.$numero;
    $fecha = date("Y-m-d");
    $sql[] = getSqlNewVendedores($idvendedor, $idtienda, $codigo, $nombre, $apellido,"", $telefono, $direccion, $numero, $fecha, $responsable, $estado, false);

//    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql)) {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true) {
        return $dev;
    }
    else {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
function  GuardarEditarVendedor($idvendedor) {
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false) {
        $dev['mensaje'] = "Error en el codigo de almacen: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }


    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $telefono = $_GET['telefono'];
    $direccion = $_GET['direccion'];
    $estado = $_GET['estado'];
    $idtienda = $_SESSION['idtienda'];
//    $idvendedorA = findUltimoID("vendedores", "numero", true);
//    $numero = $idendedorA['resultado']+1;
    $responsable = $_SESSION['idusuario'];
//    $idvendedor = 'prv-'.$numero;
    $fecha = date("Y-m-d");
    $sql[] = getSqlUpdateVendedores($idvendedor,$idtienda,$codigo, $nombre, $apellido, "", $telefono, $direccion, $numero, $fecha, $responsable, $estado, false);

//        MostrarConsulta($sql);
//    if(ejecutarConsultaSQLBeginCommit($sql)) {
//        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
//        $dev['error'] = "true";
//        $dev['resultado'] = "";
//    }
//    else {
//        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
//        $dev['error'] = "false";
//        $dev['resultado'] = "";
//    }
    if($return == true) {
        return $dev;
    }
    else {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
//function getSqlDeleteProveedores($idproveedor){
//    return "DELETE FROM proveedores WHERE idproveedor = '$idproveedor'" ;
//}
//function EliminarProveedor($idproveedor,$callback, $_dc, $return= 'true')
//{
//    $dev['mensaje'] = "";
//    $dev['error']   = "";
//    $idproveedorA = verificarValidarText($idproveedor, true, "marcas", "idproveedor");
//    if($idproveedorA['error']==true){
//        $dev['mensaje'] = "No puede eliminar este proveevor. Esta siendo utilizado en algunos valores";
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//        exit;
//    }
//
//    $sql[] = getSqlDeleteProveedores($idproveedor);
//
//    //        MostrarConsulta($sql);
//    if(ejecutarConsultaSQLBeginCommit($sql))
//    {
//        $dev['mensaje'] = "Se Elimino el Proveedor correctamente";
//        $dev['error'] = "true";
//        $dev['resultado'] = "";
//    }
//    else
//    {
//        $dev['mensaje'] = "Ocurrio un error al elminar un usuario";
//        $dev['error'] = "false";
//        $dev['resultado'] = "";
//    }
//    if($return == true)
//    {
//        return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//        print($output);
//    }
//
//
//
//}
?>