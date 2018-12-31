<?php $this->load->view('auth/cabeza_plataforma'); 
//print_r($resultado);
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($resultado!='') {

	foreach($resultado as $rs){
	$vc_nombre = $rs->VC_NOMBRE;
  $id_categoria = $rs->ID_CATEGORIA;
  $id_tipo_contenido = $rs->ID_TIPO_CONTENIDO;
  $palabras_claves = $rs->PALABRAS_CLAVES;
  $id_uni_admin = $rs->ID_UNI_ADMIN;
  $descripcion = $rs->DESCRIPCION;
  $id_tipo_publico = $rs->ID_TIPO_PUBLICO;
  $imagen_logoname = $rs->IMAGEN_LOGO;
  $imagen_interiorname = $rs->IMAGEN_INTERIOR;
	$estatus = $rs->ESTATUS;	
	$tieneg = $rs->TIENE_GRAFICA;
	$razong = $rs->RAZONES_GRAFICA;
	if($rs->URL_ALT=='' || $rs->URL_ALT=='null') $url_ami=limpiaSTRIni($vc_nombre);	
	else $url_ami = $rs->URL_ALT;
	$fch_ult = $rs->FCH_ULT_ACTUALIZA;
	$aloja = $rs->SERVIDOR_ALOJA;	
	$serv_ip = $rs->IP_SERVIDOR;	
	
	$result = $platforma_prin;
//  for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);
 $set[]=$result;
	}
}else{
$vc_nombre = ''; $id_categoria = ''; $id_tipo_contenido = ''; $palabras_claves = ''; $id_uni_admin = ''; $descripcion = ''; $id_tipo_publico = ''; $imagen_logoname = ''; $imagen_interiorname = ''; $url_ami =''; $razong='';$tieneg='';$estatus=''; $fch_ult='';	$aloja = '';	$serv_ip = '';	$result=''; $set[]='';
	
}

function seleccionaMultiple($valor, $arreglo)
{
	$seleccionado = '';

  if($valor!='' && $arreglo[0]!='')
  {

    foreach($arreglo[0] as $cat)
    {
       
      if($cat->ID_CATEGORIA==$valor)
      {
        $seleccionado = ' selected="selected"';
      }
    }
    echo $seleccionado;
  }
}


function limpiaSTRIni($string)
{
	$string = strip_tags(trim($string));
	$string=str_replace('-','',$string);
	$string=str_replace('%','',$string);
	$string=trim($string);
	$string = str_replace(
		array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý', ' ', ',', '.', '/','(',')','|',':','%','!','¡'),
		array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y', '-', '',  '', '-','-','-','-','','','',''),
		$string
	);
	$string = strtolower($string);
	$string=str_replace('--','-',$string);
		$string=str_replace('--','-',$string);
	return $string;
}
?>
<h2><?php //echo lang('create_user_heading');?></h2>
<div class="row">
  <?php if(validation_errors()) { ?>
  <div id="infoMessage" class="alert alert-danger"><?php echo validation_errors(); ?></div>
  <?php } ?>
