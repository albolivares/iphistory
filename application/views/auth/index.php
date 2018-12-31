<?php $this->load->view('auth/cabeza'); ?>
<div class="page-title">
              <div class="title_left">
                <h3><?php echo lang('index_heading');?></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
<div class="col-md-12 col-sm-12 col-xs-12">
<h1><?php //echo lang('index_heading');?></h1>
<p><?php echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->VC_NOMBRE,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->VC_APELLIDO_PAT,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->VC_CORREO,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->ID, htmlspecialchars($group->NOMBRE,ENT_QUOTES,'UTF-8'),'class="btn btn-link"') ;?><br />
                <?php endforeach?>
			</td>
			
			<?php if($user->VC_ESTATUS==4){ ?>
			  <td>Registrado</td>
			<?php
			}else {
			  ?>
			  <td><?php echo ($user->VC_ESTATUS) ? anchor("auth/deactivate/".$user->ID, lang('index_active_link'),'class="btn btn-link"') : anchor("auth/activate/". $user->ID, lang('index_inactive_link'),'class="btn btn-link"');?></td>
			  <?php
			}
      ?>
			<td><?php echo anchor("auth/edit_user/".$user->ID, 'Modificar','class="btn btn-primary"') ;?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>

<p><?php echo anchor('auth/create_user', lang('index_create_user_link'),'class="btn btn-link"')?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'),'class="btn btn-link"')?></p>
</div>
<?php $this->load->view('auth/pie'); ?>