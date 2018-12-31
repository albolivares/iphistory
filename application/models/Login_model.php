<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  public function login_user($usuario, $password)
  {
    $this->db->where("VC_CORREO",$usuario);
    $this->db->where("VC_PSWD",$password);
    $query = $this->db->get("CONTACTO_U_ADMINISTRATIVA");    
    if($query->num_rows()==1)
    {
      return $query->row();
    } else {
      $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
      redirect(base_url().'login','refresh');
    }
  }
}
