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
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* enero 01 del 1900
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_completa('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/ 
function Fecha_completa($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$mes_c = new DateTime($Fecha);
			$dia = $mes_c->format('d');
			$me = $mes_c->format('m');
			$ano = $mes_c->format('Y');
			switch ($me) {
				case 1:  $mes='enero'; break;
				case 2:  $mes='febrero'; break;
				case 3:  $mes='marzo'; break;
				case 4:  $mes='abril'; break;
				case 5:  $mes='mayo'; break;
				case 6:  $mes='junio'; break;
				case 7:  $mes='julio'; break;
				case 8:  $mes='agosto'; break;
				case 9:  $mes='septiembre'; break;
				case 10: $mes='octubre'; break;
				case 11: $mes='noviembre'; break;
				case 12: $mes='diciembre'; break;
			}
			$cadena = $mes.' '.$dia.' del '.$ano;
			return $cadena;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 01 de enero de 1900
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_completa_alt('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha    Fecha a Formatear
* @return  String
************************************************************************/ 
function Fecha_completa_alt($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$mes_c = new DateTime($Fecha);
			$dia = $mes_c->format('d');
			$me = $mes_c->format('m');
			$ano = $mes_c->format('Y');
			switch ($me) {
				case 1:  $mes='enero'; break;
				case 2:  $mes='febrero'; break;
				case 3:  $mes='marzo'; break;
				case 4:  $mes='abril'; break;
				case 5:  $mes='mayo'; break;
				case 6:  $mes='junio'; break;
				case 7:  $mes='julio'; break;
				case 8:  $mes='agosto'; break;
				case 9:  $mes='septiembre'; break;
				case 10: $mes='octubre'; break;
				case 11: $mes='noviembre'; break;
				case 12: $mes='diciembre'; break;
			};
			$cadena = $dia.' de '.$mes.' de '.$ano;
			return $cadena;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 01-01-2019
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_estandar('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha    Fecha a Formatear
* @return  Date
************************************************************************/ 
function Fecha_estandar($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$date = date_create($Fecha);
			return date_format($date, 'd-m-Y');
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 01-01-00
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_estandar_c('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Date
************************************************************************/ 
function Fecha_estandar_c($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$date = date_create($Fecha);
			return date_format($date, 'd-m-y');
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 1900-01-01
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_normalizada('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Date
************************************************************************/ 
function Fecha_normalizada($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$date = date_create($Fecha);
			return date_format($date, 'Y-m-d');
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* enero 01 del 1900
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_mes_ano('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/ 
function Fecha_mes_ano($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$mes_c = new DateTime($Fecha);
			$me = $mes_c->format('m');
			$agno = $mes_c->format('Y');
			switch ($me) {
				case 1:  $mes='enero'; break;
				case 2:  $mes='febrero'; break;
				case 3:  $mes='marzo'; break;
				case 4:  $mes='abril'; break;
				case 5:  $mes='mayo'; break;
				case 6:  $mes='junio'; break;
				case 7:  $mes='julio'; break;
				case 8:  $mes='agosto'; break;
				case 9:  $mes='septiembre'; break;
				case 10: $mes='octubre'; break;
				case 11: $mes='noviembre'; break;
				case 12: $mes='diciembre'; break;
			}
			$cadena = $mes.' del '.$agno;
			return $cadena;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transformar fecha a numero de dia en el mes
* 
*===========================     Detalles    ===========================
* Permite obtener el numero del dia en el mes a partir de la fecha 
* ingresada, 2 dígitos sin ceros iniciales (1 al 31)
*===========================    Modo de uso  ===========================
* 	
* 	//se obtiene el numero del dia
* 	fecha2NdiaMes('2019-01-02');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Integer
************************************************************************/
function fecha2NdiaMes($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		//transformo el dato entregado al formato fecha
		$subdato = new DateTime($Fecha);
		$datofinal = $subdato->format("j");
		return $datofinal;
	}else{
		return 'El dato ingresado no es una fecha';
	}	 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transformar fecha a numero de dia en el mes
* 
*===========================     Detalles    ===========================
* Permite obtener el numero del dia en el mes a partir de la fecha 
* ingresada, 2 dígitos con ceros iniciales (1 al 31)
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NdiaMesCon0('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Integer
************************************************************************/ 
function fecha2NdiaMesCon0($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$dia1 = new DateTime($Fecha);
			$dia = $dia1->format('d');
			return $dia;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Numero del dia en la semana
* 
*===========================     Detalles    ===========================
* Muestra el numero del dia dentro de la semana, siendo 1 (para lunes) 
* hasta 7 (para domingo)
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NDiaSemana('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Integer
************************************************************************/ 
function fecha2NDiaSemana($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$dias = new DateTime($Fecha);
			$me = $dias->format('N');
			return $me;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el nombre del dia
* 
*===========================     Detalles    ===========================
* Devuelve el nombre del dia en base a la fecha ingresada (lunes a domingo)
*===========================    Modo de uso  ===========================
* 	
* 	//se transforma los datos	
* 	fecha2NombreDia('2019-01-02');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/
function fecha2NombreDia($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		$me = fecha2NDiaSemana($Fecha);
		switch ($me) {
			case 1: $dia = 'Lunes'; break;
			case 2: $dia = 'Martes'; break;
			case 3: $dia = 'Miercoles'; break;
			case 4: $dia = 'Jueves'; break;
			case 5: $dia = 'Viernes'; break;
			case 6: $dia = 'Sabado'; break;
			case 7: $dia = 'Domingo'; break;
		}
		return $dia;
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Se obtiene el numero de la semana en base a la fecha entregada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NSemana('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Integer
************************************************************************/ 
function fecha2NSemana($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$subdato = new DateTime($Fecha);
			$datofinal = $subdato->format("W");
			return $datofinal;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Se obtiene el numero del mes en base a la fecha entregada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NMes('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha  Fecha a Formatear
* @return  Integer
************************************************************************/ 
function fecha2NMes($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$subdato = new DateTime($Fecha);
			$datofinal = $subdato->format("n");
			return $datofinal;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Se obtiene el nombre del mes en base a una fecha ingresada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NombreMes('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/ 
function fecha2NombreMes($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$me = fecha2NMes($Fecha);
			switch ($me) {
				case 1:  $mes='enero'; break;
				case 2:  $mes='febrero'; break;
				case 3:  $mes='marzo'; break;
				case 4:  $mes='abril'; break;
				case 5:  $mes='mayo'; break;
				case 6:  $mes='junio'; break;
				case 7:  $mes='julio'; break;
				case 8:  $mes='agosto'; break;
				case 9:  $mes='septiembre'; break;
				case 10: $mes='octubre'; break;
				case 11: $mes='noviembre'; break;
				case 12: $mes='diciembre'; break;
			}
			return $mes;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Se obtiene el nombre abreviado del mes en base a una fecha ingresada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2NombreMesCorto('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/ 
function fecha2NombreMesCorto($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$me = fecha2NMes($Fecha);
			switch ($me) {
				case 1:  $mes='Ene'; break;
				case 2:  $mes='Feb'; break;
				case 3:  $mes='Mar'; break;
				case 4:  $mes='Abr'; break;
				case 5:  $mes='May'; break;
				case 6:  $mes='Jun'; break;
				case 7:  $mes='Jul'; break;
				case 8:  $mes='Ago'; break;
				case 9:  $mes='Sep'; break;
				case 10: $mes='Oct'; break;
				case 11: $mes='Nov'; break;
				case 12: $mes='Dic'; break;
			}
			return $mes;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Obtiene el Año en base a la fecha ingresada
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	fecha2Ano('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Integer
************************************************************************/ 
function fecha2Ano($Fecha){	
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$dia1 = new DateTime($Fecha);
			$ano = $dia1->format('Y');
			return $ano;
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
* 
*===========================     Detalles    ===========================
* Se obtiene la descripcion de la fecha en ingles, una representación 
* textual completa de un mes, como January o March, el numero del dia
* y el año
*===========================    Modo de uso  ===========================
* 	
* 	//se formatea fecha
* 	Fecha_gringa('2019-01-01');
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/ 
function Fecha_gringa($Fecha){
	//valido la fecha
	if(validaFecha($Fecha)){
		if($Fecha=='0000-00-00'){
			return 'Sin Fecha';
		}else{
			$date = date_create($Fecha);
			return date_format($date, 'F d Y');
		}
	}else{
		return 'El dato ingresado no es una fecha';
	}
}

?>
