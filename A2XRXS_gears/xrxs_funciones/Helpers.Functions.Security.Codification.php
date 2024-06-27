<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1003-014).');
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
* con la opción de la utilizacion de una palabra clave para su codificacion
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
function simpleEncode($simple_string, $passkey) {
    /**************************************/
    if (!$simple_string) {
        return false;
    }
    /**************************************/
    if (!isset($passkey) OR empty($passkey) OR $passkey=='') {
        $encryption_key = sha1('EnCRypT10nK#Y!RiSRNn');
    }else{
		$encryption_key = $passkey;
	}
    /**************************************/
    //variables
    $ciphering     = "AES-128-CTR";// Store the cipher method
    $iv_length     = openssl_cipher_iv_length($ciphering);// Use OpenSSl Encryption method
    $options       = 0;
    $encryption_iv = '1234567891011121';// Non-NULL Initialization Vector for encryption
    // Use openssl_encrypt() function to encrypt the data
    $encryption    = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    /**************************************/
    //devuelvo
    return $encryption;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Decodifica un texto
*
*===========================     Detalles    ===========================
* Permite decodificar un texto para que quede legible a la lectura normal,
* con la opción de la utilizacion de una palabra clave para su
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
function simpleDecode($simple_string, $passkey) {
    if (!$simple_string) {
        return false;
    }
    if (!isset($passkey) OR empty($passkey) OR $passkey=='') {
        $decryption_key = sha1('EnCRypT10nK#Y!RiSRNn');
    }else{
		$decryption_key = $passkey;
	}
    /**************************************/
    //variables
    $ciphering     = "AES-128-CTR";// Store the cipher method
    $iv_length     = openssl_cipher_iv_length($ciphering);// Use OpenSSl Encryption method
    $options       = 0;
    $decryption_iv = '1234567891011121';// Non-NULL Initialization Vector for encryption
    // Use openssl_encrypt() function to encrypt the data
    $decryption    = openssl_decrypt ($simple_string, $ciphering, $decryption_key, $options, $decryption_iv);
    /**************************************/
    //devuelvo
    return $decryption;
}

//Codificacion propia por cada servidor, esto impide el copiado de información entre servidores
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
* con la opción de la utilizacion de una palabra clave para su
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
