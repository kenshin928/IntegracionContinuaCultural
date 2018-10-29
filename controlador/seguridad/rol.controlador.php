<?php
    session_start();
    require_once '../../modelo/rol.modelo.php';
    
    switch($_POST["accion"]){
        case "CONSULTA":
            $respuesta = ModeloRol::mdlMostrarTodoRol();
            echo json_encode($respuesta);
            break;
        case "CONSULTA_POR_ID":
            $respuesta = ModeloRol::mdlConsultarRolPorID($_POST['idRol']);
            echo json_encode($respuesta);
            break;
        case "CONSULTA_COMBO":
            $respuesta = ModeloRol::mdlMostrarTodoRol();
            echo json_encode($respuesta);
            break;
        case 'GUARDA':
            $datos = array(
                "idRol" => $_POST['idRol'],
                "descripcion" => $_POST['descripcion'],
                "estado" => $_POST['estado'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $datosFormularios = array("formulario" => json_decode($_POST['formularios']));
            $respuesta = ModeloRol::mdlGuardarRol($datos, $datosFormularios);
            echo $respuesta;
            break;
        case "MODIFICA":
            $datos = array(
                "idRol" => $_POST['idRol'],
                "descripcion" => $_POST['descripcion'],
                "estado" => $_POST['estado'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $datosFormularios = array("formulario" => json_decode($_POST['formularios']));
            $respuesta = ModeloRol::mdlModificarRol($datos, $datosFormularios);
            echo $respuesta;
            break;
        case 'ELIMINA':
            $respuesta = ModeloRol::mdlEliminarRol($_POST["idRol"]);
            echo $respuesta;
            break;
    }
?>