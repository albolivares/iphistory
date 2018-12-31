<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo base_url();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registro de solicitudes</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url()?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url()?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>build/css/custom.min.css" rel="stylesheet">
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
    
    

    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php include("menu_izq.php"); ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <?php include("menu_top.php"); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        
        <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Registro de solicitudes</h3>
              </div>

              <div class="title_right">
                <!--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" placeholder="Search for..." class="form-control">
                    <span class="input-group-btn">
                              <button type="button" class="btn btn-default">Go!</button>
                          </span>
                  </div>
                </div>-->
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Datos generales del proyecto <small>Requiere un oficio</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>-->
                      <!--<li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i></a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                      <!--<li><a class="close-link"><i class="fa fa-close"></i></a>-->
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>Por favor llena los siguientes datos, los campos marcados con " * " son obligatorios.</p>
                    <div class="form_wizard wizard_horizontal" id="wizard">
                      <ul class="wizard_steps anchor">
                        <li>
                          <a href="#step-1" style="cursor:default" class="selected" isdone="1" rel="1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Paso 1<br>
                                              <small>Captura los datos</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" style="cursor:default" class="disabled" isdone="0" rel="2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br>
                                              <small>Espera la validación, de la Dirección TIC</small>
                                          </span>
                          </a>
                        </li>
                                      <li>
                          <a href="#step-3" style="cursor:default" class="disabled" isdone="0"   rel="3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 3<br>
                                              <small>Propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4" style="cursor:default" class="disabled" isdone="0" rel="4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Paso 4<br>
                                              <small>En espera de validación de propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-5" style="cursor:default" class="disabled" isdone="0" rel="5">
                            <span class="step_no">5</span>
                            <span class="step_descr">
                                              Paso 5<br>
                                              <small>En desarrollo</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-6" style="cursor:default" class="disabled" isdone="0" rel="6">
                            <span class="step_no">6</span>
                            <span class="step_descr">
                                              Paso 6<br>
                                              <small>Finalizado</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      
                      
                      
                      

                    <div class="stepContainer" style=" height:auto; height:100%"><div id="step-1" class="x-content" style="display: block;">

                        <?php echo form_open('solicitudes/registrar/uno', ' data-parsley-validate class="form-horizontal form-label-left"'); ?>

                          <?php 
													$data = array(        'type'  => 'hidden',        'name'  => 'tipo_solictud',        'id'    => 'tipo_solictud',        'value' => $tipo_solicitud);
													echo form_input($data);
													?>
                          
                          <?php 
													$data = array(        'type'  => 'hidden',        'name'  => 'carpeta',        'id'    => 'carpeta',        'value' => $carpeta_p);
													echo form_input($data);
													?>

