<HTML><HEAD><TITLE>Online viewer</TITLE></HEAD>
<BODY onload="self.location=document.links[0]">
<PRE>
<? include("rsc.class.inc");
   include("const.inc");
   include("func.inc");
   include("db.inc");
   include("fetch.inc");
   include("render.inc");

	if(file_exists("$dir_rsc".$tmpRsc->RscMD5."/tmp1.gif")) {
		echo "\n\n<A HREF=\"psview.php?id=$tmpRsc->RscMD5&page=1\">View document here</A>";

	} elseif(file_exists("$dir_rsc".$tmpRsc->RscMD5."/index.html")) {
		echo "\n\n<a href=\"rsc/$tmpRsc->RscMD5/\">View document here</A>";

	} else {
		echo "\n\n<a href=\"psfail.php\">Could not view document. Sorry it didn't work out!</A>";
	}
?>
</PRE>
</BODY></HTML>

