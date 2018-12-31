<?php $this->load->view('auth/cabeza'); 
if (isset($resultado)) {
  $id_servidor = $resultado->ID;
  $ip = $resultado->IP;
  $memoria_ram = $resultado->MEMORIA_RAM;
  $disco_duro = $resultado->DISCO_DURO;
  $sistema_operativo = $resultado->SISTEMA_OPERATIVO;
  $servidor_web = $resultado->SERVIDOR_WEB;
  $motor_bd = $resultado->MOTOR_BD;
  $version_php = $resultado->VERSION_PHP;
  $dominio = $resultado->DOMINIO;
  $estatus = $resultado->ESTATUS;
}else{
  $id_servidor = '';
  $ip = '';
  $memoria_ram = '';
  $disco_duro =  '';
  $sistema_operativo = '';
  $servidor_web = '';
  $motor_bd ='';
  $version_php = '';
  $dominio = '';
  $estatus = '';
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
    <?php echo form_open("servidor/".$accion.'/'.$id_servidor, 'class="form-horizontal form-label-left"');
      $data = array('id_servidor' => $id_servidor, );

        echo form_hidden($data);
        ?>      
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Dirección IP del Servidor*:', 'orden', $attributes);
        $data = array('name' => 'ip', 'id' => 'ip', 'value' => $this -> form_validation -> set_value('ip',$ip), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Dominio:', 'orden', $attributes);
        $data = array('name' => 'dominio', 'id' => 'dominio', 'value' => $this -> form_validation -> set_value('dominio',$dominio), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Memoria RAM:', 'orden', $attributes);
        $data = array('name' => 'memoria_ram', 'id' => 'memoria_ram', 'value' => $this -> form_validation -> set_value('memoria_ram',$memoria_ram), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Capacidad de disco duro*:', 'orden', $attributes);
        $data = array('name' => 'disco_duro', 'id' => 'disco_duro', 'value' => $this -> form_validation -> set_value('disco_duro',$disco_duro), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Sistema operativo*:', 'orden', $attributes);
        $data = array('name' => 'sistema_operativo', 'id' => 'sistema_operativo', 'value' => $this -> form_validation -> set_value('sistema_operativo',$sistema_operativo), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Servidor web*:', 'orden', $attributes);
        $data = array('name' => 'servidor_web', 'id' => 'servidor_web', 'value' => $this -> form_validation -> set_value('servidor_web',$servidor_web), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Motor de base de datos:', 'orden', $attributes);
        $data = array('name' => 'motor_bd', 'id' => 'motor_bd', 'value' => $this -> form_validation -> set_value('motor_bd',$motor_bd), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">            
            <?php
        $attributes = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12', );
        echo form_label('Versión de PHP:', 'orden', $attributes);
        $data = array('name' => 'version_php', 'id' => 'version_php', 'value' => $this -> form_validation -> set_value('version_php',$version_php), 'class' => 'form-control col-md-7 col-xs-12', );
        echo form_input($data);
        ?>            
      </div>
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus</label> <br />
            <?php
              $opciones = array(''=>'Seleccione');
              $options = array(              
                 ''=>'Seleccione', 'ACTIVO'=>'Activo', 'INACTIVO'=>'Inactivo'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('estatus', $options,$estatus, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'estatus']);
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
<?php $this->load->view('auth/pie'); 
?>