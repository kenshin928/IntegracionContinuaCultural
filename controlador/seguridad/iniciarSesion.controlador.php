<?php
    class ControladorUsuario{
        static public function ctrIniciarSesion()
        {
            if(isset($_POST["txtUsuario"])){
                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["txtUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["txtContrasenia"])){
                    $tabla = "usuario";
                    $item = "codigo";
                    $valor = $_POST["txtUsuario"];
                    $respuesta = ModeloUsuario::mdlMostrarUsuarios($tabla, $item, $valor);
                    if($respuesta["codigo"] == $_POST["txtUsuario"] &&
                        $respuesta["clave"] == EncriptarPassMD5::Encriptar($_POST["txtContrasenia"]) ){
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["nombreUsuario"] = $respuesta["descripcion"];
                        $_SESSION["idUsuario"] = $respuesta["idUsuario"];
                        $respuesta["administrador"] == '1' ? $_SESSION["administrador"] = "si" : $_SESSION["administrador"] = "no";
                        echo '<script>
                            window.location = "inicio";
                        </script>';
                    }else{
                        echo '<br>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Los datos de usuario son incorrectos.
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
                    }
                }
            }
        }
    }
?>