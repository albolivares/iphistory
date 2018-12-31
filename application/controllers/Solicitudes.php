<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
  {
    parent::__construct();

    $this->load->library(array('ion_auth','session','form_validation'));
    $this->load->helper(array('url','form','security'));
		$this->load->model('Solicitudes_model');
  } 
	 
	public function index()
	{   
		  //if ($this->session->userdata('activado'))
		  if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
			
			
				if($this->session->userdata('perm')==3){
				$data['tipo_sol'] = $this->Solicitudes_model->getTipoSolicitud();
				$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudes();
				$data['lista_camb'] =$this->Solicitudes_model->getListaCambios((int)$this->session->userdata('uno'), false);
				$this->load->view('solicitudes_panel', $data);
				
				}elseif($this->session->userdata('perm')==2 || $this->session->userdata('perm')==5 || $this->ion_auth->is_admin()) {
					$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudesAprob();
					$id_usu=(int)$this->session->userdata('uno');
					$data['log_gral'] =$this->Solicitudes_model->logSolicitudUsu($id_usu);
					$data['lista_camb'] =$this->Solicitudes_model->getListaCambios((int)$this->session->userdata('uno'), true);
					$this->load->view('solicitudes_panel_aprobador', $data);
				}
			}//else redirect('/login');
	}
	
	
	
		public function lista_aprobar()
	{
		

		  if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
				//$data['tipo_sol'] = $this->Solicitudes_model->getTipoSolicitud();
				$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudesAprob(true);
				$this->load->view('solicitudes_panel_aprobador', $data);
			}//else redirect('/login');
	}
	
