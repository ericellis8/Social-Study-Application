<!-- Will work when new announcement table is in place. -->
<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
SESSION_START();

$user = $_SESSION['username'];
//$remove_annoucement = $_GET[];

$deleteAnnouncement = "Delete from user_announcements where user_id = (Select user_id from user where user_name = '$user') 
AND announcement_number = (Select announcement from user_announcements where user_name = '$user')";
$query = mysql_query($deleteUser);
?>