<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends My_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in()) redirect(base_url());
    $this->load->model('admin/panel_model', 'panel_bd');
  }


 public function llenaCiudad($id_tipo=false, $id=false)
 {
	 $options = "";

	 if($this->input->post('filtro') || $id_tipo)
	 {
	 ($id_tipo) ? $tipo =$id_tipo:$tipo = $this->input->post('filtro');
	 $rs = $this->panel_bd->getCiudades($tipo);
	 foreach($rs as $fila)
	 { if($id) {($id==$fila->id_ciudad) ? $selp=' selected="selected" ': $selp='';  } $selp='';
	 ?>
	 <option value="<?=$fila -> id_ciudad ?>" <?=$selp?> ><?=$fila -> ciudad ?></option>
	 <?php
	 }
	 }
 }
}