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
    	<h2>Historía: <small><?=($acc=='nvo') ? echo 'Agregar nuevo registro' : echo 'Editar registro' ?> </small></h2>     <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
    </div>

<div class="x_content">
	<div class="stepContainer" >
    
	<form action="<?=($acc=='nvo') ? base_url() . 'historia/nuevo/' : base_url() . 'historia/editar/'.$id_obj ?>" id="arqForm2" method="post" enctype="multipart/form-data" accept-charset="utf-8" ><input type="hidden" id="base_url" value="<?=base_url()?>">
	<input type="hidden" id="id_obj" name="id_obj" value="<?=$id_obj?>">
	
	<div id="step-1" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title">Ficha básica</h3></div>

	<div class="panel-body">
	<div class="col-md-3 col-sm-6 col-xs-12">
		<label for="numero_catalogo">Numero de catálogo</label>
			<?php echo form_input($numero_catalogo);?><div class="help-block with-errors"></div></div>

	<div class="col-md-3 col-sm-6 col-xs-12">
	<label for="numero_inventario">Estatus</label>
		<?php $options = array(
        '0'         => 'No publicado',
        '1'           => 'Publicado');
		echo form_dropdown('estatus', $options, '0'); die;?><div class="help-block with-errors"></div>
			
	</div>

	<div class="col-md-3 col-sm-6 col-xs-12">
	<label for="catalogo_anterior">Catálogo anterior</label>
	<?php echo form_input($catalogo_anterior);?><div class="help-block with-errors"></div>
	</div>
	<div class="col-md-3  col-sm-6 col-xs-12">
		<label for="otros_numeros">Otros números</label>
		<?php echo form_input($otros_numeros);?><div class="help-block with-errors"></div>
	</div>

	<div class="col-md-6  col-sm-12 col-xs-12">
		<label for="tarjeta_catalogo">Tarjetas de catálogo</label>
		<?php echo form_input($tarjeta_catalogo);?><div class="help-block with-errors"></div>
	</div>

	<div class="col-md-6  col-sm-12 col-xs-12">
	<label for="tarjeta_catalogo">* Folio real SURPMZAH (DRPMZAH)</label>
		<?php echo form_input($folio_sur);?><div class="help-block with-errors"></div>
	</div>
	</div><!--.panel-body-->		
  </div><!--#step-1-->	

  <div id="step-2" class="panel panel-default" >
		<div class="panel-heading"><h3 class="panel-title">Ubicación</h3></div>
		
		<div class="panel-body">

		<div class="col-md-4  col-sm-12 col-xs-12">
		<label>* Tipo de objeto:&nbsp;</label>
	
		<input type="radio" name="tipo_obj" class="form-control"  value="1" id="tipo_obj_1" <?=($tipo_obj==1) ? ' checked="" ':""; ?>   > 
		Objeto unitario          
		<input type="radio"  name="tipo_obj" class="form-control" value="2" id="tipo_obj_2" <?=($tipo_obj==2) ? ' checked="" ':""; ?>  >
		Lote <input type="radio"  name="tipo_obj" class="form-control"  value="3" id="tipo_obj_3"   >
		Conjunto

		
		</div>	

		<div class="col-md-4  col-sm-6 col-xs-12">
		<label>Cantidad de piezas:&nbsp;</label>
		<?php echo form_input($piezas_lote);?><div class="help-block with-errors"></div>
		</div>	

		<div class="col-md-4  col-sm-12 col-xs-12">
		<label>* Ubicación:&nbsp;</label>

		<select id="ubicacion" name="ubicacion" type="select" class="form-control">
		<option>--Selecciona la ubicación-</option>
		<?php
		foreach($rsUbicacion as $ubi) { ($idUbica==$ubi->id) ? $selp=' selected="selected" ': $selp=''; 
		echo '<option select '.$selp.' value="'.$ubi->id.'">'.$ubi->ubicacion.'</option>'; } ?>
		</select><div class="help-block with-errors"></div>
		</div>	


		<div class="col-md-3 col-sm-6 col-xs-12">
		<label for="sala">Sala:</label>
		<select id="sala" name="sala" type="select" class="form-control">
		<option>--Selecciona la sala-</option>
		<?php
		foreach($rsSala as $sala) { ($idSala==$sala->id) ? $selp=' selected="selected" ': $selp='';   
		echo '<option '.$selp.' value="'.$sala->id.'">'.$sala->sala.'</option>'; } ?>
		</select><div class="help-block with-errors"></div>

		</div>

		<div class="col-md-3 col-sm-6 col-xs-12">
		<label for="vitrina">Vitrina:</label>
		<?php echo form_input($vitrina);?><div class="help-block with-errors"></div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
		<label for="no_objeto">No. Objeto:</label>
		<?php echo form_input($no_objeto);?><div class="help-block with-errors"></div>
		</div>		
		<div class="col-md-3 col-sm-6 col-xs-12">
		<label for="pieza_s">Pieza suelta:</label>
		<?php echo form_input($pieza_s);?><div class="help-block with-errors"></div>
		</div>
	</div><!--.panel-body-->
	</div><!--#step-2-->
