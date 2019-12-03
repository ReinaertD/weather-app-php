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
		<div class="row justify-content-center">
			<div class="col-6 d-flex justify-content-center flex-column">
				<input id="city" class="text-center">
				<button id="showWeather">DISCOVER THE UPCOMING WEATHER</button>
			</div>
		</div>
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
				foreach ($_days as $day => $weather) {
					if ($day % 8 === 0) {
						$timestamp = $weather['dt'];
						$day = new DateTime("@$timestamp");
						//var_dump($day);
						echo "<div class=\"col-sm\"><div class=\"card\">";
						echo "<div class=\"card-title\">$weather[dt_txt]";
						//var_dump($weather[main][temp]);
						echo "<div class=\"card-body\">";
						echo "<table><tbody>";
						echo "<tr><th>Current Temp</th><td>" . $weather[main][temp] . "</td>";
						echo "<tr><th>Min. Temp</th><td>" . $weather[main][temp_min] . "</td>";
						echo "<tr><th>Max. Temp</th><td>" . $weather[main][temp_max] . "</td>";
						echo "<tr><th>Wind Speed</th><td>" . $weather[wind][speed] . "</td>";
						echo "<tr><th>Wind Direction</th><td>" . $weather[wind][deg] . "</td>";
						echo "</tbody></table>";
						echo "</div></div>";
						echo "</div></div>";
					}
			}
			?>
		</div>
	</div>

</body>

</html>