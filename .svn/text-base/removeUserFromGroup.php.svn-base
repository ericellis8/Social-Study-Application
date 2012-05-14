<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();
$group_name = $_GET['group_name'];
$username = $_SESSION['username'];

$removeGroup = "Delete from study_groups_users where group_id = (SELECT group_id from study_groups where group_name = '$group_name') AND user_id = (Select user_id from user where user_name = '$username')";
$result = mysql_query($removeGroup);

?>