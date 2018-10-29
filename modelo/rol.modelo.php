<?php
    require_once 'conexion.php';
    require_once 'rolformulario.modelo.php';

    class ModeloRol{
        static public function mdlMostrarTodoRol(){
            try{
                $consulta = Conexion::conectar()->prepare("SELECT * FROM rol");
                $consulta->execute();
                return $consulta->fetchAll(\PDO::FETCH_OBJ);
                $consulta -> close();
                $consulta = null;
            }catch(PDOException $error){
                echo $error->getMessage();
            }
        }
        static public function mdlConsultarRolPorID($idRol){
            try{
                $retorno = Conexion::conectar()->prepare("SELECT * FROM rol WHERE idRol = ".$idRol);
                $retorno->execute();
                $rolFormulario = ModeloRolFormulario::mdlConsultarRolFormularioPorIdRol($idRol);
                $valores = $retorno->fetch(\PDO::FETCH_OBJ);
                $valores->rolFormulario = $rolFormulario;
                return $valores;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error desde el modelo";
            }
        }
        static public function mdlGuardarRol($datos, $datosFormularios){
            try{
                $sql = "INSERT INTO rol
                                (descripcion,
                                estado,
                                fechaCreacion,
                                fechaModificacion,
                                idUsuarioCreacion,
                                idUsuarioModificacion)
                    VALUES (:descripcion,
                            :estado,
                            (SELECT NOW()),
                            (SELECT NOW()),
                            :idUsuarioCreacion,
                            :idUsuarioModificacion);";
                $retorno = new Conexion();
                $stmt = $retorno->obtenerConexion()->prepare($sql);
                $retorno->obtenerConexion()->beginTransaction();

                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);             
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $stmt->bindParam(":idUsuarioCreacion", $datos["idUsuarioCreacion"], PDO::PARAM_INT);
                $stmt->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);                
                if($stmt->execute()){
                    $idInsertado = $retorno->obtenerConexion()->lastInsertId();

                    foreach($datosFormularios["formulario"] as $formulario)
                    {
                        $sql = "INSERT INTO rolFormulario
                                            (idRol,
                                            idFormulario)
                                VALUES (:idRol,
                                        :idFormulario);";
                        $stmt = $retorno->obtenerConexion()->prepare($sql);
                        $stmt->bindParam(":idRol", $idInsertado, PDO::PARAM_INT);
                        $stmt->bindParam(":idFormulario", $formulario->value, PDO::PARAM_INT);
                        if(!$stmt->execute()){
                            $retorno->obtenerConexion()->rollBack();
                            return "error";
                        }
                    }
                    $retorno->obtenerConexion()->commit();
                    return "ok";
                }else{
                    return "error";
                }
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlModificarRol($datos, $datosFormularios){
            try{
                $sql = "UPDATE rol
                SET descripcion = :descripcion,
                  estado = :estado,
                  fechaModificacion = (SELECT NOW()),
                  idUsuarioModificacion = :idUsuarioModificacion
                WHERE idRol = :idRol;";

                $retorno = new Conexion();
                $stmt = $retorno->obtenerConexion()->prepare($sql);
                $retorno->obtenerConexion()->beginTransaction();

                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_INT);
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $stmt->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);
                $stmt->bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
                if($stmt->execute()){
                    $sql = "DELETE FROM rolFormulario WHERE idRol = ".$datos["idRol"];
                    $stmt = $retorno->obtenerConexion()->prepare($sql);
                    $stmt->execute();
                    foreach($datosFormularios["formulario"] as $formulario)
                    {
                        $sql = "INSERT INTO rolFormulario
                                            (idRol,
                                            idFormulario)
                                VALUES (:idRol,
                                        :idFormulario);";
                        $stmt = $retorno->obtenerConexion()->prepare($sql);
                        $stmt->bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
                        $stmt->bindParam(":idFormulario", $formulario->value, PDO::PARAM_INT);
                        if(!$stmt->execute()){
                            $retorno->obtenerConexion()->rollBack();
                            return "error";
                        }
                    }
                    $retorno->obtenerConexion()->commit();
                    return "ok";
                }else{
                    return "error";
                }
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlEliminarRol($idEliminar){
            try{
                $retorno = Conexion::conectar()->prepare("DELETE FROM rol WHERE idRol = :idRol");
                $retorno->bindParam(":idRol", $idEliminar, PDO::PARAM_INT);
                if($retorno->execute()){
                    $retorno = Conexion::conectar()->prepare("DELETE FROM rolFormulario WHERE idRol = :idRol");
                    $retorno->bindParam(":idRol", $idEliminar, PDO::PARAM_INT);
                    $retorno->execute();
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