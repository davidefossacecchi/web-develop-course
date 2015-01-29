<?php
	$url="http://api.openweathermap.org/data/2.5/weather?q=".$_GET["location"];
	$json=file_get_contents($url);
	$weather = json_decode($json, true);
	echo $weather["weather"][0]["main"];
?>