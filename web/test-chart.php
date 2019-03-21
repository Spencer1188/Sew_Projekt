<html>
<head>
</head>
<body>
	<canvas id="chart"></canvas>
	
	<script src="asserts/js/chart.js"></script>
</body>
	<script>
		var ctx = document.getElementById("chart");
		var chart = new Chart(ctx,{
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
	},
	});
	
	</script>
</html>