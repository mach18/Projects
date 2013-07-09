<link rel="stylesheet" type="text/css" href="style.css">
<br>
<a href="./time.php">BACK TO CALENDER</a>
<?
session_start();
include('dbconnect.php');

$day=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
$days=array('Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6,'Sun'=>7);
$_SESSION["year"];
$_SESSION['month'];
$_SESSION['day'];
$_SESSION['date']=$_GET['date_var'];
$_SESSION['today_day']=($days[$_SESSION['day']]+($_GET['date_var']-1)%7)%7;
foreach ($day as $i){ if($days[$i]==$_SESSION['today_day']){ $_SESSION['today_day']=$i; break;}}
$_SESSION['today_day'];
$date=$_SESSION['date'];
$year=$_SESSION['year'];
$month=$_SESSION['month'];
/*
if(isset($_POST['event']) && !empty($_POST['event']))
{
	$event=$_POST['event'];
	$time_var=time();
	mysql_query("insert into events values($date,'$month',$year,'$event',$time_var,NULL)");
	unset($_POST['event']);
}
*/

echo "<br><h2>";
echo $_SESSION['date'].','.$_SESSION['month'].','.$_SESSION['year'];
echo "</h2>";

?>
<table>
<tr>
<td>
<?
$array1=mysql_query("select id, event, time from events where date=$date and year=$year and month='$month'");

$var=mysql_num_fields($array1);
echo "<table cellspacing='0px' class='show_event'>";
if(mysql_num_rows($array1))
{
echo "<tr>";
echo "<th>Events</th><th></th>";
echo "</tr>";
}
while($row=mysql_fetch_array($array1))
{
echo "<tr class='event'>";
echo "<td >".$row['event']."<br><a class='time'>".date('M,d Y',$row['time'])."</a></td>";
?>
<td><a href="date_delete.php?id=<?echo $row['id']?>"><img src="stone.png" height="7px" width="7px" ></a></td>
<?
echo "</tr>";
}
echo "</table><br/>";


?>

<form method="POST" action="./insert_event.php">
<input type="text" name="event" value="" class="input">
</form>
</td>
<td>
<?
$array1=mysql_query("select id, event, time from events where date=$date and year=1 and month='$month'");

$var=mysql_num_fields($array1);
echo "<table cellspacing='0px' class='show_event'>";
if(mysql_num_rows($array1))
{
echo "<tr>";
echo "<th>Events</th><th></th>";
echo "</tr>";
}
while($row=mysql_fetch_array($array1))
{
echo "<tr class='event'>";
echo "<td>".$row['event']."<br><a class='time'>".date('M,d Y',$row['time'])."</a></td>";
?>
<td><a href="date_delete.php?id=<?echo $row['id']?>"><img src="stone.png" height="7px" width="7px" ></a></td>
<?
echo "</tr>";
}
echo "</table><br/>";


?>

<form method="POST" action="./insert_event.php?year=1">
<input type="text" name="event" value="" class="input">
</form>
</td>
</tr>
</table>

