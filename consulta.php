<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<title>Transportation - Consultar ENVIOS</title><!-- Web Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'><!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet"><!-- Flaticon CSS -->
	<link href="fonts/flaticon/flaticon.css" rel="stylesheet"><!-- font-awesome CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet"><!-- Offcanvas CSS -->
	<link href="css/hippo-off-canvas.css" rel="stylesheet"><!-- animate CSS -->
	<link href="css/animate.css" rel="stylesheet"><!-- language CSS -->
	<link href="css/language-select.css" rel="stylesheet"><!-- owl.carousel CSS -->
	<link href="owl.carousel/assets/owl.carousel.css" rel="stylesheet"><!-- magnific-popup -->
	<link href="css/magnific-popup.css" rel="stylesheet"><!-- Main menu -->
	<link href="css/menu.css" rel="stylesheet"><!-- Template Common Styles -->
	<link href="css/template.css" rel="stylesheet"><!-- Custom CSS -->
	<link href="css/style.css" rel="stylesheet"><!-- Responsive CSS -->
	<link href="css/responsive.css" rel="stylesheet">
	<script src="js/vendor/modernizr-2.8.1.min.js">
	</script><!-- HTML5 Shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
            <script src="js/vendor/html5shim.js"></script>
            <script src="js/vendor/respond.min.js"></script>
        <![endif]-->
</head>
<body id="page-top">
	<div class="st-container" id="st-container">
		<div class="st-pusher">
			<div class="st-content">
				<header class="header">
					<nav class="top-bar">
						<div class="overlay-bg">
							<div class="container">
								<div class="row">
									<div class="col-sm-6 col-xs-12">
										<div class="call-to-action">
											<ul class="list-inline">
												<li>
													<a href="#"><i class="fa fa-phone"></i> 099249698</a>
												</li>
												<li>
													<a href="#"><i class="fa fa-envelope"></i> kevinb45@gmail.com</a>
												</li>
											</ul>
										</div><!-- /.call-to-action -->
									</div><!-- /.col-sm-6 -->
								</div><!-- /.row -->
							</div><!-- /.container -->
						</div><!-- /.overlay-bg -->
					</nav><!-- /.top-bar -->
					
					<nav class="navbar navbar-default" role="navigation">
						<div class="container mainnav">
							<div class="navbar-header">
								<h1 class="logo"><a class="navbar-brand" href="index.html"><img alt="" src="img/logo.png"></a></h1><!-- offcanvas-trigger -->
								 <button class="navbar-toggle collapsed pull-right hidden-md hidden-lg" type="button"><span class="sr-only">Navegación</span> <i class="fa fa-bars"></i></button>
							</div><!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-collapse">
								<ul class="nav navbar-nav navbar-right hidden-sm">
									<!-- Inicio -->
									<li>
										<a href="index.html">Inicio</a>
									</li><!-- /Inicio -->
									<!-- Empresa -->
									<li class="dropdown">
										<a href="#">Empresa <span class="fa fa-angle-down"></span></a> <!-- submenu-wrapper -->
										<div class="submenu-wrapper">
											<div class="submenu-inner">
												<ul class="dropdown-menu">
													<li>
														<a href="about.html">Sobre nosotros</a>
													</li>
													<li>
														<a href="our-people.html">Nuestra Gente</a>
													</li>
												</ul>
											</div>
										</div><!-- /submenu-wrapper -->
									</li><!-- /Empresa -->
									<!-- Servicioss -->
									<li class="dropdown">
										<a href="service.html">Servicios</a>
									</li><!-- /Contacto -->
									<li>
										<a href="contact.html">Contacto</a>
									</li>
									<li style="padding-left: 2px !important; padding-right: 4px !important;">
										<a href="index.php" style="color:#fff;background-color:#428bca;border-color:#357ebd;">Iniciar sesión</a>
									</li>
									<li>
										<a href="consulta.php" style="color:#3f3f3f;background-color:#eaeaea;">Ingresar como Cliente</a>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container -->
					</nav>
				</header>
    
	<!-- BUSCADOR de envios -->
	<!-- En este caso uso php en la misma página y que se resuelva todo aquí mismo. -->
				<section>
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-wrap">
								<br>
								<h3 style='text-align: center;'>ENVIOS</h3>						
								<form action="<?php echo $_SERVER['PHP_SELF'] ?>" style='text-align: center;' method="POST">
									<input type="text" name="ingreso" placeholder ="Número de envío"/>
									<input type="submit" value="Buscar" name="search"/>
								</form>
								<br>
