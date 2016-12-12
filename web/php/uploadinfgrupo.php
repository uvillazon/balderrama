<?php
require_once('../lib/includeLibs.php');
include("impl/Utils.php");
include("bd/bd.php");
if($_GET['funcion']=="insertarimagen"){

    $upload = new upload; // upload image
    $upload -> SetDirectory("uploads");
    $file = $_FILES['file']['name'];
    $query = new query;
 
    if ($_FILES['file']['name'] != "")
    {
        $tipo_archivo = $_FILES['file']['type'];
        if (!(strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg"))) {
            echo "Solo imagenes. Verifique e intente de nuevo <a href='uploadimagen.php'>nuevamente</a>";
        } else {
           
            $upload -> SetFile("file");
           
            $name = "marca_".time();
//            echo $name;
            $upload->UploadFile($name);
            if ($upload -> UploadFile($name)){
//                echo "hola";
//                $update['imagen'] = "uploads/".$name.".".$upload->ext;
//                $update['idmarca'] = $_POST['idproducto'];
//                $update['fecha'] = date("Y-m-d");
//                $update['numero'] = $numero;
//                $update['idimagen'] = $idusuario;
                $update1['imagen'] = "uploads/".$name.".".$upload->ext;
                $query->dbUpdate($update1,"marcas","where idmarca = '".$_POST['idproducto']."'");
//                $query->dbInsert($update,"imagenes");
                echo "se guardo correctamente ahora puede cerrar la ventana";
            }
            else{
                "holaaaDSFDSF";
            }
        }
    }elseif ($_FILES['file']['error'] == 4 && $_FILES['file']['name'] != "")
    echo "Archivo no encontrado. Por favor verifique y trate luego <a href='uploadimagen.php'>nuevamente</a> ";
     echo "<script>window.close()</script>";

    //    if($query->dbUpdate($update,"enlace","where id_enlace = ".$id)) { //save in the data base
    //        echo "<script>alert('Enlace actualizado exitosamente');</script>";
    //        echo "<script>window.location.href='Enlace.php'</script>";
    //    }
    //    else {
    //        echo "<script>alert('La Enlace existe');</script>";
    //
    //    }

}
elseif($_GET['funcion']=="procesocarga")
{
    $idproducto = $_GET['idgrupo'];
        echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Subir Imagen de producto</title>
</head>

<body>
<form action='uploadimagen.php?funcion=insertarimagen' method='post' enctype='multipart/form-data' name='form1' id='form1'>
  <p>&nbsp;</p>
  <p>
    <label>Subir Imagen
    <input type='file' name='file' />
    </label>
  </p>
  <p>
    <label>
     <input name='idproducto' type='hidden' value='$idproducto' />
    <input type='submit' name='Submit' value='Subir Imagen' />
    </label>
  </p>
</form>
</body>
</html>
";


}
else{
    if($_GET['funcion']=="procesodescarga")
{
    $idproducto = $_GET['idgrupo'];
        echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Subir Imagen de producto</title>
</head>

<body>
<form action='uploadimagen.php?funcion=insertarimagen' method='post' enctype='multipart/form-data' name='form1' id='form1'>
  <p>&nbsp;</p>
  <p>
    <label>Subir Imagen
    <input type='file' name='file' />
    </label>
  </p>
  <p>
    <label>
     <input name='idproducto' type='hidden' value='$idproducto' />
    <input type='submit' name='Submit' value='Subir Imagen' />
    </label>
  </p>
</form>
</body>
</html>
";


}
else{
            echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Subir Imagen de producto</title>
</head>

<body>
<form action='?funcion=insertarimagen' method='post' enctype='multipart/form-data' name='form1' id='form1'>
  <p>&nbsp;</p>
  <p>
    <label>Subir Imagen
    <input type='file' name='file' />
    </label>
  </p>
  <p>
    <label>

    <input type='submit' name='Submit' value='Subir Imagen' />
    </label>
  </p>
</form>
</body>
</html>
";
}
}
?>