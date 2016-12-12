<?php
session_name("balderrama");
session_start();
include("bd/bd.php");
include("impl/Utils.php");
include("impl/Colores.php");
//include("impl/ColoresDao.php");
//include("impl/PaisDAO.php");
//include("impl/MarcaDAO.php");
//include("impl/UnidadDAO.php");
//include("impl/ProductoDAO.php");
require_once("impl/JSON.php");
require_once 'impl/ExcelReader.php';

$nombre = $_GET['file'];

$ext = strrchr($nombre, ".");
$ext = strtolower($ext);
if($ext == ".jpg")
{
    echo $html = "EL TIPO DE ARCHIVO NO ES VALIDO";
}
else if($ext == ".xlsx")
{

    // ExcelFile($filename, $encoding);
    $data = new Spreadsheet_Excel_Reader();

    // Set output Encoding.
    $data->setOutputEncoding('CP1251');

    $enlace = "../../php/configuracion/".$_SESSION['empresa']."/".$_GET['file'];
    $data->read($enlace);

    error_reporting(E_ALL ^ E_NOTICE);
//    $idCategoriaUltimoA = findUltimoID("categoria", "numero", true);
//    $idCategoriaUltimo = $idCategoriaUltimoA['resultado'] +1;
//
//    $idSubCategoriaUltimoA = findUltimoID("subcategoria", "numero", true);
//    $idSubCategoriaUltimo = $idSubCategoriaUltimoA['resultado'] +1;
//
//    $idPaisUltimoA = findUltimoID("pais", "numero", true);
//    $idPaisUltimo = $idPaisUltimoA['resultado'] +1;
//
//    $idMarcaUltimoA = findUltimoID("marca", "numero", true);
//    $idMarcaUltimo = $idMarcaUltimoA['resultado'] +1;
//
//    $idUnidadUltimoA = findUltimoID("unidad", "numero", true);
//    $idUnidadUltimo = $idUnidadUltimoA['resultado'] +1;
//
//    $idProductoUltimoA = findUltimoID("producto", "numero", true);
//    $idProductoUltimo = $idProductoUltimoA['resultado'] +1;
//
//    $idKardexUltimoA = findUltimoID("kardex", "numero", true);
//    $idKardexUltimo = $idKardexUltimoA['resultado'] +1;
//
//    $idMovimientoUltimoA = findUltimoID("movimiento", "numero", true);
//    $idMovimientoUltimo = $idMovimientoUltimoA['resultado'] +1;

    $idMovimientoUltimoA = findUltimoID("colores", "numero", true);
    $idMovimientoUltimo = $idMovimientoUltimoA['resultado'] +1;

    $marcaConcat = false;
    $fin = $data->sheets[0]['numRows'];
    for ($i = 2; $i <= $fin; $i++) {
        $codigoP = $data->sheets[0]['cells'][$i][1];
        $codigoP = strtoupper($codigoP);
        $sql = "SELECT p.codigo FROM producto p WHERE upper(p.codigo) = '$codigoP'";
        $productoA = findBySqlReturnCampoUnique($sql, true, true, "codigo");
        //    exit;
        if($productoA['error'] == "true")
        {
            $mensaje .= $i.".- Ya existe un producto con el codigo: ".$codigoP."<br>";
        }
        else
        {

            $categoria = $data->sheets[0]['cells'][$i][2];
            $categoria = strtoupper($categoria);
            $subcategoria = $data->sheets[0]['cells'][$i][3];
            $subcategoria = strtoupper($subcategoria);
            $codigoFabrica = $data->sheets[0]['cells'][$i][4];
            $nombre = $data->sheets[0]['cells'][$i][5];
            $marca = $data->sheets[0]['cells'][$i][6];
            $marca = strtoupper($marca);
            $pais = $data->sheets[0]['cells'][$i][7];
            $pais = strtoupper($pais);
            $codpais = $data->sheets[0]['cells'][$i][8];
            $codpais = strtoupper($codpais);
            $unidad = $data->sheets[0]['cells'][$i][9];
            $unidad = strtoupper($unidad);
            $costo = $data->sheets[0]['cells'][$i][10];
            $precioVenta = $data->sheets[0]['cells'][$i][11];
            $alm1 = $data->sheets[0]['cells'][$i][12];
            $alm2 = $data->sheets[0]['cells'][$i][13];
            $alm3 = $data->sheets[0]['cells'][$i][14];
            $alm4 = $data->sheets[0]['cells'][$i][15];
            $alm5 = $data->sheets[0]['cells'][$i][16];
            $stockminimo = $data->sheets[0]['cells'][$i][17];



            //Buscar si ya existe la categoria
            $sql = "SELECT c.idcategoria FROM categoria c WHERE upper(c.nombre) = '$categoria'";
            $categoriaA = findBySqlReturnCampoUnique($sql, true, true, "idcategoria");
            if($categoriaA['error'] == "true")
            {
                $idCategoria = $categoriaA['resultado'];
            }
            else
            {
                $sqlA[] = getSqlNewCategoria($categoria, $idCategoriaUltimo);
                $idCategoria = "cat-".$idCategoriaUltimo;
                $idCategoriaUltimo ++;
            }

            //Buscar si ya existe la subcategoria
            if($categoriaA['error'] == "true")
            {
                $sql = "SELECT s.idsubcategoria FROM subcategoria s WHERE upper(s.nombre) = '$subcategoria' AND s.idcategoria = '$idCategoria'";
                $subcategoriaA = findBySqlReturnCampoUnique($sql, true, true, "idsubcategoria");
                if($subcategoriaA['error'] == "true")
                {
                    $idSubCategoria = $subcategoriaA['resultado'];
                }
                else
                {
                    $sqlA[] = getSqlNewSubCategoria($subcategoria, $idSubCategoriaUltimo, $idCategoria);
                    $idSubCategoria = "sub-".$idSubCategoriaUltimo;
                    $idSubCategoriaUltimo ++;
                }
            }
            else
            {
                $sqlA[] = getSqlNewSubCategoria($subcategoria, $idSubCategoriaUltimo, $idCategoria);
                $idSubCategoria = "sub-".$idSubCategoriaUltimo;
                $idSubCategoriaUltimo ++;
            }

            //Buscar si ya existe Pais
            $sql = "SELECT p.idpais FROM pais p WHERE upper(p.nombre) = '$pais'";
            $paisA = findBySqlReturnCampoUnique($sql, true, true, "idpais");
            if($paisA['error'] == "true")
            {
                $idPais = $paisA['resultado'];
            }
            else
            {
                $sqlA[] = getSqlNewPais($pais, $idPaisUltimo, $codpais);
                $idPais = "pai-".$idPaisUltimo;
                $idPaisUltimo ++;
            }

            //Buscar si ya existe Marca
            $sql = "SELECT m.idmarca FROM marca m WHERE upper(m.nombre) = '$marca'";
            $marcaA = findBySqlReturnCampoUnique($sql, true, true, "idmarca");
            if($marcaA['error'] == "true")
            {
                $idMarca = $marcaA['resultado'];
            }
            else
            {
                $sqlA[] = getSqlNewMarca($marca, $idMarcaUltimo);
                $idMarca = "mar-".$idMarcaUltimo;
                $idMarcaUltimo ++;
            }

            //Buscar si ya existe unidad
            $sql = "SELECT u.idunidad FROM unidad u WHERE upper(u.nombre) = '$unidad'";
            $unidadA = findBySqlReturnCampoUnique($sql, true, true, "idunidad");
            if($unidadA['error'] == "true")
            {
                $idUnidad = $unidadA['resultado'];
            }
            else
            {
                $sqlA[] = getSqlNewUnidad($unidad, $idUnidadUltimo, "DECIMAL");
                $idUnidad = "uni-".$idUnidadUltimo;
                $idUnidadUltimo ++;
            }

            //    if ($codConcat == true) {
            //        if ($codpais < 10) {
            //            $codigoP = $codigoP."00".$codpais;
            //        } else if ($codpais < 100 && $codpais >= 10) {
            //            $codigoP = $codigoP."0".$codpais;
            //        } else {
            //            $codigoP = $codigoP."".$codpais;
            //        }
            //    }
            $precioVentaSus = $precioVenta;
            if(marcaConcat == true)
            {
                $nombre = $nombre." ".$marca;
            }
            $sqlA[] = getSqlNewProducto($nombre, $idProductoUltimo, $codigoP, $codigoFabrica, $nombre, $idMarca, $idPais, $idUnidad, $stockminimo, $precioVenta, $precioVentaSus, $idSubCategoria, "0", "0", "0", "Normal");
            $idProducto = "pro-".$idProductoUltimo;
            $idProductoUltimo ++;

            for($sss = 12; $sss <= 16; $sss++)
            {
                $alm = $data->sheets[0]['cells'][0][$sss];
                if($alm != "NULO")
                {
                    $cantidadSaldo += $data->sheets[0]['cells'][$i][$sss];
                }
            }

            //para kardex
            $valoradoSaldo = $cantidadSaldo*$costo;
            $sqlA[] = getSqlNewKardex($idKardexUltimo, $cantidadSaldo, $costo, $valoradoSaldo, $idProducto);
            $idKardex = "kar-".$idKardexUltimo;
            $idKardexUltimo ++;
            $sqlA[] = "UPDATE producto SET idkardex = '$idKardex' WHERE idproducto = '$idProducto';";
            $cantidadSaldo = 0;
            //para producto almacen
            for($sss = 12; $sss <= 16; $sss++)
            {
                $alm = $data->sheets[0]['cells'][1][$sss];
                if($alm != "NULO")
                {
                    //Buscar si ya existe Pais
                    $alm = strtoupper($alm);
                    $sql = "SELECT a.idalmacen FROM almacen a WHERE upper(a.nombre) = '$alm'";
                    $almacenA = findBySqlReturnCampoUnique($sql, true, true, "idalmacen");
                    if($almacenA['error'] == "true")
                    {
                        $idAlmacen = $almacenA['resultado'];
                        $cantidadEnAlmacen = $data->sheets[0]['cells'][$i][$sss];
                        $sqlA[] = getSqlNewProductoAlmacen($idProducto, $idAlmacen, $cantidadEnAlmacen, "");
                        $sqlA[] = getSqlMovimientoNewProducto($idProducto, $idAlmacen, $cantidadEnAlmacen, 0, "INICIO DE INVENTARIO", $_SESSION['codigo'], $idMovimientoUltimo, $costo, $cantidadSaldo, $idKardex, true);
                        $idMovimientoUltimo ++;
                    }
                    else
                    {
                        echo "No existe el almacen: ".$alm;
                        exit;
                    }
                }
            }
            //        MostrarConsulta($sqlA);
            //        exit;
            if(ejecutarConsultaSQLBeginCommit($sqlA) == true)
            {
                $mensaje .= "Se guardo correctamente el producto: ".$nombre."<br>";
            }
            else
            {
                $mensaje .= "Error al guardar el producto: ".$nombre."<br>";
                //             MostrarConsulta($sqlA);
            }
            $sqlA = null;
        }

    }
    //MostrarConsulta($sqlA);
    echo $mensaje;
    //MostrarConsulta($sqlA);


    //print_r($data);
    //print_r($data->formatRecords);
}

?>
