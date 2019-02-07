<?php
	class conexion
	{
		private $servidor;
		private $usuario;
		private $contrasena;
		private $basedatos;
		public  $conexion;

		public function __construct($servidor,$usuario,$contrasena,$basedatos){
			$this->servidor   = $servidor;
			$this->usuario	  = $usuario;
			$this->contrasena = $contrasena;
			$this->basedatos  = $basedatos;

		}

		function conectar(){
			$this->conexion= new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
		}

		function cerrar(){
			$this->conexion->close();
		}
	}

?>