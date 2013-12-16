<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME ?> | <?php echo $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url("img/favicon.png") ?>">
	<script type="text/javascript" src="http://localhost/chemlabaccs/js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="http://localhost/chemlabaccs/highcharts/Highcharts-3.0.7/js/highcharts.js"></script>
	
	<style type="text/css">
		Div#bar {
			width: 45%;
			float: left;
		}
		Div#pie {
			width: 45%;
			float: left;
		}
	</style>
	
	<script type="text/javascript">	
		jQuery(document).ready(function()
		{
			console.log("Creating Graphs");
			$('#bar').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Accidents by Building'
				},
				xAxis: {
					categories: ['Chemistry', 'Biology', 'Physics']
				},
				yAxis: {
					title: {
						text: 'Accidents per Month'
					}
				},
				series: <?php echo $series_data;?>
			});
			
			
			$('#pie').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'Accidents per time of day'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Accidents Percent',
				data: [
					['Noon-2',   45.0],
					['8-10',       26.8],
					{
						name: '10-noon',
						y: 12.8,
						sliced: true,
						selected: true
					},
					['2-4',    8.5],
					['4-6',     6.2],
					['Others',   0.7]
				]
			}]
			});
		});
	</script>
</head>

<body>
	<div id="bar">
	</div>
	
	<div id="pie">
	</div>
</body>

</html>