var conector = (location.href.indexOf('?') == -1) ? '?' : '&';
var site = location.href;
var site_no = ["#"];
$.each(site_no, function(i,v){
  site = site.replace(v, "");
});

var website = site + conector;

(function (factory) {
  /* global define */
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(window.jQuery);
  }
}(function ($) {

  // Extends plugins for adding hello.
  //  - plugin is external module for customizing.
  $.extend($.summernote.plugins, {
    /**
     * @param {Object} context - context object has status of editor.
     */
     'elfinder': function (context) {
      var self = this;

      // ui has renders to build ui elements.
      //  - you can create a button with `ui.button`
      var ui = $.summernote.ui;

      // add elfinder button
      context.memo('button.elfinder', function () {
        // create button
        var button = ui.button({
          contents: '<i class="fa fa-picture-o"/>',
          tooltip: 'Galeria de Imagenes',
          click: function () {
            elfinderDialog(context);
          }
        });

        // create jQuery object from button instance.
        var $elfinder = button.render();
        return $elfinder;
      });

    }
  });
}));
function elfinderDialog(context){
  var fm = $('<div/>').dialogelfinder({
    url : elfinder,
    lang : 'es',
    destroyOnClose : true,
    getFileCallback : function(files, fm) {
      console.log(files);
      context.invoke('editor.insertImage', files.url);
    },
    commandsOptions : {
      getfile : {
        oncomplete : 'close',
        folders : false
      }
    }
  }).dialogelfinder('instance');
}

var elfinder = admin + '/elfinder';



