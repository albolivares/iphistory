<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocompletado extends My_Controller
{
	
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
		
		$data = array('titulo' => 'Autocompletar');
		$this->load->view('autocompletado_view',$data);
		
	}
	

	function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$conditions['search']['keywords'] = $_GET['term'];
		  	$result = $this->panel_bd->getHistBusc($conditions);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->titulo_hist,
					'description'	=> $row->duracion_hist,
					'id_hist'	=> $row->id_hist,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

	public function autocompletar()
	{
		//si es una petición ajax y existe una variable post
		//llamada info dejamos pasar
		if($this->input->is_ajax_request() && $this->input->post('info'))
        {
        	
			$abuscar = $this->security->xss_clean($this->input->post('info'));
			$conditions['search']['keywords'] = $abuscar;
			$search = $this->panel_bd->getHistBusc($conditions);
			
			//si search es distinto de false significa que hay resultados
			//y los mostramos con un loop foreach
			if($search !== FALSE)
			{
				
				foreach($search as $fila)
				{
				?>
				
					<p><a href=""><?php echo $fila->titulo_hist ?></a></p>
				
				<?php	
				}
				
			//en otro caso decimos que no hay resultados
			}else{
			?>
				
				<p><?php echo 'No hay resultados' ?></p>
				
			<?php	
			}
			
		}
		
	}
	
}
/*
 * end application/controllers/autocompletado.php
 */