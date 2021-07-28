<?php

require_once "conexion.php";

class LibroModel
{
    static public function SeleccionarLibrosModel($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            //$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_alta, '%d/%m/%Y') AS date FROM $tabla ORDER BY id DESC");
            //$stmt->execute();
            //return $stmt->fetchAll();
            $stmt = Conexion::conectar()->prepare("SELECT libros.nombre, libros.imagen, libros.id ,libros.estado ,libros.fecha_alta ,libros.autor, libros.editorial, libros.stock, categorias.categoria
                                                    FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id");
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

    static public function registrarLibrosModel($tabla, $valor)
    {
        $estado = 0;
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria,
                                                                    codigo,nombre,
                                                                    autor,editorial,
                                                                    precio,stock,estado,imagen,ruta) VALUES 
                                                                    (:id_categoria,:codigo,
                                                                    :nombre,:autor,:editorial,:precio,
                                                                    :stock,:estado, :imagen, :ruta)");


        $stmt->bindParam(":id_categoria", $valor["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $valor["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $valor["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":autor", $valor["autor"], PDO::PARAM_STR);
        $stmt->bindParam(":editorial", $valor["editorial"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $valor["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $valor["stock"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt->bindParam(":imagen", $valor["imagen"], PDO::PARAM_STR);
        $stmt ->bindParam(":ruta", $valor["ruta"],PDO::PARAM_STR);



        if ($stmt->execute()) {
            return 'ok';
        } else {
            return Conexion::conectar()->errorInfo();
        }
        $stmt = null;
    }

    static public function cambiarEstadoModel($tabla, $valor)
    {
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

    static public function eliminarLibroModel($tabla, $valor)
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

    static public function actualizarStockModal($tabla, $valor)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE id = :id");
        $stmt->bindParam(":id", $valor["id"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $valor["stock"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function editarLibroModel($tabla, $valor)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                    codigo = :codigo, ruta = :ruta, nombre = :nombre, autor = :autor, editorial = :editorial,
                                    precio = :precio, imagen = :imagen, stock = :stock, ruta= :ruta  WHERE id = :id");

        if ($valor["imagen"] == "") {
            $result = Conexion::conectar()->prepare("SELECT imagen FROM $tabla WHERE id=:id");
            $result->bindParam(":id", $valor["id"], PDO::PARAM_INT);
            $result->execute();
            $result = $result->fetch();
            $valor["imagen"] = $result["imagen"];
        }

        $stmt->bindParam(":stock", $valor["stock"], PDO::PARAM_INT);
        // $stmt -> bindParam(":id_categoria", $valor["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $valor["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $valor["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $valor["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":autor", $valor["autor"], PDO::PARAM_STR);
        $stmt->bindParam(":editorial", $valor["editorial"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $valor["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $valor["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":ruta", $valor["ruta"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    static public function editarLibroStockModel($tabla, $valor){
        var_dump($valor);
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET stock = :stock WHERE id = :id");

        $stmt -> bindParam(":stock", $valor["stock"], PDO::PARAM_INT);
        $stmt -> bindParam(":id", $valor["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;

    }

    static public function buscarNombreCategoria($tabla,$item,$valor,$categoria){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM libros ,categorias WHERE libros.nombre = :$item AND libros.estado != 2 AND categorias.id = :idcategorias");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":idcategorias", $categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt = null;

    }

    static public function SeleccionarListaEditorialModel(){
        $stmt = Conexion::conectar() -> prepare("SELECT distinct editorial FROM libros ORDER BY editorial");
        $stmt -> execute();
        return $stmt -> fetchAll();  
    }

    static public function SeleccionarListaAutorModel(){
        $stmt = Conexion::conectar() -> prepare("SELECT distinct autor FROM libros ORDER BY autor");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    static public function validarNombreModel($nombre){
        $stmt = Conexion::conectar() -> prepare("SELECT libros.nombre, categorias.categoria, categorias.id FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id WHERE libros.nombre = :nombre");
        $stmt -> bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }
}
