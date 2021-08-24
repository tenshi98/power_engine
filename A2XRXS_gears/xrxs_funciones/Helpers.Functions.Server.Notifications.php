<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Envio Correos
* 
*===========================     Detalles    ===========================
* Permite enviar correos a todos los usuarios
*===========================    Modo de uso  ===========================
* 	
* 	//Envio de correo
*	$rmail = tareas_envio_correo('jperez@mail.com', 'Juan Perez', 
*                                'malvarez@mail.com', 'Marisol Alvarez', 
*                                'jefatura@mail.com', 'respaldo@mail.com', 
*                                'Notificacion', 
*                                '<p>Cuerpo mensaje</p>','Cuerpo mensaje', 
*                                'upload/archivo adjunto.jpg');
*   //Envio del mensaje
*	if ($rmail!=1) {
*		
*	} else {
*		
*	}
* 
*===========================    Parametros   ===========================
* String    $tarea    Direccion web con lo que se tiene que ejecutar 
*                     en el servidor, entregar URL completas
************************************************************************/
//Funcion
function tareas_envio_correo($De_correo, $De_nombre, 
                             $Hacia_correo, $Hacia_nombre, 
                             $CopiaCarbon, $CopiaCarbonOculta, 
                             $Asunto, 
                             $CuerpoHTML,$CuerpoNoHTML, 
                             $Adjuntos,
                             $lvl,
							 $GmailUsername,
							 $GmailPassword){
	
	//valido que exista correo
	if(isset($De_correo)&&isset($Hacia_correo)){
		//valido que los correos sean validos
		if(validarEmail($De_correo)&&validarEmail($Hacia_correo)){
			//verifico si los envio por gmail
			if(isset($GmailUsername)&&$GmailUsername!=''&&isset($GmailPassword)&&$GmailPassword!=''){
				
				tareas_envio_correo_google($GmailUsername, $De_nombre, 
											$Hacia_correo, $Hacia_nombre, 
											$CopiaCarbon, $CopiaCarbonOculta, 
											$Asunto, 
											$CuerpoHTML,$CuerpoNoHTML, 
											$Adjuntos,
											$lvl,
											$GmailUsername,
											$GmailPassword);
			//si no se envian por gmail
			}else{
				
				/********************************************************/
				//Definicion de errores
				$errorn = 0;
				//se definen los errores
				if($De_correo==''){      $errorn++;$error = 'No ha ingresado el correo origen';}
				if($Hacia_correo==''){   $errorn++;$error = 'No ha ingresado el correo destino';}
				if($CuerpoHTML==''){     $errorn++;$error = 'No ha ingresado el mensaje';}
				//si no se sabe a quien va se modifica el nombre
				if($De_nombre==''){      $De_nombre='Contacto';}    //$errorn++;$error = 'No ha ingresado el nombre origen';}
				if($Hacia_nombre==''){   $Hacia_nombre='Contacto';} //$errorn++;$error = 'No ha ingresado el nombre destino';}
				
				/********************************************************/
				//Ejecucion si no hay errores
				if($errorn==0){

					//Se cargan archivos para el envio de correos
					switch ($lvl) {
						case 1:
							require_once '../LIBS_php/PHPMailer/src/PHPMailer.php';
							require_once '../LIBS_php/PHPMailer/src/SMTP.php';
							require_once '../LIBS_php/PHPMailer/src/Exception.php';
							break;
						case 2:
							require_once '../../LIBS_php/PHPMailer/src/PHPMailer.php';
							require_once '../../LIBS_php/PHPMailer/src/SMTP.php';
							require_once '../../LIBS_php/PHPMailer/src/Exception.php';
							break;
					}

					//Instanciacion
					$mail = new PHPMailer\PHPMailer\PHPMailer(true);

					try {
						//Datos de envio
						$mail->CharSet = 'UTF-8';
						$mail->setFrom($De_correo, $De_nombre);                          //Quien envia el correo
						$mail->addAddress($Hacia_correo, $Hacia_nombre);                 //Destinatario
						$mail->addReplyTo($De_correo, $De_nombre);                       //A quien responder el correo
						if($CopiaCarbon!=''){$mail->addCC($CopiaCarbon);}                //Copia Carbon
						if($CopiaCarbonOculta!=''){$mail->addBCC($CopiaCarbonOculta);}   //Copia Carbon oculta
						
						//Adjuntos
						if($Adjuntos!=''){
							$mail->addAttachment($Adjuntos);  // Datos Adjuntos
						}

						//Cuerpo del mensaje
						$mail->isHTML(true);                                    //Se setea para enviar html
						$mail->Subject = $Asunto;                               //Asunto
						if($CuerpoHTML!=''){  $mail->Body    = $CuerpoHTML;}    //Cuerpo HTML
						if($CuerpoNoHTML!=''){$mail->AltBody = $CuerpoNoHTML;}  //Cuerpo No HTML

						$mail->send();
						
						//error_log("/***************************************************************/", 0);
						//error_log("DE:".$De_correo, 0);
						//error_log("HACIA:".$Hacia_correo, 0);
						//error_log("ASUNTO:".$Asunto, 0);
						//error_log("/***************************************************************/", 0);
						
						return 1;
					} catch (Exception $e) {
						return $mail->ErrorInfo;
					}
					
				}else{
					error_log("/***************************************************************/", 0);
					error_log("Mail Error:".$error, 0);
					error_log("/***************************************************************/", 0);
					
					return $error;
				}
			}
			
		}else{
			error_log("/***************************************************************/", 0);
			if(!validarEmail($De_correo)){    error_log("Mail Error:El Email (De: ".$De_correo.") ingresado no es valido", 0);}
			if(!validarEmail($Hacia_correo)){ error_log("Mail Error:El Email (Hacia: ".$Hacia_correo.") ingresado no es valido", 0);}
			error_log("/***************************************************************/", 0);
			
			return $error;
		}
	}else{
		error_log("/***************************************************************/", 0);
		if(!isset($De_correo)){    error_log("Mail Error:No ha ingresado Email (De)", 0);}
		if(!isset($Hacia_correo)){ error_log("Mail Error:No ha ingresado Email (Hacia)", 0);}
		
		error_log("/***************************************************************/", 0);
			
		return $error;
	}	
			
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Envio Correos
* 
*===========================     Detalles    ===========================
* Permite enviar correos a todos los usuarios a traves de un servicio google
*===========================    Modo de uso  ===========================
* 	
* 	//Envio de correo
*	$rmail = tareas_envio_correo_google('jperez@mail.com', 'Juan Perez', 
*                                		'malvarez@mail.com', 'Marisol Alvarez', 
*                                		'jefatura@mail.com', 'respaldo@mail.com', 
*                                		'Notificacion', 
*                                		'<p>Cuerpo mensaje</p>','Cuerpo mensaje', 
*                                		'upload/archivo adjunto.jpg',
*                                       'jperez@mail.com', 
*                                       '123456');
*   //Envio del mensaje
*	if ($rmail!=1) {
*		
*	} else {
*		
*	}
* 
*===========================    Parametros   ===========================
* String    $tarea    Direccion web con lo que se tiene que ejecutar 
*                     en el servidor, entregar URL completas
************************************************************************/
//Funcion
function tareas_envio_correo_google($De_correo, $De_nombre, 
									$Hacia_correo, $Hacia_nombre, 
									$CopiaCarbon, $CopiaCarbonOculta, 
									$Asunto, 
									$CuerpoHTML,$CuerpoNoHTML, 
									$Adjuntos,
									$lvl,
									$GmailUsername,
									$GmailPassword){
	
	/********************************************************/
	//Definicion de errores
	$errorn = 0;
	//se definen los errores
	if($De_correo==''){      $errorn++;$error = 'No ha ingresado el correo origen';}
	if($De_nombre==''){      $errorn++;$error = 'No ha ingresado el nombre origen';}
	if($Hacia_correo==''){   $errorn++;$error = 'No ha ingresado el correo destino';}
	if($Hacia_nombre==''){   $errorn++;$error = 'No ha ingresado el nombre destino';}
	if($CuerpoHTML==''){     $errorn++;$error = 'No ha ingresado el mensaje';}
	if($GmailUsername==''){  $errorn++;$error = 'No ha ingresado el usuario de Gmail';}
	if($GmailPassword==''){  $errorn++;$error = 'No ha ingresado la contraseña del usuario de Gmail';}
	

	/********************************************************/
	//Ejecucion si no hay errores
	if($errorn==0){

		//Se cargan archivos para el envio de correos
		switch ($lvl) {
			case 1:
				require_once '../LIBS_php/PHPMailer/src/PHPMailer.php';
				require_once '../LIBS_php/PHPMailer/src/SMTP.php';
				require_once '../LIBS_php/PHPMailer/src/Exception.php';
				break;
			case 2:
				require_once '../../LIBS_php/PHPMailer/src/PHPMailer.php';
				require_once '../../LIBS_php/PHPMailer/src/SMTP.php';
				require_once '../../LIBS_php/PHPMailer/src/Exception.php';
				break;
		}


		//Instanciacion
		$mail = new PHPMailer\PHPMailer\PHPMailer(true);

		try {
			
			$mail->CharSet = 'UTF-8';
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use -> ssl
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = $GmailUsername;
			//Password to use for SMTP authentication
			$mail->Password = $GmailPassword;
			
			
			//Datos de envio
			$mail->setFrom($De_correo, $De_nombre);                          //Quien envia el correo
			$mail->addAddress($Hacia_correo, $Hacia_nombre);                 //Destinatario
			$mail->addReplyTo($De_correo, $De_nombre);                       //A quien responder el correo
			if($CopiaCarbon!=''){$mail->addCC($CopiaCarbon);}                //Copia Carbon
			if($CopiaCarbonOculta!=''){$mail->addBCC($CopiaCarbonOculta);}   //Copia Carbon oculta
			
			//Adjuntos
			if($Adjuntos!=''){
				$mail->addAttachment($Adjuntos);  // Datos Adjuntos
			}

			//Cuerpo del mensaje
			$mail->isHTML(true);                                    //Se setea para enviar html
			$mail->Subject = $Asunto;                               //Asunto
			if($CuerpoHTML!=''){  $mail->Body    = $CuerpoHTML;}    //Cuerpo HTML
			if($CuerpoNoHTML!=''){$mail->AltBody = $CuerpoNoHTML;}  //Cuerpo No HTML

			$mail->send();
			
			//error_log("/***************************************************************/", 0);
			//error_log("DE:".$De_correo, 0);
			//error_log("HACIA:".$Hacia_correo, 0);
			//error_log("ASUNTO:".$Asunto, 0);
			//error_log("/***************************************************************/", 0);
			
			return 1;
		} catch (Exception $e) {
			error_log("/***************************************************************/", 0);
			error_log("GMail Error:".$mail->ErrorInfo, 0);
			error_log("/***************************************************************/", 0);
			return $mail->ErrorInfo;
		}
		
	}else{
		error_log("/***************************************************************/", 0);
		error_log("GMail Error:".$error, 0);
		error_log("/***************************************************************/", 0);
			
		return $error;
	}		
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Envio Mensaje Push
* 
*===========================     Detalles    ===========================
* Permite enviar mensajes o notificaciones a las aplicaciones android
*===========================    Modo de uso  ===========================
* 	
* 	//Envio de correo
*	$rmail = envio_mensaje_push('jperez@mail.com', 'Juan Perez', 
*                                'malvarez@mail.com', 'Marisol Alvarez', 
*                                'jefatura@mail.com', 'respaldo@mail.com', 
*                                'Notificacion', 
*                                '<p>Cuerpo mensaje</p>','Cuerpo mensaje', 
*                                'upload/archivo adjunto.jpg');
*   //Envio del mensaje
*	if ($rmail!=1) {
*		
*	} else {
*		
*	}
* 
*===========================    Parametros   ===========================
* String    $tarea    Direccion web con lo que se tiene que ejecutar 
*                     en el servidor, entregar URL completas
************************************************************************/
//Funcion
function envio_mensaje_push($title, $message, $action, $firebase_token, $firebase_api, 
                            $imageUrl, $actionDestination){
	
	$url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array (
			'to' => $firebase_token,
			'data' => array (
					"title" => $title,
					"body" => $message,
					"image" => $imageUrl,
					"action" => $action,
					"action_destination" => $actionDestination
			)
	);
        
	$fields = json_encode ( $fields );
	$headers = array (
			'Authorization: key='.$firebase_api,
			'Content-Type: application/json'
	);

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

	$result = curl_exec ( $ch );
	curl_close ( $ch );
							 
}

?>
