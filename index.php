<?php
    require_once 'controlador/plantilla.controlador.php';
    require_once 'controlador/seguridad/iniciarSesion.controlador.php';
    require_once 'controlador/md5.controlador.php';
    require_once 'modelo/usuario.modelo.php';

    $plantilla = new ControladorPlantilla();
    $plantilla->ctrPlantilla();


?>