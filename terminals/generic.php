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
	$out =  '<html><head><title>'.$object[0]["title"].'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script></head>';
	$out .= '<div data-role="header"><h1>'.$object[0]["title"].'</h1></div>';
	$out .= '<body><h3>'.$object[0]["text"].'</h3>';
	
    if ($object[0]["okurl"] != "") {$out .= '<a href="?read='.$object[0]["okurl"].'" data-role="button" data-icon="check">'.$lang["ok"].'</a>';}
	if ($object[0]["cancelurl"] != "") {$out .= '<a href="?read='.$object[0]["cancelurl"].'" data-role="button" data-icon="delete">'.$lang["cancel"].'</a>';}
	
	$out .= '</body><html>';
	return $out;
	}	

### HTML - TEXTMENU
# $object = HTML_TEXTMENU($object,$terminal);
#
function HTML_TEXTMENU($object,$terminal,$lang)
	{
	$out =  '<html><head><title>'.$object[0]["title"].'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script></head>';
	$out .= '<body>';
	$out .= '<ul data-role="listview" data-ajax="false" data-inset="true" data-theme="d"><li data-role="list-divider">'.$object[0]["title"].'</li>';
	if ($object[0]["line1text"] != "") {$out .= '<li><a href="?read='.$object[0]["line1url"].'">'.$object[0]["line1text"].'</a></li>';}
	if ($object[0]["line2text"] != "") {$out .= '<li><a href="?read='.$object[0]["line2url"].'">'.$object[0]["line2text"].'</a></li>';}
	if ($object[0]["line3text"] != "") {$out .= '<li><a href="?read='.$object[0]["line3url"].'">'.$object[0]["line3text"].'</a></li>';}
	if ($object[0]["line4text"] != "") {$out .= '<li><a href="?read='.$object[0]["line4url"].'">'.$object[0]["line4text"].'</a></li>';}
	if ($object[0]["line5text"] != "") {$out .= '<li><a href="?read='.$object[0]["line5url"].'">'.$object[0]["line5text"].'</a></li>';}
	if ($object[0]["line6text"] != "") {$out .= '<li/><a href="?read='.$object[0]["line6url"].'">'.$object[0]["line6text"].'</a></li>';}
	$out .= '</ul>';
	$out .= '</body><html>';
	return $out;
	}	
	
?>