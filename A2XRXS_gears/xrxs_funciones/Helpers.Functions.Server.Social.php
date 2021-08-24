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
	$data = [
		'phone' => $Phone, // Receivers phone
		'body' => $Body, // Message
	];
	$json = json_encode($data); // Encode data to JSON
	// URL for request POST /message
	$token      = $Token;
	$instanceId = $InstanceId;
	$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
	// Make a POST request
	$options = stream_context_create(['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $json
		]
	]);
	// Send a request
	$result = file_get_contents($url, false, $options);
	
	return $result;
}

?>
