<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panel_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

public function getHistorias($id=false)
{
/*SELECT id_hist, titulo_hist, duracion_hist, copy_hist, historia, portada_bg, portada_sm, teaser_audio, archivo_audio, duracion_audio, id_estatus_hist, h.id_register, id_tiempo, id_serie, hashtag_hist, fecha_inicio_hist, fecha_fin_hist, fecha_captura_hist, fecha_publicacion_hist, usuario_publica_hist, id_modifica_register, fch_modifica_register, id_elimina_register, fch_elimina_register, fecha_terminacion_contrato_hist, usuario_terminacion_hist,ap_paterno_register, nombre_register, pseudonimo_register FROM ips_historias h LEFT JOIN ips_register r on r.id_register=h.id_register WHERE 1 */
	$query = $this->db->select('id_hist, titulo_hist, duracion_hist, copy_hist, historia, portada_bg, portada_sm, portada_fb, portada_tw, teaser_audio, archivo_audio, duracion_audio, id_estatus_hist, h.id_register, id_tiempo, id_serie, hashtag_hist, fecha_inicio_hist, fecha_fin_hist, fecha_captura_hist, fecha_publicacion_hist, usuario_publica_hist, id_modifica_register, fch_modifica_register, id_elimina_register, fch_elimina_register, fecha_terminacion_contrato_hist, usuario_terminacion_hist,ap_paterno_register, nombre_register, pseudonimo_register');
	if(is_numeric($id)) {
		$query = $this->db->where('id_hist', $id);			
	}
	$query = $this->db->join('ips_register r','r.id_register=h.id_register' ,'LEFT');
	$query = $this->db->get('ips_historias h');

	return $query->result();
}


public function setHistoria(){
   $data = array(
	'titulo_hist' => $this->input->post('titulo_hist'), 
	'duracion_hist' => $this->input->post('duracion_hist'),
	'copy_hist' => $this->input->post('copy_hist'),
	'id_serie' => $this->input->post('id_serie'), 
	'hashtag_hist' => $this->input->post('hashtag_hist'), 
	'fecha_inicio_hist' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_hist' => $this->input->post('fecha_fin_hist'),
	'historia' => $this->input->post('historia'),
	'portada_bg' => $this->input->post('portada_bg'),
	'portada_sm' => $this->input->post('portada_sm'),
	'portada_fb' => $this->input->post('portada_fb'),
	'portada_tw' => $this->input->post('portada_tw'),
	'teaser_audio' => $this->input->post('teaser_audio'), 
	'archivo_audio' => $this->input->post('archivo_audio'),
	'duracion_audio' => $this->input->post('duracion_audio'),  
	'id_estatus_hist' => $this->input->post('estatus'),
	'id_serie' => $this->input->post('id_serie'),	
	'id_register' => $this->input->post('id_register'),
	'usuario_publica_hist' => $this->session->userdata('user_id'),
	'fecha_captura_hist' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_historias', $data); 
   $id_comp=$this->db->insert_id();
   

	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('id_hist', $id_comp); $this->db->delete('ips_historias_x_categorias');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   $data = array(
			'id_categoria' => $categoria,
			'id_hist' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_historias_x_categorias', $data);
   		}
	}

   return $id_comp;
}


public function updateHistoria(){
	$es_publica=false;			
	

	if($this->input->post('estatus')==1) $es_publica=true;					

   $data = array(

	'titulo_hist' => $this->input->post('titulo_hist'), 
	'duracion_hist' => $this->input->post('duracion_hist'),
	'copy_hist' => $this->input->post('copy_hist'),
	'id_serie' => $this->input->post('id_serie'), 
	'hashtag_hist' => $this->input->post('hashtag_hist'), 
	'fecha_inicio_hist' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_hist' => $this->input->post('fecha_fin_hist'),
	'historia' => $this->input->post('historia'),
	'portada_bg' => $this->input->post('portada_bg'),
	'portada_sm' => $this->input->post('portada_sm'),
	'portada_fb' => $this->input->post('portada_fb'),
	'portada_tw' => $this->input->post('portada_tw'),
	'teaser_audio' => $this->input->post('teaser_audio'), 
	'archivo_audio' => $this->input->post('archivo_audio'),
	'duracion_audio' => $this->input->post('duracion_audio'),  
	'id_estatus_hist' => $this->input->post('estatus'),
	'id_serie' => $this->input->post('id_serie'),
	'id_register' => $this->input->post('id_register')
    ); 

   if(is_numeric($this->input->post('id_obj') ) ){
   $id_comp=$this->input->post('id_obj');
   if($es_publica) { 
   			$this->db->set('fecha_publicacion_hist', 'NOW()', FALSE);
   			$this->db->set('usuario_publica_hist', $this->session->userdata('user_id'));
		} 
   else {$this->db->set('fch_modifica_register', 'NOW()', FALSE); 	
   $this->db->set('id_modifica_register', $this->session->userdata('user_id'));} 
   $this->db->where('id_hist', $this->input->post('id_obj'));
   $this->db->update('ips_historias', $data);



	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('id_hist', $id_comp); $this->db->delete('ips_historias_x_categorias');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   	$data = array('id_categoria' => $categoria,'id_hist' => $id_comp); 
   		$insertinvita=$this->db->insert('ips_historias_x_categorias', $data);
   		}
	}

	}

}


