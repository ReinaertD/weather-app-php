<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="" type="text/css">
	<title> 5 Day Weather Forecast</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<!-- PHP START -->
			<?php
			// API REQUEST
			$weatherLink = "http://api.openweathermap.org/data/2.5/forecast?q=Gent&units=metric&APPID=eb65fb39b35a837db45ed4f5089cbae6";
			$dataRequest = curl_init($weatherLink);
			curl_setopt($dataRequest, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($dataRequest);
			$_result = json_decode($response, true);
			// START WEATHER APP
			$_days = $_result['list'];
			$_date = $_days[0];
			var_dump($_date);
			echo "<table><tr>" . $_date;
				foreach ($_days as $day => $weather) {
					if ($day % 8 === 0) {
						echo "<td>LOL</td>";
					}
			}
			echo "</tr></table>"
			?>
		</div>
	</div>

</body>

</html>