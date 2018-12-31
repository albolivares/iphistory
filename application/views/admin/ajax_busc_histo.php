<table class="table table-striped">
		<thead>
		    <tr>
		      <th scope="col">Id</th>
		      <th scope="col">Historia</th>
		      <th scope="col">Seleccionar</th>
		    </tr>
		  </thead>
			<tbody >
			<div id="postList">	
<?php $contador=1; if(!empty($posts)): foreach($posts as $post): ?>
    <tr class="list-item">
                	<th scope="row"><?php echo $post['id_hist']; ?></th>
                	<th><?php echo $post['titulo_hist']; ?><input name="titulo_busc" id="thist_<?php echo $post['id_hist']; ?>" value="<?php echo $post['titulo_hist']; ?>"  type="hidden"></th>
                	<th><input name="hist_list" id="hist_<?php echo $post['id_hist']; ?>" value="<?php echo $post['id_hist']; ?>"  type="checkbox"></th>
                </tr>
<?php $contador=$contador+1; endforeach; else: ?>
<tr><th colspan="3">No hay historías que coincidan.</th></tr>
<?php endif; ?>
  </div>
            </tbody>
            </table>

<?php echo $this->ajax_pagination->create_links(); ?>