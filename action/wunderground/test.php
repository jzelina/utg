<?php 

# disable Error and Warnings
error_reporting(E_ALL & ~E_NOTICE);

@include("key.php");

#$json_string = file_get_contents("http://api.wunderground.com/api/".$key."/geolookup/conditions/q/IA/Cedar_Rapids.json"); 
$json_string = file_get_contents("http://api.wunderground.com/api/".$key."/conditions/q/zmw:00000.10.10389.json"); 

$parsed_json = json_decode($json_string); 
$weather["location"] = $parsed_json->{'current_observation'}->{'display_location'}->{'city'}; 
$weather["temp_c"] = $parsed_json->{'current_observation'}->{'temp_c'};
$weather["weather"] = $parsed_json->{'current_observation'}->{'weather'};
$weather["wind_kph"] = $parsed_json->{'current_observation'}->{'wind_kph'};
$weather["local_epoch"] = $parsed_json->{'current_observation'}->{'local_epoch'};

header("Content-Type: text/xml; charset=UTF-8");
$out = '<?xml version="1.0" encoding="UTF-8"?>';
$out .= '<AastraIPPhoneTextScreen destroyOnExit="yes"';
if ($object[0]["okurl"] != "") { $out .= ' doneAction="'.$terminal['ME'].'?read='.$object[0]["okurl"].'"';}
if ($object[0]["okurl"] != "") { $out .= ' cancelAction="'.$terminal['ME'].'?read='.$object[0]["cancelurl"].'"';}
$out .= '>';
$out .= '<Title>Weather in '.$weather["location"].'</Title>';
$out .= '<Text>Current Temp:'.$weather["temp_c"].' Weather: '.$weather["weather"].'</Text>';
$out .= '</AastraIPPhoneTextScreen>';
echo $out;
?>