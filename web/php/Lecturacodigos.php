<?php
session_name("balderrama");
session_start();
require_once('../lib/includeLibs.php');
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if($_GET['funcion']=="validaalta"){
      //Aquí es donde subimos a base de datos
        $idalmacen =$_SESSION['idalmacen'];
        $idmarca = $_REQUEST['idmarca'];
         $idvendedor = $_REQUEST['idvendedor'];
       // $idmarca = $_GET['idmarca'];
   //  $idvendedor = $_GET['idvendedor'];
      $fecha = Date("Y-m-d");

  $codigobarraA1= actualizarcodigosvendedor($idalmacen,$idmarca,$idvendedor,false);
 $respuesta = $codigobarraA1['respuestita'];
  echo 'completado ';
// if($respuesta=="ok"){
//  echo 'Se actualizo correctamente la base de datos, puede imprimir su inventario actualizado ';
//       }else{
//  echo 'Un error al actualizar ';
//       }

}
else


if($_GET['funcion']=="insertararchivo"){

//if(isset($_POST['submit']))
 //   {
        //Aquí es donde seleccionamos nuestro csv
        $idalmacen =$_SESSION['idalmacen'];
        $idmarca = $_POST['idmarca'];
     $idvendedor = $_POST['idvendedor'];
      $fecha = Date("Y-m-d");
     
         $fname = $_FILES['file']['name'];
         echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);

         if(strtolower(end($chk_ext)) == "csv")
         {
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['file']['tmp_name'];
             $handle = fopen($filename, "r");

             while (($data = fgetcsv($handle, 0, ",")) !== FALSE)
             {$columna1 = $data[0];
               //Insertamos los datos con los valores...
                $sql = "INSERT into lecturainventario(codigobarra, idalmacen, idmarca,idvendedor,fecha) values('$columna1','$idalmacen','$idmarca','$idvendedor','$fecha')";
                mysql_query($sql) or die(mysql_error());
             }
             //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);
             echo ".......IMPORTACION EXITOSA!";
                    echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>CONFIRMAR EN ALMACEN</title>
</head>

<body>

<form action='Lecturacodigos.php?funcion=validaalta'  method='post' enctype='multipart/form-data' name='form1' id='form1'>
  <p>&nbsp;</p>
  <p>

<input name='idmarca'  value='$idmarca' />
<input name='idvendedor'  value='$idvendedor' />

    <input type='submit' name='Submit' value='SUBIR A BASE DATOS' />
    </label>
  </p>
</form>
</body>
</html>
";


         }
         else
         {
            //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             //ver si esta separado por " , "
             echo "Archivo invalido !";
         }
     //   }

}

