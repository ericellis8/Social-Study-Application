<HTML><HEAD><TITLE>Online viewer</TITLE></HEAD>
<BODY BGCOLOR="F2F2F2">
<PRE><? 
	# Ought to check whether the rsc is in cache. If not, and it is a url, then it is feasible to fetch it.	
	# All it can do now, is to render, if the components have been cleaned out.
   include("../inc/rsc.class.inc");
   include("../inc/const.inc");
   include("../inc/func.inc");
   include("../inc/db.inc");
	$id = $_GET['id'];
	$page = $_GET['page'];
	$ori = $_GET['ori'];
	$all = $_GET['all'];
	$size = $_GET['size'];
	$room = $_GET['room'];
	if(isset($id) && ereg("^[0-9a-f]{8}$", $id)) { # Validate $id
		$view=1;
	} else {
		$view=0;
	}

	if(!(isset($page) && ereg("^[0-9]+$", $page))) { # Validate $page
		$page=1;
	}

	if(!(isset($ori) && ereg("^[0-3]$", $ori))) { # Validate $ori
		$ori=0;
	}

	if($view) {
		/* Let's see if there's a resource matching the MD5 */
		$sql = "SELECT * FROM Rsc WHERE RscMD5='$id' AND InCache=-1";
		$qRsc = mysql_query($sql);
		if(!$tmpRsc = mysql_fetch_object($qRsc)) {
			/* Not in cache */
			$view=0;
			echo "Resource not in cache<br>";
		}
	}

	if($view) {
		include("render.inc");

		/* By now, there should be a resource with components available */

		/* Fetch components */
		$sql = "SELECT * FROM RscComp WHERE RscID=".$tmpRsc->RscID;
		$sql .= " ORDER BY Position";
#DEB		echo $sql;
		$qRscComp = mysql_query($sql);
		if(($num_comp = mysql_num_rows($qRscComp)) > 0) {
			/* Got components */
		} else { // Got no components
			/* Not ok */
			echo "Resource not in cache<br>";
			$view=0;
		}
	}

	# Handle rotated images
	if($view) {
		if($ori != 0) {
			# Check if there is a rotated image already there
			if(!file_exists($dir_rsc."/".$tmpRsc->RscMD5."/tmp".$page."_".$ori.".gif")) { 
				$angle = $ori * 90; # 0->0, 1->90, 2->180, 3->270
				$cmd = "$cmd_convert -rotate $angle $dir_rsc/".$tmpRsc->RscMD5."/tmp".$page.".gif $dir_rsc/".$tmpRsc->RscMD5."/tmp".$page."_".$ori.".gif";
#				echo $cmd;
				exec($cmd);

			}
		}

		$ori_clockwise = ($ori+1) % 4;
		$ori_counterclockwise = ($ori+3) % 4;
	}

	if(isset($size) && $size=="full") {
		$dofull=true;
	} else {
		$dofull=false;
	}

?></PRE><?

