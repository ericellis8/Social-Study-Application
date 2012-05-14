<html>
<head>
<link rel="stylesheet" href="style.css" />  
<script type='text/javascript'>

</script>
</head>

<?php
                mysql_connect("localhost","mia","soulskater") or die(mysql_error());
        mysql_select_db("social_study_groups") or die(mysql_error());
                $search = $_GET['search'];
if($search != ''){
    $query = "Select distinct user_name from user where user_name LIKE '%$search%'";
        $result = mysql_query($query);
        if(mysql_num_rows($result) == 0){
                echo "No users";
        }else{
                while($row = mysql_fetch_array($result)){
	        echo "<a id='anyoneSearchResultsIndividual' style='cursor:pointer;color:blue' onclick=\"addAnyUserToSession('".$row['user_name']."')\">" . $row['user_name'] . "</a><BR>";
		}
        }
}



?>

</html>

