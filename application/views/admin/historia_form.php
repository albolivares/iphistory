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
    	<h2>Historía: <small><?=($acc=='nvo') ?  'Agregar nuevo registro' :  'Editar registro'; ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>
	<div class="x_content">
	<div class="stepContainer" >
    
	<!-- <form action="<?=($acc=='nvo') ? base_url() . 'admin/historia/nuevo/' : base_url() . 'admin/historia/editar/'.$id_obj ?>" id="contactForm" method="post" enctype="multipart/form-data" accept-charset="utf-8" >
 -->
	<?php $frm=($acc=='nvo') ? base_url() . 'admin/historia/nueva/' : base_url() . 'admin/historia/editar/'.$id_obj; echo form_open($frm, ' enctype="multipart/form-data" ') ?>	
	<input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title"><?=($acc=='nvo') ?  'Nueva historía' :  'Editar historía'; ?></h3></div>
	<div class="panel-body">
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estatus">Estatus</label>
		<?php $options = array('0'         => 'No publicado','1'           => 'Publicado');
		echo form_dropdown('estatus', $options, $estatusId, 'class=form-control'); ?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="duracion_hist">Duración lectura</label>
	<select id="duracion_hist" name="duracion_hist"  class="form-control">
	<option>--</option>
	<?php
	foreach($rsTiempo as $tiempo) { ($duracionId==$tiempo->id_tiempo) ? $selp=' selected="selected" ': $selp=''; 
	echo '<option '.$selp.' value="'.$tiempo->id_tiempo.'">'.$tiempo->tiempo.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<label for="titulo_hist">Título:</label>
	<?php echo form_input($titulo_hist);?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-12 col-sm-6 col-xs-12">
	<label for="id_serie">Serie:</label>
	<select id="id_serie" name="id_serie"  class="form-control">
	<option>--</option>
	<?php
	foreach($rsSerie as $serie) { ($serieId==$serie->id_serie) ? $selp=' selected="selected" ': $selp='';  
	echo '<option '.$selp.' value="'.$serie->id_serie.'">'.$serie->titulo_serie.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="form-group">
		<label for="copy_hist">Copy:</label><br/>
		<?php echo form_textarea($copy_hist);?><div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-md-1 col-xs-12">

		    <div class="form-group" style="margin-top: 10px">
            <label>Vigencia:</label>
          </div>
    </div>
	<div class="col-md-3 col-xs-6">
		   <div class="form-group"> 
            <?php echo form_input($fecha_inicio_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><div class="help-block with-errors"></div>
          </div>
    </div>      
    <div class="col-md-3 col-xs-6">      
      <div class="form-group">    
            <?php echo form_input($fecha_fin_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><div class="help-block with-errors"></div>
          </div>    
    </div>
	<div class="col-md-1 col-xs-2">
		    <div class="form-group" style="margin-top: 10px">
           <label for="hashtag_hist">Hastag:</label>
          </div>
    </div>
    <div class="col-md-4 col-xs-10">      
      <div class="form-group">

            <?php echo form_input($hashtag_hist);?><div class="help-block with-errors"></div>
          </div>    
    </div>
	<div class="col-md-6">
     <div class="form-group">                 
	    <span class="fileinput-button button " tabindex="6">        
	        <span><i class="glyphicon glyphicon-camera" aria-hidden="true"></i>
	            Portada (300px X 300px)</span>
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
	        	<?php if($portada_sm){ echo '<img style="width:240px; height:180px;" src="'.base_url().'uploads/images/historia/'.$portada_sm.'" /><input type="hidden" name="portada_sm" id="portada_sm" value="'.$portada_sm.'" />'; } ?>
	           
	        </ul>
	    </div>
	</div>
</div>
	<div class="col-md-6">
    <div class="form-group">
	    <span class="fileinput-button button " tabindex="6">        
	        <span><i class="glyphicon glyphicon-camera" aria-hidden="true"></i>
	            Portada grande (500px X 300px)</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileuploadfe_g" type="file" name="files[]"  >        
	    </span>
	    <br>
	    <br>
	    <!-- The global progress bar -->
	    <div id="progressfe_g" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="filesfe_g" class="files">
	        <ul class="listaimg">
<?php if($portada_bg){ echo '<img style="width:240px; height:180px;" src="'.base_url().'uploads/images/historia/'.$portada_bg.'" /><input type="hidden" name="portada_bg" id="portada_bg" value="'.$portada_bg.'" />'; } ?>
	           
	        </ul>
	    </div>
	</div>
</div>	
	<div class="col-md-12 col-xs-12">

	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Historia</a></li>
		<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Categoría</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	  <?php echo form_textarea($historia);?>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
	<select multiple="multiple" id="categoria" name="my-categoria[]" class="form-control" >
	<?php print_r($arrCath);
	 foreach($rsCategoria as $categoria) { 
	
	if (in_array($categoria->id_categoria, $arrCath)) $selp=' selected="selected" ';  else $selp='';
	echo '<option '.$selp.' value="'.$categoria->id_categoria.'">'.$categoria->categoria.'</option>'; } ?>
	</select>           
    </div>
   </div>

	</div>	

</div>
   	
	</div><!--panel-body-->
</div><!--#step1-->

	<div class="col-md-6">
     <div class="form-group">                 
	    <span class="fileinput-button button " tabindex="6">        
	        <span><i class="glyphicon glyphicon-play-circle" aria-hidden="true"></i>
	            Audio completo</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileuploadau" type="file" name="files[]"  >        
	    </span>
	    <br>
	    <br>
	    <!-- The global progress bar -->
	    <div id="progressfau" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="filesfau" class="files">
	        <ul class="listaimg">
<?php if($audio){ 
$audioc='<li><audio controls><source src="'.base_url().'uploads/audio/historia/'.$audio.'"></audio>';
          echo $audioc.'<br/><a target="_blank" href="'.base_url().'uploads/audio/historia/'.$audio.'">'.$audio.'</a><input type="hidden" name="archivo_audio" id="archivo_audio" value="'.$audio.'" /></li>'; 
} ?>
	        </ul>
	    </div>
	</div>
</div>


	<div class="col-md-6">
     <div class="form-group">                 
	    <span class="fileinput-button button " tabindex="6">        
	        <span><i class="glyphicon glyphicon-play-circle" aria-hidden="true"></i>
	            Teaser</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileuploadaut" type="file" name="files[]"  >        
	    </span>
	    <br>
	    <br>
	    <!-- The global progress bar -->
	    <div id="progressfaut" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="filesfaut" class="files">
	        <ul class="listaimg">
<?php if($teaser){ 
$audioc='<li><audio controls><source src="'.base_url().'uploads/audio/historia/'.$teaser.'"></audio>';
          echo $audioc.'<br/><a target="_blank" href="'.base_url().'uploads/audio/historia/'.$teaser.'">'.$teaser.'</a><input type="hidden" name="teaser_audio" id="teaser_audio" value="'.$teaser.'" /></li>'; 
} ?>
	           
	        </ul>
	    </div>
	</div>
</div>

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