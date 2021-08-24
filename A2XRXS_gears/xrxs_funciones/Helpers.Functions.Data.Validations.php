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
* Validador de RUT con digito verificador 
* 
*===========================     Detalles    ===========================
* Valida el Rut chileno si esta correcto, devuelve vacio si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarRut('10.569.874-5');
* 
*===========================    Parametros   ===========================
* String   $Rut    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validarRut($Rut) {
    $Rut=str_replace('.', '', $Rut);
    if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$Rut,$d)) {
        $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
        return chr($s?$s+47:75)==strtoupper($d[2]);
    }   
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar correo
* 
*===========================     Detalles    ===========================
* Valida si el correo escrito esta correcto, devuelve vacio si esta 
* incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarEmail('asd@asd.cl');
* 
*===========================    Parametros   ===========================
* String   $Direccion    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validarEmail($Direccion, $tempEmailAllowed = false){ 
	if(filter_var($Direccion,FILTER_VALIDATE_EMAIL)){ 
		//valid email
		return TRUE; 
    } else{
        //INVALID EMAIL
        return FALSE; 
    }
	
	/*if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$}',$Direccion)){
        return FALSE; 
    }else { 
		return TRUE; 
		/*strpos($Direccion, '@') ? list(, $mailDomain) = explode('@', $Direccion) : $mailDomain = null;
        if (filter_var($Direccion, FILTER_VALIDATE_EMAIL) &&
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
        return false;*/ 
	//}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar numero
* 
*===========================     Detalles    ===========================
* Valida si el dato ingresado es un numero, devuelve vacio si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarNumero(25);
* 
*===========================    Parametros   ===========================
* Decimal  $numero    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validarNumero($numero){ 
	//cambio la coma por puntos para evitar problemas con los decimales
	$number = str_replace(',', '.', $numero);
	//Verfica si es un numero
	if(is_numeric($number)) {
		return TRUE; 
	} else {
		return FALSE;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar Patente
* 
*===========================     Detalles    ===========================
* Valida si la patente chilena ingresada esta correcta, devuelve 
* vacio si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	ValidarPatente('AU1825');
* 
*===========================    Parametros   ===========================
* String   $patente    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function ValidarPatente($patente){
	//elimino los posibles guones
	$value = str_replace("-","",$patente);
 	//caracteres admitidos
 	$regex = '/^[a-z]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}|[b-d,f-h,j-l,p,r-t,v-z]{2}[\-\. ]?[b-d,f-h,j-l,p,r-t,v-z]{2}[\.\- ]?[0-9]{2}$/i';
	//valida formato
	if (preg_match($regex, $patente)){
		return TRUE; 
	}else{
		return FALSE;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar URL
* 
*===========================     Detalles    ===========================
* Valida si la URL ingresada es valida o no, devuelve vacio si esta 
* incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarURL(https://www.google.cl');
* 
*===========================    Parametros   ===========================
* String   $url    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validarURL($url){
    return (bool) filter_var($url, FILTER_VALIDATE_URL);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar HTTPS
* 
*===========================     Detalles    ===========================
* Detecta si la pagina es HTTPS, devuelve vacio si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarHttps();
* 
*===========================    Parametros   ===========================
* @return  Bolean
************************************************************************/
//Funcion
function validarHttps(){
	if ((isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
		return true; 
	}else{
		return false;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar Ajax
* 
*===========================     Detalles    ===========================
* Detecta si la pagina es AJAX, devuelve vacio si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validarAjax();
* 
*===========================    Parametros   ===========================
* @return  Bolean
************************************************************************/
//Funcion
function validarAjax(){
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }
    return false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar Hora
* 
*===========================     Detalles    ===========================
* Permite validar si el dato ingresado es una hora, devuelve vacio 
* si esta incorrecto, con un tope maximo de 99 horas
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validaHora('16:24:00');
* 
*===========================    Parametros   ===========================
* Time     $time     Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validaHora($time) {
	$pattern1 = "/^([0-9][0-9])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
    $pattern2 = "/^([0-9][0-9])[\:]([0-5][0-9])$/";
    
    if(preg_match($pattern1,$time)){
        return true;
	}else{
		if(preg_match($pattern2,$time)){
			return true;
		}else{
			return false;
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar Fecha
* 
*===========================     Detalles    ===========================
* Permite validar si el dato ingresado es una fecha, devuelve vacio 
* si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validaFecha('1900-01-01', 'Y-m-d');
* 
*===========================    Parametros   ===========================
* Date     $date     Dato a validar
* String   $format   (Opcional) formato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validaFecha($date, $format = 'Y-m-d'){
	if($date=='0000-00-00'){
		return 'Sin Fecha';
	}else{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar entero
* 
*===========================     Detalles    ===========================
* Permite validar si el valor ingresado es un numero entero, devuelve vacio 
* si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validaEntero(1);
* 
*===========================    Parametros   ===========================
* Integer  $input    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validaEntero($input){
    //se verifica si es un numero lo que se recibe
	if (is_numeric($input)){ 
		return(ctype_digit(strval($input)));
	} else { 
		return 'El dato ingresado no es un numero';
	}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar Dispositivo Movil
* 
*===========================     Detalles    ===========================
* Permite validar el tipo de dispositivo con el cual se accede, devuelve vacio 
* si esta incorrecto
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validaDispositivoMovil();
* 
*===========================    Parametros   ===========================
* Integer  $input    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validaDispositivoMovil(){
    $useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		return true;
	}else{	
		return false;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Validar permiso
* 
*===========================     Detalles    ===========================
* Permite validar el nivel del permiso otorgado al usuario
*===========================    Modo de uso  ===========================
* 	
* 	//se valida dato
* 	validaPermisoUser($nivel_usuario, $nivel_requerido, $dbConn);
* 
*===========================    Parametros   ===========================
* Integer  $input    Dato a validar
* @return  Bolean
************************************************************************/
//Funcion
function validaPermisoUser($nivel_usuario, $nivel_requerido, $dbConn){
	//si el nivel de permiso del usuario es inferior al requerido
	if($nivel_usuario<$nivel_requerido){
		
		/****************************************************************/
		//variables
		$sesion_usuario          = 'Ninguno';
		$sesion_fecha            = fecha_actual();
		$sesion_hora             = hora_actual();		
		$sesion_IP_Client        = obtenerIpCliente();
		$sesion_Agent_Transp     = obtenerSistOperativo().' - '.obtenerNavegador();
		$sesion_email_principal  = DB_EMPRESA_MAIL;
		$sesion_error_email      = DB_ERROR_MAIL;
		$sesion_RazonSocial      = DB_EMPRESA_NAME;		
		$sesion_Empresa          = DB_SOFT_NAME;
		$sesion_Gmail_User       = DB_GMAIL_USER;	
		$sesion_Gmail_Password   = DB_GMAIL_PASSWORD;
		$sesion_N_Hacks          = 5;
		$sesion_archivo          = 'Ninguno';
		$sesion_tarea            = 'Ninguna';
		//verifico si tiene sesion activa
		if(isset($_SESSION['usuario']['basic_data']['usuario'])&&$_SESSION['usuario']['basic_data']['usuario']!=''){
			$sesion_usuario = $_SESSION['usuario']['basic_data']['usuario'];
		}
		//Verifico desde donde viene si es que existe
		if(isset($original)&&$original!=''){         $sesion_archivo  = $original;}
		//verifico la tarea si es que existe
		if(isset($form_trabajo)&&$form_trabajo!=''){ $sesion_tarea    = $form_trabajo;}
		
		/****************************************************************/
		//Cuerpo del correo
		$sesion_texto  = '<h3>Intento de hackeo</h3><br/>';
		$sesion_texto .= '<strong>Desde:</strong>'.$sesion_Empresa.'<br/>';
		$sesion_texto .= '<strong>Fecha:</strong>'.fecha_estandar($sesion_fecha).'<br/>';
		$sesion_texto .= '<strong>Hora:</strong>'.$sesion_hora.'<br/>';
		$sesion_texto .= '<strong>IP Client:</strong>'.$sesion_IP_Client.'<br/>';
		$sesion_texto .= '<strong>Agent Transp:</strong>'.$sesion_Agent_Transp.'<br/>';
		$sesion_texto .= '<strong>Usuario:</strong>'.$sesion_usuario.'<br/>';
		$sesion_texto .= '<strong>Archivo Comprometido:</strong>'.$sesion_archivo.'<br/>';
		$sesion_texto .= '<strong>Tarea:</strong>'.$sesion_tarea.'<br/>';
					
		/****************************************************************/
		//se envia correo de alerta
		tareas_envio_correo($sesion_email_principal, $sesion_RazonSocial, 
							$sesion_error_email, 'Receptor', 
							'', '', 
							'Intento de hackeo', 
							$sesion_texto,'', 
							'', 
							1, 
							$sesion_Gmail_User, 
							$sesion_Gmail_Password);
						
		/****************************************************************/
		//se guarda log
		error_log("=========================================================", 0);						
		error_log($sesion_texto, 0);						
		error_log("=========================================================", 0);	
		
		/****************************************************************/
		//se guarda en una tabla de datos
		$n_hackeos = db_select_nrows (false, 'idHacking', 'sistema_seguridad_hacking', '', "IP_Client='".$sesion_IP_Client."' OR usuario='".$sesion_usuario."'", $dbConn);
		//si ya hay demasiados intentos de hackeo
		if($n_hackeos>=$sesion_N_Hacks){
			//Se borra todos los datos relacionados a las sesiones
			session_unset();
			session_destroy();
			//redirijo a la pagina index
			header( 'Location: index.php' );
			die;
		//verifico el numero de intentos de hackeo y guardo el dato
		}elseif($n_hackeos<$sesion_N_Hacks){
			//filtros
			if(isset($sesion_fecha) && $sesion_fecha != ''){                $a  = "'".$sesion_fecha."'" ;           }else{$a  = "''";}
			if(isset($sesion_hora) && $sesion_hora != ''){                  $a .= ",'".$sesion_hora."'" ;           }else{$a .= ",''";}
			if(isset($sesion_IP_Client) && $sesion_IP_Client != ''){        $a .= ",'".$sesion_IP_Client."'" ;      }else{$a .= ",''";}
			if(isset($sesion_Agent_Transp) && $sesion_Agent_Transp != ''){  $a .= ",'".$sesion_Agent_Transp."'" ;   }else{$a .= ",''";}
			if(isset($sesion_usuario) && $sesion_usuario != ''){            $a .= ",'".$sesion_usuario."'" ;        }else{$a .= ",''";}
					
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `sistema_seguridad_hacking` (Fecha, Hora, IP_Client, Agent_Transp, usuario) 
			VALUES (".$a.")";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//redirijo a la pagina principal
			header( 'Location: principal.php' );
			die;
		}
	}
}
?>
