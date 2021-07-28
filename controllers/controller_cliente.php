<?php

class ClienteController{
    public static function buscarClientesController(){
        $tabla = "usuarios";
        $respuesta = ClienteModel::traerClienteModal($tabla,"cliente");
        return $respuesta;
    }

    public static function traerClienteCodigoController($codigo){
        $tabla = "usuarios";
        $respuesta = ClienteModel::traerClienteCodigoModal($tabla,$codigo);
        return $respuesta;
    }

    public static function buscarClienteVentasController($idcliente){
        $tabla = "venta_libros";
        $respuesta = ClienteModel::traerClienteVentasModel($tabla,$idcliente);
        return $respuesta;

    }

    public static function traerClienteTotalLibrosController($idcliente){
        $tabla = "venta_libros";
        $respuesta = ClienteModel::traerClienteVentasModel($tabla,$idcliente);
        $cantidad = 0;
        foreach ($respuesta as $key => $value) {
        
            $cantidad += (int)$value["cantidad"];
        }
        return $cantidad;
    }

    public static function traerClienteTotalDineroController($idcliente){
        $tabla = "venta";
        $respuesta = ClienteModel::traerClienteVentasTotalModel($tabla, $idcliente);
        $monto = 0;
        foreach($respuesta as $key => $value){
            $monto += (int)$value["monto"];
        }
        return $monto;
    }


}