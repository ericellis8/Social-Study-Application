function searchAnyone(){
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
        document.getElementById("anyoneSearchResults").innerHTML=xmlhttp.responseText;
        }
    }

    var value = document.getElementById('searchAnyoneValue').value;
    document.getElementById('anyoneSearchResults').style.display = '';
    if(value == ''){
        document.getElementById('anyoneSearchResults').style.display = 'none';
    }

    xmlhttp.open("GET","searchAnyone.php?search="+value,true);
    xmlhttp.send();

}

var buddiesClickedOn = new Array();
var docOrDraw = "draw";
function showDocViewer(){
	document.getElementById('uniondraw').style.display = 'none';
	document.getElementById('docViewer').style.display = '';
	document.getElementById('showWhiteBoard').src = "images/whiteboard.png";
	document.getElementById('showDoc').src = "images/docViewerSelected.png";
	docOrDraw = "doc"
}	

function showWhiteboard(image){
	docOrDraw = "draw";
	document.getElementById('docViewer').style.display = 'none';
	document.getElementById('uniondraw').style.display = '';
	document.getElementById('showWhiteBoard').src = "images/whiteboardSelected.png";
	document.getElementById('showDoc').src = "images/docViewer.png";
}	

function removeUserFromTable(user){
	for (i=0; i<buddiesClickedOn.length; i++){
		if(user == buddiesClickedOn[i]){
			buddiesClickedOn.splice(i, 1);
		}
	}
	document.getElementById("addToUserTable").innerHTML = "";
	
	for (i=0; i<buddiesClickedOn.length; i++){
		if((i % 3) == 0 && i != 0){
        	document.getElementById("addToUserTable").innerHTML += "<BR>";
		}
		document.getElementById("addToUserTable").innerHTML += "<tr style='width:22px'><td class='userAdded' style='background-color:green'><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none;' onClick=\"removeUserFromTable('" + buddiesClickedOn[i] +"');\"><img src='images/delete.gif' /></a>"+buddiesClickedOn[i]+"</td></tr>";
		
	}
}

function addAnyUserToSession(user){
        for (i=0; i<buddiesClickedOn.length; i++){
                if(user == buddiesClickedOn[i]){
                        return;
                }
        }
	document.getElementById('anyoneSearchResults').style.display='none';
	buddiesClickedOn.push(user);
	document.getElementById("addToUserTable").innerHTML += "<a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeUserFromTable('" + user +"');\"><img src='images/delete.gif' /></a>"+user;
	if((buddiesClickedOn.length % 3) == 0){
        	document.getElementById("addToUserTable").innerHTML += "<BR>";
	}
	document.getElementById('searchAnyoneValue').value='';
}

function addUserToStudySessionFromMajor(){
        var e = document.getElementById('usersInMajorSelect');
        var user = e.options[e.selectedIndex].text;
        var i = 0;
        for (i=0; i<buddiesClickedOn.length; i++){
                if(user == buddiesClickedOn[i]){
                        return;
                }
        }
        document.getElementById("addToUserTable").innerHTML += "<tr><td class='userAdded' style='background-color:green'><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeUserFromTable('" + user +"');\"><img src='images/delete.gif' /></a>"+user+"</td></tr>";
        buddiesClickedOn.push(user);
        if((buddiesClickedOn.length % 3) == 0){
        	document.getElementById("addToUserTable").innerHTML += "<BR>";
		}
}


