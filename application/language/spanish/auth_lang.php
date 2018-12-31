<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
* 
* Author: Josue Ibarra
*         @josuetijuana
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  Spanish language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Este formulario no pasó nuestras pruebas de seguridad.';

// Login
$lang['login_heading']         = 'Ingresar';
$lang['login_subheading']      = 'Por favor, introduce tu email/usuario y contraseña.';
$lang['login_identity_label']  = 'Email/Usuario:';
$lang['login_password_label']  = 'Contraseña:';
$lang['login_remember_label']  = 'Recuérdame:';
$lang['login_submit_btn']      = 'Ingresar';
$lang['login_forgot_password'] = '¿Has olvidado tu contraseña?';

// Index
$lang['index_heading']           = 'Usuarios';
$lang['index_subheading']        = 'Debajo está la lista de usuarios.';
$lang['index_fname_th']          = 'Nombre';
$lang['index_lname_th']          = 'Apellidos';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Grupos';
$lang['index_status_th']         = 'Estado';
$lang['index_action_th']         = 'Acción';
$lang['index_active_link']       = 'Desactivar';
$lang['index_inactive_link']     = 'Activar';
$lang['index_create_user_link']  = 'Crear nuevo usuario';
$lang['index_create_group_link'] = 'Crear nuevo grupo';

// Deactivate User
$lang['deactivate_heading']                  = 'Desactivar usuario';
$lang['deactivate_subheading']               = '¿Estás seguro que quieres desactivar el usuario \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Sí:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Enviar';
$lang['deactivate_validation_confirm_label'] = 'confirmación';
$lang['deactivate_validation_user_id_label'] = 'ID de usuario';

// Create User
$lang['create_user_heading']                           = 'Registro';
$lang['create_user_subheading']                        = 'Por favor, introduzca la información del usuario.';
$lang['create_user_nombre_label']                      = 'Nombre:';
$lang['create_user_apellidopat_label']                 = 'Apellido paterno:';
$lang['create_user_apellidomat_label']                 = 'Apellido materno:';
$lang['create_user_id_u_administrativa_label']         = ' Unidad Administrativa o Institución de la Secretaría de Cultura:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_company_label']                     = 'Compañía:';
$lang['create_user_email_label']                       = 'Correo institucional:';
$lang['create_user_vc_correo_ext_label']               = 'Correo externo:';
$lang['create_user_telefono_label']                    = 'Teléfono:';
$lang['create_user_tel_ext_label']                     = 'Extensión:';
$lang['create_user_cargo_label']                       = 'Cargo en la institución:';
$lang['create_user_password_label']                    = 'Contraseña:';
$lang['create_user_password_confirm_label']            = 'Confirmar contraseña:';
$lang['create_user_submit_btn']                        = 'Crear Usuario';
$lang['create_user_submit_registro_btn']                        = 'Registrar';
$lang['create_user_validation_nombre_label']           = 'Nombre';
$lang['create_user_validation_apellidopat_label']      = 'Apellido paterno:';
$lang['create_user_validation_apellidomat_label']      = 'Apellido materno:';
$lang['create_user_validation_id_u_administrativa_label']            = 'Unidad administrativa:';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Correo institucional';
$lang['create_user_validation_telefono_label']            = 'Teléfono';
$lang['create_user_validation_extension_label']            = 'Teléfono';
$lang['create_user_validation_cargo_label']            = 'Cargo';
$lang['create_user_validation_company_label']          = 'Nombre de la compañía';
$lang['create_user_validation_password_label']         = 'Contraseña';
$lang['create_user_validation_password_confirm_label'] = 'Confirmación de contraseña';

// Edit User
$lang['edit_user_heading']                           = 'Editar Usuario';
$lang['edit_user_perfil']                           = 'Editar Perfil';
$lang['edit_user_subheading']                        = 'Por favor introduzca la nueva información del usuario.';
$lang['edit_user_subheading_perfil']                        = 'Por favor si desea actualice su perfil.';
$lang['edit_user_nombre_label']                      = 'Nombre:';
$lang['edit_user_apellidopat_label']                 = 'Apellido paterno:';
$lang['edit_user_apellidomat_label']                 = 'Apellido materno:';
$lang['edit_user_id_u_administrativa_label']         = 'Unidad administrativa:';
$lang['edit_user_email_label']                       = 'Correo institucional:';
$lang['edit_user_vc_correo_ext_label']               = 'Correo externo:';
$lang['edit_user_telefono_label']                    = 'Teléfono:';
$lang['edit_user_tel_ext_label']                     = 'Extensión:';
$lang['edit_user_cargo_label']                       = 'Cargo en la institución:';
$lang['edit_user_password_label']                    = 'Contraseña: (si quieres cambiarla)';
$lang['edit_user_password_confirm_label']            = 'Confirmar contraseña: (si quieres cambiarla)';
$lang['edit_user_groups_heading']                    = 'Miembro de grupos';
$lang['edit_user_submit_btn']                        = 'Guardar Usuario';
$lang['edit_user_validation_nombre_label']           = 'Nombre';
$lang['edit_user_validation_apellidopat_label']      = 'Apellido paterno:';
$lang['edit_user_validation_apellidomat_label']      = 'Apellido materno:';
$lang['edit_user_validation_id_u_administrativa_label']            = 'Unidad administrativa:';
$lang['edit_user_validation_email_label']            = 'Correo electrónico';
$lang['edit_user_validation_phone_label']            = 'Teléfono';
$lang['edit_user_validation_company_label']          = 'Compañía';
$lang['edit_user_validation_groups_label']           = 'Grupos';
$lang['edit_user_validation_password_label']         = 'Contraseña';
$lang['edit_user_validation_password_confirm_label'] = 'Confirmación de contraseña';

