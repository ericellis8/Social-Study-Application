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
	$query = "Select * from user where CONCAT(user_name,' ', full_name) LIKE '%$search%'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0){
		echo "No Users";
	}
	while($row = mysql_fetch_array($result)){
		echo "<a id='searchResults' style='cursor:pointer;color:blue' onclick=\"addUser('" . $row['user_name'] . "')\">" .$row['user_name'] . " - " . $row['full_name'] ."</a><BR>";
	}
}
?>

</html>