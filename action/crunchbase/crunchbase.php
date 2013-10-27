<?php 

# disable Error and Warnings
error_reporting(E_ALL & ~E_NOTICE);

### CRUNCHBASE - GET Company
# $object = APP_CRUNCHBASE_GET_COMPANY($company,$terminal);
#
function APP_CRUNCHBASE_GET_COMPANY($company,$terminal)
	{
	@include("key.php");

	$json_string = file_get_contents("http://api.crunchbase.com/v/1/company/".$company.".js?api_key=".$key); 

	$parsed_json = json_decode($json_string); 
	#print_r($parsed_json);

	$crunch["name"] = $parsed_json->{'name'};
	$crunch["founded_year"] = $parsed_json->{'founded_year'};
	$crunch["description"] = $parsed_json->{'description'};
	$crunch["overview"] = $parsed_json->{'overview'};
	return $crunch;
	}

# Main
	if ($object[0]["function"] == "APP_CRUNCHBASE_GET_COMPANY")
		{
		#Get Company > Output to TextScreen
		$crunch = APP_CRUNCHBASE_GET_COMPANY($object[0]["company"],$terminal);
		$object[1] = $object[0];
		$object[0]["type"] = "TextScreen";
		$object[0]["title"] = 'Comany Info: '.$crunch["name"];
		$object[0]["text"] = strip_tags($crunch["overview"]);
		}

?>