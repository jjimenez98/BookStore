<?php

require_once "../../controllers/controller_dashboard.php";
require_once "../../models/dashboard.model.php";


class DashBoard{
    public $datos;
    public $controller;
    public function funcionDashBoard(){
           
        $datos = $this->datos;
        $controller= $this->controller;

        $respuesta =  DashBoardController::$controller($datos);
    
        echo json_encode($respuesta);

        }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if(isset($_POST["categoriasVendidas"])){
        $a = new DashBoard();
        $a->controller = "traerLibrosVendidosCategoriaController";
        $a->funcionDashBoard();
    }

}