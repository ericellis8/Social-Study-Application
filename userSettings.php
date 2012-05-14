<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();
$username = $_SESSION['username'];
$query = "Select * from user where user_name = '$username'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$name = $row['full_name'];
$major = $row['major'];
$checked = $row['show_name'];
?>

<html>
<body>
<a style="cursor:pointer;" onclick="closeNewSession()"><img align="right" src="images/x.png" /></a><BR>
<center>
<h2 style="COLOR:#c34500;">User Settings</h2>
</center>
<form style="position:relative;left:3px;font:14px Tahoma, Sans-serif;color:black;">
Full Name: <?php echo $name; ?><BR><BR>
Username:(<?php echo $username ?>) <input align="right" type="checkbox" id="changedName" <?php if($checked==0) echo "checked"; ?>>Anonymous <BR><BR>
Major: <input type="text" name="usersMajor" id="usersMajorChanged" value="<?php echo $major; ?>" size="50"/><BR><BR>
<center>
<button type="button" class="button" value ="Submit Changes" onClick="changeSettings()">Submit Changes</button>
</center>
</form>
</body>
</html>
