<?php
function ListaPrecios($idcoleccionA, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    if(($_GET['resultado'] == "all")||(count($idcoleccionA)>1)){
        //        echo "hola";


        $sql = "
SELECT
  p.idproducto AS idproducto,
  a.nombre AS nombreP,
  ka.saldocantidad,
  0 AS preciomayor,
  0 AS costoreal,
  p.nombre

FROM
  `almacenes` a,
  `productos` p,
  `kardexalmacen` ka
WHERE
  p.idproducto = ka.idproducto AND
  ka.idalmacen = a.idalmacen AND
  a.idalmacen = '$idalmacen' AND
  ka.saldocantidad = 0
";
    }
    if(count($idcoleccionA)==1){
        //        echo " hola2";
        $idcoleccion = $idcoleccionA[0];

        $sql = "

SELECT
  cal.idcalzado,
  ca.descripcionmaterial AS material,
  ca.descripcioncolor AS color,
  cal.precio1sus AS preciooficina,
  cal.precio2sus AS preciomayor,
  cal.precio3sus AS precio3,
  mo.codigo AS modelo,
  ma.nombre AS marca
FROM
  calzados cal,
  caracteristicas ca,
  modelos mo,
  marcas ma
WHERE
  cal.idcaracteristica = ca.idcaracteristica AND
  cal.idmodelo = mo.idmodelo AND
  mo.idmarca = ma.idmarca AND
  mo.idcoleccion = '$idcoleccion' ;
";}
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

?>