<?php            
if(isset($campos)  && $campos!='' ){		
	foreach($campos as $fila_camp)
		{
?>
<div class="form-group">
        <label for="<?=$fila_camp->CVE_TIPO; ?>" class="control-label col-md-3 col-sm-3 col-xs-12"><?=$fila_camp->VC_DOCUMENTO; ?><?php if($fila_camp->ES_OBLIGATORIO==1) echo ' <span class="required">*</span> ' ?>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        
        <?php if($fila_camp->TIPO=='hidden') { ?>
		 		   <input type="hidden" name="<?=$fila_camp->CVE_TIPO; ?>" id="<?=$fila_camp->CVE_TIPO; ?>" value="<?php echo set_value('$fila_camp->CVE_TIPO') ?>"/>
		
           <button id="upload_<?=$fila_camp->CVE_TIPO; ?>" class="btn btn-default" type="button">Cargar documento</button>
                             <button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp->CVE_TIPO; ?>">?</button>

		       <div id="files_<?=$fila_camp->CVE_TIPO; ?>" class="btn" ><?php if(set_value('$fila_camp->CVE_TIPO')){ ?><a href="<?php echo base_url().set_value('$fila_camp->CVE_TIPO') ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp->CVE_TIPO; ?>" ></span>		
				<?php } else { 
				 if($fila_camp->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <input type="text" class="form-control col-md-7 col-xs-12" <?php if($fila_camp->ES_OBLIGATORIO==1) echo ' required="required" '?> id="<?=$fila_camp->CVE_TIPO; ?>" name="<?=$fila_camp->CVE_TIPO; ?>"  value="<?php echo set_value('$fila_camp->CVE_TIPO'); ?>" >
          </div>
                  <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp->CVE_TIPO; ?>">?</button></div>
          <?php } elseif($fila_camp->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                    <textarea id="<?=$fila_camp->CVE_TIPO; ?>" <?php if($fila_camp->ES_OBLIGATORIO==1) echo ' required="required" '?> class="form-control" name="<?=$fila_camp->CVE_TIPO; ?>" data-parsley-trigger="keyup" data-parsley-minlength="<?=$fila_camp->MIN_CAR; ?>" data-parsley-maxlength="<?=$fila_camp->MAX_CAR; ?>" data-parsley-minlength-message="Necesitas al menos <?=$fila_camp->MIN_CAR; ?> caracteres." data-parsley-validation-threshold="10"><?php echo set_value('$fila_camp->CVE_TIPO'); ?></textarea>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp->CVE_TIPO; ?>">?</button></div>
                    
          <?php } 
					} ?>                             
        </div>
      </div><!--.form-group-->
<?php } /*foreach*/
}/*if(isset($datos_sol)...*/ ?>


<div class="x_content">

<?php            
if(isset($campos)  && $campos!='' ){		
	foreach($campos as $fila_camp)
		{

?>
  <!-- Small modal -->
  <div class="modal fade modal_<?=$fila_camp->CVE_TIPO; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2"><?=$fila_camp->VC_DOCUMENTO; ?></h4>
        </div>
        <div class="modal-body">
          <?=$fila_camp->DESCRIPCION; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>
  <!-- /modals -->
<?php } } ?>  
</div>
                          
                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle-name">Contacto</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="contacto" readonly class="form-control col-md-7 col-xs-12" id="contacto" value="<?=$this->session->userdata('nombre')?>" >
                            </div>
                          </div>
                          
                            
                              <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Cuenta con servidor para instalar el proyecto? <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div data-toggle="buttons" class="btn-group" id="gender">
                                  <input type="radio"   name="servidor" id="servidor" value="1" required <?php            
																if(isset($servidores)  && $servidores!='' ) echo ' checked'; ?> > &nbsp; Sí &nbsp;
                                  <input type="radio"   name="servidor" id="servidor" value="0" <?php            
																if(!isset($servidores)  && $servidores=='' ) echo ' checked'; ?>   > &nbsp; No &nbsp;

                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Servidor</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                              <select name="id_servidor" class="form-control" id="id_servidor" >

                              <?php            
																if(isset($servidores)  && $servidores!='' ){	
																	echo '<option value="">-Servidores registrados-</option>';	
																	foreach($servidores as $fila_servs)
																		{ echo '<option value="'.$fila_servs->ID.'">'.$fila_servs->IP.'</option>'; }
																}else{																	echo '<option value=""></option>';	
																}
																
																?>
																
                              </select>
                            </div>
                          </div>
                          
                          
                    
                    <div class="actionBar"><div class="msgBox"><div class="content"></div><a class="close" href="#">X</a></div><div class="loader">Loading</div><button type="submit" class="btn btn-success">Guardar</button></div>

                        </form>

                      </div></div><!--<div class="actionBar"><div class="msgBox"><div class="content"></div><a class="close" href="#">X</a></div><div class="loader">Loading</div><a href="#" class="buttonFinish buttonDisabled btn btn-default">Finish</a><a href="#" class="buttonNext btn btn-success">Next</a><a href="#" class="buttonPrevious buttonDisabled btn btn-primary">Previous</a></div>--></div>
                    <!-- End SmartWizard Content -->



                  </div>
                </div>
              </div>
            </div>
          </div>
        
        
        </div><!--.right_col-->
        
        
        <!-- /page content -->

        <!-- footer content -->
        <?php include("footer.php"); ?>
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
    <!-- Skycons -->
    <script src="<?=base_url()?>vendors/skycons/skycons.js"></script>
        <script src="<?=base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- bootstrap-wysiwyg -->
    <script src="<?=base_url()?>vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?=base_url()?>vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?=base_url()?>vendors/google-code-prettify/src/prettify.js"></script>
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

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>build/js/custom.min.js"></script>
    
    
    <script src="<?=base_url()?>vendors/jquery/src/ajaxupload.3.5.js"></script>
    
    <script type="text/javascript">
		

$(document).ready(function(){
<?php  if(!isset($servidores)  && $servidores=='' ) echo '$( "#id_servidor" ).prop( "disabled", true );'; ?>			
$("input[name=servidor]:radio").click(function() {
    if($(this).attr("value")=="1") {
        //$(".inputclassname").show();
			//	alert('tiene servidor');
			$( "#id_servidor" ).prop( "disabled", false );
    }
    if($(this).attr("value")=="0") {
        //$(".inputclassname").hide();
			//alert('no tiene servidor');
			$( "#id_servidor" ).prop( "disabled", true );
    }
});

});


<?php            
if(isset($campos)  && $campos!='' ){		
	foreach($campos as $fila_camp)
		{
			 if($fila_camp->TIPO=='hidden') { 
?>

		/***Upload PDF***/
	$(function(){
		var btnUpload=$('#upload_<?=$fila_camp->CVE_TIPO; ?>');

		var status=$('#status_<?=$fila_camp->CVE_TIPO; ?>');
		var carpeta=$('#carpeta').val();
		new AjaxUpload(btnUpload, {
			action: '../uploadf/'+carpeta,
			name: 'uploadfile',
			responseType: 'json',
			onSubmit: function(file, ext){
				 if (! (ext && /^(pdf|doc|docx|xls|xlsx|ppt|pptx)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Solo archivos con extension PDF, DOC, XLS, XLSX, PPT, PPTX o DOCX son soportados');
					return false;
				}
				status.text('Cargando...');
			},
			onComplete: function(file, response){	
			//alert(response);
			
		
      var archivo = response.archivo;
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response.respuesta==="success"){

					$('#files_<?=$fila_camp->CVE_TIPO; ?>').html('<input class="flat" type="checkbox" checked style=" opacity: 0;"><a href="<?=base_url()?>recursos/pdf/'+carpeta+'/'+archivo+'" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=strip_tags($fila_camp->VC_DOCUMENTO); ?></a>&nbsp;&nbsp;&nbsp;<i class="fa fa-remove eli_doc" ></i><input type="hidden" name="<?=$fila_camp->CVE_TIPO; ?>" id="<?=$fila_camp->CVE_TIPO; ?>" value="recursos/pdf/'+carpeta+'/'+archivo+'"/>').addClass('success');

					/**PDF**/
		$(".eli_doc_<?=$fila_camp->CVE_TIPO; ?>").click(function(){
			var msg = confirm("¿Desea eliminar el archivo?");
			if(msg){	
		    $('#files_<?=$fila_camp->CVE_TIPO; ?>').html('<input type="hidden" name="<?=$fila_camp->CVE_TIPO; ?>" id="<?=$fila_camp->CVE_TIPO; ?>" value=""/>');

			};		
		});
					
				} else{
					/*$('<li></li>').appendTo*/$('#files_<?=$fila_camp->CVE_TIPO; ?>').text(file).addClass('error'); 
				}
			}
		});		
	});


<?php } /* if($fila_camp->TIPO=='hidden')*/ 
	} 
} ?>


		</script>

	
  </body>
</html>