public function registrar($fase=false, $id=false){
if (!$this->ion_auth->logged_in())
	{
		// redirect them to the login page
			redirect('auth/login', 'refresh');
		}else
		{
		if(!$fase) 
		{
			$tipo_solicitud = $this->input->post("r_tipo");
			
			if($tipo_solicitud!='')
			{
					$carpeta=$this->generaClaveCarpeta();
					$data['tipo_solicitud'] =$tipo_solicitud;
					$data['carpeta_p'] =$carpeta;
					$campos=$this->Solicitudes_model->getCamposSolicitud($tipo_solicitud,'A');
					$data['campos'] =$campos;	
					$servs=$this->Solicitudes_model->getServidores();
					$data['servidores'] =$servs;
					$this->load->view('solicitudes_form_aut',$data);
			} else {
					$data['tipo_sol'] = $this->Solicitudes_model->getTipoSolicitud();
					$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudes();
					$data['msg_regsitro']='Se necesita un tipo de solicitud.';
					$this->load->view('solicitudes_panel', $data);
			}/*$tipo_solicitud!=''*/
		}/*!$fase*/
		elseif($fase=='uno'){
					if($tipo_solicitud==1){
					$this->form_validation->set_rules('sol_nombre', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
					$this->form_validation->set_rules('sol_desc', 'Descripción', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sol_oficio_nom', 'Oficio', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sol_objetivo', 'Objetivo general', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('sol_justifica', 'Objetivo especifico', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required');
					}else{
						$this->form_validation->set_rules('sol_nombre', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
						$this->form_validation->set_rules('sol_oficio_nom', 'Oficio', 'trim|required|xss_clean');
						$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required');
					}
					if ($this->form_validation->run() == FALSE)
					{
						$carpeta=$this->generaClaveCarpeta();
						$data['tipo_solicitud'] =$this->input->post("tipo_solictud");
						$data['carpeta_p'] =$carpeta;
						$this->load->view('solicitudes_form_aut',$data);
					}
					elseif ($this->form_validation->run() == TRUE ) 
					{
				
						$tipo_solictud = $this->input->post("tipo_solictud");
						$NOMBRE = $this->input->post("sol_nombre"); 
						$estatus_sol = $this->input->post("estatus_sol");
						$tiene_server = $this->input->post("servidor");
						$id_server = $this->input->post("id_servidor");
						$carpeta = $this->input->post("carpeta");
						
						if( ! ($this->input->post("sol_oficio_nom")) )	$oficio = $this->input->post("sol_oficio_nom"); else $oficio = '';
						if( ! ($this->input->post("sol_oficio")) )	$url_oficio = $this->input->post("sol_oficio");  else $url_oficio = '';
						if( ! ($this->input->post("sol_justifica")) ) $JUSTIFICA = $this->input->post("sol_justifica"); else $JUSTIFICA='';
						if( ! ($this->input->post("sol_objetivo")) ) $OBJETIVO = $this->input->post("sol_objetivo"); else $OBJETIVO='';
						if( ! ($this->input->post("sol_desc")) ) $DESC = $this->input->post("sol_desc"); else $DESC ='';
						if( ! ($this->input->post("sol_arqui")) ) $ARQUI = $this->input->post("sol_arqui"); else $ARQUI ='';
						if( ! ($this->input->post("sol_reqf"))) $REQF = $this->input->post("sol_reqf"); else $REQF = '';
						if( ! ($this->input->post("sol_reqt"))) $REQT = $this->input->post("sol_reqt"); else $REQT = '';
						if( ! ($this->input->post("sol_list")))	$LIST = $this->input->post("sol_list"); else $LIST = '';
						if( ! ($this->input->post("sol_siste"))) $SISTE = $this->input->post("sol_siste"); else $SISTE = '';
						if( ! ($this->input->post("sol_alim")))	$ALIM = $this->input->post("sol_alim"); else $ALIM = '';
						if( ! ($this->input->post("sol_cantg")))	$CANTG = $this->input->post("sol_cantg"); else $CANTG = '';
						if( ! ($this->input->post("sol_prodi")))	$PRODI = $this->input->post("sol_prodi"); else $PRODI = '';
						if( ! ($this->input->post("sol_ident")))	$IDENT = $this->input->post("sol_ident"); else $IDENT = '';
						if( ! ($this->input->post("avanc_solictud")))	$avance = $this->input->post("avanc_solictud"); else $avance = '';
						if( ! ($this->input->post("completa_solictud")))	$avance = $this->input->post("completa_solictud"); 
						$OFICIO_NOM=$oficio; $OFICIO=$url_oficio;
						
							$actualiza=$this->Solicitudes_model->insertaSolicitudGral($tipo_solictud, $oficio, $url_oficio, $NOMBRE, $JUSTIFICA, $OBJETIVO, $DESC, $tiene_server, $id_server, $carpeta, $ARQUI, $REQF, $LIST, $SISTE, $ALIM, $CANTG, $PRODI, $IDENT);
							if($actualiza>0)  { 
							
								if($estatus_sol==1){

									$cuenta_ob=0;
									$ob_con_dat=0;
									
									foreach($campos as $fila_camp)
										{
											if($fila_camp->ES_OBLIGATORIO==1) 
											{
												$cuenta_ob=$cuenta_ob+1; 
												if ( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} !='' )  {$ob_con_dat=$ob_con_dat+1;}
											}
										}
										$avance=($ob_con_dat*100)/$cuenta_ob;
								}
								
								if( $estatus_sol==1 && $avance==100){
									/*inserta registro en tabla de FASE_SOLICITUDES*/
									$actualiza=$this->Solicitudes_model->completaSolicitudFase1($id,$estatus);
									if($actualiza>0){
										/*Envia correo que se completo la información al usuario*/
										$correo_usu=$this->sendMailUsu($this->session->userdata('enline'), $NOMBRE, $oficio);
										
										/*Envia correo que se completo la información al aprobador*/
										$correo_admin=$this->sendMailAdmin('aolivares@cultura.gob.mx',$this->session->userdata('enline'), $proyecto, $oficio, $url_oficio, $JUSTIFICA, $OBJETIVO, $DESC);
										
										/*Envia correo que se completo la información al aprobador*/
										$correo_admin=$this->sendMailAdmin('mbustamante@cultura.gob.mx',$this->session->userdata('enline'), $proyecto, $oficio, $url_oficio, $JUSTIFICA, $OBJETIVO, $DESC);
									}
								}
															
								echo 'el proyecto se agrego correctamente'.$proyecto; 							
								redirect('/solicitudes');
							}
							else {echo 'Existio un problema al agregar!.'; 							exit();}



					}
			}/*elseif($fase=='uno')*/
			elseif($fase=="modp"){
					$tipo_solicitud = $this->input->post("r_tipo");
					$id_solicitud = $this->input->post("l_aprob");
					
					if(is_numeric($id_solicitud))
					{
						$es_admin=false;
						if(($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 )) $es_admin=true;
						$data['es_admin'] =$es_admin;	
						$campos=$this->Solicitudes_model->getCamposSolicitud($id_solicitud,'A');
						$data['campos'] =$campos;	
						$datos_sol=$this->Solicitudes_model->getSolicitud($id_solicitud, $es_admin);
					$data['datos_sol']=$datos_sol;
					foreach($datos_sol as $fila_sol){$fila_sol->ID_CONTACTO_UA; }
					$data['tipo_solicitud']=$tipo_solicitud;					
					$data['carpeta_p']=$fila_sol->CARPETA;
					$data['id_proyo']=$fila_sol->ID;
					$data['datos_per']=$this->Solicitudes_model->getDatosSolicita($fila_sol->ID_CONTACTO_UA);
					$data['logs_solicitud']=$this->Solicitudes_model->logSolicitud($id_solicitud);
					$data['datos_fase1']=$this->Solicitudes_model->consultaSolicitudFase1($id_solicitud, 2);
					$campos_desT=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'D'); 
					$data['campos_desT'] =$campos_desT;	
					$campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'F'); 
					$data['ID_EST_AP']=7;
					$data['campos_des'] =$campos_des;	
					$datos_sol_des=$this->Solicitudes_model->getSolicitudDes($id_solicitud, $es_admin);
					$data['datos_sol_des'] =$datos_sol_des;	
					
					$campos_cmbio=$this->Solicitudes_model->getCamposSolicitud($tipo_solicitud,'A');
					$data['campos_cmbio'] =$campos_cmbio;
					$data['data_cmbio'] ='';
					
					$this->load->view('solicitudes_form_cambios',$data);
					}
					else{
					$data['tipo_sol'] = $this->Solicitudes_model->getTipoSolicitud();
					$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudes();
					$data['msg_regsitro']='Se necesita un id de solicitud.';
					$this->load->view('solicitudes_panel', $data);
						
					}/*if(is_numeric($id_solicitud))*/
					
			}/*$fase=="modp"*/
			elseif($fase=="camb"){
				
				/*tipo_solictud,carpeta,id_proy_o,sol_nombre,sol_desc,sol_reqf*/
					$this->form_validation->set_rules('sol_nombre', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
					$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required|xss_clean');
					$this->form_validation->set_rules('id_proy_o', 'Id ori', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sol_desc', 'Descripción', 'trim|required|xss_clean');
					
					if ($this->form_validation->run() == FALSE)
					{
						$data['tipo_solicitud'] =$this->input->post("tipo_solictud");
						$data['id_proyo'] =$this->input->post("id_proy_o");
						$data['carpeta_p'] =$this->input->post("carpeta");
						$this->load->view('solicitudes_form_cambios',$data);
					}
					elseif ($this->form_validation->run() == TRUE ) 
					{
				
						$tipo_solictud = $this->input->post("tipo_solictud");
						$id_solictud = $this->input->post("id_proy_o");
						$NOMBRE = $this->input->post("sol_nombre"); 
						if( ! ($this->input->post("sol_desc")) ) $DESC = $this->input->post("sol_desc"); else $DESC ='';
						if( ! ($this->input->post("sol_reqf"))) $REQF = $this->input->post("sol_reqf"); else $REQF = '';/*INF ADICIONAL*/
						if( ! ($this->input->post("sol_prodi")))	$PRODI = $this->input->post("sol_prodi"); else $PRODI = '';/*PROPUESTA DISEÑO*/
						
						$actualiza=$this->Solicitudes_model->insertaCambioGral($id_solictud,$tipo_solictud,$NOMBRE, $DESC, $REQF, $PRODI);
						if($actualiza>0)  { 

								$mail=$this->sendMailCamb($this->session->userdata('enline'), $NOMBRE, $DESC, '', 10, $es_admin,'');
								$mail=$this->sendMailCamb('aolivares@cultura.gob.mx', $NOMBRE, $DESC, '', 10, true,$this->session->userdata('enline'));

								echo 'el cambio se agrego correctamente'.$proyecto; 							
								redirect('/solicitudes');
						}else{echo 'Existio un problema al agregar!.'; 							exit();}
					}

					
					
					
			}/*$fase=="camb"*/
	}/*loguin*/
}
	
	public function registrar_resp($fase=false, $id=false)
	{
		if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
			if(!$fase) {
				$tipo_solicitud = $this->input->post("r_tipo");
				
				if($tipo_solicitud!='')
				{
					$carpeta=$this->generaClaveCarpeta();
					$data['tipo_solicitud'] =$tipo_solicitud;
					$data['carpeta_p'] =$carpeta;
					
					$this->load->view('solicitudes_form',$data);
					
		//			$this->session->set_flashdata('tipo_solicitud',$tipo_solicitud);
		//			redirect('/solicitudes/registrar/');
				}else {
					$data['tipo_sol'] = $this->Solicitudes_model->getTipoSolicitud();
					$data['lista_sol'] =$this->Solicitudes_model->getListaSolicitudes();
					$data['msg_regsitro']='Se necesita un tipo de solicitud.';
					$this->load->view('solicitudes_panel', $data);
				}
			}elseif($fase=='uno'){

					$this->form_validation->set_rules('proyecto', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
					$this->form_validation->set_rules('descr', 'Descripción', 'trim|required|xss_clean');
					$this->form_validation->set_rules('oficio', 'Oficio', 'trim|required|xss_clean');
					$this->form_validation->set_rules('objeivo_g', 'Objetivo general', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('objeivo_e', 'Objetivo especifico', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required');

					if ($this->form_validation->run() == FALSE)
					{
						$carpeta=$this->generaClaveCarpeta();
						$data['tipo_solicitud'] =$this->input->post("tipo_solictud");
						$data['carpeta_p'] =$carpeta;
						$this->load->view('solicitudes_form',$data);
					}
					elseif ($this->form_validation->run() == TRUE ) 
					{
					
							$proyecto = $this->input->post("proyecto");
							$descripcion = $this->input->post("descr");
							$oficio = $this->input->post("oficio");
							$url_oficio = $this->input->post("docp");
							$objeivo_g = $this->input->post("objeivo_g");
							$objeivo_e = $this->input->post("objeivo_e");
							$tipo_solictud = $this->input->post("tipo_solictud");
							$contacto_nom = $this->input->post("contacto");
							$justifica = $this->input->post("justifica");
							$tiene_server = $this->input->post("servidor");
							$id_server = $this->input->post("id_servidor");
							$carpeta = $this->input->post("carpeta");

							$actualiza=$this->Solicitudes_model->insertaSolicitud($tipo_solictud, $oficio, $url_oficio, $proyecto, $justifica, $objeivo_g, $objeivo_e, $descripcion, $tiene_server, $id_server, $carpeta);
							if($actualiza>0)  { 
								echo 'el proyecto se agrego correctamente'.$proyecto; 							
								redirect('/solicitudes');
							}
							else {echo 'Existio un problema al agregar!.'; 							exit();}



					}
			}/*elseif($fase=='uno')*/
			
		}//else redirect('/login');
	}
	
	public function editar_c($id)
	{
		$id=(int)$id;
		$es_admin=false;
		if ($this->ion_auth->logged_in() && is_numeric($id))               
		{
			if(($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 )) $es_admin=true;
			$datos_sol=$this->Solicitudes_model->getCambio($id);
	
			foreach($datos_sol as $fila_sol){$id_sol=$fila_sol->ID_SOLICITUD; }
				$datos_sol2=$this->Solicitudes_model->getSolicitud($id_sol, $es_admin);
				$data['datos_sol'] =$datos_sol2;			
				$data['es_admin'] =$es_admin;	
				$campos=$this->Solicitudes_model->getCamposSolicitud($id_sol,'A');
					$data['campos'] =$campos;	
					$data['tipo_solicitud']=$fila_sol->TIPO_SOLICITUD;;					
					$data['carpeta_p']=$fila_sol->CARPETA;
					$data['id_proyo']=$id_sol;
					$data['datos_per']=$this->Solicitudes_model->getDatosSolicita($fila_sol->CONTACTO_S);
					$data['logs_solicitud']=$this->Solicitudes_model->logSolicitud($id_sol);
					$data['datos_fase1']=$this->Solicitudes_model->consultaSolicitudFase1($id_sol, 2);
					$campos_desT=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_S,'D'); 
					$data['campos_desT'] =$campos_desT;	
					$campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_S,'F'); 
					$data['ID_EST_AP']=7;
					$data['campos_des'] =$campos_des;	
					$datos_sol_des=$this->Solicitudes_model->getSolicitudDes($id_sol, $es_admin);
					$data['datos_sol_des'] =$datos_sol_des;	
					
					$campos_cmbio=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'A');
					$data['campos_cmbio'] =$campos_cmbio;
					$data['data_cmbio'] =$datos_sol;
					
					
					$this->load->view('solicitudes_form_cambios',$data);
			
		}
	}
	
	public function editar($tipo, $id)
	{
		$id=(int)$id;
		if ($this->ion_auth->logged_in() && is_numeric($id))               
		{
			$es_admin=false;
			if($tipo=='m') $data['acc']="modificar"; elseif($tipo=='e') $data['acc']="eliminar";
			if(($this->session->userdata('perm')==2 || $this->ion_auth->is_admin() || $this->session->userdata('perm')==5 )) $es_admin=true;
			$datos_sol=$this->Solicitudes_model->getSolicitud($id, $es_admin);
			foreach($datos_sol as $fila_sol){$fila_sol->ID_CONTACTO_UA; }
			
			$data['servidores']=$this->Solicitudes_model->getServidores($es_admin, $fila_sol->ID_CONTACTO_UA);
			$data['datos_sol']=$datos_sol;
			$data['datos_fase1']='';
			$campos=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'A');
			$data['campos'] =$campos;	
			if($fila_sol->ESTATUS_PROY>1) {$data['datos_fase1']=$this->Solicitudes_model->consultaSolicitudFase1($id, $fila_sol->ESTATUS_PROY);}
			$data['datos_per']=$this->Solicitudes_model->getDatosSolicita($fila_sol->ID_CONTACTO_UA);
			
			$data['logs_solicitud']=$this->Solicitudes_model->logSolicitud($id); 
			

			
			if($fila_sol->ESTATUS_PROY==2 || $fila_sol->ESTATUS_PROY==11 || $fila_sol->ESTATUS_PROY==12 || $fila_sol->ESTATUS_PROY==14 || $fila_sol->ESTATUS_PROY==7 ) 
			{
				$data['datos_fase1']=$this->Solicitudes_model->consultaSolicitudFase1($id, 2);
				if( ( (!$fila_sol->PRODI && $fila_sol->ESTATUS_PROY<>7 && $fila_sol->PRODI!='') || $fila_sol->ESTATUS_PROY==11) && $fila_sol->ESTATUS_PROY<>14) 
				{

					$campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'D'); 
					$data['ID_EST_AP']=11;
				}elseif($fila_sol->ESTATUS_PROY==14){
						$campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'F'); 
						if($es_admin) $campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'D'); 
						else $campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'F'); 
						$data['ID_EST_AP']=14;
					}
				elseif($fila_sol->ESTATUS_PROY==7){
					$campos_desT=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'D'); 
					$data['campos_desT'] =$campos_desT;	
						if($es_admin) $campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'F'); 
						else $campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'F'); 
						$data['ID_EST_AP']=7;
			}
				else {$campos_des=$this->Solicitudes_model->getCamposSolicitud($fila_sol->TIPO_SOLICITUD,'G'); if($fila_sol->ESTATUS_PROY!=12)  $data['ID_EST_AP']=2; else  $data['ID_EST_AP']=12; 

				}
				$data['campos_des'] =$campos_des;	
				$datos_sol_des=$this->Solicitudes_model->getSolicitudDes($id, $es_admin);
			
				$data['datos_sol_des'] =$datos_sol_des;	
				$this->load->view('solicitudes_form_fase2',$data);
			}
			else $this->load->view('solicitudes_form_mod_aut',$data);
			
		}else redirect('auth/login', 'refresh');
	}
	
	
	public function modificar()
	{

		if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
				$tipo_solicitud = $this->input->post("tipo_solictud");

					if($tipo_solicitud==1){
					$this->form_validation->set_rules('sol_nombre', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
					$this->form_validation->set_rules('sol_desc', 'Descripción', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sol_oficio_nom', 'Oficio', 'trim|required|xss_clean');
					$this->form_validation->set_rules('sol_objetivo', 'Objetivo general', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('sol_justifica', 'Objetivo especifico', 'trim|required|xss_clean|min_length[3]');
					$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required');
					}else{
						$this->form_validation->set_rules('sol_nombre', 'Nombre', 'trim|required|xss_clean|min_length[3]|max_length[255]');
						$this->form_validation->set_rules('sol_oficio_nom', 'Oficio', 'trim|required|xss_clean');
						$this->form_validation->set_rules('tipo_solictud', 'Tipo', 'trim|required');
					}

					

		if ($this->form_validation->run() == FALSE)
		{
			redirect('/solicitudes');
		}
		elseif ($this->form_validation->run() == TRUE ) 
		{
		
				$id = $this->input->post("id_solictud");
				$tipo_solictud = $this->input->post("tipo_solictud");
				$NOMBRE = $this->input->post("sol_nombre"); 
				$estatus_sol = $this->input->post("estatus_sol");

				$tiene_server = $this->input->post("servidor");
				$id_server = $this->input->post("id_servidor");
				$carpeta = $this->input->post("carpeta");
				
				if( ! ($this->input->post("sol_oficio_nom")) )	$oficio = $this->input->post("sol_oficio_nom"); else $oficio = '';
				if( ! ($this->input->post("sol_oficio")) )	$url_oficio = $this->input->post("sol_oficio");  else $url_oficio = '';
				if( ! ($this->input->post("sol_justifica")) ) $JUSTIFICA = $this->input->post("sol_justifica"); else $JUSTIFICA='';
				if( ! ($this->input->post("sol_objetivo")) ) $OBJETIVO = $this->input->post("sol_objetivo"); else $OBJETIVO='';
				if( ! ($this->input->post("sol_desc")) ) $DESC = $this->input->post("sol_desc"); else $DESC ='';				
				if( ! ($this->input->post("sol_arqui")) ) $ARQUI = $this->input->post("sol_arqui"); else $ARQUI ='';
				if( ! ($this->input->post("sol_reqf"))) $REQF = $this->input->post("sol_reqf"); else $REQF = '';
				if( ! ($this->input->post("sol_reqt"))) $REQT = $this->input->post("sol_reqt"); else $REQT = '';
				if( ! ($this->input->post("sol_list")))	$LIST = $this->input->post("sol_list"); else $LIST = '';
				if( ! ($this->input->post("sol_siste"))) $SISTE = $this->input->post("sol_siste"); else $SISTE = '';
				if( ! ($this->input->post("sol_alim")))	$ALIM = $this->input->post("sol_alim"); else $ALIM = '';
				if( ! ($this->input->post("sol_cantg")))	$CANTG = $this->input->post("sol_cantg"); else $CANTG = '';
				if( ! ($this->input->post("sol_prodi")))	$PRODI = $this->input->post("sol_prodi"); else $PRODI = '';
				if( ! ($this->input->post("sol_ident")))	$IDENT = $this->input->post("sol_ident"); else $IDENT = '';
				if( ! ($this->input->post("avanc_solictud")))	$avance = $this->input->post("avanc_solictud"); else $avance = '';
				if( ! ($this->input->post("completa_solictud")))	$avance = $this->input->post("completa_solictud"); 
				$OFICIO_NOM=$oficio; $OFICIO=$url_oficio;
				
				/*	$AVANCE=$fila_sol->PORC_AVANCE_DOC;
	
	$OFICIO_NOM=$fila_sol->OFICIO_NOM; $OFICIO=$fila_sol->OFICIO; $NOMBRE=$fila_sol->NOMBRE;
	$JUSTIFICA=$fila_sol->JUSTIFICA; $OBJETIVO=$fila_sol->OBJETIVO; $DESC=$fila_sol->DESC; 
	$ARQUI=$fila_sol->ARQUI; $REQF=$fila_sol->REQF; $REQT=$fila_sol->REQT; $LIST=$fila_sol->LIST; $ALIM=$fila_sol->ALIM; 
	$SISTE=$fila_sol->SISTE;  $CANTG=$fila_sol->CANTG; $PRODI=$fila_sol->PRODI; $IDENT=$fila_sol->IDENT; */
				
							
				$actualiza=$this->Solicitudes_model->modificaSolicitudFase1($id,$tipo_solictud, $oficio, $url_oficio, $NOMBRE, $JUSTIFICA, $OBJETIVO, $DESC, $tiene_server, $id_server, $carpeta, $ARQUI, $REQF, $REQT, $LIST, $SISTE, $ALIM, $CANTG, $PRODI, $IDENT, $avance);
				
				if($estatus_sol==1 && $avance<100 ){
					$campos=$this->Solicitudes_model->getCamposSolicitud($tipo_solictud,'A');
					$cuenta_ob=0;
					$ob_con_dat=0;
					
					foreach($campos as $fila_camp)
						{
							if($fila_camp->ES_OBLIGATORIO==1) 
							{
								$cuenta_ob=$cuenta_ob+1; 
								if ( ${strtoupper(str_replace('sol_','',$fila_camp->CVE_TIPO))} !='' )  {$ob_con_dat=$ob_con_dat+1;}
							}
						}
						$avance=($ob_con_dat*100)/$cuenta_ob;
				}
				
				if( $estatus_sol==1 && $avance==100){
					/*inserta registro en tabla de FASE_SOLICITUDES*/
					$actualiza=$this->Solicitudes_model->completaSolicitudFase1($id,$estatus_sol);
					if($actualiza>0){
						/*Envia correo que se completo la información al usuario*/
						echo $this->session->userdata('enline');
						
						/*Envia correo que se completo la información al aprobador*/
						$correo_admin=$this->sendMailAdmin('aolivares@cultura.gob.mx',$this->session->userdata('enline'), $NOMBRE, $oficio, $url_oficio, $JUSTIFICA, $OBJETIVO, $DESC);
						
						$correo_usu=$this->sendMailUsu($this->session->userdata('enline'), $NOMBRE, $oficio, $OBJETIVO, $DESC);

						
					}
				}elseif( $estatus_sol==9 && $avance==100){
					
				}
				
				redirect('/solicitudes');

/*				if($actualiza)  { 
					echo 'el proyecto se modifico correctamente'.$id; 							
					redirect('/solicitudes');
					}
			else {echo 'Existio un problema al agregar!.'; 							exit();}
*/
		}
	}
}
	
public function modificar_c()
{

if (!$this->ion_auth->logged_in())
	{
	// redirect them to the login page
		redirect('auth/login', 'refresh');
	}else
	{

		$this->form_validation->set_rules('id_proy_o', 'Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_camb_o', 'Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('est_camb_o', 'Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('aprobada_s', 'Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('comentario_aprueba', 'Id', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
				{
					redirect('/solicitudes');
				}
				elseif ($this->form_validation->run() == TRUE ) 
				{
				
						$id_sol = $this->input->post("id_proy_o");
						$id_camb = $this->input->post("id_camb_o");
						$est_camb = $this->input->post("est_camb_o");
						$aprobada = $this->input->post("aprobada_s");
						$comentario = $this->input->post("comentario_aprueba");
						
						$NOMBRE = $this->input->post("sol_nombre"); 
						if( ! ($this->input->post("sol_desc")) ) $DESC = $this->input->post("sol_desc"); else $DESC ='';
						if( ! ($this->input->post("corr_camb_o")) ) $CORR_USU = $this->input->post("corr_camb_o"); else $CORR_USU ='';
					
						
						$actualiza=$this->Solicitudes_model->actCambio($id_sol, $id_camb, $est_camb,$aprobada, $comentario);
						if( ($aprobada==7 || $aprobada==8 || $aprobada==11) && $CORR_USU!='') $mail=$this->sendMailCamb($CORR_USU, $NOMBRE, $DESC, $comentario, $aprobada, $es_admin, '');
						else  $mail=$this->sendMailCamb($this->session->userdata('enline'), $NOMBRE, $DESC, $comentario, $aprobada, $es_admin,'');
						

						
						redirect('/solicitudes');
						
				}

	}
}
	
	public function aprobar()
	{

		if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
		$this->form_validation->set_rules('id_solictud_ap', 'Id', 'trim|required');
		$this->form_validation->set_rules('comentario_aprueba', 'Descripción', 'trim|required|xss_clean');
		$this->form_validation->set_rules('aprobada_s', 'Oficio', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			redirect('/solicitudes');
		}
		elseif ($this->form_validation->run() == TRUE ) 
		{
		
				$id = $this->input->post("id_solictud_ap");
				$comentario = $this->input->post("comentario_aprueba");
				$estatus = $this->input->post("aprobada_s");
				$nombre_proy = $this->input->post("nom_solictud_ap");
				$correo_usuario = $this->input->post("usu_solictud_ap");
				
				$estatus_text='';
				if($estatus==1) $estatus_text='Aprobada';
				elseif($estatus==9) $estatus_text='No aprobada por falta de documentación y/o datos. Se le pide corregir y verificar su documentación.';
				elseif($estatus==8) $estatus_text='No aprobada, se rechaza la solicitud.';
				         /*                         <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==2) echo 'checked'; ?> value="1" required  > &nbsp; Sí &nbsp;
                                  <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==9) echo 'checked'; ?> value="9"   > &nbsp; No aprobada por falta de documentación y/o datos&nbsp;
                                  <input type="radio" class="flat" name="aprobada_s" id="aprobada_s" <?php if($id_fase1==8) echo 'checked'; ?> value="8"   > &nbsp; No aprobada, se rechaza la solicitud.&nbsp;
				*/
				$actualiza=$this->Solicitudes_model->apruebaSolicitudFase1($id,$comentario, $estatus);
				if($actualiza>0)  { 
					echo 'el proyecto se aprobo correctamente'.$id;
					$correo_aprob=$this->sendMailUsuAprobFase1($correo_usuario, $nombre_proy, $estatus_text, $comentario); 							
					redirect('/solicitudes');
					}
			else {echo 'Existio un problema al agregar!.'; 							exit();}

		}
	}
}


	public function aprobarf2()
	{

		if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
		$this->form_validation->set_rules('id_solictud_ap', 'Id', 'trim|required');
		$this->form_validation->set_rules('carpeta', 'carpeta', 'trim|required|xss_clean');
		

		if ($this->form_validation->run() == FALSE)
		{
			redirect('/solicitudes');
		}
		elseif ($this->form_validation->run() == TRUE ) 
		{
		
				$id = $this->input->post("id_solictud_ap");
				$carpeta = $this->input->post("carpeta");
				$estatus = $this->input->post("id_est_ap");
				$avance = $this->input->post("avancd_solictud");
				
				if( ! ($this->input->post("sol_propd")) ) $propd  = $this->input->post("sol_propd"); else $propd ='';
				if( ! ($this->input->post("sol_based")) ) $based  = $this->input->post("sol_based"); else $based ='';
				if( ! ($this->input->post("sol_maque")) ) $maque  = $this->input->post("sol_maque"); else $maque ='';
				if( ! ($this->input->post("sol_integra")) ) $integra  = $this->input->post("sol_integra"); else $integra ='';
				if( ! ($this->input->post("sol_cmsn")) ) $cmsn  = $this->input->post("sol_cmsn"); else $cmsn ='';
				if( ! ($this->input->post("sol_cmse")) ) $cmse  = $this->input->post("sol_cmse"); else $cmse ='';
				if( ! ($this->input->post("sol_grafb")) ) $grafb  = $this->input->post("sol_grafb"); else $grafb ='';
				if( ! ($this->input->post("sol_prufi")) ) $prufi  = $this->input->post("sol_prufi"); else $prufi ='';
				if( ! ($this->input->post("sol_valuf")) ) $valuf  = $this->input->post("sol_valuf"); else $valuf ='';
				if( ! ($this->input->post("sol_comf")) ) $comf  = $this->input->post("sol_comf"); else $comf ='';
				if( ! ($this->input->post("sol_envapr")) ) $envapr = $this->input->post("sol_envapr"); else $envapr='';
				if( ! ($this->input->post("sol_manut")) ) $manut = $this->input->post("sol_manut"); else $manut='';
				if( ! ($this->input->post("sol_manuu")) ) $manuu = $this->input->post("sol_manuu"); else $manuu='';
				if( ! ($this->input->post("sol_manut")) ) $manut = $this->input->post("sol_manut"); else $manut='';
				if( ! ($this->input->post("sol_comvpgd")) ) $sol_comvpgd = $this->input->post("sol_comvpgd"); else $sol_comvpgd='';								
				if( ! ($this->input->post("sol_valpgd")) ) $sol_valpgd = $this->input->post("sol_valpgd"); else $sol_valpgd='';

				$correosol = $this->input->post("csol");
				$nombre_proy = $this->input->post("nproy");
				$comentarios='';
				

				if( ($estatus==12 && $propd!='') || ($estatus==2 && $propd!='') ){
					$accion='envio_propuesta';
					$estatusf=12;
					$enviapropuesta=$this->Solicitudes_model->enviaPropuestaGrafica($id,$estatusf, $propd);
					$correop=$this->sendMailGrafica($correosol,$nombre_proy,$propd, 'Se envía la propuesta gráfica para su aprobación, para hacerlo es necesario que ingrese al sistema. Una vez que se apruebe comenzará la fase de desarrollo.', $comentarios, $accion, '');

					$actualiza=$this->Solicitudes_model->insertaSolicitudDes($id,$carpeta, $estatusf, $avance, $propd,	$based,	$maque,	$integra,	$cmsn,	$cmse,	$grafb,	$prufi,	$valuf,	$comf, $envapr, $manut, $manuu);
				}
				elseif($estatus!=12 && $estatus!=2){ $actualiza=$this->Solicitudes_model->insertaSolicitudDes($id,$carpeta, $estatus, $avance, $propd,	$based,	$maque,	$integra,	$cmsn,	$cmse,	$grafb,	$prufi,	$valuf,	$comf, $envapr, $manut, $manuu);
				}
				if($actualiza>0)  { 
					echo 'el proyecto se aprobo correctamente'.$id;
					redirect('/solicitudes');
					}
			else {echo 'Existio un problema al agregar!.'; 							exit();}

		}
	}
}

public function modificarf2()
	{

		if (!$this->ion_auth->logged_in())
      {
      // redirect them to the login page
        redirect('auth/login', 'refresh');
      }else
      {
		$this->form_validation->set_rules('id_solictud_ap', 'Id', 'trim|required');
		$this->form_validation->set_rules('carpeta', 'carpeta', 'trim|required|xss_clean');
		

		if ($this->form_validation->run() == FALSE)
		{
			redirect('/solicitudes');
		}
		elseif ($this->form_validation->run() == TRUE ) 
		{
				$id = $this->input->post("id_solictud_ap");
				$idaprob = $this->input->post("id_des_ap");
				$avance = $this->input->post("avancd_solictud");
				$estatus = $this->input->post("id_est_ap");
				
				if( ! ($this->input->post("sol_propd")) ) $propd  = $this->input->post("sol_propd"); else $propd ='';
				if( ! ($this->input->post("sol_based")) ) $based  = $this->input->post("sol_based"); else $based ='';
				if( ! ($this->input->post("sol_maque")) ) $maque  = $this->input->post("sol_maque"); else $maque ='';
				if( ! ($this->input->post("sol_integra")) ) $integra  = $this->input->post("sol_integra"); else $integra ='';
				if( ! ($this->input->post("sol_cmsn")) ) $cmsn  = $this->input->post("sol_cmsn"); else $cmsn ='';
				if( ! ($this->input->post("sol_cmse")) ) $cmse  = $this->input->post("sol_cmse"); else $cmse ='';
				if( ! ($this->input->post("sol_grafb")) ) $grafb  = $this->input->post("sol_grafb"); else $grafb ='';
				if( ! ($this->input->post("sol_prufi")) ) $prufi  = $this->input->post("sol_prufi"); else $prufi ='';
				if( ! ($this->input->post("sol_valuf")) ) $valuf  = $this->input->post("sol_valuf"); else $valuf ='';
				if( ! ($this->input->post("sol_comf")) ) $comf  = $this->input->post("sol_comf"); else $comf ='';
				if( ! ($this->input->post("sol_envapr")) ) $envapr = $this->input->post("sol_envapr"); else $envapr='';
				if( ! ($this->input->post("sol_manut")) ) $manut = $this->input->post("sol_manut"); else $manut='';
				if( ! ($this->input->post("sol_manuu")) ) $manuu = $this->input->post("sol_manuu"); else $manuu='';
				if( ! ($this->input->post("sol_comvpgd")) ) $sol_comvpgd = $this->input->post("sol_comvpgd"); else $sol_comvpgd='';								
				if( ! ($this->input->post("sol_valpgd")) ) $sol_valpgd = $this->input->post("sol_valpgd"); else $sol_valpgd='';
				if( ! ($this->input->post("nvo_disenio")) ) $nvo_disenio = $this->input->post("nvo_disenio"); else $nvo_disenio='';
				
				$correosol = $this->input->post("csol");
				$nombre_proy = $this->input->post("nproy");
				$correoaprob = $this->input->post("cval");
				
						
				if( ($estatus==12 && $propd!='') || ($estatus==2 && $propd!='') )
				{
						if($nvo_disenio=='esndisenio') 
						{
							$enviapropuesta=$this->Solicitudes_model->enviaPropuestaGrafica($id,12, $propd);
							/*envia correo de nueva propuesta de diseño*/
							$correop=$this->sendMailGrafica($correosol,$nombre_proy,$propd, 'Se envía la propuesta gráfica para su aprobación, para aprobarla es necesario que ingrese al sistema. Una vez que se apruebe comenzará la fase de desarrollo.', $comentarios, 'envio_propuesta', '');

							$actualiza=$this->Solicitudes_model->modificaSolicitudDes($id, $idaprob, $avance, $propd,	'',	'',	'',	'',	'',	'',	'',	'',	'', '', '', '', '', '', 12);
						} else {
							$actualiza=$this->Solicitudes_model->validaPropuestaGrafica($id,$estatus, $propd, $sol_valpgd, $sol_comvpgd);
							$correog=$this->Solicitudes_model->consultaCorreoGrafica($id);
							foreach($correog as $fila_correo_des)
							{
							$correoaprob=$fila_camp_des->VC_CORREO;
							$correop=$this->sendMailGrafica($correoaprob,$nombre_proy,$propd, $sol_valpgd, $sol_comvpgd, 'valida_propuesta','');
							$correop=$this->sendMailGrafica($this->session->userdata('enline'),$nombre_proy,$propd, $sol_valpgd, $sol_comvpgd, 'valida_propuesta','');
							}/*foreach*/
						}/*if($nvo_disenio...*/
				}elseif($estatus==11 && $avance==100 && $envapr==1){
						/*se envia el aviso que el sistema ya se desarrollo y esta completo, este aviso lo envia el desarrollador*/
						$actualiza=$this->Solicitudes_model->enviaPropuestaFinal($id,$estatus, $envapr);
						$correop=$this->sendMailGrafica($correoaprob,$nombre_proy,$propd, $sol_valpgd, $sol_comvpgd, 'aviso_desarrollo', $manut);
						$correop=$this->sendMailGrafica($this->session->userdata('enline'),$nombre_proy,$propd, $sol_valpgd, $sol_comvpgd, 'aviso_desarrollo',$manut);
						
				}elseif($estatus==14){
						/*se envia el aviso que el sistema ya se desarrollo y esta completo, este aviso lo envia el desarrollador*/
						$actualiza=$this->Solicitudes_model->validaPropuestaFinal($id,$estatus, $valuf, $comf);
						$correop=$this->sendMailGrafica($correoaprob,$nombre_proy,$propd, $valuf, $comf, 'valida_desarrollo',$manut);
						$correop=$this->sendMailGrafica($this->session->userdata('enline'),$nombre_proy,$propd, $valuf, $comf, 'valida_desarrollo',$manut);
				}
				else $actualiza=$this->Solicitudes_model->modificaSolicitudDes($id, $idaprob, $avance, $propd,	$based,	$maque,	$integra,	$cmsn,	$cmse,	$grafb,	$prufi,	$valuf,	$comf, $envapr, $manut, $manuu, $sol_valpgd, $sol_comvpgd);
				
				if($actualiza)  { 
					echo 'el proyecto se aprobo correctamente'.$id;
					redirect('/solicitudes');
					}
			else {echo 'Existio un problema al agregar!.'; 							exit();}

		}
	}
}
	
	public function generaClaveCarpeta(){
      $key = "";
$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
//aquí podemos incluir incluso caracteres especiales pero cuidado con las ' y " y algunos otros
$length = 10;
$max = strlen($caracteres) - 1;
for ($i=0;$i<$length;$i++) {
$key .= substr($caracteres, rand(0, $max), 1);
}
return $key;
}


public function enviarCor(){
  $config = array(
     'protocol' => 'smtp',
     'smtp_host' => 'smtp.googlemail.com',
     'smtp_user' => 'scdesarrollo@gmail.com', //Su Correo de Gmail Aqui
     'smtp_pass' => 't17cult_sec', // Su Password de Gmail aqui
     'smtp_port' => '465',
     'smtp_crypto' => 'ssl',
     'mailtype' => 'html',
     'wordwrap' => TRUE,
     'charset' => 'utf-8'
     );
     $this->load->library('email', $config);
     $this->email->set_newline("\r\n");
     $this->email->from('scdesarrollo@example.com');
     $this->email->subject('Asunto del correo');
     $this->email->message('Hola desde correo');
     $this->email->to('aolivares@cultura.gob.mx');
     if($this->email->send(FALSE)){
         echo "enviado<br/>";
         echo $this->email->print_debugger(array('headers'));
     }else {
         echo "fallo <br/>";
         echo "error: ".$this->email->print_debugger(array('headers'));
     }
}

public function sendMailGmail()
	{
		//cargamos la libreria email de ci
		$this->load->library("email");

		//configuracion para gmail
		$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
     'smtp_user' => 'scdesarrollo@gmail.com', //Su Correo de Gmail Aqui
     'smtp_pass' => 't17cult_sec', // Su Password de Gmail aqui
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);    

		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);

		$this->email->from('Alberto Olivares');
		$this->email->to("aolivares@cultura.gob.mx");
		$this->email->subject('Bienvenido/a a uno-de-piera.com');
		$this->email->message('<h2>Email enviado con codeigniter haciendo uso del smtp de gmail</h2><hr><br> Bienvenido al blog');
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());
	}

