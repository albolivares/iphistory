<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Historia extends My_Controller {

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
		$this->data['rsHistorias']=$this->panel_bd->getHistorias();
		 $this->render('admin/panel_ini', $this->data);
	}


  public function nueva()
  {
    if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='nvo';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','tinymce/tinymce.min.js','jquery.multi-select.js', 'historia.js'];
    $this->data['rsSerie'] = $this->panel_bd->getSerie(1,'');
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsTiempo'] = $this->panel_bd->getTiempo();
    $this->data['id_obj']='';
    $this->data['estatusId']='0';
    $this->data['duracionId']='';
    $this->data['serieId']='';

    $this->data['portada_bg']='';
    $this->data['portada_sm']='';
    $this->data['teaser']='';
    $this->data['audio']='';
    $this->data['arrCath']='';
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Por favor escriba el título', 'trim|required');
    $this->form_validation->set_rules('historia','Por favor escriba la historia', 'trim|required');
    
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

      $this->data['historia'] = array(
        'name'  => 'historia',
        'id'    => 'historia',
        'rows'        => '3',
        'cols'        => '3',
        'value' => $this->form_validation->set_value('historia'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la descripción'        
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

    $this->render('admin/historia_form', $this->data);
    }else{
    
        $this->panel_bd->setHistoria();

        redirect(base_url().'admin/historia');
     }      
  
     
  }

   public function editar($id)
  {
    if (!$this->ion_auth->logged_in() || !is_numeric($id)) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='mod';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','tinymce/tinymce.min.js','jquery.multi-select.js', 'historia.js'];
    $this->data['rsSerie'] = $this->panel_bd->getSerie(1,'');
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsTiempo'] = $this->panel_bd->getTiempo();
    $rsHistoria=$this->panel_bd->getHistorias($id);
    if($rsHistoria) $rsHistoria=$rsHistoria[0];
    $this->data['id_obj']=$rsHistoria->id_hist;
    $this->data['estatusId']=$rsHistoria->id_estatus_hist;
    $this->data['duracionId']=$rsHistoria->duracion_hist;
    $this->data['serieId']=$rsHistoria->id_serie;

    $this->data['portada_bg']=$rsHistoria->portada_bg;
    $this->data['portada_sm']=$rsHistoria->portada_sm;
    $this->data['teaser']=$rsHistoria->teaser_audio;
    $this->data['audio']=$rsHistoria->archivo_audio;
    $rscath=$this->panel_bd->getHistCategoria($id);
    $arrCath=array();
    foreach ($rscath as $key => $cath) {
       array_push($arrCath,$cath->id_categoria);
       
     } 
     $this->data['arrCath']=$arrCath;
      /*SELECT id_hist, titulo_hist, duracion_hist, copy_hist, historia, portada_bg, portada_sm, teaser_audio, archivo_audio, duracion_audio, id_estatus_hist, id_register, id_tiempo, id_serie, hashtag_hist, fecha_inicio_hist, fecha_fin_hist, fecha_captura_hist, fecha_publicacion_hist, usuario_publica_hist, fecha_terminacion_contrato_hist, usuario_terminacion_hist FROM ips_historias WHERE 1*/
    
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('titulo_hist','Por favor escriba el título', 'trim|required');
    $this->form_validation->set_rules('historia','Por favor escriba la historia', 'trim|required');
    
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['titulo_hist'] = array('name'  => 'titulo_hist', 'id'    => 'titulo_hist', 
        'type'  => 'text', 
        'value' => ($this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_hist)) ? $this->form_validation->set_value('titulo_hist', $rsHistoria->titulo_hist) : $this->form_validation->set_value('titulo_hist'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el título');

 $this->data['hashtag_hist'] = array('name'  => 'hashtag_hist', 'id'    => 'hashtag_hist', 'type'  => 'text', 'value' => ($this->form_validation->set_value('hashtag_hist', $rsHistoria->hashtag_hist)) ? $this->form_validation->set_value('hashtag_hist', $rsHistoria->hashtag_hist) : $this->form_validation->set_value('hashtag_hist'), 'class' => 'form-control');

      $this->data['copy_hist'] = array(
        'name'  => 'copy_hist',
        'id'    => 'copy_hist',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('copy_hist', $rsHistoria->copy_hist)) ? $this->form_validation->set_value('copy_hist', $rsHistoria->copy_hist) : $this->form_validation->set_value('copy_hist'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la copy'        
      );

      $this->data['historia'] = array(
        'name'  => 'historia',
        'id'    => 'historia',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('historia', $rsHistoria->historia)) ? $this->form_validation->set_value('historia', $rsHistoria->historia) : $this->form_validation->set_value('historia'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la descripción'        
      );

   $this->data['fecha_inicio_hist'] = array(
        'name'  => 'fecha_inicio_hist',
        'id'    => 'fecha_inicio_hist',
        'type'  => 'text',
        'value' => ($this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_hist)) ? $this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fecha_inicio_hist) : $this->form_validation->set_value('fecha_inicio_hist'),
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
        'value' => ($this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_hist)) ? $this->form_validation->set_value('fecha_fin_hist', $rsHistoria->fecha_fin_hist) : $this->form_validation->set_value('fecha_fin_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de inicio.',
        'autocomplete'=>"off"
      );

    $this->render('admin/historia_form', $this->data);
    }else{
    
        $this->panel_bd->updateHistoria();

        redirect(base_url().'admin/historia');
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

      public function getInfoMp3($archivo){
        //$this->load->library("MP3File");  
        /*$mp3file = new MP3File("http://localhost/iphistory/iphistory/uploads/audio/historia/Pedigree%20me%20toca%20sobre%20Mexico%20%284%29.mp3");//http://www.npr.org/rss/podcast.php?id=510282
        $duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
        $duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
        echo "duration: $duration1 seconds"."\n";
        echo "estimate: $duration2 seconds"."\n";
        echo MP3File::formatTime($duration2)."\n";*/
      }

}
