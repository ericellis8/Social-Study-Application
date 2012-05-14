<HTML>
<HEAD>
<TITLE>Add a document to your study group</TITLE>
<META name="description" content="Online PDF, PostScript and Word viewer. View documents online for free. No software installation required.">
<META name="keywords" content="Online, Web, View, Viewer, PDF, PS, PostScript, Word, MS, Microsoft, Free, Convert">
<style type="text/css">
body {
  background-color:#f2f2f2;
}
</style>
</HEAD>
<BODY> 

<H1 align=center>Add a Document</H1>

<!--<UL>-->
<!--<LI>This is an online viewer, with which you can view PDF and PostScript files as browsable images and Word documents as web pages. Given a URL on the net or a file on your computer, the viewer will try to retrieve the document, convert it and show it to you. No plugin software is required.
</UL>

<UL>
<B>WEB view - Fetch the document from the web:</B>
<LI>
<FORM action="ps.php" method="GET">
<INPUT NAME="url" SIZE=50 TYPE="text" VALUE="http://">
<INPUT NAME="submit" TYPE="submit" VALUE="View!"><BR>
</FORM>
</UL>-->
<UL>
<B>Upload a file from your computer:</B>

<FORM  ENCTYPE="multipart/form-data" action="ps.php?room=<?php echo $_GET['room']; ?>" method="POST">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="5000000">
<INPUT NAME="file" SIZE=50 TYPE="file" VALUE="">
<INPUT NAME="submit" TYPE="submit" VALUE="Upload">
<BR>
</FORM>
</UL>
<!--
<UL>
<B>OR - View these examples:</B>
<LI>
<A href="ps.php?url=http://view.samurajdata.se/rsc/license.pdf">PDF</A>
<A href="ps.php?url=http://view.samurajdata.se/rsc/refcard.ps">PostScript</A>
<A href="ps.php?url=http://view.samurajdata.se/rsc/refcard.ps.gz">Gzipped PostScript</A>
<A href="ps.php?url=http://view.samurajdata.se/rsc/opensource.doc">Word</A>
</UL>

<UL>
<B>Software:</B>
<LI>The viewer software is open source, licensed under the GNU Public License.
<LI>Version 0.2 of the software can be downloaded here: <a href="psview-0.2.tar.gz">psview-0.2.tar.gz</a>
</UL>

<UL>
<B>History:</B>
<LI>The viewer grew out of frustration over there never being good PDF or PostScript viewers on all different operating systems and computers I use.
<LI>The solution: a web interface! All major operating systems have somewhat functional web browsers available, so now I can view PDF and PostScript files wherever I want, and it can handle compressed files too. 
</UL>

<UL>
<B>Todo:</B>
<LI>Better user interface
<LI>Convert to different formats
<LI>Create a FAQ that is actually based on questions people have asked
<LI>Page layout
<LI>Better error messages
<LI>Better feedback
<LI>Increase speed (possibly by only converting pages on demand, instead of converting all like now)
</UL>

<UL>
<B>FAQ:</B>
<LI>Q: Why is it so slow? A: Because downloading and converting images is a slow business.
<LI>Q: Something went wrong. Who do I mail? A: <A HREF="mailto:cj@samurajdata.se">cj@samurajdata.se</A>.
<LI>Q: What makes these features possible? A: In one word: Open Source (oops! that was two words...). In several words: Ghostscript, php, wvWare, Apache, ImageMagick, gnu wget, gnu zip, Linux and so on.
</UL>

<UL>
<B>More stuff:</B>
<LI>The viewer is hosted by <a href="http://www.samurajdata.se/">Samuraj Data AB</a>.
</UL>-->

</BODY>
</HTML>
