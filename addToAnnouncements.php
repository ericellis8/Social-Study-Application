<?php
	$con = mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	
	$sql="
	INSERT INTO news_feed (announcement)
	Values ('$_POST[newsEntry]')
	";
	
	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}

	mysql_close($con);
?>

<?php
header("Location: index.php?");
exit;
?> 