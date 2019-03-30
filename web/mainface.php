<!doctype html>
<?php 
	session_start();
	$id = $_SESSION["id"];

echo "
   <script type=\"text/javascript\"><!--
 	var usrid = \"".$id."\";
   </script>
 ";
?>
<html>
<head>
<meta charset="utf-8">
<title>Einkaufsliste</title>
	<link type="text/css" rel="stylesheet" href="asserts/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">Logo</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="asserts/php/logout.php">Logout</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>
</nav>
	
	<div class="jumbotron">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>
	<section id="widget-chart-day" class="container">
		<div class="row" >
			<div class="col-6">
				<canvas id="chart-day"></canvas>
			</div>
			<div class="col-6">
				<canvas id="chart-items"></canvas>
			</div>
		</div>
	</section>	
	<section id="widget-chart-month" class="container">
		<div class="row" >
			<div class="col-6">
				<canvas id="chart-month"></canvas>
			</div>
		</div>
	</section>
	<br><br><br>
	<script src="asserts/js/bootstrap.js"></script>
	<script src="asserts/js/jquery.js"></script>
	<script src="asserts/js/chart.js"></script>
	<script src="asserts/js/my-main.js"></script>
</body>
	<script>
			// Set Date
			var d = new Date();
			if((d.getMonth()+1) < 9){
				month = "0"+(d.getMonth()+1);
			}else{
				month = (d.getMonth()+1);
			}
			var date = d.getDate() + "" + month + "" + d.getFullYear();
		
	//Set Charts
	window.onload = function () {
		DrawChartDays(usrid);	
    }


			
// Draw Chart for the 5 Days		
	function DrawChartDays(usrid){
		var d = new Date();
		if((d.getMonth()+1) < 9){
			month = "0"+(d.getMonth()+1);
		}else{
			month = (d.getMonth()+1);
		}
		var minday = d.getDate()-4 
		var date = month + "" + d.getFullYear();

		const url = "api/sendjson.php?op=daybyday&day="+minday+"&date="+date+"&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){
					
					var ctxday = document.getElementById("chart-day");
					var chartday = new Chart(ctxday,{
					// The type of chart we want to create
					type: 'line',
					// The data for our dataset
					data: {
						labels: [getdatesub(4),getdatesub(3), getdatesub(2), getdatesub(1), date, getdateadd(1)],
						datasets: [{
							label: 'Einkäufe',
							backgroundColor: '#42a5f5',
							borderColor: '#42a5f5',
							data: result
						}]
					},
					});
						//Show Items on onclick a Point of the Chart Item
						ctxday.onclick = function(evt){
						var activePoints = chartday.getElementsAtEvent(evt);

						if (activePoints[0]) {
							var chartData = activePoints[0]['_chart'].config.data;
							var idx = activePoints[0]['_index'];
							var seldate = chartData.labels[idx];

							if (typeof chartitems !== 'undefined') {
								// variable is undefined
								chartitems.data.labels.pop();
								chartitems.data.datasets.pop()
								chartitems.update();
							}
							getchartitems(seldate);
						  }
						}
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
		

		  }
				
// Draws the Chart for the selected Point		
	function getchartitems(date){
			const url = "api/sendjson.php?op=itemsday&day="+date+"&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){

					var data = {
						datasets: [{
							data: result[0],
							backgroundColor: result[2],
							hoverBackgroundColor: result[2]
						}],
						labels: result[1]
					};

					var ctxitems = document.getElementById("chart-items");
					chartitems = new Chart(ctxitems, {
						type: 'doughnut',
						data: data
					});
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
			
		}
// Draws the Month Chart
	function DrawChartDays(usrid){
		var d = new Date();
		if((d.getMonth()+1) < 9){
			month = "0"+(d.getMonth()+1);
		}else{
			month = (d.getMonth()+1);
		}
		var date = d.getFullYear() + "-" + month + "-" + d.getDate();

		const url = "api/sendjson.php?op=daybyday&date="+date+"&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){
					result[0].reverse();
					var ctxday = document.getElementById("chart-day");
					var chartday = new Chart(ctxday,{
					// The type of chart we want to create
					type: 'line',
					// The data for our dataset
					data: {
						labels: result[0],
						datasets: [{
							label: 'Einkäufe',
							backgroundColor: '#42a5f5',
							borderColor: '#42a5f5',
							data: result[1]
						}]
					},
					});
						//Show Items on onclick a Point of the Chart Item
						ctxday.onclick = function(evt){
						var activePoints = chartday.getElementsAtEvent(evt);

						if (activePoints[0]) {
							var chartData = activePoints[0]['_chart'].config.data;
							var idx = activePoints[0]['_index'];
							var seldate = chartData.labels[idx];

							if (typeof chartitems !== 'undefined') {
								// variable is undefined
								chartitems.data.labels.pop();
								chartitems.data.datasets.pop()
								chartitems.update();
							}
							getchartitems(seldate);
						  }
						}
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
		

		  }

</script>
</html>