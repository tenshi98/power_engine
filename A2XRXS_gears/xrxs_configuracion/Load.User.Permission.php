<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1001-001).');
}
/*******************************************************************************************************************/
/*                                          Conexion de la Base de datos                                           */
/*******************************************************************************************************************/
//Verifico si existe la variable
if(isset($_SESSION['usuario']['Permisos'][$original]['level']) && $_SESSION['usuario']['Permisos'][$original]['level']!=''){
	//Si no tiene el nivel necesario para ver la transaccion
	if($_SESSION['usuario']['Permisos'][$original]['level'] <= 0) {
		//redirijo a la pagina principal
		header( 'Location: principal.php' );
		die;		
	//Si lo tiene traspaso el nivel de permiso a una variable
	}else{
		$rowlevel['level'] = $_SESSION['usuario']['Permisos'][$original]['level'];
	}
//Si el permiso no existe
}else{
	//redirijo a la pagina principal
	header( 'Location: principal.php' );
	die;
}


?>