toastr.options = {
  "closeButton": true,
  "debug": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "onclick": null,
  "showDuration": "400",
  "hideDuration": "1000",
  "timeOut": "15000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

function list_comment(id){
  setTimeout(function() {
    $('.list-comment[data-id='+id+']').trigger('click');
    $('.success-element[data-id='+id+']').css('background-color', '#FFFDEC');
  }, 500);
}
$(function() {

  $('.spin-icon').click(function () {
    $(".theme-config-box").toggleClass("show");
  });
  $(document).on('keypress', 'form', function(e){
    if(e == 13){
      return false;
    }
  });
  $(document).on('keypress', 'input', function(e){
    if(e.which == 13){
      return false;
    }
  });


  $("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    container: 'body'
  });
  $('.i-checks').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
  });

  Tinycon.setBubble("+");

  Tinycon.setOptions({
    background: '#1ab394'
  });

  if ($('.tokenfield').length > 0) {
    $('.tokenfield').tokenfield({
      createTokensOnBlur: true,
      delimiter: ['|'],
    });
  }
  if ($('.color_picker').length > 0) {
    $('.color_picker').colorpicker();
    $(document).on('change', '.color_picker input[type=text]', function(){
      $this = $(this);
      $this.parent().find('.input-group-addon i').css({
        'background-color': $(this).val()
      })
    });

  }

  $(document).on("click", "#myTab a", function(e) {
    e.preventDefault();
    $(this).tab('show');
  });

  $(document).on('click', '.portlet-content .checkbox', function(){
    $(this).find("input").click();
  });

  
  if ($('.summernote').length > 0) {

    $('.summernote').summernote({
      lang: 'es-ES',
      dialogsInBody: true,
      toolbar: [
      ['style', ['style']],
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['table', ['table']],
      ['insert', ['link', 'video', 'elfinder']],
      ['view', ['fullscreen', 'codeview']],
      ['help', ['help']],
      ],
      callbacks: {
        onImageUpload: function(files) {
          sendI(files[0], $(this) );
        },
        onChange: function(contents, $editable) {
          console.log(contents.replace(/(<([^>]+)>)/ig,"").length);
        }
      }
    }).summernote('fontName', 'Arial');
  }

  if ($('#datatable').length > 0) {
    $('.search-form').fadeTo("slow", 1);
    $(".search-form input").prop("readonly", false);
    $(".search-form input").keyup(function() {
      var text = $(this).val();
      $("#datatable_filter input").val(text).keyup();
    });
  }

  function limpiar(text) {
    var text = text.toLowerCase();
    text = text.replace(/[áàäâå]/, 'a');
    text = text.replace(/[éèëê]/, 'e');
    text = text.replace(/[íìïî]/, 'i');
    text = text.replace(/[óòöô]/, 'o');
    text = text.replace(/[úùüû]/, 'u');
    text = text.replace(/[ýÿ]/, 'y');
    text = text.replace(/[ñ]/, 'n');
    text = text.replace(/[ç]/, 'c');
    text = text.replace(/['"]/, '');
    return text;
  }

  if ($('#excelHTML5').length > 0) {
    $('.search-form').fadeTo("slow", 1);
    $(".search-form input").prop("readonly", false);
  }

  if ($('.wp-asistencia').length > 0) {
    $('.search-form').fadeTo("slow", 1);
    $(".search-form input").prop("readonly", false);
    $(".search-form input").keyup(function() {
      var value = this.value.toLowerCase().trim();
      $(".form-horizontal .vote-item").each(function(index) {
        var id = $(this).attr('data-name').toLowerCase().trim();
        id = limpiar(id);
        var not_found = (id.indexOf(value) == -1);
        $(this).toggle(!not_found);
      });
    });
  }

  if($('.table-asistencia').length > 0){

    $('.search-form').fadeTo("slow", 1);
    $(".search-form input").prop("readonly", false);
    $(".search-form input").keyup(function() {
      var value = this.value.toLowerCase().trim();
      $(".table-asistencia tbody tr").each(function(index) {
        var id = $(this).attr('data-name').toLowerCase().trim();
        id = limpiar(id);
        var not_found = (id.indexOf(value) == -1);
        $(this).toggle(!not_found);
      });
    });
  }
  if($('#list-alumno').length > 0){
    $("#datatable_filter input").keyup(function() {
     var text = $(this).val();
     $(".search-form input").val(text);
   });
    if ($('#tabla_tipo_cambio').length > 0) {
      $('.search-form').fadeTo("slow", 1);
      $(".search-form input").prop("readonly", false);
      $(".search-form input").keyup(function() {
        var text = $(this).val();
        $("#tabla_tipo_cambio_filter input").val(text).keyup();
      });
    }
  }

  $(document).on('click', '#dragg_toggle', function(){
    $i = $(this).find('i');
    if($i.hasClass('fa-toggle-on')){
      $i.removeClass('fa-toggle-on').addClass('fa-toggle-off');
      $("#dragg_body").slideUp('slow', function(){
       $("#draggable").animate({
        height: $("#draggable > div").height()
      }, 500);
     });
    }else{
      $i.removeClass('fa-toggle-off').addClass('fa-toggle-on');
      $("#dragg_body").slideDown('slow', function(){
       $("#draggable").animate({
        height: $("#draggable > div").height()
      }, 500);
     });
    }
  });

  $(document).on('click', '.btn-cc-comentar', function(){
    $("#name_cc_comentar").text($(this).attr('data-name'));
    var id = $(this).attr('data-id');
    var comentario = $(".cc-comentario[data-id="+id+"]:visible").text();
    if($.trim(comentario) == "No disponible"){
      comentario = "";
    }
    $("[name=cc_comentario]").val(comentario);
    $("[name=btn-cc-com]").attr('data-id', $(this).attr('data-id'));
    $("#myModal_cc_comentar").modal();
  });

  $(document).on("click", "[name=btn-cc-com]", function(e) {

    var id = $(this).attr('data-id');
    var comentario = $("[name=cc_comentario]").val();
    var form = 'comentario';
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: form,
        id: id,
        comentario: comentario
      },
      success: function(data) {
        if (data.type == 'success') {
          if($.trim(comentario) == ""){
            comentario = "No disponible";
          }
          $(".cc-comentario[data-id="+id+"]").text(comentario);
          $("#myModal_cc_comentar").modal('hide');
        }
        Command: toastr[data.type](data.msje);
      },
      error: function() {
        var msj = 'No se puede realizar el registro.<br>Intente de nuevo.'
        Command: toastr["error"](msj);
      }
    });
  });

  $(document).on('click', ".noti-close",  function(){
    $(".notificaciones").fadeOut();
  });
  $("#tabla_tipo_cambio_filter input").keyup(function() {
   var text = $(this).val();
   $(".search-form input").val(text);
 });

  $(document).on("click", ".mup", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    $("#cabs").html(name);
    $("[name=btn-del]").attr('data-id', id);
  });
