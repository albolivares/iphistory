$( function() {


    $( "#fecha_inicio_hist" ).datepicker({

    singleDatePicker: true,

    showDropdowns: true,

    changeMonth: true,

    changeYear: true,
yearRange: "1920:2019",

    dateFormat: "yy-mm-dd",


    maxDate: '0',

    

    });


    $( "#fecha_fin_hist" ).datepicker({

    singleDatePicker: true,

    showDropdowns: true,

    changeMonth: true,

    changeYear: true,

    yearRange: "2018:2019",

    dateFormat: "yy-mm-dd",

    minDate: 0,

    //maxDate: '+2m',

    });

  } );



/**thumb**/
$(function () {
    'use strict';
    var base_url1 = $('#base_url').val();    
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                base_url1 : base_url1+'admin/historia/procesar/';
    $('#fileuploadfe').fileupload({
        formData: {
                 carpeta: 'avatar'               
          },        
        url: url,
        add: function(e, data) {
        var uploadErrors = [];
        var ext = data.originalFiles[0].name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpeg','jpg']) == -1) {
            uploadErrors.push('No es un tipo de archivo valido');
        }
        if(data.originalFiles[0].size > (1*1024*1024)) {//2 MB
            uploadErrors.push('El tamaño del archivo es demasiado grande solo se permiten 1 MB como maximo');
        }
        if(uploadErrors.length > 0) {
            alert(uploadErrors.join("\n"));
        } else {
            data.submit();
         }
    }, 
        dataType: 'json',        
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/avatar/'+file.name+'" />'+'<input type="hidden" name="portada_sm" id="portada_sm" value="'+file.name+'" />').appendTo('#filesfe ul');
                //$('<p/>').html('<input type="hidden" name="ruta[]" id="ruta" value="'+file.name+' />').appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progressfe .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});


/**thumb**/
$(function () {
    'use strict';
    var base_url1 = $('#base_url').val();    
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                base_url1 : base_url1+'admin/historia/procesar/';
    $('#fileuploadfe_g').fileupload({
        formData: {
                 carpeta: 'avatar'               
          },        
        url: url,
        add: function(e, data) {
        var uploadErrors = [];
        var ext = data.originalFiles[0].name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpeg','jpg']) == -1) {
            uploadErrors.push('No es un tipo de archivo valido');
        }
        if(data.originalFiles[0].size > (1*1024*1024)) {//2 MB
            uploadErrors.push('El tamaño del archivo es demasiado grande solo se permiten 1 MB como maximo');
        }
        if(uploadErrors.length > 0) {
            alert(uploadErrors.join("\n"));
        } else {
            data.submit();
         }
    }, 
        dataType: 'json',        
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                console.log(file.name);
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/avatar/'+file.name+'" />'+'<input type="hidden" name="portada_bg" id="portada_bg" value="'+file.name+'" />').appendTo('#filesfe_g ul');
                //$('<p/>').html('<input type="hidden" name="ruta[]" id="ruta" value="'+file.name+' />').appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progressfe_g .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});



$(document).ready(function(){  

//$("#contAva").hide(); $("#contUp").hide();
    tinymce.init({
        mode : "specific_textareas",
    editor_selector : "mceEditor",
      height: 300,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
      
    });

    /*tinymce.init({
      selector: '#minibio',
      height: 300,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
      
    });
*/

$("#estado").change(function() {
    $("#estado option:selected").each(function() 
    {
        filtro = $('#estado').val();
        var base_url1 = $('#base_url').val();
        console.log(base_url1);
        $.post(base_url1 + "admin/ajax/llenaCiudad", {
        filtro : filtro
        }, function(data) {
            $("#ciudad").html(data);
        });
    });
 });/*$#tipo*/


$( "input[name=avatar]" ).on( "click", function() {
  var tipo_obj=$( "input:checked" ).val();
  if(tipo_obj==1) { $("#contAva").show(); $("#contUp").hide(); }
  else if(tipo_obj==2) { $("#contAva").hide(); $("#contUp").show(); }
});


});



$('#categoria').multiSelect();


