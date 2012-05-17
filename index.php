

<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$query = "Select show_name from user where user_name = '$username'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_array($result);
	require dirname(__FILE__)."/phpFreeChat/src/phpfreechat.class.php";
	$params = array();
	$params["title"] = "ClassPoint";
	if($row['show_name'] == 0){
		$myNickName = "student".rand(1,1000);
		$params["nick"] = $myNickName;
	}else{
		$params["nick"] = $_SESSION['username'];
		$myNickName = $_SESSION['username'];
	}		
	//$myNickName = $params["nick"];
	$params['firstisadmin'] = true;
	$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
	$params["serverid"] = md5("pupchat"); //__FILE__); // calculate a unique id for this chat
	$params["debug"] = false;
	$params["theme_path"] = "/phpFreeChat/themes";
	$params["theme"] = "default";
	$params["showsmileys"] = false;
	$params["shownotice"] = 0;
	$params["display_ping"] = false;
	$params["max_msg"] = 1000;
	$params["clock"] = false;
	$params["quit_on_closedwindow"] = true;
	$chat = new phpFreeChat( $params );
}

?> 

 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
    <html lang="en">  
        <head>  
            <meta charset="utf-8">  
            <title>Pup 'n Suds</title>  
            <link rel="stylesheet" href="style.css" />  
            <link rel="stylesheet" href="nav.css" />  
            
            <!--[if IE]>  
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>  
            <![endif]--> 

<script src="scripts.js" />
<script type="text/javascript">
	setTimeout("changeName('<?php echo $myNickName; ?>')", 1000);
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        </head>  
        <body class="no-js"> 
<!-- Image for blurring out the background -->        
        <img id="blur" style="display:none" src="images/blur.png"/>
<!--///////////////////////////////////////-->           
      
<!-- Navagation Bar -->      
           <nav id="topNav" style="min-width:1190px;">  
                    <ul>  
                    	<li class='first-child'><a href='index.php'>Beaver Study</a></li>  
                        <li><a href='#' onclick="newStudySession()" title="Create a session for one time use">Start A Temporary Session</a></li>  
                    	<li><a href="#" onclick="newStudyGroup()" title="Create a perminent study group" >Create A New Study Group</a></li> 
                    	<!--<li><a href="#" title="Nav Link 1">Add Friends</a></li>  -->
                    	<!--<li><a href="javascript:void(0)" onClick='logOut()'>Log Out</a></li>-->
                    	<li>
                    		<a href="#">Account</a>
                    		<ul>
                    			<li><a href="javascript:void(0)" onClick='logOut()'>Log Out</a></li>
                    			<li><a href="javascript:void(0)" onclick='editUserSettings()'>User Settings</a></li>
                    		</ul>
                    	</li>  
                    	<li class="last"><a href="about.php" class="last">About</a></li> 
<?
						if($_SESSION['loggedIn'] == 'true')
                    	{
                    		echo "<span style=\"position:relative;bottom:-12px;left:3px;color:white\">Welcome " . $_SESSION['name'] ;
                    	    //echo "<a style='position:relative;left:20px;' onclick='logOut()' href='javascript:void(0)'>Log Out</a></span>";
                    	}
?>
                	</ul>  
            </nav>
	<?php
                    	/*if($_SESSION['loggedIn'] == 'true')
                    	{
                    		echo "<span style=\"position:relative;bottom:-38px;left:3px;\">Welcome " . $_SESSION['name'] ;
                    	    echo "<a style='position:relative;left:20px;' onclick='logOut()' href='javascript:void(0)'>Log Out</a></span>";
                    	}*/
?>
	<table id="mainBody" style="height:100%" style="background:#FFF;">
		<tr>
		
<!-- Buddy List and Study Groups -->		
			<td width="250px" id="left_bar" align="left" valign="top"	>	
