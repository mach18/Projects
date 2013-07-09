<?php
include("../../../../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../../../../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
$con=mysql_connect();
mysql_select_db("test", $con);
$var=mysql_query("select email_id from students where roll_no=".$_POST['roll_no']);
$var1=mysql_fetch_array($var);
$user_name=$var1['email_id'];
//$user_name=phpCAS::getUser();
/*function isValidEmail($email)
{
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}
*/
$name=$_POST['name'];

$roll_no=$_POST['roll_no'];
$sex=$_POST['sex'];
//$email_id=$user_name;
$bloodgroup=$_POST['bloodgroup'];

$allergy=$_POST['allergy'];
$address=$_POST['address'];
$contact_no=$_POST['contact_no'];

$guardian_name=$_POST['guardian_name'];
$guardian_contact_no=$_POST['guardian_contact_no'];
//echo isset($fname).!empty($fname).isset($lname).!empty($lname).isset($street).!empty($street).isset($zip).isset($state).!empty($state).isset($country).!empty($country).isset($email_address).!empty($email_address).isset($contact_cell).!empty($contact_cell);
//echo "here<br />";

if
(
isset($roll_no) and
isset($name) and !empty($name) and
isset($sex) and
//isset($email_id) and !empty($email_id) and isValidEmail($email_id) and
isset($bloodgroup) and
isset($allergy) and
isset($address) and
isset($contact_no) and
isset($guardian_name) and
isset($guardian_contact_no)
)
{
echo "started updating data <br />";
mysql_query("delete from students where roll_no=".$roll_no);
mysql_query("INSERT INTO students VALUES ('$roll_no','$name','$sex','NULL','$user_name','$bloodgroup','$allergy','$address','$contact_no','$guardian_name','$guardian_contact_no')");
//mysql_query("INSERT INTO students VALUES (201101111,'majh','n','NULL','jl','dd','f','fbaddress','325325','nkll','3525')");
echo " your data is updated/inserted ";
header('location: ../../../../frame2.php');
}
else
{
	Echo "<html>";
	Echo "<body>";
	echo "Fill all the values and a valid email address<br />";
	$url="index.php";
	echo "<a href=$url>Go back to form</a><br />";
	$url="../index.php";	
	echo "<a href=$url>Go back to home page</a><br />";
	echo "</body>";
	echo "</html>";

}
?>
