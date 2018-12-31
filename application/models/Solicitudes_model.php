<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class solicitudes_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();		
  }
  
  public function registro()
  {
    $this->load->view('registro_view',$data);
  }
	
	public function getTipoSolicitud($id=false)
	{

		if(is_numeric($id)) {
			$query = $this->db->where('S.ID', $id);			
		}
		$query = $this->db->order_by('ID', 'ASC');
		$query = $this->db->get('CAT_TIPO_SOLICITUD');
		return $query->result();
	}
	
 public function getCamposSolicitud($tiposol, $tipo){
	 $tiposol=(int)$tiposol;
	 
		$sin_datos="";
	 $id_usu=(int)$this->session->userdata('uno');
	 if($id_usu>0) {
		 
		 		$query = $this->db->select('C.VC_DOCUMENTO, C.DESCRIPCION, C.CVE_TIPO, C.TIENE_ADJUNTO, C.TIPO, C.MIN_CAR, C.MAX_CAR, R.ES_OBLIGATORIO, R.ORDEN ');
				$query = $this->db->from('REL_TIPSOL_CATDOC R');
				$query = $this->db->join('CAT_DOCUMENTOS C', 'C.ID=R.ID_CAT_DOCUMENTO', 'left');
				$query = $this->db->where('R.ID_TIPO_SOLICITUD',$tiposol);			
				if($tipo=='' || $tipo=='A') $query = $this->db->where('R.FASE','A');
				elseif($tipo=='D') $query = $this->db->where('R.FASE','D');			
				elseif($tipo=='G') $query = $this->db->where('R.FASE','G');			
				elseif($tipo=='F') $query = $this->db->where('R.FASE','F');			
				$query = $this->db->order_by('ORDEN', 'ASC');
				$query = $this->db->get();
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
	 }

 }
 
 
 
 public function getListaSolicitudes($tipo=false){
	             $sin_datos="";
	 $id_usu=(int)$this->session->userdata('uno');
	 if($id_usu>0) {
				$query = $this->db->select('S.*, C.VC_NOMBRE ESTATUS, TS.VC_NOMBRE TIPO_SOL');
				$query = $this->db->from('SOLICITUDES_T S');
				$query = $this->db->join('CAT_FASES C', 'C.ID=S.ESTATUS_PROY', 'left');
				$query = $this->db->join('CAT_TIPO_SOLICITUD TS', 'TS.ID=S.TIPO_SOLICITUD', 'left');
				$query = $this->db->where('S.ID_CONTACTO_UA',$id_usu);
				if($tipo=='F') 	$query = $this->db->where('S.ESTATUS_PROY',7);			
				$query = $this->db->order_by('S.ID', 'DESC');
				$query = $this->db->get();
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }
 }
 
  public function getListaSolicitudesAprob($solo_fina=false){
	             $sin_datos="";
	 

				$query = $this->db->select('S.*, C.VC_NOMBRE ESTATUS, TS.VC_NOMBRE TIPO_SOL, VC_CORREO, CA.VC_NOMBRE UNIDAD, R.AVANCE AVANCE_DES');
				$query = $this->db->from('SOLICITUDES_T S');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=S.ID_CONTACTO_UA', 'inner');
				$query = $this->db->join('CAT_U_ADMINISTRATIVAS CA', 'CA.ID=U.ID_U_ADMINISTRATIVA', 'left');
				$query = $this->db->join('CAT_FASES C', 'C.ID=S.ESTATUS_PROY', 'left');
				$query = $this->db->join('CAT_TIPO_SOLICITUD TS', 'TS.ID=S.TIPO_SOLICITUD', 'left');
				$query = $this->db->join('REL_SOL_DESARROLLO R', 'R.ID_SOLICITUD=S.ID', 'left');
				if($solo_fina) $query = $this->db->where('S.ESTATUS_PROY',7);			
				$query = $this->db->order_by('S.ID', 'DESC');
				$query = $this->db->get();
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 
 }
 
  public function getSolicitud($id, $es_admin){
	 $sin_datos="";
	 $id_usu=(int)$this->session->userdata('uno');
	 if($id_usu>0) {
				$query = $this->db->select('S.*, C.VC_NOMBRE ESTATUS, TS.VC_NOMBRE TIPO_SOL, U.VC_CORREO, R.AVANCE AVANCE_DES, SE.IP, SE.ID ID_SERV');
				$query = $this->db->from('SOLICITUDES_T S');
				$query = $this->db->join('CAT_FASES C', 'C.ID=S.ESTATUS_PROY', 'left');
				$query = $this->db->join('CAT_TIPO_SOLICITUD TS', 'TS.ID=S.TIPO_SOLICITUD', 'left');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=S.ID_CONTACTO_UA', 'left');
				$query = $this->db->join('REL_SOL_DESARROLLO R', 'R.ID_SOLICITUD=S.ID', 'left');
				$query = $this->db->join('SERVIDOR SE', 'S.ID_SERVIDOR=SE.ID', 'left');
				if(!$es_admin) $query = $this->db->where('S.ID_CONTACTO_UA',$id_usu);
				$query = $this->db->where('S.ID',$id);	
//				var_dump($query);		

				$query = $this->db->get();

//	echo $this->db->last_query(); 
//	exit(); 
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }
 }
 
 
 public function getSolicitudDes($id, $es_admin){
	 $sin_datos="";
	 $id_usu=(int)$this->session->userdata('uno');
	 if($id_usu>0) {
				$query = $this->db->select('S.*, C.VC_NOMBRE ESTATUS');
				$query = $this->db->from('REL_SOL_DESARROLLO S');
				$query = $this->db->join('CAT_FASES C', 'C.ID=S.ESTATUS_PROY', 'left');
				$query = $this->db->where('S.ID_SOLICITUD',$id);	
//				var_dump($query);		

				$query = $this->db->get();

//	echo $this->db->last_query(); 
//	exit(); 
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }
 }
 
  public function getServidores($es_admin=false, $id_usu=false)
  {
	$id_usu=(int)$id_usu;	
	$query = $this->db->select('S.*');
	$query = $this->db->from('SERVIDOR S');
	if($es_admin && is_numeric($id_usu) && $id_usu>0) 	$this->db->where('ID_USUARIO',$id_usu);	
	else $query = $this->db->where('ID_USUARIO',$this->session->userdata('user_id'));	
	$query = $this->db->get();
	if($query->num_rows() > 0 ) return $query->result();

  }
 
 public function getDatosSolicita($id)
 {
	 
	 /*SELECT C.ID, C.VC_NOMBRE, C.VC_APELLIDO_PAT, C.VC_APELLIDO_MAT, C.ID_U_ADMINISTRATIVA, CU.VC_NOMBRE UNIDAD, C.VC_CARGO, C.VC_EXTENSION, C.VC_CORREO, C.VC_CORREO_EXT
 FROM CONTACTO_U_ADMINISTRATIVA C LEFT JOIN CAT_U_ADMINISTRATIVAS CU ON CU.ID=C.ID_U_ADMINISTRATIVA
WHERE C.ID=1*/

$sin_datos="";
	 $id_usu=(int)$id;
	 if($id_usu>0) {
				$query = $this->db->select('C.ID, C.VC_NOMBRE, C.VC_APELLIDO_PAT, C.VC_APELLIDO_MAT, C.ID_U_ADMINISTRATIVA, CU.VC_NOMBRE UNIDAD, C.VC_CARGO, C.VC_EXTENSION, C.VC_CORREO, C.VC_CORREO_EXT, C.VC_TELEFONO');
				$query = $this->db->from('CONTACTO_U_ADMINISTRATIVA C');
				$query = $this->db->join('CAT_U_ADMINISTRATIVAS CU', 'CU.ID=C.ID_U_ADMINISTRATIVA', 'left');
				$query = $this->db->where('C.ID',$id_usu);	
				
//				var_dump($query);		

				$query = $this->db->get();
//				echo $this->db->last_query(); 
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }

	 
 }
 
 public function insertaSolicitud($tipo, $oficio, $url_oficio, $nombre_proy, $justifica, $obj_g, $obj_e, $desc, $tiene_server, $id_server, $carpeta){
	 /*INSERT INTO `PROY_SC`.`SOLICITUDES` (`ID`, `TIPO_SOLICITUD`, `VC_OFICIO`, `URL_OFICIO`, `ID_CONTACTO_UA`, `FCH_ALTA`, `VC_NOMBRE_PROY`, `VC_JUSTIFICA`, `VC_OBJETIVO_GENERAL`, `VC_OBJETIVO_ESPECIFICO`, `TIPO_PUBLICO`, `TXT_DESCRIPCION_PROY`, `TXT_DESCRIPCION_MOD`, `ESTATUS_PROY`, `TIENE_SERVER`, `ID_SERVIDOR`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/
	 	   $data = array(
                'TIPO_SOLICITUD'=>$tipo,
                'VC_OFICIO'=>$oficio,
                'URL_OFICIO'=>$url_oficio,
                'ID_CONTACTO_UA'=>$this->session->userdata('uno'),
                'VC_NOMBRE_PROY'=>$nombre_proy,
                'VC_JUSTIFICA'=>$justifica,
                'VC_OBJETIVO_GENERAL'=>$obj_g,
                'VC_OBJETIVO_ESPECIFICO'=>$obj_e,
                'TXT_DESCRIPCION_PROY'=>$desc,
                'ESTATUS_PROY'=>1,
                'TIENE_SERVER'=>$tiene_server,
                'ID_SERVIDOR'=>$id_server,
								 'CARPETA'=>$carpeta
                );
                $this->db->set('FCH_ALTA', 'NOW()', FALSE); 
                $this->db->insert('SOLICITUDES', $data); 
                $id = $this->db->insert_id();
                if(is_numeric($id)) return $id; else return 0;
								
 }
 
  public function insertaSolicitudGral($tipo, $oficio, $url_oficio, $nombre_proy, $justifica, $obj_g, $desc, $tiene_server, $id_server, $carpeta, $arqui, $reqf, $list, $siste, $alim, $cantg, $prodi, $ident){

	 	   $data = array(
                'TIPO_SOLICITUD'=>$tipo,
                'OFICIO_NOM'=>$oficio,
                'OFICIO'=>$url_oficio,
                'ID_CONTACTO_UA'=>$this->session->userdata('uno'),
                'NOMBRE'=>$nombre_proy,
                'JUSTIFICA'=>$justifica,
                'OBJETIVO'=>$obj_g,
                'DESC'=>$desc,
                'ESTATUS_PROY'=>1,
                'TIENE_SERVER'=>$tiene_server,
                'ID_SERVIDOR'=>$id_server,
								'CARPETA'=>$carpeta, 
								'arqui'=>$arqui, 
								'reqf'=>$reqf, 
								'list'=>$list, 
								'siste'=>$siste, 
								'alim'=>$alim, 
								'cantg'=>$cantg, 
								'prodi'=>$prodi, 
								'ident'=>$ident
								 
								 
                );
                $this->db->set('FCH_ALTA', 'NOW()', FALSE); 
                $this->db->insert('SOLICITUDES_T', $data); 
                $id = $this->db->insert_id();
                if(is_numeric($id)) return $id; else return 0;
								
 }


 public function modificaSolicitudFase1($id,$tipo_solictud, $oficio, $url_oficio, $proyecto, $justifica, $objeivo, $descripcion, $tiene_server, $id_server, $carpeta, $arqui, $reqf, $reqt, $list, $siste, $alim, $cantg, $prodi, $ident, $avance){
		 $data = array(
                'TIPO_SOLICITUD'=>$tipo_solictud,
                'OFICIO_NOM'=>$oficio,
                'OFICIO'=>$url_oficio,
                'USU_MODIFICA'=>$this->session->userdata('uno'),
                'NOMBRE'=>$proyecto,
                'JUSTIFICA'=>$justifica,
                'OBJETIVO'=>$objeivo,
                'DESC'=>$descripcion,
                'TIENE_SERVER'=>$tiene_server,
                'ID_SERVIDOR'=>$id_server,
								'CARPETA'=>$carpeta, 
								'arqui'=>$arqui, 
								'reqf'=>$reqf,
								'reqt'=>$reqt, 
								'list'=>$list, 
								'siste'=>$siste, 
								'alim'=>$alim, 
								'cantg'=>$cantg, 
								'prodi'=>$prodi, 
								'ident'=>$ident, 
								'PORC_AVANCE_DOC'=>$avance
						);
            $this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
            $this->db->where('ID', $id);
            $this->db->update('SOLICITUDES_T', $data); 
	  //echo $this->db->last_query();
 }

 public function completaSolicitudFase1($id_proy, $estatus){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 
	 	$id_proy=(int)$id_proy;
		$id_fase=10; 
		 $data = array(
						'ID_SOLICITUD'=>$id_proy,
						'ID_FASE'=>$id_fase,
						'USU_ALTA'=>$this->session->userdata('uno'),
						'CONSECUTIVO_DE_FASE'=>'1',
						'ESTATUS'=>$estatus,
						);
						$this->db->set('FCH_ALTA', 'NOW()', FALSE); 
						$this->db->insert('FASE_SOLICITUDES', $data); 
						$id = $this->db->insert_id();
						if(is_numeric($id)) {

             $data2 = array(
                'ESTATUS_PROY'=>$id_fase         
             );
            $this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
            $this->db->where('ID', $id_proy);
            $this->db->update('SOLICITUDES_T', $data2); 
						
//					 echo $this->db->last_query(); exit();
						
						return $id;
						}else return 0;
	 
 }

 
 public function apruebaSolicitudFase1($id_sol,$comentarios, $estatus){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 
	 $id_sol=(int)$id_sol;
	 $estatus_opt=0;
		if($estatus==1) {$id_fase=2; $estatus_opt=1;}
		elseif($estatus==9) $id_fase=1;
		elseif($estatus==8) $id_fase=8;
		 $data = array(
						'ID_SOLICITUD'=>$id_sol,
						'ID_FASE'=>$id_fase,
						'USU_VALIDA'=>$this->session->userdata('uno'),
						'COMENTARIOS_VALIDA'=>$comentarios,
						'CONSECUTIVO_DE_FASE'=>'1',
						'ESTATUS'=>$estatus_opt
						);
						$this->db->set('FCH_VALIDA', 'NOW()', FALSE); 
						$this->db->insert('FASE_SOLICITUDES', $data); 
						$id = $this->db->insert_id();
						if(is_numeric($id)) {

             $data = array(
                'ESTATUS_PROY'=>$id_fase         
             );
            $this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
            $this->db->where('ID', $id_sol);
            $this->db->update('SOLICITUDES_T', $data); 
						echo $this->db->last_query(); 
						
						return $id;
						}else return 0;
	 
 }
 
 public function enviaPropuestaGrafica($id_sol,$id_fase, $archivo){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 
	 $id_sol=(int)$id_sol;
		 $data = array(
						'ID_SOLICITUD'=>$id_sol,
						'ID_FASE'=>$id_fase,
						'USU_ALTA'=>$this->session->userdata('uno'),
						'COMENTARIOS_VALIDA'=>'Se envia propuesta gráfica para aprobación.',
						'CONSECUTIVO_DE_FASE'=>'1'
						);
						$this->db->set('FCH_ALTA', 'NOW()', FALSE); 
						$this->db->insert('FASE_SOLICITUDES', $data); 
						$id = $this->db->insert_id();
						if(is_numeric($id)) {

             $data = array(
                'ESTATUS_PROY'=>$id_fase         
             );
            $this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
            $this->db->where('ID', $id_sol);
            $this->db->update('SOLICITUDES_T', $data); 
 
						
						return $id;
						}else return 0;
	 
 }

 public function validaPropuestaGrafica($id_sol,$id_fasen, $archivo, $estatus, $comentario){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 
	 if($estatus==1 && $id_fasen==12) $id_fase=11;
	 else $id_fase=2;
	 $id_sol=(int)$id_sol;
		$data = array(
		'ID_FASE'=>$id_fasen,
		'USU_VALIDA'=>$this->session->userdata('uno'),
		'COMENTARIOS_VALIDA'=>$comentario,
		'CONSECUTIVO_DE_FASE'=>'1',
		'ESTATUS'=>$estatus
		);
		$this->db->set('FCH_VALIDA', 'NOW()', FALSE); 
		$this->db->where('ID_SOLICITUD', $id_sol);
		$this->db->where('ID_FASE', '12');
		$this->db->where('USU_VALIDA', null);
		$this->db->where('ESTATUS', null);
		$this->db->update('FASE_SOLICITUDES', $data); 
		//echo $this->db->last_query();
		
		 $data2 = array(
				'ESTATUS_PROY'=>$id_fase         
		 );
		$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
		$this->db->where('ID', $id_sol);
		$this->db->update('SOLICITUDES_T', $data2); 

		 $data3 = array(
				'ESTATUS_PROY'=>$id_fase,
				'USU_MODIFICA'=>$this->session->userdata('uno'),
				'VALPGD'=>$estatus,
				'COMVPGD'=>$comentario,
		 );
		$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
		$this->db->where('ID_SOLICITUD', $id_sol);
		return $this->db->update('REL_SOL_DESARROLLO', $data3); 
		
	 
 }
 
 public function consultaCorreoGrafica($id_sol){
	 /*SELECT U.VC_CORREO
FROM FASE_SOLICITUDES F INNER JOIN  CONTACTO_U_ADMINISTRATIVA U ON U.ID=F.USU_ALTA
WHERE ID_SOLICITUD=3  AND USU_ALTA<>'' AND ID_FASE=12 AND USU_VALIDA IS NULL
GROUP BY  F.USU_ALTA, U.VC_CORREO*/
$sin_datos="";
	 $id_sol=(int)$id_sol;
	 if($id_sol>0) {
				$query = $this->db->select('U.VC_CORREO ');
				$query = $this->db->from('FASE_SOLICITUDES F');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=F.USU_VALIDA', 'left');
				$query = $this->db->where('F.ID_FASE',12);
				$query = $this->db->where('F.USU_VALIDA');
				$query = $this->db->where('USU_ALTA is NOT NULL', NULL, FALSE);
				$query = $this->db->where('F.ID_SOLICITUD',$id_sol);
				$query = $this->db->group_by('USU_ALTA'); 
				$query = $this->db->group_by('VC_CORREO'); 

//				var_dump($query);		

				$query = $this->db->get();
			//echo $this->db->last_query(); 
				if($query->num_rows() > 0 ) return $query->result();
				
				else return $sin_datos;
	 }
 }
 
 public function enviaPropuestaFinal($id_sol,$id_fasen, $estatus){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 
	 if($estatus==1 && $id_fasen==11) 
	 {
	 $id_fase=14;

	 $id_sol=(int)$id_sol;

	 $id_sol=(int)$id_sol;
		 $data = array(
		'ID_SOLICITUD'=>$id_sol,
		'ID_FASE'=>$id_fase,
		'USU_ALTA'=>$this->session->userdata('uno'),
		'COMENTARIOS_VALIDA'=>'El desarrollo del sistema se ha concluido, se envia el aviso para la aprobación del solicitante.',
		'CONSECUTIVO_DE_FASE'=>'1'
		);
		$this->db->set('FCH_ALTA', 'NOW()', FALSE); 
		$this->db->insert('FASE_SOLICITUDES', $data); 
		$id = $this->db->insert_id();						
		//echo $this->db->last_query();
		
		 $data2 = array(
				'ESTATUS_PROY'=>$id_fase         
		 );
		$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
		$this->db->where('ID', $id_sol);
		$this->db->update('SOLICITUDES_T', $data2); 

		 $data3 = array(
				'ESTATUS_PROY'=>$id_fase,
				'USU_MODIFICA'=>$this->session->userdata('uno'),
				'ENVAPR'=>$estatus,
				'COMF'=>''
		 );
		$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
		$this->db->where('ID_SOLICITUD', $id_sol);
		return $this->db->update('REL_SOL_DESARROLLO', $data3); 
	 }
	 
 } 
 
 public function validaPropuestaFinal($id_sol,$id_fase, $estatus, $comf){
	 /*INSERT INTO `PROY_SC`.`FASE_SOLICITUDES` (`ID`, `ID_FASE`, `FCH_ALTA`, `USU_ALTA`, `URL_ARCHIVO`, `USU_VALIDA`, `FCH_VALIDA`, `COMENTARIOS_ALTA`, `COMENTARIOS_VALIDA`, `CONSECUTIVO_DE_FASE`, `ESTATUS`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/	 


	 $id_sol=(int)$id_sol;
	 if($estatus==1 && $id_fase==14) $id_fasen=7;
	 else $id_fasen=11;

		$data = array(
		'ID_FASE'=>$id_fasen,
		'USU_VALIDA'=>$this->session->userdata('uno'),
		'COMENTARIOS_VALIDA'=>$comf,
		'CONSECUTIVO_DE_FASE'=>'1',
		'ESTATUS'=>$estatus
		);
		$this->db->set('FCH_VALIDA', 'NOW()', FALSE); 
		$this->db->where('ID_SOLICITUD', $id_sol);
		$this->db->where('ID_FASE', '14');
		$this->db->where('USU_VALIDA', null);
		$this->db->where('ESTATUS', null);
		$this->db->update('FASE_SOLICITUDES', $data); 					
		//echo $this->db->last_query();
		
		 $data2 = array(
				'ESTATUS_PROY'=>$id_fasen         
		 );
		$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
		$this->db->where('ID', $id_sol);
		$this->db->update('SOLICITUDES_T', $data2); 


		 $data3 = array(
				'ESTATUS_PROY'=>$id_fasen,
				'USU_VALIDA'=>$this->session->userdata('uno'),
				'VALUF'=>$estatus,
				'ENVAPR'=>$estatus,
				'COMF'=>$comf,
		 );

		$this->db->set('FCH_VALIDA', 'NOW()', FALSE); 
		$this->db->where('ID_SOLICITUD', $id_sol);
		return $this->db->update('REL_SOL_DESARROLLO', $data3); 
	 
	 
 }  

public function consultaSolicitudFase1($id, $fase){
	/*SELECT F.ID_FASE, C.VC_NOMBRE FASE, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS 
FROM FASE_SOLICITUDES F INNER JOIN CAT_FASES C ON C.ID=F.ID_FASE
WHERE F.ID_SOLICITUD=4;*/
//echo $id.'|'.$fase;
$sin_datos="";
	 $id=(int)$id;
	 if($id>0) {
				$query = $this->db->select('F.ID_FASE, C.VC_NOMBRE FASE, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS, F.USU_VALIDA, U.VC_CORREO ');
				$query = $this->db->from('FASE_SOLICITUDES F');
				$query = $this->db->join('CAT_FASES C', 'C.ID=F.ID_FASE', 'left');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=F.USU_VALIDA', 'left');
				$query = $this->db->where('F.ID_SOLICITUD',$id);
				$query = $this->db->where('F.ID_FASE',$fase);	
//				var_dump($query);		

				$query = $this->db->get();
		//		echo $this->db->last_query(); 
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }
}

