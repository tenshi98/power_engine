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
//solo si es administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	//Se guarda la memoria final del sistema
	$sis_mem_fin = memory_get_usage();

	//Obtengo la memoria del sistema
	$memUsage = obtenerUsoMemoriaServidor(false);
	//Calculos
	$total_memory   = $memUsage["total"];
	$server_memory  = $memUsage["total"] - $memUsage["free"];
	$actual_memory  = ($sis_mem_fin - $sis_mem_ini)*1024;
	
	//obtengo la ip del servidor
	$serverIP = $_SERVER["SERVER_ADDR"];
	
	//Archivos
	$Archivo1 = '1_logs_hacking.txt';
	$Archivo2 = '1_logs_send_mail.txt';
	$Archivo3 = '1_logs_error_log_php.txt';
	
	echo '
	<div style="background: #fff;">
                  
        <div class="col-md-9 col-sm-12">';
			
			//Errores PHP
			if (file_exists($Archivo3)) {
				echo '<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">'; 
					echo '<h4>Errores PHP</h4>';
					echo '<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Fecha</th>
										<th>Hora</th>
										<th>Usuario</th>
										<th>Transaccion</th>
										<th>Tarea</th>
										<th>ErrorCode</th>
										<th>Mensaje</th>
										<th>Consulta</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">';
									//se trata de guardar el archivo
									try {
										$myfile = fopen($Archivo3, "r") or die("Unable to open file!");
										while(!feof($myfile)) {
											echo '<tr class="odd">';
											//separo lo que obtengo
											$INT_piezas = explode(" /\ ", fgets($myfile));
											//recorro los elementos
											foreach ($INT_piezas as $INT_valor) {
												echo '<td>'.$INT_valor.'</td>';
											}
											echo '</tr>';
										}
										fclose($myfile);
									} catch (Exception $e) {
										error_log("Ha ocurrido un error (".$e->getMessage().")", 0);
									}
									echo '						  
								</tbody>
							</table>
						</div>'; 
				echo '</div>'; 
			}else{
				error_log("No existe el archivo (".$Archivo3.")", 0);
			}
			
            //intentos de Hackeo
			if (file_exists($Archivo1)) {
				echo '<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">'; 
					echo '<h4>Intentos de Hackeo</h4>';
					echo '<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>IP Client</th>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Empresa</th>
										<th>Sistema Operativo</th>
										<th>Navegador</th>
										<th>Usuario</th>
										<th>Archivo</th>
										<th>Tarea</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">';
									//se trata de guardar el archivo
									try {
										$myfile = fopen($Archivo1, "r") or die("Unable to open file!");
										while(!feof($myfile)) {
											echo '<tr class="odd">';
											//separo lo que obtengo
											$INT_piezas = explode(" - ", fgets($myfile));
											//recorro los elementos
											foreach ($INT_piezas as $INT_valor) {
												echo '<td>'.$INT_valor.'</td>';
											}
											echo '</tr>';
										}
										fclose($myfile);
									} catch (Exception $e) {
										error_log("Ha ocurrido un error (".$e->getMessage().")", 0);
									}					  
								echo '</tbody>
							</table>
						</div>';
				echo '</div>';
			}else{
				error_log("No existe el archivo (".$Archivo1.")", 0);
			}
				
			//Correos Enviados
			/*if (file_exists($Archivo2)) {
				echo '<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">'; 
					echo '<h4>Correos Enviados</h4>';
					
				echo '</div>';
			}else{
				error_log("No existe el archivo (".$Archivo2.")", 0);
			}*/
			
			
			
			
			//Errores
            echo '<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">'; 
				echo '<h4>Errores detectados</h4>';
				require_once 'Helpers.Utils.Result.Errors.php';
			echo '</div>';
			
			
			           
        echo '</div>
 
        <div class="col-md-3 col-sm-6">
            <div class="info-box-main">
				
				<div class="info-box-box">
					<div class="info-stats">
						<p>Carga del Sistema</p>
						<span>'.getNiceFileSize($actual_memory, false).' / '.getNiceFileSize($total_memory, false).'</span>
					</div>
					<div class="info-icon text-danger"><i class="fa fa-server" aria-hidden="true"></i></div>
					<div class="info-box-progress">
						<div class="progress">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: '.Cantidades((($actual_memory/$total_memory)*100), 0).'%;"></div>
						</div>
					</div>
				</div>
				
                <div class="info-box-box">
					<div class="info-stats">
						<p>Carga del Servidor</p>
						<span>'.getNiceFileSize($server_memory, false).' / '.getNiceFileSize($total_memory, false).'</span>
					</div>
					<div class="info-icon text-danger"><i class="fa fa-server" aria-hidden="true"></i></div>
					<div class="info-box-progress">
						<div class="progress">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: '.Cantidades((($server_memory/$total_memory)*100), 0).'%;"></div>
						</div>
					</div>
                </div>
                
            </div>
            
            <div class="info-box-main">
                <div class="info-stats">
                    <p>Server IP</p>
                    <span>'.$serverIP.'</span>
                </div>
            </div>
            
        </div>

        <div class="clearfix"></div>        
    </div>';

//para el resto	
}else{
	//se envian correos
	require_once 'Helpers.Utils.Result.Errors.php';
}





//Se verifica el tipo de usuario
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ 

	

	?>

	

<?php }
?>
