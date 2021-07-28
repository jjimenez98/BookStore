<?php

    class MetricosController{

        public static function  traerLibrosVendidosCategoria(){
            $categorias = MetricosModel::traerCategorias();
        
            $average = array();
            foreach ($categorias as $row => $item) {
                $totalVendidos = MetricosModel::traerTotalCategorias($item["id"]);
                array_push($average,[$item["categoria"] => $totalVendidos[0]["SUM(venta_libros.monto)"]]);
            }
            return $average;
        }


    }