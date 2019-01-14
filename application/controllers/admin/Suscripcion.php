<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suscripcion extends My_Controller {

  private $image_validation;
  
  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in()) redirect(base_url());
    
    $this->load->model('admin/panel_model', 'panel_bd');
    //$this->data['js'] = ['digitalizacion.js'];
    $this->image_validation = '';
    $this->load->library('upload');
    $user_groups = $this->ion_auth->get_users_groups($this->ion_auth->get_user_id())->result();
    foreach ($user_groups as $key => $value)
      $this->data['groups'][$value->ID] = $value->NOMBRE; 
     $this->data['admin'] = in_array("sub_admin", $this->data['groups']);
    
    
  }
  
	public function index()
	{
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh');    }

		$this->data='';
		$this->data['rsSuscripcion']=$this->panel_bd->getSuscripciones('','');
		 $this->render('admin/panel_suscripcion', $this->data);
	}


  public function nueva()
  {
    if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='nvo';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','jquery.multi-select.js', 'suscripcion.js'];
    
    $this->data['id_obj']='';
    $this->data['estatusId']='0';$this->data['tipo']='';$this->data['duracionId']='';
    $this->data['rsDuracion']=$this->panel_bd->getDuracionSuscripcion();
    $this->form_validation->set_rules('estatus','Estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Título', 'trim|required');
    $this->form_validation->set_rules('descripcion','Descripción.', 'trim|required');
    $this->form_validation->set_rules('tipo','Tipo.', 'trim|required');
    $this->form_validation->set_rules('precio','Precio.', 'trim|required');
 

      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 'type'  => 'text', 'value' => $this->form_validation->set_value('titulo_hist'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título');


      $this->data['descripcion'] = array(
        'name'  => 'descripcion',
        'id'    => 'descripcion',
        'rows'        => '3',
        'cols'        => '3',
        'value' => $this->form_validation->set_value('descripcion'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la descripción'        
      );

 $this->data['precio'] = array('name'  => 'precio', 'id'    => 'precio', 'type'  => 'text', 'value' => $this->form_validation->set_value('precio'), 'class' => 'form-control');

 $this->data['orden'] = array('name'  => 'orden', 'id'    => 'orden', 'type'  => 'text', 'value' => $this->form_validation->set_value('orden'), 'class' => 'form-control');

 $this->data['num_historias'] = array('name'  => 'num_historias', 'id'    => 'num_historias', 'type'  => 'text', 'value' => $this->form_validation->set_value('num_historias'), 'class' => 'form-control');

    $this->render('admin/suscripcion_form', $this->data);
    }else{
    
        $this->panel_bd->setSuscripcion();

        redirect(base_url().'admin/suscripcion');
     }      
  
     
  }

   public function editar($id)
  {
    if (!$this->ion_auth->logged_in() || !is_numeric($id)) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='mod';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','jquery.multi-select.js', 'suscripcion.js'];
    
    $rsHistoria=$this->panel_bd->getSuscripciones($id,'');
    if($rsHistoria) $rsHistoria=$rsHistoria[0];
    $this->data['rsDuracion']=$this->panel_bd->getDuracionSuscripcion();
    $this->data['id_obj']=$rsHistoria->id_suscripcion;
    $this->data['estatusId']=$rsHistoria->estatus_suscripcion;
    $this->data['tipo']=$rsHistoria->tipo_suscripcion; 
    $this->data['duracionId']=$rsHistoria->id_duracion_suscr;
    
    $this->form_validation->set_rules('estatus','Estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Título', 'trim|required');
    $this->form_validation->set_rules('descripcion','Descripción.', 'trim|required');
    $this->form_validation->set_rules('tipo','Tipo.', 'trim|required');
    $this->form_validation->set_rules('precio','Precio.', 'trim|required');
     
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
/*id_suscripcion, titulo_suscripcion, descripcion_suscripcion, tipo_suscripcion, precio_suscripcion, estatus_suscripcion, num_historias_suscripcion, id_duracion_suscr, orden_suscripcion, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica*/


      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 
        'type'  => 'text', 
        'value' => ($this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_suscripcion)) ? $this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_suscripcion) : $this->form_validation->set_value('titulo_hist'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título', 'placeholder'=>'Escribe tu búsqueda');

      $this->data['descripcion'] = array(
        'name'  => 'descripcion',
        'id'    => 'descripcion',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('descripcion', $rsHistoria->descripcion_suscripcion)) ? $this->form_validation->set_value('descripcion', $rsHistoria->descripcion_suscripcion) : $this->form_validation->set_value('descripcion'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la descripción'        
      );

 $this->data['precio'] = array('name'  => 'precio', 'id'    => 'precio', 'type'  => 'text', 'value' => ($this->form_validation->set_value('precio', $rsHistoria->precio_suscripcion)) ? $this->form_validation->set_value('precio', $rsHistoria->precio_suscripcion) : $this->form_validation->set_value('precio'), 'class' => 'form-control');

 $this->data['orden'] = array('name'  => 'orden', 'id'    => 'orden', 'type'  => 'text', 'value' => ($this->form_validation->set_value('orden', $rsHistoria->orden_suscripcion)) ? $this->form_validation->set_value('orden', $rsHistoria->orden_suscripcion) : $this->form_validation->set_value('orden'), 'class' => 'form-control');

 $this->data['num_historias'] = array('name'  => 'num_historias', 'id'    => 'num_historias', 'type'  => 'text', 'value' =>  ($this->form_validation->set_value('num_historias', $rsHistoria->num_historias_suscripcion)) ? $this->form_validation->set_value('num_historias', $rsHistoria->num_historias_suscripcion) : $this->form_validation->set_value('num_historias'), 'class' => 'form-control');

    $this->render('admin/suscripcion_form', $this->data);
    }else{
    
        $this->panel_bd->updateSuscripcion();

        redirect(base_url().'admin/suscripcion');
     }      
  
     
  }

  public function eliminar($id)
  {
    $this->panel_bd->eliRegistro('suscripcion',$id);
    redirect(base_url().'admin/suscripcion');
  }


      /**
     * function para el procesamiento de imagenes por medio de ajax
     */
    public function procesar() {
        //var_dump($_POST); die;
        $carpeta = $_POST['carpeta'];
        $options = array('upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']) . '/uploads/images/' . $carpeta . '/', 'upload_url' => $this->get_full_url() . '/uploads/images/' . $carpeta . '/', 'accept_file_types' => '/\.(gif|jpe?g|png)$/i'/* ,
                  'image_resize'=>TRUE,
                  'max_width'=>$_POST['max_width'],
                  'max_height'=>$_POST['max_height'] */
        );
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler", $options);
    }

      /**
     * function para el procesamiento de imagenes por medio de ajax
     */
    public function procesaraudio() {
        //var_dump($_POST); die;
        $carpeta = $_POST['carpeta'];
        $options = array('upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']) . '/uploads/audio/' . $carpeta . '/', 'upload_url' => $this->get_full_url() . '/uploads/audio/' . $carpeta . '/', 'accept_file_types' => '/\.(mp3|wma)$/i'/* ,
                  'image_resize'=>TRUE,
                  'max_width'=>$_POST['max_width'],
                  'max_height'=>$_POST['max_height'] */
        );
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler", $options);
    }

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 || !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        return ($https ? 'https://' : 'http://') . (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] . ($https && $_SERVER['SERVER_PORT'] === 443 || $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

      
}
