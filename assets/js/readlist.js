$( function() {

$("#fecha_inicio_hist").datepicker({ 
//    minDate: new Date(),
    singleDatePicker: true,
    showDropdowns: true,
    changeMonth: true,
    changeYear: true,
    yearRange: "2018:2019",
    dateFormat: "yy-mm-dd",
    minDate: 0,
    maxDate: '+9m',
    onSelect: function(date){
        var selectedDate = new Date(date);
        var msecsInADay = 86400000;
        var endDate = new Date(selectedDate.getTime() + msecsInADay);
       //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
        $("#fecha_fin_hist").val('');
        $("#fecha_fin_hist").datepicker( "option", "minDate", endDate );
        $("#fecha_fin_hist").datepicker( "option", "maxDate", '+2m' );

    }
});

    $( "#fecha_inicio_hist" ).datepicker({

    singleDatePicker: true,

    showDropdowns: true,

    changeMonth: true,

    changeYear: true,

    yearRange: "2018:2019",

    dateFormat: "yy-mm-dd",

    minDate: 0,

    maxDate: '+9m',

    

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
                base_url1 : base_url1+'admin/readlist/procesar/';
    $('#fileuploadfe').fileupload({
        formData: {
                 carpeta: 'readlist'               
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
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/readlist/'+file.name+'" />'+'<input type="hidden" name="portada_sm" id="portada_sm" value="'+file.name+'" />').appendTo('#filesfe ul');
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
                base_url1 : base_url1+'admin/readlist/procesar/';
    $('#fileuploadfe_g').fileupload({
        formData: {
                 carpeta: 'readlist'               
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
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/readlist/'+file.name+'" />'+'<input type="hidden" name="portada_bg" id="portada_bg" value="'+file.name+'" />').appendTo('#filesfe_g ul');
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



/*funciones para el buscador*/

 $( function() {
    var tag, dialog, form ,
       id_p = $( "#id_p" ), 
      nombre = $( "#nombre" );

  function addUser() {
    
      var valid = true;
      if ( valid ) {
         var searchIDs = $('input:checked').map(function(){
      //return $(this).val();    
      console.log($(this).val());
      if($(this).val()>0) {
        val_c= $(this).val();
        $( "#datatable-responsive tbody" ).append( "<tr>" +
          "<td>" + $("#hist_"+val_c).val() + "</td>" +
          "<td>" + $("#thist_"+val_c).val() + "</td>" +
          "<td><button type=\"button\"  class=\"removebutton\" title=\"Eliminar\">X</button></td><input type=\"hidden\" name=\"val_hist[]\" id=\"val_hist_" + $("#hist_"+val_c).val() + "\" value=\"" + $("#hist_"+val_c).val() + "\" /></td>" +"</tr>" );
        }
    });

              //dialog.dialog( "close" );

      }
      return valid;
    }
 




    $("#btn_preview").click(function(e){
        e.preventDefault();
        var name='';
        var message='';
        var tag = $("<div></div>");
        var base_url1 = $('#base_url').val();
        $(tag).attr("title", "Buscar historía");
        $.ajax({
            type: "POST",
            data: {message: message, name: name},
            url: base_url1 + 'admin/buscar/ajaxPaginationData',//Important: base_url is defined in the header section
            success:function(result){
                $(tag).dialog({
                    autoOpen: false,
                     buttons: {
                        "Seleccionar": addUser,
                        Cancel: function() {
                            tag.dialog( "close" );
                            }
                        },
                    close: function() {
                        //form[ 0 ].reset();
                        tag.dialog( "close" );
                    },
                        show: {
                            effect: "blind",
                            duration: 1000
                        },
                        hide: {
                            effect: "explode",
                            duration: 1000
                        }
                    });

                 form = tag.find( "form" ).on( "submit", function( event ) {
                  event.preventDefault();
                  addUser();
                  tag.dialog( "close" );
                });
                $(tag).dialog( "option", "width", 480 );
                $(tag).html(result).dialog().dialog('open');
            }
        });
    });
});

 $(document).on('click','button.removebutton', function() {
    alert("Eliminar historia");
  $(this).closest('tr').remove();
  return false;
});