/*
$(document).on("dblclick", "#datatable >tbody >tr", function(e) {
  window.getSelection().removeAllRanges();
  var edit = $(this).find('.fa-edit');
  if (edit.length == 1) {
    edit.trigger("click");
  }
  console.log("xd");
})
*/
$(document).on("click", "[name=btn-ficha-inscripcion]", function(){
  $("#name_ficha").text($(this).attr('data-allname'));
  var enlace = escuela+'/interesados/'+$(this).attr('data-id')+'/'+$(this).attr('data-email');
  $("#enlace_ficha").text(enlace).attr('href', enlace);
  $("#myModal_ficha [name=enlace]").val(enlace);
  $("#myModal_ficha [name=email]").val($(this).attr('data-email'));
  $("#myModal_ficha [name=name]").val($(this).attr('data-name'));
  $("#myModal_ficha").modal();
});

$("select").select2();

if ($('.table').length) {
    $(document).on("click", "[name=btn-del]", function(e) {
        var cols = 0;
        $('#datatable >thead >tr:nth-child(1) th').each(function() {
            if ($(this).attr('colspan')) {
                cols += +$(this).attr('colspan');
            } else {
                cols++;
            }
        });
        var none = "<tr><td colspan='" + cols + "' align='center'>No hay datos en la tabla.</td></tr>";
        var id = $(this).attr('data-id');
        $.ajax({
            dataType: "json",
            url: website + "del",
            type: "POST",
            data: {
                del_id: id
            },
            success: function(data) {
                if (data.type == 'success') {
                    r = $('table.table >tbody >tr:visible:not(.child)').length;
                    if (r == 1) $('table.table > tbody').hide().html(none).fadeIn();
                    $td = $("#datatable a[data-id=" + id + "]").parent().parent().parent();
                    $next = $td.next();
                    if ($next.hasClass('child')) {
                        $next.remove();
                    }
                    $td.remove();

                }
                Command: toastr[data.type](data.msje);
            },
            error: function() {
                var msj = 'No se puede eliminar el registro.<br>Intente de nuevo.'
                Command: toastr["error"](msj);
            }
        });
    });
    $(document).on("click", "[name=btn-recuperar]", function(e) {
        var cols = 0;
        $('#datatable >thead >tr:nth-child(1) th').each(function() {
            if ($(this).attr('colspan')) {
                cols += +$(this).attr('colspan');
            } else {
                cols++;
            }
        });
        var none = "<tr><td colspan='" + cols + "' align='center'>No hay datos en la tabla.</td></tr>";
        var id = $(this).attr('data-id');
        $.ajax({
            dataType: "json",
            url: website + "recuperar",
            type: "POST",
            data: {
                recp_id: id
            },
            success: function(data) {
                if (data.type == 'success') {
                    r = $('table.table >tbody >tr:visible:not(.child)').length;
                    if (r == 1) $('table.table > tbody').hide().html(none).fadeIn();
                    $td = $("#datatable a[data-id=" + id + "]").parent().parent().parent();
                    $next = $td.next();
                    if ($next.hasClass('child')) {
                        $next.remove();
                    }
                    $td.remove();

                }
                Command: toastr[data.type](data.msje);
            },
            error: function() {
                var msj = 'No se puede recuperar el registro.<br>Intente de nuevo.'
                Command: toastr["error"](msj);
            }
        });
    });
}

$(document).on('click', '[name=btn-inscribir]', function(){
  $("#myModal_inscribir").modal();
  $id = $(this).attr("data-id");
  $name =$(this).attr("data-name");
  $("#myModal_inscribir [name=id_inscribir]").val($id);
  $("#name_inscribir").text($name);
});

