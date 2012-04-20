<?
	function render($dir_rsc, $rsc_id, $rsc_type) {
		global $dir_bin;
 		$cmd = "$dir_bin/render.sh $dir_rsc $rsc_id $rsc_type";
#DEB		echo str_repeat(" ", 512)."\n";
#DEB		echo $cmd."<br>";
#DEB		flush();
#DEB		sleep(10);

		system($cmd);
		return true;
	}

	function discover_gif_comps($dir_rsc, $rsc_md5, $rsc_id, $rsc_type) {
		/* Fetch directory. See how many files there are */
		$my_dir = array();

		$d = dir($dir_rsc."/".$rsc_md5);
		while($entry=$d->read()) {
			if(ereg(".gif", $entry)) {
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
#DEB		echo $sql."<br>";
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

#DEB	echo $tmpRsc->RscID."<br>";
#DEB	echo $tmpRsc->RscTypeID."<br>";

	/* If first component not in cache... */
	$sql = "SELECT RscCompID FROM RscComp WHERE Position=1 AND RscID=".$tmpRsc->RscID;
	$q = mysql_query($sql);
	if(mysql_num_rows($q) == 0) { // Not in component cache - render rsc */
#DEB		echo "Do render<br>";

		/* Dir for rsc component files */
		mkdir($dir_rsc."/".$tmpRsc->RscMD5, 0700);

		/* Do rendition */
		render($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscTypeID);

		// Insert rendition in RscComp
		if($tmpRsc->RscTypeID == 4)
			discover_html_comps($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscID, $tmpRsc->RscTypeID);
		else
			discover_gif_comps($dir_rsc, $tmpRsc->RscMD5, $tmpRsc->RscID, $tmpRsc->RscTypeID);
	}
?>

