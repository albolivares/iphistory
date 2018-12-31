<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class registro_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();		
  }
  
  public function registro()
  {
    $this->load->view('registro_view',$data);
  }
	
	public function getUnidadAdministrativa()
	{

		$query = $this->db->get('CAT_U_ADMINISTRATIVAS');
		$query = $this->db->order_by('ES_INSTITUCION', 'ASC');
		$query = $this->db->order_by('VC_NOMBRE', 'ASC');
		return $query->result();
	}
  
  public function setRegistro($vc_nombre, $vc_apellido_pat,$vc_apellido_mat,$id_u_administrativa,$vc_cargo,$vc_telefono,$vc_extension,$vc_correo,$vc_correo_ext,$contra,$fch_alta)
  {
    try{
        $data = array(
                      'VC_NOMBRE'=>$vc_nombre,
                      'VC_APELLIDO_PAT'=>$vc_apellido_pat,
                      'VC_APELLIDO_MAT'=>$vc_apellido_mat,
                      'ID_U_ADMINISTRATIVA'=>$id_u_administrativa,
                      'VC_CARGO'=>$vc_cargo,
                      'VC_TELEFONO'=>$vc_telefono,
                      'VC_EXTENSION'=>$vc_extension,
                      'VC_CORREO'=>$vc_correo,
                      'VC_CORREO_EXT'=>$vc_correo_ext,
                      'VC_PSWD'=>$contra,
                      'FCH_ALTA'=>$fch_alta,
                      'VC_ESTATUS'=>'4'
                      );       
       $this->db->insert('CONTACTO_U_ADMINISTRATIVA',$data);
       return $true;
    }catch(PDOException $e)
    {
      return $e->getMessage();
    }
  }
}
