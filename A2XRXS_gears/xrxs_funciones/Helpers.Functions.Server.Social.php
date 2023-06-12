<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1003-019).');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Envio de mensajes whatsapp
*
*===========================     Detalles    ===========================
* Permite el envio de mensajes whatsapp a traves de chat-api
*===========================    Modo de uso  ===========================
*
* 	//se obtiene dato
* 	WhatsappSendMessage('asdertcvbtrtr', '356644', '569122345678', 'test');
*
*===========================    Parametros   ===========================
* String   $Token        Token de la plataforma
* String   $InstanceId   Instancia a utilizar
* String   $Phone        Telefono a enviar el mensaje
* String   $Body         mensaje
* @return  Date
************************************************************************/
//Funcion
function WhatsappSendMessage($Token, $InstanceId, $Phone, $Body){
	/**************************************/
	//Normalizo el mensaje
	$saltoLinea = '
';

	$vowels_1 = array('<br/>', '<br>', '</br>');
	$vowels_2 = array('<strong>', '</strong>');
	$Body = str_replace($vowels_1, $saltoLinea, $Body);
	$Body = str_replace($vowels_2, '*', $Body);

	/**************************************/
	//verifico si numero comienza con +56 o con 56
	$myNumber = $Phone;
	$findme_1 = '+';
	$findme_2 = '+56';
	$findme_3 = '56';

	$pos_1 = strpos($myNumber, $findme_1);
	$pos_2 = strpos($myNumber, $findme_2);
	$pos_3 = strpos($myNumber, $findme_3);

	//si comienza con el +
	if ($pos_1 !== false && $pos_1==0) {
		//comienza con el +56
		if ($pos_2 !== false && $pos_2==0) {
			$myPhone = $Phone;
		//no comienza con el +56, es otro numero
		} else {
			$myPhone = '';
		}
	//no comienza por el +
	} else {
		//comienza con el 56
		if ($pos_3 !== false && $pos_3==0) {
			$myPhone = '+'.$Phone;
		//no comienza con el 56, es otro numero
		} else {
			$myPhone = '+56'.$Phone;
		}
	}

	/**************************************/
	//verifico la existencia de datos
	if(isset($myPhone)&&$myPhone!=''&&isset($InstanceId)&&$InstanceId!=''&&isset($Token)&&$Token!=''){
		$data = [
			'phone' => $myPhone, // Receivers phone
			'body' => $Body, // Message
		];
		$json = json_encode($data); // Encode data to JSON
		// URL for request POST /message

		//$url = 'https://api.chat-api.com/instance'.$InstanceId.'/sendMessage?token='.$Token;
		$url = 'https://api.1msg.io/'.$InstanceId.'/sendMessage?token='.$Token;

		// Make a POST request
		$options = stream_context_create(['http' => [
				'method'  => 'POST',
				'header'  => 'Content-type: application/json',
				'content' => $json
			]
		]);
		// Send a request
		try {
			$result = file_get_contents($url, false, $options);
			//return $result;
		} catch (Exception $e) {
			error_log("===============================================", 0);
			error_log("myPhone:".$myPhone, 0);
			error_log("Body:".$Body, 0);
			error_log("InstanceId:".$InstanceId, 0);
			error_log("Token:".$Token, 0);
			error_log("url:".$url, 0);
			error_log("Excepción capturada:".$e->getMessage(), 0);
			error_log("===============================================", 0);
		}

	//guardo el log
	}else{
		error_log("===============================================", 0);
		error_log("myPhone:".$myPhone, 0);
		error_log("InstanceId:".$InstanceId, 0);
		error_log("Token:".$Token, 0);
		error_log("===============================================", 0);
	}

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Envio de mensajes a un grupo whatsapp
*
*===========================     Detalles    ===========================
* Permite el envio de mensajes a grupos de whatsapp a traves de chat-api
*===========================    Modo de uso  ===========================
*
* 	//se obtiene dato
* 	WhatsappGroupSendMessage('asdertcvbtrtr', '356644', 'groupTest', 'test');
*
*===========================    Parametros   ===========================
* String   $Token        Token de la plataforma
* String   $InstanceId   Instancia a utilizar
* String   $Phone        Telefono a enviar el mensaje
* String   $Body         mensaje
* @return  Date
************************************************************************/
//Funcion
function WhatsappGroupSendMessage($Token, $InstanceId, $Group, $Body){

	/**************************************/
	//verifico la existencia de datos
	if(isset($Group)&&$Group!=''&&isset($InstanceId)&&$InstanceId!=''&&isset($Token)&&$Token!=''){
		$data = [
			'chatId' => $Group, // Receivers phone
			'body' => $Body, // Message
		];
		$json = json_encode($data); // Encode data to JSON
		// URL for request POST /message

		$url = 'https://api.chat-api.com/instance'.$InstanceId.'/sendMessage?token='.$Token;
		// Make a POST request
		$options = stream_context_create(['http' => [
				'method'  => 'POST',
				'header'  => 'Content-type: application/json',
				'content' => $json
			]
		]);
		// Send a request
		$result = file_get_contents($url, false, $options);

		/*error_log("===============================================", 0);
		error_log("Group:".$Group, 0);
		error_log("InstanceId:".$InstanceId, 0);
		error_log("Token:".$Token, 0);
		error_log("url:".$url, 0);
		error_log("result:".$result, 0);
		error_log("===============================================", 0);*/

		//return $result;
	//guardo el log
	}else{
		error_log("===============================================", 0);
		error_log("Group:".$Group, 0);
		error_log("InstanceId:".$InstanceId, 0);
		error_log("Token:".$Token, 0);
		error_log("===============================================", 0);
	}

}


?>
