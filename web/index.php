<?php
session_name("balderrama");
session_start();
if($_SESSION["user"] == NULL)
{
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
      <meta name='gwt:module' content='org.selkis.Main=org.balderrama.Main'>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link type="text/css" rel='stylesheet' href='css/Main.css'>
        <link rel="icon" type="image/jpeg" href="/img/favicon.jpg" />
        <link rel="stylesheet" type="text/css" href="js/ext/resources/css/ext-all.css" />
        <link id="theme" rel="stylesheet" type="text/css" href="themes/slate/css/theme-slate.css"/>
        <link id="showcase" rel="stylesheet" type="text/css" href="css/Showcase2.css"/>
        <link id="indexCSS" rel="stylesheet" type="text/css" href="css/index.css"/>
        <link id="gwtCSS" rel="stylesheet" type="text/css" href="css/gwt.css"/>
        <script type="text/javascript" src="js/ext/adapter/yui/yui-utilities.js"></script>
        <script type="text/javascript" src="js/ext/adapter/yui/ext-yui-adapter.js"></script>
        <script type="text/javascript" src="js/ext/ext-all-debug.js"></script>
        <script type="text/javascript" src="js/ext/ext-lang-es.js"></script>
       <title>Nova Moda SRL</title>
    </head>
    <body background="images/c.jpg">
        <script language="javascript" src="org.balderrama.Main/org.balderrama.Main.nocache.js"></script>
        <script type="text/javascript" src="org.balderrama.Main/gwt.js"></script>
       
        <div id="menus" style="width:400px;height:25px;left:50px;"></div>
       
        <div id="cabeceraP" style="height:25px;top:0px;left:550px;width:auto;position:fixed;text-align:left;"></div>
        <div id="errores" style="top:25px;position:fixed;" class='kmensaje'></div>
         <div id="reportarError" style="margin-left:170px;margin-top:-25px;"></div>
        <div id="cuerpo" style="width:800px;height:570px;margin-top:25px;">Cargando .... </div>
        
    </body>
</html>