function addUserToStudySession(){
	var e = document.getElementById('classUserList');
	var user = e.options[e.selectedIndex].text;
        var i = 0;
	for (i=0; i<buddiesClickedOn.length; i++){
		if(user == buddiesClickedOn[i]){
			return;
		}
	}
	document.getElementById("addToUserTable").innerHTML += "<tr><td style='background-color:green'><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeUserFromTable('" + user +"');\"><img src='images/delete.gif' /></a>"+user+"</td></tr>";
	buddiesClickedOn.push(user);	
	if((buddiesClickedOn.length % 3) == 0){
        	document.getElementById("addToUserTable").innerHTML += "<BR>";
	}
}

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
	document.getElementById("majorSearchValue").value = "";
	document.getElementById("majorSearchResults").style.display = "none";
	document.getElementById("usersInMajor").style.display = "";
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
    if(document.getElementsByClassName("studyRooom")){
        var study_room = document.getElementsByClassName("studyRoom");
        var roomLength = study_room.length;
        if(document.getElementById("pfc_title")){
            var title = document.getElementById("pfc_title").innerHTML;
            for(var i =0; i < roomLength; i++){
                if(study_room[i].name == title){
                    study_room[i].style.color = "#c34500";
                }else{
                    study_room[i].style.color = "black";
                }
            }
        }
    }
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

function addSelfToGroup(groupName)
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
xmlhttp.open("GET","addUserToGroup.php?group_name="+groupName,true);
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

function addToGroup(user,group)
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
    //document.getElementById("newStudySession").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","addToGroup.php?group_name="+group+"&username="+user,true);
xmlhttp.send();
}

function newStudyGroup()
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
xmlhttp.open("GET","newStudyGroup.php",true);
xmlhttp.send();
}


function editUserSettings()
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
xmlhttp.open("GET","userSettings.php",true);
xmlhttp.send();
}

function changeSettings()
{
	var newSessionPopUp = document.getElementById('newStudySession');
	newSessionPopUp.style.display = 'none';
	var newSessionPopUp = document.getElementById('blur');
	newSessionPopUp.style.display = 'none';
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
        //var newName = document.getElementyById("changedName").value;
    	changeName(xmlhttp.responseText);
        //document.getElementById("buddyList").innerHTML=xmlhttp.responseText;
        }
    }

    var value = document.getElementById('usersMajorChanged').value;
	var name = document.getElementById('changedName').checked;
    xmlhttp.open("GET","changeMajor.php?major="+value+"&name="+name,true);
    xmlhttp.send();	
}

var showhide_status = false;

/**********************************************************************
* Changes the showhide_status to true or false
***********************************************************************/
function swap_show_hide()
{
    if (showhide_status) 
    {
      showhide_status = false;
    } 
    else 
    {
      showhide_status = true;
    }
    this.refresh_show_hide();
}


/**********************************************************************
* Minimizes or maximizes the left bar
***********************************************************************/
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
     uniondraw.style.top = '0px';
     uniondraw.style.width= '600px';
     document.getElementById('whiteboardApplication').style.width= '65%';
     if(document.getElementById("pfc_title").innerHTML != "OSU Chat"){
     	
     document.getElementById('docViewer').style.display = '';
      document.getElementById('psview').style.width = '450px';
      document.getElementById('psview').style.top = '0px';
      document.getElementById('udraw').style.width = '450px';
     document.getElementById('uniondraw').style.display = '';
     document.getElementById('switchDocDraw').style.display = 'none';
     }else{
     	document.getElementById('whiteboardApplication').style.width= '68%';
     	document.getElementById('newsfeed').style.width= '920px';
     }
    }
    else
    {
     left_bar.style.display = '';
     showhide2.style.display = 'none';
     if(uniondraw){
     	uniondraw.style.top = '-2px';
     	uniondraw.style.width= '600px';
     }
     if(document.getElementById('psview')){	
     	document.getElementById('psview').style.top = '-2px';
      	document.getElementById('psview').style.width = '600px';
     }
     if(document.getElementById('udraw')){
      	document.getElementById('udraw').style.width = '600px';
     }
     document.getElementById('whiteboardApplication').style.width= '40%';
     document.getElementById('newsfeed').style.width= '600px';
     if(document.getElementById("pfc_title").innerHTML != "OSU Chat"){
     	document.getElementById('switchDocDraw').style.display = '';
     	showWhiteboard();
     }
    }
}

/**********************************************************************
* Min/Max Chat
***********************************************************************/


