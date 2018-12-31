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
  <p><?php echo anchor('tipo_solicitud/nuevo', 'Nuevo','class="btn btn-link"')?></p>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>¿Requiere Id de Proyecto?</th>
    <th>¿Es nuevo?</th>
    <th>Usuario</th>
    <th>Fecha</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($tiposoli as $tiposol):?>
    <tr>
            <td><?php echo htmlspecialchars($tiposol->VC_NOMBRE,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo ($tiposol->REQUIERE_ID_PROY==0) ? 'No':'Sí'?></td>
            <td><?php echo ($tiposol->ES_NUEVO==0) ? 'No':'Sí'?></td>
            <td><?php echo htmlspecialchars($tiposol->USU_CREA,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo $tiposol->FCH_CREA;?></td>
            <td><?php echo anchor("tipo_solicitud/modi/".$tiposol->ID, 'Modificar','class="btn btn-primary"') ;?> | <?php echo anchor("tipo_solicitud/eli/".$tiposol->ID, 'Eliminar','class="btn btn-primary"') ;?></td>    
   </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<?php $this->load->view('auth/pie'); ?>