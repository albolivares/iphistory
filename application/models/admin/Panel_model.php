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

	if(is_numeric($id)) {
		$query = $this->db->where('id_hist', $id);			
	}
	$query = $this->db->get('ips_historias');
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
	'teaser_audio' => $this->input->post('teaser_audio'), 
	'archivo_audio' => $this->input->post('archivo_audio'),
	'duracion_audio' => $this->input->post('duracion_audio'),  
	'id_estatus_hist' => $this->input->post('estatus'),
	'id_serie' => $this->input->post('id_serie'),	
	'id_register' => $this->session->userdata('user_id'),
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
	'teaser_audio' => $this->input->post('teaser_audio'), 
	'archivo_audio' => $this->input->post('archivo_audio'),
	'duracion_audio' => $this->input->post('duracion_audio'),  
	'id_estatus_hist' => $this->input->post('estatus'),
	'id_serie' => $this->input->post('id_serie')
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
/*SELECT id_hist, titulo_hist, duracion_hist, copy_hist, historia, portada_bg, portada_sm, teaser_audio, archivo_audio, duracion_audio, id_estatus_hist, id_register, id_tiempo, id_serie, hashtag_hist, fecha_inicio_hist, fecha_fin_hist, fecha_captura_hist, fecha_publicacion_hist, usuario_publica_hist, id_modifica_register, fch_modifica_register, id_elimina_register, fch_elimina_register, fecha_terminacion_contrato_hist, usuario_terminacion_hist FROM ips_historias WHERE 1*/

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



}