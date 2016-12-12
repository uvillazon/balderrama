<?php
require_once('../lib/includeLibs.php');
function findCiudadSucursalAlmCatSubcat($return)
{
    $ciudad = findAllCiudad(0, 0, "", "", "", "", true, true);
    $dev['ciudadM'] = $ciudad['resultado'];

    //$sucursal = findAllSucursal(0, 0, "", "", "", "", true, true);
    //$dev['sucursalM'] = $sucursal["resultado"];

    $almacen = findAllAlmacen(0, 0, "", "", "", "", true);
    $dev['almacenM'] = $almacen["resultado"];

    $categoria = findAllCategoria(0, 0, "", "", "", "", true, true);
    $dev['categoriaM'] = $categoria["resultado"];

    //$subcategoria = findAllSubcategoria(0, 0, "", "", "", "", true);
    //$dev['subcategoriaM'] = $subcategoria["resultado"];

    $dev["error"] = "true";
    $dev["mensaje"] = "Se cargaron correctamente los datos";

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
//function findAllProductoConCondiciones($start, $limit, $sort, $dir, $callback, $_dc, $return)
function listarproductos($start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
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
    //,    (k.saldocantidad + SUM(ka.saldocantidad)) AS cantidad

    $idalmacen = $_SESSION['idalmacen'];
    if($where == null || $where == "")
    {
        $sql = "
        SELECT
  pro.idproducto,
  pro.nombre,
  pro.codigo,
  pro.imagen,
  pro.stockminimo,
  (k.precio2bs*0.3 + k.precio2bs) AS preciobs,
  k.saldocantidad AS cantidad,

  cat.nombre AS categoria,
  prv.nombre AS proveedor,
  k.precio2bs AS preciosus,
  pro.unidad,
  pro.estado
FROM
 kardexalmacen k,
productos pro,
  proveedores prv,
  categorias cat,
  marcas mar

WHERE
  k.idalmacen = '$idalmacen' AND
  k.idproducto = pro.idproducto  AND
  pro.idcategoria = cat.idcategoria AND
pro.idproveedor = prv.idproveedor
GROUP by (pro.idproducto)
        $order LIMIT $start,0";
        $sql1 = "
        SELECT
  pro.idproducto,
  pro.nombre,
  pro.codigo,
  pro.imagen,
  pro.stockminimo,
  (k.precio2bs*0.3 + k.precio2bs) AS preciobs,
  k.saldocantidad AS cantidad,

  cat.nombre AS categoria,
  prv.nombre AS proveedor,
  k.precio2bs AS preciosus,
  pro.unidad,
  pro.estado
FROM
  productos pro,
  proveedores prv,
  categorias cat,
  marcas mar,
  kardexalmacen k
WHERE
  pro.idproducto = k.idproducto AND
  pro.idcategoria = cat.idcategoria AND
pro.idproveedor = prv.idproveedor AND k.idalmacen = '$idalmacen'
GROUP by (pro.idproducto)
        $order";


    }
    else
    {
        $sql = "
SELECT
  pro.idproducto,
  pro.nombre,
  pro.codigo,
  pro.imagen,
  pro.stockminimo,
   (k.precio2bs*0.3 + k.precio2bs) AS preciobs,
  k.saldocantidad AS cantidad,

  cat.nombre AS categoria,
  prv.nombre AS proveedor,
  k.precio2bs AS preciosus,
  pro.unidad,
  pro.estado
FROM
  productos pro,
  proveedores prv,
  categorias cat,
  marcas mar,
  kardexalmacen k
WHERE
  pro.idproducto = k.idproducto AND
  pro.idcategoria = cat.idcategoria AND
pro.idproveedor = prv.idproveedor AND k.idalmacen = '$idalmacen' AND
        $where GROUP by (pro.idproducto)  $order ";
        $sql1 = "
SELECT
  pro.idproducto,
  pro.nombre,
  pro.codigo,
  pro.imagen,
  pro.stockminimo,
   (k.precio2bs*0.3 + k.precio2bs) AS preciobs,
  k.saldocantidad AS cantidad,

  cat.nombre AS categoria,
  prv.nombre AS proveedor,
  k.precio2bs AS preciosus,
  pro.unidad,
  pro.estado
FROM
  productos pro,
  proveedores prv,
  categorias cat,
  marcas mar,
  kardexalmacen k
WHERE
  pro.idproducto = k.idproducto AND
  pro.idcategoria = cat.idcategoria AND
pro.idproveedor = prv.idproveedor AND k.idalmacen = '$idalmacen' AND
        $where GROUP by (pro.idproducto)  $order";

    }
    //                    echo $sql;
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
                $dev['mensaje'] = "No existe un producto con estos datos";
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

/////////////////////funcion modificada por andy ///////////////////////////////////
function listarproductoscompra($idproveedor,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
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
        if($idproveedor == null || $idproveedor == ""){
            $sql = "SELECT
                pro.idproducto,
                pro.codigo,
                prv.nombre AS proveedor,
                pro.nombre,
                cat.nombre AS categoria,
                pro.unidad,
                ka.costounitario as precio,
                SUM(ka.saldocantidad) AS cantidad
                FROM
                productos pro,
                proveedores prv,
                categorias cat,
                kardexalmacen ka

                WHERE
                 pro.idproveedor = prv.idproveedor AND
                 pro.idcategoria = cat.idcategoria AND
                 ka.idproducto = pro.idproducto
                 GROUP by (pro.idproducto) $order LIMIT $start,$limit ";}
        else{
            $sql = "SELECT
                pro.idproducto,
                pro.codigo,
                prv.nombre AS proveedor,
                pro.nombre,
                cat.nombre AS categoria,
                pro.unidad,
                ka.costounitario as precio,
                SUM(ka.saldocantidad) AS cantidad
                FROM
                productos pro,
                proveedores prv,
                categorias cat,
                kardexalmacen ka

                WHERE
                 pro.idproveedor = prv.idproveedor AND
                 pro.idcategoria = cat.idcategoria AND
                 ka.idproducto = pro.idproducto AND
                 prv.idproveedor = '$idproveedor'
                 GROUP by (pro.idproducto) $order LIMIT $start,$limit ";
        }



    }
    else
    {
        if($idproveedor == null || $idproveedor == ""){
            $sql = "SELECT
                pro.idproducto,
                pro.codigo,
                prv.nombre AS proveedor,
                pro.nombre,
                cat.nombre AS categoria,
                pro.unidad,
                ka.costounitario as precio,
                SUM(ka.saldocantidad) AS cantidad
                FROM
                productos pro,
                proveedores prv,
                categorias cat,
                kardexalmacen ka

                WHERE
                 pro.idproveedor = prv.idproveedor AND
                 pro.idcategoria = cat.idcategoria AND
                 ka.idproducto = pro.idproducto AND $where
                GROUP by (pro.idproducto) $order LIMIT $start,$limit ";}
        else{
            $sql = "SELECT
                pro.idproducto,
                pro.codigo,
                prv.nombre AS proveedor,
                pro.nombre,
                cat.nombre AS categoria,
                pro.unidad,
                ka.costounitario as precio,
                SUM(ka.saldocantidad) AS cantidad
                FROM
                productos pro,
                proveedores prv,
                categorias cat,
                kardexalmacen ka

                WHERE
                 pro.idproveedor = prv.idproveedor AND
                 pro.idcategoria = cat.idcategoria AND
                 ka.idproducto = pro.idproducto
                 prv.idproveedor = '$idproveedor' AND $where
                 GROUP by (pro.idproducto) $order LIMIT $start,$limit ";
        }



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

                $dev['mensaje'] = "No existe en prod con es";
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
    $tuplas = NumeroTuplas($sql);
    $dev['totalCount'] = $tuplas['resultado'];
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

function insertarnuevoproducto($resultado,$return){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";

    // $nombreA = validarText($nombre, true);
    //if($idkardex=="kar-1001"){
    $idproducto = $resultado->idproducto;
    $numeroA = findUltimoID("productos", "numero", true);
    $numero = $numeroA['resultado'] +1;

    $idproducto = "pro-".$numero;
    $nombre = $resultado->nombres;
    $marca ='';
    $estado = $resultado->estado;
    $idcategoria = $resultado->idcategoria;
    $idproveedor = $resultado->idproveedor;
    $stockminimo = $resultado->stockminimo;
    $codigobarra = $resultado->codigobarra;
    $detalle = $resultado->descripcion;
    $codigo = $resultado->codigo;
    $unidad = $resultado->unidad;
    $idusuario = $resultado->idempleado;
    $idalmacen = $_SESSION['idalmacen'];
    // $idcategoria = "cat-1001";
    //$idmarca= "mar-1001";

    ///////////////////////////Validacion/////////////////// productos
    //    if(($marca == '')||($marca == null)){
    //        $dev['mensaje'] = "Error el campo marca esta vacio ".$marca['mensaje'];
    //        $json = new Services_JSON();
    //        $output = $json->encode($dev);
    //        print($output);
    //        exit;
    //    }





    $codigoA = validarTextNumericSpace($codigo, true);
    if($codigoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el codigo de producto: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $codigofabricaA = validarTextNumericSpace($codigobarra, false);
    if($codigofabricaA['error'] == false)
    {
        $dev['mensaje'] = "Error en el codigo Barra de producto: ".$codigofabricaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $nombreA = validarTextNumericSpace($nombre, false);
    if($nombreA['error'] == false)
    {
        $dev['mensaje'] = "Error en el nombre de producto: ".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $stockA = validarDecimal($stockminimo, true);
    if($stockA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo stock minimo: ".$stockA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $proveedorA = validarIdTablas($idproveedor, true);
    if($proveedorA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo proveedor: ".$proveedorA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idcategoriaA = validarIdTablas($idcategoria, true);
    if($idcategoriaA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Categoria: ".$idcategoriaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idestadoA = validarIdTablas($estado, true);
    if($idestadoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Estado: ".$idestadoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $descripcionA = validarTextNumericSpace($detalle, false);
    if($descripcionA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo descripcion: ".$descripcionA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }





    $sql[]=getSqlNewProductos($idproducto, $idcategoria, $idmarca, $codigo, $nombre, $detalle, $stockminimo, $numero, $estado, $unidad, $idproveedor, $name, $codigobarra,$idusuario, $return);
    $numeroemp = findUltimoID("empleadoproducto", "numero", true);
    $numeroe = $numeroemp['resultado']+1;
    $sql[]=getSqlNewEmpleadoproducto($idempleadoproducto, $numeroe, $idusuario, $idalmacen, $idproducto, false);

   $sqlalmacen = "
    SELECT
      *
    FROM
      almacenes a ;
    ";
    //        echo $sqlalmacen;
    $rowA=NumeroTuplas($sqlalmacen);
    $row=$rowA['resultado'];
    //    echo $row;
    $alm=getTablaToArrayOfSQL($sqlalmacen);
    $alm1=$alm['resultado'];
    $fechamodificacion = Date("Y-m-d");
    $numeroKardexmovA = findUltimoID("movimientokardexalmacen", "numero", true);
    $numerokardexmov = $numeroKardexmovA['resultado'] +1;
    for($i=0;$i<$row;$i++){
        $almacen=$alm1[$i];
        $idalmacen = $almacen['idalmacen'];

        $idmovimientokardexalmacen = "mka-".$numerokardexmov;
        //        echo $numerokardexmov;
        $sql[]=getSqlNewKardexalmacen($idproducto, $idalmacen, $codigo, $fechamodificacion, 0, 0, 0, 0, 0, 0, 0, 1, false);
        $sql[]=getSqlNewMovimientokardexalmacen($idmovimientokardexalmacen, $idproducto, $idalmacen, 0, 0, 0, 0, 0,0, 0, $fechamodificacion, date("H:i:s"), "nuevo producto", $numerokardexmov,0, false);
        $numerokardexmov++;
    }

    //    $idultimokardexA = findUltimoID("kardex", "numero", true);
    //    $numero1 = $idultimokardexA['resultado'] +1;
    //    $idkardex = "kar-".$numero1;
    //    $numeroA = findUltimoID("productos", "numero", true);
    //    $numero = $numeroA['resultado'] +1;
    //
    //    $idproducto = "pro-".$numero;
    //    $fechamodificacion = Date("Y-m-d");
    //    $precio1bs = 0;
    //    $precio1sus = 0;
    //    $precio2bs = 0;
    //    $precio2sus = 0;
    //    $costounitario = 0;
    //    $saldocantidad = 0;
    //    $cantidad = 0;
    //
    //
    //    $codigo = $numero1;
    //    $sql[]=getSqlNewKardex($idkardex, $idproducto, $codigo, $fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return);
    //    //}
    //    //if($idkardex=="kar-1001"){
    //    $numeroKardexA = findUltimoIDforanyway("movimientokardex", "numero", "idproducto", $idproducto, true);
    //    $numerokardex = $numeroKardexA['resultado'] +1;
    //    $idmovimientokardex = "mok-".$numerokardex;
    //    $sql[]=getSqlNewMovimientokardex($idmovimientokardex, $idproducto, 0, 0, 0, 0, 0, 0,"cracion de nuevo producto", $fechamodificacion, date("H:i:s"), $numerokardex, 0, "creacion de nuevo producto",0, false);
    //    $idultimokardexalmacenA = findUltimoID("kardexalmacen", "numero", true);
    //    $numero2 = $idultimokardexalmacenA['resultado'] +1;
    //    $idkardex = "kar-".$numero2;
    //
    //
    //    //$idcategoria = "kar-".$numero1;
    //    $fechamodificacion = Date("Y-m-d");
    //    $precio1bs = 0;
    //    $precio1sus = 0;
    //    $precio2bs = 0;
    //    $precio2sus = 0;
    //    $costounitario = 0;
    //    //$estadoCuenta = "nueva cuenta";
    //    $codigo = Date("Y/m").":".$numero1."/".$idproducto;
    //
    //    // $codigo = $numero1;


    //        MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardo correctamente el producto";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al registrar producto";
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


function getSqlNewMarcas($idmarca, $nombre, $numero, $detalle, $return){
    $setC[0]['campo'] = 'idmarca';
    $setC[0]['dato'] = $idmarca;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'numero';
    $setC[2]['dato'] = $numero;
    $setC[3]['campo'] = 'detalle';
    $setC[3]['dato'] = $detalle;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO marcas ".$sql2;
}
function getSqlNewProductos($idproducto, $idcategoria, $idmarca, $codigo, $nombre, $detalle, $stockminimo, $numero, $estado, $unidad, $idproveedor, $imagen, $codigobarra, $idusuario,$return){
    $setC[0]['campo'] = 'idproducto';
    $setC[0]['dato'] = $idproducto;
    $setC[1]['campo'] = 'idcategoria';
    $setC[1]['dato'] = $idcategoria;
    $setC[2]['campo'] = 'idmarca';
    $setC[2]['dato'] = $idmarca;
    $setC[3]['campo'] = 'codigo';
    $setC[3]['dato'] = $codigo;
    $setC[4]['campo'] = 'nombre';
    $setC[4]['dato'] = $nombre;
    $setC[5]['campo'] = 'detalle';
    $setC[5]['dato'] = $detalle;
    $setC[6]['campo'] = 'stockminimo';
    $setC[6]['dato'] = $stockminimo;
    $setC[7]['campo'] = 'numero';
    $setC[7]['dato'] = $numero;
    $setC[8]['campo'] = 'estado';
    $setC[8]['dato'] = $estado;
    $setC[9]['campo'] = 'unidad';
    $setC[9]['dato'] = $unidad;
    $setC[10]['campo'] = 'idproveedor';
    $setC[10]['dato'] = $idproveedor;
    $setC[11]['campo'] = 'imagen';
    $setC[11]['dato'] = $imagen;
    $setC[12]['campo'] = 'codigobarra';
    $setC[12]['dato'] = $codigobarra;
    $setC[13]['campo'] = 'idusuario';
    $setC[13]['dato'] = $idusuario;

    $sql2 = generarInsertValues($setC);
    return "INSERT INTO productos ".$sql2;
}


function getSqlNewKardex($idkardex, $idproducto, $codigo, $fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return){
    $setC[0]['campo'] = 'idkardex';
    $setC[0]['dato'] = $idkardex;
    $setC[1]['campo'] = 'idproducto';
    $setC[1]['dato'] = $idproducto;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'fechamodificacion';
    $setC[3]['dato'] = $fechamodificacion;
    $setC[4]['campo'] = 'saldocantidad';
    $setC[4]['dato'] = $saldocantidad;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;
    $setC[6]['campo'] = 'precio1bs';
    $setC[6]['dato'] = $precio1bs;
    $setC[7]['campo'] = 'precio1sus';
    $setC[7]['dato'] = $precio1sus;
    $setC[8]['campo'] = 'precio2bs';
    $setC[8]['dato'] = $precio2bs;
    $setC[9]['campo'] = 'precio2sus';
    $setC[9]['dato'] = $precio2sus;
    $setC[10]['campo'] = 'costounitario';
    $setC[10]['dato'] = $costounitario;
    $setC[11]['campo'] = 'numero';
    $setC[11]['dato'] = $numero;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO kardex ".$sql2;
}
function getSqlNewKardexalmacen($idproducto, $idalmacen, $codigo, $fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero,$generado, $return){
    $setC[0]['campo'] = 'idproducto';
    $setC[0]['dato'] = $idproducto;
    $setC[1]['campo'] = 'idalmacen';
    $setC[1]['dato'] = $idalmacen;
    $setC[2]['campo'] = 'codigo';
    $setC[2]['dato'] = $codigo;
    $setC[3]['campo'] = 'fechamodificacion';
    $setC[3]['dato'] = $fechamodificacion;
    $setC[4]['campo'] = 'saldocantidad';
    $setC[4]['dato'] = $saldocantidad;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;
    $setC[6]['campo'] = 'precio1bs';
    $setC[6]['dato'] = $precio1bs;
    $setC[7]['campo'] = 'precio1sus';
    $setC[7]['dato'] = $precio1sus;
    $setC[8]['campo'] = 'precio2bs';
    $setC[8]['dato'] = $precio2bs;
    $setC[9]['campo'] = 'precio2sus';
    $setC[9]['dato'] = $precio2sus;
    $setC[10]['campo'] = 'costounitario';
    $setC[10]['dato'] = $costounitario;
    $setC[11]['campo'] = 'numero';
    $setC[11]['dato'] = $numero;
     $setC[12]['campo'] = 'generado';
    $setC[12]['dato'] = $generado;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO kardexalmacen ".$sql2;
}

function listarcategoria($start, $limit, $sort, $dir, $callback, $_dc, $return)
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
    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT
  ct.idcategoria AS idcategoria,
  ct.nombre
FROM
  `categorias` ct $order";
    }
    else
    {
        $sql = "SELECT
  ct.idcategoria AS idcategoria,
  ct.nombre
FROM
  `categorias` ct $order LIMIT $start,$limit ";
    }
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
function listarmarca($start, $limit, $sort, $dir, $callback, $_dc, $return)
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
    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT
  pv.idmarca AS idmarca,
  pv.nombre
FROM
  marcas pv $order";
    }
    else
    {
        $sql = "SELECT
  pv.idmarca,
  pv.nombre
FROM
  marcas pv $order LIMIT $start,$limit ";
    }
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
function listarprove($start, $limit, $sort, $dir, $callback, $_dc, $return)
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
    if($star == 0 && $limit == 0)
    {
        $sql = "SELECT
  pv.idproveedor AS proveedor,
  pv.nombre
FROM
  proveedores pv $order";
    }
    else
    {
        $sql = "SELECT
  pv.idproveedor,
  pv.nombre
FROM
  proveedores pv $order LIMIT $start,$limit ";
    }
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
function listarmarcaycategoria($start, $limit, $sort, $dir, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $marca = listarmarca(0, 0, "", "", "", "", true);
    if($marca['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marca['resultado'];
    }
    $categoria= listarcategoria(0, 0, "", "", "", "", true);
    if($categoria['error'] == true)
    {
        $value['categorias'] = "true";
        $value['categoriaM'] = $categoria['resultado'];
    }
    $prove= listarprove(0, 0, "", "", "", "", true);
    if($prove['error'] == true)
    {
        $value['prove'] = "true";
        $value['proveM'] = $prove['resultado'];
    }
    $usuario= listarempleadoalmacen(0, 0, "", "", "", "","",true);
    if($usuario['error'] == true)
    {
        $value['usuarios'] = "true";
        $value['usuarioM'] = $usuario['resultado'];
    }

    //	   MostrarConsulta($sql);
    $dev['error']   = "true";
    $dev['mensaje'] = "Se cargaron los datos correctamente";
    $dev['resultado'] = $value;
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

function datosactualizarproducto($idproducto, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    //echo "hola";
    $idalmacen = $_SESSION['idalmacen'];
    $categoria = listarcategoria(0, 0, "", "", "", "", true);
    if($categoria['error'] == true)
    {
        $value['categorias'] = "true";
        $value['categoriaM'] = $categoria['resultado'];
    }
    $marca= listarmarca(0, 0, "", "", "", "", true);
    if($marca['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $marca['resultado'];
    }

    $usuario= listarempleadoalmacen(0, 0, "", "", "", "","",true);
    if($usuario['error'] == true)
    {
        $value['usuarios'] = "true";
        $value['usuarioM'] = $usuario['resultado'];
    }
    $verificarA = verificarValidarText($idproducto, true, "empleadoproducto", "idproducto");
    $verificar = $verificarA['resultado'];
    if($verificar == true){
        $sql = "
SELECT
  c.idproducto,
  c.codigo,
  c.idcategoria,
  c.idproveedor,
  c.nombre,
  c.detalle AS descripcion,
  c.stockminimo,
  c.estado,
  c.numero,
  c.unidad,
  c.codigobarra AS codigofabrica,
  c.idmarca,

  em.idempleado as idusuario
FROM
  productos c,
  empleadoproducto em
WHERE
  c.idproducto = '$idproducto' AND
  c.idproducto = em.idproducto AND
  em.idalmacen = '$idalmacen'
"
        ;
    }
    else{
        $sql = "

SELECT
  c.idproducto,
  c.codigo,
  c.idcategoria,
  c.idproveedor,
  c.nombre,
  c.detalle AS descripcion,
  c.stockminimo,
  c.estado,
  c.numero,
  c.unidad,
  c.codigobarra AS codigofabrica,
  c.idmarca,
  c.idusuario
FROM
  productos c
WHERE
  c.idproducto = '$idproducto'
";
    }



    //        echo $sql;
    if($idproducto != null)
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
    $tuplas= NumeroTuplas($sql);
    $dev['totalCount'] = $tuplas['resultado'];

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
function getSqlNewEmpleadoproducto($idempleadoproducto, $numero, $idempleado, $idalmacen, $idproducto, $return){
    $setC[0]['campo'] = 'idempleadoproducto';
    $setC[0]['dato'] = $idempleadoproducto;
    $setC[1]['campo'] = 'numero';
    $setC[1]['dato'] = $numero;
    $setC[2]['campo'] = 'idempleado';
    $setC[2]['dato'] = $idempleado;
    $setC[3]['campo'] = 'idalmacen';
    $setC[3]['dato'] = $idalmacen;
    $setC[4]['campo'] = 'idproducto';
    $setC[4]['dato'] = $idproducto;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO empleadoproducto ".$sql2;
}

function buscarporcodigo($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "SELECT
  c.idproducto,
  c.idkardex,
  c.codigo AS codigo,
  c.nombre,
  c.detalle AS descripcion,
  c.stockminimo,
  c.estado,
  c.unidad,
  c.numero,
  c.codigofrabrica AS codigofabrica FROM productos c WHERE c.codigo = '$codigo' ";
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
//////////////////////// Modificado por Andy ////////////////////////////////////
function buscarporcodigobarra($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen = $_SESSION['idalmacen'];
    $sql = "
SELECT
              prod.idproducto,
              prod.codigo,
              prod.nombre,
              prov.nombre AS proveedor,
              kalm.saldocantidad as cantidad,
              kalm.costounitario,
              kalm.precio1bs  as precio,
              kalm.precio2bs as precio2

            FROM
              productos prod,
              proveedores prov,
              kardexalmacen kalm
            WHERE
              prod.idproducto = kalm.idproducto AND
              prod.idproveedor = prov.idproveedor AND
              kalm.idalmacen = '$idalmacen' AND prod.codigobarra = '$codigo' ";


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

function BuscarCodigoProducto($codigo, $callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $idalmacen = $_SESSION['idalmacen'];
    $sql = "
SELECT
              prod.idproducto,
              prod.codigo,
              prod.nombre,
              prov.nombre AS proveedor,
              kalm.saldocantidad as cantidad,
              kalm.costounitario,
              kalm.precio1bs as precio,
              kalm.precio2bs as precio2
            FROM
              productos prod,
              proveedores prov,
              kardexalmacen kalm
            WHERE
              prod.idproducto = kalm.idproducto AND
              prod.idproveedor = prov.idproveedor AND
              kalm.idalmacen = '$idalmacen' AND prod.codigo = '$codigo' ";

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

//////////////////////// Modificado por Andy ////////////////////////////////////
function listarproductoscompraentrega($idcompra,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{

    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";



    $sql = "

SELECT
  pro.idproducto,
  pro.codigo,
  prv.nombre AS proveedor,
  pro.nombre,
  cat.nombre AS categoria,
  pro.unidad,
  it.cantidadentrega as cantidad,
  it.preciobs as precio1bs,
  it.preciosus AS precio1sus,
  it.precio
FROM
  items it,
  productos pro,
  proveedores prv,
  categorias cat
WHERE
  it.idproducto = pro.idproducto AND
  pro.idcategoria = cat.idcategoria AND
  pro.idproveedor = prv.idproveedor AND
  it.cantidadentrega > 0 AND
  it.idcompra = '$idcompra'



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

                $dev['mensaje'] = "No existe en prod con es";
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
    $tuplas = NumeroTuplas($sql);
    $dev['totalCount'] = $tuplas['resultado'];
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

function listarproductosalmacen($idalmacen,$start, $limit, $sort, $dir, $callback, $_dc,$where = '', $return = "true")
{

    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    if($idalmacen == 'alm-1000'){
        $sql = '
SELECT
  pro.idproducto,
  prv.nombre AS proveedor,
  pro.codigo,
  pro.nombre,
  kar.saldocantidad AS cantidad,
  kar.precio1bs,
  kar.precio2bs,
  cat.nombre AS categoria
FROM
  productos pro,
  proveedores prv,
  kardex kar,
  categorias cat
WHERE
  pro.idproducto = kar.idproducto AND
  pro.idcategoria = cat.idcategoria AND
  pro.idproveedor = prv.idproveedor
';

    }
    else{

        $sql = "
SELECT
  pro.idproducto,
  pro.codigo,
  pro.nombre,
  cat.nombre AS categoria,
  prv.nombre AS proveedor,
  kar.saldocantidad AS cantidad,
  kar.precio1bs,
  kar.precio2bs
FROM
  `proveedores` prv,
  `kardexalmacen` kar,
  `productos` pro,
  `categorias` cat
WHERE
  pro.idproducto = kar.idproducto AND
  pro.idproveedor = prv.idproveedor AND
  pro.idcategoria = cat.idcategoria AND
  kar.idalmacen = '$idalmacen'
";
    }
    //echo $sql;
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

                $dev['mensaje'] = "No existe en prod con es";
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
    $tuplas = NumeroTuplas($sql);
    $dev['totalCount'] = $tuplas['resultado'];
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

function actualizarproducto($resultado,$return){
    //    function modificarcliente($resultado,$return){

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idproducto = $resultado->idproducto;

    $nombre = $resultado->nombres;

    $estado = $resultado->estado;
    $idcategoria = $resultado->idcategoria;
    $idproveedor = $resultado->idproveedor;
    $marca = $resultado->idmarca;
    $stockminimo = $resultado->stockminimo;
    $codigofrabrica = $resultado->codigobarra;
    $detalle = $resultado->descripcion;
    $codigo = $resultado->codigo;
    $idusuario = $resultado->idempleado;
    $idalmacen = $_SESSION['idalmacen'];
    //   $unidad = $resultado->unidad;

    $codigoA = validarTextNumericSpace($codigo, true);
    if($codigoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo codigo de producto: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $nombreA = validarTextNumericSpace($nombre, true);
    if($nombreA['error'] == false)
    {
        $dev['mensaje'] = "Error en el nombre de producto: ".$nombreA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $stockA = validarDecimal($stockminimo, false);
    if($stockA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo stock minimo: ".$stockA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $proveedorA = validarIdTablas($idproveedor, true);
    if($proveedorA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo proveedor: ".$proveedorA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idcategoriaA = validarIdTablas($idcategoria, true);
    if($idcategoriaA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Categoria: ".$idcategoriaA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idestadoA = validarIdTablas($estado, true);
    if($idestadoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Estado: ".$idestadoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $descripcionA = validarTextNumericSpace($detalle, false);
    if($descripcionA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo descripcion: ".$descripcionA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }



    $sql[]=getSqlUpdateProductos($idproducto, $idkardex, $idcategoria, $marca, $codigo, $nombre, $detalle, $stockminimo, $numero, $estado, $codigofrabrica, $unidad, $idproveedor,$idusuario, $return);
    $sql[]="DELETE FROM empleadoproducto WHERE idproducto =  '$idproducto' AND idalmacen = '$idalmacen';";

    $numeroemp = findUltimoID("empleadoproducto", "numero", true);
    $numeroe = $numeroemp['resultado']+1;
    $sql[]=getSqlNewEmpleadoproducto($idempleadoproducto, $numeroe, $idusuario, $idalmacen, $idproducto, false);

    //    $sql[]=getSqlUpdateKardex($idkardex,$idproducto,$codigo,$fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return);
    //}
    //if($idkardex=="kar-1001"){
    //
    //    $idultimokardexalmacenA = findUltimoID("kardexalmacen", "numero", true);
    //    $numero2 = $idultimokardexalmacenA['resultado'] +1;
    //    $idkardex = "kar-".$numero2;
    //    $numeroA = findUltimoID("productos", "numero", true);
    //    $numero = $numeroA['resultado'] +1;
    //    $idproducto = "pro-".$numero;
    //    $fechamodificacion = Date("Y-m-d");
    //    $precio1bs = 0;
    //    $precio1sus = 0;
    //    $precio2bs = 0;
    //    $precio2sus = 0;
    //    $costounitario = 0;
    //$estadoCuenta = "nueva cuenta";
    //    $codigo = Date("Y/m").":".$numero1."/".$idproducto;

    // $codigo = $numero1;
    //    $sql[]=getSqlUpdateKardexalmacen($idproducto,$idalmacen,$codigo,$fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return);
    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los productos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los productos";
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
function getSqlUpdateProductos($idproducto, $idkardex, $idcategoria, $marca, $codigo, $nombre, $detalle, $stockminimo, $numero, $estado, $codigofrabrica, $unidad, $idproveedor,$idusuario, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'nombre';
    $setC[1]['dato'] = $nombre;
    $setC[2]['campo'] = 'detalle';
    $setC[2]['dato'] = $detalle;
    $setC[3]['campo'] = 'stockminimo';
    $setC[3]['dato'] = $stockminimo;
    $setC[4]['campo'] = 'estado';
    $setC[4]['dato'] = $estado;
    $setC[5]['campo'] = 'codigobarra';
    $setC[5]['dato'] = $codigofrabrica;
    $setC[6]['campo'] = 'unidad';
    $setC[6]['dato'] = $unidad;
    $setC[7]['campo'] = 'idcategoria';
    $setC[7]['dato'] = $idcategoria;
    $setC[8]['campo'] = 'idmarca';
    $setC[8]['dato'] = $marca;
    $setC[9]['campo'] = 'idproveedor';
    $setC[9]['dato'] = $idproveedor;
    $setC[10]['campo'] = 'idusuario';
    $setC[10]['dato'] = $idusuario;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idproducto';
    $wher[0]['dato'] = $idproducto;

    $where = generarWhereUpdate($wher);
    return "UPDATE productos SET ".$set." WHERE ".$where;
}

function getSqlUpdateKardex($idkardex,$idproducto,$codigo,$fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'fechamodificacion';
    $setC[1]['dato'] = $fechamodificacion;
    $setC[2]['campo'] = 'saldocantidad';
    $setC[2]['dato'] = $saldocantidad;
    $setC[3]['campo'] = 'cantidad';
    $setC[3]['dato'] = $cantidad;
    $setC[4]['campo'] = 'precio1bs';
    $setC[4]['dato'] = $precio1bs;
    $setC[5]['campo'] = 'precio1sus';
    $setC[5]['dato'] = $precio1sus;
    $setC[6]['campo'] = 'precio2bs';
    $setC[6]['dato'] = $precio2bs;
    $setC[7]['campo'] = 'precio2sus';
    $setC[7]['dato'] = $precio2sus;
    $setC[8]['campo'] = 'costounitario';
    $setC[8]['dato'] = $costounitario;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idkardex';
    $wher[0]['dato'] = $idkardex;
    $wher[1]['campo'] = 'idproducto';
    $wher[1]['dato'] = $idproducto;

    $where = generarWhereUpdate($wher);
    return "UPDATE kardex SET ".$set." WHERE ".$where;
}
function getSqlUpdateKardexalmacen($idproducto,$idalmacen,$codigo,$fechamodificacion, $saldocantidad, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $costounitario, $numero, $return){
    $setC[0]['campo'] = 'codigo';
    $setC[0]['dato'] = $codigo;
    $setC[1]['campo'] = 'fechamodificacion';
    $setC[1]['dato'] = $fechamodificacion;
    $setC[2]['campo'] = 'saldocantidad';
    $setC[2]['dato'] = $saldocantidad;
    $setC[3]['campo'] = 'cantidad';
    $setC[3]['dato'] = $cantidad;
    $setC[4]['campo'] = 'precio1bs';
    $setC[4]['dato'] = $precio1bs;
    $setC[5]['campo'] = 'precio1sus';
    $setC[5]['dato'] = $precio1sus;
    $setC[6]['campo'] = 'precio2bs';
    $setC[6]['dato'] = $precio2bs;
    $setC[7]['campo'] = 'precio2sus';
    $setC[7]['dato'] = $precio2sus;
    $setC[8]['campo'] = 'costounitario';
    $setC[8]['dato'] = $costounitario;
    $setC[9]['campo'] = 'numero';
    $setC[9]['dato'] = $numero;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idproducto';
    $wher[0]['dato'] = $idproducto;
    $wher[1]['campo'] = 'idalmacen';
    $wher[1]['dato'] = $idalmacen;

    $where = generarWhereUpdate($wher);
    return "UPDATE kardexalmacen SET ".$set." WHERE ".$where;
}


function getSqlDeleteKardex($idKardex){
    return "DELETE FROM kardex WHERE idKardex = $idKardex";
}

function eliminarproductos($productos,$callback, $_dc, $return = 'true')
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $error = "";
    for($i = 0; $i< count($productos); $i++)
    {
        $producto = $productos[$i];
        $idproducto = $producto->idproducto;

        $itemproducto = verificarValidarText($idproducto, true, "items", "idproducto");
        $itemproducto1 = verificarValidarText($idproducto, true, "itemventa", "idproducto");
        $itemproducto2 = verificarValidarText($idproducto, true, "detalletraspaso", "idproducto");
        if(($itemproducto['error'] == false)&&($itemproducto1['error'] == false)&&($itemproducto2['error'] == false)){
            $sql[] = "DELETE FROM productos WHERE idproducto = '$idproducto';";

            $sql[] = "DELETE FROM kardexalmacen WHERE idproducto = '$idproducto'";

            $sql[] = "DELETE FROM movimientokardexalmacen WHERE idproducto = '$idproducto'";
            $sql1 = "
Select imagen FROM productos where idproducto = '$idproducto';
";
            $imagenA = findBySqlReturnCampoUnique($sql1,true, true,"imagen" );
            $imagen = $imagenA['resultado'];
            if($imagen!=null){
                if(!unlink($imagen)){
                    $dev['mensaje'] = "Error al eliminir la imagen";
                    $json = new Services_JSON();
                    $output = $json->encode($dev);
                    print($output);
                    exit;


                }
            }
        }
        else{
            $dev['mensaje'] = "El producto no se puede eliminar ya que afectara al estado de RESULTADO";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }

    }
    //  MostrarConsulta($sql);


    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        if($error ==""){
            $dev['mensaje'] = "Se Eliminaron los productos correctamente";
            $dev['error'] = "true";
            $dev['resultado'] = "";
        }
        else{
            $dev['mensaje'] = "Se Eliminaron los productos correctamente a excepcion de los siguientes producto $error";
            $dev['error'] = "true";
            $dev['resultado'] = "";
        }

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
function getSqlNewMovimientokardex($idmovimientokardex, $idproducto, $entrada, $salida, $saldo, $ingreso, $egreso, $saldobs, $compra, $fecha, $hora, $numero, $preciounitario, $descripcion, $saldocantidad,$return){
    $setC[0]['campo'] = 'idmovimientokardex';
    $setC[0]['dato'] = $idmovimientokardex;
    $setC[1]['campo'] = 'idproducto';
    $setC[1]['dato'] = $idproducto;
    $setC[2]['campo'] = 'entrada';
    $setC[2]['dato'] = $entrada;
    $setC[3]['campo'] = 'salida';
    $setC[3]['dato'] = $salida;
    $setC[4]['campo'] = 'saldo';
    $setC[4]['dato'] = $saldo;
    $setC[5]['campo'] = 'ingreso';
    $setC[5]['dato'] = $ingreso;
    $setC[6]['campo'] = 'egreso';
    $setC[6]['dato'] = $egreso;
    $setC[7]['campo'] = 'saldobs';
    $setC[7]['dato'] = $saldobs;
    $setC[8]['campo'] = 'compra';
    $setC[8]['dato'] = $compra;
    $setC[9]['campo'] = 'fecha';
    $setC[9]['dato'] = $fecha;
    $setC[10]['campo'] = 'hora';
    $setC[10]['dato'] = $hora;
    $setC[11]['campo'] = 'numero';
    $setC[11]['dato'] = $numero;
    $setC[12]['campo'] = 'preciounitario';
    $setC[12]['dato'] = $preciounitario;
    $setC[13]['campo'] = 'descripcion';
    $setC[13]['dato'] = $descripcion;
    $setC[14]['campo'] = 'saldocantidad';
    $setC[14]['dato'] = $saldocantidad;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO Movimientokardex ".$sql2;
}
function getSqlNewMovimientokardexalmacen($idmovimientokardexalmacen, $idproducto, $idalmacen, $entrada, $salida, $saldo, $costounitario, $ingreso, $egreso, $saldobs, $fecha, $hora, $descripcion, $numero, $saldocantidad, $return){
    $setC[0]['campo'] = 'idmovimientokardexalmacen';
    $setC[0]['dato'] = $idmovimientokardexalmacen;
    $setC[1]['campo'] = 'idproducto';
    $setC[1]['dato'] = $idproducto;
    $setC[2]['campo'] = 'idalmacen';
    $setC[2]['dato'] = $idalmacen;
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
    return "INSERT INTO movimientokardexalmacen ".$sql2;
}
function getPrecioProductoKardex($fechamodificacion, $idproducto, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $return){
    $setC[0]['campo'] = 'fechamodificacion';
    $setC[0]['dato'] = $fechamodificacion;
    $setC[1]['campo'] = 'precio1bs';
    $setC[1]['dato'] = $precio1bs;
    $setC[2]['campo'] = 'precio1sus';
    $setC[2]['dato'] = $precio1sus;
    $setC[3]['campo'] = 'precio2bs';
    $setC[3]['dato'] = $precio2bs;
    $setC[4]['campo'] = 'precio2sus';
    $setC[4]['dato'] = $precio2sus;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idproducto';
    $wher[0]['dato'] = $idproducto;

    $where = generarWhereUpdate($wher);
    return "UPDATE kardex SET ".$set." WHERE ".$where;
}
function getPrecioProductoKardexAlmacen($fechamodificacion, $idproducto, $cantidad, $precio1bs, $precio1sus, $precio2bs, $precio2sus, $return){
    $setC[0]['campo'] = 'fechamodificacion';
    $setC[0]['dato'] = $fechamodificacion;
    $setC[1]['campo'] = 'precio1bs';
    $setC[1]['dato'] = $precio1bs;
    $setC[2]['campo'] = 'precio1sus';
    $setC[2]['dato'] = $precio1sus;
    $setC[3]['campo'] = 'precio2bs';
    $setC[3]['dato'] = $precio2bs;
    $setC[4]['campo'] = 'precio2sus';
    $setC[4]['dato'] = $precio2sus;
    $setC[5]['campo'] = 'cantidad';
    $setC[5]['dato'] = $cantidad;

    $set = generarSetsUpdate($setC);
    $wher[0]['campo'] = 'idproducto';
    $wher[0]['dato'] = $idproducto;
    $wher[1]['campo'] = 'idalmacen';
    $wher[1]['dato'] = 'alm-1000';

    $where = generarWhereUpdate($wher);
    return "UPDATE kardexalmacen SET ".$set." WHERE ".$where;
}