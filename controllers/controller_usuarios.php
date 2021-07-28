<?php

class UsuarioController
{
    static public function buscarController($item, $valor)
    {

        $tabla = "usuarios";
        $respuesta = UsuarioModel::SeleccionarUsuariosModel($tabla, $item, $valor);
        return $respuesta;
    }

    static public function eliminarController($datos)
    {
        if (isset($datos)) {
            $tabla = "usuarios";
            $valor = $datos;
            $respuesta = UsuarioModel::eliminarUsuarioModel($tabla, $valor);
            return $respuesta;
        }
    }

    static public function registrarController($datos)
    {

        if (isset($datos)) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["registrarNombre"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["registrarCorreo"]) &&
                preg_match('/^[0-9a-zA-Z]+$/', $datos["registrarContraseña"])
            ) {

                $tabla = "usuarios";
                $encriptarContraseña = crypt($datos["registrarContraseña"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos["registrarContraseña"] = $encriptarContraseña;

                if ($datos["imagen-tipo"] == "image/png") {
                    $aleatorio = mt_rand(100, 999);
                    $aleatorio2 = mt_rand(100, 999);
                    $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".png";

                    $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".png";
                    $resultado = move_uploaded_file($datos['registrarImagen'], $ruta2);
                    $datos["registrarImagen"] = $ruta;
                }
                if ($datos["imagen-tipo"] == "image/jpeg") {
                    $aleatorio = mt_rand(100, 999);
                    $aleatorio2 = mt_rand(100, 999);
                    $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                    $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                    $resultado = move_uploaded_file($datos['registrarImagen'], $ruta2);
                    $datos["registrarImagen"] = $ruta;
                }


                $valor = $datos;

                $respuesta = UsuarioModel::registrarUsuarioModel($tabla, $valor);
                return $respuesta;
            } else {
                return 'error';
            }
        }
    }

    static public function editarController($datos)
    {
        if (isset($datos)) {
            $tabla = "usuarios";

            if ($datos["editarContrasena"] != "") {
                $encriptarContraseña = crypt($datos["editarContrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos["editarContrasena"] = $encriptarContraseña;
            }

            if ($datos["editarImagen"] != null) {
                $aleatorio = mt_rand(100, 999);
                $aleatorio2 = mt_rand(100, 999);
                $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".png";
                $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".png";
                $resultado = move_uploaded_file($datos['editarImagen'], $ruta2);

                print_r($resultado, "moveupload");
                $datos["editarImagen"] = $ruta;
            }


            $valor = $datos;
            $respuesta = UsuarioModel::editarUsuarioModel($tabla, $valor);
            return $respuesta;
        }
    }
    //Ctr para ingreo, compara correo input con la base de datos.
    //llamdo por un onchange listener
    static public function validarEmailController($datos)
    {
        if (isset($datos)) {
            $tabla = "usuarios";
            $item = "correo";
            $valor = $datos;
            $respuesta = UsuarioModel::SeleccionarUsuariosModel($tabla, $item, $valor);
            if ($respuesta != null) {
                if ($respuesta["correo"] == $datos) {
                    return 'match';
                } else {
                    return 'no-match';
                }
            } else {
                return 'no-match';
            }
        }
    }
    static public function cambiarEstadoController($datos)
    {
        if (isset($datos)) {
            $tabla = "usuarios";
            var_dump($datos);
            if ($datos["estadoValor"] == "true") {
                $valor = array(
                    "estado" => 0,
                    "id" => $datos["estadoId"]
                );
            } else {
                print_r("FALSEEEEE");
                $valor = array(
                    "estado" => 1,
                    "id" => $datos["estadoId"]
                );
            }
            $respuesta = UsuarioModel::cambiarEstadoModel($tabla, $valor);
            if ($respuesta != null) {
                return $respuesta;
            } else {
                return 'no-match';
            }
        }
    }
}
