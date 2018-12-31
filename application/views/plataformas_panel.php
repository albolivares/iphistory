<?php $this->load->view('auth/cabeza'); ?>
<div class="page-title">
              <div class="title_left">
                <h3><?php echo $title; ?></h3>
              </div>
            </div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <p><?php echo anchor('plataforma/nuevo', 'Nuevo','class="btn btn-primary btn-sm"')?>  </p>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>

    <th>Nombre</th>
    <th>Unidad administrativa</th>
    <th>Tipo de contenido</th>
    <th>Gráfica base</th>
    <th>Estatus</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($rsPlataforma as $plataforma):
    
    $grafica=$plataforma->TIENE_GRAFICA;
		$txt_grafica='';
		if($grafica>=0) {if($grafica==0) $txt_grafica='No'; elseif($grafica==1) $txt_grafica='Si'; else $txt_grafica='No aplica';}
    ?>
    <tr>
            <td><?php echo $plataforma->VC_NOMBRE;?></td>
            <td><?php echo $plataforma->TXT_UNI_ADMIN;?></td>            
            <td><?php echo $plataforma->VC_TIPO_CONTENIDO?></td>            
            <td><?php echo $txt_grafica;?></td>
            <td><?php echo $plataforma->ESTATUS;?></td>
            <td><?php echo anchor("plataforma/editar/".$plataforma->ID, 'Modificar','class="btn btn-primary"') ;?> | <?php echo anchor("plataforma/eli/".$plataforma->ID, 'Eliminar','class="btn btn-primary"') ;?></td>    
   </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<?php $this->load->view('auth/pie'); ?>