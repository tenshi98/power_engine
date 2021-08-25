<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
//Crea un grafico lineal
function GraphLinear_1($idDiv, 
						$titulo, $eje_x_titulo, $eje_y_titulo, 
						$xData, $yData, $names, $types, $texts, $lineColors, $lineDash, $lineWidth){
	
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
		var layout = {
			title:\''.$titulo.'\',
			xaxis: {title: \''.$eje_x_titulo.'\', showticklabels: labelview},
			yaxis: {title: \''.$eje_y_titulo.'\'}
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
	
	echo $graph;
	
}
/*******************************************************************************************************************/
//Crea un grafico lineal
function GraphLinear_2($idDiv, 
						$titulo, $eje_x_titulo, $eje_y_titulo, 
						$xData, $yData, $names, $types, $texts, $lineColors, $lineDash, $lineWidth){
	
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
			yaxis: {title: \''.$eje_y_titulo.'\'}
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
	
	echo $graph;
	
}

?>
