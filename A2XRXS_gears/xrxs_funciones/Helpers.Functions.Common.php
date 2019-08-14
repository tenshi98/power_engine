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
* Se encarga de generar un array multinivel
* 
*===========================     Detalles    ===========================
* Al ingresar un Array, se selecciona una de las columnas, dicha columna generara un 
* nuevo nivel dentro del arreglo, reordenando los datos
*===========================    Modo de uso  ===========================
* 	
* 	//se filtran los datos		
* 	filtrar($arreglo, 'categoria' );
* 	//se recorre el nuevo arreglo
* 	foreach ($arreglo AS $categoria=>$arr1){
* 		//imprimimos la categoría
* 		echo $categoria;
* 		//se recorren los datos dentro de la categoria
* 		foreach ($arr1 AS $arr2){
* 			//imprimimos los datos dentro de la categoria
* 		}
* 	}
* 
*===========================    Parametros   ===========================
* Array    $arreglo   Arreglo a reordenar
* String   categoria  Dato desde el cual se va a reordenar el arreglo
* @return  Array
************************************************************************/
function filtrar(&$array, $clave_orden ) {
	// inicializamos un nuevo array
	$array_filtrado = array(); 
	// creamos un bucle foreach para recorrer el array original y “acomodar” los datos
	foreach($array as $index=>$array_value) {
		// guardamos temporalmente el nombre de la categoría
		$value = $array_value[$clave_orden];
		// eliminamos la categoria del registro, ya no la necesitaremos
		unset($array_value[$clave_orden]);
		// creamos una clave en nuestro nuevo array, con el nombre de la categoria
		$array_filtrado[$value][] = $array_value;
	}
	// modificamos automáticamente nuestro array global $row
	$array = $array_filtrado; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Generar un password aleatorio
* 
*===========================     Detalles    ===========================
* Permite generar un pasword aleatorio de dos tipos, numerico o alfanumerico,
* seleccionando el largo del password aleatorio
*===========================    Modo de uso  ===========================
* 	//Numerico:
* 	genera_password(10,'numerico');
* 
* 	//Alfanumerico:
* 	genera_password(10,'alfanumerico');
* 
*===========================    Parametros   ===========================
* Integer    $longitud   Largo de la password generada
* String     $tipo       Tipo de password a generar
* @return    String
************************************************************************/
function genera_password($longitud,$tipo){
	
	//verifico si los datos estan bien entregados
	if (is_numeric($longitud)&&($tipo=="alfanumerico" || $tipo=="numerico")){
		
		//selecciono el tipo de password
		if ($tipo=="alfanumerico"){
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		} elseif ($tipo=="numerico"){
			$alphabet = '1234567890';
		}
		
		//creo la password
		$password = substr(str_shuffle($alphabet), 0, $longitud);

		return $password;
	}else{
		return 'Datos requeridos mal ingresados';
	}
	
    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Generar un password unica
* 
*===========================     Detalles    ===========================
* Se genera una password unica en base a la fecha y a la hora del servidor, de
* esta forma no hay probabilidades de que esta se repita, tener en cuenta su
* uso en caso de ser utilizada reiteradamente (2 veces en el mismo segundo)
*===========================    Modo de uso  ===========================
* 			
* 	genera_password_unica();
* 
*===========================    Parametros   ===========================
* @return    String
************************************************************************/
function genera_password_unica(){
	
	//inicializo variable
	$password = '';
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Imprimimos la fecha actual dandole un formato
	$password.= date("Ymd");
	//Imprimimos la hora actual dandole un formato
	$password.= date("His");
	//devuelvo valor
    return $password;
    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Obtiene la extension de un archivo
* 
*===========================     Detalles    ===========================
* Permite obtener la extension del archivo solicitado, hay que tener en 
* cuenta el otorgar la ruta de acceso al archivo
*===========================    Modo de uso  ===========================
* 			
* 	obtenerExtensionArchivo('nombre del archivo');
* 
*===========================    Parametros   ===========================
* String   $nombreArchivo     Nombre del archivo a revisar, incluyendo la ruta
*                             de acceso a este
* @return  String
************************************************************************/
function obtenerExtensionArchivo($nombreArchivo){
    return pathinfo($nombreArchivo, PATHINFO_EXTENSION);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Genera una palabra con caracteres random
* 
*===========================     Detalles    ===========================
* Permite generar palabras con caracteres random, con varias opciones
*===========================    Modo de uso  ===========================
* 			
* 	caracteresRandom(16, true, false, false);
* 
*===========================    Parametros   ===========================
* integer    $longitud          Define el largo de la palabra generada
* boolean    $lecturaAmigable   Remueve los caracteres similares a otro, 
*                               tales como O y 0, l y 1, etc(true - false)
* boolean    $incluirSimbolos   Permite incluir simbolos en la palabra 
*                               generada, no debe estar activadasi lectura 
*                               amigable esta activa(true - false)
* boolean    $sinDuplicados     Da la opcion de que la palabra generada 
*                               no contenga caracteres repetidos(true - false)
* 
* @return    String
************************************************************************/
function caracteresRandom($longitud = 16, $lecturaAmigable = true, $incluirSimbolos = false, $sinDuplicados = false){
        
    $caracteres_legibles = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefhjkmnprstuvwxyz23456789';
    $caracteres_todos    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $simbolos            = '!@#$%^&*()~_-=+{}[]|:;<>,.?/"\'\\`';
    $cadena              = '';

    // Determine el conjunto de caracteres disponibles en función de los parámetros dados
    if ($lecturaAmigable) {
        $cola = $caracteres_legibles;
    } else {
        $cola = $caracteres_todos;
		//si se incluyen los simbolos
        if ($incluirSimbolos) {
            $cola .= $simbolos;
        }
    }
	
	//elimino los duplicados
    if (!$sinDuplicados) {
        return substr(str_shuffle(str_repeat($cola, $longitud)), 0, $longitud);
    }

    // No permita que se deshabiliten letras duplicadas si la longitud es mayor que los caracteres disponibles
    if ($sinDuplicados && strlen($cola) < $longitud) {
        //throw new \LengthException('$length exceeds the size of the pool and $sinDuplicados is enabled');
    }

    //Convierta el conjunto de caracteres en una matriz de caracteres y mezcle la matriz
    $cola       = str_split($cola);
    $largo_cola = count($cola);
    $rand       = mt_rand(0, $largo_cola - 1);

    //Generar nuestra cadena
    for ($i = 0; $i < $longitud; $i++) {
        $cadena .= $cola[$rand];

        // Elimine el carácter de la matriz para evitar duplicados.
        array_splice($cola, $rand, 1);

        // Generar un nuevo número
        if (($largo_cola - 2 - $i) > 0) {
            $rand = mt_rand(0, $largo_cola - 2 - $i);
        } else {
            $rand = 0;
        }
    }

    return $cadena;
}


?>
