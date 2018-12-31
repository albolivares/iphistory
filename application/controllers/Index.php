<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Sugerencias_model','sugerencias',true);
    $this->load->library(array('ion_auth','session','form_validation','email'));
    $this->load->helper(array('url','form','security'));
    $email_config = $this->config->item('email_config', 'ion_auth');
    if ($this->config->item('use_ci_email', 'ion_auth') && isset($email_config) && is_array($email_config))
    {
      $this->email->initialize($email_config);
    }
  }
  
  public function index()
  {
     //if ($this->session->userdata('activado'))
      if ($this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('solicitudes', 'refresh');
      }else
      {
        $data['sugerencias'] = $this->sugerencias->getSugerenciasHome();
        $this->load->view('index',$data);
      }//else redirect('/login');
    
  }
  
  public function enviarCorreo(){
          $nombre = $this->input->post('nombre');
          $email = $this->input->post('email');
          $mensaje = 'Nombre: '.$nombre.'<br/>';
          $mensaje .= 'Email: '.$email.'<br/>';          
          $mensaje .= 'Mensaje: '.$this->input->post('mensaje');
          
          $this->email->clear();
          $this->email->from($this->config->item('admin_email', 'ion_auth'),$this->config->item('site_title', 'ion_auth'));
          $this->email->to($this->config->item('admin_email', 'ion_auth'),$this->config->item('site_title', 'ion_auth'));
          $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . 'Se recibio un correo de contacto');
          $this->email->message($mensaje);
                 
          if ($this->email->send())
          {
            $this->load->view('gracias_view');
            return TRUE;
          }
          else
          {
             print_r($this->email->print_debugger());
            return FALSE;
          }    
 /*$config = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'starttls',
    //'smtp_user' => 'aamador@cultura.gob.mx',
    //'smtp_pass' =>'Terminator1992'
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);
     $nombre = $this->input->post('nombre');
     $email = $this->input->post('email');
     $mensaje = $this->input->post('mensaje');   
     //$this->load->library('email', $config);
     //$this->email->set_newline("\r\n");
     $this->email->from($email);
     $this->email->subject('Contacto');
     $this->email->message($mensaje);
     $this->email->to('aamador@cultura.gob.mx');
     if($this->email->send()){
         echo "enviado<br/>";
         //echo $this->email->print_debugger(array('headers'));
     }else {
         echo "fallo <br/>";
         echo "error: ".$this->email->print_debugger(array('headers'));
     }*/
}

public function historial()
{
  $data['historias'] = $this->sugerencias->getSugerenciasHistoria();
  $this->load->view('historial_view',$data);
}
}
