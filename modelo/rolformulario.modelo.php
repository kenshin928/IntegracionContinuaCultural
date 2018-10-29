<?php
    require_once 'conexion.php';

    class ModeloRolFormulario{
        static public function mdlConsultarRolFormularioPorIdRol($idRol){
            $stmt= Conexion::conectar()->prepare("SELECT * FROM rolformulario WHERE idRol = :idRol");
            $stmt->bindParam(":idRol", $idRol, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }

    }
?>