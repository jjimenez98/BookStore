<?php


class VentasController{
    public static function buscarVentasController(){
        $tabla = "venta";
        $respuesta = VentasModel::traerVentasModel($tabla);
        return $respuesta;
    }
}