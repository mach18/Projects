<?php
include("CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"/cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();

$email = phpCAS::getUser();
//$email="ayush.datta@students.iiit.ac.in";
if (empty($email))
{
        echo "wrongpasswd";
	phpCAS::logout();
        die("Some blank login!?");
}
else
{
}
?>
<?php
session_start();
?>
<frameset cols="15%,70%,15%">
<frame src="frame1.php" name="frame1" frameborder="0" scrolling="no" noresize="noresize">
<frame src="frame2.php" name="frame2" frameborder="0" scrolling="no" noresize="noresize">
<frame src="frame3.php" name="frame3" frameborder="0" scrolling="no" noresize="noresize">
</frameset>
<?php
$con=mysql_connect();
mysql_select_db("test", $con);
$a=mysql_fetch_array(mysql_query("select * from hit"));
//echo $a['hit'];
mysql_query("update hit set hit=hit+1");
?>

