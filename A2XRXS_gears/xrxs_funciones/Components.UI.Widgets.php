<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
//Despliega un mapa en base a los datos entregados
function mapa_from_gps($Latitud, $Longitud, $Titulo, $SubTitulo, $Contenido, $IDGoogle, $zoom_map, $MapTypeId){
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){	
		$mapa  = '<div class="col-sm-12" style="margin-top:10px;">';
		$mapa .= alert_post_data(4,1,1, 'No ha ingresado Una API de Google Maps.');
		$mapa .= '</div>';
	}else{
		$google = $IDGoogle;
		
		//Si no existe el titulo
		if(!isset($Titulo) OR $Titulo==''){       $S_titulo    = 'Sin Titulo';    }else{ $S_titulo    = $Titulo;}
		//Si no existe el subtitulo
		if(!isset($SubTitulo) OR $SubTitulo==''){ $S_Subtitulo = 'Sin SubTitulo'; }else{ $S_Subtitulo = $SubTitulo;}
		//Si no existe el titulo
		if(!isset($Contenido) OR $Contenido==''){ $S_contenido = 'Sin Contenido'; }else{ $S_contenido = $Contenido;}
		//Si no existe zoom de mapa
		if(!isset($zoom_map) OR $zoom_map=='' OR $zoom_map==0){ $int_map = 18; }else{ $int_map = $zoom_map;}
		//si no existe un tipo de mapa
		if(!isset($MapTypeId) OR $MapTypeId=='' OR $MapTypeId==0){
			$int_map_type = 'ROADMAP';
		}else{
			switch ($MapTypeId) {
				case 1: $int_map_type = 'ROADMAP';   break; //muestra la vista predeterminada del mapa de carreteras. Este es el tipo de mapa predeterminado.
				case 2: $int_map_type = 'SATELLITE'; break;//muestra imágenes de satélite de Google Earth.
				case 3: $int_map_type = 'HYBRID';    break;//muestra una mezcla de vistas normales y de satélite.
				case 4: $int_map_type = 'TERRAIN';   break;//muestra un mapa físico basado en la información del terreno.
			}
		}
		
	
		$mapa = '
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
			<script type="text/javascript">
				function initialize() {
					var myLatlng = new google.maps.LatLng('.$Latitud.', '.$Longitud.');
					var mapOptions = {
						zoom: '.$int_map.',
						scrollwheel: false,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.'.$int_map_type.'
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
						icon      	: "'.DB_SITE_REPO.'/LIB_assets/img/map-icons/1_series_orange.png"
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
function mapa_from_direccion($Ubicacion, $explanation, $IDGoogle, $zoom_map, $MapTypeId){	
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$mapa  = '<div class="col-sm-12" style="margin-top:10px;">';
		$mapa .= alert_post_data(4,1,1, 'No ha ingresado Una API de Google Maps.');
		$mapa .= '</div>';
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
		if(isset($explanation)&&$explanation!=''&&$explanation!=0){ $datasig = $explanation; }else{$datasig = $Ubicacion; }
		//Si no existe zoom de mapa
		if(!isset($zoom_map) OR $zoom_map=='' OR $zoom_map==0){     $int_map = 18;           }else{$int_map = $zoom_map;}
		//si no existe un tipo de mapa
		if(!isset($MapTypeId) OR $MapTypeId=='' OR $MapTypeId==0){
			$int_map_type = 'ROADMAP';
		}else{
			switch ($MapTypeId) {
				case 1: $int_map_type = 'ROADMAP';   break; //muestra la vista predeterminada del mapa de carreteras. Este es el tipo de mapa predeterminado.
				case 2: $int_map_type = 'SATELLITE'; break;//muestra imágenes de satélite de Google Earth.
				case 3: $int_map_type = 'HYBRID';    break;//muestra una mezcla de vistas normales y de satélite.
				case 4: $int_map_type = 'TERRAIN';   break;//muestra un mapa físico basado en la información del terreno.
			}
		}


		$mapa = '
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
			<script type="text/javascript">

				var geocoder = new google.maps.Geocoder();
				var map;
				var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
				
				var _infoBox;
						
				function initialize() {

					var mapOptions = {
						zoom: '.$int_map.',
						scrollwheel: false,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.'.$int_map_type.'
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
								icon      	: "'.DB_SITE_REPO.'/LIB_assets/img/map-icons/1_series_orange.png"
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
function mapa_from_ubicacion_mixta($Ubicacion_1, $explanation_1,$Ubicacion_2, $explanation_2, $IDGoogle, $identificador){	
	
	//Si no existe una ID se envia mensaje
	if(!isset($IDGoogle) OR $IDGoogle==''){
		$mapa  = '<div class="col-sm-12" style="margin-top:10px;">';
		$mapa .= alert_post_data(4,1,1, 'No ha ingresado Una API de Google Maps.');
		$mapa .= '</div>';
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



		$mapa = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key='.$google.'&sensor=false"></script>
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
						icon      	: "'.DB_SITE_REPO.'/LIB_assets/img/map-icons/1_series_orange.png"
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
						icon      	: "'.DB_SITE_REPO.'/LIB_assets/img/map-icons/1_series_green.png"
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
		<script src="'.DB_SITE_REPO.'/LIBS_js/PDFObject/pdfobject.js"></script>
		<script>PDFObject.embed("'.$route.'", "#'.$name.'");</script>
		<style>
			.pdfobject-container { height: 500px;}
			.pdfobject { border: 1px solid #666; }
		</style>';
	

	return $input;

}/*******************************************************************************************************************/
//permite ver un preview de los documentos
function download_docs($file_path, $file, $extensions, $mainSite, $EmpPath){
	
	/****************************************/
	//Definicion de directorio y carpeta contenedora
	$destination_path = '';
	if($mainSite!=''){  $destination_path = $mainSite; }   //directorio raiz
	if($EmpPath!=''){   $destination_path .= $EmpPath;  }  //carpeta contenedora
	
	/****************************************/
	//se verifican las extensiones admitidas
	if($extensions!=''){
		$exten = $extensions;
	}else{
		$exten  = 'JPG,jpg,jpeg,gif,png,bmp';       //Imagenes
		$exten .= ',doc,docx,xls,xlsx,ppt,pptx';    //archivos microsoft office
		$exten .= ',odt,odp,ods';                   //archivos libre office
		$exten .= ',pdf';                           //pdf
		$exten .= ',mp3,oga';                       //Audio
		$exten .= ',mp4,webm,ogv';                  //Video
		$exten .= ',txt';                           //texto plano
			
	}
	
	/****************************************/
	//Se verifica si el archivo dado esta dentro de los permitidos
	$path       = $destination_path.$file_path.'/'.$file;
	$ext        = pathinfo($path, PATHINFO_EXTENSION);
	$num_files  = glob($path.".{".$exten."}", GLOB_BRACE);
	//$Filesize   = filesize($path);
	
	/****************************************/
	//Si existen archivos
	if($num_files > 0){
		//selecciono el tipo mime a partir de la extension
		switch ($ext) {
			case 'JPG':  $aplication = 'image/jpeg'; break;
			case 'jpg':  $aplication = 'image/jpeg'; break;
			case 'jpeg': $aplication = 'image/jpeg'; break;
			case 'gif':  $aplication = 'image/gif'; break;
			case 'png':  $aplication = 'image/png'; break;
			case 'bmp':  $aplication = 'image/bmp'; break;
			case 'doc':  $aplication = 'application/vnd.ms-word'; break;
			case 'docx': $aplication = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'; break;
			case 'xls':  $aplication = 'application/vnd.ms-excel'; break;
			case 'xlsx': $aplication = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; break;
			case 'ppt':  $aplication = 'application/vnd.ms-powerpoint'; break;
			case 'pptx': $aplication = 'application/vnd.openxmlformats-officedocument.presentationml.presentation'; break;
			case 'odt':  $aplication = 'application/vnd.oasis.opendocument.text'; break;
			case 'odp':  $aplication = 'application/vnd.oasis.opendocument.presentation'; break;
			case 'ods':  $aplication = 'application/vnd.oasis.opendocument.spreadsheet'; break;
			case 'pdf':  $aplication = 'application/pdf'; break;
			case 'mp3':  $aplication = 'audio/mpeg'; break;
			case 'webm': $aplication = 'video/webm'; break;
			case 'oga':  $aplication = 'audio/ogg'; break;
			case 'ogv':  $aplication = 'video/ogg'; break;
			case 'txt':  $aplication = 'text/plain'; break;
			
			default:   $aplication = 'application/octet-stream';
							
		}

		//header ("Content-Disposition: attachment; filename=".$file." ");
		//header ("Content-Type: ".$aplication." ");
		//header ("Content-Length: ".$Filesize);
		//readfile($path);
		
		//echo $file.'<br/>';
		//echo $aplication.'<br/>';
		
	
		header ("Content-Disposition: attachment; filename=".$file." ");
		header ("Content-Type: application/octet-stream");
		header ("Content-Length: ".filesize($path));
		readfile($path);

		
	}else{
		$Alert_Text  = 'Tipo de archivo no soportado';
		alert_post_data(4,2,2, $Alert_Text);
	}
	
	
	
	


	
}
/*******************************************************************************************************************/
//permite ver un preview de los documentos
function preview_docs($file_path, $file, $extensions, $mainSite, $EmpPath){
	
	/****************************************/
	//se verifican las extensiones
	if($extensions!=''){
		$exten = $extensions;
	}else{
		$exten  = 'JPG,jpg,jpeg,gif,png,bmp';           //Imagenes
		$exten .= ',doc,docx,xls,xlsx,ppt,pptx';        //archivos microsoft office
		$exten .= ',odt,odp,ods';                       //archivos libre office
		$exten .= ',pdf';                               //pdf
		$exten .= ',mp3,oga,wav';                       //Audio
		$exten .= ',mp4,webm,ogv,mp2,mpeg,mpg,mov,avi'; //Video
		$exten .= ',txt,rtf';                           //texto plano
		$exten .= ',gz,gzip,7Z,zip,rar';                //Archivos Comprimidos

	}
	
	/****************************************/
	//Definicion de directorio y carpeta contenedora
	if($mainSite!=''){  $site     = $mainSite; }else{ $site     = DB_SITE_REPO; }    //directorio raiz
	if($EmpPath!=''){   $emp_path = $EmpPath;  }else{ $emp_path = DB_SITE_MAIN_PATH; } //carpeta contenedora
	
	
	/****************************************/
	//Se verifica si el archivo dado esta dentro de los permitidos
	$path       = $file_path.'/'.$file;
	$ext        = pathinfo($path, PATHINFO_EXTENSION);
	$num_files  = glob($path.".{".$exten."}", GLOB_BRACE);
	

	$input = '
	<style>
		img {width: 100%;height: auto;padding: 0;margin: 0;}
		iframe {width: 100%;height: 100%;padding: 0;margin: 0;}
		iframe{float:right;height: 600px;}
	</style>';
	
	//Si existen archivos
	if($num_files > 0){
		
		switch($ext){
			/**************************************************/
			//Si son imagenes
			case 'JPG'; case 'jpg'; case 'jpeg'; case 'gif'; case 'png'; case 'bmp';
				$input .= '<img src="'.$site.'/'.$emp_path.'/'.$path.'" />';  
			break;
			/**************************************************/
			//Si son archivos microsoft office
			case 'doc'; case 'docx'; case 'xls'; case 'xlsx'; case 'ppt'; case 'pptx';
				$input .= '
				<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.$site.'/'.$emp_path.'/'.$path.'" frameborder="0">
					<a target="_blank" rel="noopener noreferrer" href="'.$site.'/'.$emp_path.'/'.$path.'">Descargar Documento</a>
				</iframe>';
			break;
			/**************************************************/
			//Si son archivos open office y pdf
			case 'odt'; case 'odp'; case 'ods'; case 'pdf';
				$input .= '<iframe src = "'.DB_SITE_REPO.'/LIBS_js/ViewerJS/#../../'.$emp_path.'/'.$path.'" allowfullscreen webkitallowfullscreen></iframe>';
			break;
			/**************************************************/
			//Si son archivos de audio
			case 'mp3';
				$input .= '
				<link rel="stylesheet" type="text/css" href="'.DB_SITE_REPO.'/LIBS_js/audio_player/css/style.css">
				<div class="audio green-audio-player">
					<div class="loading">
						<div class="spinner"></div>
					</div>
					<div class="play-pause-btn">  
						<svg xmlns="https://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
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
							<svg xmlns="https://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
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
						<source src="'.$site.'/'.$emp_path.'/'.$path.'">
					</audio>
				</div>
				<script src="'.DB_SITE_REPO.'/LIBS_js/audio_player/js/index.js"></script>';
			break;
			/**************************************************/
			//Si son archivos de video
			case 'mp4'; case 'webm'; case 'ogv';
				$input .= '
			
				<link href="'.DB_SITE_REPO.'/LIBS_js/video_player/video-js.min.css" rel="stylesheet">
				<script src="'.DB_SITE_REPO.'/LIBS_js/video_player/ie8/videojs-ie8.min.js"></script>
				<script src="'.DB_SITE_REPO.'/LIBS_js/video_player/video.min.js"></script>
				<style>
				.video-js .vjs-big-play-button {
					visibility: hidden !important;
				}
				
				</style>
				
				<video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="'.DB_SITE_REPO.'/Legacy/gestion_modular/img/video-thumbnail.png" data-setup="{}">';
					switch ($ext) {
						case 'mp4':
							$input .= '<source src="'.$site.'/'.$emp_path.'/'.$path.'" type="video/mp4">';
							break;
						case 'webm':
							$input .= '<source src="'.$site.'/'.$emp_path.'/'.$path.'" type="video/webm">';
							break;
						case 'ogv':
							$input .= '<source src="'.$site.'/'.$emp_path.'/'.$path.'" type="video/ogg">';
							break;
					}
					$input .= '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
				</video>';
			break;
			/**************************************************/
			//Si son archivos de texto plano
			case 'txt'; case 'rtf';
				$input = alert_post_data(4,1,1, 'No se pueden previsualizar los archivos de texto '.$ext.', descarguelos presionando  <a href="'.$site.'/'.$emp_path.'/'.$path.'" class="">aqui</a>');
			break;
			/**************************************************/
			//Si son archivos comprimidos
			case 'gz'; case 'gzip'; case '7Z'; case 'zip'; case 'rar';
				$input = alert_post_data(4,1,1, 'No se pueden previsualizar los archivos comprimidos '.$ext.', descarguelos presionando <a href="'.$site.'/'.$emp_path.'/'.$path.'" class="">aqui</a>');
			break;
			/**************************************************/
			//Si son archivos no reproducibles por los reproductores
			case 'mp2'; case 'mpeg'; case 'mpg'; case 'mov'; case 'avi'; case 'oga'; case 'wav';
				$input = alert_post_data(4,1,1, 'No se pueden previsualizar los archivos multimedia '.$ext.', descarguelos presionando <a href="'.$site.'/'.$emp_path.'/'.$path.'" class="">aqui</a>');
			break;
			/**************************************************/
			//excepcion
			default;
				$input = alert_post_data(4,1,1, 'No esta soportada la previsualizacion para los archivos '.$ext.', para descargar el archivo presione <a href="'.$site.'/'.$emp_path.'/'.$path.'" class="">aqui</a>');
			break;
		}
		
	}else{
		if(isset($file_path)&&$file_path!=''&&isset($file)&&$file!=''){
			$input = alert_post_data(4,1,1, 'No esta soportada la previsualizacion, para descargar el archivo presione <a href="'.$site.'/'.$emp_path.'/'.$path.'" class="">aqui</a>');
		}else{
			$input = alert_post_data(4,1,1, 'El Archivo a previsualizar no existe');
		}
	}

	return $input;

}
/*******************************************************************************************************************/
//Muestra las imagenes animadas
function widget_TipoImagen($tipoImagen, $site, $path, $content_folder, $direccion){
	
	//cadena
	$widget = '';
	//se identifica el tipo de imagen								  
	switch ($tipoImagen) {
		//Si no esta configurada
		case 0:
			$widget .= '<img src="'.$content_folder.'/'.$direccion.'" style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture"  >';
			break;
		//Normal
		case 1:
			$widget .= '<img src="'.$content_folder.'/'.$direccion.'" style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture"  >';
			break;
		//Tambor
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		case 10:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/prefixfree/prefixfree.min.js"></script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/drum.js"></script>';
			$widget .= '<script>
					var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";	
					document.getElementById("cover_prod").appendChild(createBarrel(textura));
				</script>';
			$widget .= '<style>#cover_prod {position: relative;perspective: 600px;perspective: 600px;text-align:center;width:100%;height:300px;}#cover_prod .threedee {position: absolute;left: 50%;top: 50%;transform-style: preserve-3d;transform-origin: 50% 50% 50%;backface-visibility: hidden;}#cover_prod .assembly {animation: spincover 30s linear infinite;}@keyframes spincover {to {transform: rotateY(360deg);}}</style>';
			break;
		//Cubo Carton 1x1x1
		case 11:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 10;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 10;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
			break;
		//Cubo Carton 2x1x1
		case 12:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 30;</script>';
			$widget .= '<script>var med_largo = 5;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
			break;
		//Cubo Carton 1x2x1
		case 13:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 5;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
			break;
		//Cubo Carton 2x2x1
		case 14:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 10;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
			break;
		//Cubo Madera 1x1x1
		case 15:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 10;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 10;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
			break;
		//Cubo Madera 2x1x1
		case 16:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 30;</script>';
			$widget .= '<script>var med_largo = 5;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
			break;
		//Cubo Madera 1x2x1
		case 17:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 5;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
			break;
		//Cubo Madera 2x2x1
		case 18:
			$widget .= '<div class="fcenter" id="cover_prod"></div>';
			$widget .= '<script src="'.$site.'/LIBS_js/three_js/three.min.js"></script>';
			$widget .= '<script>var textura = "'.$site.$path.'/'.$content_folder.'/'.$direccion.'";</script>';
			$widget .= '<script>var med_alto  = 10;</script>';
			$widget .= '<script>var med_largo = 10;</script>';
			$widget .= '<script>var med_ancho = 5;</script>';
			$widget .= '<script src="'.$site.'/LIBS_js/3d_cover/cube_normal.js"></script>';
			$widget .= '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
			break;
	}
	//devolver dato
	return $widget;
}
/*******************************************************************************************************************/
//Muestra el cuadro de dialogo
function widget_avgrund(){
	require_once '../LIBS_js/avgrund/avgrund.php';							  	
}
/*******************************************************************************************************************/
//Muestra un explorador de archivos personalizado
function file_explorer($type, $conector, $emp_path, $id_emp, $prm){

	//generacion del input
	$input = '
		<style>
			.iframe_elfinder{height: 700px;}
			iframe{float:right;width: 100%;height: 100%;padding: 0;margin: 0;border:none;}
		</style>
			
		<div class="iframe_elfinder">
			<iframe class="embed-responsive-item" src="'.DB_SITE_REPO.'/LIBS_js/elFinder/index.php?type='.$type.'&conector='.$conector.'&emp_path='.$emp_path.'&id_emp='.$id_emp.'&prm='.$prm.'" allowfullscreen></iframe>
		</div>';
		
	//Imprimir dato	
	return $input;
}
/*******************************************************************************************************************/
//Muestra la ventana modal
function widget_modal($width, $height){
	require_once '../LIBS_js/modal/modal.php';
	echo "
	<script>
		$(document).ready(function(){
			//Examples of how to assign the Colorbox event to elements
			$(\".iframe\").colorbox({iframe:true, width:\"".$width."%\", height:\"".$height."%\"});
			$(\".callbacks\").colorbox({
				onOpen:function(){ alert('onOpen: colorbox is about to open'); },
				onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
				onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
				onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
				onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
			});

					
			//Example of preserving a JavaScript event for inline calls.
			$(\"#click\").click(function(){ 
				$('#click').css({\"background-color\":\"#f00\", \"color\":\"#fff\", \"cursor\":\"inherit\"}).text(\"Open this window again and this message will still be here.\");
				return false;
			});
		});
	</script>
	";							  	
}
/*******************************************************************************************************************/
//Muestra un explorador de archivos personalizado
function widget_rainloop($id, $extra){

	//generacion del widget
	$widget = '
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<iframe id="'.$id.'" style="width: 100%;height: 100vh;" src="'.DB_SITE_REPO.'/LIBS_js/rainloop/'.$extra.'" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
			
		<script>
			$(function () {
				document.getElementById(\''.$id.'\').style.height = \'calc(100vh - \' + ($(\'#myIframe\').offset().top + 25) + \'px)\';            
			});
		</script>';
		
	//Imprimir dato	
	return $widget;
}
/*******************************************************************************************************************/
//Muestra la Burbuja de ayuda
function widget_tooltipster(){
	require_once '../LIBS_js/tooltipster/tooltipster.php';							  	
}
/*******************************************************************************************************************/
//Ejecuta el validador de formularios
function widget_validator(){
	require_once '../LIBS_js/validator/form_validator.php';						  	
}
/*******************************************************************************************************************/
//se muestra informacion como planilla excel
function widget_excel($identificador, $tabla, $extraconfig){
	
	//generacion del widget
	$widget = '
		<link href="'.DB_SITE_REPO.'/LIBS_js/webdatarocks/webdatarocks.min.css" rel="stylesheet" />
		<script src="'.DB_SITE_REPO.'/LIBS_js/webdatarocks/webdatarocks.toolbar.min.js"></script>
		<script src="'.DB_SITE_REPO.'/LIBS_js/webdatarocks/webdatarocks.js"></script>
						
		<div id="'.$identificador.'"></div>
		
		<script>
			var tipsData = ['.$tabla.'];
			var pivot = new WebDataRocks({
				container: "#'.$identificador.'",
				toolbar: true,
				report: {
					dataSource: {
						data: tipsData
					},
					'.$extraconfig.'
				},
				global: {
					// replace this path with the path to your own translated file
					localization: "https://cdn.webdatarocks.com/loc/es.json"
				}
			});
		</script>
		';
		
	//Imprimir dato	
	return $widget;					  	
}
/*******************************************************************************************************************/
//se muestra el buscador dentro de una tabla
function widget_sherlock($type, $colspan){
	//indica que tipo es
	switch ($type) {
		case 1: $html_obj = 'th'; break;
		case 2: $html_obj = 'td'; break;
	}

	//generacion del widget
	$widget = '
	<tr role="row">
		<'.$html_obj.' colspan="'.$colspan.'"><input class="form-control" id="InputTableFilter" type="text" placeholder="Filtrar Datos.."></'.$html_obj.'>
	</tr>
	<script>
		$(document).ready(function(){
			$("#InputTableFilter").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#TableFiltered tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>
	';
	
	//Imprimir dato	
	return $widget;				  	
}
/*******************************************************************************************************************/
//se muestra el buscador dentro de una tabla
function widget_table_filter($id_table){
	//generacion del widget
	$widget = '
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="'.DB_SITE_REPO.'/LIBS_js/Dropdown_Table_Filter/ddtf.js"></script>
	<script>jQuery(\'#'.$id_table.'\').ddTableFilter();</script>
	';
	
	//Imprimir dato	
	return $widget;				  	
}
/*******************************************************************************************************************/
//se muestra el visualizador de codigo fuente
function widget_code_block($type, $code){
	
	/********************************************************/
	//Definicion de errores
	$errorn = 0;
	//se definen las opciones disponibles
	$tipos = array(1, 2, 3, 4, 5, 6, 7);
	//verifico si el dato ingresado existe dentro de las opciones
	if (!in_array($type, $tipos)) {
		alert_post_data(4,1,1, 'La configuracion $type entregada en el codeblock no esta dentro de las opciones');
		$errorn++;
	}
	/********************************************************/
	//Ejecucion si no hay errores
	if($errorn==0){
		switch ($type) {
			//HTML Code Example
			case 1:
				$tittle = 'Codigo HTML';
				$class  = 'language-markup';
				break;
			//CSS Code Example
			case 2:
				$tittle = 'Codigo CSS';
				$class  = 'language-css';
				break;
			//JavaScript Code Example
			case 3:
				$tittle = 'Codigo JavaScript';
				$class  = 'language-javascript';
				break;
			//Python Code Example
			case 4:
				$tittle = 'Codigo Python';
				$class  = 'language-python';
				break;
			//PHP Code Example
			case 5:
				$tittle = 'Codigo PHP';
				$class  = 'language-php';
				break;
			//Handlebars Code Example
			case 6:
				$tittle = 'Codigo Handlebars';
				$class  = 'language-handlebars';
				break;
			//Git Code Example
			case 7:
				$tittle = 'Codigo Git';
				$class  = 'language-git';
				break;
		}
		//Limpieza
		$code = str_replace('<','&lt;',$code);	
		$code = str_replace('>','&gt;',$code);
		$code = str_replace('"','&quot;',$code);
		//$code = str_replace('>','&gt;',$code);
		//$code = str_replace('>','&gt;',$code);
		$widget = '
		<div class="code-block">
			<h6>'.$tittle.'</h6>
			<pre style="padding-top: 0px;"><code class="'.$class.'">'.$code.'</code></pre>
		</div>
		';
		
		//Imprimir dato	
		return $widget;	
		
	}		
}
/*******************************************************************************************************************/
//Muestra un explorador de archivos personalizado
function widget_feed($URL, $MaxCount, $height, $ShowDesc, $ShowPubDate){
	
	//opciones de configuracion
	$opciones  = 'FeedUrl: \''.$URL.'\'';                //URL de los datos
	$opciones .= ',MaxCount: '.$MaxCount;                //cantidad de post a mostrar
	$opciones .= ',ShowDesc: '.$ShowDesc;                //Mostrar descripcion (true-false)
	$opciones .= ',ShowPubDate: '.$ShowPubDate;          //mostrar fecha de publicacion (true-false)
	//$opciones .= ',DescCharacterLimit: '.$DescCharLimit; //limitar caracteres
	$opciones .= ',imgDirection: "'.DB_SITE_REPO.'/LIB_assets/img/loader.gif"';          //Direccion del loader
	
	
	//despliegue
	$input = '
	<link href="'.DB_SITE_REPO.'/LIBS_js/atom_feed/css/FeedEk.css" rel="stylesheet" type="text/css" />
	
	<div id="divRss" style="height:'.$height.'px;overflow:auto;"></div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/atom_feed/js/FeedEk.js?v2"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(\'#divRss\').FeedEk({
				'.$opciones.'
			});
		});
	</script>
	';
	
	




		
	//Imprimir dato	
	return $input;
}
/*******************************************************************************************************************/
//Muestra los ultimos temblores
function widget_sismologia(){
	
	//Se da permiso para el acceso remoto
	ini_set("allow_url_fopen", 1);
	//se verifica si el permiso fue concedido
	if( ini_get('allow_url_fopen') ) {
		//Obtengo los datos
		$sismologia = file_get_contents('http://www.sismologia.cl/links/tabla.html');
		
		//modifico el html obtenido
		$sismologia = str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"','', $sismologia);
		$sismologia = str_replace('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">','', $sismologia);
		$sismologia = str_replace('<html xmlns="http://www.w3.org/1999/xhtml">','', $sismologia);
		$sismologia = str_replace('<head>','', $sismologia);
		$sismologia = str_replace('<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->','', $sismologia);
		$sismologia = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />','', $sismologia);
		$sismologia = str_replace('<meta http-equiv="refresh" content="150" />','', $sismologia);
		$sismologia = str_replace('<meta name="description" content="Servicio Sismológico, Universidad de Chile" />','', $sismologia);
		$sismologia = str_replace('<meta name="author" content="SSUCH" />','', $sismologia);
		$sismologia = str_replace('<!--[if IE 8]> <link rel="stylesheet" href="/css/style_ie8.css" /><![endif]-->','', $sismologia);
		$sismologia = str_replace('<link rel="stylesheet" href="/css/style.css" />','', $sismologia);
		$sismologia = str_replace('<title>Ultimos Sismos</title>','', $sismologia);
		$sismologia = str_replace('<script type="text/javascript">','', $sismologia);
		$sismologia = str_replace('function popitup(url) {','', $sismologia);
		$sismologia = str_replace('var newwindow=window.open(url,"Epicentro","height=480,width=320,resizable=0,scrollbars=0,location=0,toolbar=0");','', $sismologia);
		$sismologia = str_replace('if (window.focus) {newwindow.focus()}','', $sismologia);
		$sismologia = str_replace('return false;','', $sismologia);
		$sismologia = str_replace('}','', $sismologia);
		$sismologia = str_replace('</script>','', $sismologia);
		$sismologia = str_replace('</head>','', $sismologia);
		$sismologia = str_replace('<body>','', $sismologia);
		$sismologia = str_replace('</body>','', $sismologia);
		$sismologia = str_replace('</html>','', $sismologia);
		$sismologia = str_replace('<a href="/events', '<a target="_blank" rel="noopener noreferrer" href="http://www.sismologia.cl/events', $sismologia);
		
		//genero cuerpo
		$s_body = '
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-map-o" aria-hidden="true"></i></div><h5>Últimos Sismos</h5>
				</header>
				<div class="external_page">
					'.$sismologia.'
				</div> 
			</div>';
		
		//devuelvo cuerpo								
		return $s_body;	
	//si no fue concedido
	} else {
		return alert_post_data(4,1,1, 'La funcion allow_url_fopen no esta activa');
	}
														
								
}
/*******************************************************************************************************************/
//Muestra los dias feriados del año
function widget_feriados(){
	
	//Se da permiso para el acceso remoto
	ini_set("allow_url_fopen", 1);
	//se verifica si el permiso fue concedido
	if( ini_get('allow_url_fopen') ) {
		//Obtengo los datos
		$feriado = file_get_contents('https://www.feriados.cl/');
		
		//modifico el html obtenido
		$feriado = str_replace('<!DOCTYPE html>','', $feriado);
		$feriado = str_replace('<html lang="es">','', $feriado);
		$feriado = str_replace('<head>','', $feriado);
		$feriado = str_replace('<!-- Global site tag (gtag.js) - Google Analytics -->','', $feriado);
		$feriado = str_replace('<script async src="https://www.googletagmanager.com/gtag/js?id=UA-11741389-1"></script>','', $feriado);
		$feriado = str_replace('<script>','', $feriado);
		$feriado = str_replace('window.dataLayer = window.dataLayer || [];','', $feriado);
		$feriado = str_replace('function gtag(){dataLayer.push(arguments);}','', $feriado);
		$feriado = str_replace('gtag(\'js\', new Date());','', $feriado);
		$feriado = str_replace("gtag('config', 'UA-11741389-1');", '', $feriado);
		$feriado = str_replace('<meta charset = "UTF-8" >','', $feriado);
		$feriado = str_replace('<meta name="description"','', $feriado);
		$feriado = str_replace('content="Sitio con la información de los días feriados de Chile y las leyes que los rigen.">','', $feriado);
		$feriado = str_replace('<link rel="shortcut icon" href="favicon.ico">','', $feriado);
		$feriado = str_replace('<link rel="stylesheet" type="text/css" href="style18-4.css">','', $feriado);
		$feriado = str_replace('<meta name="keywords"','', $feriado);
		$feriado = str_replace('content="Feriados de Chile, Feriados, 2021, Año Nuevo, Viernes Santo, Sábado Santo, Día Nacional de Trabajo, San Pedro y San Pablo, Día de la Virgen del Carmen, Asunsión de la Virgen, Independencia Nacional, Día de la Glorias del Ejército, Encuentro de Dos Mundos, Día de las Iglesias Evangélicas y Protestantes, Día de Todos los Santos, Inmaculada Concepción, Navidad, Elecciones Municipales, Plebiscito, Asamblea Constituyente, Constitución">','', $feriado);
		$feriado = str_replace('<title>Feriados de Chile - Año 2021</title>','', $feriado);
		$feriado = str_replace('<link rel="canonical" href="https://www.feriados.cl/index.php">','', $feriado);
		$feriado = str_replace('<meta name="viewport" content="width=device-width, initial-scale=1">','', $feriado);
		$feriado = str_replace('<!-- Anuncio Automatico -->','', $feriado);
		$feriado = str_replace('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>','', $feriado);
		$feriado = str_replace('(adsbygoogle = window.adsbygoogle || []).push({','', $feriado);
		$feriado = str_replace('google_ad_client: "pub-1764294017474123",','', $feriado);
		$feriado = str_replace('enable_page_level_ads: true','', $feriado);
		$feriado = str_replace('});','', $feriado);
		$feriado = str_replace('</head>','', $feriado);
		$feriado = str_replace('<body style="background-color: #ffffff; margin-top: 1%; margin-left: 2%; margin-right: 2%; margin-bottom: 1%;">','', $feriado);
		$feriado = str_replace('<header>','', $feriado);
		$feriado = str_replace('<div class="logo"><a href="#sobre">','', $feriado);
		$feriado = str_replace('<img src="logoferiados.png" alt="Logo" style="width:75%; margin-left: auto; margin-right: auto; display: block;"></a></div>','', $feriado);
		$feriado = str_replace('<div class="titulo"><h1 style="text-align:center;  color: #ffffff;">Feriados de Chile Año 2021','', $feriado);
		$feriado = str_replace('<a href="#menutarget" style="text-decoration: none;"><span class="menulink"></span></a></h1></div>','', $feriado);
		$feriado = str_replace('</header>','', $feriado);
		$feriado = str_replace('<main>','', $feriado);
		$feriado = str_replace('</main>','', $feriado);
		$feriado = str_replace('<aside>','', $feriado);
		$feriado = str_replace('<nav id="menu">','', $feriado);
		$feriado = str_replace('</nav>','', $feriado);
		$feriado = str_replace('<div class="share">','', $feriado);
		$feriado = str_replace('<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://feriados.cl/" data-via="feriados" ','', $feriado);
		$feriado = str_replace('data-size="large" data-count="none" data-hashtags="Feriados" style="vertical-align: text-bottom;" >Tweet</a>','', $feriado);
		$feriado = str_replace('<a href="whatsapp://send?text=Hola! Te recomiendo Feriados de Chile https://feriados.cl/" ','', $feriado);
		$feriado = str_replace('data-action="share/whatsapp/share"><img src="ws.png" alt="WhatsApp" height="28"></a>','', $feriado);
		$feriado = str_replace('<div>','', $feriado);
		$feriado = str_replace('<!-- BloqueResponsivo -->','', $feriado);
		$feriado = str_replace('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>','', $feriado);
		$feriado = str_replace('<ins class="adsbygoogle"','', $feriado);
		$feriado = str_replace('style="display:block"','', $feriado);
		$feriado = str_replace('data-ad-client="ca-pub-1764294017474123"','', $feriado);
		$feriado = str_replace('data-ad-slot="5711300468"','', $feriado);
		$feriado = str_replace('data-ad-format="auto"></ins>','', $feriado);
		$feriado = str_replace('(adsbygoogle = window.adsbygoogle || []).push({});','', $feriado);
		$feriado = str_replace('</div>','', $feriado);
		$feriado = str_replace('<div style="display:block; margin:auto; ">','', $feriado);
		$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Actualizaciones Twitter</span></p>','', $feriado);
		$feriado = str_replace('<a class="twitter-timeline"  data-tweet-limit="5" data-chrome="noheader;nofooter" data-width="100%"  data-height="auto"  ','', $feriado);
		$feriado = str_replace('href="https://twitter.com/feriados">Twitter @Feriados</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>','', $feriado);
		$feriado = str_replace('<p><span style="color: #004080; font-weight: bold;">Licencia</span></p>','', $feriado);
		$feriado = str_replace('<p style="font-size:smaller;"><a class="navblack" rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">','', $feriado);
		$feriado = str_replace('<img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>','', $feriado);
		$feriado = str_replace('<br />Esta obra está bajo una <a class="navblack" style="font-weight:normal;" ','', $feriado);
		$feriado = str_replace('rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">','', $feriado);
		$feriado = str_replace('Licencia Creative Commons Atribución-NoComercial-CompartirIgual 4.0 Internacional</a>.</p>','', $feriado);
		$feriado = str_replace('</aside>','', $feriado);
		$feriado = str_replace('</body>','', $feriado);
		$feriado = str_replace('</html>','', $feriado);
		$feriado = str_replace('<table>','<table style="width: 100%;white-space: initial;">', $feriado);
		$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Sobre el sitio</span></p>','', $feriado);
		$feriado = str_replace('<p style="padding: 0px 6px 0px 6px;">En Feriados de Chile creemos que la familia y comunidad son la base de la sociedad, ','', $feriado);
		$feriado = str_replace('y que cada momento que pasan juntas, contribuye a una sociedad más fuerte. Nosotros te contamos cuándo es feriado, para que','', $feriado);
		$feriado = str_replace('disfrutes junto a los tuyos. Fuente de información: ','', $feriado);
		$feriado = str_replace('<a class="navblack" style="font-weight: normal;" href="https://www.bcn.cl/" target="_blank">Biblioteca Congreso Nacional</a>.</p>','', $feriado);
		$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Otros sitios </span></p>','', $feriado);
		$feriado = str_replace('<p>','', $feriado);
		$feriado = str_replace('</p>','', $feriado);
		$feriado = str_replace('<a href="https://www.preparados.cl/"','', $feriado);
		$feriado = str_replace('<a href="https://www.datoutil.cl/"','', $feriado);
		$feriado = str_replace('<a href="https://www.efemerides.cl/"','', $feriado);
		$feriado = str_replace('target','', $feriado);
		$feriado = str_replace('_blank','', $feriado);
		$feriado = str_replace('=>','', $feriado);
		$feriado = str_replace('<img class="logott"','', $feriado);
		$feriado = str_replace('alt="Estar Preparados"','', $feriado);
		$feriado = str_replace('alt="Dato Util"','', $feriado);
		$feriado = str_replace('alt="Efemérides Chile"','', $feriado);
		$feriado = str_replace('src="preparadostt.png" >','', $feriado);
		$feriado = str_replace('src="datoutiltt.png" >','', $feriado);
		$feriado = str_replace('src="efemeridestt.png" >','', $feriado);
		$feriado = str_replace('<span  class="menuitemcur">Feriados Año 2021</span>','', $feriado);
		$feriado = str_replace('<a class="navwhite"','', $feriado);
		$feriado = str_replace('href="2022.htm">Feriados Año 2022','', $feriado);
		$feriado = str_replace('href="leyes.htm">Leyes','', $feriado);
		$feriado = str_replace('href="faq.htm">Preguntas Frecuentes','', $feriado);
		$feriado = str_replace('</a>','', $feriado);	
		$feriado = str_replace('<th>Día</th>','<th><strong><span style="color:#fff">Día</span></strong></th>', $feriado);	
		$feriado = str_replace('<th>Festividad</th>','<th><strong><span style="color:#fff">Festividad</span></strong></th>', $feriado);	
		$feriado = str_replace('<th>Tipo</th>','<th><strong><span style="color:#fff">Tipo</span></strong></th>', $feriado);	
		$feriado = str_replace('<th class="rl">Respaldo Legal</th>','<th><strong><span style="color:#fff">Respaldo Legal</span></strong></th>', $feriado);	
		
		
		//genero cuerpo
		$s_body = '
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div><h5>Feriados de Chile</h5>
				</header>
				<div class="">
					'.$feriado.'
				</div> 
			</div>';
		
		//devuelvo cuerpo								
		return $s_body;
	//si no fue concedido
	} else {
		return alert_post_data(4,1,1, 'La funcion allow_url_fopen no esta activa');
	}
	
}
/*******************************************************************************************************************/
//Muestra los dias feriados del año
function widget_radio_player(){
	//radios
	$arr = array();
	$arr[] = array('https://redirector.dps.live/biobiosantiago/aac/icecast.audio',                                               '2939.v10.png',         'Radio Bio Bio');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/CORAZONAAC.aac?dist=onlineradiobox',       '2940.v12.png',         'Radio Corazón');
	$arr[] = array('https://mdstrm.com/audio/5c8d6406f98fbf269f57c82c/live.m3u8',                                                '3545.v8.png',          'Play FM');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/ADN.mp3?dist=onlineradiobox',              '334.v17.png',          'ADN Radio');
	$arr[] = array('https://redirector.dps.live/cooperativafm/mp3/icecast.audio',                                                '2990.v21.png',         'Radio Cooperativa');
	$arr[] = array('https://unlimited4-us.dps.live/p7concepcion/mp3/icecast.audio',                                              '62835.v15.png',        'Radio Punto 7 Concepción');
	$arr[] = array('https://sp.tvcontrolcp.com:10905/;',                                                                         '63733.v12.png',        'Radio Kpop Star');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/FUTURO_SC?dist=onlineradiobox',            '2895.v8.png',          'Radio Futuro');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/ROCK_AND_POPAAC.aac?dist=onlineradiobox',  '2920.v8.png',          'Rock & Pop');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/IMAGINA_SC?dist=onlineradiobox',           '322.v8.png',           'Radio Imagina');
	$arr[] = array('https://onlineradiobox.com/json/cl/paloma/play?platform=web',                                                '3434.v16.png',         'Radio Paloma');
	$arr[] = array('https://unlimited1-us.dps.live/carolinatv/carolinatv.smil/playlist.m3u8',                                    '358.v20.png',          'Radio Carolina');
	$arr[] = array('https://stream.edelweiss.fm/radio/8040/radio.mp3',                                                           '3266.v19.png',         'Radio Mirador');
	$arr[] = array('https://onlineradiobox.com/json/cl/delosrecuerdos/play?platform=web',                                        '63830.v9.png',         'FM de los Recuerdos');
	$arr[] = array('https://mdstrm.com/audio/5c915497c6fd7c085b29169d/live.m3u8',                                                '2943.v6.png',          'Radio Oasis');
	$arr[] = array('https://stream.edelweiss.fm/radio/8000/radio.mp3',                                                           '63821.v15.png',        'Radio Edelweiss');
	$arr[] = array('https://onlineradiobox.com/json/cl/carabineros/play?platform=web',                                           '75629.v8.png',         'Radio Carabineros');
	$arr[] = array('https://audio1.tustreaming.cl/9020/stream',                                                                  '3655.v7.png',          'Mi Radio');
	$arr[] = array('https://mdstrm.com/audio/5c915724519bce27671c4d15/icecast.audio?property=radiobox',                          '2988.v8.png',          'Sonar 105.3 FM');
	$arr[] = array('https://unlimited4-us.dps.live/romantica/aac/icecast.audio',                                                 '307.v19.png',          'Radio Romantica');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/ACTIVA.mp3?dist=onlineradiobox',           '3124.v11.png',         'RadioActiva');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/FMDOS_SC?dist=onlineradiobox',             '2938.v8.png',          'FM Dos');
	$arr[] = array('https://onlineradiobox.com/json/cl/carnavalantofagasta/play?platform=web',                                   '3070.v10.png',         'Radio Carnaval');
	$arr[] = array('https://unlimited4-us.dps.live/universo/aac/icecast.audio',                                                  '306.v7.png',           'Universo');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/PUDAHUEL.mp3?dist=onlineradiobox',         '309.v9.png',           'Radio Pudahuel');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/CONCIERTOAAC.aac?dist=onlineradiobox',     '2894.v5.png',          'Concierto 88.5 FM');
	$arr[] = array('https://radio.trix.hosting:18094/;',                                                                         '63045.v13.png',        'Retroclásicos Radio');
	$arr[] = array('https://unlimited4-us.dps.live/agricultura/gotardis/audio/now/livestream1.m3u8',                             '318.v12.png',          'Radio Agricultura');
	$arr[] = array('https://stream10.usastreams.com:10998/;',                                                                    '2898.v16.png',         'El Conquistador');
	$arr[] = array('https://unlimited4-us.dps.live/disney/mp364k/icecast.audio',                                                 '62400.v11.png',        'Radio Disney');
	$arr[] = array('https://mdstrm.com/audio/5c915613519bce27671c4caa/live.m3u8',                                                '63666.v9.png',         'Tele 13 Radio');
	$arr[] = array('https://stream.festival.cl/1',                                                                               '313.v13.png',          'Radio Festival');
	$arr[] = array('https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_CHILEAAC.aac?dist=onlineradiobox',   '2941.v13.png',         'Los 40');
	$arr[] = array('https://centova.neonetwork.cl:9154/stream',                                                                  '63848.v9.png',         'Radio Lola');
	$arr[] = array('https://unlimited4-us.dps.live/digitalfm/aac/icecast.audio',                                                 '329.v13.png',          'Digital FM');
	$arr[] = array('https://xradiopanel.com/8004/stream',                                                                        '63092.v10.png',        'Radio 80s');
	$arr[] = array('https://onlineradiobox.com/json/cl/estacion247/play?platform=web',                                           '73087.v11.png',        'Radio Estación 24/7');
	$arr[] = array('https://streaming.conectaapp.cl/fmplus',                                                                     '3085.v6.png',          'Radio Plus FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/scuraexitos8090s/play?platform=web',                                      '63095.v14.png',        'Radioscura Éxitos 80/90&amp;#39;s');
	$arr[] = array('https://kpopreplay.radioca.st//stream',                                                                      '63655.v8.png',         'Kpop Replay');
	$arr[] = array('https://sonic.portalfoxmix.club:7157/;',                                                                     '80313.v24.png',        'Radio Raol Retro');
	$arr[] = array('https://unlimited11-cl.dps.live/infinita/aac/icecast.audio',                                                 '321.v9.png',           'Infinita Radio');
	$arr[] = array('https://unlimited3-cl.dps.live/beethovenfm/gotardis/audio/now/livestream1.m3u8',                             '332.v10.png',          'Beethoven');
	$arr[] = array('https://onlineradiobox.com/json/cl/araucana/play?platform=web',                                              '3293.v10.png',         'Radio Araucana');
	$arr[] = array('https://onlineradiobox.com/json/cl/ritoque/play?platform=web',                                               '3570.v6.png',          'Radio Ritoque');
	$arr[] = array('https://sonic.portalfoxmix.cl:7045/;',                                                                       '3401.v9.png',          'Picarona Panguipulli');
	$arr[] = array('https://vintage.ice.infomaniak.ch/vintage.mp3',                                                              '63368.v7.png',         'Radio Vintage');
	$arr[] = array('https://stream.zenolive.com/p0ar2tuq98quv',                                                                  '80442.v4.png',         'Radio K-pop Music');
	$arr[] = array('https://unlimited4-us.dps.live/nostalgica/aac/icecast.audio',                                                '3111.v9.png',          'Radio Nostalgica');
	$arr[] = array('https://audio1.tustreaming.cl:10973/stream',                                                                 '3147.v12.png',         'Radio Corporacion');
	$arr[] = array('https://aac.noot.live/laclavebb.aac',                                                                        '63522.v12.png',        'Radio La Clave');
	$arr[] = array('https://sonic.portalfoxmix.cl:7034/live',                                                                    '3553.v6.png',          'FM Dance');
	$arr[] = array('https://onlineradiobox.com/json/cl/maxima/play?platform=web',                                                '62964.v13.png',        'Radio Máxima');
	$arr[] = array('https://unlimited3-cl.dps.live/duna/gotardis/audio/now/livestream1.m3u8',                                    '328.v12.png',          'Duna');
	$arr[] = array('https://streamuchile.teslati.com/liveruch',                                                                  '3081.v11.png',         'Radio Universidad de Chile');
	$arr[] = array('https://unlimited1-us.dps.live/fmtiempotv/fmtiempotv.smil/playlist.m3u8',                                    '324.v8.png',           'FM Tiempo');
	$arr[] = array('https://onlineradiobox.com/json/cl/mirasol/play?platform=web',                                               '63863.v8.png',         'Radio Mirasol');
	$arr[] = array('https://audio4.tustreaming.cl/8160/stream',                                                                  '63010.v13.png',        'Viña del Mar Classic');
	$arr[] = array('https://sonic.portalfoxmix.cl/8226/stream',                                                                  '80534.v7.png',         'Recuerdos Retro');
	$arr[] = array('https://us9.maindigitalstream.com/ssl/7389',                                                                 '1840.v10.png',         'Radio Sol');
	$arr[] = array('https://broadcast.radio247.net/radio/8100/stream',                                                           '3012.v11.png',         'Desierto FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/rtl/play?platform=web',                                                   '3432.v17.png',         'Radio RTL Curicó');
	$arr[] = array('https://unlimited11-cl.dps.live/elcarbon/aac/icecast.audio',                                                 '63826.v10.png',        'Radio El Carbon');
	$arr[] = array('https://mdstrm.com/audio/5de7fdb07e2fde0798203821/live.m3u8',                                                '63379.v26.png',        'Rockaxis');
	$arr[] = array('https://rusach.janus.cl/playlist/stream.m3u8',                                                               '3543.v15.png',         'Radio USACH');
	$arr[] = array('https://onlineradiobox.com/json/cl/nahuel/play?platform=web',                                                '3324.v9.png',          'Radio Nahuel');
	$arr[] = array('https://onlineradiobox.com/json/cl/vln/play?platform=web',                                                   '69682.v11.png',        'VLN Radio');
	$arr[] = array('https://archi-us.digitalproserver.com/osorno-fm.aac',                                                        '3322.v6.png',          'Radio Sago');
	$arr[] = array('https://unlimited4-us.dps.live/positiva/aac/icecast.audio',                                                  '68190.v15.png',        'Radio Positiva');
	$arr[] = array('https://onlineradiobox.com/json/cl/powerplaydiscotheque/play?platform=web',                                  '63328.v9.png',         'Power Play Discotheque');
	$arr[] = array('https://sonando-us.digitalproserver.com/ucvradio',                                                           '62979.v9.png',         'UCV Radio');
	$arr[] = array('https://sonic.portalfoxmix.cl:7026/stream',                                                                  '63196.v10.png',        'Radio Fiesta Mix');
	$arr[] = array('https://onlineradiobox.com/json/cl/lavozdelacosta/play?platform=web',                                        '63841.v9.png',         'Radio La Voz de la Costa');
	$arr[] = array('https://streaming.conectaapp.cl/fmquiero',                                                                   '71461.v9.png',         'FM Quiero');
	$arr[] = array('https://onlineradiobox.com/json/cl/libra/play?platform=web',                                                 '62980.v9.png',         'Radio Libra');
	$arr[] = array('https://onlineradiobox.com/json/cl/codigometal/play?platform=web',                                           '58095.v9.png',         'Código Metal Radio');
	$arr[] = array('https://archi-us.digitalproserver.com/austral.aac',                                                          '3406.v6.png',          'Radio Austral');
	$arr[] = array('https://streaming.conectaapp.cl/canal95',                                                                    '3008.v6.png',          'Radio Canal 95');
	$arr[] = array('https://onlineradiobox.com/json/cl/dulce/play?platform=web',                                                 '3564.v7.png',          'Radio Dulce');
	$arr[] = array('https://portales.tustreamings1.cl/stream',                                                                   '3552.v7.png',          'Radio Portales');
	$arr[] = array('https://radiostreaming.cloudserverlatam.com/8088/stream',                                                    '74515.v5.png',         'Radio Beat 98.7 FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/punto9/play?platform=web',                                                '62871.v14.png',        'Radio Punto 9');
	$arr[] = array('https://onlineradiobox.com/json/cl/azukar1079/play?platform=web',                                            '74095.v3.png',         'Radio Azukar 107.9 FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/caramelo/play?platform=web',                                              '3230.v15.png',         'Radio Caramelo-Malleco');
	$arr[] = array('https://sonic-us.streaming-chile.com:7037/;',                                                                '63866.v25.png',        'Dossil Radio Chile');
	$arr[] = array('https://onlineradiobox.com/json/cl/sinfoniaonline/play?platform=web',                                        '63067.v16.png',        'Radio Sinfonia Online');
	$arr[] = array('https://onlineradiobox.com/json/cl/lagosdelsur/play?platform=web',                                           '79342.v7.png',         'FM Lagos del Sur');
	$arr[] = array('https://stream.zeno.fm/cpvysp4m4ceuv',                                                                       '76736.v21.png',        'World Hits Radio (Radio Hits Chile)');
	$arr[] = array('https://archi-us.digitalproserver.com/definitiva.aac',                                                       '314.v7.png',           'Radio Definitiva');
	$arr[] = array('https://audio4.tustreaming.cl/8130/stream',                                                                  '3551.v13.png',         'Radio Santiago');
	$arr[] = array('https://onlineradiobox.com/json/cl/contemporanea/play?platform=web',                                         '62974.v9.png',         'Radio Contemporánea');
	$arr[] = array('https://onlineradiobox.com/json/cl/toromondo/play?platform=web',                                             '63060.v10.png',        'ToroMondo');
	$arr[] = array('https://unlimited3-cl.dps.live/radiopaula/gotardis/audio/now/livestream1.m3u8',                              '2991.v8.png',          'Paula FM');
	$arr[] = array('https://radiox.tustreamings5.cl/stream',                                                                     '63636.v12.png',        'Radio X FM');
	$arr[] = array('https://radio.tvstream.cl/8008/stream',                                                                      '68735.v34.png',        'Radio Zona Activa');
	$arr[] = array('https://onlineradiobox.com/json/cl/folclordechile/play?platform=web',                                        '63373.v8.png',         'Radio Folclor De Chile');
	$arr[] = array('https://radio.saopaulo01.com.br/8188/stream',                                                                '62832.v11.png',        '94.1 FM Patagonia Radio');
	$arr[] = array('https://onlineradiobox.com/json/cl/sanbartolome/play?platform=web',                                          '3249.v8.png',          'Radio San Bartolome');
	$arr[] = array('https://onlineradiobox.com/json/cl/classica1063/play?platform=web',                                          '3352.v10.png',         'Radio Classica');
	$arr[] = array('https://centova.neonetwork.cl:9172/stream',                                                                  '3354.v8.png',          'Radio Reloncavi');
	$arr[] = array('https://onlineradiobox.com/json/cl/chileno/play?platform=web',                                               '63413.v7.png',         'Rock Chileno');
	$arr[] = array('https://stream.zeno.fm/ktmru7k741zuv',                                                                       '75973.v9.png',         'Radio Modelo');
	$arr[] = array('https://stream.zeno.fm/c16qw0esehruv',                                                                       '82795.v10.png',        'Radio Retrocadas');
	$arr[] = array('https://onlineradiobox.com/json/cl/congreso/play?platform=web',                                              '62981.v9.png',         'Radio Congreso');
	$arr[] = array('https://cp.streamchileno.cl/radio/8040/radio.mp3',                                                           '3252.v19.png',         'Radio Riquelme');
	$arr[] = array('https://onlineradiobox.com/json/cl/supersol/play?platform=web',                                              '3656.v6.png',          'Radio SuperSol');
	$arr[] = array('https://audio.streaminghd.cl:2000/stream/RadioPulso',                                                        '80554.v20.png',        'Radio Pulso');
	$arr[] = array('https://sonic.portalfoxmix.cl:7012/;',                                                                       '3335.v9.png',          'Radio La Palabra');
	$arr[] = array('https://onlineradiobox.com/json/cl/magiztral/play?platform=web',                                             '63528.v11.png',        'Radio Magiztral');
	$arr[] = array('https://onlineradiobox.com/json/cl/gabrielaonline/play?platform=web',                                        '63349.v11.png',        'Radio Gabriela On Line');
	$arr[] = array('https://onlineradiobox.com/json/cl/galaxia/play?platform=web',                                               '63512.v7.png',         'Radio Galaxia');
	$arr[] = array('https://onlineradiobox.com/json/cl/fiessta/play?platform=web',                                               '3465.v8.png',          'Radio Fiessta');
	$arr[] = array('https://archi-us.digitalproserver.com/portales-fm-valparaiso-vina-del-mar.aac',                              '72051.v5.png',         'Radio Portales de Valparaiso');
	$arr[] = array('https://onlineradiobox.com/json/cl/macarena997/play?platform=web',                                           '320.v10.png',          'Macarena');
	$arr[] = array('https://onlineradiobox.com/json/cl/dimension/play?platform=web',                                             '70347.v14.png',        'Dimensión Primavera FM');
	$arr[] = array('https://archi-us.digitalproserver.com/santa-maria-am.aac',                                                   '3194.v6.png',          'Radio Santa Maria');
	$arr[] = array('https://onlineradiobox.com/json/cl/futura/play?platform=web',                                                '62773.v9.png',         'Futura 100.7 FM');
	$arr[] = array('https://audio3.tustreaming.cl:10964/caramelosvicente',                                                       '62926.v13.png',        'Radio Caramelo 104.5 FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/pauta/play?platform=web',                                                 '75624.v8.png',         'Pauta FM');
	$arr[] = array('https://estilofm.tustreamings2.cl/stream',                                                                   '3417.v9.png',          'Estilo FM');
	$arr[] = array('https://onlineradiobox.com/json/cl/azul/play?platform=web',                                                  '3571.v7.png',          'Radio Azul');
	$arr[] = array('https://mdstrm.com/audio/5d013e4bc8a64d0da420ced6/live.m3u8',                                                '63579.v10.png',        'Súbela Radio');
	$arr[] = array('https://cp.streamchileno.cl/radio/8130/radio.mp3',                                                           '3251.v6.png',          'Radio Pinamar');

	
	//Hoja de estilo		
	$input ='<link rel="stylesheet prefetch" href="'.DB_SITE_REPO.'/LIBS_js/mejs-player-master/build/mediaelementplayer.css">';
	
	//se crea widget
	$input .='
	<div id="main-wrapper">
		<div class="player-wrapper">

			<audio id="audio" class="mejs__player" controls="controls" src="">
				Your browser does not support the audio format.
			</audio>
			
			<ul class="playlist custom-counter" id="list">';
				
				foreach ($arr as $prod) {
					$input .='
					<li>
					   <div class="track-info" >
							<img class="station__title__logo" src="'.DB_SITE_REPO.'/LIBS_js/mejs-player-master/emisoras/'.$prod[1].'" alt="'.$prod[2].'" title="'.$prod[2].'">
							<a href="#" data-value="'.$prod[0].'">'.$prod[2].'</a>
						</div>
					</li>';
				}
				
				
			$input .='	
			</ul>
		 
		</div>
	</div>';
	
	//script
	$input .='<script src="'.DB_SITE_REPO.'/LIBS_js/mejs-player-master/build/mediaelement-and-player.js"></script>';		
	$input .='
	<script >
		// Dynamic URL change
		list.onclick = function(e) {
		  e.preventDefault();

		  var elm = e.target;
		  var audio = document.getElementById("audio");

		  var source = document.getElementById("audio");
		  source.src = elm.getAttribute("data-value");

		  audio.load(); //call this to just preload the audio without playing
		  audio.play(); //call this to play the song right away
		};
	 </script>';
	
	$input .='<style>
		/* Radio Player */
		#main-wrapper{padding:30px 0;}
		#main-wrapper .player-wrapper{border-radius: 5px;box-shadow: 0 0 8px -1px rgba(0, 0, 0, 0.25);background-image: -webkit-linear-gradient(315deg, #FF5572, #FF7555);background-image: linear-gradient(135deg, #FF5572, #FF7555);overflow: hidden;margin: 0 auto;max-width:100%;width: 100%;padding: 0;border-radius:0;}
		#main-wrapper .player-wrapper .playlist {margin:0;padding:15px 15px 0 15px;height: 400px;overflow-x: auto;color:#fff;}
		#main-wrapper .player-wrapper .playlist li{ overflow: hidden;line-height: 20px;display: flex;padding: 10px 0;border-bottom: 1px solid rgba(230, 211, 211, 0.31);}
		#main-wrapper .player-wrapper .playlist li .track-info {display: inline-block;position: relative;line-height: 1.3em;width: 100%;font-weight:500;}
		#main-wrapper .player-wrapper .playlist li .track-info img { margin-right: 10px;border-radius: 3px;width: 90px;}
		#main-wrapper .player-wrapper .playlist li .track-info a{color: #fff;text-decoration:none;}
		.mejs__controls{height:60px;}
		.mejs__button.mejs__playpause-button.mejs__replay,.mejs__button.mejs__playpause-button.mejs__pause{background: #FFB00E;width: 40px;padding: 0 5px;border-radius: 50%;}
		.mejs__button.mejs__playpause-button.mejs__replay{background: #29cf54;}
		.mejs__button.mejs__playpause-button.mejs__play {background: #29cf54;width: 40px;padding: 0 5px;border-radius: 50%;}
		.mejs__time {box-sizing: content-box;color: #444;font-size: 15px;font-weight: bold;height: 24px;overflow: hidden;width: 50px;padding:16px 0;}
		.mejs__button > button  {display: block;padding: 0;border: 0;font-family: FontAwesome;font-size: 20px;color: #444;background: transparent!important;}
		.mejs__button.mejs__playpause-button.mejs__play button:before {content: "\f04b";color:#fff;}
		.mejs__button.mejs__playpause-button.mejs__pause button:before {content: "\f04c";color:#fff;}
		.mejs__button.mejs__playpause-button.mejs__replay button:before {content: "\f01e";color:#fff;} 
		.mejs__button.mejs__volume-button.mejs__mute button:before {content: "\f028";}
		.mejs__button.mejs__volume-button.mejs__unmute button:before {content: "\f026";}
		.mejs__container {font-family: Segui Ui,Arial,serif;background-size: cover;position: relative;background:#fff;text-align: left;text-indent: 0;vertical-align: top;height: 80px!important;width: 100%!important;}
		.mejs__controls:not([style*="display: none"]) {background: none;}
		.mejs__time-total {background: rgb(212, 245, 221);margin: 5px 0 0;width: 100%;}
		span.mejs__time-current {background: #dedede;}
		span.mejs__time-loaded {background: #29cf54;}
		.mejs__time-handle-content {border: 4px solid rgba(255, 255, 255, 0.9);border-radius: 0;height: 10px;left: -5px;top: -4px;-webkit-transform: scale(0);-ms-transform: scale(0);transform: scale(0);width: 1px;}
		.mejs__horizontal-volume-total {background: rgb(41, 207, 84);height: 10px;top:14px;border-radius:0;}
	</style>';
	
	//devuelvo cuerpo								
	return $input;
  
}
/*******************************************************************************************************************/


?>
