<?php

### AASTRA - INPUTSCREEN
# $object = AASTRA_INPUTSCREEN($object,$terminal,$lang);
#
function AASTRA_INPUTSCREEN($object,$terminal,$lang)
	{
	header("Content-Type: text/xml; charset=UTF-8");
	$out = '<?xml version="1.0" encoding="UTF-8"?>';
	$out .= '<AastraIPPhoneInputScreen destroyOnExit="yes" type="'.$object["inputtype"].'"';
	if ($object[0]["cancelurl"] != "") { $out .= ' cancelAction="'.$terminal['ME'].'?read='.$object[0]["cancelurl"].'"';}
	$out .= '>';
	$out .= '<Title>'.$object[0]["title"].'</Title>';
	$out .= '<Promt>'.$object[0]["promt"].'</Promt>';
	$out .= '<URL>'.$terminal['ME'].'?read='.$object[0]["okurl"].'</URL>';
	$out .= '<Parameter>'.$object[0]["parameter"].'</Parameter>';
	$out .= '<Default>'.$object[0]["default"].'</Default>';
	$out .= '</AastraIPPhoneInputScreen>';
	return $out;
	}

?>