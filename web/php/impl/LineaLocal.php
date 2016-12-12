<?php
function ListarLineaLocal($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  lin.idlinealocal AS idlinea,
  lin.codigo,
  lin.nombre,
  lin.descripcion,
  mar.nombre as marca
FROM
  `linealocal` lin,
  `marcadetalle` mar
WHERE
  lin.idmarcadetalle = mar.idmarcadetalle
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

function BuscarMarcalocal($callback, $_dc, $where = '', $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudad = ListarMarca("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    

    if($ciudad["error"]==true){
        $dev['mensaje'] = "Todo Ok";
        $dev['error']   = "true";
        $value["marcaM"] = $ciudad['resultado'];
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

function InsertarNuevoLinea(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = strtoupper($_GET['codigo']);
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo : ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    $codigoA1 = verificarValidarText($codigo, false, "linealocal", "codigo");
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

    $ciudad =$_GET['marca'];
    $ciudadA = validarText($ciudad, true);
    if($ciudadA['error']==false){
        $dev['mensaje'] = "Error en la marca: ".$ciudadA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
  $idmarcadetalle =$_GET['idmarca'];
    $direccion=strtoupper($_GET['descripcion']);
    //    $estado=$_GET['estado'];
    //    $email=$_GET['email'];
    $numeroA = findUltimoID("linealocal", "numero", true);
    $numero = $numeroA['resultado']+1;


    $idlinealocal = 'lin-'.$numero;
    $sql[] = getSqlNewLinealocal($idlinealocal, $codigo, $nombre, $descripcion, $numero, $idmarcadetalle, false);

   //        MostrarConsulta($sql);
// if($_GET['tipos']=='TIENDA'){
//        $sql[]= getSqlNewTiendas($idtienda, $idalmacen, $codigo, $nombre, $responsable, $direccion, $telefono, $email, $numero, $estado, $fax, $return);
//    }
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
function getSqlNewLinealocal($idlinealocal, $codigo, $nombre, $descripcion, $numero, $idmarcadetalle, $return){
$setC[0]['campo'] = 'idlinealocal';
$setC[0]['dato'] = $idlinealocal;
$setC[1]['campo'] = 'codigo';
$setC[1]['dato'] = $codigo;
$setC[2]['campo'] = 'nombre';
$setC[2]['dato'] = $nombre;
$setC[3]['campo'] = 'descripcion';
$setC[3]['dato'] = $descripcion;
$setC[4]['campo'] = 'numero';
$setC[4]['dato'] = $numero;
$setC[5]['campo'] = 'idmarcadetalle';
$setC[5]['dato'] = $idmarcadetalle;
$sql2 = generarInsertValues($setC);
return "INSERT INTO linealocal ".$sql2;
}
//
?>