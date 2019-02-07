<?php
$connect = mysqli_connect("172.18.55.6", "comandato", "comandato123", "sistemecuador_atm");
$connect -> set_charset( 'utf8' );
if(isset($_POST["cedula"]))
{
	date_default_timezone_set( 'America/Guayaquil' );
 			$fecha = strftime( "%Y-%m-%d %H:%M:%S", time() );
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE `sistemecuador_atm`.`informacion_cliente` SET ".$_POST["column_name"]."='".$value."', `FECHA_INGRESO_EMAIL`='".$fecha."' WHERE `CEDULA`='".$_POST["cedula"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ACTUALIZADO';
 }
}
?>