/*fase de desarrollo de solicitud*/
 public function insertaSolicitudDes($id_sol,$carpeta, $estatus, $avance, $propd,	$based,	$maque,	$integra,	$cmsn,	$cmse,	$grafb,	$prufi,	$valuf,	$comf, $envapr, $manut, $manuu){
	
	$data = array(
				'ID_SOLICITUD'=>$id_sol,
				 'CARPETA'=>$carpeta, 
				 'ESTATUS_PROY'=>$estatus,
				 'USU_CREA'=>$this->session->userdata('uno'),
				 'AVANCE'=>$avance,
				 'PROPD'=>$propd,
				 'BASED'=>$based, 
				 'MAQUE'=>$maque,
				 'INTEGRA'=>$integra,
				 'CMSN'=>$cmsn, 
				 'CMSE'=>$cmse, 
				 'GRAFB'=>$grafb, 
				 'PRUFI'=>$prufi, 
				 'VALUF'=>$valuf, 
				 'COMF'=>$comf,
				 'ENVAPR'=>$envapr,
				 'MANUT'=>$manut,
				 'MANUU'=>$manuu
				  
		);
	$this->db->set('FCH_CREA', 'NOW()', FALSE); 
	$this->db->insert('REL_SOL_DESARROLLO', $data); 
	$id = $this->db->insert_id();
	
	if(is_numeric($id)) {

	 $data2 = array(
			'ESTATUS_PROY'=> $estatus         
	 );
	$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
	$this->db->where('ID', $id_sol);
	$this->db->update('SOLICITUDES_T', $data2); 
	}
	if(is_numeric($id)) return $id; else return 0;
								
 }
 
