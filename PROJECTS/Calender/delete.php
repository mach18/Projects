<?
$id=$_GET['id'];
include('dbconnect.php');
mysql_query("delete from events where id=$id");
header('location: time.php');
?>
