$(function(){
	var App = function() {
		var t = function() {},
		e = function() {
			$(document).on('click', '.up-down-trigger', function(t) {
				var e = $(this),
				i = e.parents(".entry");
				if (e.hasClass("up-entry")) {
					var n = i.prev();
					i.insertBefore(n)
				} else if (e.hasClass("down-entry")) {
					var r = i.next();
					i.insertAfter(r)
				}
			});
			$(document).on('click', ".delete-entry", function(t) {
				var e = $(this);
				swal({
					title: '¿Estás seguro?',
					text: 'Usted no será capaz de recuperar esto!',
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: 'Sí , eliminarla !',
					cancelButtonText: 'Cancelar',
					closeOnConfirm: false
				}, function() {
					NProgress.set(.4);
					"entry" == e.attr("data-block") ? e.parents(".entry").first().remove() : e.parents(".answer").first().remove(), $('.tooltip').remove();
					swal("Eliminado!", "Se eliminado correctamente.", "success");
					NProgress.done(!0);
				});

			});
			$(document).on('click', ".clone-entry", function(t) {
				$('.i-checks').iCheck('destroy');
				var e = $(this);
				swal({
					title: '¿Estás seguro?',
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#AEDEF4",
					confirmButtonText: 'Sí , Duplicar !',
					cancelButtonText: 'Cancelar',
					closeOnConfirm: false
				}, function() {
					NProgress.set(.4);
					var n=Math.floor(Math.random()*11);
					var k = Math.floor(Math.random()* 1000000);
					var m = String.fromCharCode(n)+k;
					var clone = e.parents(".entry").clone();
					var id = clone.find('input[data-type=key]').val();
					clone = clone.prop('outerHTML');
					clone = clone.replace(id, m);
					$(clone).appendTo("#entries");
					$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
					});
					swal("Duplicado!", "Se duplicado correctamente.", "success");
					o();
					NProgress.done(!0);
				});
			});
			$(document).on('click', "#add_campo", function(t) {
				NProgress.set(.4);
				var form = 'bloque',
				type = $(this).attr('data-type');
				$.ajax({
					dataType: "json",
					url: website + "json",
					type: "POST",
					data: {
						form: form,
						type: type
					},
					success: function(data) {
						if (data.type == 'success') {
							var db = data.data;
							$(db).appendTo("#entries");
							o();
						}else{
							Command: toastr[data.type](data.msje);
						}
						NProgress.done(!0);
					},
					error: function() {
						var msj = 'Error en Formulario. Intente de nuevo.'
						Command: toastr["error"](msj);
					}
				});
			});
		},
		l = function() {
			$(document).on('click', ".add_option", function() {
				var y = $(this).closest("div[data-type=check], div[data-type=icheck]").find(".preguntas");
				$x = $(this).closest("div[data-type=check], div[data-type=icheck]").find(".preguntas .select:first-child").clone();
				$x.find('input[data-type=subtitulo]').val('');
				$x.appendTo(y);
			});
			$(document).on('click', ".delete-select", function() {
				$(this).closest(".select").remove();
				$('.tooltip').remove();
			});
		},
		o = function(){
			$(".switchery").remove();
			$('.tooltip').remove();
			var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
			elems.forEach(function(html) {
				var switchery = new Switchery(html);
			});
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		},
		ss = function(){
			NProgress.inc(), $("#loading_stats").fadeIn();
			var e = $(this).closest("form"),
			form = 'save',
			t = $("[name=name_agenda]").val(),
			a = $("[name=activo_agenda]").val();
			(null == typeof t || "" == t || void 0 == t) && (t = null);
			if (t == null) return swal('Añadir un nombre al formulario'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
			var x = [];
			var y = 0;
			if (0 == $(".entry").length) return swal('Añadir un nuevo campo'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
			$(document).find("#entries .entry").each(function(e, a) {
				var i = $(this).attr("data-type");
				(null == typeof i || "" == i || void 0 == i) && (i = null);
				var n = $(this).find('[data-type="titulo"]').first().val();
				(null == typeof n || "" == n || void 0 == n) && (n = null);
				var d = $(this).find('[data-type="horario"]').first().val();
				(null == typeof d || "" == d || void 0 == d) && (d = null);
				var k = $(this).find('[data-type="key"]').first().val();
				(null == typeof k || "" == k || void 0 == k) && (k = null);
				if(n == null){ y++; }
				if ("mott" == i) {
					return swal('AJAX Testing'), NProgress.done(!0), $("#loading_stats").fadeOut();
				}else if ("check" == i) {
					x[e] = {
						type: i,
						key: k,
						horario: d,
						titulo: n
					}, x[e].answers = [], $(a).find(".preguntas .select").each(function(a, i) {
						var q = $(i).find('[data-type="subtitulo"]').first().val();
						(null == typeof q || "" == q || void 0 == q) && (q = null);
						x[e].answers[a] = {
							titulo: q
						}
					})
				} else x[e] = {
					type: i,
					key: k,
					horario: d,
					titulo: n
				}
			});

			if (y > 0) return swal('Complete los campos'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
			NProgress.set(.4);
			$.ajax({
				dataType: "json",
				url: website + "json",
				type: "POST",
				data: {
					form: form,
					name: t,
					activo: a,
					entries: x
				},
				success: function(data) {
					if (data.type == 'success') {
						if(data.location){
							NProgress.done(!0);
							$("#loading_stats").fadeOut();
							location.href = data.location
							return true;
						}
					}
					Command: toastr[data.type](data.msje);
					NProgress.done(!0);
					$("#loading_stats").fadeOut();
				},
				error: function() {
					var msj = 'Error en Formulario. Intente de nuevo.'
					Command: toastr["error"](msj);
					$("#loading_stats").fadeOut();
				}
			});
		},
		m = function() {
			$("[name=btn-save]").off("click").on("click", function(event) {
				ss();
			});
		};
		return {
			init: function() {
				e(), l(), o(), m();
			}
		}
	}();
	App.init();
});