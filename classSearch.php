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
	$query = "Select * from classes where Concat(class_name, ' - ',description) LIKE '%$search%' ORDER BY class_name";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0){
		echo "No Classes";
	}
	while($row = mysql_fetch_array($result)){
		echo "<a id='searchResults' style='cursor:pointer;color:blue' onclick=\"addGroup('" . $row['class_name'] . " Sec. " . $row['section'] . "')\">" .$row['class_name'] . " Sec. " . $row['section'] .' - ' . $row['description'] . "</a><BR>";
	}
}
?>

</html>