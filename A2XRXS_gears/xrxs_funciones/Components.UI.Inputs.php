<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                                    Clases                                                       */
/*******************************************************************************************************************/
class Basic_Inputs{
    
    /////////////////////////////        PRIVADAS        /////////////////////////////
    /****************************************************************************************/
	//imprime el script que impide el tipeo de teclas raras
	private function solo_letras($name){
		$input = '
		<script>
			function soloLetras_'.$name.'(e){
				key = e.keyCode || e.which;
				tecla = String.fromCharCode(key).toLowerCase();
				letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
				especiales = [8,37,38,39,40,46];

				tecla_especial = false
				for(var i in especiales){
					if(key == especiales[i]){
						tecla_especial = true;
						break;
					} 
				}		 
				if(letras.indexOf(tecla)==-1 && !tecla_especial)
				return false;
			}
		</script>';
		
		echo $input;
	}
	
	/****************************************************************************************/
	//imprime el script que impide el tipeo de teclas raras
	private function solo_letras_textarea($name){
		$input = '
		<script>
			function soloLetrasTextArea_'.$name.'(e){
				key = e.keyCode || e.which;
				tecla = String.fromCharCode(key).toLowerCase();
				letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
				especiales = [8,13,37,38,39,40,46];

				tecla_especial = false
				for(var i in especiales){
					if(key == especiales[i]){
						tecla_especial = true;
						break;
					} 
				}		 
				if(letras.indexOf(tecla)==-1 && !tecla_especial)
				return false;
			}
		</script>';
		
		echo $input;
	}
	
	/****************************************************************************************/
	//imprime el script que solo permite el tipeo de numeros
	private function solo_numeros_naturales($name){
		$input = '
		<script>
			<!--
				function soloNumerosNaturales_'.$name.'(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						//valor negativo
						}else if(charCode == 45){
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				}
			//-->
	 
		</script>';
		
		echo $input;
	}
	
	/****************************************************************************************/
	//imprime el script que solo permite el tipeo de numeros
	private function solo_numeros_naturales_enteros($name){
		$input = '
		<script>
			<!--
				function soloNumerosEnteros_'.$name.'(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return false;
						//valor negativo
						}else if(charCode == 45){
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}	
				}
			//-->
	 
		</script>';
		
