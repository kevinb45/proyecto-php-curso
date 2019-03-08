<?php
// Se inicia la sesión trayendo los datos de login.php
session_start(); 

	// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	
	// Traemos la clase contactos.
	require_once("clases/contactos.php");
	// Creamos nuevo array.
	$contacto = new contactos();
	// Llamamos la función getDatos y traemos todos los datos necesarios para el listado.
	$c = $contacto->getDatos();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>..:: Listado de Encomiendas ::..</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<!-- Creamos todos los mensajes para cuando se ha ingresado, actualizado y eliminado los datos. -->
				<?php
                if(isset($_GET["m"])){
                    switch($_GET["m"])
                    {
                        case '1':
                            ?>
                            <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                                El registro se ha ingresado exitosamente
                            </div>
                    <?php
                    	break;
                    	case '2'
                     ?>
                     	<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                                El registro se ha actualizado exitosamente
                            </div>
                    <?php
                        break;
                        case '3'
                    ?>
                    	<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                                El registro ha sido eliminado exitosamente
                            </div>
                    <?php
                      }
                	}
                    ?>
			<!-- Creamos la tabla con los encabezados de cada datos. -->
			<div class="panel-body">
				<table class="table table-bordered">	
						<thead>	
							<tr class="info">
								<th>Nombre</th>
								<th>Email</th>
								<th>Telefono</th>
								<th>Asunto</th>
								<th>Mensaje</th>
								<th>Ingreso</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($c as $dato) {
							 ?>
							 <tr>
							 	<td><?php echo $dato->nombre ?></td>
							 	<td><?php echo $dato->email ?></td>
								<td><?php echo $dato->telefono ?></td>
								<td><?php echo $dato->asunto ?></td>
							 	<td><?php echo $dato->mensaje ?></td>
							 	<td><?php echo Helpers::fecha($dato->fechahora) ?></td>
								<td><?php echo $dato->estado ?></td>
							 	<td>
								<!-- Enviamos el id que seria igual al id del contacto para poder editar y tambien para eliminar, generandose los procedimientos en archivos externos. -->
							 		<a href="editarc.php?id=<?php echo $dato->idcontacto ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

							 		<a href="javascript:void(0);"onclick="eliminar('eliminarc.php?id=<?php echo $dato->idcontacto?>');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							 	</td>
							 </tr>
							 <?php 
							 	}
		
								?>
						</tbody>
				</table>	
				<div>
<?php
    // El procedimiento de páginado para mostrar debajo de la tabla si tiene mayor de 50 registros por página.
	// Traemos las variables
	$url = "listadocontactos.php";

	$total_paginas = $contacto->cantidad();
	$pagina = false;
	
    $cant_reg_paginas = 50;
	
	if (isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
	if (!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio = ($pagina - 1) * $cant_reg_paginas;
	}
	echo '<p>';
	
	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<a href="'.$url.'?pagina='.($pagina-1).'"> < </a>';
			for ($i=1;$i<=$total_paginas;$i++) {
				if ($pagina == $i){
					// Si se muestra el índice de la página actual, no se coloca enlace.
					echo $pagina;
				}else{
					// Si el índice no corresponde con la página mostrada actualmente, 
					// se coloca el enlace para ir a esa página.
					echo '  <a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
				}
			}
		// Se muestra las páginas:	
		if ($pagina != $total_paginas)
			echo '<a href="'.$url.'?pagina='.($pagina+1).'"> > </a>';
	}
	echo '</p>';	
?>				
				</div>
			</div>
		</div>	
	</div>
	 <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funciones.js"></script>
</body>
</html>