public function sendMailUsu($correo_usuario, $nombre_proy, $oficio, $objeivo, $descripcion)
	{
		//cargamos la libreria email de ci
				$this->load->library("email");

		//configuracion para gmail
	/*	$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
     'smtp_user' => 'scdesarrollo@gmail.com', //Su Correo de Gmail Aqui
     'smtp_pass' => 't17cult_sec', // Su Password de Gmail aqui
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);  */
		
		$configGmail = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);



		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);
				//$this->email->clear();			
		$this->email->from('desarrolloweb@cultura.gob.mx','Administrador de Proyectos TIC');
		$this->email->to($correo_usuario);
		$this->email->subject("Usted ha completado la información requerida para la solicitud del proyecto: ". $nombre_proy );


		$str_msg='<html><head><title>Administrador de Proyectos TIC</title></head><body style="background-color:#F7F7F7; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<div style="width:100%; max-width:900px; margin:auto; margin-left:auto; margin-right:auto"><table style="color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px;background: #fff; border: 1px solid #e6e9ed; display: inline-block; padding: 10px 17px; width:100%; max-width:900px; margin:auto; border:0">';
		$str_msg.='<tr><td><div style="border-bottom: 2px solid #e6e9ed; padding: 1px 5px 6px; margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px"><strong>Administrador de Proyectos TIC</strong></div></td></tr>';
		$str_msg.='<tr><td><div style="margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<p style="font-weight: 300; line-height: 1.4; margin-bottom: 20px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; ">Le informamos que se ha recibido la información completa del proyecto <strong>"'.$nombre_proy.'"</strong>, con las siguientes características:</p>';
		$str_msg.='<p><strong>Nombre:</strong>'.$nombre_proy.'<br/><br/>';
		$str_msg.='<strong>Oficio:</strong>'.$oficio.'<br/><br/>';
		if($objeivo!='') $str_msg.='<strong>Objetivo: </strong><br/>'.$objeivo.'<br/><br/>';
		$str_msg.='<strong>Descripción: </strong><br/>'.$descripcion.'<br/><br/>';
		$str_msg.='<br/><br/>La información completa será revisada. Una vez que se tenga una respuesta, se le informara a través de este medio y podrá darle seguimiento en el Sistema de Administración de proyectos.<br/></p>';
		$str_msg.='</div></td></tr>';
		$str_msg.='</table></div></body></html>';
		$this->email->message($str_msg);
		$this->email->send();
		//con esto podemos ver el resultado
		//var_dump($this->email->print_debugger());
		
	}
	