if($('#list-comentarios').length){
  $(document).on('click', '[name=btn-coment]', function(){
    $comentar = $("[name=comentar]").val();
    $id = $(this).attr('data-id');
    $option = $(this).attr('data-option');
    if($comentar == ""){
      Command: toastr["error"]('Complete los campos faltantes');
      return false;
    }
    $form = "add-coment";
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: $form,
        id: $id,
        option: $option,
        comentar: $comentar
      },
      success: function(data) {
       if (data.type == 'success') {
        $("#myModal_seguimiento .no-comentario").hide();
        $("#myModal_seguimiento [name=comentar]").val('');
        $("#myModal_seguimiento .note_notes > *:last").after(data.html);
        $("#myModal_seguimiento .list-comment[data-id="+$id+"]").html('<i class="fa fa-group"></i> '+data.id);
        $("#myModal_seguimiento #current_notes").animate({ scrollTop: $('#myModal_seguimiento #current_notes')[0].scrollHeight}, 1000);
      }else{
        Command: toastr[data.type](data.msje);
      }
    },
    error: function() {
      var msj = 'No se pudo guardar en la base de datos. Intente de nuevo.'
      Command: toastr["error"](msj);
    }
  });
  });
  $(document).on('click', '[name=btn-can]', function(){
    $id = $(this).attr('data-id');
    $("#list-comentarios .success-element[data-id="+$id+"]").show();
    $("#list-comentarios .update[data-id="+$id+"]").hide();
  });
  $(document).on('click', '.on.editable-click', function(){
    $id = $(this).attr('data-id');
    $("#list-comentarios .success-element[data-id="+$id+"]").hide();
    $("#list-comentarios .update[data-id="+$id+"]").show();
  });
  $(document).on('click', '.list-comment', function(){
    $id = $(this).attr('data-id');
    $option = $(this).attr('data-option');
    $title = $(".editable-click.comentario[data-id="+$id+"]").text();
    $name = $(".name[data-id="+$id+"]").text();
    $trabajador = $(".name[data-id="+$id+"]").attr('data-trabajador');
    $programado = $(".programar[data-id="+$id+"]").html();
    $("#myModal_seguimiento .modal-body h3").text($title);
    $("#myModal_seguimiento .modal-body .name").text($name);
    $(".textarea_holder textarea").val('');
    if($option == "on"){
      $("[name=btn-coment]").attr('data-id', $id);
      $("[name=btn-coment]").attr('data-option', $option);
      $("#myModal_seguimiento .modal-footer ").show();
    }else{
      $("#myModal_seguimiento .modal-footer ").hide();
    }
    setTimeout(function() {
     $(".textarea_holder textarea").focus();
   }, 500);
    if($programado == ""){
      $("#myModal_seguimiento .modal-body .programado").hide();
    }else{
     $("#myModal_seguimiento .modal-body .programado").show();
     $("#myModal_seguimiento .modal-body .programado span").text($programado);
   }
   $form = "trabajador";
   $.ajax({
    dataType: "json",
    url: website + "json",
    type: "POST",
    data: {
      form: $form,
      trabajador: $trabajador,
      id: $id,
      option: $option
    },
    success: function(data) {
     if (data.type == 'success') {
      $(".note_extra_info img").attr('src', data.img);
      $(".note_notes").html(data.html);
      $('.success-element').css('background-color', '');
      $('.success-element[data-id='+$id+']').css('background-color', '#FFFDEC');
    }else{
      Command: toastr[data.type](data.msje);
    }
  },
  error: function() {
    var msj = 'No se pudo verificar en la base de datos. Intente de nuevo.'
    Command: toastr["error"](msj);
  }
});
 });


  $(document).on('click', '[name=btn-update]', function(){
    $id = $(this).attr('data-id');
    $this  = $(this);
    $padre = $(this).parent().parent().parent();
    $programar = $padre.find('[name=programar]').val();
    $programar = $.trim($programar);
    $comentario = $padre.find('[name=comentario]').val();
    $comentario = $.trim($comentario);
    if($comentario == ""){
      Command: toastr["error"]('Complete los campos faltantes');
      return false;
    }
    $form = "update";
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: $form,
        id: $id,
        programar: $programar,
        comentario: $comentario
      },
      success: function(data) {
        if (data.type == 'success') {
          $("#list-comentarios .success-element[data-id="+$id+"]").show();
          $("#list-comentarios .update[data-id="+$id+"]").hide();
          $(".editable-click.comentario[data-id="+$id+"]").text($comentario);
          $(".editable-click.programar[data-id="+$id+"]").text($programar);
          if($programar == ""){
            $(".programado[data-id="+$id+"]").hide();
            console.log(1);
          }else{
            $(".programado[data-id="+$id+"]").show();
          }
        }
        Command: toastr[data.type](data.msje);
      },
      error: function() {
        var msj = 'No se pudo guardar en la base de datos. Intente de nuevo.'
        Command: toastr["error"](msj);
      }
    });
  });
  $(document).on('click', '.btn-borrar', function(){
    $id = $(this).attr('data-id');
    $this  = $(this);
    $padre = $(this).parent().parent().parent();
    $programar = $padre.find('[name=programar]').val();
    $programar = $.trim($programar);
    $comentario = $padre.find('[name=comentario]').val();
    $comentario = $.trim($comentario);
    $("#cabs").text($comentario);
    $("[name=btn-del]").attr('data-id', $id);
    console.log($id);
  });
  $(document).on('click', '.btn-borrar-coment', function(){
    $segui = $(this).attr('data-segui');
    $id = $(this).attr('data-id');
    $this  = $(this);
    $comentario = $("#myModal_seguimiento .modal-body h3").text();
    $("#cabs_coment").text($comentario);
    $(".btn-cal-coment, .btn-del-coment").attr('data-id', $id);
    $(".btn-cal-coment, .btn-del-coment").attr('data-segui', $segui);
    $('#myModal_seguimiento').modal('hide');
  });
  $(document).on('click', '.btn-cal-coment', function(){
   $segui = $(this).attr('data-segui');
   $('.list-comment[data-id='+$segui+']').trigger('click');
 });
  $(document).on('click', '.btn-del-coment', function(){
    $this  = $(this);
    $id = $(this).attr('data-id');
    $segui = $(this).attr('data-segui');
    $form = "del-coment";
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: $form,
        id: $id,
        segui: $segui
      },
      success: function(data) {
        if (data.type == 'success') {
          Command: toastr[data.type](data.msje);
          $('.list-comment[data-id='+$segui+']').trigger('click');
          $(".list-comment[data-id="+$segui+"]").html('<i class="fa fa-group"></i> '+data.id);
        }
      },
      error: function() {
        var msj = 'No se pudo eliminar de la base de datos. Intente de nuevo.'
        Command: toastr["error"](msj);
      }
    });
  });

  $(document).on('click', '[name=btn-segui]', function(){
    $this  = $(this);
    $padre = $(this).parent().parent().parent();
    $programar = $padre.find('[name=programar]').val();
    $programar = $.trim($programar);
    $comentario = $padre.find('[name=comentario]').val();
    $comentario = $.trim($comentario);
    if($comentario == ""){
      Command: toastr["error"]('Complete los campos faltantes');
      return false;
    }
    $form = "save";
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: $form,
        programar: $programar,
        comentario: $comentario
      },
      success: function(data) {
        if (data.type == 'success') {
          $padre.find('[name=programar]').val("");
          $padre.find('[name=comentario]').val("");
          $("#no-registro").hide();
          $("#list-comentarios").find('.on').addClass('off').removeClass('on').attr('data-option', 'off');
          $(".btn-borrar").remove();
          $("#list-comentarios *:first").before(data.html);
          $('#datetime, .datetime').datetimepicker();
        }
        Command: toastr[data.type](data.msje);
      },
      error: function() {
        var msj = 'No se pudo guardar en la base de datos. Intente de nuevo.'
        Command: toastr["error"](msj);
      }
    });
  });

  $(document).on('click', '[name=btn-estado]', function(){
    $estado = $('[name=estado]').val();
    $form = "estado";
    $.ajax({
      dataType: "json",
      url: website + "json",
      type: "POST",
      data: {
        form: $form,
        estado: $estado
      },
      success: function(data) {
        Command: toastr[data.type](data.msje);
      },
      error: function() {
        var msj = 'No se pudo guardar en la base de datos. Intente de nuevo.'
        Command: toastr["error"](msj);
      }
    });
  });
  $(document).on("click", "[name=btn-del]", function(e) {
    var id = $(this).attr('data-id');


    $.ajax({
      dataType: "json",
      url: website + "del",
      type: "POST",
      data: {
        del_id: id
      },
      success: function(data) {
       if (data.type == 'success') {
        $("#list-comentarios .success-element[data-id="+$id+"]").remove();
        $("#list-comentarios .update[data-id="+$id+"]").remove();
        $("#list-comentarios li:first").find('.off').addClass('on').attr('data-option', 'on').removeClass('off');
        $("#list-comentarios div:first").find('.off').addClass('on').attr('data-option', 'on').removeClass('off');
        $nid = $("#list-comentarios li:first").attr('data-id');
        $("#list-comentarios li:first").find('.agile-detail > span:first').before('<spam class="pull-right btn btn-xs btn-danger btn-borrar" data-target="#myModal" data-toggle="modal" data-id="'+$nid+'"><i class="fa fa-trash"></i></spam>');
        var cols = 0;
        $('#list-comentarios > li').each(function() {
          cols++;
        });
        if(cols <= 1){
          $("#list-comentarios").html('<li id="no-registro">No existe ningún registro.</li>');
        }
      }
      Command: toastr[data.type](data.msje);
    },
    error: function() {
      var msj = 'No se puede eliminar el registro.<br>Intente de nuevo.'
      Command: toastr["error"](msj);
    }
  });
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      bclose = "<span class='close fa fa-times fa-2x eli' title='Eliminar'></span>";
      if($(".ticket_img").length){
        bclose = "<span class='close s_boton'>Eliminar Foto</span>";
      }
      $(input).parent().parent().find('.prevdemo').empty().css({"background-image": "url(" + e.target.result + ")",backgroundColor : "#E5E9EC"}).append(bclose).show();
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#previmage, .previmage").change(function() {
  readURL(this);
});
var bg = $('.prevdemo').css('background-image');
$(document).on("click", ".prevdemo .close, .prevpdfdemo .close", function() {
  $(this).parent().parent().parent().find(".previmage").val("");
  $(this).parent().parent().parent().find('.prevdemo, .prevpdfdemo').css({"background-image": bg}).hide();
});

