<?php

require_once "conexion.php";

class loginModel
{
    static public function SeleccionarIngresoModel($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS date FROM $tabla ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll;
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS date FROM $tabla WHERE $item = :$item ORDER BY id DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
        $stmt = null;
    }
}
