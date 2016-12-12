<?php 
session_name("balderrama");
session_start();
include("impl/Pedidos.php");
include("impl/DetallePedido.php");
include("impl/IngresoAlmacen.php");
include("impl/Linea.php");
include("impl/Modelo.php");
include("impl/Colores.php");
include("impl/Marca.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarPedidos"){
        $band = false;
        $idpedido = $_GET['idpedido'];
        $extra .="det.idpedido = '$idpedido'";
        if($_GET['buscarnumeropedido'] != null)
        {
            if($band == false) {
                $extras .= " pe.numeropedido LIKE '%".$_GET['buscarnumeropedido']."%'";
                $band = true;
            }
            else {
                $extras .= " AND lin.codigo LIKE '%".$_GET['buscarnumeropedido']."%'";
            }
        }
         if($_GET['buscarfecha'] != null)
        {
            if($band == false) {
                $extras .= " pe.fecha LIKE '%".$_GET['buscarfecha']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.fecha LIKE '%".$_GET['buscarfecha']."%'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
                $band = true;
            }
            else {
                $extras .= " AND ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }
        if($_GET['buscarestado'] != null)
        {
            if($band == false) {
                $extras .= " pe.estado LIKE '%".$_GET['buscarestado']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND pe.estado LIKE '%".$_GET['buscarestado']."%'";
            }
        }
       
        ListarPedidos($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }

    else if($funcion =="BuscarModeloPorId"){

        buscarModeloporId($_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion =="BuscarModeloPorIdtienda"){

        buscarModeloporIdtienda($_GET['idmodelo'],$_GET['idestilo'], $_GET['idmarca'],$_GET['callback'], $_GET['_dc'],false);
    }
      else if($funcion =="BuscarModeloUnion"){

        buscarModeloUnion($_GET['idmodelo'],$_GET['opcion'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
    }
     else if($funcion =="BuscarModeloPorIdSimple"){

        buscarModeloporIdSimple($_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
    }
      else if($funcion =="BuscarPedidoPorId"){

        buscarPedidoPorId($_GET['idpedido'], $_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion =="BuscarModeloPorCodigo"){

        buscarModeloporCodigo($_GET['idmodelo'], $_GET['callback'], $_GET['_dc'],false);
    }else if($funcion =="BuscarModeloPorIdPedidoRegistrar"){
       $opcionmarca = $_GET['opcionmarca'];
        if ($opcionmarca=='8'){
        BuscarModeloPorIdtiendaRegistrar($_GET['modelo'],$_GET['idestilo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
         if ($opcionmarca=='5'){
        BuscarModeloPorIdtiendaRegistrarModeloPedido($_GET['modelo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
           if ($opcionmarca=='6'){
        BuscarModeloPorIdtiendaRegistrarModeloPedido($_GET['modelo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
     if ($opcionmarca=='3'){
        BuscarModeloPorIdtiendaRegistrarLineaPedido($_GET['modelo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
         if ($opcionmarca=='12'){
        BuscarModeloPorIdtiendaRegistrarColorPedido($_GET['modelo'],$_GET['idmarca'], $_GET['callback'], $_GET['_dc'],false);
         }
    }
    else if($funcion =="GuardarNuevoPedido"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        //insertarventa($datos,false);
        GuardarNuevoPedido($datos,false);
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