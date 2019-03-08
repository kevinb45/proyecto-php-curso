<?php
// Se inicia la sesión trayendo los datos de páginas anteriores.
session_start(); 
// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.		
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase contactos.
	require_once("clases/contactos.php");
	$c = new contactos();// Creamos nuevo array.
	// Comprobamos si existe y si es númerico el id
	if(!isset($_GET["id"]) or !is_numeric($_GET["id"])){
	    die("error 404");
	}
	$datos=$c->getDatosId($_GET["id"]);// Traemos los datos
	// Si el tamaño de los datos es igual a 0 tira error.
	if(sizeof($datos)==0){
	    die("error 404");
	}
	// Si presionamos el boton actualizar, actualizamos
	if(isset($_POST["actualizar"])){
	    $c->actualizarDatos();
	    header("Location: listadocontactos.php?m=2"); // Mandamos hacia la página anterior con un mensaje.
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>..:: Listado de Contactos ::..</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="listadocontactos.php">Inicio</a></li>
		  <li class="active">Ver Contactos</li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Ver Contactos</h3>
			</div>
			<div class="panel-body">
			<!-- En este caso mostramos los datos y solo modificamos el estado. -->
				<form name="form" action="" method="post" >
					<p>
                        <label for="nombre">Nombre:</label>
						<br>
                        <?php echo $datos[0]->nombre;?>
                    </p>
                    <p>
                       <label for="email">E-mail:</label>
					   <br>
                       <?php echo $datos[0]->email;?>
                    </p>
                    <p>
						<label for="asunto">Asunto:</label>
						<br>
                        <?php echo $datos[0]->asunto;?>
                    </p>
						<label for="telefono">Telefono:</label>
						<br>
                        <?php echo $datos[0]->telefono;?>
                    </p>
					</p>
						<label for="mensaje">Mensaje:</label>
						<br>
                        <?php echo $datos[0]->mensaje;?>
                    </p>
					</p>
						<label for="fechahora">Fecha y Hora:</label>
						<br>
                       <?php echo $datos[0]->fechahora;?>
                    </p>
					 <p>
					 <!-- El estado lo modificamos con valores escritos -->
                        <label for="estado">Estado:</label>
                        <select class="form-control" name="estado">
							<option value='elija'>Elija el estado</option>
							<option value="No Leido">No Leido</option>
							<option value="Leido">Leido</option>
						</select>
					
				   </p>
                    <hr/>
                    <input type="hidden" name="id" value="<?php echo $datos[0]->idcontacto;?>" />
                    <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary" />
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/funciones.js"></script>
	<script src="js/modernizr-custom.js"></script>
        <!-- polyfiller file to detect and load polyfills -->
    <script src="js/polyfiller.js"></script>
	<script>
          webshims.setOptions('waitReady', false);
          webshims.setOptions('forms-ext', {types: 'date'});
          webshims.polyfill('forms forms-ext');
     </script>
</body>
</html>