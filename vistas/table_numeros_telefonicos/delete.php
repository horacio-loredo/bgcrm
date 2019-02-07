<?php
$connect = mysqli_connect("172.18.55.6", "comandato", "comandato123", "TELEFONICOS_NUMEROS");
$connect -> set_charset( 'utf8' );
if(isset($_POST["cedula"]))
{
 $query = "DELETE FROM TELEFONOS WHERE CEDULA = '".$_POST["cedula"]."' AND NUMERO = '".$_POST["numero"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'ELIMINADO';
 }
 else{
 	echo mysqli_error($connect);
 }
}
?>