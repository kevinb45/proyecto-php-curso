<?php
// Se inicia la sesión trayendo los datos de páginas anteriores.
session_start(); 
// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta p
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase Usuarios.
	require_once("clases/usuarios.php");
	$u = new regusuarios(); // Creamos nuevo array.	
	// Comprobamos si existe y si es númerico el id
	if(!isset($_GET["id"]) or !is_numeric($_GET["id"])){
	    die("error 404");
	}
	$datos=$u->getDatosId($_GET["id"]); // Traemos los datos
	// Si el tamaño de los datos es igual a 0 tira error.
	if(sizeof($datos)==0){
	    die("error 404");
	}
	// Si presionamos el boton actualizar, actualizamos
	if(isset($_POST["actualizar"])){	
	// Aquí no hay tantas validaciones porque el usuario solo puede modificar la clave y el tipo de usuario.
	    $u->actualizarDatos();
	    header("Location: listadousuarios.php?m=2"); // Mandamos hacia la página anterior con un mensaje.
	}		
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>..:: Listado de Usuarios ::..</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="listadousuarios.php">Inicio</a></li>
		  <li class="active">Actualizar Usuarios</li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Actualizar Usuarios</h3>
			</div>
			<div class="panel-body">
			<!-- Validamos datos con html. -->
				<form name="form" action="" method="post">
					<p>
					<p>
                        <label for="cedula">Cedula:</label>
                        <?php echo $datos[0]->cedula;?>
                    </p>
					<p>
                        <label for="nombre">Nombre:</label>
                        <?php echo $datos[0]->nombre;?>
                    </p>
                    <p>
                       <label for="apellido">Apellido:</label>
                       <?php echo $datos[0]->apellido;?>
                    </p>
                    <p>
						<label for="nombreusuario">Nombre de Usuario:</label>
                        <?php echo $datos[0]->nombreusuario;?>
                    </p>
						<label for="clave">Clave:</label>
                        <input type="password" name="clave" placeholder="Clave" class="form-control" required="true" maxlength="32" value="<?php echo $datos[0]->clave;?>" />
                    </p>
				
                      <p>
						<!-- El estado lo modificamos con valores escritos -->
                        <label for="tipousuario">Tipo de Usuario:</label>
						<select class="form-control" name="tipousuario" required="true"><option value='#'>Elija el tipo de usuario</option>
							<option value="Administrador">Administrador</option>
							<option value="Recepcion">Recepción</option>
				   
						</select>
                    </p> 
                    </p>
                    <hr />
                    <input type="hidden" name="id" value="<?php echo $datos[0]->cedula;?>" />
                    <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary" onclick="valida();"/>
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