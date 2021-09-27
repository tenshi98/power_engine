<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion Normal)
function GraphLinear_1($idDiv, 
						$titulo, $eje_x_titulo, $eje_y_titulo, 
						$xData, $yData, $names, $types, $texts, $lineColors, $lineDash, $lineWidth,
						$legendOptions){
	
	//Opciones del legend
	switch ($legendOptions) {
		//Legend abajo
		case 1:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		//Doble eje
		case 2:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		default:
			$lopts = '';
	}

	/*************************************************/
	//imprime
	$graph  = '<div id="'.$idDiv.'"></div>';
	$graph .= '<script>';
		$graph .= $xData;
		$graph .= $yData;
		$graph .= $names;
		$graph .= $types;
		$graph .= $texts;
		$graph .= $lineColors;
		$graph .= $lineDash;
		$graph .= $lineWidth;
		$graph .='
		//se arman datos	
		var dataPlotly = [];
		for ( var i = 0 ; i < xData.length ; i++ ) {
			var result = {
				x: xData[i],
				y: yData[i],
				type: \'scatter\',
				name: names[i],
				mode: types[i],
				text: texts[i],
				line: {
					color: lineColors[i],
					dash: lineDash[i],
					width: lineWidth[i]
				}
			};
			dataPlotly.push(result);
		}
		//vista de los label
		var labelview = true;
		if(xData[0].length > 30){
			labelview = false;
		}
		/*****************************************************************/
		var layout = {';
			if(isset($titulo)&&$titulo!=''){             $graph .= 'title:\''.$titulo.'\',';}
			if(isset($eje_x_titulo)&&$eje_x_titulo!=''){ $graph .= 'xaxis: {title: \''.$eje_x_titulo.'\', showticklabels: labelview},';}
			if(isset($eje_y_titulo)&&$eje_y_titulo!=''){ $graph .= 'yaxis: {title: \''.$eje_y_titulo.'\'},';}
			$graph .= 'showlegend: true,';
			$graph .= $lopts;
		$graph .= ' };

		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoom2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';	
	
	return $graph;
	
}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion con Rango)
function GraphLinear_2($idDiv, 
						$titulo, $eje_x_titulo, $eje_y_titulo, 
						$xData, $yData, $names, $types, $texts, $lineColors, $lineDash, $lineWidth,
						$legendOptions){
	
	//Opciones del legend
	switch ($legendOptions) {
		//Legend abajo
		case 1:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		//Doble eje
		case 2:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		default:
			$lopts = '';
	}

	/*************************************************/
	//imprime
	$graph  = '<div id="'.$idDiv.'"></div>';
	$graph .= '<script>';
		$graph .= $xData;
		$graph .= $yData;
		$graph .= $names;
		$graph .= $types;
		$graph .= $texts;
		$graph .= $lineColors;
		$graph .= $lineDash;
		$graph .= $lineWidth;
		$graph .='
		//se arman datos	
		var dataPlotly = [];
		for ( var i = 0 ; i < xData.length ; i++ ) {
			var result = {
				x: xData[i],
				y: yData[i],
				type: \'scatter\',
				name: names[i],
				mode: types[i],
				text: texts[i],
				line: {
					color: lineColors[i],
					dash: lineDash[i],
					width: lineWidth[i]
				}
			};
			dataPlotly.push(result);
		}
		/*****************************************************************/
		var layout = {
			title:\''.$titulo.'\',
			xaxis: {title: \''.$eje_x_titulo.'\', autorange: true,rangeslider: {range: [xData[0][0], xData[0][xData[0].length]]},type: \'linear\'},
			yaxis: {title: \''.$eje_y_titulo.'\'},
			showlegend: true,
			'.$lopts.'
		};

		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoom2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';	
	
	return $graph;
	
}
/*******************************************************************************************************************/
//Crea un grafico de doble eje
function GraphLinear_3($idDiv, 
						$titulo, $eje_x_titulo, $eje_y_titulo_1, $eje_y_titulo_2, 
						$xData_1, $yData_1, $name_1,
						$xData_2, $yData_2, $name_2,
						$legendOptions){
	
	//Opciones del legend
	switch ($legendOptions) {
		//Legend abajo
		case 1:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		//Doble eje
		case 2:
			$lopts = 'height: 600,legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		default:
			$lopts = '';
	}

	/*************************************************/
	//imprime
	$graph  = '<div id="'.$idDiv.'"></div>';
	$graph .= '<script>
		//guardo las fechas
		var xData_1 = ['.$xData_1.'];
		var xData_2 = ['.$xData_2.'];
		
		var trace1 = {
			x: xData_1,
			y: ['.$yData_1.'],
			name: '.$name_1.',
			type: \'scatter\'
		};

		var trace2 = {
			x: xData_2,
			y: ['.$yData_2.'],
			name: '.$name_2.',
			yaxis: \'y2\',
			type: \'scatter\'
		};

		var dataPlotly = [trace1, trace2];
		
		//vista de los label
		var labelview = true;
		if(xData_1.length > 30){
			labelview = false;
		}
		if(xData_2.length > 30){
			labelview = false;
		}
			
		var layout = {';
			if(isset($titulo)&&$titulo!=''){                  $graph .= 'title:\''.$titulo.'\',';}
			if(isset($eje_x_titulo)&&$eje_x_titulo!=''){      $graph .= 'xaxis: {title: \''.$eje_x_titulo.'\', showticklabels: labelview},';}
			if(isset($eje_y_titulo_1)&&$eje_y_titulo_1!=''){  $graph .= 'yaxis: {title: \''.$eje_y_titulo_1.'\'},';}
			if(isset($eje_y_titulo_2)&&$eje_y_titulo_2!=''){  $graph .= 'yaxis2: {title: \''.$eje_y_titulo_2.'\', titlefont: {color: \'rgb(148, 103, 189)\'}, tickfont: {color: \'rgb(148, 103, 189)\'}, overlaying: \'y\', side: \'right\' },';}
			$graph .= 'showlegend: true,';
			$graph .= $lopts;
		$graph .= ' };

		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoom2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>
	';
			
	
	return $graph;
	
}

?>
