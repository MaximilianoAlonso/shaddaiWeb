function tabla_tipo_cambio(){
	$('#tabla_tipo_cambio').dataTable( {
		responsive: true,
		"sDom": "<'row'<'col-md-6'f r l T ><'col-md-6' <'export'> <'toolbar'> >><'datatable-cont't><'row'<'col-md-6'i> <'col-md-6'p>>",
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "_MENU_",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
		},
		"aaSorting": [[ 4, "desc" ]],
	} );
	if(!$("#datatable.no-add").length){
		$("div.toolbar").html('<a href="'+site+'/agregar" class="btn btn-primary" style="margin-left:12px" id="test2">Agregar</a>');
	}
	if(!$("#datatable.no-xls").length){
		$("div.export").html('<span id="exportar_excel" class="btn btn-outline btn-primary btn-excel"><i class="fa fa-file-excel-o"></i> Exportar Excel</span>');
	}
}

$(document).ready(function() {

	if($("#tabla_tipo_cambio").length){
		tabla_tipo_cambio();
	}
	if($("#datatable.desc").length){
		var orden = "desc";
	}else{
		var orden = "asc";
	}

	$('#datatable').DataTable({
		stateSave: true,
		responsive: true,
		"aaSorting": [[ 0, orden ]],
		"sDom": "<'row'<'col-md-6'f r l T ><'col-md-6' <'toolbar'> >><'datatable-cont't><'row'<'col-md-6'i> <'col-md-6'p>>",
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "_MENU_",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
		},

		"processing": true,

		"serverSide": true,

		data: { data: 'data'},

		"ajax":{

			url : website + "tabla",

			type: "post",

			error: function(e){

				$(".datatable-error").html("");

				$("#datatable_processing").css("display","none");

			},

		}
	});

	if($("#datatable").length){
		var toolbar = '';
		var site_ = location.href;
		site_ = site_.replace('?n', '');
		site_ = site_.replace('?t', '');

		if($("#datatable.edicion").length > 0){
			toolbar += '<a href="'+site_+'/edicion" class="btn btn-info btn-excel">Edición Rápida</a> ';
		}
		if($("#datatable.orden").length > 0){
			toolbar += '<a href="'+site_+'/orden" class="btn btn-outline btn-warning" style="margin-left:12px" > Orden</a> ';
		}
		if(!$("#datatable.no-add").length > 0){
			toolbar += '<a href="'+site_+'/agregar" class="btn btn-primary" style="margin-left:12px" >Agregar</a> ';
		}
		if(!$("#datatable.no-xls").length > 0){
			toolbar += '<a href="'+site_+'/exportar" class="btn btn-outline btn-primary btn-excel" style="margin-left:12px" ><i class="fa fa-file-excel-o"></i> Exportar Excel</a> ';
		}
		$("div.toolbar").html(toolbar);

	}
});
