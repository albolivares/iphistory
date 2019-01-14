<div class="right_col" role="main">
<?php if (validation_errors() != '') {?>
  <div class="row">
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong><?php echo validation_errors(); ?></strong> 
  </div>
</div>
<?php } ?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_title"> 
    	<h2>Autor: <small><?=($acc=='nvo') ?  'Agregar nuevo registro' :  'Editar registro'; ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>
	<div class="x_content">
	<div class="stepContainer" >
    
	
	<?php $frm=($acc=='nvo') ? base_url() . 'admin/autor/nuevo/' : base_url() . 'admin/autor/editar/'.$id_obj; echo form_open($frm, ' enctype="multipart/form-data" ') ?>	
	<input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	<input type="hidden" id="pswd_act" name="pswd_act" value="<?=$pswd_act?>">
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title"><?=($acc=='nvo') ?  'Nueva autor' :  'Editar autor'; ?></h3></div>
	<div class="panel-body">
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estatus">Estatus</label>
		<?php $options = array('0'         => 'Inactivo','1'           => 'Activo');
		echo form_dropdown('estatus', $options, $estatusId, 'class=form-control'); ?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="nombre">* Nombre:</label>
	<?php echo form_input($nombre);?><div class="help-block with-errors"></div>
	</div>	
	<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="apellido_p">* Apellido paterno:</label>
	<?php echo form_input($apellido_p);?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="apellido_m">Apellido materno:</label>
	<?php echo form_input($apellido_m);?><div class="help-block with-errors"></div>
	</div>
	
	<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="pseudonimo">Pseudonimo:</label>
	<?php echo form_input($pseudonimo);?><div class="help-block with-errors"></div>
	</div>

		<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="correo">* Correo:</label>
	<?php echo form_input($correo);?><div class="help-block with-errors"></div>
	</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="pswd">* Password:</label>
	<?php echo form_input($pswd);?><div class="help-block with-errors"></div>
	</div>

