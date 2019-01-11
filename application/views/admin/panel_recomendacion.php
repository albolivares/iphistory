<!-- page content -->
<div class="right_col" role="main">
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Lista<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
              <!--<li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>-->
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <a href="<?=base_url().'admin/recomendacion/nueva' ?>" class="btn btn-default">+ Agregar nueva</a><br/><br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Título</th>
                          <th>Autor</th>
                          <th>Categoría</th>
                          <th>Sección</th>
                          <th>Fecha inicio</th>
                          <th>Fecha fin</th>
                          <th>Estatus</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if($rsRecomienda){/*SELECT id_recom, fecha_registro, fecha_inicio_recom, fecha_fin_recom, estatus_recom, orden, id_hist, usuario_alta, fecha_alta, usuario_modifica, fecha_modifica*/
                        foreach ($rsRecomienda as $index => $value) { ?>
                          <tr>
                            <td><?=$value->id_hist?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?=$value->fecha_inicio_recom?></td>
                            <td><?=$value->fecha_fin_recom?></td>
                            <td><?=$value->estatus_recom?></td>
                             <td>
                              
                              <a href="<?= base_url() . 'admin/recomendacion/editar/' . $value->id_recom; ?>">
                                <button type="button" class="btn btn-round" style="background: #AE1141">
                                  <i class="fa fa-pencil" style="color: #FFFFFF"></i></button></a>

                            </td>
                          </tr>  

                         <?php }
                         } 
                      ?>  
                      </tbody>
                    </table>
           </div>
        </div> 
      </div>
</div><!--.right_col-->    
