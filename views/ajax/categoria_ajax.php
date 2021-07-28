<?php

require_once "../../controllers/controller_categoria.php";
require_once "../../models/categorias.model.php";

class Categoria
{
    public $datos;
    public $controller;
    public function funcionCategoria()
    {

        $datos = $this->datos;
        $controller = $this->controller;

        $respuesta = CategoriaController::$controller($datos);

        echo $respuesta;
    }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if (isset($_POST["categoria"])) {
        $categoria = $_POST["categoria"];
        $id = $_POST["id_alta"];
        $estado = 0;
        $ruta = $_POST["categoria"];

        $datos = array(
            "categoria" => $categoria,
            "id_alta" => $id,
            "estado" => $estado,
            "ruta" => $ruta
        );
        $a = new Categoria();
        $a->datos = $datos;

        $a->controller = "agregarCategoriaController";
        $a->funcionCategoria();
    }

    if (isset($_POST["vcategoria"])) {
        $vcategoria = $_POST["vcategoria"];
        $datos = array("vcategoria" => $vcategoria);
        $a = new Categoria();
        $a->datos = $datos;
        $a->controller = "validarCategoriaController";
        $a->funcionCategoria();
    }

    if (isset($_POST["editarMostrarCategoria"])) {
        $ecategoria = $_POST["editarMostrarCategoria"];
        $datos = array("ecategoria" => $ecategoria);
        $a = new Categoria();
        $a->datos = $datos;
        $a->controller = "mostrarCategoriaController";
        $a->funcionCategoria();
    }

    if (isset($_POST["eliminarCategoriaID"])) {
        $id = $_POST["eliminarCategoriaID"];
        $datos = array("eliminarID" => $id);
        $a = new Categoria();
        $a->datos = $datos;
        $a->controller = "eliminarCategoriaController";
        $a->funcionCategoria();
    }

    if (isset($_POST["editarCategoria"])) {
        $categoria = $_POST["editarCategoria"];
        $datos = array(
            "editarCategoria" => $_POST["editarCategoria"],
            "editarID" => $_POST["editarID"],
            "editarRuta" => $_POST["editarCategoria"]
        );
        $a = new Categoria();
        $a->datos = $datos;
        $a->controller = "editarCategoriaController";
        $a->funcionCategoria();
    }

    if (isset($_POST["categoriaEstado"])) {
        var_dump($_POST);
        $categoria = $_POST["categoriaEstado"];
        $datos = array(
            "estado" => $_POST["categoriaEstado"],
            "id" => $_POST["id"]
        );
        $a = new Categoria();
        $a->datos = $datos;
        $a->controller = "estadoCategoriaController";
        $a->funcionCategoria();
    }
}
