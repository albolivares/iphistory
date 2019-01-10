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
            <a href="<?=base_url().'admin/autor/nuevo' ?>" class="btn btn-default">+ Agregar nuevo</a><br/><br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                          <th>Autor</th>
                          <th>Estado</th>
                          <th>Estatus</th>
                          <th>Fecha</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                        if($rsAutores){
                        foreach ($rsAutores as $index => $value) { ?>
                          <tr>
                            <td><?=$value->nombre_register.' '.$value->ap_paterno_register?></td>
                            <td><?=$value->entidad?></td>
                            <td><?=($value->estatus_register==0)? 'Inactivo':'Activo'; ?></td>
                            <td><?=$value->fecha_alta?></td>
                             <td>
                              
                              <a href="<?= base_url() . 'admin/autor/editar/' . $value->id_register; ?>">
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