$('.clockpicker').clockpicker();

$(document).on("click", '#select-all', function(event){
  if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
          this.checked = true;
        });
      }else{
        $(':checkbox').each(function() {
          this.checked = false;
        });
      }
    });

$('#datetimepicker, .datetimepicker').datepicker({
  language: "es",
  autoclose: true,
  format: "dd/mm/yyyy",
  todayBtn: "linked",
  keyboardNavigation: false,
  forceParse: false,
  calendarWeeks: true
});


$('#datetime, .datetime').datetimepicker();


$("#datetimepicker input").on('click', function(){
  $(this).parent().find('.input-group-addon').click();
});

if($("#calendar").length){
/*
  $(document).on('dblclick', "#calendar .fc-day-top[data-date]", function(){
    var $date = $(this).attr('data-date');
   $("#myModal_fecha").modal();
   $("#view_fecha").html('<b>'+$date+'</b>');
   $("#myModal_fecha .btn-fecha").attr('href', 'view/'+$date);
 });
 */
 $count_fecha = 0;
 var date = new Date();
 var d = date.getDate();
 var m = date.getMonth();
 var y = date.getFullYear();


 $('#calendar').fullCalendar({
  lang: 'es',
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,listDay,listWeek'
  },

  views: {
    listDay: { buttonText: 'Día' },
    listWeek: { buttonText: 'Semana' }
  },

  eventLimit: true,
  events: {
    url: website + "json",
    error: function() {
      Command: toastr['error']('Error en cargar datos.');
    },
    success: function(e){
      console.log(e);
    }
  },
  loading: function(bool) {
    $('#loading').toggle(bool);
  },

  dayClick: function(date, jsEvent, view) {
    $date = date.format();
    $date = $date.substr(0, 10);
    if($count_fecha == $date){
      $("#myModal_fecha").modal();
      $("#view_fecha").html('<b>'+$date+'</b>');
      $("#myModal_fecha .btn-fecha").attr('href', 'view/'+$date);
      $count_fecha = 0;
    }else{
      $count_fecha = $date;
      return $count_fecha;
    }
  },

  eventClick: function(calEvent, jsEvent, view) {
    if(calEvent.type == "feriado"){
      Command: toastr['warning']('Esta fecha es un feriado');
    }else if(calEvent.type == "horario"){
      $("#myModal_horario .modal-title").html(calEvent.titulo);
      $("#myModal_horario .clase_name").html(calEvent.clase);
      $("#myModal_horario .alumno_name").html(calEvent.alumno);
      $("#myModal_horario .inicio_name").html(calEvent.inicio);
      $("#myModal_horario .aula_name").html(calEvent.aula);
      $("#myModal_horario .horario_name").html(calEvent.horario);
      $("#myModal_horario .periodo_name").html(calEvent.periodo);
      $("#myModal_horario .comentarios_name").html(calEvent.comentarios);
      $("#myModal_horario .materiales_name").html(calEvent.materiales);
      $("#myModal_horario .btn-fecha").attr('href', calEvent.dia);
      $("#myModal_horario .btn-excel").attr('href', calEvent.excel);
      $("#myModal_horario .btn-programa").attr('href', calEvent.programa);
      $('#myModal_horario').modal();
    }else if(calEvent.type == "inicios"){
      $("#myModal_inicios .modal-title").html(calEvent.titulo);
      $("#myModal_inicios .clase_name").html(calEvent.clase);
      $("#myModal_inicios .alumno_name").html(calEvent.alumno);
      $("#myModal_inicios .inicio_name").html(calEvent.inicio);
      $("#myModal_inicios .aula_name").html(calEvent.aula);
      $("#myModal_inicios .horario_name").html(calEvent.horario);
      $("#myModal_inicios .periodo_name").html(calEvent.periodo);
      $("#myModal_inicios .comentarios_name").html(calEvent.comentarios);
      $("#myModal_inicios .materiales_name").html(calEvent.materiales);
      $("#myModal_inicios .btn-fecha").attr('href', calEvent.dia);
      $("#myModal_inicios .btn-excel").attr('href', calEvent.excel);
      $("#myModal_inicios .btn-programa").attr('href', calEvent.programa);
      $('#myModal_inicios').modal();
    }else if(calEvent.type == "interesados"){
     $("#myModal_interesados .modal-title").html(calEvent.titulo);
     $("#myModal_interesados .name_name").html(calEvent.name);
     $("#myModal_interesados .curso_name").html(calEvent.curso);
     $("#myModal_interesados .fecha_name").html(calEvent.fecha);
     $("#myModal_interesados .telefono_name").html(calEvent.telefono);
     $("#myModal_interesados .email_name").html(calEvent.email);
     $("#myModal_interesados .consulta_name").html(calEvent.consulta);
     $("#myModal_interesados .btn-seguimiento").attr('href', calEvent.seguimiento);
     $("#myModal_interesados .btn-fecha").attr('href', calEvent.dia);
     $('#myModal_interesados').modal();
   }else if(calEvent.type == "aulas"){
    $("#myModal_aulas .btn-fecha").attr('href', calEvent.dia);
    $("#myModal_aulas .name_name").html(calEvent.name);
    $("#myModal_aulas .comentarios_name").html(calEvent.comentarios);
    $("#myModal_aulas .horario_name").html(calEvent.horario);
    $("#myModal_aulas .fecha_name").html(calEvent.fecha);
    $("#myModal_aulas .modal-title").html(calEvent.titulo);
    $("#myModal_aulas .btn-aula").attr('href', calEvent.editar);
    $('#myModal_aulas').modal();
  }else{
    Command: toastr['error']('Complete el type');
  }
}

});

}

