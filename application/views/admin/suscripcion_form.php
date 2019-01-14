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
    	<h2>Suscripción: <small><?=($acc=='nvo') ?  'Agregar nuevo registro' :  'Editar registro'; ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>
	<div class="x_content">
	<div class="stepContainer" >
    
	<?php $frm=($acc=='nvo') ? base_url() . 'admin/suscripcion/nueva/' : base_url() . 'admin/suscripcion/editar/'.$id_obj; echo form_open($frm, ' enctype="multipart/form-data" ') ?>	
	<input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title"><?=($acc=='nvo') ?  'Nueva suscripción' :  'Editar suscripción'; ?></h3></div>
	<div class="panel-body">
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estatus">Estatus</label>
		<?php $options = array('0'         => 'Inactiva','1'           => 'Activa');
		echo form_dropdown('estatus', $options, $estatusId, 'class=form-control'); ?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
	</div>
	
	<div  class="col-md-12">
		<div class="form-group">
		    <label for="titulo_hist">Título:</label>
		    <?php echo form_input($titulo_hist);?><div class="help-block with-errors"></div>  
		 </div>
	</div>	 


	<div  class="col-md-12">
		<div class="form-group">
		    <label for="descripcion">Descripción:</label>
		    <?php echo form_textarea($descripcion);?><div class="help-block with-errors"></div>  
		 </div>
	</div>	 

	
	<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="form-group"><br/>
	<label for="tipo">Tipo:</label>
		<input id="tipo1" name="tipo" type="radio" class="" <?php if($tipo=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('tipo', 0); ?> />
        <label for="permanente" class="">Suscripción</label>
        <input id="tipo2" name="tipo" type="radio" class="" <?php if($tipo=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('tipo', 1); ?> />
        <label for="permanente" class="">Paquete</label>
	</div>
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="form-group">
	<label for="Precio">Precio:</label>
		<?php echo form_input($precio);?><div class="help-block with-errors"></div>
	</div>
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="form-group">
	<label for="Orden">Orden:</label>
		<?php echo form_input($orden);?><div class="help-block with-errors"></div>
	</div>
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12" id="conDura" <?=($tipo==1)? " style=' display:none;' ":""; ?> >
	<label for="duracion">Duración:</label>
	<select id="duracion" name="duracion"  class="form-control">
	<option>--</option>
	<?php
	foreach($rsDuracion as $duracion) { ($duracionId==$duracion->id_duracion_suscr) ? $selp=' selected="selected" ': $selp='';  
	echo '<option '.$selp.' value="'.$duracion->id_duracion_suscr.'">'.$duracion->duracion_suscr.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>


	<div class="col-md-3 col-sm-6 col-xs-12" id="contNumH" <?=($tipo==0 || $tipo=='')? " style=' display:none;' ":""; ?> >
	<label for="num_historias">Núm. de historías:</label>
	<?php echo form_input($num_historias);?><div class="help-block with-errors"></div><div class="help-block with-errors"></div>
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