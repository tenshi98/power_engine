<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                        Control de numero de funciones                                           */
/*                                                                                                                 */
/*******************************************************************************************************************/
$n_funct_common = 0;
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
//control numero funciones
$n_funct_common++;
//Funcion
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
//control numero funciones
$n_funct_common++;
//Funcion
function genera_password($longitud,$tipo){
	
	//verifico si los datos estan bien entregados
	if (validarNumero($longitud)&&($tipo=="alfanumerico" || $tipo=="numerico")){
		
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
* 	//generar una password		
* 	genera_password_unica();
* 
*===========================    Parametros   ===========================
* @return    String
************************************************************************/
//control numero funciones
$n_funct_common++;
//Funcion
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
* cuenta el otorgar la ruta completa de acceso al archivo
*===========================    Modo de uso  ===========================
* 	
* 	//obtener extension		
* 	obtenerExtensionArchivo('nombre del archivo');
* 
*===========================    Parametros   ===========================
* String   $nombreArchivo     Nombre del archivo a revisar, incluyendo la ruta
*                             de acceso a este
* @return  String
************************************************************************/
//control numero funciones
$n_funct_common++;
//Funcion
function obtenerExtensionArchivo($nombreArchivo){
    return pathinfo($nombreArchivo, PATHINFO_EXTENSION);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Genera una palabra con caracteres random
* 
*===========================     Detalles    ===========================
* Permite generar palabras con caracteres random, con varias opciones
* disponibles
*===========================    Modo de uso  ===========================
* 	
* 	//Caracteres Random	
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
//control numero funciones
$n_funct_common++;
//Funcion
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Genera un cuadro de alerta
* 
*===========================     Detalles    ===========================
* Permite generar un cuadro de alerta personalizado
*===========================    Modo de uso  ===========================
* 	//se imprime input	
* 	alert_post_data(1,0,3, 'dato' );
* 	alert_post_data(2,1,2, '<strong>Dato:</strong>explicacion' );
* 	alert_post_data(3,2,1, '<strong>Dato 1:</strong>explicacion 1 <br/><strong>Dato 2:</strong>explicacion 2' );
* 	alert_post_data(4,3,0, 'bla' );
* 
*===========================    Parametros   ===========================
* Integer  $type            Tipo de mensaje (define el color de este)
* Integer  $icon            Icono a utilizar
* Integer  $iconAnimation   Animacion del icono utilizado
* String   $Text            Texto del mensaje (permite HTML)
* @return  String
************************************************************************/
//control numero funciones
$n_funct_common++;
//Funcion
function alert_post_data($type, $icon, $iconAnimation, $Text){
		
	//Valido si los datos ingresados estan correctos
	if (validarNumero($type)&&validarNumero($icon)&&validarNumero($iconAnimation)){
			
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido_1 = array(1,2,3,4);
		$requerido_2 = array(0,1,2,3);
		$requerido_3 = array(0,1,2,3);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($type, $requerido_1)) {
			alert_post_data(4,1,1, 'La configuracion $type entregada no esta dentro de las opciones');
			$errorn++;
		}
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($icon, $requerido_2)) {
			alert_post_data(4,1,1, 'La configuracion $icon entregada no esta dentro de las opciones');
			$errorn++;
		}
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($iconAnimation, $requerido_3)) {
			alert_post_data(4,1,1, 'La configuracion $iconAnimation entregada no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Selecciono el tipo de mensaje
			switch ($type) {
				case 1: $tipo = 'success';  break;
				case 2: $tipo = 'info';     break;
				case 3: $tipo = 'warning';  break;
				case 4: $tipo = 'danger';   break;
			}
				
			//Selecciono el tipo de mensaje
			switch ($iconAnimation) {
				case 0: $Animation = '';                      break;
				case 1: $Animation = 'faa-bounce animated';   break;
				case 2: $Animation = 'faa-vertical animated'; break;
				case 3: $Animation = 'faa-flash animated';    break;	
			}
				
			//Selecciono el tipo de icono
			switch ($icon) {
				case 0: $iconType = '';                                                                                   break;
				case 1: $iconType = '<div class="icon"><i class="fa fa-info-circle '.$Animation.'" aria-hidden="true"></i></div>';           break;
				case 2: $iconType = '<div class="icon"><i class="fa fa-exclamation '.$Animation.'" aria-hidden="true"></i></div>';           break;
				case 3: $iconType = '<div class="icon"><i class="fa fa-exclamation-triangle '.$Animation.'" aria-hidden="true"></i></div>';  break;
			}


			//generacion del mensaje
			$input  = '<div class="alert alert-'.$tipo.' alert-white rounded alert_box_correction" role="alert">';
			if($icon!=0){$input .= $iconType;}
			$input .= '<span id="alert_post_data">'.$Text.'</span>';
			$input .= '<div class="clearfix"></div>';	
			$input .= '</div>';
					
			//Imprimir dato	
			echo $input;
		}
	}
}

?>
