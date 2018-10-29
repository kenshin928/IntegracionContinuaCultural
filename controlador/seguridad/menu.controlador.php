<?php
    session_start();
    require_once '../../modelo/menu.modelo.php';

    switch($_POST["accion"]){
        case "CONSULTA_MENU":
            if(isset($_SESSION["iniciarSesion"]) && 
                $_SESSION["iniciarSesion"] == "ok"){
                $respuesta = ModeloMenu::mdlConsultarMenu($_SESSION["administrador"], $_SESSION["idUsuario"]);
                echo json_encode($respuesta);
            }
            break;
    }

?>