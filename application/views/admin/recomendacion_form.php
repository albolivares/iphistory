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
    	<h2>Recomendación: <small><?=($acc=='nvo') ?  'Agregar nuevo registro' :  'Editar registro'; ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>
	<div class="x_content">
	<div class="stepContainer" >
    
	<?php $frm=($acc=='nvo') ? base_url() . 'admin/recomendacion/nueva/' : base_url() . 'admin/recomendacion/editar/'.$id_obj; echo form_open($frm, ' enctype="multipart/form-data" ') ?>	
	<input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title"><?=($acc=='nvo') ?  'Nueva recomendación' :  'Editar recomendación'; ?></h3></div>
	<div class="panel-body">
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estatus">Estatus</label>
		<?php $options = array('0'         => 'No publicado','1'           => 'Publicado');
		echo form_dropdown('estatus', $options, $estatusId, 'class=form-control'); ?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
	</div>
	<div class="col-md-6  col-sm-6 col-xs-12">
		   <div class="form-group">
		   <label for="fecha_inicio_hist">Fecha inicio:</label> 
            <?php echo form_input($fecha_inicio_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true" style="margin-top: 28px;"></span><div class="help-block with-errors"></div>
          </div>
    </div>      
    <div class="col-md-6 col-sm-6 col-xs-12">      
      <div class="form-group">  
      		<label for="fecha_fin_hist">Fecha fin:</label>   
            <?php echo form_input($fecha_fin_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true" style="margin-top: 28px;"></span><div class="help-block with-errors"></div>
          </div>    
    </div>
	

	<div  class="col-md-12">
		<div class="form-group">
		    <label>Título</label>
		    <!-- <input type="text" name="title" class="form-control" id="title" placeholder="Escribe tu búsqueda" required data-error="Por favor busque el título." > -->
		    <?php echo form_input($title);?>
		    <input type="hidden" id="id_hist" name="id_hist" value="<?=$id_hist?>" >
		 </div>
		<!-- 		 <div class="form-group">
				    <label>Description</label>
				    <textarea name="description" class="form-control" placeholder="Description" style="width:500px;"></textarea>
				 </div> -->
	</div>	
	
	
<div class="col-md-12 col-xs-12">



	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Categoría</a></li>
		<li role="presentation" ><a href="#tab_content2" id="semb-tab" role="tab" data-toggle="tab" >Secciones</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	  
		<div class="form-group">

			<select multiple="multiple" id="categoria" name="my-categoria[]" class="form-control" >
			<?php 
			 foreach($rsCategoria as $categoria) { 
			if (in_array($categoria->id_categoria, $arrCath)) $selp=' selected="selected" ';  else $selp='';
			echo '<option '.$selp.' value="'.$categoria->id_categoria.'">'.$categoria->categoria.'</option>'; } ?>
			</select> 	
		</div>	
	</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="semb-tab">
	  
		<div class="form-group">
			<select multiple="multiple" id="seccion" name="my-seccion[]" class="form-control" >
			<?php 
			 foreach($rsSeccion as $seccion) { 
			if (in_array($seccion->id_seccion, $arrSec)) $selp=' selected="selected" ';  else $selp='';
			echo '<option '.$selp.' value="'.$seccion->id_seccion.'">'.$seccion->seccion.'</option>'; } ?>
			</select> 	
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