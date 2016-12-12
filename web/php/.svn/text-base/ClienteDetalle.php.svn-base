<?php 
session_name("balderrama");
session_start();
require_once("impl/ClienteDetalle.php");
//require_once("impl/VentaCredito.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
//ubadlo
if(permitido("fun1000", $_SESSION['codigo'])==true)
{
    $funcion = $_GET['funcion'];
   if($funcion == "listarcliente")
{
    $band = false;
    if($_GET['buscarnit'] != null)
    {
        if($band == false) {
            $extras .= " c.nit LIKE '%".$_GET['buscarnit']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.nit LIKE '%".$_GET['buscarnit']."%'";
        }
    }
    if($_GET['buscarnombres'] != null)
    {
        if($band == false) {
            $extras .= " c.nombre LIKE '%".$_GET['buscarnombres']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.nombre LIKE '%".$_GET['buscarnombres']."%'";
        }
    }
    if($_GET['buscarapellido'] != null)
    {
        if($band == false) {
            $extras .= " c.apellido LIKE '%".$_GET['buscarapellido']."%'";
            $band = true;
        }
        else {
            $extras .= " AND c.apellido LIKE '%".$_GET['buscarapellido']."%'";
       
        }
    }
	if($_GET['buscarempresa'] != null)
    {
        if($band == false) {
            $extras .= " emp.nombre LIKE '%".$_GET['buscarempresa']."%'";
            $band = true;
        }
        else {
            $extras .= " AND emp.nombre LIKE '%".$_GET['buscarempresa']."%'";
       
        }
    }
    listarcliente($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
}
else if($funcion == "BuscarEmpresa"){
        BuscarEmpresa($_GET['callback'], $_GET['_dc'], "",false);
    }
 
else if($funcion == "insertnuevocliente"){

    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    insertnuevocliente($datos,false);
}
else if($funcion == "BuscarEmpresas"){


    buscarempresas($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], false);
}

 else if($funcion =="buscarclienteporid"){
        $idcliente = $_GET['idclienteempresa'];
        buscarclienteporid($idcliente,$_GET['callback'], $_GET['_dc'],false);
    }
else if($funcion == "modificarcliente"){
    $resultado = $_GET['resultado'];
    $json = new Services_JSON();
    $datos = $json->decode($resultado);
    modificarcliente($datos,false);
}
else if($funcion == "eliminarcliente"){

      eliminarcliente($_GET['idclienteempresa'],$_GET['callback'], $$_GET['dc'],'');

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