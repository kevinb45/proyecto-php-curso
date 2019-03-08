
<?php 
    // Se inicia la sesión trayendo los datos de login.php
	session_start(); 
	
	// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
?>	
<!-- Navegador -->
<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand"><img src="img/logo.png" alt=""></a></a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
	<?php 
	// Creo este procedimiento para contar los mensajes no leidos de la página de contactos y mostrarle al usuario.
	require("/php/conexion.php");
		$abc="SELECT * FROM contacto WHERE estado='No Leido'";
		$contar =mysqli_num_rows($conexion->query($abc));							
	?>			
		  <li><a href="#loglist"  data-toggle="tab"><h4>Mensajes (<?php echo $contar; ?>)</h4></a></li> <!-- Después lo muestro aquí -->
	      <li><a href="php/logout.php"><h4>CERRAR SESIÓN</h4></a></li> <!-- Aquí manda al procedimiento de cierre de sesión  -->
    </ul>
  </div>
</nav>
<!-- /Navegador -->
<?php
// Utilizando este procedimiento controlo que la sesión sea de usuario Administrador o Recepción.
// En este caso lo hago para mostrar un texto diferente.
if($_SESSION['perfil'] == "Administrador") 
{
?>
<h3 style="text-align: center;">EXCLUSIVO para ADMINISTRADORES</h3>
<?php
}else{
?>
<h3 style="text-align: center;">EXCLUSIVO para RECEPCIÓN</h3>
<?php
}
	// Traigo los datos más relevantes de la sesión y se lo muestro al usuario.	
	echo "<p style='text-align: center;'>",$_SESSION['nombre']," ", $_SESSION['apellido'],". ";
	echo "Usuario: ".$_SESSION['usuario'],". ";
	echo "Tu perfil es: ".$_SESSION['perfil'],". </p>";
?>

<!DOCTYPE html>

    <html lang="en">

    <head>
	
	<title>Gestor</title>
	
	<!-- Force IE to turn off past version compatibility mode and use current version mode -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	
	<!-- Get the width of the users display-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Text encoded as UTF-8 -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
	<!-- bootstrap -->
	<link href="css/gestor.css" rel="stylesheet">
	<link href="css/gestor2.css" rel="stylesheet">
	<link href="css/bootstrap.min2.css" rel="stylesheet" id="default">
	</head>

		<body class="bootstrap">
				<div class="col-md-12"> 	
					<div class="panel panel-default panel-fade">
						<div class="panel-heading">
							<span class="panel-title">
								<div class="pull-left">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#letters" data-toggle="tab"><i class="glyphicon glyphicon-road"></i> Encomiendas</a></li>
									<?php
									// Utilizando este procedimiento controlo que la sesión sea de usuario Administrador o Recepción.
									// En este caso es para habilitar usuarios solo para Administrador.
									if($_SESSION['perfil'] == "Administrador") 
									{
									?>
									<li><a href="#emails" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
									<?php
									}
									?>
									<li><a href="#loglist" data-toggle="tab"><i class="glyphicon glyphicon-envelope"></i> Contactos</a></li>
								</ul>	
								</div>
								<div class="clearfix"></div>
							</span>
						</div>
						<div class="panel-body">	
							<div class="tab-content">
								 <!-- Utilizando iframe traemos los listados php cada uno en su respectiva sección -->
                                 <div class="tab-pane fade in active" width="100%" id="letters">
								  <iframe width="100%"; height="100%"; frameborder="none"; src="<?php print ("listadoencomiendas.php"); ?>"></iframe> 
								</div>							
								    <div class="tab-pane fade" id="emails">
								<iframe width="100%"; height="100%"; frameborder="none"; src="<?php print ("listadousuarios.php"); ?>"></iframe> 	
								</div>							
							    <div class="tab-pane fade" id="loglist">
								<iframe width="100%"; height="100%"; frameborder="none"; src="<?php print ("listadocontactos.php"); ?>"></iframe> 
								</div>
							</div>
						</div>
					</div>
				</div>
			<footer>
				<!--#INCLUDE VIRTUAL="FooterInclude.asp"--> 
				<script src="js/jquery-1.9.1.js" type="text/javascript" ></script>
				<script src="js/bootstrap.min.js"></script>
				<script src="js/jquery.easytabs.min.js" type="text/javascript"></script>
				<script>
				$('a.btn.btn-default').hover(function(e) {
				$('a.btn.dropdown-toggle').trigger(e.type);
				})
				</script>
				
				<script type="text/javascript">
				$(".display-fade").delay(25).animate({"opacity": "1"}, 800);
				$(".table-fade").delay(25).animate({"opacity": "1"}, 800);
				</script>
				
				<script type="text/javascript">
				var def="black";
				function showNotification(color)
				{
					$( "#notification" ).removeClass(def);
					$( "#notification" ).addClass(color);
					def=color;
					$( "#notification" ).fadeIn( "slow" );
					//alert('hi');
					$(".win8-notif-button").click(function()
					{
					//alert('hi');
					$(".notification").fadeOut("slow");
					});
				}
				</script>
			</footer>
		</body>
	</html>
