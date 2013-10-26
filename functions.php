<?php

#######################
#UTG - Main Functions
#######################

### Object to File - $object = write($type,$content,$label);
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

### File to Object - $object = write($label,$terminal);
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

?>