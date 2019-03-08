<?php
// Se inicia la sesión trayendo los datos de páginas anteriores.
session_start(); 
// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.		
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase encomiendas.
	require_once("clases/encomiendas.php");
	$e = new encomiendas();	// Creamos nuevo array.
	// Comprobamos si existe y si es númerico el id
	if(!isset($_GET["id"]) or !is_numeric($_GET["id"])){
	    die("error 404");
	}
	$datos=$e->getDatosId($_GET["id"]); // Traemos los datos
	// Si el tamaño de los datos es igual a 0 tira error.
	if(sizeof($datos)==0){
	    die("error 404");
	}
	// Si presionamos el boton actualizar, actualizamos
	if(isset($_POST["actualizar"])){
	    $e->actualizarDatos();
	    header("Location: listadoencomiendas.php?m=2"); // Mandamos hacia la página anterior con un mensaje.
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>..:: Listado de Encomiendas::..</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="listadoencomiendas.php">Listado Encomiendas</a></li>
		  <li class="active">Actualizar Encomiendas</li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Actualizar Encomiendas</h3>
			</div>
			<div class="panel-body">
			<!-- Validamos datos con html. -->
				<form name="form" action="" method="post">
					<p>
                        <label for="nombredest">Destinatario:</label>
                        <input type="text" name="nombredest" placeholder="Nombre del Destinatario" autofocus="true" class="form-control" maxlength="25" required="true" value="<?php echo $datos[0]->nombredest;?>"/>
                    </p>
                    <p>
                        <label for="nombredesp">Despachante:</label>
                        <input type="text" name="nombredesp" placeholder="Nombre del Despachante" class="form-control" maxlength="25" required="true" value="<?php echo $datos[0]->nombredesp;?>" />
                    </p>
					<p>
                        <label for="destino">Destino:</label><br>
					<?php
					// Para traer los datos traemos una conexion.
					require("php/conexion.php");
					// Generamos la consulta.
						$sql = "select d.idd as id, d.nombre as destino
								from destino as d";
						if (!$registros = $conexion->query($sql)) {
						echo "Lo sentimos, La consulta no se pudo realizar.";
						exit;		
						}
						// Ingresamos los select y option por php.
						echo "<select name='destino'><option>Elija el destino</option>";
						while ($item = $registros->fetch_assoc()) {
						echo '<option value="'.$item['id'].'">'.utf8_encode($item['destino']).'</option>';
						}
						echo "</select>";
						?>
					</p>	
						
					<p>
                        <label for="origen">Origen:</label><br>
					<?php 
					// Generamos la consulta.
					    $sql = "select o.ido as id, o.nombre as origen
								from origen as o";
						if (!$registros = $conexion->query($sql)) {
						echo "Lo sentimos, La consulta no se pudo realizar.";
						exit;		
						}
						// Ingresamos los select y option por php.
						echo "<select name='origen'><option>Elija el origen</option>";
						while ($item = $registros->fetch_assoc()) {
						echo '<option value="'.$item['id'].'">'.utf8_encode($item['origen']).'</option>';
						}
						echo "</select>";
						?>
					</p>	
                    <p>
						<label for="tipo">Tipo:</label>
                        <input type="text" name="tipo" placeholder="Tipo" class="form-control" maxlength="25" required="true" value="<?php echo $datos[0]->tipo;?>" />
                    </p>
                    <p>
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" class="form-control" maxlength="25" value="<?php echo $datos[0]->fecha;?>"/>
                    </p>
					<p>
                        <label for="hora">Hora:</label>
                        <input type="time" name="hora" class="form-control" maxlength="25" value="<?php echo $datos[0]->hora;?>"/>
                    </p>
					<p>
                        <label for="estado" >Estado:</label><br>
					<?php 
					// Generamos la consulta.
					    $sql = "select e.idEstado as id, e.nombre as estado
								from estado as e";
						if (!$registros = $conexion->query($sql)) {
						echo "Lo sentimos, La consulta no se pudo realizar.";
						exit;		
						}
						// Ingresamos los select y option por php.
						echo "<select name='estado'><option>Elija el estado</option>";
						while ($item = $registros->fetch_assoc()) {
						echo '<option value="'.$item['id'].'">'.utf8_encode($item['estado']).'</option>';
						}
						echo "</select>";
						?>
					</p>	
                    <hr />
                    <input type="hidden" name="id" value="<?php echo $datos[0]->id;?>" />
                    <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary"/>
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