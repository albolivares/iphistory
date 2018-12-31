<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Plataforma extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Plataformas_model','plataformas');
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
    $data['title'] = "Listado de Plataformas registradas";
    $data['rsPlataforma'] = $this->plataformas->lista();
    $this->load->view('plataformas_panel',$data);
  }
	
	public function nuevo()
  {


    $data['title'] = "Nueva plataforma";
		
		  /*Carga inicial*/
		$data['resultado'] = '';
		$data['categorias'] = $this->plataformas->getCategorias();
		$data['uniadmin'] = $this->plataformas->getUnidadAdministrativa();
		$data['tipocont'] = $this->plataformas->getTipoContenido();
		$data['tipopub'] = $this->plataformas->getTipoPublico();
		$data['plataforma_soc'] = $this->plataformas->getCatPlataforma('S');
		$data['plataforma_socA'] = $this->plataformas->getCatPlataforma('A');
		$data['acc'] ='nvo';
		$data['id'] ='';
		/*formulario enviado*/
		
		//$this->input->post(NULL, TRUE);


    $this->form_validation->set_rules('vc_nombre','Nombre de la aplicación requerida', 'trim|required');
    $this->form_validation->set_rules('id_uni_admin','Unidad administrativa', 'trim|required');
    $this->form_validation->set_rules('descripcion','Descripción', 'trim|required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('plataforma_form', $data);
     }else{
			 /*valida el tipo de accion*/


			 $this->plataformas->insertaPlataforma();
       redirect('plataforma');
     }
		
  
//    $this->load->view('plataforma_form',$data);

  }
  
		public function editar($id)
  {

		if(is_numeric($id)){
    $data['title'] = "Detalle de plataforma";
		
		  /*Carga inicial*/
		$data['resultado'] = $this->plataformas->getPlataforma($id);
		$data['platforma_prin'] = $this->plataformas->getPlataformaCategoria($id);
		$data['categorias'] = $this->plataformas->getCategorias();
		$data['uniadmin'] = $this->plataformas->getUnidadAdministrativa();
		$data['tipocont'] = $this->plataformas->getTipoContenido();
		$data['tipopub'] = $this->plataformas->getTipoPublico();
		$data['plataforma_rel'] = $this->plataformas->getPlataformaRel($id, 'S');
		$data['plataforma_soc'] = $this->plataformas->getCatPlataforma('S');
		$data['plataforma_socA'] = $this->plataformas->getCatPlataforma('A');
		$data['plataforma_relA'] = $this->plataformas->getPlataformaRel($id, 'A');
		$data['acc'] ='mod';
		$data['id'] =$id;
		/*formulario enviado*/
		
		//$this->input->post(NULL, TRUE);

    $this->form_validation->set_rules('id','id', 'trim|required');
    $this->form_validation->set_rules('vc_nombre','Nombre de la aplicación requerida', 'trim|required');
    $this->form_validation->set_rules('id_uni_admin','Unidad administrativa', 'trim|required');
    $this->form_validation->set_rules('descripcion','Descripción', 'trim|required');
    $this->form_validation->set_rules('estatus','Estatus', 'required');
    if ($this->form_validation->run() === FALSE)
     {
       $this->load->view('plataforma_form', $data);
     }else{
			 /*valida el tipo de accion*/


			 $this->plataformas->updatePlataforma();
       redirect('plataforma');
     }
		
  
//    $this->load->view('plataforma_form',$data);
		}/*if(!is_numeric($id)){...*/
  }
  
}
