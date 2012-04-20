<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

$currentuser = $_GET['username'];
if($currentuser == ''){
	$currentuser = $_SESSION['username'];
}

$announcementSQL = "
SELECT `announcement` 
FROM `news_feed` 
WHERE TO_DAYS(now()) < TO_DAYS(timestamp) + 1";
$announcementResult=mysql_query($announcementSQL) or die(mysql_error());
$aNumResult = mysql_num_rows($announcementResult);
$groupSQL = "
SELECT study_groups.group_name
FROM study_groups
INNER JOIN study_groups_users
ON study_groups.group_id = study_groups_users.group_id
WHERE study_groups_users.user_id = (SELECT 
";
//#groupResult = mysql_query($groupSQL) or die(mysql_error());
//$gNumResult = mysql_num_rows($groupResult);

$friendSQL = "
SELECT user.user_name
FROM user
INNER JOIN study_buddy_request
ON user.user_id = study_buddy_request.user_id
WHERE study_buddy_request.buddy_id = (SELECT user.user_id from user where user.user_name = '$currentuser')
";
$friendResult = mysql_query($friendSQL) or die(mysql_error());
$fNumResult = mysql_num_rows($friendResult);

?>

<center><B style='font:20px Tahoma, Sans-serif;'>News</B></center>
<p align="left">	

<!-- Admin announcements table -->

<table border="0" style='font:15px Tahoma, Sans-serif'>
<tr>
<th align = "left">Announcements</th>
</tr>
<ul>
<?php
while($row=mysql_fetch_array($announcementResult))
{
	echo '<ul>';
	echo '</td><td><li>';
	echo $row['announcement'];
	echo '</td></tr></li>';
}

echo "</ul></table>";
?>

<br>

<!-- Study Requests Table -->
<table border="0" style='font:15px Tahoma, Sans-serif'>
<tr>
<th align="left">Study Requests</th>
</tr>
<ul>
<?php
while($row=mysql_fetch_array($group_name)){
	echo '<ul>';
	echo '</td><td><li>';
	echo $row['announcement'];
	echo "</td></tr>";
}
echo "</table>";
?>


<br>

<!-- Friend Requests Table -->

<table border="0" style='font:15px Tahoma, Sans-serif'>
<tr>
<th align="left">Friend Requests</th>
</tr>
<ul>
<?php
while($row=mysql_fetch_array($friendResult)){
	echo '<ul>';
	echo '</td><td><li>';
	echo $row['user_name'];
	echo "</td></tr>";
}
echo "</table>";
?>




