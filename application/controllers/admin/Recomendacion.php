<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recomendacion extends My_Controller {

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
		$this->data['rsRecomienda']=$this->panel_bd->getRecomendaciones('','');
		 $this->render('admin/panel_recomendacion', $this->data);
	}


  public function nueva()
  {
    if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='nvo';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','jquery.multi-select.js', 'recomendacion.js'];
    
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsSeccion'] = $this->panel_bd->getSeccion();
    $this->data['id_obj']='';
    $this->data['estatusId']='0';
    $this->data['arrCath']='';$this->data['arrSec']='';$this->data['id_hist']='';
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('title','Por favor escriba el título', 'trim|required');
    $this->form_validation->set_rules('id_hist','Por favor escriba una historia registrada.', 'trim|required');
 
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 'type'  => 'text', 'value' => $this->form_validation->set_value('titulo_hist'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título');

      $this->data['title'] = array('name'  => 'title', 'id'    => 'title', 
        'type'  => 'text', 
        'value' => $this->form_validation->set_value('title'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título', 'placeholder'=>'Escribe tu búsqueda');


 $this->data['hashtag_hist'] = array('name'  => 'hashtag_hist', 'id'    => 'hashtag_hist', 'type'  => 'text', 'value' => $this->form_validation->set_value('hashtag_hist'), 'class' => 'form-control');

      $this->data['copy_hist'] = array(
        'name'  => 'copy_hist',
        'id'    => 'copy_hist',
        'rows'        => '3',
        'cols'        => '3',
        'value' => $this->form_validation->set_value('copy_hist'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la copy'        
      );


   $this->data['fecha_inicio_hist'] = array(
        'name'  => 'fecha_inicio_hist',
        'id'    => 'fecha_inicio_hist',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('fecha_inicio_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

   $this->data['fecha_fin_hist'] = array(
        'name'  => 'fecha_fin_hist',
        'id'    => 'fecha_fin_hist',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('fecha_fin_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

    $this->render('admin/recomendacion_form', $this->data);
    }else{
    
        $this->panel_bd->setRecomendacion();

        redirect(base_url().'admin/recomendacion');
     }      
  
     
  }

   public function editar($id)
  {
    if (!$this->ion_auth->logged_in() || !is_numeric($id)) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='mod';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','jquery.multi-select.js', 'recomendacion.js'];
    
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsSeccion'] = $this->panel_bd->getSeccion();
    $rsHistoria=$this->panel_bd->getRecomendaciones($id,'');
    if($rsHistoria) $rsHistoria=$rsHistoria[0];

    $this->data['id_obj']=$rsHistoria->id_recom;
    $this->data['estatusId']=$rsHistoria->estatus_recom;
    $this->data['id_hist']=$rsHistoria->id_hist;

    
    
    $rscath=$this->panel_bd->getRecomendacionCategoria($id);
    $arrCath=array();
    foreach ($rscath as $key => $cath) {
       array_push($arrCath,$cath->id_categoria);
       
     } 
     //print_r($arrCath);
     $this->data['arrCath']=$arrCath;


    $rssecc=$this->panel_bd->getRecomendacionSeccion($id);
    $arrSec=array();
    foreach ($rssecc as $key => $cath) {
       array_push($arrSec,$cath->id_seccion);
       
     } 
     //print_r($arrCath);
     $this->data['arrSec']=$arrSec;
     
    
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('title','Por favor escriba el título', 'trim|required');
    $this->form_validation->set_rules('id_hist','Por favor escriba una historia registrada.', 'trim|required');
    
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
/*r.id_recom, fecha_registro, fecha_inicio_recom, fecha_fin_recom, estatus_recom, orden, r.id_hist, h.titulo_hist, h.usuario_publica_hist, u.id_register, u.ap_paterno_register, u.ap_materno_register,u.nombre_register, r.usuario_alta, r.fecha_alta, r.usuario_modifica, r.fecha_modifica*/
    

      $this->data['title'] = array('name'  => 'title', 'id'    => 'title', 
        'type'  => 'text', 
        'value' => ($this->form_validation->set_value('title', $rsHistoria->titulo_hist)) ? $this->form_validation->set_value('title', $rsHistoria->titulo_hist) : $this->form_validation->set_value('title'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título', 'placeholder'=>'Escribe tu búsqueda');


   $this->data['fecha_inicio_hist'] = array(
        'name'  => 'fecha_inicio_hist',
        'id'    => 'fecha_inicio_hist',
        'type'  => 'text',
        'value' => ($this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_recom)) ? $this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_recom) : $this->form_validation->set_value('fecha_inicio_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

   $this->data['fecha_fin_hist'] = array(
        'name'  => 'fecha_fin_hist',
        'id'    => 'fecha_fin_hist',
        'type'  => 'text',
        'value' => ($this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_recom)) ? $this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_recom) : $this->form_validation->set_value('fecha_fin_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

    $this->render('admin/recomendacion_form', $this->data);
    }else{
    
        $this->panel_bd->updateRecomendacion();

        redirect(base_url().'admin/recomendacion');
     }      
  
     
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
