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
function secure($Data) {

	//Si el dato no es un numero
	if (!is_numeric($Data)) {
		
		//se definen las letras a reemplazar
    /*$originales   = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿª';
    $modificadas  = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybya';
    $cadena       = utf8_decode($oracion);
    $cadena       = strtr($cadena, utf8_decode($originales), $modificadas);
    $oracion      = utf8_encode($cadena);
	
	//Lista de palabras censuradas en ingles 
	$censuradas_1 = array('fuck','horny','aroused','hentai','slut','slag','boob','pussy','vagina',
						'faggot','bugger','bastard','cunt','nigga','nigger','jerk','wanker',
						'tosser','shit','rape','rapist','dick','cock','whore','bitch','asshole',
						'twat','titt','piss','intercourse','sperm','spunk','testicle','milf',
						'retard','anus','dafuq','gay','lesbian','homo','homosexual','cum',
						'prostitute','wtf','penis','ffs','pedo','hack','dumb','crap','fuck you',
						'bullshit','damn','hell','ass','badass','son of a bitch','pissed off',
						'dickhead','motherfucker','dumbass','tramp');
	
	
	DROP
	TABLE 
	INSERT 
	UPDATE 
	SELECT ; 'OR' "OR"
	%27
	%3B
	--
	+
						
	$partes_1   = count($censuradas_1);					
	$contador   = 0;
	
	
	for ($i=0; $i < $partes_1; $i++) { 
		if( strpos($oracion,' '.$censuradas_1[$i].' ') !== false ){
			//Cuenta las prohibidas
			$contador++;
		}
	}*/						
		
		//$Data = mysqli_real_escape_string($dbConn, $Data);
	}elseif(is_numeric($Data) && abs($Data) == $Data){
		$Data = $Data;
		
	}



	return $Data;
}
function SanitizarDatos($Data) {
// Loop through POST variables
	foreach($Data as $input => $value) {
		$Data[$input] = secure($value);
	}
	return $Data;
}
	
?>