<div id="infoMessage"><?php //echo $message;?></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo $title; ?></h2>
    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<form name="frmprincipal"  method="post" enctype="multipart/form-data" >
      <input type="hidden" name="acc" id="acc" value="<?php echo $acc?>" />
      <input type="hidden" name="id" value="<?php echo $id ?>" />
      <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="vc_nombre" id="vc_nombre" value="<?php echo $vc_nombre;?>" class="form-control" />        
      </div>
      <div class="form-group">
        <label>URL:</label>
        <input type="text" name="url_ami" id="url_ami" value="<?php echo $url_ami;?>" class="form-control" />   
        <br/>* Esta url es la que presenta en el sitio de http://todocultura.mx/, solo debe contener letras y números separados por un guón. Sin espacios,ni acentos o caraceteres extraños.     
      </div>
      <div class="form-group">
        <label>Categoría:</label>
        <select name="id_categoria[]" id="id_categoria" class="form-control" multiple="multiple">
          <option value="">--Seleccione la Categoría--</option>
          <?php  foreach($categorias as $fila_cat){ ?>
          <option value="<?=$fila_cat->ID_CATEGORIA?>" <?php seleccionaMultiple($fila_cat->ID_CATEGORIA,$set)?>><?php echo $fila_cat->VC_CATEGORIA?></option>
          <?php } ?>
        </select>        
      </div>
      <div class="form-group">
        <label>Tipo Contenido:</label>
        <select name="id_tipo_contenido" id="id_tipo_contenido" class="form-control">
          <option value="">--Seleccione tipo contenido--</option>
          <?php foreach($tipocont as $fila_cont){ ?>
          <option value="<?=$fila_cont->ID_TIPO_CONTENIDO; ?>"<?php echo ($id_tipo_contenido==$fila_cont->ID_TIPO_CONTENIDO) ? ' selected="selected"':''?>><?=$fila_cont->VC_TIPO_CONTENIDO?></option>
          <?php } ?>
        </select>        
      </div>
      <div class="form-group">
        <label>Palabras claves:</label>
        <textarea name="palabras_claves" id="palabras_claves" class="form-control"><?php echo $palabras_claves?></textarea>
      </div>
      <div class="form-group">
        <label>Unidad Administrativa:</label>
        
            
        <select name="id_uni_admin" id="id_uni_admin" class="form-control">
          <option value="">--Seleccione Unidad Administrativa--</option>
          <?php foreach($uniadmin as $fila_adm){ ?>
          <option value="<?php echo $fila_adm->ID_UNI_ADMIN?>"<?php echo ($id_uni_admin==$fila_adm->ID_UNI_ADMIN) ? ' selected="selected"':''?>><?php echo $fila_adm->TXT_UNI_ADMIN?></option>
          <?php  } ?>
        </select>        
      </div>
      <div class="form-group">
        <label>Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $descripcion?></textarea>
      </div>
      <div class="form-group">
        <label>Tipo publico:</label>
        <select name="id_tipo_publico" id="id_tipo_publico" class="form-control">
          <option value="">--Seleccione Tipo publico--</option>
          <?php foreach($tipopub as $fila_pub){ ?>
          <option value="<?php echo $fila_pub->ID_TIPO_PUBLICO?>"<?php echo ($id_tipo_publico==$fila_pub->ID_TIPO_PUBLICO) ? ' selected="selected"':''?>><?php echo $fila_pub->VC_TIPO_PUBLICO?></option>
          <?php  } ?>
        </select>        
      </div>
      <div class="form-group">
        <label>Red Social</label>
        
        
        <?php if($acc=='mod' && $id!=0 || $acc=='eli')
        { 
          $cont = 1;          //foreach($)
          if($plataforma_rel){

          foreach($plataforma_rel as $fila_rel){        
            ?>
              
      <div id="input<?php echo $cont;?>" class="clonedInput">      
      	<input type="text" name="url[]" id="url" value="<?php echo $fila_rel->URL?>" size="80" />
      	<select name="id_plataforma[]" id="id_plataforma">
          <option value="">--Seleccione Red Social--</option>
          <?php
					
					
					foreach($plataforma_soc as $fila_soc){          
          ?>
          <option value="<?php echo $fila_soc->ID?>" <?php echo ($fila_rel->ID_PLA==$fila_soc->ID) ? ' selected="selected"' :'' ?>><?php echo $fila_soc->VC_NOMBRE?></option>
          <?php  
            }
          
          ?>
        </select>
   		</div>
   <?php 
          $cont++; 
          }/*foreach($plataforma_rel as $fila_rel){*/
          }/*if($resultadoS){*/ else {
          ?>
          <div id="input1" class="clonedInput">      
      <input type="text" name="url[]" id="url" value="" size="80" /><select name="id_plataforma[]" id="id_plataforma">
          <option value="">--Seleccione Red Social--</option>
          <?php
					
					
					foreach($plataforma_soc as $fila_soc){          
          ?>
          <option value="<?php echo $fila_soc->ID?>" ><?php echo $fila_soc->VC_NOMBRE?></option>
          <?php  
            }
          
          ?>
        </select>
   </div>
          <?php  
          }/*else...($resultadoS){*/
          } else { 
    ?>
    <div id="input1" class="clonedInput">      
      <input type="text" name="url[]" id="url" value="" size="80" /><select name="id_plataforma[]" id="id_plataforma">
          <option value="">--Seleccione Red Social--</option>
          <?php
					
					
					foreach($plataforma_soc as $fila_soc){          
          ?>
          <option value="<?php echo $fila_soc->ID?>"><?php echo $fila_soc->VC_NOMBRE?></option>
          <?php 
            
          }
          ?>
        </select>
   </div>
   <?php  
   }/*if($acc=='mod' && $id!=0 || $acc=='eli')*/ ?>
   <div class="form-group">
      <label>Agregar más campos</label>
      <input type="button" id="btnAdd" value="+" class="btn btn-primary"/>
      <input type="button" id="btnDel" value="-" class="btn btn-primary"/>
   </div>
      </div>
      <div class="form-group">
        <label>Aplicación</label>
        <?php if($acc=='mod' && $id!=0)
        { 
          $cont = 1;
          if($plataforma_relA){
          	foreach($plataforma_relA as $fila_relA){        
         ?>
        <div id="inputb<?php echo $cont?>" class="clonedInputb">            
      <input type="text" name="urlb[]" id="urlb" size="80" value="<?php echo $fila_relA->URL?>" /><select name="id_plataformab[]" id="id_plataformab">
          <option value="">--Seleccione Aplicación--</option>
          <?php
					
					
					foreach($plataforma_socA as $fila_socA){          
          ?>
          <option value="<?php echo $fila_socA->ID?>" <?php echo ($fila_relA->ID_PLA==$fila_socA->ID) ? ' selected="selected"' :'' ?>><?php echo $fila_socA->VC_NOMBRE?></option>
          <?php  
            }
          
          ?>
        </select>
        
   </div>
   <?php 
          $cont++;
          } /*foreach($plataforma_relA as $fila_relA){ */
          }else{ ?>
           <div id="inputb1" class="clonedInputb">             
      <input type="text" name="urlb[]" id="urlb" size="80" value="" /><select name="id_plataformab[]" id="id_plataformab">
          <option value="">--Seleccione Aplicación--</option>
          <?php						
						foreach($plataforma_socA as $fila_socA){          
          ?>
          <option value="<?php echo $fila_socA->ID?>" ><?php echo $fila_socA->VC_NOMBRE?></option>
          <?php  
            }
          
          ?>
        </select>
        
   </div> 
          <?php
          }
          
          } else {
    ?>
    <div id="inputb1" class="clonedInputb">      
      <input type="text" name="urlb[]" id="urlb" value="" size="80" /><select name="id_plataformab[]" id="id_plataformab">
          <option value="">--Seleccione Aplicación--</option>
          <?php
					
					
					foreach($plataforma_socA as $fila_socA){          
          ?>
          <option value="<?php echo $fila_socA->ID?>"><?php echo $fila_socA->VC_NOMBRE?></option>
          <?php 
            
          }
          ?>
        </select>
   </div>
    <?php } ?>
   <div class="form-group">
      <label>Agregar más campos</label>
      <input type="button" id="btnAddb" value="+"  class="btn btn-primary"/>
      <input type="button" id="btnDelb" value="-"  class="btn btn-primary"/>
   </div>
      </div>
      <div class="form-group">
        <label>Imagen logo: <?php echo $imagen_logoname?></label>
        <input type="file" name="imagen_logo" id="imagen_logo" class="form-control" value="<?=$imagen_logoname?>" />        
      </div>
       <div class="form-group">
        <label>Imagen interior:<?php echo  $imagen_interiorname?></label>
        <input type="file" name="imagen_interior" id="imagen_interior" value="<?=$imagen_interiorname?>" class="form-control" />        
      </div>
      
      <hr/>
             
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus</label> <br />
            <?php
              $opciones = array(''=>'Seleccione');
              $options = array(              
                 ''=>'Seleccione', 'A'=>'Publicado', 'N'=>'No publicado', 'F'=>'Fuera de línea'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('estatus', $options,$estatus, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'estatus']);?>
      </div>
      
      
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-3 col-xs-12">Fecha de última modificación</label> <br />
            <input type="text" name="datepicker"  id="datepicker" value="<?=$fch_ult?>" class="form-control"  />        
     </div>
     
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-3 col-xs-12">¿El servidor dónde se aloja el sitio fue proporcionado por la Secretaria de Cultura?</label> <br />
                        <?php
              $opciones = array(''=>'Seleccione');
              $options = array(              
                 ''=>'Seleccione', '1'=>'Sí', '0'=>'No'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('servidor_aloja', $options,$aloja, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'servidor_aloja']);?>
     </div>
     
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-3 col-xs-12">Direción IP o nombre del sevidor dónde se aloja el sitio</label> <br />
            <input type="text" name="servidor_ip" id="servidor_ip" value="<?=$serv_ip?>" class="form-control"  />        
     </div>
     
           <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-3 col-xs-12">¿Cuenta con gráfica base aplicada?</label> <br />
                     <?php
              $opciones = array(''=>'Seleccione');
              $options = array(              
                 ''=>'Seleccione', '1'=>'Sí', '0'=>'No'
                );

              //$shirts_on_sale = array('small', 'large');

              echo form_dropdown('tiene_grafica', $options,$tieneg, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'tiene_grafica']);?>
     </div>
     
           <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <label>Razones por las que aplica o no aplica la gráfica base:</label>
        <textarea name="descripcion_gb" id="descripcion_gb" class="form-control"><?=$razong ?></textarea>
      </div>
     
      <div><input type="submit" name="btnSubmit" id="btnSubmit" value="<?php if ($acc=="eli") {?>Eliminar<?php } else { ?>Guardar<?php } ?>" class="btn btn-primary" /></div>
    </form>
</div>
  </div>
</div>
</div>
<?php $this->load->view('auth/pie'); 
?>