<?php
// Traigo el archivo conexión para realizar la consulta.
require_once("php/conexion.php");
// Creamos una variable para que se vean los caracteres bien en la consulta.
$acentos = $conexion->query("SET NAMES 'utf8'");
// Cuando se presiona el boton search se genera el procedimiento.
if(isset($_POST['search'])){
	
	// Declaro una variable para almacenar el valor ingresado en la caja de texto
	$b = $_POST['ingreso'];
	
	// Guardo en una variable la consulta SQL para realizar la busqueda.
	// No utilizo LIKE para en este caso porque el número de envío tiene que ser exacto.
	// Se conecta en la consulta a las 3 tablas, origen, destino y estado que se encuentran foraneas dentro de encomiendas.
	$sql = "select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado
			and e.id = '$b'";
	$resultado = $conexion->query($sql);
	
	// Almacenamos en una variable la cantidad de filas de registros 
	// que se encuentra en la consulta de SQL
	$numfilas = mysqli_num_rows($resultado);
	
	// Si se encuentrar registros para la consulta los mostramos
	if($numfilas>0){
		while ($encontrado = $resultado -> fetch_assoc()){ //fetch_assoc o tambien fetch_array
			echo "<p style='text-align: center;'>Nombre del destinatario: ".$encontrado['nombredest'].
			"</p><p style='text-align: center;'>Nombre del despachante: ".$encontrado['nombredesp'].
			"</p><p style='text-align: center;'>Origen: ".$encontrado['origen'].
			"</p><p style='text-align: center;'>Destino: ".$encontrado['destino'].
			"</p><p style='text-align: center;'>Fecha: ".$encontrado['fecha'].
			"</p><p style='text-align: center;'>Hora: ".$encontrado['hora'].
			"</p><p style='text-align: center;'>Estado: ".$encontrado['estado']."</p><br>";
		}
	}else{
		echo "<p style='text-align: center;'> No se encontraron registros para la busqueda.</p>";
	}
	
}	
?>

								</div>
							</div> <!-- /.col-xs-12 -->
						</div> <!-- /.row -->
					</div> <!-- /.container -->
				</section>
				<!-- /BUSCADOR de envios -->
   <section class="footer-widget-section section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-md-offset-1 col-sm-4">
					<div class="footer-widget">
						<h3>Lugar y Contacto</h3>
						<address>
							384 Maple Circle<br>
							Simi Valley, Nevada 47424<br>
							<!-- Google Map Modal Trigger -->
							 <button class="modal-map" data-target="#cssMapModal" data-toggle="modal" type="button">Mapa</button> <span class="tel">(598) 99-249-698</span>
						</address><!-- Modal -->
						<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="cssMapModal" role="dialog" tabindex="-1">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Nuestra Ubicación</h4>
									</div>
									<div class="modal-body">
										<div id="googleMap"></div>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- End Modal -->
					</div><!-- /.footer-widget -->
				</div><!-- /.col-md-4 -->
				<div class="col-md-3 col-sm-4">
					<div class="footer-widget">
						<h3>Sobre el transporte</h3>
						<ul>
							<li>
								<a href="about.html">Acerca de</a>
							</li>
							<li>
								<a href="service.html">Servicios</a>
							</li>
							<li>
								<a href="our-people.html">Nuestra gente</a>
							</li>
						</ul>
					</div><!-- /.footer-widget -->
				</div><!-- /.col-md-4 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.cta-section -->
	<!-- footer-widget-section end -->
	<!-- copyright-section start -->
	<footer class="copyright-section">
		<div class="container text-center">
			<div class="copyright-info">
				<span>Copyright © 2018 Kevin Grassi. Todos los derechos reservados. Diseñado por <a href="http://kgdesign3d.com">Kgdesign3d</a><br>
				Proudly powered by <a href="http://www.w3schools.com/html/html5_intro.asp">HTML5</a> and <a href="getbootstrap.com">Bootstrap3</a></span>
			</div>
		</div><!-- /.container -->
	</footer><!-- copyright-section end -->
	<!-- .st-content -->
	<!-- .st-pusher -->
	<!-- OFF CANVAS MENU -->
	<div class="offcanvas-menu offcanvas-effect hidden-md hidden-lg">
		<div class="offcanvas-wrap">
			<div class="off-canvas-header">
				<button aria-hidden="true" class="close" data-toggle="offcanvas" id="off-canvas-close-btn" type="button">&times;</button>
			</div>
			<ul class="list-unstyled visible-xs visible-sm" id="offcanvasMenu">
				<li class="active">
					<a href="index.html">Inicio<span class="sr-only">(current)</span></a>
				</li>
				<li>
					<a href="#">Empresa</a>
					<ul>
						<li>
							<a href="about.html">Sobre nosotros</a>
						</li>
						<li>
							<a href="our-people.html">Nuestra gente</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="service.html">Servicios</a>
				</li>
				<li>
					<a href="contact.html">Contacto</a>
				</li>
				<li>
					<a class="btn btn-primary animated lightSpeedIn" href="#">Iniciar Sesión</a>
				</li>
				<li>
					<a class="btn btn-primary animated lightSpeedIn" href="#" style="color:#3f3f3f;background-color:#eaeaea;">Ingresar como Cliente</a>
				</li>
			</ul
		</div>
	</div><!-- .offcanvas-menu -->
	<!-- /st-container -->
	<!-- Preloader -->
	<div id="preloader">
		<div id="status">
			<div class="status-mes"></div>
		</div>
	</div><!-- jQuery -->
	<script src="js/jquery.js">
	</script> <!-- Bootstrap Core JavaScript -->
	 
	<script src="js/bootstrap.min.js">
	</script> <!-- owl.carousel -->
	 
	<script src="owl.carousel/owl.carousel.min.js">
	</script> <!-- Magnific-popup -->
	 
	<script src="js/jquery.magnific-popup.min.js">
	</script> <!-- Offcanvas Menu -->
	 
	<script src="js/hippo-offcanvas.js">
	</script> <!-- inview -->
	 
	<script src="js/jquery.inview.min.js">
	</script> <!-- stellar -->
	 
	<script src="js/jquery.stellar.js">
	</script> <!-- countTo -->
	 
	<script src="js/jquery.countTo.js">
	</script> <!-- classie -->
	 
	<script src="js/classie.js">
	</script> <!-- selectFx -->
	 
	<script src="js/selectFx.js">
	</script> <!-- sticky kit -->
	 
	<script src="js/jquery.sticky-kit.min.js">
	</script> <!-- GOGLE MAP -->
	 
	<script src="https://maps.googleapis.com/maps/api/js">
	</script> <!--TWITTER FETCHER-->
	 
	<script src="js/twitterFetcher_min.js">
	</script> <!-- Custom Script -->
	 
	<script src="js/scripts.js">
	</script>
</body>
</html>