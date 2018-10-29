var menu = [];
var formularios = [];
$(document).ready(function(){
	var parametros = {
		"accion": "CONSULTA_MENU"
	}
	$.ajax({
		url: './controlador/seguridad/menu.controlador.php',
		data: parametros,
		type: 'post',
		dataType: 'json',
		success: function(response){
			$.each(response, function(index, data){
				var objMenu = {
					"idMenu": data.idCarpeta,
					"menu": data.nombre
				};
				var objForm = {
					"idFormulario" : data.idFormulario,
					"nombreFormulario" : data.nombreFormulario,
					"ruta" : data.ruta,
					"icono" : data.icono,
					"idMenu": data.idCarpeta
				};
				menu.push(objMenu);
				formularios.push(objForm);
			});

			menu = filterData(menu, "idMenu");
			formularios = filterData(formularios, "idFormulario");
			
			var menuHtml = "";
			$.each(menu, function(index, data){
				menuHtml += "<hr class='my-3'>";
				menuHtml += "	<h6 class='navbar-heading text-muted'>" + data.menu + "</h6>";
				menuHtml += "		<ul class='navbar-nav'>";
				$.each(formularios, function(index, dataForm){
					if(dataForm.idMenu == data.idMenu){
						menuHtml += "		<li class='nav-item'>";
						menuHtml += "            <a class='nav-link' href='" + dataForm.ruta + "'>";
						menuHtml += "                <i class='" + dataForm.icono + "'></i> " + dataForm.nombreFormulario;
						menuHtml += "            </a>";
						menuHtml += "       </li>";
					}
				});
				menuHtml += " </ul>";
			});
			$('#menu').html(menuHtml);
		}
	});
});

function filterData(array, property){
	return array.filter((obj, pos, arr) => {
		return arr.map(mapObj => mapObj[property]).indexOf(obj[property]) === pos;
	});
}

// DATATABLE 
$(".tabla").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});

$('#txtContraseniaCambio').keypress(function(){
	var valor = $('#txtContraseniaCambio').val();
	if(valor.length == 0){
		$('#mensajeContrasenia').html("");
	}
	if(valor.length > 0 && valor.length < 5){
		$('#mensajeContrasenia').html("<small>Seguridad de la contraseña: <span class='text-danger font-weight-700'>Baja</span></small>");
	}
	if(valor.length >= 5 && valor.length < 10){
		$('#mensajeContrasenia').html("<small>Seguridad de la contraseña: <span class='text-warning font-weight-700'>Media</span></small>");
	}
	if(valor.length >= 10 && valor.length < 15){
		$('#mensajeContrasenia').html("<small>Seguridad de la contraseña: <span class='text-success font-weight-700'>Alta</span></small>");
	}
});