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
            <a href="<?=base_url().'admin/suscripcion/nueva' ?>" class="btn btn-default">+ Agregar nueva</a><br/><br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Título</th>
                          <th>Descripción</th>
                          <th>Precio</th>
                          <th>Fecha registro</th>
                          <th>Estatus</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if($rsSuscripcion){
                        foreach ($rsSuscripcion as $index => $value) { ?>
                          <tr>
                            <td><?=$value->titulo_suscripcion?></td>
                            <td><?=$value->descripcion_suscripcion?></td>
                          
                            <td><?=$value->precio_suscripcion?></td>
                            <td><?=$value->fecha_alta?></td>
                            <td><?=($value->estatus_suscripcion==0)? 'Inactiva':'Activa'; ?></td>
                             <td>
                              
                              <a href="<?= base_url() . 'admin/suscripcion/editar/' . $value->id_suscripcion; ?>">
                                <button type="button" class="btn btn-round" style="background: #AE1141">
                                  <i class="fa fa-pencil" style="color: #FFFFFF"></i></button></a>
                              <a class="verifica_resp" href="<?= base_url() . 'admin/suscripcion/eliminar/' . $value->id_suscripcion; ?>">
                                <button type="button" class="btn btn-round" style="background: #AE1141">
                                  <i class="fa fa-close" style="color: #FFFFFF"></i></button></a>


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
<div class="unique">¿Desea eliminar el registro?</div>