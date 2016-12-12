<?php
function findAllFiles($callback, $return)
{
    $enlace = "../configuracion/".$_SESSION['empresa']."/";
    //abrimos la carpeta
    $dir = opendir($enlace);

    //Mostramos los archivos
    $i = 0;
    while ($elemento = readdir($dir))
    {
        $temp = $enlace.$elemento;
        if($elemento != "." && $elemento != "..")
        {
            $ar["nombre"] = $elemento;
            $tam = filesize($temp);;
            $tam = $tam / 1024;
            $tam = round($tam, 2);
            $ar["tamano"] = $tam." Kb";
            $ar["fecha"] = date("Y-m-d", fileatime($temp));
            $ar["hora"] = date("H:i:s", fileatime($temp));
            $devY[$i] = $ar;
            $i++;
        }
        //            echo $elemento."<br>";
    }

    //Cerramos la carpeta
    $dev["resultado"] = $devY;
    $dev["totalcount"] = $i+1;

    closedir($dir);
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
function findVistaPrevia($nombre, $return)
{
    $ext = strrchr($nombre, ".");
    $ext = strtolower($ext);
    if($ext == ".jpg")
    {
        $html = "<img src='".$_SESSION["ruta"]."php/configuracion/".$_SESSION['empresa']."/".$nombre."'></img>";
    }
    else if($ext == ".xls")
    {
        $enlace = "../../php/configuracion/".$_SESSION['empresa']."/".$nombre;
        //        $enlace = $nombre;
        readExcelFile($enlace);
    }
    echo $html;
}
function readExcelFile($nombre)
{
    $allow_url_override = 1; // Set to 0 to not allow changed VIA POST or GET
    if(!$allow_url_override || !isset($file_to_include))
    {
        $file_to_include = $nombre;
    }
    if(!$allow_url_override || !isset($max_rows))
    {
        $max_rows = 0; //USE 0 for no max
    }
    if(!$allow_url_override || !isset($max_cols))
    {
        $max_cols = 0; //USE 0 for no max
    }
    if(!$allow_url_override || !isset($debug))
    {
        $debug = 0;  //1 for on 0 for off
    }
    if(!$allow_url_override || !isset($force_nobr))
    {
        $force_nobr = 1;  //Force the info in cells not to wrap unless stated explicitly (newline)
    }
    require_once 'ExcelReader.php';
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('CPa25a');
    $data->read($file_to_include);
    error_reporting(E_ALL ^ E_NOTICE);
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $bandera = 1;
    $sheet = 0;
    //    for($sheet=0;$sheet<count($data->sheets);$sheet++)
    //    {
    $html .= "<table cellpadding='0' cellspacing='0' border='0' style='font-size:11px;width:100%;font-family:Tahoma;background-color;#FFFFFF;'>";
    $html .= "<TR><TD>&nbsp;</TD>";
    for($i=0;$i<$data->sheets[$sheet]['numCols']&&($i<=$max_cols||$max_cols==0);$i++)
    {
        $html .= "<TD style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>" . make_alpha_from_numbers($i) . "</TD>";
    }
    for($row=1;$row<=$data->sheets[$sheet]['numRows']&&($row<=$max_rows||$max_rows==0);$row++)
    {
        $html .= "<TR><TD style='border-bottom:1px solid #000000;border-left:1px solid #000000;font-weight:bold;font-size:11px;text-align:center;background-color:silver;'>" . $row . "</TD>";
        for($col=1;$col<=$data->sheets[$sheet]['numCols']&&($col<=$max_cols||$max_cols==0);$col++)
        {
            if($bandera == 1)
            {
                //                $html .= "<TD style='font-size:12px;text-align:right;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;'>&nbsp;";
                //
                //                $html .= nl2br(htmlentities($data->sheets[$sheet]['cells'][$row][$col]));
                //                $html .= "</TD>";
                $html .= "<TD style='font-size:12px;text-align:right;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;background-color:#ffffff;'>&nbsp;".$data->sheets[$sheet]['cells'][$row][$col]."</TD>";
            }
            else
            {
                $html .= "<TD style='font-size:12px;text-align:right;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;background-color:#cccccc;'>&nbsp;".$data->sheets[$sheet]['cells'][$row][$col]."</TD>";
            }
        }
        if($bandera == 1)
        {
            $bandera = 0;
        }
        else
        {
            $bandera = 1;
        }
        $html .= "</TR>";
    }
    //    }
    $html .= "</TABLE>";

    $html .= "</body>";
    $html .= "</html>";
    echo $html;
}
function make_alpha_from_numbers($number)
{
    $numeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if($number<strlen($numeric))
    {
        return $numeric[$number];
    }
    else
    {
        $dev_by = floor($number/strlen($numeric));
        return "" . make_alpha_from_numbers($dev_by-1) . make_alpha_from_numbers($number-($dev_by*strlen($numeric)));
    }
}
function txDeleteCargarDatos($file, $return)
{
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $enlace = "../configuracion/".$_SESSION['empresa']."/" . $file;
    if (file_exists($enlace))
    {
        if(unlink($enlace))
        {
            $dev['mensaje'] = "Se elimino correctamente el archivo";
            $dev['error'] = "true";
        }
        else
        {
            $dev['mensaje'] = "No se pudo eliminar el archivo";
        }
    }
    else
    {
        $dev['mensaje'] = "No existe el archivo";
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