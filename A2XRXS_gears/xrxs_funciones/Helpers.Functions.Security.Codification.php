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
* Codifica un texto
* 
*===========================     Detalles    ===========================
* Permite codificar un texto para que quede ilegible a la lectura normal,
* con la opcion de la utilizacion de una palabra clave para su codificacion
*===========================    Modo de uso  ===========================
* 	
* 	//se codifica texto
* 	simpleEncode("php recipe");
* 
*===========================    Parametros   ===========================
* String   $string   Texto a transformar
* String   $passkey  (Opcional)Palabra clave de codificacion
* @return  String
************************************************************************/ 
//Funcion
function simpleEncode($value, $passkey) {
    if (!$value) {
        return false;
    }
    if (!isset($passkey) OR empty($passkey) OR $passkey=='') {
        $key = sha1('EnCRypT10nK#Y!RiSRNn');
    }else{
		$key = $passkey;
	}
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $crypttext = '';

    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($value, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }

    return $crypttext;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Decodifica un texto
* 
*===========================     Detalles    ===========================
* Permite decodificar un texto para que quede legible a la lectura normal,
* con la opcion de la utilizacion de una palabra clave para su 
* decodificacion
*===========================    Modo de uso  ===========================
* 	
* 	//se decodifica texto
* 	simpleDecode("qcnVhqjKxpuilw==");
* 
*===========================    Parametros   ===========================
* String   $string   Texto a transformar
* String   $passkey  (Opcional)Palabra clave de codificacion
* @return  String
************************************************************************/ 
//Funcion
function simpleDecode($value, $passkey) {
    if (!$value) {
        return false;
    }
    if (!isset($passkey) OR empty($passkey) OR $passkey=='') {
        $key = sha1('EnCRypT10nK#Y!RiSRNn');
    }else{
		$key = $passkey;
	}
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $decrypttext = '';

    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $decrypttext .= chr($ordStr - $ordKey);
    }

    return $decrypttext;
}

//Codificacion propia por cada servidor, esto impide el copiado de informacion entre servidores
function generateServerSpecificHash(){
	return (isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME']))
            ? md5($_SERVER['SERVER_NAME'])
            : md5(pathinfo(__FILE__, PATHINFO_FILENAME));
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Decodifica un texto
* 
*===========================     Detalles    ===========================
* Permite decodificar un texto para que quede legible a la lectura normal,
* con la opcion de la utilizacion de una palabra clave para su 
* decodificacion
*===========================    Modo de uso  ===========================
* 	
* 	// Encriptas id 5008   
* 	$encriptar = encrypt_decrypt('encrypt',5008);
* 	echo $encriptar . '<br>';
* 	
* 	// Desencriptas el id para verlo de manera original
* 	$decriptar = encrypt_decrypt('decrypt',$encriptar);
* 	echo $decriptar;
* 	
* 	//salidas:
* 	bnR6UTRVTHAzYWd1dWEvWVdpMGo4QT09 (corresponde a 5008)
* 	5008 
* 
*===========================    Parametros   ===========================
* String   $string   Texto a transformar
* String   $passkey  (Opcional)Palabra clave de codificacion
* @return  String
************************************************************************/ 
function encrypt_decrypt($action, $string) :string {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key     = 'tu_clave_secreta';
	$secret_iv      = 'salt_secreto';
	// hash
	$key = hash('sha256', $secret_key);    
	// iv - encrypt method AES-256-CBC expects 16 bytes 
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}elseif( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

function token_bin2hex($longitud) {
	$token = bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
	return $token;
}

?>
