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
//Fecha actual
function fecha_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$fecha_actual = date("Y-m-d");
	return $fecha_actual; 
}
/*******************************************************************************************************************/
//Hora actual
function hora_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$hora_actual = date("H:i:s");
	return $hora_actual; 
}
/*******************************************************************************************************************/
//Hora actual
function hora_actual_val(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$hora_actual = date("H-i-s");
	return $hora_actual; 
}
/*******************************************************************************************************************/
//dia actual
function dia_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$dia_actual = date("j");
	return $dia_actual; 
}
/*******************************************************************************************************************/
//semana actual
function semana_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$semana_actual = date("W");
	return $semana_actual; 
}
/*******************************************************************************************************************/
//mes actual
function mes_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$mes_actual = date("n");
	return $mes_actual; 
}
/*******************************************************************************************************************/
//año actual
function ano_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$ano_actual = date("Y");
	return $ano_actual; 
}
/*******************************************************************************************************************/
//Obtengo la IP del cliente que se conecta
function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')){
		$ipaddress = getenv('HTTP_CLIENT_IP');
	}elseif(getenv('HTTP_X_FORWARDED_FOR')){
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	}elseif(getenv('HTTP_X_FORWARDED')){
		$ipaddress = getenv('HTTP_X_FORWARDED');
	}elseif(getenv('HTTP_FORWARDED_FOR')){
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	}elseif(getenv('HTTP_FORWARDED')){
	   $ipaddress = getenv('HTTP_FORWARDED');
	}elseif(getenv('REMOTE_ADDR')){
		$ipaddress = getenv('REMOTE_ADDR');
	}else{
		$ipaddress = 'UNKNOWN';
	}
	return $ipaddress;
}
/*******************************************************************************************************************/
/* <!--
/*############################################################################ 
#                                                                            # 
#Nombre de la funcion: MeDir                                                 # 
#Version de la funcion:  1.0.0.11                                             #  
#Fecha de la funcion (Creacion):  01/06/2006                                 #  
#Fecha de la funcion (revision 1.0.0.4):  19/08/2006                         # 
#Fecha de la funcion (ultima revision):  16/09/2006                          # 
#                                                                            # 
#Autor: SERBice(r) # 
#                                                                            # 
#Descripcion de la funcion: Recorre un directorio midiendo todos los         #
#                           archivos que contiene (incluso en sus            # 
#                           subdirectorios, hasta el ultimo).                # 
#                                                                            # 
#Parametros de la funcion: El parametro $dir, establece el directorio sobre el# 
#                          cual actuara la funcion, es decir, que establece  # 
#                          el directorio del cual se obtendra informacion de # 
#                          su tamaño.                                        #
#                          Si $dir no se establece se utilizara el directorio# 
#                          donde se encuentra el archivo que llamo a la      # 
#                          funcion                                              #  
#                          $subdirs es el parametro que establece si vamos   #
#                          o no a medir en subdirectorios o no. Si $subdirs  #
#                           no se establece su valor por defaul sera 1 y     #
#                           medira los subdirectorios                   # 
#                                                                            # 
#Este Software se distribuye bajo Licencia GPL, por lo cual se solicita que  # 
#se utilice con fines no lucrativos, es decir, que sea de uso Personal y No  # 
#Comercial. Que se conserven los derechos de autor y que cualquier           # 
#modificacion le sea notifiacda al autor, para saber y estar al tanto de     # 
#los avances del software en cuestion; y de esta manera enriquezer aun mas   # 
#esta peque?a herramienta                                                    # 
#                                                                            # 
#Atentamente: SERBice(r)                                                     # 
#                                                                            # 
############################################################################*/ 
function MeDir($dir,$subdirs){ 
        /* Creamos un array con todos los nombres de directorios y 
        archivos contenidos dentro del directorio inicial */ 
        $arr = scandir($dir); 

        /* establecemos que la variable $sizedir es igual a cero */ 
        $sizedir = 0; 

        /* YA NO Recorremos el array saltando los directorios . y .. */ 
        for ($i=0; $i<count($arr); $i++)
            {
                /* Comprobamos que el archivo/directorio actual no sea "." ni ".." */
              if ($arr[$i]!="." && $arr[$i]!="..")
              	{
	                /* Si es un directorio hacer..... */ 
	                if (is_dir($dir ."/". $arr[$i])) 
	                    { 
	                        /* Establecemos que la variable $sizedir es igual 
	                        a ella misma m?s el valor devuelto por MeDir */ 
	                        if (isset($subdirs)&&$subdirs==1) $sizedir += MeDir($dir . "/" . $arr[$i],1); 
	                    } 
	                /* Si es un archivo hacer ... */ 
	                else 
	                    { 
	                        /* Establecemos que la variable $sizedir es igual 
	                        a ella misma m?s el tama?o del fichero $dir ."/". $arr[$i] */ 
	                        $sizedir += filesize($dir ."/". $arr[$i]); 
	                    } 
               }
            } 
        /* Devolvemos el valor total de $sizedir */ 
        return $sizedir; 
}
/*******************************************************************************************************************/
//obtengo la direccion base del sitio
/*
//  url like: http://stackoverflow.com/questions/2820723/how-to-get-base-url-with-php
echo base_url();    //  will produce something like: http://stackoverflow.com/questions/2820723/
echo base_url(TRUE);    //  will produce something like: http://stackoverflow.com/
echo base_url(TRUE, TRUE); || echo base_url(NULL, TRUE);    //  will produce something like: http://stackoverflow.com/questions/
//  and finally
echo base_url(NULL, NULL, TRUE);
//  will produce something like: 
//      array(3) {
//          ["scheme"]=>
//          string(4) "http"
//          ["host"]=>
//          string(12) "stackoverflow.com"
//          ["path"]=>
//          string(35) "/questions/2820723/"
//      }
*/
if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}
/*******************************************************************************************************************/
//Calculo de la carga de trabajo en el servidor
function getServerMemoryUsage($getPercentage=true){
    $memoryTotal = null;
    $memoryFree = null;

    if (stristr(PHP_OS, "win")) {
        // Get total physical memory (this is in bytes)
        $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
        @exec($cmd, $outputTotalPhysicalMemory);

        // Get free physical memory (this is in kibibytes!)
        $cmd = "wmic OS get FreePhysicalMemory";
        @exec($cmd, $outputFreePhysicalMemory);

        if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
            // Find total value
            foreach ($outputTotalPhysicalMemory as $line) {
                if ($line && preg_match("/^[0-9]+\$/", $line)) {
                    $memoryTotal = $line;
                    break;
                }
            }

            // Find free value
            foreach ($outputFreePhysicalMemory as $line) {
                if ($line && preg_match("/^[0-9]+\$/", $line)) {
                    $memoryFree = $line;
                    $memoryFree *= 1024;  // convert from kibibytes to bytes
                    break;
                }
            }
        }
    }else{
        if (is_readable("/proc/meminfo")){
            $stats = @file_get_contents("/proc/meminfo");

            if ($stats !== false) {
                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find correct lines for total and free mem
                foreach ($stats as $statLine) {
                    $statLineData = explode(":", trim($statLine));

                    // Total memory
                    if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
                        $memoryTotal = trim($statLineData[1]);
                        $memoryTotal = explode(" ", $memoryTotal);
                        $memoryTotal = $memoryTotal[0];
                        $memoryTotal *= 1024;  // convert from kibibytes to bytes
                    }

                    // Free memory
                    if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
                        $memoryFree = trim($statLineData[1]);
                        $memoryFree = explode(" ", $memoryFree);
                        $memoryFree = $memoryFree[0];
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                    }
                }
            }
        }
    }

    if (is_null($memoryTotal) || is_null($memoryFree)) {
        return null;
    } else {
        if ($getPercentage) {
            return (100 - ($memoryFree * 100 / $memoryTotal));
        } else {
            return array(
                "total" => $memoryTotal,
                "free" => $memoryFree,
            );
        }
    }
}

