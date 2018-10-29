<?php
    require_once 'conexion.php';

    class ModeloCarpeta{
        static public function mdlMostrarTodoCarpeta(){
            try{
                $consulta = Conexion::conectar()->prepare("SELECT c.*, cp.nombre AS 'nombrePadre' FROM carpeta c LEFT JOIN carpeta cp ON cp.idCarpeta = c.idCarpetaPadre");
                $consulta->execute();
                return $consulta->fetchAll(\PDO::FETCH_OBJ);
                $consulta -> close();
                $consulta = null;
            }catch(PDOException $error){
                echo $error->getMessage();
            }
        }
        static public function mdlConsultarCarpetaPorID($idCarpeta){
            try{
                $retorno = Conexion::conectar()->prepare("SELECT * FROM carpeta WHERE idCarpeta = ".$idCarpeta);
                $retorno->execute();
                return $retorno->fetch(\PDO::FETCH_OBJ);
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error desde el modelo";
            }
        }
        static public function mdlGuardarCarpeta($carpeta){
            try{
                $sql = "INSERT INTO carpeta
                                (idCarpetaPadre,
                                codigo,
                                nombre,
                                estado,
                                fechaCreacion,
                                fechaModificacion,
                                idUsuarioCreacion,
                                idUsuarioModificacion)
                    VALUES (:idCarpetaPadre,
                            :codigo,
                            :nombre,
                            :estado,
                            (SELECT NOW()),
                            (SELECT NOW()),
                            :idUsuarioCreacion,
                            :idUsuarioModificacion);";
                $idCarpetaPadre = ($carpeta["idCarpetaPadre"] !== '-1' ? $carpeta["idCarpetaPadre"] : null);
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->bindParam(":idCarpetaPadre", $idCarpetaPadre, PDO::PARAM_INT);
                $retorno->bindParam(":codigo", $carpeta["codigo"], PDO::PARAM_STR);
                $retorno->bindParam(":nombre", $carpeta["nombre"], PDO::PARAM_STR);
                $retorno->bindParam(":estado", $carpeta["estado"], PDO::PARAM_STR);
                $retorno->bindParam(":idUsuarioCreacion", $carpeta["idUsuarioCreacion"], PDO::PARAM_INT);
                $retorno->bindParam(":idUsuarioModificacion", $carpeta["idUsuarioModificacion"], PDO::PARAM_INT);
                if($retorno->execute()){
                    return "ok";
                }else{
                    $a = $retorno->errorInfo();
                    return "error";
                    
                }
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlModificarCarpeta($datos){
            try{
                $sql = "UPDATE carpeta
                        SET idCarpetaPadre = :idCarpetaPadre,
                            codigo = :codigo,
                            nombre = :nombre,
                            estado = :estado,
                            fechaModificacion = (SELECT NOW()),
                            idUsuarioModificacion = :idUsuarioModificacion
                        WHERE idCarpeta = :idCarpeta;";
                $idCarpetaPadre = ($datos["idCarpetaPadre"] !== '-1' ? $datos["idCarpetaPadre"] : null);
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->bindParam(":idCarpetaPadre", $idCarpetaPadre, PDO::PARAM_INT);
                $retorno->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
                $retorno->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $retorno->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $retorno->bindParam(":idCarpeta", $datos["idCarpeta"], PDO::PARAM_INT);
                $retorno->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);
                if($retorno->execute()){
                    return "ok";
                }else{
                    $a = $retorno->errorInfo();
                    return "error";
                }
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlEliminarCarpeta($idEliminar){
            try{
                $retorno = Conexion::conectar()->prepare("DELETE FROM carpeta WHERE idCarpeta = :idCarpeta");
                $retorno->bindParam(":idCarpeta", $idEliminar, PDO::PARAM_INT);
                if($retorno->execute()){
                    return "ok";
                }else{
                    return "error";
                }
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
            }
        }
    }
?>