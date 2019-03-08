<?php
//Incluimos los archivos necesarios
require_once("conectar.php");
require_once("helpers.php");

class encomiendas extends conectar //Creamos la clase encomiendas que extiende o hereda de la clase conectar
{
	private $db; 

	// Crear nuestro constructor
	public function __construct(){
		$this->db=parent::conectar(); //Parent para hacer referencia a la clase padre
		parent::setNames();   
	}
	
	// Creamos la función cantidad para contar las páginas
	public function cantidad(){
		
		$consulta_registros = "SELECT * FROM encomiendas";

// Almacenamos en una variable el resultado obtenido luego de procesar la consulta
$resultado_registros = $this->db->query($consulta_registros);

// Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
$total_registros = mysqli_num_rows($resultado_registros);

// Si hay registros
if ($total_registros > 0) {
	
	// Se limita la busqueda a 3 registros por página
	$cant_reg_paginas = 50;
    
	// Creamos una varible que nos permitirá gestionar el número de página,
	// al inicio le asignamos valor falso (que no se ha seteado valor aún)
	$pagina = false;

	// Examinamos la página a mostrar y el inicio del registro a mostrar
	if (isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
	// Si la variable pagina no tiene valor
	if (!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio = ($pagina - 1) * $cant_reg_paginas;
	}
	
	// Calculo el total de páginas.
	// Funcion ceil(): redondea fracciones hacia arriba.
	$total_paginas = ceil($total_registros / $cant_reg_paginas);
	
	
	return $total_paginas;
		
        }
   }
	// Creamos la función getDatosbuscador para el usuario administrador
	// donde le apareceran LISTADOS todos los datos en la página principal sin excepcion.
	public function getDatosbuscador(){
	
	// Declaro una variable para almacenar el valor ingresado en la caja de texto
	$b = $_POST['ingreso'];
	
	// Guardo en una variable la consulta SQL para realizar la busqueda.
	// Utilizo LIKE para 3 de los 4 campos que tiene la tabla, tambien se utiliza
	// comodines ya que no sabemos en que lugar del valor de los campos se encuentra la cadena ingresada por el usuario.
	$sql = "select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado
			and (e.id = '$b' or e.nombredesp LIKE '%$b%')";
	$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
	
	// Creamos la función getDatosbuscadoru para el usuario recepcion
	// donde le apareceran LISTADOS todos los datos en la página principal menos "Eliminada/Cancelada"
	public function getDatosbuscadoru(){
	
	// Declaro una variable para almacenar el valor ingresado en la caja de texto
	$b = $_POST['ingreso'];
	
	// Guardo en una variable la consulta SQL para realizar la busqueda.
	// Utilizo LIKE para 3 de los 4 campos que tiene la tabla, tambien se utiliza
	// comodines ya que no sabemos en que lugar del valor de los campos se encuentra la cadena ingresada por el usuario.
	$sql = "select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado
			and (e.id = '$b' or e.nombredesp LIKE '%$b%') and es.nombre <> 'Eliminada/Cancelada'"; // Aquí señalamos que muestre todos menos "Eliminada/Cancelada"
	$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
	
	// Creamos la función getDatos para listar los datos
	public function getDatos(){
		
		$url = "listadoencomiendas.php";

// Creamos una variable que almacena la consulta a realizar
$consulta_registros = "SELECT * FROM encomiendas";

// Almacenamos en una variable el resultado obtenido luego de procesar la consulta
$resultado_registros = $this->db->query($consulta_registros);

// Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
$total_registros = mysqli_num_rows($resultado_registros);

// Si hay registros
if ($total_registros > 0) {
	
	// Se limita la busqueda a 3 registros por página
	$cant_reg_paginas = 50;
    
	// Creamos una varible que nos permitirá gestionar el número de página,
	// al inicio le asignamos valor falso (que no se ha seteado valor aún)
	$pagina = false;

	// Examinamos la página a mostrar y el inicio del registro a mostrar
	if (isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
	// Si la variable pagina no tiene valor
	if (!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio = ($pagina - 1) * $cant_reg_paginas;
	}
	
	// Calculo el total de páginas.
	// Funcion ceil(): redondea fracciones hacia arriba.
	$total_paginas = ceil($total_registros / $cant_reg_paginas);

		$sql="select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado ORDER BY e.id ASC LIMIT ".$inicio."," . $cant_reg_paginas;
		$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
}	
	// Creamos la función getDatosId para enviar los datos por id para editar, eliminar 
	public function getDatosu(){
		
	
		$url = "listadoencomiendas.php";

// Creamos una variable que almacena la consulta a realizar
$consulta_registros = "SELECT * FROM encomiendas";

// Almacenamos en una variable el resultado obtenido luego de procesar la consulta
$resultado_registros = $this->db->query($consulta_registros);

// Creamos una variable donde guardamos la cantidad de registros obtenido en la consulta
$total_registros = mysqli_num_rows($resultado_registros);

// Si hay registros
if ($total_registros > 0) {
	
	// Se limita la busqueda a 3 registros por página
	$cant_reg_paginas = 50;
    
	// Creamos una varible que nos permitirá gestionar el número de página,
	// al inicio le asignamos valor falso (que no se ha seteado valor aún)
	$pagina = false;

	// Examinamos la página a mostrar y el inicio del registro a mostrar
	if (isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
	// Si la variable pagina no tiene valor
	if (!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio = ($pagina - 1) * $cant_reg_paginas;
	}
	
	// Calculo el total de páginas.
	// Funcion ceil(): redondea fracciones hacia arriba.
	$total_paginas = ceil($total_registros / $cant_reg_paginas);

		$sql="select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado WHERE es.nombre <> 'Eliminada/Cancelada' ORDER BY e.id ASC LIMIT ".$inicio."," . $cant_reg_paginas;
		$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
}	

	// Creamos la función buscador para la busqueda de encomiendas dentro del panel.
	public function buscador(){
	
	if(isset($_POST['search'])){
	
	// Declaro una variable para almacenar el valor ingresado en la caja de texto
	$b = $_POST['ingreso'];
	
	// Guardo en una variable la consulta SQL para realizar la busqueda.
	// Utilizo LIKE para encontrar el despachante, no lo use para la busqueda del id porque es especifico.
	$sql = "select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado
			and e.id = '$b' or LIKE e.nombredesp = '%$b%'";
	$this->db->query($sql);
		$arreglo=array();
		
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;
		
	}
	}
	// Creamos la función getDatosId para enviar los datos por id para editar, eliminar 
	public function getDatosId($id){
		

		$sql="select e.id, e.fecha, e.hora, e.nombredest,e.nombredesp, o.nombre as origen,  d.nombre as destino, e.tipo, es.nombre as estado, e.tipo 
			from encomiendas as e
			inner join origen as o
			on e.origen = o.Ido
			inner join destino as  d
			on e.destino = d.Idd 
			inner join estado as es
			on e.estado = es.idEstado 
			and e.id='".$id."'";
		
		$datos= $this->db->query($sql);
		$arreglo=array();
		
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;
		
	}
	// Creamos la función insertarDatos para ingresar nuevo registro
	public function insertarDatos(){
		
		$id = $_POST['id']; 
		$dest = $_POST['nombredest']; 
	    $desp = $_POST['nombredesp'];
		$destino = $_POST['destino']; 
	    $origen = $_POST['origen'];
		$tipo = $_POST['tipo']; 
	    $fecha = $_POST['fecha'];
		$hora = $_POST['hora']; 
		$estado = $_POST['estado'];

		$sql="INSERT INTO encomiendas (fecha, hora, nombredest, nombredesp, destino, origen,  tipo, estado) VALUES ('$fecha','$hora','$dest','$desp','$destino','$origen','$tipo','$estado');";

		$this->db->query($sql);
	}
	// Creamos la función actualizarDatos dar el update y modificar
	public function actualizarDatos(){
		
		$id = $_POST['id']; 
		$dest = $_POST['nombredest']; 
	    $desp = $_POST['nombredesp'];
		$destino = $_POST['destino']; 
	    $origen = $_POST['origen'];
		$tipo = $_POST['tipo']; 
	    $fecha = $_POST['fecha'];
		$hora = $_POST['hora']; 
		$estado = $_POST['estado'];

		$sql="UPDATE encomiendas SET nombredest = '$dest', nombredesp = '$desp', destino = '$destino', origen = '$origen', tipo = '$tipo', fecha = '$fecha', hora = '$hora', estado = '$estado' WHERE id = '$id'";
		
		
		$this->db->query($sql);
		
		
	}
	// Creamos la función eliminarDatos para eliminar un registro
	public function eliminarDatos(){
		
		$sql="DELETE FROM encomiendas WHERE id='".$_GET["id"]."'";
		$this->db->query($sql);
		
	}
}
?>

