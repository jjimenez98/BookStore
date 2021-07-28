<?php

require_once "conexion.php";

class CategoriasModel
{
    static public function agregarCategoriaModel($tabla, $valor)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria,ruta,estado,id_alta) 
                                               VALUES (:categoria,:ruta,:estado,:id_alta)");
        $stmt->bindParam(":categoria", $valor["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $valor["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $valor["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_alta", $valor, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }
    static public function SeleccionarCategoriaModel($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS date FROM $tabla ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS date FROM $tabla WHERE $item = :$item AND estado != 2 ORDER BY id DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
        $stmt = null;
    }
    static public function eliminarCategoriaModel($tabla, $valor)
    {
        $estado = 2;
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");
        $stmt->bindParam(":id", $valor["eliminarID"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function editarCategoriaModel($tabla, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria=:categoria, ruta=:ruta WHERE id = :id");



        $stmt->bindParam(":categoria", $valor["editarCategoria"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor["editarID"], PDO::PARAM_INT);
        $stmt->bindParam(":ruta", $valor["editarRuta"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function cambiarEstadoModel($tabla, $valor){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado=:estado WHERE id = :id");
        $stmt->bindParam(":estado", $valor["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $valor["id"], PDO::PARAM_INT);


        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }
}
