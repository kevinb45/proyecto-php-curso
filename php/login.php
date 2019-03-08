<?php
// Al presionar el boton login en index.php se activa el procedimiento.
if(isset($_POST['login'])){
	
	$usu = $_POST['usuario'];
	$psw = MD5($_POST['contrasena']); // Encriptamos el valor ingresado para poder compararlo con la encropción MD5 guardada.
	
	// Utilizo un condicional para evaluar que los campos no queden vacíos.
	if($usu!="" && $psw!=""){	
	
		// Llamada al archivo de conexion.
		require("conexion.php");
		
		// Cadena de consulta almacenada en una variable.
		$sql = "SELECT * FROM usuarios WHERE nombreusuario = '$usu' AND Clave ='$psw'";
		
		// Almaceno en una variable la cantidad de filas obtenidas luego de realizar la consulta.
		$numfilas = mysqli_num_rows($conexion->query($sql));
		
		// Consulto la cantidad de filas obtenidas. 
		// Si estoy trabajando con Primary Key no debería de tener mas de un registro con los mismos valores, 
		// entonces $numfilas sería 0 sin registros o 1 con registro válido
		if($numfilas>0){			
			
			
			$sqlperfil = "SELECT nombreusuario, nombre, apellido, tipousuario, cedula FROM usuarios WHERE nombreusuario = '$usu'";			
			$resultado = $conexion->query($sqlperfil);
			$info = $resultado -> fetch_assoc(); 	
			
			// Creo una variable de sesión para almacenar el nombre del usuario.
			// Para poder manejar la variable super global $_SESSION[] es necesario abrir una session.
			// A parte lo envio al archivo gestor.php donde se muestra todos los datos.

			session_start();
			$_SESSION['usuario'] = $info['nombreusuario'];
			$_SESSION['perfil'] = $info['tipousuario'];
			$_SESSION['nombre'] = $info['nombre'];
			$_SESSION['apellido'] = $info['apellido'];
			$_SESSION['cedula'] = $info['cedula'];
			
			header('location:../gestor.php');
			
		}else{
			// Muestro mensaje en Javascript y redirijo a la pagina index.php para que vuelva a logearse bien.
			echo "<script>alert(\"Usuario y/o contraseña incorrectos.\");window.location='../index.php';</script>";
			exit;
		}
	}
}

?>