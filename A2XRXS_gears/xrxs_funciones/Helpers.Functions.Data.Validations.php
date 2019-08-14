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
/*******************************************************************************************************************/
// Validador de RUT con digito verificador 
function RutValidate($rut) {
    $rut=str_replace('.', '', $rut);
    if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$rut,$d)) {
        $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
        return chr($s?$s+47:75)==strtoupper($d[2]);
    }   
}
/*******************************************************************************************************************/
/*Valida el email, el formato y si es un correo real
 * Modo de Uso:
 * validateEmail("user@gmail.com");
 * devuelve true o false
 * */
function validaremail($address, $tempEmailAllowed = true){ 
	if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$}',$address)){
        return FALSE; 
    }else { 
		strpos($address, '@') ? list(, $mailDomain) = explode('@', $address) : $mailDomain = null;
        if (filter_var($address, FILTER_VALIDATE_EMAIL) &&
            !is_null($mailDomain) &&
            checkdnsrr($mailDomain, 'MX')
        ) {
            if ($tempEmailAllowed) {
                return true;
            } else {
                $handle = fopen(__DIR__.'/banned.txt', 'r');
                $temp = [];
                while (($line = fgets($handle)) !== false) {
                    $temp[] = trim($line);
                }
                if (in_array($mailDomain, $temp)) {
                    return false;
                }
                return true;
            }
        }
        return false; 
	}
}
/*******************************************************************************************************************/
//esta funcion valida el numero
function validarnumero($numero){ 
	if($numero=='0'){
		return FALSE; 
	}else{
		//si es numerico no hace nada
		if(is_numeric($numero)) {
		   return FALSE; 
		//si es texto alerta
		} else {
			return TRUE;
		}
	}
}
/*******************************************************************************************************************/
//Validar patente vehicular
function ValidaPatente($patente){
	//elimino los posibles guones
	$value = str_replace("-","",$patente);
 	//caracteres admitidos
 	$regex = '/^[a-z]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}|[b-d,f-h,j-l,p,r-t,v-z]{2}[\-\. ]?[b-d,f-h,j-l,p,r-t,v-z]{2}[\.\- ]?[0-9]{2}$/i';
	//valida formato
	if (preg_match($regex, $patente)){
	  return "";
	}else{
	  return "Patente incorrecta o con formato incorrecto";
	}
}
/*******************************************************************************************************************/
/*Valida si la URL ingresada es valida o no*/
function validateURL($url){
    return (bool) filter_var($url, FILTER_VALIDATE_URL);
}
/*******************************************************************************************************************/
/*Detecta si la pagina es HTTPS
 * Modo de Uso
 * $isHttps = isHttps();
 * var_dump($isHttps);
 * outputs: TRUE - FALSE
 * */
function isHttps(){
    return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}
/*******************************************************************************************************************/
/*Detecta si la pagina es AJAX
 * Modo de Uso
 * $isAjax = isAjax();
 * var_dump($isHttps);
 * outputs: TRUE - FALSE
 * */
function isAjax(){
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;
}
/*******************************************************************************************************************/
/*Detecta si la pagina es AJAX
 * Modo de Uso
 * $isAjax = isAjax();
 * var_dump($isHttps);
 * outputs: TRUE - FALSE
 * */
function validaHora($time, $format='H:i:s') {
    $d = DateTime::createFromFormat("Y-m-d $format", "2017-12-01 $time");
    return $d && $d->format($format) == $time;
}
function validaFecha($date, $format = 'Y-m-d'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}
function validaEntero($input){
    return(ctype_digit(strval($input)));
}
 
?>
