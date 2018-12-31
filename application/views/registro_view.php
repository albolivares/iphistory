<?php $this->load->view('cabeza'); ?>
<div class="row">
    <h1 class="12u">
        <?php echo lang('create_user_heading');?>
    </h1>
    <h2 class="12u  n-pad-top  n-mar-bottom">
        <?php echo lang('create_user_subheading');?>
    </h2>

    <div class="12u" id="infoMessage">
        <?php echo $message;?>
    </div>
</div>
<?php echo form_open("auth/registro");?>
<div class="cont-form row">
    <div class="4u 12u(narrow) obl">
        <?php echo lang('create_user_nombre_label', 'VC_NOMBRE');?>
        <?php echo form_input($vc_nombre);?>
    </div>

    <div class="4u 12u(narrow) obl">
        <?php echo lang('create_user_apellidopat_label', 'VC_APELLIDO_PAT');?>
        <?php echo form_input($vc_apellido_pat);?>
    </div>

    <div class="4u 12u(narrow) ">
        <?php echo lang('create_user_apellidomat_label', 'VC_APELLIDO_MAT');?>
        <?php echo form_input($vc_apellido_mat);?>
    </div>
    <div class="12u ">
        <?php echo lang('create_user_id_u_administrativa_label', 'ID_U_ADMINISTRATIVA');?>
        
        <select name="id_u_administrativa">
          
        <option value="">Selecciona la Institución o Unidad Administrativa de la Secretaría de Cultura</option>
        <?php
            $cont_int=0;
						$cont_ua=0;
						
            foreach($u_administrativa as $v)
            {

							 if($v->ES_INSTITUCION==0 && $cont_ua==0) echo '<optgroup label="Unidad Administrativa">';
							 if($v->ES_INSTITUCION==1 && $cont_int==0) { echo '</optgroup><optgroup label="Institituciones">'; $cont_int=$cont_int+1;}
							 echo '<option value="'.$v->ID.'">'.$v->VC_NOMBRE.'</option>';

							 $cont_ua=$cont_ua+1;

            }
						echo '</optgroup>';
				?>		
        </select>
      <?php
            
            foreach($u_administrativa as $v)
            {
               $opciones[$v->ID] = $v->VC_NOMBRE;  
            }
              $options = array(              
                  $opciones
                );
            array_unshift($opciones, "Selecciona la Institución o Unidad Administrativa de la Secretaría de Cultura" ); 

              //$shirts_on_sale = array('small', 'large');
        //var_dump($options) ;

              //echo form_dropdown('id_u_administrativa', $opciones, '0');
?>
    </div>
    <div class="8u 8u(narrow) obl">
        <?php echo lang('create_user_telefono_label', 'VC_TELEFONO');?>
        <?php echo form_input($vc_telefono);?>
    </div>
    <div class="4u 4u(narrow)">
        <?php echo lang('create_user_tel_ext_label', 'VC_EXTENSION');?>
        <?php echo form_input($vc_extension);?>
    </div>
    <?php
      if($identity_column!=='VC_CORREO') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br>';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>
        <div class="7u 12u(narrow) obl">

            <div class="12u">
                <?php echo lang('create_user_email_label', 'VC_CORREO');?>
            </div>
            <div class="6u 6u(narrow) n-pad-top float-l">


                <?php echo form_input($vc_correo);?>

            </div>
            <div class="6u 6u(narrow) n-pad-top float-l">
                <select id="vc_correo2" name="vc_correo2">
                <option value="@cultura.gob.mx">@cultura.gob.mx</option>
                <option value="@inah.gob.mx">@inah.gob.mx</option>
              </select>

            </div>
        </div>
        <input type="hidden" id="vc_correoh" name="vc_correoh" value="" />
        <div class="5u 12u(narrow)">
            <?php echo lang('create_user_vc_correo_ext_label', 'VC_CORREO_EXT');?>
            <?php echo form_input($vc_correo_ext);?>
        </div>
        <div class="clear"></div>
        <!--  <div class="12u">
            <?php //echo lang('create_user_cargo_label', 'VC_CARGO');?>
            <?php //echo form_input($vc_cargo);?>
        </div>-->

        <div class="6u 12u(narrow) obl">
            <?php echo lang('create_user_password_label', 'password');?>
            <?php echo form_input($password);?>
        </div>

        <div class="6u 12u(narrow) obl">
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
            <?php echo form_input($password_confirm);?>
        </div>


        <div class="12u btn-submit">
           <p class="obl"> <span>*</span> Estos campos son obligatorios</p>
            <?php echo form_submit('submit', lang('create_user_submit_registro_btn'));?>
        </div>
</div>
<?php echo form_close();?>

<?php $this->load->view('pie'); ?>