<?php
function ListarProveedor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  p.idproveedor,
  p.codigo,
  p.nombre,
  p.telefono,
  p.representante,
  p.ciudad,
  p.pais,
  p.web,
  p.email
FROM
  `proveedores` p WHERE p.idproveedor !='prv-0'

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
function BuscarProveedorPorId($idproveedor,$return){


    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $sql ="
SELECT
  p.idproveedor,
  p.codigo,
  p.nombre,
  p.telefono,
  p.direccion,
  p.representante,
  p.fax,
  p.pais,
  p.web,
  p.email
FROM
  `proveedores` p
WHERE p.idproveedor = '$idproveedor'

";
    if($idproveedor != null)
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
function getSqlNewProveedores($idproveedor, $codigo, $nombre, $telefono, $representante, $ciudad, $pais, $direccion, $web, $email, $numero, $return){
    $setC[0]['campo'] = 'idproveedor';
    $setC[0]['dato'] = $idproveedor;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'nombre';
    $setC[2]['dato'] = $nombre;
    $setC[3]['campo'] = 'telefono';
    $setC[3]['dato'] = $telefono;
    $setC[4]['campo'] = 'representante';
    $setC[4]['dato'] = $representante;
    $setC[5]['campo'] = 'fax';
    $setC[5]['dato'] = $ciudad;
    $setC[6]['campo'] = 'pais';
    $setC[6]['dato'] = $pais;
    $setC[7]['campo'] = 'direccion';
    $setC[7]['dato'] = $direccion;
    $setC[8]['campo'] = 'web';
    $setC[8]['dato'] = $web;
    $setC[9]['campo'] = 'email';
    $setC[9]['dato'] = $email;
    $setC[10]['campo'] = 'numero';
    $setC[10]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO proveedores ".$sql2;
}
function getSqlUpdateProveedores($idproveedor,$codigo, $nombre, $telefono, $representante, $ciudad, $pais, $direccion, $web, $email, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'telefono';
    $setC[2]['dato'] = $telefono;
    $setC[3]['campo'] = 'representante';
    $setC[3]['dato'] = $representante;
    $setC[4]['campo'] = 'ciudad';
    $setC[4]['dato'] = $ciudad;
    $setC[5]['campo'] = 'pais';
    $setC[5]['dato'] = $pais;
    $setC[6]['campo'] = 'direccion';
    $setC[6]['dato'] = $direccion;
    $setC[7]['campo'] = 'web';
    $setC[7]['dato'] = $web;
    $setC[8]['campo'] = 'email';
    $setC[8]['dato'] = $email;


    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idproveedor';
    $wher[0]['dato'] = $idproveedor;

    $where = generarWhereUpdate($wher);
    return "UPDATE proveedores SET ".$set." WHERE ".$where;
}

function InsertarNuevoProveedor(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigoA1 = verificarValidarText($codigo, false, "proveedores", "codigo");
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
        $dev['mensaje'] = "Error en el nombre: ".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $telefono = $_GET['telefono'];
    $pais = strtoupper($_GET['pais']);
    $fax = strtoupper($_GET['fax']);
    $direccion = strtoupper($_GET['direcion']);
    $email = $_GET['email'];
    $web = $_GET['web'];
    $representante = strtoupper($_GET['representante']);

    $idproveedorA = findUltimoID("proveedores", "numero", true);
    $numero = $idproveedorA['resultado']+1;

    $idproveedor = 'prv-'.$numero;
    $sql[] = getSqlNewProveedores($idproveedor, $codigo, $nombre, $telefono, $representante, $fax, $pais, $direccion, $web, $email, $numero, false);

   //    MostrarConsulta($sql);
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
function GuardarEditarProveedor(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idproveedor = $_GET['idproveedor'];
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo: ".$codigoA['mensaje'];
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
    $codigoC = verificarValidarTextUnicoEdit("idproveedor", $idproveedor, true, "proveedores", "codigo", $codigo);
    if($codigoC['error']==false){
        $dev['mensaje'] = "error en el campo Codigo :".$codigoC['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $nombre = strtoupper($_GET['nombre']);
    $telefono = $_GET['telefono'];
    $pais = strtoupper($_GET['pais']);
    $ciudad = strtoupper($_GET['ciudad']);
    $direccion = strtoupper($_GET['direcion']);
    $email = $_GET['email'];
    $web = $_GET['web'];
    $representante = strtoupper($_GET['representante']);

    $sql[] = getSqlUpdateProveedores($idproveedor, $codigo, $nombre, $telefono, $representante, $ciudad, $pais, $direccion, $web, $email, false);

    //    MostrarConsulta($sql);
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
function getSqlDeleteProveedores($idproveedor){
    return "DELETE FROM proveedores WHERE idproveedor = '$idproveedor'" ;
}
function EliminarProveedor($idproveedor,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idproveedorA = verificarValidarText($idproveedor, true, "marcas", "idproveedor");
    if($idproveedorA['error']==true){
        $dev['mensaje'] = "No puede eliminar este proveevor. Esta siendo utilizado en algunos valores";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $sql[] = getSqlDeleteProveedores($idproveedor);

    //        MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se Elimino el Proveedor correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al elminar un usuario";
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