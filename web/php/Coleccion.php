<?php 
session_name("balderrama");
session_start();
require_once("impl/Coleccion.php");
require_once("impl/Anio.php");
require_once("impl/Marca.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1001", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarColecciones"){
        $band = false;
        if($_GET['buscarcodigo'] != null)
        {
            if($band == false) {
                $extras .= " col.codigo LIKE '%".$_GET['buscarcodigo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND col.codigo LIKE '%".$_GET['buscarcodigo']."%'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " mar.idmarca LIKE '".$_GET['buscarmarca']."'";
                $band = true;
            }
            else {
                $extras .= " AND mar.idmarca LIKE '".$_GET['buscarmarca']."'";
            }
        }
        if($_GET['buscaranio'] != null)
        {
            if($band == false) {
                $extras .= " col.anio LIKE '%".$_GET['buscaranio']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND col.anio LIKE '%".$_GET['buscaranio']."%'";
            }
        }
       

        ListarColecciones($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
    else if($funcion == "BuscarMarcaAnio"){
        BuscarMarcaAnio($_GET['callback'], $_GET['_dc'], "",false);
    }
    else if($funcion == "GuardarNuevaColeccion"){
        InsertarNuevoColeccion();
    }
    else if($funcion =="BuscarMarcaAnioPorId"){
        $idcoleccion = $_GET['idcoleccion'];
        BuscarMarcaAnioPorId($idcoleccion,false);
    }
    else if($funcion =="GuardarEditarColeccion"){
        GuardarEditarColeccion();
    }
    else if($funcion =="EliminarColeccion"){
        EliminarColeccion($_GET['idcoleccion'],$_GET['callback'], $$_GET['dc'],'');
    }
    else if($funcion =="BuscarModeloPorIdColeccion"){
        BuscarModeloPorIdColeccion($_GET['idcoleccion'],$_GET['callback'], $$_GET['dc'],'');
    }
    else if($funcion =="GuardarListaDePrecios"){
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
        GuardarListaDePrecios($datos,false);
    }
    else{
        echo "else";
    }


}
else
{
    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
    $dev['error'] = "false";
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}
?>