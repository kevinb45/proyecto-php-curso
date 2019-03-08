<?php
//Incluimos los archivos necesarios
require_once("conectar.php");
require_once("helpers.php");

class regusuarios extends conectar //Creamos la clase usuarios que extiende o hereda de la clase conectar
{
	private $db; 

	//Crear nuestro constructor
	public function __construct(){
		$this->db=parent::conectar(); //Parent para hacer referencia a la clase padre
		parent::setNames();   
	}
    
	// Creamos la función getDatos para listar los datos
	public function getDatos(){
		
			
		$sql="SELECT cedula, nombre, apellido, nombreusuario, clave, tipousuario FROM usuarios";
		$datos= $this->db->query($sql);
		
		$arreglo=array();
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;   
	}
	// Creamos la función getDatosId para enviar los datos por id para editar, eliminar 
	public function getDatosId($id){
				
		$sql="SELECT cedula,nombre, apellido, nombreusuario, clave, tipousuario FROM usuarios WHERE cedula='".$id."'";
		
		$datos= $this->db->query($sql);
		$arreglo=array();
		
		while($reg=$datos->fetch_object()){
			$arreglo[]=$reg;
		}

		return $arreglo;
		
	}
	// Creamos la función insertarDatos para ingresar nuevo registro
	public function insertarDatos(){
		
		$ced = $_POST['cedula']; 
		$nom = $_POST["nombre"]; 
	    $ape = $_POST["apellido"];
		$user = $_POST["nombreusuario"]; 
	    $clave = MD5($_POST["clave"]);
		$tipo = $_POST["tipousuario"]; 
         
		 
		$sql="INSERT INTO usuarios (cedula, nombre, apellido, nombreusuario, clave, tipousuario) VALUES ('$ced','$nom','$ape','$user','$clave', '$tipo');";

		
		$this->db->query($sql); 
	}
	// Creamos la función actualizarDatos dar el update y modificar
	public function actualizarDatos(){
		
		
	    $clave = MD5($_POST["clave"]);
		$tipo = $_POST["tipousuario"]; 
		
		$sql="UPDATE usuarios SET clave = '$clave', tipousuario = '$tipo' WHERE cedula='".$_GET["id"]."'";
		
		
		$this->db->query($sql);
		
			
	}
	// Creamos la función eliminarDatos para eliminar un registro
	public function eliminarDatos(){

		
		$sql="DELETE FROM usuarios WHERE cedula='".$_GET["id"]."'";
		$this->db->query($sql);
		
		
	}
}
?>

