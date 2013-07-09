<?
session_start();
include('dbconnect.php');
$date=$_SESSION['date'];
$year=$_SESSION['year'];
$month=$_SESSION['month'];
if(isset($_POST['event']) && !empty($_POST['event']))
{
	$event1=$_POST['event'];
	$event=htmlspecialchars($event1);
	$time_var=time()+270*60;
	if($_GET['year']!=1)
		mysql_query("insert into events values($date,'$month',$year,'$event',$time_var,NULL)");
	else
		mysql_query("insert into events values($date,'$month',1,'$event',$time_var,NULL)");
}
header ("location: date.php?date_var=$date");
?>