<?php
	if($_SESSION['loggedIn'] == 'true'){
?>			
				<img title="Hide Side Bar" align='right' id='showhide' onclick='swap_show_hide()' src='images/left.png' />
<?php
	}
	if($_SESSION['loggedIn'] != 'true'){
?>
			Log in
			<table>
				<tr><td>
					<form align="left" action="login_basic.php" method="post">
						Username: 
				</td><td>
						<input type="text" name="username" /><br>
				</td></tr>
				<tr><td>
						Password: 
				</td><td>	
						<input type="password" name="password" /><br>
				</td></tr>
			</table>
					<center>
						<input type="submit" value="Sign on" />
						<input type="button" value="Onid Login" onclick="window.location.href='https://login.oregonstate.edu/cas-dev/login?service=http://24.21.109.238/svn/root/login.php'" />
					</center>
			<br>
					</form>
					
			<br><br>
					
			New Users (User's without ONID)
			<table>
				<tr><td>
					<form align="left" action="addNewUser.php" method="post">
						Username: 
				</td><td>
						<input type="text" name="username_entry" /><br>
				</td></tr>
				<tr><td>
						Onidname: 
				</td><td>	
						<input type="text" name="oniduser_entry" /><br>
				</td></tr>
				<tr><td>
						Full Name: 
				</td><td>	
						<input type="text" name="fullname_entry" /><br>
				</td></tr>
				<tr><td>
						Email: 
				</td><td>	
						<input type="text" name="email_entry" /><br>
				</td></tr>
				<tr><td>
						Password: 
				</td><td>	
						<input type="password" name="password_entry" /><br>
				</td></tr>
				<tr><td>
						Password Confirmation: 
				</td><td>	
						<input type="password" name="password2_entry" /><br>
				</td></tr>
				<tr><td>
						Major: 
				</td><td>	
						<input type="text" name="major_entry" /><br>
				</td></tr>
			</table>
					<center>
						<input type="submit" value="Create Account" />
					</center>
			<br>
					</form>
			
<?php
	}
	else
	{
?>
		<div id="studyRoom">		
			<script type="text/javascript">
				loadStudyRooms('<?php echo $username; ?>');
				setInterval("loadStudyRooms('<?php echo $username; ?>')", 5000);
			</script>
		</div>
		<img id="searchbox" src="images/searchBox.png">
		<img style="position:relative;top:6px;left:7px;" src='images/search.png' /><input id="classSearch" type="text" size="30" onKeyUp="searchClasses()" value="Search Classes" onBlur="setClassSearchBoxValue()" onFocus="setClassSearchBoxValue()" value=""/>
		<div style="display:none" id="classSearchResults"></div>
		</img>
		<BR>
		<BR>
		<HR color="#c34500">
		<div id="buddyList" onMouseOver="lock_scroll()" onMouseOut="unlock_scroll()">
			<script type="text/javascript">
				getBuddyList('<?php echo $username; ?>');
				setInterval("getBuddyList('<?php echo $username; ?>')", 5000);	
			</script>	
		</div>
		<BR>
		<img id="searchbox" src="images/searchBox.png" >
		<img style="position:relative;top:6px;left:7px;" src='images/search.png' /><input id="buddySearch" onBlur="setBuddySearchBoxValue()" value="Search Users" onFocus="setBuddySearchBoxValue()" type="text" size="30" onKeyUp="searchUsers()" value=""/>
		<div style="display:none" id="buddySearchResults"></div>
		</img>

			</td>
			
			<div style="display:none; "id="newStudySession"> </div>
		
<!-- Whiteboard Application -->			
			<td id='whiteboardApplication' style="" valign="top" width="40%"">
				<?
					if($_SESSION['loggedIn'] == 'true'){
				?>
				<img style="cursor:pointer" src='images/saveGroup.png' name='save_group'  onMouseDown="save_group.src='images/saveGroupClicked.png'" onMouseUp="save_group.src='images/saveGroup.png'" id="save_group" onClick="saveGroup();loadStudyRooms('<?php echo $username; ?>');" />
				<img style="cursor:pointer" src='images/saveClass.png' name='save_class'  onMouseDown="save_group.src='images/saveClassClicked.png'" onMouseUp="save_group.src='images/saveClass.png'" id="save_class" onClick="saveClass();loadStudyRooms('<?php echo $username; ?>');" />
				<?
				
					}
				?>
				<img title="Show Side Bar" align='left' id='showhide2' onclick='swap_show_hide()' src='images/right.png' style="display:none;"/>
				<div id='newsfeed' onMouseOver="lock_scroll('doc')" onMouseOut="unlock_scroll()"></div>
				<table>
				<tr>
				<td>
				<div id='uniondraw'></div>
				</td><td>
				<span id='docViewer' onMouseOver="lock_scroll('doc')" onMouseOut="unlock_scroll()"></span>
				</td></tr>
				</table>
				<?
					if($_SESSION['loggedIn'] == 'true'){
				?>
				<div style='width:600px;position:relative;left:8px;background-color:#DDD;bottom:10px;height:39px;border:1px solid black;' style="display:none;" id='switchDocDraw'>
					
					<img id="showWhiteBoard" style="cursor:pointer;" onclick='showWhiteboard()' src='images/whiteboardSelected.png' />
					<img id="showDoc" style="cursor:pointer;position:relative;right:0px;" onclick='showDocViewer()' src='images/docViewer.png' />
					
				</div>
				<?
					}
				?>
				
			</td>
			
<!-- Document Viewer Application (psview-0.3 -->


			
<!-- Chat Application -->			
			<td id="chatApplication" align="left" valign="top">
					<div class="content">
						<?php
							if($_SESSION['loggedIn'] == 'true')
							{
								$chat->printChat(); 
							}	
						?>	   
					</div>							
			</td>
			
			
		</tr>
		
	</table>	

<!-- Bottom Tabs --> 	

 	<ul id="pfc_channels_list"></ul>
<?php
	}
?>
	</body>  
</html>  
