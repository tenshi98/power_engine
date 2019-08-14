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
	private function solo_letras($name){
		$input = '
		<script>
			function soloLetras_'.$name.'(e){
				key = e.keyCode || e.which;
				tecla = String.fromCharCode(key).toLowerCase();
				letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
				especiales = [8,37,46];

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
				especiales = [8,37,46];

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
	public function form_input_hidden($name, $value, $required){
		
		//Validacion de variables
		if($value!=''){$w=$value;}else{$w='';}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' >';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_text($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<input type="text" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
				</div>
			</div>';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_password($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input type="password" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)"  >
						<span class="pass_impt" id="view_button_'.$name.'"><i class="fa fa-eye" aria-hidden="true"></i></span>
						<span class="input-group-addon add-on" ><i class="fa fa-key"></i></span> 
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
	/*******************************************************************************************************************/
	public function form_input_disabled($placeholder,$name, $value, $required){
		
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
	/*******************************************************************************************************************/
	public function form_input_icon($placeholder,$name, $value, $required, $icon){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="'.$icon.'"></i></span> 
					</div>
				</div>
			</div>';		
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_rut($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
		
		//filtrado de teclas
		$input = $this->solo_rut($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'" >'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloRut_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-male"></i></span> 
					</div>
				</div>
			</div>';
		
		//Validacion Script		
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
		
		//ejecucion script
		$input.='
			<script>
				$("#'.$name.'").rut();
			</script>';
				
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_validate($placeholder,$name, $value, $required, $aValidar){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4" id="label_'.$name.'">'.$placeholder.'</label>
				<div class="col-sm-8 field autocomplete">
					<input type="text" placeholder="'.$placeholder.'" class="form-control"  name="'.$name.'" id="'.$name.'" value="'.$w.'"  '.$x.' onkeypress="return soloLetras_'.$name.'(event)" autocomplete="off">
					<input type="hidden" name="rev_'.$name.'" id="rev_'.$name.'" value="'.$aValidar.'" >
				</div>
			</div>';	
		
		//ejecucion script		
		$input .= '
				<script>
				function autocomplete(inp, arr) {
					/*the autocomplete function takes two arguments,
					the text field element and an array of possible autocompleted values:*/
					var currentFocus;
					/*execute a function when someone writes in the text field:*/
					inp.addEventListener("input", function(e) {
						var a, b, i, val = this.value;
						/*close any already open lists of autocompleted values*/
						closeAllLists();
						if (!val) { return false;}
						currentFocus = -1;
						/*create a DIV element that will contain the items (values):*/
						a = document.createElement("DIV");
						a.setAttribute("id", this.id + "autocomplete-list");
						a.setAttribute("class", "autocomplete-items");
						/*append the DIV element as a child of the autocomplete container:*/
						this.parentNode.appendChild(a);
						/*for each item in the array...*/
						for (i = 0; i < arr.length; i++) {
							/*check if the item starts with the same letters as the text field value:*/
							if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
								/*create a DIV element for each matching element:*/
								b = document.createElement("DIV");
								/*make the matching letters bold:*/
								b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
								b.innerHTML += arr[i].substr(val.length);
								/*insert a input field that will hold the current array items value:*/
								b.innerHTML += "<input type=\'hidden\' value=\'" + arr[i] + "\'>";
								/*execute a function when someone clicks on the item value (DIV element):*/
								b.addEventListener("click", function(e) {
									/*insert the value for the autocomplete text field:*/
									inp.value = this.getElementsByTagName("input")[0].value;
									/*close the list of autocompleted values,
									(or any other open lists of autocompleted values:*/
									closeAllLists();
								});
							a.appendChild(b);
							}
						}
					});
					/*execute a function presses a key on the keyboard:*/
					inp.addEventListener("keydown", function(e) {
						var x = document.getElementById(this.id + "autocomplete-list");
						if (x) x = x.getElementsByTagName("div");
						if (e.keyCode == 40) {
							/*If the arrow DOWN key is pressed,
							increase the currentFocus variable:*/
							currentFocus++;
							/*and and make the current item more visible:*/
							addActive(x);
						} else if (e.keyCode == 38) { //up
							/*If the arrow UP key is pressed,
							decrease the currentFocus variable:*/
							currentFocus--;
							/*and and make the current item more visible:*/
							addActive(x);
						} else if (e.keyCode == 13) {
							/*If the ENTER key is pressed, prevent the form from being submitted,*/
							e.preventDefault();
							if (currentFocus > -1) {
								/*and simulate a click on the "active" item:*/
								if (x) x[currentFocus].click();
							}
						}
					});
					function addActive(x) {
						/*a function to classify an item as "active":*/
						if (!x) return false;
						/*start by removing the "active" class on all items:*/
						removeActive(x);
						if (currentFocus >= x.length) currentFocus = 0;
						if (currentFocus < 0) currentFocus = (x.length - 1);
						/*add class "autocomplete-active":*/
						x[currentFocus].classList.add("autocomplete-active");
					}
					function removeActive(x) {
						/*a function to remove the "active" class from all autocomplete items:*/
						for (var i = 0; i < x.length; i++) {
						  x[i].classList.remove("autocomplete-active");
						}
					}
					function closeAllLists(elmnt) {
						/*close all autocomplete lists in the document,
						except the one passed as an argument:*/
						var x = document.getElementsByClassName("autocomplete-items");
						for (var i = 0; i < x.length; i++) {
						  if (elmnt != x[i] && elmnt != inp) {
							x[i].parentNode.removeChild(x[i]);
						  }
						}
					}
					/*execute a function when someone clicks in the document:*/
					document.addEventListener("click", function (e) {
						closeAllLists(e.target);
					});
				}';
				
			$input .= '
				/*An array containing all the country names in the world:*/
				var vali_val = [""';
				
				//limpio y separo los datos de la cadena de comprobacion
				$obligatorios = str_replace(' ', '', $aValidar);
				$piezas = explode(",", $obligatorios);
				//recorro los elementos
				foreach ($piezas as $validd) {
					$input .= ',"'.$validd.'"';
				}		
				
				
			$input .= '];

			/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
			autocomplete(document.getElementById("'.$name.'"), vali_val);
		</script>';
				
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_values($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros_naturales_enteros_positivos($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnterosPositivos_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-usd"></i></span> 
					</div>
				</div>
			</div>';

		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_phone($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros_naturales_enteros_positivos($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnterosPositivos_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-phone"></i></span> 
					</div>
				</div>
			</div>';

		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_fax($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros_naturales_enteros_positivos($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnterosPositivos_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-fax"></i></span> 
					</div>
				</div>
			</div>';

		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_number($placeholder,$name, $value, $required){
		
		//Validacion de variables
		$w=$value;
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input ='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
					</div>
				</div>
			</div>';
		
		//filtrado de teclas
		$input .= $this->solo_numeros_naturales($name);
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_number_integer($placeholder,$name, $value, $required){
		
		//Validacion de variables
		$w=$value;
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros_naturales_enteros($name);
		
		//generacion del input
		$input .='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosEnteros_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-superscript"></i></span> 
					</div>
				</div>
			</div>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_number_alt($placeholder,$name, $value, $required){
		
		//Validacion de variables
		$w=$value;
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input ='<div class="form-group" id="div_'.$name.'">
					<label class="control-label col-sm-12" style="text-align: left;">'.$placeholder.'</label>
					<div class="col-sm-12 field">
						<div class="input-group bootstrap-timepicker">
							<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$name.'(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 
							
						</div>
					</div>
				</div>';
		
		//filtrado de teclas
		$input .= $this->solo_numeros_naturales($name);
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_input_number_spinner($placeholder,$name, $value, $min, $max, $step, $ndecimal, $required){
		
		//Validacion de variables
		$w=$value;
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//se cargan recursos
		$input  ='<script src="'.DB_SITE.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.js"></script>';
		$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.css">';
		
		//generacion del input
		$input .='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'" type="text" name="'.$name.'" id="'.$name.'" value="'.str_replace(',','.',$value).'" '.$x.' onkeypress="return soloNumerosNaturales_'.$name.'(event)">
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
		
		//filtrado de teclas
		$input .= $this->solo_numeros_naturales($name);
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_date($placeholder,$name, $value, $required){
		
		//variables internas
		$random_int = rand(1, 999);
		$EXname = str_replace('[]', '', $name);
		$EXname = $EXname.'_'.$random_int;
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//solicitud de recursos
		$input ='<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
		$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
		$input .='<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>';
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
			
		//generacion del input
		$input .='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$EXname.'" value="'.$w.'" '.$x.'>
						<span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span> 
					</div>
				</div>
			</div>';
		
		//ejecucion script	
		$input .='<script type="text/javascript">
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
	/*******************************************************************************************************************/
	public function form_time($placeholder,$name, $value, $required, $position){
		
		//Validacion de variables
		if($value==''){$w='';}elseif($value!=''){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//Posicion de la burbuja
		switch ($position) {
			case 1: $x_pos = 'top'; break;
			case 2: $x_pos = 'bottom'; break;
		}
		
		//solicitud de recursos
		$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
		
		//generacion del input
		$input .='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >
						<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span> 
					</div>
				</div>
			</div>';
		
		//solicitud de recursos
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
		
		//ejecucion script
		$input .='<script type="text/javascript">
			$("#'.$name.'").clockpicker({
				placement: "'.$x_pos.'",
				align: "left",
				donetext: "Listo"
			});
			</script>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_time_popover($placeholder,$name, $value, $required, $position, $limit){
		
		//Validacion de variables
		if($value==''){$w='';}elseif($value!=''){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//Posicion de la burbuja
		switch ($position) {
			case 1: $x_pos = 'top'; break;
			case 2: $x_pos = 'bottom'; break;
		}
		
		//solicitud recursos
		$input  ='<script src="'.DB_SITE.'/LIBS_js/popover_timepicker/js/timepicki_'.$x_pos.'.js"></script>';
		$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/popover_timepicker/css/timepicki_'.$x_pos.'.css">';
		
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
				disable_keyboard_mobile: true});
		  });
		</script>';

		
		//generacion del input
		$input .='
			<div class="form-group" id="div_'.$name.'">
				<label class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >
						<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span> 
					</div>
				</div>
			</div>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_textarea($placeholder,$name, $value, $required, $height){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		if($height!=0){$xheight=$height;}elseif($height==0){$xheight='320';}	
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="form-group" id="div_'.$name.'">
				<label for="text2" class="control-label col-sm-4">'.$placeholder.'</label>
				<div class="col-sm-8 field">
					<textarea name="'.$name.'" id="'.$name.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; height: '.$xheight.'px;" '.$x.' onkeypress="return soloLetras_'.$name.'(event)" >'.$w.'</textarea>
				</div>
			</div>';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_ckeditor($placeholder,$name, $value, $required, $tipo){

		//Validacion de variables
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//generacion del input
		$input = '
			<div class="txtckedit field">
				<h3>'.$placeholder.'</h3>
				<textarea id="ckeditor_'.$name.'" class="ckeditor" name="'.$name.'" '.$x.'>'.$value.'</textarea>
			</div>';
		
		//se cargan recursos					
		$input .= '<script src="'.DB_SITE.'/LIBS_js/ckeditor/ckeditor.js"></script>';
		
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
	/*******************************************************************************************************************/
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
	public function form_multiple_upload($placeholder, $name, $max_files, $type_files){
		
		//Verifico si es mas de un archivo
		if(isset($max_files)&&$max_files!=1){
			$ndat = '[]';
		}else{
			$ndat = '';
		}
		
		//se cargan recursos
		$input = '
			<link href="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
			<link href="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
			<script src="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/js/plugins/sortable.js" type="text/javascript"></script>
			<script src="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/js/fileinput.js" type="text/javascript"></script>
			<script src="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/js/locales/es.js" type="text/javascript"></script>
			<script src="'.DB_SITE.'/LIBS_js/bootstrap_fileinput/themes/explorer/theme.js" type="text/javascript"></script>
		';
		
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
	/*******************************************************************************************************************/
	public function form_checkbox($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

		//si dato es requerido
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//Filtro para el where
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
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
									<label>
										<input type="checkbox" value="'.$select['idData'].'" '.$w.' name="'.$name.'_'.$z.'" id="'.$name.'_'.$z.'">
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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
		

	}
	/*******************************************************************************************************************/
	public function form_checkbox_active($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){

		//si dato es requerido
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//Filtro para el where
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
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
									<label>
										<input class="styled" type="checkbox" value="'.$m.'" '.$w.' name="'.$name.'_'.$z.'" id="'.$name.'_'.$z.'">
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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
		

	}
	/*******************************************************************************************************************/
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
	public function form_select($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $orderby, $dbConn){

		//si dato es requerido
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//Filtro para el where
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
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
		//Verifica si se pidio ordenar
		if(isset($orderby)&&$orderby!=''){$order_by = $orderby;}

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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}

	}
	/*******************************************************************************************************************/
	public function form_select_filter($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $orderby, $dbConn){

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			$input = $this->form_select($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $orderby, $dbConn);
		}else{
		   //si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
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
			//Verifica si se pidio ordenar
			if(isset($orderby)&&$orderby!=''){$order_by = $orderby;}

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
				
				$input = '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/chosen/chosen.css">';
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
						
							<script src="'.DB_SITE.'/LIBS_js/chosen/chosen.jquery.js" type="text/javascript"></script>
							<script src="'.DB_SITE.'/LIBS_js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
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
							#div_'.$name.' .chosen-single {background:url('.DB_SITE.'/LIB_assets/img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
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
				echo '<p>Error en la consulta, consulte con el administrador</p>';			
			}
		}
	}
	/*******************************************************************************************************************/
	public function form_select_join($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

		//si dato es requerido
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		//Filtro para el where
		$filtro = '';
		if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
		

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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
	}
	/*******************************************************************************************************************/
	public function form_select_join_filter($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			$input = $this->form_select_join($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn);
		}else{
			//si dato es requerido
			if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
			//Filtro para el where
			$filtro = '';
			if ($filter!='0'){$filtro .="WHERE ".$filter." ";	}
			

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
				
				$input = '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/chosen/chosen.css">';
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
						
							<script src="'.DB_SITE.'/LIBS_js/chosen/chosen.jquery.js" type="text/javascript"></script>
							<script src="'.DB_SITE.'/LIBS_js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
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
							#div_'.$name.' .chosen-single {background:url('.DB_SITE.'/LIB_assets/img/required.png) no-repeat 5px center !important;background-color: #fff !important;}
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
				echo '<p>Error en la consulta, consulte con el administrador</p>';			
			}
		}
	}
	/*******************************************************************************************************************/
	public function form_select_disabled($placeholder,$name, $value, $required, $data1, $data2, $table, $filter, $dbConn){
		
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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}

	}
	/*******************************************************************************************************************/
	public function form_select_n_auto($placeholder,$name, $value, $required, $valor_ini, $valor_fin){

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
	/*******************************************************************************************************************/
	public function form_select_country($placeholder,$name, $value, $required, $dbConn){

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
		<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/country_picker/css/bootstrap-select.min.css">
		<script src="'.DB_SITE.'/LIBS_js/country_picker/js/bootstrap-select.min.js"></script>
		<script>var domain_val = "'.DB_SITE.'";</script>   	
		<script src="'.DB_SITE.'/LIBS_js/country_picker/js/countrypicker.js"></script>'; 
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function form_select_depend1($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$dbConn, $form_name){

		//Variables
		$input = '';
		

		//DATOS REQUERIDOS
		$required = array();
		if($required1==1){$required[1]='';      }elseif($required1==2){$required[1]='required';$_SESSION['form_require'].=','.$name1;}
		if($required2==1){$required[2]='';      }elseif($required2==2){$required[2]='required';$_SESSION['form_require'].=','.$name2;}
		
		//FILTROS
		$filtro = array();
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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
	/*******************************************************************************************************************/
	public function form_select_depend2($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$dbConn, $form_name){

		//Variables
		$input = '';
		

		//DATOS REQUERIDOS
		$required = array();
		if($required1==1){$required[1]='';      }elseif($required1==2){$required[1]='required';$_SESSION['form_require'].=','.$name1;}
		if($required2==1){$required[2]='';      }elseif($required2==2){$required[2]='required';$_SESSION['form_require'].=','.$name2;}
		if($required3==1){$required[3]='';      }elseif($required3==2){$required[3]='required';$_SESSION['form_require'].=','.$name3;}
		
		//FILTROS
		$filtro = array();
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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
	/*******************************************************************************************************************/
	public function form_select_depend3($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										$dbConn, $form_name){

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
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4." ";	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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

	/*******************************************************************************************************************/
	public function form_select_depend4($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										$placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
										$dbConn, $form_name){

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
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4." ";	}
		$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4." ";	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
		$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5." ";	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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
	/*******************************************************************************************************************/
	public function form_select_depend5($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
										$placeholder2, $name2,  $value2,  $required2,  $dataA2,  $dataB2,  $table2,  $filter2,   $extracomand2, 
										$placeholder3, $name3,  $value3,  $required3,  $dataA3,  $dataB3,  $table3,  $filter3,   $extracomand3,
										$placeholder4, $name4,  $value4,  $required4,  $dataA4,  $dataB4,  $table4,  $filter4,   $extracomand4,
										$placeholder5, $name5,  $value5,  $required5,  $dataA5,  $dataB5,  $table5,  $filter5,   $extracomand5,
										$placeholder6, $name6,  $value6,  $required6,  $dataA6,  $dataB6,  $table6,  $filter6,   $extracomand6,
										$dbConn, $form_name){

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
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4." ";	}
		$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5." ";	}
		$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4." ";	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
		$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5." ";	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
		$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6." ";	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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

	/*******************************************************************************************************************/
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
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4." ";	}
		$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5." ";	}
		$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6." ";	}
		$filtro[7] = '';  if ($filter7!='0') {$filtro[7] .=" AND ".$filter7." ";	}
		$filtro[8] = '';  if ($filter8!='0') {$filtro[8] .=" AND ".$filter8." ";	}
		$filtro[9] = '';  if ($filter9!='0') {$filtro[9] .=" AND ".$filter9." ";	}
		$filtro[10] = ''; if ($filter10!='0'){$filtro[10] .=" AND ".$filter10." ";	}
		$filtro[11] = ''; if ($filter11!='0'){$filtro[11] .=" AND ".$filter11." ";	}
		$filtro[12] = ''; if ($filter12!='0'){$filtro[12] .=" AND ".$filter12." ";	}
		$filtro[13] = ''; if ($filter13!='0'){$filtro[13] .=" AND ".$filter13." ";	}
		$filtro[14] = ''; if ($filter14!='0'){$filtro[14] .=" AND ".$filter14." ";	}
		$filtro[15] = ''; if ($filter15!='0'){$filtro[15] .=" AND ".$filter15." ";	}
		$filtro[16] = ''; if ($filter16!='0'){$filtro[16] .=" AND ".$filter16." ";	}
		$filtro[17] = ''; if ($filter17!='0'){$filtro[17] .=" AND ".$filter17." ";	}
		$filtro[18] = ''; if ($filter18!='0'){$filtro[18] .=" AND ".$filter18." ";	}
		$filtro[19] = ''; if ($filter19!='0'){$filtro[19] .=" AND ".$filter19." ";	}
		$filtro[20] = ''; if ($filter20!='0'){$filtro[20] .=" AND ".$filter20." ";	}
		$filtro[21] = ''; if ($filter21!='0'){$filtro[21] .=" AND ".$filter21." ";	}
		$filtro[22] = ''; if ($filter22!='0'){$filtro[22] .=" AND ".$filter22." ";	}
		$filtro[23] = ''; if ($filter23!='0'){$filtro[23] .=" AND ".$filter23." ";	}
		$filtro[24] = ''; if ($filter24!='0'){$filtro[24] .=" AND ".$filter24." ";	}
		$filtro[25] = ''; if ($filter25!='0'){$filtro[25] .=" AND ".$filter25." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4." ";	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
		$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5." ";	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
		$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6." ";	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
		$excom[7] = '';  if ($extracomand7!='0') {$excom[7] .=" ".$extracomand7." ";	} else{$excom[7] .=" ORDER BY Nombre ASC ";}
		$excom[8] = '';  if ($extracomand8!='0') {$excom[8] .=" ".$extracomand8." ";	} else{$excom[8] .=" ORDER BY Nombre ASC ";}
		$excom[9] = '';  if ($extracomand9!='0') {$excom[9] .=" ".$extracomand9." ";	} else{$excom[9] .=" ORDER BY Nombre ASC ";}
		$excom[10] = ''; if ($extracomand10!='0'){$excom[10] .=" ".$extracomand10." ";	} else{$excom[10] .=" ORDER BY Nombre ASC ";}
		$excom[11] = ''; if ($extracomand11!='0'){$excom[11] .=" ".$extracomand11." ";	} else{$excom[11] .=" ORDER BY Nombre ASC ";}
		$excom[12] = ''; if ($extracomand12!='0'){$excom[12] .=" ".$extracomand12." ";	} else{$excom[12] .=" ORDER BY Nombre ASC ";}
		$excom[13] = ''; if ($extracomand13!='0'){$excom[13] .=" ".$extracomand13." ";	} else{$excom[13] .=" ORDER BY Nombre ASC ";}
		$excom[14] = ''; if ($extracomand14!='0'){$excom[14] .=" ".$extracomand14." ";	} else{$excom[14] .=" ORDER BY Nombre ASC ";}
		$excom[15] = ''; if ($extracomand15!='0'){$excom[15] .=" ".$extracomand15." ";	} else{$excom[15] .=" ORDER BY Nombre ASC ";}
		$excom[16] = ''; if ($extracomand16!='0'){$excom[16] .=" ".$extracomand16." ";	} else{$excom[16] .=" ORDER BY Nombre ASC ";}
		$excom[17] = ''; if ($extracomand17!='0'){$excom[17] .=" ".$extracomand17." ";	} else{$excom[17] .=" ORDER BY Nombre ASC ";}
		$excom[18] = ''; if ($extracomand18!='0'){$excom[18] .=" ".$extracomand18." ";	} else{$excom[18] .=" ORDER BY Nombre ASC ";}
		$excom[19] = ''; if ($extracomand19!='0'){$excom[19] .=" ".$extracomand19." ";	} else{$excom[19] .=" ORDER BY Nombre ASC ";}
		$excom[20] = ''; if ($extracomand20!='0'){$excom[20] .=" ".$extracomand20." ";	} else{$excom[20] .=" ORDER BY Nombre ASC ";}
		$excom[21] = ''; if ($extracomand21!='0'){$excom[21] .=" ".$extracomand21." ";	} else{$excom[21] .=" ORDER BY Nombre ASC ";}
		$excom[22] = ''; if ($extracomand22!='0'){$excom[22] .=" ".$extracomand22." ";	} else{$excom[22] .=" ORDER BY Nombre ASC ";}
		$excom[23] = ''; if ($extracomand23!='0'){$excom[23] .=" ".$extracomand23." ";	} else{$excom[23] .=" ORDER BY Nombre ASC ";}
		$excom[24] = ''; if ($extracomand24!='0'){$excom[24] .=" ".$extracomand24." ";	} else{$excom[24] .=" ORDER BY Nombre ASC ";}
		$excom[25] = ''; if ($extracomand25!='0'){$excom[25] .=" ".$extracomand25." ";	} else{$excom[25] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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


	/*******************************************************************************************************************/
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
		$filtro[1] = '';  if ($filter1!='0') {$filtro[1] .=" AND ".$filter1." ";	}
		$filtro[2] = '';  if ($filter2!='0') {$filtro[2] .=" AND ".$filter2." ";	}
		$filtro[3] = '';  if ($filter3!='0') {$filtro[3] .=" AND ".$filter3." ";	}
		$filtro[4] = '';  if ($filter4!='0') {$filtro[4] .=" AND ".$filter4." ";	}
		$filtro[5] = '';  if ($filter5!='0') {$filtro[5] .=" AND ".$filter5." ";	}
		$filtro[6] = '';  if ($filter6!='0') {$filtro[6] .=" AND ".$filter6." ";	}
		$filtro[7] = '';  if ($filter7!='0') {$filtro[7] .=" AND ".$filter7." ";	}
		$filtro[8] = '';  if ($filter8!='0') {$filtro[8] .=" AND ".$filter8." ";	}
		$filtro[9] = '';  if ($filter9!='0') {$filtro[9] .=" AND ".$filter9." ";	}
		$filtro[10] = ''; if ($filter10!='0'){$filtro[10] .=" AND ".$filter10." ";	}
		$filtro[11] = ''; if ($filter11!='0'){$filtro[11] .=" AND ".$filter11." ";	}
		$filtro[12] = ''; if ($filter12!='0'){$filtro[12] .=" AND ".$filter12." ";	}
		$filtro[13] = ''; if ($filter13!='0'){$filtro[13] .=" AND ".$filter13." ";	}
		$filtro[14] = ''; if ($filter14!='0'){$filtro[14] .=" AND ".$filter14." ";	}
		$filtro[15] = ''; if ($filter15!='0'){$filtro[15] .=" AND ".$filter15." ";	}
		$filtro[16] = ''; if ($filter16!='0'){$filtro[16] .=" AND ".$filter16." ";	}
		$filtro[17] = ''; if ($filter17!='0'){$filtro[17] .=" AND ".$filter17." ";	}
		$filtro[18] = ''; if ($filter18!='0'){$filtro[18] .=" AND ".$filter18." ";	}
		$filtro[19] = ''; if ($filter19!='0'){$filtro[19] .=" AND ".$filter19." ";	}
		$filtro[20] = ''; if ($filter20!='0'){$filtro[20] .=" AND ".$filter20." ";	}
		$filtro[21] = ''; if ($filter21!='0'){$filtro[21] .=" AND ".$filter21." ";	}
		$filtro[22] = ''; if ($filter22!='0'){$filtro[22] .=" AND ".$filter22." ";	}
		$filtro[23] = ''; if ($filter23!='0'){$filtro[23] .=" AND ".$filter23." ";	}
		$filtro[24] = ''; if ($filter24!='0'){$filtro[24] .=" AND ".$filter24." ";	}
		$filtro[25] = ''; if ($filter25!='0'){$filtro[25] .=" AND ".$filter25." ";	}
		$filtro[26] = ''; if ($filter26!='0'){$filtro[26] .=" AND ".$filter26." ";	}
		$filtro[27] = ''; if ($filter27!='0'){$filtro[27] .=" AND ".$filter27." ";	}
		$filtro[28] = ''; if ($filter28!='0'){$filtro[28] .=" AND ".$filter28." ";	}
		$filtro[29] = ''; if ($filter29!='0'){$filtro[29] .=" AND ".$filter29." ";	}
		$filtro[30] = ''; if ($filter30!='0'){$filtro[30] .=" AND ".$filter30." ";	}
		$filtro[31] = ''; if ($filter31!='0'){$filtro[31] .=" AND ".$filter31." ";	}
		$filtro[32] = ''; if ($filter32!='0'){$filtro[32] .=" AND ".$filter32." ";	}
		$filtro[33] = ''; if ($filter33!='0'){$filtro[33] .=" AND ".$filter33." ";	}
		$filtro[34] = ''; if ($filter34!='0'){$filtro[34] .=" AND ".$filter34." ";	}
		$filtro[35] = ''; if ($filter35!='0'){$filtro[35] .=" AND ".$filter35." ";	}
		$filtro[36] = ''; if ($filter36!='0'){$filtro[36] .=" AND ".$filter36." ";	}
		$filtro[37] = ''; if ($filter37!='0'){$filtro[37] .=" AND ".$filter37." ";	}
		$filtro[38] = ''; if ($filter38!='0'){$filtro[38] .=" AND ".$filter38." ";	}
		$filtro[39] = ''; if ($filter39!='0'){$filtro[39] .=" AND ".$filter39." ";	}
		$filtro[40] = ''; if ($filter40!='0'){$filtro[40] .=" AND ".$filter40." ";	}
		$filtro[41] = ''; if ($filter41!='0'){$filtro[41] .=" AND ".$filter41." ";	}
		$filtro[42] = ''; if ($filter42!='0'){$filtro[42] .=" AND ".$filter42." ";	}
		$filtro[43] = ''; if ($filter43!='0'){$filtro[43] .=" AND ".$filter43." ";	}
		$filtro[44] = ''; if ($filter44!='0'){$filtro[44] .=" AND ".$filter44." ";	}
		$filtro[45] = ''; if ($filter45!='0'){$filtro[45] .=" AND ".$filter45." ";	}
		$filtro[46] = ''; if ($filter46!='0'){$filtro[46] .=" AND ".$filter46." ";	}
		$filtro[47] = ''; if ($filter47!='0'){$filtro[47] .=" AND ".$filter47." ";	}
		$filtro[48] = ''; if ($filter48!='0'){$filtro[48] .=" AND ".$filter48." ";	}
		$filtro[49] = ''; if ($filter49!='0'){$filtro[49] .=" AND ".$filter49." ";	}
		$filtro[50] = ''; if ($filter50!='0'){$filtro[50] .=" AND ".$filter50." ";	}
		
		//COMANDOS EXTRAS
		$excom = array();
		$excom[1] = '';  if ($extracomand1!='0') {$excom[1] .=" ".$extracomand1." ";	} else{$excom[1] .=" ORDER BY Nombre ASC ";}
		$excom[2] = '';  if ($extracomand2!='0') {$excom[2] .=" ".$extracomand2." ";	} else{$excom[2] .=" ORDER BY Nombre ASC ";}
		$excom[3] = '';  if ($extracomand3!='0') {$excom[3] .=" ".$extracomand3." ";	} else{$excom[3] .=" ORDER BY Nombre ASC ";}
		$excom[4] = '';  if ($extracomand4!='0') {$excom[4] .=" ".$extracomand4." ";	} else{$excom[4] .=" ORDER BY Nombre ASC ";} 
		$excom[5] = '';  if ($extracomand5!='0') {$excom[5] .=" ".$extracomand5." ";	} else{$excom[5] .=" ORDER BY Nombre ASC ";}
		$excom[6] = '';  if ($extracomand6!='0') {$excom[6] .=" ".$extracomand6." ";	} else{$excom[6] .=" ORDER BY Nombre ASC ";}
		$excom[7] = '';  if ($extracomand7!='0') {$excom[7] .=" ".$extracomand7." ";	} else{$excom[7] .=" ORDER BY Nombre ASC ";}
		$excom[8] = '';  if ($extracomand8!='0') {$excom[8] .=" ".$extracomand8." ";	} else{$excom[8] .=" ORDER BY Nombre ASC ";}
		$excom[9] = '';  if ($extracomand9!='0') {$excom[9] .=" ".$extracomand9." ";	} else{$excom[9] .=" ORDER BY Nombre ASC ";}
		$excom[10] = ''; if ($extracomand10!='0'){$excom[10] .=" ".$extracomand10." ";	} else{$excom[10] .=" ORDER BY Nombre ASC ";}
		$excom[11] = ''; if ($extracomand11!='0'){$excom[11] .=" ".$extracomand11." ";	} else{$excom[11] .=" ORDER BY Nombre ASC ";}
		$excom[12] = ''; if ($extracomand12!='0'){$excom[12] .=" ".$extracomand12." ";	} else{$excom[12] .=" ORDER BY Nombre ASC ";}
		$excom[13] = ''; if ($extracomand13!='0'){$excom[13] .=" ".$extracomand13." ";	} else{$excom[13] .=" ORDER BY Nombre ASC ";}
		$excom[14] = ''; if ($extracomand14!='0'){$excom[14] .=" ".$extracomand14." ";	} else{$excom[14] .=" ORDER BY Nombre ASC ";}
		$excom[15] = ''; if ($extracomand15!='0'){$excom[15] .=" ".$extracomand15." ";	} else{$excom[15] .=" ORDER BY Nombre ASC ";}
		$excom[16] = ''; if ($extracomand16!='0'){$excom[16] .=" ".$extracomand16." ";	} else{$excom[16] .=" ORDER BY Nombre ASC ";}
		$excom[17] = ''; if ($extracomand17!='0'){$excom[17] .=" ".$extracomand17." ";	} else{$excom[17] .=" ORDER BY Nombre ASC ";}
		$excom[18] = ''; if ($extracomand18!='0'){$excom[18] .=" ".$extracomand18." ";	} else{$excom[18] .=" ORDER BY Nombre ASC ";}
		$excom[19] = ''; if ($extracomand19!='0'){$excom[19] .=" ".$extracomand19." ";	} else{$excom[19] .=" ORDER BY Nombre ASC ";}
		$excom[20] = ''; if ($extracomand20!='0'){$excom[20] .=" ".$extracomand20." ";	} else{$excom[20] .=" ORDER BY Nombre ASC ";}
		$excom[21] = ''; if ($extracomand21!='0'){$excom[21] .=" ".$extracomand21." ";	} else{$excom[21] .=" ORDER BY Nombre ASC ";}
		$excom[22] = ''; if ($extracomand22!='0'){$excom[22] .=" ".$extracomand22." ";	} else{$excom[22] .=" ORDER BY Nombre ASC ";}
		$excom[23] = ''; if ($extracomand23!='0'){$excom[23] .=" ".$extracomand23." ";	} else{$excom[23] .=" ORDER BY Nombre ASC ";}
		$excom[24] = ''; if ($extracomand24!='0'){$excom[24] .=" ".$extracomand24." ";	} else{$excom[24] .=" ORDER BY Nombre ASC ";}
		$excom[25] = ''; if ($extracomand25!='0'){$excom[25] .=" ".$extracomand25." ";	} else{$excom[25] .=" ORDER BY Nombre ASC ";}
		$excom[26] = ''; if ($extracomand26!='0'){$excom[26] .=" ".$extracomand26." ";	} else{$excom[26] .=" ORDER BY Nombre ASC ";}
		$excom[27] = ''; if ($extracomand27!='0'){$excom[27] .=" ".$extracomand27." ";	} else{$excom[27] .=" ORDER BY Nombre ASC ";}
		$excom[28] = ''; if ($extracomand28!='0'){$excom[28] .=" ".$extracomand28." ";	} else{$excom[28] .=" ORDER BY Nombre ASC ";}
		$excom[29] = ''; if ($extracomand29!='0'){$excom[29] .=" ".$extracomand29." ";	} else{$excom[29] .=" ORDER BY Nombre ASC ";}
		$excom[30] = ''; if ($extracomand30!='0'){$excom[30] .=" ".$extracomand30." ";	} else{$excom[30] .=" ORDER BY Nombre ASC ";}
		$excom[31] = ''; if ($extracomand31!='0'){$excom[31] .=" ".$extracomand31." ";	} else{$excom[31] .=" ORDER BY Nombre ASC ";}
		$excom[32] = ''; if ($extracomand32!='0'){$excom[32] .=" ".$extracomand32." ";	} else{$excom[32] .=" ORDER BY Nombre ASC ";}
		$excom[33] = ''; if ($extracomand33!='0'){$excom[33] .=" ".$extracomand33." ";	} else{$excom[33] .=" ORDER BY Nombre ASC ";}
		$excom[34] = ''; if ($extracomand34!='0'){$excom[34] .=" ".$extracomand34." ";	} else{$excom[34] .=" ORDER BY Nombre ASC ";}
		$excom[35] = ''; if ($extracomand35!='0'){$excom[35] .=" ".$extracomand35." ";	} else{$excom[35] .=" ORDER BY Nombre ASC ";}
		$excom[36] = ''; if ($extracomand36!='0'){$excom[36] .=" ".$extracomand36." ";	} else{$excom[36] .=" ORDER BY Nombre ASC ";}
		$excom[37] = ''; if ($extracomand37!='0'){$excom[37] .=" ".$extracomand37." ";	} else{$excom[37] .=" ORDER BY Nombre ASC ";}
		$excom[38] = ''; if ($extracomand38!='0'){$excom[38] .=" ".$extracomand38." ";	} else{$excom[38] .=" ORDER BY Nombre ASC ";}
		$excom[39] = ''; if ($extracomand39!='0'){$excom[39] .=" ".$extracomand39." ";	} else{$excom[39] .=" ORDER BY Nombre ASC ";}
		$excom[40] = ''; if ($extracomand40!='0'){$excom[40] .=" ".$extracomand40." ";	} else{$excom[40] .=" ORDER BY Nombre ASC ";} 
		$excom[41] = ''; if ($extracomand41!='0'){$excom[41] .=" ".$extracomand41." ";	} else{$excom[41] .=" ORDER BY Nombre ASC ";} 
		$excom[42] = ''; if ($extracomand42!='0'){$excom[42] .=" ".$extracomand42." ";	} else{$excom[42] .=" ORDER BY Nombre ASC ";} 
		$excom[43] = ''; if ($extracomand43!='0'){$excom[43] .=" ".$extracomand43." ";	} else{$excom[43] .=" ORDER BY Nombre ASC ";} 
		$excom[44] = ''; if ($extracomand44!='0'){$excom[44] .=" ".$extracomand44." ";	} else{$excom[44] .=" ORDER BY Nombre ASC ";} 
		$excom[45] = ''; if ($extracomand45!='0'){$excom[45] .=" ".$extracomand45." ";	} else{$excom[45] .=" ORDER BY Nombre ASC ";} 
		$excom[46] = ''; if ($extracomand46!='0'){$excom[46] .=" ".$extracomand46." ";	} else{$excom[46] .=" ORDER BY Nombre ASC ";} 
		$excom[47] = ''; if ($extracomand47!='0'){$excom[47] .=" ".$extracomand47." ";	} else{$excom[47] .=" ORDER BY Nombre ASC ";} 
		$excom[48] = ''; if ($extracomand48!='0'){$excom[48] .=" ".$extracomand48." ";	} else{$excom[48] .=" ORDER BY Nombre ASC ";} 
		$excom[49] = ''; if ($extracomand49!='0'){$excom[49] .=" ".$extracomand49." ";	} else{$excom[49] .=" ORDER BY Nombre ASC ";} 
		$excom[50] = ''; if ($extracomand50!='0'){$excom[50] .=" ".$extracomand50." ";	} else{$excom[50] .=" ORDER BY Nombre ASC ";}
		
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
		$query = "SELECT ".$dataA[1]." AS idData ".$data_requiredA." FROM `".$table[1]."` WHERE ".$dataA[1]."!='' ".$filtro[1]." ".$excom[1]."";
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
				$query = "SELECT ".$dataA[$i]." AS idData ".$data_requiredB."  FROM `".$table[$i]."` WHERE ".$dataA[$i-1]." = ".$value[$i-1]." ".$filtro[$i]." ".$excom[$i]."";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSeleccion,$row );
				}
				mysqli_free_result($resultado);
			} 
			// Se trae un listado con todos los datos
			$arrTodos = array();
			$query = "SELECT ".$dataA[$i]." AS idData, ".$dataA[$i-1]." AS idCat ".$data_requiredB." FROM `".$table[$i]."` WHERE ".$dataA[$i]."!='' ".$filtro[$i]." ".$excom[$i]."";
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


?>
