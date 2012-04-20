<?php
        mysql_connect("localhost","mia","soulskater") or die(mysql_error());
    mysql_select_db("social_study_groups") or die(mysql_error());
        $class = $_GET['class'];
         echo "hello";
        if($class != ''){
      	$query = "select distinct user_name from user, class_permissions, classes where class_permissions.crn = (Select crn from classes where CONCAT(class_name, ' Sec. ', section) = '$class') AND class_permissions.user_id = user.user_id"; 
                $result = mysql_query($query) or die(mysql_error());

                //Current user class list
                echo "<select id='classUserList'>";
                while($row = mysql_fetch_array($result)){
                        echo "<option value='" . $row['user_name'] . "'>". $row['user_name'] . "</option>";
                }
                echo "</select>";
        }
       
?>

