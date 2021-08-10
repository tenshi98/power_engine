<?php

//Verifico la existencia de errores
$err_count = 0;
foreach($_SESSION['ErrorListing'] as $producto) {
	$err_count++;
}

//despliego los errores
if($err_count!=0){
	//variables
	$idUsuario   = $_SESSION['usuario']['basic_data']['idUsuario'];
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$idSistema   = $_SESSION['usuario']['basic_data']['idSistema'];
	$Fecha       = fecha_actual();
	$Hora        = hora_actual();
	$Transaccion = $original;
	$email       = DB_ERROR_MAIL;
	$MailBody    = '';
	$CountError  = 0;

	//Titulo del cuerpo del correo
	$MailBody.= '<p><strong>Usuario :</strong>'.$NombreUsr.'</p>'; 
	$MailBody.= '<p><strong>Transaccion :</strong>'.$Transaccion.'</p>'; 
	$MailBody.= '<br/>';	
	
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	
	//recorro los errores
	foreach($_SESSION['ErrorListing'] as $producto) {
		
		$ErrorCode   = limpiarString($producto['code']);
		$Mensaje     = limpiarString($producto['description']);
		$Consulta    = $producto['query'];
		
		/***************************************/
		//solo si es administrador
		if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
			//imprimo los errores
			echo '<p><strong>MySQL error '.$ErrorCode.' :</strong>'.$Mensaje.'</p>'; 
			echo '<pre>'.$Consulta.'</pre>';
		}
		
		/***************************************/
		//guardo errores en el log
		error_log("Error code: ". $ErrorCode, 0);
		error_log("Error description: ". $Mensaje, 0);
		error_log("Error query: ". $Consulta, 0);
		error_log("-------------------------------------------------------------------", 0);
		
		/***************************************/
		//Genero el cuerpo del mensaje
		$MailBody.= '<p><strong>MySQL error '.$ErrorCode.' :</strong>'.$Mensaje.'</p>'; 
		$MailBody.= '<pre>'.$Consulta.'</pre>';
		$MailBody.= '<br/><br/>';
		
		/***************************************/
		//se limpia la cadena antes de guardarla
		$Consulta = preg_replace("/[\r\n|\n|\r]+/", " ", $Consulta);
		
		//Cuerpo del log
		$rmail         = '';
		$sesion_texto  = '';
		$sesion_texto .= fecha_estandar($Fecha);
		$sesion_texto .= ' /\ '.$Hora;
		$sesion_texto .= ' /\ '.$NombreUsr;
		$sesion_texto .= ' /\ '.$Transaccion;
		$sesion_texto .= ' /\ '.'Helper utils error';
		$sesion_texto .= ' /\ '.$ErrorCode;
		$sesion_texto .= ' /\ '.$Mensaje;
		$sesion_texto .= ' /\ '.$Consulta;
				
		//se guarda el log
		log_response(3, $rmail, $sesion_texto);	
		
		//Cuento los errores generados
		$CountError++;
	}
	
}

//Si se genera cuerpo para el correo, se envia el mensaje a soporte
if(isset($MailBody)&&$MailBody!=''&&$CountError!=0){
	
	/*********************************/
	//Busco al usuario en el sistema
	$query = "SELECT Nombre AS RazonSocial, email_principal,Config_Gmail_Usuario, Config_Gmail_Password
	FROM `core_sistemas` 
	WHERE idSistema = '".$idSistema."'";
	$resultado = mysqli_query($dbConn, $query);
	$rowUser = mysqli_fetch_array($resultado);

	/*********************************/
	//compruebo que exista correo
	if(isset($rowUser['email_principal'])&&$rowUser['email_principal']!=''){
		//Envio de correo
		$rmail = tareas_envio_correo($rowUser['email_principal'], $rowUser['RazonSocial'], 
                                     $email, 'Receptor', 
                                     '', '', 
                                     'Error Sistema '.$rowUser['RazonSocial'], 
                                     $MailBody,'', 
                                     '', 
                                     1, 
                                     $rowUser['Config_Gmail_Usuario'], 
                                     $rowUser['Config_Gmail_Password']);
	}else{
		error_log("No esta configurado el correo para el envio de errores", 0);
	}
	
}
//borro todos los errores para evitar duplicarlos
unset($_SESSION['ErrorListing']);


?>
