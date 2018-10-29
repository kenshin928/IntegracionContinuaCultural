<?php
    session_start();
    require_once '../../modelo/carpeta.modelo.php';

    
    switch($_POST["accion"]){
        case "CONSULTA":
            $respuesta = ModeloCarpeta::mdlMostrarTodoCarpeta();
            echo json_encode($respuesta);
            /*$valores = "";
            foreach($respuesta as $dato){
                $valores .= "<tr>
                                <td>".$dato->codigo."</td>
                                <td>".$dato->nombre."</td>
                                <td>
                                    <span class='badge ".($dato->estado == '1' ? "badge-success" : "badge-danger")."'>".($dato->estado == '1' ? "Activo" : "Inactivo")."</span>
                                </td>
                                <td>".$dato->nombrePadre."</td>
                                <td>
                                    <button class='btn btn-sm btn-warning' onclick='consultarPorId(".$dato->idCarpeta.")'>
                                        Modificar
                                    </button>
                                    <button class='btn btn-sm btn-danger' onclick='eliminar(".$dato->idCarpeta.");'>
                                        Eliminar
                                    </button>
                                </td>
                            </tr>";
            }
            echo $valores;*/
            break;
        case "CONSULTA_POR_ID":
            $respuesta = ModeloCarpeta::mdlConsultarCarpetaPorID($_POST['idCarpeta']);
            echo json_encode($respuesta);
            break;
        case "CONSULTA_COMBO":
            $respuesta = ModeloCarpeta::mdlMostrarTodoCarpeta();
            echo json_encode($respuesta);
            break;
        case 'GUARDA':
            $datos = array(
                "idCarpetaPadre" => $_POST['idCarpetaPadre'],
                "codigo" => $_POST['codigo'],
                "nombre" => $_POST['nombre'],
                "estado" => $_POST['estado'],
                "idCarpeta" => $_POST['idCarpeta'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"],
                "idUsuarioCreacion" => $_SESSION["idUsuario"]
            );
            $respuesta = ModeloCarpeta::mdlGuardarCarpeta($datos);
            echo $respuesta;
            /*if($respuesta == "ok"){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Datos guardados con éxito
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Error al guardar.
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }*/
            break;
        case "MODIFICA":
            $datos = array(
                "idCarpetaPadre" => $_POST['idCarpetaPadre'],
                "codigo" => $_POST['codigo'],
                "nombre" => $_POST['nombre'],
                "estado" => $_POST['estado'],
                "idCarpeta" => $_POST['idCarpeta'],
                "idUsuarioModificacion" => $_SESSION["idUsuario"]
            );
            $respuesta = ModeloCarpeta::mdlModificarCarpeta($datos);
            echo $respuesta;
            /*
            if($respuesta == "ok"){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Datos guardados con éxito
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Error al guardar.
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }*/
            break;
        case 'ELIMINA':
            $respuesta = ModeloCarpeta::mdlEliminarCarpeta($_POST["idEliminar"]);
            echo $respuesta;
            /*if($respuesta == "ok"){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Dato eliminado correctamente.
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">
                                    Error al eliminar.
                                </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                </button>
                            </div>';
            }*/
            break;
    }
?>