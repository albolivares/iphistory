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
                base_url1 : base_url1+'admin/serie/procesar/';
    $('#fileuploadfe').fileupload({
        formData: {
                 carpeta: 'serie'               
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
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/serie/'+file.name+'" />'+'<input type="hidden" name="portada_sm" id="portada_sm" value="'+file.name+'" />').appendTo('#filesfe ul');
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
                base_url1 : base_url1+'admin/serie/procesar/';
    $('#fileuploadfe_g').fileupload({
        formData: {
                 carpeta: 'serie'               
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
                $('<li/>').html('<img style="width:240px; height:180px;" src="'+base_url1+'uploads/images/serie/'+file.name+'" />'+'<input type="hidden" name="portada_bg" id="portada_bg" value="'+file.name+'" />').appendTo('#filesfe_g ul');
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




$('#categoria').multiSelect();