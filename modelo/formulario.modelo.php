<?php
    require_once 'conexion.php';

    class ModeloFormulario{
        static public function mdlMostrarTodoFormulario(){
            try{
                $consulta = Conexion::conectar()->prepare("SELECT c.*, cp.nombre AS 'nombreCarpeta' FROM formulario c LEFT JOIN carpeta cp ON cp.idCarpeta = c.idCarpeta");
                $consulta->execute();
                return $consulta->fetchAll(\PDO::FETCH_OBJ);
                $consulta -> close();
                $consulta = null;
            }catch(PDOException $error){
                echo $error->getMessage();
            }
        }
        static public function mdlConsultarFormularioPorID($idFormulario){
            try{
                $retorno = Conexion::conectar()->prepare("SELECT * FROM formulario WHERE idFormulario = ".$idFormulario);
                $retorno->execute();
                return $retorno->fetch(\PDO::FETCH_OBJ);
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error desde el modelo";
            }
        }
        static public function mdlGuardarFormulario($formulario){
            try{
                $sql = "INSERT INTO thexperto.formulario
                                        (idCarpeta,
                                        nombreFormulario,
                                        ruta,
                                        icono,
                                        estado,
                                        fechaCreacion,
                                        fechaModificacion,
                                        idUsuarioCreacion,
                                        idUsuarioModificacion)
                            VALUES (:idCarpeta,
                                    :nombreFormulario,
                                    :ruta,
                                    :icono,
                                    :estado,
                                    (SELECT NOW()),
                                    (SELECT NOW()),
                                    :idUsuarioCreacion,
                                    :idUsuarioModificacion);";
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->bindParam(":idCarpeta", $formulario["idCarpeta"], PDO::PARAM_INT);
                $retorno->bindParam(":nombreFormulario", $formulario["nombreFormulario"], PDO::PARAM_STR);
                $retorno->bindParam(":ruta", $formulario["ruta"], PDO::PARAM_STR);
                $retorno->bindParam(":icono", $formulario["icono"], PDO::PARAM_STR);
                $retorno->bindParam(":estado", $formulario["estado"], PDO::PARAM_STR);
                $retorno->bindParam(":idUsuarioCreacion", $formulario["idUsuarioCreacion"], PDO::PARAM_INT);
                $retorno->bindParam(":idUsuarioModificacion", $formulario["idUsuarioModificacion"], PDO::PARAM_INT);
                if($retorno->execute()){
                    return "ok";
                }else{
                    return "error";
                }
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlModificarFormulario($datos){
            try{
                $sql = "UPDATE formulario
                        SET idCarpeta = :idCarpeta,
                        nombreFormulario = :nombreFormulario,
                        ruta = :ruta,
                        icono = :icono,
                        estado = :estado,
                        fechaModificacion = (SELECT NOW()),
                        idUsuarioModificacion = :idUsuarioModificacion
                        WHERE idFormulario = :idFormulario;";
                $retorno = Conexion::conectar()->prepare($sql);
                $retorno->bindParam(":idCarpeta", $datos["idCarpeta"], PDO::PARAM_INT);
                $retorno->bindParam(":nombreFormulario", $datos["nombreFormulario"], PDO::PARAM_STR);
                $retorno->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
                $retorno->bindParam(":icono", $datos["icono"], PDO::PARAM_STR);
                $retorno->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
                $retorno->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);
                $retorno->bindParam(":idFormulario", $datos["idFormulario"], PDO::PARAM_INT);
                if($retorno->execute()){
                    return "ok";
                }else{
                    return "error";
                }
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlEliminarFormulario($idEliminar){
            try{
                $retorno = Conexion::conectar()->prepare("DELETE FROM formulario WHERE idFormulario = :idFormulario");
                $retorno->bindParam(":idFormulario", $idEliminar, PDO::PARAM_INT);
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