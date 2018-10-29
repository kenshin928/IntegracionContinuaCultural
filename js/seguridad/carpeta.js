var url = './controlador/seguridad/carpeta.controlador.php';

$( document ).ready(function() {
    $.ajax({
        data: {"accion": "CONSULTA_COMBO"},
        url: url,
        type:'post',
        dataType:'json',
        success: function(response){
            var lista = "<option value='-1'>--Seleccione--</option>";
            $.each(response, function(index, data){
                lista += "<option value='" + data.idCarpeta + "'>" + data.nombre + "</option>";
            });

            $("#ddlMenuPadre").html(lista);
            $("#ddlMenuPadreModificar").html(lista);
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
                tabla += "   <td>" + data.nombre + "</td>";
                tabla += "   <td>";
                tabla += "      <span class='badge " + (data.estado == '1' ? "badge-success" : "badge-danger") + "'>" + (data.estado == '1' ? "Activo" : "Inactivo") + "</span>";
                tabla += "   </td>";
                tabla += "   <td>" + (data.nombrePadre == null ? '' : data.nombrePadre) + "</td>";
                tabla += "   <td>";
                tabla += "      <button class='btn btn-sm btn-warning' onclick='consultarPorId(" + data.idCarpeta + ")'>";
                tabla += "          Modificar";
                tabla += "      </button>";
                tabla += "      <button class='btn btn-sm btn-danger' onclick='eliminar(" + data.idCarpeta + ");'>";
                tabla += "          Eliminar";
                tabla += "      </button>";
                tabla += "   </td>";
                tabla += "</tr>";
            })
            $("#datos").html(tabla);
        }
    });
}

function consultarPorId(idCarpeta){
    var parametros = {
        "idCarpeta" : idCarpeta,
        "accion": "CONSULTA_POR_ID"
    }
    $.ajax({
        data: parametros,
        url: url,
        type: "post",
        dataType: 'json',
        success: function(response){
            $('#modal-modificar').modal('show');
            $('#hiddenIdCarpeta').val(response.idCarpeta);
            $('#txtCodigo').val(response.codigo);
            $('#txtDescripcion').val(response.nombre);
            $('#ddlEstado').val(response.estado);
            if(response.idCarpetaPadre == null)
            {
                $('#ddlMenuPadre').val("-1");
            }
            else
            {
                $('#ddlMenuPadre').val(response.idCarpetaPadre);
            }
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
    if(validar()){
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

function validar(){
    if($("#txtCodigo").val() == "" || 
        $("#txtDescripcion").val() == "" || 
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

function cargarParametros(accion){
    return { 
        "accion" : accion,
        "codigo" : $("#txtCodigo").val(),
        "nombre" : $("#txtDescripcion").val(),
        "estado" : $("#ddlEstado").val(),
        "idCarpeta" : $('#hiddenIdCarpeta').val(),
        "idCarpetaPadre": $('#ddlMenuPadre').val()
    }
}

function nuevo(){
    $('#txtCodigo').val('');
    $('#txtDescripcion').val('');
    $('#ddlEstado').val('-1');
    $('#ddlMenuPadre').val('-1');
    $('#hiddenIdCarpeta').val();
    $('#datos').html('');
    $('#btnGuardar').removeAttr("disabled");
    $('#btnModificar').attr("disabled", "disabled");
}

