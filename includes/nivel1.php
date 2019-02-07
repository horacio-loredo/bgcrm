<?php
	
	require ('conexion.php');
	
	
	
	$queryM = "SELECT * FROM Biggestion.NIVEL1 WHERE ID_CAMP = '3'";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value=''>Seleccionar</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_NIVEL1']."'>".$rowM['NOM_NIVEL1']."</option>";
	}
	
	echo $html;
?>		