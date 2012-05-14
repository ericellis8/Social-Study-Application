 <?php
 session_start();
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
                    	<li class='first-child'><a href='index.php'>Beaver Study</a></li>  
                        <li><a href='#' onclick="newStudySession()" title="Create a session for one time use">Start A Temporary Session</a></li>  
                    	<li><a href="#" title="Create a perminent study group" >Create A New Study Group</a></li> 
                    	<!--<li><a href="#" title="Nav Link 1">Add Friends</a></li>  -->
                    	<li><a href="javascript:void(0)" onClick='logOut()'>Log Out</a></li>
                    	<!--<li>
                    		<a href="#">Account</a>
                    		<ul>
                    			<li><a href="javascript:void(0)" onClick='logOut()'>Log Out</a></li>
                    			<li><a href="#">User Settings</a></li>
                    		</ul>
                    	</li>  -->
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
      <BR><BR>      
<center>
<h1 style="color:#c34500">About </h1>

<table>
<tr><td align="center">
Interactive Whiteboard
</td><td align="center">
Document Viewer
<tr><td>
<img width="600px" src="images/CS Screenshot.png" />
</td><td>
<img width="600px" src="images/362 Screenshot.png" />
</tr>
</table>
<BR><BR>
<h2 style="color:#c34500">2012 Senior Capstone<h2>      
</center>     
</body>
</html>