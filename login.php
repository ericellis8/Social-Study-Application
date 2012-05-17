<!-- This is a correct simple CAS client -->
<?php
session_start();
// Load the settings from the central config file
require_once 'config.php';
// Load the CAS lib
require_once $phpcas_path . '/CAS.php';
$cas_host = 'login.oregonstate.edu';
$cas_port = 443;
$cas_context = '/cas-dev/';
$start_session = false;

// Uncomment to enable debugging
phpCAS::setDebug();

// Initialize phpCAS
//phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
phpCAS::client(SAML_VERSION_1_1, $cas_host, $cas_port, $cas_context, $start_session);

// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);
//::setCasServerCACert('/etc/certs/CAS_Cert_Chain.pem');

// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
phpCAS::setNoCasServerValidation();

//phpcas::allowProxyChain(new CAS_ProxyChain_Any);
// force CAS authentication
phpCAS::forceAuthentication();

//$t = phpCAS::getAttributes();
// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// logout if desired
if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
}


// for this test, simply print that the authentication was successfull
?>

<?php
$con = mysql_connect("localhost","mia","soulskater") or die(mysql_error());
mysql_select_db("social_study_groups") or die(mysql_error());

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
	$_SESSION['major'] = '';
}
?>

<?php
header("Location: index.php?");
exit;
?> 