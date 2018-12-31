<?php $this -> load -> view('auth/cabeza');
if ($resultado) {
  $id_sugerencia = $resultado -> ID;
  $titulo = $resultado -> TITULO;
  $estatus = $resultado->ESTATUS;
  $resumen = $resultado->RESUMEN;
  $descripcion = $resultado->DESCRIPCION;
  $fuente = $resultado->FUENTE;
  $url = $resultado->URL;
  $ruta = $resultado->IMAGEN;
} else {
  $id_sugerencia = '';
  $titulo = '';
  $estatus = '';
  $resumen = '';
  $descripcion = '';
  $fuente = '';
  $url = '';
  $ruta = '';
}
?>
<h2>Sugerencia</h2>
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
        <?php echo form_open("sugerencias/" . $accion, 'class="form-horizontal form-label-left"');
        $data = array('id_sugerencia' => $id_sugerencia, );

        echo form_hidden($data);
        $data = array('fch_crea' => date('Y-m-d H:i:s'), );

        echo form_hidden($data);
      ?>
          
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Titulo*:', 'titulo', $attributes);
        $data = array('name' => 'titulo', 'id' => 'titulo', 'value' => $this -> form_validation -> set_value('titulo', $titulo), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Resumen*:', 'resumen', $attributes);
        $data = array('name' => 'resumen', 'id' => 'resumen', 'value' => $this -> form_validation -> set_value('resumen', $resumen), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_textarea($data);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Descripción:', 'descripcion', $attributes);
        $data = array('name' => 'descripcion', 'id' => 'descripcion', 'value' => $this -> form_validation -> set_value('descripcion', $descripcion), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_textarea($data);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Seleccione imagen..</span>
                                            <!-- The file input field used as target for the file upload widget -->
                                            <input id="fileupload" type="file" name="files[]" multiple>
                                            
                                        </span>
                                        <br>
                                        <br>
                                        <!-- The global progress bar -->
                                        <div id="progress" class="progress">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <!-- The container for the uploaded files -->
                                        <div id="files" class="files"><ul class="listaimg">
                                        <input type="hidden" name="ruta" id="ruta" value="<?php echo $ruta?>" />
                                        </ul>
                                          <?php if($ruta!=''){ ?>
                                          <div><a href="<?php echo $ruta?>" target="_blank"><img src="<?php echo $ruta?>" width="100" height="100" /></a></div>
                                          <?php } ?>
                                        </div>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('URL:', 'url', $attributes);
        $data = array('name' => 'url', 'id' => 'url', 'value' => $this -> form_validation -> set_value('url', $url), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Fuente:', 'fuente', $attributes);
        $data = array('name' => 'fuente', 'id' => 'fuente', 'value' => $this -> form_validation -> set_value('fuente', $fuente), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>
        </div>         
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <?php
        $attributes = array('class' => 'control-label col-md-5 col-sm-5 col-xs-12', );
        echo form_label('Estatus*:', 'estatus', $attributes);
        $options = array('' => 'Seleccione', '0' => 'No', '1' => 'Sí');
        echo form_dropdown('estatus', $options, $this -> form_validation -> set_value('estatus', $estatus), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'estatus']);
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