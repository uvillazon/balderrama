<?php 
session_name("balderrama");
session_start();
require_once("impl/Calzado.php");
include("impl/Linea.php");
include("impl/Coleccion.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarCalzado")
    {
        $band = false;
        if($_GET['buscarmodelo'] != null)
        {
            if($band == false) {
                $extras .= " mo.codigo LIKE '%".$_GET['buscarmodelo']."%'";
                $band = true;
            }
            else {
                $extras .= " AND mo.codigo LIKE '%".$_GET['buscarmodelo']."%'";
            }
        }
        if($_GET['buscarcoleccion'] != null)
        {
            if($band == false) {
                $extras .= " co.codigo LIKE '%".$_GET['buscarcoleccion']."%'";
                $band = true;
            }
            else {
                $extras .= " AND co.codigo LIKE '%".$_GET['buscarcoleccion']."%'";
            }
        }
        if($_GET['buscarlinea'] != null)
        {
            if($band == false) {
                $extras .= " li.codigo LIKE '%".$_GET['buscarlinea']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND li.codigo LIKE '%".$_GET['buscarlinea']."%'";
            }
        }
        if($_GET['buscarmarca'] != null)
        {
            if($band == false) {
                $extras .= " ma.nombre LIKE '%".$_GET['buscarmarca']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND ma.nombre LIKE '%".$_GET['buscarmarca']."%'";
            }
        }
        if($_GET['buscarcolor'] != null)
        {
            if($band == false) {
                $extras .= " car.descripcioncolor LIKE '%".$_GET['buscarcolor']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND car.descripcioncolor LIKE '%".$_GET['buscarcolor']."%'";
            }
        }
        if($_GET['buscarmaterial'] != null)
        {
            if($band == false) {
                $extras .= " car.descripcionmaterial LIKE '%".$_GET['buscarmaterial']."%' ";
                $band = true;
            }
            else {
                $extras .= " AND car.descripcionmaterial LIKE '%".$_GET['buscarmaterial']."%'";
            }
        }

        ListarCalzado($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion =="BuscarLineaColeccionMarca"){
        $idmarca = $_GET['idmarca'];
        BuscarLineaColeccionMarca($idmarca,false);


    }
    else if($funcion =="BuscarLineaColeccionMarcaPorId"){
        $idmarca = $_GET['idmodelo'];
        BuscarLineaColeccionMarcaPorId($idmarca,false);
    }
    else if($funcion =="GuardarNuevoModelo"){
        GuardarNuevoModelo();

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