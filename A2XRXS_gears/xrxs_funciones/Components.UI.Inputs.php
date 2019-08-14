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
		
		return $input;
	}
	
	/****************************************************************************************/
	//imprime el script que solo permite el tipeo de numeros
	private function solo_numeros($name){
		$input = '
		<script>
			<!--
				function soloNumeros_'.$name.'(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
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
		
		return $input;
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
		
		return $input;
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
		
		return $input;
	}
	
	
	
	/////////////////////////////        PUBLICAS        /////////////////////////////
    /****************************************************************************************/
	public function input_login_usr($placeholder,$name, $value){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		$x='required';$_SESSION['form_require'].=','.$name;
		
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
	/*******************************************************************************************************************/
	public function input_login_rut($placeholder,$name, $value){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		$x='required';$_SESSION['form_require'].=','.$name;
		
		//filtrado de teclas
		$input = $this->solo_rut($name);
			
		//generacion del input
		$input .= '
			<div class="field" id="div_'.$name.'">
				<input type="text"     placeholder="'.$placeholder.'"    class="form-control top"  id="'.$name.'"  name="'.$name.'"  autocomplete="off" value="'.$w.'" '.$x.' onkeypress="return soloRut_'.$name.'(event)">
			</div>';
				
		//Validacion Script		
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
		
		//script ejecucion
		$input .='
			<script>
				$("#'.$name.'").rut();
			</script>';
			
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_login_pass($placeholder,$name, $value){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		$x='required';$_SESSION['form_require'].=','.$name;	
		
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
	/*******************************************************************************************************************/
	public function input_login_mail($placeholder,$name, $value){
		
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
	/*******************************************************************************************************************/
	public function input($type,$placeholder,$name, $value, $required){
		
		//Se eliminan datos
		$name = str_replace('[]', '', $name);
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="field">
				<input class="form-control" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
			</div>
		';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_hold($type,$placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
			
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '
			<div class="field">
				<input class="form-control" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">
			</div>
		';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_hidden($name, $value, $required){
		
		//Validacion de variables
		if($value!=''){$w=$value;}else{$w='';}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' >';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_values_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros($name);
			
		//generacion del input
		$input .= '<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return soloNumeros_'.$name.'(event)" value="'.$w.'" >';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function select($placeholder,$name, $required, $data1, $data2, $table, $filter,$style, $dbConn){

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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
	}
	/*******************************************************************************************************************/
	public function select_change($placeholder,$name, $required, $data1, $data2, $table, $filter,$style, $OnSelectionChange,$dbConn){

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
			
			$input = '<div class="field">
			<select name="'.$name.'" id="'.$name.'" class="form-control" '.$x.' style="'.$style.'" onchange="'.$OnSelectionChange.' (this)">
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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
	}
	/*******************************************************************************************************************/
	public function select_val_filter($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			$input = $this->input_select_val($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn);
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
	public function input_select_val($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
	}
	/*******************************************************************************************************************/
	public function input_textarea_obs($placeholder,$name, $required,$style,$value){

		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '<textarea placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control" style="overflow: auto; word-wrap: break-word; resize: horizontal; '.$style.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)" >'.$w.'</textarea>';
			
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_text($type,$placeholder,$name,$required,$extra_class,$style){
		
		//Validacion de variables
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '<input class="form-control '.$extra_class.'" style="'.$style.'" "type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return soloLetras_'.$name.'(event)">';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_text_val($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '<input class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" placeholder="'.$placeholder.'"  name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)">';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_values_val_2($type,$placeholder,$name,$required,$extra_class,$style,$value){
		
		//Validacion de variables
		if($value==''){$w='0';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//filtrado de teclas
		$input = $this->solo_numeros($name);
			
		//generacion del input
		$input .= '<input placeholder="'.$placeholder.'"  class="form-control '.$extra_class.'" style="'.$style.'" type="'.$type.'" name="'.$name.'" id="'.$name.'"  '.$x.' onkeypress="return soloNumeros_'.$name.'(event)" value="'.$w.'" >';
		
		//Imprimir dato	
		echo $input;
	} 
	/*******************************************************************************************************************/
	public function input_date($placeholder,$name, $required){

		//Validacion de variables
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//Solicitud de recursos
		$input  ='<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/material_datetimepicker/css/bootstrap-material-datetimepicker.css" />';
		$input .='<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
		$input .='<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>';
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/material_datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
			
		//generacion del input
		$input .='<input placeholder="'.$placeholder.'" class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'"  '.$x.'> ';
		
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
	/*******************************************************************************************************************/
	public function input_time($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//solicitud de recursos
		$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.css">';
		
		//generacion del input
		$input .='<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >';
		
		//solicitud de recursos
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>';
		
		//script activacion
		$input .='<script type="text/javascript">
			$("#'.$name.'").clockpicker({
				placement: "top",
				align: "right",
				donetext: "Listo"
			});
			</script>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_time_popover($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}
		
		//solicitud de recursos
		$input  ='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/popover_timepicker/css/timepicker.css">';
		$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/popover_timepicker/js/timepicker.js">';
		
		//generacion del input
		$input .='<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.'   >';
		
		//script activacion
		$input .='<script type="text/javascript">
			$("#'.$name.'").timepicker();
			</script>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_select_val_filter_ot($placeholder,$name, $required, $data1, $data2, $table, $filter,$style,$value, $dbConn){

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
			
			$input = '<link rel="stylesheet" href="'.DB_SITE.'/LIBS_js/chosen/chosen.css">';
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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}
		

	}
	/*******************************************************************************************************************/
	public function input_radio($placeholder,$name,$value,$checked){
		
		//Validacion de variables
		if($checked==1){$x='';}elseif($checked==2){$x='checked';}
			
		//generacion del input
		$input = '
		<div class="radio">
			<label>
				<input type="radio" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$x.'>
				'.$placeholder.'
			</label>
		</div>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_checkbox($placeholder,$name,$value){
		
		//generacion del input
		$input = '
		<div class="checkbox">
			<label>
				<input type="checkbox" name="'.$name.'" id="'.$name.'" value="'.$value.'">
				'.$placeholder.'
			</label>
		</div>';
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_number_spinner($placeholder,$name, $value, $min, $max, $step, $ndecimal, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//solicitud de recursos
		$input  ='<script src="'.DB_SITE.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.js"></script>';
		$input .='<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.css">';
		
		//generacion del input
		$input .='<input placeholder="'.$placeholder.'" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$name.'(event)">';
				
		//script activacion
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
	public function input_number($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==0){$w='';}elseif($value!=0){$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input ='<div class="field">
					<div class="input-group bootstrap-timepicker">
						<input placeholder="'.$placeholder.'"  class="form-control timepicker-default" type="text" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloNumerosNaturales_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="fa fa-subscript"></i></span> 		
					</div>
				</div>';
				
		//filtrado de teclas
		$input .= $this->solo_numeros_naturales($name);
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function input_disabled($type,$placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}	
		
		//generacion del input
		$input = '<input type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$name.'" class="form-control '.$name.'" value="'.$w.'"  '.$x.' disabled="disabled">';	
		
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function select_bodega($placeholder,$name, $value, $required, $data1, $data2, $table1, $table2, $filter, $dbConn){

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
			echo '<p>Error en la consulta, consulte con el administrador</p>';			
		}

	}
	/*******************************************************************************************************************/
	public function input_rut($placeholder,$name, $value, $required){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
		
		//filtrado de teclas
		$input = $this->solo_rut($name);
			
		//generacion del input
		$input .= '<div class="field">
						<div class="input-group bootstrap-timepicker">
							<input type="text" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloRut_'.$name.'(event)"  >
							<span class="input-group-addon add-on"><i class="fa fa-male"></i></span> 
							
						</div>
					</div>';
		
		//Validacion Script		
		$input .='<script type="text/javascript" src="'.DB_SITE.'/LIBS_js/rut_validate/jquery.rut.min.js"></script>';
		
		//script activacion
		$input.='
			<script>
				$("#'.$name.'").rut();
			</script>';
				
		//Imprimir dato	
		echo $input;
	}
	/*******************************************************************************************************************/
	public function select_depend1($placeholder1, $name1,  $value1,  $required1,  $dataA1,  $dataB1,  $table1,  $filter1,   $extracomand1,
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
	/*******************************************************************************************************************/
	public function input_icon($type,$placeholder,$name, $value, $required, $icon){
		
		//Validacion de variables
		if($value==''){$w='';}else{$w=$value;}
		if($required==1){$x='';}elseif($required==2){$x='required';$_SESSION['form_require'].=','.$name;}			
		
		//filtrado de teclas
		$input = $this->solo_letras($name);
			
		//generacion del input
		$input .= '<div class="field">
					<div class="input-group bootstrap-timepicker">
						<input type="'.$type.'" placeholder="'.$placeholder.'"  class="form-control timepicker-default" name="'.$name.'" id="'.$name.'" value="'.$w.'" '.$x.' onkeypress="return soloLetras_'.$name.'(event)"  >
						<span class="input-group-addon add-on"><i class="'.$icon.'"></i></span> 
							
					</div>
				</div>';		
		
		//Imprimir dato	
		echo $input;
	}

}


?>
