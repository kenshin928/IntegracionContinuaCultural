<?php
    session_start();
    require_once '../../modelo/formulario.modelo.php';
    require_once '../../modelo/carpeta.modelo.php';
    
    switch($_POST["accion"]){
        case "CONSULTA":
            $respuesta = ModeloFormulario::mdlMostrarTodoFormulario();
            echo json_encode($respuesta);
            break;
        case "CONSULTA_POR_ID":
            $respuesta = ModeloFormulario::mdlConsultarFormularioPorID($_POST['idFormulario']);
            echo json_encode($respuesta);
            break;
        case "CONSULTA_COMBO":
            $respuesta = ModeloCarpeta::mdlMostrarTodoCarpeta();
            echo json_encode($respuesta);
            break;
        case 'GUARDA':
            $datos = array(
                "idCarpeta" => $_POST['idCarpeta'],
                "nombreFormulario" => $_POST['nombreFormulario'],
                "ruta" => $_POST['ruta'],
                "estado" => $_POST['estado'],
                "icono" => $_POST['icono'],
                "idFormulario" => $_POST['idFormulario'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $respuesta = ModeloFormulario::mdlGuardarFormulario($datos);
            echo $respuesta;
            break;
        case "MODIFICA":
            $datos = array(
                "idCarpeta" => $_POST['idCarpeta'],
                "nombreFormulario" => $_POST['nombreFormulario'],
                "ruta" => $_POST['ruta'],
                "estado" => $_POST['estado'],
                "icono" => $_POST['icono'],
                "idFormulario" => $_POST['idFormulario'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $respuesta = ModeloFormulario::mdlModificarFormulario($datos);
            echo $respuesta;
            break;
        case 'ELIMINA':
            $respuesta = ModeloFormulario::mdlEliminarFormulario($_POST["idEliminar"]);
            echo $respuesta;
            break;
        
    }

?>