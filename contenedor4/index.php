<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html>
 	<head>
 		<title>Smart Trash</title>			
 		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
 		<?php require_once 'navbar.php' ?>
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-more.js"></script>
		<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
	</head>
 	
	<body>
 		<center><h1 class="title is-1">Smart Trash - Contenedor 4</h1></center><br>
 				
		<div id="dashboard">
			
			<div class="columns">
				<div class="column">
					<!--<div style="width: 600px; height: 200px;">-->
					<div class="columns">
					<div class="column">
							<center><br><br><div id="container-tmp" style="width: 300px; height: 200px; "></div></center>
						</div>
						<div class="column">
							<center><br><br><div id="container-humid" style="width: 300px; height: 200px; "></div></center>
						</div>
					</div>
				</div>

			</div>
			
			<div class="columns">
				<div class="column">
					<!--<div style="width: 600px; height: 200px;">-->
					<div class="columns">
						<div class="column">
							<center><br><br><br>
						<div id="container-lvl" style="width: 300px; height: 200px; "></div></center>
						</div>
						<div class="column">		
							<center><div id="container-mois" style="min-width: 150px; max-width: 150px; height: 150px; margin: 0 auto; display:none"></div></center>
							<center><div id="container-flame" style="min-width: 150px; height: 150px; max-width: 150px; margin: 0 auto"></div></center>
						</div>
					</div>
				</div>
			</div>	
			<div class="columns">
				<div class="column">
					<center><div id="container-usage" style="min-width: 300px; height: 300px; margin: 0 auto"></div><center>
				</div>
				<div class="column">
					<center><div id="concon" style="min-width: 300px; height: 300px; margin: 0 auto"></div><center>
				</div>
			</div>
			<!--live-->
			
		</div>
	</body>
	<?php require_once 'footer.php' ?>
</html>