public function modificaSolicitudDes($id, $idaprob, $avance, $propd,	$based,	$maque,	$integra,	$cmsn,	$cmse,	$grafb,	$prufi,	$valuf,	$comf, $envapr, $manut, $manuu, $valpgd, $comvpgd, $estatus){



	 $data = array(
						 'USU_MODIFICA'=>$this->session->userdata('uno'),
						 'AVANCE'=>$avance,
						 'PROPD'=>$propd,
						 'BASED'=>$based, 
						 'MAQUE'=>$maque,
						 'INTEGRA'=>$integra,
						 'CMSN'=>$cmsn, 
						 'CMSE'=>$cmse, 
						 'GRAFB'=>$grafb, 
						 'PRUFI'=>$prufi, 
						 'VALUF'=>$valuf, 
						 'COMF'=>$comf,
						 'ENVAPR'=>$envapr,
						 'MANUT'=>$manut,
						 'MANUU'=>$manuu,
						 'VALPGD'=>$valpgd,
						 'COMVPGD'=>$comvpgd
				);
	if($estatus!='') $this->db->set('ESTATUS_PROY', $estatus, FALSE); 			 
	$this->db->set('FCH_MODIFICA', 'NOW()', FALSE); 
	$this->db->where('ID_SOLICITUD', $id);
	$this->db->where('ID', $idaprob);
	$mod_des=$this->db->update('REL_SOL_DESARROLLO', $data); 	
	//echo $this->db->last_query(); 
	
	return $mod_des;
 }

