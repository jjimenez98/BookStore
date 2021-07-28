<?php

require_once "conexion.php";

class UsuarioModel
{
    static public function SeleccionarUsuariosModel($tabla, $item, $valor)
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

    static public function eliminarUsuarioModel($tabla, $valor)
    {
        $estado = 2;
        print_r($valor);
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");
        $stmt->bindParam(":id", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }

    static public function registrarUsuarioModel($tabla, $valor)
    {
        var_dump($valor);

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_completo,
                                        codigo,
                                        fecha_nacimiento,
                                        nivel,
                                        imagen,
                                        estado,
                                        correo,
                                        id_alta,
                                        contrasena) VALUES 
                                        ( :nombre_completo,
                                          :codigo,
                                          :fecha_nacimiento,
                                          :nivel,
                                          :imagen,
                                          :estado,
                                          :correo,
                                          :id_alta,
                                          :contrasena)");

        $stmt->bindParam(":nombre_completo", $valor["registrarNombre"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $valor["registrarCodigo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $valor["registrarNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":nivel", $valor["registrarNivel"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $valor["registrarImagen"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $valor["registrarEstado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_alta", $valor["registrarIdalta"], PDO::PARAM_INT);
        $stmt->bindParam(":correo", $valor["registrarCorreo"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $valor["registrarContraseña"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        $stmt = null;
    }
    static public function editarUsuarioModel($tabla, $valor)
    {
        if ($valor["editarContrasena"] == "") {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_completo=:nombre_completo, codigo=:codigo, 
            fecha_nacimiento=:fecha_nacimiento, nivel=:nivel, imagen=:imagen, estado=:estado,
             correo=:correo WHERE id = :id");

             print_r($valor["editarImagen"]);

            if($valor["editarImagen"] == ""){
                $result = Conexion::conectar()->prepare("SELECT imagen FROM $tabla WHERE id=:id");
                $result->bindParam(":id", $valor["editarID"], PDO::PARAM_INT);
                $result->execute();
                $result = $result->fetch();
                $valor["editarImagen"] = $result["imagen"];
            }

      

            $stmt->bindParam(":nombre_completo", $valor["editarNombre"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $valor["editarCodigo"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $valor["editarNacimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":nivel", $valor["editarNivel"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $valor["editarImagen"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $valor["editarEstado"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $valor["editarCorreo"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $valor["editarID"], PDO::PARAM_INT);
        } else {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_completo=:nombre_completo, codigo=:codigo, 
                                        fecha_nacimiento=:fecha_nacimiento, nivel=:nivel, imagen=:imagen, estado=:estado,
                                         correo=:correo, contrasena=:contrasena WHERE id = :id");

            $stmt->bindParam(":nombre_completo", $valor["editarNombre"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $valor["editarCodigo"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $valor["editarNacimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":nivel", $valor["editarNivel"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $valor["editarImagen"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $valor["editarEstado"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $valor["editarCorreo"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $valor["editarID"], PDO::PARAM_INT);
            $stmt->bindParam(":contrasena", $valor["editarContrasena"], PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            return 'ok';
        } else {
            print_r(Conexion::conectar()->errorInfo());
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
}