else if($_GET['funcion']=="subirarchivo")
{
    $idmarca = $_GET['idmarca'];
     $idvendedor = $_GET['idvendedor'];
        echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Subir Archivos</title>
</head>

<body>
 
<form action='Lecturacodigos.php?funcion=insertararchivo'  method='post' enctype='multipart/form-data' name='form1' id='form1'>
  <p>&nbsp;</p>

  <p>

    <label>Subir Archivo
    <input type='file' name='file' />
    </label>
  </p>
  <p>
    <label>
     <input name='idmarca' type='hidden' value='$idmarca' />
<input name='idvendedor' type='hidden' value='$idvendedor' />
    <input type='submit' name='Submit' value='confirmar Archivos' />
    </label>
  </p>
</form>
</body>
</html>
";


}
else{

}
function actualizarcodigosvendedor($idalmacen,$idmarca,$idvendedor,$return = false)
{ set_time_limit(0);
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
//    $idmarca='mar-33';
//    $idvendedor='emp-67';
actualizainventario($idkardexunico,$idmodelo,$idvendedor,$idmarca,$idalmacen,false);
$numeroD = findUltimoID("modelo", "numero", true);
    $numeromodelo = $numeroD['resultado'] +1;

$sql ="
SELECT codigobarra
FROM lecturainventario
WHERE idalmacen='$idalmacen' AND idmarca='$idmarca' and idvendedor='$idvendedor';
";
//echo $sql;
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
//while($fi = mysql_fetch_array($re));
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                                mysql_field_name($re, $i) == "codigobarra";
                                $idkardexunico = $fi[$i];
                       //         echo $idplanillaemitida;
             $iditemventa =$iditemventa+1;
              $sql31 = " SELECT idmodelo FROM kardexdetallepar WHERE codigobarra='$idkardexunico'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
        $idmodelo = $cantidadventaA1['resultado'];
      $sql31 = " SELECT * FROM modelo WHERE idmodelo='$idmodelo' and idvendedor='$idvendedor' and idmarca='$idmarca' and idalmacen='$idalmacen'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idmodelo");
        $idmodeloexiste = $cantidadventaA1['resultado'];
        //$sqlA[] = "UPDATE kardexdetallepar kp,modelo m SET kp.kardex=kp.saldocantidad,kp.saldocantidad='0'  where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and m.idmarca='$idmarca' and kp.idalmacen='$idalmacen';";

            $sql31 = " SELECT kp.idkardexunico FROM kardexdetallepar kp,modelo m WHERE kp.codigobarra='$idkardexunico' and  kp.idmodelo=m.idmodelo  and m.idvendedor='$idvendedor' and m.idmarca='$idmarca' and kp.idalmacen='$idalmacen'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idkardexunico");
        $idmodeloexiste1 = $cantidadventaA1['resultado'];

         if($idmodeloexiste1==null || $idmodeloexiste1==''){
             //no hay
                 actualizaparcero($idkardexunico,$idmodelo,$idmodelonuevo,$numeromodelo,$idvendedor,$idmarca,$idalmacen,false);
             }else{
                  actualizapar($idkardexunico,$idmodelo,$idvendedor,$idmarca,$idalmacen,false);
              }
//        if($idmodeloexiste==null || $idmodeloexiste==''){
//        // generar con modelo nuevo  //opcion unir
//    $idmodelonuevo = "m-".$numeromodelo;
//
//        actualizaparymodelo($idkardexunico,$idmodelonuevo,$numeromodelo,$idmodelo,$idvendedor,$idmarca,$idalmacen,false);
//
//   }else{
//
//         //solo actualizar
//       actualizapar($idkardexunico,$idmodelo,$idvendedor,$idmarca,$idalmacen,false);
//
//         }

               //   insertarpares($iditemventa,$idkardexunico,$idmodelo,$idventa,$idempleado,$idcliente,false);

                     }
                    }while($fi = mysql_fetch_array($re));
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
           $dev['respuestita'] = "ok";
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
            //print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
           // print($output);
        }


    }

}

function  actualizaparymodelo($codigobarra,$idmodelonuevo,$numeromodelo,$idmodelo,$vendedordestino,$idmarca,$idalmacen,$return){
    set_time_limit(0);
     $sql12 = "SELECT * FROM kardexdetallepar WHERE codigobarra = '$codigobarra' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idkardexunico");
    $idkardexunico = $saldocantidadA['resultado'];

  $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];

 $sql125 = "SELECT CONCAT(a.nombre,'/',c.codigo) AS cliente FROM almacenes a,ciudades c WHERE a.idciudad=c.idciudad and a.idalmacen = '$idalmacen' ";
       $saldocantidadA1 = findBySqlReturnCampoUnique($sql125, true, true, "cliente");
    $clientenuevo = $saldocantidadA1['resultado'];
    $tipo="";

