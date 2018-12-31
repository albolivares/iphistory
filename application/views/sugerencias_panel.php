<?php $this->load->view('auth/cabeza'); ?>
<div class="page-title">
              <div class="title_left">
                <h3><?php echo $title; ?></h3>
              </div>
            </div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <p><?php echo anchor('sugerencias/nuevo', 'Nuevo','class="btn btn-link"')?></p>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th>Titulo</th>
    <th>Resumen</th>
    <th>Estatus</th>    
    <th>Fecha</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($sugerencias as $sugerencia):?>
    <tr>
            <td><?php echo htmlspecialchars($sugerencia->TITULO,ENT_QUOTES,'UTF-8');?></td>            
            <td><?php echo htmlspecialchars($sugerencia->RESUMEN,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo ($sugerencia->ESTATUS==0) ? 'Inactivo':'Activo';?></td>
            <td><?php echo $sugerencia->FECHA;?></td>
            <td><?php echo anchor("sugerencias/modi/".$sugerencia->ID, 'Modificar','class="btn btn-primary"') ;?> | <?php echo anchor("sugerencias/eli/".$sugerencia->ID, 'Eliminar','class="btn btn-primary"') ;?></td>    
   </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<?php $this->load->view('auth/pie'); ?>