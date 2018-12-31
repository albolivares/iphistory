<?php session_start();  
error_reporting(E_ALL); 

  ini_set("display_errors", 1);
	
  require_once("JSON.php");  
  include('class.upload.php');
	//$json = new Services_JSON; 	
	$cproy=$_REQUEST["c"];
	if(!empty($_FILES)){
		 
		 	if($_FILES['uploadEfemerides']):
			
		    $handle= new upload($_FILES['uploadEfemerides']);
		    $nombre_archivo = strtolower(sacar_extension_nombre(quitarAcentos($_FILES['uploadEfemerides']['name'])));		
		    $nombre_archivoext =  strtolower(quitarAcentos($_FILES['uploadEfemerides']['name']));		
		    $anio = date(Y);
		    $mes = date(m);	 
		   
					$carpeta = $ruta_fotogaleria_efemerides.$anio.$mes."/";
				 
		    if(!is_dir($carpeta)) mkdir($carpeta, 0777);
    		if ($handle->uploaded) 
				{
					$handle->file_src_name_body      = $nombre_archivo.uniqid();			
					$handle->file_overwrite          = true; 
					$handle->Process($carpeta);
					$json_file['archivo_ori'] = $carpeta.$handle->file_dst_name;			    
					if($_COOKIE['LogEditaEstado']==1)://A		
					else://AELSE
						$image_file = getimagesize($handle->file_dst_pathname);
						$maxwidth= 355;
						$maxheight= 900;
						$oldwidth= $image_file[0];
						$oldheight= $image_file[1];
						//if($oldwidth > $oldheight)://1
							if($handle->processed)://2
								$imagen = $handle->file_dst_name;
								$imagen_355 = new upload($handle->file_dst_pathname);
								$imagen_355->file_src_name_body = $nombre_archivo.uniqid();
								$imagen_355->image_resize        = true;
								$imagen_355->image_ratio_y       = true;
								$imagen_355->image_x       = 355;
								$imagen_355->process($carpeta);
								$json_file['archivo'] = $carpeta.$imagen_355->file_dst_name;
					    endif;//2					  
					 // endif;//1
			    endif;//endifA
				  $json_file['respuesta'] = "success";					
				  echo $json->encode($json_file);
		  }else {
			  $json_file['respuesta'] = "error";			
			    echo $json->encode($json_file);
		  }
		endif;
		 		
		
		/***PDF***/
		if($_FILES['uploadfile']):
		$handle= new upload($_FILES['uploadfile']);
		$nombre_archivo = strtolower(sacar_extension_nombre(quitarAcentos($_FILES['uploadfile']['name'])));
		
		$nombre_archivoext =  strtolower(quitarAcentos($_FILES['uploadfile']['name']));
		$peso =  formatBytes($_FILES['uploadfile']['size']);

		$carpeta = "../../../../recursos/pdf/".$cproy."/";
		if(!is_dir($carpeta)) mkdir($carpeta, 0777);
    
		if ($handle->uploaded) {
		  $handle->file_src_name_body      = $nombre_archivo;
			$handle->file_overwrite          = true; 
			$handle->Process($carpeta);
			
			$json_file['archivo'] = $handle->file_dst_name;
			$json_file['peso'] = $peso;
			$json_file['respuesta'] = "success";
			
			echo json_encode($json_file);
			
			//echo "success";
			
		}else {
			$json_file['respuesta'] = "error";			
			echo json_encode($json_file);
		 }
		 endif;
		 
		 /***IMG convocatorias***/
		 if($_FILES['uploadfileimgc']):
		$handle= new upload($_FILES['uploadfileimgc']);
		$nombre_archivo = strtolower(sacar_extension_nombre(quitarAcentos($_FILES['uploadfileimgc']['name'])));
		
		$nombre_archivoext =  strtolower(quitarAcentos($_FILES['uploadfileimgc']['name']));
		
		$anio = date(Y);
		$mes = date(m);	
		$carpeta = $ruta_convocatorias.$anio.$mes."/";        
		
		if(!is_dir($carpeta)) mkdir($carpeta, 0777);
    
		if ($handle->uploaded) {
		  $handle->file_src_name_body      = $nombre_archivo;
			$handle->file_overwrite          = true; 
			$handle->Process($carpeta);
			
			$json_file['archivo'] = $carpeta.$handle->file_dst_name;
			//$json_file['peso'] = $peso;
			$json_file['respuesta'] = "success";
			
			echo $json->encode($json_file);
			
			//echo "success";
			
		}else {
			$json_file['respuesta'] = "error";			
			echo $json->encode($json_file);
		 }
		 endif;

		 /***PDF Convocatorias***/
		if($_FILES['uploadfiledoc']):
		$handle= new upload($_FILES['uploadfiledoc']);
		$nombre_archivo = strtolower(sacar_extension_nombre(quitarAcentos($_FILES['uploadfiledoc']['name'])));
		
		$nombre_archivoext =  strtolower(quitarAcentos($_FILES['uploadfiledoc']['name']));
		
		$anio = date(Y);
		$mes = date(m);	 
		$carpeta = $ruta_convocatorias.$anio.$mes."/";
		if(!is_dir($carpeta)) mkdir($carpeta, 0777);
    
		if ($handle->uploaded) {
		  $handle->file_src_name_body      = $nombre_archivo;
			$handle->file_overwrite          = true; 
			$handle->Process($carpeta);
			
			$json_file['archivo'] = $carpeta.$handle->file_dst_name;
			//$json_file['peso'] = $peso;
			$json_file['respuesta'] = "success";
			
			echo $json->encode($json_file);
			
			//echo "success";
			
		}else {
			$json_file['respuesta'] = "error";			
			echo $json->encode($json_file);
		 }
		 endif;
		 
		 /***PDF edo***/
		if($_FILES['uploadfileedo']):
		
		$handle= new upload($_FILES['uploadfileedo']);
		$nombre_archivo = strtolower(sacar_extension_nombre(quitarAcentos($_FILES['uploadfileedo']['name'])));
		
		$nombre_archivoext =  strtolower(quitarAcentos($_FILES['uploadfileedo']['name']));
		if(isset($_GET['tblA'])) $tbl = $_GET['tblA'];
		if ($tbl=="CT") 
		{
			$tbl_mod="CURSOS_TALLERES";
			$titulo = "CURSOS, TALLERES Y DIPLOMADOS";
			$ruta=$ruta_cursos;
			//echo "entro aqui";
		}
	else  
		{
			$tbl_mod="ACTIVIDADES_CULTURALES";
			$ruta=$ruta_ferias_festivales;
			$titulo = "FERIAS Y FESTIVALES";
		}
		$anio = date(Y);
		$mes = date(m);	
		$carpeta = $ruta.$anio.$mes."/";
		
		if(!is_dir($carpeta)) mkdir($carpeta, 0777);
    
		if ($handle->uploaded) {
		  $handle->file_src_name_body      = $nombre_archivo;
			$handle->file_overwrite          = true; 
			$handle->Process($carpeta);
			
			$json_file['archivo'] = $carpeta.$handle->file_dst_name;
			//$json_file['peso'] = $peso;
			$json_file['respuesta'] = "success";
			
			echo $json->encode($json_file);
			
			//echo "success";
			
		}else {
			$json_file['respuesta'] = "error";			
			echo $json->encode($json_file);
		 }
		 endif;
	}

/**
*  Funciones para quitar acentos
*
*
*/

function quitarAcentos($text)
	{		
		
		$text = htmlentities($text);
		
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
	
	function sacar_extension_nombre($file) {
    $trozos = explode("." , $file);
    $cuantos = count($trozos);
    $ext = $trozos[0];
    return (string) $ext;
  }
	

function formatBytes($b,$p = null) {
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
	
?>