//echo $sql12;
if($estadotraspaso!="ninguno" || $estadotraspaso!='ninguno')
    {

//$sql1224 = "SELECT t.idmodelo FROM traspasodetallepar t,modelo m WHERE t.idmodelo=m.idmodelo and t.idimpresion='$almacendestino' and t.idmodeloorigen = '$idmodelo' group by t.idmodeloorigen ";
//    $saldocantidadA = findBySqlReturnCampoUnique($sql1224, true, true, "idmodelo");
//    $idmodelonuevotraspaso = $saldocantidadA['resultado'];

    $sql122 = "SELECT idmodelo FROM kardexdetallepar WHERE idmodelo = '$idmodelonuevotraspaso' and idalmacen='$idalmacen' group by idmodelo ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql122, true, true, "idmodelo");
    $idmodeloexiste = $saldocantidadA['resultado'];

//echo $sql122;
    if($idmodeloexiste == null || $idmodeloexiste == ""){

//
//     $sql[] = getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelonuevo, $clientenuevo, $numerodetalle, $idtraspaso, $idalmaceningreso, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso,false);
//       $numerodetalle++;
$sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, "ninguno", $fechaingreso, false);
 $numeromodelo++;
$idmodelonuevo = $idmodelonuevo;
   $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
 $tipo="noexiste";
         }
        else{
$sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";

        $idmodelonuevo = $idmodeloexiste;
   }


   //hasta aqui por si falla
  // echo $idmodelonuevo;
  $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
    }
else{
//echo "nuevooooooo";
//$sql[] = getSqlNewTraspasomodelo($idtraspasomodelo, $idmodelo, $idmodelonuevo, $clientenuevo, $numerodetalle, $idtraspaso, $idalmaceningreso, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $talla, $idalmacen, $estadotraspaso,false);
//       $numerodetalle++;
$sql[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $vendedordestino, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Activo", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, "ninguno", $fechaingreso, false);
 $numeromodelo++;

   $sql[] = "UPDATE modelo SET estadotraspaso='$idmodelonuevo' where idmodelo='$idmodelo';";
 $tipo="noexiste";
    }
  switch($formatomayor){
  case '10':
if($tallakardex=="U"){$tallakardex="34";}
if($tallakardex=="XS"){$tallakardex="35";}
if($tallakardex=="S"){$tallakardex="36";}
if($tallakardex=="P"){$tallakardex="37";}
if($tallakardex=="M"){$tallakardex="38";}
if($tallakardex=="L"){$tallakardex="39";}
if($tallakardex=="XL"){$tallakardex="40";}
$sql12 = "SELECT cantidad FROM kardexdetalle WHERE idmodelo = '$idmodelo' and tallakardex='$tallakardex' ";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex -1;
     $sql[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where idmodelo = '$idmodelo' and tallakardex='$tallakardex';";


    break;
  default:
$sql12 = "SELECT cantidad FROM kardexdetalle WHERE idmodelo = '$idmodelo' and tallakardex='$tallakardex' ";
       $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "cantidad");
    $saldocantidadkardex = $saldocantidadA['resultado'];
    $saldocantidadkardex=$saldocantidadkardex -1;
     $sql[] = "UPDATE kardexdetalle SET cantidad='$saldocantidadkardex' where idmodelo = '$idmodelo' and tallakardex='$tallakardex';";


        break;
}

// $sql[] =getSqlNewTraspasodetallepar($idkardexunico, $idkardex, $idtraspaso, $idmodelonuevo, '1', $tallakardex, $idtraspaso, $preciounitario, 'no', '0', $idperiodo, $almacendestino, $idmodelo, false);
 $sql[] = "UPDATE kardexdetallepar SET saldocantidad='1',lector='1' ,idmodelo='$idmodelonuevo',idalmacen='$idalmacen' where idkardexunico='$idkardexunico';";
//$sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";

//$sqlA[] = "UPDATE kardexdetallepar SET saldocantidad='1',lector='1' where idkardexunico='$idkardexunico' and idmodelo='$idmodelo' and idalmacen='$idalmacen';";



ejecutarConsultaSQLBeginCommit($sqlA);
//   if(ejecutarConsultaSQLBeginCommit($sqlA))
//    {
//       $dev['mensaje'] = "";
//        $dev['error'] = "true";
//        $dev['resultado'] = "$iditemventa";
//    }
//    else
//    {
//        $dev['mensaje'] = "";
//        $dev['error'] = "false";
//        $dev['resultado'] = "$iditemventa";
//    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
       // print($output);
    }
}
function  actualizaparcero($codigobarra,$idmodelo,$idmodelonuevo,$numeromodelo,$idvendedor,$idmarca,$idalmacen,$return){
    set_time_limit(0);
    
        //echo $idmodelo;
 $sql12 = "SELECT * FROM modelo WHERE idmodelo = '$idmodelo' ";
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmodelodetalle");
    $idmodelodetalle = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idmarca");
    $idmarca = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "codigo");
    $codigo = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "color");
    $color = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "material");
    $material = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "linea");
    $linea = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "idcoleccion");
    $idcoleccion = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "precioventa");
    $precioventa = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "preciounitario");
    $preciounitario = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "numeroparesfila");
    $numeroparesfila = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "talla");
    $tallam = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "estadotraspaso");
    $estadotraspaso = $saldocantidadA['resultado'];
    $saldocantidadA = findBySqlReturnCampoUnique($sql12, true, true, "fechaingreso");
    $fechaingreso = $saldocantidadA['resultado'];

     $sql125 = "SELECT CONCAT(a.nombre,'/',c.codigo) AS cliente FROM almacenes a,ciudades c WHERE a.idciudad=c.idciudad and a.idalmacen = '$almacendestino' ";
       $saldocantidadA1 = findBySqlReturnCampoUnique($sql125, true, true, "cliente");
    $clientenuevo = $saldocantidadA1['resultado'];
  $sql312 = " SELECT * FROM modelo WHERE estado='Pendiente' and idmarca='$idmarca' and idvendedor='$idvendedor' and idalmacen='$idalmacen'";
        $cantidadventaA12 = findBySqlReturnCampoUnique($sql312, true, true, "idvendedor");
        $existemodeloss = $cantidadventaA12['resultado'];
