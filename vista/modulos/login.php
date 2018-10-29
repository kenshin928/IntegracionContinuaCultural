<div class="main-content">
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <img src="./assets/img/brand/logo.png" class="img-fluid img-responsive">
              </div>
              <form role="form" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nombre de usuario" type="text" name="txtUsuario">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Contraseña" type="password" name="txtContrasenia">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-1">Iniciar sesión</button>
                </div>
                <?php
                    $instancia = new ControladorUsuario();
                    $instancia->ctrIniciarSesion();
                ?>
              </form>
            </div>
          </div>
          <div class="row mt-1">
            <div class="col-6">
              <a href="recuperar-pass" class="text-light"><small>¿Olvidó la contraseña?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="registro" class="text-light"><small>Crear una cuenta</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Footer -->
<footer class="py-1">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
            &copy; 2018 <a href="https://www.sic.com" class="font-weight-bold ml-1" target="_blank">SIC</a>
            </div>
        </div>
        </div>
    </div>
</footer>
  