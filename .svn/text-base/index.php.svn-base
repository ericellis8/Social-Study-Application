<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	require dirname(__FILE__)."/phpFreeChat/src/phpfreechat.class.php";
	$params = array();
	$params["title"] = "ClassPoint";
	$params["nick"] = $_SESSION['username'];	
	$myNickName = $params["nick"];
	$params['firstisadmin'] = true;
	$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
	$params["serverid"] = md5("pupchat"); //__FILE__); // calculate a unique id for this chat
	$params["debug"] = false;
	$params["theme_path"] = "/phpFreeChat/themes";
	$params["theme"] = "default";
	$params["showsmileys"] = false;
	$params["shownotice"] = 0;
	$params["display_ping"] = false;
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
	setTimeout("changeName('<?php echo $username; ?>')", 1000);
</script>

        </head>  
        <body class="no-js"> 
<!-- Image for blurring out the background -->        
        <img id="blur" style="display:none" src="images/blur.png"/>
<!--///////////////////////////////////////-->           
      
<!-- Navagation Bar -->      
           <nav id="topNav" style="min-width:1090px;">  
                    <ul>  
                    	<li class='first-child'><a href='index.php' title="Nav Link 1">Beaver Study</a></li>  
                        <li><a href='#' onclick="newStudySession()" title="Nav Link 1">Start A Temporary Session</a></li>  
                    	<li><a href="#" title="Nav Link 1" >Create A New Study Group</a></li> 
                    	<!--<li><a href="#" title="Nav Link 1">Add Friends</a></li>  -->
                    	<li>
                    		<a href="#" title="Nav Link 1">Account</a>
                    		<ul>
                    			<li><a href="javascript:void(0)" onClick='logOut()'>Log Out</a></li>
                    			<li><a href="#">User Settings</a></li>
                    		</ul>
                    	</li>  
                    	<li class="last"><a href="#" class="last" title="Nav Link 1">About</a></li> 
<?
						if($_SESSION['loggedIn'] == 'true')
                    	{
                    		echo "<span style=\"position:relative;bottom:-10px;left:3px;color:white\">Welcome " . $_SESSION['name'] ;
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
				<img title="Hide Side Bar" align='right' id='showhide' onclick='swap_show_hide()' src='images/left.png' />
<?php
	if($_SESSION['loggedIn'] != 'true'){
?>
			Log in
			<table>
				<tr><td>
					<form align="left" action="login.php" method="post">
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
						<input type="button" value="Authentication" onclick="window.location.href='https://login.oregonstate.edu/cas/login?service=http://example.oregonstate.edu/'" />
					</center>
			<br>
					</form>
			login with username = testUser <BR>
			and password = password <BR>
			or create your own in the DB
			
		
			
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
		<HR color="#ff6347">
		<div id="buddyList">
			<script type="text/javascript">
				getBuddyList('<?php echo $username; ?>');
				setInterval("getBuddyList('<?php echo $username; ?>')", 5000);	
			</script>	
		</div>
		<BR>
		<img id="searchbox" src="images/searchBox.png">
		<img style="position:relative;top:6px;left:7px;" src='images/search.png' /><input id="buddySearch" onBlur="setBuddySearchBoxValue()" value="Search Users" onFocus="setBuddySearchBoxValue()" type="text" size="30" onKeyUp="searchUsers()" value=""/>
		<div style="display:none" id="buddySearchResults"></div>
		</img>
<?php
	}
?>
			</td>
			
			<div style="display:none; "id="newStudySession"> </div>
		
<!-- Whiteboard Application -->			
			<td id='whiteboardApplication' style="" valign="top" width="40%">
				<?
					if($_SESSION['loggedIn'] == 'true'){
				?>
				<img style="cursor:pointer" src='images/saveGroup.png' name='save_group'  onMouseDown="save_group.src='images/saveGroupClicked.png'" onMouseUp="save_group.src='images/saveGroup.png'" id="save_group" onClick="saveGroup();loadStudyRooms('<?php echo $username; ?>');" />
				<img style="cursor:pointer" src='images/saveClass.png' name='save_class'  onMouseDown="save_group.src='images/saveClassClicked.png'" onMouseUp="save_group.src='images/saveClass.png'" id="save_class" onClick="saveClass();loadStudyRooms('<?php echo $username; ?>');" />
				<?
				
					}
				?>
				<img title="Show Side Bar" align='left' id='showhide2' onclick='swap_show_hide()' src='images/right.png' style="display:none;"/>
				<div id='newsfeed'></div>
				<div id='uniondraw'></div>
			</td>
			
<!-- Chat Application -->			
			<td id="chatApplication" align="center" valign="top">
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

	</body>  
</html>  
