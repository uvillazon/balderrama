<?php
session_name("balderrama");
session_start();
function  generarcodigo($return = true)
{
  

    $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;
    //    MostrarConsulta($sql);
    $html = "";
    $html .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>";
    $html .= "<html>";
    $html .= "<head>";
    $html .= "<title></title>";
    $html .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    $html .= "<link href='".$_SESSION["ruta"]."css/print.css' rel='stylesheet' type='text/css' media='all'>";
    //$html .= "<link href='../print.css' rel='stylesheet' type='text/css' media='all'>";
    $html .= "</head>";
    $html .= "<body>";
    $html .= "
<table width='1000' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='33%'><div align='center'>
      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=2&amp;t=50&amp;r=2&amp;text=011001000135&amp;f=5&amp;a1=&amp;a2='></p>
      <p>Codigo : 213123123123</p>
      <p>Detalle : Color y material </p>
    </div></td>
    <td width='33%'><div align='center'>
      <p><img alt='Error? Cant display image!' src='php/imagen.php?code=ean13&amp;o=2&amp;t=80&amp;r=2&amp;text=187654637812&amp;f=3&amp;a1=&amp;a2='></p>
      <p>Codigo : 213123123123</p>
      <p>Detalle : Color y material </p>
    </div></td>
    <td width='33%'><div align='center'>
      <p><img src='php/imagen.php?code=ean13&amp;o=2&amp;t=50&amp;r=1&amp;text=927654637812&amp;f=3&amp;a1=&amp;a2=' width='150' height='80'/></p>
      <p>Codigo : 213123123123</p>
      <p>Detalle : Color y material </p>
    </div></td>
  </tr>
</table>
";
    $html .= "</body>";
    $html .= "</html>";
    if($return == true)
    {
        return $html;
    }
    else
    {
        echo $html;
    }
}

////////////////////////////////////////////////////

?>