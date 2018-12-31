<?php $this -> load -> view('auth/cabeza');
if (isset($resultado)) {
  $id_cat_tipo_documento = $resultado -> ID;
  $vc_nombre = $resultado -> VC_NOMBRE;
  $requiere_id_proy = $resultado -> REQUIERE_ID_PROY;
  $es_nuevo = $resultado -> ES_NUEVO;
} else {
  $id_cat_tipo_documento = '';
  $vc_nombre = '';
  $requiere_id_proy = '';
  $es_nuevo = '';
}
?>
<h2>Tipo de Solicitud</h2>
<div class="row">
  <?php if(validation_errors()) { ?>
  <div id="infoMessage" class="alert alert-danger"><?php echo validation_errors(); ?></div>
  <?php } ?>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><?php echo $title; ?></h3>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>            
            <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php echo form_open("tipo_solicitud/" . $accion . "/" . $id_cat_tipo_documento, 'class="form-horizontal form-label-left"');
        $data = array('id_cat_tipo_documento' => $id_cat_tipo_documento, );

        echo form_hidden($data);
        $data = array('fch_crea' => date('Y-m-d H:i:s'), );

        echo form_hidden($data);
      ?>
          
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Tipo de solicitud*:', 'vc_nombre', $attributes);
        $data = array('name' => 'vc_nombre', 'id' => 'vc_nombre', 'value' => $this -> form_validation -> set_value('vc_nombre', $vc_nombre), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-4 col-sm-4 col-xs-12', );
        echo form_label('¿Requiere identificador del proyecto?*:', 'requiere_id_proy', $attributes);
        $options = array('' => 'Seleccione', '0' => 'No', '1' => 'Sí');

        //$shirts_on_sale = array('small', 'large');

        echo form_dropdown('requiere_id_proy', $options, $this -> form_validation -> set_value('requiere_id_proy', $requiere_id_proy), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'requiere_id_proy']);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-5 col-sm-5 col-xs-12', );
        echo form_label('¿Es nuevo?*:', 'es_nuevo', $attributes);
        $options = array('' => 'Seleccione', '0' => 'No', '1' => 'Sí');
        echo form_dropdown('es_nuevo', $options, $this -> form_validation -> set_value('es_nuevo', $es_nuevo), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'es_nuevo']);
        ?>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group"> 
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"><?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>
        </div>
      </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?php $this -> load -> view('auth/pie'); ?>