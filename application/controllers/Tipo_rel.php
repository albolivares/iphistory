<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tipo_rel extends CI_Controller {
  public function __construct()
  {
    parent::__construct();   
    $this->load->model('Tipo_rel_model','tipo_rel');
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
  }
  
  public function index()
  { $data['title'] = "Listado relación de tipo de solicitud con el catálogo de documentos";
    $data['tiporela'] = $this->tipo_rel->getTipoRel();
    $this->load->view('tiporel_panel',$data);
  }
  
  public function nuevo()
  { $data['accion'] = 'nuevo';
    $data['title'] = "Nueva relación de tipo de solicitud con el catálogo de documentos"; 
    $data['u_administrativa'] = $this->tipo_rel->getTipoSolicitud();
    $data['documentos'] = $this->tipo_rel->getCatDocumento();
    $this->form_validation->set_rules('id_tipo_solicitud','Tipo de solicitud', 'required');
    $this->form_validation->set_rules('id_cat_documento','Categoría de documento', 'required');
    $this->form_validation->set_rules('es_obligatorio','¿Es obligatorio?', 'required');
    $this->form_validation->set_rules('fase','Fase', 'required');
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('tiporel_form', $data);
     }else{
       $this->tipo_rel->set_tipo_rel();
       redirect('tipo_rel');
     }
  }
  
  public function editar($id)
  {
    $data['accion'] = 'editar';
    $data['title'] = "Editar relación de tipo de solicitud con el catálogo de documentos"; 
    $data['u_administrativa'] = $this->tipo_rel->getTipoSolicitud();
    $data['documentos'] = $this->tipo_rel->getCatDocumento();
    $data['resultado'] = $this->tipo_rel->getTipoRelById($id);
    $this->form_validation->set_rules('id_tipo_solicitud','Tipo de solicitud', 'required');
    $this->form_validation->set_rules('id_cat_documento','Categoría de documento', 'required');
    $this->form_validation->set_rules('es_obligatorio','¿Es obligatorio?', 'required');
    $this->form_validation->set_rules('fase','Fase', 'required');
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('tiporel_form', $data);
     }else{
       $this->tipo_rel->edit_tipo_rel();
       redirect('tipo_rel');
     }
  }
  
  public function eli($id)
  {
    $data['title'] = "Eliminar Tipo de rel";
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('tiporel', 'refresh');
        }
     if($this->tipo_rel->del_tipo_rel($id))
     {
       redirect('Tipo_rel');
     }
  }
  
  public function llenacombo()
  {
    $options="";
    $id_cat_documento1 = $this->input->post('id_cat_documento1');
    
    if($this->tipo_rel->getCatDocumento()==false)
    {
      $options = '<option value="">--Seleccione--</option>';
    }else {
    $options.= '<option value="">--Seleccione--</option>';
    foreach($this->tipo_rel->getCatDocumento() as $valor)
    {
      if($id_cat_documento1==$valor->ID){
      $options.= '<option value="'.$valor->ID.'" selected="selected" >'.$valor->VC_DOCUMENTO.'</option>';
      }else{
        $options.= '<option value="'.$valor->ID.'" >'.$valor->VC_DOCUMENTO.'</option>';
      }
    }
    }
    echo $options;
  }
}