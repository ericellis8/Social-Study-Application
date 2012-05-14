<center><u style='font:16px Tahoma, Sans-serif;color:#ff6347;position:relative;left:15px;' >Study Groups</u></center>
<p align="left">	
<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

	function getNumberOfUsers($channel) 
	{
		$serverid = isset($GLOBALS['serverid']) ? $GLOBALS['serverid'] : 0;
		require_once dirname(__FILE__)."/phpFreeChat/src/pfcinfo.class.php";
		$info  = new pfcInfo( md5("pupchat") );
		$listOnline = $info->getOnlineNick($channel, 20);
		return count($listOnline);
	}

	$username = $_GET['username'];
	$query = "Select class_name, major, section, description from classes, class_permissions, user WHERE user.user_name = '$username' AND class_permissions.user_id = user.user_id and classes.crn = class_permissions.crn";
	$result = mysql_query($query);

	echo "<table width=100%>";
	if($_SESSION['major'] != ""){
		echo "<tr><td><span style='font-size:23px;'>Departments</span></td><td align='right' style='font-size:23px;'>Online  </td></tr>";
		$num = getNumberOfUsers($_SESSION['major']);
		$number = getNumberOfUsers("OSU Chat");
		if($number > 0){
			echo "<tr><td><a onclick=\"pfc.sendRequest('/join ". "OSU Chat" . "')\"style='font:14px Tahoma, Sans-serif; text-decoration:none;' href='javascript:void(0);'>". "  OSU Chat". "</a></td><td align='right' style='color:red'>  " . $number."</td></tr>";
		}else{
			echo "<tr><td><a onclick=\"pfc.sendRequest('/join ". "OSU Chat" . "')\"style='font:14px Tahoma, Sans-serif; text-decoration:none;' href='javascript:void(0);'>". "  OSU Chat". "</a></td><td align='right'>  " . $number."</td></tr>";
		}
		if($num > 0){
			echo "<tr><td><a onclick=\"pfc.sendRequest('/join ". $_SESSION['major'] . "')\"style='font:14px Tahoma, Sans-serif; text-decoration:none;' href='javascript:void(0);'>". $_SESSION['major']. "</a></td><td align='right' style='color:red'>  " . $num."</td></tr>";
		}else{
			echo "<tr><td><a onclick=\"pfc.sendRequest('/join ". $_SESSION['major'] . "')\"style='font:14px Tahoma, Sans-serif; text-decoration:none;' href='javascript:void(0);'>". $_SESSION['major']. "</a></td><td align='right'>  " . $num."</td></tr>";
		}
	}
	echo "</td></tr></table>";
	echo "<BR>";
	echo "<span style='font-size:23px;'>Classes</span><BR>";
	echo "<table width=100%>";
	while($row = mysql_fetch_array($result)){
		$class = $row["class_name"] . ' Sec. ' . $row['section'];
		$num = getNumberOfUsers($class);
		if($num > 0){
			echo "<tr><td><a title='Remove Class' href='#' onClick=\"removeClass('". $class ."');loadStudyRooms('". $username ."');\" style='color:red;text-decoration:none;position:relative;bottom:1px'><img src='images/delete.gif' /> </a><a title='" . $row['description'] . "' onclick=\"pfc.sendRequest('/join ". $class . "')\"style='font:14px Tahoma, Sans-serif;text-decoration:none;' href='javascript:void(0);'>". $class ."</a></td><td align='right' style='color:red'> " . $num."</td></tr>";
		}else{
			echo "<tr><td><a title='Remove Class' href='#' onClick=\"removeClass('". $class ."');loadStudyRooms('". $username ."');\" style='color:red;text-decoration:none;position:relative;bottom:1px'><img src='images/delete.gif' /> </a><a title='" . $row['description'] . "' onclick=\"pfc.sendRequest('/join ". $class . "')\"style='font:14px Tahoma, Sans-serif;text-decoration:none;' href='javascript:void(0);'>". $class ."</a></td><td align='right'> " . $num."</td></tr>";
		}
	}
	echo "</td></tr></table>";
	$query = "Select group_name from study_groups, user, study_groups_users WHERE user.user_name = '$username' AND study_groups_users.user_id = user.user_id and study_groups.group_id = study_groups_users.group_id";
	$result = mysql_query($query) or die(mysql_error());
	echo "<BR>";
	echo "<span style='font-size:23px;'>Groups</span><BR>";
	echo "<table width=100%>";
	while($row = mysql_fetch_array($result)){
		$group = $row["group_name"];
		//$group = split('-', $group);
		$num = getNumberOfUsers(trim($group));
		if($num > 0){
			echo "<tr><td><a title='Remove Group' href='#' onClick=\"removeGroup('". $group ."');loadStudyRooms('". $username ."');\" style='color:red;text-decoration:none;position:relative;bottom:1px'><img src='images/delete.gif' /> </a><a onclick=\"pfc.sendRequest('/join ". $group . "')\"style='font:14px Tahoma, Sans-serif;text-decoration:none;' href='javascript:void(0);'>". $row['group_name']. "</a></td><td align='right' style='color:red';> " . $num."</td></tr>";
		}else{
			echo "<tr><td><a title='Remove Group' href='#' onClick=\"removeGroup('". $group ."');loadStudyRooms('". $username ."');\" style='color:red;text-decoration:none;position:relative;bottom:1px'><img src='images/delete.gif' /> </a><a onclick=\"pfc.sendRequest('/join ". $group . "')\"style='font:14px Tahoma, Sans-serif;text-decoration:none;' href='javascript:void(0);'>". $row['group_name']. "</a></td><td align='right'> " . $num."</td></tr>";
		}
	}
	echo "</td></tr></table>";
	
	

?>


</p>
