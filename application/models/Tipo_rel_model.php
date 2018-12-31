<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipo_rel_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  
  public function getTipoRel()
  {
    /*$query = $this->db->order_by('VC_NOMBRE', 'ASC');
    $query = $this->db->get('CAT_TIPO_SOLICITUD');
    return $query->result();*/
    $this->db->select('REL_TIPSOL_CATDOC.ID, REL_TIPSOL_CATDOC.ID_TIPO_SOLICITUD,CAT_TIPO_SOLICITUD.VC_NOMBRE, REL_TIPSOL_CATDOC.ID_CAT_DOCUMENTO, CAT_DOCUMENTOS.VC_DOCUMENTO,CAT_DOCUMENTOS.DESCRIPCION,REL_TIPSOL_CATDOC.ES_OBLIGATORIO, REL_TIPSOL_CATDOC.ORDEN, REL_TIPSOL_CATDOC.FASE');
    $this->db->from('REL_TIPSOL_CATDOC');
    $this->db->join('CAT_TIPO_SOLICITUD', 'CAT_TIPO_SOLICITUD.ID = REL_TIPSOL_CATDOC.ID_TIPO_SOLICITUD');
    $this->db->join('CAT_DOCUMENTOS', 'CAT_DOCUMENTOS.ID = REL_TIPSOL_CATDOC.ID_CAT_DOCUMENTO');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function getTipoRelById($id)
  {
   $query = $this->db->select('*')
                      ->where('ID', $id)
                      ->limit(1)
                      ->order_by('ID', 'ASC')
                      ->get('REL_TIPSOL_CATDOC');
    return $query->row();
  }
  
  public function getTipoSolicitud()
  { $query = $this->db->order_by('ID', 'ASC');
    $query = $this->db->order_by('VC_NOMBRE', 'ASC');
    $query = $this->db->get('CAT_TIPO_SOLICITUD');
    return $query->result();
  }
  
  public function getCatDocumento()
  {  $fase = $this->input->post('mifase');
    if($fase=='A'){
    $this->db->where('ID BETWEEN 1 AND 15');
    }elseif($fase=='' ){
      return false;
}else{
    $this->db->where('ID>15');
    }  
    $this->db->order_by('ID', 'ASC');    
    $query = $this->db->get('CAT_DOCUMENTOS');
    return $query->result();
  }

  public function set_tipo_rel()
  {
    $data = array(
        'ID_TIPO_SOLICITUD' => $this->input->post('id_tipo_solicitud'),        
        'ID_CAT_DOCUMENTO' => $this->input->post('id_cat_documento'),
        'ES_OBLIGATORIO' => $this->input->post('es_obligatorio'),
        'FASE' => $this->input->post('fase'),
        'ORDEN' => $this->input->post('orden')
        
    );    
    return $this->db->insert('REL_TIPSOL_CATDOC', $data);
  }

  public function edit_tipo_rel()
  {
    $data = array(
        'ID_TIPO_SOLICITUD' => $this->input->post('id_tipo_solicitud'),        
        'ID_CAT_DOCUMENTO' => $this->input->post('id_cat_documento'),
        'ES_OBLIGATORIO' => $this->input->post('es_obligatorio'),
        'FASE' => $this->input->post('fase'),
        'ORDEN' => $this->input->post('orden')
        
    ); 
         $this->db->where('ID', $this->input->post('id_tipo_rel'));    
       return    $this->db->update('REL_TIPSOL_CATDOC', $data);
  }
  
  public function del_tipo_rel($id)
  {
    $this->db->where('ID',$id);
    return $this->db->delete('REL_TIPSOL_CATDOC');
  }
}
