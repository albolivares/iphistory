<?php $this->load->view('cabeza'); ?>
<div class="row">
    <h1 class="12u">
        <?php echo lang('login_heading');?>
    </h1>
    <h2 class="12u  n-pad-top  n-mar-bottom">
        <?php echo lang('login_subheading');?>
    </h2>


    <div class="12u no-pad" id="infoMessage" class="alert alert-danger">
        <?php echo $message;?>
    </div>
</div>
<div class="cont-row">
    <?php echo form_open("auth/login");?>

    <div class="6u 12u(narrow) obl">
        <?php echo lang('login_identity_label', 'identity');?>
        <?php echo form_input($identity);?>
    </div>

    <div class="6u 12u(narrow) obl">
        <?php echo lang('login_password_label', 'password');?>
        <?php echo form_input($password);?>
    </div>
<p class="12u obl"> <span>*</span> Estos campos son obligatorios</p>
    <div class="6u 12u(narrow) recuerdame">
        <?php echo lang('login_remember_label', 'remember');?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
    </div>


    <div class="6u 12u(narrow) n-pad-top">
        <?php echo form_submit('submit', lang('login_submit_btn'));?>
        <p>
            <a href="forgot_password">
                <?php echo lang('login_forgot_password');?>
            </a>
        </p>
    </div>

    <?php echo form_close();?>


</div>
<?php $this->load->view('pie'); ?>