<?php

require_once "../../controllers/controller_metricos.php";
require_once "../../models/metricos.model.php";


class Metricos{
    public $datos;
    public $controller;
    public function funcionMetricos(){
           
        $datos = $this->datos;
        $controller= $this->controller;

        $respuesta =  MetricosController::$controller($datos);
    
        echo json_encode($respuesta);

        }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if(isset($_POST["categoriasVendidas"])){
        $a = new Metricos();
        $a->controller = "traerLibrosVendidosCategoria";
        $a->funcionMetricos();
    }

}