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

    
    
    
		<?php /* UPDATE `PROY_SC`.`SOLICITUDES_T` SET `ID`='0000000001', `TIPO_SOLICITUD`='1', `ESTATUS_PROY`='1', `OFICIO_NOM`='of/787987', `OFICIO`='', `NOMBRE`='nombre...', `JUSTIFICA`='justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...justificación...', `OBJETIVO`='objetivos...objetivos...objetivos...objetivos...objetivos...objetivos...objetivos...', `DESC`='descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....descripción....', `TIENE_SERVER`='0', `ID_SERVIDOR`=NULL, `CARPETA`='15NH6OJ4TR', `ARQUI`='', `REQF`='', `REQT`=NULL, `LIST`='', `SISTE`='', `ALIM`='', `CANTG`='', `PRODI`='', `IDENT`='', `FCH_ALTA`='2017-07-27 17:32:20', `ID_CONTACTO_UA`='1', `VC_OBJETIVO_ESPECIFICO`=NULL, `TIPO_PUBLICO`=NULL, `TXT_DESCRIPCION_MOD`=NULL, `FCH_MODIFICA`=NULL WHERE (`ID`='0000000001');
*/
/*Paso 1 asigna los campos con los  valores del regitro a editar*/		
    
if(isset($datos_sol)  && $datos_sol!='' ){		

foreach($datos_sol as $fila_sol)
	{
	$id_sol=(int)$fila_sol->ID; 
	
	$tipo_sol=$fila_sol->TIPO_SOL; 
	$id_tipo_sol=$fila_sol->TIPO_SOLICITUD;
	$estatus_sol=$fila_sol->ESTATUS_PROY;  
	$estatus_nom=$fila_sol->ESTATUS;
		$correo_sol=$fila_sol->VC_CORREO;
	$TIENE_SERVER=$fila_sol->TIENE_SERVER;$ID_SERVIDOR=$fila_sol->ID_SERVIDOR;$IP_SERVIDOR=$fila_sol->IP; $CARPETA=$fila_sol->CARPETA;
	$ID_CONTACTO_UA=$fila_sol->ID_CONTACTO_UA; $FCH_ALTA=$fila_sol->FCH_ALTA;
	$AVANCE=$fila_sol->PORC_AVANCE_DOC;
	
	$OFICIO_NOM=$fila_sol->OFICIO_NOM; $OFICIO=$fila_sol->OFICIO; $NOMBRE=$fila_sol->NOMBRE;
	$JUSTIFICA=$fila_sol->JUSTIFICA; $OBJETIVO=$fila_sol->OBJETIVO; $DESC=$fila_sol->DESC; 
	$ARQUI=$fila_sol->ARQUI; $REQF=$fila_sol->REQF; $REQT=$fila_sol->REQT; $LIST=$fila_sol->LIST; $ALIM=$fila_sol->ALIM; 
	$SISTE=$fila_sol->SISTE;  $CANTG=$fila_sol->CANTG; $PRODI=$fila_sol->PRODI; $IDENT=$fila_sol->IDENT; 
	} 
}


?>
    
    
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
                <h3><strong>Proyecto:</strong> <?=$NOMBRE ?></h3>
                <h4><strong>Estatus:</strong> <?=$estatus_nom ?></h4>
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
                    <h2>Datos generales del proyecto <small>Tipo de solicitud: <?=$tipo_sol ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a aria-expanded="false" role="button" style="color:#34495E; font-weight:600; "  class="dropdown-toggle" href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-wrench"></i> Historial de solicitud</a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <!--<li><a class="close-link"><i class="fa fa-close"></i></a></li>-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->

                    <p>Por favor llena los siguientes datos, los campos marcados con " * " son obligatorios.</p>
                    <div class="form_wizard wizard_horizontal" id="wizard">
                      <ul class="wizard_steps anchor">
                        <li>
                          <a href="#step-1" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==1) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Paso 1<br>
                                              <small>Captura los datos</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==10) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?>   rel="2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br>
                                              <small>Espera la validación, de la Dirección TIC</small>
                                          </span>
                          </a>
                        </li>
                                           <li>
                          <a href="#step-3" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==2) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?>   rel="3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 3<br>
                                              <small>Propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        
                        <li>
                          <a href="#step-4" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==12) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Paso 4<br>
                                              <small>En espera de validación de propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        
                        <li>
                          <a href="#step-5" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==11) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="5">
                            <span class="step_no">5</span>
                            <span class="step_descr">
                                              Paso 5<br>
                                              <small>En desarrollo</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-6" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==7) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="6">
                            <span class="step_no">6</span>
                            <span class="step_descr">
                                              Paso 6<br>
                                              <small>Finalizado</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      
                      
                      
                      

                    <div class="stepContainer" style=" height:auto; height:100%"><div id="step-1" class="x-content" style="display: block;">

