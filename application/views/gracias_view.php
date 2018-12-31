<?php 
    !empty($_GET["seccion"])? $seccion = $_GET["seccion"] : $seccion = "";

?>
    <!DOCTYPE HTML>
    <!--
  Tessellate by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
    <html>

    <head>
        <title>Solicita tu sitio Web</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    </head>

    <body>
       <!-- Header -->
        <section id="header" class="dark">
            <header>
                <?php $this->load->view("menu.php"); ?>
            </header>
            
        </section>
        <!-- First -->
        <section id="objetivos" class="main">
       
            <div class="content dark style1 featured">
                <div class="container">
                    <h1>Su mensaje se ha enviado, en unos momentos sera contactado.</h1>                   
                    
                </div>
            </div>
        </section>


        <section id="footer">
            <?php include("pie.php"); ?>
                <a href="#" id="to_the_top"></a>
        </section>
        <!-- Scripts -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.scrolly.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/skel.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="<?php echo base_url();?>assets/js/main.js"></script>
        <script>
            /*smooth scrolling */
            $(document).ready(function () {
                var irA = "<?php echo $seccion; ?>";
                if (irA != "") {
                    destino = $("#" + irA);
                    if (destino.length > 0) {
                        $('html, body').animate({
                            scrollTop: destino.offset().top
                        }, 500, function () {
                            console.log("termina animacion");
                            $('html, body').clearQueue().finish();
                        });
                        //return false;
                         //console.log("hola");
                    }
                    console.log("termina if");
                }
                console.log("adios");
                $('a.scroll').click(function (e) {
                    e.preventDefault();
                    //var destino = $(this.hash);
                    var destino = $(this).attr("name");
                    console.log(destino);
                    var seccion = destino.replace("#", "");
                    /*if (destino.length == 0) {
                      destino = $('a[name="' + this.hash.substr(1) + '"]');
                    }
                    if (destino.length == 0) {
                      destino = $('html');
                    }*/
                    if (destino.length == 0) {
                        window.location.href = "<?php echo base_url();?>?seccion=" + seccion;
                    }
                    else {
                        $('html, body').stop().animate({
                            scrollTop: $("#" + destino).offset().top
                        }, 500, function () {
                        });
                        return false;
                    }
                });
            });
        </script>
    </body>

    </html>