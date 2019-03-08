<?php

	$conexion = new mysqli('localhost', 'root', '', 'encomiendas_kevin');
	if ($conexion->connect_errno) {
		echo "Lo sentimos, este sitio web está experimentando problemas.";
		exit;
	}
	
?>