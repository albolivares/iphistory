<?php
class Sugerencias extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Sugerencias_model','sugerencia',true);
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
  }
  
  public function index()
  {
   $data['title'] = "Listado de Sugerencias";
    $data['sugerencias'] = $this->sugerencia->getSugerencias();    
    $this->load->view('sugerencias_panel',$data);
  }
  
  public function nuevo()
  {
    $data['title'] = "Crear sugerencia";
    $data['accion'] = "nuevo";
    $data['resultado'] = array();    
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('sugerencias', 'refresh');
        }
    $this->form_validation->set_rules('titulo','Titulo', 'required');
    $this->form_validation->set_rules('resumen','Resumen', 'required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    $this->form_validation->set_rules('fuente','Fuente','required');
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('sugerencias_form', $data);
     }else{
       $titulo = $this->input->post('titulo');
       $resumen = $this->input->post('resumen');
       $descripcion = $this->input->post('descripcion');
       $fuente = $this->input->post('fuente');
       $estatus = $this->input->post('estatus');
       $url = $this->input->post('url');
       $fecha = $this->input->post('fch_crea');
       $ruta = $this->input->post('ruta');
       $this->sugerencia->setSugerencias($titulo,$resumen,$descripcion,$fuente,$estatus,$url,$fecha,$ruta);
       redirect('sugerencias');
     }
  }
  
  public function modi($id)
  {
    $data['title'] = "Editar sugerencia";
    $data['accion'] = "modi/".$id;
    $data['resultado'] = $this->sugerencia->getSugerenciasById($id);    
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('sugerencias', 'refresh');
        }
    $this->form_validation->set_rules('titulo','Titulo', 'required');
    $this->form_validation->set_rules('resumen','Resumen', 'required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    $this->form_validation->set_rules('fuente','Fuente','required');
     if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('sugerencias_form', $data);
     }else{
       $titulo = $this->input->post('titulo');
       $resumen = $this->input->post('resumen');
       $descripcion = $this->input->post('descripcion');
       $fuente = $this->input->post('fuente');
       $estatus = $this->input->post('estatus');
       $url = $this->input->post('url');
       $fecha = $this->input->post('fch_crea');
       $ruta = $this->input->post('ruta');
       $this->sugerencia->editSugerencias($titulo,$resumen,$descripcion,$fuente,$estatus,$url,$fecha,$ruta,$id);
       redirect('sugerencias');
     }
  }
  
  public function eli($id)
  {
    $this->sugerencia->eliSugerencias($id);
    return true;
  }
  
  public function historial()
  {
    
  }
  
  public function procesar()
  {
    
        $carpeta = 'sugerencias';
        $options = array(            
            'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/assets/upload/'.$carpeta.'/',
            'upload_url' => $this->get_full_url().'/assets/upload/'.$carpeta.'/',
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
        );
             
    error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler",$options);
  }
   
  protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
            !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }
}
