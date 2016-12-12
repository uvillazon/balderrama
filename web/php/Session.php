<?php 

class Session{
    public $idalmacen;
    public $codigo;

    function __construct(){
//        var_dump($_SESSION);

        $this->idalmacen = $_SESSION['idalmacen'];
        $this->codigo = $_SESSION['codigo'];

        //        $this->guardarLoguardarLog();
    }
    public function guardarLog(){

    }



}
?>