<?php

### AASTRA - TEXTMENU
# $object = AASTRA_TEXTMENU($object,$terminal);
#
function AASTRA_TEXTMENU($object,$terminal,$lang)
	{
	header("Content-Type: text/xml; charset=UTF-8");
	$out = '<?xml version="1.0" encoding="UTF-8"?>';
	$out .= '<AastraIPPhoneTextMenu destroyOnExit="yes"';
	if ($object[0]["okurl"] != "") { $out .= ' doneAction="'.$terminal['ME'].'?read='.$object[0]["okurl"].'"';}
	if ($object[0]["okurl"] != "") { $out .= ' cancelAction="'.$terminal['ME'].'?read='.$object[0]["cancelurl"].'"';}
	$out .= '>';
	$out .= '<Title>'.$object[0]["title"].'</Title>';
	if ($object[0]["line1text"] != "") { $out .= '<MenuItem><Prompt>'.$object[0]["line1text"].'</Prompt><URI>'.$terminal['ME'].'?read='.$object[0]["line1url"].'</URI></MenuItem>'; }
	if ($object[0]["line2text"] != "") { $out .= '<MenuItem><Prompt>'.$object[0]["line2text"].'</Prompt><URI>'.$terminal['ME'].'?read='.$object[0]["line2url"].'</URI></MenuItem>'; }
	if ($object[0]["line3text"] != "") { $out .= '<MenuItem><Prompt>'.$object[0]["line3text"].'</Prompt><URI>'.$terminal['ME'].'?read='.$object[0]["line3url"].'</URI></MenuItem>'; }
	
	$out .= '</AastraIPPhoneTextMenu>';
	return $out;
	}

?>