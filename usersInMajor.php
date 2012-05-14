<?php
                mysql_connect("localhost","mia","soulskater") or die(mysql_error());
        mysql_select_db("social_study_groups") or die(mysql_error());
                $major = $_GET['major'];
if($major != ''){
    $query = "Select user_name from user where major='$major'";
        $result = mysql_query($query);
        if(mysql_num_rows($result) == 0){
                echo "No users in " . $major . ".";
        }else{
                echo "<select id='usersInMajorSelect'>";
                while($row = mysql_fetch_array($result)){
                        echo "<option value='" . $row['user_name'] . "'>" . $row['user_name'] . "</option>";
                }
                echo "</select>";
		echo "<button type='button' onClick=\"addUserToStudySessionFromMajor('')\">Add selected user to study session</button>"; 
        }
}


?>
