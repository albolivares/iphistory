<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    
  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('session','form_validation'));
    $this->load->helper(array('url','form'));
    $this->load->database('default');
  }

  public function render($view = '', $data = []) {
    $this->load->view('rendertop');
    if($view != '')
      $this->load->view($view, $data);
    $this->load->view('renderbot');
  }
  public function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
  
  
  
}
?>