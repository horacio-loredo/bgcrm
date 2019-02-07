<?php
	$mysqli = new mysqli("172.18.55.6","comandato","comandato123","biggestion"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli->set_charset('utf8');
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>