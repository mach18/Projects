<?php
if(!isset($_SESSION['uu']))
{
include('menu.php');
echo "<br /><br />";
session_start();
}
$type=$_REQUEST["type"];
$desc=$_REQUEST["desc"];
$place=$_REQUEST["place"];
//echo $type;
//echo $desc;
//echo $_SESSION['roll'];
//echo $place;
//echo $_SESSION['roll'];
$roll=$_SESSION['roll'];
$var=date('Y-m-d',time());
$var1=date('H:i:s',time());
$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);
$result = mysql_query("Insert into complaints (student_id,complaint_type,description,place,complaint_date,complaint_time,status) values('$roll','$type','$desc','$place','$var','$var1','False')");
mysql_close($con);
echo "Your complaint Has been Registered";
header("location: mainuser.php");
?>
