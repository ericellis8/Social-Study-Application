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
	//$user = $_GET['username'];
//if($user != ''){
if($search != ''){
    $query = "Select distinct major from user where major LIKE '%$search%'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0){
		echo "No majors";
	}else{
		while($row = mysql_fetch_array($result)){
			echo "<a id='majorSearchResults' style='cursor:pointer;color:blue' onclick='usersInMajors('".$row['major']."')'>" . $row['major'] . "</a><BR>";
		}
	}
}



?>

</html>
