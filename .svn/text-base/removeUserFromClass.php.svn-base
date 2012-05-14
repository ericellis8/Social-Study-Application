<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();
$class_name = $_GET['class_name'];
$username = $_SESSION['username'];

$removeClass = "Delete from class_permissions where crn = (SELECT crn from classes where CONCAT(class_name, ' Sec. ', section) = '$class_name') AND user_id = (Select user_id from user where user_name = '$username')";
$result = mysql_query($removeClass) or die(mysql_error());
echo "yep";

?>