<script type="text/javascript">					
	var gaugeOptions = {
		chart: {
		type: 'solidgauge'
		},
	title: null,
	pane: {
		center: ['50%', '85%'],
		size: '150%',
		startAngle: -90,
		endAngle: 90,
		background: {
			backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
			innerRadius: '60%',
			outerRadius: '100%',
			shape: 'arc'
			}
		},
	tooltip: {
		enabled: false
		},
					
	// el eje de valores
	yAxis: {
		stops: [
		[0.1, '#82daff'], // azul
		[0.5, '#9483ff'], // morado
		[0.9, '#ca74ff']  // violeta
		],
		lineWidth: 0,
		minorTickInterval: null,
		tickAmount: 2,
		title: {
			y: -70
			},
		labels: {
			y: 16
			}
		},
	plotOptions: {
		solidgauge: {
			dataLabels: {
				y: 5,
				borderWidth: 0,
				useHTML: true
				}
			}
		}
	};
		
	// Medidor de Temperatura
	var chartTmp = Highcharts.chart('container-tmp', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 80,
			title: {
				text: 'Temperatura'
				}
			},
						
		credits: {
			enabled: false
			},
						
		series: [{
			name: 'Temperatura',
			data: [0],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:25px;color:' +
				((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
				'<span style="font-size:12px;color:gray">°C</span></div>'
				},
			tooltip: {
				valueSuffix: ' revolutions/min'
				}
			}]
					
		}));
						
	// Indicador de la Humedad
	var chartHumid = Highcharts.chart('container-humid', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 100,
			title: {
				text: 'Humedad'
				}
			},
		credits: {
			enabled: false
			},

		series: [{
			name: 'Humedad',
			data: [0],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:25px;color:' +
				((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
				'<span style="font-size:12px;color:gray">%</span></div>'
				},
			tooltip: {
				valueSuffix: ' revolutions/min'
				}
			}]
		}));
								
	// Indicador de nivel
	var chartLvl = Highcharts.chart('container-lvl', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 100,
			title: {
			text: 'Nivel'
				}
			},
		credits: {
			enabled: false
			},

		series: [{
			name: 'Nivel',
			data: [0],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:25px;color:' +
				((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
				'<span style="font-size:12px;color:gray">%</span></div>'
				},
			tooltip: {
			valueSuffix: ' km/hr'
				}
			}]
		}));
								

		
	var chartMoi = Highcharts.chart('container-mois', {

		chart: {
			type: 'gauge',
			plotBackgroundColor: null,
			plotBackgroundImage: null,
			plotBorderWidth: 0,
			plotShadow: false
		},

		title: {
			text: 'Humedad'
		},
		
		credits: {
			enabled: false
			},

		pane: {
			startAngle: -150,
			endAngle: 150,
			background: [{
				backgroundColor: {
					linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
					stops: [
						[0, '#FFF'],
						[1, '#FFF']
					]
				},
				borderWidth: 0,
				outerRadius: '109%'
			}, {
				backgroundColor: {
					linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
					stops: [
						[0, '#FFF'],
						[1, '#FFF']
					]
				},
				borderWidth: 1,
				outerRadius: '107%'
			}, {
				backgroundColor: '#000',
				borderWidth: 0,
				outerRadius: '105%',
				innerRadius: '103%'
			}]
		},

		// eje de valores
		yAxis: {
			min: 0,
			max: 6,

			minorTickInterval: 'auto',
			minorTickWidth: 0,
			minorTickLength: 8,
			minorTickPosition: 'inside',
			minorTickColor: '#666',

			tickPixelInterval: 30,
			tickWidth: 0,
			tickPosition: 'inside',
			tickLength: 10,
			tickColor: '#666',
			labels: {
				step: 2,
				rotation: 'auto'
			},
			title: {
				text: ''
			},
			
			
			plotBands: [{
				from: 0,
				to: 1,
				color: '#ca74ff' 
			}, {
				from: 1,
				to: 2,
				color: '#58ACFA' // morado
			}, {
				from: 2,
				to: 3,
				color: '#82daff' // azul
			}, {
				from: 3,
				to: 4,
				color: '#82daff' // azul
			}, {
				from: 4,
				to: 5,
				color: '#58ACFA' // violeta
			}, {
				from: 5,
				to: 6,
				color: '#ca74ff' // violeta
			}]
		},

		series: [{
			name: 'Humedad',
			data: [0],
			tooltip: {
				valueSuffix: '%'
			}
		}]

	});

	var chartUsage = Highcharts.chart('container-usage', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Uso del contenedor en cada hora'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: [
            '10.00',
            '11.00',
            '12.00',
            '13.00',
            '14.00',
            '15.00',
            '16.00',
			'17.00',
            '18.00',
            '19.00',
            '20.00',
			'21.00'
        ],
        plotBands: [{ // visualizar el fin de semana
            from: 10.5,
            to: 12,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Abierto'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' Veces'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Contenedor',
        data: [10, 11, 12, 10, 5, 4, 2,2,7,7,6,5]
    }]
});
	
	// Hace que arranquen los medidores
	setInterval(function () {
		var point,
		newVal,
		inc,
		i;
		
		// Temperatura
		if (chartTmp) {
			$.getJSON('/Smart Trash/contenedor4/php/newdata.php',function(data)
				{
				point = chartTmp.series[0].points[0];
				point.y = data[0].temp;
				newVal = point.y - 0;		
				point.update(newVal);
				});
			}
						
		// Humedad
		if (chartHumid) {
			$.getJSON('/Smart Trash/contenedor4/php/newdata.php',function(data)
			{
				point = chartHumid.series[0].points[0];
				point.y = data[0].humid;
				newVal = point.y - 0;		
				point.update(newVal);
				});
			}
		
		// Nivel
		if (chartLvl) {
			$.getJSON('/Smart Trash/contenedor4/php/newdata.php',function(data)
			{
				point = chartLvl.series[0].points[0];
				point.y = data[0].lvl;
				newVal = point.y - 0;		
				point.update(newVal);
				});
			}

		// Humedad
		if (chartMoi) {
			$.getJSON('/Smart Trash/contenedor4/php/newdata.php',function(data)
			{
				point = chartMoi.series[0].points[0];
				point.y = data[0].mois;
				newVal = point.y - 0;		
				point.update(newVal);
				});
			}
			
		}, 3000);
		

	
	Highcharts.setOptions({
		global: {
			useUTC: false
		}
	});

	Highcharts.chart('concon', {
		chart: {
			type: 'spline',
			animation: Highcharts.svg, 
			marginRight: 10,
			events: {
				load: function () {

					// configura la actualización del gráfico cada segundo
					var series = this.series;
					
					setInterval(function () {
						$.getJSON('/Smart Trash/contenedor4/php/newdata.php',function(data){
							var x = (new Date()).getTime(), // tiempo actual
							 temp = parseInt(data[0].temp);
							var humid = parseInt(data[0].humid),
							y=temp,
							z=humid;
							series[0].addPoint([x, y], true);
							series[1].addPoint([x, z], true);
							});
						
			 
					}, 3000);
				}
			}
		},
		title: {
			text: 'Temperatura y Humedad en vivo'
		},
		xAxis: {
			type: 'datetime',
			tickPixelInterval: 150
		},
		yAxis: {
			title: {
				text: 'Temperatura(C) Humedad(%)'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function () {
				return '<b>' + this.series.name + '</b><br/>' +
					Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
					Highcharts.numberFormat(this.y, 2);
			}
		},
		legend: {
			enabled: true
		},
		exporting: {
			enabled: false
		},
		credits: {
			enabled: false
			},
		series: [{
			name: 'Temperatura',
			data: [],
			color: '#222f3e'
		},{
			name: 'Humedad',
			data: [],
			color: '#10ac84'
		}]
	});

	// Setea los colores
	Highcharts.setOptions({
		colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
			return {
				radialGradient: {
					cx: 0.5,
					cy: 0.3,
					r: 0.7
				},
				stops: [
					[0, color],
					[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
				]
			};
		})
	});

	setInterval(function () {
		$.getJSON('/Smart Trash/contenedor4/php/firedata.php',function(data)
			{
			fme = data[0].fire;
			//console.log(data[0].fire);
			if(fme == 1)
				{
				// Fuego
					Highcharts.chart('container-flame', {
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
						},
						title: {
							text: 'Fuego'
						},
						tooltip: {
							pointFormat: '' /*'{series.data}' : <b>{point.percentage:.1f}%</b>'*/
						},
						plotOptions: {
							pie: {
								animation: false,
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									},
									connectorColor: 'silver'
								}
							}
						},
						credits: {
								enabled: false
								},
						
						series: [{
						name: 'Fuego',
						data: [
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'Fuego', y: 1 }
							]
						}]
						
						
					});	
				}
			if(fme == 2)
				{
					// Cerca de la llama
					Highcharts.chart('container-flame', {
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
						},
						title: {
							text: 'Fuego'
						},
						tooltip: {
							pointFormat: '' /*'{series.data}' : <b>{point.percentage:.1f}%</b>'*/
						},
						plotOptions: {
							pie: {
								animation: false,
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									},
									connectorColor: 'silver'
								}
							}
						},
						credits: {
								enabled: false
								},
						
						series: [{
						name: 'Probablemente Fuego',
						data: [
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'Probablemente Fuego', y: 1 }
							]
						}]
						
						
					});	
				}
			if(fme == 3)
				{
					// No Fuego
					Highcharts.chart('container-flame', {
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
						},
						title: {
							text: 'Fuego'
						},
						tooltip: {
							pointFormat: '' /*'{series.data}' : <b>{point.percentage:.1f}%</b>'*/
						},
						plotOptions: {
							pie: {
								animation: false,
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									},
									connectorColor: 'silver'
								}
							}
						},
						credits: {
								enabled: false
								},
						
						series: [{
						name: 'No Fuego',
						data: [
								{ name: 'x', y: 0 },
								{ name: 'x', y: 0 },
								{ name: 'No Fuego', y: 1 }
							]
						}]
						
						
					});	
				}
			});
		}, 2000);



</script>

