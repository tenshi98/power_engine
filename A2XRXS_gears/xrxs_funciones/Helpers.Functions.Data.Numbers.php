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
function Cantidades($valor, $n_decimales){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)&&is_numeric($n_decimales)){ 
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
function n_doc($valor, $n_ceros){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)&&is_numeric($n_ceros)){ 
		//Verifica si el numero recibido es un entero
		if (validaEntero($valor)&&validaEntero($n_ceros)){ 
			return str_pad($valor, $n_ceros, "0", STR_PAD_LEFT);
		} else { 
			return 'El dato ingresado no es un numero entero';
		}
	} else { 
		return 'El dato ingresado no es un numero';
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
* 	Valores(1500.85,2);
* 
*===========================    Parametros   ===========================
* Decimal     $valor         Numero a formatear
* Integer     $n_decimales   Numero de decimales deseados
* @return     String
************************************************************************/ 
//Agrega un separador de valoresjunto con dos decimales
function Valores($valor, $n_decimales){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)&&is_numeric($n_decimales)){ 
		//Verifica si el numero recibido es un entero
		if (validaEntero($n_decimales)){ 
			return '$ '.number_format($valor,$n_decimales,',','.');
		} else { 
			return 'El dato ingresado no es un numero entero';
		}
	} else { 
		return 'El dato ingresado no es un numero';
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
* @return  String
************************************************************************/ 
function valores_enteros($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
		if($valor==0){
			return 0;
		}else{
			return floatval(number_format($valor, 0, '.', ''));
		}
	} else { 
		return 'El dato ingresado no es un numero';
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
function valores_truncados($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
		if($valor==0){
			return 0;
		}else{
			return floor($valor);
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el valor con los decimales reales que tiene
* 
*===========================     Detalles    ===========================
* * Formatea el valor entregado de forma variable, esto quiere decir 
* que solo mostrara la cantidad de decimales reales que tenga un 
* valor decimal, si solo tiene 3 solo mostrara 3, si solo tiene 1 
* solo mostrara 1, no rellena los decimales necesarios con 0, en el 
* caso de ser un decimal infinito periodico, sno limita la cantidad 
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
function Cantidades_decimales_justos($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
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
//Agrega un separador de valores
function Cantidades_decimales_justos_alt($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
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
function cantidades_excel($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
		return str_replace('.', ',', $valor);
	} else { 
		return 'El dato ingresado no es un numero';
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
function cantidades_google($valor){	
	//se verifica si es un numero lo que se recibe
	if (is_numeric($valor)){ 
		 return str_replace(',', '.', $valor);
	} else { 
		return 'El dato ingresado no es un numero';
	}
}

?>
