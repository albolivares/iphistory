$(document).ready(function(){  


  
$( "input[name=tipo]" ).on( "click", function() {
  var tipo_obj=$( "input:checked" ).val();
  if(tipo_obj==0) { $("#conDura").show(); $("#contNumH").hide(); }
  else if(tipo_obj==1) { $("#conDura").hide(); $("#contNumH").show(); }
});


   $(function () {
        $('.verifica_resp').on("click", function (e) {
            var link = this;

            e.preventDefault();

            $('.unique').dialog({
                buttons: {
                    "Ok": function () {
                        //window.open($(link).attr("href"));
                        var goUrl=$(link).attr("href");
                        window.location = goUrl;
                    },
                    "Cancelar": function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    });


});


   $(function () {
        $('.verifica_resp').on("click", function (e) {
            var link = this;

            e.preventDefault();

            $('.unique').dialog({
                buttons: {
                    "Ok": function () {
                        //window.open($(link).attr("href"));
                        var goUrl=$(link).attr("href");
                        window.location = goUrl;
                    },
                    "Cancelar": function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    });