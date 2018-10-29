var url = './controlador/seguridad/rol.controlador.php';

$( document ).ready(function() {
    $.ajax({
        data: {"accion": "CONSULTA"},
        url: './controlador/seguridad/formulario.controlador.php',
        type:'post',
        dataType:'json',
        success: function(response){
            var tabla = "";
            $.each(response, function(index, data){
                tabla += "<tr>";
                tabla += "   <td>";
                tabla += "      <div class='custom-control custom-checkbox mb-3'>";
                tabla += "          <input class='custom-control-input' id='" + (data.idFormulario) + "' type='checkbox' value='" + (data.idFormulario) + "'>";
                tabla += "          <label class='custom-control-label' for='" + (data.idFormulario) + "'>" + data.nombreFormulario + "</label>";
                tabla += "      </div>";
                tabla += "  </td>";
                tabla += "</tr>";
            })

            $("#datosFormulario").html(tabla);
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
                tabla += "   <td>" + data.descripcion + "</td>";
                tabla += "   <td>";
                tabla += "      <span class='badge " + (data.estado == '1' ? "badge-success" : "badge-danger") + "'>" + (data.estado == '1' ? "Activo" : "Inactivo") + "</span>";
                tabla += "   </td>";
                tabla += "   <td>";
                tabla += "      <button class='btn btn-sm btn-warning' onclick='consultarPorId(" + data.idRol + ")'>";
                tabla += "          Modificar";
                tabla += "      </button>";
                tabla += "      <button class='btn btn-sm btn-danger' onclick='eliminar(" + data.idRol + ");'>";
                tabla += "          Eliminar";
                tabla += "      </button>";
                tabla += "   </td>";
                tabla += "</tr>";
            })
            $("#datos").html(tabla);
        }
    });
}

function consultarPorId(idRol){
    var parametros = {
        "idRol" : idRol,
        "accion": "CONSULTA_POR_ID"
    }
    $.ajax({
        data: parametros,
        url: url,
        type: "post",
        dataType: 'json',
        success: function(response){
            $('#modal-modificar').modal('show');
            $('#hiddenIdRol').val(response.idRol);
            $('#txtDescripcion').val(response.descripcion);
            $('#ddlEstado').val(response.estado);
            $('#btnModificar').removeAttr("disabled");
            $('#btnGuardar').attr("disabled", "disabled");
            $.each(response.rolFormulario, function(index, data){
                $('input[id=' + data.idFormulario + ']').prop('checked', true);
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
    if(validar())
    {
        $.ajax({
            data: cargarParametros("MODIFICA"),
            url: url,
            type: 'post',
            success: function(response){
                mensaje(response, "Datos modificados con éxito.", "Error al modificar los datos.");
                nuevo();
            }
        });
    }
}

function eliminar(idRol){
    var parametros = {
        "accion" : "ELIMINA",
        "idRol" : idRol
    }

    $.ajax({
        data: parametros,
        url: url,
        type: 'post',
        success: function(response){
            mensaje(response, "Datos eliminados con éxito.", "Error al eliminar los datos.");
            nuevo();
        }
    });
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
        "accion": accion,
        "descripcion" : $('#txtDescripcion').val(),
        "estado" : $('#ddlEstado').val(),
        "idRol" : $('#hiddenIdRol').val(),
        "formularios" : JSON.stringify(parametros)
    }
}

function nuevo(){
    $('#txtDescripcion').val("");
    $('#ddlEstado').val("-1");
    $('#hiddenIdFormulario').val("");
    $('#datos').html('');
    $('#btnGuardar').removeAttr("disabled");
    $('#btnModificar').attr("disabled", "disabled");
    $('input[type=checkbox]').each(function(){
        this.checked = false;
    });
}

function validar(){
    if($("#txtDescripcion").val() == "" || 
        $("#ddlEstado").val() == "-1")
    {
        $("#mensaje").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><span class="alert-inner--text">Existen campos vacíos, por favor verifique.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button></div>');
        return false;
    }
    return true;
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