<?php $this->load->view('auth/cabeza'); ?>
<h1><?php echo lang('edit_user_heading');?></h1>
<div class="row">
<div id="infoMessage"><?php echo $message;?></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
                    <h2><?php echo lang('edit_user_subheading');?></h2>
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
<?php echo form_open(uri_string(), 'class="form-horizontal form-label-left"');?>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_nombre_label', 'VC_NOMBRE',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_nombre);?>
            </div>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_apellidopat_label', 'VC_APELLIDO_PAT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'))?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_apellido_pat);?>
            </div>
      </div>
      
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_apellidomat_label', 'VC_APELLIDO_MAT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_apellido_mat);?>
            </div>
      </div>      
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_id_u_administrativa_label', 'ID_U_ADMINISTRATIVA',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
            $opciones=''; $options='';
            foreach($u_administrativa as $v)
            {
               $opciones[$v->ID] = $v->VC_NOMBRE;  
            }
              if($opciones) { $options = array(              
                  $opciones
                ); }

              //$shirts_on_sale = array('small', 'large');

              if($options) echo form_dropdown('id_u_administrativa', $options, $id_u_administrativa,array('class'=>'control-label col-md-7 col-sm-7 col-xs-12'));
?></div>
      </div>
       <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_telefono_label', 'VC_TELEFONO',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_telefono);?>
            </div>
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_tel_ext_label', 'VC_EXTENSION',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_extension);?>
            </div>
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_vc_correo_ext_label', 'VC_CORREO_EXT',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
            <?php echo form_input($vc_correo_ext);?>
            </div>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('create_user_cargo_label', 'VC_CARGO',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($vc_cargo);?>
            </div>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_password_label', 'password',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?> 
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($password);?>
            </div>
      </div>

      <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12'));?>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo form_input($password_confirm);?>
            </div>
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12 checkbox">
      <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['ID'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->ID) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['ID'];?>"<?php echo $checked;?>>
              <?php echo htmlspecialchars($group['NOMBRE'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

      <?php endif ?>
     </div>
      <?php echo form_hidden('id', $user->ID);?>
      <?php echo form_hidden($csrf); ?>
       <div class="ln_solid"></div>
      <div class="form-group"> 
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"');?>
        </div>
      </div>

<?php echo form_close();?>

</div>
  </div>
</div>
</div>
<?php $this->load->view('auth/pie'); ?>