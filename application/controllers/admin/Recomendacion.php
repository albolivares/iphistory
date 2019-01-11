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
    $this->data['rsSerie'] = $this->panel_bd->getSerie(1,'');
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsSeccion'] = $this->panel_bd->getSeccion();
    $this->data['id_obj']='';
    $this->data['estatusId']='0';
    $this->data['duracionId']='';
    $this->data['seId']='';

    $this->data['portada_bg']='';
    $this->data['portada_sm']='';
    $this->data['teaser']='';
    $this->data['audio']='';
    $this->data['arrCath']='';$this->data['arrSec']='';
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Por favor escriba el título', 'trim|required');
 
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 'type'  => 'text', 'value' => $this->form_validation->set_value('titulo_hist'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título');

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
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','jquery.multi-select.js', 'serie.js'];
    
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsTiempo'] = $this->panel_bd->getTiempo();
    $rsHistoria=$this->panel_bd->getSerie('',$id);
    if($rsHistoria) $rsHistoria=$rsHistoria[0];
    $this->data['id_obj']=$rsHistoria->id_serie;
    $this->data['estatusId']=$rsHistoria->estatus_serie;
    
    $this->data['portada_bg']=$rsHistoria->portada_serie_bg;
    $this->data['portada_sm']=$rsHistoria->portada_serie_sm;
    
    $rscath=$this->panel_bd->getSerieCategoria($id);
    $arrCath=array();
    foreach ($rscath as $key => $cath) {
       array_push($arrCath,$cath->id_categoria);
       
     } 
     //print_r($arrCath);
     $this->data['arrCath']=$arrCath;
     
    
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Por favor escriba el título', 'trim|required');
    
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

/*id_serie, titulo_serie, estatus_serie, fecha_alta, portada_serie_bg, portada_serie_sm, fecha_inicio_serie, fecha_fin_serie, copy_serie, hashtag_serie, usuario_alta, fecha_modifica, usuario_modifica*/


      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 
        'type'  => 'text', 
        'value' => ($this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_serie)) ? $this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_serie) : $this->form_validation->set_value('titulo_hist'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título');

 $this->data['hashtag_hist'] = array('name'  => 'hashtag_hist', 'id'    => 'hashtag_hist', 'type'  => 'text', 'value' => ($this->form_validation->set_value('hashtag_hist', $rsHistoria->hashtag_serie)) ? $this->form_validation->set_value('hashtag_hist', $rsHistoria->hashtag_serie) : $this->form_validation->set_value('hashtag_hist'), 'class' => 'form-control');

      $this->data['copy_hist'] = array(
        'name'  => 'copy_hist',
        'id'    => 'copy_hist',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('copy_hist', $rsHistoria->copy_serie)) ? $this->form_validation->set_value('copy_hist', $rsHistoria->copy_serie) : $this->form_validation->set_value('copy_hist'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la copy'        
      );


   $this->data['fecha_inicio_hist'] = array(
        'name'  => 'fecha_inicio_hist',
        'id'    => 'fecha_inicio_hist',
        'type'  => 'text',
        'value' => ($this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_serie)) ? $this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_serie) : $this->form_validation->set_value('fecha_inicio_hist'),
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
        'value' => ($this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_serie)) ? $this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_serie) : $this->form_validation->set_value('fecha_fin_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

    $this->render('admin/serie_form', $this->data);
    }else{
    
        $this->panel_bd->updateSerie();

        redirect(base_url().'admin/serie');
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