if($view) {
	$web_path = "rsc/".$tmpRsc->RscMD5."/";

?>
<TABLE>
<TR VALIGN=TOP>
<TD WIDTH=130 VALIGN=TOP>
<!-- Nav -->
	<A HREF="index.php?room=<?php echo $room; ?>">Upload a new file</A> <span style="position:relative;left:40px;">Click on document to enlarge</span>
</TD>
</TR>
<TR VALIGN=TOP><TD VALIGN=TOP>
	<PRE><?
		//echo "  \" \"\n <@ @>\n\n";
	 	if($page>1) {
			$prev_page=$page-1;
			echo "<A HREF=\"psview.php?id=$id&page=$prev_page&room=$room";
			if($dofull) {
				echo "&size=full";
			}
			if($ori != 0) { 
				echo "&ori=".$ori; 
			}
			echo "\">&lt;--</A>";
			//echo "\"><img src='../../images/leftArrow.png' /></A>";
		} else
			echo "&lt;--";
			//echo "<img src='../../images/leftArrow.png' />";
		echo " ";

 		if($page<$num_comp) {
			$next_page=$page+1.0;
			echo "<A HREF=\"psview.php?id=$id&page=$next_page&room=$room";
			if($dofull) {
				echo "&size=full";
			}
			if($ori != 0) { 
				echo "&ori=".$ori; 
			}
			echo "\">--&gt;</A>";
			//echo "\"><img src='../../images/rightArrow.png' /></A>";

		} else
			echo "--&gt;";
			//echo "<img src='../../images/rightArrow.png' />";
		
		//echo "\n\n";		
		echo "   ";
		while ($comp = mysql_fetch_object($qRscComp)) {
			$img = "tmp".$comp->Position;
			if($ori != 0)
				$img .= "_".$ori;
			$img .= ".gif";
			$comp_id = $comp->RscCompID;

			$link = "psview.php?id=$id&room=$room&page=".$comp->Position;
			if($dofull)
				$link .= "&size=full";
			if($ori != 0) 
				$link .= "&ori=".$ori; 

			$comps[$comp->Position] = array($link, $img);

			if($page==$comp->Position) {
				echo "-&gt; ";
				$web_file = $img;
			} else {
				echo "   ";
			}

			echo "<A HREF=\"".$link."\">".$comp->Position."</A>";
        	} ?><!--</PRE>Show this<br>document<br>to a friend
	<FORM ACTION="psmail.php" METHOD="GET">
		<input type=hidden name=id value="<? echo $id; ?>">
		<input type=hidden name=page value="<? echo $page; ?>">
		<INPUT NAME="email" SIZE=13 TYPE="text" VALUE="email here"><BR>
		<INPUT NAME="submit" TYPE="submit" VALUE="Send mail!"><BR>
	</FORM>
	<PRE>--><?
			echo "   ";
			echo "<A HREF=\"psview.php?id=$id&room=$room&page=".$page;
			if($dofull) {
				echo "&size=full";
			}
			echo "&ori=".$ori_clockwise;
			echo "\">Rotate right</A>";
			echo "   ";
			echo "<A HREF=\"psview.php?id=$id&room=$room&page=".$page;
			if($dofull) {
				echo "&size=full";
			}
			echo "&ori=".$ori_counterclockwise;
			echo "\">Rotate left</A>";
			echo "   ";
			echo "<A HREF=\"psview.php?id=$id&room=$room&page=".$page;
			if($dofull) {
				echo "&size=full";
			}
//			if($ori != 0)
//				echo "&ori=".$ori;
			echo "&all=1";
			echo "\">View all</A><BR>";
	?></PRE>
</TD>
</tr><tr>
<TD ALIGN=LEFT><?
	if(!isset($all)) { // One page only
?>
	<A HREF="psview.php?id=<? 
		echo $id."&room=$room&page=".$page; 
		if(!$dofull) { 
			echo "&size=full"; 
		}
		if($ori != 0) { 
			echo "&ori=".$ori; 
		}
    ?>"><IMG BORDER=1 SRC="<? echo $web_path.$web_file; ?>" <? if(!$dofull) { echo "WIDTH=570"; } ?>></A>
<?
	} else { // All pages?
		foreach($comps as $key=>$val) {
			echo "<A HREF=\"".$val[0]."&all=1";
			if(!$dofull) { 
				echo "&size=full"; 
			}
			echo "\">";
			echo "<IMG BORDER=1 SRC=\"".$web_path.$val[1]."\"";
			if(!$dofull) { echo " WIDTH=570"; }
			echo "></A><BR>";
		}
	}
?></TD>
</TR>
</TABLE>

<? 
	/* Tell RscCompView */
	$host = mysql_escape_string(substr(GetEnv("REMOTE_HOST"), 0, 254));
	$ip = mysql_escape_string(substr(GetEnv("REMOTE_ADDR"), 0, 15));
	$req_status = "200";	
	$req_method = mysql_escape_string(substr(GetEnv("REQUEST_METHOD"), 0, 254));
	$request = mysql_escape_string(substr(GetEnv("QUERY_STRING"), 0, 254));
	$referer = mysql_escape_string(substr(GetEnv("HTTP_REFERER"), 0, 254));
	$user_agent = mysql_escape_string(substr(GetEnv("HTTP_USER_AGENT"), 0, 254));

	$sql = "INSERT INTO RscCompView";
	$sql .= " (RscCompID, req_date, req_status, req_method, request, referer, user_agent, host, ip)";
	$sql .= sprintf(" VALUES (%d, NOW(), '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
						$comp_id,
						$req_status,
						$req_method,
						$request,
						$referer,
						$user_agent,
						$host,
						$ip
					);

#DEB	echo $sql."<BR>";
	$q = mysql_query($sql);
	if($page == '1' && isset($_GET['room'])){
		$query = "Select * from doc_files where room_id = '$room'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			$query = "Update doc_files SET rsc_id = '$id' where room_id = '$room'";
			mysql_query($query);
		}else{
			$query = "Insert into doc_files(rsc_id,room_id) VALUES('$id','$room')";
			mysql_query($query) or die(mysql_error());
		}
	}
   } else { ?>
	Could not view this page
<? } ?>
</BODY></HTML>
