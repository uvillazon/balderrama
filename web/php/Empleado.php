<?php 
session_name("balderrama");
session_start();
include("impl/Ciudad.php");
include("impl/Cargo.php");
include("impl/Empleado.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
require_once("Session.php");

$session = new Session();
if(permitido("fun1001", $session->codigo)==true)
{
    $funcion = $_GET['funcion'];
    if($funcion == "ListarEmpleados"){
        ListarEmpleados($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $_GET['where'], false , $session);
    }
    else if($funcion == "ListarEmpleadoMarca"){
        $extras = $_GET['idempleado'];
        ListarEmpleadoMarca($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras,false);
    }
      else if($funcion == "finddatosmarcaempleado")
    {

        finddatosmarcaempleado($_GET['idempleado'], $_GET['callback'], $_GET['_dc'], false);
    }

else
if($funcion == "ListarVendedor"){
        ListarVendedor($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $_GET['where'], false);
    }

    else if($funcion == "CargarNuevoEmpleado"){

        CargarNuevoEmpleado(false);
    }
      else if($funcion == "CargarMarcas"){

        CargarMarcasEmpleado(false);
    }
     else if($funcion == "insertarMarcaEmpleado"){
        insertarMarcaEmpleado();
    }
    else if($funcion == "EditarMarcaEstado"){
        EditarMarcaEstado();
    }
    else if($funcion == "GuardarNuevoEmpleado"){
//        echo "hola";exit();pruebafinal
        InsertarNuevoEmpleado(false);
    }
    else if($funcion =="CargarDatosEditarEmpleado"){
        $idempleado = $_GET['idempleado'];
        CargarDatosEditarEmpleado($idempleado,$_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion =="GuardarEditarEmpleado"){
        
        GuardarEditarEmpleado(false);

    } else

    if($funcion =="GuardarEstadoEmpleado"){
        GuardarEstadoEmpleado(false);
       } else
    if($funcion =="buscarMarcasEmpleado"){
        $idmaterial = $_GET['idempleado'];
          $idmarca = $_GET['idmarca'];
        buscarMarcasEmpleado($idmaterial,$idmarca,false);
    }
     else if($funcion =="EliminarEmpleado"){
        $idestilo = $_GET['idempleado'];
        EliminarEmpleado($idestilo, $_GET['callback'],$_GET['_dc'],false);
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