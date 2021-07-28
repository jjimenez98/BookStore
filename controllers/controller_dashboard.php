<?php

class DashBoardController
{

    public static function  traerLibrosVendidosCategoriaController()
    {
        $categorias = DashBoardModel::traerCategoriasModel();

        $average = array();
        foreach ($categorias as $row => $item) {
            $totalVendidos = DashBoardModel::traerTotalCategoriasModel($item["id"]);
            array_push($average, [$item["categoria"] => $totalVendidos[0]["SUM(venta_libros.monto)"]]);
        }
        return $average;
    }

    static public function traerCincoLibrosMasVendidosController()
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
            if ($counter == 4) {
                break;
            }
            $fetch = DashBoardModel::traerLibroIDModel($key);
            array_push($listofrealbooks, $fetch);
            $counter++;
        }
        return $listofrealbooks;
    }

    static public function traerTotalLibrosVendidosController()
    {
        $total = DashBoardModel::traerTotalLibrosVendidosModel();
        return $total;
    }

    static public function traerTotalVentaMesController()
    {
        date_default_timezone_set('America/Tijuana');
        $current_time = date('y-m-d');
        $total = DashBoardModel::traerTotalVentaMesModel($current_time);

        $totalMonto = 0;
        foreach ($total as $key => $value) {
            $totalMonto += $value["cantidad"];
        }

        return $totalMonto;
    }
}
