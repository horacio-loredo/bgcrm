<?php
	
	require ('conexion.php');
	
	$idnivel1_select = $_POST['idnivel1_select'];
	
	$queryM = "SELECT * FROM Biggestion.NIVEL2 WHERE ID_NIVEL1 = '$idnivel1_select' and ID_CAMP = '3' ";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value=''>Seleccionar</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_NIVEL2']."'>".$rowM['NOM_NIVEL2']."</option>";
	}
	
	echo $html;
?>		