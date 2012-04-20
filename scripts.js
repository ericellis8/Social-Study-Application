function usersInMajors(major){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("usersInMajor").innerHTML=xmlhttp.responseText;
	    }
	  }
	//currentClass = document.getElementById("class").value;
	xmlhttp.open("GET","usersInMajor.php?major="+major,true);
	xmlhttp.send();
}



function classUserList(currentClass){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("classUserList").innerHTML=xmlhttp.responseText;
    }
  }
//currentClass = document.getElementById("class").value;
xmlhttp.open("GET","classUserList.php?class="+currentClass,true);
xmlhttp.send();	
}

function displaySearchAnyone(){
        document.getElementById("classList").style.display="none";
        document.getElementById("anyoneSearch").style.display="";
        document.getElementById("majorSearch").style.display="none";	
}

function displayNone(){
        document.getElementById("classList").style.display="none";
        document.getElementById("anyoneSearch").style.display="none";
        document.getElementById("majorSearch").style.display="none";
}

function logOut(){
	pfc.sendRequest('/quit');
	setTimeout("window.location = 'logout.php';",500);
}

function getUser(){
	var li = pfc.buildNickItem('904cb17acbe02c2ad452f5be0901e317d031502f');
	document.getElementById('buddyList').appendChild(li);
}
function changeName(nick){
	pfc.sendRequest('/nick ' + nick);
}

function loadStudyRooms(username)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("studyRoom").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","studyRooms.php?username="+username,true);
xmlhttp.send();
}
function getBuddyList(username)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("buddyList").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","buddyList.php?username="+username,true);
xmlhttp.send();
}


function saveGroup()
{
var xmlhttp;
 if(window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   // document.getElementById("buddyList").innerHTML=xmlhttp.responseText;
    }
  }
  groupName = document.getElementById("pfc_title").innerHTML;
xmlhttp.open("GET","addUserToGroup.php?group_name="+groupName,true);
xmlhttp.send();
}

function saveClass()
{
var xmlhttp;
 if(window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   // document.getElementById("buddyList").innerHTML=xmlhttp.responseText;
    }
  }
  className = document.getElementById("pfc_title").innerHTML;
xmlhttp.open("GET","saveClass.php?class="+className,true);
xmlhttp.send();
}

function newStudySession()
{
var newSessionPopUp = document.getElementById('newStudySession');
newSessionPopUp.style.display = '';
var newSessionPopUp = document.getElementById('blur');
newSessionPopUp.style.display = '';
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("newStudySession").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","newStudySession.php",true);
xmlhttp.send();
}

var showhide_status = false;
function swap_show_hide()
  {
    if (showhide_status) {
      showhide_status = false;
    } else {
      showhide_status = true;
    }
    this.refresh_show_hide();
  }
function refresh_show_hide()
  {
   	var showhide     = $('showhide');    
    var left_bar = $('left_bar');
    var showhide2 = $('showhide2');
    var uniondraw = $('udraw');
    var room = $();
    if (showhide_status)
    { 
     showhide2.style.display = '';
     left_bar.style.display = 'none';
     uniondraw.style.top = '1px';
     uniondraw.style.width= '600px';
    }
    else
    {
     left_bar.style.display = '';
     showhide2.style.display = 'none';
     uniondraw.style.top = '1px';
     uniondraw.style.width= '600px';
    }
  }
var buddiesClickedOn = new Array();
function beginSession(){
	var sessionName = document.getElementById('sessionName');
	if(sessionName.value != ""){
		pfc.sendRequest("/join "+sessionName.value);
		for(var i=0;i<buddiesClickedOn.length;i++){
			pfc.sendRequest("/invite "+buddiesClickedOn[i] + " \"" + sessionName.value + "\"");
		}
		var newSessionPopUp = document.getElementById('newStudySession');
		newSessionPopUp.style.display = 'none';
		var newSessionPopUp = document.getElementById('blur');
		newSessionPopUp.style.display = 'none';
	}else{
		alert("Please enter a name for the session");
	}
}	


