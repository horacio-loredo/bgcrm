<?php
$connect = mysqli_connect("172.18.55.6", "comandato", "comandato123", "TELEFONICOS_NUMEROS");
$connect -> set_charset( 'utf8' );
if(isset($_POST["cedula"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE TELEFONOS SET ".$_POST["column_name"]."= UPPER('".$value."') WHERE CEDULA = '".$_POST["cedula"]."' and  NUMERO = '".$_POST["numero"]."' ";
 if(mysqli_query($connect, $query))
 {
  echo 'ACTUALIZADO';
 }
}
?>