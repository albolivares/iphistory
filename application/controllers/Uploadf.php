<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set("display_errors", 0);

class Uploadf extends CI_Controller {


  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('session','form_validation', 'upload'));
    $this->load->helper(array('form', 'url'));
  }
  
	function _remap($cproy) {
        $this->index($cproy);
    }

	
  public function index($cproy)
  { 
		if(!empty($_FILES) && $cproy!=''){
			//$cproy = $this->input->post('carpeta');
			$handle= new upload($_FILES['uploadfile']);

			$nombre_archivo = strtolower($this->sacar_extension_nombre($this->quitarAcentos($_FILES['uploadfile']['name'])));
			$nombre_archivoext =  strtolower($this->quitarAcentos($_FILES['uploadfile']['name']));
			$carpeta = "/export/home/paginas/www2/solpro/recursos/pdf/".$cproy."/";
			//echo $carpeta;
		
			//var_dump(mkdir($carpeta, 0777));
			//print_r(mkdir($carpeta, 0777));
			//exit();
			if(!is_dir($carpeta)) mkdir($carpeta, 0777);
			if ($handle->uploaded) {
		  	$handle->file_src_name_body      = $nombre_archivo;
				$handle->file_overwrite          = false; 
				$handle->Process($carpeta);
				$json['archivo'] = $handle->file_dst_name;
				$json['respuesta'] = "success";
				echo json_encode($json);
				}else {
					echo "error:".$handle->json;
		 		}
			}
  }


	public function sacar_extension_nombre($file) {
    $trozos = explode("." , $file);
    $cuantos = count($trozos);
    $ext = $trozos[0];
    return (string) $ext;
  }
	
	public function quitarAcentos($text)
	{
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
		//$text = strtolower($text);
		$patron = array (
			// Espacios, puntos y comas por guion
			'/[\,]+/' => '-',
 
			// Vocales
			'/&agrave;/' => 'a', 
			'/&egrave;/' => 'e',
			'/&igrave;/' => 'i',
			'/&ograve;/' => 'o',
			'/&ugrave;/' => 'u',
			'/&Agrave;/' => 'A', 
			'/&Egrave;/' => 'E',
			'/&Igrave;/' => 'I',
			'/&Ograve;/' => 'O',
			'/&Ugrave;/' => 'U',
 
			'/&aacute;/' => 'a',
			'/&eacute;/' => 'e',
			'/&iacute;/' => 'i',
			'/&oacute;/' => 'o',
			'/&uacute;/' => 'u',
			'/&Aacute;/' => 'A',
			'/&Eacute;/' => 'E',
			'/&Iacute;/' => 'I',
			'/&Oacute;/' => 'O',
			'/&Uacute;/' => 'U',
 
			'/&acirc;/' => 'a',
			'/&ecirc;/' => 'e',
			'/&icirc;/' => 'i',
			'/&ocirc;/' => 'o',
			'/&ucirc;/' => 'u',
			'/&acirc;/' => 'A',
			'/&ecirc;/' => 'E',
			'/&icirc;/' => 'I',
			'/&ocirc;/' => 'O',
			'/&ucirc;/' => 'U',
 
			'/&atilde;/' => 'a',
			'/&etilde;/' => 'e',
			'/&itilde;/' => 'i',
			'/&otilde;/' => 'o',
			'/&utilde;/' => 'u',
			'/&Atilde;/' => 'A',
			'/&Etilde;/' => 'E',
			'/&Itilde;/' => 'I',
			'/&Otilde;/' => 'O',
			'/&Utilde;/' => 'U',
 
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
			'/&Auml;/' => 'A',
			'/&Euml;/' => 'E',
			'/&Iuml;/' => 'I',
			'/&Ouml;/' => 'O',
			'/&Uuml;/' => 'U',
			
 
			
 
			// Otras letras y caracteres especiales
			'/&aring;/' => 'a', 
			'/&ntilde;/' => 'n',
			'/&Aring;/' => 'A', 
			'/&Ntilde;/' => 'N',
 
			// Agregar aqui mas caracteres si es necesario
 
		);
 
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		$text = str_replace(" ", "_",$text);	
		return $text;
	}

public function formatBytes($b,$p = null) {
    /**
     *
     * @author Martin Sweeny
     * @version 2010.0617
     *
     * returns formatted number of bytes.
     * two parameters: the bytes and the precision (optional).
     * if no precision is set, function will determine clean
     * result automatically.
     *
     **/
    $units = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
    $c=0;
    if(!$p && $p !== 0) {
        foreach($units as $k => $u) {
            if(($b / pow(1024,$k)) >= 1) {
                $r["bytes"] = $b / pow(1024,$k);
                $r["units"] = $u;
                $c++;
            }
        }
        return number_format($r["bytes"],2) . " " . $r["units"];
    } else {
        return number_format($b / pow(1024,$p)) . " " . $units[$p];
    }
}
	


}