public function logSolicitud($id){
	$sin_datos='';
	$query = $this->db->select('F.ID_FASE,C.VC_NOMBRE, F.USU_ALTA,U1.VC_CORREO C_ALTA, F.FCH_ALTA, F.USU_VALIDA, U2.VC_CORREO C_VALIDA, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS ');
	$query = $this->db->from('FASE_SOLICITUDES F');
	$query = $this->db->join('CAT_FASES C', 'C.ID=F.ID_FASE', 'inner');
	$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U1', 'U1.ID=F.USU_ALTA', 'left');
	$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U2', 'U2.ID=F.USU_VALIDA', 'left');
	$query = $this->db->where('ID_SOLICITUD',$id);			
	$query = $this->db->get();
	if($query->num_rows() > 0 ) return $query->result();
	else return $sin_datos;

}

public function logSolicitudUsu($id_usuario){
	$sin_datos='';
	$query = $this->db->select('F.ID_FASE,C.VC_NOMBRE, F.USU_ALTA,U1.VC_CORREO C_ALTA, F.FCH_ALTA, F.USU_VALIDA, U2.VC_CORREO C_VALIDA, F.FCH_VALIDA, F.COMENTARIOS_VALIDA, F.ESTATUS ');
	$query = $this->db->from('FASE_SOLICITUDES F');
	$query = $this->db->join('CAT_FASES C', 'C.ID=F.ID_FASE', 'inner');
	$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U1', 'U1.ID=F.USU_ALTA', 'left');
	$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U2', 'U2.ID=F.USU_VALIDA', 'left');
	$query = $this->db->where('F.USU_ALTA',$id_usuario);
	$query = $this->db->or_where('F.USU_VALIDA =', $id_usuario);	
	$query = $this->db->order_by('FCH_ALTA', 'DESC');	
	$query = $this->db->order_by('FCH_VALIDA', 'DESC');	
	$query = $this->db->get();
	if($query->num_rows() > 0 ) return $query->result();
	else return $sin_datos;

}

