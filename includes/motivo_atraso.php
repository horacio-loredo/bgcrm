<?php
	
	require ('conexion.php');
	
	
	
	$queryM = "SELECT idmotivo_atraso, nom_mot FROM motivo_atraso WHERE id_camp ='3' ORDER BY nom_mot";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value=''>Seleccionar</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idmotivo_atraso']."'>".$rowM['nom_mot']."</option>";
	}
	
	echo $html;
?>		