<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
SESSION_START();

$user = $_GET['username'];
$me = $_SESSION['username'];

$deleteUser = "Delete from study_buddies where user_id = (Select user_id from user where user_name = '$me') AND buddy_id = (Select user_id from user where user_name = '$user')";
$result = mysql_query($deleteUser);
?>