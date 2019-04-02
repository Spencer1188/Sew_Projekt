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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <a class="nav-link" href="mainface.php">Übersicht</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="buylist.php">Einkaufsliste</a>
    </li>
  </ul>
</nav>
	
	<div class="jumbotron">
  <h1 class="display-4">Ihre Übersicht</h1>
  <p class="lead">Alles was wichtig ist Zusammengefasst</p>
  <hr class="my-4">
</div>
	<section id="widget-chart-day" class="container">
		<div class="row" >
			<div class="col-lg-6 col-sm-12 text-center">
				<h1>Tagesansicht</h1>
				<canvas id="chart-day"></canvas>
				<button onClick="last_day()" class="btn btn-outline-dark">
					<i class="fas fa-arrow-left"></i>
				</button>				
				<button onClick="reset_day()" class="btn btn-outline-dark">
					<i class="fas fa-undo"></i>
				</button>
				<button onClick="next_day()" class="btn btn-outline-dark">
					<i class="fas fa-arrow-right"></i>
				</button>
			</div>
			<div class="col-lg-6 col-sm-12">
				<h1 style="color: white"></h1>
				<canvas id="chart-items"></canvas>
			</div>
		</div>
	</section><br><br><br>	
	<section id="widget-chart-month" class="container">
		<div class="row" >
			<div class="col-lg-6 text-center">
				<h1>Monatsansicht</h1>
				<canvas id="chart-month"></canvas>
				<button onClick="last_month()" class="btn btn-outline-dark">
					<i class="fas fa-arrow-left"></i>
				</button>
				<button onClick="reset_month()" class="btn btn-outline-dark">
					<i class="fas fa-undo"></i>
				</button>
				<button onClick="next_month()" class="btn btn-outline-dark">
					<i class="fas fa-arrow-right"></i>
				</button>
			</div>
			<div class="col-lg-6 text-center">
				<h1>Meist gekaufte Artikel</h1>
				<canvas id="chart-most"></canvas>
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
		var chartday;
		var chartmonth;
		var d = new Date();
		var m = new Date();
		if((d.getMonth()+1) < 9){
			month = "0"+(d.getMonth()+1);
		}else{
			month = (d.getMonth()+1);
		}
		if(d.getDate() < 9){
			day = "0"+d.getDate();
		}else{
			day = d.getDate();
		}
		var date = d.getFullYear() + "-" + month + "-" + day;
		var datem = d.getFullYear() + "-" + month + "-" + day;
		const aktdate = d.getFullYear() + "-" + month + "-" + day;
	
	//Set Charts
	window.onload = function () {
		DrawChartDays(usrid,0);	
		DrawChartMonth(usrid,0);
		DrawChartMost(usrid);

    }

	function last_day(){
		DrawChartDays(usrid,1);
	}
		
	function next_day(){
		DrawChartDays(usrid,2);
	}
		
	function last_month(){
		DrawChartMonth(usrid,1);
	}
		
	function next_month(){
		DrawChartMonth(usrid,2);
	}
		
	function reset_day(){
		DrawChartDays(usrid,3);
	}
			
	function reset_month(){
		DrawChartMonth(usrid,3);
	}
			