if($("#calendar_semana").length){
  $count_fecha = 0;
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();


  $('#calendar_semana').fullCalendar({
    lang: 'es',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'listDay,listWeek'
    },
    views: {
      listDay: { buttonText: 'Día' },
      listWeek: { buttonText: 'Semana' }
    },

    defaultView: 'listWeek',

    eventLimit: true,
    events: {
      url: website + "json",
      error: function() {
        Command: toastr['error']('Error en cargar datos.');
      },
      success: function(e){
        console.log(e);
      }
    },
    loading: function(bool) {
      $('#loading_stats').toggle(bool);
    },

    dayClick: function(date, jsEvent, view) {
      $date = date.format();
      $date = $date.substr(0, 10);
      if($count_fecha == $date){
        $("#myModal_fecha").modal();
        $("#view_fecha").html('<b>'+$date+'</b>');
        $("#myModal_fecha .btn-fecha").attr('href', 'view/'+$date);
        $count_fecha = 0;
      }else{
        $count_fecha = $date;
        return $count_fecha;
      }
    },

    eventClick: function(calEvent, jsEvent, view) {
      if(calEvent.type == "feriado"){
        Command: toastr['warning']('Esta fecha es un feriado');
      }else if(calEvent.type == "pagos"){
        $("#myModal_pagos .modal-title").html(calEvent.titulo);
        $("#myModal_pagos .clase_name").html(calEvent.clase);
        $("#myModal_pagos .alumno_name").html(calEvent.alumno);
        $("#myModal_pagos .inicio_name").html(calEvent.inicio);
        $("#myModal_pagos .aula_name").html(calEvent.aula);
        $("#myModal_pagos .horario_name").html(calEvent.horario);
        $("#myModal_pagos .periodo_name").html(calEvent.periodo);
        $("#myModal_pagos .comentarios_name").html(calEvent.comentarios);
        $("#myModal_pagos .materiales_name").html(calEvent.materiales);
        $("#myModal_pagos .btn-fecha").attr('href', calEvent.dia);
        $("#myModal_pagos .btn-excel").attr('href', calEvent.excel);
        $("#myModal_pagos .btn-programa").attr('href', calEvent.programa);
        $('#myModal_pagos').modal();
      }else{
        Command: toastr['error']('Complete el type');
      }
    }

  });

}

});