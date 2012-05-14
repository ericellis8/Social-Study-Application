<?
	function render($dir_rsc, $rsc_id, $rsc_type, $room) {
		ini_set('display_errors', 1);
		global $dir_bin;
		$room = $_GET['room'];
 		$cmd = "$dir_bin/render.sh $dir_rsc $rsc_id $rsc_type '$room' 2>&1";
#		echo str_repeat(" ", 512)."\n";
		echo $cmd."<br>";
#		flush();
#		sleep(10);
		$out = system($cmd);
#		$out = shell_exec("nice /usr/bin/ghostscript -dBATCH -dNOPAUSE -sDEVICE=pcx256 -r150x150 -sOutputFile=\"/opt/lampp/htdocs/svn/root/psview-0.3/html/rsc/f1055bfe/tmp%d\" \"/opt/lampp/htdocs/svn/root/psview-0.3/html/rsc/f1055bfe.infile\"");
		echo "<BR><pre>here ".$out."</pre>";
		return true;
	}

	function discover_gif_comps($dir_rsc, $rsc_md5, $rsc_id, $rsc_type) {
		/* Fetch directory. See how many files there are */
		$my_dir = array();
		$d = dir($dir_rsc."".$rsc_md5);
		while($entry=$d->read()) {
			echo "hi";
			if(ereg(".gif", $entry)) {
				echo "hey";
				$my_dir[] = (int) substr($entry,3,strlen($entry)-7);
			}
		}
		$d->close();
		sort($my_dir);

		$sql = "INSERT INTO RscComp (RscID, RscCompTypeID, Position, Size, Filename)";
		$sql .= " VALUES ";

		$arr = array();
		foreach($my_dir as $key=>$val) {
			$arr[] = sprintf("('%s', 1, %d, %d, '%s')",
							$rsc_id,
							$val,
							filesize("$dir_rsc/$rsc_md5/tmp$val.gif"),
							"tmp$val.gif"
							);
		}
		$sql .= join(",", $arr);
		$q = mysql_query($sql);
		return true;
	}

	function discover_html_comps($dir_rsc, $rsc_md5, $rsc_id, $rsc_type) {
		/* Fetch directory. See how many files there are */
		$my_dir = array();

		$d = dir($dir_rsc."/".$rsc_md5);
		while($entry=$d->read()) {
			if($entry == "index.html") {
				$my_dir[] = $entry;
			}
		}
		$d->close();
		sort($my_dir);

		$sql = "INSERT INTO RscComp (RscID, RscCompTypeID, Position, Size, Filename)";
		$sql .= " VALUES ";

		$arr = array();
		foreach($my_dir as $key=>$val) {
			$arr[] = sprintf("('%s', 3, %d, %d, '%s')",
							$rsc_id,
							$val,
							filesize("$dir_rsc/$rsc_md5/index.html"),
							"tmp$val.gif"
							);
		}
		$sql .= join(",", $arr);
#DEB		echo $sql."<br>";
		$q = mysql_query($sql);
		return true;
	}

	echo $tmpRsc->RscName."<br>";
#DEB	echo $tmpRsc->RscTypeID."<br>";
	/* If first component not in cache... */
	$sql = "SELECT RscCompID FROM RscComp WHERE Position=1 AND RscID=".$tmpRsc->RscID;
	$q = mysql_query($sql);
	if(mysql_num_rows($q) == 0) { // Not in component cache - render rsc */
		echo "Do render<br>";

		/* Dir for rsc component files */
		mkdir($dir_rsc."".$tmpRsc->RscMD5, 0777);
		chmod($dir_rsc."".$tmpRsc->RscMD5, 0777);
		echo "<BR>" . $dir_rsc."".$tmpRsc->RscMD5. "<BR>";
		/* Do rendition */
		render($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscTypeID);

		// Insert rendition in RscComp
		if($tmpRsc->RscTypeID == 4){
			discover_html_comps($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscID, $tmpRsc->RscTypeID);
		}else{	
			discover_gif_comps($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscID, $tmpRsc->RscTypeID);
		}
	}
?>

