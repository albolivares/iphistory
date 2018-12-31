<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plataformas_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();

  }
  
	 public function getServidor()
  {
	}
	
	public function listaCount(){
				/*$count="SELECT COUNT(*) FROM ".TABLE."";*/
	}
	
	public function lista($ini=false){
		$limit_end = 20;
		if(!$ini) $ini=1;
		$init = ($ini-1) * $limit_end;
	
		$db_di = $this->load->database('ag_di', TRUE);
		$query = $db_di->select('P.ID, P.VC_NOMBRE,P.ID_UNI_ADMIN, TXT_UNI_ADMIN, P.ESTATUS, VC_TIPO_CONTENIDO, SUBSTRING(`DESCRIPCION`, 1, 130) AS RESUMEN, "" URL, P.TIENE_GRAFICA' );
		$query = $db_di->from('PRINCIPAL P');
		$query = $db_di->join('UNIDAD_ADMINISTRATIVA A', 'P.ID_UNI_ADMIN = A.ID_UNI_ADMIN ', 'left');
		$query = $db_di->join('TIPO_CONTENIDO C', 'P.ID_TIPO_CONTENIDO = C.ID_TIPO_CONTENIDO', 'left');
		/*$query = $db_di->join('PLAT_RELACION R', 'P.ID = R.ID_PLA_DIG', 'left');
		$query = $db_di->join('PLATAFORMAS F', 'F.ID=R.ID_PLA_DIG AND F.TIPO="W"', 'inner');*/
		if(!$this->ion_auth->is_admin()) $query = $db_di->where('P.ID_UNI_ADMIN', $this->session->userdata('ua'));
		$query = $db_di->order_by('VC_NOMBRE', 'ASC');
		$query = $db_di->distinct();
		$query = $db_di->get();
		if($query->num_rows() > 0 ) return $query->result();
		else return $sin_datos;
	}
	
	public function editaPlataforma(){
		/* $sql = "UPDATE PRINCIPAL SET VC_NOMBRE='".$vc_nombre."', ID_TIPO_CONTENIDO='".$id_tipo_contenido."', PALABRAS_CLAVES='".$palabras_claves."', ID_UNI_ADMIN='".$id_uni_admin."',";
        $sql.= "DESCRIPCION='".$descripcion."', ID_TIPO_PUBLICO='".$id_tipo_publico."'";
        if($imagen_logoname!='')
        {
          $sql.=", IMAGEN_LOGO='".$imagen_logoname."'";
        }
        if($imagen_interiorname!='')
        {
          $sql.=" ,IMAGEN_INTERIOR='".$imagen_interiorname."'";
        } 
          $sql.=  " WHERE ID='".$id."'";
       */
	}
	
	public function getCategorias(){
			$sin_datos='';
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('ID_CATEGORIA, VC_CATEGORIA' );
			$query = $db_di->from('CATEGORIAS P');
			$query = $db_di->order_by('ID_CATEGORIA');	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	}
	
		public function getTipoContenido(){
			$sin_datos='';
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('ID_TIPO_CONTENIDO, VC_TIPO_CONTENIDO' );
			$query = $db_di->from('TIPO_CONTENIDO P');
			$query = $db_di->order_by('ID_TIPO_CONTENIDO');	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	}
	
	public function getUnidadAdministrativa(){
			$sin_datos='';
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('ID_UNI_ADMIN, TXT_UNI_ADMIN' );
			$query = $db_di->from('UNIDAD_ADMINISTRATIVA P');
			if(!$this->ion_auth->is_admin()) $query = $db_di->where('P.ID_UNI_ADMIN', $this->session->userdata('ua'));
			$query = $db_di->order_by('ID_UNI_ADMIN');	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	}
	
		public function getTipoPublico(){

			$sin_datos='';
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('ID_TIPO_PUBLICO, VC_TIPO_PUBLICO' );
			$query = $db_di->from('TIPO_PUBLICO P');
			$query = $db_di->order_by('ID_TIPO_PUBLICO');	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	}
	
	public function getPlataforma($id){
		$sin_datos='';
		if(is_numeric($id)){
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('P.*' );
			$query = $db_di->from('PRINCIPAL P');
			$query = $db_di->where('P.ID',$id);	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	
		}
	}
		public function getPlataformaCategoria($id){
		$sin_datos='';
		if(is_numeric($id)){
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('P.*' );
			$query = $db_di->from('PRINCIPAL_CATEGORIA P');
			$query = $db_di->where('P.ID_PRINCIPAL',$id);	
			$query = $db_di->get();
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	
		}
	}
	
	public function getCatPlataforma($tipo){
		/*SELECT ID, VC_NOMBRE FROM PLATAFORMAS WHERE TIPO='R' ORDER BY ID*/
		$sin_datos='';
		if($tipo!=''){
			
			/* $sql = "SELECT ID, VC_NOMBRE FROM PLATAFORMAS WHERE TIPO='R' ORDER BY ID";          */
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('ID, VC_NOMBRE' );
			$query = $db_di->from('PLATAFORMAS P');
			if($tipo=='A') $query = $db_di->where("TIPO !=",'R');
			elseif($tipo=='S') $query = $db_di->where("TIPO",'R');
			else $query = $db_di->where('P.TIPO',$tipo);
			$query = $db_di->order_by('ID');		
			$query = $db_di->get();
			
			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	
		}
	}
  
	public function getPlataformaRel($id, $tipo){
		$sin_datos='';
		
		/*"SELECT PR.ID_REL,PR.ID_PLA_DIG,PR.ID_PLA, PR.URL, PL.TIPO, PL.VC_NOMBRE 
		FROM PRINCIPAL P INNER JOIN PLAT_RELACION PR ON PR.ID_PLA_DIG = P.ID 
		INNER JOIN PLATAFORMAS PL ON PL.ID=PR.ID_PLA WHERE PR.ID_PLA_DIG=$id AND TIPO!='R'";*/
		if(is_numeric($id)){
			$db_di = $this->load->database('ag_di', TRUE);
			$query = $db_di->select('PR.ID_REL,PR.ID_PLA_DIG,PR.ID_PLA, PR.URL, PL.TIPO, PL.VC_NOMBRE' );
			$query = $db_di->from('PRINCIPAL P');
			$query = $db_di->join('PLAT_RELACION PR', 'PR.ID_PLA_DIG = P.ID');
			$query = $db_di->join('PLATAFORMAS PL', 'PL.ID=PR.ID_PLA');
			$query = $db_di->where('PR.ID_PLA_DIG',$id);	
			if($tipo=='S') $query = $db_di->where("TIPO",'R');
			else $query = $db_di->where("TIPO !=",'R');
			$query = $db_di->get();

			if($query->num_rows() > 0 ) return $query->result();
			else return $sin_datos;
	
		}
	}
	
	