//  if($existemodeloss==null || $existemodeloss==''){
//        $sqlA[] =getSqlNewModelo($idmodelonuevo, $idmodelodetalle, $idmarca, $idvendedor, $codigo, $color, $material, $linea, $clientenuevo, $numeromodelo, $idingreso, $fechareal, $hora, $generado, $opciont, $unido, $inventario, $rebaja, "Pendiente", $idcoleccion, $almacendestino, $precioventa, $preciounitario, $preciototalcaja, '1', $numeroparesfila, $numeroparesfila, $numeracion, $modificar, $tallam, $almacendestino, "ninguno", $fechaingreso, false);
//     $numeromodelo++;
//    }else{
//
//    }
       $sql31 = " SELECT * FROM modelo WHERE idmodelo='$idmodelo'";
        $cantidadventaA1 = findBySqlReturnCampoUnique($sql31, true, true, "idvendedor");
        $idvendedoractual = $cantidadventaA1['resultado'];

$sqlA[] = "UPDATE lecturainventario SET confirmado='1',idvendedoractual='$idvendedoractual',idmodelo='$idmodelo',idmodelonuevo='$idmodelonuevo' where codigobarra='$codigobarra';";
$idmodelonuevo = "m-".$numeromodelo;


ejecutarConsultaSQLBeginCommit($sqlA);


}

function  actualizapar($codigobarra,$idmodelo,$idvendedor,$idmarca,$idalmacen,$return){
    set_time_limit(0);

$sqlA[] = "UPDATE kardexdetallepar SET saldocantidad='1',lector='1' where codigobarra='$codigobarra' and idmodelo='$idmodelo' and idalmacen='$idalmacen';";

//$sqlA[] = "UPDATE lecturainventario SET confirmado='1' where codigobarra='$codigobarra';";

ejecutarConsultaSQLBeginCommit($sqlA);

//   if(ejecutarConsultaSQLBeginCommit($sqlA))
//    {
//       $dev['mensaje'] = "";
//        $dev['error'] = "true";
//        $dev['resultado'] = "$iditemventa";
//    }
//    else
//    {
//        $dev['mensaje'] = "";
//        $dev['error'] = "false";
//        $dev['resultado'] = "$iditemventa";
//    }
//    if($return == true)
//    {
//        return $dev;
//    }
//    else
//    {
//        $json = new Services_JSON();
//        $output = $json->encode($dev);
//       // print($output);
//    }
}

