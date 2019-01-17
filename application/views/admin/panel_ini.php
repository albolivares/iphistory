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
            <a href="<?=base_url().'admin/historia/nueva' ?>" class="btn btn-default">+ Agregar nueva</a><br/><br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Título</th>
                          <th>Autor</th>
                          <th>Categoría</th>
                          <th>Fecha de captura</th>
                          <th>Fecha de publicación</th>
                          <th>Vigencia</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if($rsHistorias){
                        foreach ($rsHistorias as $index => $value) { ?>
                          <tr>
                          
                            <td><?=$value->titulo_hist?></td>
                            <td><?=$value->nombre_register.' '.$value->ap_paterno_register.' ('.$value->pseudonimo_register.')'?></td>
                            <td></td>
                            <td><?=$value->fecha_captura_hist?></td>
                            <td><?=$value->fecha_publicacion_hist?></td>
                            <td><?=$value->fecha_fin_hist?></td>
                             <td>
                              
                              <a href="<?= base_url() . 'admin/historia/editar/' . $value->id_hist; ?>">
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