public function sendMailAdmin($correo_aprobador,$correo_usuario, $nombre_proy, $oficio, $url_oficio, $justifica, $objeivo, $descripcion)
	{

		$this->load->library("email");
		//configuracion para gmail
		/*$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
     'smtp_user' => 'scdesarrollo@gmail.com', //Su Correo de Gmail Aqui
     'smtp_pass' => 't17cult_sec', // Su Password de Gmail aqui
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);    */
		
		$configGmail = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);

		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);
		//$this->email->clear();
		$this->email->from('desarrolloweb@cultura.gob.mx','Administrador de Proyectos TIC');
		$this->email->to($correo_aprobador);
		$this->email->subject('Se ha completado la información requerida del proyecto: '. $nombre_proy );
		//$this->email->cc('another@another-example.com');
//$this->email->bcc('them@their-example.com');
//$this->email->attach('image.jpg', 'inline');
//$this->email->attach('http://example.com/filename.pdf');
/*$filename = '/img/photo1.jpg';
$this->email->attach($filename);
foreach ($list as $address)
{
        $this->email->to($address);
        $cid = $this->email->attachment_cid($filename);
        $this->email->message('<img src="cid:'. $cid .'" alt="photo1" />');
        $this->email->send();
}*/

		$str_msg='<html><head><title>Administrador de Proyectos TIC</title></head><body style="background-color:#F7F7F7; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<div style="width:100%; max-width:900px; margin:auto; margin-left:auto; margin-right:auto"><table style="color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px;background: #fff; border: 1px solid #e6e9ed; display: inline-block; padding: 10px 17px; width:100%; max-width:900px; margin:auto; border:0">';
		$str_msg.='<tr><td><div style="border-bottom: 2px solid #e6e9ed; padding: 1px 5px 6px; margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px"><strong>Administrador de Proyectos TIC</strong></div></td></tr>';
		$str_msg.='<tr><td><div style="margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<p style="font-weight: 300; line-height: 1.4; margin-bottom: 20px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; ">Le informamos que se ha recibido la información completa del proyecto <strong>"'.$nombre_proy.'"</strong>, con las siguientes características:</p>';
  	$str_msg.='<p><strong>Solicitante: </strong>'.$correo_usuario.'<br/><br/>';
		$str_msg.='<strong>Nombre del proyecto: </strong>'.$nombre_proy.'<br/><br/>';
		$str_msg.='<strong>Oficio: </strong>'.$oficio.'<br/><br/>';
		$str_msg.='<strong>Url Oficio: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$url_oficio.'<br/><br/>';
		if($objeivo!='')  $str_msg.='<strong>Objetivo: </strong><br/>'.$objeivo.'<br/><br/>';
		$str_msg.='<strong>Descripción: </strong><br/>'.$descripcion.'<br/><br/>';
		$str_msg.='<br/><br/>La información completa esta disponible en el sistema. Se envía esta información para su valoración y revisión.<br/> <br/>';
		$str_msg.='</p></div></td></tr>';
		$str_msg.='</table></div></body></html>';
		$this->email->message($str_msg);
		$this->email->send();
		//con esto podemos ver el resultado
		//var_dump($this->email->print_debugger());
		//exit();
	}	
	
	
	public function sendMailUsuAprobFase1($correo_usuario, $nombre_proy, $estatus_aprob, $descripcion_aprob)
	{
		//cargamos la libreria email de ci
		$this->load->library("email");

		//configuracion para gmail
		/*$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
     'smtp_user' => 'scdesarrollo@gmail.com', //Su Correo de Gmail Aqui
     'smtp_pass' => 't17cult_sec', // Su Password de Gmail aqui
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		); */   
		
		$configGmail = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);

		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);

		$this->email->from('desarrolloweb@cultura.gob.mx','Administrador de Proyectos TIC');
		$this->email->to($correo_usuario);
		$this->email->subject('Información del proyecto: '. $nombre_proy );
		//$str_msg = 'MIME-Version: 1.0' . "\r\n";
		//$str_msg .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$str_msg='<html><head><title>Administrador de Proyectos TIC</title></head><body style="background-color:#F7F7F7; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<div style="width:100%; max-width:900px; margin:auto; margin-left:auto; margin-right:auto"><table style="color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px;background: #fff; border: 1px solid #e6e9ed; display: inline-block; padding: 10px 17px; width:100%; max-width:900px; margin:auto; border:0">';
		$str_msg.='<tr><td><div style="border-bottom: 2px solid #e6e9ed; padding: 1px 5px 6px; margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px"><strong>Administrador de Proyectos TIC</strong></div></td></tr>';
		$str_msg.='<tr><td><div style="margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<p style="font-weight: 300; line-height: 1.4; margin-bottom: 20px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; ">Le informamos que se ha revisado la información del proyecto <strong>"'.$nombre_proy.'"</strong>, y con base en ella, el proyecto ha sido: '.$estatus_aprob.' </p>';
		$str_msg.='<p><strong>Comentarios del aprobador: </strong><br/>'.$descripcion_aprob.'<br/><br/>';
		$str_msg.='<br/><br/>Le agradecemos su atención y si requiere más información al respecto podrá encontrarla en el Sistema de Administración de proyectos.<br/></p>';
		$str_msg.='</div></td></tr>';
		$str_msg.='</table></div></body></html>';
		$this->email->message($str_msg);
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());

	}
	
	public function sendMailGrafica($correo_usuario,$nombre_proy,$propd, $mensaje, $comentarios, $accion, $datos_des)
	{
		//cargamos la libreria email de ci
		$this->load->library("email");
		
		$configGmail = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);

		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);

		$this->email->from('desarrolloweb@cultura.gob.mx','Administrador de Proyectos TIC');
		$this->email->to($correo_usuario);
		$this->email->bcc('aolivares@cultura.gob.mx');
		$this->email->subject('Información del proyecto: '. $nombre_proy );
		//$str_msg = 'MIME-Version: 1.0' . "\r\n";
		//$str_msg .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$str_msg='<html><head><title>Administrador de Proyectos TIC</title></head><body style="background-color:#F7F7F7; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<div style="width:100%; max-width:900px; margin:auto; margin-left:auto; margin-right:auto"><table style="color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px;background: #fff; border: 1px solid #e6e9ed; display: inline-block; padding: 10px 17px; width:100%; max-width:900px; margin:auto; border:0">';
		$str_msg.='<tr><td><div style="border-bottom: 2px solid #e6e9ed; padding: 1px 5px 6px; margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px"><strong>Administrador de Proyectos TIC</strong></div></td></tr>';
		$str_msg.='<tr><td><div style="margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		if($accion=='envio_propuesta')
		{
			$str_msg.=$mensaje.'<br/><br/>';
			$str_msg.='<strong>Propuesta: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			$str_msg.='<br/><br/>Le agradecemos su atención y si requiere más información al respecto podrá encontrarla en el Sistema de Administración de proyectos.<br/></p>';
		}elseif($accion=='valida_propuesta'){
			if($mensaje==1) $str_msg.='El usuario ha validado la propuesta de diseño.';
			else $str_msg.='El usuario no validado la propuesta de diseño.';
			$str_msg.='<strong>Comentarios del usuario: '.$comentarios.'<br/><br/>';
			$str_msg.='<strong>Propuesta: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			$str_msg.='<br/><br/>Es necesario que revise los comentarios y se hagan las modificaciones, nuevamente se requiere que se suba la propuesta de diseño.<br/></p>';
			
		}elseif($accion=='aviso_desarrollo'){
			$str_msg.='Se le informa que se ha completado el desarrollo del proyecto de acuerdo a la propuesta gráfica aceptada previamente.<br/><br/>';
			$str_msg.='<strong>Propuesta: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			if($datos_des!='') $str_msg.='<strong>Datos del desarrollo: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			$str_msg.='<br/><br/>Le agradecemos su atención y si requiere más información al respecto podrá encontrarla en el Sistema de Administración de proyectos.<br/></p>';
		}elseif($accion=='valida_desarrollo'){
			if($mensaje==1) $str_msg.='El usuario solicitante ha validado el desarrollo.';
			else $str_msg.='El usuario solicitante no valido el desarrollo.<br/><br/>';
			$str_msg.='<strong>Propuesta: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			if($datos_des!='') $str_msg.='<strong>Datos del desarrollo: </strong>http://agendadigital.cultura.gob.mx/solpro/'.$propd.'<br/><br/>';
			$str_msg.='<strong>Comentarios: </strong>'.$comentarios.'<br/><br/>';
			$str_msg.='<br/><br/>Le agradecemos su atención y si requiere más información al respecto podrá encontrarla en el Sistema de Administración de proyectos.<br/></p>';
			}
		$str_msg.='</div></td></tr>';
		$str_msg.='</table></div></body></html>';
		$this->email->message($str_msg);
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());

	}
	
	public function sendMailCamb($correo_usuario, $titulo_camb, $descripcion, $respuesta, $fase, $es_admin, $usu_solicita)
	{
		//cargamos la libreria email de ci
		$this->load->library("email");
		$configGmail = array(
    'protocol'=> 'smtp',
    'mailtype'=> 'html',
    'charset'=> 'utf-8',
    'crlf' => "\r\n",
    'newline'=> "\r\n",//must have for office 365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'desarrolloweb@cultura.gob.mx',
    'smtp_pass' =>'Desaweb1708'
);



		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);
				//$this->email->clear();			
		$this->email->from('desarrolloweb@cultura.gob.mx','Administrador de Proyectos TIC');
		$this->email->to($correo_usuario);
		
		if($fase==10 && !$es_admin) $this->email->subject("Se registro la solicitud de cambio: ". $titulo_camb ); 
		elseif($fase==10 && $es_admin) $this->email->subject("Se ha registrado una nueva solicitud de cambio: ". $titulo_camb ); 
		elseif($fase==8) $this->email->subject("La solicitud de cambio: ". $titulo_camb. " no ha sido aprobada." ); 
		elseif($fase==11) $this->email->subject("La solicitud de cambio: ". $titulo_camb. " ha sido aprobada, y se comenzará a desarrollar." );
		elseif($fase==7) $this->email->subject("La solicitud de cambio: ". $titulo_camb. " ha sido finalizada." ); 
		else $this->email->subject("Se registro la solicitud de cambio: ". $titulo_camb ); 


		$str_msg='<html><head><title>Administrador de Proyectos TIC</title></head><body style="background-color:#F7F7F7; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<div style="width:100%; max-width:900px; margin:auto; margin-left:auto; margin-right:auto"><table style="color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px;background: #fff; border: 1px solid #e6e9ed; display: inline-block; padding: 10px 17px; width:100%; max-width:900px; margin:auto; border:0">';
		$str_msg.='<tr><td><div style="border-bottom: 2px solid #e6e9ed; padding: 1px 5px 6px; margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px"><strong>Administrador de Proyectos TIC</strong></div></td></tr>';
		$str_msg.='<tr><td><div style="margin-left:10px; margin-right:10px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; font-size:16px">';
		$str_msg.='<p style="font-weight: 300; line-height: 1.4; margin-bottom: 20px; color:#4A5C6F; font-family:Arial, Helvetica, sans-serif; ">Solicitud de cambio: <strong>"'.$titulo_camb.'"</strong>, con las siguientes características:</p>';
		$str_msg.='<p><strong>Título: </strong>'.$titulo_camb.'<br/><br/>';
		$str_msg.='<strong>Descripción: </strong>'.$descripcion.'<br/><br/>';
		if($fase==10 && $es_admin) $str_msg.='<strong>Usuario que solicita: </strong>'.$correo_usuario.'<br/><br/>';
		if($fase==7 || $fase==8 || $fase==11) $str_msg.='<strong>Respuesta: </strong><br/>'.$respuesta.'<br/><br/>';

		$str_msg.='<br/><br/>La información completa será revisada. Una vez que se tenga una respuesta, se le informara a través de este medio y podrá darle seguimiento en el Sistema de Administración de proyectos.<br/></p>';
		$str_msg.='</div></td></tr>';
		$str_msg.='</table></div></body></html>';
		$this->email->message($str_msg);
		$this->email->send();
		//con esto podemos ver el resultado
		//var_dump($this->email->print_debugger());
		
	}
	
}
