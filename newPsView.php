<?php
	//ini_set('display_errors', 1);
	mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	session_start();
	$room = $_GET['room'];
	$query = "Select * from doc_files where room_id = '$room'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if(mysql_num_rows($result) > 0){
		$rsc_id = $row['rsc_id'];
		$path = "psview-0.3/html/rsc/".$rsc_id."/".$rsc_id.".html";
		$d = dir("psview-0.3/html/rsc/".$rsc_id);
		while($entry=$d->read()) {
			if(ereg(".gif", $entry)) {
				?>
					<iframe id='psview' style="border:1px solid black;padding-left:0px;padding-right:0px;padding-bottom:5px;position:relative;top:-2px;left:1px;width:600px;"  frameborder="0" scrolling="yes" src="psview-0.3/html/psview.php?id=<?php echo $rsc_id; ?>&room=<?php echo $room; ?>" width="100%" height="435" width="600">
				<?php
			}
			if(ereg(".html", $entry)) {
				?>
					<iframe id='psview' style="border:1px solid black;padding-left:0px;padding-right:0px;padding-bottom:5px;position:relative;top:-2px;left:1px;width:600px;"  frameborder="0" scrolling="yes" src="psview-0.3/html/rsc/<?php echo $rsc_id; ?>/index.html" width="100%" height="435" width="600">
				<?php
			}
		}
	}else{
?>
<iframe id='psview' style="border:1px solid black;padding-left:0px;padding-right:0px;padding-bottom:5px;position:relative;top:-2px;left:1px;width:600px;"  frameborder="0" scrolling="yes" src="psview-0.3/html/index.php?room=<?php echo $room; ?>" width="100%" height="435" width="600">
<?php
}
?>
