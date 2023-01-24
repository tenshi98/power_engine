<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1003-006).');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Agrega un separador de valores
*
*===========================     Detalles    ===========================
* Convierte un valor entregado a un numero formateado de acuerdo a la
* configuracion dada, con separador de miles y con la cantidad de
* decimales configurada, si la cantidad de decimales deseada no se
* cumple, seran rellenados con 0
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	Cantidades(1250.85,6);
*
*===========================    Parametros   ===========================
* Decimal     $valor         Numero a formatear
* Integer     $n_decimales   Numero de decimales deseados
* @return     String
************************************************************************/
//Funcion
function Cantidades($valor, $n_decimales){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)&&validarNumero($n_decimales)){
			//Verifica si el numero recibido es un entero
			if (validaEntero($n_decimales)){
				//valido los valores en 0
				if($valor!=0){
					return number_format($valor,$n_decimales,',','.');
				}else{
					return 0;
				}
			} else {
				return 'El dato ingresado no es un numero entero';
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Agrega ceros a un numero designado
*
*===========================     Detalles    ===========================
* Agrega ceros a un numero designado, permitiendo dar el formato de
* numero correlativo de un documento, la cantidad de ceros define el
* largo del numero ingresado
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	n_doc(25, 7);
*
*===========================    Parametros   ===========================
* Integer     $valor         Numero a formatear
* Integer     $n_ceros       Numero de ceros a la izquierda del valor
* @return     String
************************************************************************/
//Funcion
function n_doc($valor, $n_ceros){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)&&validarNumero($n_ceros)){
			//Verifica si el numero recibido es un entero
			if (validaEntero($valor)&&validaEntero($n_ceros)){
				return str_pad($valor, $n_ceros, "0", STR_PAD_LEFT);
			} else {
				return 'El dato ingresado no es un numero entero';
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma a peso cualquier valor ingresado
*
*===========================     Detalles    ===========================
* Antepone un simbolo de peso al valor ingresado, luego formatea el
* valor con un separador de miles y por ultimo agrega la cantidad
* de decimales predefinida por el usuario
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	Valores(1500.85565,2);
*
*===========================    Parametros   ===========================
* Decimal     $valor         Numero a formatear
* Integer     $n_decimales   Numero de decimales deseados
* @return     String
************************************************************************/
//Funcion
function Valores($valor, $n_decimales){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)&&validarNumero($n_decimales)){
			//Verifica si el numero recibido es un entero
			if (validaEntero($n_decimales)){
				return '$ '.number_format($valor,$n_decimales,',','.');
			} else {
				return 'El dato ingresado no es un numero entero';
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '$ 0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devolver enteros
*
*===========================     Detalles    ===========================
* Transforma el valor ingresado a un entero, aproximandolo al entero
* mas cercano, agregando un separador de miles
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	valores_enteros(1500.85);
*
*===========================    Parametros   ===========================
* Decimal  $valor   Numero a formatear
* @return  Integer
************************************************************************/
//Funcion
function valores_enteros($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				return floatval(number_format($valor, 0, '.', ''));
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devolver enteros para comparar valores
*
*===========================     Detalles    ===========================
* Transforma el valor ingresado a un entero, aproximandolo al entero
* mas cercano
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	valores_comparables(1500.85);
*
*===========================    Parametros   ===========================
* Decimal  $valor   Numero a comparar
* @return  Integer
************************************************************************/
//Funcion
function valores_comparables($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				return ceil($valor);
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Truncar valores
*
*===========================     Detalles    ===========================
* Elimina los decimales del valor ingresado, sin aproximarlo al valor
* mas cercano, simplemente elimina la parte decimal del valor, sin
* separador de miles
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	valores_truncados(1500.85);
*
*===========================    Parametros   ===========================
* Decimal  $valor   Numero a formatear
* @return  Integer
************************************************************************/
//Funcion
function valores_truncados($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				return floor($valor);
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el valor con los decimales reales que tiene
*
*===========================     Detalles    ===========================
* Formatea el valor entregado de forma variable, esto quiere decir
* que solo mostrara la cantidad de decimales reales que tenga un
* valor decimal, si solo tiene 3 solo mostrara 3, si solo tiene 1
* solo mostrara 1, no rellena los decimales necesarios con 0, en el
* caso de ser un decimal infinito periodico, sino limita la cantidad
* de decimales (tener cuidado con este punto, si no se tiene
* seguridad respecto a este punto, utilizar la version alternativa)
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	Cantidades_decimales_justos(1500.85);
*
*===========================    Parametros   ===========================
* Decimal  $valor   Numero a formatear
* @return  Decimal
************************************************************************/
//Funcion
function Cantidades_decimales_justos($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				//valido si es un numero entero para eliminar el punto despues del valor
				if (ctype_digit($valor)) {
					return floatval(number_format($valor, 0, '.', ''));
				}else{
					$dec = strlen($valor) - strrpos($valor, '.') - 1;
					return floatval(number_format($valor, $dec, '.', ''));
				}
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el valor con los decimales reales que tiene (version alternativa)
*
*===========================     Detalles    ===========================
* Formatea el valor entregado de forma variable, esto quiere decir
* que solo mostrara la cantidad de decimales reales que tenga un
* valor decimal, si solo tiene 3 solo mostrara 3, si solo tiene 1
* solo mostrara 1, no rellena los decimales necesarios con 0, en el
* caso de ser un decimal infinito periodico, se limita a una
* cantidad de 6 decimales
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	Cantidades_decimales_justos_alt(1500.85);
*
*===========================    Parametros   ===========================
* Decimal  $valor   Numero a formatear
* @return  Decimal
************************************************************************/
//Funcion
function Cantidades_decimales_justos_alt($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				//valido si es un numero entero para eliminar el punto despues del valor
				if (ctype_digit($valor)) {
					return floatval(number_format($valor, 0, '.', ''));
				}else{
					return rtrim(number_format($valor,6,'.',','), ',0');
				}
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Entrega un formato compatible con excel
*
*===========================     Detalles    ===========================
* Devuelve un valor compatible con excel en el uso de decimales
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	cantidades_excel(1500.85);
*
*===========================    Parametros   ===========================
* Decimal   $valor   Numero a formatear
* @return   Decimal
************************************************************************/
//Funcion
function cantidades_excel($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		return str_replace('.', ',', $valor);
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Entrega un formato compatible con google
*
*===========================     Detalles    ===========================
* Devuelve un valor compatible con google en el uso de decimales
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	cantidades_google(1500.85);
*
*===========================    Parametros   ===========================
* Decimal   $valor   Numero a formatear
* @return   Decimal
************************************************************************/
//Funcion
function cantidades_google($valor){
	//Se verifica que se recibe algo
	if($valor!=''){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($valor)){
			if($valor==0){
				return 0;
			}else{
				return str_replace(',', '.', $valor);
			}
		} else {
			return 'El dato ingresado no es un numero';
		}
	}else{
		return '0';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Entrega un formato de numero telefonico
*
*===========================     Detalles    ===========================
* Devuelve un numero telefonico
*===========================    Modo de uso  ===========================
*
* 	//se formatea numero
* 	formatPhone('+56911265984');
*
*===========================    Parametros   ===========================
* Decimal   $valor   Numero a formatear
* @return   String
************************************************************************/
//Funcion
function formatPhone($Phone){

	//Verifico si existe
	if(isset($Phone)&&$Phone!=''){
		//obtengo el largo
		$largo = strlen($Phone);

		//si tiene al menos 8 digitos como lo es obligatorio
		if($largo>7){

			//si solo tiene el formato antiguo se le agrega el 9
			if($largo==8){$Phone = '9'.$Phone;}
			/**************************************/
			//verifico si numero comienza con +56 o con 56
			$myNumber = $Phone;
			$findme_1 = '+';
			$findme_2 = '+56';
			$findme_3 = '56';

			$pos_1 = strpos($myNumber, $findme_1);
			$pos_2 = strpos($myNumber, $findme_2);
			$pos_3 = strpos($myNumber, $findme_3);

			//si comienza con el +
			if ($pos_1 !== false && $pos_1==0) {
				//comienza con el +56
				if ($pos_2 !== false && $pos_2==0) {
					$myPhone = $Phone;
				//no comienza con el +56, es otro numero
				} else {
					$myPhone = '';
				}
			//no comienza por el +
			} else {
				//comienza con el 56
				if ($pos_3 !== false && $pos_3==0) {
					$myPhone = '+'.$Phone;
				//no comienza con el 56, es otro numero
				} else {

					$myPhone = '+56'.$Phone;
				}
			}

			/**************************************/
			//verifico la existencia de datos
			if(isset($myPhone)&&$myPhone!=''){

				$result = sprintf("(%s) %s %s %s",
					  substr($myPhone, 0, 3),
					  substr($myPhone, 3, 1),
					  substr($myPhone, 4, 4),
					  substr($myPhone, 8, 4));

				return $result;
			}
		//si no tiene el largo necesario
		}else{
			return 'Numero demasiado corto, tiene '.$largo.' numeros y debe tener al menos 9';
		}
	//si no existe
	}else{
		return '';
	}
}

?>
