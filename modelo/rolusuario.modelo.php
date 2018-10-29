<?php
    require_once 'conexion.php';

    class ModeloRolUsuario{
        static public function mdlConsultarRolUsuarioPorIdUsuario($idUsuario){
            $stmt= Conexion::conectar()->prepare("SELECT * FROM rolusuario WHERE idUsuario = :idUsuario");
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }

    }
?>