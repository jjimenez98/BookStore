<?php

require_once "conexion.php";

class ClienteModel{

    public static function traerClienteModal($tabla,$valor){

        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE nivel = :nivel ORDER BY id");
        $stmt -> bindParam(":nivel",$valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetchAll();

    }

    public static function traerClienteCodigoModal($tabla,$codigo){
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE codigo = :codigo");
        $stmt -> bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch();
    }

    public static function traerClienteVentasModel($tabla, $idcliente){
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id_usuario = :idcliente");
        $stmt -> bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt->fetchAll();
    }

    public static function traerClienteVentasTotalModel($tabla , $idcliente){
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id_usuario = :idcliente");
        $stmt -> bindParam(":idcliente",$idcliente, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

}