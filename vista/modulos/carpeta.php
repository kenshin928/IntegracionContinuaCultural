<script src="./js/seguridad/carpeta.js"></script>
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
            <input type="hidden" name="hiddenIdCarpeta" id="hiddenIdCarpeta">
            <h5 class="card-title">Gestionar Menú</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="txtCodigo">Código</label>
                        <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                        </div>
                        <input class="form-control" placeholder="Código" type="text" id="txtCodigo" name="txtCodigo">
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
            <div class="col-md-3">
                <label for="ddlEstado">Estado</label>
                <select class="form-control" name="ddlEstado" id="ddlEstado">
                    <option value="-1">--Seleccione--</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="ddlCarpeta">Menú Padre</label>
                <select class="form-control" name="ddlMenuPadre" id="ddlMenuPadre">
                </select>
            </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Menú padre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="datos">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>