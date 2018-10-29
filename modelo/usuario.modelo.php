<?php
    require_once 'conexion.php';

    class ModeloUsuario{
        static public function mdlMostrarUsuarios($tabla, $item, $valor){
            $consulta = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $consulta->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetch();
            $consulta -> close();
            $consulta = null;
        }
        static public function mdlMostrarTodoUsuario(){
            try{
                $consulta = Conexion::conectar()->prepare("SELECT * FROM usuario");
                $consulta->execute();
                return $consulta->fetchAll(\PDO::FETCH_OBJ);
                $consulta -> close();
                $consulta = null;
            }catch(PDOException $error){
                echo $error->getMessage();
            }
        }
        static public function mdlConsultarUsuarioPorID($idUsuario){
            try{
                $retorno = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE idUsuario = ".$idUsuario);
                $retorno->execute();
                $rolUsuario = ModeloRolUsuario::mdlConsultarRolUsuarioPorIdUsuario($idUsuario);
                $valores = $retorno->fetch(\PDO::FETCH_OBJ);
                $valores->rolUsuario = $rolUsuario;
                return $valores;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error desde el modelo";
            }
        }
        static public function mdlGuardarUsuario($datos, $datosRol){
            try{
                $sql = "INSERT INTO usuario
                                    (codigo,
                                    descripcion,
                                    clave,
                                    administrador,
                                    estado,
                                    fechaCreacion,
                                    fechaModificacion,
                                    idUsuarioCreacion,
                                    idUsuarioModificacion)
                        VALUES (:codigo,
                                :descripcion,
                                :clave,
                                :administrador,
                                :estado,
                                (SELECT NOW()),
                                (SELECT NOW()),
                                :idUsuarioCreacion,
                                :idUsuarioModificacion);";
                $contrasenia = md5($datos["clave"]);
                $retorno = new Conexion();
                $stmt = $retorno->obtenerConexion()->prepare($sql);
                $retorno->obtenerConexion()->beginTransaction();
                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
                $stmt->bindParam(":clave", $contrasenia, PDO::PARAM_STR);
                $stmt->bindParam(":administrador", $datos["administrador"], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $stmt->bindParam(":idUsuarioCreacion", $datos["idUsuarioCreacion"], PDO::PARAM_INT);
                $stmt->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);
                if($stmt->execute()){
                    $idInsertado = $retorno->obtenerConexion()->lastInsertId();

                    foreach($datosRol["roles"] as $rol)
                    {
                        $sql = "INSERT INTO rolusuario
                                            (idRol,
                                            idUsuario)
                                VALUES (:idRol,
                                        :idUsuario);";
                        $stmt = $retorno->obtenerConexion()->prepare($sql);
                        $stmt->bindParam(":idRol", $rol->value, PDO::PARAM_INT);
                        $stmt->bindParam(":idUsuario", $idInsertado, PDO::PARAM_INT);
                        if(!$stmt->execute()){
                            $retorno->obtenerConexion()->rollBack();
                            return "error";
                        }
                    }
                    $retorno->obtenerConexion()->commit();
                    return "ok";
                }else{
                    $mensaje = $retorno->errorInfo();
                    return "error";
                }
                $retorno->obtenerConexion()->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }

        static public function mdlModificarUsuario($datos, $datosRol){
            try{
                $sql = "UPDATE usuario
                        SET codigo = :codigo,
                        descripcion = :descripcion,
                        clave = :clave,
                        estado = :estado,
                        administrador = :administrador,
                        fechaModificacion = (SELECT NOW()),
                        idUsuarioModificacion = :idUsuarioModificacion
                        WHERE idUsuario = :idUsuario;";
                $contrasenia = md5($datos["clave"]);

                $retorno = new Conexion();
                $stmt = $retorno->obtenerConexion()->prepare($sql);
                $retorno->obtenerConexion()->beginTransaction();

                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
                $stmt->bindParam(":clave", $contrasenia, PDO::PARAM_STR);
                $stmt->bindParam(":administrador", $datos["administrador"], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
                $stmt->bindParam(":idUsuarioModificacion", $datos["idUsuarioModificacion"], PDO::PARAM_INT);
                $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
                if($stmt->execute()){
                    $sql = "DELETE FROM rolusuario WHERE idUsuario = ".$datos["idUsuario"];
                    $stmt = $retorno->obtenerConexion()->prepare($sql);
                    $stmt->execute();
                    foreach($datosRol["roles"] as $rol)
                    {
                        $sql = "INSERT INTO rolusuario
                                            (idRol,
                                            idUsuario)
                                VALUES (:idRol,
                                        :idUsuario);";
                        $stmt = $retorno->obtenerConexion()->prepare($sql);
                        $stmt->bindParam(":idRol", $rol->value, PDO::PARAM_INT);
                        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
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
                $retorno->close();
                $retorno = null;
            }catch(PDOException $error){
                echo $error->getMessage();
                return "error modelo";
            }
        }
        static public function mdlEliminarUsuario($idUsuario){
            try{
                $retorno = Conexion::conectar()->prepare("DELETE FROM usuario WHERE idUsuario = :idUsuario");
                $retorno->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
                if($retorno->execute()){
                    $retorno = Conexion::conectar()->prepare("DELETE FROM rolusuario WHERE idUsuario = :idUsuario");
                    $retorno->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
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