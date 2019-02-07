<?php
	
	require ('conexion.php');
	
	$idnivel2_select = $_POST['idnivel2_select'];
	
	$queryM = "SELECT * FROM Biggestion.NIVEL3 WHERE ID_NIVEL2 = '$idnivel2_select' and ID_CAMP = '3'";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value=''>Seleccionar</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_NIVEL3']."'>".$rowM['NOM_NIVEL3']."</option>";
	}
	
	echo $html;
?>		