<?php $this->load->view('auth/cabeza'); 
if (isset($resultado)) {
  $id_tipo_rel = $resultado -> ID;
  $id_tipo_solicitud = $resultado -> ID_TIPO_SOLICITUD;
  $id_cat_documento = $resultado -> ID_CAT_DOCUMENTO;
  $es_obligatorio = $resultado -> ES_OBLIGATORIO;
  $fase = $resultado -> FASE;
  $orden = $resultado -> ORDEN;
} else {
  $id_tipo_rel = '';
  $id_tipo_solicitud = '';
  $id_cat_documento = '';
  $es_obligatorio = '';
  $fase = '';
  $orden = '';
}
?>

<h2><?php //echo lang('create_user_heading');?></h2>
<div class="row">
  <?php if(validation_errors()) { ?>
  <div id="infoMessage" class="alert alert-danger"><?php echo validation_errors(); ?></div>
  <?php } ?>
<div id="infoMessage"><?php //echo $message;?></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $title; ?></h2>
    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
    <?php echo form_open("tipo_rel/".$accion.'/'.$id_tipo_rel, 'class="form-horizontal form-label-left"');
      $data = array('id_tipo_rel' => $id_tipo_rel, );

        echo form_hidden($data);
        ?>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Solicitud</label> <br />
            <?php
            $opciones = array(''=>'Seleccione tipo de solicitud');
            ?>
            <select name="id_tipo_solicitud" id="id_tipo_solicitud" class="form-control col-md-7 col-xs-12">
              <option value="">--Seleccione--</option>
            <?php
            foreach($u_administrativa as $k=>$v)
            {
               ?> 
               <option value="<?php echo $v->ID?>" <?php echo ($id_tipo_solicitud==$v->ID) ? ' selected="selected"':''?>><?php echo $v->VC_NOMBRE?></option>
                <?php
               //$opciones[$k] = array($v->ID => $v->VC_NOMBRE);  
            } 
              //echo form_dropdown('id_tipo_solicitud', $options, $id_tipo_solicitud, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'id_tipo_solicitud']);
?>
</select>
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fase</label> <br />
            <?php
              $options = array(              
                  ''=>'Seleccione fase','A' => 'Solicitud', 'D'=>'Desarrollador', 'G' => 'Gráfico', 'F'=> 'Final'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('fase', $options,$fase, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'fase']);
?>
      </div>
       <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría de documento</label> <br />
            <select name="id_cat_documento" id="id_cat_documento" class="form-control col-md-7 col-xs-12">
              <option value="">--Seleccione--</option>
            <?php
            
            /*$opciones = array(''=>'Seleccione tipo de documento');
            foreach($documentos as $v)
            {
               $opciones[$v->ID] = $v->VC_DOCUMENTO;  
            }
              $options = array(              
                  $opciones
                );

              

              echo form_dropdown('id_cat_documento', $options,$id_cat_documento, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'id_cat_documento']);*/
?>
</select>
      <input type="hidden" name="id_cat_documento1" id="id_cat_documento1" value="<?php echo $id_cat_documento?>" />
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">¿Es obligatorio?</label> <br />
            <?php
              $opciones = array(''=>'Seleccione');
              $options = array(              
                 ''=>'Seleccione', '0'=>'No', '1'=>'Sí'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('es_obligatorio', $options,$es_obligatorio, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'es_obligatorio']);
?>
      </div>
      
      <div class="form-group col-md-1 col-sm-1 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Orden*:', 'orden', $attributes);
        $data = array('name' => 'orden', 'id' => 'orden', 'value' => $this -> form_validation -> set_value('orden',$orden), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="ln_solid"></div>
        <div class="form-group"> 
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"><?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>
        </div>
      </div>
<?php echo form_close();?>
</div>
  </div>
</div>
</div>
<?php $this->load->view('auth/pie'); ?>