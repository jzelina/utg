<?php

### WUNDERGROUND - GET Weather
# $object = APP_WUNDERGROUND_GET_WEATHER($location,$terminal);
#
function APP_WUNDERGROUND_GET_WEATHER($location,$terminal)
	{
	@include("key.php");

	#todo: support modes (forcast, conditions)

	#$json_string = file_get_contents("http://api.wunderground.com/api/".$key."/geolookup/conditions/q/IA/Cedar_Rapids.json"); 
	$json_string = file_get_contents("http://api.wunderground.com/api/".$key."/conditions/q/".$location.".json"); 

	$parsed_json = json_decode($json_string); 
	$weather["location"] = $parsed_json->{'current_observation'}->{'display_location'}->{'city'}; 
	$weather["temp_c"] = $parsed_json->{'current_observation'}->{'temp_c'};
	$weather["weather"] = $parsed_json->{'current_observation'}->{'weather'};
	$weather["wind_kph"] = $parsed_json->{'current_observation'}->{'wind_kph'};
	$weather["local_epoch"] = $parsed_json->{'current_observation'}->{'local_epoch'};
	return $weather;
	}	

# Main
	if ($object[0]["function"] == "APP_WUNDERGROUND_GET_WEATHER")
		{
		#Get Weather > Output to TextScreen
		$weather = APP_WUNDERGROUND_GET_WEATHER($object[0]["location"],$terminal);
		$object[1] = $object[0];
		$object[0]["type"] = "TextScreen";
		$object[0]["title"] = 'Weather in '.$weather["location"];
		$object[0]["text"] = 'Current Temp:'.$weather["temp_c"].' Weather: '.$weather["weather"].' Location-Time: '.date("H:i:s", $weather["local_epoch"]);
		}
	
?>