/**********************************************************************
* Starts a new group with every user from the buddiesClickedOn array
***********************************************************************/
function beginGroup()
{
	var sessionName = document.getElementById('sessionName');
	if(sessionName.value != "")
    {
		pfc.sendRequest("/join "+sessionName.value);
		addSelfToGroup(sessionName.value);
		for(var i=0;i<buddiesClickedOn.length;i++)
        {
			addToGroup(buddiesClickedOn[i], sessionName.value);
			pfc.sendRequest("/invite "+buddiesClickedOn[i] + " \"" + sessionName.value + "\"");
		}
		var newSessionPopUp = document.getElementById('newStudySession');
		newSessionPopUp.style.display = 'none';
		var newSessionPopUp = document.getElementById('blur');
		newSessionPopUp.style.display = 'none';
		buddiesClickedOn = new Array();
	}
    else
    {
		alert("Please enter a name for the session");
	}
}


/**********************************************************************
* Starts a new session with every user from the buddiesClickedOn array
***********************************************************************/
function beginSession()
{
	var sessionName = document.getElementById('sessionName');
	if(sessionName.value != "")
    {
		pfc.sendRequest("/join "+sessionName.value);
		for(var i=0;i<buddiesClickedOn.length;i++)
        {
			pfc.sendRequest("/invite "+buddiesClickedOn[i] + " \"" + sessionName.value + "\"");
		}
		var newSessionPopUp = document.getElementById('newStudySession');
		newSessionPopUp.style.display = 'none';
		var newSessionPopUp = document.getElementById('blur');
		newSessionPopUp.style.display = 'none';
		buddiesClickedOn = new Array();
	}
    else
    {
		alert("Please enter a name for the session");
	}
}	

/**********************************************************************
* Adds to the buddiesClickedOn array
***********************************************************************/
function clickedOn(buddyClickedOn)
{
	var i;
	for (i=0; i<buddiesClickedOn.length; i++){
		if(buddyClickedOn == buddiesClickedOn[i]){
			return;
		}
	}
	document.getElementById("addToUserTable").innerHTML += "<tr><td style='background-color:green'><a title='Remove User' href='#' style='color:red;cursor:pointer;text-decoration:none' onClick=\"removeUserFromTable('" + buddyClickedOn +"');\"><img src='images/delete.gif' /></a>"+buddyClickedOn+"</td></tr>";
	buddiesClickedOn.push(buddyClickedOn);	
	if((buddiesClickedOn.length % 3) == 0){
        	document.getElementById("addToUserTable").innerHTML += "<BR>";
	}
}

/**********************************************************************
* Returns a dropdown listing the current users classes
***********************************************************************/ 
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


/**********************************************************************
* Displays the major search bar
***********************************************************************/
function displayMajorSearchBar(){
	document.getElementById("classList").style.display="none";
    document.getElementById("anyoneSearch").style.display="none";
	document.getElementById("majorSearch").style.display="";
}

/**********************************************************************
* Returns a dropdown listing the majors that match the input string
***********************************************************************/
function searchMajors()
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
        document.getElementById("majorSearchResults").innerHTML=xmlhttp.responseText;
        }
    }

    var value = document.getElementById('majorSearchValue').value;
    document.getElementById('usersInMajor').style.display = 'none';
    document.getElementById('majorSearchResults').style.display = '';
    if(value == ''){
        document.getElementById('majorSearchResults').style.display = 'none';
    }

    xmlhttp.open("GET","searchMajors.php?search="+value,true);
    xmlhttp.send();	
}


/**********************************************************************
* Removes the NewSession window from the screen, removes the blurred 
* background, and clears the buddiesClickedOn array
***********************************************************************/
function closeNewSession()
{
	var newSessionPopUp = document.getElementById('newStudySession');
	newSessionPopUp.style.display = 'none';
	var newSessionPopUp = document.getElementById('blur');
	newSessionPopUp.style.display = 'none';
    buddiesClickedOn = new Array();
}

