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
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Conectar Base de Datos
* 
*===========================     Detalles    ===========================
* Funcion para conectarse a la base de datos, devuelve un puntero con 
* el cual trabajar, utiliza constantes internas del Server
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	conectar ();
* 
*===========================    Parametros   ===========================
* Constantes  DB_SERVER  Ubicacion o direccion web donde se ubica la base de datos
* Constantes  DB_USER    Usuario de acceso a la BD
* Constantes  DB_PASS    Contraseña de acceso a la BD
* Constantes  DB_NAME    Nombre de la BD
* @return  db_con
************************************************************************/
//Funcion
function conectar () {
	$db_con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$db_con->set_charset("utf8");
	return $db_con; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Seleccionar datos
* 
*===========================     Detalles    ===========================
* Funcion para seleccionar informacion desde la base de datos
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	db_select_data(false, 'tabla1.columnaA1,tabla2.columnaB1','tabla1','LEFT JOIN tabla2 ON tabla2.id = tabla1.id','tabla1.id=1',$dbConn, 'usuario', 'transaccion.php', 'insert');
* 
*===========================    Parametros   ===========================
* String   $showQuery      Muestra la consulta que se esta tratando de ejecutar
* String   $data           Columnas seleccionadas en la consulta
* String   $table          Tabla desde donde traer los datos
* String   $join           Concatenaciones con otras tablas
* String   $where          Definicion del dato a traer
* db_con   $dbConn         Puntero Conexion a la base de datos
* String   $Usuario        Definicion del usuario que ejecuta la accion
* String   $Transaccion    Definicion de la transaccion donde se ejecuta
* String   $Tarea          Definicion de la tarea donde se ejecuta
* @return  Object
************************************************************************/
//Funcion
function db_select_data ($showQuery, $data, $table, $join, $where, $dbConn, $Usuario, $Transaccion, $Tarea) {
	
	// Se hace consulta
	$query = 'SELECT '.$data.' FROM `'.$table.'` '.$join.' WHERE '.$where.' LIMIT 1';
	//si estoy pidiendo mostrar la query
	if($showQuery==true){
		echo '<pre>';
			var_dump($query);
		echo '</pre>';
	}else{
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			//si hay respuesta se devuelven los resultados
			$rowData = mysqli_fetch_assoc ($resultado);
		
			//devolver objeto
			return $rowData;
					
		//si da error, guardar en el log de errores una copia
		}else{
			
			//Verifico el entorno
			if(getEntorno()==true){
				echo '<pre>';
					echo 'mysqli_errno: '.mysqli_errno($dbConn).'<br/>';
					echo 'mysqli_error: '.mysqli_error($dbConn).'<br/>';
					var_dump($query);
				echo '</pre>';
			}else{
				//generar log
				php_error_log($Usuario, $Transaccion, $Tarea, mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			}
			
			//devuelvo error
			return false;
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Contar datos
* 
*===========================     Detalles    ===========================
* Funcion para contar data desde la base de datos
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	db_select_nrows(false, 'tabla1.columnaA1,tabla2.columnaB1','tabla1','LEFT JOIN tabla2 ON tabla2.id = tabla1.id','tabla1.id=1',$dbConn, 'usuario', 'transaccion.php', 'insert');
* 
*===========================    Parametros   ===========================
* String   $showQuery      Muestra la consulta que se esta tratando de ejecutar
* String   $data           Columnas seleccionadas en la consulta
* String   $table          Tabla desde donde traer los datos
* String   $join           Concatenaciones con otras tablas
* String   $where          Definicion del dato a traer
* db_con   $dbConn         Conexion a la base de datos
* String   $Usuario        Definicion del usuario que ejecuta la accion
* String   $Transaccion    Definicion de la transaccion donde se ejecuta
* String   $Tarea          Definicion de la tarea donde se ejecuta
* @return  Integer
************************************************************************/
//Funcion
function db_select_nrows ($showQuery, $data, $table, $join, $where, $dbConn, $Usuario, $Transaccion, $Tarea) {
	
	// Se hace consulta
	$query = 'SELECT '.$data.' FROM `'.$table.'` '.$join.' WHERE '.$where;
	//si estoy pidiendo mostrar la query
	if($showQuery==true){
		echo '<pre>';
			var_dump($query);
		echo '</pre>';
	}else{
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			//obtengo el numero de filas de la seleccion
			$ndata_1 = mysqli_num_rows($resultado);
		
			//devolver objeto
			return $ndata_1;
					
		//si da error, guardar en el log de errores una copia
		}else{
			
			//Verifico el entorno
			if(getEntorno()==true){
				echo '<pre>';
					echo 'mysqli_errno: '.mysqli_errno($dbConn).'<br/>';
					echo 'mysqli_error: '.mysqli_error($dbConn).'<br/>';
					var_dump($query);
				echo '</pre>';
			}else{
				//generar log
				php_error_log($Usuario, $Transaccion, $Tarea, mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			}
			
			//devuelvo error
			return false;
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Eliminar datos
* 
*===========================     Detalles    ===========================
* Funcion para eliminar informacion en la base de datos
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	db_delete_data(false, 'tabla1','tabla1.id=1',$dbConn, 'usuario', 'transaccion.php', 'insert');
* 
*===========================    Parametros   ===========================
* String   $showQuery      Muestra la consulta que se esta tratando de ejecutar
* String   $table          Tabla desde donde borrar los datos
* String   $where          Definicion del dato a borrar
* db_con   $dbConn         Puntero Conexion a la base de datos
* String   $Usuario        Definicion del usuario que ejecuta la accion
* String   $Transaccion    Definicion de la transaccion donde se ejecuta
* String   $Tarea          Definicion de la tarea donde se ejecuta
* @return  Object
************************************************************************/
//Funcion
function db_delete_data($showQuery, $table, $where, $dbConn, $Usuario, $Transaccion, $Tarea) {
	
	//se borran los datos
	$query  = 'DELETE FROM `'.$table.'` WHERE '.$where;
	//si estoy pidiendo mostrar la query
	if($showQuery==true){
		echo '<pre>';
			var_dump($query);
		echo '</pre>';
	}else{
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			//devuelvo ok		
			return true;
					
		//si da error, guardar en el log de errores una copia
		}else{
			
			//Verifico el entorno
			if(getEntorno()==true){
				echo '<pre>';
					echo 'mysqli_errno: '.mysqli_errno($dbConn).'<br/>';
					echo 'mysqli_error: '.mysqli_error($dbConn).'<br/>';
					var_dump($query);
				echo '</pre>';
			}else{
				//generar log
				php_error_log($Usuario, $Transaccion, $Tarea, mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			}
			
			//devuelvo error
			return false;
		}
	}
	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Actualizar Datos
* 
*===========================     Detalles    ===========================
* Funcion para actualizar data en la base de datos
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	db_update_data(false, 'column=""','tabla1','id=1',$dbConn, 'usuario', 'transaccion.php', 'insert');
* 
*===========================    Parametros   ===========================
* String   $showQuery      Muestra la consulta que se esta tratando de ejecutar
* String   $data           Columnas actualizadas en la consulta
* String   $table          Tabla desde donde actualizar los datos
* String   $where          Definicion del dato a actualizar
* db_con   $dbConn         Conexion a la base de datos
* String   $Usuario        Definicion del usuario que ejecuta la accion
* String   $Transaccion    Definicion de la transaccion donde se ejecuta
* String   $Tarea          Definicion de la tarea donde se ejecuta
* @return  Integer
************************************************************************/
//Funcion
function db_update_data ($showQuery, $data, $table, $where, $dbConn, $Usuario, $Transaccion, $Tarea) {
	
	// Se actualizan los datos
	$query  = 'UPDATE `'.$table.'` SET '.$data.' WHERE '.$where;
	//si estoy pidiendo mostrar la query
	if($showQuery==true){
		echo '<pre>';
			var_dump($query);
		echo '</pre>';
	}else{
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			//devuelvo ok		
			return true;
					
		//si da error, guardar en el log de errores una copia
		}else{
			
			//Verifico el entorno
			if(getEntorno()==true){
				echo '<pre>';
					echo 'mysqli_errno: '.mysqli_errno($dbConn).'<br/>';
					echo 'mysqli_error: '.mysqli_error($dbConn).'<br/>';
					var_dump($query);
				echo '</pre>';
			}else{
				//generar log
				php_error_log($Usuario, $Transaccion, $Tarea, mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			}
			
			//devuelvo error
			return false;
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************
* Seleccionar array de datos
* 
*===========================     Detalles    ===========================
* Funcion para seleccionar informacion desde la base de datos
*===========================    Modo de uso  ===========================
* 	
* 	//se ejecuta codigo
* 	db_select_array(false, 'tabla1.columnaA1,tabla2.columnaB1','tabla1','LEFT JOIN tabla2 ON tabla2.id = tabla1.id','tabla1.id=1',$dbConn, 'usuario', 'transaccion.php', 'insert');
* 
*===========================    Parametros   ===========================
* String   $showQuery      Muestra la consulta que se esta tratando de ejecutar
* String   $data           Columnas seleccionadas en la consulta
* String   $table          Tabla desde donde traer los datos
* String   $join           Concatenaciones con otras tablas
* String   $where          Definicion del dato a traer
* db_con   $dbConn         Puntero Conexion a la base de datos
* String   $Usuario        Definicion del usuario que ejecuta la accion
* String   $Transaccion    Definicion de la transaccion donde se ejecuta
* String   $Tarea          Definicion de la tarea donde se ejecuta
* @return  Object
************************************************************************/
//Funcion
function db_select_array ($showQuery, $data, $table, $join, $filter, $orderby, $dbConn, $Usuario, $Transaccion, $Tarea) {
	
	if (isset($join)&&$join!='0'&&$join!=''){          $joined   = $join;                  }else{$joined   = '';}
	if (isset($filter)&&$filter!='0'&&$filter!=''){    $where    = "WHERE ".$filter;       }else{$where    = '';}
	if (isset($orderby)&&$orderby!='0'&&$orderby!=''){ $order_by = "ORDER BY ".$orderby;   }else{$order_by = '';}
		
	// Se trae un listado con todos los datos
	$arrSelect = array();
	$query = 'SELECT '.$data.' FROM `'.$table.'` '.$joined.' '.$where.' '.$order_by;
	//si estoy pidiendo mostrar la query
	if($showQuery==true){
		echo '<pre>';
			var_dump($query);
		echo '</pre>';
	}else{
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if($resultado){
			//si hay respuesta se devuelven los resultados
			while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSelect,$row );
			}
			//devolver objeto
			return $arrSelect;
					
		//si da error, guardar en el log de errores una copia
		}else{
			
			//Verifico el entorno
			if(getEntorno()==true){
				echo '<pre>';
					echo 'mysqli_errno: '.mysqli_errno($dbConn).'<br/>';
					echo 'mysqli_error: '.mysqli_error($dbConn).'<br/>';
					var_dump($query);
				echo '</pre>';
			}else{
				//generar log
				php_error_log($Usuario, $Transaccion, $Tarea, mysqli_errno($dbConn), mysqli_error($dbConn), $query );
			}
			
			//devuelvo error
			return false;
		}
	}	
	
}
?>
