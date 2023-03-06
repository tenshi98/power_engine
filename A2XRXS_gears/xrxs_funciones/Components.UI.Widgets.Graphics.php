<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1002-004).');
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
		//Legend dentro al lado izquierdo
		case 2:
			$lopts = 'legend: {x: 0,y: 1.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho
		case 3:
			$lopts = 'legend: {x: 0,y: 2.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
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
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
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
		//Legend dentro al lado izquierdo
		case 2:
			$lopts = 'legend: {x: 0,y: 1.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho
		case 3:
			$lopts = 'legend: {x: 0,y: 2.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
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
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
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
		//Legend dentro al lado izquierdo
		case 2:
			$lopts = 'legend: {x: 0,y: 1.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho
		case 3:
			$lopts = 'legend: {x: 0,y: 2.0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
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
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>
	';

	return $graph;

}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion Normal)
function GraphBarr_1($idDiv,
					$titulo, $eje_x_titulo, $eje_y_titulo,
					$xData, $yData, $Name, $hoverinfo, $markerColor, $markerLine,
					$type, $legendOptions){

	//Tipo de grafico
	switch ($type) {
		case 1:  $typeopts = 'group'; break;
		case 2:  $typeopts = 'stack'; break;
		default: $typeopts = '';
	}

	//Opciones del legend
	switch ($legendOptions) {
		//Legend abajo
		case 1:
			$lopts = 'legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		//Legend dentro al lado izquierdo superior
		case 2:
			$lopts = 'legend: {x: 0,y: 1, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho superior
		case 3:
			$lopts = 'legend: {x: 1,y: 1, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado izquierdo inferior
		case 4:
			$lopts = 'legend: {x: 0,y: 0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho inferior
		case 5:
			$lopts = 'legend: {x: 1,y: 0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
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
		$graph .= $Name;
		$graph .= $hoverinfo;
		$graph .= $markerColor;
		$graph .= $markerLine;

		$graph .='
		//se arman datos
		var dataPlotly = [];
		for ( var i = 0 ; i < xData.length ; i++ ) {
			var textin = "";
			if(grf_info[i]!=""){
				textin = grf_info[i];
			}else{
				textin = yData[i].map(String);
			}

			var result = {
				x: xData[i],
				y: yData[i],
				type: \'bar\',
				name: names[i],
				text: textin,
				textposition: \'auto\',
				hoverinfo: \'grf_info[i]\',
				marker: {
					color: \'markerColor[i]\',
					line: {
						color: \'markerLine[i]\',
						width: 1.5
					}
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
		var layout = {
			title: \''.$titulo.'\',
			barmode: \''.$typeopts.'\',';
			if(isset($eje_x_titulo)&&$eje_x_titulo!=''){ $graph .= 'xaxis: {title: \''.$eje_x_titulo.'\',titlefont: {size: 16,color: \'rgb(107, 107, 107)\'},tickfont: {size: 14,color: \'rgb(107, 107, 107)\'}},';}
			if(isset($eje_y_titulo)&&$eje_y_titulo!=''){ $graph .= 'yaxis: {title: \''.$eje_y_titulo.'\',titlefont: {size: 16,color: \'rgb(107, 107, 107)\'},tickfont: {size: 14,color: \'rgb(107, 107, 107)\'}},';}
			$graph .= $lopts;
		 $graph .= '
		};
		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';

	return $graph;

}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion Normal)
function GraphPie_1($idDiv,
					$titulo,
					$values,$labels,$width,$height,
					$dataOptions, $layoutOptions){

	//Tipo de grafico
	switch ($dataOptions) {
		//Normal
		case 1:
			$dopts = 'textinfo: "label+percent", textposition: "inside", automargin: true';
			break;
		//Valores fuera
		case 2:
			$dopts = 'textinfo: "label+percent", textposition: "outside", automargin: true';
			break;
		//Donut Chart
		case 3:
			$dopts = 'hole: .4,';
			break;
		default:
			$dopts = '';
	}
	//Tipo de grafico
	switch ($layoutOptions) {
		//Normal
		case 1:
			$lopts = 'showlegend: false,';
			break;
		default:
			$lopts = '';
	}

	/*************************************************/
	//imprime
	$graph  = '<div id="'.$idDiv.'"></div>';
	$graph .= '<script>';
		$graph .= $values;
		$graph .= $labels;

		$graph .='
		//se arman datos
		var dataPlotly = [{
			values: allValues,
			labels: allLabels,
			name: allLabels,
			type: \'pie\',
			automargin: true,';
			$graph .= $dopts;
			$graph .= '

		}];

		/*****************************************************************/
		var layout = {
			title: \''.$titulo.'\',
			width: \''.$width.'\',
			height: \''.$height.'\',
			margin: {"t": 45, "b": 0, "l": 0, "r": 0},';
			$graph .= $lopts;
		 $graph .= '
		};
		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';

	return $graph;

}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion Normal)
function GraphBarrLat_1($idDiv,
						$titulo, $eje_x_titulo, $eje_y_titulo,
						$xData, $yData, $Name, $hoverinfo, $markerColor, $markerLine,
						$type, $legendOptions){

	//Tipo de grafico
	switch ($type) {
		case 1:  $typeopts = 'group'; break;
		case 2:  $typeopts = 'stack'; break;
		default: $typeopts = '';
	}

	//Opciones del legend
	switch ($legendOptions) {
		//Legend abajo
		case 1:
			$lopts = 'legend: {"orientation": "h",x: 0,  y: -1, bgcolor: "#E2E2E2", bordercolor: "#FFFFFF", borderwidth: 2}';
			break;
		//Legend dentro al lado izquierdo superior
		case 2:
			$lopts = 'legend: {x: 0,y: 1, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho superior
		case 3:
			$lopts = 'legend: {x: 1,y: 1, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado izquierdo inferior
		case 4:
			$lopts = 'legend: {x: 0,y: 0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho inferior
		case 5:
			$lopts = 'legend: {x: 1,y: 0, bgcolor: \'rgba(255, 255, 255, 0)\',bordercolor: \'rgba(255, 255, 255, 0)\'},';
			break;
		//Legend dentro al lado derecho inferior
		case 6:
			$lopts = 'margin: {l: 300, r: 0, t: 100, b: 100 },height: 600,';
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
		$graph .= $Name;
		$graph .= $hoverinfo;
		$graph .= $markerColor;
		$graph .= $markerLine;

		$graph .='
		//se arman datos
		var dataPlotly = [];
		for ( var i = 0 ; i < xData.length ; i++ ) {
			var result = {
				x: xData[i],
				y: yData[i],
				type: \'bar\',
				name: names[i],
				orientation: \'h\',
				text: xData[i].map(String),
				textposition: \'auto\',
				hoverinfo: \'grf_info[i]\',
				marker: {
					color: \'markerColor[i]\',
					line: {
						color: \'markerLine[i]\',
						width: 1.5
					}
				}
			};
			dataPlotly.push(result);
		}
		/*****************************************************************/
		var layout = {
			title: \''.$titulo.'\',
			barmode: \''.$typeopts.'\',';
			if(isset($eje_x_titulo)&&$eje_x_titulo!=''){ $graph .= 'xaxis: {title: \''.$eje_x_titulo.'\',titlefont: {size: 16,color: \'rgb(107, 107, 107)\'},tickfont: {size: 14,color: \'rgb(107, 107, 107)\'}},';}
			if(isset($eje_y_titulo)&&$eje_y_titulo!=''){ $graph .= 'yaxis: {title: \''.$eje_y_titulo.'\',titlefont: {size: 16,color: \'rgb(107, 107, 107)\'},tickfont: {size: 14,color: \'rgb(107, 107, 107)\'}},';}
			$graph .= $lopts;
		 $graph .= '
		};
		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';

	return $graph;

}
/*******************************************************************************************************************/
//Crea un grafico lineal (Seleccion Normal)
function GraphEmbudo_1($idDiv, $titulo, $xData, $yData,$width,$height, $Options){

	//Opciones del legend
	switch ($Options) {
		case 1:
			$lopts = 'margin: {l: 300, r: 0, t: 100, b: 100 },';
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

		$graph .='
		var dataPlotly = [
			{
				type: \'funnel\',
				y: yData,
				x: xData,
				textposition: "inside",
				textinfo: "value+percent initial",
				hoverinfo: "percent total+x",
				opacity: 0.65,
				marker: {
					color: ["59D4E8", "DDB6C6", "A696C8", "67EACA", "94D2E6", "59D4E8", "DDB6C6", "A696C8", "67EACA", "94D2E6", "59D4E8", "DDB6C6", "A696C8", "67EACA", "94D2E6"],
					line: {
						"width": [4, 2, 2, 3, 1, 1],
						color: ["3E4E88", "606470", "3E4E88", "606470", "3E4E88", "3E4E88", "606470", "3E4E88", "606470", "3E4E88", "3E4E88", "606470", "3E4E88", "606470", "3E4E88"]
					}
				},
				connector: {
					line: {
						color: "royalblue",
						dash: "dot",
						width: 3
					}
				}
			}
		];

		/*****************************************************************/
		var layout = {
			title: \''.$titulo.'\',
			width: \''.$width.'\',
			height: \''.$height.'\',';
			$graph .= $lopts;
		 $graph .= '
		};
		var config = {
			locale: \'es-ar\',
			displayModeBar: true,
			modeBarButtonsToRemove: [\'select2d\', \'lasso2d\', \'zoomIn2d\', \'zoomOut2d\'],
			displaylogo: false,
			responsive: true
		};

		Plotly.newPlot(\''.$idDiv.'\', dataPlotly, layout, config);
	</script>';

	return $graph;

}

?>
