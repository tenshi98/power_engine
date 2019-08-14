<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa1($Latitud, $Longitud, $Titulo, $SubTitulo, $Contenido, $IDGoogle){
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$mapa = '<p>No ha ingresado Una API de Google Maps</p>';
	}else{
		$google = $IDGoogle;
		
		//Si no existe el titulo
		if(!isset($Titulo) OR $Titulo==''){
			$S_titulo = 'Sin Titulo';
		}else{
			$S_titulo = $Titulo;
		}
		
		//Si no existe el subtitulo
		if(!isset($SubTitulo) OR $SubTitulo==''){
			$S_Subtitulo = 'Sin SubTitulo';
		}else{
			$S_Subtitulo = $SubTitulo;
		}
		
		//Si no existe el titulo
		if(!isset($Contenido) OR $Contenido==''){
			$S_contenido = 'Sin Contenido';
		}else{
			$S_contenido = $Contenido;
		}
		
			
		$mapa = '
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
			<script type="text/javascript">
				function initialize() {
					var myLatlng = new google.maps.LatLng('.$Latitud.', '.$Longitud.');
					var mapOptions = {
						zoom: 15,
						scrollwheel: false,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
					
					
					// marker position
					var factory = new google.maps.LatLng('.$Latitud.', '.$Longitud.');

					// InfoWindow content
					var content = 	\'<div id="iw-container">\' +
									\'<div class="iw-title">'.$S_titulo.'</div>\' +
									\'<div class="iw-content">\' +
									\'<div class="iw-subTitle">'.$S_Subtitulo.'</div>\' +
									\'<p>'.$S_contenido.'</p>\' +
									\'</div>\' +
									\'<div class="iw-bottom-gradient"></div>\' +
									\'</div>\';

					// A new Info Window is created and set content
					var infowindow = new google.maps.InfoWindow({
						content: content,
						maxWidth: 350
					});
							   
					// marker options
					var marker = new google.maps.Marker({
						position	: factory,
						map			: map,
						title		: "Direccion",
						animation 	: google.maps.Animation.DROP,
						icon      	: "'.DB_SITE.'/LIB_assets/img/map-icons/1_series_orange.png"
					});

					// This event expects a click on a marker
					// When this event is fired the Info Window is opened.
					google.maps.event.addListener(marker, \'click\', function() {
						infowindow.open(map,marker);
					});

					// Event that closes the Info Window with a click on the map
					google.maps.event.addListener(map, \'click\', function() {
						infowindow.close();
					});

					// *
					// START INFOWINDOW CUSTOMIZE.
					// The google.maps.event.addListener() event expects
					// the creation of the infowindow HTML structure \'domready\'
					// and before the opening of the infowindow, defined styles are applied.
					// *
					google.maps.event.addListener(infowindow, \'domready\', function() {

						// Reference to the DIV that wraps the bottom of infowindow
						var iwOuter = $(\'.gm-style-iw\');

						/* Since this div is in a position prior to .gm-div style-iw.
						* We use jQuery and create a iwBackground variable,
						* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
						*/
						var iwBackground = iwOuter.prev();

						// Removes background shadow DIV
						iwBackground.children(\':nth-child(2)\').css({\'display\' : \'none\'});

						// Removes white background DIV
						iwBackground.children(\':nth-child(4)\').css({\'display\' : \'none\'});

						// Moves the infowindow 25px to the right.
						//iwOuter.parent().parent().css({left: \'5px\'});

						// Moves the shadow of the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(1)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Moves the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(3)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Changes the desired tail shadow color.
						iwBackground.children(\':nth-child(3)\').find(\'div\').children().css({\'box-shadow\': \'rgba(72, 181, 233, 0.6) 0px 1px 6px\', \'z-index\' : \'1\'});

						// Reference to the div that groups the close button elements.
						var iwCloseBtn = iwOuter.next();

						// Apply the desired effect to the close button
						iwCloseBtn.css({width: \'28px\',height: \'28px\', opacity: \'1\', right: \'38px\', top: \'3px\', border: \'7px solid #48b5e9\', \'border-radius\': \'13px\', \'box-shadow\': \'0 0 5px #3990B9\'});

						// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
						if($(\'.iw-content\').height() < 140){
							$(\'.iw-bottom-gradient\').css({display: \'none\'});
						}

						// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
						iwCloseBtn.mouseout(function(){
							$(this).css({opacity: \'1\'});
						});
					});
							
					//muestro la infowindow al inicio
					infowindow.open(map,marker);
							
					
				}  
			</script>
			<div id="map_canvas" style="width:100%; height:500px">
				<script type="text/javascript">initialize();</script>
			</div>
		';	
		
	}
	
	

	return $mapa;
}
/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa2($Ubicacion, $explanation, $IDGoogle){	
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$mapa = '<p>No ha ingresado Una API de Google Maps</p>';
	}else{
		
		//Se limpian los nombres
		$Ubicacion = str_replace('Nº', '', $Ubicacion);
		$Ubicacion = str_replace('nº', '', $Ubicacion);
		$Ubicacion = str_replace(' n ', '', $Ubicacion);
		
		$Ubicacion = str_replace("'", '', $Ubicacion);
		
		$Ubicacion = str_replace("Av.", 'Avenida', $Ubicacion);
		$Ubicacion = str_replace("av.", 'Avenida', $Ubicacion);
		
		$google = $IDGoogle;
		
		
		//Verifico si lleva datos extras
		if(isset($explanation)&&$explanation!=''&&$explanation!=0){
			$datasig = $explanation;
		}else{
			$datasig = $Ubicacion;
		}



		$mapa = '
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
			<script type="text/javascript">

				var geocoder = new google.maps.Geocoder();
				var map;
				var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
				
				var _infoBox;
						
				function initialize() {

					var mapOptions = {
						zoom: 15,
						center: myLatlng,
						disableDefaultUI: false
					}
					map = new google.maps.Map(document.getElementById(\'map_canvas\'), mapOptions);
				}

				function codeAddress() {
						  
					geocoder.geocode( { \'address\': \''.$Ubicacion.'\'}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							
							// marker position
							var factory = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());

							// InfoWindow content
							var content = 	\'<div id="iw-container">\' +
											\'<div class="iw-title">Direccion</div>\' +
											\'<div class="iw-content">\' +
											\'<div class="iw-subTitle">Calle</div>\' +
											\'<p>'.$datasig.'</p>\' +
											\'</div>\' +
											\'<div class="iw-bottom-gradient"></div>\' +
											\'</div>\';

							// A new Info Window is created and set content
							var infowindow = new google.maps.InfoWindow({
								content: content,
								maxWidth: 350
							});
							   
							// marker options
							var marker = new google.maps.Marker({
								position	: factory,
								map			: map,
								title		: "Direccion",
								animation 	: google.maps.Animation.DROP,
								icon      	: "'.DB_SITE.'/LIB_assets/img/map-icons/1_series_orange.png"
							});

							// This event expects a click on a marker
							// When this event is fired the Info Window is opened.
							google.maps.event.addListener(marker, \'click\', function() {
								infowindow.open(map,marker);
							});

							// Event that closes the Info Window with a click on the map
							google.maps.event.addListener(map, \'click\', function() {
								infowindow.close();
							});

							// *
							// START INFOWINDOW CUSTOMIZE.
							// The google.maps.event.addListener() event expects
							// the creation of the infowindow HTML structure \'domready\'
							// and before the opening of the infowindow, defined styles are applied.
							// *
							google.maps.event.addListener(infowindow, \'domready\', function() {

								// Reference to the DIV that wraps the bottom of infowindow
								var iwOuter = $(\'.gm-style-iw\');

								/* Since this div is in a position prior to .gm-div style-iw.
								* We use jQuery and create a iwBackground variable,
								* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
								*/
								var iwBackground = iwOuter.prev();

								// Removes background shadow DIV
								iwBackground.children(\':nth-child(2)\').css({\'display\' : \'none\'});

								// Removes white background DIV
								iwBackground.children(\':nth-child(4)\').css({\'display\' : \'none\'});

								// Moves the infowindow 25px to the right.
								//iwOuter.parent().parent().css({left: \'5px\'});

								// Moves the shadow of the arrow 76px to the left margin.
								iwBackground.children(\':nth-child(1)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

								// Moves the arrow 76px to the left margin.
								iwBackground.children(\':nth-child(3)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

								// Changes the desired tail shadow color.
								iwBackground.children(\':nth-child(3)\').find(\'div\').children().css({\'box-shadow\': \'rgba(72, 181, 233, 0.6) 0px 1px 6px\', \'z-index\' : \'1\'});

								// Reference to the div that groups the close button elements.
								var iwCloseBtn = iwOuter.next();

								// Apply the desired effect to the close button
								iwCloseBtn.css({width: \'28px\',height: \'28px\', opacity: \'1\', right: \'38px\', top: \'3px\', border: \'7px solid #48b5e9\', \'border-radius\': \'13px\', \'box-shadow\': \'0 0 5px #3990B9\'});

								// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
								if($(\'.iw-content\').height() < 140){
									$(\'.iw-bottom-gradient\').css({display: \'none\'});
								}

								// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
								iwCloseBtn.mouseout(function(){
									$(this).css({opacity: \'1\'});
								});
							});
							
							//muestro la infowindow al inicio
							infowindow.open(map,marker);

											  
						} else {
							alert(\'Geocode was not successful for the following reason: \' + status);
						}
					});
				}
				

			</script>
			<div id="map_canvas" style="width:100%; height:500px">
				<script type="text/javascript">initialize();codeAddress();</script>
			</div>';
	}

	return $mapa;
}
/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa3($Ubicacion_1, $explanation_1,$Ubicacion_2, $explanation_2, $IDGoogle, $identificador){	
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$mapa = '<p>No ha ingresado Una API de Google Maps</p>';
	}else{
		//Se limpian los nombres
		$Ubicacion_1 = str_replace('Nº', '', $Ubicacion_1);
		$Ubicacion_1 = str_replace('nº', '', $Ubicacion_1);
		$Ubicacion_1 = str_replace(' n ', '', $Ubicacion_1);
		
		$Ubicacion_1 = str_replace("'", '', $Ubicacion_1);
		
		$Ubicacion_1 = str_replace("Av.", 'Avenida', $Ubicacion_1);
		$Ubicacion_1 = str_replace("av.", 'Avenida', $Ubicacion_1);
		/****/
		$Ubicacion_2 = str_replace('Nº', '', $Ubicacion_2);
		$Ubicacion_2 = str_replace('nº', '', $Ubicacion_2);
		$Ubicacion_2 = str_replace(' n ', '', $Ubicacion_2);
		
		$Ubicacion_2 = str_replace("'", '', $Ubicacion_2);
		
		$Ubicacion_2 = str_replace("Av.", 'Avenida', $Ubicacion_2);
		$Ubicacion_2 = str_replace("av.", 'Avenida', $Ubicacion_2);
		
		
		$google = $IDGoogle;
		
		
		//Verifico si lleva datos extras
		if(isset($explanation_1)&&$explanation_1!=''&&$explanation_1!=0){
			$datasig_1 = $explanation_1;
		}else{
			$datasig_1 = $Ubicacion_1;
		}
		/*****/
		//Verifico si lleva datos extras
		if(isset($explanation_2)&&$explanation_2!=''&&$explanation_2!=0){
			$datasig_2 = $explanation_2;
		}else{
			$datasig_2 = $Ubicacion_2;
		}



		$mapa = '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
		<script type="text/javascript">

		var geocoder;
		var map_'.$identificador.';
		
		var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
		
		function initialize_'.$identificador.'() {
		  geocoder = new google.maps.Geocoder();
		  var mapOptions = {
			zoom: 15,
			center: myLatlng
		  }
		  map_'.$identificador.' = new google.maps.Map(document.getElementById(\''.$identificador.'\'), mapOptions);
		}

		function codeAddress_'.$identificador.'() {
			bounds  = new google.maps.LatLngBounds();
			
			geocoder.geocode( { \'address\': \''.$Ubicacion_1.'\'}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					
					// marker position
					var factory_1 = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());

					// InfoWindow content
					var content = 	\'<div id="iw-container">\' +
									\'<div class="iw-title">Direccion</div>\' +
									\'<div class="iw-content">\' +
									\'<div class="iw-subTitle">Calle</div>\' +
									\'<p>'.$datasig_1.'</p>\' +
									\'</div>\' +
									\'<div class="iw-bottom-gradient"></div>\' +
									\'</div>\';

					// A new Info Window is created and set content
					var infowindow = new google.maps.InfoWindow({
						content: content,
						maxWidth: 350
					});
						   
					// marker options
					var marker_1 = new google.maps.Marker({
						position	: factory_1,
						map			: map_'.$identificador.',
						title		: "Direccion",
						animation 	: google.maps.Animation.DROP,
						icon      	: "'.DB_SITE.'/LIB_assets/img/map-icons/1_series_orange.png"
					});

					// This event expects a click on a marker_1
					// When this event is fired the Info Window is opened.
					google.maps.event.addListener(marker_1, \'click\', function() {
						infowindow.open(map_'.$identificador.',marker_1);
					});

					// Event that closes the Info Window with a click on the map
					google.maps.event.addListener(map, \'click\', function() {
						infowindow.close();
					});

					// *
					// START INFOWINDOW CUSTOMIZE.
					// The google.maps.event.addListener() event expects
					// the creation of the infowindow HTML structure \'domready\'
					// and before the opening of the infowindow, defined styles are applied.
					// *
					google.maps.event.addListener(infowindow, \'domready\', function() {

						// Reference to the DIV that wraps the bottom of infowindow
						var iwOuter = $(\'.gm-style-iw\');

						/* Since this div is in a position prior to .gm-div style-iw.
						* We use jQuery and create a iwBackground variable,
						* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
						*/
						var iwBackground = iwOuter.prev();

						// Removes background shadow DIV
						iwBackground.children(\':nth-child(2)\').css({\'display\' : \'none\'});

						// Removes white background DIV
						iwBackground.children(\':nth-child(4)\').css({\'display\' : \'none\'});

						// Moves the infowindow 25px to the right.
						//iwOuter.parent().parent().css({left: \'5px\'});

						// Moves the shadow of the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(1)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Moves the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(3)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Changes the desired tail shadow color.
						iwBackground.children(\':nth-child(3)\').find(\'div\').children().css({\'box-shadow\': \'rgba(72, 181, 233, 0.6) 0px 1px 6px\', \'z-index\' : \'1\'});

						// Reference to the div that groups the close button elements.
						var iwCloseBtn = iwOuter.next();

						// Apply the desired effect to the close button
						iwCloseBtn.css({width: \'28px\',height: \'28px\', opacity: \'1\', right: \'38px\', top: \'3px\', border: \'7px solid #48b5e9\', \'border-radius\': \'13px\', \'box-shadow\': \'0 0 5px #3990B9\'});

						// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
						if($(\'.iw-content\').height() < 140){
							$(\'.iw-bottom-gradient\').css({display: \'none\'});
						}

						// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
						iwCloseBtn.mouseout(function(){
							$(this).css({opacity: \'1\'});
						});
					});
						
					//muestro la infowindow al inicio
					infowindow.open(map_'.$identificador.',marker_1);
						
						
						
					/*var marker_1 = new google.maps.Marker({
								  position:  new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()),
								  map: map_'.$identificador.',
								  title:"Marcador"

							  });
					var infowindow = new google.maps.InfoWindow({
						content: "'.$datasig_1.'"
					});
					marker_1.addListener(\'click\', function() {
						infowindow.open(map_'.$identificador.', marker_1);
					});
					infowindow.open(map_'.$identificador.', marker_1);*/
					
					
					loc = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
					bounds.extend(loc);
					  
				} else {
					alert(\'Geocode was not successful for the following reason: \' + status);
				}
			});
			
			geocoder.geocode( { \'address\': \''.$Ubicacion_2.'\'}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					
					// marker position
					var factory_2 = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());

					// InfoWindow content
					var content = 	\'<div id="iw-container">\' +
									\'<div class="iw-title">Direccion</div>\' +
									\'<div class="iw-content">\' +
									\'<div class="iw-subTitle">Calle</div>\' +
									\'<p>'.$datasig_2.'</p>\' +
									\'</div>\' +
									\'<div class="iw-bottom-gradient"></div>\' +
									\'</div>\';

					// A new Info Window is created and set content
					var infowindow = new google.maps.InfoWindow({
						content: content,
						maxWidth: 350
					});
						   
					// marker options
					var marker_2 = new google.maps.Marker({
						position	: factory_2,
						map			: map_'.$identificador.',
						title		: "Direccion",
						animation 	: google.maps.Animation.DROP,
						icon      	: "'.DB_SITE.'/LIB_assets/img/map-icons/1_series_green.png"
					});

					// This event expects a click on a marker_2
					// When this event is fired the Info Window is opened.
					google.maps.event.addListener(marker_2, \'click\', function() {
						infowindow.open(map_'.$identificador.',marker_2);
					});

					// Event that closes the Info Window with a click on the map
					google.maps.event.addListener(map, \'click\', function() {
						infowindow.close();
					});

					// *
					// START INFOWINDOW CUSTOMIZE.
					// The google.maps.event.addListener() event expects
					// the creation of the infowindow HTML structure \'domready\'
					// and before the opening of the infowindow, defined styles are applied.
					// *
					google.maps.event.addListener(infowindow, \'domready\', function() {

						// Reference to the DIV that wraps the bottom of infowindow
						var iwOuter = $(\'.gm-style-iw\');

						/* Since this div is in a position prior to .gm-div style-iw.
						* We use jQuery and create a iwBackground variable,
						* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
						*/
						var iwBackground = iwOuter.prev();

						// Removes background shadow DIV
						iwBackground.children(\':nth-child(2)\').css({\'display\' : \'none\'});

						// Removes white background DIV
						iwBackground.children(\':nth-child(4)\').css({\'display\' : \'none\'});

						// Moves the infowindow 25px to the right.
						//iwOuter.parent().parent().css({left: \'5px\'});

						// Moves the shadow of the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(1)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Moves the arrow 76px to the left margin.
						iwBackground.children(\':nth-child(3)\').attr(\'style\', function(i,s){ return s + \'left: 6px !important;\'});

						// Changes the desired tail shadow color.
						iwBackground.children(\':nth-child(3)\').find(\'div\').children().css({\'box-shadow\': \'rgba(72, 181, 233, 0.6) 0px 1px 6px\', \'z-index\' : \'1\'});

						// Reference to the div that groups the close button elements.
						var iwCloseBtn = iwOuter.next();

						// Apply the desired effect to the close button
						iwCloseBtn.css({width: \'28px\',height: \'28px\', opacity: \'1\', right: \'38px\', top: \'3px\', border: \'7px solid #48b5e9\', \'border-radius\': \'13px\', \'box-shadow\': \'0 0 5px #3990B9\'});

						// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
						if($(\'.iw-content\').height() < 140){
							$(\'.iw-bottom-gradient\').css({display: \'none\'});
						}

						// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
						iwCloseBtn.mouseout(function(){
							$(this).css({opacity: \'1\'});
						});
					});
						
					//muestro la infowindow al inicio
					infowindow.open(map_'.$identificador.',marker_2);
						
					
					/*var marker_2 = new google.maps.Marker({
								  position:  new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()),
								  map: map_'.$identificador.',
								  title:"Marcador"

							  });
					var infowindow = new google.maps.InfoWindow({
						content: "'.$datasig_2.'"
					});
					marker_2.addListener(\'click\', function() {
						infowindow.open(map_'.$identificador.', marker_2);
					});
					infowindow.open(map_'.$identificador.', marker_2);*/
					
					
					loc = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
					bounds.extend(loc);
					//centralizado y redimensionado del mapa
					map_'.$identificador.'.fitBounds(bounds);      
					map_'.$identificador.'.panToBounds(bounds);
				  
				} else {
					alert(\'Geocode was not successful for the following reason: \' + status);
				}
			});
		}

		</script>
		<div id="'.$identificador.'" style="width:100%; height:500px">
				<script type="text/javascript">initialize_'.$identificador.'();codeAddress_'.$identificador.'();</script>
		</div>';
	}

	return $mapa;
}
/*******************************************************************************************************************/
function preview_pdf($name, $route){

	$input = '
		<div id="'.$name.'"></div>
		<script src="'.DB_SITE.'/LIBS_js/PDFObject/pdfobject.js"></script>
		<script>PDFObject.embed("'.$route.'", "#'.$name.'");</script>
		<style>
			.pdfobject-container { height: 500px;}
			.pdfobject { border: 1px solid #666; }
		</style>';
	

	return $input;

}
/*******************************************************************************************************************/
function preview_docs($folder_path, $file_name){
	
	$num_files     = glob($folder_path.$file_name.".{JPG,jpg,jpeg,gif,png,bmp,doc,docx,xls,xlsx,ppt,pptx,odt,odp,ods,pdf}", GLOB_BRACE);
	$folder        = opendir($folder_path);

	$input = '
	<style>
		iframe, img {
			width: 100%;
			height: 100%;
			padding: 0;
			margin: 0;
		}
		iframe{
			float:right;
			height: 600px;
		}
	</style>';
	
	//Si existen rchivos
	if($num_files > 0){
		
		$path = $folder_path.'/'.$file_name;
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		
		/**************************************************/
		//Si son imagenes
		if($ext=='jpg' || $ext =='jpeg' || $ext == 'gif' || $ext =='png' || $ext == 'bmp') {
			$input .= '<img src="'.$path.'" />';    
		}
		/**************************************************/
		//Si son archivos microsoft office
		if($ext=='doc' || $ext =='docx' || $ext == 'xls' || $ext =='xlsx' || $ext == 'ppt' || $ext =='pptx') {
			$input .= '
			<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.DB_SITE.'/'.DB_EMPRESA_PATH.'/'.$path.'" frameborder="0">
				<a target="_blank" href="'.DB_SITE.'/'.DB_EMPRESA_PATH.'/'.$path.'">Descargar Documento</a>
			</iframe>';
		}
		/**************************************************/
		//Si son archivos open office
		if($ext=='odt' || $ext =='odp' || $ext == 'ods' || $ext == 'pdf') {
			$input .= '<iframe src = "'.DB_SITE.'/LIBS_js/ViewerJS/#../../'.DB_EMPRESA_PATH.'/'.$path.'" allowfullscreen webkitallowfullscreen></iframe>';
		}
		/**************************************************/
		//Si son archivos de audio
		if($ext=='mp3') {
			$input .= '
				<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/audio_player/css/style.css">
				<div class="audio green-audio-player">
					<div class="loading">
						<div class="spinner"></div>
					</div>
					<div class="play-pause-btn">  
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
							<path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"/>
						</svg>
					</div>
					  
					<div class="controls">
						<span class="current-time">0:00</span>
						<div class="slider" data-direction="horizontal">
							<div class="progress">
								<div class="pin" id="progress-pin" data-method="rewind"></div>
							</div>
						</div>
						<span class="total-time">0:00</span>
					</div>
					  
					<div class="volume">
						<div class="volume-btn">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<path fill="#566574" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" id="speaker"/>
							</svg>
						</div>
						<div class="volume-controls hidden">
							<div class="slider" data-direction="vertical">
								<div class="progress">
									<div class="pin" id="volume-pin" data-method="changeVolume"></div>
								</div>
							</div>
						</div>
					</div>
					  
					<audio crossorigin>
						<source src="'.$path.'">
					</audio>
				</div>
				<script src="'.DB_SITE.'/LIBS_js/audio_player/js/index.js"></script>        
			';
		}
		/**************************************************/
		//Si son archivos de video
		if($ext=='mp4' || $ext =='webm' || $ext == 'ogv' ) {
			$input .= '
			
				<link href="'.DB_SITE.'/LIBS_js/video_player/video-js.min.css" rel="stylesheet">
				<script src="'.DB_SITE.'/LIBS_js/video_player/ie8/videojs-ie8.min.js"></script>
				<script src="'.DB_SITE.'/LIBS_js/video_player/video.min.js"></script>
				<style>
				.video-js .vjs-big-play-button {
					visibility: hidden !important;
				}
				
				</style>
				
				<video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="'.DB_SITE.'/Legacy/gestion_modular/img/video-thumbnail.png" data-setup="{}">';
					switch ($ext) {
						case 'mp4':
							$input .= '<source src="'.$path.'" type="video/mp4">';
							break;
						case 'webm':
							$input .= '<source src="'.$path.'" type="video/webm">';
							break;
						case 'ogv':
							$input .= '<source src="'.$path.'" type="video/ogg">';
							break;
					}
					$input .= '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
				</video>

			';
		}
		
	}else{
		$input = '<p>No existe documento o no esta soportado</p>';
	}
	
	return $input;

}


?>
