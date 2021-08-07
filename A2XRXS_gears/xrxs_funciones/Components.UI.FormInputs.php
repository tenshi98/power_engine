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
class Basic_Form_Inputs{
	
	/////////////////////////////        PRIVADAS        /////////////////////////////
   /****************************************************************************************/
	//imprime el script que impide el tipeo de teclas raras
	private function test($data){
	
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
				case 1: $tipo = 'h1'; break;
				case 2: $tipo = 'h2'; break;
				case 3: $tipo = 'h3'; break;
				case 4: $tipo = 'h4'; break;
				case 5: $tipo = 'h5'; break;
				case 6: $tipo = 'p';  break;
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
	* 	$Form->form_input_hidden('idCategoria', 1, 1 );
	* 	$Form->form_input_hidden('Categoria', 'Categoria', 1 );
	* 	$Form->form_input_hidden('idCategoria', 1, 2 );
	* 
	*===========================    Parametros   ===========================
	* String   $name       Nombre del identificador del Input
	* String   $value      Valor por defecto, puede ser texto o valor
	* Integer  $required   Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_hidden($name, $value, $required){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada no esta dentro de las opciones');
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
	* Permite crear un input tipo texto
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_text('Categoria','idCategoria', 1, 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_text($placeholder,$name, $value, $required){
		
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
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<input type="text" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' onkeypress="return soloLetras(event)">
					</div>
				</div>';	
			
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
	* 	$Form->form_input_password('Password','password', '', 2 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_password($placeholder,$name, $value, $required){
		
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
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input type="password" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras(event)"  >
							<span class="pass_impt" id="view_button_'.$name.'"><i class="fa fa-eye" aria-hidden="true"></i></span>
							<span class="input-group-addon add-on" ><i class="fa fa-key" aria-hidden="true"></i></span> 
						</div>
					</div>
				</div>';
					
			//ejecucion script
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
				</script>';	
					
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
	* 	$Form->form_input_disabled('Dia actual','dia', '2018-02-02', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_disabled($placeholder,$name, $value, $required){
		
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
			$input = '<div class="form-group" id="div_'.$name.'">
						<label class="control-label col-sm-4">'.$placeholder.'</label>
						<div class="col-sm-8 field">
							<input type="text" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" value="'.$w.'"  '.$x.' disabled="disabled">
						</div>
					</div>';	
			
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
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $icon          icono a utilizar(fontawesome)
	* @return  String
	************************************************************************/
	public function form_input_icon($placeholder,$name, $value, $required, $icon){
		
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
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras(event)"  >
							<span class="input-group-addon add-on"><i class="'.$icon.'"></i></span> 
						</div>
					</div>
				</div>';		
			
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
	* 	$Form->form_input_rut('Rut','rut', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_rut($placeholder,$name, $value, $required){
		
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
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloRut(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-male" aria-hidden="true"></i></span> 
						</div>
					</div>
				</div>';
			
			//Validacion Script		
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
			
			//ejecucion script
			$input.='
				<script>
					$("#'.$name.'").rut();
				</script>';
					
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
	* enteros positivos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_values('Valores Enteros','valores', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, ingresar numeros enteros
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_values($placeholder,$name, $value, $required){
		
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
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroNatural(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-usd" aria-hidden="true"></i></span> 
						</div>
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
	* 	$Form->form_input_number('Numeros','numeros', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Decimal  $value         Valor por defecto, ingresar numeros enteros o decimales
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_number($placeholder,$name, $value, $required){
		
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
		/*if (!validarNumero($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}*/
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			$w=$value;
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
				
			//generacion del input
			$input ='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroRealRacional(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-subscript" aria-hidden="true"></i></span> 
						</div>
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
	* enteros
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_number_integer('Enteros','enteros', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, ingresar numeros enteros
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_number_integer($placeholder,$name, $value, $required){
		
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
			$w=$value;
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//generacion del input
			$input ='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroNaturalReal(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-superscript" aria-hidden="true"></i></span> 
						</div>
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
	* 	$Form->form_input_number_alt('Numeros','numeros', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Decimal  $value         Valor por defecto, ingresar numeros enteros o decimales
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_number_alt($placeholder,$name, $value, $required){
		
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
			//Validacion de variables
			$w=$value;
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//generacion del input
			$input ='<div class="form-group" id="div_'.$name.'">
						<label class="control-label col-sm-12" style="text-align: left;">'.$placeholder.'</label>
						<div class="col-sm-12 field">
							<div class="input-group bootstrap-timepicker">
								<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroRealRacional(event)"  >
								<span class="input-group-addon add-on"><i class="fa fa-subscript" aria-hidden="true"></i></span> 
							</div>
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
	* permite valores decimales y numeros negativos, agregando botones 
	* en ambos lados, que aumentan o disminuyen los valores ingresados, 
	* en los rangos preestablecido
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_number_spinner('Numeros','numeros', '', 1, 50, 1, 2, 1 );
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
	public function form_input_number_spinner($placeholder,$name, $value, $min, $max, $step, $ndecimal, $required){
		
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
			//Validacion de variables
			$w=$value;
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
								
			//se cargan recursos
			$input  ='<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.js"></script>';
			$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.css">';
								
			//generacion del input
			$input .='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'" type="text" name="'.$name.'" id="'.$name.'" value="'.str_replace(',','.',$value).'" '.$x.' onkeypress="return soloNumeroRealRacional(event)">
						</div>
					</div>
				</div>';
								
			//ejecucion script		
			$input .= '
				<script>
					//se inicializa el plugin
					$("input[name=\''.$name.'\']").TouchSpin({
						min: '.$min.',
						max: '.$max.',
						step: '.$step.',
						decimals: '.$ndecimal.',
						boostat: 5,
						maxboostedstep: 10
					});
				</script>';
								
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
	* 	$Form->form_input_phone('Telefono','fono', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, ingresar numeros enteros
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_phone($placeholder,$name, $value, $required){
		
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
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroNatural(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-phone" aria-hidden="true"></i></span> 
						</div>
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
	public function form_input_fax($placeholder,$name, $value, $required){
		
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
			if($value==0){$w='';}elseif($value!=0){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
					
			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumeroNatural(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-fax" aria-hidden="true"></i></span> 
						</div>
					</div>
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
	* 	$Form->form_date('Fecha','fecha', '', 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Date     $value         Valor por defecto, debe tener formato fecha
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_date($placeholder,$name, $value, $required){
		
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
		if (!validaFecha($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es una fecha');
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
				
			//solicitud de recursos
			$input  ='<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
			$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/material_datetimepicker/js/moment-with-locales.min.js"></script>';
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
					
			//generacion del input
			$input .='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.'>
							<span class="input-group-addon add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span> 
						</div>
					</div>
				</div>';
				
			//ejecucion script	
			$input .='
				<script type="text/javascript">
					$(document).ready(function(){
						$("#'.$EXname.'").bootstrapMaterialDatePicker
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
	* 	$Form->form_time('Hora', 'hora','', 1,1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Time     $value         Valor por defecto, debe tener formato hora
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Integer  $position      Posicion (1=arriba, 2=abajo)
	* @return  String
	************************************************************************/
	public function form_time($placeholder,$name, $value, $required, $position){
		
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
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($position, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $position ('.$position.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		/*if (!validaHora($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es una hora');
			$errorn++;
		}*/
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==''){$w='';}elseif($value!=''){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
					
			//Posicion de la burbuja
			switch ($position) {
				case 1: $x_pos = 'top'; break;
				case 2: $x_pos = 'bottom'; break;
			}
					
			//solicitud de recursos
			$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
					
			//generacion del input
			$input .='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >
							<span class="input-group-addon add-on"><i class="fa fa-clock-o" aria-hidden="true"></i></span> 
						</div>
					</div>
				</div>';
					
			//solicitud de recursos
			$input .='<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
					
			//ejecucion script
			$input .='
				<script type="text/javascript">
					$("#'.$name.'").clockpicker({
						placement: "'.$x_pos.'",
						align: "left",
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
	* 	$Form->form_time_popover('Hora Inspeccion','H_inspeccion', '', 1, 1, 24);
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Time     $value         Valor por defecto, debe tener formato hora
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Integer  $position      Posicion (1=arriba, 2=abajo)
	* Integer  $limit         Limite de horas a aceptar, ej:24
	* @return  String
	************************************************************************/
	public function form_time_popover($placeholder,$name, $value, $required, $position, $limit){
		
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
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($position, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $position ('.$position.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($limit)&&$limit!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $limit ('.$limit.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($limit)&&$limit!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $limit ('.$limit.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		//Verifica si el numero recibido es superior a 24
		if ($limit!=''&&$limit>24){ 
			alert_post_data(4,1,1, 'El valor ingresado en $limit ('.$limit.') en <strong>'.$placeholder.'</strong> es superior a 24');
			$errorn++;
		}
		//valido la hora
		if(!validaHora($value)&&$value!=''){ 
			alert_post_data(4,1,1, 'El dato ingresado en $value ('.$value.') en <strong>'.$placeholder.'</strong> no es una hora');
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==''){$w='';}elseif($value!=''){$w=$value;}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
						
			//Posicion de la burbuja
			switch ($position) {
				case 1: $x_pos = 'top'; break;
				case 2: $x_pos = 'bottom'; break;
			}
						
			//solicitud recursos
			$input  ='<script src="'.DB_SITE_REPO.'/LIBS_js/popover_timepicker/js/timepicki_'.$x_pos.'.js"></script>';
			$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/popover_timepicker/css/timepicki_'.$x_pos.'.css">';
						
			//ejecucion script
			$input .='
			<script>
				$(document).ready(function(){
					$("#'.$name.'").timepicki({
						show_meridian:false,
						min_hour_value:0,
						max_hour_value:'.$limit.',
						step_size_minutes:1,
						overflow_minutes:true,
						increase_direction:\'up\',
						input_writable: false,
						disable_keyboard_mobile: true
					});
				});
			</script>';

						
			//generacion del input
			$input .='
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >
							<span class="input-group-addon add-on"><i class="fa fa-clock-o" aria-hidden="true"></i></span> 
						</div>
					</div>
				</div>';
						
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo color
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo selector de colores
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_color('Categoria','idCategoria', 1, 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* @return  String
	************************************************************************/
	public function form_input_color($placeholder,$name, $value, $required){
		
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
			if($value==''){$bcolor='';}else{$bcolor='style="background-color: '.$value.';"';}
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
			//generacion del input
			$input = '
				<link href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_colorpicker/dist/css/bootstrap-colorpicker.min.css"  rel="stylesheet">
				<link href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_colorpicker/dist/css/bootstrap-colorpicker-plus.css" rel="stylesheet">';
    	
			//generacion del input
			$input .= '
				<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<input type="text" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' '.$bcolor.' onkeypress="return soloLetras(event)">
					</div>
				</div>';
					
			//Ejecucion Javascript
			$input .= '
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_colorpicker/dist/js/bootstrap-colorpicker-plus.js"></script>
				<script type="text/javascript">
					$(function(){
						var color_'.$name.' = $("#'.$name.'");
						color_'.$name.'.colorpickerplus();
						color_'.$name.'.on("changeColor", function(e,color){
							if(color==null)
							$(this).val("transparent").css("background-color", "#fff");//tranparent
							else
							$(this).val(color).css("background-color", color);
						});
					});
				</script>
			';
			
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un textarea
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo text, en el cual podemos definir su 
	* altura a mostrar en el navegador
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_textarea('Observaciones','observaciones', '', 1, 160 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Integer  $height        Altura del input
	* @return  String
	************************************************************************/
	public function form_textarea($placeholder,$name, $value, $required, $height){
		
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
		if (!validarNumero($height)&&$height!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $height ('.$height.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($value==''){    $w = '';             }else{$w=$value;}
			if($required==1){  $x = '';             }elseif($required==2){ $x = 'required';$_SESSION['form_require'].=','.$name;}	
			if($height!=0){    $xheight = $height;  }elseif($height==0){   $xheight = '320';}	
				
			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<textarea name="'.$name.'" id="'.$name.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; height: '.$xheight.'px;" '.$x.' onkeypress="return soloLetrasTextArea(event)" >'.$w.'</textarea>
					</div>
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
	* Inserta un editor de texto completo
	* 
	*===========================     Detalles    ===========================
	* Permite crear un editor de texto completo
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_ckeditor('Observaciones','observaciones', '', 1, 1 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Integer  $tipo          Opciones con los botones a mmostrar
	* @return  String
	************************************************************************/
	public function form_ckeditor($placeholder,$name, $value, $required, $tipo){

		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se definen las opciones disponibles
		$requerido = array(1, 2);
		$tipos     = array(1, 2, 3);
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($required, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required ('.$required.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		//verifico si el dato ingresado existe dentro de las opciones
		if (!in_array($tipo, $tipos)) {
			alert_post_data(4,1,1, 'La configuracion $tipo ('.$tipo.') entregada en <strong>'.$placeholder.'</strong> no esta dentro de las opciones');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
				
			//generacion del input
			$input = '
				<div class="txtckedit field">
					<h3>'.$placeholder.'</h3>
					<textarea id="ckeditor_'.$name.'" class="ckeditor" name="'.$name.'" '.$x.'>'.$value.'</textarea>
				</div>';
				
			//se cargan recursos					
			$input .= '<script src="'.DB_SITE_REPO.'/LIBS_js/ckeditor/ckeditor.js"></script>';
				
			//ejecucion de script
			$input .= '<script>';
			//se selecciona el tipo de editor a mostrar
			switch ($tipo) {
				case 1:
					$input .= "CKEDITOR.replace( 'ckeditor_".$name."', {				
								toolbar: [										
								[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],					
								{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule' ] },						
								{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], 
								items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },					
								'/',
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },					
								{ name: 'styles', items: [ 'Styles', 'Format' ] }]})";
					break;
				case 2:
					$input .= "CKEDITOR.replace( 'ckeditor_".$name."', {				
								toolbar: [										
								[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],											
								{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], 
								items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },					
								'/',
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },					
								{ name: 'styles', items: [ 'Styles', 'Format' ] }]})";
					break;
				case 3:
					break;
			}           
			$input .= '</script>';
					
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input para subir archivos
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input estandar para subir archivos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_input_file('Adjuntar Archivos','archivos' );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* @return  String
	************************************************************************/
	public function form_input_file($placeholder,$name){
		
		//generacion del input
		$input = '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<input id="uploadFile'.$name.'" placeholder="'.$placeholder.'" disabled="disabled" />
					<div class="fileUpload btn btn-primary">
						<span><i class="fa fa-search" aria-hidden="true"></i> Seleccionar Archivo</span>
						<input id="uploadBtn'.$name.'" type="file" class="upload" name="'.$name.'" />
					</div>
				</div>
			</div>';
			
		//ejecucion de codigo
		$input .= '
			<script>
				document.getElementById("uploadBtn'.$name.'").onchange = function () {
					document.getElementById("uploadFile'.$name.'").value = this.value;
				};
			</script>';

		//Imprimir dato	
		echo $input;
		
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input para subir archivos
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que permite subir multiples archivos 
	* simultaneamente, con validacion y previsualizacion para algunos 
	* tipos de archivo
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_multiple_upload('Subir Archivos','archivos', 10, '"jpg", "png", "gif", "jpeg"' );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $max_files     Cantidad Maxima de archivos
	* String   $type_files    Tipo de archivos a aceptar, son validados por el input
	* @return  String
	************************************************************************/
	public function form_multiple_upload($placeholder, $name, $max_files, $type_files){
		
		/********************************************************/
		//Definicion de errores
		$errorn = 0;
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($max_files)&&$max_files!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $max_files ('.$max_files.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($max_files)&&$max_files!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $max_files ('.$max_files.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Verifico si es mas de un archivo
			if(isset($max_files)&&$max_files!=1){
				$ndat = '[]';
			}else{
				$ndat = '';
			}
					
			//se cargan recursos
			$input = '
				<link href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
				<link href="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/js/plugins/sortable.js" type="text/javascript"></script>
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/js/fileinput.js" type="text/javascript"></script>
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/js/locales/es.js" type="text/javascript"></script>
				<script src="'.DB_SITE_REPO.'/LIBS_js/bootstrap_fileinput/themes/explorer/theme.js" type="text/javascript"></script>
			';
			
			//Mostrar Maximo de archivos
			$s_msg  = '<strong><i class="fa fa-file-o" aria-hidden="true"></i> Maximo de Archivos Permitidos: </strong>'.$max_files.'<br/>';
			$s_msg .= '<strong><i class="fa fa-file-o" aria-hidden="true"></i> Extensiones de Archivos Permitidos: </strong><br/>'.$type_files;
			$input .= alert_post_data(2,1,1,$s_msg );
			
			//generacion del input
			$input .= '
				<div class="form-group" id="div_'.$name.'">
					<div class="col-sm-12" style="margin-bottom:10px;">
						<label class="control-label col-sm-4">'.$placeholder.'</label>
					</div>
					<div class="col-sm-12">
						<input id="kv-'.$name.'" name="'.$name.$ndat.'" type="file" multiple>
					</div>
				</div>
			';			
								
			//ejecucion de codigo
			$input .= '			
				<script>
					$(document).ready(function () {
						$("#kv-'.$name.'").fileinput({
							\'theme\': \'explorer\',
							language: "es",
							allowedFileExtensions: ['.$type_files.'],
							maxFileCount: '.$max_files.',
							overwriteInitial: false,
							initialPreviewAsData: true,
							showUpload: false
						});
					});
								
				</script>
			';

			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input tipo checkbox
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo checkbox en base a datos de la base de datos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_checkbox('Opciones','opciones', '', 1, 'ID', 'Nombre', 'tabla_opciones', '', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_checkbox($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

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
				
				$input = '<div class="form-group" id="div_'.$name.'">			
							<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>			
							<div class="col-sm-8 field">';
								$z = 1;
								foreach ( $arrSelect as $select ) {
									$w = '';
									if($value==$select['idData']){
										$w .= 'checked';
									}  	
									if(count($datos)==1){
										$data_writing = $select[$datos[0]].' ';
									}else{
										$data_writing = '';
										foreach($datos as $dato){
											$data_writing .= $select[$dato].' ';
										}
									}
								
									$input .= '			
									<div class="checkbox checkbox-primary">
										<input type="checkbox" value="'.$select['idData'].'" '.$w.' name="'.$name.'_'.$z.'" id="'.$name.'_'.$z.'">
										<label for="'.$name.'_'.$z.'">
											'.$data_writing.'
										</label>
									</div>';
									
									$z++;	
								}
								
								$input .= '		
							</div>		
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
	* Crea un input tipo checkbox
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo checkbox en base a datos de la base de 
	* datos, que lleva por defecto opciones activas
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_checkbox_active('Opciones','opciones', '', 1, 'ID', 'Nombre', 'tabla_opciones', '', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_checkbox_active($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

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
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}
			//explode para poder crear cadena
			$datos2 = explode(",", $value);
			$arrTemp = array();
			$y = 1;
			foreach($datos2 as $dato){
				$arrTemp[$y] = $dato;
				$y++;	
			}
	
			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			ORDER BY idData";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
				
				$input = '<div class="form-group" id="div_'.$name.'">			
							<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>			
							<div class="col-sm-8 field">';
								$z = 1;
								foreach ( $arrSelect as $select ) {
									$w = '';
									$m = '';
									if(isset($arrTemp[$z])&&$arrTemp[$z]==2){
										$w .= 'checked';
										$m = '2';
									}else{
										$m = '2';
									}	
									if(count($datos)==1){
										$data_writing = $select[$datos[0]].' ';
									}else{
										$data_writing = '';
										foreach($datos as $dato){
											$data_writing .= $select[$dato].' ';
										}
									}
								
									$input .= '			
									<div class="checkbox checkbox-primary">
										<input                type="hidden"   value="1"      '.$w.' name="'.$name.'_'.$z.'" >
										<input class="styled" type="checkbox" value="'.$m.'" '.$w.' name="'.$name.'_'.$z.'" id="'.$name.'_'.$z.'">
										<label for="'.$name.'_'.$z.'">
											'.$data_writing.'
										</label>
									</div>';
									
									$z++;	
								}
								
								$input .= '		
							</div>		
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
	public function form_terms_and_conditions($name, $inicio, $link, $fin, $submit_name){
		
		//generacion del input
		$input = '
			<div class="col-sm-12">
				<div class="col-sm-4"></div>
				<div class="col-sm-8">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="'.$name.'" id="'.$name.'" value="1" onchange="acbtn_'.$name.'(this)">
							'.$inicio.'  <a class="iframe" href="'.$link.'">'.$fin.'</a> 
						</label>
					</div>
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
	* Crea un input tipo select
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', 'idMes>2', 'ORDER BY Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $extrafilter   Comandos extras, tales como ORDER BY - GROUP BY
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $extrafilter, $dbConn){

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
		/*if (!validarNumero($value)&&$value!=''){ 
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
				$order_by = 'ORDER BY '.$datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = 'ORDER BY '.$datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}
			//Verifica si se enviaron mas datos
			if(!isset($extrafilter) OR $extrafilter==''){$extrafilter = $order_by;}

			//se trae un listado con todas las categorias
			$arrSelect = array();
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			".$filtro."
			".$extrafilter;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrSelect,$row );
				}
				mysqli_free_result($resultado);
						
				$input = '<div class="form-group" id="div_'.$name.'">
							<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
							<div class="col-sm-8 field">
							<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
							<option value="" selected>Seleccione una Opcion</option>';
									
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
							</div>
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
	* Crea un input tipo select con filtro
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* el cual tiene un filtrode texto que permite encontrar facilmente el 
	* dato necesario
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', 'idMes>2', 'ORDER BY Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $extrafilter   Comandos extras, tales como ORDER BY - GROUP BY
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_filter($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $extrafilter, $dbConn){

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
				$input = $this->form_select($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $extrafilter, $dbConn);
			}else{
				//si dato es requerido
				if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
				//Filtro para el where
				$filtro = '';
				if ($filter!='0'){ $filtro .="WHERE ".$filter;	}
				//explode para poder crear cadena
				$datos = explode(",", $data2);
				if(count($datos)==1){
					$data_required = ','.$datos[0].' AS '.$datos[0];
					$order_by = 'ORDER BY '.$datos[0].' ASC ';
					if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
				}else{
					$data_required = '';
					$order_by = 'ORDER BY '.$datos[0].' ASC ';
					if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .="WHERE ".$datos[0]."!='' ";}
					foreach($datos as $dato){
						$data_required .= ','.$dato.' AS '.$dato;
					}
				}
				//Verifica si se enviaron mas datos
				if(!isset($extrafilter) OR $extrafilter==''){$extrafilter = $order_by;}

				//se trae un listado con todas las categorias
				$arrSelect = array();
				$query = "SELECT  
				".$data1." AS idData 
				".$data_required."
				FROM `".$table."`  
				".$filtro."
				".$extrafilter;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrSelect,$row );
					}
					mysqli_free_result($resultado);
							
					$input = '<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/chosen/chosen.css">';
					$input .= '<div class="form-group" id="div_'.$name.'">
									<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
									<div class="col-sm-8 field">
										<select name="'.$name.'" id="'.$name.'" '.$x.' data-placeholder="Seleccione una Opcion" class="form-control chosen-select chosendiv_'.$name.' " tabindex="2" >
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
									</div>
								</div>
									
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
							//validacion si es requerido
					if($required==2){	
						$input .='
						<style>
							#div_'.$name.' .chosen-single {background:url('.DB_SITE_REPO.'/LIB_assets/img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
						</style>';
					}

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
	* Crea un input tipo select
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* que tambien obtiene datos desde otras tablas
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_join('Empresas','empresas', 1, 1, 'idEmpresa', 'Nombre,Tipo', 'tabla_empresas', 'tabla_tipo','', $dbConn );
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
	public function form_select_join($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

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
						
				$input = '<div class="form-group" id="div_'.$name.'">
						<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
									<div class="col-sm-8 field">
									<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' >
									<option value="" selected>Seleccione una Opcion</option>';
									
									foreach ( $arrSelect as $select ) {
										$w = '';
										if($value==$select['idData']){
											$w .= 'selected="selected"';
										}  	
										
						$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$select[$data2].'</option>';
								} 
				$input .= '</select>
							</div>
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
	* Crea un input tipo select con filtro
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input tipo select en base a datos de la base de datos, 
	* que tambien obtiene datos desde otras tablas, agregando un filtro 
	* para encontrar datos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_join_filter('Empresas','empresas', 1, 1, 'idEmpresa', 'Nombre,Tipo', 'tabla_empresas', 'tabla_tipo','', $dbConn );
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
	public function form_select_join_filter($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

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
				$input = $this->form_select_join($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn);
			}else{
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
							
					$input = '<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/chosen/chosen.css">';
					$input .= '<div class="form-group" id="div_'.$name.'">
									<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
									<div class="col-sm-8 field">
										<select name="'.$name.'" id="'.$name.'" '.$x.' data-placeholder="Seleccione una Opcion" class="form-control chosen-select chosendiv_'.$name.'" tabindex="2">
											<option value=""></option>';
													
												
									foreach ( $arrSelect as $select ) {
										$w = '';
										if($value==$select['idData']){
											$w .= 'selected="selected"';
										}  	
										$input .= '<option value="'.$select['idData'].'" '.$w.' >'.$select[$data2].'</option>';
									} 
												
												
									$input .= '</select>
											</div>
										</div>
									
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
							//validacion si es requerido
							if($required==2){	
								$input .='
								<style>
									#div_'.$name.' .chosen-single {background:url('.DB_SITE_REPO.'/LIB_assets/img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
								</style>';
							}        
									
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
	* Crea un input descativado
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input desactivado con datos desde la base de datos
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_disabled('Categoria','idCategoria', 1, 1,'idCategoria','Nombre','tabla_categorias','', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_disabled($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){
		
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
			$filtro = '';
			//explode para poder crear cadena
			$datos = explode(",", $data2);
			if(count($datos)==1){
				$data_required = ','.$datos[0].' AS '.$datos[0];
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .=" AND ".$datos[0]."!='' ";}
			}else{
				$data_required = '';
				$order_by = $datos[0].' ASC ';
				if($filter!=''){$filtro .=" AND ".$datos[0]."!='' ";}elseif($filter==''){$filtro .=" AND ".$datos[0]."!='' ";}
				foreach($datos as $dato){
					$data_required .= ','.$dato.' AS '.$dato;
				}
			}

			//se trae un listado con todas las categorias
			$query = "SELECT  
			".$data1." AS idData 
			".$data_required."
			FROM `".$table."`  
			WHERE ".$data1."=".$value." 
			".$filtro."
			ORDER BY ".$order_by;
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				$rowselect = mysqli_fetch_assoc ($resultado);
				mysqli_free_result($resultado);
							
				if(count($datos)==1){
					$data_writing = $rowselect[$datos[0]].' ';
				}else{
					$data_writing = '';
					foreach($datos as $dato){
						$data_writing .= $rowselect[$dato].' ';
					}
				}
										
				$input = '<div class="form-group" id="div_'.$name.'">
							<label class="control-label col-sm-4">'.$placeholder.'</label>
							<div class="col-sm-8 field">
								<input type="text" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" 
								value="'.$data_writing.'"   disabled="disabled">
							</div>
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
	* Crea un input numerico
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input que contiene numeros enteros secuenciales
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_n_auto('Notas','notas', '', 1, 1, 7 );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Integer  $valor_ini     Valor rango inicio, debe ser numero entero
	* Integer  $valor_fin     Valor rango fin, debe ser numero entero
	* @return  String
	************************************************************************/
	public function form_select_n_auto($placeholder,$name, $value, $required, $valor_ini, $valor_fin){

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
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($valor_ini)&&$valor_ini!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $valor_ini ('.$valor_ini.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($valor_ini)&&$valor_ini!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $valor_ini ('.$valor_ini.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		//se verifica si es un numero lo que se recibe
		if (!validarNumero($valor_fin)&&$valor_fin!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $valor_fin ('.$valor_fin.') en <strong>'.$placeholder.'</strong> no es un numero');
			$errorn++;
		}
		//Verifica si el numero recibido es un entero
		if (!validaEntero($valor_fin)&&$valor_fin!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $valor_fin ('.$valor_fin.') en <strong>'.$placeholder.'</strong> no es un numero entero');
			$errorn++;
		}
		/********************************************************/
		//Ejecucion si no hay errores
		if($errorn==0){
			//Validacion de variables
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}

			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">			
					<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>			
					<div class="col-sm-8 field">				
						<select class="form-control" name="'.$name.'" id="'.$name.'" '.$x.'>
							<option value="">Seleccione una Opcion</option>';
								for ($i = $valor_ini; $i <= $valor_fin; $i++) {
									$j = '';
									if(isset($value)&&$value==$i) {
										$j .= 'selected="selected"';
									}
									$input .= '<option value="'.$i.'" '.$j.'>'.$i.'</option>';					
								} 	       				
					$input .= '</select>			
					</div>		
				</div>';
									
			//Imprimir dato	
			echo $input;
		}
	}
	/*******************************************************************************************************************/
	/***********************************************************************
	* Crea un input select con los paises
	* 
	*===========================     Detalles    ===========================
	* Permite crear un input select que trae los paises
	*===========================    Modo de uso  ===========================
	* 	
	* 	//se imprime input	
	* 	$Form->form_select_country('Pais','idPais', '', 2, $dbConn);
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* String   $value         Valor por defecto, puede ser texto o valor
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_country($placeholder,$name, $value, $required, $dbConn){

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

			//Variable
			$pais = '0';
			if(isset($value)&&$value!=''){
				$pais = $value;
			}

			//generacion del input
			$input = '
				<div class="form-group" id="div_'.$name.'">
					<label for="text2" class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
					<div class="col-sm-8 field">
						<select name="'.$name.'" id="'.$name.'" class="form-control frm_country selectpicker countrypicker" '.$x.'  data-live-search="true" data-default="'.$pais.'" data-flag="true"></select>
					</div>
				</div>';
					
			//se cargan recursos
			$input .= '
			<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/country_picker/css/bootstrap-select.min.css">
			<script src="'.DB_SITE_REPO.'/LIBS_js/country_picker/js/bootstrap-select.min.js"></script>
			<script>var domain_val = "'.DB_SITE_REPO.'";</script>   	
			<script src="'.DB_SITE_REPO.'/LIBS_js/country_picker/js/countrypicker.js"></script>'; 
					
			//Imprimir dato	
			echo $input;
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
	* 	$Form->form_select_depend1('Año','idMeses', 1, 1, 'idAno', 'Nombre', 'tabla_anos', '', 'Nombre ASC', 
	*                              'Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC',
	*                              $dbConn, 'form1' );
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
	public function form_select_depend1($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend2($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
				
			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			
			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 3 veces
			$maxs = 3;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend3($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required4, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required4 ('.$required4.') entregada en '.$placeholder4.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			if($required4==1){$required[4]='';      }elseif($required4==2){$required[4]='required';$_SESSION['form_require'].=','.$name4;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4;	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			if ($value4!=0&&$value4!=''){$display[4]='';}else{$display[4]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			if ($value4!=0&&$value4!=''){$value[4]=$value4;}else{$value[4]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
			if (isset($name4)&&$name4!=''){$name[4]=$name4;}else{$name[4]='';}
				
			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			if (isset($dataA4)&&$dataA4!=''){$dataA[4]=$dataA4;}else{$dataA[4]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			if (isset($dataB4)&&$dataB4!=''){$dataB[4]=$dataB4;}else{$dataB[4]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			if (isset($table4)&&$table4!=''){$table[4]=$table4;}else{$table[4]='';}
			
			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			if (isset($placeholder4)&&$placeholder4!=''){$placeholder[4]=$placeholder4;}else{$placeholder[4]='';}
			
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 4 veces
			$maxs = 4;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend4($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										$placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required4, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required4 ('.$required4.') entregada en '.$placeholder4.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required5, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required5 ('.$required5.') entregada en '.$placeholder5.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			if($required4==1){$required[4]='';      }elseif($required4==2){$required[4]='required';$_SESSION['form_require'].=','.$name4;}
			if($required5==1){$required[5]='';      }elseif($required5==2){$required[5]='required';$_SESSION['form_require'].=','.$name5;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4;	}
			$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4;	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
			$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5;	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			if ($value4!=0&&$value4!=''){$display[4]='';}else{$display[4]='style="display:none;"';}
			if ($value5!=0&&$value5!=''){$display[5]='';}else{$display[5]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			if ($value4!=0&&$value4!=''){$value[4]=$value4;}else{$value[4]='';}
			if ($value5!=0&&$value5!=''){$value[5]=$value5;}else{$value[5]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
			if (isset($name4)&&$name4!=''){$name[4]=$name4;}else{$name[4]='';}
			if (isset($name5)&&$name5!=''){$name[5]=$name5;}else{$name[5]='';}
				
			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			if (isset($dataA4)&&$dataA4!=''){$dataA[4]=$dataA4;}else{$dataA[4]='';}
			if (isset($dataA5)&&$dataA5!=''){$dataA[5]=$dataA5;}else{$dataA[5]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			if (isset($dataB4)&&$dataB4!=''){$dataB[4]=$dataB4;}else{$dataB[4]='';}
			if (isset($dataB5)&&$dataB5!=''){$dataB[5]=$dataB5;}else{$dataB[5]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			if (isset($table4)&&$table4!=''){$table[4]=$table4;}else{$table[4]='';}
			if (isset($table5)&&$table5!=''){$table[5]=$table5;}else{$table[5]='';}
			
			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			if (isset($placeholder4)&&$placeholder4!=''){$placeholder[4]=$placeholder4;}else{$placeholder[4]='';}
			if (isset($placeholder5)&&$placeholder5!=''){$placeholder[5]=$placeholder5;}else{$placeholder[5]='';}
			
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 5 veces
			$maxs = 5;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend5($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										$placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
										$placeholder6, $name6,  $value6,  $required6,  $dataA6,  $dataB6,  $table6,  $filter6,   $extracomand6,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required4, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required4 ('.$required4.') entregada en '.$placeholder4.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required5, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required5 ('.$required5.') entregada en '.$placeholder5.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required6, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required6 ('.$required6.') entregada en '.$placeholder6.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			if($required4==1){$required[4]='';      }elseif($required4==2){$required[4]='required';$_SESSION['form_require'].=','.$name4;}
			if($required5==1){$required[5]='';      }elseif($required5==2){$required[5]='required';$_SESSION['form_require'].=','.$name5;}
			if($required6==1){$required[6]='';      }elseif($required6==2){$required[6]='required';$_SESSION['form_require'].=','.$name6;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4;	}
			$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5;	}
			$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4;	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
			$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5;	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
			$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6;	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			if ($value4!=0&&$value4!=''){$display[4]='';}else{$display[4]='style="display:none;"';}
			if ($value5!=0&&$value5!=''){$display[5]='';}else{$display[5]='style="display:none;"';}
			if ($value6!=0&&$value6!=''){$display[6]='';}else{$display[6]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			if ($value4!=0&&$value4!=''){$value[4]=$value4;}else{$value[4]='';}
			if ($value5!=0&&$value5!=''){$value[5]=$value5;}else{$value[5]='';}
			if ($value6!=0&&$value6!=''){$value[6]=$value6;}else{$value[6]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
			if (isset($name4)&&$name4!=''){$name[4]=$name4;}else{$name[4]='';}
			if (isset($name5)&&$name5!=''){$name[5]=$name5;}else{$name[5]='';}
			if (isset($name6)&&$name6!=''){$name[6]=$name6;}else{$name[6]='';}
			

			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			if (isset($dataA4)&&$dataA4!=''){$dataA[4]=$dataA4;}else{$dataA[4]='';}
			if (isset($dataA5)&&$dataA5!=''){$dataA[5]=$dataA5;}else{$dataA[5]='';}
			if (isset($dataA6)&&$dataA6!=''){$dataA[6]=$dataA6;}else{$dataA[6]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			if (isset($dataB4)&&$dataB4!=''){$dataB[4]=$dataB4;}else{$dataB[4]='';}
			if (isset($dataB5)&&$dataB5!=''){$dataB[5]=$dataB5;}else{$dataB[5]='';}
			if (isset($dataB6)&&$dataB6!=''){$dataB[6]=$dataB6;}else{$dataB[6]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			if (isset($table4)&&$table4!=''){$table[4]=$table4;}else{$table[4]='';}
			if (isset($table5)&&$table5!=''){$table[5]=$table5;}else{$table[5]='';}
			if (isset($table6)&&$table6!=''){$table[6]=$table6;}else{$table[6]='';}
			

			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			if (isset($placeholder4)&&$placeholder4!=''){$placeholder[4]=$placeholder4;}else{$placeholder[4]='';}
			if (isset($placeholder5)&&$placeholder5!=''){$placeholder[5]=$placeholder5;}else{$placeholder[5]='';}
			if (isset($placeholder6)&&$placeholder6!=''){$placeholder[6]=$placeholder6;}else{$placeholder[6]='';}
			
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 6 veces
			$maxs = 6;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend25($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										 $placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										 $placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										 $placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										 $placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
										 $placeholder6, $name6,  $value6,  $required6,  $dataA6,  $dataB6,  $table6,  $filter6,   $extracomand6,
										 $placeholder7, $name7,  $value7,  $required7,  $dataA7,  $dataB7,  $table7,  $filter7,   $extracomand7,
										 $placeholder8, $name8,  $value8,  $required8,  $dataA8,  $dataB8,  $table8,  $filter8,   $extracomand8,
										 $placeholder9, $name9,  $value9,  $required9,  $dataA9,  $dataB9,  $table9,  $filter9,   $extracomand9,
										 $placeholder10,$name10, $value10, $required10, $dataA10, $dataB10, $table10, $filter10,  $extracomand10,
										 $placeholder11,$name11, $value11, $required11, $dataA11, $dataB11, $table11, $filter11,  $extracomand11,
										 $placeholder12,$name12, $value12, $required12, $dataA12, $dataB12, $table12, $filter12,  $extracomand12,
										 $placeholder13,$name13, $value13, $required13, $dataA13, $dataB13, $table13, $filter13,  $extracomand13,
										 $placeholder14,$name14, $value14, $required14, $dataA14, $dataB14, $table14, $filter14,  $extracomand14,
										 $placeholder15,$name15, $value15, $required15, $dataA15, $dataB15, $table15, $filter15,  $extracomand15,
										 $placeholder16,$name16, $value16, $required16, $dataA16, $dataB16, $table16, $filter16,  $extracomand16,
										 $placeholder17,$name17, $value17, $required17, $dataA17, $dataB17, $table17, $filter17,  $extracomand17,
										 $placeholder18,$name18, $value18, $required18, $dataA18, $dataB18, $table18, $filter18,  $extracomand18,
										 $placeholder19,$name19, $value19, $required19, $dataA19, $dataB19, $table19, $filter19,  $extracomand19,
										 $placeholder20,$name20, $value20, $required20, $dataA20, $dataB20, $table20, $filter20,  $extracomand20,
										 $placeholder21,$name21, $value21, $required21, $dataA21, $dataB21, $table21, $filter21,  $extracomand21,
										 $placeholder22,$name22, $value22, $required22, $dataA22, $dataB22, $table22, $filter22,  $extracomand22,
										 $placeholder23,$name23, $value23, $required23, $dataA23, $dataB23, $table23, $filter23,  $extracomand23,
										 $placeholder24,$name24, $value24, $required24, $dataA24, $dataB24, $table24, $filter24,  $extracomand24,
										 $placeholder25,$name25, $value25, $required25, $dataA25, $dataB25, $table25, $filter25,  $extracomand25,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required4, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required4 ('.$required4.') entregada en '.$placeholder4.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required5, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required5 ('.$required5.') entregada en '.$placeholder5.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required6, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required6 ('.$required6.') entregada en '.$placeholder6.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required7, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required7 ('.$required7.') entregada en '.$placeholder7.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required8, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required8 ('.$required8.') entregada en '.$placeholder8.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required9, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required9 ('.$required9.') entregada en '.$placeholder9.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required10, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required10 ('.$required10.') entregada en '.$placeholder10.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required11, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required11 ('.$required11.') entregada en '.$placeholder11.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required12, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required12 ('.$required12.') entregada en '.$placeholder12.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required13, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required13 ('.$required13.') entregada en '.$placeholder13.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required14, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required14 ('.$required14.') entregada en '.$placeholder14.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required15, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required15 ('.$required15.') entregada en '.$placeholder15.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required16, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required16 ('.$required16.') entregada en '.$placeholder16.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required17, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required17 ('.$required17.') entregada en '.$placeholder17.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required18, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required18 ('.$required18.') entregada en '.$placeholder18.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required19, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required19 ('.$required19.') entregada en '.$placeholder19.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required20, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required20 ('.$required20.') entregada en '.$placeholder20.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required21, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required21 ('.$required21.') entregada en '.$placeholder21.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required22, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required22 ('.$required22.') entregada en '.$placeholder22.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required23, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required23 ('.$required23.') entregada en '.$placeholder23.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required24, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required24 ('.$required24.') entregada en '.$placeholder24.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required25, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required25 ('.$required25.') entregada en '.$placeholder25.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value7)&&$value7!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value7 ('.$value7.') en <strong>'.$placeholder7.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value8)&&$value8!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value8 ('.$value8.') en <strong>'.$placeholder8.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value9)&&$value9!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value9 ('.$value9.') en <strong>'.$placeholder9.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value10)&&$value10!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value10 ('.$value10.') en <strong>'.$placeholder10.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value11)&&$value11!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value11 ('.$value11.') en <strong>'.$placeholder11.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value12)&&$value12!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value12 ('.$value12.') en <strong>'.$placeholder12.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value13)&&$value13!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value13 ('.$value13.') en <strong>'.$placeholder13.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value14)&&$value14!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value14 ('.$value14.') en <strong>'.$placeholder14.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value15)&&$value15!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value15 ('.$value15.') en <strong>'.$placeholder15.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value16)&&$value16!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value16 ('.$value16.') en <strong>'.$placeholder16.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value17)&&$value17!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value17 ('.$value17.') en <strong>'.$placeholder17.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value18)&&$value18!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value18 ('.$value18.') en <strong>'.$placeholder18.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value19)&&$value19!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value19 ('.$value19.') en <strong>'.$placeholder19.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value20)&&$value20!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value20 ('.$value20.') en <strong>'.$placeholder20.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value21)&&$value21!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value21 ('.$value21.') en <strong>'.$placeholder21.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value22)&&$value22!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value22 ('.$value22.') en <strong>'.$placeholder22.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value23)&&$value23!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value23 ('.$value23.') en <strong>'.$placeholder23.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value24)&&$value24!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value24 ('.$value24.') en <strong>'.$placeholder24.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value25)&&$value25!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value25 ('.$value25.') en <strong>'.$placeholder25.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value7)&&$value7!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value7 ('.$value7.') en <strong>'.$placeholder7.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value8)&&$value8!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value8 ('.$value8.') en <strong>'.$placeholder8.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value9)&&$value9!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value9 ('.$value9.') en <strong>'.$placeholder9.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value10)&&$value10!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value10 ('.$value10.') en <strong>'.$placeholder10.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value11)&&$value11!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value11 ('.$value11.') en <strong>'.$placeholder11.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value12)&&$value12!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value12 ('.$value12.') en <strong>'.$placeholder12.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value13)&&$value13!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value13 ('.$value13.') en <strong>'.$placeholder13.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value14)&&$value14!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value14 ('.$value14.') en <strong>'.$placeholder14.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value15)&&$value15!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value15 ('.$value15.') en <strong>'.$placeholder15.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value16)&&$value16!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value16 ('.$value16.') en <strong>'.$placeholder16.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value17)&&$value17!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value17 ('.$value17.') en <strong>'.$placeholder17.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value18)&&$value18!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value18 ('.$value18.') en <strong>'.$placeholder18.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value19)&&$value19!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value19 ('.$value19.') en <strong>'.$placeholder19.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value20)&&$value20!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value20 ('.$value20.') en <strong>'.$placeholder20.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value21)&&$value21!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value21 ('.$value21.') en <strong>'.$placeholder21.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value22)&&$value22!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value22 ('.$value22.') en <strong>'.$placeholder22.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value23)&&$value23!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value23 ('.$value23.') en <strong>'.$placeholder23.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value24)&&$value24!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value24 ('.$value24.') en <strong>'.$placeholder24.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value25)&&$value25!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value25 ('.$value25.') en <strong>'.$placeholder25.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			if($required4==1){$required[4]='';      }elseif($required4==2){$required[4]='required';$_SESSION['form_require'].=','.$name4;}
			if($required5==1){$required[5]='';      }elseif($required5==2){$required[5]='required';$_SESSION['form_require'].=','.$name5;}
			if($required6==1){$required[6]='';      }elseif($required6==2){$required[6]='required';$_SESSION['form_require'].=','.$name6;}
			if($required7==1){$required[7]='';      }elseif($required7==2){$required[7]='required';$_SESSION['form_require'].=','.$name7;}
			if($required8==1){$required[8]='';      }elseif($required8==2){$required[8]='required';$_SESSION['form_require'].=','.$name8;}
			if($required9==1){$required[9]='';      }elseif($required9==2){$required[9]='required';$_SESSION['form_require'].=','.$name9;}
			if($required10==1){$required[10]='';    }elseif($required10==2){$required[10]='required';$_SESSION['form_require'].=','.$name10;}
			if($required11==1){$required[11]='';    }elseif($required11==2){$required[11]='required';$_SESSION['form_require'].=','.$name11;}
			if($required12==1){$required[12]='';    }elseif($required12==2){$required[12]='required';$_SESSION['form_require'].=','.$name12;}
			if($required13==1){$required[13]='';    }elseif($required13==2){$required[13]='required';$_SESSION['form_require'].=','.$name13;}
			if($required14==1){$required[14]='';    }elseif($required14==2){$required[14]='required';$_SESSION['form_require'].=','.$name14;}
			if($required15==1){$required[15]='';    }elseif($required15==2){$required[15]='required';$_SESSION['form_require'].=','.$name15;}
			if($required16==1){$required[16]='';    }elseif($required16==2){$required[16]='required';$_SESSION['form_require'].=','.$name16;}
			if($required17==1){$required[17]='';    }elseif($required17==2){$required[17]='required';$_SESSION['form_require'].=','.$name17;}
			if($required18==1){$required[18]='';    }elseif($required18==2){$required[18]='required';$_SESSION['form_require'].=','.$name18;}
			if($required19==1){$required[19]='';    }elseif($required19==2){$required[19]='required';$_SESSION['form_require'].=','.$name19;}
			if($required20==1){$required[20]='';    }elseif($required20==2){$required[20]='required';$_SESSION['form_require'].=','.$name20;}
			if($required21==1){$required[21]='';    }elseif($required21==2){$required[21]='required';$_SESSION['form_require'].=','.$name21;}
			if($required22==1){$required[22]='';    }elseif($required22==2){$required[22]='required';$_SESSION['form_require'].=','.$name22;}
			if($required23==1){$required[23]='';    }elseif($required23==2){$required[23]='required';$_SESSION['form_require'].=','.$name23;}
			if($required24==1){$required[24]='';    }elseif($required24==2){$required[24]='required';$_SESSION['form_require'].=','.$name24;}
			if($required25==1){$required[25]='';    }elseif($required25==2){$required[25]='required';$_SESSION['form_require'].=','.$name25;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4;	}
			$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5;	}
			$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6;	}
			$filtro[7] = '';  if ($filter7!='0') {$filtro[7] .=" AND ".$filter7;	}
			$filtro[8] = '';  if ($filter8!='0') {$filtro[8] .=" AND ".$filter8;	}
			$filtro[9] = '';  if ($filter9!='0') {$filtro[9] .=" AND ".$filter9;	}
			$filtro[10] = ''; if ($filter10!='0'){$filtro[10] .=" AND ".$filter10;	}
			$filtro[11] = ''; if ($filter11!='0'){$filtro[11] .=" AND ".$filter11;	}
			$filtro[12] = ''; if ($filter12!='0'){$filtro[12] .=" AND ".$filter12;	}
			$filtro[13] = ''; if ($filter13!='0'){$filtro[13] .=" AND ".$filter13;	}
			$filtro[14] = ''; if ($filter14!='0'){$filtro[14] .=" AND ".$filter14;	}
			$filtro[15] = ''; if ($filter15!='0'){$filtro[15] .=" AND ".$filter15;	}
			$filtro[16] = ''; if ($filter16!='0'){$filtro[16] .=" AND ".$filter16;	}
			$filtro[17] = ''; if ($filter17!='0'){$filtro[17] .=" AND ".$filter17;	}
			$filtro[18] = ''; if ($filter18!='0'){$filtro[18] .=" AND ".$filter18;	}
			$filtro[19] = ''; if ($filter19!='0'){$filtro[19] .=" AND ".$filter19;	}
			$filtro[20] = ''; if ($filter20!='0'){$filtro[20] .=" AND ".$filter20;	}
			$filtro[21] = ''; if ($filter21!='0'){$filtro[21] .=" AND ".$filter21;	}
			$filtro[22] = ''; if ($filter22!='0'){$filtro[22] .=" AND ".$filter22;	}
			$filtro[23] = ''; if ($filter23!='0'){$filtro[23] .=" AND ".$filter23;	}
			$filtro[24] = ''; if ($filter24!='0'){$filtro[24] .=" AND ".$filter24;	}
			$filtro[25] = ''; if ($filter25!='0'){$filtro[25] .=" AND ".$filter25;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4;	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
			$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5;	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
			$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6;	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
			$excom[7] = '';  if ($extracomand7!='0') {$excom[7] .=" ".$extracomand7;	} else{$excom[7] .=" ORDER BY Nombre ASC ";}
			$excom[8] = '';  if ($extracomand8!='0') {$excom[8] .=" ".$extracomand8;	} else{$excom[8] .=" ORDER BY Nombre ASC ";}
			$excom[9] = '';  if ($extracomand9!='0') {$excom[9] .=" ".$extracomand9;	} else{$excom[9] .=" ORDER BY Nombre ASC ";}
			$excom[10] = ''; if ($extracomand10!='0'){$excom[10] .=" ".$extracomand10;	} else{$excom[10] .=" ORDER BY Nombre ASC ";}
			$excom[11] = ''; if ($extracomand11!='0'){$excom[11] .=" ".$extracomand11;	} else{$excom[11] .=" ORDER BY Nombre ASC ";}
			$excom[12] = ''; if ($extracomand12!='0'){$excom[12] .=" ".$extracomand12;	} else{$excom[12] .=" ORDER BY Nombre ASC ";}
			$excom[13] = ''; if ($extracomand13!='0'){$excom[13] .=" ".$extracomand13;	} else{$excom[13] .=" ORDER BY Nombre ASC ";}
			$excom[14] = ''; if ($extracomand14!='0'){$excom[14] .=" ".$extracomand14;	} else{$excom[14] .=" ORDER BY Nombre ASC ";}
			$excom[15] = ''; if ($extracomand15!='0'){$excom[15] .=" ".$extracomand15;	} else{$excom[15] .=" ORDER BY Nombre ASC ";}
			$excom[16] = ''; if ($extracomand16!='0'){$excom[16] .=" ".$extracomand16;	} else{$excom[16] .=" ORDER BY Nombre ASC ";}
			$excom[17] = ''; if ($extracomand17!='0'){$excom[17] .=" ".$extracomand17;	} else{$excom[17] .=" ORDER BY Nombre ASC ";}
			$excom[18] = ''; if ($extracomand18!='0'){$excom[18] .=" ".$extracomand18;	} else{$excom[18] .=" ORDER BY Nombre ASC ";}
			$excom[19] = ''; if ($extracomand19!='0'){$excom[19] .=" ".$extracomand19;	} else{$excom[19] .=" ORDER BY Nombre ASC ";}
			$excom[20] = ''; if ($extracomand20!='0'){$excom[20] .=" ".$extracomand20;	} else{$excom[20] .=" ORDER BY Nombre ASC ";}
			$excom[21] = ''; if ($extracomand21!='0'){$excom[21] .=" ".$extracomand21;	} else{$excom[21] .=" ORDER BY Nombre ASC ";}
			$excom[22] = ''; if ($extracomand22!='0'){$excom[22] .=" ".$extracomand22;	} else{$excom[22] .=" ORDER BY Nombre ASC ";}
			$excom[23] = ''; if ($extracomand23!='0'){$excom[23] .=" ".$extracomand23;	} else{$excom[23] .=" ORDER BY Nombre ASC ";}
			$excom[24] = ''; if ($extracomand24!='0'){$excom[24] .=" ".$extracomand24;	} else{$excom[24] .=" ORDER BY Nombre ASC ";}
			$excom[25] = ''; if ($extracomand25!='0'){$excom[25] .=" ".$extracomand25;	} else{$excom[25] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			if ($value4!=0&&$value4!=''){$display[4]='';}else{$display[4]='style="display:none;"';}
			if ($value5!=0&&$value5!=''){$display[5]='';}else{$display[5]='style="display:none;"';}
			if ($value6!=0&&$value6!=''){$display[6]='';}else{$display[6]='style="display:none;"';}
			if ($value7!=0&&$value7!=''){$display[7]='';}else{$display[7]='style="display:none;"';}
			if ($value8!=0&&$value8!=''){$display[8]='';}else{$display[8]='style="display:none;"';}
			if ($value9!=0&&$value9!=''){$display[9]='';}else{$display[9]='style="display:none;"';}
			if ($value10!=0&&$value10!=''){$display[10]='';}else{$display[10]='style="display:none;"';}
			if ($value11!=0&&$value11!=''){$display[11]='';}else{$display[11]='style="display:none;"';}
			if ($value12!=0&&$value12!=''){$display[12]='';}else{$display[12]='style="display:none;"';}
			if ($value13!=0&&$value13!=''){$display[13]='';}else{$display[13]='style="display:none;"';}
			if ($value14!=0&&$value14!=''){$display[14]='';}else{$display[14]='style="display:none;"';}
			if ($value15!=0&&$value15!=''){$display[15]='';}else{$display[15]='style="display:none;"';}
			if ($value16!=0&&$value16!=''){$display[16]='';}else{$display[16]='style="display:none;"';}
			if ($value17!=0&&$value17!=''){$display[17]='';}else{$display[17]='style="display:none;"';}
			if ($value18!=0&&$value18!=''){$display[18]='';}else{$display[18]='style="display:none;"';}
			if ($value19!=0&&$value19!=''){$display[19]='';}else{$display[19]='style="display:none;"';}
			if ($value20!=0&&$value20!=''){$display[20]='';}else{$display[20]='style="display:none;"';}
			if ($value21!=0&&$value21!=''){$display[21]='';}else{$display[21]='style="display:none;"';}
			if ($value22!=0&&$value22!=''){$display[22]='';}else{$display[22]='style="display:none;"';}
			if ($value23!=0&&$value23!=''){$display[23]='';}else{$display[23]='style="display:none;"';}
			if ($value24!=0&&$value24!=''){$display[24]='';}else{$display[24]='style="display:none;"';}
			if ($value25!=0&&$value25!=''){$display[25]='';}else{$display[25]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			if ($value4!=0&&$value4!=''){$value[4]=$value4;}else{$value[4]='';}
			if ($value5!=0&&$value5!=''){$value[5]=$value5;}else{$value[5]='';}
			if ($value6!=0&&$value6!=''){$value[6]=$value6;}else{$value[6]='';}
			if ($value7!=0&&$value7!=''){$value[7]=$value7;}else{$value[7]='';}
			if ($value8!=0&&$value8!=''){$value[8]=$value8;}else{$value[8]='';}
			if ($value9!=0&&$value9!=''){$value[9]=$value9;}else{$value[9]='';}
			if ($value10!=0&&$value10!=''){$value[10]=$value10;}else{$value[10]='';}
			if ($value11!=0&&$value11!=''){$value[11]=$value11;}else{$value[11]='';}
			if ($value12!=0&&$value12!=''){$value[12]=$value12;}else{$value[12]='';}
			if ($value13!=0&&$value13!=''){$value[13]=$value13;}else{$value[13]='';}
			if ($value14!=0&&$value14!=''){$value[14]=$value14;}else{$value[14]='';}
			if ($value15!=0&&$value15!=''){$value[15]=$value15;}else{$value[15]='';}
			if ($value16!=0&&$value16!=''){$value[16]=$value16;}else{$value[16]='';}
			if ($value17!=0&&$value17!=''){$value[17]=$value17;}else{$value[17]='';}
			if ($value18!=0&&$value18!=''){$value[18]=$value18;}else{$value[18]='';}
			if ($value19!=0&&$value19!=''){$value[19]=$value19;}else{$value[19]='';}
			if ($value20!=0&&$value20!=''){$value[20]=$value20;}else{$value[20]='';}
			if ($value21!=0&&$value21!=''){$value[21]=$value21;}else{$value[21]='';}
			if ($value22!=0&&$value22!=''){$value[22]=$value22;}else{$value[22]='';}
			if ($value23!=0&&$value23!=''){$value[23]=$value23;}else{$value[23]='';}
			if ($value24!=0&&$value24!=''){$value[24]=$value24;}else{$value[24]='';}
			if ($value25!=0&&$value25!=''){$value[25]=$value25;}else{$value[25]='';}

			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
			if (isset($name4)&&$name4!=''){$name[4]=$name4;}else{$name[4]='';}
			if (isset($name5)&&$name5!=''){$name[5]=$name5;}else{$name[5]='';}
			if (isset($name6)&&$name6!=''){$name[6]=$name6;}else{$name[6]='';}
			if (isset($name7)&&$name7!=''){$name[7]=$name7;}else{$name[7]='';}
			if (isset($name8)&&$name8!=''){$name[8]=$name8;}else{$name[8]='';}
			if (isset($name9)&&$name9!=''){$name[9]=$name9;}else{$name[9]='';}
			if (isset($name10)&&$name10!=''){$name[10]=$name10;}else{$name[10]='';}
			if (isset($name11)&&$name11!=''){$name[11]=$name11;}else{$name[11]='';}
			if (isset($name12)&&$name12!=''){$name[12]=$name12;}else{$name[12]='';}
			if (isset($name13)&&$name13!=''){$name[13]=$name13;}else{$name[13]='';}
			if (isset($name14)&&$name14!=''){$name[14]=$name14;}else{$name[14]='';}
			if (isset($name15)&&$name15!=''){$name[15]=$name15;}else{$name[15]='';}
			if (isset($name16)&&$name16!=''){$name[16]=$name16;}else{$name[16]='';}
			if (isset($name17)&&$name17!=''){$name[17]=$name17;}else{$name[17]='';}
			if (isset($name18)&&$name18!=''){$name[18]=$name18;}else{$name[18]='';}
			if (isset($name19)&&$name19!=''){$name[19]=$name19;}else{$name[19]='';}
			if (isset($name20)&&$name20!=''){$name[20]=$name20;}else{$name[20]='';}
			if (isset($name21)&&$name21!=''){$name[21]=$name21;}else{$name[21]='';}
			if (isset($name22)&&$name22!=''){$name[22]=$name22;}else{$name[22]='';}
			if (isset($name23)&&$name23!=''){$name[23]=$name23;}else{$name[23]='';}
			if (isset($name24)&&$name24!=''){$name[24]=$name24;}else{$name[24]='';}
			if (isset($name25)&&$name25!=''){$name[25]=$name25;}else{$name[25]='';}

			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			if (isset($dataA4)&&$dataA4!=''){$dataA[4]=$dataA4;}else{$dataA[4]='';}
			if (isset($dataA5)&&$dataA5!=''){$dataA[5]=$dataA5;}else{$dataA[5]='';}
			if (isset($dataA6)&&$dataA6!=''){$dataA[6]=$dataA6;}else{$dataA[6]='';}
			if (isset($dataA7)&&$dataA7!=''){$dataA[7]=$dataA7;}else{$dataA[7]='';}
			if (isset($dataA8)&&$dataA8!=''){$dataA[8]=$dataA8;}else{$dataA[8]='';}
			if (isset($dataA9)&&$dataA9!=''){$dataA[9]=$dataA9;}else{$dataA[9]='';}
			if (isset($dataA10)&&$dataA10!=''){$dataA[10]=$dataA10;}else{$dataA[10]='';}
			if (isset($dataA11)&&$dataA11!=''){$dataA[11]=$dataA11;}else{$dataA[11]='';}
			if (isset($dataA12)&&$dataA12!=''){$dataA[12]=$dataA12;}else{$dataA[12]='';}
			if (isset($dataA13)&&$dataA13!=''){$dataA[13]=$dataA13;}else{$dataA[13]='';}
			if (isset($dataA14)&&$dataA14!=''){$dataA[14]=$dataA14;}else{$dataA[14]='';}
			if (isset($dataA15)&&$dataA15!=''){$dataA[15]=$dataA15;}else{$dataA[15]='';}
			if (isset($dataA16)&&$dataA16!=''){$dataA[16]=$dataA16;}else{$dataA[16]='';}
			if (isset($dataA17)&&$dataA17!=''){$dataA[17]=$dataA17;}else{$dataA[17]='';}
			if (isset($dataA18)&&$dataA18!=''){$dataA[18]=$dataA18;}else{$dataA[18]='';}
			if (isset($dataA19)&&$dataA19!=''){$dataA[19]=$dataA19;}else{$dataA[19]='';}
			if (isset($dataA20)&&$dataA20!=''){$dataA[20]=$dataA20;}else{$dataA[20]='';}
			if (isset($dataA21)&&$dataA21!=''){$dataA[21]=$dataA21;}else{$dataA[21]='';}
			if (isset($dataA22)&&$dataA22!=''){$dataA[22]=$dataA22;}else{$dataA[22]='';}
			if (isset($dataA23)&&$dataA23!=''){$dataA[23]=$dataA23;}else{$dataA[23]='';}
			if (isset($dataA24)&&$dataA24!=''){$dataA[24]=$dataA24;}else{$dataA[24]='';}
			if (isset($dataA25)&&$dataA25!=''){$dataA[25]=$dataA25;}else{$dataA[25]='';}

			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			if (isset($dataB4)&&$dataB4!=''){$dataB[4]=$dataB4;}else{$dataB[4]='';}
			if (isset($dataB5)&&$dataB5!=''){$dataB[5]=$dataB5;}else{$dataB[5]='';}
			if (isset($dataB6)&&$dataB6!=''){$dataB[6]=$dataB6;}else{$dataB[6]='';}
			if (isset($dataB7)&&$dataB7!=''){$dataB[7]=$dataB7;}else{$dataB[7]='';}
			if (isset($dataB8)&&$dataB8!=''){$dataB[8]=$dataB8;}else{$dataB[8]='';}
			if (isset($dataB9)&&$dataB9!=''){$dataB[9]=$dataB9;}else{$dataB[9]='';}
			if (isset($dataB10)&&$dataB10!=''){$dataB[10]=$dataB10;}else{$dataB[10]='';}
			if (isset($dataB11)&&$dataB11!=''){$dataB[11]=$dataB11;}else{$dataB[11]='';}
			if (isset($dataB12)&&$dataB12!=''){$dataB[12]=$dataB12;}else{$dataB[12]='';}
			if (isset($dataB13)&&$dataB13!=''){$dataB[13]=$dataB13;}else{$dataB[13]='';}
			if (isset($dataB14)&&$dataB14!=''){$dataB[14]=$dataB14;}else{$dataB[14]='';}
			if (isset($dataB15)&&$dataB15!=''){$dataB[15]=$dataB15;}else{$dataB[15]='';}
			if (isset($dataB16)&&$dataB16!=''){$dataB[16]=$dataB16;}else{$dataB[16]='';}
			if (isset($dataB17)&&$dataB17!=''){$dataB[17]=$dataB17;}else{$dataB[17]='';}
			if (isset($dataB18)&&$dataB18!=''){$dataB[18]=$dataB18;}else{$dataB[18]='';}
			if (isset($dataB19)&&$dataB19!=''){$dataB[19]=$dataB19;}else{$dataB[19]='';}
			if (isset($dataB20)&&$dataB20!=''){$dataB[20]=$dataB20;}else{$dataB[20]='';}
			if (isset($dataB21)&&$dataB21!=''){$dataB[21]=$dataB21;}else{$dataB[21]='';}
			if (isset($dataB22)&&$dataB22!=''){$dataB[22]=$dataB22;}else{$dataB[22]='';}
			if (isset($dataB23)&&$dataB23!=''){$dataB[23]=$dataB23;}else{$dataB[23]='';}
			if (isset($dataB24)&&$dataB24!=''){$dataB[24]=$dataB24;}else{$dataB[24]='';}
			if (isset($dataB25)&&$dataB25!=''){$dataB[25]=$dataB25;}else{$dataB[25]='';}

			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			if (isset($table4)&&$table4!=''){$table[4]=$table4;}else{$table[4]='';}
			if (isset($table5)&&$table5!=''){$table[5]=$table5;}else{$table[5]='';}
			if (isset($table6)&&$table6!=''){$table[6]=$table6;}else{$table[6]='';}
			if (isset($table7)&&$table7!=''){$table[7]=$table7;}else{$table[7]='';}
			if (isset($table8)&&$table8!=''){$table[8]=$table8;}else{$table[8]='';}
			if (isset($table9)&&$table9!=''){$table[9]=$table9;}else{$table[9]='';}
			if (isset($table10)&&$table10!=''){$table[10]=$table10;}else{$table[10]='';}
			if (isset($table11)&&$table11!=''){$table[11]=$table11;}else{$table[11]='';}
			if (isset($table12)&&$table12!=''){$table[12]=$table12;}else{$table[12]='';}
			if (isset($table13)&&$table13!=''){$table[13]=$table13;}else{$table[13]='';}
			if (isset($table14)&&$table14!=''){$table[14]=$table14;}else{$table[14]='';}
			if (isset($table15)&&$table15!=''){$table[15]=$table15;}else{$table[15]='';}
			if (isset($table16)&&$table16!=''){$table[16]=$table16;}else{$table[16]='';}
			if (isset($table17)&&$table17!=''){$table[17]=$table17;}else{$table[17]='';}
			if (isset($table18)&&$table18!=''){$table[18]=$table18;}else{$table[18]='';}
			if (isset($table19)&&$table19!=''){$table[19]=$table19;}else{$table[19]='';}
			if (isset($table20)&&$table20!=''){$table[20]=$table20;}else{$table[20]='';}
			if (isset($table21)&&$table21!=''){$table[21]=$table21;}else{$table[21]='';}
			if (isset($table22)&&$table22!=''){$table[22]=$table22;}else{$table[22]='';}
			if (isset($table23)&&$table23!=''){$table[23]=$table23;}else{$table[23]='';}
			if (isset($table24)&&$table24!=''){$table[24]=$table24;}else{$table[24]='';}
			if (isset($table25)&&$table25!=''){$table[25]=$table25;}else{$table[25]='';}

			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			if (isset($placeholder4)&&$placeholder4!=''){$placeholder[4]=$placeholder4;}else{$placeholder[4]='';}
			if (isset($placeholder5)&&$placeholder5!=''){$placeholder[5]=$placeholder5;}else{$placeholder[5]='';}
			if (isset($placeholder6)&&$placeholder6!=''){$placeholder[6]=$placeholder6;}else{$placeholder[6]='';}
			if (isset($placeholder7)&&$placeholder7!=''){$placeholder[7]=$placeholder7;}else{$placeholder[7]='';}
			if (isset($placeholder8)&&$placeholder8!=''){$placeholder[8]=$placeholder8;}else{$placeholder[8]='';}
			if (isset($placeholder9)&&$placeholder9!=''){$placeholder[9]=$placeholder9;}else{$placeholder[9]='';}
			if (isset($placeholder10)&&$placeholder10!=''){$placeholder[10]=$placeholder10;}else{$placeholder[10]='';}
			if (isset($placeholder11)&&$placeholder11!=''){$placeholder[11]=$placeholder11;}else{$placeholder[11]='';}
			if (isset($placeholder12)&&$placeholder12!=''){$placeholder[12]=$placeholder12;}else{$placeholder[12]='';}
			if (isset($placeholder13)&&$placeholder13!=''){$placeholder[13]=$placeholder13;}else{$placeholder[13]='';}
			if (isset($placeholder14)&&$placeholder14!=''){$placeholder[14]=$placeholder14;}else{$placeholder[14]='';}
			if (isset($placeholder15)&&$placeholder15!=''){$placeholder[15]=$placeholder15;}else{$placeholder[15]='';}
			if (isset($placeholder16)&&$placeholder16!=''){$placeholder[16]=$placeholder16;}else{$placeholder[16]='';}
			if (isset($placeholder17)&&$placeholder17!=''){$placeholder[17]=$placeholder17;}else{$placeholder[17]='';}
			if (isset($placeholder18)&&$placeholder18!=''){$placeholder[18]=$placeholder18;}else{$placeholder[18]='';}
			if (isset($placeholder19)&&$placeholder19!=''){$placeholder[19]=$placeholder19;}else{$placeholder[19]='';}
			if (isset($placeholder20)&&$placeholder20!=''){$placeholder[20]=$placeholder20;}else{$placeholder[20]='';}
			if (isset($placeholder21)&&$placeholder21!=''){$placeholder[21]=$placeholder21;}else{$placeholder[21]='';}
			if (isset($placeholder22)&&$placeholder22!=''){$placeholder[22]=$placeholder22;}else{$placeholder[22]='';}
			if (isset($placeholder23)&&$placeholder23!=''){$placeholder[23]=$placeholder23;}else{$placeholder[23]='';}
			if (isset($placeholder24)&&$placeholder24!=''){$placeholder[24]=$placeholder24;}else{$placeholder[24]='';}
			if (isset($placeholder25)&&$placeholder25!=''){$placeholder[25]=$placeholder25;}else{$placeholder[25]='';}

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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 25 veces
			$maxs = 25;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	* 	$Form->form_select_filter('Meses del año','idMeses', 1, 1, 'idMes', 'Nombre', 'tabla_meses', '', 'Nombre ASC', $dbConn );
	* 
	*===========================    Parametros   ===========================
	* String   $placeholder   Nombre o texto a mostrar en el navegador
	* String   $name          Nombre del identificador del Input
	* Integer  $value         Valor por defecto, debe ser un numero entero
	* Integer  $required      Si dato es obligatorio (1=no, 2=si)
	* String   $data1         Identificador de la base de datos
	* String   $data2         Texto a mostrar en la opcion del input
	* String   $table         Tabla desde donde tomar los datos
	* String   $filter        Filtro de la seleccion de la base de datos
	* String   $orderby       Ordenamiento de los datos, si no hay nada ordena automatico
	* Object   $dbConn        Puntero a la base de datos
	* @return  String
	************************************************************************/
	public function form_select_depend50($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										 $placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										 $placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										 $placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										 $placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
										 $placeholder6, $name6,  $value6,  $required6,  $dataA6,  $dataB6,  $table6,  $filter6,   $extracomand6,
										 $placeholder7, $name7,  $value7,  $required7,  $dataA7,  $dataB7,  $table7,  $filter7,   $extracomand7,
										 $placeholder8, $name8,  $value8,  $required8,  $dataA8,  $dataB8,  $table8,  $filter8,   $extracomand8,
										 $placeholder9, $name9,  $value9,  $required9,  $dataA9,  $dataB9,  $table9,  $filter9,   $extracomand9,
										 $placeholder10,$name10, $value10, $required10, $dataA10, $dataB10, $table10, $filter10,  $extracomand10,
										 $placeholder11,$name11, $value11, $required11, $dataA11, $dataB11, $table11, $filter11,  $extracomand11,
										 $placeholder12,$name12, $value12, $required12, $dataA12, $dataB12, $table12, $filter12,  $extracomand12,
										 $placeholder13,$name13, $value13, $required13, $dataA13, $dataB13, $table13, $filter13,  $extracomand13,
										 $placeholder14,$name14, $value14, $required14, $dataA14, $dataB14, $table14, $filter14,  $extracomand14,
										 $placeholder15,$name15, $value15, $required15, $dataA15, $dataB15, $table15, $filter15,  $extracomand15,
										 $placeholder16,$name16, $value16, $required16, $dataA16, $dataB16, $table16, $filter16,  $extracomand16,
										 $placeholder17,$name17, $value17, $required17, $dataA17, $dataB17, $table17, $filter17,  $extracomand17,
										 $placeholder18,$name18, $value18, $required18, $dataA18, $dataB18, $table18, $filter18,  $extracomand18,
										 $placeholder19,$name19, $value19, $required19, $dataA19, $dataB19, $table19, $filter19,  $extracomand19,
										 $placeholder20,$name20, $value20, $required20, $dataA20, $dataB20, $table20, $filter20,  $extracomand20,
										 $placeholder21,$name21, $value21, $required21, $dataA21, $dataB21, $table21, $filter21,  $extracomand21,
										 $placeholder22,$name22, $value22, $required22, $dataA22, $dataB22, $table22, $filter22,  $extracomand22,
										 $placeholder23,$name23, $value23, $required23, $dataA23, $dataB23, $table23, $filter23,  $extracomand23,
										 $placeholder24,$name24, $value24, $required24, $dataA24, $dataB24, $table24, $filter24,  $extracomand24,
										 $placeholder25,$name25, $value25, $required25, $dataA25, $dataB25, $table25, $filter25,  $extracomand25,
										 $placeholder26,$name26, $value26, $required26, $dataA26, $dataB26, $table26, $filter26,  $extracomand26,
										 $placeholder27,$name27, $value27, $required27, $dataA27, $dataB27, $table27, $filter27,  $extracomand27,
										 $placeholder28,$name28, $value28, $required28, $dataA28, $dataB28, $table28, $filter28,  $extracomand28,
										 $placeholder29,$name29, $value29, $required29, $dataA29, $dataB29, $table29, $filter29,  $extracomand29,
										 $placeholder30,$name30, $value30, $required30, $dataA30, $dataB30, $table30, $filter30,  $extracomand30,
										 $placeholder31,$name31, $value31, $required31, $dataA31, $dataB31, $table31, $filter31,  $extracomand31,
										 $placeholder32,$name32, $value32, $required32, $dataA32, $dataB32, $table32, $filter32,  $extracomand32,
										 $placeholder33,$name33, $value33, $required33, $dataA33, $dataB33, $table33, $filter33,  $extracomand33,
										 $placeholder34,$name34, $value34, $required34, $dataA34, $dataB34, $table34, $filter34,  $extracomand34,
										 $placeholder35,$name35, $value35, $required35, $dataA35, $dataB35, $table35, $filter35,  $extracomand35,
										 $placeholder36,$name36, $value36, $required36, $dataA36, $dataB36, $table36, $filter36,  $extracomand36,
										 $placeholder37,$name37, $value37, $required37, $dataA37, $dataB37, $table37, $filter37,  $extracomand37,
										 $placeholder38,$name38, $value38, $required38, $dataA38, $dataB38, $table38, $filter38,  $extracomand38,
										 $placeholder39,$name39, $value39, $required39, $dataA39, $dataB39, $table39, $filter39,  $extracomand39,
										 $placeholder40,$name40, $value40, $required40, $dataA40, $dataB40, $table40, $filter40,  $extracomand40,
										 $placeholder41,$name41, $value41, $required41, $dataA41, $dataB41, $table41, $filter41,  $extracomand41,
										 $placeholder42,$name42, $value42, $required42, $dataA42, $dataB42, $table42, $filter42,  $extracomand42,
										 $placeholder43,$name43, $value43, $required43, $dataA43, $dataB43, $table43, $filter43,  $extracomand43,
										 $placeholder44,$name44, $value44, $required44, $dataA44, $dataB44, $table44, $filter44,  $extracomand44,
										 $placeholder45,$name45, $value45, $required45, $dataA45, $dataB45, $table45, $filter45,  $extracomand45,
										 $placeholder46,$name46, $value46, $required46, $dataA46, $dataB46, $table46, $filter46,  $extracomand46,
										 $placeholder47,$name47, $value47, $required47, $dataA47, $dataB47, $table47, $filter47,  $extracomand47,
										 $placeholder48,$name48, $value48, $required48, $dataA48, $dataB48, $table48, $filter48,  $extracomand48,
										 $placeholder49,$name49, $value49, $required49, $dataA49, $dataB49, $table49, $filter49,  $extracomand49,
										 $placeholder50,$name50, $value50, $required50, $dataA50, $dataB50, $table50, $filter50,  $extracomand50,
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
		if (!in_array($required3, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required3 ('.$required3.') entregada en '.$placeholder3.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required4, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required4 ('.$required4.') entregada en '.$placeholder4.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required5, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required5 ('.$required5.') entregada en '.$placeholder5.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required6, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required6 ('.$required6.') entregada en '.$placeholder6.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required7, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required7 ('.$required7.') entregada en '.$placeholder7.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required8, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required8 ('.$required8.') entregada en '.$placeholder8.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required9, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required9 ('.$required9.') entregada en '.$placeholder9.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required10, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required10 ('.$required10.') entregada en '.$placeholder10.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required11, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required11 ('.$required11.') entregada en '.$placeholder11.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required12, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required12 ('.$required12.') entregada en '.$placeholder12.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required13, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required13 ('.$required13.') entregada en '.$placeholder13.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required14, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required14 ('.$required14.') entregada en '.$placeholder14.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required15, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required15 ('.$required15.') entregada en '.$placeholder15.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required16, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required16 ('.$required16.') entregada en '.$placeholder16.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required17, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required17 ('.$required17.') entregada en '.$placeholder17.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required18, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required18 ('.$required18.') entregada en '.$placeholder18.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required19, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required19 ('.$required19.') entregada en '.$placeholder19.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required20, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required20 ('.$required20.') entregada en '.$placeholder20.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required21, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required21 ('.$required21.') entregada en '.$placeholder21.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required22, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required22 ('.$required22.') entregada en '.$placeholder22.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required23, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required23 ('.$required23.') entregada en '.$placeholder23.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required24, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required24 ('.$required24.') entregada en '.$placeholder24.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required25, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required25 ('.$required25.') entregada en '.$placeholder25.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required26, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required26 ('.$required26.') entregada en '.$placeholder26.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required27, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required27 ('.$required27.') entregada en '.$placeholder27.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required28, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required28 ('.$required28.') entregada en '.$placeholder28.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required29, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required29 ('.$required29.') entregada en '.$placeholder29.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required30, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required30 ('.$required30.') entregada en '.$placeholder30.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required31, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required31 ('.$required31.') entregada en '.$placeholder31.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required32, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required32 ('.$required32.') entregada en '.$placeholder32.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required33, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required33 ('.$required33.') entregada en '.$placeholder33.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required34, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required34 ('.$required34.') entregada en '.$placeholder34.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required35, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required35 ('.$required35.') entregada en '.$placeholder35.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required36, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required36 ('.$required36.') entregada en '.$placeholder36.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required37, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required37 ('.$required37.') entregada en '.$placeholder37.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required38, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required38 ('.$required38.') entregada en '.$placeholder38.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required39, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required39 ('.$required39.') entregada en '.$placeholder39.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required40, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required40 ('.$required40.') entregada en '.$placeholder40.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required41, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required41 ('.$required41.') entregada en '.$placeholder41.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required42, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required42 ('.$required42.') entregada en '.$placeholder42.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required43, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required43 ('.$required43.') entregada en '.$placeholder43.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required44, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required44 ('.$required44.') entregada en '.$placeholder44.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required45, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required45 ('.$required45.') entregada en '.$placeholder45.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required46, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required46 ('.$required46.') entregada en '.$placeholder46.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required47, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required47 ('.$required47.') entregada en '.$placeholder47.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required48, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required48 ('.$required48.') entregada en '.$placeholder48.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required49, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required49 ('.$required49.') entregada en '.$placeholder49.' no esta dentro de las opciones');
			$errorn++;
		}
		if (!in_array($required50, $requerido)) {
			alert_post_data(4,1,1, 'La configuracion $required50 ('.$required50.') entregada en '.$placeholder50.' no esta dentro de las opciones');
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
		if (!validarNumero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value7)&&$value7!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value7 ('.$value7.') en <strong>'.$placeholder7.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value8)&&$value8!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value8 ('.$value8.') en <strong>'.$placeholder8.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value9)&&$value9!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value9 ('.$value9.') en <strong>'.$placeholder9.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value10)&&$value10!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value10 ('.$value10.') en <strong>'.$placeholder10.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value11)&&$value11!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value11 ('.$value11.') en <strong>'.$placeholder11.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value12)&&$value12!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value12 ('.$value12.') en <strong>'.$placeholder12.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value13)&&$value13!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value13 ('.$value13.') en <strong>'.$placeholder13.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value14)&&$value14!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value14 ('.$value14.') en <strong>'.$placeholder14.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value15)&&$value15!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value15 ('.$value15.') en <strong>'.$placeholder15.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value16)&&$value16!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value16 ('.$value16.') en <strong>'.$placeholder16.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value17)&&$value17!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value17 ('.$value17.') en <strong>'.$placeholder17.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value18)&&$value18!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value18 ('.$value18.') en <strong>'.$placeholder18.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value19)&&$value19!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value19 ('.$value19.') en <strong>'.$placeholder19.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value20)&&$value20!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value20 ('.$value20.') en <strong>'.$placeholder20.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value21)&&$value21!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value21 ('.$value21.') en <strong>'.$placeholder21.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value22)&&$value22!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value22 ('.$value22.') en <strong>'.$placeholder22.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value23)&&$value23!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value23 ('.$value23.') en <strong>'.$placeholder23.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value24)&&$value24!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value24 ('.$value24.') en <strong>'.$placeholder24.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value25)&&$value25!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value25 ('.$value25.') en <strong>'.$placeholder25.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value26)&&$value26!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value26 ('.$value26.') en <strong>'.$placeholder26.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value27)&&$value27!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value27 ('.$value27.') en <strong>'.$placeholder27.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value28)&&$value28!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value28 ('.$value28.') en <strong>'.$placeholder28.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value29)&&$value29!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value29 ('.$value29.') en <strong>'.$placeholder29.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value30)&&$value30!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value30 ('.$value30.') en <strong>'.$placeholder30.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value31)&&$value31!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value31 ('.$value31.') en <strong>'.$placeholder31.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value32)&&$value32!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value32 ('.$value32.') en <strong>'.$placeholder32.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value33)&&$value33!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value33 ('.$value33.') en <strong>'.$placeholder33.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value34)&&$value34!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value34 ('.$value34.') en <strong>'.$placeholder34.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value35)&&$value35!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value35 ('.$value35.') en <strong>'.$placeholder35.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value36)&&$value36!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value36 ('.$value36.') en <strong>'.$placeholder36.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value37)&&$value37!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value37 ('.$value37.') en <strong>'.$placeholder37.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value38)&&$value38!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value38 ('.$value38.') en <strong>'.$placeholder38.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value39)&&$value39!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value39 ('.$value39.') en <strong>'.$placeholder39.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value40)&&$value40!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value40 ('.$value40.') en <strong>'.$placeholder40.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value41)&&$value41!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value41 ('.$value41.') en <strong>'.$placeholder41.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value42)&&$value42!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value42 ('.$value42.') en <strong>'.$placeholder42.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value43)&&$value43!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value43 ('.$value43.') en <strong>'.$placeholder43.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value44)&&$value44!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value44 ('.$value44.') en <strong>'.$placeholder44.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value45)&&$value45!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value45 ('.$value45.') en <strong>'.$placeholder45.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value46)&&$value46!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value46 ('.$value46.') en <strong>'.$placeholder46.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value47)&&$value47!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value47 ('.$value47.') en <strong>'.$placeholder47.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value48)&&$value48!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value48 ('.$value48.') en <strong>'.$placeholder48.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value49)&&$value49!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value49 ('.$value49.') en <strong>'.$placeholder49.'</strong> no es un numero');
			$errorn++;
		}
		if (!validarNumero($value50)&&$value50!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value50 ('.$value50.') en <strong>'.$placeholder50.'</strong> no es un numero');
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
		if (!validaEntero($value3)&&$value3!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value3 ('.$value3.') en <strong>'.$placeholder3.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value4)&&$value4!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value4 ('.$value4.') en <strong>'.$placeholder4.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value5)&&$value5!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value5 ('.$value5.') en <strong>'.$placeholder5.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value6)&&$value6!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value6 ('.$value6.') en <strong>'.$placeholder6.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value7)&&$value7!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value7 ('.$value7.') en <strong>'.$placeholder7.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value8)&&$value8!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value8 ('.$value8.') en <strong>'.$placeholder8.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value9)&&$value9!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value9 ('.$value9.') en <strong>'.$placeholder9.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value10)&&$value10!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value10 ('.$value10.') en <strong>'.$placeholder10.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value11)&&$value11!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value11 ('.$value11.') en <strong>'.$placeholder11.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value12)&&$value12!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value12 ('.$value12.') en <strong>'.$placeholder12.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value13)&&$value13!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value13 ('.$value13.') en <strong>'.$placeholder13.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value14)&&$value14!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value14 ('.$value14.') en <strong>'.$placeholder14.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value15)&&$value15!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value15 ('.$value15.') en <strong>'.$placeholder15.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value16)&&$value16!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value16 ('.$value16.') en <strong>'.$placeholder16.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value17)&&$value17!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value17 ('.$value17.') en <strong>'.$placeholder17.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value18)&&$value18!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value18 ('.$value18.') en <strong>'.$placeholder18.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value19)&&$value19!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value19 ('.$value19.') en <strong>'.$placeholder19.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value20)&&$value20!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value20 ('.$value20.') en <strong>'.$placeholder20.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value21)&&$value21!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value21 ('.$value21.') en <strong>'.$placeholder21.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value22)&&$value22!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value22 ('.$value22.') en <strong>'.$placeholder22.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value23)&&$value23!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value23 ('.$value23.') en <strong>'.$placeholder23.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value24)&&$value24!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value24 ('.$value24.') en <strong>'.$placeholder24.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value25)&&$value25!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value25 ('.$value25.') en <strong>'.$placeholder25.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value26)&&$value26!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value26 ('.$value26.') en <strong>'.$placeholder26.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value27)&&$value27!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value27 ('.$value27.') en <strong>'.$placeholder27.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value28)&&$value28!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value28 ('.$value28.') en <strong>'.$placeholder28.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value29)&&$value29!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value29 ('.$value29.') en <strong>'.$placeholder29.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value30)&&$value30!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value30 ('.$value30.') en <strong>'.$placeholder30.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value31)&&$value31!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value31 ('.$value31.') en <strong>'.$placeholder31.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value32)&&$value32!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value32 ('.$value32.') en <strong>'.$placeholder32.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value33)&&$value33!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value33 ('.$value33.') en <strong>'.$placeholder33.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value34)&&$value34!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value34 ('.$value34.') en <strong>'.$placeholder34.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value35)&&$value35!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value35 ('.$value35.') en <strong>'.$placeholder35.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value36)&&$value36!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value36 ('.$value36.') en <strong>'.$placeholder36.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value37)&&$value37!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value37 ('.$value37.') en <strong>'.$placeholder37.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value38)&&$value38!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value38 ('.$value38.') en <strong>'.$placeholder38.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value39)&&$value39!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value39 ('.$value39.') en <strong>'.$placeholder39.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value40)&&$value40!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value40 ('.$value40.') en <strong>'.$placeholder40.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value41)&&$value41!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value41 ('.$value41.') en <strong>'.$placeholder41.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value42)&&$value42!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value42 ('.$value42.') en <strong>'.$placeholder42.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value43)&&$value43!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value43 ('.$value43.') en <strong>'.$placeholder43.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value44)&&$value44!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value44 ('.$value44.') en <strong>'.$placeholder44.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value45)&&$value45!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value45 ('.$value45.') en <strong>'.$placeholder45.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value46)&&$value46!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value46 ('.$value46.') en <strong>'.$placeholder46.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value47)&&$value47!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value47 ('.$value47.') en <strong>'.$placeholder47.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value48)&&$value48!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value48 ('.$value48.') en <strong>'.$placeholder48.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value49)&&$value49!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value49 ('.$value49.') en <strong>'.$placeholder49.'</strong> no es un numero entero');
			$errorn++;
		}
		if (!validaEntero($value50)&&$value50!=''){ 
			alert_post_data(4,1,1, 'El valor ingresado en $value50 ('.$value50.') en <strong>'.$placeholder50.'</strong> no es un numero entero');
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
			if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
			if($required4==1){$required[4]='';      }elseif($required4==2){$required[4]='required';$_SESSION['form_require'].=','.$name4;}
			if($required5==1){$required[5]='';      }elseif($required5==2){$required[5]='required';$_SESSION['form_require'].=','.$name5;}
			if($required6==1){$required[6]='';      }elseif($required6==2){$required[6]='required';$_SESSION['form_require'].=','.$name6;}
			if($required7==1){$required[7]='';      }elseif($required7==2){$required[7]='required';$_SESSION['form_require'].=','.$name7;}
			if($required8==1){$required[8]='';      }elseif($required8==2){$required[8]='required';$_SESSION['form_require'].=','.$name8;}
			if($required9==1){$required[9]='';      }elseif($required9==2){$required[9]='required';$_SESSION['form_require'].=','.$name9;}
			if($required10==1){$required[10]='';    }elseif($required10==2){$required[10]='required';$_SESSION['form_require'].=','.$name10;}
			if($required11==1){$required[11]='';    }elseif($required11==2){$required[11]='required';$_SESSION['form_require'].=','.$name11;}
			if($required12==1){$required[12]='';    }elseif($required12==2){$required[12]='required';$_SESSION['form_require'].=','.$name12;}
			if($required13==1){$required[13]='';    }elseif($required13==2){$required[13]='required';$_SESSION['form_require'].=','.$name13;}
			if($required14==1){$required[14]='';    }elseif($required14==2){$required[14]='required';$_SESSION['form_require'].=','.$name14;}
			if($required15==1){$required[15]='';    }elseif($required15==2){$required[15]='required';$_SESSION['form_require'].=','.$name15;}
			if($required16==1){$required[16]='';    }elseif($required16==2){$required[16]='required';$_SESSION['form_require'].=','.$name16;}
			if($required17==1){$required[17]='';    }elseif($required17==2){$required[17]='required';$_SESSION['form_require'].=','.$name17;}
			if($required18==1){$required[18]='';    }elseif($required18==2){$required[18]='required';$_SESSION['form_require'].=','.$name18;}
			if($required19==1){$required[19]='';    }elseif($required19==2){$required[19]='required';$_SESSION['form_require'].=','.$name19;}
			if($required20==1){$required[20]='';    }elseif($required20==2){$required[20]='required';$_SESSION['form_require'].=','.$name20;}
			if($required21==1){$required[21]='';    }elseif($required21==2){$required[21]='required';$_SESSION['form_require'].=','.$name21;}
			if($required22==1){$required[22]='';    }elseif($required22==2){$required[22]='required';$_SESSION['form_require'].=','.$name22;}
			if($required23==1){$required[23]='';    }elseif($required23==2){$required[23]='required';$_SESSION['form_require'].=','.$name23;}
			if($required24==1){$required[24]='';    }elseif($required24==2){$required[24]='required';$_SESSION['form_require'].=','.$name24;}
			if($required25==1){$required[25]='';    }elseif($required25==2){$required[25]='required';$_SESSION['form_require'].=','.$name25;}
			if($required26==1){$required[26]='';    }elseif($required26==2){$required[26]='required';$_SESSION['form_require'].=','.$name26;}
			if($required27==1){$required[27]='';    }elseif($required27==2){$required[27]='required';$_SESSION['form_require'].=','.$name27;}
			if($required28==1){$required[28]='';    }elseif($required28==2){$required[28]='required';$_SESSION['form_require'].=','.$name28;}
			if($required29==1){$required[29]='';    }elseif($required29==2){$required[29]='required';$_SESSION['form_require'].=','.$name29;}
			if($required30==1){$required[30]='';    }elseif($required30==2){$required[30]='required';$_SESSION['form_require'].=','.$name30;}
			if($required31==1){$required[31]='';    }elseif($required31==2){$required[31]='required';$_SESSION['form_require'].=','.$name31;}
			if($required32==1){$required[32]='';    }elseif($required32==2){$required[32]='required';$_SESSION['form_require'].=','.$name32;}
			if($required33==1){$required[33]='';    }elseif($required33==2){$required[33]='required';$_SESSION['form_require'].=','.$name33;}
			if($required34==1){$required[34]='';    }elseif($required34==2){$required[34]='required';$_SESSION['form_require'].=','.$name34;}
			if($required35==1){$required[35]='';    }elseif($required35==2){$required[35]='required';$_SESSION['form_require'].=','.$name35;}
			if($required36==1){$required[36]='';    }elseif($required36==2){$required[36]='required';$_SESSION['form_require'].=','.$name36;}
			if($required37==1){$required[37]='';    }elseif($required37==2){$required[37]='required';$_SESSION['form_require'].=','.$name37;}
			if($required38==1){$required[38]='';    }elseif($required38==2){$required[38]='required';$_SESSION['form_require'].=','.$name38;}
			if($required39==1){$required[39]='';    }elseif($required39==2){$required[39]='required';$_SESSION['form_require'].=','.$name39;}
			if($required40==1){$required[40]='';    }elseif($required40==2){$required[40]='required';$_SESSION['form_require'].=','.$name40;}
			if($required41==1){$required[41]='';    }elseif($required41==2){$required[41]='required';$_SESSION['form_require'].=','.$name41;}
			if($required42==1){$required[42]='';    }elseif($required42==2){$required[42]='required';$_SESSION['form_require'].=','.$name42;}
			if($required43==1){$required[43]='';    }elseif($required43==2){$required[43]='required';$_SESSION['form_require'].=','.$name43;}
			if($required44==1){$required[44]='';    }elseif($required44==2){$required[44]='required';$_SESSION['form_require'].=','.$name44;}
			if($required45==1){$required[45]='';    }elseif($required45==2){$required[45]='required';$_SESSION['form_require'].=','.$name45;}
			if($required46==1){$required[46]='';    }elseif($required46==2){$required[46]='required';$_SESSION['form_require'].=','.$name46;}
			if($required47==1){$required[47]='';    }elseif($required47==2){$required[47]='required';$_SESSION['form_require'].=','.$name47;}
			if($required48==1){$required[48]='';    }elseif($required48==2){$required[48]='required';$_SESSION['form_require'].=','.$name48;}
			if($required49==1){$required[49]='';    }elseif($required49==2){$required[49]='required';$_SESSION['form_require'].=','.$name49;}
			if($required50==1){$required[50]='';    }elseif($required50==2){$required[50]='required';$_SESSION['form_require'].=','.$name50;}
			
			//FILTROS
			$filtro = array();
			$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1;	}
			$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2;	}
			$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3;	}
			$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4;	}
			$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5;	}
			$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6;	}
			$filtro[7] = '';  if ($filter7!='0') {$filtro[7] .=" AND ".$filter7;	}
			$filtro[8] = '';  if ($filter8!='0') {$filtro[8] .=" AND ".$filter8;	}
			$filtro[9] = '';  if ($filter9!='0') {$filtro[9] .=" AND ".$filter9;	}
			$filtro[10] = ''; if ($filter10!='0'){$filtro[10] .=" AND ".$filter10;	}
			$filtro[11] = ''; if ($filter11!='0'){$filtro[11] .=" AND ".$filter11;	}
			$filtro[12] = ''; if ($filter12!='0'){$filtro[12] .=" AND ".$filter12;	}
			$filtro[13] = ''; if ($filter13!='0'){$filtro[13] .=" AND ".$filter13;	}
			$filtro[14] = ''; if ($filter14!='0'){$filtro[14] .=" AND ".$filter14;	}
			$filtro[15] = ''; if ($filter15!='0'){$filtro[15] .=" AND ".$filter15;	}
			$filtro[16] = ''; if ($filter16!='0'){$filtro[16] .=" AND ".$filter16;	}
			$filtro[17] = ''; if ($filter17!='0'){$filtro[17] .=" AND ".$filter17;	}
			$filtro[18] = ''; if ($filter18!='0'){$filtro[18] .=" AND ".$filter18;	}
			$filtro[19] = ''; if ($filter19!='0'){$filtro[19] .=" AND ".$filter19;	}
			$filtro[20] = ''; if ($filter20!='0'){$filtro[20] .=" AND ".$filter20;	}
			$filtro[21] = ''; if ($filter21!='0'){$filtro[21] .=" AND ".$filter21;	}
			$filtro[22] = ''; if ($filter22!='0'){$filtro[22] .=" AND ".$filter22;	}
			$filtro[23] = ''; if ($filter23!='0'){$filtro[23] .=" AND ".$filter23;	}
			$filtro[24] = ''; if ($filter24!='0'){$filtro[24] .=" AND ".$filter24;	}
			$filtro[25] = ''; if ($filter25!='0'){$filtro[25] .=" AND ".$filter25;	}
			$filtro[26] = ''; if ($filter26!='0'){$filtro[26] .=" AND ".$filter26;	}
			$filtro[27] = ''; if ($filter27!='0'){$filtro[27] .=" AND ".$filter27;	}
			$filtro[28] = ''; if ($filter28!='0'){$filtro[28] .=" AND ".$filter28;	}
			$filtro[29] = ''; if ($filter29!='0'){$filtro[29] .=" AND ".$filter29;	}
			$filtro[30] = ''; if ($filter30!='0'){$filtro[30] .=" AND ".$filter30;	}
			$filtro[31] = ''; if ($filter31!='0'){$filtro[31] .=" AND ".$filter31;	}
			$filtro[32] = ''; if ($filter32!='0'){$filtro[32] .=" AND ".$filter32;	}
			$filtro[33] = ''; if ($filter33!='0'){$filtro[33] .=" AND ".$filter33;	}
			$filtro[34] = ''; if ($filter34!='0'){$filtro[34] .=" AND ".$filter34;	}
			$filtro[35] = ''; if ($filter35!='0'){$filtro[35] .=" AND ".$filter35;	}
			$filtro[36] = ''; if ($filter36!='0'){$filtro[36] .=" AND ".$filter36;	}
			$filtro[37] = ''; if ($filter37!='0'){$filtro[37] .=" AND ".$filter37;	}
			$filtro[38] = ''; if ($filter38!='0'){$filtro[38] .=" AND ".$filter38;	}
			$filtro[39] = ''; if ($filter39!='0'){$filtro[39] .=" AND ".$filter39;	}
			$filtro[40] = ''; if ($filter40!='0'){$filtro[40] .=" AND ".$filter40;	}
			$filtro[41] = ''; if ($filter41!='0'){$filtro[41] .=" AND ".$filter41;	}
			$filtro[42] = ''; if ($filter42!='0'){$filtro[42] .=" AND ".$filter42;	}
			$filtro[43] = ''; if ($filter43!='0'){$filtro[43] .=" AND ".$filter43;	}
			$filtro[44] = ''; if ($filter44!='0'){$filtro[44] .=" AND ".$filter44;	}
			$filtro[45] = ''; if ($filter45!='0'){$filtro[45] .=" AND ".$filter45;	}
			$filtro[46] = ''; if ($filter46!='0'){$filtro[46] .=" AND ".$filter46;	}
			$filtro[47] = ''; if ($filter47!='0'){$filtro[47] .=" AND ".$filter47;	}
			$filtro[48] = ''; if ($filter48!='0'){$filtro[48] .=" AND ".$filter48;	}
			$filtro[49] = ''; if ($filter49!='0'){$filtro[49] .=" AND ".$filter49;	}
			$filtro[50] = ''; if ($filter50!='0'){$filtro[50] .=" AND ".$filter50;	}
			
			//COMANDOS EXTRAS
			$excom = array();
			$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1;	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
			$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2;	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
			$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3;	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
			$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4;	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
			$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5;	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
			$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6;	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
			$excom[7] = '';  if ($extracomand7!='0') {$excom[7] .=" ".$extracomand7;	} else{$excom[7] .=" ORDER BY Nombre ASC ";}
			$excom[8] = '';  if ($extracomand8!='0') {$excom[8] .=" ".$extracomand8;	} else{$excom[8] .=" ORDER BY Nombre ASC ";}
			$excom[9] = '';  if ($extracomand9!='0') {$excom[9] .=" ".$extracomand9;	} else{$excom[9] .=" ORDER BY Nombre ASC ";}
			$excom[10] = ''; if ($extracomand10!='0'){$excom[10] .=" ".$extracomand10;	} else{$excom[10] .=" ORDER BY Nombre ASC ";}
			$excom[11] = ''; if ($extracomand11!='0'){$excom[11] .=" ".$extracomand11;	} else{$excom[11] .=" ORDER BY Nombre ASC ";}
			$excom[12] = ''; if ($extracomand12!='0'){$excom[12] .=" ".$extracomand12;	} else{$excom[12] .=" ORDER BY Nombre ASC ";}
			$excom[13] = ''; if ($extracomand13!='0'){$excom[13] .=" ".$extracomand13;	} else{$excom[13] .=" ORDER BY Nombre ASC ";}
			$excom[14] = ''; if ($extracomand14!='0'){$excom[14] .=" ".$extracomand14;	} else{$excom[14] .=" ORDER BY Nombre ASC ";}
			$excom[15] = ''; if ($extracomand15!='0'){$excom[15] .=" ".$extracomand15;	} else{$excom[15] .=" ORDER BY Nombre ASC ";}
			$excom[16] = ''; if ($extracomand16!='0'){$excom[16] .=" ".$extracomand16;	} else{$excom[16] .=" ORDER BY Nombre ASC ";}
			$excom[17] = ''; if ($extracomand17!='0'){$excom[17] .=" ".$extracomand17;	} else{$excom[17] .=" ORDER BY Nombre ASC ";}
			$excom[18] = ''; if ($extracomand18!='0'){$excom[18] .=" ".$extracomand18;	} else{$excom[18] .=" ORDER BY Nombre ASC ";}
			$excom[19] = ''; if ($extracomand19!='0'){$excom[19] .=" ".$extracomand19;	} else{$excom[19] .=" ORDER BY Nombre ASC ";}
			$excom[20] = ''; if ($extracomand20!='0'){$excom[20] .=" ".$extracomand20;	} else{$excom[20] .=" ORDER BY Nombre ASC ";}
			$excom[21] = ''; if ($extracomand21!='0'){$excom[21] .=" ".$extracomand21;	} else{$excom[21] .=" ORDER BY Nombre ASC ";}
			$excom[22] = ''; if ($extracomand22!='0'){$excom[22] .=" ".$extracomand22;	} else{$excom[22] .=" ORDER BY Nombre ASC ";}
			$excom[23] = ''; if ($extracomand23!='0'){$excom[23] .=" ".$extracomand23;	} else{$excom[23] .=" ORDER BY Nombre ASC ";}
			$excom[24] = ''; if ($extracomand24!='0'){$excom[24] .=" ".$extracomand24;	} else{$excom[24] .=" ORDER BY Nombre ASC ";}
			$excom[25] = ''; if ($extracomand25!='0'){$excom[25] .=" ".$extracomand25;	} else{$excom[25] .=" ORDER BY Nombre ASC ";}
			$excom[26] = ''; if ($extracomand26!='0'){$excom[26] .=" ".$extracomand26;	} else{$excom[26] .=" ORDER BY Nombre ASC ";}
			$excom[27] = ''; if ($extracomand27!='0'){$excom[27] .=" ".$extracomand27;	} else{$excom[27] .=" ORDER BY Nombre ASC ";}
			$excom[28] = ''; if ($extracomand28!='0'){$excom[28] .=" ".$extracomand28;	} else{$excom[28] .=" ORDER BY Nombre ASC ";}
			$excom[29] = ''; if ($extracomand29!='0'){$excom[29] .=" ".$extracomand29;	} else{$excom[29] .=" ORDER BY Nombre ASC ";}
			$excom[30] = ''; if ($extracomand30!='0'){$excom[30] .=" ".$extracomand30;	} else{$excom[30] .=" ORDER BY Nombre ASC ";}
			$excom[31] = ''; if ($extracomand31!='0'){$excom[31] .=" ".$extracomand31;	} else{$excom[31] .=" ORDER BY Nombre ASC ";}
			$excom[32] = ''; if ($extracomand32!='0'){$excom[32] .=" ".$extracomand32;	} else{$excom[32] .=" ORDER BY Nombre ASC ";}
			$excom[33] = ''; if ($extracomand33!='0'){$excom[33] .=" ".$extracomand33;	} else{$excom[33] .=" ORDER BY Nombre ASC ";}
			$excom[34] = ''; if ($extracomand34!='0'){$excom[34] .=" ".$extracomand34;	} else{$excom[34] .=" ORDER BY Nombre ASC ";}
			$excom[35] = ''; if ($extracomand35!='0'){$excom[35] .=" ".$extracomand35;	} else{$excom[35] .=" ORDER BY Nombre ASC ";}
			$excom[36] = ''; if ($extracomand36!='0'){$excom[36] .=" ".$extracomand36;	} else{$excom[36] .=" ORDER BY Nombre ASC ";}
			$excom[37] = ''; if ($extracomand37!='0'){$excom[37] .=" ".$extracomand37;	} else{$excom[37] .=" ORDER BY Nombre ASC ";}
			$excom[38] = ''; if ($extracomand38!='0'){$excom[38] .=" ".$extracomand38;	} else{$excom[38] .=" ORDER BY Nombre ASC ";}
			$excom[39] = ''; if ($extracomand39!='0'){$excom[39] .=" ".$extracomand39;	} else{$excom[39] .=" ORDER BY Nombre ASC ";}
			$excom[40] = ''; if ($extracomand40!='0'){$excom[40] .=" ".$extracomand40;	} else{$excom[40] .=" ORDER BY Nombre ASC ";} 
			$excom[41] = ''; if ($extracomand41!='0'){$excom[41] .=" ".$extracomand41;	} else{$excom[41] .=" ORDER BY Nombre ASC ";} 
			$excom[42] = ''; if ($extracomand42!='0'){$excom[42] .=" ".$extracomand42;	} else{$excom[42] .=" ORDER BY Nombre ASC ";} 
			$excom[43] = ''; if ($extracomand43!='0'){$excom[43] .=" ".$extracomand43;	} else{$excom[43] .=" ORDER BY Nombre ASC ";} 
			$excom[44] = ''; if ($extracomand44!='0'){$excom[44] .=" ".$extracomand44;	} else{$excom[44] .=" ORDER BY Nombre ASC ";} 
			$excom[45] = ''; if ($extracomand45!='0'){$excom[45] .=" ".$extracomand45;	} else{$excom[45] .=" ORDER BY Nombre ASC ";} 
			$excom[46] = ''; if ($extracomand46!='0'){$excom[46] .=" ".$extracomand46;	} else{$excom[46] .=" ORDER BY Nombre ASC ";} 
			$excom[47] = ''; if ($extracomand47!='0'){$excom[47] .=" ".$extracomand47;	} else{$excom[47] .=" ORDER BY Nombre ASC ";} 
			$excom[48] = ''; if ($extracomand48!='0'){$excom[48] .=" ".$extracomand48;	} else{$excom[48] .=" ORDER BY Nombre ASC ";} 
			$excom[49] = ''; if ($extracomand49!='0'){$excom[49] .=" ".$extracomand49;	} else{$excom[49] .=" ORDER BY Nombre ASC ";} 
			$excom[50] = ''; if ($extracomand50!='0'){$excom[50] .=" ".$extracomand50;	} else{$excom[50] .=" ORDER BY Nombre ASC ";}
			
			//visualizar listado
			$display = array();
			if ($value2!=0&&$value2!=''){$display[2]='';}else{$display[2]='style="display:none;"';}
			if ($value3!=0&&$value3!=''){$display[3]='';}else{$display[3]='style="display:none;"';}
			if ($value4!=0&&$value4!=''){$display[4]='';}else{$display[4]='style="display:none;"';}
			if ($value5!=0&&$value5!=''){$display[5]='';}else{$display[5]='style="display:none;"';}
			if ($value6!=0&&$value6!=''){$display[6]='';}else{$display[6]='style="display:none;"';}
			if ($value7!=0&&$value7!=''){$display[7]='';}else{$display[7]='style="display:none;"';}
			if ($value8!=0&&$value8!=''){$display[8]='';}else{$display[8]='style="display:none;"';}
			if ($value9!=0&&$value9!=''){$display[9]='';}else{$display[9]='style="display:none;"';}
			if ($value10!=0&&$value10!=''){$display[10]='';}else{$display[10]='style="display:none;"';}
			if ($value11!=0&&$value11!=''){$display[11]='';}else{$display[11]='style="display:none;"';}
			if ($value12!=0&&$value12!=''){$display[12]='';}else{$display[12]='style="display:none;"';}
			if ($value13!=0&&$value13!=''){$display[13]='';}else{$display[13]='style="display:none;"';}
			if ($value14!=0&&$value14!=''){$display[14]='';}else{$display[14]='style="display:none;"';}
			if ($value15!=0&&$value15!=''){$display[15]='';}else{$display[15]='style="display:none;"';}
			if ($value16!=0&&$value16!=''){$display[16]='';}else{$display[16]='style="display:none;"';}
			if ($value17!=0&&$value17!=''){$display[17]='';}else{$display[17]='style="display:none;"';}
			if ($value18!=0&&$value18!=''){$display[18]='';}else{$display[18]='style="display:none;"';}
			if ($value19!=0&&$value19!=''){$display[19]='';}else{$display[19]='style="display:none;"';}
			if ($value20!=0&&$value20!=''){$display[20]='';}else{$display[20]='style="display:none;"';}
			if ($value21!=0&&$value21!=''){$display[21]='';}else{$display[21]='style="display:none;"';}
			if ($value22!=0&&$value22!=''){$display[22]='';}else{$display[22]='style="display:none;"';}
			if ($value23!=0&&$value23!=''){$display[23]='';}else{$display[23]='style="display:none;"';}
			if ($value24!=0&&$value24!=''){$display[24]='';}else{$display[24]='style="display:none;"';}
			if ($value25!=0&&$value25!=''){$display[25]='';}else{$display[25]='style="display:none;"';}
			if ($value26!=0&&$value26!=''){$display[26]='';}else{$display[26]='style="display:none;"';}
			if ($value27!=0&&$value27!=''){$display[27]='';}else{$display[27]='style="display:none;"';}
			if ($value28!=0&&$value28!=''){$display[28]='';}else{$display[28]='style="display:none;"';}
			if ($value29!=0&&$value29!=''){$display[29]='';}else{$display[29]='style="display:none;"';}
			if ($value30!=0&&$value30!=''){$display[30]='';}else{$display[30]='style="display:none;"';}
			if ($value31!=0&&$value31!=''){$display[31]='';}else{$display[31]='style="display:none;"';}
			if ($value32!=0&&$value32!=''){$display[32]='';}else{$display[32]='style="display:none;"';}
			if ($value33!=0&&$value33!=''){$display[33]='';}else{$display[33]='style="display:none;"';}
			if ($value34!=0&&$value34!=''){$display[34]='';}else{$display[34]='style="display:none;"';}
			if ($value35!=0&&$value35!=''){$display[35]='';}else{$display[35]='style="display:none;"';}
			if ($value36!=0&&$value36!=''){$display[36]='';}else{$display[36]='style="display:none;"';}
			if ($value37!=0&&$value37!=''){$display[37]='';}else{$display[37]='style="display:none;"';}
			if ($value38!=0&&$value38!=''){$display[38]='';}else{$display[38]='style="display:none;"';}
			if ($value39!=0&&$value39!=''){$display[39]='';}else{$display[39]='style="display:none;"';}
			if ($value40!=0&&$value40!=''){$display[40]='';}else{$display[40]='style="display:none;"';}
			if ($value41!=0&&$value41!=''){$display[41]='';}else{$display[41]='style="display:none;"';}
			if ($value42!=0&&$value42!=''){$display[42]='';}else{$display[42]='style="display:none;"';}
			if ($value43!=0&&$value43!=''){$display[43]='';}else{$display[43]='style="display:none;"';}
			if ($value44!=0&&$value44!=''){$display[44]='';}else{$display[44]='style="display:none;"';}
			if ($value45!=0&&$value45!=''){$display[45]='';}else{$display[45]='style="display:none;"';}
			if ($value46!=0&&$value46!=''){$display[46]='';}else{$display[46]='style="display:none;"';}
			if ($value47!=0&&$value47!=''){$display[47]='';}else{$display[47]='style="display:none;"';}
			if ($value48!=0&&$value48!=''){$display[48]='';}else{$display[48]='style="display:none;"';}
			if ($value49!=0&&$value49!=''){$display[49]='';}else{$display[49]='style="display:none;"';}
			if ($value50!=0&&$value50!=''){$display[50]='';}else{$display[50]='style="display:none;"';}
			
			//Se guardan los valores
			$value = array();
			if ($value1!=0&&$value1!=''){$value[1]=$value1;}else{$value[1]='';}
			if ($value2!=0&&$value2!=''){$value[2]=$value2;}else{$value[2]='';}
			if ($value3!=0&&$value3!=''){$value[3]=$value3;}else{$value[3]='';}
			if ($value4!=0&&$value4!=''){$value[4]=$value4;}else{$value[4]='';}
			if ($value5!=0&&$value5!=''){$value[5]=$value5;}else{$value[5]='';}
			if ($value6!=0&&$value6!=''){$value[6]=$value6;}else{$value[6]='';}
			if ($value7!=0&&$value7!=''){$value[7]=$value7;}else{$value[7]='';}
			if ($value8!=0&&$value8!=''){$value[8]=$value8;}else{$value[8]='';}
			if ($value9!=0&&$value9!=''){$value[9]=$value9;}else{$value[9]='';}
			if ($value10!=0&&$value10!=''){$value[10]=$value10;}else{$value[10]='';}
			if ($value11!=0&&$value11!=''){$value[11]=$value11;}else{$value[11]='';}
			if ($value12!=0&&$value12!=''){$value[12]=$value12;}else{$value[12]='';}
			if ($value13!=0&&$value13!=''){$value[13]=$value13;}else{$value[13]='';}
			if ($value14!=0&&$value14!=''){$value[14]=$value14;}else{$value[14]='';}
			if ($value15!=0&&$value15!=''){$value[15]=$value15;}else{$value[15]='';}
			if ($value16!=0&&$value16!=''){$value[16]=$value16;}else{$value[16]='';}
			if ($value17!=0&&$value17!=''){$value[17]=$value17;}else{$value[17]='';}
			if ($value18!=0&&$value18!=''){$value[18]=$value18;}else{$value[18]='';}
			if ($value19!=0&&$value19!=''){$value[19]=$value19;}else{$value[19]='';}
			if ($value20!=0&&$value20!=''){$value[20]=$value20;}else{$value[20]='';}
			if ($value21!=0&&$value21!=''){$value[21]=$value21;}else{$value[21]='';}
			if ($value22!=0&&$value22!=''){$value[22]=$value22;}else{$value[22]='';}
			if ($value23!=0&&$value23!=''){$value[23]=$value23;}else{$value[23]='';}
			if ($value24!=0&&$value24!=''){$value[24]=$value24;}else{$value[24]='';}
			if ($value25!=0&&$value25!=''){$value[25]=$value25;}else{$value[25]='';}
			if ($value26!=0&&$value26!=''){$value[26]=$value26;}else{$value[26]='';}
			if ($value27!=0&&$value27!=''){$value[27]=$value27;}else{$value[27]='';}
			if ($value28!=0&&$value28!=''){$value[28]=$value28;}else{$value[28]='';}
			if ($value29!=0&&$value29!=''){$value[29]=$value29;}else{$value[29]='';}
			if ($value30!=0&&$value30!=''){$value[30]=$value30;}else{$value[30]='';}
			if ($value31!=0&&$value31!=''){$value[31]=$value31;}else{$value[31]='';}
			if ($value32!=0&&$value32!=''){$value[32]=$value32;}else{$value[32]='';}
			if ($value33!=0&&$value33!=''){$value[33]=$value33;}else{$value[33]='';}
			if ($value34!=0&&$value34!=''){$value[34]=$value34;}else{$value[34]='';}
			if ($value35!=0&&$value35!=''){$value[35]=$value35;}else{$value[35]='';}
			if ($value36!=0&&$value36!=''){$value[36]=$value36;}else{$value[36]='';}
			if ($value37!=0&&$value37!=''){$value[37]=$value37;}else{$value[37]='';}
			if ($value38!=0&&$value38!=''){$value[38]=$value38;}else{$value[38]='';}
			if ($value39!=0&&$value39!=''){$value[39]=$value39;}else{$value[39]='';}
			if ($value40!=0&&$value40!=''){$value[40]=$value40;}else{$value[40]='';}
			if ($value41!=0&&$value41!=''){$value[41]=$value41;}else{$value[41]='';}
			if ($value42!=0&&$value42!=''){$value[42]=$value42;}else{$value[42]='';}
			if ($value43!=0&&$value43!=''){$value[43]=$value43;}else{$value[43]='';}
			if ($value44!=0&&$value44!=''){$value[44]=$value44;}else{$value[44]='';}
			if ($value45!=0&&$value45!=''){$value[45]=$value45;}else{$value[45]='';}
			if ($value46!=0&&$value46!=''){$value[46]=$value46;}else{$value[46]='';}
			if ($value47!=0&&$value47!=''){$value[47]=$value47;}else{$value[47]='';}
			if ($value48!=0&&$value48!=''){$value[48]=$value48;}else{$value[48]='';}
			if ($value49!=0&&$value49!=''){$value[49]=$value49;}else{$value[49]='';}
			if ($value50!=0&&$value50!=''){$value[50]=$value50;}else{$value[50]='';}
			
			//Se guardan los nombres
			$name = array();
			if (isset($name1)&&$name1!=''){$name[1]=$name1;}else{$name[1]='';}
			if (isset($name2)&&$name2!=''){$name[2]=$name2;}else{$name[2]='';}
			if (isset($name3)&&$name3!=''){$name[3]=$name3;}else{$name[3]='';}
			if (isset($name4)&&$name4!=''){$name[4]=$name4;}else{$name[4]='';}
			if (isset($name5)&&$name5!=''){$name[5]=$name5;}else{$name[5]='';}
			if (isset($name6)&&$name6!=''){$name[6]=$name6;}else{$name[6]='';}
			if (isset($name7)&&$name7!=''){$name[7]=$name7;}else{$name[7]='';}
			if (isset($name8)&&$name8!=''){$name[8]=$name8;}else{$name[8]='';}
			if (isset($name9)&&$name9!=''){$name[9]=$name9;}else{$name[9]='';}
			if (isset($name10)&&$name10!=''){$name[10]=$name10;}else{$name[10]='';}
			if (isset($name11)&&$name11!=''){$name[11]=$name11;}else{$name[11]='';}
			if (isset($name12)&&$name12!=''){$name[12]=$name12;}else{$name[12]='';}
			if (isset($name13)&&$name13!=''){$name[13]=$name13;}else{$name[13]='';}
			if (isset($name14)&&$name14!=''){$name[14]=$name14;}else{$name[14]='';}
			if (isset($name15)&&$name15!=''){$name[15]=$name15;}else{$name[15]='';}
			if (isset($name16)&&$name16!=''){$name[16]=$name16;}else{$name[16]='';}
			if (isset($name17)&&$name17!=''){$name[17]=$name17;}else{$name[17]='';}
			if (isset($name18)&&$name18!=''){$name[18]=$name18;}else{$name[18]='';}
			if (isset($name19)&&$name19!=''){$name[19]=$name19;}else{$name[19]='';}
			if (isset($name20)&&$name20!=''){$name[20]=$name20;}else{$name[20]='';}
			if (isset($name21)&&$name21!=''){$name[21]=$name21;}else{$name[21]='';}
			if (isset($name22)&&$name22!=''){$name[22]=$name22;}else{$name[22]='';}
			if (isset($name23)&&$name23!=''){$name[23]=$name23;}else{$name[23]='';}
			if (isset($name24)&&$name24!=''){$name[24]=$name24;}else{$name[24]='';}
			if (isset($name25)&&$name25!=''){$name[25]=$name25;}else{$name[25]='';}
			if (isset($name26)&&$name26!=''){$name[26]=$name26;}else{$name[26]='';}
			if (isset($name27)&&$name27!=''){$name[27]=$name27;}else{$name[27]='';}
			if (isset($name28)&&$name28!=''){$name[28]=$name28;}else{$name[28]='';}
			if (isset($name29)&&$name29!=''){$name[29]=$name29;}else{$name[29]='';}
			if (isset($name30)&&$name30!=''){$name[30]=$name30;}else{$name[30]='';}
			if (isset($name31)&&$name31!=''){$name[31]=$name31;}else{$name[31]='';}
			if (isset($name32)&&$name32!=''){$name[32]=$name32;}else{$name[32]='';}
			if (isset($name33)&&$name33!=''){$name[33]=$name33;}else{$name[33]='';}
			if (isset($name34)&&$name34!=''){$name[34]=$name34;}else{$name[34]='';}
			if (isset($name35)&&$name35!=''){$name[35]=$name35;}else{$name[35]='';}
			if (isset($name36)&&$name36!=''){$name[36]=$name36;}else{$name[36]='';}
			if (isset($name37)&&$name37!=''){$name[37]=$name37;}else{$name[37]='';}
			if (isset($name38)&&$name38!=''){$name[38]=$name38;}else{$name[38]='';}
			if (isset($name39)&&$name39!=''){$name[39]=$name39;}else{$name[39]='';}
			if (isset($name40)&&$name40!=''){$name[40]=$name40;}else{$name[40]='';}
			if (isset($name41)&&$name41!=''){$name[41]=$name41;}else{$name[41]='';}
			if (isset($name42)&&$name42!=''){$name[42]=$name42;}else{$name[42]='';}
			if (isset($name43)&&$name43!=''){$name[43]=$name43;}else{$name[43]='';}
			if (isset($name44)&&$name44!=''){$name[44]=$name44;}else{$name[44]='';}
			if (isset($name45)&&$name45!=''){$name[45]=$name45;}else{$name[45]='';}
			if (isset($name46)&&$name46!=''){$name[46]=$name46;}else{$name[46]='';}
			if (isset($name47)&&$name47!=''){$name[47]=$name47;}else{$name[47]='';}
			if (isset($name48)&&$name48!=''){$name[48]=$name48;}else{$name[48]='';}
			if (isset($name49)&&$name49!=''){$name[49]=$name49;}else{$name[49]='';}
			if (isset($name50)&&$name50!=''){$name[50]=$name50;}else{$name[50]='';}
			
			//Se guardan los nombres
			$dataA = array();
			if (isset($dataA1)&&$dataA1!=''){$dataA[1]=$dataA1;}else{$dataA[1]='';}
			if (isset($dataA2)&&$dataA2!=''){$dataA[2]=$dataA2;}else{$dataA[2]='';}
			if (isset($dataA3)&&$dataA3!=''){$dataA[3]=$dataA3;}else{$dataA[3]='';}
			if (isset($dataA4)&&$dataA4!=''){$dataA[4]=$dataA4;}else{$dataA[4]='';}
			if (isset($dataA5)&&$dataA5!=''){$dataA[5]=$dataA5;}else{$dataA[5]='';}
			if (isset($dataA6)&&$dataA6!=''){$dataA[6]=$dataA6;}else{$dataA[6]='';}
			if (isset($dataA7)&&$dataA7!=''){$dataA[7]=$dataA7;}else{$dataA[7]='';}
			if (isset($dataA8)&&$dataA8!=''){$dataA[8]=$dataA8;}else{$dataA[8]='';}
			if (isset($dataA9)&&$dataA9!=''){$dataA[9]=$dataA9;}else{$dataA[9]='';}
			if (isset($dataA10)&&$dataA10!=''){$dataA[10]=$dataA10;}else{$dataA[10]='';}
			if (isset($dataA11)&&$dataA11!=''){$dataA[11]=$dataA11;}else{$dataA[11]='';}
			if (isset($dataA12)&&$dataA12!=''){$dataA[12]=$dataA12;}else{$dataA[12]='';}
			if (isset($dataA13)&&$dataA13!=''){$dataA[13]=$dataA13;}else{$dataA[13]='';}
			if (isset($dataA14)&&$dataA14!=''){$dataA[14]=$dataA14;}else{$dataA[14]='';}
			if (isset($dataA15)&&$dataA15!=''){$dataA[15]=$dataA15;}else{$dataA[15]='';}
			if (isset($dataA16)&&$dataA16!=''){$dataA[16]=$dataA16;}else{$dataA[16]='';}
			if (isset($dataA17)&&$dataA17!=''){$dataA[17]=$dataA17;}else{$dataA[17]='';}
			if (isset($dataA18)&&$dataA18!=''){$dataA[18]=$dataA18;}else{$dataA[18]='';}
			if (isset($dataA19)&&$dataA19!=''){$dataA[19]=$dataA19;}else{$dataA[19]='';}
			if (isset($dataA20)&&$dataA20!=''){$dataA[20]=$dataA20;}else{$dataA[20]='';}
			if (isset($dataA21)&&$dataA21!=''){$dataA[21]=$dataA21;}else{$dataA[21]='';}
			if (isset($dataA22)&&$dataA22!=''){$dataA[22]=$dataA22;}else{$dataA[22]='';}
			if (isset($dataA23)&&$dataA23!=''){$dataA[23]=$dataA23;}else{$dataA[23]='';}
			if (isset($dataA24)&&$dataA24!=''){$dataA[24]=$dataA24;}else{$dataA[24]='';}
			if (isset($dataA25)&&$dataA25!=''){$dataA[25]=$dataA25;}else{$dataA[25]='';}
			if (isset($dataA26)&&$dataA26!=''){$dataA[26]=$dataA26;}else{$dataA[26]='';}
			if (isset($dataA27)&&$dataA27!=''){$dataA[27]=$dataA27;}else{$dataA[27]='';}
			if (isset($dataA28)&&$dataA28!=''){$dataA[28]=$dataA28;}else{$dataA[28]='';}
			if (isset($dataA29)&&$dataA29!=''){$dataA[29]=$dataA29;}else{$dataA[29]='';}
			if (isset($dataA30)&&$dataA30!=''){$dataA[30]=$dataA30;}else{$dataA[30]='';}
			if (isset($dataA31)&&$dataA31!=''){$dataA[31]=$dataA31;}else{$dataA[31]='';}
			if (isset($dataA32)&&$dataA32!=''){$dataA[32]=$dataA32;}else{$dataA[32]='';}
			if (isset($dataA33)&&$dataA33!=''){$dataA[33]=$dataA33;}else{$dataA[33]='';}
			if (isset($dataA34)&&$dataA34!=''){$dataA[34]=$dataA34;}else{$dataA[34]='';}
			if (isset($dataA35)&&$dataA35!=''){$dataA[35]=$dataA35;}else{$dataA[35]='';}
			if (isset($dataA36)&&$dataA36!=''){$dataA[36]=$dataA36;}else{$dataA[36]='';}
			if (isset($dataA37)&&$dataA37!=''){$dataA[37]=$dataA37;}else{$dataA[37]='';}
			if (isset($dataA38)&&$dataA38!=''){$dataA[38]=$dataA38;}else{$dataA[38]='';}
			if (isset($dataA39)&&$dataA39!=''){$dataA[39]=$dataA39;}else{$dataA[39]='';}
			if (isset($dataA40)&&$dataA40!=''){$dataA[40]=$dataA40;}else{$dataA[40]='';}
			if (isset($dataA41)&&$dataA41!=''){$dataA[41]=$dataA41;}else{$dataA[41]='';}
			if (isset($dataA42)&&$dataA42!=''){$dataA[42]=$dataA42;}else{$dataA[42]='';}
			if (isset($dataA43)&&$dataA43!=''){$dataA[43]=$dataA43;}else{$dataA[43]='';}
			if (isset($dataA44)&&$dataA44!=''){$dataA[44]=$dataA44;}else{$dataA[44]='';}
			if (isset($dataA45)&&$dataA45!=''){$dataA[45]=$dataA45;}else{$dataA[45]='';}
			if (isset($dataA46)&&$dataA46!=''){$dataA[46]=$dataA46;}else{$dataA[46]='';}
			if (isset($dataA47)&&$dataA47!=''){$dataA[47]=$dataA47;}else{$dataA[47]='';}
			if (isset($dataA48)&&$dataA48!=''){$dataA[48]=$dataA48;}else{$dataA[48]='';}
			if (isset($dataA49)&&$dataA49!=''){$dataA[49]=$dataA49;}else{$dataA[49]='';}
			if (isset($dataA50)&&$dataA50!=''){$dataA[50]=$dataA50;}else{$dataA[50]='';}
			
			//Se guardan los nombres
			$dataB = array();
			if (isset($dataB1)&&$dataB1!=''){$dataB[1]=$dataB1;}else{$dataB[1]='';}
			if (isset($dataB2)&&$dataB2!=''){$dataB[2]=$dataB2;}else{$dataB[2]='';}
			if (isset($dataB3)&&$dataB3!=''){$dataB[3]=$dataB3;}else{$dataB[3]='';}
			if (isset($dataB4)&&$dataB4!=''){$dataB[4]=$dataB4;}else{$dataB[4]='';}
			if (isset($dataB5)&&$dataB5!=''){$dataB[5]=$dataB5;}else{$dataB[5]='';}
			if (isset($dataB6)&&$dataB6!=''){$dataB[6]=$dataB6;}else{$dataB[6]='';}
			if (isset($dataB7)&&$dataB7!=''){$dataB[7]=$dataB7;}else{$dataB[7]='';}
			if (isset($dataB8)&&$dataB8!=''){$dataB[8]=$dataB8;}else{$dataB[8]='';}
			if (isset($dataB9)&&$dataB9!=''){$dataB[9]=$dataB9;}else{$dataB[9]='';}
			if (isset($dataB10)&&$dataB10!=''){$dataB[10]=$dataB10;}else{$dataB[10]='';}
			if (isset($dataB11)&&$dataB11!=''){$dataB[11]=$dataB11;}else{$dataB[11]='';}
			if (isset($dataB12)&&$dataB12!=''){$dataB[12]=$dataB12;}else{$dataB[12]='';}
			if (isset($dataB13)&&$dataB13!=''){$dataB[13]=$dataB13;}else{$dataB[13]='';}
			if (isset($dataB14)&&$dataB14!=''){$dataB[14]=$dataB14;}else{$dataB[14]='';}
			if (isset($dataB15)&&$dataB15!=''){$dataB[15]=$dataB15;}else{$dataB[15]='';}
			if (isset($dataB16)&&$dataB16!=''){$dataB[16]=$dataB16;}else{$dataB[16]='';}
			if (isset($dataB17)&&$dataB17!=''){$dataB[17]=$dataB17;}else{$dataB[17]='';}
			if (isset($dataB18)&&$dataB18!=''){$dataB[18]=$dataB18;}else{$dataB[18]='';}
			if (isset($dataB19)&&$dataB19!=''){$dataB[19]=$dataB19;}else{$dataB[19]='';}
			if (isset($dataB20)&&$dataB20!=''){$dataB[20]=$dataB20;}else{$dataB[20]='';}
			if (isset($dataB21)&&$dataB21!=''){$dataB[21]=$dataB21;}else{$dataB[21]='';}
			if (isset($dataB22)&&$dataB22!=''){$dataB[22]=$dataB22;}else{$dataB[22]='';}
			if (isset($dataB23)&&$dataB23!=''){$dataB[23]=$dataB23;}else{$dataB[23]='';}
			if (isset($dataB24)&&$dataB24!=''){$dataB[24]=$dataB24;}else{$dataB[24]='';}
			if (isset($dataB25)&&$dataB25!=''){$dataB[25]=$dataB25;}else{$dataB[25]='';}
			if (isset($dataB26)&&$dataB26!=''){$dataB[26]=$dataB26;}else{$dataB[26]='';}
			if (isset($dataB27)&&$dataB27!=''){$dataB[27]=$dataB27;}else{$dataB[27]='';}
			if (isset($dataB28)&&$dataB28!=''){$dataB[28]=$dataB28;}else{$dataB[28]='';}
			if (isset($dataB29)&&$dataB29!=''){$dataB[29]=$dataB29;}else{$dataB[29]='';}
			if (isset($dataB30)&&$dataB30!=''){$dataB[30]=$dataB30;}else{$dataB[30]='';}
			if (isset($dataB31)&&$dataB31!=''){$dataB[31]=$dataB31;}else{$dataB[31]='';}
			if (isset($dataB32)&&$dataB32!=''){$dataB[32]=$dataB32;}else{$dataB[32]='';}
			if (isset($dataB33)&&$dataB33!=''){$dataB[33]=$dataB33;}else{$dataB[33]='';}
			if (isset($dataB34)&&$dataB34!=''){$dataB[34]=$dataB34;}else{$dataB[34]='';}
			if (isset($dataB35)&&$dataB35!=''){$dataB[35]=$dataB35;}else{$dataB[35]='';}
			if (isset($dataB36)&&$dataB36!=''){$dataB[36]=$dataB36;}else{$dataB[36]='';}
			if (isset($dataB37)&&$dataB37!=''){$dataB[37]=$dataB37;}else{$dataB[37]='';}
			if (isset($dataB38)&&$dataB38!=''){$dataB[38]=$dataB38;}else{$dataB[38]='';}
			if (isset($dataB39)&&$dataB39!=''){$dataB[39]=$dataB39;}else{$dataB[39]='';}
			if (isset($dataB40)&&$dataB40!=''){$dataB[40]=$dataB40;}else{$dataB[40]='';}
			if (isset($dataB41)&&$dataB41!=''){$dataB[41]=$dataB41;}else{$dataB[41]='';}
			if (isset($dataB42)&&$dataB42!=''){$dataB[42]=$dataB42;}else{$dataB[42]='';}
			if (isset($dataB43)&&$dataB43!=''){$dataB[43]=$dataB43;}else{$dataB[43]='';}
			if (isset($dataB44)&&$dataB44!=''){$dataB[44]=$dataB44;}else{$dataB[44]='';}
			if (isset($dataB45)&&$dataB45!=''){$dataB[45]=$dataB45;}else{$dataB[45]='';}
			if (isset($dataB46)&&$dataB46!=''){$dataB[46]=$dataB46;}else{$dataB[46]='';}
			if (isset($dataB47)&&$dataB47!=''){$dataB[47]=$dataB47;}else{$dataB[47]='';}
			if (isset($dataB48)&&$dataB48!=''){$dataB[48]=$dataB48;}else{$dataB[48]='';}
			if (isset($dataB49)&&$dataB49!=''){$dataB[49]=$dataB49;}else{$dataB[49]='';}
			if (isset($dataB50)&&$dataB50!=''){$dataB[50]=$dataB50;}else{$dataB[50]='';}
			
			//Se guardan los nombres
			$table = array();
			if (isset($table1)&&$table1!=''){$table[1]=$table1;}else{$table[1]='';}
			if (isset($table2)&&$table2!=''){$table[2]=$table2;}else{$table[2]='';}
			if (isset($table3)&&$table3!=''){$table[3]=$table3;}else{$table[3]='';}
			if (isset($table4)&&$table4!=''){$table[4]=$table4;}else{$table[4]='';}
			if (isset($table5)&&$table5!=''){$table[5]=$table5;}else{$table[5]='';}
			if (isset($table6)&&$table6!=''){$table[6]=$table6;}else{$table[6]='';}
			if (isset($table7)&&$table7!=''){$table[7]=$table7;}else{$table[7]='';}
			if (isset($table8)&&$table8!=''){$table[8]=$table8;}else{$table[8]='';}
			if (isset($table9)&&$table9!=''){$table[9]=$table9;}else{$table[9]='';}
			if (isset($table10)&&$table10!=''){$table[10]=$table10;}else{$table[10]='';}
			if (isset($table11)&&$table11!=''){$table[11]=$table11;}else{$table[11]='';}
			if (isset($table12)&&$table12!=''){$table[12]=$table12;}else{$table[12]='';}
			if (isset($table13)&&$table13!=''){$table[13]=$table13;}else{$table[13]='';}
			if (isset($table14)&&$table14!=''){$table[14]=$table14;}else{$table[14]='';}
			if (isset($table15)&&$table15!=''){$table[15]=$table15;}else{$table[15]='';}
			if (isset($table16)&&$table16!=''){$table[16]=$table16;}else{$table[16]='';}
			if (isset($table17)&&$table17!=''){$table[17]=$table17;}else{$table[17]='';}
			if (isset($table18)&&$table18!=''){$table[18]=$table18;}else{$table[18]='';}
			if (isset($table19)&&$table19!=''){$table[19]=$table19;}else{$table[19]='';}
			if (isset($table20)&&$table20!=''){$table[20]=$table20;}else{$table[20]='';}
			if (isset($table21)&&$table21!=''){$table[21]=$table21;}else{$table[21]='';}
			if (isset($table22)&&$table22!=''){$table[22]=$table22;}else{$table[22]='';}
			if (isset($table23)&&$table23!=''){$table[23]=$table23;}else{$table[23]='';}
			if (isset($table24)&&$table24!=''){$table[24]=$table24;}else{$table[24]='';}
			if (isset($table25)&&$table25!=''){$table[25]=$table25;}else{$table[25]='';}
			if (isset($table26)&&$table26!=''){$table[26]=$table26;}else{$table[26]='';}
			if (isset($table27)&&$table27!=''){$table[27]=$table27;}else{$table[27]='';}
			if (isset($table28)&&$table28!=''){$table[28]=$table28;}else{$table[28]='';}
			if (isset($table29)&&$table29!=''){$table[29]=$table29;}else{$table[29]='';}
			if (isset($table30)&&$table30!=''){$table[30]=$table30;}else{$table[30]='';}
			if (isset($table31)&&$table31!=''){$table[31]=$table31;}else{$table[31]='';}
			if (isset($table32)&&$table32!=''){$table[32]=$table32;}else{$table[32]='';}
			if (isset($table33)&&$table33!=''){$table[33]=$table33;}else{$table[33]='';}
			if (isset($table34)&&$table34!=''){$table[34]=$table34;}else{$table[34]='';}
			if (isset($table35)&&$table35!=''){$table[35]=$table35;}else{$table[35]='';}
			if (isset($table36)&&$table36!=''){$table[36]=$table36;}else{$table[36]='';}
			if (isset($table37)&&$table37!=''){$table[37]=$table37;}else{$table[37]='';}
			if (isset($table38)&&$table38!=''){$table[38]=$table38;}else{$table[38]='';}
			if (isset($table39)&&$table39!=''){$table[39]=$table39;}else{$table[39]='';}
			if (isset($table40)&&$table40!=''){$table[40]=$table40;}else{$table[40]='';}
			if (isset($table41)&&$table41!=''){$table[41]=$table41;}else{$table[41]='';}
			if (isset($table42)&&$table42!=''){$table[42]=$table42;}else{$table[42]='';}
			if (isset($table43)&&$table43!=''){$table[43]=$table43;}else{$table[43]='';}
			if (isset($table44)&&$table44!=''){$table[44]=$table44;}else{$table[44]='';}
			if (isset($table45)&&$table45!=''){$table[45]=$table45;}else{$table[45]='';}
			if (isset($table46)&&$table46!=''){$table[46]=$table46;}else{$table[46]='';}
			if (isset($table47)&&$table47!=''){$table[47]=$table47;}else{$table[47]='';}
			if (isset($table48)&&$table48!=''){$table[48]=$table48;}else{$table[48]='';}
			if (isset($table49)&&$table49!=''){$table[49]=$table49;}else{$table[49]='';}
			if (isset($table50)&&$table50!=''){$table[50]=$table50;}else{$table[50]='';}
			
			//Se guardan los nombres
			$placeholder = array();
			if (isset($placeholder1)&&$placeholder1!=''){$placeholder[1]=$placeholder1;}else{$placeholder[1]='';}
			if (isset($placeholder2)&&$placeholder2!=''){$placeholder[2]=$placeholder2;}else{$placeholder[2]='';}
			if (isset($placeholder3)&&$placeholder3!=''){$placeholder[3]=$placeholder3;}else{$placeholder[3]='';}
			if (isset($placeholder4)&&$placeholder4!=''){$placeholder[4]=$placeholder4;}else{$placeholder[4]='';}
			if (isset($placeholder5)&&$placeholder5!=''){$placeholder[5]=$placeholder5;}else{$placeholder[5]='';}
			if (isset($placeholder6)&&$placeholder6!=''){$placeholder[6]=$placeholder6;}else{$placeholder[6]='';}
			if (isset($placeholder7)&&$placeholder7!=''){$placeholder[7]=$placeholder7;}else{$placeholder[7]='';}
			if (isset($placeholder8)&&$placeholder8!=''){$placeholder[8]=$placeholder8;}else{$placeholder[8]='';}
			if (isset($placeholder9)&&$placeholder9!=''){$placeholder[9]=$placeholder9;}else{$placeholder[9]='';}
			if (isset($placeholder10)&&$placeholder10!=''){$placeholder[10]=$placeholder10;}else{$placeholder[10]='';}
			if (isset($placeholder11)&&$placeholder11!=''){$placeholder[11]=$placeholder11;}else{$placeholder[11]='';}
			if (isset($placeholder12)&&$placeholder12!=''){$placeholder[12]=$placeholder12;}else{$placeholder[12]='';}
			if (isset($placeholder13)&&$placeholder13!=''){$placeholder[13]=$placeholder13;}else{$placeholder[13]='';}
			if (isset($placeholder14)&&$placeholder14!=''){$placeholder[14]=$placeholder14;}else{$placeholder[14]='';}
			if (isset($placeholder15)&&$placeholder15!=''){$placeholder[15]=$placeholder15;}else{$placeholder[15]='';}
			if (isset($placeholder16)&&$placeholder16!=''){$placeholder[16]=$placeholder16;}else{$placeholder[16]='';}
			if (isset($placeholder17)&&$placeholder17!=''){$placeholder[17]=$placeholder17;}else{$placeholder[17]='';}
			if (isset($placeholder18)&&$placeholder18!=''){$placeholder[18]=$placeholder18;}else{$placeholder[18]='';}
			if (isset($placeholder19)&&$placeholder19!=''){$placeholder[19]=$placeholder19;}else{$placeholder[19]='';}
			if (isset($placeholder20)&&$placeholder20!=''){$placeholder[20]=$placeholder20;}else{$placeholder[20]='';}
			if (isset($placeholder21)&&$placeholder21!=''){$placeholder[21]=$placeholder21;}else{$placeholder[21]='';}
			if (isset($placeholder22)&&$placeholder22!=''){$placeholder[22]=$placeholder22;}else{$placeholder[22]='';}
			if (isset($placeholder23)&&$placeholder23!=''){$placeholder[23]=$placeholder23;}else{$placeholder[23]='';}
			if (isset($placeholder24)&&$placeholder24!=''){$placeholder[24]=$placeholder24;}else{$placeholder[24]='';}
			if (isset($placeholder25)&&$placeholder25!=''){$placeholder[25]=$placeholder25;}else{$placeholder[25]='';}
			if (isset($placeholder26)&&$placeholder26!=''){$placeholder[26]=$placeholder26;}else{$placeholder[26]='';}
			if (isset($placeholder27)&&$placeholder27!=''){$placeholder[27]=$placeholder27;}else{$placeholder[27]='';}
			if (isset($placeholder28)&&$placeholder28!=''){$placeholder[28]=$placeholder28;}else{$placeholder[28]='';}
			if (isset($placeholder29)&&$placeholder29!=''){$placeholder[29]=$placeholder29;}else{$placeholder[29]='';}
			if (isset($placeholder30)&&$placeholder30!=''){$placeholder[30]=$placeholder30;}else{$placeholder[30]='';}
			if (isset($placeholder31)&&$placeholder31!=''){$placeholder[31]=$placeholder31;}else{$placeholder[31]='';}
			if (isset($placeholder32)&&$placeholder32!=''){$placeholder[32]=$placeholder32;}else{$placeholder[32]='';}
			if (isset($placeholder33)&&$placeholder33!=''){$placeholder[33]=$placeholder33;}else{$placeholder[33]='';}
			if (isset($placeholder34)&&$placeholder34!=''){$placeholder[34]=$placeholder34;}else{$placeholder[34]='';}
			if (isset($placeholder35)&&$placeholder35!=''){$placeholder[35]=$placeholder35;}else{$placeholder[35]='';}
			if (isset($placeholder36)&&$placeholder36!=''){$placeholder[36]=$placeholder36;}else{$placeholder[36]='';}
			if (isset($placeholder37)&&$placeholder37!=''){$placeholder[37]=$placeholder37;}else{$placeholder[37]='';}
			if (isset($placeholder38)&&$placeholder38!=''){$placeholder[38]=$placeholder38;}else{$placeholder[38]='';}
			if (isset($placeholder39)&&$placeholder39!=''){$placeholder[39]=$placeholder39;}else{$placeholder[39]='';}
			if (isset($placeholder40)&&$placeholder40!=''){$placeholder[40]=$placeholder40;}else{$placeholder[40]='';}
			if (isset($placeholder41)&&$placeholder41!=''){$placeholder[41]=$placeholder41;}else{$placeholder[41]='';}
			if (isset($placeholder42)&&$placeholder42!=''){$placeholder[42]=$placeholder42;}else{$placeholder[42]='';}
			if (isset($placeholder43)&&$placeholder43!=''){$placeholder[43]=$placeholder43;}else{$placeholder[43]='';}
			if (isset($placeholder44)&&$placeholder44!=''){$placeholder[44]=$placeholder44;}else{$placeholder[44]='';}
			if (isset($placeholder45)&&$placeholder45!=''){$placeholder[45]=$placeholder45;}else{$placeholder[45]='';}
			if (isset($placeholder46)&&$placeholder46!=''){$placeholder[46]=$placeholder46;}else{$placeholder[46]='';}
			if (isset($placeholder47)&&$placeholder47!=''){$placeholder[47]=$placeholder47;}else{$placeholder[47]='';}
			if (isset($placeholder48)&&$placeholder48!=''){$placeholder[48]=$placeholder48;}else{$placeholder[48]='';}
			if (isset($placeholder49)&&$placeholder49!=''){$placeholder[49]=$placeholder49;}else{$placeholder[49]='';}
			if (isset($placeholder50)&&$placeholder50!=''){$placeholder[50]=$placeholder50;}else{$placeholder[50]='';}
			
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
						<label for="text2" class="control-label col-sm-4">'.$placeholder[1].'</label>
						<div class="col-sm-8 field">
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

			//Se recorre 50 veces
			$maxs = 50;
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
							<label for="text2" class="control-label col-sm-4">'.$placeholder[$i].'</label>
							<div class="col-sm-8 field">
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
											//echo $data_writing.'<br/>';
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
	
/*******************************************************************************************************************/
	
}


?>
