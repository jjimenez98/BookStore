<?php

require_once "../../controllers/controller_biblioteca.php";
require_once "../../models/biblioteca.model.php";

class Biblioteca
{
    public $datos;
    public $controller;
    public function funcionBiblioteca()
    {

        $datos = $this->datos;
        $controller = $this->controller;

        $respuesta = BibliotecaController::$controller($datos);

        if (
            $controller == "obtenerLibroPorAutorCategoriaController" ||
            $controller == "obtenerCarritoItemsController"
        ) {
            echo json_encode($respuesta);
        } else {
            echo $respuesta;
        }
    }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if (isset($_POST["cantidad"])) {
        $categoria = $_POST["cantidad"];
        $id = $_POST["id"];

        $datos = array(
            "cantidad" => $categoria,
            "id" => $id
        );
        $a = new Biblioteca();
        $a->datos = $datos;

        $a->controller = "validarCantidadLibroController";
        $a->funcionBiblioteca();
    }

    if (isset($_POST["filtrarPorCategoria"])) {
        $datos = array("autor" => $_POST["filtrarPorAutor"], "categoria" => $_POST["filtrarPorCategoria"]);

        $a = new Biblioteca();
        $a->datos = $datos;
        $a->controller = "obtenerLibroPorAutorCategoriaController";
        $a->funcionBiblioteca();
    }
    if (isset($_POST["obtenerCarrito"])) {
        $a = new Biblioteca();
        $a->controller = "obtenerCarritoItemsController";
        $a->funcionBiblioteca();
    }
}
