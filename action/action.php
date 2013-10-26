<?php
#############################
#UTG - Execute Applications #
#############################

##### wunderground #####

if ($object[0]["app"] == "wunderground")
		{
		@include("wunderground/wunderground.php");
		}

?>