<?php
function findAllUsuario($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = "true")
{$idalmacen =$_SESSION['idalmacen'];
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
    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
    $password = md5($password);
    if($where == null || $where == "")
    {
        $sql = "SELECT u.idusuario, u.nombre AS nombres, u.apellido1, u.apellido2, u.ci AS carnetidentidad,
u.email, u.telefono, u.celular, u.login, u.paswd, u.fechareg, u.estado, r.nombre AS rol, a.nombre AS almacen FROM usuario u,
rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen and u.idalmacen='$idalmacen' $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(u.*) AS total FROM usuario u, rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen ";
    }
    else
    {
        $sql = "SELECT u.idusuario, u.nombre AS nombres, u.apellido1, u.apellido2, u.ci AS carnetidentidad,
u.email, u.telefono, u.celular, u.login, u.paswd, u.fechareg, u.estado, r.nombre AS rol, a.nombre AS almacen FROM usuario u,
rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen  and u.idalmacen='$idalmacen' AND $where $order LIMIT $start,$limit ";
        $sqlTotal = "SELECT count(u.*) AS total FROM usuario u, rol r, almacenes a WHERE u.idrol = r.idrol AND u.idalmacen = a.idalmacen  AND $where";
    }
    // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
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
    $dev['totalCount'] = allBySql($sql);
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

function findRolSucursalAlmacenForNewUsuario($callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $rold = findAllRol(0, 0, "", "", "", "", true);
    if($rold['error'] == true)
    {
        $value['roles'] = "true";
        $value['rolesM'] = $rold['resultado'];
    }
    else
    {
        $value['roles'] = "false";
    }

//    $almacend = ListarAlmacen(0, 0, "", "", "", "","", true);
//    //$almacend = findAllAlmacenConcatSucursal(0, 0, "", "", "", "", true);
//    if($almacend['error'] == true)
//    {
//        $value['almacenes'] = "true";
//        $value['almacenesM'] = $almacend['resultado'];
//    }
//    else
//    {
//        $value['almacenes'] = "false";
//    }
    $dev['mensaje'] = "Existen resultados";
    $dev['error']   = "true";
    $dev['resultado'] = $value;
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }

}
function findUsuarioByIdRolSucursalAlmacen($idusuario, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";

    $sql = "SELECT u.* FROM usuario u, almacenes a WHERE u.idalmacen = a.idalmacen AND u.idusuario = '$idusuario'";
    if($idusuario != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{mysql_field_name($re, $i)}= $fi[$i];
                        }

                        $rold = findAllRol(0, 0, "", "", "", "", true);
                        if($rold['error'] == true)
                        {
                            $value['roles'] = "true";
                            $value['rolesM'] = $rold['resultado'];
                        }
                        else
                        {
                            $value['roles'] = "false";
                        }

                        $almacend = ListarAlmacen(0, 0, "", "", "", "","", true);
                        if($almacend['error'] == true)
                        {
                            $value['almacenes'] = "true";
                            $value['almacenesM'] = $almacend['resultado'];
                        }
                        else
                        {
                            $value['almacenes'] = "false";
                        }
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
                    $dev['mensaje'] = "No se encontro datos en la consulta";
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
    }
    else
    {
        $dev['mensaje'] = "El codigo de usuario es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    $dev['totalCount'] = allBySql($sql);
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }

}
function txNewUsuario($nombres, $apellido1, $apellido2, $carnetidentidad, $email, $telefono, $celular,$login, $pass1, $pass2, $idrol, $estado,  $return)
{$idalmacen =$_SESSION['idalmacen'];


 $nombres= strtoupper($nombres);
 $apellido1= strtoupper($apellido1);
 $apellido2= strtoupper($apellido2);

    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
   $sqla=" SELECT COUNT(idusuario) as cuantos FROM usuario WHERE login='$login'";
    $result = findBySqlReturnCampoUnique($sqla, true, true, "cuantos");
    $loginnn = $result['resultado'];
    if($loginnn > '0')
    {
        $dev['mensaje'] = "Error en el Login ,Ya existe el login asigne otro";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($pass1 != $pass2)
    {
        $dev['mensaje'] = "Error el password no es el mismo";
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }else  {
        $passwdA = $pass1;
        }


    $idUsuarioUltimoA = findUltimoID("usuario", "numero", true);
    $idUsuarioUltimo = $idUsuarioUltimoA['resultado'] +1;

    $setC[0]['campo'] = "nombre";
    $setC[0]['dato'] = $nombres;
    $setC[1]['campo'] = "apellido1";
    $setC[1]['dato'] = $apellido1;
    $setC[2]['campo'] = "apellido2";
    $setC[2]['dato'] = $apellido2;
    $setC[3]['campo'] = "ci";
    $setC[3]['dato'] = $carnetidentidad;
    $setC[4]['campo'] = "email";
    $setC[4]['dato'] = $email;
    $setC[5]['campo'] = "telefono";
    $setC[5]['dato'] = $telefono;
    $setC[6]['campo'] = "celular";
    $setC[6]['dato'] = $celular;
    $setC[7]['campo'] = "paswd";
    $setC[7]['dato'] = $passwdA;
    $setC[8]['campo'] = "idrol";
    $setC[8]['dato'] = $idrol;
    $setC[9]['campo'] = "estado";
    $setC[9]['dato'] = $estado;
    $setC[10]['campo'] = "idalmacen";
    $setC[10]['dato'] = $idalmacen;
    $setC[11]['campo'] = "login";
    $setC[11]['dato'] = $login;
    $setC[12]['campo'] = "fechareg";
    $setC[12]['dato'] = date("Y-m-d");
    $setC[13]['campo'] = "numero";
    $setC[13]['dato'] = $idUsuarioUltimo;
    $setC[14]['campo'] = "idusuario";
    $setC[14]['dato'] = "usr-".$idUsuarioUltimo;

    $set = generarInsertValues($setC);

    $sql[] = "INSERT INTO usuario ".$set;
  //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql) == true)
    {
        $dev['mensaje'] = "Se guardo correctamente el usuario";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error guardar el usuario";
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
function txDeleteUsuario($idusuario, $callback, $_dc, $return)
{
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $usuarioM = verificarValidarText($idusuario, true, "usuario", "idusuario");
    if($usuarioM['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo idusuario: ".$usuarioM['mensaje'];
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
        exit;
    }
    $sql = "DELETE FROM usuario WHERE idusuario = '".$usuarioM['dato']."'";
    if($usuarioM['error'] == "true")
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    $user = findUsuarioById($usuarioM['dato'], "", "", true);
                    if($user['error'] == "false")
                    {
                        $dev['mensaje'] = "Se elimino correctamente al usuario";
                        $dev['error']   = "true";
                    }
                    else
                    {
                        $dev['mensaje'] = "Error al eliminar el usuario";
                        $dev['error']   = "false";
                    }
                }
                else
                {
                    $dev['mensaje'] = "No se puede eliminar porque tiene asignado items";
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
    }
    else
    {
        $dev['mensaje'] = $usuarioM['mensaje'];
        $dev['error']   = "false";
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
        //$output = substr($output, 1);
        //$output = "$callback({".$output.");";
        print($output);
    }

}
function txUpdateUsuario($idusuarios,$nombres, $apellido1, $apellido2, $carnetidentidad, $email, $telefono, $celular,$login, $pass1, $pass2, $idrol, $estado,  $return)
{$idalmacen =$_SESSION['idalmacen'];

     $nombresA   = validarText($nombres, true);
    $apellido1A = validarText($apellido1, true);
    $apellido2A = validarText($apellido2, false);
    $carnetidentidadA = validarText($carnetidentidad, true);
    $emailA     = validarEmail($email, true);
    $telefonoA  = validarText($telefono, false);
    $celularA   = validarText($celular, false);
    $loginA     = validarText($login, false);
    $passwdA    = validarPassword($pass1, $pass2, true);
   // $fecharegA  = validarFecha($fechareg);
    $idrolA     = verificarValidarText($idrol, true, "rol", "idrol");
    $estadoA    = validarText($estado, true);


    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    if($nombresA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo nombres: ".$nombresA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($apellido1A['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Apellido1: ".$apellido1A['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($apellido2A['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Apellido2: ".$apellido2A['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($carnetidentidadA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo CI: ".$carnetidentidadA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($emailA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Email: ".$emailA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($telefonoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Telefono: ".$telefonoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($celularA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo celular: ".$celularA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($loginA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo login: ".$loginA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($passwdA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Password: ".$passwdA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    if($idrolA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Rol: ".$idrolA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    if($estadoA['error'] == false)
    {
        $dev['mensaje'] = "Error en el campo Estado: ".$estadoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }

    if($passwdA['dato'] == "d41d8cd98f00b204e9800998ecf8427e")
    {
        $passwdA['dato'] = "";
    }
  //  $setC[5]['dato'] = $telefonoA['dato'];
    $nombre = $nombresA['dato'];
    $apellido1 = $apellido1A['dato'];
    $apellido2 = $apellido2A['dato'];
    $ci = $carnetidentidadA['dato'];
    $email = $emailA['dato'];
    $telefono = $telefonoA['dato'];
    $celular = $celularA['dato'];
    $passwd = $passwdA['dato'];
    $idrol = $idrolA['dato'];
    $estado = $estadoA['dato'];


$sql[] = "UPDATE usuario SET idrol='$idrol',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',ci='$ci',email='$email',telefono='$telefono',celular='$celular',paswd='$passwd',estado='$estado' where idusuario='$idusuarios';";

  //  MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql) == true)
    {
        $dev['mensaje'] = "Se guardo correctamente el usuario";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error guardar el usuario";
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
function existeUsuarioByLogin($login)
{
    $dev = false;
    $sql = "SELECT u.* FROM usuario u WHERE u.login = '$login'";
    if($login != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        if($fi['login'] == $login)
                        {
                            $dev = true;
                        }
                        else
                        {
                            $dev = false;
                        }
                    }
                    else
                    {
                        $dev = false;
                    }

                }
                else
                {
                    $dev = false;
                }
            }
            else
            {
                $dev = false;
            }
        }
        else
        {
            $dev = false;
        }
    }
    else
    {
        $dev = false;
    }
    return $dev;
}

function existeUsuarioByCI($ci)
{
    $dev = false;
    $sql = "SELECT u.* FROM usuario u WHERE u.carnetidentidad = '$ci'";
    if($ci != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        if($fi['carnetidentidad'] == $ci)
                        {
                            $dev = true;
                        }
                        else
                        {
                            $dev = false;
                        }
                    }
                    else
                    {
                        $dev = false;
                    }

                }
                else
                {
                    $dev = false;
                }
            }
            else
            {
                $dev = false;
            }
        }
        else
        {
            $dev = false;
        }
    }
    else
    {
        $dev = false;
    }
    return $dev;
}


//lista todos los usuarios administradores de almacenes
function ListarUsuariosAdmin($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){

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
  usu.idusuario,
  usu.idrol,
  usu.idalmacen,
  usu.nombre,
  usu.apellido1,
  usu.apellido2,
  CONCAT(usu.apellido1, ' ', usu.apellido2) AS apellido,
  usu.ci,
  usu.email,
  usu.telefono,
  usu.celular,
  usu.login,
  usu.paswd,
  usu.fechareg,
  usu.numero,
  usu.estado
FROM
  usuario usu
WHERE
  usu.idrol = 'rol-1001';

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
function BuscarAlmacenes($callback, $_dc, $where = '', $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $ciudad = ListarAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $value['almacenes'] = $ciudad['error'];
    $value["almacenM"] = $ciudad['resultado'];
    $dev["resultado"] = $value;


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
function BuscarAlmacenPorUsuario($idusuario,$callback, $_dc, $return = false){

    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";


    $ciudad = ListarAlmacen("", "", "", "", "", "", "", true);
    if($ciudad["error"]==false){
        $dev['mensaje'] = "No se pudo encontrar almacenes";
        $dev['error']   = "false";
        $dev['resultado'] = "";

    }
    $value['almacenes'] = $ciudad['error'];
    $value["almacenM"] = $ciudad['resultado'];


    $sql ="
SELECT
  usu.idusuario,
  usu.idrol,
  usu.idalmacen,
  usu.nombre,
  usu.apellido1,
  usu.apellido2,
  CONCAT(usu.apellido1, ' ', usu.apellido2) AS apellido,
  usu.ci,
  usu.email,
  usu.telefono,
  usu.celular,
  usu.login,
  usu.paswd,
  usu.fechareg,
  usu.numero,
  usu.estado
FROM
  usuario usu
WHERE
  usu.idrol = 'rol-1001' AND
  usu.idusuario = '$idusuario';

";
    if($idusuario != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else
                            {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
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
                    $dev['mensaje'] = "No se encontro datos en la consulta";
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
    }
    else
    {
        $dev['mensaje'] = "El codigo de producto es nulo";
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


function GuardarNuevoUsuarioAdmin(){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $codigo = $_GET['codigo'];
    $codigoA = validarText($codigo, true);
    if($codigoA['error']==false){
        $dev['mensaje'] = "Error en el codigo de Linea: ".$codigoA['mensaje'];
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
        exit;
    }
    $idlinea = $_GET['idlinea'];
    $nombre = $_GET['nombre'];
    //    $codigo=$_GET['codigo'];
    $descripcion = $_GET['descripcion'];
    //    $pais = $_GET['pais'];
    //    $ciudad = $_GET['ciudad'];
    //    $direccion = $_GET['direcion'];
    //    $email = $_GET['email'];
    //    $web = $_GET['web'];
    //    $representante = $_GET['representante'];
    //    $idproveedor = $_GET['idproveedor'];
    $sql[] = getSqlUpdateLineas($idlinea,$nombre, $codigo, $descripcion, false);

    //    MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se guardaron y actualizaron correctamente los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error al actualizar o guardar los datos";
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
?>