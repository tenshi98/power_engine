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
		$originales   = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿª';
		$modificadas  = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybya';
		$cadena       = utf8_decode($Data);
		$cadena       = strtr($cadena, utf8_decode($originales), $modificadas);
		$Data         = utf8_encode($cadena);
		//se cambian todas las letras a minusculas
		$Data         = strtolower($Data);
	
		//%20 = espacio
		//%22 = "
		//%25 = %
		//%27 = '
		//%2B = +
		//%2D = -
		//%2F = /
		//%3B = ;
		//%3C = <
		//%3D = =
		//%3E = >
		//%3F = ?
		
		//Lista de palabras censuradas en ingles 
		$inject = array('drop','table','insert','update','select','like', 'union', 'truncate', 'shutdown', 'show', 
						'"', '""',"'", "''",
						'";', "';", ';',
						'"OR"', "'OR'",
						'char(',
						'%20', '%22', '%25', '%27', '%2B', '%2D', '%2F', '%3B', '%3C', '%3D', '%3E', '%3F'
		
		);
		
		//
		$contador = 0;
		//se revisa una a una
		for ($i=0; $i < count($inject); $i++) { 
			if( strpos($Data,$inject[$i]) !== false ){
				
				//Cuenta las prohibidas
				$contador++;
			}
		}
		
		//si no hay ninguna
		if($contador==0){
			return $Data;
		}else{
			return $contador;
		}						
		
		//$Data = mysqli_real_escape_string($dbConn, $Data);
	}elseif(is_numeric($Data) && abs($Data) == $Data){
		$Data = $Data;
		return $Data;
	}
	
}
function SanitizarDatos($Data) {
// Loop through POST variables
	foreach($Data as $input => $value) {
		$Data[$input] = secure($value);
	}
	return $Data;
}


function anti_injection($sql){
    $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
    return $sql;
}


?>
