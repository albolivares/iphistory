<?php $this->load->view('auth/cabeza'); ?>
<div class="page-title">
              <div class="title_left">
                <h3><?php echo $title; ?></h3>
              </div>
              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <p><?php echo anchor('tipo_rel/nuevo', 'Nuevo','class="btn btn-link"')?></p>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th>Tipo de solicitud</th>
    <th>Documento</th>
    <!--<th>Descripción</th>-->
    <th>¿Es obligatorio?</th>
    <th>Orden</th>
    <th>Fase</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($tiporela as $tiporel):
    
    switch ($tiporel->FASE) {
      case 'A':
        $fase = 'Solicitud';
        break;
      case 'D':
        $fase = 'Desarrollador';
        break;
      case 'G':
        $fase = 'Gráfica';
        break;
      case 'F':
        $fase = 'Final';
        break;      
    }
    
    ?>
    <tr>
            <td><?php echo htmlspecialchars($tiporel->VC_NOMBRE,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($tiporel->VC_DOCUMENTO,ENT_QUOTES,'UTF-8');?></td>
            <!--<td><?php echo htmlspecialchars($tiporel->DESCRIPCION,ENT_QUOTES,'UTF-8');?></td>-->
            <td><?php echo ($tiporel->ES_OBLIGATORIO==0) ? 'No':'Sí'?></td>            
            <td><?php echo $tiporel->ORDEN?></td>
            <td><?php echo $fase;?></td>
            <td><?php echo anchor("tipo_rel/editar/".$tiporel->ID, 'Modificar','class="btn btn-primary"') ;?> | <?php echo anchor("tipo_rel/eli/".$tiporel->ID, 'Eliminar','class="btn btn-primary"') ;?></td>    
   </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<?php $this->load->view('auth/pie'); ?>