/**********************************************************************
* Returns a dropdown listing the classes that match the input string
***********************************************************************/
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
    
    //when xmlhttp's readystate changes, call this function
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("classSearchResults").innerHTML=xmlhttp.responseText;
        }
    }
    
    var searchInput = document.getElementById('classSearch').value;
  
    if(searchInput == ''){
        document.getElementById('classSearchResults').style.display = 'none';
    }
    else
    {
        document.getElementById('classSearchResults').style.display = '';
    }

    xmlhttp.open("GET","classSearch.php?search="+searchInput,true);
    xmlhttp.send();
}


/**********************************************************************
* Returns a dropdown listing the users that match the input string
***********************************************************************/
function searchUsers()
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
            document.getElementById("buddySearchResults").innerHTML=xmlhttp.responseText;
        }
    }

    var searchInput = document.getElementById('buddySearch').value;
    
    if(searchInput == ''){
        document.getElementById('buddySearchResults').style.display = 'none';
    }
    else
    {
        document.getElementById('buddySearchResults').style.display = '';
    }
    
    xmlhttp.open("GET","buddySearch.php?search="+searchInput,true);
    xmlhttp.send();
    
}

/**********************************************************************
* Opens the study room of the name that is passed in
***********************************************************************/
function enterRoom(name)
{
    document.getElementById('classSearchResults').style.display = 'none';
    document.getElementById('classSearch').value = '';
    setClassSearchBoxValue(); //reset the search box to say "Search Classes"
    name = name.split(' - '); 
    pfc.sendRequest('/join ' + name[0]); //name the room {DEP} {Class#} Sec. {Section#}
}


/**********************************************************************
* Adds the given user to the current logged in user's buddy list
***********************************************************************/
function addUser(name)
{
    document.getElementById('buddySearchResults').style.display = 'none';
    document.getElementById('buddySearch').value = '';
    setBuddySearchBoxValue();
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
            getBuddyList('');
        }
    }

    xmlhttp.open("GET","addToBuddyList.php?name="+username[0],true);
    xmlhttp.send();
}


/**********************************************************************
* Deletes the givin user from the current logged in user's buddy list
***********************************************************************/
function removeBuddy(username)
{
	var accept = confirm("Are you sure you want to remove "+username+" from your buddy list?");
	if(!accept){
		return;
	}
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

        }
    }

    xmlhttp.open("GET","removeBuddy.php?username="+username,true);
    xmlhttp.send();
}

/**********************************************************************
* Deletes the given group from the current logged in user's groups
***********************************************************************/
function removeGroup(group)
{
	var accept = confirm("Are you sure you want to remove this group?");
	if(!accept){
		return;
	}
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
   
        }
    }

    xmlhttp.open("GET","removeUserFromGroup.php?group_name="+group,true);
    xmlhttp.send();
}

/**********************************************************************
* Deletes the given group from the current logged in user's classes
***********************************************************************/
function removeClass(group)
{   
	var accept = confirm("Are you sure you want to remove this class?");
	if(!accept){
		return;
	}
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
   
        }
    }

    xmlhttp.open("GET","removeUserFromClass.php?class_name="+group,true);
    xmlhttp.send();
}

/**********************************************************************
* Updates the class search box to either display "Search Classes" or 
* nothing
***********************************************************************/
function setClassSearchBoxValue()
{
    var searchBox = document.getElementById("classSearch");
    
    if(searchBox.value == 'Search Classes')
    {
        searchBox.value = '';
        searchBox.style.color = 'black';
    }else if(searchBox.value == '')
    {
        searchBox.value = "Search Classes";
        searchBox.style.color = 'grey';
    }
}

/**********************************************************************
* Updates the buddy search box to either display "Search Users" or 
* nothing
***********************************************************************/
function setBuddySearchBoxValue()
{
    var searchBox = document.getElementById("buddySearch");
    
    if(searchBox.value == 'Search Users')
    {
        searchBox.value = '';
        searchBox.style.color = 'black';
    }
    else if(searchBox.value == '')
    {
        searchBox.value = "Search Users";
        searchBox.style.color = 'grey';
    }
}