function clickedOn(buddyClickedOn){
	var id=document.getElementById(buddyClickedOn);
	id.style.backgroundColor = "green";
	buddiesClickedOn.push(buddyClickedOn);
	
}
 
function yourClasses(username){
document.getElementById("classList").style.display="";
document.getElementById("majorSearch").style.display="none";
document.getElementById("anyoneSearch").style.display="none";
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("classList").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","populateMyClasses.php?username="+username,true);
xmlhttp.send();	
}

function displayMajorSearchBar(){
	document.getElementById("classList").style.display="none";
        document.getElementById("anyoneSearch").style.display="none";
	document.getElementById("majorSearch").style.display="";
}

function searchMajors(){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("newSessionSearchResults").innerHTML=xmlhttp.responseText;
    }
  }
var value = document.getElementById('majorSearchValue').value;
document.getElementById('newSessionSearchResults').style.display = '';
if(value == ''){
document.getElementById('newSessionSearchResults').style.display = 'none';
}
xmlhttp.open("GET","searchMajors.php?search="+value,true);
xmlhttp.send();	
}

function closeNewSession(){
	var newSessionPopUp = document.getElementById('newStudySession');
	newSessionPopUp.style.display = 'none';
	var newSessionPopUp = document.getElementById('blur');
	newSessionPopUp.style.display = 'none';
    buddiesClickedOn = new Array();
}

function searchClasses(){
    var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("classSearchResults").innerHTML=xmlhttp.responseText;
    }
  }
var value = document.getElementById('classSearch').value;
document.getElementById('classSearchResults').style.display = '';
if(value == ''){
document.getElementById('classSearchResults').style.display = 'none';
}
xmlhttp.open("GET","classSearch.php?search="+value,true);
xmlhttp.send();
    
}

function searchUsers(){
    var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("buddySearchResults").innerHTML=xmlhttp.responseText;
    }
  }
var value = document.getElementById('buddySearch').value;
document.getElementById('buddySearchResults').style.display = '';
if(value == ''){
document.getElementById('buddySearchResults').style.display = 'none';
}
xmlhttp.open("GET","buddySearch.php?search="+value,true);
xmlhttp.send();
    
}

function addGroup(name){
    document.getElementById('classSearchResults').style.display = 'none';
    document.getElementById('classSearch').value = '';
    name = name.split(' - ');
    pfc.sendRequest('/join ' + name[0]);
}

function addUser(name){
    document.getElementById('buddySearchResults').style.display = 'none';
    document.getElementById('buddySearch').value = '';
    username = name.split(' - ');
    var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("studyRoom").innerHTML=xmlhttp.responseText;
    getBuddyList('');
    }
  }
xmlhttp.open("GET","addToBuddyList.php?name="+username[0],true);
xmlhttp.send();
    //pfc.sendRequest('/invite ' + username[0]);
}

function removeBuddy(username){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   // document.getElementById("classesDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","removeBuddy.php?username="+username,true);
xmlhttp.send();
}

function removeGroup(group){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   // document.getElementById("classesDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","removeUserFromGroup.php?group_name="+group,true);
xmlhttp.send();
}

function removeClass(group){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   // document.getElementById("classesDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","removeUserFromClass.php?class_name="+group,true);
xmlhttp.send();
}

function setClassSearchBoxValue(){
    var searchBox = document.getElementById("classSearch");
    if(searchBox.value == 'Search Classes'){
        searchBox.value = '';
        searchBox.style.color = 'black';
    }else if(searchBox.value == ''){
        searchBox.value = "Search Classes";
        searchBox.style.color = 'grey';
    }
}

function setBuddySearchBoxValue(){
    var searchBox = document.getElementById("buddySearch");
    if(searchBox.value == 'Search Users'){
        searchBox.value = '';
        searchBox.style.color = 'black';
    }else if(searchBox.value == ''){
        searchBox.value = "Search Users";
        searchBox.style.color = 'grey';
    }
}
