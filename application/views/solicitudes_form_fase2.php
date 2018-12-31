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
    
    
     <!-- PNotify -->
    <link href="<?=base_url()?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    
            <?php 
						
			if(isset($datos_sol)  && $datos_sol!='' ){		
			
				
				foreach($datos_sol as $fila_sol)
												{
													$tipo_sol=$fila_sol->TIPO_SOL; 
	$estatus_sol=$fila_sol->ESTATUS_PROY;  
	$estatus_nom=$fila_sol->ESTATUS;
		$correo_sol=$fila_sol->VC_CORREO;
	$TIENE_SERVER=$fila_sol->TIENE_SERVER;$ID_SERVIDOR=$fila_sol->ID_SERVIDOR; $CARPETA=$fila_sol->CARPETA;
	$ID_CONTACTO_UA=$fila_sol->ID_CONTACTO_UA; $FCH_ALTA=$fila_sol->FCH_ALTA;
	$AVANCE=$fila_sol->PORC_AVANCE_DOC;
	
	$OFICIO_NOM=$fila_sol->OFICIO_NOM; $OFICIO=$fila_sol->OFICIO; $NOMBRE=$fila_sol->NOMBRE;
	$JUSTIFICA=$fila_sol->JUSTIFICA; $OBJETIVO=$fila_sol->OBJETIVO; $DESC=$fila_sol->DESC; 
	$ARQUI=$fila_sol->ARQUI; $REQF=$fila_sol->REQF; $REQT=$fila_sol->REQT; $LIST=$fila_sol->LIST; $ALIM=$fila_sol->ALIM; 
	$SISTE=$fila_sol->SISTE;  $CANTG=$fila_sol->CANTG; $PRODI=$fila_sol->PRODI; $IDENT=$fila_sol->IDENT; 
	
												
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
                <h3><strong>Proyecto: </strong><?=$fila_sol->NOMBRE ?></h3>
                <h4><strong>Estatus: </strong><?php if($ID_EST_AP==2 ) echo ' En espera de propuesta gráfica.';  else { echo $fila_sol->ESTATUS;} ?></h4>
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
                    <h2>Datos generales del proyecto <small>Tipo de solicitud: <?=$fila_sol->TIPO_SOL; ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a aria-expanded="false" role="button" style="color:#34495E; font-weight:600; "  class="dropdown-toggle" href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-wrench"></i> Historial de la solicitud</a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
<!--                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>Por favor llena los siguientes datos, los campos marcados con " * " son obligatorios.</p>
                    <div class="form_wizard wizard_horizontal" id="wizard">
                      <ul class="wizard_steps anchor">
                        <li>
                          <a href="#step-1" class="disabled" style="cursor:default" isdone="1" rel="1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Paso 1<br>
                                              <small>Captura los datos</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==1) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?>   rel="2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 2<br>
                                              <small>Espera la validación, de la Dirección TIC</small>
                                          </span>
                          </a>
                        </li>
                                                <li>
                          <a href="#step-2" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==2) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?>   rel="3">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Paso 3<br>
                                              <small>Propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        
                                                <li>
                          <a href="#step-3" style="cursor:default" <?php if( $fila_sol->ESTATUS_PROY==12) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="4">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Paso 4<br>
                                              <small>En espera de validación de propuesta gráfica</small>
                                          </span>
                          </a>
                        </li>
                        
                        <li>
                          <a href="#step-3" style="cursor:default" <?php if(  $fila_sol->ESTATUS_PROY==11) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="5">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Paso 5<br>
                                              <small>En desarrollo</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4" style="cursor:default" <?php if( $ID_EST_AP==7) echo ' class="selected" isdone="1" '; else echo ' class="disabled" isdone="0" '; ?> rel="6">
                            <span class="step_no">5</span>
                            <span class="step_descr">
                                              Paso 6<br>
                                              <small>Finalizado</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      
                      
                      
                      

                    <div class="stepContainer" style=" height:auto; height:100%"><div id="step-1" class="x-content" style="display: block;">
                    
                    
                    
                    
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Datos del proyecto <small><?=$fila_sol->NOMBRE ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li style="float:right; text-align:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!--<li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i></a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                      <!--<li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start accordion -->
                    <div aria-multiselectable="true" role="tablist" id="accordion1" class="accordion">
                      <div class="panel">
                        <a aria-controls="collapseOne" aria-expanded="false" href="#collapseOne1" data-parent="#accordion1" data-toggle="collapse" id="headingOne1" role="tab" class="panel-heading collapsed">
                          <h4 class="panel-title">Datos del solicitante</h4>
                        </a>
                        <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="collapseOne1" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body">
                            
                              <?php foreach($datos_per as $fila_per){ ?>
                              	<strong>Nombre:</strong>
<?=$fila_per->VC_NOMBRE.' '.$fila_per->VC_APELLIDO_PAT.' '.$fila_per->VC_APELLIDO_MAT; ?><br/>
                              	<strong>Correo:</strong>
<?=$fila_per->VC_CORREO; ?><br/>
                                <strong>Unidad administrativa:</strong>
<?php echo $fila_per->UNIDAD; $unidad=$fila_per->UNIDAD; ?><br/>
                                <strong>Cargo:</strong>
<?=$fila_per->VC_CARGO ?><br/>
                                <strong>Telefono:</strong>
<?=$fila_per->VC_TELEFONO.' '.$fila_per->VC_EXTENSION ?><br/>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo1" data-parent="#accordion1" data-toggle="collapse" id="headingTwo1" role="tab" class="panel-heading collapsed">
                          <h4 class="panel-title">Datos del proyecto solicitado</h4>
                        </a>
                        <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="collapseTwo1" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body form-horizontal form-label-left">
                          	
                            <div class="form-group">
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de solicitud: </label>
                            <div class="col-md-9 col-sm-9 col-xs-9" style="padding-left: 0px;"><?=$fila_sol->TIPO_SOL; ?></div></div>
                            <div class="form-group"><label  class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de solicitud: </label>
                            <div class="col-md-9 col-sm-9 col-xs-9" style="padding-left: 0px;"><?=$fila_sol->FCH_ALTA; ?></div></div>
                            <div class="form-group"><label  class="control-label col-md-3 col-sm-3 col-xs-12">Unidad administrativa: </label>
                            <div class="col-md-9 col-sm-9 col-xs-9" style="padding-left: 0px;"><?=$unidad; ?></div></div>
                            <?php
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
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
        
        <?php if($fila_camp->TIPO=='hidden') { ?>

		       <div id="files_<?=$fila_camp->CVE_TIPO; ?>" class="btn" style="padding-left: 0px; border-left-width: 0px;" ><?php if( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ){ ?><a href="<?php echo base_url().${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp->CVE_TIPO; ?>" ></span>		
				<?php } else { 
				 if($fila_camp->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?>
          </div>

          <?php } elseif($fila_camp->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                           <?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?>
                    </div>

                    
          <?php } 
					} ?>                             
        </div>
      </div><!--.form-group-->
<?php } /*foreach*/
}/*if(isset($datos_sol)...*/ ?>
                            
     <div class="form-group">                     
        <label for="sol_oficio_nom" class="control-label col-md-3 col-sm-3 col-xs-12">Servidor <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
       <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;"><?php if($fila_sol->TIENE_SERVER==1) echo 'Ya cuenta con un servidor para el proyecto.'; else 'No cuenta con un servidor para el proyecto. Necesita solictarlo a la Dirección de informática.' ?></div>
			 </div>
       </div>
      
      
     <?php if($fila_sol->TIENE_SERVER==1) {?>
       <div class="form-group">
        <label for="sol_oficio_nom" class="control-label col-md-3 col-sm-3 col-xs-12">Datos del servidor <span class="required">*</span>         </label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;"><div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;"><?=$fila_sol->IP?></div></div>
       </div>
      <?php }?>
                            
                            
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree3" data-parent="#accordion1" data-toggle="collapse" id="headingThree3" role="tab" class="panel-heading collapsed"  >
                          <h4 class="panel-title">Datos de aprobación del proyecto</h4>
                        </a>
                        <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="collapseThree3" >
                          <div class="panel-body form-horizontal form-label-left">
                            
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
															$validac=$fila_fase_1->VC_CORREO;														
														}
												} ?>
                        		<strong>Fecha de validación: </strong> <?=$fecha_fase1 ?><br/>
                            <strong>Usuario validación: </strong> <?=$validac ?><br/>
                            <strong>Comentarios de validación: </strong> <?=$com_fase1 ?><br/>
                          </div>
                        </div>
                      </div>
                      
                      <?php if($ID_EST_AP==7) { ?>
                      
                      <div class="panel">
                        <a aria-controls="collapseFour" aria-expanded="true" href="#collapseThree4" data-parent="#accordion1" data-toggle="collapse" id="headingThree4" role="tab" class="panel-heading">
                          <h4 class="panel-title">Datos de desarrollo del proyecto</h4>
                        </a>
                        <div aria-labelledby="headingFour" role="tabpanel" class="panel-collapse collapse in" id="collapseThree4" aria-expanded="true">
                          <div class="panel-body form-horizontal form-label-left">
                         
                         <?php
if(isset($datos_sol_des)  && $datos_sol_des!='' ){		

foreach($datos_sol_des as $fila_sol_des)
	{
		$ID_DES=$fila_sol_des->ID; 
		$ID_SOLICITUD_DES=$fila_sol_des->ID_SOLICITUD;  
		$AVANCE_DES=$fila_sol_des->AVANCE;  
		$CARPETA_DES=$fila_sol_des->CARPETA;
		$PROPD=$fila_sol_des->PROPD;
		$BASED=$fila_sol_des->BASED; 
		$MAQUE=$fila_sol_des->MAQUE; 
		$INTEGRA=$fila_sol_des->INTEGRA;
		$CMSN=$fila_sol_des->CMSN; 
		$CMSE=$fila_sol_des->CMSE;
		$GRAFB=$fila_sol_des->GRAFB;
		$PRUFI=$fila_sol_des->PRUFI; 
		$VALUF=$fila_sol_des->VALUF; 
		$COMF=$fila_sol_des->COMF;
		$ENVAPR=$fila_sol_des->ENVAPR; 
		$MANUT=$fila_sol_des->MANUT; 
		$MANUU=$fila_sol_des->MANUU;
		$VALPGD=$fila_sol_des->VALPGD;
		$COMVPGD=$fila_sol_des->COMVPGD;
		$ESTATUS_PROY=$fila_sol_des->ESTATUS_PROY; 
	}
} ?>
                        <?php
												
												//echo 'des:'.print_r($datos_sol_des);
												/* Array ( [0] => stdClass Object ( [ID] => 0000000001 [ID_SOLICITUD] => 1 [CARPETA] => 15NH6OJ4TR [AVANCE] => 100 [PROPD] => recursos/pdf/15NH6OJ4TR/la__dama_de_urtubi_7.pdf [BASED] => 1 [MAQUE] => 1 [INTEGRA] => 1 [CMSN] => 1 [CMSE] => 1 [GRAFB] => 1 [PRUFI] => 1 [VALUF] => 1 [COMF] => Ya revise los accesos y si cumple con los requerimientos que solicite, más adelante me gustaría que.... [ENVAPR] => 1 [MANUT] => recursos/pdf/15NH6OJ4TR/la__dama_de_urtubi_8.pdf [MANUU] => [VALPGD] => 0 [COMVPGD] => [ESTATUS_PROY] => 7 [USU_CREA] => 17 [FCH_CREA] => 2017-08-31 17:41:28 [USU_MODIFICA] => 17 [FCH_MODIFICA] => 2017-08-31 17:39:16 [USU_VALIDA] => 10 [FCH_VALIDA] => 2017-08-31 17:41:28 [ESTATUS] => Finalizada ) ) des:1 Fecha de validación: 2017-08-31 17:41:28*/
												//print_r($datos_sol_des);
?>

<?php
                            if(isset($campos_desT)  && $campos_desT!='' ){		
$cuenta_ob=0;
$ob_con_dat=0;
	foreach($campos_desT as $fila_camp)
		{
						if($fila_camp->ES_OBLIGATORIO==1) {$cuenta_ob=$cuenta_ob+1; 
						if ( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} !='' )  {$ob_con_dat=$ob_con_dat+1;}
						}
?>
<div class="form-group">
        <label for="<?=$fila_camp->CVE_TIPO; ?>" class="control-label col-md-3 col-sm-3 col-xs-12"><?=$fila_camp->VC_DOCUMENTO; ?><?php if($fila_camp->ES_OBLIGATORIO==1) echo ' <span class="required">*</span> ' ?>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
        
        <?php if($fila_camp->TIPO=='hidden') { ?>

		       <div id="files_<?=$fila_camp->CVE_TIPO; ?>" class="btn" style="margin-left:0; padding-left:0" ><?php if( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ){ ?><a href="<?php echo base_url().${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp->CVE_TIPO; ?>" ></span>		
				<?php } else { 
				 if($fila_camp->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?>
          </div>

          <?php } elseif($fila_camp->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                           <?php echo ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}; ?>
                    </div>

                    
          <?php } elseif($fila_camp->TIPO=='option') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                           <?php if( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))}==1 ) echo 'Sí'; else 'No' ?>
                    </div>

                    
          <?php } 
					
					} ?>                             
        </div>
      </div><!--.form-group-->
