(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

var conector = (location.href.indexOf('?') == -1) ? '?' : '&';
var site = location.href;
var site_no = ["#", "?n"];
$.each(site_no, function(i,v){
	site = site.replace(v, "");
});
var website = site + conector;
toastr.options = {
	"closeButton": true,
	"debug": false,
	"progressBar": true,
	"positionClass": "toast-bottom-right",
	"onclick": null,
	"showDuration": "400",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
}

$(function(){
	$('.i-checks').iCheck({
		checkboxClass: 'iradio_evaluacion',
		radioClass: 'iradio_evaluacion',
	}).on('ifChecked', function(event){
		$(this).closest(".input-group-addon").addClass('checked');
	}).on('ifUnchecked', function(event){
		$(this).closest(".input-group-addon").removeClass('checked');
	});

	$(".cuadricula .i-checks *").mouseover(function(){
		$(this).closest("tr").find('td span').addClass('hover');
		var position = $(this).closest("td").index();
		$(this).closest("table").find('tr th:eq('+position+') span').addClass('hover');
	}).mouseout(function(){
		$(this).closest("tr").find('td span').removeClass('hover');
		var position = $(this).closest("td").index();
		$(this).closest("table").find('tr th:eq('+position+') span').removeClass('hover');
	});

	$('input.tags').tokenfield();
	$('input').keypress(function(e){
		if(e.which == 13){
			return false;
		}
	});
	$(document).on('submit', 'input.tags', function(event){
		event.preventDefault();
		return false;
	});

	function d(t, e, a) {
		t.html(e);
	};

	function c(t, e, a, i) {
		console.log(a), a.fail(function(t, e) {
			return console.log(t.status);
		}), a.done(function(a) {
			if (a) {
				var n, r, o = a.html;
				if ("tweet" == t) {
					var s = o.replace('<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>', "");
					r = o, n = s
				} else if ("instagram" == t) {
					var l = Math.floor(1e3 * Math.random() + 1);
					r = a.html, n = i
				} else "soundcloud" == t && (e.parents(".entry").find(".ordering input").val(a.title), r = o, n = o);
				d(e, r, n)
			}
		});
	};

	if($(".widget-twitter").length > 0){
		$(document).find('.widget-twitter').each(function(){
			var e = $(this).text(),
			t = $(this),
			a = $.ajax({
				cache: !1,
				url: "https://api.twitter.com/1/statuses/oembed.json?url=" + e,
				method: "GET",
				dataType: "jsonp"
			});
			c("tweet", t, a, e);
		});
	}
	if($(".widget-instagram").length > 0){
		$(document).find('.widget-instagram').each(function(){
			var e = $(this).text(),
			t = $(this),
			a = $.ajax({
				cache: !1,
				url: "http://api.instagram.com/oembed/?url=" + e,
				method: "GET",
				dataType: "jsonp"
			});
			c("instagram", t, a, e)
		});
	}

	$("[name=btn-save]").off("click").on("click", function(event) {
		$("#loading_stats").fadeIn();
		var e = $(document).find("form"),
		form = 'save',
		data = $("form").serialize();
		$.ajax({
			dataType: "json",
			url: website + "json",
			type: "POST",
			data: {
				form: form,
				data: data
			},
			success: function(data) {
				if (data.type == 'success') {
					swal({
						title: "Buen trabajo!",
						text: data.msje,
						type: "success"
					});
				}else{
					swal({
						title: "Error!",
						text: data.msje,
						type: "warning",
						confirmButtonColor: "#8CD4F5",
						confirmButtonText: "OK",
						closeOnConfirm: false
					});
				}
				$("#loading_stats").fadeOut();
			},
			error: function() {
				var msj = 'Error en Formulario. Intente de nuevo.';
				swal({
					title: "Error!",
					text:msj,
					type: "warning",
					confirmButtonColor: "#8CD4F5",
					confirmButtonText: "OK",
					closeOnConfirm: false
				});
				$("#loading_stats").fadeOut();
			}
		});
	});


	function file(){
		$(document).find('.input-fa').each(function(){
			var input = $(this),
			name = input.attr('name'),
			id = input.attr('data-id'),
			form = "files",
			initialPreview = '',
			initialPreviewConfig= '',
			json = '',
			url = directorio +id;
			$.ajax({
				dataType: "json",
				url: vista_directorio +id,
				type: "POST",
				success: function(data) {

					var initialPreview = [],
					initialPreviewConfig = {},
					files = {};
					o = 0;
					if(data.files){
						$(data.files).each(function(e, u) {
							json  = {};
							files[o] = u.name;
							initialPreview[o] = "<img style='height:160px; width: auto' class='kv-preview-data file-preview-image' title='"+u.name+"' src='"+url+'/'+u.name+"'>";
							json['caption'] = u.name;
							json['size'] = u.filesize;
							json['url'] = website + "json&delete";
							json['key'] = u.name;
							initialPreviewConfig[o] = json;
							o++;
						});
					}
					$("[name="+id+"_files]").val(JSON.stringify(files));
					file_(initialPreview, initialPreviewConfig, input, id);
				},
				error: function() {
					file_(initialPreview, initialPreviewConfig, input, id);
				}
			});
			/*
			$.ajax({
				dataType: "json",
				url: website + "json",
				type: "POST",
				data: {
					form: form,
					id: id
				},
				success: function(data) {
					if (data.type == 'success') {
						var data = data.data,
						initialPreview = [],
						initialPreviewConfig = {},
						files = {};
						o = 0;
						$(data).each(function(e, u) {
							json  = {};
							files[o] = u.name;
							initialPreview[o] = "<img style='height:160px; width: auto' class='kv-preview-data file-preview-image' title='"+u.name+"' src='"+vista_directorio+'/'+u.name+"'>";
							json['caption'] = u.name;
							json['size'] = u.filesize;
							json['url'] = website + "json&delete";
							json['key'] = u.name;
							initialPreviewConfig[o] = json;
							o++;
						});
						$("[name="+id+"_files]").val(JSON.stringify(files));
						file_(initialPreview, initialPreviewConfig, input, id);
					}
				},
				error: function() {
					file_(initialPreview, initialPreviewConfig, input, id);
				}
			});
			*/
		});
	}
	function file_(initialPreview, initialPreviewConfig, input, uid){
		$(input).fileinput({
			language: "es",
			uploadUrl:  website + 'json&upload',
			uploadExtraData: function() {
				return {
					name: uid
				}
			},
			uploadAsync: true,
			overwriteInitial: false,
			maxFileCount: 5,
			initialPreview: initialPreview,
			initialPreviewConfig: initialPreviewConfig,
			initialPreviewAsData: false,
			initialPreviewFileType: 'image',
			allowedFileExtensions: ["jpg", "png", "gif"]
		}).on('fileuploaded', function(event, data, previewId, index) {
			var files = {};
			var o = 0;
			var x = 0;
			var form = data.form, files = data.files, extra = data.extra,
			response = data.response, reader = data.reader;
			var dp = data.response.url;
			$('.file-drop-zone img').each(function(){
				var title = $(this).attr('title');
				if(title == dp){
					if(x == 0){
						files[o] = title;
						o++;
						x++;
					}
				}else{
					files[o] = title;
					o++;
				}
			});
			$("[name="+uid+"_files]").val(JSON.stringify(files));
			console.log(files);

		});
	}
	$(document).on('click', '.kv-file-remove', function(){
		var files = {},
		o = 0,
		key = $(this).closest('.file-thumbnail-footer').find('.file-footer-caption').attr('title'),
		id = $(this).closest(".editor").find('.input-fa').attr('data-id');
		$.ajax({
			dataType: "json",
			url: website + "json&delete",
			type: "POST",
			data: {
				key: key,
				name: id
			},
			success: function(data) {
				if(data.error){
					Command: toastr["error"](data.error);
				}
			},
			error: function() {
				var msj = 'Error en borrar. Intente de nuevo.'
				Command: toastr["error"](msj);
			}
		});
		$('.file-drop-zone img').each(function(){
			var title = $(this).attr('title');
			if(title != key){
				files[o] = title;
				o++;
			}
		});
		$("[name="+id+"_files]").val(JSON.stringify(files));
	});
	file();

	$(document).on('change', 'select[data-type=select]', function(){
		var val = $(this).val();
		var nota = '?'+ta;
		var respuesta = $(this).closest('.toolbar').find('.respuesta');
		respuesta.attr('data-nota', 0);
		var no = $(this).attr('data-punto');
		if(val == 'correcto'){
			nota = no + ta;
			respuesta.attr('data-nota', no);
		}else if(val == 'incorrecto'){
			nota = '0' + ta;
		}
		var fin = 0;
		$(document).find('.respuesta[data-nota]').each(function(){
			console.log($(this).attr('data-nota'));
			fin += parseFloat($(this).attr('data-nota'));
		});
		$("#final").text(Math.round(fin)+ta);
		respuesta.html('<h5 class="'+val+'"><b> '+nota+'</b></h5>');
	});

});