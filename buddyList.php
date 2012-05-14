<center><u style='font:16px Tahoma, Sans-serif;color:#c34500;text-decoration:none'>Buddy List
<?php
	mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	session_start();
	$username = $_GET['username'];
	if($username == ''){
		$username = $_SESSION['username'];
	}
	$query = "Select * from user as u, study_buddies as sb where u.user_id = sb.buddy_id AND sb.user_id = (Select user_id from user where user.user_name = '$username')";
	$result = mysql_query($query);
	$offlineUserArray = array();
	function getNicknames($nickId) 
	{
		require_once dirname(__FILE__)."/phpFreeChat/src/pfcinfo.class.php";
		$info  = new pfcInfo( md5("pupchat") );
		$listOnline = $info->getOnlineNick(NULL);
		return $listOnline;
	}
	$users = getNicknames(1);
	$onlineUserArray = array();
	$num_users_online = 0;
	while($row = mysql_fetch_array($result)){
		$yes = false;
		for($i = 0; $i<count($users); $i++){
			if($row["user_name"] == $users[$i]){
				array_push($onlineUserArray, $row["user_name"]);
				$num_users_online++;
				$yes = true;
			}	
		}	
		if($yes != true){	
			array_push($offlineUserArray, $row["user_name"]);
		}	
	}
	echo " - " . $num_users_online . " Online</u></center>";
	echo "<BR><span id='here'>";
	echo "<table width=100%>";
	foreach($onlineUserArray as $user){
		echo "<div style='font:15px Tahoma, Sans-serif;color:#c34500;'>";
		echo "<tr><td><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeBuddy('" . $user ."');getBuddyList('". $username ."')\"><img src='images/delete.gif' /> </a><a onclick=\"pfc.sendRequest('/privmsg ". $user . "')\" href= 'javascript:void(0);' style = 'text-decoration:none;color:#c34500;'>" . $user . "</a></td><td align=right></td></tr>";
		echo "</div>";
	}
	
	?>
	<script type='text/javascript'>
			setInterval("getUser()",1000);
		</script>
	<?php
	
	for($i = 0; $i < count($offlineUserArray); $i++){
		echo "<tr><td style='font:15px Tahoma, Sans-serif;color:grey'><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeBuddy('" . $offlineUserArray[$i] ."');getBuddyList('". $username ."')\"><img src='images/delete.gif' /></a> " . $offlineUserArray[$i] . "</td><td align=right></td></tr>";
	}
	echo "</td></tr></table>";
	echo "</span>";

?>

