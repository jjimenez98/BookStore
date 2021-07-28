<?php

require_once "../../controllers/controller_login.php";
require_once "../../models/login.model.php";

    class Login{
        public $datos;
        public $controller;
        public function funcionLogin(){
           
            $datos = $this->datos;
            $controller= $this->controller;

            $respuesta = LoginController::$controller($datos);
    
            echo $respuesta;


        }

    }

    if(isset($_POST["ingresoNombre"])){
        session_start();
        $email = $_POST["ingresoNombre"];
        $password = $_POST["ingresoPassword"];

        $datos = array("ingresoNombre" => $email, "ingresoPassword" => $password);
        $a = new Login();
        $a->datos = $datos;

        $a -> controller = "ingresoController";
        $a-> funcionLogin();
    }
