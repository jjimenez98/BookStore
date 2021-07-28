<?php

class CategoriaController
{
    //Ctr para ingreso, compara correo y contrasena input con la base de datos.
    //llamado por un onclick listerner

    static public function funcionCambiarAcentos($cadena)
    {
        $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena
        );

        //Reemplazamos la I y i
        $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena
        );

        //Reemplazamos la O y o
        $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena
        );

        //Reemplazamos la U y u
        $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena
        );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
        );

        $cadena = str_replace(" ", "-", $cadena);

        return $cadena;
    }


    static public function buscarController($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = CategoriasModel::SeleccionarCategoriaModel($tabla, $item, $valor);
        return $respuesta;
    }

    static public function agregarCategoriaController($datos)
    {
        if (isset($datos["categoria"])) {

            $tabla = "categorias";
            $valor = $datos;
            $valor["ruta"] = CategoriaController::funcionCambiarAcentos($valor["ruta"]);

            $buscar = CategoriasModel::SeleccionarCategoriaModel("categorias", "categoria", $datos["categoria"]);

            if ($buscar) {
                return "categoria existe";
            }

            $respuesta = CategoriasModel::agregarCategoriaModel($tabla, $valor);
            if ($respuesta != null) {
                return "match";
            } else {
                return "no-match";
            }
        }
    }

    static public function validarCategoriaController($valor)
    {
        $tabla = "categorias";
        $item = "categoria";
        $valor = $valor["vcategoria"];
        $respuesta = CategoriasModel::SeleccionarCategoriaModel($tabla, $item, $valor);
        if ($respuesta != null) {
            if ($respuesta["categoria"] == $valor) {
                return 'match';
            } else {
                return 'no-match';
            }
        } else {
            return 'no-match';
        }
    }
    static public function mostrarCategoriaController($valor)
    {
        $tabla = "categorias";
        $item = "id";
        $valor = $valor["ecategoria"];
        $respuesta = CategoriasModel::SeleccionarCategoriaModel($tabla, $item, $valor);

        return $respuesta["categoria"];
    }

    static public function eliminarCategoriaController($datos)
    {
        if (isset($datos)) {
            $tabla = "categorias";
            $valor = $datos;
            $respuesta = CategoriasModel::eliminarCategoriaModel($tabla, $valor);
            return $respuesta;
        }
    }

    static public function editarCategoriaController($datos)
    {
        if (isset($datos)) {
            $tabla = "categorias";
            $valor = $datos;
            $valor["editarRuta"] = CategoriaController::funcionCambiarAcentos($valor["editarRuta"]);

            $buscar = CategoriasModel::SeleccionarCategoriaModel("categorias", "categoria", $datos["editarCategoria"]);

            if ($buscar) {
                $respuesta = "categoria existe";
                return $respuesta;
            }


            $respuesta = CategoriasModel::editarCategoriaModel($tabla, $valor);

            return $respuesta;
        }
    }

    static public function estadoCategoriaController($datos)
    {
        if (isset($datos)) {
            $tabla = "categorias";
            if ($datos["estado"] == "true") {
                $valor = array(
                    "estado" => 0,
                    "id" => $datos["id"]
                );
            } else {
                $valor = array(
                    "estado" => 1,
                    "id" => $datos["id"]
                );
            }
            $respuesta = CategoriasModel::cambiarEstadoModel($tabla, $valor);
            if ($respuesta != null) {
                return $respuesta;
            } else {
                return 'no-match';
            }
        }
    }
}
