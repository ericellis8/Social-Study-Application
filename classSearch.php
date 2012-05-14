<html>
<head>
<link rel="stylesheet" href="style.css" />  
<script type='text/javascript'>

</script>
</head>

<?php
	//connect to mysql Database
	mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
	
	$search = $_GET['search']; //value entered into search bar
	if($search != '')
	{
		$query = "Select * from classes where Concat(class_name, ' - ',description) LIKE '%$search%' ORDER BY class_name";
		$result = mysql_query($query);
	
		//If there are no classes returned
		if(mysql_num_rows($result) == 0)
		{
			echo "No Classes"; 
		}
	
		//Print out links for each class returned. Call enterRoom on click
		while($row = mysql_fetch_array($result))
		{
			echo "<a id='searchResults' style='cursor:pointer;color:blue' onclick=\"enterRoom('" . $row['class_name'] . " Sec. " . $row['section'] . "')\">" .$row['class_name'] . " Sec. " . $row['section'] .' - ' . $row['description'] . "</a><BR>";
		}
	}
?>

</html>
