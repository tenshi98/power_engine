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
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
//reduce la cantidad de caracteres en un texto
function cortar($texto, $cuantos){
	if (strlen($texto) <= $cuantos) return $texto;
	return substr($texto, 0, $cuantos) . '...';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
//reduce la cantidad de caracteres en un rut chileno
function cortarRut($texto){
	//verifico si existe el guion	
	$var1 = substr_count($texto, '-');
	//se verifica el largo del texto
	$var2 = strlen($texto);
	//se consulta
	if($var1==1){
		$x = $var2 - 2;
		return substr($texto, 0, $x);
	}else{
		return $texto;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
//Verifica el largo del texto
function palabra_largo($variable,$largo){
	if (strlen($variable) < $largo) { 
   			$var	    = 'El dato ingresado debe tener al menos '.$largo.' caracteres';
			return $var;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
//Verifica lo corto del texto
function palabra_corto($variable,$largo){
	if (strlen($variable) > $largo) { 
   		$var	    = 'El dato ingresado debe tener no mas de '.$largo.' caracteres';
		return $var;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
//Limpiar textos
function limpiarString($texto){
    //Limpieza caracteres normales
    $texto = preg_replace('([^A-Za-z0-9.])', ' ', $texto);
    //Se eliminan saltos de linea y pagina
    $texto = str_replace(array("\n", "\r"), '', $texto);
    $texto = strip_tags($texto, '');	     					
    return $textoLimpio;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Se calcula la diferencia de meses
* 
*===========================     Detalles    ===========================
* Se calcula la diferencia de meses en base a dos fechas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	diferencia_meses('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fechainicial   Fecha de inicio 
* Date     $fechafinal     Fecha de termino
* @return  Integer
************************************************************************/
/* reemplaza los espacios por guiones*/
function espacio_guion($dato) {
    $dato = str_replace(' ', '_', $dato);
    return $dato;
}



?>
