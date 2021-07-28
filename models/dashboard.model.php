<?php

require_once "conexion.php";

    class DashBoardModel{
        static public function traerCategoriasModel(){
            $stmt = Conexion::conectar() -> prepare("SELECT * FROM categorias WHERE estado != 2");
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function traerTotalCategoriasModel($categoriaId){
            $stmt = Conexion::conectar() -> prepare("SELECT SUM(venta_libros.monto) FROM venta_libros INNER JOIN libros ON venta_libros.id_libro = libros.id WHERE libros.id_categoria =:categoria AND libros.estado != 2");
            $stmt -> bindParam(":categoria",$categoriaId,PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt->fetchAll();

        }

        static public function traerCincoLibrosMasVendidosModel(){
            $stmt = Conexion::conectar() -> prepare("SELECT venta_libros.cantidad, venta_libros.id_libro FROM venta_libros");
            $stmt -> execute();
            return $stmt -> fetchAll();

        }

        static public function traerTotalLibrosVendidosModel(){
            $stmt = Conexion::conectar() -> prepare("SELECT SUM(monto) FROM venta_libros");
            $stmt -> execute();
            return $stmt -> fetch();
        }

        //$date = current date
        static public function traerTotalVentaMesModel($date){
            $stmt = Conexion::conectar() -> prepare("SELECT * FROM venta_libros WHERE MONTH(`fecha_alta`) = MONTH('$date') AND YEAR(`fecha_alta`) = YEAR('$date')");
            $stmt -> execute();
            return $stmt -> fetchAll();

        }

        static public function traerLibroIDModel($id){
            $stmt = Conexion::conectar() -> prepare("SELECT * FROM libros WHERE id = '$id'");
            $stmt -> execute();
            return $stmt -> fetch();
        }

    }