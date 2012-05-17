<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

$currentuser = $_GET['username'];
//$currentuser = 'yamagucs';
//$currentuser = phpCAS::getUser();
if($currentuser == ''){
	$currentuser = $_SESSION['username'];
}

//constant declarations
$announcement_days = 7;
$group_days = 7;
$friend_days = 7;

//Announcement invites displayed on news feed
$announcementSQL = "
SELECT `announcement` 
FROM `news_feed` 
WHERE TO_DAYS(now()) < TO_DAYS(timestamp) + $announcement_days
";
$announcementResult=mysql_query($announcementSQL) or die(mysql_error());
$aNumResult = mysql_num_rows($announcementResult);

//Group invites displayed on news feed.
$groupSQL = "
SELECT study_groups.group_name
FROM study_groups
INNER JOIN study_groups_users
ON study_groups.group_id = study_groups_users.group_id
WHERE study_groups_users.user_id = (SELECT user.user_id from user where user.user_name = '$currentuser')
AND TO_DAYS(now()) < TO_DAYS(study_groups_users.entry_added) + $group_days
";
$groupResult = mysql_query($groupSQL) or die(mysql_error());
$gNumResult = mysql_num_rows($groupResult);

//Friend invites displayed on news feed.
$friendSQL = "
SELECT distinct user.user_name
FROM user
INNER JOIN study_buddy_request
ON user.user_id = study_buddy_request.user_id
WHERE study_buddy_request.buddy_id = (SELECT user.user_id from user where user.user_name = '$currentuser')
AND TO_DAYS(now()) < TO_DAYS(study_buddy_request.timestamp) + $friend_days
";
$friendResult = mysql_query($friendSQL) or die(mysql_error());
$fNumResult = mysql_num_rows($friendResult);

//Check for user permissions
$permissionsLevelSQL = "
SELECT user_permissions.permission_id
FROM user_permissions
INNER JOIN user
ON user.user_id = user_permissions.user_id
WHERE user_permissions.user_id = (SELECT user.user_id from user where user.user_name = '$currentuser')
";

$permissionsResult = mysql_query($permissionsLevelSQL) or die(mysql_error());
$permissionsNumResult = mysql_num_rows($permissionsResult);
if ($permissionsNumResult > 0)
{
//$userPermissions = mysql_result($permissionsResult, 0);
$row =mysql_fetch_array($permissionsResult);
$userPermissions = $row['permission_id'];
}
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
	echo "</td><td style='color:#c34500;'><li>";
	echo $row['announcement'];
	echo '</td></tr></li>';
}

echo "</ul></table>";
?>

<br>

<?php
$level1 = 1;

if($userPermissions <= $level1 && $permissionsNumResult > 0)
{
	echo '<div style="margin-left: 20px;">';
	echo 'Add new announcement: (appears to admin users)';
	echo '<form method="post" action="addToAnnouncements.php">';
	echo '<textarea name="newsEntry"  cols="40" rows="2"  style="resize:none;" >';
	echo '</textarea><br>';
	echo ' <input type=submit value="Submit">';
	echo '</form>';
	echo '</div>';
	echo '<BR>';
}
?>

<!-- Study Requests Table -->
<table border="0" style='font:15px Tahoma, Sans-serif'>
<tr>
<th align="left">Study Requests</th>
</tr>
<ul>
<?php
while($row=mysql_fetch_array($groupResult)){
	echo '<ul>';
 	echo "</td><td style='color:#c34500;'><li>";	
	//echo $row['group_name'];
	echo "<a id='studyRequestAnnouncement' title='Enter ".$row['group_name']." study room' style='cursor:pointer;' onclick=\"enterRoom('" . $row['group_name'] . "')\">" .$row['group_name']."</a><BR>";
	echo "</td></tr>";
}
echo "</table>";
?>


<br><br>

<!-- Friend Requests Table -->

<table border="0" style='font:15px Tahoma, Sans-serif'>
<tr>
<th align="left">Friend Requests</th>
</tr>
<ul>
<?php
while($row=mysql_fetch_array($friendResult)){
	echo '<ul>';
	echo "</td><td style='color:#c34500;'><li>";
	//echo $row['user_name'];
	echo "<a id='searchResults' title='Add ".$row['user_name']." to your buddy list' style='cursor:pointer;' onclick=\"addUser('" . $row['user_name'] . "')\">" .$row['user_name']."</a><BR>";
	echo "</td></tr>";
}
echo "</table>";
?>




