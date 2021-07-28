<?php

require_once "conexion.php";

    class MetricosModel{
        static public function traerCategorias(){
            $stmt = Conexion::conectar() -> prepare("SELECT * FROM categorias WHERE estado != 2");
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function traerTotalCategorias($categoriaId){
            $stmt = Conexion::conectar() -> prepare("SELECT SUM(venta_libros.monto) FROM venta_libros INNER JOIN libros ON venta_libros.id_libro = libros.id WHERE libros.id_categoria =:categoria AND libros.estado != 2");
            $stmt -> bindParam(":categoria",$categoriaId,PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();

        }

    }