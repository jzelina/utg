<?php

#######################
#UTG - create pages   #
#######################

	# TextScreen
	if ($_POST['type'] == "TextScreen")
		{
		echo "Your TextScreen: ".$_POST['textscreen'];
		
		#Build text screen
		$content["0"]["label"] = "db/".$_POST['label'].".xml";
		$content["0"]["type"] = $_POST['type'];
		$content["0"]["text"] = $_POST['textscreen'];
		$content["0"]["title"] = $_POST['title'];
		$content["0"]["okurl"] = $_POST['okurl'];
		$content["0"]["cancelurl"] = $_POST['cancelurl'];
		
		$object = write($type,$content,$content["0"]["label"]);
		exit;
		}
	
	##############
	# SETUP GUI
	##############
	
	$handle = opendir("db/");
	while ($res = readdir($handle)) { if (!(is_dir($res)) && preg_match("/\.xml/",$res) )
	$db .= '<option value="'.str_replace(".xml", "", $res).'">'.str_replace(".xml", "", $res).'</option>';
	}
	
	echo '<html><head><title>'.$title.'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head>';
	echo '<body><form method="post" action="'.$XML_SERVER.'?setup=1">
			<table style="width: 300px; margin-left: auto; margin-right: auto;">
			    <tr>
					<td colspan="2" rowspan="1" align="center"><h3>'.$tile.'</h3></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><select name="type"><option value="TextScreen">TextScreen</option></select></td>
				</tr>
				<tr>
					<td><br /><b>TextScreen<b></td>
					<td></td>
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
					<td>Text</td>
					<td><input type="text" name="textscreen" /></td>
				</tr>
				<tr>
					<td>OK-URL</td>
					<td><select name="okurl"><option value=""></option>'.$db.'</select></td>
				</tr>
					<tr>
					<td>Cancel-URL</td>
					<td><select name="cancelurl"><option value=""></option>'.$db.'</select></td>
				</tr>
				<tr>
					<td colspan="2" rowspan="1" align="center"><input style="width:90px" type="submit" name="submit" value="'.$lang["ok"].'" /></td>
				</tr>
	</table></form></body></html>';
	
?>