<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>SIC</title>
  
  <!--
    ======================================================
    ESTILOS IMPORTADOS
    ======================================================
  -->

  <!-- Favicon -->
  <link href="./assets/img/brand/favicon-thexperto.png" rel="icon" type="image/png">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">

  <!-- DATA TABLE-->
  <link type="text/css" href="./assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="./assets/css/responsive.bootstrap.min.css" rel="stylesheet">

  <!--
      ===================================================
      JAVASCRIPT IMPORTADO
      ===================================================
  -->

  <!-- JQUERY -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>

  <!-- BOOTSTRAP -->
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ARGON -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>

  <!-- DATATABLES -->
  <script src="./assets/js/jquery.dataTables.min.js"></script>
  <script src="./assets/js/dataTables.responsive.min.js"></script>
  <script src="./assets/js/responsive.bootstrap.min.js"></script>
  <script src="./assets/js/dataTables.bootstrap.min.js"></script>

</head>

<body>
    <?php
        if(isset($_SESSION["iniciarSesion"]) && 
            $_SESSION["iniciarSesion"] == "ok"){

            include "modulos/menu.php";
            echo '<div class="main-content">';
            include "modulos/cabezote.php";
            echo '<div class="container-fluid mt--7">';
            if(isset($_GET["ruta"])){
                if($_GET["ruta"] == "inicio" ||
                    $_GET["ruta"] == "usuario" ||
                    $_GET["ruta"] == "formulario" ||
                    $_GET["ruta"] == "rol" ||
                    $_GET["ruta"] == "salir" ||
                    $_GET["ruta"] == "carpeta"){
                    include "modulos/".$_GET["ruta"].".php";
                }
                else{
                    include "modulos/404.php";
                }
            }else{
                include "modulos/404.php";
            }
            include "modulos/footer.php";
            
            echo '</div>';
            echo '</div>';

        }else{
            if(isset($_GET["ruta"])){
                if($_GET["ruta"] == "login" ||
                    $_GET["ruta"] == "registro" ||
                    $_GET["ruta"] == "recuperar-pass"){
                    include "modulos/".$_GET["ruta"].".php";
                }
                else{
                    include "modulos/404.php";
                }
            }else{
                include "modulos/login.php";
            }
        }
    ?>
<script src="./assets/js/plantilla.js"></script>
</body>
</html>