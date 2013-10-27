<?php
#############################
#UTG - Execute Applications #
#############################

##### wunderground #####

if ($object[0]["app"] == "wunderground")
		{
		@include("wunderground/wunderground.php");
		}
		
##### crunchbase #####
if ($object[0]["app"] == "crunchbase")
		{
		@include("crunchbase/crunchbase.php");
		}
		
##### RSS_PHP #####
if ($object[0]["app"] == "rss")
		{
		@include("rss/rss.php");
		}
?>