public function insertaPlataforma()
  {
		
		
	$db_di = $this->load->database('ag_di', TRUE);

  $imagen_logoname = $_FILES['imagen_logo']['name'];
  $imagen_interiorname = $_FILES['imagen_interior']['name'];
	$id=(int)$this->input->post('id');
	
	$carpeta = "/export/home/paginas/www2/images/";
    
    if(!empty($imagen_logoname)) {
      $ExtImage = $this->getFileExtension($imagen_logoname);
      if(!is_dir($carpeta)) mkdir($carpeta, 0777); 
      $imagen_logo = $carpeta.basename($_FILES['imagen_logo']['name']);
      $img_nm1 = substr($imagen_logo, 6, strlen($imagen_logo) - 3);
      $tamano = $_FILES ['imagen_logo']['size'];  
      
      if (basename($_FILES['imagen_logo']['name']) != "") {
        if ($_FILES["imagen_logo"]["error"] > 0) { echo "Error: " . $_FILES["imagen_logo"]["error"] . "<br />"; exit();}
        else {
          if($tamano<900000000) {
              if (file_exists($carpeta.$_FILES["imagen_logo"]["name"]))  echo $_FILES["imagen_logo"]["name"]." ya existe.";
              else move_uploaded_file($_FILES["imagen_logo"]["tmp_name"], $imagen_logo);
          } else {
            $msg= "La imagen no debe sobrepasar 900 Mb de peso"; 
            exit();
          }
        } 
      } 

    }
		

if(!empty($imagen_interiorname)) {
      $ExtImage = $this->getFileExtension($imagen_interiorname);
      if(!is_dir($carpeta)) mkdir($carpeta, 0777); 
      $imagen_interior = $carpeta.basename($_FILES['imagen_interior']['name']);
      $img_nm2 = substr($imagen_interior, 6, strlen($imagen_interior) - 3);
      $tamano = $_FILES ['imagen_interior']['size']; 
      if (basename($_FILES['imagen_interior']['name']) != "") {
        if ($_FILES["imagen_interior"]["error"] > 0) { echo "Error: " . $_FILES["imagen_interior"]["error"] . "<br />"; exit();}
        else {
          if($tamano<900000000) {
              if (file_exists($carpeta.$_FILES["imagen_interior"]["name"]))  echo $_FILES["imagen_interior"]["name"]." ya existe.";
              else move_uploaded_file($_FILES["imagen_interior"]["tmp_name"], $imagen_interior);
          } else {
            $msg= "La imagen no debe sobrepasar 900 Mb de peso"; 
            exit();
          }
        }
      }

    } 		
		
		if($this->input->post('url_ami')=='') $url_ami=$this->limpiaSTRIni($this->input->post('vc_nombre')); else  $url_ami=$this->limpiaSTRIni($this->input->post('url_ami'));
		if($imagen_logoname!='' && $imagen_interiorname!=''){ 
			$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_LOGO' => $imagen_logoname,
        'IMAGEN_INTERIOR' => $imagen_interiorname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); 
		} elseif($imagen_logoname!=''){
			$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_LOGO' => $imagen_logoname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); 
		} elseif($imagen_interiorname!=''){ 
					$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_INTERIOR' => $imagen_interiorname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
								'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); }else {
		$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
			  'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),	
    ); 
		}
		/*modifica cabecera*/

		$db_di->insert('PRINCIPAL', $data); 
		$id = $this->db->insert_id();
		/*modifica PRINCIPAL_CATEGORIA*/
		$id_categoria = $this->input->post('id_categoria');
		$url = $this->input->post('url');
		$id_plataforma=$this->input->post('id_plataforma');
		$urlb = $this->input->post('urlb');
		$id_plataformab=$this->input->post('id_plataformab');
		
		if(is_numeric($id) && $id>0){
			$this->insertPrincipalCat($id, $id_categoria);
			/*modifica PLAT_RELACION*/
			$this->insertPlatRela($id, $id_plataforma, $url, 1);
			/*modifica PLAT_RELACION*/
			$this->insertPlatRela($id, $id_plataformab, $urlb, 0);
		}

  }
	
	public function updatePlataforma()
  {
		
		
	$db_di = $this->load->database('ag_di', TRUE);
/*$btnSubmit = $_REQUEST['btnSubmit'];
  $vc_nombre = $_REQUEST['vc_nombre'];
  $id_categoria = $_REQUEST['id_categoria'];
  $id_tipo_contenido = $_REQUEST['id_tipo_contenido'];
  $palabras_claves = $_REQUEST['palabras_claves'];
  $id_uni_admin = $_REQUEST['id_uni_admin'];
  $descripcion = $_REQUEST['descripcion'];
  $id_tipo_publico = $_REQUEST['id_tipo_publico'];
  $imagen_logoname = $_FILES['imagen_logo']['name'];
  $imagen_interiorname = $_FILES['imagen_interior']['name'];
  $url = $_REQUEST['url'];
  $id_plataforma=$_REQUEST['id_plataforma'];
  $urlb = $_REQUEST['urlb'];
  $id_plataformab=$_REQUEST['id_plataformab'];
  $id= (int)$_REQUEST['id'];  */
	
	/*UPDATE `AGENDA_DIGITAL`.`PRINCIPAL` SET `ID`='1', `VC_NOMBRE`='Secretaría de Cultura', `ID_CATEGORIA`='11', `ID_TIPO_CONTENIDO`='7', `PALABRAS_CLAVES`='Políticas culturales, Noticias, Acciones y programas, Transparencia', `ID_UNI_ADMIN`='28', `DESCRIPCION`='La Secretaría de Cultura fue creada en diciembre de 2015 por decreto presidencial. Es la institución encargada de la promoción y difusión de  las expresiones artísticas y culturales de México, así como de la proyección de la presencia del país en el extranjero. Impulsa la educación y la investigación artística y cultural y dota a la infraestructura cultural, de espacios y servicios dignos para hacer de ella, un uso más intensivo. Trabaja en favor de la preservación, promoción y difusión del patrimonio y la diversidad cultural. Asimismo, apoya la creación artística y el desarrollo de las industrias creativas para reforzar la generación y acceso de bienes y servicios culturales, además de que promueve el acceso universal a la cultura aprovechando los recursos que ofrece la tecnología digital.', `ID_TIPO_PUBLICO`='5', `IMAGEN_LOGO`='secretaria_de_cultura.jpg', `IMAGEN_INTERIOR`='', `URL_ALT`='secretaria-cultura', `TIENE_GRAFICA`='1', `RAZONES_GRAFICA`='BIEN APLICADA', `ESTATUS`=NULL, `FCH_REVISION`=NULL, `USU_REVISION`=NULL WHERE (`ID`='1');
*/



  $imagen_logoname = $_FILES['imagen_logo']['name'];
  $imagen_interiorname = $_FILES['imagen_interior']['name'];
	$id=(int)$this->input->post('id');
	
	$carpeta = "/export/home/paginas/www2/images/";
    
    if(!empty($imagen_logoname)) {
      $ExtImage = $this->getFileExtension($imagen_logoname);
      if(!is_dir($carpeta)) mkdir($carpeta, 0777); 
      $imagen_logo = $carpeta.basename($_FILES['imagen_logo']['name']);
      $img_nm1 = substr($imagen_logo, 6, strlen($imagen_logo) - 3);
      $tamano = $_FILES ['imagen_logo']['size'];  
      
      if (basename($_FILES['imagen_logo']['name']) != "") {
        if ($_FILES["imagen_logo"]["error"] > 0) { echo "Error: " . $_FILES["imagen_logo"]["error"] . "<br />"; exit();}
        else {
          if($tamano<900000000) {
              if (file_exists($carpeta.$_FILES["imagen_logo"]["name"]))  echo $_FILES["imagen_logo"]["name"]." ya existe.";
              else move_uploaded_file($_FILES["imagen_logo"]["tmp_name"], $imagen_logo);
          } else {
            $msg= "La imagen no debe sobrepasar 900 Mb de peso"; 
            exit();
          }
        } 
      } 

    }
		

if(!empty($imagen_interiorname)) {
      $ExtImage = $this->getFileExtension($imagen_interiorname);
      if(!is_dir($carpeta)) mkdir($carpeta, 0777); 
      $imagen_interior = $carpeta.basename($_FILES['imagen_interior']['name']);
      $img_nm2 = substr($imagen_interior, 6, strlen($imagen_interior) - 3);
      $tamano = $_FILES ['imagen_interior']['size']; 
      if (basename($_FILES['imagen_interior']['name']) != "") {
        if ($_FILES["imagen_interior"]["error"] > 0) { echo "Error: " . $_FILES["imagen_interior"]["error"] . "<br />"; exit();}
        else {
          if($tamano<900000000) {
              if (file_exists($carpeta.$_FILES["imagen_interior"]["name"]))  echo $_FILES["imagen_interior"]["name"]." ya existe.";
              else move_uploaded_file($_FILES["imagen_interior"]["tmp_name"], $imagen_interior);
          } else {
            $msg= "La imagen no debe sobrepasar 900 Mb de peso"; 
            exit();
          }
        }
      }

    } 		
		
		if($this->input->post('url_ami')=='') $url_ami=$this->limpiaSTRIni($this->input->post('vc_nombre')); else  $url_ami=$this->limpiaSTRIni($this->input->post('url_ami'));
		if($imagen_logoname!='' && $imagen_interiorname!=''){ 
			$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_LOGO' => $imagen_logoname,
        'IMAGEN_INTERIOR' => $imagen_interiorname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); 
		} elseif($imagen_logoname!=''){
			$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_LOGO' => $imagen_logoname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); 
		} elseif($imagen_interiorname!=''){ 
					$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'IMAGEN_INTERIOR' => $imagen_interiorname,
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
				'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
								'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),
    ); }else {
		$data = array(
        'VC_NOMBRE' => $this->input->post('vc_nombre'),        
        'ID_TIPO_CONTENIDO' => $this->input->post('id_tipo_contenido'),
        'PALABRAS_CLAVES' => $this->input->post('palabras_claves'),
        'ID_UNI_ADMIN' => $this->input->post('id_uni_admin'),
        'DESCRIPCION' => $this->input->post('descripcion'),
        'ID_TIPO_PUBLICO' => $this->input->post('id_tipo_publico'),
        'URL_ALT' => $this->session->userdata('url'),
        'USU_REVISION' => $this->session->userdata('nombre'),
        'FCH_REVISION' => date('Y-m-d H:i:s'),
				'ESTATUS' =>$this->input->post('estatus'),
			  'URL_ALT' =>$url_ami,
				'FCH_ULT_ACTUALIZA' => $this->input->post('datepicker'),
				'SERVIDOR_ALOJA' => $this->input->post('servidor_aloja'),
				'IP_SERVIDOR' => $this->input->post('servidor_ip'),
				'TIENE_GRAFICA' => $this->input->post('tiene_grafica'),
				'RAZONES_GRAFICA' => $this->input->post('descripcion_gb'),	
    ); 
		}
		/*modifica cabecera*/
	 	$db_di->where('ID', $id);
	  $db_di->update('PRINCIPAL', $data);
		/*modifica PRINCIPAL_CATEGORIA*/
		$id_categoria = $this->input->post('id_categoria');

		$this->insertPrincipalCat($id, $id_categoria);
		/*modifica PLAT_RELACION*/
		$url = $this->input->post('url');
		$id_plataforma=$this->input->post('id_plataforma');
		
	
		$this->insertPlatRela($id, $id_plataforma, $url, 1);
		
		/*modifica PLAT_RELACION*/
		$urlb = $this->input->post('urlb');
		$id_plataformab=$this->input->post('id_plataformab');
		

		$this->insertPlatRela($id, $id_plataformab, $urlb, 0);
		

  }
	
	
	public function insertPrincipalCat($id, $valor){		
	if($valor!='' && is_numeric($id))
		{
			$db_di = $this->load->database('ag_di', TRUE);
			$db_di->where('ID_PRINCIPAL', $id);
			$db_di->delete('PRINCIPAL_CATEGORIA');
			$id_categoria=$valor;
			for($j=0;$j<count($id_categoria); $j++)
			{
			$data = array( 'ID_PRINCIPAL'=>$id, 'ID_CATEGORIA'=>$id_categoria[$j]);
			$db_di->insert('PRINCIPAL_CATEGORIA', $data); 
			//$id = $db_di->insert_id();
			//if(is_numeric($id)) return $id; else return 0;
			}
		}
	}
	
