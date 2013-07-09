<?
include('dbconnect.php');
$year=$_SESSION['year'];
$month=$_SESSION['month'];
$array1=mysql_query("select year, id, event, time, date from events where ((year=$year and month='$month') or (year=1 and month='$month')) order by date");
$var=mysql_num_fields($array1);
echo "<table cellspacing='0px' class='show_event'>";

if(mysql_num_rows($array1))
{echo "<tr>";
echo "<th>Event</th>";
echo "<th>Date</th><th></th>";
echo "</tr>";
}
while($row=mysql_fetch_array($array1))
{

$year_var="";
if($row['year']==1)
{
	$year_var="_year";
}

echo "<tr class='event$year_var'>";
echo "<td>".$row['event']."<br><a class='time'>".date('M,d Y',$row['time'])."</a></td>";
?>
<td class="date"><a href="date.php?date_var=<?echo $row['date']?>"><?echo $row['date']?></a></td>
<td class="image_td"><a href="delete.php?id=<?echo $row['id']?>"><img class="image" src="stone.png" height="7px" width="7px" ></a></td>
<?
echo "</tr>";
}
echo "</table>";
?>
