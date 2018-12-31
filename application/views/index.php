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
    <title>Sistema de Solicitudes Web</title>
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
            <div class="main-logos">
            <img class="sc-logo" src="<?php echo base_url()?>images/sc-w.png" >
            <img src="<?php echo base_url()?>images/logo-adc-b.png" >
            </div>
            <!--<h1>Agenda Digital de la Secretaría de Cultura</h1>-->
            <h1>  Sistema ipstori</h1>
        </header>
        <footer> <a href="<?php echo base_url()?>auth/registro" class="button scrolly">Regístrate</a> 
            <a href="<?php echo base_url()?>auth/login" class="button scrolly">Inicia sesión</a> </footer>
        <a class="godown scroll" name="objetivos" href="#"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
        <div class="opz"><a href="">.</a></div>
    </section>

    
    <!-- Footer -->
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
        $(document).ready(function() {
            //resizeDiv();
            var irA = "<?php echo $seccion; ?>";
            if (irA != "") {
                destino = $("#" + irA);
                if (destino.length > 0) {
                    $('html, body').animate({
                        scrollTop: destino.offset().top
                    }, 500, function() {
                        console.log("termina animacion");
                        $('html, body').clearQueue().finish();
                    });

                }
                console.log("termina if");
            }
            $('a.scroll').click(function(e) {
                e.preventDefault();
                var destino = $(this).attr("name");
                var seccion = destino.replace("#", "");

                if (destino.length == 0) {
                    window.location.href = "<?php echo base_url();?>?seccion=" + seccion;
                } else {
                    $('html, body').stop().animate({
                        scrollTop: $("#" + destino).offset().top
                    }, 500);
                }
            });



        });
window.onresize = function (event) {
						//resizeDiv();
					
					}
        function resizeDiv() {
            vpw = $(window).width();
            vph = $(window).height();
            navBar = $("nav.sub-navbar");
            navBarH = navBar.outerHeight(true);
            finalH = vph;
            $('section#header').css({
                'height': finalH + 'px'
            });
        }
    </script>
</body>

</html>