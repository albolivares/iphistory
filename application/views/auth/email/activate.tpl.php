<html>
<body>
	<h3><?php echo sprintf(lang('email_activate_heading'), $NOMBRE);?></h3>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $ID .'/'. $ACTIVATION_CODE, lang('email_activate_link')));?></p>
	<p><?php echo lang('email_activate_texto').  anchor('auth/activate/'. $ID .'/'. $ACTIVATION_CODE)?></p>
	<p>En caso de no haber solicitado la activación de tu cuenta, favor de hacer caso omiso.</p>
	<p><?php echo lang('email_activate_pie');?></p>
</body>
</html>