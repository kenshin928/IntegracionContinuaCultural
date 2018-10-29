<script src="./js/seguridad/usuario.js"></script>
<div class="card">
    <div class="card-header">
        <div class="row">
            <button class="btn btn-icon btn-3 btn-primary btn-sm" type="button" onclick="nuevo();">
                <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                <span class="btn-inner--text">Nuevo</span>
            </button>
            <button class="btn btn-icon btn-3 btn-primary btn-sm" type="button" onclick="consultar();">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                <span class="btn-inner--text">Consultar</span>
            </button>
            <button class="btn btn-icon btn-3 btn-primary btn-sm" type="button" onclick="guardar();" id="btnGuardar">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Guardar</span>
            </button>
            <button class="btn btn-icon btn-3 btn-primary btn-sm" type="button" onclick="modificar();" id="btnModificar" disabled>
                <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                <span class="btn-inner--text">Modificar</span>
            </button>
        </div>
    </div>
    <div id="mensaje">
            
    </div>
    <div class="card-body">
        <h5 class="card-title">Gestionar Usuarios</h5>
        
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-user mr-2"></i>Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="far fa-user-circle mr-2"></i>Asociar roles</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        <input type="hidden" name="hiddenIdUsuario" id="hiddenIdUsuario">
        
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="txtCodigo">Nombre de usuario</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chevron-right"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de usuario" type="text" id="txtCodigo" name="txtCodigo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="txtDescripcion">Descripción</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chevron-right"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Descripción" type="text" id="txtDescripcion" name="txtDescripcion">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtClave">Clave</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chevron-right"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Clave" type="password" id="txtClave" name="txtClave">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="ddlEstado">Estado</label>
                                <select class="form-control" name="ddlEstado" id="ddlEstado">
                                    <option value="-1">--Seleccione--</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="ddlAdministrador">Administrador</label>
                                <select class="form-control" name="ddlAdministrador" id="ddlAdministrador">
                                    <option value="-1">--Seleccione--</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Administrador</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="datos">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Rol</th>
                                    </tr>
                                </thead>
                                <tbody id="datosRoles">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>