<div class="col-md-6 col-xs-12">
		   <div class="form-group"> 
		   	<label for="fecha_inicio_hist">* Fecha nacimiento:</label>
            <?php echo form_input($fecha_inicio_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true" style="margin-top: 28px;"></span><div class="help-block with-errors"></div>
          </div>
    </div>      

<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="genero">Género:</label><br/>
	<input type="radio" name="genero" value="1" id="id_genero1">&nbsp;Femenino&nbsp;&nbsp;<input type="radio" name="genero" value="2" id="id_genero2">&nbsp;Masculino<br/><br/>
	<div class="help-block with-errors"></div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="nacionalidad">Nacionalidad</label>
	<select id="nacionalidad" name="nacionalidad"  class="form-control">
	<option>--</option>
	<?php
	foreach($rsNacionalidad as $nacionalidad) { ($nacionalidadId==$nacionalidad->id) ? $selp=' selected="selected" ': $selp=''; 
	echo '<option '.$selp.' value="'.$nacionalidad->id.'">'.$nacionalidad->nacionalidad.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estado">Estado</label>
	<select id="estado" name="estado"  class="form-control">
	<option>--</option>
	<?php
	foreach($rsEstados as $estados) { ($estadosId==$estados->id) ? $selp=' selected="selected" ': $selp=''; 
	echo '<option '.$selp.' value="'.$estados->id.'">'.$estados->entidad.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estado">Ciudad</label>
	<select id="ciudad" name="ciudad"  class="form-control">
	<option>--</option></select>
	<div class="help-block with-errors"></div>
	</div>	

	<div class="col-md-6 col-sm-12 col-xs-12">
	<label for="pseudonimo">Núm. contrato:</label>
	<?php echo form_input($num_contrato);?><div class="help-block with-errors"></div>
	</div>


<div class="col-md-6 col-sm-12 col-xs-12" >
	<label for="avatar">¿Mostrar avatar?:</label><br/>
	<input type="radio" name="avatar" value="1" id="id_avatar1" <?=($muestraAvatar=='1')? "checked='checked'":""; ?>>&nbsp;Sí&nbsp;&nbsp;<input type="radio" name="avatar" value="2" id="id_avatar2" <?=($muestraAvatar=='2')? "checked='checked'":""; ?>>&nbsp;No, quiero mi foto(300x300px)<br/><br/>
	<div class="help-block with-errors"></div>

<div class="cc-selector" id="contAva" <?=($muestraAvatar=='2' || $muestraAvatar=='' || $muestraAvatar=='0')? " style=' display:none;' ":""; ?> >

	<?php foreach($rsAvatars as $avatar) { ?> 
        <input id="<?=$avatar->id_avatar?>" <?=($idAvatar==$avatar->id_avatar)? "checked='checked'":""; ?> type="radio" name="avatar_sel" value="<?=$avatar->id_avatar?>" />
        <label class="drinkcard-cc" style="background-image:url(<?=base_url().$avatar->imagen_avatar?>);" for="<?=$avatar->id_avatar?>"></label>
    <?php }?>    
        
    </div>


	</div>


	<div class="col-md-6  col-sm-12 col-xs-12" id="contUp" <?=($muestraAvatar=='1' || $muestraAvatar=='' || $muestraAvatar=='0')? " style=' display:none;' ":""; ?> >
     <div class="form-group">                 
	    <span class="fileinput-button button " tabindex="6">        
	        <span><i class="glyphicon glyphicon-camera" aria-hidden="true"></i>
	            Cargar foto (300px X 300px)</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileuploadfe" type="file" name="files[]"  >        
	    </span>
	    <br>
	    <br>
	    <!-- The global progress bar -->
	    <div id="progressfe" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="filesfe" class="files">
	        <ul class="listaimg">
	        	<?php if($portada_sm){ echo '<img style="width:240px; height:180px;" src="'.base_url().'uploads/images/avatar/'.$portada_sm.'" /><input type="hidden" name="portada_sm" id="portada_sm" value="'.$portada_sm.'" />'; } ?>
	           
	        </ul>
	    </div>
	</div>
</div>
		
	<div class="col-md-12 col-xs-12">

	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Minibio</a></li>
		<li role="presentation" ><a href="#tab_content3" id="semb-tab" role="tab" data-toggle="tab" >Semblanza</a></li>
		<li role="presentation" ><a href="#tab_content4" id="int-tab" role="tab" data-toggle="tab" >Intereses</a></li>
		<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" >Datos fiscales</a></li>
		<li role="presentation" class=""><a href="#tab_content5" role="tab" id="banc-tab" data-toggle="tab" >Datos bancarios</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	  <?php echo form_textarea($minibio);?>
	</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="int-tab">
	  <?php echo form_textarea($historia);?>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="int">
	  <select multiple="multiple" id="categoria" name="my-categoria[]" class="form-control" >
	<?php print_r($arrCath);
	 foreach($rsCategoria as $categoria) { 
	
	if (in_array($categoria->id_categoria, $arrCath)) $selp=' selected="selected" ';  else $selp='';
	echo '<option '.$selp.' value="'.$categoria->id_categoria.'">'.$categoria->categoria.'</option>'; } ?>
	</select>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
	<h2>Agregar RFC</h2>

	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="tipo">Tipo persona:</label>
		<input id="tipop1" name="tipo_persona" type="radio" class="" <?php if($tipop=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('tipop', 0); ?> />
        <label for="permanente" class="">Física</label>
        <input id="tipop2" name="tipo_persona" type="radio" class="" <?php if($tipop=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('tipop', 1); ?> />
        <label for="permanente" class="">Moral</label>
	</div>
	</div>


	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="rfc">RFC:</label>
	<?php echo form_input($rfc);?><div class="help-block with-errors"></div>	
	</div>
	</div>

	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="razons">Razón social:</label>
	<?php echo form_input($razons);?><div class="help-block with-errors"></div>	
	</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="domiciliof">Domicilio fiscal:</label>
	<?php echo form_textarea($domiciliof);?><div class="help-block with-errors"></div>	
	</div>
	</div>


	<div class="col-md-6 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="CIF">CIF:</label>
	<div class="help-block with-errors"></div>	
	</div>
	</div>

    </div>
    <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="banc-tab">
	<h2>Cuenta bancaria</h2>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="nombre_cuenta">Nombre titular:</label>
	<?php echo form_input($nombre_cuenta);?><div class="help-block with-errors"></div>	
	</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="nombre_cuenta">Num. cuenta:</label>
	<?php echo form_input($num_cuenta);?><div class="help-block with-errors"></div>	
	</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="clabe">CLABE:</label>
	<?php echo form_input($clabe);?><div class="help-block with-errors"></div>	
	</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="num_tarjeta">Num. tarjeta:</label>
	<?php echo form_input($num_tarjeta);?><div class="help-block with-errors"></div>	
	</div>
	</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="num_cliente">Num. cliente:</label>
	<?php echo form_input($num_cliente);?><div class="help-block with-errors"></div>	
	</div>
	</div>

	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="banco">Banco:</label>
	<div class="help-block with-errors"></div>	
	</div>
	</div>


	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="sucursal">Sucursal:</label>
	<?php echo form_input($sucursal);?><div class="help-block with-errors"></div>	
	</div>
	</div>

    </div>
   </div>

	</div>	

</div>
   	
	</div><!--panel-body-->
</div><!--#step1-->

	



	<div class="col-md-12 col-xs-12">
    <div class="form-group">
    
    	 <?php echo form_submit('submit', 'Guardar'," class='btn btn-success pull-right' "); ?>
    </div>
</div> 
	<?=form_close() ?>
 	</div><!--.stepContainer-->    
</div><!--x-content-->	
    </div><!--.x_panel-->
   </div><!--.col-md-12.col-sm-12.col-xs-12-->      	
</div>