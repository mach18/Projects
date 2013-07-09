<?
include('dbconnect.php');
$var=$_GET['q'];
//echo $var;
$result=mysql_query("select event from events where event like '%$var%'");
while($row=mysql_fetch_array($result))
{
	echo $row['event']."<br>";
}
?>
