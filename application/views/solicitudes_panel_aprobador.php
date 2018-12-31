<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo base_url();

//print_r($log_gral);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registro de solicitudes</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url()?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url()?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php include("menu_izq.php"); ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <?php include("menu_top.php"); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        
        
        
        
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Control de solicitudes<small>Registradas</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Todo proyecto aprobado debe tener un número de oficio relacioanado con la solicitud y el documento del oficio anexado.
                    </p>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Nombre de proyecto</th>
                          <th>Oficio</th>
                          <th>Fecha registro</th>
                          <th>Estatus</th>
                          <th>Tipo</th>
                          <th>Usuario solicita</th>
                          <th>Unidad Administrativa</th>
                          <th>Avance</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
											if(isset($lista_sol) && $lista_sol!='')
											{
												foreach($lista_sol as $fila_sol)
												{
													if($fila_sol->ESTATUS_PROY==11) $avance=$fila_sol->AVANCE_DES; 
												  elseif($fila_sol->ESTATUS_PROY==7) $avance=100;
													else $avance=$fila_sol->PORC_AVANCE_DOC;
													if($avance>0) $avance=$avance.'%'; else $avance='';

											?>
												<tr>
                          <td><a href="<?=base_url()?>solicitudes/editar/m/<?=(int)$fila_sol->ID;?>" ><?=$fila_sol->NOMBRE;?></a></td>
                          <td><?=$fila_sol->OFICIO_NOM;?></td>
                          <td><?=$fila_sol->FCH_ALTA;?></td>
                          <td><?=$fila_sol->ESTATUS;?></td>
                          <td><?=$fila_sol->TIPO_SOL;?></td>
                          <td><?=$fila_sol->VC_CORREO;?></td>
                          <td><?=$fila_sol->UNIDAD;?></td>
                          <td><?=$avance;?></td>
                        </tr>
                          
												<?php

												}/*cierre de foreach*/
											}/*cierre de if*/
											
											?>
                        
                        <!--<tr>
                          <td>Garrett</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                          <td>P</td>
                          <td>g.winters@datatables.net</td>
                        </tr>-->
                        
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
        
         <?php if(isset($lista_camb) && $lista_camb!='') { ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de cambios</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Cambios registrados sobre los proyectos finalizados.
                    </p>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
													<th>Título</th>
                          <th>Tipo</th>
                          <th>Estatus</th>
                          <th>Usuario solicita</th>
                          <th>Fecha registro</th>
													<th>Proyecto</th>

                        </tr>
                      </thead>
                      <tbody>
                      <?php 

											if(isset($lista_camb) && $lista_camb!='')
											{
												foreach($lista_camb as $fila_camb)
												{
													/*C.ID_SOLICITUD, S.NOMBRE, C.TIPO_SOLICITUD, TS.VC_NOMBRE TIPO, C.TITULO, C.DESCRIPCION, C.FCH_CREA_USU,U.VC_CORREO, C.ESTATUS, F.VC_NOMBRE FASE*/
											?>
												<tr>
													<td><a href="<?=base_url()?>solicitudes/editar_c/<?=(int)$fila_camb->ID;?>" ><?=$fila_camb->TITULO;?></a></td>
													<td><?=$fila_camb->TIPO;?></td>
                          <td><?=$fila_camb->FASE;?></td>
                          <td><?=$fila_camb->VC_CORREO;?></td>
                          <td><?=$fila_camb->FCH_CREA_USU;?></td>
                          <td><?=$fila_camb->NOMBRE;?></td>
                          
                        </tr>
                          
												<?php

												}/*cierre de foreach*/
											}/*cierre de if*/
											
											?>
                        
                        
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
        <?php } ?>
        
        
        </div><!--.right_col-->
        
        
        <!-- /page content -->

        <!-- footer content -->
        <?php include("footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?=base_url()?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?=base_url()?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url()?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>vendors/iCheck/icheck.min.js"></script>
    <!-- Parsley -->
    <script src="<?=base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Skycons -->
    <script src="<?=base_url()?>vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?=base_url()?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?=base_url()?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?=base_url()?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?=base_url()?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?=base_url()?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>build/js/custom.min.js"></script>
	
  </body>
</html>
