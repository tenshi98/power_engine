<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              Funciones  Horas                                                   */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma numeros (decimales) a horas
* 
*===========================     Detalles    ===========================
* Permite ingresar un numero (decimales, representando las horas) y 
* transformarlo en formato hora
*===========================    Modo de uso  ===========================
* 	
* 	//transformar minutos	
* 	numero2horas(1.5);
* 
*===========================    Parametros   ===========================
* Integer    $mins   Numero de minutos a transformar
* @return    Time
************************************************************************/
//Funcion
function numero2horas($in) {
	//se verifica si es un numero lo que se recibe
	if (validarNumero($in)){ 
		$h = intval($in);
		$m = round((((($in - $h) / 100.0) * 60.0) * 100), 0);
		if ($m == 60){
           $h++;
           $m = 0;
		}
		$retval = sprintf("%02d:%02d:%02d", $h, $m, '00');
		return $retval;
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma minutos a horas
* 
*===========================     Detalles    ===========================
* Permite ingresar un numero (de minutos) y transformarlo en formato hora
*===========================    Modo de uso  ===========================
* 	
* 	//transformar minutos	
* 	minutos2horas(65);
* 
*===========================    Parametros   ===========================
* Integer    $mins   Numero de minutos a transformar
* @return    Time
************************************************************************/
//Funcion
function minutos2horas($mins) {
	//se verifica si es un numero lo que se recibe
	if (validarNumero($mins)){ 
		//if(validaEntero($mins)){
			$extraIntH = intval($mins/60);
			$extraIntHs = ($mins/60);            
			$whole = floor($extraIntHs);      
			$fraction = $extraIntHs - $whole; 
			$extraIntHss =  round($fraction*60); 
			//Se agrega el 0
			if (strlen($extraIntHss) < 2){
				$extraIntHss = '0'.$extraIntHss;
			}
			//Se agrega el 0
			if (strlen($extraIntH) < 2){
				$extraIntH = '0'.$extraIntH;
			}

			return $extraIntH.':'.$extraIntHss.':00';
		//}else { 
		//	return 'El dato ingresado no es un numero entero';
		//}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma segundos a horas
* 
*===========================     Detalles    ===========================
* Permite ingresar un numero (de segundos) y transformarlo en formato hora
*===========================    Modo de uso  ===========================
* 	
* 	//transformar segundos	
* 	segundos2horas(3600);
* 
*===========================    Parametros   ===========================
* Integer    $segundos   Numero de segundos a transformar
* @return    Time
************************************************************************/
//Funcion
function segundos2horas($segundos) {
	//se verifica si es un numero lo que se recibe
	if (validarNumero($segundos)){ 
		$t = round($segundos);
		return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma horas a minutos
* 
*===========================     Detalles    ===========================
* Transforma las horas a minutos, esta debe ser ingresada en formato texto
* para que la funcion la reconozca correctamente
*===========================    Modo de uso  ===========================
* 	
* 	//transformar hora	
* 	horas2minutos('01:05:00');
* 
*===========================    Parametros   ===========================
* Time       $horas   La hora en formato texto
* @return    Integer
************************************************************************/
//Funcion
function horas2minutos($horas) { 
	//valido la hora
	if(validaHora($horas)){
		$t = EXPLODE(":", $horas); 
		$h = $t[0]; 
		if (isset($t[1])) { 
			$m = $t[1]; 
		} else { 
			$m = "00"; 
		} 
		$mm = ($h * 60)+$m; 
		return $mm;
	}else{
		return 'El dato ingresado no es una hora ('.$horas.')';
	} 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma a segundos una hora 
* 
*===========================     Detalles    ===========================
* Transforma las horas a segundos, esta debe ser ingresada en formato texto
* para que la funcion la reconozca correctamente
*===========================    Modo de uso  ===========================
* 	
* 	//se transforma la hora		
* 	horas2segundos('14:30:00');
* 
*===========================    Parametros   ===========================
* Time     $horas   La hora en formato texto
* @return  Integer
************************************************************************/
//Funcion
function horas2segundos($horas){
	//valido la hora
	if(validaHora($horas)){
		$timeExploded = explode(':', $horas);
		if (isset($timeExploded[2])) {
			return $timeExploded[0] * 3600 + $timeExploded[1] * 60 + $timeExploded[2];
		}
		return $timeExploded[0] * 3600 + $timeExploded[1] * 60;
	}else{
		return 'El dato ingresado no es una hora ('.$horas.')';
	}
	
    
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma a numero decimal una hora 
* 
*===========================     Detalles    ===========================
* Transforma las horas ingresadas a numeros con decimales, por 
* ejemplo 1:30 pasaria a 1.5 horas
*===========================    Modo de uso  ===========================
* 	
* 	//se transforma la hora		
* 	horas2decimales('14:30:00');
* 
*===========================    Parametros   ===========================
* Time     $horas   La hora en formato texto
* @return  Decimal
************************************************************************/
//Funcion
function horas2decimales($horas){
	//valido la hora
	if(validaHora($horas)){
		$hms = explode(":", $horas);
		return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
	}else{
		return 'El dato ingresado no es una hora ('.$horas.')';
	}
}




/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              Funciones  Fechas                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Convetir mes abreviado a mes completo
* 
*===========================     Detalles    ===========================
* Muestra el mes completo en el navegador a partir de sus primeras 3 letras
*===========================    Modo de uso  ===========================
* 	
* 	//se convierten los datos	
* 	Devolver_mes('Ene');
* 
*===========================    Parametros   ===========================
* String    $mes    Mes con 3 letras
* @return   String
************************************************************************/
//Funcion
function Devolver_mes($mes){
	//Paso a minusculas los datos recibidos
	$mes = strtolower($mes);
	//se definen las opciones disponibles
	$meses = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'  );
	//verifico si el dato ingresado existe dentro de las opciones
	if (in_array($mes, $meses)) {
		//busco el dato dentro de las opciones
		switch ($mes) {
			case 'ene':  $meslargo = 'Enero'; break;
			case 'feb':  $meslargo = 'Febrero'; break;
			case 'mar':  $meslargo = 'Marzo'; break;
			case 'abr':  $meslargo = 'Abril'; break;
			case 'may':  $meslargo = 'Mayo'; break;
			case 'jun':  $meslargo = 'Junio'; break;
			case 'jul':  $meslargo = 'Julio'; break;
			case 'ago':  $meslargo = 'Agosto'; break;
			case 'sep':  $meslargo = 'Septiembre'; break;
			case 'oct':  $meslargo = 'Octubre'; break;
			case 'nov':  $meslargo = 'Noviembre'; break;
			case 'dic':  $meslargo = 'Diciembre'; break;
		};
		//devuelvo el resultado
		return $meslargo;
	}else{
		return 'Dato fuera de parametros esperados';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma numero a texto (numero)
* 
*===========================     Detalles    ===========================
* Permite transformar el numero del mes a un texto, el cual antepone 
* un 0 en el caso de que el valor ingresado sea inferior a 10, los 
* valores a ingresear deben de estar entre el 1 y el 12
*===========================    Modo de uso  ===========================
* 	
* 	//se convierten los datos	
* 	numero_mes(1);
* 
*===========================    Parametros   ===========================
* Integer    $numero   Numero a transformar (de 1 a 12)
* @return    String
************************************************************************/
//Funcion
function numero_mes($numero){
	//se verifica si es un numero lo que se recibe
	if (validarNumero($numero)){ 
		//verifico que este dentro de los valores esperados
		if($numero>0&&$numero<13){
			switch ($numero) {
				case 1:  $mes = '01'; break;
				case 2:  $mes = '02'; break;
				case 3:  $mes = '03'; break;
				case 4:  $mes = '04'; break;
				case 5:  $mes = '05'; break;
				case 6:  $mes = '06'; break;
				case 7:  $mes = '07'; break;
				case 8:  $mes = '08'; break;
				case 9:  $mes = '09'; break;
				case 10: $mes = '10'; break;
				case 11: $mes = '11'; break;
				case 12: $mes = '12'; break;
			}
			return $mes;
		}else{
			return 'Numero fuera de parametros esperados';
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma numero a mes
* 
*===========================     Detalles    ===========================
* Permite transformar el numero del mes al nombre del mes que corresponde, 
* los valores a ingresear deben de estar entre el 1 y el 12
*===========================    Modo de uso  ===========================
* 	
* 	//se convierten los datos	
* 	numero_a_mes(1);
* 
*===========================    Parametros   ===========================
* Integer    $numero   Numero a transformar (de 1 a 12)
* @return    String
************************************************************************/
//Funcion
function numero_a_mes($numero){	
	//se verifica si es un numero lo que se recibe
	if (validarNumero($numero)){ 
		//verifico que este dentro de los valores esperados
		if($numero>0&&$numero<13){
			switch ($numero) {
				case 1:  $mes = 'Enero'; break;
				case 2:  $mes = 'Febrero'; break;
				case 3:  $mes = 'Marzo'; break;
				case 4:  $mes = 'Abril'; break;
				case 5:  $mes = 'Mayo'; break;
				case 6:  $mes = 'Junio'; break;
				case 7:  $mes = 'Julio'; break;
				case 8:  $mes = 'Agosto'; break;
				case 9:  $mes = 'Septiembre'; break;
				case 10: $mes = 'Octubre'; break;
				case 11: $mes = 'Noviembre'; break;
				case 12: $mes = 'Diciembre'; break;
			}
			return $mes;
		}else{
			return 'Numero fuera de parametros esperados';
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma un numero a mes (solo las primeras 3 letras)
* 
*===========================     Detalles    ===========================
* Permite transformar el numero del mes al nombre del mes que corresponde
* (solo las primeras 3 letras), los valores a ingresear deben de estar 
* entre el 1 y el 12
*===========================    Modo de uso  ===========================
* 	
* 	//se convierten los datos	
* 	numero_a_mes_corto(1);
* 
*===========================    Parametros   ===========================
* Integer    $numero   Numero a transformar (de 1 a 12)
* @return    String
************************************************************************/
//Funcion
function numero_a_mes_corto($numero){	
	//se verifica si es un numero lo que se recibe
	if (validarNumero($numero)){ 
		//verifico que este dentro de los valores esperados
		if($numero>0&&$numero<13){
			switch ($numero) {
				case 1:  $mes = 'Ene'; break;
				case 2:  $mes = 'Feb'; break;
				case 3:  $mes = 'Mar'; break;
				case 4:  $mes = 'Abr'; break;
				case 5:  $mes = 'May'; break;
				case 6:  $mes = 'Jun'; break;
				case 7:  $mes = 'Jul'; break;
				case 8:  $mes = 'Ago'; break;
				case 9:  $mes = 'Sep'; break;
				case 10: $mes = 'Oct'; break;
				case 11: $mes = 'Nov'; break;
				case 12: $mes = 'Dic'; break;
			}
			return $mes;
		}else{
			return 'Numero fuera de parametros esperados';
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el nombre del dia
* 
*===========================     Detalles    ===========================
* Devuelve el nombre del dia en base a un numero (1-7 : lunes a domingo)
*===========================    Modo de uso  ===========================
* 	
* 	//se convierten los datos	
* 	numero_nombreDia(3);
* 
*===========================    Parametros   ===========================
* Integer   $numero   Numero a transformar (de 1 a 7)
* @return   String
************************************************************************/
//Funcion
function numero_nombreDia($numero){
	//se verifica si es un numero lo que se recibe
	if (validarNumero($numero)){ 
		//verifico que este dentro de los valores esperados
		if($numero>0&&$numero<8){
			switch ($numero) {
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
			return 'Numero fuera de parametros esperados';
		}
	} else { 
		return 'El dato ingresado no es un numero';
	}
}







/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              Funciones  Valores                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma valores a porcentaje
* 
*===========================     Detalles    ===========================
* Permite transformar cualquier valor decimal ingresado en formato porcentaje
*===========================    Modo de uso  ===========================
* 	
* 	//se transforman los valores
* 	porcentaje(0.65);
* 
*===========================    Parametros   ===========================
* Decimal    $valor   Decimal a transformar
* @return    String
************************************************************************/
//Funcion
function porcentaje($valor){
	//se verifica si es un numero lo que se recibe
	if (validarNumero($valor)){ 
		$porcentaje = $valor *100;
		return number_format($porcentaje,0,',','.').' %';
	} else { 
		return 'El dato ingresado no es un numero';
	}
}



/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              Funciones  Textos                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Devuelve el monto ingresado en palabras
* 
*===========================     Detalles    ===========================
* Transforma los numeros ingresados a su equivalente en palabras
*===========================    Modo de uso  ===========================
* 	
* 	//se transforma los datos		
* 	numtoletras(1200);
* 
*===========================    Parametros   ===========================
* Integer  $monto   Valor a transformar en palabras
* @return  String
************************************************************************/
//Funcion
function numtoletras($monto){
	//se verifica si es un numero lo que se recibe
	if (validarNumero($monto)){ 
		$xarray = array(0 => "Cero",
			1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
			"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
			"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
			100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
		);

		$monto = trim($monto);
		$xlength = strlen($monto);
		$xpos_punto = strpos($monto, ".");
		$xaux_int = $monto;
		$xdecimales = "00";
		if (!($xpos_punto === false)) {
			if ($xpos_punto == 0) {
				$monto = "0" . $monto;
				$xpos_punto = strpos($monto, ".");
			}
			$xaux_int = substr($monto, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
			$xdecimales = substr($monto . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		}
	 
		$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
		$xcadena = "";
		for ($xz = 0; $xz < 3; $xz++) {
			$xaux = substr($XAUX, $xz * 6, 6);
			$xi = 0;
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
					break; // termina el ciclo
				}
	 
				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								 
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma lógica que las centenas)
							if (substr($xaux, 1, 2) < 10) {
								 
							} else {
								$key = (int) substr($xaux, 1, 2);
								if (TRUE === array_key_exists($key, $xarray)) {
									$xseek = $xarray[$key];
									$xsub = subfijo($xaux);
									if (substr($xaux, 1, 2) == 20)
										$xcadena = " " . $xcadena . " VEINTE " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3;
								}
								else {
									$key = (int) substr($xaux, 1, 1) * 10;
									$xseek = $xarray[$key];
									if (20 == substr($xaux, 1, 1) * 10)
										$xcadena = " " . $xcadena . " " . $xseek;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 1, 2) < 10)
							break;
						case 3: // checa las unidades
							if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
								 
							} else {
								$key = (int) substr($xaux, 2, 1);
								$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
								$xsub = subfijo($xaux);
								$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
							} // ENDIF (substr($xaux, 2, 1) < 1)
							break;
					} // END SWITCH
				} // END FOR
				$xi = $xi + 3;
			} // ENDDO
	 
			if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
				$xcadena.= " DE";
	 
			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
				$xcadena.= " DE";
	 
			// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
			if (trim($xaux) != "") {
				switch ($xz) {
					case 0:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN BILLON ";
						else
							$xcadena.= " BILLONES ";
						break;
					case 1:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN MILLON ";
						else
							$xcadena.= " MILLONES ";
						break;
					case 2:
						if ($monto < 1) {
							$xcadena = "CERO PESOS ";
						}
						if ($monto >= 1 && $monto < 2) {
							$xcadena = "UN PESO  ";
						}
						if ($monto >= 2) {
							$xcadena.= " PESOS  "; //
						}
						break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
			// ------------------      en este caso, para México se usa esta leyenda     ----------------
			$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
		} // ENDFOR ($xz)
		return trim($xcadena);
	} else { 
		return 'El dato ingresado no es un numero';
	}
	
    
}
//Sufijo del valor
function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}





/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              Funciones  Objetos                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma un objeto a un arreglo
* 
*===========================     Detalles    ===========================
* Transforma un objeto a un arreglo
*===========================    Modo de uso  ===========================
* 	
* 	//se transforman los datos		
* 	$array = objectToArray($obj);
* 
*===========================    Parametros   ===========================
* Object    $object   Objeto a Transformar
* @return   Array
************************************************************************/
//Funcion
function objectToArray($object){
    if (is_object($object)) {
        return json_decode(json_encode($object), true);
    } else {
        throw new \Exception('Not an object');
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma un arreglo a un objeto
* 
*===========================     Detalles    ===========================
* Transforma un arreglo a un objeto
*===========================    Modo de uso  ===========================
* 	
* 	//se transforman los datos		
* 	$obj = arrayToObject($array);
* 
*===========================    Parametros   ===========================
* Array     $array   Arreglo a Transformar
* @return   Object
************************************************************************/   
//Funcion
function arrayToObject(array $array = []){
    if (!is_array($array)) {
        throw new \Exception('Not an array');
    }

    $object = new \stdClass();
    if (is_array($array) && count($array) > 0) {
        foreach ($array as $name => $value) {
            if (is_array($value)) {
                $object->{$name} = arrayToObject($value);
            } else {
                $object->{$name} = $value;
            }
        }
    }
    return $object;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Transforma un arreglo a un texto
* 
*===========================     Detalles    ===========================
* Transforma un arreglo a un texto
*===========================    Modo de uso  ===========================
* 	
* 	//se transforman los datos		
* 	$string = arrayToString($array);
* 
*===========================    Parametros   ===========================
* Array     $array   Arreglo a Transformar
* @return   String
************************************************************************/      
//Funcion
function arrayToString(array $array = [], $delimiter = ' '){
    $pairs = [];
    foreach ($array as $key => $value) {
        $pairs[] = "$key=\"$value\"";
    }
    return implode($delimiter, $pairs);
}






?>