function  actualizainventario($idkardexunico,$idmodelo,$idvendedor,$idmarca,$idalmacen,$return){
    set_time_limit(0);



$sqlA[] = "UPDATE kardexdetallepar kp,modelo m SET kp.kardex=kp.saldocantidad,kp.saldocantidad='0'  where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and m.idmarca='$idmarca' and kp.idalmacen='$idalmacen';";
ejecutarConsultaSQLBeginCommit($sqlA);

}
function getSqlNewModelo($idmodelo, $idmodelodetalle, $idmarca, $idvendedor, $codigo, $color, $material, $linea, $cliente, $numero, $idingreso, $fecha, $hora, $generado, $opciont, $unido, $inventario, $rebaja, $estado, $idcoleccion, $idcliente, $precioventa, $preciounitario, $preciototalcaja, $numerocajas, $numeroparesfila, $totalparescaja, $numeracion, $modificar, $talla, $idalmacen, $estadotraspaso, $fechaingreso, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'idmodelodetalle';
$setC[1]['dato'] = $idmodelodetalle;
$setC[2]['campo'] = 'idmarca';
$setC[2]['dato'] = $idmarca;
$setC[3]['campo'] = 'idvendedor';
$setC[3]['dato'] = $idvendedor;
$setC[4]['campo'] = 'codigo';
$setC[4]['dato'] = $codigo;
$setC[5]['campo'] = 'color';
$setC[5]['dato'] = $color;
$setC[6]['campo'] = 'material';
$setC[6]['dato'] = $material;
$setC[7]['campo'] = 'linea';
$setC[7]['dato'] = $linea;
$setC[8]['campo'] = 'cliente';
$setC[8]['dato'] = $cliente;
$setC[9]['campo'] = 'numero';
$setC[9]['dato'] = $numero;
$setC[10]['campo'] = 'idingreso';
$setC[10]['dato'] = $idingreso;
$setC[11]['campo'] = 'fecha';
$setC[11]['dato'] = $fecha;
$setC[12]['campo'] = 'hora';
$setC[12]['dato'] = $hora;
$setC[13]['campo'] = 'generado';
$setC[13]['dato'] = $generado;
$setC[14]['campo'] = 'opciont';
$setC[14]['dato'] = $opciont;
$setC[15]['campo'] = 'unido';
$setC[15]['dato'] = $unido;
$setC[16]['campo'] = 'inventario';
$setC[16]['dato'] = $inventario;
$setC[17]['campo'] = 'rebaja';
$setC[17]['dato'] = $rebaja;
$setC[18]['campo'] = 'estado';
$setC[18]['dato'] = $estado;
$setC[19]['campo'] = 'idcoleccion';
$setC[19]['dato'] = $idcoleccion;
$setC[20]['campo'] = 'idcliente';
$setC[20]['dato'] = $idcliente;
$setC[21]['campo'] = 'precioventa';
$setC[21]['dato'] = $precioventa;
$setC[22]['campo'] = 'preciounitario';
$setC[22]['dato'] = $preciounitario;
$setC[23]['campo'] = 'preciototalcaja';
$setC[23]['dato'] = $preciototalcaja;
$setC[24]['campo'] = 'numerocajas';
$setC[24]['dato'] = $numerocajas;
$setC[25]['campo'] = 'numeroparesfila';
$setC[25]['dato'] = $numeroparesfila;
$setC[26]['campo'] = 'totalparescaja';
$setC[26]['dato'] = $totalparescaja;
$setC[27]['campo'] = 'numeracion';
$setC[27]['dato'] = $numeracion;
$setC[28]['campo'] = 'modificar';
$setC[28]['dato'] = $modificar;
$setC[29]['campo'] = 'talla';
$setC[29]['dato'] = $talla;
$setC[30]['campo'] = 'idalmacen';
$setC[30]['dato'] = $idalmacen;
$setC[31]['campo'] = 'estadotraspaso';
$setC[31]['dato'] = $estadotraspaso;
$setC[32]['campo'] = 'fechaingreso';
$setC[32]['dato'] = $fechaingreso;
$sql2 = generarInsertValues($setC);
return "INSERT INTO modelo ".$sql2;
}
?>