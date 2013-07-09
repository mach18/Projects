<?php
/*
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
*/
include('menu.php');

$con=mysql_connect();
mysql_select_db("test", $con);
$user_name=phpCAS::getUser();
//echo $user_name;
function isValidEmail($email)
{
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}
$start_date=$_POST['start_date'];

$finish_date=$_POST['finish_date'];
$description=$_POST['description'];
//echo isset($fname).!empty($fname).isset($lname).!empty($lname).isset($street).!empty($street).isset($zip).isset($state).!empty($state).isset($country).!empty($country).isset($email_address).!empty($email_address).isset($contact_cell).!empty($contact_cell);
//echo "here<br />";
if
(
isset($start_date) and
isset($finish_date) and
isset($description) 
)
{
echo "if";
echo "started updating data <br />";
mysql_query("INSERT INTO newsfeed VALUES ('$description','$start_date','$finish_date')");
//mysql_query("INSERT INTO students VALUES (201101111,'majh','n','NULL','jl','dd','f','fbaddress','325325','nkll','3525')");
echo " your data is updated/inserted ";
//header('location: ../frame2.php');
}
else
{
	Echo "<html>";
	Echo "<body>";
	echo "<link rel='stylesheet' type='text/css' href='menu.css'>"
	echo "Fill all the values and a valid email address<br />";
	$url="index.php";
	echo "<a href=$url>Go back to form</a><br />";
	$url="index.php";	
	echo "<a href=$url>Go back to home page</a><br />";
	echo "</body>";
	echo "</html>";

}

?>
