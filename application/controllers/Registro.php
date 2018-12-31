<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registro extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
		$this->load->model('Registro_model','registro');
    $this->load->library(array('session','form_validation'));
    $this->load->helper(array('form', 'url'));
  }
  
  public function index()
  { 
		$data['ua'] = $this->registro->getUnidadAdministrativa();
    $this->load->view('registro_view',$data);
  }
	
	public function registrate()
	{
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[8]');
    $this->form_validation->set_rules('password2', 'Confirmación contraseña', 'trim|required|matches[password]');
     if ($this->form_validation->run() == FALSE)
     {
            //$this->load->view('pages/'.'equipForm');
       $this->load->view('registro_view');
     }else{
       $vc_nombre = $this->input->post('vc_nombre');
       $vc_apellido_pat = $this->input->post('vc_apellido_pat');       
       $vc_nombre = $this->input->post('vc_nombre'); 
       $vc_apellido_pat = $this->input->post('vc_apellido_pat');
       $vc_apellido_mat = $this->input->post('vc_apellido_mat');
       $id_u_administrativa = (int)$this->input->post('id_u_administrativa');
       $vc_cargo = $this->input->post('vc_cargo');
       $vc_telefono = $this->input->post('vc_telefono');
       $vc_extension = $this->input->post('vc_extension');
       $vc_correo = $this->input->post('vc_correo');
       $vc_correo_ext = $this->input->post('vc_correo_ext');
       $contrasena = $this->input->post('password');       
       $salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
       $enc_pass  = md5($salt.$contrasena);
       $fch_alta = date('Y-m-d H:i:s');   
       $registrocontacto = $this->registro->setRegistro($vc_nombre, $vc_apellido_pat,$vc_apellido_mat,$id_u_administrativa,$vc_cargo,$vc_telefono,$vc_extension,$vc_correo,$vc_correo_ext,$enc_pass,$fch_alta);
       if($registrocontacto==true)
       {
         
       }
     }
     
	}

  public function activar($code)
  {
    
  }
}