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
  <p><?php echo anchor('servidor/nuevo', 'Nuevo','class="btn btn-primary btn-sm"')?>  </p>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
    <th>IP</th>
    <th>Dominio</th>
    <th>Memoria RAM</th>
    <!--<th>Descripción</th>-->
    <th>Capacidad DD</th>
    <th>Sistema Operativo</th>
    <th>Servidor Web</th>
    <th>Motor BD</th>
    <th>Versión PHP</th>
    <th>Estatus</th>
    <th>Acciones</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($rsServidor as $servidor):
    
    /*switch ($tiporel->FASE) {
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
    }*/
    
    ?>
    <tr>
            <td><?php echo $servidor->IP;?></td>
            <td><?php echo $servidor->DOMINIO;?></td>            
            <td><?php echo $servidor->MEMORIA_RAM?></td>            
            <td><?php echo $servidor->DISCO_DURO?></td>
            <td><?php echo $servidor->SISTEMA_OPERATIVO;?></td>
            <td><?php echo $servidor->SERVIDOR_WEB;?></td>
            <td><?php echo $servidor->MOTOR_BD;?></td>
            <td><?php echo $servidor->VERSION_PHP;?></td>
            <td><?php echo $servidor->ESTATUS;?></td>
            <td><?php echo anchor("servidor/editar/".$servidor->ID, 'Modificar','class="btn btn-primary"') ;?> | <?php echo anchor("servidor/eli/".$servidor->ID, 'Eliminar','class="btn btn-primary"') ;?></td>    
   </tr>
  <?php endforeach;?>
  </tbody>
</table>
</div>
<?php $this->load->view('auth/pie'); ?>