<?php
	class conectar
	{
		private $cn;
		
		public function conectar(){
			
			$this->cn=new mysqli('localhost','root','','encomiendas_kevin');
        	return $this->cn;
			
		}

		public function setNames(){
			return $this->cn->query("SET NAMES 'utf8'");
		}
	}
 ?>
