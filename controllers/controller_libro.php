<?php

class LibroController
{
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

        $tabla = "libros";
        $respuesta = LibroModel::SeleccionarLibrosModel($tabla, $item, $valor);
        return $respuesta;
    }

    static public function agregarLibroController($datos)
    {
        if (isset($datos)) {

            $codigo = LibroModel::SeleccionarLibrosModel("libros", "codigo", $datos["codigo"]);

            $nombre = LibroModel::buscarNombreCategoria("libros", "nombre", $datos["nombre"], $datos["categoria"]);

            if ($codigo) {
                return "codigo ya existe";
            }

            if ($nombre) {
                var_dump($nombre);
                return "nombre ya existe";
            }

            $datos["ruta"] = LibroController::funcionCambiarAcentos($datos["ruta"]);


            $tabla = "libros";

            if ($datos["imagen-tipo"] == "image/png") {
                $aleatorio = mt_rand(100, 999);
                $aleatorio2 = mt_rand(100, 999);
                $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".png";
                print_r($ruta, "RUTAAAAAAA");
                $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".png";
                $resultado = move_uploaded_file($datos['imagen'], $ruta2);
                $datos["imagen"] = $ruta;
            }
            if ($datos["imagen-tipo"] == "image/jpeg") {
                $aleatorio = mt_rand(100, 999);
                $aleatorio2 = mt_rand(100, 999);
                $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                $resultado = move_uploaded_file($datos['imagen'], $ruta2);
                $datos["imagen"] = $ruta;
            }


            $valor = $datos;

            $respuesta = LibroModel::registrarLibrosModel($tabla, $valor);
            return $respuesta;
        }
    }
    static public function estadoLibroController($datos)
    {
        var_dump($datos);
        if (isset($datos["estado"])) {
            $tabla = "libros";
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
            $respuesta = LibroModel::cambiarEstadoModel($tabla, $valor);
            if ($respuesta != null) {
                return $respuesta;
            } else {
                return 'no-match';
            }
        }
    }

    static public function eliminarLibroController($datos)
    {
        if (isset($datos)) {
            $tabla = "libros";
            $valor = $datos;
            $respuesta = LibroModel::eliminarLibroModel($tabla, $valor);
            return $respuesta;
        }
    }

    static public function actualizarStockController($datos)
    {
        if (isset($datos)) {
            $tabla = "libros";
            $valor = $datos;
            $respuesta = LibroModel::actualizarStockModal($tabla, $valor);
            return $respuesta;
        }
    }

    static public function editarLibroController($datos)
    {
        if (isset($datos)) {

            $tabla = "libros";

            $datos["ruta"] = LibroController::funcionCambiarAcentos($datos["ruta"]);


            if ($datos["imagen-tipo"] == "image/png") {
                $aleatorio = mt_rand(100, 999);
                $aleatorio2 = mt_rand(100, 999);
                $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".png";
                print_r($ruta, "RUTAAAAAAA");
                $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".png";
                $resultado = move_uploaded_file($datos['imagen'], $ruta2);
                $datos["imagen"] = $ruta;
            }
            if ($datos["imagen-tipo"] == "image/jpeg") {
                $aleatorio = mt_rand(100, 999);
                $aleatorio2 = mt_rand(100, 999);
                $ruta = "views/assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                $ruta2 = "../assets/img/" . $aleatorio . $aleatorio2 . ".jpeg";
                $resultado = move_uploaded_file($datos['imagen'], $ruta2);
                $datos["imagen"] = $ruta;
            }

            $valor = $datos;
            $respuesta = LibroModel::editarLibroModel($tabla, $valor);
            return $respuesta;
        }
    }

    static public function editarStockController($datos)
    {
        if (isset($datos)) {
            $tabla = "libros";
            $valor = $datos;
            $respuesta = LibroModel::editarLibroStockModel($tabla, $valor);
            return $respuesta;
        }
    }

    static public function validarCodigoController($datos)
    {
        if (isset($datos)) {
            $tabla = "libros";
            $item = "codigo";
            $valor = $datos["codigo"];
            $respuesta = LibroModel::SeleccionarLibrosModel($tabla, $item, $valor);
            if ($respuesta != null) {
                if ($respuesta["codigo"] == $datos["codigo"]) {
                    return "match";
                } else {
                    return "no-match";
                }
            } else {
                return "no_match";
            }
        }
    }

    static public function validarNombreController($datos)
    {
        if (isset($datos)) {
            $nombre = $datos["nombre"];
            $respuesta = LibroModel::validarNombreModel($nombre);
            
           
            if ($respuesta != null) {
                foreach ($respuesta as $row => $value) {
                    if($value["nombre"] == $nombre && $value["id"] == $datos["categoria"] ){
                        return "match";
                    }
                }
            } else {
                return "no-match";
            }

            return "no-match";
        }
    }

    static public function listaEditorialController(){
        $respuesta = LibroModel::SeleccionarListaEditorialModel();

        foreach ($respuesta as $row => $item) {
            echo '<option value = "' . $item["editorial"] . '" > '. $item["editorial"] . '</option>';
        }
    }

    static public function listaAutorController(){
        $respuesta = LibroModel::SeleccionarListaAutorModel();
        foreach($respuesta as $row => $item){
            echo '<option value = "' . $item["autor"] . '">' .$item["autor"] . '</option>';
        }
    }

}
