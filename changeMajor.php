<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();
$username = $_SESSION['username'];
$major = $_GET['major'];
$name = $_GET['name'];
if($name == "true"){
	$showName = 0;
	echo "student".rand(1,1000);
}else{
	$showName = 1;
	echo $_SESSION['username'];
}
$query = "Update user SET major = '$major', show_name = '$showName' where user_name = '$username' ";
$result = mysql_query($query) or die(mysql_error());
$_SESSION['major'] = $major;
?>
