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
    
<script src="<?=base_url()?>vendors/jquery/src/ajaxupload.3.5.js"></script>    
<script type="text/javascript">
		
$(document).ready(function() {		
		/***Upload PDF***/
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
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
			
			$("#pesp").val(response.peso);			
      var archivo = response.archivo;
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response.respuesta==="success"){
					$('#files').html('<a href="<?=base_url()?>recursos/pdf/'+carpeta+'/'+archivo+'" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar documento</a>&nbsp;&nbsp;&nbsp;<i class="fa fa-remove eli_doc" ></i><input type="hidden" name="docp" id="docp" value="recursos/pdf/'+carpeta+'/'+archivo+'"/>').addClass('success');
					/**PDF**/
		$(".eli_doc").click(function(){
			var msg = confirm("¿Desea eliminar el archivo?");
			if(msg){	
		    $('#files').html('<input type="hidden" name="docp" id="docp" value=""/>');
				$('#pesp').val('');
			};		
		});
					
				} else{
					/*$('<li></li>').appendTo*/$('#files').text(file).addClass('error'); 
				}
			}
		});		
	});

});
		</script>
    
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
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" placeholder="Search for..." class="form-control">
                    <span class="input-group-btn">
                              <button type="button" class="btn btn-default">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Datos generales del proyecto <small>Requiere un oficio</small><?=$tipo_solicitud; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i></a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                          <a href="#step-1" class="selected" isdone="1" rel="1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Paso 1<br>
                                              <small>Captura los datos</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" class="disabled" isdone="0" rel="2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br>
                                              <small>Espera la validación, del Dirección TIC</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="disabled" isdone="0" rel="3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 3<br>
                                              <small>Integra la documentación solicitada</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4" class="disabled" isdone="0" rel="4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Paso 4<br>
                                              <small>Revisa el avance</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      
                      
                      
                      

                    <div class="stepContainer" style=" height:auto; height:100%"><div id="step-1" class="x-content" style="display: block;">

                        <?php echo form_open('solicitudes/registrar/uno', ' data-parsley-validate class="form-horizontal form-label-left"'); ?>
<!--
/*INSERT INTO `PROY_SC`.`SOLICITUDES` (`ID`, `TIPO_SOLICITUD`, `VC_OFICIO`, `URL_OFICIO`, `ID_CONTACTO_UA`, `FCH_ALTA`, `VC_NOMBRE_PROY`, `VC_JUSTIFICA`, `VC_OBJETIVO_GENERAL`, `VC_OBJETIVO_ESPECIFICO`, `TIPO_PUBLICO`, `TXT_DESCRIPCION_PROY`, `TXT_DESCRIPCION_MOD`, `ESTATUS_PROY`, `TIENE_SERVER`, `ID_SERVIDOR`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/-->
                          <?php 
													$data = array(        'type'  => 'hidden',        'name'  => 'tipo_solictud',        'id'    => 'tipo_solictud',        'value' => $tipo_solicitud);
													echo form_input($data);
													?>
                          
                                                    <?php 
													$data = array(        'type'  => 'hidden',        'name'  => 'carpeta',        'id'    => 'carpeta',        'value' => $carpeta_p);
													echo form_input($data);
													?>


                          <div class="form-group">
                            <label for="proyecto" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del proyecto<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" class="form-control col-md-7 col-xs-12" required="required" id="proyecto" name="proyecto"  value="<?php echo set_value('proyecto'); ?>" >
                            </div>
                          </div>

                          
                          <div class="form-group">
                            <label for="last-name" class="control-label col-md-3 col-sm-3 col-xs-12">Oficio<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin:0; padding-left:0;">
                              <div class="col-md-10 col-sm-10 col-xs-10">
                              <input type="text" class="form-control col-md-7 col-xs-12" required="required" name="oficio" id="oficio" value="<?php echo set_value('oficio'); ?>" >
                              </div>
                              <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding-left:0">
                              	<button id="upload" class="btn btn-default" type="button">Cargar Oficio</button>
                       					<span id="status" ></span>		
                              </div>
														<div>		                 
                   
		                  <div id="files" class="btn" ><?php if(set_value('docp')){ ?><a href="<?php echo base_url().set_value('docp') ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar Oficio</a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc" ></i><?php } ?>
                      <input type="hidden" name="docp" id="docp" value="<?php echo set_value('docp') ?>"/>
                      </div>
                   </div>
                            </div>
                          </div>
                          
                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle-name">Contacto</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="contacto" readonly class="form-control col-md-7 col-xs-12" id="contacto" value="<?=$this->session->userdata('nombre')?>" >
                            </div>
                          </div>
                          
                          <div class="form-group"> 
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objeivo_g">Objetivo general<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12"><textarea id="objeivo_g" required="required" class="form-control" name="objeivo_g" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas al menos 20 caracteres." data-parsley-validation-threshold="10"><?php echo set_value('objeivo_g'); ?></textarea></div>
                         </div>   
                         
                         <div class="form-group"> 
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objeivo_e">Objetivo especifico<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12"><textarea id="objeivo_e" required="required" class="form-control" name="objeivo_e" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas al menos 20 caracteres." data-parsley-validation-threshold="10"><?php echo set_value('objeivo_e'); ?></textarea></div>
                         </div>   
                         
                         <div class="form-group"> 
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objeivo_e">Justificación<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12"><textarea id="justifica" required="required" class="form-control" name="justifica" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas al menos 20 caracteres." data-parsley-validation-threshold="10"><?php echo set_value('justifica'); ?></textarea></div>
                         </div>  
                            
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="middle-name">Descripción<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
 
																 <?php // include "editor_texto.php"; ?>
                                 
                                 <!--<div id="editor-one" class="editor-wrapper"></div>-->
																	<textarea name="descr" id="descr" required="required" class="form-control" ><?php echo set_value('descr'); ?></textarea>
                            </div>      
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Cuenta con servidor para instalar el proyecto? <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div data-toggle="buttons" class="btn-group" id="gender">
                                  <input type="radio" class="flat" name="servidor" id="servidor" value="1" required > &nbsp; Sí &nbsp;
                                  <input type="radio" class="flat" name="servidor" id="servidor" value="0"   > &nbsp; No &nbsp;

                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Servidor <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" required="required" class="date-picker form-control col-md-7 col-xs-12" id="id_servidor" name="id_servidor">
                            </div>
                          </div>
                          
                                              <div class="form-group">
                    <button type="submit" class="btn btn-success">Nuevo</button>
                    </div>

                        </form>

                      </div><div id="step-2" class="content" style="display: none;">
                        <h2 class="StepTitle">Step 2 Content</h2>
                        <p>
                          do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                          fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                      </div><div id="step-3" class="content" style="display: none;">
                        <h2 class="StepTitle">Step 3 Content</h2>
                        <p>
                          sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                          eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                      </div><div id="step-4" class="content" style="display: none;">
                        <h2 class="StepTitle">Step 4 Content</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                          in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                      </div></div><div class="actionBar"><div class="msgBox"><div class="content"></div><a class="close" href="#">X</a></div><div class="loader">Loading</div><a href="#" class="buttonFinish buttonDisabled btn btn-default">Finish</a><a href="#" class="buttonNext btn btn-success">Next</a><a href="#" class="buttonPrevious buttonDisabled btn btn-primary">Previous</a></div></div>
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
	
  </body>
</html>
