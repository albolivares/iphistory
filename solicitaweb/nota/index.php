<!DOCTYPE HTML>
<!--
	Tessellate by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Nota - Solicita tu sitio Web</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link href="../../assets/css/main.css" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
	<!-- Header -->
	<section class="dark">
        <header>
        <?php include("../menu.php"); ?>
     	</header>
	</section>
	<div class="content style3">
		<div class="container">
			<span class="image featured"><img src="http://teek.cultura.gob.mx/solpro/images/pic07.jpg" alt="" /></span>
				<div class="row recomendaciones">
					<div class="12u 12u(narrow)">
						<h3>4 métricas clave para todo sitio web</h3>
						<p>Gravida dis placerat lectus ante vel nunc euismod est turpis sodales. Diam tempor dui lacinia eget ornare varius gravida. Gravida dis placerat lectus ante vel nunc euismod est turpis sodales. Diam tempor dui lacinia accumsan vivamus augue cubilia vivamus nisi eu eget ornare varius gravida euismod.  Gravida dis lorem ipsum dolor placerat magna tempus feugiat.</p>
						<p>Lectus ante vel nunc euismod est turpis sodales. Diam tempor dui lacinia accumsan vivamus augue cubilia vivamus nisi eu eget ornare varius gravida dolore euismod lorem ipsum dolor sit amet consequat. vivamus nisi eu eget ornare varius gravida dolore euismod lorem ipsum dolor sit amet consequat. vivamus nisi eu eget ornare et magna.</p>
               			<h2> FUENTE: <a href="https://www.merca20.com/4-metricas-clave-para-todo-sitio-web/" target="_blank">https://www.merca20.com/4-metricas-clave-para-todo-sitio-web/</a></h2>
               		</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
		<section id="footer">
			<?php include("../pie.php"); ?>
       		<a href="#" id="to_the_top"></a>
		</section>

		<!-- Scripts -->
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/jquery.scrolly.min.js"></script>
			<script src="../../assets/js/skel.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../../assets/js/main.js"></script>
          	<script>
            /*smooth scrolling */
            $(document).ready(function () {
                var irA = "<?php echo $seccion; ?>";
                if (irA != "") {
                    destino = $("#" + irA);
                    $('html, body').animate({
                        scrollTop: destino.offset().top
                    }, 500);
                    return false;
                }
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
                    if ($("#"+destino).length == 0) {
                        window.location.href = "http://teek.cultura.gob.mx/solpro/solicitaweb?seccion=" + seccion;
                    }
                    else {
                        $('html, body').animate({
                            scrollTop: $("#"+destino).offset().top
                        }, 500);
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>