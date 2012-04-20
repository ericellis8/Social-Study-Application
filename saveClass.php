<?php
	mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	session_start();
	$class = $_GET['class'];
	$myName = $_SESSION['username'];
	$query = "select * from class_permissions where user_id = (SELECT user_id from user where user_name = '$myName') AND crn = (SELECT crn from classes where CONCAT(class_name, ' Sec. ', section) = '$class')";
	$result = mysql_query($query);
 	//$row = mysql_fetch_array($result);
 	if(mysql_num_rows($result) > 0){
 		echo "already enrolled";
 	}else{
 		$insertQuery = "Insert into class_permissions(crn,user_id,permissions)VALUES((Select crn from classes where CONCAT(class_name, ' Sec. ', section) = '$class'), (Select user_id from user where user.user_name = '$myName'),1)";
 		$insertResult = mysql_query($insertQuery) or die(mysql_error());
 		
 	}
?>