<div id="step-3"  class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title">Datos técnicos</h3></div>

   <div class="panel-body">	
	<div class="col-md-6  col-sm-6 col-xs-12">
	<label>* Tipo de objeto:&nbsp;</label>

	<select id="tipo" name="tipo" type="select" class="form-control">
	<option>--Selecciona el tipo-</option>
	<?php
	foreach($rsTipo as $tipo) { ($idTipo==$tipo->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$tipo->id.'">'.$tipo->tipo.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>


	<div class="col-md-6  col-sm-6 col-xs-12">
	<label>* Forma:&nbsp;</label>

	<select id="forma" name="forma" type="select" class="form-control">
	<option>--Selecciona la forma-</option>
	<?=$llenaForma?>
	</select><div class="help-block with-errors"></div>
	</div>



<?php if($rsMats) { $cont_mats=1; foreach ($rsMats as $key => $matlist) { ?>
	<div id="input<?=$cont_mats?>" class="clonedInput">

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Materia prima </label>

		<select id="materia_<?=$cont_mats?>" name="materia_<?=$cont_mats?>" type="select" class="sel_materia form-control" >
		<option>--Selecciona materia prima--</option>
		<?php
		foreach($rsMateria as $materia) { ($matlist->id_matprima==$materia->id) ? $selp=' selected="selected" ': $selp='';  
		echo '<option '.$selp.' value="'.$materia->id.'">'.$materia->matprima.'</option>'; } ?>
		</select><div class="help-block with-errors"></div>
		</div>	

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Tipo de materia prima <?=$cont_mats?></label>

		<select id="matsub_<?=$cont_mats?>" name="matsub_<?=$cont_mats?>" type="select" class="form-control sel_manufactura">
		<option>--Selecciona el tipo--</option>
		<?php echo $arr_sub[$cont_mats];  ?>
		</select><div class="help-block with-errors"></div>
		</div>

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Técnica de manufactura</label>

		<select id="manufacura_<?=$cont_mats?>" name="manufacura_<?=$cont_mats?>" type="select" class="form-control sel_manufactura">
		<option>--Selecciona la manufacura--</option>
		<?php echo $arr_man[$cont_mats]; ?>
		</select><div class="help-block with-errors"></div>
		</div>


		<div class="col-md-3  col-sm-6 col-xs-12 ">
		<label>* Técnica de acabado y/o decoración</label>

		<select id="acabado_<?=$cont_mats?>" name="acabado_<?=$cont_mats?>" type="select" class="form-control sel_acabado">
		<option>--Selecciona el acabado--</option>
		<?php echo $arr_acab[$cont_mats]; ?>
		</select><div class="help-block with-errors"></div>
		</div>	
	</div>
<?php $cont_mats=$cont_mats+1;} } else{ ?>
<div id="input1" class="clonedInput">

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Materia prima</label>

		<select id="materia_1" name="materia_1" type="select" class="sel_materia form-control" >
		<option>--Selecciona materia prima--</option>
		<?php
		foreach($rsMateria as $materia) {  $selp=''; 
		echo '<option '.$selp.' value="'.$materia->id.'">'.$materia->matprima.'</option>'; } ?>
		</select><div class="help-block with-errors"></div>
		</div>	

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Tipo de materia prima</label>

		<select id="matsub_1" name="matsub_1" type="select" class="form-control sel_manufactura">
		<option>--Selecciona el tipo--</option>
		</select><div class="help-block with-errors"></div>
		</div>

		<div class="col-md-3  col-sm-6 col-xs-12">
		<label>* Técnica de manufactura</label>

		<select id="manufacura_1" name="manufacura_1" type="select" class="form-control sel_manufactura">
		<option>--Selecciona la manufacura--</option>
		</select><div class="help-block with-errors"></div>
		</div>


		<div class="col-md-3  col-sm-6 col-xs-12 ">
		<label>* Técnica de acabado y/o decoración</label>

		<select id="acabado_1" name="acabado_1" type="select" class="form-control sel_acabado">
		<option>--Selecciona el acabado--</option>
		</select><div class="help-block with-errors"></div>
		</div>	
	</div>
<?php } ?>	


<div class="col-md-3  col-sm-6 col-xs-3 col-md-offset-9" style="text-align: right;"  >
		<label><br/></label><br/>	
		<input type="button" id="btnAddPrima" value="+ Agregar otra materia prima"  class="btn btn-default"/></div>

	
</div><!--.panel-body-->
</div><!--.setp-3-->


   <div id="step-4" class="panel panel-default" >
		<div class="panel-heading"><h3 class="panel-title">Procedencia</h3></div>
        <div class="panel-body">                
     <div class="col-md-6  col-sm-6 col-xs-12">
	<label>* Región Cultural:&nbsp;</label>

	<select id="region" name="region" type="select" class="form-control">
	<option>--Selecciona la region-</option>
	<?php
	foreach($rsRegion as $region) { ($idRegion==$region->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$region->id.'">'.$region->region.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>



	<div class="col-md-6  col-sm-6 col-xs-12">
	<label>* Subregión:&nbsp;</label>

	<select id="subregion" name="subregion" type="select" class="form-control">
	<option>--Selecciona la subregión-</option>
	<?=$llenaSubRegion?>
	</select><div class="help-block with-errors"></div>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
	<label for="sitio_arq">Sitio arqueológico:</label>
	<?php echo form_input($sitio_arq);?><div class="help-block with-errors"></div>
	</div>

	<div class="col-md-12 col-xs-12">
		<div class="form-group">
		<label>Lugar de procedencia:</label><br/>
		<?php echo form_textarea($procedencia);?><div class="help-block with-errors"></div>
		</div>
	</div> 

	<div class="col-md-12  col-sm-12 col-xs-12">
	<p class="text-muted font-13 m-b-30">
	<br/>Filiación cultural
	</p><hr/></div>		


		<div class="col-md-6  col-sm-6 col-xs-12">
	<label>*  Horizonte cronológico:&nbsp;</label>

	<select id="horizonte" name="horizonte" type="select" class="form-control">
	<option>--Selecciona el horizonte cronológico--</option>
	<?php
	foreach($rsHorizonte as $horizonte) { ($idHorizcron==$horizonte->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$horizonte->id.'">'.$horizonte->horizonte.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>


	<div class="col-md-6  col-sm-6 col-xs-12">
	<label>Estilo:&nbsp;</label>

	<select id="estilo" name="estilo" type="select" class="form-control">
	<option>--Selecciona el Estilo-</option>
	<?php
	foreach($rsEstilo as $estilo) { ($idEstilo==$estilo->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$estilo->id.'">'.$estilo->nombre.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>


	<div class="col-md-6  col-sm-6 col-xs-12">
	<label>Cultura:&nbsp;</label>

	<select id="cultura" name="cultura" type="select" class="form-control">
	<option>--Selecciona la cultura-</option>
	<?php
	foreach($rsCultura as $cultura) { ($idCultura==$cultura->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$cultura->id.'">'.$cultura->cultura.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>


<div class="col-md-6  col-sm-6 col-xs-12">
	<label>Época:&nbsp;</label>

	<select id="epoca" name="epoca" type="select" class="form-control">
	<option>--Selecciona la época-</option>
	<?php
	foreach($rsEpoca as $epoca) { ($idEpoca==$epoca->id) ? $selp=' selected="selected" ': $selp='';   
	echo '<option '.$selp.' value="'.$epoca->id.'">'.$epoca->epoca.'</option>'; } ?>
	</select><div class="help-block with-errors"></div>
	</div>

</div><!--.panel-body-->
</div><!--#step-4-->

<div id="step-5" class="panel panel-default" >
	<div class="panel-heading"><h3 class="panel-title">Dimensiones</h3></div>
    <div class="panel-body">                

      	<div class="col-md-6  col-sm-6 col-xs-12" style="margin-left: 0; padding-left: 0">
      	<label>*  Mínima:&nbsp;</label><hr/>	

      	<?php /*Array ( [0] => stdClass Object ( [id] => 2 [id_medida] => 1 [id_unidad] => 4 [id_base] => 4 [magnitud] => 1 [es_minimo] => 0 [id_tipocol] => 1 [usu_crea] => 1 [fch_crea] => 2018-12-11 01:07:19 [usu_modifica] => 0 [fch_modifica] => 0000-00-00 00:00:00 ) ) */ ?>
      	<?php  if($rsMeds1)	{ $cont_meds1=1; foreach ($rsMeds1 as $key => $medlist) {  ?>
		<div id="medida<?=$cont_meds1?>" class="clonedMedida" style="margin-left: 0; padding-left: 0">

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Tipo:&nbsp;</label>

			<select id="medida_<?=$cont_meds1?>" name="medida_<?=$cont_meds1?>" type="select" class="form-control">
			<option>--</option>
			<?php
			foreach($rsMedidas as $medida) { ($medlist->id_medida==$medida->id) ? $selp=' selected="selected" ': $selp='';  
			echo '<option '.$selp.' value="'.$medida->id.'">'.$medida->medida.'</option>'; } ?>
			</select><div class="help-block with-errors"></div>
			</div>

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Valor:&nbsp;</label>
			<input type="text" name="medida_val_<?=$cont_meds1?>" value="<?=$medlist->magnitud?>" id="medida_val_<?=$cont_meds1?>" class="form-control">	
			<div class="help-block with-errors"></div>
			</div>		

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Unidad:&nbsp;</label>

			<select id="unidad_<?=$cont_meds1?>" name="unidad_<?=$cont_meds1?>" type="select" class="form-control">
			<option>--</option>
			<?php
			foreach($rsUnidades as $unidad) { ($medlist->id_unidad==$unidad->id) ? $selp=' selected="selected" ': $selp='';  
			echo '<option '.$selp.' value="'.$unidad->id.'">'.$unidad->unidad.'</option>'; } ?>
			</select><div class="help-block with-errors"></div>
			</div>
		</div>
		<?php $cont_meds1=$cont_meds1+1; }  } 
		else { 
			?>
			<div id="medida1" class="clonedMedida" style="margin-left: 0; padding-left: 0">

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Tipo:&nbsp;</label>

			<select id="medida_1" name="medida_1" type="select" class="form-control">
			<option>--</option>
			<?php
			foreach($rsMedidas as $medida) { $selp=''; 
			echo '<option '.$selp.' value="'.$medida->id.'">'.$medida->medida.'</option>'; } ?>
			</select><div class="help-block with-errors"></div>
			</div>

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Valor:&nbsp;</label>
			<?php //echo form_input($medida_val_1);?>
				<input type="text" name="medida_val_1"  id="medida_val_1" class="form-control">	
			<div class="help-block with-errors"></div>
			</div>		

			<div class="col-md-4  col-sm-4 col-xs-12">
			<label>Unidad:&nbsp;</label>

			<select id="unidad_1" name="unidad_1" type="select" class="form-control">
			<option>--</option>
			<?php
			foreach($rsUnidades as $unidad) { $selp=''; 
			echo '<option '.$selp.' value="'.$unidad->id.'">'.$unidad->unidad.'</option>'; } ?>
			</select><div class="help-block with-errors"></div>
			</div>
		</div>
		<?php } ?>	
		
		<div class="col-md-2  col-sm-2 col-xs-2" style="text-align: right;"  >
			<label><br/></label><br/>
			<input type="button" id="btnAddMedida" value="+ Agregar medida"  class="btn btn-default"/>

		</div>


		</div>	

		<div class="col-md-6  col-sm-6 col-xs-12" >
		<label>Máxima (Opcional):&nbsp;</label><hr/>	

		</div>	

	</div><!--panel-body-->
</div><!--#step-5-->	


<div id="step-6" class="panel panel-default" >
<div class="panel-heading"><h3 class="panel-title">Información</h3></div>
<div class="panel-body">     
	<div class="col-md-12 col-xs-12">
	<div class="form-group">
	<label>* Descripción:</label><br/>
	<?php echo form_textarea($descripcion);?><div class="help-block with-errors"></div>
	</div>
	</div>

	<div class="col-md-12 col-xs-12">
	<div class="form-group">
	<label>Señas particulares:</label><br/>
	<?php echo form_textarea($senias);?><div class="help-block with-errors"></div>
	</div>
	</div>

	<div class="col-md-12 col-xs-12">
	<div class="form-group">
	<label>Nombre(s) con que se conoce al monumento:</label><br/>
	<?php echo form_textarea($nombresm);?><div class="help-block with-errors"></div>
	</div>
	</div>

	<div class="col-md-12 col-xs-12">
	<div class="form-group">
	<label>Estado de conservación:</label><br/>
	<?php echo form_textarea($estado_cons);?><div class="help-block with-errors"></div>
	</div>
	</div>

	<div class="col-md-12 col-xs-12">
	<div class="form-group">
	<label>Observaciones:</label><br/>
	<?php echo form_textarea($observaciones);?><div class="help-block with-errors"></div>
	</div>
	</div>  

	<div class="col-md-12 col-xs-12">
		<div class="form-group">
		<label>Otros datos:</label><br/>
		<?php echo form_textarea($otros_datos);?><div class="help-block with-errors"></div>
		</div>
	</div> 
	</div><!--panel-body-->
</div><!--step-7-->
<div class="col-md-12 col-xs-12">
		<div class="form-group">

		<?php if($puede_modificar) { 
			if($puede_aprobar && $estatusIni==2) echo form_submit('submit', 'Aprobar'," class='control btn btn-default' ");  
			elseif(!$puede_aprobar && $estatusIni==2 ) echo '* En espera de aprobación.'; 
			elseif($estatusIni==1 ){ 
			echo form_submit('submit', 'Guardar'," class='control btn btn-default' ");
			if($act_aprov==2) echo ' | '.form_submit('submit', 'Enviar a validación'," class='control btn btn-default' "); 
			} elseif($estatusIni==3 ){ 
			echo form_submit('submit', 'Guardar'," class='control btn btn-default' ");
			echo form_submit('submit', 'Respaldar'," class='control btn btn-default' ");
			} 
			} 
		?>
		</div>

</div>  

				</form>
 
 		</div><!--.stepContainer-->
        
        </div><!--x-content-->	

       </div><!--.x_panel-->
    </div><!--.col-md-12.col-sm-12.col-xs-12-->      	
</div><!--.right_col