<?php } /*foreach*/
}/*if(isset($datos_sol)...*/ ?>



                          </div>
                        </div>
                      </div>
                      
                      <?php } ?>
                      
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
                    

         </div>
                      
                   
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

                      <hr/>
                      
<?php
if(isset($datos_sol_des)  && $datos_sol_des!='' ){		

foreach($datos_sol_des as $fila_sol_des)
	{
		$ID_DES=$fila_sol_des->ID; 
		$ID_SOLICITUD_DES=$fila_sol_des->ID_SOLICITUD;  
		$AVANCE_DES=$fila_sol_des->AVANCE;  
		$CARPETA_DES=$fila_sol_des->CARPETA;
		$PROPD=$fila_sol_des->PROPD;
		$BASED=$fila_sol_des->BASED; 
		$MAQUE=$fila_sol_des->MAQUE; 
		$INTEGRA=$fila_sol_des->INTEGRA;
		$CMSN=$fila_sol_des->CMSN; 
		$CMSE=$fila_sol_des->CMSE;
		$GRAFB=$fila_sol_des->GRAFB;
		$PRUFI=$fila_sol_des->PRUFI; 
		$VALUF=$fila_sol_des->VALUF; 
		$COMF=$fila_sol_des->COMF;
		$ENVAPR=$fila_sol_des->ENVAPR; 
		$MANUT=$fila_sol_des->MANUT; 
		$MANUU=$fila_sol_des->MANUU;
		$VALPGD=$fila_sol_des->VALPGD;
		$COMVPGD=$fila_sol_des->COMVPGD;
		$ESTATUS_PROY=$fila_sol_des->ESTATUS_PROY; 

	}
}else{
		$ID_DES='';
		$ID_SOLICITUD_DES='';
		$AVANCE_DES='';
		$CARPETA_DES='';
		$PROPD='';
		$BASED='';
		$MAQUE='';
		$INTEGRA='';
		$CMSN='';
		$CMSE='';
		$GRAFB='';
		$PRUFI='';
		$VALUF='';
		$COMF='';
		$ESTATUS_PROY='';
		$ENVAPR=''; 
		$MANUT=''; 
		$MANUU='';
		$VALPGD='';
		$COMVPGD='';

}

	if($PRODI!='' && $VALPGD!=0){$PROPD=$PRODI; $VALPGD=1;}
	$ID_EST_AP=(int)$ID_EST_AP;
	

	
