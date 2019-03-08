<?php 
// Se inicia la sesión trayendo los datos de login.php
session_start(); 
	// Se controla que el usuario no este vació y que realmente se haya logeado para estar en esta página.
	if(empty($_SESSION['usuario'])){
		echo("<script>alert(\"Debe iniciar sesión.\");window.location='index.php';</script>");
	}
	// Traemos la clase usuarios.
	require_once("clases/usuarios.php");
	// Creamos nuevo array.
	$regusuario = new regusuarios();
	// Llamamos la función getDatos y traemos todos los datos necesarios para el listado.
	$u = $regusuario->getDatos();
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
					<a href="agregaru.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
				</p>
				<table class="table table-bordered">	
						<thead>	
							<tr class="info">
								<th>Cedula</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Nombre de Usuario</th>
								<th>Tipo de Usuario</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($u as $dato) {
							 ?>
							 <tr>
							 	<td><?php echo $dato->cedula ?></td>
							 	<td><?php echo $dato->nombre ?></td>
							 	<td><?php echo $dato->apellido ?></td>
							 	<td><?php echo $dato->nombreusuario ?></td>
								<td><?php echo $dato->tipousuario ?></td>
							 	<td>
								<!-- Enviamos el id que seria igual al id del contacto para poder editar y tambien para eliminar, generandose los procedimientos en archivos externos. -->
							 		<a href="editaru.php?id=<?php echo $dato->cedula ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<?php
									/* Este procedimiento es IMPORTANTE, para que el usuario no se pueda borrar asi mismo igualamos el dato cedula de la funcion getDatos
									con el dato cedula de la sesion. Si es igual no aparecera el icono de borrar.  */
									if($_SESSION['cedula'] != $dato->cedula) 
									{
									?>
							 		<a href="javascript:void(0);"onclick="eliminar('eliminaru.php?id=<?php echo $dato->cedula?>');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
				</div>		
			</div>
		</div>	
	</div>
	 <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funciones.js"></script>
</body>
</html>