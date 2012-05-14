<?php

        mysql_connect("localhost","mia","soulskater") or die(mysql_error());
        mysql_select_db("social_study_groups") or die(mysql_error());
        session_start();
        $username = $_SESSION["username"];
        $query = "Select * from user as u, study_buddies as sb where u.user_id = sb.buddy_id AND sb.user_id = (Select user_id from user where user.user_name = '$username')";
        $result = mysql_query($query);
        $buddyArray = array();


function getNicknames($nickId)
        {
                $serverid = isset($GLOBALS['serverid']) ? $GLOBALS['serverid'] : 0;
                require_once dirname(__FILE__)."/phpFreeChat/src/pfcinfo.class.php";
                $info  = new pfcInfo( md5("pupchat") );
                $listOnline = $info->getOnlineNick(NULL);
                return $listOnline;
        }

 $users = getNicknames(1);
        $userArray = array();
        $num_users = 0;
        while($row = mysql_fetch_array($result)){
                $yes = false;
                for($i = 0; $i<count($users); $i++){
                        if($row["user_name"] == $users[$i]){
                                array_push($userArray, $row["user_name"]);
                                $num_users++;
                                $yes = true;
                        }
                }
                if($yes != true){
                        array_push($buddyArray, $row["user_name"]);
                }
        }

	$buddiesClickedOn = array();
?>

<!DOCTYPE HTML>
<html>
<head>

<style type="text/css">

</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<SCRIPT LANGUAGE="JavaScript" SRC="scripts.js">
displayNone();
</SCRIPT>

<script type="text/javascript">

var buddiesClickedOn = new Array();
function clickedOn(buddyClickedOn){
    var id=document.getElementById(buddyClickedOn);
	id.style.backgroundColor = "green";
	buddiesClickedOn.push(buddyClickedOn);
	alert("test");
	//document.write(buddiesClickedOn[0]);
}
function beginSession(){
	var studySessionTest = "test";
//	pfc.sendRequest("/join " + studySessionTest);
}

</script>
</head>
<body>
<center>
<div class="newStudySession">
<form>
<a style="cursor:pointer;" onclick="closeNewSession()"><img align="right" src="images/x.png" /></a><BR>
<h1 align="center">Begin A New Study Session</h1>
<h3>Step 1: Enter the Name of the Study Session</h3>
<input id="sessionName" type="text" name="sessionName" /><br />
<h3>Step 2: Select Study Buddies to Invite</h3>
Choose from your online study buddies:<br /><br />
<?php
if(sizeof($userArray)>0){
	echo "<table border='1' width='100%' cellpadding='0' cellspacing='0' class='onlineBuddies'>";
	echo "<tr>";
}else{
	echo "<h3 style='color:red' >None of your buddies are online</h3>";	
}
for ($i=0; $i<sizeof($userArray); $i++) {
	if($i == 3){
		echo "</tr><tr>";
	}
	echo "<td align='center' style='background-color:#C34500;cursor:pointer;' id='" . $userArray[$i] . "' onclick=\"clickedOn('" . $userArray[$i] . "')\">" . $userArray[$i] . "</td>";

}
echo "</tr></table>";
?>
<br />
And/or select students to join the session from...<br /><br />
</div>
</center>
<div class="select">
<form>
<input type="radio" name="select" value="class" onclick="yourClasses('<?php echo $username; ?>')" /> A class<br />
<div id="classList" align="center"></div>
<input type="radio" name="select" value="major" onclick='displayMajorSearchBar()' /> A subject/major<br />
<div style="display:none" id="majorSearch" align="center">
<img id="newSessionSearchBox" src="images/searchBox.png" width="60">
        <img style="position:relative;top:6px;left:7px;" src='images/search.png' /><input id="majorSearchValue" type="text" size="60" style="position:relative;top:3px;left:10px;background-color:#DDD;border:0;" onKeyUp="searchMajors()" value=""/>
        <div style="display:none" id="majorSearchResults"></div>
	<div style="display:none" id="usersInMajor"></div>
</img>
</div>
<input type="radio" name="select" value="search" onclick='displaySearchAnyone()' /> Search for someone<br />
<div style="display:none" id="anyoneSearch" align="center">
<img id="newSessionSearchBox" src="images/searchBox.png" width="60">
        <img style="position:relative;top:6px;left:7px;" src='images/search.png' /><input id="searchAnyoneValue" type="text" size="60" style="position:relative;top:3px;left:10px;background-color:#DDD;border:0;" onKeyUp="searchAnyone()" value=""/>
        <div style="display:none" id="anyoneSearchResults"></div>
</img>
</div>
<br />
</form>
</div> 
</form>
<br />

<table align='center' border='0' cellpadding='0' cellspacing='0' class='usersAdded'>
<tr align='center' width='100%'>
<td style='background-color:green' width='33%'>
<div id='addToUserTable'></div>
</td>
</tr>
</table>

 
<center><button type="button" class="button" onclick="beginSession()" />Begin The Study Session!</button></center>
</body>

</html>