function getNiceFileSize($bytes, $binaryPrefix) {
    if ($binaryPrefix==true) {
        $unit=array('B','KiB','MiB','GiB','TiB','PiB');
        if ($bytes==0) return '0 ' . $unit[0];
        return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
    } else {
        $unit=array('B','KB','MB','GB','TB','PB');
        if ($bytes==0) return '0 ' . $unit[0];
        return @round($bytes/pow(1000,($i=floor(log($bytes,1000)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
    }
}
/*******************************************************************************************************************/
//Detecta el tipo de navegador utilizado
function getBrowser(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$ini = '
	<div class="col-xs-12" style="margin-top:15px;">
		<div class="alert alert-danger alert-white rounded"> 
			<div class="icon"><i class="fa fa-exclamation-triangle faa-flash animated "></i></div> 
				Esta utilizando el navegador ';
	$fin = ', Se garantiza el funcionamiento en los navegadores Firefox o Chrome en sus ultimas versiones.
		</div>
	</div>';
	if(strpos($user_agent, 'Maxthon') !== FALSE){
		return $ini.'Maxthon'.$fin;
	}elseif(strpos($user_agent, 'SeaMonkey') !== FALSE){
		return $ini.'SeaMonkey'.$fin;
	}elseif(strpos($user_agent, 'Vivaldi') !== FALSE){
		return $ini.'Vivaldi'.$fin;
	}elseif(strpos($user_agent, 'Arora') !== FALSE){
		return $ini.'Arora'.$fin;
	}elseif(strpos($user_agent, 'Avant Browser') !== FALSE){
		return $ini.'Avant Browser'.$fin;
	}elseif(strpos($user_agent, 'Beamrise') !== FALSE){
		return $ini.'Beamrise'.$fin;
	}elseif(strpos($user_agent, 'Epiphany') !== FALSE){
		return $ini.'Epiphany'.$fin;
	}elseif(strpos($user_agent, 'Chromium') !== FALSE){
		return $ini.'Chromium'.$fin;
	}elseif(strpos($user_agent, 'Iceweasel') !== FALSE){
		return $ini.'Iceweasel'.$fin;
	}elseif(strpos($user_agent, 'Galeon') !== FALSE){
		return $ini.'Galeon'.$fin;
	}elseif(strpos($user_agent, 'Edge') !== FALSE){
		return $ini.'Microsoft Edge'.$fin;
	}elseif(strpos($user_agent, 'Trident') !== FALSE){ 
		return $ini.'Internet Explorer'.$fin;
	}elseif(strpos($user_agent, 'MSIE') !== FALSE){
		return $ini.'Internet Explorer'.$fin;
	}elseif(strpos($user_agent, 'Opera Mini') !== FALSE){
		return $ini.'Opera Mini'.$fin;
	}elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE){
		return $ini.'Opera'.$fin;
	}elseif(strpos($user_agent, 'Firefox') !== FALSE){
		//return 'Mozilla Firefox';
	}elseif(strpos($user_agent, 'Chrome') !== FALSE){
		//return 'Google Chrome';
	}elseif(strpos($user_agent, 'Safari') !== FALSE){
		return $ini.'Safari'.$fin;
	}elseif(strpos($user_agent, 'iTunes') !== FALSE){
		return $ini.'iTunes'.$fin;
	}elseif(strpos($user_agent, 'Konqueror') !== FALSE){
		return $ini.'Konqueror'.$fin;
	}elseif(strpos($user_agent, 'Dillo') !== FALSE){
		return $ini.'Dillo'.$fin;
	}elseif(strpos($user_agent, 'Netscape') !== FALSE){
		return $ini.'Netscape'.$fin;
	}elseif(strpos($user_agent, 'Midori') !== FALSE){
		return $ini.'Midori'.$fin;
	}elseif(strpos($user_agent, 'ELinks') !== FALSE){
		return $ini.'ELinks'.$fin;
	}elseif(strpos($user_agent, 'Links') !== FALSE){
		return $ini.'Links'.$fin;
	}elseif(strpos($user_agent, 'Lynx') !== FALSE){
		return $ini.'Lynx'.$fin;
	}elseif(strpos($user_agent, 'w3m') !== FALSE){
		return $ini.'w3m'.$fin;
	}else{
		return 'No hemos podido detectar su navegador';
	}
}
/*******************************************************************************************************************/
//Detecta el sistema operativo
function getPlatform(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$ini = '
	<div class="col-xs-12" style="margin-top:15px;">
		<div class="alert alert-danger alert-white rounded"> 
			<div class="icon"><i class="fa fa-exclamation-triangle faa-flash animated "></i></div> 
				Esta utilizando el SO ';
	$fin = ', Se garantiza el funcionamiento en los sistemas Windows 7 hacia arriba o sistemas Linux o derivados en sus ultimas versiones.
		</div>
	</div>';
		
	if(strpos($user_agent, 'Windows NT 10.0') !== FALSE){
		//return $ini.'Windows 10'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 6.3') !== FALSE){
		//return $ini.'Windows 8.1'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 6.2') !== FALSE){
		//return $ini.'Windows 8'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 6.1') !== FALSE){
		//return $ini.'Windows 7'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 6.0') !== FALSE){
		return $ini.'Windows Vista'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 5.1') !== FALSE){
		return $ini.'Windows XP'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 5.2') !== FALSE){
		return $ini.'Windows 2003'.$fin;
	}elseif(strpos($user_agent, 'Windows NT 5.0') !== FALSE){
		return $ini.'Windows 2000'.$fin;
	}elseif(strpos($user_agent, 'Windows ME') !== FALSE){
		return $ini.'Windows ME'.$fin;
	}elseif(strpos($user_agent, 'Win98') !== FALSE){
		return $ini.'Windows 98'.$fin;
	}elseif(strpos($user_agent, 'Win95') !== FALSE){
		return $ini.'Windows 95'.$fin;
	}elseif(strpos($user_agent, 'WinNT4.0') !== FALSE){
		return $ini.'Windows NT 4.0'.$fin;
	}elseif(strpos($user_agent, 'Windows Phone') !== FALSE){
		return $ini.'Windows Phone'.$fin;
	}elseif(strpos($user_agent, 'Windows') !== FALSE){
		return $ini.'Windows'.$fin;
	}elseif(strpos($user_agent, 'iPhone') !== FALSE){
		return $ini.'iPhone'.$fin;
	}elseif(strpos($user_agent, 'iPad') !== FALSE){
		return $ini.'iPad'.$fin;
	}elseif(strpos($user_agent, 'Debian') !== FALSE){
		//return $ini.'Debian'.$fin;
	}elseif(strpos($user_agent, 'Ubuntu') !== FALSE){
		//return $ini.'Ubuntu'.$fin;
	}elseif(strpos($user_agent, 'Slackware') !== FALSE){
		//return $ini.'Slackware'.$fin;
	}elseif(strpos($user_agent, 'Linux Mint') !== FALSE){
		//return $ini.'Linux Mint'.$fin;
	}elseif(strpos($user_agent, 'Gentoo') !== FALSE){
		//return $ini.'Gentoo'.$fin;
	}elseif(strpos($user_agent, 'Elementary OS') !== FALSE){
		//return $ini.'ELementary OS'.$fin;
	}elseif(strpos($user_agent, 'Fedora') !== FALSE){
		//return $ini.'Fedora'.$fin;
	}elseif(strpos($user_agent, 'Kubuntu') !== FALSE){
		//return $ini.'Kubuntu'.$fin;
	}elseif(strpos($user_agent, 'Linux') !== FALSE){
		//return $ini.'Linux'.$fin;
	}elseif(strpos($user_agent, 'FreeBSD') !== FALSE){
		return $ini.'FreeBSD'.$fin;
	}elseif(strpos($user_agent, 'OpenBSD') !== FALSE){
		return $ini.'OpenBSD'.$fin;
	}elseif(strpos($user_agent, 'NetBSD') !== FALSE){
		return $ini.'NetBSD'.$fin;
	}elseif(strpos($user_agent, 'SunOS') !== FALSE){
		return $ini.'Solaris'.$fin;
	}elseif(strpos($user_agent, 'BlackBerry') !== FALSE){
		return $ini.'BlackBerry'.$fin;
	}elseif(strpos($user_agent, 'Android') !== FALSE){
		return $ini.'Android'.$fin;
	}elseif(strpos($user_agent, 'Mobile') !== FALSE){
		return $ini.'Firefox OS'.$fin;
	}elseif(strpos($user_agent, 'Mac OS X+') || strpos($user_agent, 'CFNetwork+') !== FALSE){
		return $ini.'Mac OS X'.$fin;
	}elseif(strpos($user_agent, 'Macintosh') !== FALSE){
		return $ini.'Mac OS Classic'.$fin;
	}elseif(strpos($user_agent, 'OS/2') !== FALSE){
		return $ini.'OS/2'.$fin;
	}elseif(strpos($user_agent, 'BeOS') !== FALSE){
		return $ini.'BeOS'.$fin;
	}elseif(strpos($user_agent, 'Nintendo') !== FALSE){
		return $ini.'Nintendo'.$fin;
	}else{
		return 'Plataforma Desconocida';
	}
} 
/*******************************************************************************************************************/
/*Obtiene el Favicon del sitio y lo devuelve en una imagen
 * Modo de Uso
 * echo getFavicon("http://youtube.com/");
 * */
function getFavicon($url){
	return sprintf('<img src="https://www.google.com/s2/favicons?domain=%s"/>',urlencode($url));
}
/*******************************************************************************************************************/
/*Obtiene el avatar del correo
 * Modo de Uso
 * echo getGravatar('tucorreo@gmail.com');
 * echo getGravatar(
 * 		"tucorreo@gmail.com",
 * 		$size = 200,
 * 		$default = 'monsterid',
 * 		$rating = 'x',
 * 		$attributes = array(
 * 			"class" => "Gravatar"
 * 		)
 * );
 * */
function getGravatar($email, $size = 80, $default = 'mm', $rating = 'g', $attributes = []){
        
    $attr = trim(arrayToString($attributes));
    if (is_https()) {
        $url = 'https://secure.gravatar.com/';
    } else {
        $url = 'http://www.gravatar.com/';
    }

    return sprintf(
        '<img src="%savatar.php?gravatar_id=%s&default=%s&size=%s&rating=%s" width="%spx" height="%spx" %s />',
        $url,
        md5(strtolower(trim($email))),
        $default,
        $size,
        $rating,
        $size,
        $size,
        $attr
    );
}
/*******************************************************************************************************************/
/*Obtiene la URL Actual */
function getCurrentURL(){
    $url = 'http://';
    if (isHttps()) {
        $url = 'https://';
    }

    if (isset($_SERVER['PHP_AUTH_USER'])) {
        $url .= $_SERVER['PHP_AUTH_USER'];
        if (isset($_SERVER['PHP_AUTH_PW'])) {
            $url .= ':'.$_SERVER['PHP_AUTH_PW'];
        }
        $url .= '@';
    }
    if (isset($_SERVER['HTTP_HOST'])) {
        $url .= $_SERVER['HTTP_HOST'];
    }
    if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80) {
        $url .= ':'.$_SERVER['SERVER_PORT'];
    }
    if (!isset($_SERVER['REQUEST_URI'])) {
        $url .= substr($_SERVER['PHP_SELF'], 1);
        if (isset($_SERVER['QUERY_STRING'])) {
            $url .= '?'.$_SERVER['QUERY_STRING'];
        }

        return $url;
    }

    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}
/*******************************************************************************************************************/
/*Obtiene la IP del cliente */
function getClientIP($headerContainingIPAddress = null){
    if (!empty($headerContainingIPAddress)) {
        return isset($_SERVER[$headerContainingIPAddress]) ? trim($_SERVER[$headerContainingIPAddress]) : false;
    }

    $knowIPkeys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR',
    ];

    foreach ($knowIPkeys as $key) {
        if (array_key_exists($key, $_SERVER) !== true) {
            continue;
        }
        foreach (explode(',', $_SERVER[$key]) as $ip) {
            $ip = trim($ip);
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                return $ip;
            }
        }
    }

    return false;
}
/*******************************************************************************************************************/
/*Verifica si el dispositivo es movil */
function isMobile(){
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop'
            .'|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i'
            .'|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)'
            .'|vodafone|wap|windows ce|xda|xiino/i', $_SERVER['HTTP_USER_AGENT'])
        || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)'
            .'|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi'
            .'(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co'
            .'(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)'
            .'|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|'
            .'haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|'
            .'i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|'
            .'kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|'
            .'m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|'
            .'t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)'
            .'\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|'
            .'phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|'
            .'r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|'
            .'mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy'
            .'(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)'
            .'|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|'
            .'70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
        substr($_SERVER['HTTP_USER_AGENT'], 0, 4))) {
        return true;
    }

    return false;
}
/*******************************************************************************************************************/
/*Obtiene el navegador del cliente */
function getAdvancedBrowser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $browserName = $ub = $platform = 'Unknown';
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac OS';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    }

    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $browserName = 'Internet Explorer';
        $ub = 'MSIE';
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $browserName = 'Mozilla Firefox';
        $ub = 'Firefox';
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $browserName = 'Google Chrome';
        $ub = 'Chrome';
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $browserName = 'Apple Safari';
        $ub = 'Safari';
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $browserName = 'Opera';
        $ub = 'Opera';
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $browserName = 'Netscape';
        $ub = 'Netscape';
    }

    $known = ['Version', $ub, 'other'];
    $pattern = '#(?<browser>'.implode('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    preg_match_all($pattern, $u_agent, $matches);
    $i = count($matches['browser']);
    $version = $matches['version'][0];
    if ($i != 1 && strripos($u_agent, 'Version') >= strripos($u_agent, $ub)) {
        $version = $matches['version'][1];
    }
    if ($version == null || $version == '') {
        $version = '?';
    }

    return implode(', ', [$browserName, 'Version: '.$version, $platform]);
}
/*******************************************************************************************************************/
/*Obtiene la ubicacion del navegador */
/*function getClientLocation(){
    $result = false;
    $ip_data = @json_decode(self::curl('http://www.geoplugin.net/json.gp?ip='.getClientIP()));

    if (isset($ip_data) && $ip_data->geoplugin_countryName != null) {
        $result = $ip_data->geoplugin_city.', '.$ip_data->geoplugin_countryCode;
    }

    return $result;
}

function generateServerSpecificHash(){
        return (isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME']))
            ? md5($_SERVER['SERVER_NAME'])
            : md5(pathinfo(__FILE__, PATHINFO_FILENAME));
    }*/



?>
