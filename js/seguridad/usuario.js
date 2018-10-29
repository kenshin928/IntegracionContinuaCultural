var url = './controlador/seguridad/usuario.controlador.php';

$( document ).ready(function() {
    $.ajax({
        data: {"accion": "CONSULTA_COMBO"},
        url: './controlador/seguridad/rol.controlador.php',
        type:'post',
        dataType: 'json',
        success: function(response){
            var tabla = "";
            $.each(response, function(index, data){
                tabla += "<tr>";
                tabla += "   <td>";
                tabla += "      <div class='custom-control custom-checkbox mb-3'>";
                tabla += "          <input class='custom-control-input' id='" + (data.idRol) + "' type='checkbox' value='" + (data.idRol) + "'>";
                tabla += "          <label class='custom-control-label' for='" + (data.idRol) + "'>" + data.descripcion + "</label>";
                tabla += "      </div>";
                tabla += "  </td>";
                tabla += "</tr>";
            })
            $("#datosRoles").html(tabla);
        }
    });
});

function consultar(){
    $.ajax({
        data: cargarParametros("CONSULTA"),
        url: url,
        type: 'post',
        dataType: 'json',
        success: function(response){
            var tabla = "";
            $.each(response, function(index, data){
                tabla += "<tr>";
                tabla += "   <td>" + (index+1) + "</td>";
                tabla += "   <td>" + data.codigo + "</td>";
                tabla += "   <td>" + data.descripcion + "</td>";
                tabla += "   <td>";
                tabla += "      <span class='badge " + (data.estado == '1' ? "badge-success" : "badge-danger") + "'>" + (data.estado == '1' ? "Activo" : "Inactivo") + "</span>";
                tabla += "   </td>";
                tabla += "   <td>";
                tabla += "      <span class='badge " + (data.administrador == '1' ? "badge-success" : "badge-danger") + "'>" + (data.administrador == '1' ? "SI" : "NO") + "</span>";
                tabla += "   </td>";
                tabla += "   <td>";
                tabla += "      <button class='btn btn-sm btn-warning' onclick='consultarPorId(" + data.idUsuario + ")'>";
                tabla += "          Modificar";
                tabla += "      </button>";
                tabla += "      <button class='btn btn-sm btn-danger' onclick='eliminar(" + data.idUsuario + ");'>";
                tabla += "          Eliminar";
                tabla += "      </button>";
                tabla += "   </td>";
                tabla += "</tr>";
            })
            $("#datos").html(tabla);
        }
    });
}

function consultarPorId(idUsuario){
    var parametros = {
        "idUsuario" : idUsuario,
        "accion": "CONSULTA_POR_ID"
    }
    $.ajax({
        data: parametros,
        url: url,
        type: "post",
        dataType: 'json',
        success: function(response){
            $('#modal-modificar').modal('show');
            $('#hiddenIdUsuario').val(response.idUsuario);
            $('#txtCodigo').val(response.codigo);
            $('#txtDescripcion').val(response.descripcion);
            $('#txtClave').val(response.clave);
            $('#ddlAdministrador').val(response.administrador);
            $('#ddlEstado').val(response.estado);
            $('#btnModificar').removeAttr("disabled");
            $('#btnGuardar').attr("disabled", "disabled");
            $.each(response.rolUsuario, function(index, data){
                $('input[id=' + data.idRol + ']').prop('checked', true);
            })
        }
    })
}

function guardar(){
    if(validar()){
        $.ajax({
            data: cargarParametros("GUARDA"),
            url: url,
            type: 'post',
            success: function(response){
                mensaje(response, "Datos guardados con éxito.", "Error al guardar los datos.");
                nuevo();
            }
        });
    }
}

function modificar(){
    if(validar()){
        $.ajax({
            data: cargarParametros("MODIFICA"),
            url: url,
            type: 'post',
            success: function(response){
                mensaje(response, "Datos modificados con éxitos.", "Error al modificar los datos.");
                nuevo();
            }
        });
    }
}

function eliminar(idEliminar){
    var parametros = {
        "accion" : "ELIMINA",
        "idUsuario" : idEliminar
    }

    $.ajax({
        data: parametros,
        url: url,
        type: 'post',
        success: function(response){
            mensaje(response, "Datos eliminados con éxitos.", "Error al eliminar los datos.");
            nuevo();
        }
    });
}

function mensaje(response, mensajePositivo, mensajeNegativo)
{
    var mensaje = "";
    if(response == "ok"){
        mensaje += '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    }else{
        mensaje += '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    };
    mensaje += '<span class="alert-inner--text">';
    if(response == "ok"){
        mensaje += mensajePositivo;
    }else{
        mensaje += mensajeNegativo;
    }
    mensaje += '</span>';
    mensaje += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    mensaje += '<span aria-hidden="true">X</span>';
    mensaje += '</button>';
    mensaje += '</div>';
    $("#mensaje").html(mensaje);
}

function cargarParametros(accion){
    var parametros = [];

    $('input[type=checkbox]').each(function(){
        if(this.checked){
            var obj = {
                "id" : $(this).id,
                "value" : $(this).val()
            };
            parametros.push(obj);
        }
    });

    return { 
        "accion" : accion,
        "codigo" : $("#txtCodigo").val(),
        "descripcion" : $("#txtDescripcion").val(),
        "clave" : $("#txtClave").val(),
        "administrador" : $("#ddlAdministrador").val(),
        "estado" : $("#ddlEstado").val(),
        "idUsuario" : $('#hiddenIdUsuario').val(),
        "roles" : JSON.stringify(parametros)
    }
}

function nuevo(){
    $('#txtCodigo').val('');
    $('#txtDescripcion').val('');
    $('#txtClave').val('');
    $('#ddlAdministrador').val('-1');
    $('#ddlEstado').val('-1');
    $('#hiddenIdUsuario').val();
    $('#datos').html('');
    $('#btnGuardar').removeAttr("disabled");
    $('#btnModificar').attr("disabled", "disabled");
    $('input[type=checkbox]').each(function(){
        this.checked = false;
    });
}

function validar(){
    if($("#ddlAdministrador").val() == "-1" || 
        $("#txtDescripcion").val() == "" || 
        $("#ddlEstado").val() == "-1" || 
        $('#txtCodigo').val() == "" || 
        $('#txtClave').val() == "")
    {
        $("#mensaje").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><span class="alert-inner--text">Existen campos vacíos, por favor verifique.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button></div>');
        return false;
    }
    return true;
}
