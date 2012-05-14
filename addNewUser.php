<?php
	$con = mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	
	$sql="
	INSERT INTO user (user_name, onid_user, full_name, email, password, major, show_name)
	Values ('$_POST[username_entry]', '$_POST[oniduser_entry]', '$_POST[fullname_entry]', 
		'$_POST[email_entry]', '$_POST[password_entry]', '$_POST[major_entry]', '1')
	";

	$password1 = $_POST[password_entry];
	$password2 = $_POST[password2_entry];
	if($password1 == $password2)
	{
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
	}

	mysql_close($con);
?>

<?php
header("Location: index.php?");
exit;
?> 