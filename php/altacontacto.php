<?php

// Si el boton de ENVIAR se presiona
if(isset($_POST['enviar'])){
	
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];	
	$asunto = $_POST['asunto']; 
	$telefono = $_POST['telefono']; 
	$mensaje = $_POST['mensaje']; 
	$estado = 'No Leido';
	
	// Utilizo un condicional para evaluar que los campos no queden vacíos
	
	if($nombre!="" && $email!="" && $telefono!="" && $mensaje!="" && $asunto!=""){
		
		// Llamada al archivo de conexion
		require("conexion.php");
		
		// SQL para realizar al Alta de un nuevo mensaje de contacto
		$sqlAlta = "INSERT INTO contacto (nombre, email, asunto, telefono, mensaje, estado) VALUES ('$nombre', '$email','$asunto','$telefono','$mensaje', '$estado');";
		
		// Almacenamos en una variable el valor de la consulta
		$query = $conexion->query($sqlAlta);
		
		// Controlo en caso de error en la cansulta SQL, si esta NULL es porque no la pudo realizar
		if ($query == NULL) {
			// Muestro mensaje en Javascript y redirijo a la pagina Index
			echo "<script>alert('No se pudo realizar el alta de registro.');window.location='../contact.html';</script>";
			exit;
		}else{
			// Muestro mensaje en Javascript y redirijo a la pagina Index
			echo "<script>alert('Registro realizado con éxito.');window.location='../contact.html';</script>";
			exit;
		}
		
	}else{
		// Asigno valor a la variable de error de ALTA para campos vacios
		$msgA = "<span style='color:red;'>Error: No pueden quedar campos vacíos.</span>";
		header("location:../contact.html");
	}
	// Cierro la conexion con el servidor y base de datos
	$conexion->close();
}
?>