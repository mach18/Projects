<?
session_start();
$date=$_SESSION['date'];
$id=$_GET['id'];
include('dbconnect.php');
mysql_query("delete from events where id=$id");
header("location: date.php?date_var=$date");
?>
