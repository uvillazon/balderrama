<?php 
session_name("balderrama");
session_start();
include("impl/UsuariosAdmin.php");
include("impl/Rol.php");
require_once("impl/Almacen.php");
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");

//if(permitido("fun1001", $_SESSION['codigo'])==true)
//{
    $funcion = $_GET['funcion'];

    if($funcion == "findAllUsuario")
    {
        $band = false;
        if($_GET['buscarci'] != null)
        {
            if($band == false) {
                $extras .= " u.ci LIKE '%".$_GET['buscarci']."%'";
                $band = true;
            }
            else {
                $extras .= " AND u.ci LIKE '%".$_GET['buscarci']."%'";
            }
        }
        if($_GET['buscarnombres'] != null)
        {
            if($band == false) {
                $extras .= " u.nombre LIKE '%".$_GET['buscarnombres']."%'";
                $band = true;
            }
            else {
                $extras .= " AND u.nombre LIKE '%".$_GET['buscarnombres']."%'";
            }
        }
        if($_GET['buscarapellido'] != null)
        {
            if($band == false) {
                $extras .= " (u.apellido1 LIKE '%".$_GET['buscarapellido']."%' OR u.apellido2 LIKE '%".$_GET['buscarapellido']."%') ";
                $band = true;
            }
            else {
                $extras .= " AND (u.apellido1 LIKE '%".$_GET['buscarapellido']."%' OR u.apellido2 LIKE '%".$_GET['buscarapellido']."%') ";
            }
        }
        if($_GET['buscarlogin'] != null)
        {
            if($band == false) {
                $extras .= " u.login LIKE '%".$_GET['buscarlogin']."%'";
                $band = true;
            }
            else {
                $extras .= " AND u.login LIKE '%".$_GET['buscarlogin']."%'";
            }
        }
        findAllUsuario($_GET['start'], $_GET['limit'], $_GET['sort'], $_GET['dir'], $_GET['callback'], $_GET['_dc'], $extras, false);
    }
    else if($funcion == "findUsuarioByIdRolSucursalAlmacen")
    {
        findUsuarioByIdRolSucursalAlmacen($_GET['idusuario'], $_GET['callback'], $_GET['_dc'], false);
    } else if($funcion == "findRolSucursalAlmacenForNewUsuario")
    {
        findRolSucursalAlmacenForNewUsuario($_GET['callback'], $_GET['_dc'], false);
    }
    else if($funcion =="BuscarAlmacenes"){
        BuscarAlmacenes($_GET['callback'], $_GET['_dc'], "",false);
    }
    else if($funcion =="EliminarUsuario"){
         txDeleteUsuario($_GET['idusuario'], $_GET['callback'], $_GET['_dc'], false);
    }
    else if($funcion =="BuscarAlmacenPorUsuario"){
        $idusuario = $_GET['idusuario'];
        BuscarAlmacenPorUsuario($idusuario,$_GET['callback'], $_GET['_dc'],false);
    }
    else if($funcion == "GuardarNuevoUsuario"){

        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
      //  $da = txNewUsuario($datos->nombres, $datos->apellido1, $datos->apellido2, $datos->carnetidentidad, $datos->email, $datos->telefono, $datos->celular,
      //      $datos->login, $datos->paswd1, $datos->paswd2, $datos->idrol, $datos->estado, false);
        $da = txNewUsuario($_GET['nombres'],$_GET['apellido1'],$_GET['apellido2'],$_GET['carnetidentidad'],$_GET['email'],$_GET['telefono'],$_GET['celular'],$_GET['login'],$_GET['paswd1'],$_GET['paswd2'],$_GET['idrol'],$_GET['estado'], false);

    }
    
    else if($funcion == "txUpdateUsuario"){
// $_GET['idusuario']
        $resultado = $_GET['resultado'];
        $json = new Services_JSON();
        $datos = $json->decode($resultado);
         $da = txUpdateUsuario($_GET['idusuario'],$_GET['nombres'],$_GET['apellido1'],$_GET['apellido2'],$_GET['carnetidentidad'],$_GET['email'],$_GET['telefono'],$_GET['celular'],$_GET['login'],$_GET['paswd1'],$_GET['paswd2'],$_GET['idrol'],$_GET['estado'], false);
//         $da = txUpdateUsuario($_GET['idusuario'],$datos->idusuario,$datos->nombres, $datos->apellido1, $datos->apellido2, $datos->carnetidentidad, $datos->email, $datos->telefono, $datos->celular,
//            $datos->login, $datos->paswd1, $datos->paswd2, $datos->idrol, $datos->estado, false);

//        $da = txUpdateUsuario($datos->idusuario, $datos->nombres, $datos->apellido1, $datos->apellido2, $datos->carnetidentidad, $datos->email, $datos->telefono, $datos->celular,
//            $datos->login, $datos->paswd1, $datos->paswd2, date("Y-m-d"), $datos->idrol, $datos->estado,  false);
//      
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