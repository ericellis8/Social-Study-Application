<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
$room = $_GET['room'];
?>
<html>
<head>

<title>UnionDraw: Multiuser Drawing Pad in JavaScript</title>

<!--Prevents iPhone, iPad, and touch devices from scrolling or zooming when touched-->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />

<!--CSS-->
<style type="text/css">
html, body {
  width:  100%;
  height: 100%;
}

#canvas {
	/*background-image:url('images/test.png');*/
  background-color: #333333;
  position: absolute;
  top: 35px;
  border:2px solid #000000
}

#status {
  color: #FFFFFF;
  position: absolute;
  cursor: default;
  font-family: Helvetica, Verdana, sans-serif;
  font-weight: bold;
  margin: 10px;
  top: 30px;
}

#controls {
  background-color: #AAAAAA;
  position: absolute;
  font-family: Helvetica, Verdana, sans-serif;
  font-weight: bold;
  font-size: smaller;
  padding: 3px;
  width:100%;/*594px;*/
  height: 24px;
}

#thickness{
	position:relative;
	bottom:6px;
}
select {
  font-family: monospace;
  font-size: medium;
}

* {
  padding:0;
  margin:0;
}
</style>

<!--
Load Canvas support for IE8. ExplorerCanvas courtesy Google. 
See: http://code.google.com/p/explorercanvas/
-->
<!--[if lt IE 9]>
<script src="excanvas.js"></script>
<![endif]-->

<!--Load OrbiterMicro, minified version-->
<script src="OrbiterMicro_1.1.0.514_Release_min.js"></script>

<!--Load UnionDraw application code-->
<script src="UnionDraw.js">
var test = <?php echo $test; ?></script>

<script type='text/javascript'>
function savePic(file){
		var testCanvas = document.getElementById('canvas');
		var canvasData = testCanvas.toDataURL("image/png");
		var ajax = new XMLHttpRequest();
		var ajax;
		if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			ajax=new XMLHttpRequest();
  		}
		else
  		{// code for IE6, IE5
  			ajax=new ActiveXObject("Microsoft.XMLHTTP");
  		}
  		ajax.onreadystatechange=function()
	    {
	    if (ajax.readyState==4 && ajax.status==200)
			{
				//document.getElementById("here").innerHTML=ajax.responseText;
			}
	  	}
  		ajax.open("POST",'save.php?file='+file,false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(canvasData );
	}	

</script>

</head>

<body>
  <!--Drop down menus for selecting line thickness and color-->
  <div id="controls">
    <span style="position:relative;bottom:6px;">Pen Size:</span>
    <select id="thickness" class="fixed">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
    </select>

 
    <span id='color'>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#FFFFFF')" src="../images/white.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#ff0000')" src="../images/red.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#228b22')" src="../images/green.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#0000ff')" src="../images/blue.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#ffa500')" src="../images/orange.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#ffff00')" src="../images/yellow.png" /></span>
    <span><img style="cursor:pointer;" onclick="colorSelectListener('#333333')"src="../images/eraser2.png" /></span>
    </span>
  </div>
  
  <!--The canvas where drawings will be displayed-->
  <canvas style="cursor:crosshair;" id="canvas"></canvas>
  
  <!--A status text field, for displaying connection information-->
  <div id="status"></div>
  <script type='text/javascript'>
  	//savePic();
  	setInterval("savePic('<?php echo $room;?>')",5000);
  </script>
	
</body>
</html>
