<?php

// Si el boton de ALTA se presiona
if(isset($_POST['enviardatos'])){
	
	$usu = $_POST['usuario'];
	// MD5() se utiliza para encriptar contraseñas, existen otras maneras mas eficientes.
	// Siempre genera una cadena de 32 caracteres, por eso es inmprescindible contar en la base de datos con un campo de esa longitud: VARCHAR(32)
	$psw = MD5($_POST['contrasena']); 
	$nom = $_POST['nombre']; 	
	
	// Utilizo un condicional para evaluar que los campos no queden vacíos
	if($usu!="" && $psw!="" && $nom!="" ){
		
		// Llamada al archivo de conexion
		require("conexion.php");
		
		// SQL para realizar al Alta de un nuevo registro
		$sqlAlta = "INSERT INTO usuarios VALUE('$usu','$psw','$nom')";
		
		// Almacenamos en una variable el valor de la consulta
		$query = $conexion->query($sqlAlta);
		
		// Controlo en caso de error en la cansulta SQL, si esta NULL es porque no la pudo realizar
		if ($query == NULL) {
			// Muestro mensaje en Javascript y redirijo a la pagina Index
			echo "<script>alert('No se pudo realizar el alta de registro.');window.location='../index.php';</script>";
			exit;
		}else{
			// Muestro mensaje en Javascript y redirijo a la pagina Index
			echo "<script>alert('Registro realizado con éxito.');window.location='../index.php';</script>";
			exit;
		}
		
	}else{
		// Asigno valor a la variable de error de ALTA para campos vacios
		$msgA = "<span style='color:red;'>Error: No pueden quedar campos vacíos.</span>";
		header("location:../index.php");
	}
	// Cierro la conexion con el servidor y base de datos
	$conexion->close();
}
?>