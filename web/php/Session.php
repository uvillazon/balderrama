<?php

class Session
{
    public $idalmacen;
    public $codigo;
    public $basededatos;
    public $user;
    public $nombre;
    public $ciudadN;
    public $almacenN;
    public $almacenC;
    public $idusuario;
    public $idtienda;

    function __construct()
    {
//        var_dump($_SESSION);

        $this->idalmacen = $_SESSION['idalmacen'];
        $this->codigo = $_SESSION['codigo'];
        $this->basededatos = $_SESSION['basededatos'];
        $this->user = $_SESSION['user'];
        $this->nombre = $_SESSION["nombre"];
        $this->ciudadN = $_SESSION["ciudadN"];
        $this->almacenN = $_SESSION["almacenN"];
        $this->almacenC = $_SESSION["almacenC"];
        $this->idusuario = $_SESSION["idusuario"];
        $this->idtienda = $_SESSION["idtienda"];
        $this->guardarLog();
    }

    public function guardarLog()
    {
        $file = date("Ymd") . "session";

        $file = "logs/" . $file . ".txt";
        $otros = "";
        if (isset($_SESSION)) {

            foreach ($_SESSION as $key => $value) {
                $otros = $otros . "\t" . $key . " => " . $value . " | ";
            }
        }

        $log = date("d-m-Y H:i:s") . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $_SERVER["REQUEST_URI"] . "\t" . $otros . "\n\n";
        if ($f = fopen($file, 'a')) {
            fwrite($f, $log);
            fclose($f);
        }
    }

}

?>