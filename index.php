<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="" type="text/css">
	<title> 5 Day Weather Forecast</title>
</head>

			<!-- PHP START -->
			<?php
			// API REQUEST
			$weatherLink = "http://api.openweathermap.org/data/2.5/forecast?q=".htmlspecialchars($_POST['location'])  ."&units=metric&APPID=eb65fb39b35a837db45ed4f5089cbae6";
			$dataRequest = curl_init($weatherLink);
			curl_setopt($dataRequest, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($dataRequest);
			$_result = json_decode($response, true);
			$_days = $_result['list'];
			$_currentWeather = $_days[0][weather][0][main];
			switch($_currentWeather){
				case Rain :
					$_backgroundstatus = "rain.jpg";
				break;
				case Snow :
					$_backgroundstatus = "snow.jpg";
				break;
				case Clear :
					$_backgroundstatus = "sun.jpg";
				break;
				case Clouds :
					$_backgroundstatus = "clouds.jpg";
				break;
				default :
				$_backgroundstatus = "sun.jpg";
			}
echo "<body style=\"background: url($_backgroundstatus) no-repeat fixed center/cover ;\"  >";
echo	"<div class=\"container\" ><div class=\"row justify-content-center\"><div class=\"col-6 d-flex justify-content-center\"><form class=\"d-flex justify-content-center flex-column\" action=\"\" method=\"post\"><input class=\"text-center\" type=\"text\" name=\"location\"><input type=\"submit\" value=\"Discover the weather\"></form></div></div>";
			// START WEATHER APP
			echo "<div class=\"row justify-content-center\"> <h1 class\"text-center\" style=\"color:white;\">Weather for ". htmlspecialchars($_POST['location']). "</h1></div>";
			echo "<div class=\"card-deck\">";
				foreach ($_days as $day => $weather) {
					if ($day % 8 === 0) {
						$timestamp = $weather['dt'];
						$date = new DateTime("@$timestamp");
						$dateFormat = "l j F";
						echo "<div class=\"col d-flex justify-content-center flex-column\" style=\"border-radius:0.25rem;color:white;background-color:rgba(0,0,0,0.4);\">";
						echo "<div class=\"font-weight-bold my-2\">" . date($dateFormat,$timestamp) . "</div>" ;
						echo "<table class=\"table-striped\"><tbody>";
						echo "<tr><th>Current Temp</th><td style=\"text-align:right;\">" . $weather[main][temp] . "</td>";
						echo "<tr><th>Wind Speed</th><td style=\"text-align:right;\">" . $weather[wind][speed] . "</td>";
						echo "<tr><th>Wind Direction</th><td style=\"text-align:right;\">" . $weather[wind][deg] . "</td>";
						echo "<tr><th>Weather</th><td class=\"small\" style=\"text-align:right;\">" . $weather[weather][0][main] . "</td>";
						echo "</tbody></table>";
						echo "</div>";
					}
			}
			echo "</div>";
			?>
		</div>

</body>

</html>