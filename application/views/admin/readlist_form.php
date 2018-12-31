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
    	<h2>Serie: <small><?=($acc=='nvo') ?  'Agregar nuevo registro' :  'Editar registro'; ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>
	<div class="x_content">
	<div class="stepContainer" >
    
	<?php $frm=($acc=='nvo') ? base_url() . 'admin/readlist/nueva/' : base_url() . 'admin/readlist/editar/'.$id_obj; echo form_open($frm, ' enctype="multipart/form-data" ') ?>	
	<input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title"><?=($acc=='nvo') ?  'Nueva readlist' :  'Editar readlist'; ?></h3></div>
	<div class="panel-body">
	<div class="col-md-6 col-sm-6 col-xs-12">
	<label for="estatus">Estatus</label>
		<?php $options = array('0'         => 'No publicado','1'           => 'Publicado');
		echo form_dropdown('estatus', $options, $estatusId, 'class=form-control'); ?><div class="help-block with-errors"></div>
	</div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
	<label for="titulo_hist">Título readlist:</label>
	<?php echo form_input($titulo_hist);?><div class="help-block with-errors"></div>
	</div>
	
	<div class="col-md-12 col-xs-12">
		<div class="form-group">
		<label for="copy_hist">Copy:</label><br/>
		<?php echo form_textarea($copy_hist);?><div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
	<label for="estatus">¿Es permanente?</label>
		<input id="permanente" name="permanente" type="radio" class="" <?php if($permanente=='0') echo "checked='checked'"; ?> value="0" <?php echo $this->form_validation->set_radio('permanente', 0); ?> />
                <label for="permanente" class="">Sí</label>

                <input id="permanente" name="permanente" type="radio" class="" <?php if($permanente=='1') echo "checked='checked'"; ?> value="1" <?php echo $this->form_validation->set_radio('permanente', 1); ?> />
                <label for="permanente" class="">No</label>
	</div>
	<div class="col-md-1 col-xs-12">

		    <div class="form-group" style="margin-top: 10px">
            <label>Vigencia:</label>
          </div>
    </div>
	<div class="col-md-4 col-xs-6">
		   <div class="form-group"> 
            <?php echo form_input($fecha_inicio_hist);?><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><div class="help-block with-errors"></div>
          </div>
    </div>      
    <div class="col-md-4 col-xs-6">      
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
    <div class="col-md-7 col-xs-12 col-md-offset-7"">      
          <div class="form-group"></div>
    </div>
 <div class="row">   
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
	        	<?php if($portada_sm){ echo '<img style="width:240px; height:180px;" src="'.base_url().'uploads/images/readlist/'.$portada_sm.'" /><input type="hidden" name="portada_sm" id="portada_sm" value="'.$portada_sm.'" />'; } ?>
	           
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
<?php if($portada_bg){ echo '<img style="width:240px; height:180px;" src="'.base_url().'uploads/images/readlist/'.$portada_bg.'" /><input type="hidden" name="portada_bg" id="portada_bg" value="'.$portada_bg.'" />'; } ?>
	           
	        	</ul>
	    	</div>
		</div>
	</div>
</div>	
   	
	</div><!--panel-body-->
</div><!--#step1-->

<div class="col-md-12">
	<a href="#" id="btn_preview" class="btn btn-default">Buscar historias</a>
	<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Id</th>
              <th>Historía</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

          	<div id="histList">
<?php if($arrCath) {foreach ($arrCath as $key => $historia) {
	echo '<tr><td>'.$historia['id_hist'].'</td><td>'.$historia['titulo_hist'].'</td><td><button type="button" class="removebutton" title="Eliminar">X</button></td><input type="hidden" name="val_hist[]" id="val_hist_'.$historia['id_hist'].'" value="'.$historia['id_hist'].'"></tr>';
} } ?>           


        	</div>
          </tbody>
     </table>                   
         <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/img/load.gif'; ?>"/></div>
               
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