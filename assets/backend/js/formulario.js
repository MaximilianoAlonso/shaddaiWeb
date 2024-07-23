(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=1481309175418038";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
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
			$(document).on('click', ".button_form .dropdown-menu li a", function(t) {
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
		r = function(t) {
			"" == $("#upwthumb").val() && ($(".imagepr_wrap").html('<img src="' + t + '" >'), $(".previewshow").show(), $(".preview-placeholder").hide(), $("#upwthumb").val(t))
		},
		d = function(t, e, a) {
			t.parents(".entry").find(".embedarea").html(e);
		},
		c = function(t, e, a, i) {
			console.log(a), a.fail(function(t, e) {
				return console.log(t.status), t.status && 404 == t.status && swal('URL invalida', 'Por favor, intente nuevamente', "warning"), !1
			}), a.done(function(a) {
				if (a) {
					var n, r, o = a.html;
					console.log(a.html);
					if ("tweet" == t) {
						var s = o.replace('<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>', "");
						r = o, n = s
					} else if ("instagram" == t) {
						console.log(n);
						var l = Math.floor(1e3 * Math.random() + 1);
						r = a.html, n = i
					} else "soundcloud" == t && (e.parents(".entry").find(".ordering input").val(a.title), r = o, n = o);
					d(e, r, n)
				} else swal('URL invalida', 'Por favor, intente nuevamente', "warning")
			})
		},
		s = function() {
			//imagen
		},
		l = function() {
			$(document).on('click', ".createvideo", function() {
				var x = $(this).closest("div[data-type=video]").find("input[data-type=name]").val();
				console.log(x);
				var t, e, a, i = x,
				n = i.match(/^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:youtu\.be|youtube\.com)\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/)([^\?&\"'>]+)/),
				o = i.match(/^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?vimeo\.com\/([0-9]+)$/),
				s = i.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/),
				l = i.match(/https?\:\/\/(?:www\.)?facebook\.com\/(\d+|[A-Za-z0-9\.]+)\/?/);
				if (n && 11 == n[1].length) t = '<iframe src="//www.youtube.com/embed/' + n[1] + '" width="100%" height="400" frameborder="0" allowfullscreen></iframe>', a = "http://img.youtube.com/vi/" + n[1] + "/hqdefault.jpg", r(a), e = t;
				else if (o) t = '<iframe src="//player.vimeo.com/video/' + o[1] + '" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', e = t;
				else if (s) t = '<iframe src="//www.dailymotion.com/embed/video/' + s[2] + '" width="100%" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', e = t;
				else {
					if (!l) return swal('URL invalida', 'Por favor, intente nuevamente', "warning"), !1;
					var c = "video-" + (new Date).getTime();
					t = '<div class="fb-video" data-href="'+l.input+'" data-width="500" data-show-text="false"><blockquote cite="'+l.input+'" class="fb-xfbml-parse-ignore"></div><div id="fb-root"></div>';
				}
				d($(this), t, e);
				FB.XFBML.parse();
			});
			$(document).on('click', ".createtweet", function() {
				var x = $(this).closest("div[data-type=twitter]").find("input[data-type=name]").val();
				var t = $(this),
				e = x,
				a = $.ajax({
					cache: !1,
					url: "https://api.twitter.com/1/statuses/oembed.json?url=" + e,
					method: "GET",
					dataType: "jsonp"
				});
				console.log(e);
				c("tweet", t, a, e)
			});
			$(document).on('click', ".createinstagram", function() {
				var x = $(this).closest("div[data-type=instagram]").find("input[data-type=name]").val();
				var t = $(this),
				e = x,
				a = $.ajax({
					cache: !1,
					url: "http://api.instagram.com/oembed/?url=" + e,
					method: "GET",
					dataType: "jsonp"
				});
				c("instagram", t, a, e)
			});
			$(document).on('click', ".add_option", function() {
				var y = $(this).closest("div[data-type=check], div[data-type=icheck]").find(".preguntas");
				$x = $(this).closest("div[data-type=check], div[data-type=icheck]").find(".preguntas .select:first-child").clone();
				$x.find('input[data-type=selected]').val('');
				var name = $x.find('input[data-type=respuesta]').attr('name');
				$x.find('.sel').html('<input type="radio" data-type="respuesta" class="i-checks" name="'+name+'">');
				$x.appendTo(y);
				$('.i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
				});
			});
			$(document).on('click', ".add_fila", function() {
				var y = $(this).closest("div[data-type=cuadricula]").find(".fila");
				$x = $(this).closest("div[data-type=cuadricula]").find(".fila .select:first-child").clone();
				$x.find('input[data-type=selected]').val('');
				var name = $x.find('input[data-type=respuesta]').attr('name');
				$x.appendTo(y);
				$('.i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
				});
			});
			$(document).on('click', ".add_columna", function() {
				var y = $(this).closest("div[data-type=cuadricula]").find(".columna");
				$x = $(this).closest("div[data-type=cuadricula]").find(".columna .select:first-child").clone();
				$x.find('input[data-type=selected]').val('');
				var name = $x.find('input[data-type=respuesta]').attr('name');
				$x.appendTo(y);
				$('.i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
				});
			});
			$(document).on('click', ".delete-select", function() {
				$(this).closest(".select").remove();
				$('.tooltip').remove();
			});
			$(document).on('change', "[name=modo_form]", function() {
				var x = $(this).val();
				if(x == 0){
					$(".modo").removeClass('random');
					$(".button_form").css('display', 'block');
				}else{
					$(".modo").addClass('random');
					$(".button_form").css('display', 'none');
				}
				$("#entries").html('');
				NProgress.set(.4);
				var form = 'bloque',
				type = 'title';
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
			$(document).on('click', ".getimageurl", function(t) {
				var e = $(this),
				a = $(this).attr("data-target");
				swal({
					title: 'Direccion URL de la imagen',
					type: "input",
					showCancelButton: !0,
					closeOnConfirm: !1,
					animation: "slide-from-top",
					inputPlaceholder: 'Pegar URL de la imagen aqui'
				}, function(t) {
					return t === !1 ? !1 : "" === t ? (swal.showInputError('&iexcl;Tienes que escribir algo !'), !1) : null == t.match(/\.(jpeg|jpg|gif|png)$/) ? (swal.showInputError('No es válido URL de la imagen'), !1) : ("preview" == a ? i(e, t) : i(e, t), void swal({
						title: "",
						timer: 1
					}))
				})
			});
			$(document).on('click', ".thumbactions a.deleteimage", function(t) {
				var e = $(this),
				a = ($(this).attr("data-action"), $(this).attr("data-target"));
				swal({
					title: '¿Estás seguro?',
					type: "warning",
					showCancelButton: !0,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: 'Sí , eliminarla !',
					closeOnConfirm: !0
				}, function() {
					var t = ".entry",
					form = "delete",
					x = e.parents(t).find(".cd-input-image").first().val(),
					n = x.match(/^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:crm\.pe|mott\.pe)\/(uploads)\/(escuela)\/(evaluaciones)\/(\d+|[A-Za-z0-9\-\.]+)\/?/);
					if(n){
						$.ajax({
							dataType: "json",
							url: website + "json",
							type: "POST",
							data: {
								form: form,
								file: n[4]
							},
							success: function(data) {
								if (data.type == 'error') {
									Command: toastr[data.type](data.msje);
								}
							},
							error: function() {
								var msj = 'Error en Formulario. Intente de nuevo.'
								Command: toastr["error"](msj);
							}
						});
					}
					"answer" == a && (t = ".answer"), e.parents(t).find(".imagearea_img").first().html(""), e.parents(t).find(".cd-input-image").first().val(""), e.parents(t).find(".mediaupload").first().show(), e.parents(t).find(".imagearea").first().addClass("hide");
				})
			});
			$(document).on('change', ".uploadaimage", function(t) {
				NProgress.inc(), $("#loading_stats").fadeIn();
				var t = $(this);
				t.attr("name", "file").parents("form").attr("method", "POST").attr("enctype", "multipart/form-data");
				var e = $("input[name='_token']").val();
				t.parents("form").append('<input name="_token" type="hidden" value="' + e + '">');
				var form = "image";
				t.parents("form").ajaxSubmit({
					url: website + "json",
					dataType: "json",
					data: {
						form: form
					},
					success: function(e) {
						e.errors ? swal(e.type, e.msj, "error") : t.hasClass("preview") ? i(t, e.path) : i(t, e.path), $("#loading_stats").fadeOut(), NProgress.done(!0);
					}
				});
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
		i = function(t, e) {
			var a = t.attr("data-target");
			t.parents("." + a).find(".imagearea_img").first().html('<img src="' + e + '" >'), t.parents("." + a).find(".cd-input-image").first().val(e), t.parents(".inpunting").hide(), t.parents("." + a).find(".imagearea").first().removeClass("hide")
		},
		ss = function(){
			NProgress.inc(), $("#loading_stats").fadeIn();
			var e = $(this).closest("form"),
			form = 'save',
			t = $("[name=name_form]").val(),
			m = $("[name=modo_form]").val(),
			a = $("[name=activo_form]").val(),
			cd = $("[name=cantidad_form]").val(),
			dg = $("[name=design_form]").val(),
			p = $("[name=promedio_form]").val();
			(null == typeof t || "" == t || void 0 == t) && (t = null);
			if (t == null) return swal('Añadir un nombre al formulario'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
			var x = [];
			var y = 0;
			//if(m == 0){
				if (0 == $(".entry").length) return swal('Añadir un nuevo campo'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
				$(document).find("#entries .entry").each(function(e, a) {
					var i = $(this).attr("data-type");
					(null == typeof i || "" == i || void 0 == i) && (i = null);
					var n = $(this).find('[data-type="name"]').first().val();
					(null == typeof n || "" == n || void 0 == n) && (n = null);
					var d = $(this).find('[data-type="description"]').first().val();
					(null == typeof d || "" == d || void 0 == d) && (d = null);
					var r = $(this).find('[data-type="required"]').first().is(':checked');
					(null == typeof r || "" == r || void 0 == r) && (r = null);
					var o = $(this).find('[data-type="image"]').first().val();
					(null == typeof o || "" == o || void 0 == o) && (o = null);
					var k = $(this).find('[data-type="key"]').first().val();
					(null == typeof k || "" == k || void 0 == k) && (k = null);
					if(n == null){ y++; }
					if ("mott" == i) {
						return swal('AJAX Testing'), NProgress.done(!0), $("#loading_stats").fadeOut();
					}else if ("check" == i) {
						x[e] = {
							type: i,
							key: k,
							required: r,
							description: d,
							name: n
						}, x[e].answers = [], $(a).find(".preguntas .select").each(function(a, i) {
							var q = $(i).find('[data-type="selected"]').first().val();
							(null == typeof q || "" == q || void 0 == q) && (q = null);
							var w = $(this).find('[data-type="respuesta"]').first().is(':checked');
							(null == typeof w || "" == w || void 0 == w) && (w = null);
							x[e].answers[a] = {
								option: q,
								answer: w
							}
						})
					}else if ("icheck" == i) {
						x[e] = {
							type: i,
							key: k,
							required: r,
							description: d,
							image: o,
							name: n
						}, x[e].answers = [], $(a).find(".preguntas .select").each(function(a, i) {
							var q = $(i).find('[data-type="selected"]').first().val();
							(null == typeof q || "" == q || void 0 == q) && (q = null);
							var w = $(this).find('[data-type="respuesta"]').first().is(':checked');
							(null == typeof w || "" == w || void 0 == w) && (w = null);
							x[e].answers[a] = {
								option: q,
								answer: w
							}
						})
					}else if ("cuadricula" == i) {
						x[e] = {
							type: i,
							key: k,
							required: r,
							description: d,
							name: n
						}, x[e].fila = [], $(a).find(".fila .select").each(function(a, i) {
							var q = $(i).find('[data-type="selected"]').first().val();
							(null == typeof q || "" == q || void 0 == q) && (q = null);
							x[e].fila[a] = {
								option: q
							}
						}),
						x[e].colmn = [], $(a).find(".columna .select").each(function(a, i) {
							var w = $(i).find('[data-type="selected"]').first().val();
							(null == typeof w || "" == w || void 0 == w) && (w = null);
							x[e].colmn[a] = {
								option: w
							}
						})
					} else "image" == i ? x[e] = {
						type: i,
						key: k,
						required: r,
						description: d,
						name: n,
						image: o
					} : x[e] = {
						type: i,
						key: k,
						required: r,
						description: d,
						name: n
					}
				});
			//}
			if (y > 0) return swal('Complete los campos'), NProgress.done(!0), $("#loading_stats").fadeOut(), !1;
			NProgress.set(.4);
			$.ajax({
				dataType: "json",
				url: website + "json",
				type: "POST",
				data: {
					form: form,
					name: t,
					activo : a,
					promedio : p,
					cantidad : cd,
					design : dg,
					modo: m,
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
				e(), l(), o(), s(), m();
			}
		}
	}();
	App.init();
});