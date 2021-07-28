<?php

require_once "../../controllers/controller_libro.php";
require_once "../../models/libro.model.php";

class Libro
{
    public $datos;
    public $controller;
    public function funcionLibro()
    {

        $datos = $this->datos;
        $controller = $this->controller;

        if (isset($datos["editarMostrarID"])) {
            $respuesta = LibroController::$controller("id", $datos["editarMostrarID"]);

            echo json_encode($respuesta);
        } else {

            $respuesta = LibroController::$controller($datos);

            echo $respuesta;
        }
    }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if (isset($_POST["registrarCategoria"])) {
        $categoria = $_POST["registrarCategoria"];
        $codigo = $_POST["registrarCodigo"];
        $nombre = $_POST["registrarNombre"];
        $autor = $_POST["registrarAutor"];
        $editorial = $_POST["registrarEditorial"];
        $precio = $_POST["registrarPrecio"];
        $stock = $_POST["registrarStock"];
        $imagen = $_FILES["registrarImagen"]["tmp_name"];
        $imagentype = $_FILES["registrarImagen"]["type"];
        $ruta = $_POST["registrarNombre"];

        $datos = array(
            "categoria" => $categoria, "codigo" => $codigo, "nombre" => $nombre, "autor" => $autor, "editorial" => $editorial,
            "precio" => $precio, "stock" => $stock, "imagen-tipo" => $imagentype, "imagen" => $imagen, "ruta" => $ruta
        );

        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "agregarLibroController";
        $a->funcionLibro();
    }

    if (isset($_POST["estado"])) {
        $datos = array(
            "estado" => $_POST["estado"],
            "id" => $_POST["id"]
        );
        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "estadoLibroController";
        $a->funcionLibro();
    }

    if (isset($_POST["editarMostrarID"])) {
        $id = $_POST["editarMostrarID"];
        $datos = array("editarMostrarID" => $id);
        $ajx = new Libro();
        $ajx->datos = $datos;
        $ajx->controller = "buscarController";
        $ajx->funcionLibro();
    }

    if (isset($_POST["idLibro"])) {
        $id = $_POST["idLibro"];
        $datos = array("eliminarID" => $id);
        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "eliminarLibroController";
        $a->funcionLibro();
    }


    if (isset($_POST["stockModalValor"])) {
        $stock = $_POST["stockModalValor"];
        $id = $_POST["id"];
        $datos = array("stock" => $stock, "id" => $id);
        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "actualizarStockController";
        $a->funcionLibro();
    }

    if (isset($_POST["editarNombre"])) {
        $nombre = $_POST["editarNombre"];
        $codigo = $_POST["editarCodigo"];
        $autor = $_POST["editarAutor"];
        $editorial = $_POST["editarEditorial"];
        $precio = $_POST["editarPrecio"];
        $stock = $_POST["editarStock"];
        $id = $_POST["id"];
        $ruta = $_POST["editarNombre"];

        if (isset($_FILES["imagen"])) {

            $imagen = $_FILES["imagen"]["tmp_name"];
            $imagentipo =  $_FILES["imagen"]["type"];
        } else {

            $imagen = "";
            $imagentipo =  "";
        }

        $datos = array(
            "nombre" => $nombre, "codigo" => $codigo, "autor" => $autor, "editorial" => $editorial,
            "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "imagen-tipo" => $imagentipo,
            "id" => $id, "ruta" => $ruta
        );


        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "editarLibroController";
        $a->funcionLibro();
    }

    if (isset($_POST["editarStockValor"])) {
        $stock = $_POST["editarStockValor"];
        $id = $_POST["editarStockID"];
        $datos = array("stock" => $stock, "id" => $id);

        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "editarStockController";
        $a->funcionLibro();
    }

    if (isset($_POST["validarCodigo"])) {
        $codigo = $_POST["validarCodigo"];
        $datos = array("codigo" => $codigo);
        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "validarCodigoController";
        $a->funcionLibro();
    }

    if (isset($_POST["validarNombre"])) {
        $nombre = $_POST["validarNombre"];
        $categoria = $_POST["validarCategoria"];
        $datos = array("nombre" => $nombre, "categoria" => $categoria);
        $a = new Libro();
        $a->datos = $datos;
        $a->controller = "validarNombreController";
        $a->funcionLibro();
    }
}