public function insertPlatRela($id, $valor, $url, $eli){

	if($valor!='' && is_numeric($id))
		{
			$db_di = $this->load->database('ag_di', TRUE);
			if($eli==1){ $db_di->where('ID_PLA_DIG', $id); $db_di->delete('PLAT_RELACION');}
			$id_plataforma=$valor;
			
			for($i=0; $i<count($url); $i++)
			{
			if($url[$i]!=''){
				$data = array( 'ID_PLA_DIG'=>$id, 'ID_PLA'=>$id_plataforma[$i], 'URL'=>$url[$i], 'DT_FECHA_CREA'=>date('Y-m-d H:i:s'));
				print_r($data);
				$db_di->insert('PLAT_RELACION', $data); 
				//$id = $db_di->insert_id();
				//if(is_numeric($id)) return $id; else return 0;
			}
			}
			
		}

	}
	
	 public function getFileExtension($str) {
      $i = strrpos($str, ".");
      if (!$i) { return ""; }
      $l = strlen($str) - $i;
      $ext = substr($str,$i+1,$l);
      $ext = strtolower($ext);
      if($ext == "gif" || $ext == "jpg" || $ext == "png") {}
      else {
        echo"<strong>$ext</strong> no es un formato de imagen válido. Por favor sólo adjunte documentos GIF, JPG o PNG";
        exit();
      }
      return $ext;
    }

public function limpiaSTRIni($string)
{
	$string = strip_tags(trim($string));
	$string=str_replace('%','',$string);
	$string=trim($string);
	$string = str_replace(
		array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý', ' ', ',', '.', '/','(',')','|',':','%','!','¡','-'),
		array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y', '-', '',  '', '','','','','','','','','-'),
		$string
	);
	$string = strtolower($string);
	$string=str_replace('--','-',$string);
		$string=str_replace('--','-',$string);
	return $string;
}

	
}