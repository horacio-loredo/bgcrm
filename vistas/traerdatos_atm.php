<?php
$boton = $_POST[ 'btn' ];
$cedula = $_POST[ 'cedula' ];
$id = $_POST[ 'id' ];
$num = $_POST[ 'num' ];
$fecha_ini = $_POST[ 'ini' ];
$fecha_fin = $_POST[ 'fin' ];
$agen = $_POST[ 'agen' ];
$call_type = $_POST[ 'call_type' ];
$ced_agente = $_POST[ 'ced_agente' ];
$conn4 = new mysqli( "172.18.55.6", "comandato", "comandato123" );

switch ( $boton ) {
	case 'historial':
	$consulta_mysql4 = "SELECT 
	APELLIDOS,
	FECHA_GESTION,
	NUMERO_GESTION,
	RESPUESTA_OBTENIDA,
	COMENTARIOS_GESTIONO,
	MOTIVO_NO_PAGO
	FROM
	SISTEMECUADOR_ATM.GESTION,
	biggestion.agentes
	WHERE
	NRO_IDENTIFICACION_CLIENTE = '$cedula' AND
	COD_AGENTE = CODIGO order by FECHA_GESTION desc";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );
	while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

		$arreglo["data"][]=$data;
		
	}

	echo json_encode($arreglo);
	break;
	case 'historial_ivr':
	
	$consulta_mysql4 = "(SELECT 
	CAMPANA,
	EXTENSION,
	TELEFONO,
	NOMBRE,
	CEDULA,
	OPERACION,
	FECHA,
	DIAS,
	VALOR,
	CAPITAL,
	sgtest,
	FECHA_LLAMADA,
	DURATION,
	BILLISEC,
	DISPOSITION
	FROM
	reportes.REPORTES_IVRJS
	WHERE
	EXTENSION = '9013' and CEDULA = '$cedula') UNION ALL (SELECT 
	campana,
	extension,
	telefono,
	nombre,
	cedula,
	operacion,
	fecha,
	dias,
	valor,
	capital,
	sgtest,
	
	DATE_FORMAT('0000-00-00 00:00:00',
	_UTF8'%Y/%m/%d %H:%i:%s'),
	0,
	0,
	'0'
	FROM
	IVR_JS.calloutnumeros
	WHERE
	extension = '9013' AND sgtest = '1' and cedula = '$cedula') UNION ALL (SELECT 
	campana,
	extension,
	telefono,
	nombre,
	cedula,
	operacion,
	fecha,
	dias,
	valor,
	capital,
	sgtest,
	
	DATE_FORMAT('0000-00-00 00:00:00',
	_UTF8'%Y/%m/%d %H:%i:%s'),
	0,
	0,
	'0'
	FROM
	IVR_JS.calloutnumeros
	WHERE
	extension = '9013' AND sgtest = '0' and cedula = '$cedula');";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {


		$arreglo["data"][]=$data;
	}

	echo json_encode($arreglo);
	break;
	case 'multas_atm':
	
	$consulta_mysql4 = "SELECT ID_CEDULA,SALDO,DIAS_MORA,PLACA_VEHICULO,DESCRIPCION_INFRACION FROM SISTEMECUADOR_ATM.MULTAS where ID_CEDULA = '$cedula'";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

		$arreglo["data"][]=$data;
		
	}

	echo json_encode($arreglo);
	break;
	
	case 'info_cliente_atm':
	
	
	$sql1 = "SELECT 
	
	CONCAT(IF(PRIMER_NOMBRE = 'None',
	'',
	PRIMER_NOMBRE),
	' ',
	IF(SEGUNDO_NOMBRE = 'None',
	'',
	SEGUNDO_NOMBRE),
	' ',
	IF(PRIMER_APELLIDO = 'None',
	'',
	PRIMER_APELLIDO),
	' ',
	IF(SEGUNDO_APELLIDO = 'None',
	'',
	SEGUNDO_APELLIDO),
	IF(RAZON_SOCIAL is null,
	'',
	RAZON_SOCIAL)) AS NOMBRES,
	CEDULA,
	CORREO_ELECTRONICO
	FROM
	SISTEMECUADOR_ATM.INFORMACION_CLIENTE
	WHERE
	CEDULA = '$cedula'";
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $sql1 );
	$a = 0;
	while ( $fila2 = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		
		$arreglobi[ $a ][ 0 ] = $fila2[ 0 ];
		$arreglobi[ $a ][ 1 ] = $fila2[ 1 ];
		$arreglobi[ $a ][ 2 ] = $fila2[ 2 ];
		$a++;
	}
	echo json_encode( $arreglobi );
	break;
	
	
	case 'conv':
	if ($agen == 3016 || $agen == 3005 || $agen == 3023){
		$agente = "D02".$agen;
	}else{
		$agente = "D01".$agen;
	}
	
	if($call_type == 1){
		
		
		$consulta_mysql4 = "SELECT 
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION
		WHERE
		RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO'
		AND COD_AGENTE = '$agente'
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
		
	}else if($call_type == 2){
		
		$consulta_mysql4 = "SELECT 
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION
		WHERE
		RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO'
		AND COD_AGENTE = '$agente'
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );

		

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
		
	} else if($call_type == 3){
		
		$consulta_mysql4 = "SELECT 
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION
		WHERE
		(RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO' or RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO')
		AND COD_AGENTE = '$agente'
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
	}
	
	break;
	case 'conv_general':
	if ($agen == 3016 || $agen == 3005 || $agen == 3023){
		$agente = "D02".$agen;
	}else{
		$agente = "D01".$agen;
	}
	
	if($call_type == 1){
		
		$consulta_mysql4 = "SELECT 
		NOMBRES,
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION,
		biggestion.agentes
		WHERE
		COD_AGENTE = CODIGO and
		RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO'
		
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );		

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
		
	}else if($call_type == 2){
		
		$consulta_mysql4 = "SELECT 
		NOMBRES,
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION,
		biggestion.agentes
		WHERE
		COD_AGENTE = CODIGO and
		RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO'
		
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );

		

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
		
	} else if($call_type == 3){
		
		$consulta_mysql4 = "SELECT 
		NOMBRES,
		RESPUESTA_OBTENIDA,
		FECHA_GESTION,
		NRO_IDENTIFICACION_CLIENTE,
		NUMERO_GESTION,
		FECHA_PAGO_PROMESA,
		VALOR_PROMESA,
		COMENTARIOS_GESTIONO
		FROM
		SISTEMECUADOR_ATM.GESTION,
		biggestion.agentes
		WHERE
		COD_AGENTE = CODIGO and
		(RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO' or RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO')
		
		AND FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
		
		$conn4->set_charset('utf8');
		$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
		mysqli_close( $conn4 );

		while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

			$arreglo["data"][]=$data;
			
		}

		echo json_encode($arreglo);
	}
	
	break;
	
	case 'num_cuenta':
	$cedula_SINCERO=preg_replace('/^0+/', '',$id);
	
	$consulta_mysql4 = "SELECT NUMERO_CUENTA FROM SISTEMECUADOR_ATM.MULTAS where ID_CEDULA = '$cedula' order by FECHA_ENTRADA desc limit 1";
	
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	$a = 0;
	while ( $fila2 = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		$arreglobi[ $a ][ 0 ] = $fila2[ 0 ];
		
		$a++;

	}

		//eliminamos la coma que sobra

	$m = $arreglobi;
	echo json_encode( $m );
	break;
	case 'llamadas_pro':
	
	
	if ($ced_agente == 3016 || $ced_agente == 3005 || $ced_agente == 3023 ){
		$agente = "D02".$ced_agente;
	}else{
		$agente = "D01".$ced_agente;
	}
	date_default_timezone_set( 'America/Guayaquil' );
	$fechaInicial = strftime( "%Y-%m-%d", time() );
	$fechaFinal = date( 'Y-m-d', strtotime( "$fechaFinal + 1 day" ) );
	$consulta_mysql4 = "SELECT 
	COUNT(RESPUESTA_OBTENIDA) AS LLAMADAS_PRODUCTIVAS
	FROM
	SISTEMECUADOR_ATM.GESTION
	WHERE
	FECHA_GESTION BETWEEN '$fechaInicial' AND '$fechaFinal'
	AND COD_AGENTE = '$agente'
	AND (RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO'
	OR RESPUESTA_OBTENIDA = 'LOCALIZADO SIN ACUERDO'
	OR RESPUESTA_OBTENIDA = 'RECLAMO VENDIO VEHICULO'
	OR RESPUESTA_OBTENIDA = 'RENUENTE'
	OR RESPUESTA_OBTENIDA = 'RECLAMO'
	OR RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO')";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	

	$a = 0;
	while ( $fila2 = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		$arreglobi[ $a ][ 0 ] = $fila2[ 0 ];
		
		$a++;

	}

	$m = $arreglobi;
	echo json_encode( $m );
	break;
	case 'general':
	
	$consulta_mysql4 = "SELECT 
	NOMBRES,
	RESPUESTA_OBTENIDA,
	FECHA_GESTION,
	NRO_IDENTIFICACION_CLIENTE,
	NUMERO_GESTION,
	FECHA_PAGO_PROMESA,
	VALOR_PROMESA,
	COMENTARIOS_GESTIONO
	FROM
	SISTEMECUADOR_ATM.GESTION,
	biggestion.agentes
	WHERE
	COD_AGENTE = CODIGO and
	FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	

	while ( $data = mysqli_fetch_assoc( $resultado_consulta_mysql4 ) ) {

		$arreglo["data"][]=$data;
		
	}

	echo json_encode($arreglo);
	break;
	case 'cant_cliente':
	
	
	if ($ced_agente == 3016 || $ced_agente == 3005 || $ced_agente == 3023 ){
		$agente = "D02".$ced_agente;
	}else{
		$agente = "D01".$ced_agente;
	}
	date_default_timezone_set( 'America/Guayaquil' );
	$fechaInicial = strftime( "%Y-%m-%d", time() );
	$fechaFinal = date( 'Y-m-d', strtotime( "$fechaFinal + 1 day" ) );
	$consulta_mysql4 = "SELECT 
	COUNT(distinct NRO_IDENTIFICACION_CLIENTE) as cant_clientes
	FROM
	SISTEMECUADOR_ATM.GESTION
	WHERE
	COD_AGENTE = '$agente'
	AND FECHA_GESTION BETWEEN '$fechaInicial' AND '$fechaFinal'";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	$a = 0;
	while ( $fila2 = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		$arreglobi[ $a ][ 0 ] = $fila2[ 0 ];
		
		$a++;

	}

	$m = $arreglobi;
	echo json_encode( $m );
	break;
	
	case 'num_llamadas':
	
	if ($ced_agente == 3016 || $ced_agente == 3005 || $ced_agente == 3023 ){
		$agente = "D02".$ced_agente;
	}else{
		$agente = "D01".$ced_agente;
	}
	date_default_timezone_set( 'America/Guayaquil' );
	$fechaInicial = strftime( "%Y-%m-%d", time() );
	$fechaFinal = date( 'Y-m-d', strtotime( "$fechaFinal + 1 day" ) );
	$consulta_mysql4 = "SELECT 
	COUNT(NRO_IDENTIFICACION_CLIENTE) as cant_clientes
	FROM
	SISTEMECUADOR_ATM.GESTION
	WHERE
	COD_AGENTE = '$agente'
	AND FECHA_GESTION BETWEEN '$fechaInicial' AND '$fechaFinal'";
	
	$conn4->set_charset('utf8');
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	$a = 0;
	while ( $fila2 = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		$arreglobi[ $a ][ 0 ] = $fila2[ 0 ];
		
		$a++;

	}

	$m = $arreglobi;
	echo json_encode( $m );
	break;
	case 'productividad':
	
	$consulta_mysql4 = "SELECT 
	tabla2.FECHA_GESTION,
	tabla1.NOMBRES,
	tabla2.cant_llamadas,
	tabla2.cant_clientes,
	tabla1.LLAMADAS_PRODUCTIVAS
	
	FROM
	(SELECT 
	SISTEMECUADOR_ATM.GESTION.COD_AGENTE AS COD_AGENTE,
	biggestion.agentes.NOMBRES AS NOMBRES,
	COUNT(RESPUESTA_OBTENIDA) AS LLAMADAS_PRODUCTIVAS
	FROM
	SISTEMECUADOR_ATM.GESTION, biggestion.agentes
	WHERE
	SISTEMECUADOR_ATM.GESTION.COD_AGENTE = biggestion.agentes.CODIGO AND
	FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'
	AND (RESPUESTA_OBTENIDA = 'ACUERDO DE PAGO'
	OR RESPUESTA_OBTENIDA = 'LOCALIZADO SIN ACUERDO'
	OR RESPUESTA_OBTENIDA = 'RECLAMO VENDIO VEHICULO'
	OR RESPUESTA_OBTENIDA = 'RENUENTE'
	OR RESPUESTA_OBTENIDA = 'RECLAMO'
	OR RESPUESTA_OBTENIDA = 'ACUERDO DE CONVENIO')
	GROUP BY COD_AGENTE) AS tabla1
	INNER JOIN
	(SELECT 
	FECHA_GESTION,
	COD_AGENTE,
	COUNT(DISTINCT NRO_IDENTIFICACION_CLIENTE) AS cant_clientes,
	COUNT(NRO_IDENTIFICACION_CLIENTE) AS cant_llamadas
	FROM
	SISTEMECUADOR_ATM.GESTION
	WHERE
	FECHA_GESTION BETWEEN '$fecha_ini' AND '$fecha_fin'
	GROUP BY COD_AGENTE) AS tabla2 ON tabla1.COD_AGENTE = tabla2.COD_AGENTE;";
	
	$resultado_consulta_mysql4 = $conn4->query( $consulta_mysql4 );
	mysqli_close( $conn4 );

	
	while ( $data = mysqli_fetch_array( $resultado_consulta_mysql4 ) ) {
		$arreglo["data"][]=$data;
		
	}

	echo json_encode( $arreglo );
	break;
	
	default:
		# code...
	break;
}
?>