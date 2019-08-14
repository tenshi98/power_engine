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
function divHoras($hora,$divisor) {
	//valido la hora
	if(validaHora($hora)){
		//se verifica si es un numero lo que se recibe
		if (is_numeric($divisor)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($divisor)){ 
				$h1      = substr($hora,0,-3);
				$m1      = substr($hora,3,2);
				$minutos = (($h1*60)*60)+($m1*60);
				$dif     = $minutos/$divisor;
				$difm    = floor($dif/60);
				return $difm;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		}
	}else{
		return 'El dato ingresado no es una hora';
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
function multHoras($hora,$multiplicador) {
	//valido la hora
	if(validaHora($hora)){
		//se verifica si es un numero lo que se recibe
		if (is_numeric($multiplicador)){ 
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
		return 'El dato ingresado no es una hora';
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
function restahoras($hora, $horaresta){
	//valido la hora
	if(validaHora($hora)&&validaHora($horaresta)){
		//Se verifica cual es el mayor
		if(strtotime($horaini)>strtotime($horafin)){
			$horaresta  = sumahoras($horafin, '24:00:00');
		}
		
		$horai = substr($hora,0,2);
		$mini  = substr($hora,3,2);
		$segi  = substr($hora,6,2);

		$horaf = substr($horaresta,0,2);
		$minf  = substr($horaresta,3,2);
		$segf  = substr($horaresta,6,2);

		$ini   = ((($horai*60)*60)+($mini*60)+$segi);
		$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
		$dif   = $fin-$ini;

		$difh  = floor($dif/3600);
		$difm  = floor(($dif-($difh*3600))/60);
		$difs  = $dif-($difm*60)-($difh*3600);
		return date("H:i:s",mktime($difh,$difm,$difs));
	}else{
		return 'El dato ingresado no es una hora';
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
* Time    $hora        Hora ingresada
* Time    $horasuma    Cantidad de horas a sumar
* @return  Time
************************************************************************/
//funcion para sumar horas
function sumahoras($hora,$horasuma){
	//valido la hora
	if(validaHora($hora)&&validaHora($horasuma)){
		$hora=explode(":",$hora);
		$horasuma=explode(":",$horasuma);
		$horas=(int)$hora[0]+(int)$horasuma[0];
		$minutos=(int)$hora[1]+(int)$horasuma[1];
		$segundos=(int)$hora[2]+(int)$horasuma[2];
		$horas+=(int)($minutos/60);
		$minutos=(int)($minutos%60)+(int)($segundos/60);
		$segundos=(int)($segundos%60);
		return (intval($horas)<10?'0'.intval($horas):intval($horas)).':'.($minutos<10?'0'.$minutos:$minutos).':'.($segundos<10?'0'.$segundos:$segundos); 
	}else{
		return 'El dato ingresado no es una hora';
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
function sumarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (is_numeric($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '+'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				return $nuevafecha;
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha';
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
function restarDias($Fecha,$nDias){
	//valido las fechas
	if(validaFecha($Fecha)){
		//se verifica si es un numero lo que se recibe
		if (is_numeric($nDias)){ 
			//Verifica si el numero recibido es un entero
			if (validaEntero($nDias)){ 
				$nuevafecha = strtotime ( '-'.$nDias.' day' , strtotime ( $Fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				return $nuevafecha; 
			} else { 
				return 'El dato ingresado no es un numero entero';
			}
		} else { 
			return 'El dato ingresado no es un numero';
		} 
	}else{
		return 'El dato ingresado no es una fecha';
	}
	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Ver dias transcurridos entre fechas
* 
*===========================     Detalles    ===========================
* Permite ver los dias transcurridos entre dos fechas entregadas
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
//funcion que indica la diferencia de dias entre fechas
function dias_transcurridos($fecha_i,$fecha_f){
	//valido las fechas
	if(validaFecha($fecha_i)&&validaFecha($fecha_f)){
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		
		return $dias;
	}else{
		return 'El dato ingresado no es una fecha';
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
		return 'El dato ingresado no es una fecha';
	}
}


?>
