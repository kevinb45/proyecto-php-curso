<?php
// Se inicia la sesión trayendo los datos de login.php
session_start(); 
	// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	
	// Traemos la clase encomiendas.
	require_once("clases/encomiendas.php");
	// Utilizando este procedimiento controlo que la sesión sea de usuario Administrador o Recepción..
	// En este caso es para que no se le muestre en el listado de datos "Eliminada/Cancelada" de las encomiendas para el tipo de usuario Recepción.
	// Las funciones estan bien explicadas en la clase
	if($_SESSION['perfil'] == "Administrador") 
	{
	$encomienda = new encomiendas();
	$e = $encomienda->getDatos();}
	else{
	$encomienda = new encomiendas();
	$e = $encomienda->getDatosu();}
	// En este caso es para que no se le muestren los datos de "Eliminada/Cancelada" de las encomiendas cuando uno busca segun el tipo de usuario.
	if($_SESSION['perfil'] == "Administrador"){
	if(isset($_POST['search'])){
	$encomienda = new encomiendas();
	$e = $encomienda->getDatosbuscador();}}
	else{
	if(isset($_POST['search'])){
	$encomienda = new encomiendas();
	$e = $encomienda->getDatosbuscadoru();}}	
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
				<p>
				<!-- En el caso de encomiendas agregamos el boton agregar para dar de alta nuevas encomiendas -->
					<a href="agregar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
				</p>
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<input type="text" name="ingreso" placeholder ="Despachante o Numero"/>
				<input type="submit" value="Buscar" href="javascript:mostrarOcultarDiv('tabla1')" name="search"/>
				</form>
				<table class="table table-bordered">	
						<thead>	
							<tr class="info">
								<th>ID</th>
								<th>Despachante</th>
								<th>Destinatario</th>
								<th>Destino</th>
								<th>Origen</th>
								<th>Tipo</th>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Estado</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($e as $dato) {
							 ?> 
							 <tr>
							 	<td><?php echo $dato->id ?></td>
								<td><?php echo $dato->nombredesp ?></td>
							 	<td><?php echo $dato->nombredest ?></td>
								<td><?php echo $dato->destino ?></td>
								<td><?php echo $dato->origen ?></td>
							 	<td><?php echo $dato->tipo ?></td>
							 	<td><?php echo Helpers::fecha($dato->fecha) ?></td>
								<td><?php echo $dato->hora ?></td>
								<td><?php echo $dato->estado ?></td>
							 	<td>
								<!-- Enviamos el id que seria igual al id de la encomienda para poder editar y tambien para eliminar, generandose los procedimientos en archivos externos. -->
							 		<a href="editar.php?id=<?php echo $dato->id ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<?php
									// Utilizando este procedimiento controlo que la sesión sea de usuario Administrador o Recepción..
									// En este caso es para que el usuario Recepción no pueda eliminar encomiendas, solo agregar y editar.
									if($_SESSION['perfil'] == "Administrador") 
									{
									?>
							 		<a href="javascript:void(0);"onclick="eliminar('eliminar.php?id=<?php echo $dato->id?>');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>						 		
									<?php
									}
									?>									
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
	$url = "listadoencomiendas.php";

	$total_paginas = $encomienda->cantidad();
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