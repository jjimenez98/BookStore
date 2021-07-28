<?php

require_once "conexion.php";

class VentasModel{
    public static function traerVentasModel($tabla){
        $stmt = Conexion::conectar() -> prepare("SELECT usuarios.correo, venta.monto, venta.fecha_alta FROM venta INNER JOIN usuarios ON venta.id_usuario = usuarios.id");

        $stmt ->execute();
        return $stmt -> fetchAll();
        $stmt = null;
    }
}