<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1003-005).');
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
//Funcion
function Fecha_completa($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
			$mes_c   = new DateTime($Fecha);
			$dia     = $mes_c->format('d');
			$me      = $mes_c->format('m');
			$ano     = $mes_c->format('Y');
			$mes     = $options[$me-1];

			return $mes.' '.$dia.' del '.$ano;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_completa_alt($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
			$mes_c   = new DateTime($Fecha);
			$dia     = $mes_c->format('d');
			$me      = $mes_c->format('m');
			$ano     = $mes_c->format('Y');
			$mes     = $options[$me-1];

			return $dia.' de '.$mes.' de '.$ano;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
*
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 01 Enero
*===========================    Modo de uso  ===========================
*
* 	//se formatea fecha
* 	Dia_Mes('2019-01-01');
*
*===========================    Parametros   ===========================
* Date     $Fecha    Fecha a Formatear
* @return  String
************************************************************************/
//Funcion
function Dia_Mes($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
			$mes_c   = new DateTime($Fecha);
			$dia     = $mes_c->format('d');
			$me      = $mes_c->format('m');
			$mes     = $options[$me-1];

			return $dia.' '.$mes;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_estandar($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			return date_format(date_create($Fecha), 'd-m-Y');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_estandar_c($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			return date_format(date_create($Fecha), 'd-m-y');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_normalizada($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&($Fecha!='0000-00-00' OR $Fecha!='00-00-0000')){
		//valido la fecha
		if(validaFecha($Fecha)){
			return date_format(date_create(str_replace('/', '-', $Fecha)), 'Y-m-d');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
*
*===========================     Detalles    ===========================
* Cambia el formato de fecha por uno mas utilizado:
* 19000101
*===========================    Modo de uso  ===========================
*
* 	//se formatea fecha
* 	Fecha_archivos('2019-01-01');
*
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  Date
************************************************************************/
//Funcion
function Fecha_archivos($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&($Fecha!='0000-00-00' OR $Fecha!='00-00-0000')){
		//valido la fecha
		if(validaFecha($Fecha)){
			return date_format(date_create(str_replace('/', '-', $Fecha)), 'Ymd');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_mes_ano($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
			$mes_c   = new DateTime($Fecha);
			$me      = $mes_c->format('m');
			$ano     = $mes_c->format('Y');
			$mes     = $options[$me-1];

			return $mes.' del '.$ano;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NdiaMes($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			//transformo el dato entregado al formato fecha
			$subdato = new DateTime($Fecha);
			return $subdato->format("j");
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NdiaMesCon0($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$dia = new DateTime($Fecha);
			return $dia->format('d');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NDiaSemana($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$dias = new DateTime($Fecha);
			return $dias->format('N');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NombreDia($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
			$me      = fecha2NDiaSemana($Fecha);
			$dia     = $options[$me-1];
			return $dia;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NSemana($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$subdato = new DateTime($Fecha);
			return $subdato->format("W");
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
*
*===========================     Detalles    ===========================
* Se obtiene el numero del mes en base a la fecha entregada (1 a 12)
*===========================    Modo de uso  ===========================
*
* 	//se formatea fecha
* 	fecha2NMes('2019-01-01');
*
*===========================    Parametros   ===========================
* Date     $Fecha  Fecha a Formatear
* @return  Integer
************************************************************************/
//Funcion
function fecha2NMes($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$subdato = new DateTime($Fecha);
			return $subdato->format("n");
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2NombreMes($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
			$me      = fecha2NMes($Fecha);
			$mes     = $options[$me-1];
			return $mes;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Formatea la fecha entregada
*
*===========================     Detalles    ===========================
* Se obtiene el nombre abreviado (3 primeras letras) del mes en base
* a una fecha ingresada
*===========================    Modo de uso  ===========================
*
* 	//se formatea fecha
* 	fecha2NombreMesCorto('2019-01-01');
*
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a Formatear
* @return  String
************************************************************************/
//Funcion
function fecha2NombreMesCorto($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$options = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
			$me      = fecha2NMes($Fecha);
			$mes     = $options[$me-1];
			return $mes;
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function fecha2Ano($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			$dia = new DateTime($Fecha);
			return $dia->format('Y');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
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
//Funcion
function Fecha_gringa($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			return date_format(date_create($Fecha), 'F d Y');
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Entrega el ultimo dia del mes
*
*===========================     Detalles    ===========================
* Se obtiene el ultimo dia del mes de la fecha entregada
*===========================    Modo de uso  ===========================
*
* 	//se formatea fecha
* 	Fecha_ultimo_dia_mes('2019-01-01');
*
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha a usar
* @return  String
************************************************************************/
//Funcion
function Fecha_ultimo_dia_mes($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''&&$Fecha!='0000-00-00'){
		//valido la fecha
		if(validaFecha($Fecha)){
			//Ultimo dia de la fecha entregada
			return date("Y-m-t", strtotime($Fecha));
		}else{
			return 'El dato ingresado no es una fecha ('.$Fecha.')';
		}
	}else{
		return 'Sin Fecha';
	}
}




?>
