<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipo_solicitud_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  public function getTipoSolicitud()
  {
    $query = $this->db->order_by('VC_NOMBRE', 'ASC');
    $query = $this->db->get('CAT_TIPO_SOLICITUD');
    return $query->result();
  }
  
  public function get_tipo_solicitud($id)
  {
    $query = $this->db->select('*')
                      ->where('ID', $id)
                      ->limit(1)
                      ->order_by('ID', 'ASC')
                      ->get('CAT_TIPO_SOLICITUD');
    return $query->row();
  }
  
  public function set_tipo_solicitud()
  {
    $data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'REQUIERE_ID_PROY' => $this->input->post('requiere_id_proy'),
        'ES_NUEVO' => $this->input->post('es_nuevo'),
        'USU_CREA' => $_SESSION['nombre'],
        'FCH_CREA' => $this->input->post('fch_crea')
        
    );    
    return $this->db->insert('CAT_TIPO_SOLICITUD', $data);
  }
  
  public function edit_tipo_solicitud()
  {
    $data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'REQUIERE_ID_PROY' => $this->input->post('requiere_id_proy'),
        'ES_NUEVO' => $this->input->post('es_nuevo'),
    );     $this->db->where('ID', $this->input->post('id_cat_tipo_documento'));    
       return    $this->db->update('CAT_TIPO_SOLICITUD', $data);
  }
  
  public function del_tipo_solicitud($id)
  {
    $this->db->where('ID',$id);
    return $this->db->delete('CAT_TIPO_SOLICITUD');
  }
}
