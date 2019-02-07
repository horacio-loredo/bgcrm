<?php
	
	require ('conexion.php');
	
	$idnivel3_select = $_POST['idnivel3_select'];
	
	$queryM = "SELECT * FROM Biggestion.NIVEL4 WHERE ID_NIVEL3 = '$idnivel3_select' and ID_CAMP = '3'";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value=''>Seleccionar</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_NIVEL4']."'>".$rowM['NOM_NIVEL4']."</option>";
	}
	
	echo $html;
?>		