<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Servidor_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  
  public function getServidor()
  { if(!$this->ion_auth->is_admin()) $query = $this->db->where('ID_USUARIO',$this->session->userdata('user_id'));
    $query = $this->db->order_by('ID', 'ASC');
    $query = $this->db->get('SERVIDOR');
    return $query->result();
  }
  
  public function getServidorById($id)
  {
	if(!$this->ion_auth->is_admin()) {	
   $query = $this->db->select('*')
                      ->where('ID_USUARIO',$this->session->userdata('user_id'))
                      ->where('ID', $id)
                      ->limit(1)
                      ->order_by('ID', 'ASC')
                      ->get('SERVIDOR');
	}else{
		$query = $this->db->select('*')
                      ->where('ID', $id)
                      ->limit(1)
                      ->order_by('ID', 'ASC')
                      ->get('SERVIDOR');
		}
    return $query->row();
  }
  
  public function setServidor()  
  {
   $data = array(
        'IP' => $this->input->post('ip'),        
        'DOMINIO' => $this->input->post('dominio'),
        'MEMORIA_RAM' => $this->input->post('memoria_ram'),
        'DISCO_DURO' => $this->input->post('disco_duro'),
        'SISTEMA_OPERATIVO' => $this->input->post('sistema_operativo'),
        'SERVIDOR_WEB' => $this->input->post('servidor_web'),
        'MOTOR_BD' => $this->input->post('motor_bd'),
        'VERSION_PHP' => $this->input->post('version_php'),
        'ESTATUS' => $this->input->post('estatus'),
        'ID_USUARIO' => $this->session->userdata('user_id'),
        'VC_USUARIO_CREA' => $this->session->userdata('nombre'),
        'DT_FCH_ALTA' => date('Y-m-d H:i:s'),
        'IP_ALTA' => $this->input->ip_address()
    ); 
   return $this->db->insert('SERVIDOR', $data); 
  }
  
  public function updateServidor()
  {
    $data = array(
        'IP' => $this->input->post('ip'),        
        'DOMINIO' => $this->input->post('dominio'),
        'MEMORIA_RAM' => $this->input->post('memoria_ram'),
        'DISCO_DURO' => $this->input->post('disco_duro'),
        'SISTEMA_OPERATIVO' => $this->input->post('sistema_operativo'),
        'SERVIDOR_WEB' => $this->input->post('servidor_web'),
        'MOTOR_BD' => $this->input->post('motor_bd'),
        'VERSION_PHP' => $this->input->post('version_php'),
        'ESTATUS' => $this->input->post('estatus'),
        'ID_USUARIO' => $this->session->userdata('user_id'),
        'VC_USUARIO_MOD' => $this->session->userdata('nombre'),
        'DT_FCH_MOD' => date('Y-m-d H:i:s'),
        'IP_MOD' => $this->input->ip_address()
    );    
          $this->db->where('ID', $this->input->post('id_servidor'));
   return $this->db->update('SERVIDOR', $data);
  }
  
  public function eliminarServidor($id)
  {
    $this->db->where('ID',$id);
    $this->db->where('ID_USUARIO',$this->session->userdata('user_id'));
    return $this->db->delete('SERVIDOR');
  }
}