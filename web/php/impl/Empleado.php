<?php

function insertarMarcaEmpleado(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $idmarca = $_GET['idmarca'];

    $idempleado = $_GET['idempleado'];
    $sql1= "SELECT idempleado FROM empleadomarca WHERE idmarca = '$idmarca' and idempleado='$idempleado' and idalmacen='$idalmacen'";
    //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
    $vendedorexiste = $result['resultado'];
    if($vendedorexiste==null || $vendedorexiste=="") {

        $sql[] = getSqlNewEmpleadomarca($idempleado, $idalmacen, $idmarca, "A", false);
    }else{
        //validar estado del modelo
        $dev['mensaje'] = "Ya existe esta marca asignada para el vendedor, por favor revise su lista";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }




    //        MostrarConsulta($sql);
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

function EditarMarcaEstado(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen=$_SESSION['idalmacen'];
    $idmarca = $_GET['idmarca'];
    $idempleado = $_GET['idempleado'];
    $estado = $_GET['estado'];
    $estado = strtoupper($_GET['estado']);

    //echo $sql1;
    $sql[] = "UPDATE empleadomarca SET estado= '$estado' WHERE idempleado = '$idempleado' AND idmarca = '$idmarca';";




    //     MostrarConsulta($sql);
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
function ListarEmpleadoMarca($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
    $sql1= "SELECT
             opcionb
            FROM
              marcas
            WHERE
              idmarca = '$where'";
    //echo $sql1;
    $result = findBySqlReturnCampoUnique($sql1, true, true, "opcionb");
    $opcion = $result['resultado'];

    $sql ="SELECT em.idempleado,em.idmarca,m.nombre as marca,em.estado
FROM empleadomarca em, marcas m,empleados e
WHERE em.idempleado=e.idempleado and em.idmarca=m.idmarca and em.idempleado = '$where' ";
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

function ListarEmpleadoparamarca($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
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
    $sql ="SELECT  emp.idempleado,
  CONCAT(emp.nombres,'-',emp.apellidos) AS codigo
FROM
  empleados emp,empleadomarca em
WHERE
  emp.idempleado=em.idempleado  and em.idalmacen='$idalmacen' and em.idmarca='$where' $order LIMIT $start,$limit
";

    //     echo $sql;
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

function ListarVendedor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
    // CONCAT(emp.nombres,'-',emp.apellidos) AS codigo,
    $idalmacen =$_SESSION['idalmacen'];
    $sql ="
SELECT
  emp.idempleado,
  CONCAT(emp.nombres,'-',emp.apellidos) AS codigo
FROM
  empleados emp
WHERE
  emp.numero!='0' and emp.idalmacen='$idalmacen' $order LIMIT $start,$limit

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

function finddatosmarcaempleado($rol, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    //$sql = "SELECT cf.idcategoriafuncion, cf.nombre FROM categoriafuncion cf";

    $sql = "SELECT cf.idmarca, cf.nombre FROM marcas cf";
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {
                if($fi = mysql_fetch_array($re))
                {
                    do{
                        $catNom = $fi['nombre'];
                        $catNomM = $fi['nombre']."M";

                        $func = findAllFuncionByRolCategoria1($rol, $fi['idempleado'], "", "", true);
                        $cat['idempleado'] = $fi['idempleado'];
                        $cat['nombre'] = $fi['nombre'];
                        if(count($func)>=1)
                        {
                            $cat[$catNomM] = $func['resultado'];
                            $devC = null;
                        }
                        $devCat[] = $cat;
                        $devC[$catNom] = $cat;
                        $cat = null;
                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['resultado'] = $devCat;
                    if($rol != null)
                    {
                        $sqlr = "SELECT idrol, nombre, estado FROM empleado WHERE idrol = '$rol'";
                        if($re2 = $link->consulta($sqlr))
                        {
                            if($fi2 = mysql_fetch_array($re2))
                            {
                                $dev['mensaje'] = "Se recupero correctamente los datos del rol";
                                $dev['estado'] = $fi2['estado'];
                                $dev['nombre'] = $fi2['nombre'];
                                $dev['error']   = "true";
                            }
                            else
                            {
                                $dev['mensaje'] = "No existe este rol";
                                $dev['error']   = "false";
                            }

                        }
                        else
                        {
                            $dev['mensaje'] = "Error al recuperar los datos del rol";
                            $dev['error']   = "false";
                        }

                    }
                    else
                    {
                        $dev['mensaje'] = "Se recupero correctamente los datos del rol";
                        $dev['error']   = "true";
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
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }

}
function findAllFuncionByRolCategoria1($rol, $categoria, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    if($rol == null || $rol == "")
    {
        $sql = "SELECT f.idmarca, f.nombre
FROM
  marcas f
WHERE
  f.idempleado = '$categoria'";
    }
    else
    {

        $sql = "SELECT f.idfuncion,  f.descripcion, f.idcategoriafuncion,
  f.mostrar,
  (SELECT COUNT(rf.idfuncion) AS existe FROM rolfuncion rf WHERE rf.idrol = '$rol'
   AND rf.idfuncion = f.idfuncion) AS existe
FROM
  funcion f
WHERE
  f.idcategoriafuncion = '$categoria'";
    }
    if($link = new BD)
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

function ListarEmpleados($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false , $session){
    $idalmacen=$session->idalmacen;
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
  emp.idempleado,
  emp.codigo,
  emp.nombres,
  emp.apellidos,
  emp.telefeno,
  emp.celular,
  CONCAT(tpe.codigo,'-',tpe.nombre) AS tipoempleado,
  `ciudades`.nombre AS ciudad,emp.estado
FROM
  empleados emp,
  `tipoempleado` tpe,
  `ciudades`
WHERE
  emp.idtipoempleado = tpe.idtipoempleado AND
  emp.idciudad = `ciudades`.idciudad AND emp.numero!='0' AND emp.idalmacen='$idalmacen' $order LIMIT $start,$limit

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
                    $dev['session'] = $session;
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

function ListarEmpleadosPedido($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
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
    $sql ="
SELECT
  emp.idempleado,
  CONCAT(emp.codigo,'/', ciu.`codigo`) AS codigo

FROM
  empleados emp,
  ciudades ciu,
  tipoempleado tpe
WHERE
  emp.idciudad = ciu.idciudad AND
  emp.idtipoempleado = tpe.idtipoempleado and emp.idalmacen='$idalmacen' AND
  tpe.codigo LIKE '%V%' $order LIMIT $start,$limit

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

function ListarEmpleadosVendedor($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
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
    $sql ="
SELECT
  emp.idempleado,
  emp.codigo,
  emp.nombres,
  emp.apellidos,
  emp.telefeno,
  emp.celular,
  emp.direccion,
  emp.tipoempleado,
  emp.estado,
  emp.numero,
  emp.observacion,
  emp.email,
  emp.idtienda,
  emp.idalmacen
FROM
  `empleados` emp
WHERE
  emp.idalmacen = '$idalmacen' AND
  emp.tipoempleado = 'tip-1000' $order LIMIT $start,$limit

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
function ListarEmpleadosCobrador($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  emp.idempleado,
  emp.codigo,
CONCAT(emp.nombres,'-',emp.apellidos)AS nombre,
  emp.telefeno,
  emp.celular,
  emp.direccion,
  emp.idtipoempleado,
  emp.estado,
  emp.numero,
  emp.observacion,
  emp.email,
  emp.idtienda,
  emp.idalmacen
FROM
  `empleados` emp
WHERE
   emp.idtipoempleado = 'tip-1001' AND emp.numero!='0'$order LIMIT $start,$limit

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
function CargarMarcasEmpleado($return = false){
    $idalmacen = $_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $cargos = ListarMarcasempleado("","","","","","", "",true);
    if($cargos['error']==true){
        $value['marcas'] = true;
        $value['marcaM'] = $cargos['resultado'];
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
function CargarNuevoEmpleado($return = false){
    $idalmacen = $_SESSION['idalmacen'];
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudades =  ListarCiudad("","","","","","", "",true);
    if($ciudades['error']== true){
        $value['ciudades'] = true;
        $value['ciudadM'] = $ciudades['resultado'];
    }

    $cargos = ListarCargo("","","","","","", "",true);
    if($cargos['error']==true){
        $value['cargos'] = true;
        $value['cargoM'] = $cargos['resultado'];
    }
    //ListarAlmacenTienda
    // $tienda = ListarAlmacenTienda("","","","","","", "",true);
    //    if($tienda['error']==true){
    //        $value['tiendas'] = true;
    //        $value['tiendaM'] = $tienda['resultado'];
    //    }
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
function ListarMarcasempleado($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
SELECT idmarca,nombre
FROM
 marcas WHERE estado='activo'

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
function getSqlNewEmpleados($idempleado, $codigo, $nombres, $apellidos, $telefeno, $celular, $direccion, $idtipoempleado, $estado, $numero, $observacion, $email, $idtienda, $idalmacen, $idciudad, $fechainicio, $fechabaja, $return){
    $setC[0]['campo'] = 'idempleado';
    $setC[0]['dato'] = $idempleado;
    $setC[1]['campo'] = 'codigo';
    $setC[1]['dato'] = $codigo;
    $setC[2]['campo'] = 'nombres';
    $setC[2]['dato'] = $nombres;
    $setC[3]['campo'] = 'apellidos';
    $setC[3]['dato'] = $apellidos;
    $setC[4]['campo'] = 'telefeno';
    $setC[4]['dato'] = $telefeno;
    $setC[5]['campo'] = 'celular';
    $setC[5]['dato'] = $celular;
    $setC[6]['campo'] = 'direccion';
    $setC[6]['dato'] = $direccion;
    $setC[7]['campo'] = 'idtipoempleado';
    $setC[7]['dato'] = $idtipoempleado;
    $setC[8]['campo'] = 'estado';
    $setC[8]['dato'] = $estado;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;
    $setC[10]['campo'] = 'observacion';
    $setC[10]['dato'] = $observacion;
    $setC[11]['campo'] = 'email';
    $setC[11]['dato'] = $email;
    $setC[12]['campo'] = 'idtienda';
    $setC[12]['dato'] = $idtienda;
    $setC[13]['campo'] = 'idalmacen';
    $setC[13]['dato'] = $idalmacen;
    $setC[14]['campo'] = 'idciudad';
    $setC[14]['dato'] = $idciudad;
    $setC[15]['campo'] = 'fechainicio';
    $setC[15]['dato'] = $fechainicio;
    $setC[16]['campo'] = 'fechabaja';
    $setC[16]['dato'] = $fechabaja;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO empleados ".$sql2;
}


function getSqlUpdateEmpleados($idempleado,$codigo,$nombres,$apellidos,$telefeno,$celular,$direccion,$idtipoempleado,$estado,$numero,$observacion,$email,$idtienda,$idalmacen,$idciudad,$fechainicio,$fechabaja, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'nombres';
    $setC[1]['dato'] = $nombres;
    $setC[2]['campo'] = 'apellidos';
    $setC[2]['dato'] = $apellidos;
    $setC[3]['campo'] = 'telefeno';
    $setC[3]['dato'] = $telefeno;
    $setC[4]['campo'] = 'celular';
    $setC[4]['dato'] = $celular;
    $setC[5]['campo'] = 'direccion';
    $setC[5]['dato'] = $direccion;
    $setC[6]['campo'] = 'estado';
    $setC[6]['dato'] = $estado;
    $setC[7]['campo'] = 'numero';
    $setC[7]['dato'] = $numero;
    $setC[8]['campo'] = 'observacion';
    $setC[8]['dato'] = $observacion;
    $setC[9]['campo'] = 'email';
    $setC[9]['dato'] = $email;
    $setC[10]['campo'] = 'fechainicio';
    $setC[10]['dato'] = $fechainicio;
    $setC[11]['campo'] = 'fechabaja';
    $setC[11]['dato'] = $fechabaja;
    $setC[12]['campo'] = 'idtipoempleado';
    $setC[12]['dato'] = $idtipoempleado;
    $setC[13]['campo'] = 'idtienda';
    $setC[13]['dato'] = $idtienda;
    $setC[14]['campo'] = 'idalmacen';
    $setC[14]['dato'] = $idalmacen;
    $setC[15]['campo'] = 'idciudad';
    $setC[15]['dato'] = $idciudad;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idempleado';
    $wher[0]['dato'] = $idempleado;


    $where = generarWhereUpdate($wher);
    return "UPDATE empleados SET ".$set." WHERE ".$where;
}




function getSqlDeleteEmpleados($idempleados){
    return "DELETE FROM empleados WHERE idempleado ='$idempleados';";
}


function InsertarNuevoEmpleado(){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];

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
    $codigoA1 = verificarValidarText($codigo, false, "empleados", "codigo");
    if($codigoA1['error']==false){
        $dev['mensaje'] = "Error El Codigo ya Existe: ".$codigoA1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombres = strtoupper($_GET['nombre']);
    $nombresA = validarText($nombres, true);
    if($nombresA['error']==false){
        $dev['mensaje'] = "Error en el nombre: ".$nombresA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $apellidos = strtoupper($_GET['apellido']);
    $responsable = $_GET['idusuario'];
    $ciudad =$_GET['ciudad'];
    $telefeno =$_GET['telefono'];
    $celular=$_GET['celular'];
    $direccion=strtoupper($_GET['direccion']);
    $estado=$_GET['estado'];
    $email=$_GET['email'];
    $tipoempleado =$_GET['tipo'];
    $numeroA = findUltimoID("empleados", "numero", true);
    $numero = $numeroA['resultado']+1;
    $idempleado = "emp-".$numero;
    //$idtienda = $_SESSION['idtienda'];
    $idtienda = $_GET['tienda'];
    $idciudad = $_GET['idciudad'];
    $idalmacenA = validarText($idciudad, true);
    if($idalmacenA['error']==false){
        $dev['mensaje'] = "Error en el almacen: ".$idalmacenA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $fechainicio = $_GET['fechainicio'];

    $sql[] = getSqlNewEmpleados($idempleado, $codigo, $nombres, $apellidos, $telefeno, $celular, $direccion, $tipoempleado, $estado, $numero, $observacion, $email, $idtienda, $idalmacen, $idciudad, $fechainicio, $fechabaja, $return);
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
function CargarDatosEditarEmpleado($idempleado,$callback, $_dc, $return = false){
    //echo "hol111a";exit();
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudades =  ListarCiudad("","","","","","", "",true);
    if($ciudades['error']== true){
        $value['ciudades'] = true;
        $value['ciudadM'] = $ciudades['resultado'];
    }

    $cargos = ListarCargo("","","","","","", "",true);
    if($cargos['error']==true){
        $value['cargos'] = true;
        $value['cargoM'] = $cargos['resultado'];
    }

    $sql ="
SELECT
 emp.idempleado,
  emp.codigo,
  emp.nombres,
  emp.apellidos,
  emp.telefeno,
  emp.celular,
  emp.direccion,
  emp.idtipoempleado,
  emp.email,
  emp.idciudad,
  emp.fechainicio,
'0' as nombretienda,emp.estado

FROM
  `empleados` emp
WHERE
  emp.idempleado = '$idempleado';

";
    //echo $sql;
    if($idempleado != null)
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

function GuardarEditarEmpleado(){
    $idalmacen = $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idempleado = $_GET['idempleado'];
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
    $codigoA1 = verificarValidarTextUnicoEdit("idempleado", $idempleado, true, "empleados", "codigo", $codigo);
    //    ($codigo, false, "empleados", "codigo");
    if($codigoA1['error']==false){
        $dev['mensaje'] = "Error El Codigo ya Existe: ".$codigoA1['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $nombres = strtoupper($_GET['nombre']);

    $nombresA = validarText($nombres, true);
    if($nombresA['error']==false){
        $dev['mensaje'] = "Error en el nombre: ".$nombresA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $apellidos = strtoupper($_GET['apellido']);
    $responsable = $_GET['idusuario'];
    $ciudad =$_GET['ciudad'];
    $telefeno =$_GET['telefono'];
    $celular=$_GET['celular'];
    $direccion=strtoupper($_GET['direccion']);
    $estado=$_GET['estado'];
    $email=$_GET['email'];
    $tipoempleado =$_GET['tipo'];

    $idciudad = $_GET['idciudad'];
    $idalmacenA = validarText($idciudad, true);
    if($idalmacenA['error']==false){
        $dev['mensaje'] = "Error en el almacen: ".$idalmacenA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $fechainicio = $_GET['fechainicio'];
    $sql[] = getSqlUpdateEmpleados($idempleado,$codigo,$nombres,$apellidos,$telefeno,$celular,$direccion,$tipoempleado,$estado,$numero,$observacion,$email,$idtienda,$idalmacen,$idciudad,$fechainicio,$fechabaja, $return);

    //  $sql[] = getSqlUpdateEmpleados($idempleado,$codigo, $nombres, $apellidos, $telefeno, $celular, $direccion, $tipoempleado, $estado, $numero, $observacion, $email, $idtienda, $idalmacen, $return);
    //    MostrarConsulta($sql);
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


function GuardarEstadoEmpleado(){
    $idalmacen = $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idempleado = $_GET['idempleado'];
    $estado = $_GET['estado'];
    $sql1= "SELECT COUNT(idmarca)as marcas FROM empleadomarca WHERE idempleado='$idempleado' and estado='A'";
    $result = findBySqlReturnCampoUnique($sql1, true, true, "marcas");
    $marcasactivas = $result['resultado'];

    if($marcasactivas >'1' )
    {
        $dev['mensaje'] = "Para Inactivar un empleado , sus marcas deben estar inactivas tb por favor vaya a la lista de marcas asignadas ";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else
    {
        $fechainicio = $_GET['fechainicio'];
        //   $sql[] = getSqlUpdateEmpleados($idempleado,$codigo,$nombres,$apellidos,$telefeno,$celular,$direccion,$tipoempleado,$estado,$numero,$observacion,$email,$idtienda,$idalmacen,$idciudad,$fechainicio,$fechabaja, $return);
        $sql[] = "UPDATE empleados SET estado= '$estado' WHERE idempleado = '$idempleado';";

        //  $sql[] = getSqlUpdateEmpleados($idempleado,$codigo, $nombres, $apellidos, $telefeno, $celular, $direccion, $tipoempleado, $estado, $numero, $observacion, $email, $idtienda, $idalmacen, $return);
        //    MostrarConsulta($sql);
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
}
function getSqlDeleteEmpleadoss($idEstilomarca){
    return "DELETE FROM empleados WHERE idempleado = '$idEstilomarca' ";
}

function buscarMarcasEmpleado($idempleado,$idmarca,$return){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sql ="SELECT em.idmarca,m.nombre as marca,em.estado
FROM
  marcas m,empleadomarca em
WHERE
  em.idmarca=m.idmarca and em.idempleado='$idempleado' and em.idmarca='$idmarca'
";

    //echo $sql;
    //  MostrarConsulta($sql);
    if($idempleado != null)
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


function EliminarEmpleado($idempleado,$callback, $_dc, $return= 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $COLECCION=verificarValidarText($idempleado, true, "modelo", "idvendedor");
    if($COLECCION['error'] ==true )
    {
        $dev['mensaje'] = "No es posible eliminar el empleado /tiene dependencias ";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    else
    {
        $sql[] = getSqlDeleteEmpleadoss($idempleado);
        // $sql[] = getSqlDeleteEstilos($idestilo);
    }
    MostrarConsulta($sql);
    //    if(ejecutarConsultaSQLBeginCommit($sql))
    //    {
    //        $dev['mensaje'] = "Se Elimino el Estilo correctamente";
    //        $dev['error'] = "true";
    //        $dev['resultado'] = "";
    //    }
    //    else
    //    {
    //        $dev['mensaje'] = "Ese Estilo esta siendo Utilizado por alguna linea por favor eliminar la linea primero";
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

}
function getSqlNewEmpleadomarca($idempleado, $idalmacen, $idmarca, $estado, $return){
    $setC[0]['campo'] = 'idempleado';
    $setC[0]['dato'] = $idempleado;
    $setC[1]['campo'] = 'idalmacen';
    $setC[1]['dato'] = $idalmacen;
    $setC[2]['campo'] = 'idmarca';
    $setC[2]['dato'] = $idmarca;
    $setC[3]['campo'] = 'estado';
    $setC[3]['dato'] = $estado;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO empleadomarca ".$sql2;
}

?>