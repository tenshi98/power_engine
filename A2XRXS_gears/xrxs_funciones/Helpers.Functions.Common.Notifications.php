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
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Genera un cuadro de alerta
* 
*===========================     Detalles    ===========================
* Permite generar un cuadro de alerta personalizado
*===========================    Modo de uso  ===========================
* 	//se imprime input	
* 	info_post_data(1,'dato' );
* 	info_post_data(2,'<strong>Dato:</strong>explicacion' );
* 	info_post_data(3,'<strong>Dato 1:</strong>explicacion 1 <br/><strong>Dato 2:</strong>explicacion 2' );
* 	info_post_data(4,'bla' );
* 
*===========================    Parametros   ===========================
* Integer  $type            Tipo de mensaje (define el color de este)
* String   $Text            Texto del mensaje (permite HTML)
* @return  String
************************************************************************/
//Funcion
function info_post_data($type, $Text){
		
	//Valido si los datos ingresados estan correctos
	if (validarNumero($type)){
			
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido_1 = array(1,2,3,4,5,6,7);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($type, $requerido_1)) {
			alert_post_data(4,1,1, 'La configuracion $type entregada no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Selecciono el tipo de mensaje
			switch ($type) {
				case 1: $tipo = 'bs-callout-default';  break;
				case 2: $tipo = 'bs-callout-primary';  break;
				case 3: $tipo = 'bs-callout-success';  break;
				case 4: $tipo = 'bs-callout-info';     break;
				case 5: $tipo = 'bs-callout-warning';  break;
				case 6: $tipo = 'bs-callout-danger';   break;
				case 7: $tipo = 'bs-callout-link';     break;
			}
			
			//generacion del mensaje
			$input  = '<div class="bs-callout '.$tipo.'" >'.$Text.'<div class="clearfix"></div></div>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	
}

?>
