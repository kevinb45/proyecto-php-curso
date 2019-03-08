<?php
//Incluimos los archivos necesarios
require_once("conectar.php");
require_once("helpersh.php");

class contactos extends conectar //Creamos la clase encomiendas que extiende o hereda de la clase conectar
{
	private $db; 

	// Crear nuestro constructor
	public function __construct(){
		$this->db=parent::conectar(); //Parent para hacer referencia a la clase padre
		parent::setNames();   
	}
	
	//Creamos la función cantidad para contar las páginas
	public function cantidad(){
		
	$consulta_registros = "SELECT * FROM contacto";

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
	// Creamos la función getDatos para listar los datos
	public function getDatos(){
		

		$url = "listadocontactos.php";

// Creamos una variable que almacena la consulta a realizar
$consulta_registros = "SELECT * FROM usuarios";

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
		
		
		$sql="SELECT idcontacto, nombre, email, asunto, telefono, mensaje, fechahora, estado FROM contacto ORDER BY fechahora DESC LIMIT ".$inicio."," . $cant_reg_paginas;
		$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
}	
	// Creamos la función getDatosId para enviar los datos por id para editar, eliminar 
	public function getDatosId($id){
		

		$sql="SELECT idcontacto, nombre, email, asunto, telefono, mensaje, fechahora, estado FROM contacto 
			WHERE idcontacto='".$id."'";
		
		$datos= $this->db->query($sql);
		$arreglo=array();
		
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;
		
	}
	
	// Creamos la función actualizarDatos dar el update y modificar
	public function actualizarDatos(){
		
		$id = $_POST['id'];
		$estado = $_POST['estado'];

		$sql="UPDATE contacto SET estado = '$estado' WHERE idcontacto = '$id'";
		
		
		$this->db->query($sql);
		
		
	}
	
	// Creamos la función eliminarDatos para eliminar un registro
	public function eliminarDatos(){
		
		$sql="DELETE FROM contacto WHERE idcontacto='".$_GET["id"]."'";
		$this->db->query($sql);
		
	}
}
?>

