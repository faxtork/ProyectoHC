<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="http://146.83.181.9/~sesparza/ProyectoHC/public/js/jquery.js" type="text/javascript"></script>

	<script type="text/javascript" src="http://146.83.181.9/~sesparza/ProyectoHC/public/js/Chart.js"></script>

</head>
<body>
<input type="text" id="datepicker">
<canvas id="chart-area2" width="300" height="300"></canvas>
</body>
</html>
<script>
 $(document).ready(function() {
	            $("#datepicker").change(function() {
              
          			piechart(20,50);
					//alert(myPie2);
          				window.myPie2.destroy();

          			piechart(60,10);
          			          				window.myPie2.destroy();

          			piechart(20,70);


								
				                    });  
            });
</script>
	<script>
	function piechart(var1,var2){

					//	window.myPie2 = new Chart(ctx2).Pie();
					//window.myPie2.destroy();
						var pieData2 = [
						{
							value: var1,
							color:"#0b82e7",
							highlight: "#0c62ab",
							label: "Asistieron"},
						{
							value: var2,
							color: "#e3e860",
							highlight: "#a9ad47",
							label: "Ausencia"
						}
					];
						var ctx2 = document.getElementById("chart-area2").getContext("2d");
						window.myPie2=new Chart(ctx2).Pie(pieData2);
	}

	</script>

