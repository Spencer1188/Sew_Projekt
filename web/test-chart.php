<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="chart-container" style="position: relative; height:20vh; width:40vw">
		<canvas id="chart"></canvas>
	</div>
	<br><br><br><br>
	<p id="ausgabe"></p>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="asserts/js/chart.js"></script>
	<script src="asserts/js/my-main.js"></script>
</body>
	<script>
	window.onload = function () {
		getValBuys();
    }
		
			var d = new Date();
			if((d.getMonth()+1) < 9){
				month = "0"+(d.getMonth()+1);
			}else{
				month = (d.getMonth()+1);
			}
			var date = d.getDate() + "" + month + "" + d.getFullYear();
		
		function getValBuys(){
			
		var d = new Date();
		
		if((d.getMonth()+1) < 9){
			month = "0"+(d.getMonth()+1);
		}else{
			month = (d.getMonth()+1);
		}
		var minday = d.getDate()-4 
		var date = month + "" + d.getFullYear();

		const url = "api/sendjson.php?op=daybyday&day="+minday+"&date="+date;

			
			$.ajax({
				url: url,
				contentType: "application/json",
				dataType: 'json',
				success: function(result){
					
					drawchartday(result);
				},
				error: function(thrownError){
					alert("error");
				}
				
			});
		  }
		
		function drawchartday(result){

			
			var ctx = document.getElementById("chart");
			var chart = new Chart(ctx,{
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
		}

	</script>
</html>