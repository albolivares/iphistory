<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
	   
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Debe ser administrador para ver esta página.');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->ID)->result();
			}
      
			$this->_render_page('auth/index', $this->data);
		}
	}

	// log the user in
	function login()
	{
		$this->data['title'] = "Inicio de Sessión";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				//redirect('/auth', 'refresh');
				redirect('/admin/panel/');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->_render_page('auth/login', $this->data);
		}
	}

	// log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	// change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	// forgot password
	function forgot_password()
	{
	  $this->config->item('identity', 'ion_auth'); 
		// setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'VC_CORREO' )
		{
		  //echo '1'; die;
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{		  
		   $this->form_validation->set_rules('VC_CORREO', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			// setup the input
			$this->data['VC_CORREO'] = array('name' => 'VC_CORREO',
				'id' => 'VC_CORREO',
			);
     
			if ( $this->config->item('identity', 'ion_auth') != 'VC_CORREO' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');			
			$this->_render_page('auth/forgot_password', $this->data);
		}
		else
		{
		  
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('VC_CORREO'))->users()->row(); 

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'VC_CORREO')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("auth/forgot_password", 'refresh');
            		}
    
			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});      
			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->ID,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->ID != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));           
					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	// activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	function create_user()
    {
        $this->data['title'] = "Crear Usuario";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('vc_nombre', $this->lang->line('create_user_validation_nombre_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_pat', $this->lang->line('create_user_validation_apellidopat_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_mat', $this->lang->line('create_user_validation_apellidomat_label'),'trim');
        if($identity_column!=='vc_correo')
        {
            //$this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['CONTACTO_U_ADMINISTRATIVA'].'.'.$identity_column.']');
            //$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
            $this->form_validation->set_rules('vc_correo', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['CONTACTO_U_ADMINISTRATIVA'] . '.VC_CORREO]');
            $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }
        else
        {
            $this->form_validation->set_rules('vc_correo', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['CONTACTO_U_ADMINISTRATIVA'] . '.VC_CORREO]');
            $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }
        $this->form_validation->set_rules('vc_telefono', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('vc_extension', $this->lang->line('create_user_validation_extension_label'), 'trim');        
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('vc_correo'));
            $identity = ($identity_column==='vc_correo') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'VC_NOMBRE' => $this->input->post('vc_nombre'),
                'VC_APELLIDO_PAT'  => $this->input->post('vc_apellido_pat'),
                'VC_APELLIDO_MAT'  => $this->input->post('vc_apellido_mat'),
                'VC_TELEFONO'    => $this->input->post('vc_telefono'),
                'VC_EXTENSION'      => $this->input->post('vc_extension'),
                'VC_CORREO_EXT' =>$this->input->post('vc_correo_ext'),
                'VC_CARGO' => $this->input->post('vc_cargo'),
                'ID_U_ADMINISTRATIVA' =>$this->input->post('id_u_administrativa'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['vc_nombre'] = array(
                'name'  => 'vc_nombre',
                'id'    => 'vc_nombre',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_nombre'),
            );
            $this->data['vc_apellido_pat'] = array(
                'name'  => 'vc_apellido_pat',
                'id'    => 'vc_apellido_pat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_pat'),
            );
            $this->data['vc_apellido_mat'] = array(
                'name'  => 'vc_apellido_mat',
                'id'    => 'vc_apellido_mat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_mat'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['vc_correo'] = array(
                'name'  => 'vc_correo',
                'id'    => 'vc_correo',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_correo'),
            );
            
            $this->data['vc_correo_ext'] = array(
                'name'  => 'vc_correo_ext',
                'id'    => 'vc_correo_ext',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_correo_ext'),
            );
            $this->data['vc_telefono'] = array(
                'name'  => 'vc_telefono',
                'id'    => 'vc_telefono',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_telefono'),
            );
            $this->data['vc_extension'] = array(
                'name'  => 'vc_extension',
                'id'    => 'vc_extension',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_extension'),
            );            
            $this->data['vc_cargo'] = array(
                'name'  => 'vc_cargo',
                'id'    => 'vc_cargo',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_cargo'),
            ); 
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
            
            $this->data['u_administrativa'] = $this->ion_auth->getUnidadAdministrativa();

            $this->_render_page('auth/create_user', $this->data);
        }
    }

	// edit a user
	function edit_user($id)
	{
		$this->data['title'] = "Editar Usuario";

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->ID == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
	      $this->form_validation->set_rules('vc_nombre', $this->lang->line('edit_user_validation_nombre_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_pat', $this->lang->line('edit_user_validation_apellidopat_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_mat', $this->lang->line('edit_user_validation_apellidomat_label'),'trim');
		    $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('edit_user_validation_email_label'), 'valid_email');
		    $this->form_validation->set_rules('vc_telefono', $this->lang->line('edit_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('vc_extension', $this->lang->line('edit_user_validation_extension_label'), 'trim');
    //var_dump($_POST); die;
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'VC_NOMBRE' => $this->input->post('vc_nombre'),
                'VC_APELLIDO_PAT'  => $this->input->post('vc_apellido_pat'),
                'VC_APELLIDO_MAT'  => $this->input->post('vc_apellido_mat'),
                'VC_TELEFONO'    => $this->input->post('vc_telefono'),
                'VC_EXTENSION'      => $this->input->post('vc_extension'),
                'VC_CORREO_EXT' =>$this->input->post('vc_correo_ext'),
                'VC_CARGO' => $this->input->post('vc_cargo'),
                'ID_U_ADMINISTRATIVA' =>$this->input->post('id_u_administrativa'),
				);
        
				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['VC_PSWD'] = $this->input->post('password');
				}
				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			
			   if($this->ion_auth->update($user->ID, $data))
			    {
			      //die;
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['vc_nombre'] = array(
                'name'  => 'vc_nombre',
                'id'    => 'vc_nombre',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_nombre',$user->VC_NOMBRE),
            );
            $this->data['vc_apellido_pat'] = array(
                'name'  => 'vc_apellido_pat',
                'id'    => 'vc_apellido_pat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_pat',$user->VC_APELLIDO_PAT),
            );
            $this->data['vc_apellido_mat'] = array(
                'name'  => 'vc_apellido_mat',
                'id'    => 'vc_apellido_mat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_mat',$user->VC_APELLIDO_MAT),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('identity'),
            );
                        
            $this->data['vc_correo_ext'] = array(
                'name'  => 'vc_correo_ext',
                'id'    => 'vc_correo_ext',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_correo_ext',$user->VC_CORREO_EXT),
            );
            $this->data['vc_telefono'] = array(
                'name'  => 'vc_telefono',
                'id'    => 'vc_telefono',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_telefono',$user->VC_TELEFONO),
            );
            $this->data['vc_extension'] = array(
                'name'  => 'vc_extension',
                'id'    => 'vc_extension',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_extension',$user->VC_EXTENSION),
            );            
            $this->data['vc_cargo'] = array(
                'name'  => 'vc_cargo',
                'id'    => 'vc_cargo',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_cargo',$user->VC_CARGO),
            ); 
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'class'=> 'form-control col-md-7 col-xs-12',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'class'=> 'form-control col-md-7 col-xs-12',
			'type' => 'password'
		);
    $this->data['u_administrativa'] = $this->ion_auth->getUnidadAdministrativa();
    $this->data['id_u_administrativa'] = $user->ID_U_ADMINISTRATIVA;
		$this->_render_page('auth/edit_user', $this->data);
	}



   // edit a user
  function editar_perfil($id)
  {
    if($this->ion_auth->get_user_id()!=$id)
    {
      return show_error('Usted no tiene permitido acceder a editar este perfil');  
    }
    
    $this->data['title'] = "Editar Perfil";

    if (!$this->ion_auth->logged_in())
    {
      // redirect them to the login page
      redirect('auth/login', 'refresh');
    }

    $user = $this->ion_auth->user($id)->row();
    $groups=$this->ion_auth->groups()->result_array();
    $currentGroups = $this->ion_auth->get_users_groups($id)->result();

    // validate form input
        $this->form_validation->set_rules('vc_nombre', $this->lang->line('edit_user_validation_nombre_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_pat', $this->lang->line('edit_user_validation_apellidopat_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_mat', $this->lang->line('edit_user_validation_apellidomat_label'),'trim');
        $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('edit_user_validation_email_label'), 'valid_email');
        $this->form_validation->set_rules('vc_telefono', $this->lang->line('edit_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('vc_extension', $this->lang->line('edit_user_validation_extension_label'), 'trim');
    //var_dump($_POST); die;
    if (isset($_POST) && !empty($_POST))
    {
      // do we have a valid request?
      if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
      {
        show_error($this->lang->line('error_csrf'));
      }

      // update the password if it was posted
      if ($this->input->post('password'))
      {
        $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
      }

      if ($this->form_validation->run() === TRUE)
      {
        $data = array(
          'VC_NOMBRE' => $this->input->post('vc_nombre'),
                'VC_APELLIDO_PAT'  => $this->input->post('vc_apellido_pat'),
                'VC_APELLIDO_MAT'  => $this->input->post('vc_apellido_mat'),
                'VC_TELEFONO'    => $this->input->post('vc_telefono'),
                'VC_EXTENSION'      => $this->input->post('vc_extension'),
                'VC_CORREO_EXT' =>$this->input->post('vc_correo_ext'),
                'VC_CARGO' => $this->input->post('vc_cargo'),
                'ID_U_ADMINISTRATIVA' =>$this->input->post('id_u_administrativa'),
        );
        
        // update the password if it was posted
        if ($this->input->post('password'))
        {
          $data['VC_PSWD'] = $this->input->post('password');
        }
        // Only allow updating groups if user is admin
        if ($this->ion_auth->is_admin())
        {
          //Update the groups user belongs to
          $groupData = $this->input->post('groups');

          if (isset($groupData) && !empty($groupData)) {

            $this->ion_auth->remove_from_group('', $id);

            foreach ($groupData as $grp) {
              $this->ion_auth->add_to_group($grp, $id);
            }

          }
        }

      // check to see if we are updating the user
      
         if($this->ion_auth->update($user->ID, $data))
          {
            //die;
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('message', $this->ion_auth->messages() );
            /*if ($this->ion_auth->is_admin())
          {
            redirect('auth', 'refresh');
          }
          else
          {
            redirect('/', 'refresh');
          }*/

          }
          else
          {
            // redirect them back to the admin page if admin, or to the base url if non admin
            $this->session->set_flashdata('message', $this->ion_auth->errors() );
            if ($this->ion_auth->is_admin())
          {
            redirect('auth', 'refresh');
          }
          else
          {
            redirect('/', 'refresh');
          }

          }

      }
    }

    // display the edit user form
    $this->data['csrf'] = $this->_get_csrf_nonce();

    // set the flash data error message if there is one
    $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

    // pass the user to the view
    $this->data['user'] = $user;
    $this->data['groups'] = $groups;
    $this->data['currentGroups'] = $currentGroups;

    $this->data['vc_nombre'] = array(
                'name'  => 'vc_nombre',
                'id'    => 'vc_nombre',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_nombre',$user->VC_NOMBRE),
            );
            $this->data['vc_apellido_pat'] = array(
                'name'  => 'vc_apellido_pat',
                'id'    => 'vc_apellido_pat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_pat',$user->VC_APELLIDO_PAT),
            );
            $this->data['vc_apellido_mat'] = array(
                'name'  => 'vc_apellido_mat',
                'id'    => 'vc_apellido_mat',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_apellido_mat',$user->VC_APELLIDO_MAT),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('identity'),
            );
                        
            $this->data['vc_correo_ext'] = array(
                'name'  => 'vc_correo_ext',
                'id'    => 'vc_correo_ext',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_correo_ext',$user->VC_CORREO_EXT),
            );
            $this->data['vc_telefono'] = array(
                'name'  => 'vc_telefono',
                'id'    => 'vc_telefono',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_telefono',$user->VC_TELEFONO),
            );
            $this->data['vc_extension'] = array(
                'name'  => 'vc_extension',
                'id'    => 'vc_extension',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_extension',$user->VC_EXTENSION),
            );            
            $this->data['vc_cargo'] = array(
                'name'  => 'vc_cargo',
                'id'    => 'vc_cargo',
                'type'  => 'text',
                'class'=> 'form-control col-md-7 col-xs-12',
                'value' => $this->form_validation->set_value('vc_cargo',$user->VC_CARGO),
            ); 
    $this->data['password'] = array(
      'name' => 'password',
      'id'   => 'password',
      'class'=> 'form-control col-md-7 col-xs-12',
      'type' => 'password'
    );
    $this->data['password_confirm'] = array(
      'name' => 'password_confirm',
      'id'   => 'password_confirm',
      'class'=> 'form-control col-md-7 col-xs-12',
      'type' => 'password'
    );
    $this->data['u_administrativa'] = $this->ion_auth->getUnidadAdministrativa();
    $this->data['id_u_administrativa'] = $user->ID_U_ADMINISTRATIVA;
    $this->_render_page('auth/editar_perfil', $this->data);
  }

    function remove(){
    	
    }

	// create a new group
	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->NOMBRE ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->NOMBRE),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->DESCRIPCION),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
  
  // registro
  function registro()
    {
        $this->data['title'] = "Registro de usuarios";
        
        /*if ($this->ion_auth->logged_in())
        {
            redirect('/solicitudes', 'refresh');
        }*/
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;
        // validate form input
        $this->form_validation->set_rules('vc_nombre', $this->lang->line('create_user_validation_nombre_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_pat', $this->lang->line('create_user_validation_apellidopat_label'), 'required');
        $this->form_validation->set_rules('vc_apellido_mat', $this->lang->line('create_user_validation_apellidomat_label'),'trim');
        if($identity_column!=='vc_correo')
        {    $correo = $this->input->post('vc_correo');
             $correo2 = $this->input->post('vc_correo2');
            $valor = $correo.$correo2;
            //$_POST['vc_correoold']=$correo;            
            $_POST['vc_correo']=$valor;
                        
            //$this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['CONTACTO_U_ADMINISTRATIVA'].'.'.$identity_column.']');
            //$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
            $this->form_validation->set_rules('vc_correo', $this->lang->line('create_user_validation_email_label'), 'required|is_unique[' . $tables['CONTACTO_U_ADMINISTRATIVA'] . '.VC_CORREO]');
            $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }
        else
        {
            $correo = $this->input->post('vc_correo');
            $correo2 = $this->input->post('vc_correo2');
            $valor = $correo.$correo2;               
            $_POST['vc_correo']=$valor;                 
            //$this->form_validation->set_value('vc_correo',$valor); 
            $this->form_validation->set_rules('vc_correo', $this->lang->line('create_user_validation_email_label'), 'required|is_unique[' . $tables['CONTACTO_U_ADMINISTRATIVA'] . '.VC_CORREO]');
            $this->form_validation->set_rules('vc_correo_ext', $this->lang->line('create_user_validation_email_label'), 'valid_email');
        }        
        $this->form_validation->set_rules('vc_telefono', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('vc_cargo', $this->lang->line('create_user_validation_cargo_label'), 'trim');
        $this->form_validation->set_rules('vc_extension', $this->lang->line('create_user_validation_extension_label'), 'trim');        
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('vc_correo'));
            $identity = ($identity_column==='vc_correo') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'VC_NOMBRE' => $this->input->post('vc_nombre'),
                'VC_APELLIDO_PAT'  => $this->input->post('vc_apellido_pat'),
                'VC_APELLIDO_MAT'  => $this->input->post('vc_apellido_mat'),
                'VC_TELEFONO'    => $this->input->post('vc_telefono'),
                'VC_EXTENSION'      => $this->input->post('vc_extension'),
                'VC_CORREO_EXT' =>$this->input->post('vc_correo_ext'),
                'VC_CARGO' => $this->input->post('vc_cargo'),
                'ID_U_ADMINISTRATIVA' =>$this->input->post('id_u_administrativa'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth/registro", 'refresh');
        }
        else
        {   
           
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
             $_POST['vc_correo']=$correo;
            $this->data['vc_nombre'] = array(
                'name'  => 'vc_nombre',
                'id'    => 'vc_nombre',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_nombre'),
            );
            $this->data['vc_apellido_pat'] = array(
                'name'  => 'vc_apellido_pat',
                'id'    => 'vc_apellido_pat',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_apellido_pat'),
            );
            $this->data['vc_apellido_mat'] = array(
                'name'  => 'vc_apellido_mat',
                'id'    => 'vc_apellido_mat',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_apellido_mat'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['vc_correo'] = array(
                'name'  => 'vc_correo',
                'id'    => 'vc_correo',
                'type'  => 'text',
                'class' => 'form-control has-feedback-left',
                'value' => $correo,//$this->form_validation->set_value('vc_correo',$correo,true),
            );
            
            $this->data['vc_correo_ext'] = array(
                'name'  => 'vc_correo_ext',
                'id'    => 'vc_correo_ext',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_correo_ext'),
            );
            $this->data['vc_telefono'] = array(
                'name'  => 'vc_telefono',
                'id'    => 'vc_telefono',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_telefono'),
            );
            $this->data['vc_extension'] = array(
                'name'  => 'vc_extension',
                'id'    => 'vc_extension',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_extension'),
            );            
            $this->data['vc_cargo'] = array(
                'name'  => 'vc_cargo',
                'id'    => 'vc_cargo',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('vc_cargo'),
            ); 
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
            
            $this->data['u_administrativa'] = $this->ion_auth->getUnidadAdministrativa();

            $this->_render_page('registro_view', $this->data);
        }
    }

}
