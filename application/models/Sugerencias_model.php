<?php
class Sugerencias_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  public function getSugerencias()
  {
    return $this->db->get('SUGERENCIAS')->result();
  }
  
  public function getSugerenciasHome()
  {
    $this->db->limit(4);
    $this->db->order_by('ID','DESC');
    $this->db->where('ESTATUS',1);
    return $this->db->get('SUGERENCIAS')->result();
  }
  
  public function getSugerenciasHistoria()
  {
      $this->db->order_by('ID','DESC');
      $this->db->where('ESTATUS',1);
    return $this->db->get('SUGERENCIAS')->result();
  }
  
  public function getSugerenciasById($id)
  {
    $this->db->where('ID',$id); 
    return $this->db->get('SUGERENCIAS')->row();
  }
  
  public function setSugerencias($titulo,$resumen,$descripcion,$fuente,$estatus,$url,$fecha,$ruta)
  {
    $data = array('TITULO'=>$titulo,'RESUMEN'=>$resumen,'DESCRIPCION'=>$descripcion,'FUENTE'=>$fuente,'ESTATUS'=>$estatus,'URL'=>$url,'FECHA'=>$fecha, 'IMAGEN'=>$ruta);
    $this->db->insert('SUGERENCIAS',$data);
    return TRUE;
  }
  
  public function editSugerencias($titulo,$resumen,$descripcion,$fuente,$estatus,$url,$fecha,$ruta,$id)
  {
    $data = array('TITULO'=>$titulo,'RESUMEN'=>$resumen,'DESCRIPCION'=>$descripcion,'FUENTE'=>$fuente,'ESTATUS'=>$estatus,'URL'=>$url,'FECHA'=>$fecha, 'IMAGEN'=>$ruta);
    $this->db->where('ID',$id);
    $this->db->update('SUGERENCIAS',$data);
    return TRUE;
  }
  
  public function eliSugerencias($id)
  {
    $this->db->where('ID',$id);
    $this->db->delete('SUGERENCIAS');
    return TRUE;
  }
}
