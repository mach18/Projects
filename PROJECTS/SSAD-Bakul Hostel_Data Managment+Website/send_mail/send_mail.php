<?php

include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();

$con=mysql_connect();
mysql_select_db("test", $con);
$user=phpCAS::getUser();
if(
isset($_POST['subject']) and isset($_POST['body']) and
!empty($_POST['subject']) and !empty($_POST['body'])
)
{
mail('ayush.lodha@students.iiit.ac.in',$_POST['subject'],$_POST['body'],'from : '.$user);
header('location: ../index.php');
}
?>
