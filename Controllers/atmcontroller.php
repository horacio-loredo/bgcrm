<?php

require_once('../Models/modeloatm.php');
require_once('../Models/login.php');

$boton=$_POST['boton'];

switch ($boton) {
	case 'cerrar':
	session_start();
	session_destroy();
	break;
	case 'ingresar':
	$username = $_POST['username'];
	$password = $_POST['password'];

	$ins = new login();
	$array=$ins->identificar($username,$password);
	if ($array[0]==0) 
	{
		echo 0;
	}
	else
	{

		session_start();
		$_SESSION['INGRESO']='YES';
		$_SESSION['EXTENSION']=$array[0];
		$_SESSION['NOMBRES']=$array[1];
		$_SESSION['APELLIDOS']=$array[2];
		$_SESSION['CAMPANA']=$array[3];
		$_SESSION['nom_camp']=$array[4];
		$_SESSION['ROL']= $array[4];
		echo $array[3];

	}
	break;
	
	case 'guardar_atm':

	$num_cuenta = $_POST['num_cuenta'];
	$usuario_sac = $_POST['usuario_sac'];
	$cedula_cli = $_POST['cedula_cli'];
	$ing_num = $_POST['ing_num'];
	$extension = $_POST['extension'];
	$ced_agente = $_POST['ced_agente'];				
	$tipo_llamada = $_POST['tipo_llamada'];
	$nivel1 = $_POST['nivel1'];
	$nivel2 = $_POST['nivel2'];
	$nivel3 = $_POST['nivel3'];
	$nivel4 = $_POST['nivel4'];
	$nivel5 = $_POST['nivel5'];
	$fecha_pago = $_POST['fecha_pago'];
	$valor_pagar = $_POST['valor_pagar'];
	$observacion = $_POST['observacion'];

	$instancia = new modeloatm();
	if($instancia->guardar_atm($num_cuenta,$usuario_sac,$cedula_cli,$extension,$ced_agente,$tipo_llamada,$ing_num,$nivel3,$nivel4,$nivel5,$fecha_pago,$valor_pagar,$observacion))
	{
		echo 1;
	}
	else{
		echo 0;
	}
	break;

	default:
				# code...
	break;
}
?>