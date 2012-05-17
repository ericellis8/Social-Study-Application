<!-- This is a correct simple CAS client -->
<?php

// Load the settings from the central config file
require_once 'config.php';
// Load the CAS lib
require_once $phpcas_path . '/CAS.php';
$cas_host = 'login.oregonstate.edu';
$cas_port = 443;
$cas_context = '/cas-dev/';

// Uncomment to enable debugging
phpCAS::setDebug();

// Initialize phpCAS
//phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
phpCAS::client(SAML_VERSION_1_1, $cas_host, $cas_port, $cas_context);

// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);
//::setCasServerCACert('/etc/certs/CAS_Cert_Chain.pem');

// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
phpCAS::setNoCasServerValidation();

// force CAS authentication
phpCAS::forceAuthentication();

//$t = phpCAS::getAttributes();
// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// logout if desired
//if (isset($_REQUEST['logout'])) {
//	phpCAS::logout();
//}


// for this test, simply print that the authentication was successfull
?>

<?php
mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());
session_start();

$attr_uid = '';
$attr_firstname = '';
$attr_lastname = '';
$space = ' ';

foreach (phpCAS::getAttributes() as $key => $value) {

        if(strcmp($key, 'uid') == 0){
			$attr_uid = $value;
		}
		else if(strcmp($key, 'firstname') == 0){
			$attr_firstname = $value;
		}
		else if(strcmp($key, 'lastname') == 0){
			$attr_lastname = $value;
		}
}


$attr_fullname = $attr_firstname.$space.$attr_lastname;
$user = phpCAS::getUser();
$query = "Select * from user where user_name = '$user'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if(mysql_num_rows($result) > 0){
	$_SESSION['username'] = $row['user_name'];
	$_SESSION['name'] = $row['full_name'];
	$_SESSION['loggedIn'] = 'true';
	$_SESSION['major'] = $row['major'];
}
else{
	$sql="
	INSERT INTO user (user_name, onid_user, full_name, show_name)
	Values ('$user', '$user', '$attr_fullname', '1')
	";
	
	if (!mysql_query($sql,$con))
	{
		die('Error: ' . mysql_error());
	}

	$_SESSION['username'] = $attr_uid;
	$_SESSION['name'] = $attr_fullname;
	$_SESSION['loggedIn'] = 'true';
}

?>

<html>
  <head>
    <title>phpCAS simple client</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <p>the users login is <b><?php echo phpCAS::getUser(); ?></b>.</p>
    <p>phpCAS version is <b><?php echo phpCAS::getVersion(); ?></b>.</p>
	<p>attr_uid <b><?php echo $attr_uid; ?></b>.</p>
	<p>attr_fullname <b><?php echo $attr_fullname; ?></b>.</p>
	<p>session username from session is <b><?php echo $_SESSION['username']; ?></b>.</p>
	<p>session name from session is <b><?php echo $_SESSION['name']; ?></b>.</p>
	<p>session loggedIn from session is <b><?php echo $_SESSION['loggedIn']; ?></b>.</p>
	<p>session major from session is <b><?php echo $_SESSION['major']; ?></b>.</p>
    <p><a href="http://24.21.109.238/svn/root/index.php">Logout</a></p>
  </body>
</html>

<?php
header("Location: index.php?");
exit;
?> 