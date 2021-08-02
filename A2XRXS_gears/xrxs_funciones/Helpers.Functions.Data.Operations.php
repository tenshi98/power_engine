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
$n_funct_dataoperations = 0;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Funciones                                                      */
/*                                                                                                                 */
/*******************************************************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Divide horas
* 
*===========================     Detalles    ===========================
* Permite dividir la hora en base a un numero entero, devuelve el 
* resultado en minutos, si se requiere en horas, utilizar la funcion 
* correspondiente
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	divHoras('14:00:00', 4);
* 
*===========================    Parametros   ===========================
* Time     $hora        Hora ingresada
* Integer  $divisor     Divisor de la hora
* @return  Integer
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function divHoras($hora,$divisor) {
	//valido la hora
	if(validaHora($hora)){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($divisor)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($divisor)){ 
				$minutos = horas2minutos($hora);
				$difm    = $minutos/$divisor;
				return $difm;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return 'El dato ingresado no es una hora ('.$hora.')';
	}  
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Multiplicar Horas
* 
*===========================     Detalles    ===========================
* Permite multiplicar las horas ingresadas por un numero entero, el 
* resultado es devuelto en formato hora
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	multHoras('14:00:00', 4);
* 
*===========================    Parametros   ===========================
* Time     $hora            Hora ingresada
* Integer  $multiplicador   Multiplicador de la hora
* @return  Time
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function multHoras($hora,$multiplicador) {
	//valido la hora
	if(validaHora($hora)){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($multiplicador)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($multiplicador)){ 
				$seconds  = strtotime("1970-01-01 $hora UTC");
				$multiply = $seconds * $multiplicador;  //Aqui se multiplica
				$seconds  = $multiply;
				$zero     = new DateTime("@0");
				$offset   = new DateTime("@$seconds");
				$diff     = $zero->diff($offset);
				return sprintf("%02d:%02d:%02d", $diff->days * 24 + $diff->h, $diff->i, $diff->s);
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return 'El dato ingresado no es una hora ('.$hora.')';
	} 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Restar Horas
* 
*===========================     Detalles    ===========================
* Permite restar una hora a otra hora, devolviendo un resultado en 
* formato hora, verifica cual hora es mayor para evitar problemas 
* en la resta
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	restahoras('14:00:00', '07:00:00');
* 
*===========================    Parametros   ===========================
* Time    $hora        Hora ingresada
* Time    $horaresta   Cantidad de horas a restar
* @return  Time
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function restahoras($hora, $horaresta){
		
	//valido la hora
	if(validaHora($hora)&&validaHora($horaresta)){
		
		//Se verifica cual es el mayor
		if(strtotime($hora)>strtotime($horaresta)){
			$horaresta  = sumahoras($horaresta, '24:00:00');
		}
		
		//Separo la hora
		$hora      = explode(":",$hora);
		$horaresta = explode(":",$horaresta);
		
		//obtengo valores por separado
		$horai = $hora[0];
		$mini  = $hora[1];
		$segi  = $hora[2];

		//obtengo valores por separado
		$horaf = $horaresta[0];
		$minf  = $horaresta[1];
		$segf  = $horaresta[2];
		
		//transformo a segundos
		$ini   = ((($horai*60)*60)+($mini*60)+$segi);
		$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
		//ejecuto operacion
		$dif   = $fin-$ini;
		
		//devuelvo
		return segundos2horas($dif);
	}else{
		return 'El dato ingresado no es una hora ('.$hora.' - '.$horaresta.')';
	} 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Sumar Horas
* 
*===========================     Detalles    ===========================
* Permite la suma de dos horas, dando como resultado otro dato con 
* formato hora
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	sumahoras('14:00:00', '07:00:00');
* 
*===========================    Parametros   ===========================
* Time     $hora        Hora ingresada
* Time     $horasuma    Cantidad de horas a sumar
* @return  Time
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function sumahoras($hora,$horasuma){
	//valido la hora
	//if(validaHora($hora)&&validaHora($horasuma)){
	if(validaHora($hora)){	
		
		//Separo la hora
		$hora     = explode(":",$hora);
		$horasuma = explode(":",$horasuma);
		
		//obtengo valores por separado
		$horai = $hora[0];
		$mini  = $hora[1];
		$segi  = $hora[2];

		//obtengo valores por separado
		$horaf = $horasuma[0];
		$minf  = $horasuma[1];
		$segf  = $horasuma[2];
		
		//transformo a segundos
		$ini   = ((($horai*60)*60)+($mini*60)+$segi);
		$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
		//ejecuto operacion
		$dif   = $fin+$ini;
		
		//devuelvo
		return segundos2horas($dif);
	}else{
		return 'El dato ingresado no es una hora ('.$hora.' + '.$horasuma.')';
	} 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Sumar dias
* 
*===========================     Detalles    ===========================
* Permite sumar n cantidad de dias a una fecha entregada
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	sumarDias('2019-01-02', 5);
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha entregada
* Integer  $nDias   Cantidad de dias a sumar
* @return  Date
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function sumarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '+'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				return $nuevafecha;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha ('.$Fecha.')';
	}
}  
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Restar dias
* 
*===========================     Detalles    ===========================
* Permite restar n cantidad de dias a una fecha entregada
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	restarDias('2019-01-02', 5);
* 
*===========================    Parametros   ===========================
* Date     $Fecha   Fecha entregada
* Integer  $nDias   Cantidad de dias a restar
* @return  Date
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function restarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (validarNumero($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '-'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				return $nuevafecha; 
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha ('.$Fecha.')';
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Ver dias transcurridos entre fechas
* 
*===========================     Detalles    ===========================
* Permite ver el numero de los dias transcurridos entre dos fechas entregadas
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta operacion
* 	dias_transcurridos('2019-01-02', '2019-02-02');
* 
*===========================    Parametros   ===========================
* Date     $fecha_i   Fecha de inicio 
* Date     $fecha_f   Fecha de termino
* @return  Integer
************************************************************************/
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function dias_transcurridos($fecha_i,$fecha_f){
	//valido las fechas
	if(validaFecha($fecha_i)){
		if(validaFecha($fecha_f)){
			$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
			$dias 	= abs($dias); 
			$dias   = floor($dias);		
			
			return $dias;
		}else{
			return 'Fecha de termino no es una fecha';
		}
	}else{
		return 'Fecha de inicio no es una fecha';
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
//control numero funciones
$n_funct_dataoperations++;
//Funcion
function diferencia_meses( $fechainicial, $fechafinal ) {  
	//valido las fechas
	if(validaFecha($fechainicial)&&validaFecha($fechafinal)){
		
		$datetime1 = new DateTime($fechainicial);
		$datetime2 = new DateTime($fechafinal);

		// obtenemos la diferencia entre las dos fechas
		$interval=$datetime2->diff($datetime1);

		// obtenemos la diferencia en meses
		$intervalMeses=$interval->format("%m");

		// obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
		$intervalAnos = $interval->format("%y")*12;

		$meses = $intervalMeses+$intervalAnos+1;

		return $meses;
	}else{
		return 'El dato ingresado no es una fecha ('.$fechainicial.' - '.$fechafinal.')';
	}
}


?>
