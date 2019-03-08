<?php
// Se inicia la sesión trayendo los datos de páginas anteriores.
session_start(); 
	// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.	
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase usuarios.
	require_once("clases/usuarios.php");
	$u=new regusuarios(); // Creamos nuevo array.
	// Comprobamos si existe y si es númerico el id	
	if(!isset($_GET["id"]) or !is_numeric($_GET["id"])){
		die("error 404");
	}
	$datos=$u->getDatosId($_GET["id"]);// Traemos los datos
	// Si el tamaño de los datos es igual a 0 tira error.
	if(sizeof($datos)==0){
		die("error 404");
	}
	// Si presionamos el boton elminar, eliminamos a partir del id traido.
	$u->eliminarDatos();
	header("Location: listadousuarios.php?m=3"); // Mandamos hacia la página anterior con un mensaje.
?>