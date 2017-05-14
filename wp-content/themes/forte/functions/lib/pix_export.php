<?php
	date_default_timezone_set('America/Los_Angeles');
	header("Content-Type: plain/text");
	header("Content-Disposition: Attachment; filename=Forte_admin_panel_".date("d-m-Y_H-i",time()).".txt");
	header("Pragma: no-cache");

	$host =  $_POST['export_host']; 
	$user =  $_POST['export_user'];
	$pass =  $_POST['export_password']; 
	$db = $_POST['export_db']; 
	$upload_dir = $_POST['export_upload_dir']; 
	$theme_dir = $_POST['export_theme_dir']; 
	$table = $_POST['export_table']; 
	
	$link = mysql_connect($host, $user, $pass) or die("Can not connect." . mysql_error());
	
	mysql_select_db($db) or die("Can not connect."); 
	
	$result = mysql_query("SHOW COLUMNS FROM ".$table."");
	$i = 0;
	$txt_output = '';
	if (mysql_num_rows($result) > 0) {
		$txt_output = str_replace($upload_dir, "%pix_upload_dir%", $txt_output);
		$txt_output = str_replace($theme_dir, "%pix_theme_dir%", $txt_output);
		while ($row = mysql_fetch_assoc($result)) {  
			$txt_output .= $row['Field']."[pix]";
			$i++;
		}
	}
	$txt_output .= "[pix_n]"; 
	
	$values = mysql_query("SELECT * FROM ".$table."");
	while ($rowr = mysql_fetch_row($values)) {
		for ($j=0;$j<$i;$j++) { 
			$txt_output .= $rowr[$j]."[pix]";
		}
		$txt_output .= "[pix_n]"; 
	}

	echo $txt_output; 
	exit;
?>