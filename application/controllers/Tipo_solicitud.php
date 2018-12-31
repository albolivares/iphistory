<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tipo_solicitud extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Tipo_solicitud_model','tiposol');
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth')); 
   
  }
  
  public function index(){
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }    
    $data['title'] = "Listado de Tipo de Solicitud";
    $data['tiposoli'] = $this->tiposol->getTipoSolicitud();    
    $this->load->view('tipo_solicitud_panel',$data);
  }
  
  public function nuevo()
  {
    $data['title'] = "Crear Tipo de Solicitud";
    $data['accion'] = "nuevo";    
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('solicitudes', 'refresh');
        }
    $this->form_validation->set_rules('vc_nombre','Tipo de solicitud', 'required');
    $this->form_validation->set_rules('requiere_id_proy','¿Requiere identificador del proyecto?', 'required');
    $this->form_validation->set_rules('es_nuevo','¿Es nuevo?', 'required');
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('tipo_solicitud_form', $data);
     }else{
       $this->tiposol->set_tipo_solicitud();
       redirect('Tipo_solicitud');
     }
    //$this->load->view('tipo_solicitud_form');
  }
  
  public function modi($id)
  {
    $data['title'] = "Editar Tipo de Solicitud";
    $data['accion'] = "modi";
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('solicitudes', 'refresh');
        }
    $this->form_validation->set_rules('vc_nombre','Tipo de solicitud', 'required');
    $this->form_validation->set_rules('requiere_id_proy','¿Requiere identificador del proyecto?', 'required');
    $this->form_validation->set_rules('es_nuevo','¿Es nuevo?', 'required');
    $data['resultado'] = $this->tiposol->get_tipo_solicitud($id);
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('tipo_solicitud_form', $data);
     }else{
       
       $this->tiposol->edit_tipo_solicitud();
       redirect('Tipo_solicitud');
     }
  }
  
  public function eli($id)
  {
    $data['title'] = "Eliminar Tipo de Solicitud";
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('solicitudes', 'refresh');
        }
     if($this->tiposol->del_tipo_solicitud($id))
     {
       redirect('Tipo_solicitud');
     }
  }
}