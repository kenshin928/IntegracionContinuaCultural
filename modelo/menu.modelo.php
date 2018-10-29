<?php
    require_once 'conexion.php';
    class ModeloMenu{
        static public function mdlConsultarMenu($administrador, $idUsuario){
            if($administrador == 'no'){
                $sql = "SELECT 
                            f.idFormulario,
                            f.nombreFormulario,
                            f.ruta,
                            f.icono,
                            c.idCarpeta,
                            c.nombre
                        FROM rolusuario ru
                        INNER JOIN rolformulario rf ON rf.idRol = ru.idRol
                        INNER JOIN formulario f ON f.idFormulario = rf.idFormulario
                        INNER JOIN carpeta c ON c.idCarpeta = f.idCarpeta
                        WHERE ru.idUsuario = :idUsuario 
                        AND f.estado = 1
                        AND c.estado = 1";
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
                $retorno->execute();
                return $retorno->fetchAll(\PDO::FETCH_OBJ);
            }else{
                $sql = "SELECT  
                        f.idFormulario,
                        f.nombreFormulario,
                        f.ruta,
                        f.icono,
                        c.idCarpeta,
                        c.nombre
                    FROM formulario f
                    INNER JOIN carpeta c ON c.idCarpeta = f.idCarpeta
                    WHERE c.estado = 1 AND f.estado = 1";
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->execute();
                return $retorno->fetchAll(\PDO::FETCH_OBJ);
            }
        }
    }

?>