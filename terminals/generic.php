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
	
function TEXTMENU($object,$terminal,$lang)
	{
	if ($terminal['VENDOR'] == 'AASTRA'){ @include("aastra/AASTRA_TEXTMENU.php"); echo AASTRA_TEXTMENU($object,$terminal,$lang); }
	if ($terminal['VENDOR'] == 'HTML'){ echo HTML_TEXTMENU($object,$terminal,$lang); }
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

### HTML - TEXTMENU
# $object = HTML_TEXTMENU($object,$terminal);
#
function HTML_TEXTMENU($object,$terminal,$lang)
	{
	$out =  '<html><head><title>'.$object[0]["title"].'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head>';
	$out .= '<body>';
	if ($object[0]["line1text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line1url"].'">'.$object[0]["line1text"].'</a>';}
	if ($object[0]["line2text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line2url"].'">'.$object[0]["line2text"].'</a>';}
	if ($object[0]["line3text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line3url"].'">'.$object[0]["line3text"].'</a>';}
	if ($object[0]["line4text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line4url"].'">'.$object[0]["line4text"].'</a>';}
	if ($object[0]["line5text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line5url"].'">'.$object[0]["line5text"].'</a>';}
	if ($object[0]["line6text"] != "") {$out .= '<br /><a href="?read='.$object[0]["line6url"].'">'.$object[0]["line6text"].'</a>';}
	$out .= '</body><html>';
	return $out;
	}	
	
?>