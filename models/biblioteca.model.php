<?php

require_once "conexion.php";

class BibliotecaModel
{
    static public function traerCategoriaModel()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias WHERE estado = 0");
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function traerSiesLibrosMasVendidosController()
    {
        $stmt = Conexion::conectar()->prepare("SELECT venta_libros.cantidad, venta_libros.id_libro FROM venta_libros");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function traerLibrosPorCategoriaModel($categoria)
    {
        $stmt = Conexion::conectar()->prepare("SELECT libros.id,libros.nombre, categorias.categoria, libros.ruta, libros.fecha_alta, libros.autor,libros.editorial,libros.stock,libros.imagen, libros.estado FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id WHERE categorias.categoria =:categoria");

        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function traerLibroModel($nombre, $categoria)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id WHERE libros.ruta = :nombre AND categorias.categoria = :categoria");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetch();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function validarCantidadLibroModel($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT stock FROM libros WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function obtenerAutoresPorCategoriaModel($categoria)
    {
        $stmt = Conexion::conectar()->prepare("SELECT distinct libros.autor FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id WHERE categorias.categoria = :categoria AND libros.estado = 0");
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function obtenerLibroPorAutorCategoriaModel($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id WHERE categorias.categoria = :categoria AND libros.autor = :autor AND libros.estado = 0");
        $stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":autor", $datos["autor"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }


    static public function agregarLibroCarritoModel($id, $cantidad, $usuario)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO carrito(id_usuario, id_libro,cantidad) VALUES (:id_usuario, :id_libro, :cantidad)");
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(":id_libro", $id, PDO::PARAM_INT);
        $stmt->bindParam("id_usuario", $usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 0;
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }
    static public function obtenerCarritoItemModel($usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM carrito WHERE id_usuario = :usuario");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }
}