// Create Group
$lang['create_group_title']                  = 'Crear Grupo';
$lang['create_group_heading']                = 'Crear Grupo';
$lang['create_group_subheading']             = 'Por favor introduce la información del grupo.';
$lang['create_group_name_label']             = 'Nombre de Grupo:';
$lang['create_group_desc_label']             = 'Descripción:';
$lang['create_group_submit_btn']             = 'Crear Grupo';
$lang['create_group_validation_name_label']  = 'Nombre de Grupo';
$lang['create_group_validation_desc_label']  = 'Descripcion';

// Edit Group
$lang['edit_group_title']                  = 'Editar Grupo';
$lang['edit_group_saved']                  = 'Grupo Guardado';
$lang['edit_group_heading']                = 'Editar Grupo';
$lang['edit_group_subheading']             = 'Por favor, registra la informacion del grupo.';
$lang['edit_group_name_label']             = 'Nombre de Grupo:';
$lang['edit_group_desc_label']             = 'Descripción:';
$lang['edit_group_submit_btn']             = 'Guardar Grupo';
$lang['edit_group_validation_name_label']  = 'Nombre de Grupo';
$lang['edit_group_validation_desc_label']  = 'Descripción';

// Change Password
$lang['change_password_heading']                               = 'Cambiar Contraseña';
$lang['change_password_old_password_label']                    = 'Antigua Contraseña:';
$lang['change_password_new_password_label']                    = 'Nueva Contraseña (de al menos %s caracteres de longitud):';
$lang['change_password_new_password_confirm_label']            = 'Confirmar Nueva Contraseña:';
$lang['change_password_submit_btn']                            = 'Cambiar';
$lang['change_password_validation_old_password_label']         = 'Antigua Contraseña';
$lang['change_password_validation_new_password_label']         = 'Nueva Contraseña';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirmar Nueva Contraseña';

// Forgot Password
$lang['forgot_password_heading']                 = 'He olvidado mi Contraseña';
$lang['forgot_password_subheading']              = 'Por favor, introduce tu dirección de correo electrónico para que podamos enviarte un email para restablecer tu contraseña.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Enviar';
$lang['forgot_password_validation_email_label']  = 'Correo Electrónico';
$lang['forgot_password_username_identity_label'] = 'Usuario';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'El correo electrónico no existe.';

// Reset Password
$lang['reset_password_heading']                               = 'Cambiar Contraseña';
$lang['reset_password_new_password_label']                    = 'Nueva Contraseña (de al menos %s caracteres de longitud):';
$lang['reset_password_new_password_confirm_label']            = 'Confirmar Nueva Contraseña:';
$lang['reset_password_submit_btn']                            = 'Guardar';
$lang['reset_password_validation_new_password_label']         = 'Nueva Contraseña';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirmar Nueva Contraseña';

// Activation Email
$lang['email_activate_heading']    = 'Bienvenido al Sistema de Administración de Proyectos: %s';
$lang['email_activate_subheading'] = 'Antes de comenzar necesitas activar tu cuenta:  %s';
$lang['email_activate_link']       = 'activar tu cuenta';
$lang['email_activate_texto'] = 'Haz clic en el siguiente enlace, si no funciona, copia y pega el enlace en tu navegador Web:';
$lang['email_activate_pie'] = "Cualquier duda que tengas, no dudes en contactarnos, estamos para ayudarte.";

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Reestablecer contraseña para %s';
$lang['email_forgot_password_subheading'] = 'Por favor ingresa en este link para %s.';
$lang['email_forgot_password_link']       = 'Restablecer Tu Contraseña';

// New Password Email
$lang['email_new_password_heading']    = 'Nueva contraseña para %s';
$lang['email_new_password_subheading'] = 'Tu contraseña ha sido restablecida a: %s';
