<?php

####################################
### Universal Terminal GUI v.01    #
####################################

# disable Error and Warnings
error_reporting(E_ALL & ~E_NOTICE);

# configure environment

if (isset($_SERVER['HTTPS'])) { $XML_SERVER = "https://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME']; }
else { $XML_SERVER = "http://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME']; }

# include

### Object to File
# $object = write($type,$content,$label);
#
function write($type,$content,$label)
{

	# type = Textscreen, TextMenu, Image, ...
	# content = object to put in (contain parameters)
	# label = write content to 
	
	#Textscreen
	
	
	# write object
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root = $doc->createElement( "element" );
	$doc->appendChild( $root );
	foreach( $content as $object )
	{
	
		$u = $doc->createElement( "object" );
		foreach ( $object as $key=>$val )
		{
			$node = $doc->createElement( "$key" );
			$node->appendChild($doc->createTextNode( "$val" ));
			$u->appendChild( $node );
		}
	$root->appendChild( $u );
	}

	if (!($doc->save($label))) { 
		echo "fail to write";
		exit;
	}
	return $content;
}

### File to Object
# $object = write($label,$terminal);
#
function read($label,$terminal)
{
$file = "db/".$label.".xml";

if (file_exists($file)) 
		{
			$xml = new SimpleXMLElement($file, 0, TRUE);
			foreach ($xml->children() as $Node)
			{ 
			foreach($Node->children() as $key=>$val)
				{
				$index = 0;
				$object[strval($index)]["$key"] = strval($val);
				}
			}	
		}
		else { $object[0]['type'] = 'none'; }
	return $object;
}

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




# generic to vendor
function TEXTSCREEN($object,$terminal)
	{

	if ($terminal['VENDOR'] == 'AASTRA'){ echo AASTRA_TEXTSCREEN($object,$terminal); }
	if ($terminal['VENDOR'] == 'HTML'){ echo HTML_TEXTSCREEN($object,$terminal); }
	
	}

# vendors

### AASTRA - TEXTSCREEN
# $object = AASTRA_TEXTSCREEN($object,$terminal);
#
function AASTRA_TEXTSCREEN($object,$terminal)
	{
	header("Content-Type: text/xml; charset=UTF-8");
	$out = '<?xml version="1.0" encoding="UTF-8"?>';
	$out .= '<AastraIPPhoneTextScreen destroyOnExit="yes">';
	$out .= '<Title>'.$object[0]["title"].'</Title>';
	$out .= '<Text>'.$object[0]["text"].'</Text>';
	$out .= '</AastraIPPhoneTextScreen>';
	return $out;
	}
	
### HTML - TEXTSCREEN
# $object = HTML_TEXTSCREEN($object,$terminal);
#
function HTML_TEXTSCREEN($object,$terminal)
	{
	$out =  '<html><head><title>'.$object[0]["title"].'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head>';
	$out .= '<body>'.$object[0]["text"].'</body>';
	$out .= '<html>';
	return $out;
	}

# language

$lang["ok"] = "OK";
$title = "Universal Terminal GUI";

#include

########### setup
if ($_GET['setup'] != "")
	{
	
	# TextScreen
	if ($_POST['type'] == "TextScreen")
		{
		echo "Your TextScreen: ".$_POST['textscreen'];
		
		#Build text screen
		$content["0"]["label"] = "db/".$_POST['label'].".xml";
		$content["0"]["type"] = $_POST['type'];
		$content["0"]["text"] = $_POST['textscreen'];
		$content["0"]["title"] = $_POST['title'];
		
		$object = write($type,$content,$content["0"]["label"]);
		exit;
		}
	
	##############
	# SETUP GUI
	##############
	
	echo '<html><head><title>'.$title.'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head>';
	echo '<body><form method="post" action="'.$XML_SERVER.'?setup=1">
			<table style="width: 300px; margin-left: auto; margin-right: auto;">
			    <tr>
					<td colspan="2" rowspan="1" align="center"><h3>'.$tile.'</h3></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><select name="type"><option value="TextScreen">TextScreen</option></select> </td>
				</tr>
				<tr>
					<td>Label</td>
					<td><input type="text" name="label" /></td>
				</tr>
				<tr>
					<td>Title</td>
					<td><input type="text" name="title" /></td>
				</tr>
				<tr>
					<td>Text Screen</td>
					<td><input type="text" name="textscreen" /></td>
				</tr>
				<tr>
					<td colspan="2" rowspan="1" align="center"><input style="width:90px" type="submit" name="login" value="'.$lang["ok"].'" /></td>
				</tr>
	</table></form></body></html>';
	exit;
	}

# read
if ($_GET['read'] != "")
	{
	
	#detect terminal type
	$terminal = "";
	$terminal = terminal_detect($_SERVER);
	
	# Read object
	$label = $_GET['read'];
	$object = read($label,$terminal);
	#print_r($object);
	
	# Terminal Header
	
	#echo for terminal
	if ($object[0]["type"] == "TextScreen")
		{
		#echo "Text Screen object";
		
		echo TEXTSCREEN($object,$terminal);
		}
	
	if ($object[0]["type"] == "none")
		{
		echo "!!! File not Found";
		}
	exit;
	}
	
# main

$xml .= '<AastraIPPhoneTextScreen destroyOnExit="yes">';
$xml .= '<Title>Wait for it</Title>';
$xml .= '<Text>Wait for it :-)</Text>';
$xml .= '</AastraIPPhoneTextScreen>';
echo $xml;

?>