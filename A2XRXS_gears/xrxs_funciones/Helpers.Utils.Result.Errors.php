<?php
//variables
$idUsuario   = $_SESSION['usuario']['basic_data']['idUsuario'];
$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
$Fecha       = fecha_actual();
$Transaccion = $original;
$email       = DB_ERROR_MAIL;
$MailBody    = '';
$CountError  = 0;


//despliego los errores
if($err_count!=0){
	
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
		//imprimo los errores
		echo '<p><strong>MySQL error '.$ErrorCode.' :</strong>'.$Mensaje.'</p>'; 
		echo '<pre>'.$Consulta.'</pre>';
		
		/***************************************/
		//guardo errores en el log
		error_log("Error code: ". $ErrorCode, 0);
		error_log("Error description: ". $Mensaje, 0);
		error_log("Error query: ". $Consulta, 0);
		error_log("-------------------------------------------------------------------", 0);
		
		
		/***************************************/
		//inserto en la tabla de errores
		if(isset($idUsuario) && $idUsuario != ''){  $a  = "'".$idUsuario."'" ;   }else{$a  = "''";}
		if(isset($Fecha) && $Fecha != ''){          $a .= ",'".$Fecha."'" ;      }else{$a .= ",''";}
		if(isset($ErrorCode) && $ErrorCode != ''){  $a .= ",'".$ErrorCode."'" ;  }else{$a .= ",''";}
		if(isset($Mensaje) && $Mensaje != ''){      $a .= ",'".$Mensaje."'" ;    }else{$a .= ",''";}
		if(isset($Consulta) && $Consulta != ''){    $a .= ",'".$Consulta."'" ;   }else{$a .= ",''";}
		
		// inserto los datos de registro en la db
		$query  = "INSERT INTO `error_log` (idUsuario, Fecha, ErrorCode, Mensaje, Consulta) 
		VALUES ({$a} )";
		$result = mysqli_query($dbConn, $query);
		
		/***************************************/
		//Genero el cuerpo del mensaje
		$MailBody.= '<p><strong>MySQL error '.$ErrorCode.' :</strong>'.$Mensaje.'</p>'; 
		$MailBody.= '<pre>'.$Consulta.'</pre>';
		$MailBody.= '<br/><br/>';
		
		//Cuento los errores generados
		$CountError++;
	}
	
}

//Si se genera cuerpo para el correo, se envia el mensaje a soporte
if(isset($MailBody)&&$MailBody!=''&&$CountError!=0){
	
	/*********************************/
	//Si se necesita se envia correo
	require_once '../LIBS_php/PHPMailer/PHPMailerAutoload.php';
		
	/*********************************/
	//Busco al usuario en el sistema
	$query = "SELECT 
	core_sistemas.Nombre AS RazonSocial,
	core_sistemas.email_principal AS email_principal
	FROM `usuarios_listado` 
	LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = usuarios_listado.idSistema
	WHERE usuarios_listado.idUsuario = '".$idUsuario."'";
	$resultado = mysqli_query($dbConn, $query);
	$rowUser = mysqli_fetch_array($resultado);

	/*********************************/
	//compruebo que exista correo
	if(isset($rowUser['email_principal'])&&$rowUser['email_principal']!=''){
		//Instanciacion
		$mail = new PHPMailer;
		//Quien envia el correo
		$mail->setFrom($rowUser['email_principal'], $rowUser['RazonSocial']);
		//A quien responder el correo
		$mail->addReplyTo($rowUser['email_principal'], $rowUser['RazonSocial']);
		//Destinatarios
		$mail->addAddress($email, 'Receptor');
		//Asunto
		$mail->Subject = 'Error Sistema '.$rowUser['RazonSocial'];
		//Cuerpo del mensaje
		$mail->msgHTML($MailBody);
		//Datos Adjuntos
		//$mail->addAttachment('images/phpmailer_mini.png');
		//Envio del mensaje
		if (!$mail->send()) {
			error_log("Error envio correo: ".$mail->ErrorInfo, 0);
		} else {
			error_log("Correo enviado", 0);
		}
	}else{
		error_log("No esta configurado el correo para el envio de errores", 0);
	}
	
}
//borro todos los errores para evitar duplicarlos
unset($_SESSION['ErrorListing']);


?>
