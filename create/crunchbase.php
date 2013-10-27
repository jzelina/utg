<?php

#######################
#UTG - create pages   #
#######################

	# CRUNCHBASE
	if ($_POST['type'] == "CrunchBase")
		{
		echo "Your CrunchBase: ";
		echo '<br /><a href="?read='.$_POST['label'].'">see</a>';
		echo '<br /><a href="?setup=1">back</a>';
		
		#Build text screen
		$content["0"]["label"] = "db/".$_POST['label'].".xml";
		$content["0"]["type"] = "Application";
		$content["0"]["app"] = "crunchbase";
		$content["0"]["function"] = "APP_CRUNCHBASE_GET_COMPANY";
		$content["0"]["description"] = $_POST['description'];
		$content["0"]["company"] = $_POST['company'];
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
	echo '<body><form method="post" action="'.$XML_SERVER.'?setup=crunchbase.php">
			<table style="width: 300px; margin-left: auto; margin-right: auto;">
			    <tr>
					<td colspan="2" rowspan="1" align="center"><h3>'.$tile.'</h3></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><select name="type"><option value="CrunchBase">CrunchBase</option></select></td>
				</tr>
				<tr>
					<td>Label (FileName)</td>
					<td><input type="text" name="label" /></td>
				</tr>
				<tr>
					<td>Title</td>
					<td><input type="text" name="title" /></td>
				</tr>
				<tr><td></td><td><hr></td>
				<tr>
					<td>Description</td>
					<td><input type="text" name="description" value="RSS Reader"/></td>
				</tr>
				<tr>
					<td>Company</td>
					<td><input type="text" name="company" value="TechCrunch"/></td>
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
				<tr>
					<td colspan="2" rowspan="1" align="center"><a href="?setup=1">back<a/></td>
				</tr>
	</table></form></body></html>';
	
?>