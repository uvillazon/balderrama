<?php
function getSqlNewTiendas($idtienda, $idalmacen, $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numero, $estado, $fax, $return){
    $setC[0]['campo'] = 'idtienda';
    $setC[0]['dato'] = $idtienda;
    $setC[1]['campo'] = 'idalmacen';
    $setC[1]['dato'] = $idalmacen;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'nombre';
    $setC[3]['dato'] = $nombre;
    $setC[4]['campo'] = 'responsable';
    $setC[4]['dato'] = $responsable;
    $setC[5]['campo'] = 'direccion';
    $setC[5]['dato'] = $direccion;
    $setC[6]['campo'] = 'telefono';
    $setC[6]['dato'] = $telefono;
    $setC[7]['campo'] = 'email';
    $setC[7]['dato'] = $email;
    $setC[8]['campo'] = 'numero';
    $setC[8]['dato'] = $numero;
    $setC[9]['campo'] = 'estado';
    $setC[9]['dato'] = $estado;
    $setC[10]['campo'] = 'fax';
    $setC[10]['dato'] = $fax;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO tiendas ".$sql2;
}
function ListarTienda($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  ti.idtienda,
  ti.idalmacen,
  ti.codigo,
  ti.nombre,
  ti.direccion,
  ti.telefono,
  ti.email,
  ti.numero,
  ti.estado,
  alm.nombre AS almacen,
  CONCAT( usu.nombre,' - ',usu.login) AS responsable


FROM
  `tiendas` ti,
  `usuario` usu,
  `almacenes` alm
WHERE
  ti.idalmacen = alm.idalmacen AND
  ti.responsable = usu.idusuario $order LIMIT $start,$limit

";
    }else{
        $sql ="
SELECT
  ti.idtienda,
  ti.idalmacen,
  ti.codigo,
  ti.nombre,
  ti.direccion,
  ti.telefono,
  ti.email,
  ti.numero,
  ti.estado,
  alm.nombre AS almacen,
  CONCAT( usu.nombre,' - ',usu.login) AS responsable


FROM
  `tiendas` ti,
  `usuario` usu,
  `almacenes` alm
WHERE
  ti.idalmacen = alm.idalmacen AND
  ti.responsable = usu.idusuario AND $where $order LIMIT $start,$limit

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
function BuscarAlmacenUsuarioPorTienda($idtienda,$callback, $_dc, $return = false){



    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    
    $almacen = ListarAlmacen("", "", "", "", "", "", "", true);
    if($almacen["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $tipo = findAllUsuario("", "", "", "", "", "", "", true);
    if($tipo['error']==false){
        $dev['mensaje'] = "No se pudo encontrar Tipos";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }

    if(($almacen["error"]==true)&&($tipo["error"]==true)){

        $value["almacenM"] = $almacen['resultado'];
        $value["usuarioM"] = $tipo['resultado'];

    }
    $sql ="
SELECT
  ti.idtienda,
  ti.idalmacen,
  ti.codigo,
  ti.nombre,
  ti.responsable AS idusuario,
  ti.direccion,
  ti.telefono,
  ti.email,
  ti.numero,
  ti.estado,
  ti.fax,
  ti.idcliente
FROM
  `tiendas` ti
WHERE
  ti.idtienda = '$idtienda'

";
    if($idtienda != null)
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

?>