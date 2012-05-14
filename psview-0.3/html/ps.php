<HTML><HEAD><TITLE>Online viewer</TITLE></HEAD>
<BODY onload="self.location=document.links[0]">
<PRE>
<? include("../inc/rsc.class.inc");
   include("../inc/const.inc");
   include("../inc/func.inc");
   include("../inc/db.inc");
   include("../inc/fetch.inc");
   include("../inc/render.inc");
	$room = $_GET['room'];
	echo "$dir_rsc".$tmpRsc->RscMD5."/tmp1.gif";
	if(file_exists("$dir_rsc".$tmpRsc->RscMD5."/tmp1.gif")) {
		echo "\n\n<A HREF=\"psview.php?room=$room&id=$tmpRsc->RscMD5&page=1\">View document here</A>";

	} elseif(file_exists("$dir_rsc".$tmpRsc->RscMD5."/index.html")) {
		echo "\n\n<a href=\"rsc/$tmpRsc->RscMD5/index.html\">View document here</A>";
		if(isset($room)){
			$id = $tmpRsc->RscMD5;
			$query = "Select * from doc_files where room_id = '$room'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$query = "Update doc_files SET rsc_id = '$id' where room_id = '$room'";
				mysql_query($query) or die(mysql_error());
			}else{
				$query = "Insert into doc_files(rsc_id,room_id) VALUES('$id','$room')";
				mysql_query($query) or die(mysql_error());
			}
		
		}
	} else {
		echo "\n\n<a href=\"psfail.php\">Could not view document. Sorry it didn't work out!</A>";
	}
?>
</PRE>
</BODY></HTML>

