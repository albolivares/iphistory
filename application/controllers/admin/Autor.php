<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autor extends My_Controller {

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
		$this->data['rsAutores']=$this->panel_bd->getRegister('',1,'');
		 $this->render('admin/panel_autor', $this->data);

	}


  public function nuevo()
  {
    if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='nvo';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','tinymce/tinymce.min.js','jquery.multi-select.js', 'autor.js'];
    
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsNacionalidad'] = $this->panel_bd->getNacionalidad();
    $this->data['rsEstados'] = $this->panel_bd->getEstados();
    $this->data['rsAvatars'] = $this->panel_bd->getAvatarComodin();
    $this->data['id_obj']='';
    $this->data['estatusId']='0';
    $this->data['duracionId']='';
    $this->data['serieId']='';
    $this->data['nacionalidadId']='';
    $this->data['estadosId']='';
    $this->data['pswd_act']='';
    $this->data['portada_bg']='';
    $this->data['portada_sm']='';
    $this->data['teaser']='';
    $this->data['audio']='';
    $this->data['arrCath']='';
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('apellido_p','Por favor escriba el apellido paterno', 'trim|required');
    $this->form_validation->set_rules('nombre','Por favor escriba el nombre', 'trim|required');
    $this->form_validation->set_rules('correo','Por favor escriba el correo', 'trim|required|valid_email');
    $this->form_validation->set_rules('pswd','Por favor escriba el password', 'trim|required');
    
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['num_contrato'] = array('name'  => 'num_contrato', 'id'    => 'num_contrato', 'type'  => 'text', 'value' => $this->form_validation->set_value('num_contrato'), 'class' => 'form-control');
      $this->data['apellido_p'] = array('name'  => 'apellido_p', 'id'    => 'apellido_p', 'type'  => 'text', 'value' => $this->form_validation->set_value('apellido_p'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el apellido paterno','autocomplete'=>"off");
      $this->data['apellido_m'] = array('name'  => 'apellido_m', 'id'    => 'apellido_m', 'type'  => 'text', 'value' => $this->form_validation->set_value('apellido_m'), 'class' => 'form-control');
      $this->data['nombre'] = array('name'  => 'nombre', 'id'    => 'nombre', 'type'  => 'text', 'value' => $this->form_validation->set_value('nombre'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el nombre','autocomplete'=>"off");
      $this->data['pseudonimo'] = array('name'  => 'pseudonimo', 'id'    => 'pseudonimo', 'type'  => 'text', 'value' => $this->form_validation->set_value('pseudonimo'), 'class' => 'form-control','autocomplete'=>"off");
      $this->data['correo'] = array('name'  => 'correo', 'id'    => 'correo', 'type'  => 'text', 'value' => $this->form_validation->set_value('correo'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el correo', 'email'=> 'true','autocomplete'=>"off");
      $this->data['pswd'] = array('name'  => 'pswd', 'id'    => 'pswd', 'type' => 'password', 'value' => $this->form_validation->set_value('pswd'), 'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el password','autocomplete'=>"off");


      $this->data['minibio'] = array(
        'name'  => 'minibio',
        'id'    => 'minibio',
        'rows'        => '3',
        'cols'        => '3',
        'value' => $this->form_validation->set_value('minibio'),
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

    $this->render('admin/autor_form', $this->data);
    }else{
    
        $this->panel_bd->updateAutor();

        redirect(base_url().'admin/autor');
     }      
  
     
  }

   public function editar($id)
  {
    if (!$this->ion_auth->logged_in() || !is_numeric($id)) { redirect('auth/login', 'refresh');    }
    $this->data['acc']='mod';
    $this->data['js'] = ['upload/jquery.iframe-transport.js', 'upload/jquery.fileupload.js','tinymce/tinymce.min.js','jquery.multi-select.js', 'autor.js'];
    $this->data['rsCategoria'] = $this->panel_bd->getCategoria();
    $this->data['rsNacionalidad'] = $this->panel_bd->getNacionalidad();
    $this->data['rsEstados'] = $this->panel_bd->getEstados();
    $this->data['rsAvatars'] = $this->panel_bd->getAvatarComodin();
    $rsHistoria=$this->panel_bd->getRegister($id,1,'');
    if($rsHistoria) $rsHistoria=$rsHistoria[0];
    //print_r($rsHistoria); die;
    

    $this->data['id_obj']=$rsHistoria->id_register;
    $this->data['estatusId']=$rsHistoria->estatus_register;
    $this->data['portada_bg']=$rsHistoria->foto_register;
 $this->data['nacionalidadId']=$rsHistoria->id_pais;
    $this->data['estadosId']=$rsHistoria->id_estado;
    $this->data['pswd_act']=$rsHistoria->password_register;

  
    $rscath=$this->panel_bd->getAutTopic($id);
    $arrCath=array();
    foreach ($rscath as $key => $cath) {
       array_push($arrCath,$cath->id_categoria);
       
     } 
     $this->data['arrCath']=$arrCath;
      /*SELECT id_hist, titulo_hist, duracion_hist, copy_hist, historia, portada_bg, portada_sm, teaser_audio, archivo_audio, duracion_audio, id_estatus_hist, id_register, id_tiempo, id_serie, hashtag_hist, fecha_inicio_hist, fecha_fin_hist, fecha_captura_hist, fecha_publicacion_hist, usuario_publica_hist, fecha_terminacion_contrato_hist, usuario_terminacion_hist FROM ips_historias WHERE 1*/
    
    $this->form_validation->set_rules('estatus','Por favor seleccione el estatus', 'trim|required');
    $this->form_validation->set_rules('apellido_p','Por favor escriba el apellido paterno', 'trim|required');
    $this->form_validation->set_rules('nombre','Por favor escriba el nombre', 'trim|required');
    $this->form_validation->set_rules('correo','Por favor escriba el correo', 'trim|required|valid_email');
    $this->form_validation->set_rules('pswd','Por favor escriba el password', 'trim|required');
    
      if ($this->form_validation->run() === FALSE)
     {

      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

/*stdClass Object ( [id_register] => 1 [email_register] => rulfo@gmail.com [password_register] => 140ce6821a452074e68eca62878d2702 [ap_paterno_register] => Juan [ap_materno_register] => Ramirez [nombre_register] => [fch_nacimiento_register] => 2019-01-09 [genero_register] => 2 [pseudonimo_register] => jairulf [con_avatar_register] => 1 [id_avatar] => [foto_register] => perros3 (1).jpg [estatus_register] => 0 [es_lector_register] => 0 [es_autor_register] => 1 [id_pais] => 10 [nacionalidad] => MARFILEÑA [id_estado] => 10 [entidad] => DURANGO [id_ciudad] => 282 [minibio_register] => fgjfhfgfsdfd [semblanza_register] => asfasfasfasf [numero_contrato_register] => 3444 [comentarios_register] => [fecha_alta] => 2019-01-10 05:44:21 [usuario_alta] => 1 [fecha_modifica] => [usuario_modifica] => )*/

   $this->data['num_contrato'] = array('name'  => 'num_contrato', 'id'    => 'num_contrato', 'type'  => 'text', 'value' => ($this->form_validation->set_value('num_contrato', $rsHistoria->numero_contrato_register)) ? $this->form_validation->set_value('num_contrato', $rsHistoria->numero_contrato_register) : $this->form_validation->set_value('num_contrato'),
    'class' => 'form-control');
      $this->data['apellido_p'] = array('name'  => 'apellido_p', 'id'    => 'apellido_p', 'type'  => 'text', 
        'value' => ($this->form_validation->set_value('apellido_p', $rsHistoria->ap_paterno_register)) ? $this->form_validation->set_value('apellido_p', $rsHistoria->ap_paterno_register) : $this->form_validation->set_value('apellido_p'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el apellido paterno','autocomplete'=>"off");
      $this->data['apellido_m'] = array('name'  => 'apellido_m', 'id'    => 'apellido_m', 'type'  => 'text', 'value' => ($this->form_validation->set_value('apellido_m', $rsHistoria->ap_materno_register)) ? $this->form_validation->set_value('apellido_m', $rsHistoria->ap_materno_register) : $this->form_validation->set_value('apellido_m'), 
        'class' => 'form-control');
      $this->data['nombre'] = array('name'  => 'nombre', 'id'    => 'nombre', 'type'  => 'text', 
        'value' => ($this->form_validation->set_value('nombre', $rsHistoria->nombre_register)) ? $this->form_validation->set_value('nombre', $rsHistoria->nombre_register) : $this->form_validation->set_value('nombre'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el nombre','autocomplete'=>"off");

      $this->data['pseudonimo'] = array('name'  => 'pseudonimo', 'id'    => 'pseudonimo', 'type'  => 'text', 'value' => ($this->form_validation->set_value('pseudonimo', $rsHistoria->pseudonimo_register)) ? $this->form_validation->set_value('pseudonimo', $rsHistoria->pseudonimo_register) : $this->form_validation->set_value('pseudonimo'), 
        'class' => 'form-control','autocomplete'=>"off");

      $this->data['correo'] = array('name'  => 'correo', 'id'    => 'correo', 'type'  => 'text', 
        'value' => ($this->form_validation->set_value('correo', $rsHistoria->email_register)) ? $this->form_validation->set_value('correo', $rsHistoria->email_register) : $this->form_validation->set_value('correo'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el correo', 'email'=> 'true','autocomplete'=>"off");
      $this->data['pswd'] = array('name'  => 'pswd', 'id'    => 'pswd', 'type' => 'password', 
        'value' => ($this->form_validation->set_value('pswd', $rsHistoria->password_register)) ? $this->form_validation->set_value('pswd', $rsHistoria->password_register) : $this->form_validation->set_value('pswd'), 
        'class' => 'form-control', 'required'=>'',
        'data-error'=>'Por favor escriba el password','autocomplete'=>"off");


      $this->data['minibio'] = array(
        'name'  => 'minibio',
        'id'    => 'minibio',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('minibio', $rsHistoria->minibio_register)) ? $this->form_validation->set_value('minibio', $rsHistoria->minibio_register) : $this->form_validation->set_value('minibio'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la copy'        
      );


      $this->data['historia'] = array(
        'name'  => 'historia',
        'id'    => 'historia',
        'rows'        => '3',
        'cols'        => '3',
        'value' => ($this->form_validation->set_value('historia', $rsHistoria->semblanza_register)) ? $this->form_validation->set_value('historia', $rsHistoria->semblanza_register) : $this->form_validation->set_value('historia'),
        'class' => 'form-control',
        'required'=>'',
        'data-error'=>'Por favor escriba la descripción'        
      );

   $this->data['fecha_inicio_hist'] = array(
        'name'  => 'fecha_inicio_hist',
        'id'    => 'fecha_inicio_hist',
        'type'  => 'text',
        'value' => ($this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fch_nacimiento_register)) ? $this->form_validation->set_value('fecha_inicio_hist', $rsHistoria->fch_nacimiento_register) : $this->form_validation->set_value('fecha_inicio_hist'),
        'class' => 'form-control date-picker ginput_container',
        'required'=>'',
        'maxlength'=>10,
        'data-error'=>'Por favor escriba la fecha de nacimiento.',
        'autocomplete'=>"off"
      );

    $this->render('admin/autor_form', $this->data);
    }else{
    
        $this->panel_bd->updateAutor();

        redirect(base_url().'admin/autor');
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
