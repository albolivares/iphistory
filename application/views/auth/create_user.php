<?php $this->load->view('auth/cabeza'); ?>
<h2><?php echo lang('create_user_heading');?></h2>
<div class="row">
<div id="infoMessage"><?php echo $message;?></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo lang('create_user_subheading');?></h2>
    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
    <?php echo form_open("auth/create_user", 'class="form-horizontal form-label-left"');?>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_nombre_label', 'VC_NOMBRE',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_nombre);?>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_apellidopat_label', 'VC_APELLIDO_PAT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_apellido_pat);?>
      </div>
      
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_apellidomat_label', 'VC_APELLIDO_MAT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_apellido_mat);?>
      </div>      
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_id_u_administrativa_label', 'ID_U_ADMINISTRATIVA',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php
            
            foreach($u_administrativa as $v)
            {
               $opciones[$v->ID] = $v->VC_NOMBRE;  
            }
              $options = array(              
                  $opciones
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('id_u_administrativa', $options, '32');
?>
      </div>
       <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_telefono_label', 'VC_TELEFONO',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_telefono);?>
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_tel_ext_label', 'VC_EXTENSION',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_extension);?>
      </div>
      <?php
      if($identity_column!=='VC_CORREO') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_email_label', 'VC_CORREO',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_correo);?>
      </div>
      
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_vc_correo_ext_label', 'VC_CORREO_EXT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_correo_ext);?>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_cargo_label', 'VC_CARGO',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($vc_cargo);?>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_password_label', 'password',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($password);?>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_password_confirm_label', 'password_confirm',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> <br />
            <?php echo form_input($password_confirm);?>
      </div>
<div class="ln_solid"></div>
      <div class="form-group"> 
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="btn btn-primary"');?>
          
        </div>
      </div>

<?php echo form_close();?>
</div>
  </div>
</div>
</div>
<?php $this->load->view('auth/pie'); ?>
