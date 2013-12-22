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
		Div.graph {
			width: 45%;
			float: left;
		}
	</style>
	
	<script type="text/javascript">	
		jQuery(document).ready(function()
		{
			console.log("Creating Graphs");
			$('#accPerBuild').highcharts({
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
						text: 'Total Accidents'
					}
				},
				series: <?php echo $series_data;?>
			});
			
			
			$('#accPerRate').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'Accidents per severity'
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
				name: 'Percent with specified severity',
				data: <?php $count = 0;
							echo '[ ';
							foreach($severity_data as $severity) {
								echo '[\'' . $severity['name'] . '\', ' . $severity['data'] . ']'; 
								if($count != count($time_data)-1)
								{
									$count++;
									echo ', ';
								}
							} echo '] ';?>
			}]
			});
			
			
			$('#accPerTime').highcharts({
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
				name: 'Percent occuring within time range',
				data: <?php $count = 0;
							echo '[ ';
							foreach($time_data as $time) {
								echo '[\'' . $time['name'] . '\', ' . $time['data'] . ']'; 
								if($count != count($time_data)-1)
								{
									$count++;
									echo ', ';
								}
							} echo '] ';?>
			}]
			});
		});
	</script>
</head>

<body>
	<div class="graph" id="accPerBuild">
	</div>
	
	<div class="graph" id="accPerRate">
	</div>
	
	<div class="graph" id="accPerTime">
	</div>
</body>

</html>