//	echo $this->session->userdata('perm').' | '.$ID_EST_AP.' | '.$PROPD.' | '.$VALPGD;
?>


<?php 			
// echo 'p:'.$ID_EST_AP;
if( (($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 ) || $this->session->userdata('perm')==5) || ($this->session->userdata('perm')==3 && $ID_EST_AP==12 && $PROPD!='') || ($this->session->userdata('perm')==3 && $ID_EST_AP==14 && $PROPD!='') ) { ?>
<div id="step-2" class="content" style="background-color: #F4F4F4; margin-top:10px; margin-bottom:10px; padding:10px;"  >
  
  <?php if($VALPGD==0 && (is_numeric($ID_DES) && $ID_DES>0) && $ID_EST_AP!=12 && $ID_EST_AP!=14 && $ID_EST_AP!=11 && $ID_EST_AP!=7) { ?>  <h2 class="StepTitle">La propuesta de diseño no ha sido aprobada.<br/><br/> Se requiere integrar una nueva propuesta de diseño que considere los comentarios de validación de propuesta de diseño.</h2>
  <?php }elseif($ID_EST_AP==12 && ($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 ) ) { ?><h2 class="StepTitle">Se ha intregrado la propuesta de diseño.<br/><br/>Se requiere que el solicitante la valide para continuar con la fase de desarrollo.</h2>
	
	<?php }elseif($ID_EST_AP==12 && $this->session->userdata('perm')==3 ) { ?><h2 class="StepTitle">Se ha intregrado la propuesta de diseño.<br/><br/>Se requiere su revisión y validación para continuar con la fase de desarrollo.</h2>
	<?php }elseif($ID_EST_AP==14 && $this->session->userdata('perm')<>3 ) { ?><h2 class="StepTitle">En espera de aprobación final del usuario solicitante.<br/><br/>Una vez que el usuario apruebe le llegara el aviso.</h2>
  <?php }elseif($ID_EST_AP==14 && $this->session->userdata('perm')==3 ) { ?><h2 class="StepTitle">En espera de aprobación final.<br/><br/>Requerimos de su validación y revisión en el desarrollo.</h2>
  <?php if($MANUT!='') echo 'Datos del desarrollo: <a target="_blank" href="http://agendadigital.cultura.gob.mx/solpro/'.$MANUT.'"><i class="fa fa-file-pdf-o"></i> Consultar Datos del desarrollo</a>'; ?><br/>Propuesta de diseño: <a target="_blank" href="http://agendadigital.cultura.gob.mx/solpro/<?=$PROPD?>"><i class="fa fa-file-pdf-o"></i> Consultar Propuesta de diseño</a><br/><br/>
  <?php }elseif($ID_EST_AP==11 && $this->session->userdata('perm')<>3 && $COMF!='' && $VALUF==0 ) { ?><h2 class="StepTitle">El usuario solicitante no aprobo el desarrollo.<br/><br/>Comentarios: <?=$COMF?></h2>
  <?php }elseif($ID_EST_AP==7 ) { ?><h2 class="StepTitle">La solicitud ha sido finalizada.</h2><?php if($MANUT!='') echo 'Datos del desarrollo: <a target="_blank" href="http://agendadigital.cultura.gob.mx/solpro/'.$MANUT.'"><i class="fa fa-file-pdf-o"></i> Consultar Datos del desarrollo</a>'; ?><br/>Propuesta de diseño: <a target="_blank" href="http://agendadigital.cultura.gob.mx/solpro/<?=$PROPD?>"><i class="fa fa-file-pdf-o"></i> Consultar Propuesta de diseño</a><br/><br/>
	<?php }else{ ?><h2 class="StepTitle">Una vez que se lleve a cabo la reunión con la DGTIC, integre la documentación solicitada (PDF).</h2><?php } ?>
     <?php if(is_numeric($ID_DES) && $ID_DES>0 ) echo form_open('solicitudes/modificarf2/', ' data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" '); 
		 else echo form_open('solicitudes/aprobarf2/', ' data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" ');?>
                           
                           
		<?php 
    $data = array(        'type'  => 'hidden',        'name'  => 'id_solictud',        'id'    => 'id_solictud',        'value' => (int)$fila_sol->ID);
    echo form_input($data);

    $data = array(        'type'  => 'hidden',        'name'  => 'carpeta',        'id'    => 'carpeta',        'value' => $fila_sol->CARPETA);
    echo form_input($data);

    $data = array(        'type'  => 'hidden',        'name'  => 'id_solictud_ap',        'id'    => 'id_solictud_ap',        'value' => (int)$fila_sol->ID); 
    echo form_input($data);
		
		$data = array(        'type'  => 'hidden',        'name'  => 'id_des_ap',        'id'    => 'id_des_ap',        'value' => (int)$ID_DES); 
    echo form_input($data);
		
		
		$data = array(        'type'  => 'hidden',        'name'  => 'id_est_ap',        'id'    => 'id_est_ap',        'value' => (int)$ID_EST_AP); 
    echo form_input($data);
		
		
		$data = array(        'type'  => 'hidden',        'name'  => 'csol',        'id'    => 'csol',        'value' => $correo_sol); 
    echo form_input($data);
		
		
		$data = array(        'type'  => 'hidden',        'name'  => 'nproy',        'id'    => 'nproy',        'value' => $NOMBRE); 
    echo form_input($data);
		
		
		$data = array(        'type'  => 'hidden',        'name'  => 'cval',        'id'    => 'cval',        'value' => 		$usuariov); 
    echo form_input($data);

		?>
<?php 
	
if($ID_EST_AP==12 || $ID_EST_AP==2){
		if(isset($campos_des)  && $campos_des!='' ){		
		$cuenta_ob_des=0;
		$ob_con_dat_des=0;
		foreach($campos_des as $fila_camp_des)
			{
							if($fila_camp_des->ES_OBLIGATORIO==1) {$cuenta_ob_des=$cuenta_ob_des+1; 
							if ( ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} !='' )  {
								if($fila_camp_des->TIPO=='option' && ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==1) $ob_con_dat_des=$ob_con_dat_des+1;
								elseif($fila_camp_des->TIPO!='option') $ob_con_dat_des=$ob_con_dat_des+1;
								}
							}
?>
<div class="form-group">


        <label for="<?=$fila_camp_des->CVE_TIPO; ?>" class="control-label col-md-3 col-sm-3 col-xs-12"><?=$fila_camp_des->VC_DOCUMENTO; ?><?php if($fila_camp_des->ES_OBLIGATORIO==1) echo ' <span class="required">*</span> ' ?>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
        
        <?php if($fila_camp_des->TIPO=='hidden') { ?>
		 		   <input type="hidden" name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" value="<?=${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ?>"/>
		
           <button <?php if($ID_EST_AP==7) echo  ' style="display:none" '; ?> id="upload_<?=$fila_camp_des->CVE_TIPO; ?>" <?php if($this->session->userdata('perm')==3) echo ' style="display:none" ' ?>  class="btn btn-default"  type="button" >Cargar documento</button>
           <button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button>

		       <div id="files_<?=$fila_camp_des->CVE_TIPO; ?>" class="btn" style="padding-left: 0px; border-left-width: 0px;" ><?php if( ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ){ ?><a href="<?php echo base_url().${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp_des->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp_des->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp_des->CVE_TIPO; ?>" ></span>		
       <?php } elseif($fila_camp_des->TIPO=='option') { ?>  
       
       <input type="radio" class="flat" <?php if($this->session->userdata('perm')<>3) echo ' disabled '; ?>  name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if(${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==1) echo 'checked'; ?> value="1" required  > &nbsp; Sí &nbsp;
       <input type="radio" class="flat" <?php if($this->session->userdata('perm')<>3) echo ' disabled '; ?> name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if(${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==0) echo 'checked'; ?> value="0"   > &nbsp; No &nbsp;
  
           
				<?php } else { 
				 if($fila_camp_des->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <input type="text" class="form-control col-md-7 col-xs-12" <?php if($fila_camp_des->ES_OBLIGATORIO==1) echo ' required="required" '?> id="<?=$fila_camp_des->CVE_TIPO; ?>" name="<?=$fila_camp_des->CVE_TIPO; ?>"  value="<?php echo ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}; ?>" >
          </div>
                  <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button></div>
          <?php } elseif($fila_camp_des->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                    <textarea <?php if($this->session->userdata('perm')<>3) echo ' disabled '; ?> id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if($fila_camp_des->ES_OBLIGATORIO==1 && $this->session->userdata('perm')==3) echo ' required="required" '?> class="form-control" name="<?=$fila_camp_des->CVE_TIPO; ?>" data-parsley-trigger="keyup" data-parsley-minlength="<?=$fila_camp_des->MIN_CAR; ?>" data-parsley-maxlength="<?=$fila_camp_des->MAX_CAR; ?>" data-parsley-minlength-message="Necesitas al menos <?=$fila_camp_des->MIN_CAR; ?> caracteres." data-parsley-validation-threshold="10"><?php echo ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}; ?></textarea>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button></div>
                    
          <?php } 
					} ?>                             
        </div>
      </div><!--.form-group-->
<?php } /*foreach*/
}/*if(isset($datos_sol)...*/ 
											$porc_avanc_des=($ob_con_dat_des*100)/$cuenta_ob_des;
$data = array(        'type'  => 'hidden',        'name'  => 'avancd_solictud',        'id'    => 'avancd_solictud',        'value' => $porc_avanc_des ); 
   									echo form_input($data);	
										$data = array(        'type'  => 'hidden',        'name'  => 'nvo_disenio',        'id'    => 'nvo_disenio',        'value' => '' ); 
   									echo form_input($data);	
?>	

	
<?php 	}/*if($ID_EST_AP==12)*/
	
	else{
		if(isset($campos_des)  && $campos_des!='' ){		
		$cuenta_ob_des=0;
		$ob_con_dat_des=0;
		foreach($campos_des as $fila_camp_des)
			{
							if($fila_camp_des->ES_OBLIGATORIO==1) {$cuenta_ob_des=$cuenta_ob_des+1; 
							if ( ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} !='' )  {
								if($fila_camp_des->TIPO=='option' && ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==1) $ob_con_dat_des=$ob_con_dat_des+1;
								elseif($fila_camp_des->TIPO!='option') $ob_con_dat_des=$ob_con_dat_des+1;
								}
							}
?>
<div class="form-group">


        <label for="<?=$fila_camp_des->CVE_TIPO; ?>" class="control-label col-md-3 col-sm-3 col-xs-12"><?=$fila_camp_des->VC_DOCUMENTO; ?><?php if($fila_camp_des->ES_OBLIGATORIO==1) echo ' <span class="required">*</span> ' ?>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
        
        <?php if($fila_camp_des->TIPO=='hidden') { ?>
		 		   <input type="hidden" name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" value="<?=${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ?>"/>
		
           <button   id="upload_<?=$fila_camp_des->CVE_TIPO; ?>" <?php if(($fila_camp_des->CVE_TIPO=='sol_propd' && $ID_EST_AP==11 ) || $ID_EST_AP==7) echo ' style="display:none" '  ?> class="btn btn-default"  type="button" >Cargar documento</button>
           <button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button>

		       <div id="files_<?=$fila_camp_des->CVE_TIPO; ?>" class="btn" style="padding-left: 0px; border-left-width: 0px;" ><?php if( ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ){ ?><a href="<?php echo base_url().${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>&nbsp;Consultar <?=$fila_camp_des->VC_DOCUMENTO; ?></a>&nbsp;&nbsp;<i class="fa fa-remove eli_doc_<?=$fila_camp_des->CVE_TIPO; ?>" ></i><?php } ?></div>
           <span id="status_<?=$fila_camp_des->CVE_TIPO; ?>" ></span>		
       <?php } elseif($fila_camp_des->TIPO=='option') { ?>  
       
       <?php //echo $fila_camp_des->CVE_TIPO." | ".$ID_EST_AP." | ".$AVANCE_DES." | ";  ?>
       <?php ///if($fila_camp_des->CVE_TIPO=='sol_envapr' && $ID_EST_AP==11 && $AVANCE_DES<100) echo ' disabled '  ?>
       <input type="radio" class="flat"   <?php if($fila_camp_des->CVE_TIPO=='sol_envapr' && $ID_EST_AP==11 && $AVANCE_DES<100) echo ' disabled '  ?> name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if(${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==1) echo 'checked'; ?> value="1" required  > &nbsp; Sí &nbsp;
       <input type="radio" class="flat" <?php if($fila_camp_des->CVE_TIPO=='sol_envapr' && $ID_EST_AP==11 && $AVANCE_DES<100) echo ' disabled '  ?>  name="<?=$fila_camp_des->CVE_TIPO; ?>" id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if(${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==0) echo 'checked'; ?> value="0"   > &nbsp; No &nbsp;
  
           
				<?php } else { 
				 if($fila_camp_des->TIPO=='textfield') { ?>
          <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">
          <input type="text" class="form-control col-md-7 col-xs-12" <?php if($fila_camp_des->ES_OBLIGATORIO==1) echo ' required="required" '?> id="<?=$fila_camp_des->CVE_TIPO; ?>" name="<?=$fila_camp_des->CVE_TIPO; ?>"  value="<?php echo ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}; ?>" >
          </div>
                  <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button></div>
          <?php } elseif($fila_camp_des->TIPO=='textarea') { ?>
                           <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;">   
                    <textarea id="<?=$fila_camp_des->CVE_TIPO; ?>" <?php if($fila_camp_des->ES_OBLIGATORIO==1) echo ' required="required" '?> <?php if($fila_camp_des->CVE_TIPO=='sol_comf' && $this->session->userdata('perm')<>3) echo ' disabled '; ?> class="form-control" name="<?=$fila_camp_des->CVE_TIPO; ?>" data-parsley-trigger="keyup" data-parsley-minlength="<?=$fila_camp_des->MIN_CAR; ?>" data-parsley-maxlength="<?=$fila_camp_des->MAX_CAR; ?>" data-parsley-minlength-message="Necesitas al menos <?=$fila_camp_des->MIN_CAR; ?> caracteres." data-parsley-validation-threshold="10"><?php echo ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}; ?></textarea>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2"><button type="button" class="btn btn-default source" data-toggle="modal" data-target=".modal_<?=$fila_camp_des->CVE_TIPO; ?>">?</button></div>
                    
          <?php } 
					} ?>                             
        </div>
      </div><!--.form-group-->
<?php } /*foreach*/
}/*if(isset($datos_sol)...*/ 
											$porc_avanc_des=($ob_con_dat_des*100)/$cuenta_ob_des;
$data = array(        'type'  => 'hidden',        'name'  => 'avancd_solictud',        'id'    => 'avancd_solictud',        'value' => $porc_avanc_des ); 
   									echo form_input($data);
}/*else($ID_EST_AP==12)*/
?>



                         
                         
                    <div class="form-group">
                    <button  type="submit" <?php if($ID_EST_AP==7) echo  ' style="display:none" '; if( ($ID_EST_AP==14 || $ID_EST_AP==12) && 	($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 )) echo ' disabled '; ?>  class="btn btn-success">Enviar</button><?php if(($ID_EST_AP==14 || $ID_EST_AP==12) && 	($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 )) echo '* '.$fila_sol->ESTATUS; ?>
                    </div>
                           
                           </form>
                        
                      </div>
                      <?php }else{ 
													if(isset($campos_des)  && $campos_des!='' ){		
														$cuenta_ob_des=0;
														$ob_con_dat_des=0;
														foreach($campos_des as $fila_camp_des)
														{
															if($fila_camp_des->ES_OBLIGATORIO==1) {
																$cuenta_ob_des=$cuenta_ob_des+1; 
																if ( ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))} !='' )  {
																	if($fila_camp_des->TIPO=='option' && ${strtoupper(str_replace('sol_','',$fila_camp_des->CVE_TIPO))}==1) $ob_con_dat_des=$ob_con_dat_des+1;
							elseif($fila_camp_des->TIPO!='option') $ob_con_dat_des=$ob_con_dat_des+1;
																}
															}
														
														}
													}
													

											$porc_avanc_des=($ob_con_dat_des*100)/$cuenta_ob_des;
//											echo 'por:'.$porc_avanc_des;
											if($porc_avanc_des==0) $bar_color=' bg-red '; elseif($porc_avanc_des<50 ) $bar_color=' bg-orange '; elseif($porc_avanc_des<80) $bar_color=' bg-green '; elseif($porc_avanc_des>80) $bar_color=' bg-blue '; 
											else $bar_color=' bg-green ';
											
											if($ID_EST_AP==2 && $this->session->userdata('perm')==3) {echo '<div class="form-group">* Por favor espera a que se integre la propuesta gráfica para su evaluación.</div>';} else {
											?>
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Avance de desarollo:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
                            <small><?php echo round($porc_avanc_des); ?>% Completado</small>
                            <div class="progress">
                              <div class="progress-bar <?=$bar_color?>" role="progressbar" data-transitiongoal="<?php echo $porc_avanc_des; ?>"></div>
                            </div>
                            
                            </div>
                         </div>
                      
                      <?php }} ?>
                      
                      <div class="x_content">

<?php            
if(isset($campos_des)  && $campos_des!='' ){		
	foreach($campos_des as $fila_camp)
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
if(isset($campos_des)  && $campos_des!='' ){		
	foreach($campos_des as $fila_camp)
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

					<?php if($fila_camp->CVE_TIPO=='sol_propd') echo "$('#nvo_disenio').val('esndisenio');"; ?>

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
	<?php } 
	}?>
  </body>
</html>
