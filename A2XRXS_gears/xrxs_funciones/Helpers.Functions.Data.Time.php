<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1003-009).');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Hora Estandar
* 
*===========================     Detalles    ===========================
* Transforma la hora ingresada al formato estandar
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea la hora
* 	Hora_estandar('1:1');
* 
*===========================    Parametros   ===========================
* Time     $Hora   Hora a formatear
* @return  Time
************************************************************************/
//Funcion
function Hora_estandar($Hora){
	//valido la hora
	if(validaHora($Hora)){
		if($Hora!='00:00:00'){
			$date = date_create($Hora);
			return date_format($date, 'H:i');
		}else{
			return 'Sin Hora';
		}
	}else{
		return 'El dato ingresado no es una hora ('.$Hora.')';
	}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve la hora programada
* 
*===========================     Detalles    ===========================
* Transforma la hora ingresada al formato de hora programada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea la hora
* 	Hora_prog('1:1');
* 
*===========================    Parametros   ===========================
* Time     $Hora   Hora a formatear
* @return  Time
************************************************************************/
//Funcion
function Hora_prog($Hora){	
	//valido la hora
	//if(validaHora($Hora)){
		if($Hora!='00:00:00'){
			return date("H:i:s", strtotime($Hora));
		}else{
			return 'Sin Hora';
		}
	/*}else{
		return 'El dato ingresado no es una hora ('.$Hora.')';
	}*/	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve la hora programada
* 
*===========================     Detalles    ===========================
* Transforma la hora ingresada al formato de hora programada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea la hora
* 	Hora_archivos('1:1');
* 
*===========================    Parametros   ===========================
* Time     $Hora   Hora a formatear
* @return  Time
************************************************************************/
//Funcion
function Hora_archivos($Hora){	
	//valido la hora
	//if(validaHora($Hora)){
		if($Hora!='00:00:00'){
			return date("His", strtotime($Hora));
		}else{
			return 'Sin Hora';
		}
	/*}else{
		return 'El dato ingresado no es una hora ('.$Hora.')';
	}*/	
}

?>
