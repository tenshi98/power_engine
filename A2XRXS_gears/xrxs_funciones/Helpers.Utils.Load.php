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
//Variable para errores para los formularios
$_SESSION['ErrorListing'] = array();
/*******************************************************************************************************************/
//solo si es administrador
if(isset($_SESSION['usuario']['basic_data']['idTipoUsuario'])&&$_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	//Se guarda la memoria inicial del servidor al cargar la pagina
	$sis_mem_ini = memory_get_usage();
}


?>
