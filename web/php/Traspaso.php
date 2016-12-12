<?php 
session_name("balderrama");
session_start();
require_once("impl/Traspaso.php");
require_once("impl/IngresoAlmacen.php");
//require_once("impl/Tienda.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

//if(permitido("fun1000", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarAlmacen"){
       
        ListarAlmacen($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], "",false);
    }else
   if($funcion == "listarTraspaso")
{
    $band = false;
    if($_GET['buscarcodigo'] != null)
    {
        if($band == false) {
            $extras .= " tra.boleta LIKE '%".$_GET['buscarcodigo']."%'";
            $band = true;
        }
        else {
            $extras .= " AND tra.boleta LIKE '%".$_GET['buscarcodigo']."%'";
        }
    }
    if($_GET['buscarfecha'] != null)
    {$fechafin=$_GET['buscarfecha'];
            $formatear = explode( '-' , $fechafin);
$fecha = $formatear[2].'-'.$formatear[1].'-' .$formatear[0];
//echo $fecha;
        if($band == false) {
            $extras .= " tra.fecha = '".$fecha."'";
            $band = true;
        }
        else {
            $extras .= " AND tra.fecha = '".$fecha."'";
        }
    }

    if($_GET['buscartienda'] != null)
    {
        if($band == false) {
            $extras .= " ori.idalmacen ='".$_GET['buscartienda']."'";
            $band = true;
        }
        else {
            $extras .= " AND ori.idalmacen LIKE '%".$_GET['buscartienda']."%'";
        }
    }
if($_GET['buscartipo'] != null)
    {$tipotraspaso = $_GET['buscartipo'];

        listartraspasos2($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,$tipotraspaso, false);

    }
else {
       listartraspasos($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);

     }

}else
 if($funcion =="registrarcambiotraspaso"){

        registrarcambiotraspaso();
    }else
    if($funcion =="registrarcambiovendedor"){

        registrarcambiovendedor();
    }else
if($funcion =="GuardarNuevoTraspaso"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        
     //   GuardarNuevoTraspaso($datos,false);
    }else
    if($funcion =="GuardarNuevoTraspasoEnvio"){

        $sql3 = "SELECT estado FROM concurrenciatraspaso";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
           $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
         GuardarNuevoTraspasoEnvio($datos,false);
        }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando TRASPASO en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
       
         
    }else
    if($funcion == "txSaveTraspaso"){
       $sql3 = "SELECT estado FROM concurrenciatraspaso";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
         $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
      txSaveTraspaso($datos,false);
        }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando TRASPASO en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }


   
}else

 if($funcion == "txanularTraspaso"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
      txanularTraspaso($datos,false);
}else

    if($funcion == "txSaveTraspasoCaja"){


     $sql3 = "SELECT estado FROM concurrenciatraspaso";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'estado');
        $estadoactual = $saldocantidadA1['resultado'];
        if($estadoactual =='libre' || $estadoactual=="libre"){
       $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
      txSaveTraspasoCaja($datos,false);
        }else{
            $dev['mensaje'] = "Por favor espere 10 segundos ,otra sesion esta registrando TRASPASO en este momento";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;
        }
    
}else

if($funcion == "Listarempleadosmarca"){
       // echo "looll";
        Listarempleadosmarca2($_GET['callback'], $_GET['_dc'],$_GET['idalmacen'],$_GET['idmarca'],false);
    }
 else if($funcion =="BuscarMaterialPorTraspaso"){
        $idtraspaso = $_GET['idtraspaso'];
        BuscarMaterialPorTraspaso($idtraspaso,false);
    }else
    if($funcion == "buscarproductostraspaso")
    {   buscarproductostraspaso($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false,  $_GET['idtraspaso']);
    }
    else{
        echo "else";
    }


//}
//else
//{
//    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
//    $dev['error'] = "false";
//    $json = new Services_JSON();
//    $output = $json->encode($dev);
//    print($output);
//}
?>