		echo $input;
	}
	
	/****************************************************************************************/
	//imprime el script que solo permite el tipeo de numeros
	private function solo_numeros_naturales_enteros_positivos($name){
		$input = '
		<script>
			<!--
				function soloNumerosEnterosPositivos_'.$name.'(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return false;
						//valor negativo
						}else if(charCode == 45){
							return false;
						}else{
							return false;
						}
					}else{
						return true;
					}	
				}
			//-->
	 
		</script>';
		
		echo $input;
	}
	
	/****************************************************************************************/
	//imprime el script que impide el tipeo de teclas raras
	private function solo_rut($name){
		$input = '
		<script>
			function soloRut_'.$name.'(e){
				key = e.keyCode || e.which;
				tecla = String.fromCharCode(key).toLowerCase();
				letras = "kK1234567890-.";
				especiales = [8,37,38,39,40,46];

				tecla_especial = false
				for(var i in especiales){
					if(key == especiales[i]){
						tecla_especial = true;
						break;
					} 
				}
						 
				if(letras.indexOf(tecla)==-1 && !tecla_especial)
				return false;
			}
		</script>';
		
		echo $input;
	}
	
	
	
	/////////////////////////////        PUBLICAS        /////////////////////////////
    /*******************************************************************************************************************/
	/***********************************************************************
	* Crea un titulo
	* 
	*===========================     Detalles    ===========================
	* Permite un titulo para los formularios
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_tittle(1, 'dato' );
	* 	$Form->form_tittle(2, '<strong>Dato:</strong>explicacion' );
	* 	$Form->form_tittle(3, '<strong>Dato 1:</strong>explicacion 1 <br/><strong>Dato 2:</strong>explicacion 2' );
	* 	$Form->form_tittle(4, 'bla' );
	* 	$Form->form_tittle(5, 'bla' );
	* 	$Form->form_tittle(6, 'bla' );
	* 
	*===========================    Parametros   ===========================
	* String   $type      Tipo de titulo
	* String   $Text      Texto del titulo
	* @return  String
	************************************************************************/
	public function form_tittle($type, $Text){
		
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$tipos = array(1, 2, 3, 4, 5, 6);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($type, $tipos)) {
			alert_post_data(4,1,1, 'La configuracion $type ('.$type.') entregada no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Selecciono el tipo de mensaje
			switch ($type) {
				case 1:
					$tipo = 'h1';
					break;
				case 2:
					$tipo = 'h2';
					break;
				case 3:
					$tipo = 'h3';
					break;
				case 4:
					$tipo = 'h4';
					break;
				case 5:
					$tipo = 'h5';
					break;
				case 6:
					$tipo = 'p';
					break;
			}

			//generacion del mensaje
			$input = '<'.$tipo.'>'.$Text.'</'.$tipo.'>';	
				
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un cuadro de mensaje
	* 
	*===========================     Detalles    ===========================
	* Permite crear un cuadro de alerta mostrando mensajes de explicacion 
	* para los inputs
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_post_data(1, 'dato' );
	* 	$Form->form_post_data(2, '<strong>Dato:</strong>explicacion' );
	* 	$Form->form_post_data(3, '<strong>Dato 1:</strong>explicacion 1 <br/><strong>Dato 2:</strong>explicacion 2' );
	* 	$Form->form_post_data(4, 'bla' );
	* 
	*===========================    Parametros   ===========================
	* String   $type      Tipo de mensaje
	* String   $Text      Texto del mensaje
	* @return  String
	************************************************************************/
	public function form_post_data($type, $Text){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$tipos = array(1, 2, 3, 4);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($type, $tipos)) {
			alert_post_data(4,1,1, 'La configuracion $type ('.$type.') entregada no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			alert_post_data($type,1,1, $Text);
		}
		
	}
	
	/***********************************************************************
	* Crea un input tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, especificamente para ingresar usuario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_login_usr('Usuario','user', '');
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_login_usr($placeholder,$name, $value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			$x='required';
			$_SESSION['form_require'].=','.$name;
			
			//filtrado de teclas
			$input = $this->solo_letras($name);
				
			//generacion del input
			$input .= '
				<div class="field" id="div_'.$name.'">
					<input type="text" placeholder="'.$placeholder.'" class="form-control top" name="'.$name.'"  autocomplete="off" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
				</div>
			';
			
			//Imprimir dato	
			echo $input;
		}
		
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo rut
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo rut, el cual valida el formato de rut ingresado
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_login_rut('Rut','rut', '');
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_login_rut($placeholder,$name, $value){
		
		//********************************************************/
		//Definicion de errores
		$errorn = 0;
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			$x='required';
			$_SESSION['form_require'].=','.$name;
			
			//filtrado de teclas
			$input = $this->solo_rut($name);
				
			//generacion del input
			$input .= '
				<div class="field" id="div_'.$name.'">
					<input type="text"     placeholder="'.$placeholder.'"    class="form-control top"  id="'.$name.'"  name="'.$name.'"  autocomplete="off" value="'.$w.'" '.$x.' onkeypress="return soloRut_'.$name.'(event)">
				</div>';
					
			//Validacion Script		
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
			
			//script ejecucion
			$input .='
				<script>
					$("#'.$name.'").rut();
				</script>';
				
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo password
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo password, el cual oculta los datos 
	* ingresados, pero que permite verlos si se presiona el boton configurado
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_login_pass('Password','password', '');
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_login_pass($placeholder,$name, $value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			$x='required';
			$_SESSION['form_require'].=','.$name;
			
			//filtrado de teclas
			$input = $this->solo_letras($name);
				
			//generacion del input
			$input .= '
				<div class="field" id="div_'.$name.'">
					<div class="input-group col-sm-12 bootstrap-timepicker">
						<input type="password" placeholder="'.$placeholder.'" class="form-control bottom border_fix" name="'.$name.'" id="'.$name.'" autocomplete="off" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
						<span class="pass_view_log" id="view_button_'.$name.'"><i class="fa fa-eye" aria-hidden="true"></i></span>
					</div>
				</div>';
			
			//cambia el tipo de input al presionar el boton 
			$input .= '		
				<script>
					$(document).ready(function() {
						$("#view_button_'.$name.'").bind("mousedown touchstart", function() {
							$("#'.$name.'").attr("type", "text");
						})
						, $("#view_button_'.$name.'").bind("mouseup touchend", function() {
							$("#'.$name.'").attr("type", "password");
						})
					});
				</script>
			';	
			
			//Imprimir dato	
			echo $input;
		}
	}	
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo email
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, el cual permite ingresar elemail
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_login_mail('Email','email', '');
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_login_mail($placeholder,$name, $value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			$x='required';
				
			//filtrado de teclas
			$input = $this->solo_letras($name);
				
			//generacion del input
			$input .= '
				<div class="field" id="div_'.$name.'">
					<input type="email"  placeholder="'.$placeholder.'"    class="form-control"    name="'.$name.'"  autocomplete="off" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
				</div>
			';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, al enviar un nombre tipo arreglo, 
	* lo remmplaza por nombre normal
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input('text','Categoria','Cat', 'Categoria 1', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input($type,$placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){$w='';}else{$w=$value;}
			//if($value==0){$w='';echo $value;}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
				
			//filtrado de teclas
			$input = $this->solo_letras($EXname);
				
			//generacion del input
			$input .= '
				<div class="field">
					<input class="form-control" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$EXname.'(event)">
				</div>
			';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, permite nombres tipo arreglo
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_hold('text','Categoria','Cat', 'Categoria 1', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_hold($type,$placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
				
			//filtrado de teclas
			$input = $this->solo_letras($EXname);
				
			//generacion del input
			$input .= '
				<div class="field">
					<input class="form-control" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$EXname.'(event)">
				</div>';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input invisible
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que no es mostrado por el navegador, 
	* permite pasar datos ocultos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_hidden('idCategoria', 1, 1 );
	* 	$Form->input_hidden('Categoria', 'Categoria', 1 );
	* 	$Form->input_hidden('idCategoria', 1, 2 );
	* 
	*===========================    Parametros   ===========================
	* String   $name       Nombre del identificador del Input
	* String   $value      Valor por defecto, puede ser texto o valor
	* Integer  $required   Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_hidden($name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value!=''){$w=$value;}else{$w='';}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//generacion del input
			$input = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' >';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, permite nombres tipo arreglo
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_values_val('text','Categoria','Cat', 1, '', '', 25);
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $extra_class   Permite ingresar estilos extras al input
	* String   $style         Permite escribir directamente un estilo css
	* String   $value         Valor por defecto, ingresar numeros enteros
	* @return  String
	************************************************************************/
	public function input_values_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==''){$w='';}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//filtrado de teclas
			$input = $this->solo_numeros_naturales_enteros($name);
				
			//generacion del input
			$input .= '
			<div class="field">
				<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return soloNumeros_'.$name.'(event)" value="'.$w.'" >
			</div>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un textarea
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo text
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_textarea_obs('Observaciones','observaciones', 1, '', 'Observaciones varias' );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $style         Permite escribir directamente un estilo css
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_textarea_obs($placeholder,$name, $required,$style,$value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){    $w = '';  }else{   $w = $value;}
			if($required==1){  $x = '';  }elseif( $required==2){ $x='required';$_SESSION['form_require'].=','.$name;}
			
			//filtrado de teclas
			$input = $this->solo_letras_textarea($EXname);
				
			//generacion del input
			$input .= '
			<div class="field">
				<textarea placeholder="'.$placeholder.'" name="'.$name.'" id="'.$EXname.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; '.$style.'" '.$x.' onkeypress="return soloLetrasTextArea_'.$EXname.'(event)" >'.$w.'</textarea>
			</div>';
			
			//Ejecucion Javascript
			$input .= '
				<script src=\''.DB_SITE_REPO.'/LIBS_js/autosize/dist/autosize.js\'></script>
				<script>
					autosize(document.querySelectorAll(\'textarea\'));
				</script>
			';

			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_text('text','Categoria','Cat', 1, '', '' );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $extra_class   Permite ingresar estilos extras al input
	* String   $style         Permite escribir directamente un estilo css
	* @return  String
	************************************************************************/
	public function input_text($type,$placeholder,$name,$required,$extra_class,$style){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//filtrado de teclas
			$input = $this->solo_letras($EXname);
				
			//generacion del input
			$input .= '
			<div class="field">
				<input class="form-control '.$extra_class.'" style="'.$style.'" "type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$EXname.'"  '.$x.' onkeypress="return soloLetras_'.$EXname.'(event)">
			</div>';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_text_val('text','Categoria','Cat', 1, '', '', 'Categoria' );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $extra_class   Permite ingresar estilos extras al input
	* String   $style         Permite escribir directamente un estilo css
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_text_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){   $w = ''; }else{   $w=$value;}
			if($required==1){ $x = ''; }elseif( $required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//filtrado de teclas
			$input = $this->solo_letras($EXname);
				
			//generacion del input
			$input .= '
			<div class="field">
				<input class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$EXname.'(event)">
			</div>';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_values_val_2('text','Categoria','Cat', 1, '', '', 'Categoria' );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $extra_class   Permite ingresar estilos extras al input
	* String   $style         Permite escribir directamente un estilo css
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_values_val_2($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){$w='0';}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//filtrado de teclas
			$input = $this->solo_numeros_naturales($EXname);
				
			//generacion del input
			$input .= '
			<div class="field">
				<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$EXname.'"  '.$x.' onkeypress="return soloNumeros_'.$EXname.'(event)" value="'.$w.'" >
			</div>';
			
			//Imprimir dato	
			echo $input;
		}
	} 
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input de fechas
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que muestra un calendario al tratar de escribir 
	* dentro de este, una vez seleccionada la fecha, el calendario 
	* traspasa la fecha al input
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_date('Fecha','fecha', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_date($placeholder,$name, $required){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			
			//Validacion de variables
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//Solicitud de recursos
			$input  ='<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
			$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
			$input .='<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>';
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
				
			//generacion del input
			$input .='
			<div class="field">
				<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'"  '.$x.'>
			</div>';
			
			//script activacion
			$input .='<script type="text/javascript">
				$(document).ready(function()
				{
					$("#'.$name.'").bootstrapMaterialDatePicker
					({
						time: false,
						lang: "es",
						weekStart: 1,
						cancelText : "Cancelar",
						clearButton: true,
						clearText : "Limpiar",
					});
					
				});
				</script>';
					
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input de seleccion de hora
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input dentro del cual se selecciona la hora que se 
	* desea ingresar, el selector de hora aparece al presionar dentro del 
	* input, una vez seleccionada la hora esta sera traspasada al input
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_time('Hora', 'hora','', 1);
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Time     $value         Valor por defecto, debe tener formato hora
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_time($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validaHora($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es una hora');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){   $w = ''; }else{   $w=$value;}
			if($required==1){ $x = ''; }elseif( $required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			
			//solicitud de recursos
			$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
			
			//generacion del input
			$input .='
			<div class="field">
				<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' >
			</div>';
			
			//solicitud de recursos
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
			
			//script activacion
			$input .='<script type="text/javascript">
				$("#'.$EXname.'").clockpicker({
					placement: "top",
					align: "right",
					donetext: "Listo"
				});
				</script>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input de seleccion de hora
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input dentro del cual se selecciona la hora que se 
	* desea ingresar, el selector de hora aparece al presionar dentro del 
	* input, una vez seleccionada la hora esta sera traspasada al input
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_time_popover('Hora Inspeccion','H_inspeccion', '', 1);
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Time     $value         Valor por defecto, debe tener formato hora
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_time_popover($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//valido la hora
		if(!validaHora($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El dato ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es una hora');
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){   $w = ''; }else{   $w=$value;}
			if($required==1){ $x = ''; }elseif( $required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			
			//solicitud de recursos
			$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/popover_timepicker/css/timepicker.css">';
			$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/popover_timepicker/js/timepicker.js">';
			
			//generacion del input
			$input .='
			<div class="field">
				<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' >
			</div>';
			
			//script activacion
			$input .='<script type="text/javascript">
				$("#'.$EXname.'").timepicker();
				</script>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo radio
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo radio 
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_radio('Opciones','opciones', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $checked       Si dato essta marcado (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_radio($placeholder,$name,$value,$checked){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($checked, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $checked ('.$checked.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($checked==1){$x='';}elseif($checked==2){$x='checked';}
				
			//generacion del input
			$input = '
			<div class="field">
				<div class="radio">
					<input type="radio" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$x.'>
					<label>'.$placeholder.'</label>
				</div>
			</div>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo checkbox
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo checkbox
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_checkbox('Opciones','opciones', '');
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* @return  String
	************************************************************************/
	public function input_checkbox($placeholder,$name,$value){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//generacion del input
			$input = '
			<div class="field">
				<div class="checkbox">
					<input type="checkbox" name="'.$name.'" id="'.$name.'" value="'.$value.'">
					<label>'.$placeholder.'</label>
				</div>
			</div>';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea una linea con un checkbox de terminos y condiciones
	* 
	*===========================     Detalles    ===========================
	* Permite crear una linea en donde muestra la opcion de terminos y 
	* condiciones, al tener esta opcion presente deshabilita el boton 
	* submit del formulario, impidiendo su ejecucion hasta que no se 
	* acepte, el enlace abre un popup con lo que el usuario debe aceptar
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_terms_and_conditions('terminos','He leido los ','www.google.cl','terminos y condiciones', 'submit_btn' );
	* 
	*===========================    Parametros   ===========================
	* String   $name         Nombre del identificador del Input
	* String   $inicio       Texto inicio
	* String   $link         Enlace con el documento a mostrar en el popup
	* String   $fin          Texto final
	* String   $submit_name  Identificador del boton submit del formulario
	* @return  String
	************************************************************************/
	public function terms_and_conditions($name, $inicio, $link, $fin, $submit_name){
		
		//generacion del input
		$input = '
		<div class="field">
			<div class="checkbox checkbox-primary">
				<input class="styled" type="checkbox" name="'.$name.'" id="'.$name.'" value="1" onchange="acbtn_'.$name.'(this)">
				<label>
					'.$inicio.'  <a class="iframe" href="'.$link.'">'.$fin.'</a> 
				</label>
			</div>
		</div>
		';
			
		//ejecucion script	
		$input .= '
			<script>
				//se desactiva el boton f5
				window.onload = function () {
					disableSubmit();
				}
				//se desactiva el boton submit
				function disableSubmit() {
					document.getElementById("'.$submit_name.'").disabled = true;
				}
				//si se esta de acuerdo se activa el boton submit
				function acbtn_'.$name.'(element) {
					if(element.checked) {
						document.getElementById("'.$submit_name.'").disabled = false;
					}else  {
						document.getElementById("'.$submit_name.'").disabled = true;
					}
				}
			</script>
			';

		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input que solo admite numeros
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que solo permite el ingreso de numeros, 
	* permite valores decimales y numeros negativos, agregando botones 
	* en ambos lados, que aumentan o disminuyen los valores ingresados, 
	* en los rangos preestablecido
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_number_spinner('Numeros','numeros', '', 1, 50, 1, 2, 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Decimal  $value         Valor por defecto, ingresar numeros enteros o decimales
	* Decimal  $min           Valor minimo posible
	* Decimal  $max           Valor maximo posible
	* Decimal  $step          Valor a aumentar o reducir
	* Integer  $ndecimal      Numero de decimales a aceptar
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_number_spinner($placeholder,$name, $value, $min, $max, $step, $ndecimal, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($min)&&$min!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $min ('.$min.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($max)&&$max!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $max ('.$max.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($step)&&$step!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $step ('.$step.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($ndecimal)&&$ndecimal!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $ndecimal ('.$ndecimal.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//se verifica si es un numero entero lo que se recibe
		if (!validaEntero($ndecimal)&&$ndecimal!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $ndecimal ('.$ndecimal.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==0){    $w = ''; }elseif($value!=0){   $w = $value;}
			if($required==1){ $x = ''; }elseif($required==2){$x = 'required';$_SESSION['form_require'].=','.$name;}	
			
			//solicitud de recursos
			$input  ='<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.js"></script>';
			$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.css">';
			
			//generacion del input
			$input .='
			<div class="field">
				<input placeholder="'.$placeholder.'" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$EXname.'(event)">
			</div>';
					
			//script activacion
			$input .= '
				<script>
					//se inicializa el plugin
					$("input[name=\''.$EXname.'\']").TouchSpin({
						min: '.$min.',
						max: '.$max.',
						step: '.$step.',
						decimals: '.$ndecimal.',
						boostat: 5,
						maxboostedstep: 10
					});
				</script>';
				
			//filtrado de teclas
			$input .= $this->solo_numeros_naturales($EXname);
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input que solo admite numeros
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que solo permite el ingreso de numeros 
	* enteros positivos, agregando un icono de telefono
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_phone('Telefono','fono', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, ingresar numeros enteros
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_phone($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//filtrado de teclas
			$input = $this->solo_numeros_naturales_enteros_positivos($EXname);
						
			//generacion del input
			$input .= '
			<div class="field">
				<div class="input-group bootstrap-timepicker">
					<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnterosPositivos_'.$EXname.'(event)"  >
					<span class="input-group-addon add-on"><i class="fa fa-phone" aria-hidden="true"></i></span> 
				</div>
			</div>';

			//Imprimir dato	
			echo $input;
		}	
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input que solo admite numeros
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que solo permite el ingreso de numeros 
	* enteros positivos, agregando un icono de fax
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_fax('Fax','fax', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, ingresar numeros enteros
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_fax($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//filtrado de teclas
			$input = $this->solo_numeros_naturales_enteros_positivos($EXname);
						
			//generacion del input
			$input .= '
			<div class="field">
				<div class="input-group bootstrap-timepicker">
					<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnterosPositivos_'.$EXname.'(event)"  >
					<span class="input-group-addon add-on"><i class="fa fa-fax" aria-hidden="true"></i></span> 
				</div>
			</div>';

			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input que solo admite numeros
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que solo permite el ingreso de numeros, 
	* permite valores decimales y numeros negativos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_number('Numeros','numeros', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Decimal  $value         Valor por defecto, ingresar numeros enteros o decimales
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_number($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//generacion del input
			$input ='<div class="field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$EXname.'(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-subscript" aria-hidden="true"></i></span> 		
						</div>
					</div>';
					
			//filtrado de teclas
			$input .= $this->solo_numeros_naturales($EXname);
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input desactivado
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input desactivado, el cual no puede ser modificado 
	* por el usuario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_disabled('text', 'Dia actual','dia', '2018-02-02', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_disabled($type,$placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==''){$w='';}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//generacion del input
			$input = '<input type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control '.$name.'" value="'.$w.'"  '.$x.' disabled="disabled">';	
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo texto que solo admite Rut
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto en el cual solo se pueden ingresar 
	* Rut chilenos, estos son formateados (puntos separador de miles) y 
	* validados como rut
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_rut('Rut','rut', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function input_rut($placeholder,$name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){$w='';}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
			
			//filtrado de teclas
			$input = $this->solo_rut($EXname);
				
			//generacion del input
			$input .= '<div class="field">
							<div class="input-group bootstrap-timepicker">
								<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloRut_'.$EXname.'(event)"  >
								<span class="input-group-addon add-on"><i class="fa fa-male" aria-hidden="true"></i></span> 
							</div>
						</div>';
			
			//Validacion Script		
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
			
			//script activacion
			$input.='
				<script>
					$("#'.$EXname.'").rut();
				</script>';
					
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un tipo texto con la opcion de poner un icono
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo texto, con un icono en el lado derecho, 
	* el icono es tomado de la libreria de fontawesome
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_icon('Categoria','idCategoria', 1, 1,'fa fa-map');
	* 
	*===========================    Parametros   ===========================
	* String   $type          Tipo de input creado
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $icon          icono a utilizar(fontawesome)
	* @return  String
	************************************************************************/
	public function input_icon($type,$placeholder,$name, $value, $required, $icon){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//variables internas
			$random_int = rand(1, 999);
			$EXname     = str_replace('[]', '', $name);
			$EXname     = $EXname.'_'.$random_int;
			
			//Validacion de variables
			if($value==''){$w='';}else{$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
			
			//filtrado de teclas
			$input = $this->solo_letras($EXname);
				
			//generacion del input
			$input .= '<div class="field">
						<div class="input-group bootstrap-timepicker">
							<input type="'.$type.'" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$EXname.'(event)"  >
							<span class="input-group-addon add-on"><i class="'.$icon.'"></i></span>
						</div>
					</div>';		
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->select('Meses del año','idMeses', 1, 'idMes', 'Nombre', 'tabla_meses', '', '', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $style         Permite escribir directamente un estilo css
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function select($placeholder,$name, $required, $data1, $data2, $table, $filter,$style, $dbConn){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter;	}
			//explode para poder crear cadena
			$datos = explode(",", $data2);
			if(count($datos)==1){
				$data_required = ','.$datos[0].' AS '.$datos[0];
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			ORDER BY ".$order_by;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<div class="field">
							<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'">
								<option value="" selected>Seleccione '.$placeholder.'</option>';
						
						foreach ( $arrSelect as $select ) {
							$w = '';
								
							if(count($datos)==1){
								$data_writing = $select[$datos[0]].' ';
							}else{
								$data_writing = '';
								foreach($datos as $dato){
									$data_writing .= $select[$dato].' ';
								}
							}
				$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
							 } 
				$input .= '</select></div>';
						
				echo $input;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
				//Devuelvo mensaje
				alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');	
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* agregando un comando javascript onchange
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->select_change('Meses del año','idMeses', 1, 'idMes', 'Nombre', 'tabla_meses', '', '', 'cambia_mes', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $style         Permite escribir directamente un estilo css
	* String   $OnChange      Comando javascript a llamar cuando se seleccione algo
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function select_change($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$OnChange,$dbConn){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter;	}
			//explode para poder crear cadena
			$datos = explode(",", $data2);
			if(count($datos)==1){
				$data_required = ','.$datos[0].' AS '.$datos[0];
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			ORDER BY ".$order_by;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<div class="field">
				<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'" onchange="'.$OnChange.' (this)">
						<option value="" selected>Seleccione '.$placeholder.'</option>';
						
						foreach ( $arrSelect as $select ) {
							$w = '';
								
							if(count($datos)==1){
								$data_writing = $select[$datos[0]].' ';
							}else{
								$data_writing = '';
								foreach($datos as $dato){
									$data_writing .= $select[$dato].' ';
								}
							}
				$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
							 } 
				$input .= '</select></div>';
						
				echo $input;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
				//Devuelvo mensaje
				alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');	
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select con filtro
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* el cual tiene un filtrode texto que permite encontrar facilmente el 
	* dato necesario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->select_val_filter('Meses del año','idMeses', 1, 'idMes', 'Nombre', 'tabla_meses', 'idMes>2', '', 11, $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $style         Permite escribir directamente un estilo css
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function select_val_filter($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Valido dispositivo movil
			if(validaDispositivoMovil()){
				$input = $this->input_select_val($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn);
			}else{
				//si dato es requerido
				if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
				//Filtro para el where
				$filtro = '';
				if ($filter!='0'){$filtro .="WHERE ".$filter;	}
				//explode para poder crear cadena
				$datos = explode(",", $data2);
				if(count($datos)==1){
					$data_required = ','.$datos[0].' AS '.$datos[0];
					$order_by = $datos[0].' ASC ';
					if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				}else{
					$data_required = '';
					$order_by = $datos[0].' ASC ';
					if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
					foreach($datos as $dato){
						$data_required .= ','.$dato.' AS '.$dato;
					}
				}

				//se trae un listado con todas las categorias
				$arrSelect = array();
				$query = "SELECT  
				".$data1." AS idData 
				".$data_required."
				FROM `".$table."`  
				".$filtro."
				ORDER BY ".$order_by;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrSelect,$row );
					}
					mysqli_free_result($resultado);
					
					$input = '<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/chosen/chosen.css">';
					$input .= '<select name="'.$name.'" id="'.$name.'" '.$x.' style="'.$style.'" data-placeholder="Seleccione una Opcion" class="form-control chosen-select chosendiv_'.$name.'" tabindex="2">
									<option value=""></option>';

										
										foreach ( $arrSelect as $select ) {
											$w = '';
											if($value==$select['idData']){
												$w .= 'selected="selected"';
											}  	
											if(count($datos)==1){
												$data_writing = $select[$datos[0]].' ';
											}else{
												$data_writing = '';
												foreach($datos as $dato){
													$data_writing .= $select[$dato].' ';
												}
											}
											$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
										 } 
										
										
					$input .= '</select>
								<script src="'.DB_SITE_REPO.'/LIBS_js/chosen/chosen.jquery.js" type="text/javascript"></script>
								<script src="'.DB_SITE_REPO.'/LIBS_js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
								<script type="text/javascript">
									$.fn.oldChosen = $.fn.chosen
									$.fn.chosen = function(options) {
									  var selectcz_'.$name.' = $(".chosendiv_'.$name.'")
										, is_creating_chosen = !!options

									  if (is_creating_chosen && selectcz_'.$name.'.css(\'position\') === \'absolute\') {
										selectcz_'.$name.'.removeAttr(\'style\')
									  }

									  var ret = selectcz_'.$name.'.oldChosen(options)

									  if (is_creating_chosen) {
										selectcz_'.$name.'.attr(\'style\',\'display:visible; position:absolute; clip:rect(0,0,0,0)\');
										selectcz_'.$name.'.attr(\'tabindex\', -1);
									  }
									  return ret
									}
									$(\'selectcz_'.$name.'\').chosen({allow_single_deselect: true});
								</script>';
								

							
					echo $input;
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
					//Devuelvo mensaje
					alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');	
				}
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select con filtro
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* el cual tiene un filtrode texto que permite encontrar facilmente el 
	* dato necesario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_select_val('Meses del año','idMeses', 1, 'idMes', 'Nombre', 'tabla_meses', 'idMes>2', '', 1, $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $style         Permite escribir directamente un estilo css
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function input_select_val($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter;	}
			//explode para poder crear cadena
			$datos = explode(",", $data2);
			if(count($datos)==1){
				$data_required = ','.$datos[0].' AS '.$datos[0];
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			ORDER BY ".$order_by;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'" >
							<option value="" selected>Seleccione '.$placeholder.'</option>';
							
							foreach ( $arrSelect as $select ) {
								$w = '';
								if($value==$select['idData']){
									$w .= 'selected="selected"';
								}  	
								if(count($datos)==1){
									$data_writing = $select[$datos[0]].' ';
								}else{
									$data_writing = '';
									foreach($datos as $dato){
										$data_writing .= $select[$dato].' ';
									}
								}
				$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
							 } 
				$input .= '</select>';
						
				echo $input;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
				//Devuelvo mensaje
				alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select con filtro
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* el cual tiene un filtrode texto que permite encontrar facilmente el 
	* dato necesario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->input_select_val_filter_ot('Meses del año','idMeses', 1, 'idMes', 'Nombre', 'tabla_meses', 'idMes>2', '', 1, $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $style         Permite escribir directamente un estilo css
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function input_select_val_filter_ot($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter;	}
			//explode para poder crear cadena
			$datos = explode(",", $data2);
			if(count($datos)==1){
				$data_required = ','.$datos[0].' AS '.$datos[0];
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			ORDER BY ".$order_by;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/chosen/chosen.css">';
				$input .= '<select name="'.$name.'" id="'.$name.'" '.$x.' style="'.$style.'" data-placeholder="Seleccione una Opcion" class="form-control chosen-select chosendiv_'.$name.'" tabindex="2">
								<option value=""></option>';

									
									foreach ( $arrSelect as $select ) {
										$w = '';
										if($value==$select['idData']){
											$w .= 'selected="selected"';
										}  	
										if(count($datos)==1){
											$data_writing = $select[$datos[0]].' ';
										}else{
											$data_writing = '';
											foreach($datos as $dato){
												$data_writing .= $select[$dato].' ';
											}
										}
										$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$data_writing.'</option>';
									 } 
									
									
				$input .= '</select>
							
							<script type="text/javascript">
								$.fn.oldChosen = $.fn.chosen
								$.fn.chosen = function(options) {
								  var selectcz_'.$name.' = $(".chosendiv_'.$name.'")
									, is_creating_chosen = !!options

								  if (is_creating_chosen && selectcz_'.$name.'.css(\'position\') === \'absolute\') {
									selectcz_'.$name.'.removeAttr(\'style\')
								  }

								  var ret = selectcz_'.$name.'.oldChosen(options)

								  if (is_creating_chosen) {
									selectcz_'.$name.'.attr(\'style\',\'display:visible; position:absolute; clip:rect(0,0,0,0)\');
									selectcz_'.$name.'.attr(\'tabindex\', -1);
								  }
								  return ret
								}
								$(\'selectcz_'.$name.'\').chosen({allow_single_deselect: true});
							</script>';

				echo $input;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
				//Devuelvo mensaje
				alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* que tambien obtiene datos desde otras tablas
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->select_bodega('Empresas','empresas', 1, 1, 'idEmpresa', 'Nombre,Tipo', 'tabla_empresas', 'tabla_tipo','', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table1        Tabla desde donde tomar los datos
	* String   $table2        Tabla a fucionar para tener los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function select_bodega($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter;	}
			

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$table1.".".$data1." AS idData, 
			".$table1.".".$data2."
			FROM `".$table1."`  
			INNER JOIN ".$table2." ON ".$table2.".".$data1." = ".$table1.".".$data1."
			".$filtro."
			GROUP BY ".$table1.".".$data1."
			ORDER BY ".$table1.".".$data2." ASC";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<div class="field">
							<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
							<option value="" selected>Seleccione '.$placeholder.'</option>';
							
							foreach ( $arrSelect as $select ) {
								$w = '';
								if($value==$select['idData']){
									$w .= 'selected="selected"';
								}  	
								
				$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$select[$data2].'</option>';
							 } 
				$input .= '</select>
						</div>';
						
				echo $input;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
				//Devuelvo mensaje
				alert_post_data(4,1,1, 'Error en la consulta en <strong>'.$placeholder.'</strong>, consulte con el administrador');
			}
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo select dependiente
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos,
	* dependiente uno de otro
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->select_depend1('Año','idMeses', 1, 1, 'idAno', 'Nombre', 'tabla_anos', '', 'Nombre ASC', 
	*                         'Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC',
	*                         $dbConn, 'form1' );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder1   Nombre o texto a mostrar en el navegador
	* String   $name1          Nombre del identificador del Input
	* Integer  $value1         Valor por defecto, debe ser un numero entero
	* Integer  $required1      Si dato es obligatorio (1=no, 2=si)
	* String   $dataA1         Identificador de la base de datos
	* String   $dataB1         Texto a mostrar en la opcion del input
	* String   $table1         Tabla desde donde tomar los datos
	* String   $filter1        Filtro de la seleccion de la base de datos
	* String   $extracomand1   Ordenamiento de los datos, si no hay nada ordena automatico
	* String   $placeholder2   Nombre o texto a mostrar en el navegador
	* String   $name2          Nombre del identificador del Input
	* Integer  $value2         Valor por defecto, debe ser un numero entero
	* Integer  $required2      Si dato es obligatorio (1=no, 2=si)
	* String   $dataA2         Identificador de la base de datos
	* String   $dataB2         Texto a mostrar en la opcion del input
	* String   $table2         Tabla desde donde tomar los datos
	* String   $filter2        Filtro de la seleccion de la base de datos
	* String   $extracomand2   Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn         Puntero a la base de datos
	* String   $form_name      Nombre del formulario actual
	* @return  String
	************************************************************************/
	public function select_depend1($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
								   $placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
								   $dbConn, $form_name){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required1, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required1 ('.$required1.') entregada en '.$placeholder1.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required2, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required2 ('.$required2.') entregada en '.$placeholder2.' no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($value1)&&$value1!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value1 ('.$value1.') en <strong>'.$placeholder1.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value2)&&$value2!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value2 ('.$value2.') en <strong>'.$placeholder2.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($value1)&&$value1!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value1 ('.$value1.') en <strong>'.$placeholder1.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value2)&&$value2!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value2 ('.$value2.') en <strong>'.$placeholder2.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Variables
			$input = '';
			

			//DATOS REQUERIDOS
			$required = array();
			if($required1==1){$required[1]='';      }elseif($required1==2){$required[1]='required';$_SESSION['form_require'].=','.$name1;}
			if($required2==1){$required[2]='';      }elseif($required2==2){$required[2]='required';$_SESSION['form_require'].=','.$name2;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
				
			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			
			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			
			/********************************************************************************************************************/	
			//explode para poder crear cadena
			$datosA = explode(",", $dataB[1]);
			if(count($datosA)==1){
				$data_requiredA = ','.$datosA[0].' AS '.$datosA[0];
			}else{
				$data_requiredA = '';
				foreach($datosA as $dato){
					$data_requiredA .= ','.$dato.' AS '.$dato;
				}
			}
			//Primera Consulta estandar			
			$arrSeleccion = array();
			$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1];
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrSeleccion,$row );
			}
			mysqli_free_result($resultado);
			/********************************************************************************************************************/
			//Se dibuja el input
			$input .= '
					<div class="form-group" id="div_'.$name[1].'">
						<div class="field">
							<select name="'.$name[1].'" id="'.$name[1].'" class="form-control" '.$required[1].' onChange="cambia_'.$name[1].'()" >
								<option value="" selected>Seleccione una Opcion</option>';
						
								foreach ( $arrSeleccion as $seleccion ) {
									if(count($datosA)==1){
										$data_writing = $seleccion[$datosA[0]].' ';
									}else{
										$data_writing = '';
										foreach($datosA as $dato){
											$data_writing .= $seleccion[$dato].' ';
										}
									}
									$w = ''; if($value[1]==$seleccion['idData']){ $w .= 'selected="selected"'; }  	
									$input .= '<option value="'.$seleccion['idData'].'" '.$w.' >'.$data_writing.'</option>';
								} 
				$input .= '</select>
						</div>
					</div>';

			//Se recorre 2 veces
			$maxs = 2;
			for ($i = 2; $i <= $maxs; $i++) {
				
				//explode para poder crear cadena
				$datosB = explode(",", $dataB[$i]);
				if(count($datosB)==1){
					$data_requiredB = ','.$datosB[0].' AS '.$datosB[0];
				}else{
					$data_requiredB = '';
					foreach($datosB as $dato){
						$data_requiredB .= ','.$dato.' AS '.$dato;
					}
				}
				
				// Se trae un listado con los datos previamente seleccionados
				if ($value[$i-1]!=0&&$value[$i-1]!=''){
					$arrSeleccion = array();
					$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i];
					$resultado = mysqli_query ($dbConn, $query);
					while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSeleccion,$row );
					}
					mysqli_free_result($resultado);
				} 
				// Se trae un listado con todos los datos
				$arrTodos = array();
				$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i];
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrTodos,$row );
				}
				mysqli_free_result($resultado);
				
				
				//Se verifica la funcion
				$onchange = '';
				if($i!=$maxs){
					$onchange = 'onChange="cambia_'.$name[$i].'()"';
				}
				
				//Se dibuja el input
				$input .= '
						<div class="form-group" id="div_'.$name[$i].'" '.$display[$i].'>
							<div class="field">
								<select name="'.$name[$i].'" id="'.$name[$i].'" class="form-control" '.$required[$i].' '.$onchange.' >
									<option value="" selected>Seleccione una Opcion</option>';
									if ($value[$i-1]!=0&&$value[$i-1]!=''){
										foreach ( $arrSeleccion as $seleccion ) {
											if(count($datosB)==1){
												$data_writing = $seleccion[$datosB[0]].' ';
											}else{
												$data_writing = '';
												foreach($datosB as $dato){
													$data_writing .= $seleccion[$dato].' ';
												}
											}
					
											$w = ''; if($value[$i]==$seleccion['idData']){ $w .= 'selected="selected"'; }  	
											$input .= '<option value="'.$seleccion['idData'].'" '.$w.' >'.$data_writing.'</option>';
										} 
									}
					$input .= '</select>
							</div>
						</div>';
				
				$input .= '<script>
				';	
			
				//Input 2
				filtrar($arrTodos, 'idCat');
				$vowels = array(" ", "´", "-"); 
				foreach($arrTodos as $tipo=>$componentes){
					$input .= 'var id_data_'.$name[$i-1].'_'.str_replace($vowels, '_',$tipo).'=new Array(""';
					foreach ($componentes as $idcomp) {
						$input .= ',"'.$idcomp['idData'].'"';
					}
					$input .= ');
					';
				}
				
				foreach($arrTodos as $tipo=>$componentes){
					$input .= 'var data_'.$name[$i-1].'_'.str_replace($vowels, '_',$tipo).'=new Array("Seleccione una Opcion"';
					foreach ($componentes as $comp) {
						if(count($datosB)==1){
							$data_writing = $comp[$datosB[0]].' ';
						}else{
							$data_writing = '';
							foreach($datosB as $dato){
								$data_writing .= $comp[$dato].' ';
							}
						}					
						$input .= ',"'.str_replace('"', '',$data_writing).'"';
					}
					$input .= ');
					';
				}
			
				if($i <= $maxs){
					$input .= '
					function cambia_'.$name[$i-1].'(){
						var Componente
						Componente = document.'.$form_name.'.'.$name[$i-1].'[document.'.$form_name.'.'.$name[$i-1].'.selectedIndex].value
						try {
							if (Componente != "") {
							
								id_data=eval("id_data_'.$name[$i-1].'_" + Componente)
								
								data=eval("data_'.$name[$i-1].'_" + Componente)
								num_int = id_data.length
								document.'.$form_name.'.'.$name[$i].'.length = num_int
								for(i=0;i<num_int;i++){
								   document.'.$form_name.'.'.$name[$i].'.options[i].value=id_data[i]
								   document.'.$form_name.'.'.$name[$i].'.options[i].text=data[i]
								}
								document.getElementById("div_'.$name[$i].'").style.display = "block";	
								
							}else{';
						
								for ($xxx = $i; $xxx <= $maxs; $xxx++) {
									$input .= '
										document.'.$form_name.'.'.$name[$xxx].'.length = 1
										document.'.$form_name.'.'.$name[$xxx].'.options[0].value = ""
										document.'.$form_name.'.'.$name[$xxx].'.options[0].text = "Seleccione una Opcion"
										document.getElementById("div_'.$name[$xxx].'").style.display = "none";
									';
								
								}
							$input .= '	
							}
						} catch (e) {';
						
							for ($xxx = $i; $xxx <= $maxs; $xxx++) {
								$input .= '
									document.'.$form_name.'.'.$name[$xxx].'.length = 1
									document.'.$form_name.'.'.$name[$xxx].'.options[0].value = ""
									document.'.$form_name.'.'.$name[$xxx].'.options[0].text = "Seleccione una Opcion"
									document.getElementById("div_'.$name[$xxx].'").style.display = "none";
								';
								
							}
						$input .= '	
						}
						document.'.$form_name.'.'.$name[$i].'.options[0].selected = true
					}
					';
				}
				$input .= '</script>';
				
			}
					
			echo $input;
		}
	}
	
}


?>
