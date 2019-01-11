$( function() {

$("#fecha_inicio_hist").datepicker({ 
//    minDate: new Date(),
    singleDatePicker: true,
    showDropdowns: true,
    changeMonth: true,
    changeYear: true,
    yearRange: "2019:2021",
    dateFormat: "yy-mm-dd",
    minDate: 0,
    maxDate: '+24m',
    onSelect: function(date){
        var selectedDate = new Date(date);
        var msecsInADay = 86400000;
        var endDate = new Date(selectedDate.getTime() + msecsInADay);
       //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
        $("#fecha_fin_hist").val('');
        $("#fecha_fin_hist").datepicker( "option", "minDate", endDate );
        $("#fecha_fin_hist").datepicker( "option", "maxDate", '+24m' );

    }
});

    $( "#fecha_inicio_hist" ).datepicker({

    singleDatePicker: true,

    showDropdowns: true,

    changeMonth: true,

    changeYear: true,

    yearRange: "2019:2021",

    dateFormat: "yy-mm-dd",

    minDate: 0,

    maxDate: '+9m',

    

    });


    $( "#fecha_fin_hist" ).datepicker({

    singleDatePicker: true,

    showDropdowns: true,

    changeMonth: true,

    changeYear: true,

    yearRange: "2019:2021",

    dateFormat: "yy-mm-dd",

    minDate: 0,

    //maxDate: '+2m',

    });

  } );




$('#categoria').multiSelect();
$('#seccion').multiSelect();



/*autocomplete*/
$(document).ready(function(){
    //utilizamos el evento keyup para coger la información
    //cada vez que se pulsa alguna tecla con el foco en el buscador
    $(".autocompletar").keyup(function(){
                    
        //en info tenemos lo que vamos escribiendo en el buscador
        var info = $(this).val();
            var base_url1 = $('#base_url').val();
        //hacemos la petición al método autocompletar del controlador autocompletado
        //pasando la variable info
        $.post(base_url1+'admin/autocompletado/autocompletar',{ info : info }, function(data){
                        
            //si autocompletado nos devuelve algo
            if(data != '')
            {
    
                //en el div con clase contenedor mostramos la info
                $(".contenedor").html(data);
                                
            }else{
                                
                $(".contenedor").html('');
                                
            }
        })
                    
    })
                

    //buscamos el elemento pulsado con live y mostramos un alert
    /*$(".contenedor").find("a").live('click',function(e){
        e.preventDefault();
        alert($(this).html());
    });*/
            
})