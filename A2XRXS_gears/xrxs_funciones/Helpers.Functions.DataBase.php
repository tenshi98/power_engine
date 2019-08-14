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
/*******************************************************************************************************************/
//Funcion para conectarse a la base de datos
function conectar () {
	$db_con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$db_con->set_charset("utf8");
	return $db_con; 
}
/*******************************************************************************************************************/
//Funcion para seleccionar data desde la base de datos
function db_select_data ($data, $table, $join, $where, $dbConn) {
	
	// Se hace consulta
	$query = "SELECT ".$data."
	FROM `".$table."`
	".$join."
	WHERE ".$where;
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//variables
		$Transaccion = 'Helpers.Functions.DataBase.php';

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
										
	}
	$rowData = mysqli_fetch_assoc ($resultado);
	
	//devolver objeto
	return $rowData;
}
/*******************************************************************************************************************/
//Funcion para seleccionar data desde la base de datos
function db_select_nrows ($data, $table, $join, $where, $dbConn) {
	
	// Se hace consulta
	$query = "SELECT ".$data."
	FROM `".$table."`
	".$join."
	WHERE ".$where;
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//variables
		$Transaccion = 'Helpers.Functions.DataBase.php';

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
										
	}
	$ndata_1 = mysqli_num_rows($resultado);
	
	//devolver objeto
	return $ndata_1;
}

?>
