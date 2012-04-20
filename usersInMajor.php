<html>
<head>
<link rel="stylesheet" href="style.css" />  
<script type='text/javascript'>

</script>
</head>

<?php
                mysql_connect("localhost","mia","soulskater") or die(mysql_error());
        mysql_select_db("social_study_groups") or die(mysql_error());
                $major = $_GET['major'];
if($search != ''){
    $query = "Select user from user where major='$major'";
        $result = mysql_query($query);
        if(mysql_num_rows($result) == 0){
                echo "No users in " . $major " .";
        }else{
                echo "<select>";
                while($row = mysql_fetch_array($result)){
                        echo "<option value='$row'>" . $row . "</option>";
                }
                echo "</select>";
        }
}


?>

</html>

