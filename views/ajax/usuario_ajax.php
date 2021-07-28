<?php

require_once "../../controllers/controller_usuarios.php";
require_once "../../models/usuario.model.php";

class Usuario
{
    public $datos;
    public $controller;
    public function funcionUsuario()
    {

        $datos = $this->datos;
        $controller = $this->controller;
        if (isset($datos["editarMostrarID"])) {
            $respuesta = UsuarioController::$controller("id", $datos["editarMostrarID"]);

            echo json_encode($respuesta);
        } else {

            $respuesta = UsuarioController::$controller($datos);

            echo $respuesta;
        }
    }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {


    if (isset($_POST["idUsuario"])) {

        $id = $_POST["idUsuario"];
        $datos = $id;
        $ajx = new Usuario();
        $ajx->datos = $datos;
        $ajx->controller = "eliminarController";

        $ajx->funcionUsuario();
    };

    if (isset($_POST["registrarNombre"])) {



        $datos = array(
            "registrarNombre" => $_POST["registrarNombre"],
            "registrarNacimiento" => $_POST["registrarNacimiento"],
            "registrarNivel" => $_POST["registrarNivel"],
            'registrarEstado' => $_POST["registrarEstado"],
            "registrarIdalta" => $_POST["registrarIdalta"],
            "registrarCorreo" => $_POST["registrarCorreo"],
            "registrarCodigo" => $_POST["registrarCodigo"],
            "registrarImagen" => $_FILES["registrarImagen"]["tmp_name"],
            "registrarContraseña" => $_POST["registrarContraseña"],
            "registrarCContraseña" => $_POST["registrarCContraseña"],
            "imagen-tipo" => $_FILES["registrarImagen"]["type"]
        );


        $ajx = new Usuario();
        $ajx->datos = $datos;
        $ajx->controller = "registrarController";
        $ajx->funcionUsuario();
    }

    if (isset($_POST["editarNombre"])) {
        $datos = array(
            "editarNombre" => $_POST["editarNombre"],
            "editarNacimiento" => $_POST["editarNacimiento"],
            "editarNivel" => $_POST["editarNivel"],
            'editarEstado' => $_POST["editarEstado"],
            "editarCorreo" => $_POST["editarCorreo"],
            "editarCodigo" => $_POST["editarCodigo"],
            "editarImagen" => $_FILES["editarImagen"]["tmp_name"],
            "editarID" => $_POST["editarID"],
            "editarContrasena" => $_POST["editarContraseña"]
        );

        $ajx = new Usuario();
        $ajx->datos = $datos;
        $ajx->controller = "editarController";
        $ajx->funcionUsuario();
    }

    if (isset($_POST["validarEmail"])) {
        $email = $_POST['validarEmail'];
        $datos = $email;
        $a = new Usuario();
        $a->datos = $datos;
        $a->controller = "validarEmailController";
        $a->funcionUsuario();
    }

    if (isset($_POST["estado"])) {
        $estado = $_POST["estado"];
        $datos = array(
            "estadoValor" => $_POST["estado"],
            "estadoId" => $_POST["id"]
        );

        $ajx = new Usuario();
        $ajx->datos = $datos;
        $ajx->controller = "cambiarEstadoController";
        $ajx->funcionUsuario();
    }

    if (isset($_POST["editarMostrarID"])) {
        $id = $_POST["editarMostrarID"];
        $datos = array("editarMostrarID" => $id);
        $ajx = new Usuario();
        $ajx->datos = $datos;
        $ajx->controller = "buscarController";
        $ajx->funcionUsuario();
    }
}
