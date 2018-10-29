var url = './controlador/seguridad/formulario.controlador.php';

$( document ).ready(function() {
    $.ajax({
        data: {"accion": "CONSULTA_COMBO"},
        url: url,
        type:'post',
        dataType: 'json',
        success: function(response){
            var lista = "<option value='-1'>--Seleccione--</option>";
            $.each(response, function(index, data){
                lista += "<option value='" + data.idCarpeta + "'>" + data.nombre + "</option>";
            });
            $("#ddlCarpeta").html(lista);
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
                tabla += "   <td>" + data.nombreFormulario + "</td>";
                tabla += "   <td>" + data.ruta + "</td>";
                tabla += "   <td>" + data.icono + "</td>";
                tabla += "   <td>";
                tabla += "      <span class='badge " + (data.estado == '1' ? "badge-success" : "badge-danger") + "'>" + (data.estado == '1' ? "Activo" : "Inactivo") + "</span>";
                tabla += "   </td>";
                tabla += "   <td>" + data.nombreCarpeta + "</td>";
                tabla += "   <td>";
                tabla += "      <button class='btn btn-sm btn-warning' onclick='consultarPorId(" + data.idFormulario + ")'>";
                tabla += "          Modificar";
                tabla += "      </button>";
                tabla += "      <button class='btn btn-sm btn-danger' onclick='eliminar(" + data.idFormulario + ");'>";
                tabla += "          Eliminar";
                tabla += "      </button>";
                tabla += "   </td>";
                tabla += "</tr>";
            })
            $("#datos").html(tabla);
        }
    });
}

function consultarPorId(idFormulario){
    var parametros = {
        "idFormulario" : idFormulario,
        "accion": "CONSULTA_POR_ID"
    }
    $.ajax({
        data: parametros,
        url: url,
        type: "post",
        dataType: 'json',
        success: function(response){
            $('#modal-modificar').modal('show');
            $('#hiddenIdFormulario').val(response.idFormulario); 
            $('#ddlCarpeta').val(response.idCarpeta);
            $('#txtNombreFormulario').val(response.nombreFormulario);
            $('#txtRuta').val(response.ruta);
            $('#txtIcono').val(response.icono);
            $('#ddlEstado').val(response.estado);
            $('#btnModificar').removeAttr("disabled");
            $('#btnGuardar').attr("disabled", "disabled");
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

function eliminar(idEliminar){
    var parametros = {
        "accion" : "ELIMINA",
        "idEliminar" : idEliminar
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
    return { 
        "accion": accion,
        "idCarpeta" : $('#ddlCarpeta').val(),
        "nombreFormulario" : $('#txtNombreFormulario').val(),
        "ruta" : $('#txtRuta').val(),
        "estado" : $('#ddlEstado').val(),
        "icono" : $('#txtIcono').val(),
        "idFormulario" : $('#hiddenIdFormulario').val()
    }
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

function nuevo(){
    $('#ddlCarpeta').val("-1");
    $('#txtNombreFormulario').val("");
    $('#txtRuta').val("");
    $('#ddlEstado').val("-1");
    $('#txtIcono').val("");
    $('#hiddenIdFormulario').val("");
    $('#datos').html('');
    $('#btnGuardar').removeAttr("disabled");
    $('#btnModificar').attr("disabled", "disabled");
}

function validar(){
    if($("#ddlCarpeta").val() == "-1" || 
        $("#txtNombreFormulario").val() == "" || 
        $("#ddlEstado").val() == "-1" || 
        $('#txtRuta').val() == "" || 
        $('#txtIcono').val() == "")
    {
        $("#mensaje").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><span class="alert-inner--text">Existen campos vacíos, por favor verifique.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button></div>');
        //alert("Existen campos vacíos, por favor verifique.");
        return false;
    }
    return true;
}

