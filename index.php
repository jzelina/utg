<?php

####################################
### Universal Terminal GUI v.01
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
	$root = $doc->createElement( "object" );
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
	print_r($doc);
	if (!($doc->save($label))) { 
		echo "fail to write";
		exit;
	}
	return $content;
}

# language

$lang["ok"] = "OK";

$title = "Universal Terminal GUI";
#include

# setup
if ($_GET['setup'] != "")
	{
	
	# TextScreen
	if ($_POST['type'] == "TextScreen")
		{
		echo "Your TextScreen: ".$_POST['textscreen'];
		
		#Build text screen
		$content["0"]["label"] = $_POST['label'];
		$content["0"]["type"] = $_POST['type'];
		$content["0"]["text"] = $_POST['textscreen'];
		$content["0"]["title"] = $_POST['title'];
		
		$object = write($type,$content,$label);
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

# main

$xml .= '<AastraIPPhoneTextScreen destroyOnExit="yes">';
$xml .= '<Title>Wait for it</Title>';
$xml .= '<Text>Wait for it :-)</Text>';
$xml .= '</AastraIPPhoneTextScreen>';
echo $xml;

?>