public	function getHistCategoria($id){
	$query = $this->db->select('id_categoria');			
	$query = $this->db->where('id_hist', $id);			
	$query = $this->db->get('ips_historias_x_categorias');
	return $query->result();
}

public function getSerie($estatus=false, $id=false){
	$query = $this->db->select('id_serie, titulo_serie, estatus_serie, fecha_alta, portada_serie_bg, portada_serie_sm, fecha_inicio_serie, fecha_fin_serie, copy_serie, hashtag_serie, usuario_alta, fecha_modifica, usuario_modifica');			
	if(is_numeric($estatus)) $query = $this->db->where('estatus_serie', $estatus);			
	if(is_numeric($id)) $query = $this->db->where('id_serie', $id);
	$query = $this->db->get('ips_series');
	return $query->result();
}

public function getCategoria(){

	$query = $this->db->select('id_categoria, categoria, descripcion');			
	$query = $this->db->get('ips_categorias');
	return $query->result();
}

public function getTiempo(){
	$query = $this->db->select('id_tiempo, tiempo');			
	$query = $this->db->get('ips_tiempo');
	return $query->result();
}

/*funciones para series*/

public function setSerie(){
   $data = array(
	'titulo_serie' => $this->input->post('titulo_hist'), 
	'copy_serie' => $this->input->post('copy_hist'),
	'estatus_serie' => $this->input->post('estatus'),
	'hashtag_serie' => $this->input->post('hashtag_hist'), 
	'fecha_inicio_serie' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_serie' => $this->input->post('fecha_fin_hist'),
	'portada_serie_bg' => $this->input->post('portada_bg'),
	'portada_serie_sm' => $this->input->post('portada_sm'),	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_series', $data); 
   $id_comp=$this->db->insert_id();
   
	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('ips_series_id_serie', $id_comp); $this->db->delete('ips_categorias_x_series');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   $data = array(
			'ips_categorias_id_categoria' => $categoria,
			'ips_series_id_serie' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_categorias_x_series', $data);
   		}
	}

   return $id_comp;
}

public function updateSerie(){
if($this->input->post('estatus')==1) $es_publica=true;		
   $data = array(
	'titulo_serie' => $this->input->post('titulo_hist'), 
	'copy_serie' => $this->input->post('copy_hist'),
	'estatus_serie' => $this->input->post('estatus'),
	'hashtag_serie' => $this->input->post('hashtag_hist'), 
	'fecha_inicio_serie' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_serie' => $this->input->post('fecha_fin_hist'),
	'portada_serie_bg' => $this->input->post('portada_bg'),
	'portada_serie_sm' => $this->input->post('portada_sm'),	
    ); 

   	$id_comp=$this->input->post('id_obj');

   if(is_numeric($id_comp)){		
   $this->db->set('fecha_modifica', 'NOW()', FALSE); 	
   $this->db->set('usuario_modifica', $this->session->userdata('user_id')); 
   $this->db->where('id_serie', $this->input->post('id_obj'));
   $this->db->update('ips_series', $data);


   
	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('ips_series_id_serie', $id_comp); $this->db->delete('ips_categorias_x_series');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   $data = array(
			'ips_categorias_id_categoria' => $categoria,
			'ips_series_id_serie' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_categorias_x_series', $data);
   		}
	}
	}

   return $id_comp;
}


public	function getSerieCategoria($id){
	$query = $this->db->select('ips_categorias_id_categoria id_categoria');			
	$query = $this->db->where('ips_series_id_serie', $id);			
	$query = $this->db->get('ips_categorias_x_series');
	return $query->result();
}

