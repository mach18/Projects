<?php
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();

$con=mysql_connect();
mysql_select_db("test", $con);
$user_name=phpCAS::getUser();
function isValidEmail($email_address)
{
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email_address);
}

$fname=$_POST['first_name'];
$lname=$_POST['last_name'];

$street=$_POST['street'];
$zip=$_POST['zip'];
$state=$_POST['state'];
$country=$_POST['country'];

$website=$_POST['website'];
$email_address=$_POST['email'];
$contact_home=$_POST['contact_home'];
$contact_cell=$_POST['contact_cell'];

//echo isset($fname).!empty($fname).isset($lname).!empty($lname).isset($street).!empty($street).isset($zip).isset($state).!empty($state).isset($country).!empty($country).isset($email_address).!empty($email_address).isset($contact_cell).!empty($contact_cell);

if
(
isset($fname) and !empty($fname) and
isset($lname) and !empty($lname) and
isset($street) and !empty($street) and
isset($zip) and
isset($state) and !empty($state) and
isset($country) and !empty($country) and
isset($email_address) and !empty($email_address) and isValidEmail($email_address) and
isset($contact_cell) and !empty($contact_cell)
)
{
echo "started updating data <br />";
mysql_query("INSERT INTO Persons VALUES ('$fname','$lname','$user_name')");
mysql_query("INSERT INTO Address VALUES ('$street','$zip','$state','$country','$user_name')");
mysql_query("INSERT INTO Contact VALUES ('$website','$email_address','$contact_home','$contact_cell','$user_name')");
echo " your data is updated/inserted ";
}
else
{
	echo "fill all the values and correct email address";
}
?>