<?php 
  echo form_open('solicitudes/modificar/', ' data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" ');

  $data = array(        'type'  => 'hidden',        'name'  => 'tipo_solictud',        'id'    => 'tipo_solictud',        'value' => $id_tipo_sol );
  echo form_input($data);
  $data = array(        'type'  => 'hidden',        'name'  => 'id_solictud',        'id'    => 'id_solictud',        'value' => $id_sol);
  echo form_input($data);
  $data = array(        'type'  => 'hidden',        'name'  => 'carpeta',        'id'    => 'carpeta',        'value' => $CARPETA);
  echo form_input($data);

$data = array(        'type'  => 'hidden',        'name'  => 'estatus_sol',        'id'    => 'estatus_sol',        'value' => $estatus_sol);
  echo form_input($data);

if(isset($campos)  && $campos!='' ){		
$cuenta_ob=0;
$ob_con_dat=0;
	foreach($campos as $fila_camp)
		{
						if($fila_camp->ES_OBLIGATORIO==1) {$cuenta_ob=$cuenta_ob+1; 
						if ( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} !='' )  {$ob_con_dat=$ob_con_dat+1;}
						}
?>
<div class="form-group">
        <label for="<?=$fila_camp->CVE_TIPO; ?>" class="control-label col-md-3 col-sm-3 col-xs-12"><?=$fila_camp->VC_DOCUMENTO; ?><?php if($fila_camp->ES_OBLIGATORIO==1) echo ' <span class="required">*</span> ' ?>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        
        <?php if($fila_camp->TIPO=='hidden') { ?>
		 		   <input type="hidden" name="<?=$fila_camp->CVE_TIPO; ?>" id="<?=$fila_camp->CVE_TIPO; ?>" value="<?=${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ?>"/>
		
           <button id="upload_<?=$fila_camp->CVE_TIPO; ?>" class="btn btn-default"  type="button" <?php if(($this->session->userdata('perm')==2 || $this->ion_auth->is_admin())) echo ' style="display: none" '; ?>>Cargar documento</button>
           <button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp->CVE_TIPO; ?>">?</button>

		       <div id="files_<?=$fila_camp->CVE_TIPO; ?>" class="btn" ><?php if( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ){ ?><a href="<?php echo base_url().${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp->CVE_TIPO; ?>" ></span>		
				<?php } else { 
				 if($fila_camp->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <input type="text" class="form-control col-md-7 col-xs-12" <?php if($fila_camp->ES_OBLIGATORIO==1) echo ' required="required" '?> id="<?=$fila_camp->CVE_TIPO; ?>" name="<?=$fila_camp->CVE_TIPO; ?>"  value="<?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?>" >
          </div>
                  <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp->CVE_TIPO; ?>">?</button></div>
          <?php } elseif($fila_camp->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                    <textarea id="<?=$fila_camp->CVE_TIPO; ?>" <?php if($fila_camp->ES_OBLIGATORIO==1) echo ' required="required" '?> class="form-control" name="<?=$fila_camp->CVE_TIPO; ?>" data-parsley-trigger="keyup" data-parsley-minlength="<?=$fila_camp->MIN_CAR; ?>" data-parsley-maxlength="<?=$fila_camp->MAX_CAR; ?>" data-parsley-minlength-message="Necesitas al menos <?=$fila_camp->MIN_CAR; ?> caracteres." data-parsley-validation-threshold="10"><?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?></textarea>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Cuenta con servidor para instalar el proyecto? <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div data-toggle="buttons" class="btn-group" id="gender">
                                  <input type="radio"  name="servidor" id="servidor" <?php if($TIENE_SERVER==1) echo 'checked'; ?> value="1" required  > &nbsp; Sí &nbsp;
                                  <input type="radio"  name="servidor" id="servidor" <?php if($TIENE_SERVER==0 || $TIENE_SERVER=='') echo 'checked'; ?> value="0"   > &nbsp; No &nbsp;

                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Servidor
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                              
                              
                              <select name="id_servidor" class="form-control" id="id_servidor" >

                              <?php            
																if(isset($servidores)  && $servidores!='' ){	
																	echo '<option value="">-Servidores registrados-</option>';	
																	foreach($servidores as $fila_servs)
																		{
																		if($ID_SERVIDOR==$fila_servs->ID)	$sel=' selected '; else $sel=''; 
																		echo '<option '.$sel.' value="'.$fila_servs->ID.'">'.$fila_servs->IP.'</option>'; 
																		}
																}else{																	echo '<option value=""></option>';	
																}
																
																?>
																
                              </select>
                              
                            </div>
                          </div>
                         
                         <?php $porc_avance=($ob_con_dat*100)/$cuenta_ob; ?>
                         
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Avance de datos obligatorios:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <small><?php echo round($porc_avance); ?>% Completado</small>
                            <div class="progress">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $porc_avance; ?>"></div>
                            </div>
                            
                            </div>
                         </div>
                         
                         <?php if($this->session->userdata('perm')==1 && $porc_avance==100) { ?>
                          
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Datos del solicitante:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
															
                              <?php foreach($datos_per as $fila_per){ ?>
                              	<strong>Nombre:</strong>
<?=$fila_per->VC_NOMBRE.' '.$fila_per->VC_APELLIDO_PAT.' '.$fila_per->VC_APELLIDO_MAT; ?><br/>
                              	<strong>Correo:</strong>
<?=$fila_per->VC_CORREO; ?><br/>
                                <strong>Unidad administrativa:</strong>
<?=$fila_per->UNIDAD ?><br/>
                                <strong>Cargo:</strong>
<?=$fila_per->VC_CARGO ?><br/>
                                <strong>Telefono:</strong>
<?=$fila_per->VC_TELEFONO.' '.$fila_per->VC_EXTENSION ?><br/>
                              <?php } ?>
                            </div>
                          </div>
                         			
                         <?PHP } ?>
                         
                         
                        <?php
												$id_fase1=''; $nom_fase1=''; $fecha_fase1=''; $com_fase1=''; $estatus_fase1=''; 
													if(isset($datos_fase1)  && $datos_fase1!='' ){		
													
														
														
														foreach($datos_fase1 as $fila_fase_1)
														{ 
														/*F.ID_FASE, C.VC_NOMBRE FASE, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS*/
															$id_fase1=$fila_fase_1->ID_FASE;
															$nom_fase1=$fila_fase_1->FASE;
															$fecha_fase1=$fila_fase_1->FCH_VALIDA;
															$com_fase1=$fila_fase_1->COMENTARIOS_VALIDA;
															$estatus_fase1=$fila_fase_1->ESTATUS;
														
														}
												} ?>
                         
                    <div class="form-group">
                    <?php 
										if($porc_avance==100) $data = array(        'type'  => 'hidden',        'name'  => 'completa_solictud',        'id'    => 'completa_solictud',        'value' => $porc_avance );
 										else $data = array(        'type'  => 'hidden',        'name'  => 'avanc_solictud',        'id'    => 'avanc_solictud',        'value' => $porc_avance ); 
   									echo form_input($data);?>
                    <?php if( ($estatus_sol!=10) && ($this->session->userdata('perm')!=2) ) { ?>
                    <?php if($estatus_sol==1 &&  $this->session->userdata('perm')==3 && $porc_avance==100){ ?>
                    <button type="submit"   class="btn btn-primary" >Enviar</button>&nbsp;*&nbsp;Se ha completado la información requerida, para avanzar a la fase de validación, envie el formulario.
                    
                    <?php }else{ ?>
<button type="submit"  <?php if( ($this->session->userdata('perm')==3 && $porc_avance==100) || $id_fase1==2)  echo 'disabled class="btn btn-default" '; else echo ' class="btn btn-primary" '; ?> >Guardar</button>

                    <?php } }elseif($estatus_sol==10 && $this->session->userdata('perm')==3) echo '* La solicitud se encuentra en proceso de validación, en cuanto se tenga respuesta se le avisara por este medio y por correo electrónico.'?>
                    </div>

                        </form>
                        
                        

                      </div>
                      
                      
                      <?php if( ($this->session->userdata('perm')==2 || $this->ion_auth->is_admin()) && ($porc_avance==100 && $estatus_sol>1)  ) { ?>
                      <hr/>
                      <div id="step-2" class="content" style="background-color: #F4F4F4; margin-top:10px; margin-bottom:10px; padding:10px;"  >
                        
                        <?php if($nom_fase1!='') echo '<h2 class="StepTitle">Solicitud: '.$nom_fase1.'</h2><br/>'; else '<h2 class="StepTitle">Aprobar Solicitud</h2><br/>';  ?>
                        <?php if($fecha_fase1!='') echo '<br/>Fecha: '.$fecha_fase1.'<br/>'; ?>
                           <?php echo form_open('solicitudes/aprobar/', ' data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" '); ?>
                           
                           <div class="form-group"> 
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objeivo_e">Solicitud aprobada<span class="required">*</span></label>
                              <div data-toggle="buttons"  class="col-md-6 col-sm-6 col-xs-12 btn-group"  id="gender">
                                  <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==2) echo 'checked'; ?> value="1" required  > &nbsp; Sí &nbsp;
                                  <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==9) echo 'checked'; ?> value="9"   > &nbsp; No aprobada por falta de documentación y/o datos&nbsp;
                                  <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==8) echo 'checked'; ?> value="8"   > &nbsp; No aprobada, se rechaza la solicitud.&nbsp;

                              </div>
                            </div>
                           
                           <?php 
													$data = array(        'type'  => 'hidden',        'name'  => 'id_solictud_ap',        'id'    => 'id_solictud_ap',        'value' => (int)$fila_sol->ID);
													echo form_input($data);
													$data = array(        'type'  => 'hidden',        'name'  => 'nom_solictud_ap',        'id'    => 'nom_solictud_ap',        'value' => $NOMBRE);
													echo form_input($data);
													$data = array(        'type'  => 'hidden',        'name'  => 'usu_solictud_ap',        'id'    => 'usu_solictud_ap',        'value' => $correo_sol );
													echo form_input($data);
													?>
                           <div class="form-group"> 
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="objeivo_e">Comentarios<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12"><textarea id="comentario_aprueba" required="required" class="form-control" name="comentario_aprueba" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-maxlength="900" data-parsley-minlength-message="Necesitas al menos 20 caracteres." data-parsley-validation-threshold="10"><?=$com_fase1; ?></textarea></div>
                         </div> 
                         
                         
                         
                         
                    <div class="form-group">
                    <button <?php if($this->session->userdata('perm')==3 || $id_fase1==2) echo ' disabled '; ?> type="submit" class="btn btn-success">Enviar</button>
                    </div>
                           
                           </form>
                        
                      </div>
                      <?php } ?>
                      
                      </div><div class="actionBar"><div class="msgBox"><div class="content"></div>
                      <a class="close" href="#">X</a>
                      </div>
                      <div class="loader">Loading</div>
                      <!--<a href="#" class="buttonFinish buttonDisabled btn btn-default">Finish</a>--><!--<a href="#" class="buttonNext btn btn-success">Next</a>--><!--<a href="#" class="buttonPrevious buttonDisabled btn btn-primary">Previous</a>-->
                      </div></div>
                    <!-- End SmartWizard Content -->



                  </div>
                </div>
              </div>
            </div>
          </div>
        
        
        </div><!--.right_col-->
        


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Historial de la solicitud</h4>
                        </div>
                        <div class="modal-body">
                        
                        	<?php if(isset($logs_solicitud)  && $logs_solicitud!='' ){		
?>
<div class="table-responsive">
                      <table class="table table-striped jambo_table table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Fase</th>
                            <th class="column-title">Usuario alta</th>
                            <th class="column-title">Fecha alta</th>
                            <th class="column-title">Usuario valida</th>
                            <th class="column-title">Fecha valida</th>
                            <th class="column-title">Comentarios</th>
                            <th class="column-title">Estatus</th>
                          </tr>  
												</thead>
											<tbody>

<?php foreach($logs_solicitud as $fila_sol_logs)
	{ 
			$fase=$fila_sol_logs->VC_NOMBRE;
			$usuarioa=$fila_sol_logs->C_ALTA;
			$fechaa=$fila_sol_logs->FCH_ALTA;
			$usuariov=$fila_sol_logs->C_VALIDA;
			$fechav=$fila_sol_logs->FCH_VALIDA;
			$comnetariosv=$fila_sol_logs->COMENTARIOS_VALIDA;
			if($fila_sol_logs->ESTATUS==1 && $usuariov!='') $estatus_textl="Aprobada"; elseif($fila_sol_logs->ESTATUS==0) $estatus_textl="No aprobada"; else $estatus_textl="";
			
			/*F.ID_FASE,C.VC_NOMBRE, F.USU_ALTA,U1.VC_CORREO C_ALTA, F.FCH_ALTA, F.USU_VALIDA, U2.VC_CORREO C_VALIDA, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS */
	?>
		<tr class="even pointer">
    	<td class=" "><?=$fase?></td>
      <td class=" "><?=$usuarioa?></td>
      <td class=" "><?=$fechaa?></td>
      <td class=" "><?=$usuariov?></td>
      <td class=" "><?=$fechav?></td>
      <td class=" "><?=$comnetariosv?></td>
      <td class=" "><?=$estatus_textl?></td>
    </tr>  
<?php  } } ?>          

                </tbody>
             </table>
        </div>        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
                  </div>

        
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
			action: '../../../uploadf/'+carpeta,
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


$(document).ready(function(){

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
		</script>
    

  </body>
</html>
