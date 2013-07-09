<?php

include('menu.php');
echo "<br /><br />";
session_start();

$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  $id=$_GET["idd"];
mysql_select_db("test", $con);
$var=date('Y-m-d',time());
$var1=date('H:i:s',time());
$result = mysql_query("Update complaints set status='True', date_resolved='$var',time_resolved='$var1'  where complain_id='$id'");
mysql_close($con);
//echo 'complaint closed';
//echo $_SESSION['uu'];

header("location: mainuser.php");

?>
