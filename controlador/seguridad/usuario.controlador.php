<?php
    session_start();
    require_once '../../modelo/usuario.modelo.php';
    require_once '../../modelo/rolusuario.modelo.php';
    
    switch($_POST["accion"]){
        case "CONSULTA":
            $respuesta = ModeloUsuario::mdlMostrarTodoUsuario();
            echo json_encode($respuesta);
            break;
        case "CONSULTA_POR_ID":
            $respuesta = ModeloUsuario::mdlConsultarUsuarioPorID($_POST['idUsuario']);
            echo json_encode($respuesta);
            break;
        case 'GUARDA':
            $datos = array(
                "codigo" => $_POST['codigo'],
                "descripcion" => $_POST['descripcion'],
                "clave" => $_POST['clave'],
                "administrador" => $_POST['administrador'],
                "estado" => $_POST['estado'],
                "idUsuario" => $_POST['idUsuario'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );

            
            $datosRol = array(
                "roles" => json_decode($_POST['roles'])
            );
            $respuesta = ModeloUsuario::mdlGuardarUsuario($datos, $datosRol);
            if($respuesta == "ok"){
                echo "ok";
            }else{
                echo "error";
            }
            break;
        case "MODIFICA":
            $datos = array(
                "codigo" => $_POST['codigo'],
                "descripcion" => $_POST['descripcion'],
                "clave" => $_POST['clave'],
                "administrador" => $_POST['administrador'],
                "estado" => $_POST['estado'],
                "idUsuario" => $_POST['idUsuario'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $datosRol = array("roles"=>json_decode($_POST["roles"]));
            $respuesta = ModeloUsuario::mdlModificarUsuario($datos, $datosRol);
            echo $respuesta;
            break;
        case 'ELIMINA':
            $respuesta = ModeloUsuario::mdlEliminarUsuario($_POST["idUsuario"]);
            echo $respuesta;
            break;
    }
?>