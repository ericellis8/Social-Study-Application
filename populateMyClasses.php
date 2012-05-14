<?php

	mysql_connect("localhost","mia","soulskater") or die(mysql_error());
    mysql_select_db("social_study_groups") or die(mysql_error());
	$user = $_GET['username'];
	if($user != ''){
        $query = "Select class_name,section from classes,class_permissions where class_permissions.user_id=(Select user_id from user where user_name='$user') and class_permissions.crn=classes.crn";
		$result = mysql_query($query);
	
		//Current user class list
		echo "<select id='class' name='classList' onChange='classUserList(this.value)'>";
		$i = 0;
		while($row = mysql_fetch_array($result)){
			if($i == 0){
				$class = $row['class_name'] . " Sec. " . $row['section'];
			}
			$i++;
			echo "<option value='" . $row['class_name'] . " Sec. " . $row['section'] . "'>" . $row['class_name'] .  " Sec. " . $row['section'] . "</option>";
		}
		echo "</select>";

		
		$query = "select distinct user_name from user, class_permissions, classes where class_permissions.crn = (Select crn from classes where CONCAT(class_name, ' Sec. ', section) = '$class') AND class_permissions.user_id = user.user_id"; 
                $result = mysql_query($query);

                //Current user class list
                echo "<form action='addUserToTable.php' method='post'>";
		echo "<select id='classUserList'>";
                while($row = mysql_fetch_array($result)){
                        echo "<option value='" . $row['user_name'] . "'>". $row['user_name'] . "</option>";
                }
                echo "</select>";
		echo "</form>";

		//button to invite the current user into the new study session
		echo "<button type='button' onClick=\"addUserToStudySession('')\">Add to study session</button>"; 
		echo "<br />";
		
		//add users here in the table
		echo "<div id='usersAddedToTable'></div>";
		echo "</tr>";
		echo "</table>";
}

?>