/*REGISTRO DE CAMBIOS*/
public function insertaCambioGral($idsol,$tipo,$nombre_proy, $desc, $reqf, $prodi){
/*INSERT INTO `PROY_SC`.`SOLICITUDES_CAMBIOS` (`ID`, `ID_SOLICITUD`, `TIPO_SOLICITUD`, `TITULO`, `DESCRIPCION`, `PROP_DI`, `INF_ADI`, `ESTATUS`, `FCH_CREA_USU`, `USU_CREA`, `FCH_RESPUESTA`, `USU_RESPUESTA`, `TXT_RESPUESTA`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);*/
	 	   $data = array(
                'ID_SOLICITUD'=>$idsol,
                'TIPO_SOLICITUD'=>$tipo,
                'TITULO'=>$nombre_proy,
                'DESCRIPCION'=>$desc,
								'USU_CREA'=>$this->session->userdata('uno'),
                'ESTATUS'=>10,
								'INF_ADI'=>$reqf, 
								'PROP_DI'=>$prodi
								 
								 
                );
                $this->db->set('FCH_CREA_USU', 'NOW()', FALSE); 
                $this->db->insert('SOLICITUDES_CAMBIOS', $data); 
                $id = $this->db->insert_id();
                if(is_numeric($id)) return $id; else return 0;
								
 }
 
 
 public function getListaCambios($id_usu=false, $es_admin){
	 
	 /*SELECT C.ID_SOLICITUD, S.NOMBRE, C.TIPO_SOLICITUD, TS.VC_NOMBRE TIPO, C.TITULO, C.DESCRIPCION, C.FCH_CREA_USU,U.VC_CORREO, C.ESTATUS, F.VC_NOMBRE FASE
FROM SOLICITUDES_CAMBIOS C INNER JOIN SOLICITUDES_T S ON S.ID=C.ID_SOLICITUD
INNER JOIN  CONTACTO_U_ADMINISTRATIVA U ON U.ID=C.USU_CREA
INNER JOIN CAT_FASES F ON F.ID=C.ESTATUS
INNER JOIN CAT_TIPO_SOLICITUD TS ON TS.ID=C.TIPO_SOLICITUD
WHERE C.USU_CREA=10*/
	             $sin_datos="";
	 $id_usu=(int)$this->session->userdata('uno');
	 if($id_usu>0) {
				$query = $this->db->select('C.ID, C.ID_SOLICITUD, S.NOMBRE, C.TIPO_SOLICITUD, TS.VC_NOMBRE TIPO, C.TITULO, C.DESCRIPCION, C.FCH_CREA_USU,U.VC_CORREO, C.ESTATUS, F.VC_NOMBRE FASE');
				$query = $this->db->from('SOLICITUDES_CAMBIOS C');
				$query = $this->db->join('SOLICITUDES_T S', 'S.ID=C.ID_SOLICITUD', 'inner');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=C.USU_CREA', 'inner');
				$query = $this->db->join('CAT_FASES F', 'F.ID=C.ESTATUS', 'inner');
				$query = $this->db->join('CAT_TIPO_SOLICITUD TS', 'TS.ID=C.TIPO_SOLICITUD', 'inner');
				if(!$es_admin) 	$query = $this->db->where('C.USU_CREA',$id_usu);
				$query = $this->db->order_by('C.ID_SOLICITUD', 'DESC');
				$query = $this->db->get();
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
			

	 }
 }
 
 public function getCambio($id){
	 $sin_datos="";
	 $id=(int)$id;
	 
	 if($id>0) {

				$query = $this->db->select('S.ID_SOLICITUD,S.ID,S.TIPO_SOLICITUD, F.VC_NOMBRE TIPO,S.TITULO,S.DESCRIPCION,S.PROP_DI,S.INF_ADI,S.ESTATUS,S.FCH_CREA_USU,S.USU_CREA,S.FCH_RESPUESTA,S.USU_RESPUESTA, U.VC_CORREO C_RESPUESTA,S.TXT_RESPUESTA, T.TIPO_SOLICITUD TIPO_S, T.ID_CONTACTO_UA CONTACTO_S, T.CARPETA, S.USU_FINALIZA, S.FCH_FINALIZA');
				$query = $this->db->from('SOLICITUDES_CAMBIOS S');
				$query = $this->db->join('SOLICITUDES_T T', 'T.ID=S.ID_SOLICITUD', 'inner');
				$query = $this->db->join('CAT_FASES F', 'F.ID=S.ESTATUS', 'inner');
				$query = $this->db->join('CONTACTO_U_ADMINISTRATIVA U', 'U.ID=S.USU_RESPUESTA', 'LEFT');
				$query = $this->db->where('S.ID',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0 ) return $query->result();
				else return $sin_datos;
	 }

 }
 
  public function actCambio($id_sol, $id_camb, $estatus,$aprobada, $descripcion){
	 $sin_datos="";
	 $id=(int)$id;
	 
	 if($id_sol>0 && $id_camb>0) {

/*UPDATE `PROY_SC`.`SOLICITUDES_CAMBIOS` SET `ID`='1', `ID_SOLICITUD`='1', `TIPO_SOLICITUD`='13', `TITULO`='Cambio en la sección de contacto', `DESCRIPCION`='Se necesitan agregar los siguientes datos en la sección de contacto:\r\nNombre\r\nDirección:\r\nPais:\r\ny además se requiere poner el mapa georefrenciado de la siguiente dirección: Avenida de los pirules número 365', `PROP_DI`='', `INF_ADI`='', `ESTATUS`='10', `FCH_CREA_USU`='2017-11-30 12:20:28', `USU_CREA`='10', `FCH_RESPUESTA`=NULL, `USU_RESPUESTA`=NULL, `TXT_RESPUESTA`=NULL WHERE (`ID`='1');*/

	if($estatus==10 && $aprobada==11) $fase_sig=11;
	elseif($estatus==10 && $aprobada==8) $fase_sig=8;
	elseif($estatus==11) $fase_sig=7;
	
	if($estatus==11){
	$data = array(
						 'USU_FINALIZA'=>$this->session->userdata('uno'),
						 'ESTATUS'=>$fase_sig
				);
	}else {
	 $data = array(
						 'USU_RESPUESTA'=>$this->session->userdata('uno'),
						 'TXT_RESPUESTA'=>$descripcion,
						 'ESTATUS'=>$fase_sig
				);
	 }
			//if($estatus!='') $this->db->set('ESTATUS_PROY', $estatus, FALSE); 			 
			if($estatus==11) $this->db->set('FCH_FINALIZA', 'NOW()', FALSE); 
			else $this->db->set('FCH_RESPUESTA', 'NOW()', FALSE); 
			$this->db->where('ID_SOLICITUD', $id_sol);
			$this->db->where('ID', $id_camb);
			return $this->db->update('SOLICITUDES_CAMBIOS', $data); 
	 }

 }
 
}
