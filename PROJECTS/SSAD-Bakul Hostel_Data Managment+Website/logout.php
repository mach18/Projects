<?php
/*
 * Logs Out the persons session
 * As well as logs him out of the CAS system
 */
include_once("CAS.php");
include_once("../headers/functions.php");
session_destroy();
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"/cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::logout();
redirect_func("index.php");
?>

