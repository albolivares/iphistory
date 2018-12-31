</div><!--.right_col-->
</div>        
        
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view("footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?=base_url()?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?=base_url()?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url()?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>vendors/iCheck/icheck.min.js"></script>
    <!-- Parsley -->
    <script src="<?=base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Skycons -->
    <script src="<?=base_url()?>vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?=base_url()?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?=base_url()?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?=base_url()?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?=base_url()?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?=base_url()?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="<?=base_url()?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?=base_url()?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?=base_url()?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?=base_url()?>vendors/pdfmake/build/vfs_fonts.js"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
     <script src="<?php echo base_url()?>assets/js/upload/jquery.ui.widget.js"></script>
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script> 
    <!-- Bootstrap Core JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
     <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo base_url()?>assets/js/upload/jquery.fileupload-validate.js"></script>
    <script>
    $(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    } );
} );
/*funcion ajax que llena el combo dependiendo de la categoria seleccionada*/
$(document).ready(function(){
   $("#fase").change(function () {
           $("#fase option:selected").each(function () {
            mifase=$('#fase').val();
            id_cat_documento1 = $('#id_cat_documento1').val();
            $.post("<?php echo base_url();?>tipo_rel/llenacombo", { mifase: mifase,id_cat_documento1:id_cat_documento1}, function(data){
            $("#id_cat_documento").html(data);
            });            
        });
   })
   $("#fase").bind("change", function(){}).change();
});
/*fin de la funcion ajax que llena el combo dependiendo de la categoria seleccionada*/
</script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>build/js/custom.min.js"></script>
   <script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//<?php echo base_url()?>' : '/solpro/sugerencias/procesar/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        //maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        $("#files div").children().remove();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            /*if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }*/
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            /*data.context.find('button')
                .text('Cargar')
                .prop('disabled', !!data.files.error);*/
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width', 
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
          $("#files ul").children().remove();
                 $('<li/>').html('<input type="hidden" name="ruta" id="ruta" value="'+file.url+'" />').appendTo('#files ul');
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
                
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('Carga de archivo fallida.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>

 <script>
    /**Redes sociales **/
     $( function () {
  $( '#btnAdd' ).click( function() {
    var num = $( '.clonedInput' ).length;   // how many "duplicatable" input fields we currently have
    var newNum  = new Number( num + 1 );    // the numeric ID of the new input field being added
    var newElem = $( '#input' + num ).clone().attr( 'id', 'input' + newNum );
    
    newElem.children( ':first' ).attr( 'id', 'url' ).attr( 'name', 'url[]');
    $( '#input' + num ).after( newElem );
    $( '#btnDel' ).attr( 'disabled', false );
    /*if ( newNum == 5 )
      $( '#btnAdd' ).attr( 'disabled', 'disabled' );*/
  });
  
  $( '#btnDel' ).click( function() {
    var num = $( '.clonedInput' ).length;   // how many "duplicatable" input fields we currently have
    $( '#input' + num ).remove();       // remove the last element
    $( '#btnAdd' ).attr( 'disabled', false ); // enable the "add" button
    
    // if only one element remains, disable the "remove" button
    if ( num-1 == 1 )
      $( '#btnDel' ).attr( 'disabled', 'disabled' );
  });
      
  $( '#btnDel' ).attr( 'disabled', 'disabled' );
});

/**Aplicación**/
 $( function () {
  $( '#btnAddb' ).click( function() {
    var num = $( '.clonedInputb' ).length;   // how many "duplicatable" input fields we currently have
    var newNum  = new Number( num + 1 );    // the numeric ID of the new input field being added
    var newElem = $( '#inputb' + num ).clone().attr( 'id', 'inputb' + newNum );
    
    newElem.children( ':first' ).attr( 'id', 'urlb' ).attr( 'name', 'urlb[]');
    $( '#inputb' + num ).after( newElem );
    $( '#btnDelb' ).attr( 'disabled', false );
    /*if ( newNum == 5 )
      $( '#btnAdd' ).attr( 'disabled', 'disabled' );*/
  });
  
  $( '#btnDelb' ).click( function() {
    var num = $( '.clonedInputb' ).length;   // how many "duplicatable" input fields we currently have
    $( '#inputb' + num ).remove();       // remove the last element
    $( '#btnAddb' ).attr( 'disabled', false ); // enable the "add" button
    
    // if only one element remains, disable the "remove" button
    if ( num-1 == 1 )
      $( '#btnDelb' ).attr( 'disabled', 'disabled' );
  });
      
  $( '#btnDelb' ).attr( 'disabled', 'disabled' );
});
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
			yearRange: "1998:2018",
			dateFormat: "yy-mm-dd"
    });
  } );
  </script>
  </body>
</html>