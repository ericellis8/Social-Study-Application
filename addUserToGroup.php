<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();
$group_name = $_GET['group_name'];
$username = $_SESSION['username'];

$checkMember = "Select * from study_groups_users where user_id = (Select user_id from user where user_name = '$username') AND group_id = (Select group_id from study_groups where group_name = '$group_name')";
$checkMemberResult = mysql_query($checkMember);
if(mysql_num_rows($checkMemberResult)){
	return;
}

$checkGroup = "Select * from study_groups where group_name = '$group_name'";
$checkGroupResult = mysql_query($checkGroup);
if(mysql_num_rows($checkGroupResult) ==  0){
	$addGroup = "Insert into study_groups(group_name) VALUES ('$group_name')";
	$addGroupResult = mysql_query($addGroup);
	$addMemberToGroup = "Insert into study_groups_users(group_id,user_id) VALUES ((Select group_id from study_groups where group_name = '$group_name'), (Select user_id from user where user_name = '$username'))";
	echo $addMemberToGroup;
	$addMemberToGroupResult = mysql_query($addMemberToGroup) or die(mysql_error());
}else{
	$checkUserInGroup = "Select group_id from study_groups_users where group_id = (Select group_id from study_groups where group_name = '$group_name') AND user_id = (Select user_id from user where user_name = '$username')";
	$checkUserInGroupResult = mysql_query($checkUserInGroupResult);
	if(mysql_num_rows($checkGroupResult) != 0){
		$addMemberToGroup = "Insert into study_groups_users(group_id,user_id) VALUES ((Select group_id from study_groups where group_name = '$group_name'), (Select user_id from user where user_name = '$username'))";
		$addMemberToGroupResult = mysql_query($addMemberToGroup) or die(mysql_error());
	}
}
?>