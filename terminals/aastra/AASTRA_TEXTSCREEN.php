<?php

### AASTRA - TEXTSCREEN
# $object = AASTRA_TEXTSCREEN($object,$terminal);
#
function AASTRA_TEXTSCREEN($object,$terminal,$lang)
	{
	header("Content-Type: text/xml; charset=UTF-8");
	$out = '<?xml version="1.0" encoding="UTF-8"?>';
	$out .= '<AastraIPPhoneTextScreen destroyOnExit="yes"';
	if ($object[0]["okurl"] != "") { $out .= ' doneAction="'.$terminal['ME'].'?read='.$object[0]["okurl"].'"';}
	if ($object[0]["okurl"] != "") { $out .= ' cancelAction="'.$terminal['ME'].'?read='.$object[0]["cancelurl"].'"';}
	$out .= '>';
	$out .= '<Title>'.$object[0]["title"].'</Title>';
	$out .= '<Text>'.$object[0]["text"].'</Text>';
	$out .= '</AastraIPPhoneTextScreen>';
	return $out;
	}

?>