$( document ).ready(function() {

    if ($("#catalogo_o_topografica").length) {
    	var replacable = $("#take_menu").html();
    	var cat = $("#catalogo_o_topografica").val();
    	var id_objeto = $("#object_id").val();
    	if ($("#direccion_busqueda_objeto").length) {
    		var direccion = $("#direccion_busqueda_objeto").val();
    		replacable = replacable.replace(/(search_address)/g, direccion);
    	}
    	else 
    		replacable = replacable.replace(/(search_address)/g, '#');	
    	var cat = $("#catalogo_o_topografica").val();
    	
    	replacable = replacable.replace(/(catalogo_o_topografica)/g, cat);

    	replacable = replacable.replace(/(replace_id)/g, id_objeto);
    	
    	$("#item_menu_add").html(replacable);
    }
    if ($("#enografia_link").length) {
    	
    }
});

