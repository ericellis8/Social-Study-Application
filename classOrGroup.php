<?
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
	mysql_select_db("social_study_groups") or die(mysql_error());
$name = $_GET['group_name'];

$query = "SELECT class_name from classes where CONCAT(class_name, ' Sec. ', section) = '$name'";
$result = mysql_query($query);
if(mysql_num_rows($result) == 0){
	echo "group";
}else{
	echo "class";
}
?>
