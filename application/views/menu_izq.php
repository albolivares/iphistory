<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="<?=base_url()?>" class="site_title"><img src="<?=base_url()?>images/logo-top.png"  alt="logo" /><br/></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
       
    </div>
    <div class="profile_info">
<span>Administrador de Ipstori</span>
      <h2></h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li><a href="<?=base_url();?>"><i class="fa fa-home"></i>Inicio</a></li>
        <?php if($this->ion_auth->is_admin()){ ?>
        <li><a href="<?=base_url()?>auth" >
          <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Usuarios</a>
        </li>
        <?php } ?>
        <li><a href="<?=base_url()?>admin/historia"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Historias</a></li>
        <li><a href="<?=base_url()?>admin/serie"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Series</a></li>
        <li><a href="<?=base_url()?>admin/readlist"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Readlist</a></li>

<!--         <li><a><i class="fa fa-edit"></i> Proyectos <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">    
          				<?php if($this->session->userdata('perm')==3 || $this->ion_auth->is_admin()) { ?>        
						<li><a href="<?=base_url()?>solicitudes/">Solicitudes</a></li>
						<li><a href="<?=base_url()?>servidor">Servidores</a></li>
         <?php } ?>
            <?php if($this->session->userdata('perm')==2 || $this->ion_auth->is_admin()) { ?>
            <li><a href="<?=base_url()?>solicitudes/lista_aprobar/">Finalizados</a></li>
            <?php } ?>
            <?php  if($this->session->userdata('enline')=='aolivares@cultura.gob.mx' || $this->ion_auth->is_admin() ) {  ?><li><a href="<?=base_url()?>plataforma/">Plataformas</a></li><?php } ?>

          </ul>
        </li>
 -->
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=base_url()?>/auth/logout/">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>