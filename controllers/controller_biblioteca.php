<?php

class BibliotecaController
{

    static public function  traerLibrosVendidosCategoria()
    {
        $respuesta = BibliotecaModel::traerCategoriaModel();

        foreach ($respuesta as $row => $item) {
            echo '<a  href="http://localhost/e-sol/Biblioteca/biblioteca/' . $item["ruta"] . '" class="list-group-item list-group-item-action" value = "' . $item["categoria"] . '" > ' . $item["categoria"] . '</a>';
        }
    }

    static public function traerSiesLibrosMasVendidosController()
    {
        $librosVendidos = DashBoardModel::traerCincoLibrosMasVendidosModel();


        $listofbooks = array();

        foreach ($librosVendidos as $key => $value) {
            if (isset($listofbooks[$value["id_libro"]])) {
                $listofbooks[$value["id_libro"]] += (int)$value["cantidad"];
            } else {
                $listofbooks[$value["id_libro"]] = (int)$value["cantidad"];
            }
        }

        arsort($listofbooks);

        $listofrealbooks = array();
        $counter = 0;
        foreach ($listofbooks as $key => $value) {
            if ($counter == 5) {
                break;
            }
            $fetch = DashBoardModel::traerLibroIDModel($key);
            array_push($listofrealbooks, $fetch);
            $counter++;
        }

        $bookcounter = 0;
        foreach ($listofrealbooks as $key => $value) {
            if ($bookcounter == 0) {
                echo '<div class="row">';
            }

            if ($bookcounter == 3) {
                echo '<div class="row >';
            }

            echo ' <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="http://localhost/e-sol/Biblioteca/' . $value["imagen"] . '"  alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"> ' . $value["nombre"] . ' </p>
                                <p class="card-text"> ' . $value["autor"] . ' </p>
                                <p class="card-text"> ' . $value["editorial"] . ' </p>
                            </div>
                        </div>
                    </div>
            ';

            if ($bookcounter == 3) {
                echo '</div>';
            }
            if ($bookcounter == 6) {
                echo '</div>';
            }
            $bookcounter++;
        }
    }

    static public function traerLibrosPorCategoriaController($categoria)
    {
        $respuesta = BibliotecaModel::traerLibrosPorCategoriaModel($categoria);
        return $respuesta;
    }

    static public function traerlibroController($libro, $categoria)
    {
        $respuesta = BibliotecaModel::traerLibroModel($libro, $categoria);
        return $respuesta;
    }

    static public function validarCantidadLibroController($datos)
    {
        $respuesta = BibliotecaModel::validarCantidadLibroModel($datos["id"]);

        $usuario = $_SESSION["id"];

        if ((int)$datos['cantidad'] > (int)$respuesta["stock"]) {
            return 'stock unavailable';
        } else {
            $respuesta1 = BibliotecaModel::agregarLibroCarritoModel($datos["id"], $datos["cantidad"], $usuario);
            return $respuesta1;
        }
    }

    static public function obtenerAutoresPorCategoriaController($categoria)
    {
        $respuesta = BibliotecaModel::obtenerAutoresPorCategoriaModel($categoria);

        foreach ($respuesta as $row => $item) {
            echo '<a class="list-group-item list-group-item-action autoresBiblioteca" value = "' . $item["autor"] . '" > ' . $item["autor"] . '</a>';
        }
    }

    static public function obtenerLibroPorAutorCategoriaController($datos)
    {
        $respuesta = BibliotecaModel::obtenerLibroPorAutorCategoriaModel($datos);
        return $respuesta;
    }

    static public function obtenerCarritoItemsController()
    {
        $usuario = $_SESSION['id'];
        $respuesta = BiblioTecaModel::obtenerCarritoItemModel($usuario);
        return $respuesta;
    }
}
