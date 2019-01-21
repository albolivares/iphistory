<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscador</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Font Awesome -->

    <link href="<?php echo base_url() ?>build/css/custom.min.css" rel="stylesheet">


  </head>
<body style="background-color: #fff; border:1px solid #ccc;padding: 20px;">
<div class="container" style="width: 100%; background-color: #fff; border:1px solid #ccc; padding: 20px;">
    
    <div class="row">
    	<div class="col-md-9 col-xs-12 ">
          <div class="form-group post-search-panel">
              <input type="text" class="form-control" id="keywords" placeholder="Escriba el nombre/pseudonimo" onkeyup="searchFilter()"/>
          </div>
      </div>

        
<div class="col-md-3 col-xs-12">
          <div class="form-group post-search-panel">
            <select id="sortBy" class="form-control" onchange="searchFilter()">
                <option value="">Ordenar</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </select>
        </div>
    </div>
        <div class="post-list" id="postList" >
        <form>
		<table class="table table-striped">
		<thead>
		    <tr>
		      <th scope="col">Id</th>
              <th scope="col">Nombre</th>
              <th scope="col">Seleccionar</th>
		    </tr>
		  </thead>
			<tbody >
			<div id="postList">	
            <?php $contador=1; if(!empty($posts)): foreach($posts as $post): ?>
                <tr class="list-item">
                    <th scope="row"><?php echo $post['id_register']; ?></th>
                    <th><?php echo $post['nombre_register'].' '.$post['ap_paterno_register']; if($post['pseudonimo_register']!='') echo ' ('.$post['pseudonimo_register'].')'; ?><input name="titulo_busc" id="thist_<?php echo $post['id_register']; ?>" value="<?php echo $post['nombre_register'].' '.$post['ap_paterno_register']; if($post['pseudonimo_register']!='') echo ' ('.$post['pseudonimo_register'].')'; ?>"  type="hidden"></th>
                    <th><input name="hist_list" id="hist_<?php echo $post['id_register']; ?>" value="<?php echo $post['id_register']; ?>"  type="radio"></th>
                </tr>
            <?php $contador=$contador+1; endforeach; else: ?>
            <tr><th colspan="3">No hay resultados para la busqueda</th></tr>
            <?php endif; ?>
        </div>
            </tbody>
            </table>
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
   
</form>    

            <?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        <div class="loading" style="display: none;"><div class="content" style=" width: 20px; height: 20px" ><img style=" width: 20px; height: 20px" src="<?php echo base_url().'assets/img/load.gif'; ?>"/></div>
        </div>
    </div>
</div>


	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 -->	<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
   
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/buscar/ajaxPaginationDataAut/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            //alert(html);
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>
</body>