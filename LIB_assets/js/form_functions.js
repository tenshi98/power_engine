/*******************************************************************************/
//Permite el ingreso solo de caracteres predefinidos
function soloLetras(e){
	//defino el evento
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	//caracteres permitidos
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
	//caracteres especiales permitidos
	especiales = [8,37,38,39,40,46];

	tecla_especial = false;
	//reviso si alguna de las acciones es un caracter especial
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	//impido la ejecucion
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

/*******************************************************************************/
//Permite el ingreso solo de caracteres predefinidos
function soloLetrasTextArea(e){
	//defino el evento
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	//caracteres permitidos
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
	//caracteres especiales permitidos
	especiales = [8,13,37,38,39,40,46];

	tecla_especial = false;
	//reviso si alguna de las acciones es un caracter especial
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	//impido la ejecucion
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

/*******************************************************************************/
//Permite el ingreso solo de numeros enteros o decimales, positivos o negativos
function soloNumeroRealRacional(e){
	var charCode = (e.which) ? e.which : e.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		//verifico si presiono el punto
		if (charCode == 46) {
			return true;
		//valor negativo
		}else if(charCode == 45){
			return true;
		//para el resto bloquear
		}else{
			return false;
		}
	}else{
		return true;
	}
}

/*******************************************************************************/
//Permite el ingreso solo de numeros enteros, positivos o negativos
function soloNumeroNaturalReal(e){
	var charCode = (e.which) ? e.which : e.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		//verifico si presiono el punto
		if (charCode == 46) {
			return false;
		//valor negativo
		}else if(charCode == 45){
			return true;
		//para el resto bloquear
		}else{
			return false;
		}
	}else{
		return true;
	}
}

/*******************************************************************************/
//Permite el ingreso solo de numeros enteros, positivos
function soloNumeroNatural(e){
	var charCode = (e.which) ? e.which : e.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		//verifico si presiono el punto
		if (charCode == 46) {
			return false;
		//valor negativo
		}else if(charCode == 45){
			return false;
		//para el resto bloquear
		}else{
			return false;
		}
	}else{
		return true;
	}
}

/*******************************************************************************/
//Permite el ingreso solo de numeros enteros, positivos
function soloRut(e){
	//Info en https://css-tricks.com/snippets/javascript/javascript-keycodes/
	//defino el evento
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	//caracteres permitidos
	letras = "kK1234567890-.";
	//caracteres especiales permitidos
	especiales = [8,37,38,39,40,46,96,97,98,99,100,101,102,103,104,105];

	tecla_especial = false;
	//reviso si alguna de las acciones es un caracter especial
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}
	//impido la ejecucion
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}