// Draw Chart for the 5 Days		
	function DrawChartDays(usrid,val){
	
		if(val == 1){
				d.setDate(d.getDate() - 1);
				if((d.getMonth()+1) < 9){
					month = "0"+(d.getMonth()+1);
				}else{
					month = (d.getMonth()+1);
				}
				if(d.getDate() < 9){
					day = "0"+d.getDate();
				}else{
					day = d.getDate();
				}
				date = d.getFullYear() + "-" + month + "-" + day;
		}
		
		if(val == 2){
				d.setDate(d.getDate() + 1);
				if((d.getMonth()+1) < 9){
					month = "0"+(d.getMonth()+1);
				}else{
					month = (d.getMonth()+1);
				}
				if(d.getDate() < 9){
					day = "0"+d.getDate();
				}else{
					day = d.getDate();
				}
				date = d.getFullYear() + "-" + month + "-" + day;
		}
		
		if(val == 3){
				date = aktdate;
		}
			if(val == 1 || val == 2 || val == 3){
				chartday.reset();
			}
		
		const url = "api/sendjson.php?op=daybyday&date="+date+"&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){

					var ctxday = document.getElementById("chart-day");
					chartday = new Chart(ctxday,{
					// The type of chart we want to create
					type: 'line',
					// The data for our dataset
					data: {
						labels: result[0].reverse(),
						datasets: [{
							label: 'Einkäufe',
							backgroundColor: '#42a5f5',
							borderColor: '#42a5f5',
							data: result[1].reverse()
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
					});
					if(val == 1 || val == 2 || val == 3){
						chartday.update();
					}
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
		
	function DrawChartMonth(usrid,val){
	
		if(val == 1){
				m = new Date(getDateMonthsBefore(m,1));
				if((m.getMonth()+1) < 9){
					month = "0"+(m.getMonth()+1);
				}else{
					month = (m.getMonth()+1);
				}
				if(m.getDate() < 9){
					day = "0"+m.getDate();
				}else{
					day = m.getDate();
				}
				datem = m.getFullYear() + "-" + month + "-" + day;
		}
			
		if(val == 2){
				m = new Date(getDateMonthsAfter(m,1));
				if((m.getMonth()+1) < 9){
					month = "0"+(m.getMonth()+1);
				}else{
					month = (m.getMonth()+1);
				}
				if(m.getDate() < 9){
					day = "0"+m.getDate();
				}else{
					day = m.getDate();
				}
				datem = m.getFullYear() + "-" + month + "-" + day;
		}
		
		if(val == 3){
				datem = aktdate;
		}
		
		if(val == 1 || val == 2 || val == 3){
			chartmonth.reset();
		}
		
		
		const url = "api/sendjson.php?op=monthbymonth&date="+datem+"&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){

					var ctxday = document.getElementById("chart-month");
					chartmonth = new Chart(ctxday,{
					// The type of chart we want to create
					type: 'line',
					
					// The data for our dataset
					data: {
						labels: result[0].reverse(),
						datasets: [{
							label: 'Einkäufe',
							backgroundColor: '#42a5f5',
							borderColor: '#42a5f5',
							data: result[1].reverse()
						}]
					},				
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
					});
					if(val == 1 || val == 2 || val == 3){
						chartmonth.update();
					}
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
		

		  }
			
		function DrawChartMost(usrid){
			const url = "api/sendjson.php?op=most&usrid="+usrid;
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){

					var ctxmost = document.getElementById("chart-most");
					var myBarChart = new Chart(ctxmost, {
						type: 'bar',
						data: {
						  labels: result[0],
						  datasets: [
							{
							  label: "Artikelmenge",
							  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
							  data: result[1]
							}
						  ]
						}
					});
					
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
		}
		
		
function getDateMonthsBefore(date,nofMonths) {
    var thisMonth = date.getMonth();
    date.setMonth(thisMonth - nofMonths);
    if ((thisMonth - nofMonths < 0) && (date.getMonth() != (thisMonth + nofMonths))) {
        date.setDate(0);

    } else if ((thisMonth - nofMonths >= 0) && (date.getMonth() != thisMonth - nofMonths)) {
        date.setDate(0);
    }
    return date;
}
		
function getDateMonthsAfter(date,nofMonths) {
    var thisMonth = date.getMonth();
    var thisYear = date.getFullYear();
    date.setMonth(thisMonth + nofMonths);
    if ((thisMonth + nofMonths > 11) && (date.getMonth() != (thisMonth - nofMonths))) {
       date.setMonth(0);
       date.setFullYear(thisYear+1);
        /* date.setDate(0);
        alert("i am here: currentDate:" + date);*/
    } else if ((thisMonth + nofMonths <= 11) && (date.getMonth() != (thisMonth + nofMonths))) {
        date.setDate(0);
    }
    return date;
}


</script>
</html>