<?php

require_once "../../controllers/controller_cliente.php";
require_once "../../models/cliente.model.php";

class Cliente
{
    public $datos;
    public $controller;
    public function funcionCliente()
    {

        $datos = $this->datos;
        $controller = $this->controller;
        $respuesta = ClienteController::$controller($datos);

        echo $respuesta;
    }

}
