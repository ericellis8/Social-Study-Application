<?php
	$room = $_GET['room'];
?>

<iframe id='udraw' height="440" style="border:1px solid black;padding-left:0px;padding-right:0px;position:relative;top:-2px;left:5px;width:600px;height:440px;"  frameborder="0" scrolling="no" src="uniondraw/uniondraw.php?room=<?php echo $room; ?>" >
