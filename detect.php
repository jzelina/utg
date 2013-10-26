<?php

#######################
#UTG - detect terminal#
#######################


### detect terminal
function terminal_detect($SERVER)
{
#print_r($SERVER);

#AASTRA
if(stristr($SERVER['HTTP_USER_AGENT'],'Aastra'))
	{
	#AASTRA XML Terminal API
	$value=preg_split('/ MAC:/',$SERVER['HTTP_USER_AGENT']);
	$fin=preg_split('/ /',$value[1]);
	$value[1]=preg_replace('/\-/','',$fin[0]);
	$value[2]=preg_replace('/V:/','',$fin[1]);
	$terminal['VENDOR'] = "AASTRA";
	$terminal['IP']=$SERVER['REMOTE_ADDR']; # Terminal IP
	$terminal['LANG']=$SERVER['HTTP_ACCEPT_LANGUAGE']; # Terminal Language
	$terminal['AGENT']=$value[0]; # User Agent
	$terminal['NUMBER']=$value[1]; # Extension Number
	$terminal['FIRMWARE']=$value[2]; # OMM Firmware
	}
	
#HTML
if(stristr($SERVER['HTTP_USER_AGENT'],'Mozilla'))
	{
	$terminal['VENDOR'] = "HTML";
	$terminal['IP']=$SERVER['REMOTE_ADDR']; # Terminal IP
	$terminal['LANG']=$SERVER['HTTP_ACCEPT_LANGUAGE']; # Terminal Language
	$terminal['HTTP_USER_AGENT']=$SERVER['HTTP_USER_AGENT'];
	}

return $terminal;
}

?>