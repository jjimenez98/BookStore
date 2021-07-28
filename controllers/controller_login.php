<?php

    class LoginController{
        //Ctr para ingreso, compara correo y contrasena input con la base de datos.
        //llamado por un onclick listerner
        static public function ingresoController($datos){
            if(isset($datos["ingresoNombre"])){
                
                $tabla = "usuarios";
                $item = "correo";
                $valor = $datos["ingresoNombre"];

                $respuesta = loginModel::SeleccionarIngresoModel($tabla,$item,$valor);
                $encriptarContraseña = crypt($datos["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                if ($respuesta != null){


                if ($respuesta["correo"] == $datos["ingresoNombre"] && $respuesta["contrasena"] == $encriptarContraseña) {
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["nivel"] = $respuesta["nivel"];
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["imagen"] = $respuesta["imagen"];
                    // $_SESSION["fecha_nacimiento"] = respuesta[""]
                    return "match";
                } else {
    
                    return "no-match";
                }
            }else{
                return "no-match";
            } 
            }
        }

        static public function estadoLibroController($datos){
            if(isset($datos["estado"])){
                $tabla = "libros";
                if ($datos["estado"] == "true") {
                    $valor = array(
                        "estado" => 0,
                        "id" => $datos["id"]
                    );
                } else {
                    print_r("FALSEEEEE");
                    $valor = array(
                        "estado" => 1,
                        "id" => $datos["estadoId"]
                    );
                }
                $respuesta = LibroModel::cambiarEstadoModel($tabla, $valor);
                if ($respuesta != null) {
                    return $respuesta;
                } else {
                    return 'no-match';
                }
            }
        }

    }