/*funciones para readlist*/

public function getReadList($id=false,$estatus=false){
/*SELECT id_readlist, titulo_readlist, portada_readlist_bg, portada_readlist_sm, es_permanente_readlist, estatus_readlist, fecha_inicio_readlist, fecha_fin_readlist, copy_readlist, hashtag_readlist, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_readlist WHERE 1*/
	$query = $this->db->select('id_readlist, titulo_readlist, portada_readlist_bg, portada_readlist_sm, es_permanente_readlist, estatus_readlist, fecha_inicio_readlist, fecha_fin_readlist, copy_readlist, hashtag_readlist, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica');
	if(is_numeric($id)) $query = $this->db->where('id_readlist', $id);
	if(is_numeric($estatus)) $query = $this->db->where('estatus_readlist', $estatus);			
	$query = $this->db->get('ips_readlist');
	return $query->result();
}

public function setReadlist(){
   $data = array(
	'titulo_readlist' => $this->input->post('titulo_hist'), 
	'copy_readlist' => $this->input->post('copy_hist'),
	'estatus_readlist' => $this->input->post('estatus'),
	'hashtag_readlist' => $this->input->post('hashtag_hist'),
	'es_permanente_readlist' => $this->input->post('permanente'), 
	'fecha_inicio_readlist' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_readlist' => $this->input->post('fecha_fin_hist'),
	'portada_readlist_bg' => $this->input->post('portada_bg'),
	'portada_readlist_sm' => $this->input->post('portada_sm'),	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_readlist', $data); 
   $id_comp=$this->db->insert_id();
   

	$arrHistoria=$this->input->post('val_hist');
	if($id_comp){
	$this->db->where('id_readlist', $id_comp); $this->db->delete('ips_historias_x_readlist');
   	if($arrHistoria){
   	foreach ($arrHistoria as $key => $historia) {
	   $data = array(
			'id_hist' => $historia,
			'id_readlist' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_historias_x_readlist', $data);
   		}
   		}	
	}
   return $id_comp;
}

public function updateReadlist(){
	$id_comp=$this->input->post('id_obj');
   $data = array(
	'titulo_readlist' => $this->input->post('titulo_hist'), 
	'copy_readlist' => $this->input->post('copy_hist'),
	'estatus_readlist' => $this->input->post('estatus'),
	'hashtag_readlist' => $this->input->post('hashtag_hist'),
	'es_permanente_readlist' => $this->input->post('permanente'), 
	'fecha_inicio_readlist' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_readlist' => $this->input->post('fecha_fin_hist'),
	'portada_readlist_bg' => $this->input->post('portada_bg'),
	'portada_readlist_sm' => $this->input->post('portada_sm'),	
	'usuario_modifica' => $this->session->userdata('user_id'),
	'fecha_modifica' => date('Y-m-d H:i:s')
    ); 
   if(is_numeric($id_comp)){
   	$this->db->where('id_readlist', $this->input->post('id_obj'));
   	$this->db->update('ips_readlist', $data);
	

   
	$arrHistoria=$this->input->post('val_hist');
	$this->db->where('id_readlist', $id_comp); $this->db->delete('ips_historias_x_readlist');
   	if($arrHistoria){
   	foreach ($arrHistoria as $key => $historia) {
	   $data = array(
			'id_hist' => $historia,
			'id_readlist' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_historias_x_readlist', $data);
   		}
	}
	}
   return $id_comp;
}


public function getReadListHist($id){
/*SELECT `id_hist`, `id_readlist` FROM `ips_historias_x_readlist` WHERE 1*/
	$this->db->select('i.id_hist, h.titulo_hist');
	$this->db->from('ips_historias_x_readlist i');
	$this->db->join('ips_historias h', 'h.id_hist = i.id_hist');
	$this->db->where('id_readlist', $id);
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result_array():FALSE;
}

function getRows($params = array()){

	$this->db->select(' id_hist, titulo_hist, duracion_hist' );
	$this->db->from('ips_historias');
	$this->db->where('id_estatus_hist', 1);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('titulo_hist',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('titulo_hist',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id_hist','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();

        //print_r($this->db->last_query());
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

function getRowsAut($params = array()){

/*id_register, email_register, password_register, ap_paterno_register, ap_materno_register, nombre_register, fch_nacimiento_register, genero_register, pseudonimo_register, con_avatar_register, id_avatar, foto_register, estatus_register, es_lector_register, es_autor_register, id_pais, p.nacionalidad, id_estado, e.entidad, id_ciudad, minibio_register, semblanza_register, numero_contrato_register, comentarios_register, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica*/

	$this->db->select(' id_register, ap_paterno_register, nombre_register, pseudonimo_register' );
	$this->db->from('ips_register');
	$this->db->where('es_autor_register', 1);
	$this->db->where('estatus_register', 1);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            //$this->db->like('ap_paterno_register',$params['search']['keywords']);
			$this->db->where(" (nombre_register LIKE '%".$params['search']['keywords']."%' OR ap_paterno_register LIKE '%".$params['search']['keywords']."%'
OR pseudonimo_register LIKE '%".$params['search']['keywords']."%' OR email_register LIKE '%".$params['search']['keywords']."%' OR ap_materno_register LIKE '%".$params['search']['keywords']."%' )", NULL, FALSE);

        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('nombre_register',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id_register','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();

        //print_r($this->db->last_query());
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }


/*Registro de autores*/




public function getPaises(){
/*SELECT `id`, `paisnombre` FROM `ips_paises` WHERE 1*/
	$this->db->select('id, paisnombre');
	$this->db->from('ips_paises p');
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;
}

public function getNacionalidad(){
	/*SELECT `id`, `codigo_pais`, `nacionalidad`, `cve_nacionalidad` FROM `ips_nacionalidades` WHERE 1*/
$this->db->select('id, nacionalidad');
	$this->db->from('ips_nacionalidades p');
$this->db->order_by('nacionalidad');
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;
}

public function getEstados(){
	/*SELECT `id`, `entidad`, `abreviatura` FROM `ips_estados` WHERE 1*/
	
	$this->db->select('id, entidad, abreviatura');
	$this->db->from('ips_estados e');
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;
	
}

public function getCiudades($id){
	/*SELECT `id_ciudad`, `ciudad`, `id_estado`, `catalog_key` FROM `ips_ciudades` WHERE 1*/
	if(is_numeric($id)){
	$this->db->select('id_ciudad, ciudad, catalog_key');
	$this->db->from('ips_ciudades e');
	$this->db->where('id_estado', $id);
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;
	}else return false; 
}

public function getAvatarComodin(){
/*SELECT id_avatar, nombre_avatar, imagen_avatar, es_comodin, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_avatar WHERE 1*/
	$this->db->select('id_avatar, nombre_avatar, imagen_avatar');
	$this->db->from('ips_avatar');
	$this->db->where('es_comodin', 1);
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;
}

public function getRegister($id=false,$es_autor_register,$estatus=false){
	
	$this->db->select('id_register, email_register, password_register, ap_paterno_register, ap_materno_register, nombre_register, fch_nacimiento_register, genero_register, pseudonimo_register, con_avatar_register, id_avatar, foto_register, estatus_register, es_lector_register, es_autor_register, id_pais, p.nacionalidad, id_estado, e.entidad, id_ciudad, minibio_register, semblanza_register, numero_contrato_register, comentarios_register, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica');
	$this->db->from('ips_register u');
	$this->db->join('ips_nacionalidades	 p','p.id=u.id_pais','left');
	$this->db->join('ips_estados e','e.id=id_estado','left');
	if($id) $this->db->where('id_register', $id);
	if($es_autor_register) $this->db->where('es_autor_register', '1');
	else $this->db->where('es_lector_register', '1');
	$query=$this->db->get();
	return ($query->num_rows() > 0)?$query->result():FALSE;

}


public function setAutor(){
 	$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
    $hash= $this->input->post('pswd');
    $password= md5($salt.$hash);          	
   $data = array(
	'email_register' => $this->input->post('correo'), 
	'password_register' => $password,
	'ap_paterno_register' => $this->input->post('apellido_p'),
	'ap_materno_register' => $this->input->post('apellido_m'), 
	'nombre_register' => $this->input->post('nombre'), 
	'fch_nacimiento_register' => $this->input->post('fecha_inicio_hist'), 
	'genero_register' => $this->input->post('genero'),
	'pseudonimo_register' => $this->input->post('pseudonimo'),
	'con_avatar_register' => $this->input->post('avatar'),
	'id_avatar' => $this->input->post('avatar_sel'),
	'foto_register' => $this->input->post('portada_sm'),
	'estatus_register' => $this->input->post('estatus'),
	'es_lector_register' => 0,
	'es_autor_register' => 1,
	'id_pais' => $this->input->post('nacionalidad'),
	'id_estado' => $this->input->post('estado'),
	'id_ciudad' => $this->input->post('ciudad'), 
	'minibio_register' => $this->input->post('minibio'),
	'semblanza_register' => $this->input->post('historia'),  
	'numero_contrato_register' => $this->input->post('num_contrato'),	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_register', $data); 
   $id_comp=$this->db->insert_id();
   

	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('id_register', $id_comp); $this->db->delete('ips_topics_register');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   $data = array(
			'id_categoria' => $categoria,
			'id_register' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_topics_register', $data);
   		}
	}

	if($id_comp){
		/*datos fiscales*/
		/*SELECT id_fiscal, id_tipo_persona, rfc_fiscal, razon_social, domiclio_fiscal, cif_archivo, id_register, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_fiscal WHERE 1*/

$dataf = array(
	'id_tipo_persona' => $this->input->post('tipo_persona'), 
	'rfc_fiscal' => $this->input->post('rfc'),
	'razon_social' => $this->input->post('razons'), 
	'domiclio_fiscal' => $this->input->post('domiciliof'), 
	'cif_archivo' => '', 
	'id_register' => $id_comp,	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_fiscal', $dataf); 
   $id_compf=$this->db->insert_id();


		/*datos bancarios*/

		/*SELECT id_dato_bancario, nombre_titular_banco, cuenta_banco, clabe_banco, numero_tarjeta_banco, id_register, id_banco, sucursal_banco, numero_cliente_banco, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_datos_bancarios WHERE 1*/
$datab = array(
	'nombre_titular_banco' => $this->input->post('nombre_cuenta'), 
	'cuenta_banco' => $this->input->post('num_cuenta'),
	'clabe_banco' => $this->input->post('clabe'), 
	'numero_tarjeta_banco' => $this->input->post('num_tarjeta'), 
	'sucursal_banco' => $this->input->post('sucursal'), 
	'numero_cliente_banco' => $this->input->post('num_cliente'), 
	'id_banco' => $this->input->post('banco'), 
	'id_register' => $id_comp,	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_datos_bancarios', $datab); 
   $id_compb=$this->db->insert_id();
   

	}

   return $id_comp;
}

public function updateAutor(){/*INSERT INTO `ips_register`(`id_register`, `email_register`, `password_register`, `ap_paterno_register`, `ap_materno_register`, `nombre_register`, `fch_nacimiento_register`, `genero_register`, `pseudonimo_register`, `con_avatar_register`, `id_avatar`, `foto_register`, `estatus_register`, `es_lector_register`, `es_autor_register`, `id_pais`, `id_estado`, `id_ciudad`, `minibio_register`, `semblanza_register`, `numero_contrato_register`, `comentarios_register`, `fecha_alta`, `usuario_alta`, `fecha_modifica`, `usuario_modifica`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26])*/


 	if($this->input->post('pswd_act')!=$this->input->post('pswd')) {
 	$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
    $hash= $this->input->post('pswd');
    $password= md5($salt.$hash);
    $data = array(
	'email_register' => $this->input->post('correo'), 
	'password_register' => $password,
	'ap_paterno_register' => $this->input->post('apellido_p'),
	'ap_materno_register' => $this->input->post('apellido_m'), 
	'nombre_register' => $this->input->post('nombre'), 
	'fch_nacimiento_register' => $this->input->post('fecha_inicio_hist'), 
	'genero_register' => $this->input->post('genero'),
	'pseudonimo_register' => $this->input->post('pseudonimo'),
	'con_avatar_register' => $this->input->post('avatar'),
	'id_avatar' => $this->input->post('avatar_sel'),
	'foto_register' => $this->input->post('portada_sm'),
	'estatus_register' => $this->input->post('estatus'),
	'es_lector_register' => 0,
	'es_autor_register' => 1,
	'id_pais' => $this->input->post('nacionalidad'),
	'id_estado' => $this->input->post('estado'),
	'id_ciudad' => $this->input->post('ciudad'), 
	'minibio_register' => $this->input->post('minibio'),
	'semblanza_register' => $this->input->post('historia'),  
	'numero_contrato_register' => $this->input->post('num_contrato'),	
	'usuario_modifica' => $this->session->userdata('user_id'),
	'fecha_modifica' => date('Y-m-d H:i:s')
    );          	 
 	}else{$data = array(
	'email_register' => $this->input->post('correo'), 
	'ap_paterno_register' => $this->input->post('apellido_p'),
	'ap_materno_register' => $this->input->post('apellido_m'), 
	'nombre_register' => $this->input->post('nombre'), 
	'fch_nacimiento_register' => $this->input->post('fecha_inicio_hist'), 
	'genero_register' => $this->input->post('genero'),
	'pseudonimo_register' => $this->input->post('pseudonimo'),
	'con_avatar_register' => $this->input->post('avatar'),
	'id_avatar' => $this->input->post('avatar_sel'),
	'foto_register' => $this->input->post('portada_sm'),
	'estatus_register' => $this->input->post('estatus'),
	'es_lector_register' => 0,
	'es_autor_register' => 1,
	'id_pais' => $this->input->post('nacionalidad'),
	'id_estado' => $this->input->post('estado'),
	'id_ciudad' => $this->input->post('ciudad'), 
	'minibio_register' => $this->input->post('minibio'),
	'semblanza_register' => $this->input->post('historia'),  
	'numero_contrato_register' => $this->input->post('num_contrato'),	
	'usuario_modifica' => $this->session->userdata('user_id'),
	'fecha_modifica' => date('Y-m-d H:i:s')
    );}

	$id_comp=$this->input->post('id_obj');
   

    

   if(is_numeric($id_comp)){
   	$this->db->where('id_register', $this->input->post('id_obj'));
   	$this->db->update('ips_register', $data);
   

	$arrCategoria=$this->input->post('my-categoria');
	$this->db->where('id_register', $id_comp); $this->db->delete('ips_topics_register');
   	if($arrCategoria){
   	foreach ($arrCategoria as $key => $categoria) {
	   $data = array(
			'id_categoria' => $categoria,
			'id_register' => $id_comp,
			
	    ); 
   		$insertinvita=$this->db->insert('ips_topics_register', $data);
   		}
	}

/*datos fiscales*/
		/*SELECT id_fiscal, id_tipo_persona, rfc_fiscal, razon_social, domiclio_fiscal, cif_archivo, id_register, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_fiscal WHERE 1*/


$this->db->where('id_register', $id_comp); $this->db->delete('ips_fiscal');
$dataf = array(
	'id_tipo_persona' => $this->input->post('tipo_persona'), 
	'rfc_fiscal' => $this->input->post('rfc'),
	'razon_social' => $this->input->post('razons'), 
	'domiclio_fiscal' => $this->input->post('domiciliof'), 
	'cif_archivo' => '', 
	'id_register' => $id_comp,	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_fiscal', $dataf); 
   $id_compf=$this->db->insert_id();


		/*datos bancarios*/

		/*SELECT id_dato_bancario, nombre_titular_banco, cuenta_banco, clabe_banco, numero_tarjeta_banco, id_register, id_banco, sucursal_banco, numero_cliente_banco, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica FROM ips_datos_bancarios WHERE 1*/
		$this->db->where('id_register', $id_comp); $this->db->delete('ips_datos_bancarios');
$datab = array(
	'nombre_titular_banco' => $this->input->post('nombre_cuenta'), 
	'cuenta_banco' => $this->input->post('num_cuenta'),
	'clabe_banco' => $this->input->post('clabe'), 
	'numero_tarjeta_banco' => $this->input->post('num_tarjeta'), 
	'sucursal_banco' => $this->input->post('sucursal'), 
	'numero_cliente_banco' => $this->input->post('num_cliente'), 
	'id_banco' => $this->input->post('banco'), 
	'id_register' => $id_comp,	
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_datos_bancarios', $datab); 
   $id_compb=$this->db->insert_id();
   

	}
   return $id_comp;
}

public function getDatosFiscales($id){
	$query = $this->db->select('id_fiscal, id_tipo_persona, rfc_fiscal, razon_social, domiclio_fiscal, cif_archivo, id_register, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica');			
	$query = $this->db->where('id_register', $id);			
	$query = $this->db->get('ips_fiscal');
	return $query->result();


}

public function getDatosBanc($id){
	
		$query = $this->db->select('id_dato_bancario, nombre_titular_banco, cuenta_banco, clabe_banco, numero_tarjeta_banco, id_register, id_banco, sucursal_banco, numero_cliente_banco, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica');			
	$query = $this->db->where('id_register', $id);			
	$query = $this->db->get('ips_datos_bancarios');
	return $query->result();
}

public function getBancos(){
	$query = $this->db->select('id_banco, banco');					
	$query = $this->db->get('ips_bancos');
	return $query->result();
}

public	function getAutTopic($id){
	$query = $this->db->select('id_categoria');			
	$query = $this->db->where('id_register', $id);			
	$query = $this->db->get('ips_topics_register');
	return $query->result();
}

/*Recomendaciones*/
public function getRecomendaciones($id=false,$estatus=false){
	$query = $this->db->select('r.id_recom, fecha_registro, fecha_inicio_recom, fecha_fin_recom, estatus_recom, orden, r.id_hist, h.titulo_hist, h.usuario_publica_hist, u.id_register, u.ap_paterno_register, u.ap_materno_register,u.nombre_register, r.usuario_alta, r.fecha_alta, r.usuario_modifica, r.fecha_modifica');			
	if(is_numeric($id)) $query = $this->db->where('id_recom', $id);
	if($estatus) $query = $this->db->where('estatus_recom', $estatus);			
	$query = $this->db->join('ips_historias h', 'h.id_hist=r.id_hist');
	$query = $this->db->join('ips_register u','u.id_register=h.id_register');
	$query = $this->db->where('estatus_recom<>',2);
	$query = $this->db->get('ips_recomendaciones r');
	return $query->result();
}

public function getSeccion(){
	$query = $this->db->select('id_seccion,seccion');						
	$query = $this->db->get('ips_secciones');
	return $query->result();
}


function getHistBusc($params = array()){

	$this->db->select(' id_hist, titulo_hist, duracion_hist' );
	$this->db->from('ips_historias');
	$this->db->where('id_estatus_hist', 1);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('titulo_hist',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('titulo_hist',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id_hist','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result():FALSE;
    }

public function setRecomendacion(){
 $data = array(
	'fecha_inicio_recom' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_recom' => $this->input->post('fecha_fin_hist'),
	'estatus_recom' => $this->input->post('estatus'),
	'id_hist' => $this->input->post('id_hist'), 
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_recomendaciones', $data); 
   $id_comp=$this->db->insert_id();
   

	$arrHistoria=$this->input->post('my-categoria');
	$arrSeccion=$this->input->post('my-seccion');
	if($id_comp){
	$this->db->where('id_recom', $id_comp); $this->db->delete('ips_recomendaciones_x_categorias');
   	if($arrHistoria){
   		foreach ($arrHistoria as $key => $historia) {
	   		$data = array(
			'id_categoria' => $historia,
			'id_recom' => $id_comp,
	    ); 
   		$insertinvita=$this->db->insert('ips_recomendaciones_x_categorias', $data);
   		}
   	}
   	$this->db->where('id_recom', $id_comp); $this->db->delete('ips_secciones_x_recomendaciones');
   	if($arrSeccion){
   		foreach ($arrSeccion as $key => $seccion) {
	   		$data = array(
			'id_seccion' => $seccion,
			'id_recom' => $id_comp,
	    ); 
   		$insertinvita=$this->db->insert('ips_secciones_x_recomendaciones', $data);
   		}
   	}	
	}
   return $id_comp;


}

public function updateRecomendacion(){
   $data = array(
	'fecha_inicio_recom' => $this->input->post('fecha_inicio_hist'),
	'fecha_fin_recom' => $this->input->post('fecha_fin_hist'),
	'estatus_recom' => $this->input->post('estatus'),
	'id_hist' => $this->input->post('id_hist'), 
	'usuario_modifica' => $this->session->userdata('user_id'),
	'fecha_modifica' => date('Y-m-d H:i:s')
    ); 

	$id_comp=$this->input->post('id_obj');
   if(is_numeric($id_comp)){
   	$this->db->where('id_recom', $this->input->post('id_obj'));
   	$this->db->update('ips_recomendaciones', $data);

	$arrHistoria=$this->input->post('my-categoria');
	$arrSeccion=$this->input->post('my-seccion');
	if($id_comp){
	$this->db->where('id_recom', $id_comp); $this->db->delete('ips_recomendaciones_x_categorias');
   	if($arrHistoria){
   		foreach ($arrHistoria as $key => $historia) {
	   		$data = array(
			'id_categoria' => $historia,
			'id_recom' => $id_comp,
	    ); 
   		$insertinvita=$this->db->insert('ips_recomendaciones_x_categorias', $data);
   		}
   	}
   	$this->db->where('id_recom', $id_comp); $this->db->delete('ips_secciones_x_recomendaciones');
   	if($arrSeccion){
   		foreach ($arrSeccion as $key => $seccion) {
	   		$data = array(
			'id_seccion' => $seccion,
			'id_recom' => $id_comp,
	    ); 
   		$insertinvita=$this->db->insert('ips_secciones_x_recomendaciones', $data);
   		}
   	}	
	}
}
   return $id_comp;


}

public	function getRecomendacionCategoria($id){
	$query = $this->db->select('id_recom, id_categoria');			
	$query = $this->db->where('id_recom', $id);			
	$query = $this->db->get('ips_recomendaciones_x_categorias');
	return $query->result();
}


public	function getRecomendacionSeccion($id){
	$query = $this->db->select('id_recom, id_seccion');			
	$query = $this->db->where('id_recom', $id);			
	$query = $this->db->get('ips_secciones_x_recomendaciones');
	return $query->result();
}

/*Suscripciones*/

public function getSuscripciones($id=false,$estatus=false){
$query = $this->db->select('id_suscripcion, titulo_suscripcion, descripcion_suscripcion, tipo_suscripcion, precio_suscripcion, estatus_suscripcion, num_historias_suscripcion, id_duracion_suscr, orden_suscripcion, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica');			
	if(is_numeric($id)) $query = $this->db->where('id_suscripcion', $id);
	if($estatus) $query = $this->db->where('estatus_suscripcion', $estatus);			
	$query = $this->db->where('estatus_suscripcion<>',2);
	$query = $this->db->get('ips_suscripciones r');
	return $query->result();

}

public function getDuracionSuscripcion(){
	$query = $this->db->select('id_duracion_suscr, duracion_suscr');					
	$query = $this->db->get('ips_duraciones_suscripciones');
	return $query->result();
}


public function setSuscripcion(){
	/*id_suscripcion, titulo_suscripcion, descripcion_suscripcion, tipo_suscripcion, precio_suscripcion, estatus_suscripcion, num_historias_suscripcion, id_duracion_suscr, orden_suscripcion, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica*/
 $data = array(
	'titulo_suscripcion' => $this->input->post('titulo_hist'),
	'descripcion_suscripcion' => $this->input->post('descripcion'),
	'estatus_suscripcion' => $this->input->post('estatus'),
	'tipo_suscripcion' => $this->input->post('tipo'),
	'precio_suscripcion' => $this->input->post('precio'),
	'num_historias_suscripcion' => $this->input->post('num_historias'),
	'id_duracion_suscr' => $this->input->post('duracion'), 
	'orden_suscripcion' => $this->input->post('orden'), 
	'usuario_alta' => $this->session->userdata('user_id'),
	'fecha_alta' => date('Y-m-d H:i:s')
    ); 

   $insertcomp=$this->db->insert('ips_suscripciones', $data); 
   $id_comp=$this->db->insert_id();
   return $id_comp;
}  


public function updateSuscripcion(){
	/*id_suscripcion, titulo_suscripcion, descripcion_suscripcion, tipo_suscripcion, precio_suscripcion, estatus_suscripcion, num_historias_suscripcion, id_duracion_suscr, orden_suscripcion, fecha_alta, usuario_alta, fecha_modifica, usuario_modifica*/
 $data = array(
	'titulo_suscripcion' => $this->input->post('titulo_hist'),
	'descripcion_suscripcion' => $this->input->post('descripcion'),
	'estatus_suscripcion' => $this->input->post('estatus'),
	'tipo_suscripcion' => $this->input->post('tipo'),
	'precio_suscripcion' => $this->input->post('precio'),
	'num_historias_suscripcion' => $this->input->post('num_historias'),
	'id_duracion_suscr' => $this->input->post('duracion'), 
	'orden_suscripcion' => $this->input->post('orden'), 
	'usuario_modifica' => $this->session->userdata('user_id'),
	'fecha_modifica' => date('Y-m-d H:i:s')
    ); 

   $this->db->where('id_suscripcion', $this->input->post('id_obj'));
   	$this->db->update('ips_suscripciones', $data);

   return $id_comp;
}   


public function eliRegistro($tipo, $id){
if(is_numeric($id) ){
 if($tipo=='suscripcion'){	
		$data = array(
		'estatus_suscripcion' => 2,
		'usuario_modifica' => $this->session->userdata('user_id'),
		'fecha_modifica' => date('Y-m-d H:i:s')
    	); 
  	 	$this->db->where('id_suscripcion', $id);
   		$this->db->update('ips_suscripciones', $data);
	}
 }	 	
	/**/ 	

}

}