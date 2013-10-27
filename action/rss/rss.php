<?php

### RSS_NET
# $object = APP_RSS_GET_FEED($URL,$terminal);
#
function APP_RSS_GET_FEED($URL,$terminal)
	{
	require_once 'rss_php.php';
	$rss = new rss_php;
	$rss->load($URL);
	$items = $rss->getItems(); #returns all RSS items
	#print_r($items);
	return $items;
	}

# Main
	if ($object[0]["function"] == "APP_RSS_GET_FEED")
		{
		#Get RSS Feed
		$items = APP_RSS_GET_FEED($object[0]["URL"],$terminal);
		
		if ($_GET['item'] != "")
			{
			$id = strval($_GET['item']);
			#process detailed page
			$object[1] = $object[0];
			$object[0]["type"] = "TextScreen";
			$object[0]["title"] = $items[$id]["title"];
			$object[0]["text"] = preg_replace ('/<(.*)>/is', '', $items[$id]["description"]);
			if ($object[0]["text"] == "") {$object[0]["text"] = $items[$id]["title"];}
			
			}
		else
			{
			#process data (menu)
			$rssfeed[0]["title"]= $items[0]["title"];
			$rssfeed[0]["description"]= $items[0]["description"];
			$rssfeed[1]["title"]= $items[1]["title"];
			$rssfeed[1]["description"]= $items[1]["description"];
			$rssfeed[2]["title"]= $items[2]["title"];
			$rssfeed[2]["description"]= $items[2]["description"];
			
		
			#minimal output
			$object[1] = $object[0];
			$object[2] = $items; #full content
			$object[0]["type"] = "TextMenu";
			$object[0]["line1text"] = $rssfeed[0]["title"];
			$object[0]["line1url"] = $_GET['read']."&amp;item=1";
			$object[0]["line2text"] = $rssfeed[1]["title"];
			$object[0]["line2url"] = $_GET['read']."&amp;item=2";
			$object[0]["line3text"] = $rssfeed[2]["title"];
			$object[0]["line3url"] = $_GET['read']."&amp;item=3";
			}
		}


?>