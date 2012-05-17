<!-- This is a correct simple CAS client -->
<?php
// Load the settings from the central config file
require_once 'config.php';
// Load the CAS lib
require_once $phpcas_path . '/CAS.php';
$cas_host = 'login.oregonstate.edu';
$cas_port = 443;
$cas_context = '/cas-dev/';

// for this test, simply print that the authentication was successfull
?>