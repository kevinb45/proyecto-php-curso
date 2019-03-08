<?php
// Se inicia la sesión trayendo los datos de páginas anteriores.
session_start(); 
// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.	
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase usuarios.
	require_once("clases/usuarios.php");
	// En este caso para generar el procedimiento debemos apretar el boton guardar.
	if(isset($_POST["guardar"])){
		include_once('php/conexion.php'); 
		// Configurar las dos lineas siguientes 
		$cedula = $_POST["cedula"]; 
		$nombreusuario = $_POST["nombreusuario"]; 
		$nombre = $_POST["nombre"]; 
		$apellido = $_POST["apellido"]; 
		
		// Inicio de validacion de repetición cedula y usuario
		// Dato importante: Si no funcionara la validación en la base de datos 
		// la cedula al hacer id no se repetite y el usuario tampoco se puede repetir(UNIQUE).
		// Comprobamos si la cedula esta registrado 

		$nuevo_ced = $conexion->query("select cedula from usuarios where cedula='$cedula'"); 
		if(mysqli_num_rows($nuevo_ced)>0) 
			{ 
			echo "<script>alert('La cedula ya esta registrado')</script>"; 
		} // ------------ Si no esta registrado el usuario continua el script 
		else 
		{  
		// Comprobamos si el nombre de usuario esta registrado 
			$nuevo_nombre = $conexion->query("select nombreusuario from usuarios where nombreusuario='$nombreusuario'"); 
			if(mysqli_num_rows($nuevo_nombre)>0) 
			{ 
			echo "<script>alert('El usuario ya esta registrada')</script>"; 
		} 
		  
		// Comprobamos si el nombre de usuario y apellido estan registrados
			$nuevo_nombreap = $conexion->query("select nombre, apellido from usuarios where nombre='$nombre' and apellido='$apellido'"); 
			if(mysqli_num_rows($nuevo_nombreap)>0) 
			{ 
			echo "<script>alert('El nombre y apellido ya esta registrado')</script>"; 
		} 
		// Fin de la validacion

		else{ 	
			$u = new regusuarios(); // Creamos nuevo array.
			$u->insertarDatos(); // Llamamos la función insertarDatos y enviamos las datos para insertar nuevo usuario.
	    header("Location: listadousuarios.php?m=1"); // Mandamos hacia la página anterior con un mensaje.
		}
	}
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
		  <li><a href="listadousuarios.php">Listado Usuarios</a></li>
		  <li class="active">Agregar Usuario</li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Agregar Usuarios</h3>
			</div>
			<div class="panel-body">
				<form name="form" action="" method="post">
				<!-- Validamos datos con html. -->
					<p>
                        <label for="cedula">Cedula:</label>
                        <input type="number" id="ced" id="cedula" name="cedula" max= "99999999" min="700000" maxlength="8" placeholder="Cedula" autofocus="true" class="form-control" required="true" />
                    </p>
				
					<p>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" placeholder="Nombre" class="form-control" required="true" maxlength="25" />
                    </p>
                    <p>
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" placeholder="Apellido" class="form-control" required="true" maxlength="25" />
                    </p>
                    <p>
						<label for="nombreusuario">Nombre de Usuario:</label>
                        <input type="text" name="nombreusuario" placeholder="Nombre de Usuario" class="form-control" required="true" maxlength="25" />
					</p>
                    <p>
                        <label for="clave">Clave:</label>
                        <input type="password" name="clave" placeholder="Clave" class="form-control" required="true" maxlength="32" />
                    </p>
					 <p>
					 <!-- En este caso creamos las dos opciones en vez de crear una tabla y los metemos en un select para seleccionar. -->
                        <label for="tipousuario">Tipo de Usuario:</label>
						<select class="form-control" name="tipousuario" required="true"><option value="#">Elija el tipo de usuario</option>
							<option value="Administrador">Administrador</option>
							<option value="Recepcion">Recepción</option>
		  
						</select>
                    </p>
                    <hr />
                    <input type="submit" name="guardar" value="Guardar" class="btn btn-primary"/>
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
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