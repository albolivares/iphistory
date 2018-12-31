<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Servidor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Servidor_model','servidor');
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
    if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }
  }
  
  public function index()
  {
    $data['title'] = "Listado de Servidores registrados";
    $data['rsServidor'] = $this->servidor->getServidor();
    $this->load->view('servidor_panel',$data);
  }
  
  public function nuevo()
  {
    $data['accion'] = 'nuevo';
    $data['title'] = "Nuevo Servidor";
    $this->form_validation->set_rules('ip','Dirección IP del Servidor', 'trim|required');
    $this->form_validation->set_rules('disco_duro','Capacidad de disco duro', 'trim|required');
    $this->form_validation->set_rules('sistema_operativo','Sistema operativo', 'trim|required');
    $this->form_validation->set_rules('servidor_web','Servidor web', 'trim|required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('servidor_form', $data);
     }else{
       $this->servidor->setServidor();
       redirect('servidor');
     }
    //$this->load->view('servidor_form',$data);
  }
  
  public function editar($id)
  {
    $data['accion'] = 'editar';
    $data['title'] = "Editar Servidor";
    $data['resultado'] = $this->servidor->getServidorById($id);
    $this->form_validation->set_rules('ip','Dirección IP del Servidor', 'trim|required');
    $this->form_validation->set_rules('disco_duro','Capacidad de disco duro', 'trim|required');
    $this->form_validation->set_rules('sistema_operativo','Sistema operativo', 'trim|required');
    $this->form_validation->set_rules('servidor_web','Servidor web', 'trim|required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('servidor_form', $data);
     }else{
       $this->servidor->updateServidor();
       redirect('servidor');
     }
    //$this->load->view('servidor_form',$data);
  }
  
  public function eli($id)
  {    
    $data['title'] = "Eliminar Servidor";    
     if($this->servidor->eliminarServidor($id))
     {
       redirect('Servidor');
     }
  }
  
  
}
