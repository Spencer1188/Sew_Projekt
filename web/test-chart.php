<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="chart-container" style="position: relative; height:20vh; width:40vw">
		<canvas id="chart"></canvas>
	</div>
	
	<p id="ausgabe"></p>
	<script src="asserts/js/chart.js"></script>
</body>
	<script>
		var d = new Date();
		
		if((d.getMonth()+1) < 9){
			month = "0"+(d.getMonth()+1);
		}else{
			month = (d.getMonth()+1);
		}
		var date = d.getDate() + "" + month + "" + d.getFullYear();
		
		
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
            data: [getValBuys(getdatesub(1)), 10, 5, 2, 20]
        }]
	},
	});
		
		function getdatesub(tag){
			var date = d.getDate() - tag + "" + month + "" + d.getFullYear();
			return date;
		}
		
		function getdateadd(tag){
			var date = d.getDate() + tag + "" + month + "" + d.getFullYear();
			return date;
		}
		
		function getValBuys(tag){

			const Http = new XMLHttpRequest();
			const url = "api/sendjson.php?op=daybyday&day="+tag;
			var anz;
			
			Http.open("Get",url);
			Http.send();
			Http.onreadystatechange=(e)=>{
				
				document.getElementById("ausgabe").innerHTML = Http.responseText;
		
				var a = JSON.parse(Http.responseText);
				anz =  a[0].anz;
				
			}
			return anz;
			
		}
	
	</script>
</html>