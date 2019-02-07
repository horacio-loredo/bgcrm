<?php
$connect = mysqli_connect("172.18.55.6", "comandato", "comandato123", "TELEFONICOS_NUMEROS");
$connect -> set_charset( 'utf8' );

$ced = mysqli_real_escape_string($connect, $_POST["cedula"]);
$cedula_SINCERO=preg_replace('/^0+/', '',$ced);
$numero = mysqli_real_escape_string($connect, $_POST["numero"]);
$contacto = mysqli_real_escape_string($connect, $_POST["contacto"]);
$tipo = mysqli_real_escape_string($connect, $_POST["tipo"]);
$propietario = mysqli_real_escape_string($connect, $_POST["propietario"]);
$nombre = mysqli_real_escape_string($connect, $_POST["nombre"]);
 
 
 
 date_default_timezone_set('America/Guayaquil');	
$fecha = strftime( "%Y-%m-%d %H:%M:%S", time() );
 

 $query = "INSERT INTO `TELEFONICOS_NUMEROS`.`TELEFONOS` (`CEDULA`, `NUMERO`, `ESTADO`, `CONTACTO`, `CAMPAÑA`, `TIPO`, `fech_ingreso`, `PROPIETARIO`, `NOMBRE`) VALUES ('$cedula_SINCERO', UPPER('$numero'), '', '$contacto', 'SISTEMECUADOR', '$tipo', '$fecha', UPPER('$propietario'), UPPER('$nombre'))";
 if(mysqli_query($connect, $query))
 {
  echo 'INGRESADO CORRECTAMENTE';
 }
 else {
 	echo mysqli_error($connect);
 }

?>