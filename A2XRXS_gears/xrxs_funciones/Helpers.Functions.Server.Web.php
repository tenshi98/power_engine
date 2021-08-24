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
* Web Scraping
* 
*===========================     Detalles    ===========================
* Permite obtener contenido especifico de la web
*===========================    Modo de uso  ===========================
* 	
* 	//se obtiene dato
* 	fecha_actual();
* 
*===========================    Parametros   ===========================
* @return  Date
************************************************************************/
//Funcion
function getGoogleImage($consulta, $max_img){
	//reemplazo los espacios vacios
	$consulta = str_replace(' ', '+', $consulta);
	//Se da permiso para el acceso remoto
	ini_set("allow_url_fopen", 1);
	//se verifica si el permiso fue concedido
	if( ini_get('allow_url_fopen') ) {
		//Direccion con la consulta a google image
		$url = "https://www.google.com/search?q=".$consulta."&tbm=isch&source=hp&biw=1366&bih=636&ei=NWOAYIeGIpDJ1sQPjcYQ&oq=".$consulta."&gs_lcp=CgNpbWcQAzoCCAA6CAgAELEDEIMBOgUIABCxAzoECAAQE1CqHFjAlQFgo5gBaABwAHgAgAFiiAGTB5IBAjE1mAEAoAEBqgELZ3dzLXdpei1pbWc&sclient=img&ved=0ahUKEwjH9L_O8I_wAhWQpJUCHQ0jBAAQ4dUDCAY&uact=5";
		
		//obtengo el contenido							
		$html = file_get_contents($url);
		preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
		
		//recorro
		$i = 0;
		
		//div contenedor
		echo '
		<style>
		.getImgGoogle {clear: both;}
		.getImgGoogle img {padding: 4px;line-height: 1.42857143;background-color: #fff;border: 1px solid #ddd;border-radius: 4px;-webkit-transition: all .2s ease-in-out;-o-transition: all .2s ease-in-out;transition: all .2s ease-in-out;display: inline-block;max-width: 100%;height: auto;margin-right:5px;}
		</style>
		';
		echo '<div class="getImgGoogle">';
			//recorro
			foreach($matches as $image1){
				foreach($image1 as $image){
					if($i > $max_img) break;
					
					// DO with the image whatever you want here (the image element is '$image'):
					if($i>0){echo $image;}
					
					$i++;
				}
			} 
		echo '</div>';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Obtener Datos desde la IP ingresada
* 
*===========================     Detalles    ===========================
* Permite obtener la datos desde la ip ingresada
*===========================    Modo de uso  ===========================
* 	
* 	//se obtiene dato
* 	obtenerInfoIp('200.120.163.36', "city");
*   obtenerInfoIp('200.120.163.36', "region");
*   obtenerInfoIp('200.120.163.36', "regionCode");
*   obtenerInfoIp('200.120.163.36', "countryCode");
*   obtenerInfoIp('200.120.163.36', "countryName");
*   obtenerInfoIp('200.120.163.36', "continentName");
* 
*===========================    Parametros   ===========================
* @return  String
************************************************************************/
//Funcion
function obtenerInfoIp($IP_Cliente, $purpose) {
	//salida
	$output = '';
	//coneccion a servidor externo para obtener los datos de la ip
	$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$IP_Cliente));
	//se etrae la solicitud desde la respuesta
	if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
		switch ($purpose) {
			case "city":           $output = @$ipdat->geoplugin_city;           break;
			case "region":         $output = @$ipdat->geoplugin_region;         break;
			case "regionCode":     $output = @$ipdat->geoplugin_regionCode;     break;
			case "countryCode":    $output = @$ipdat->geoplugin_countryCode;    break;
			case "countryName":    $output = @$ipdat->geoplugin_countryName;    break;
			case "continentName":  $output = @$ipdat->geoplugin_continentName;  break;
		}
	}
	return $output;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devolver la URL Base
* 
*===========================     Detalles    ===========================
* Muestra la URL Base desde donde se ejecuta
*===========================    Modo de uso  ===========================
* 	
* 	//se obtiene dato
* 	base_url();
* 
*===========================    Parametros   ===========================
* @return  String
************************************************************************/
//Funcion
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
        else $base_url = 'https://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Obtener Favicon
* 
*===========================     Detalles    ===========================
* Permite obtener el favicon del sitio ingresado
*===========================    Modo de uso  ===========================
* 	
* 	//se obtiene dato
* 	getFavicon("https://youtube.com/");
* 
*===========================    Parametros   ===========================
* String   $url    Direccion web desde donde se obtendra el favicon
* @return  Image
************************************************************************/
//Funcion
function getFavicon($url){
	return sprintf('<img src="https://www.google.com/s2/favicons?domain=%s"/>',urlencode($url));
}

?>
