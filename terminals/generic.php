<?php

#######################
#UTG - Generic Output
#######################

# generic to vendor
function TEXTSCREEN($object,$terminal,$lang)
	{
	if ($terminal['VENDOR'] == 'AASTRA'){ @include("aastra/AASTRA_TEXTSCREEN.php"); echo AASTRA_TEXTSCREEN($object,$terminal,$lang); }
	if ($terminal['VENDOR'] == 'HTML'){ echo HTML_TEXTSCREEN($object,$terminal,$lang); }
	}

### HTML - TEXTSCREEN
# $object = HTML_TEXTSCREEN($object,$terminal);
#
function HTML_TEXTSCREEN($object,$terminal,$lang)
	{
	$out =  '<html><head><title>'.$object[0]["title"].'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head>';
	$out .= '<body>'.$object[0]["text"];
	if ($object[0]["okurl"] != "") {$out .= '<br /><a href="?read='.$object[0]["okurl"].'">'.$lang["ok"].'</a>';}
	if ($object[0]["cancelurl"] != "") {$out .= '<br /><a href="?read='.$object[0]["cancelurl"].'">'.$lang["cancel"].'</a>';}
	$out .= '</body><html>';
	return $out;
	}	
	
?>