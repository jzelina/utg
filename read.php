<?php

#############################
#UTG - Read Pages + Display #
#############################

	@include("terminals/generic.php");
	#detect terminal type
	$terminal = "";
	$terminal = terminal_detect($_SERVER);
	$terminal['ME'] = $ME; 
	#$terminal['VENDOR'] = 'AASTRA';
	
	# Read object
	$label = $_GET['read'];
	$object = read($label,$terminal);
	#print_r($object);
	
	# Terminal Header
	
	#echo for terminal
	if ($object[0]["type"] == "TextScreen")
		{
		#echo "Text Screen object";
		echo TEXTSCREEN($object,$terminal,$lang);
		}
	
	if ($object[0]["type"] == "none")
		{
		echo "!!! File not Found";
		}
	exit;
	
?>