<?php
include('menu.php');
echo "<br /><br />";

session_start();

//echo "<br/>Received Request<br/>Session room_no - ".$_SESSION["room_no"]."<br/>Stud name = ".$_POST["stud"]."<br/>Guar name = ".$_POST["guar"]."<br/>";
$connect = mysql_connect();
if(!$connect)
	die("Could not connect to the database ".mysql_error());

mysql_select_db("test",$connect);

$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

if($row)
{
	echo "<br/>".$row['current']." guests are currently staying in room no. ".$_POST["room_no"]." -<br/>";
	echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
		<tr>
		<th>guest no.</th>
		<th>guest name.</th>
		<th>Room no.</th>
		<th>Floor</th>
		<th>Capacity</th>
		<th>Current</th>
		<th>ac</th>
		<th>booked from</th>
		<th>booked till</th>
		<th>contact no</th>
		</tr>";

	echo "<tr>";
	echo "<td align='center'>".$row['guest_no']."</td>";
	echo "<td align='center'>".$row['guest_name']."</td>";
	echo "<td align='center'>".$row['room_no']."</td>";
	echo "<td align='center'>".$row['floor']."</td>";
	echo "<td align='center'>".$row['capacity']."</td>";
	echo "<td align='center'>".$row['current']."</td>";
	echo "<td align='center'>".$row['ac']."</td>";
	echo "<td align='center'>".$row['booked_from']."</td>";
	echo "<td align='center'>".$row['booked_till']."</td>";
	echo "<td align='center'>".$row['contact_no']."</td>";
	echo "</tr>";
	echo "</table><br/>";
}

if($row['guest_name'] == NULL)
{
	//echo "<br/>Entered if 1<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set stud1=\"".$_POST["stud"]."\", guar1=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"])."\";";
	//echo "update Rooms set stud1= ,guar1= where room_no= ;";
	$update_result = mysql_query("update guestroom set guest_name=\"".$_POST["guest_name"]."\", booked_from=\"".$_POST["booked_from"]."\",booked_till=\"".$_POST["booked_till"]."\",contact_no=\"".$_POST["contact_no"]."\", current=1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set current = current+1 where room_no=\"".$row['room_no']."\";");
}
/*else if($row['stud2'] == NULL)
{
	//echo "<br/>Entered if 2<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set stud2=\"".$_POST["stud"]."\", guar2=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"])."\";";
	//echo "update Rooms set stud2= ,guar2= where room_no= ;";
	
	$update_result = mysql_query("update Rooms set stud2=\"".$_POST["stud"]."\", guar2=\"".$_POST["guar"]."\" , current=current+1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set current = current+1 where room_no=\"".$row['room_no']."\";");
}
else if($row['stud3'] == NULL)
{
	//echo "<br/>Entered if 3<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set stud3=\"".$_POST["stud"]."\", guar3=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"]."\";";
	
	$update_result = mysql_query("update Rooms set stud3=\"".$_POST["stud"]."\", guar3=\"".$_POST["guar"]."\" , current=current+1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set current = current+1 where room_no=\"".$row['room_no']."\";");
}
//else
//{
//	echo "stud1 = ".$row['stud1']."<br/>";
//	echo "stud2 = ".$row['stud2']."<br/>";
//	echo "stud3 = ".$row['stud3']."<br/>";
//}
*/
$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

if($row)
{
	echo "<br/>".$row['current']." guests are currently staying in room no. ".$_POST["room_no"]." -<br/>";
	echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
		<tr>
		<th>guest no.</th>
		<th>guest name</th>
		<th>Room no.</th>
		<th>Floor</th>
		<th>Capacity</th>
		<th>Current</th>
		<th>ac</th>
		<th>booked from</th>
		<th>booked till</th>
		<th>contact no</th>
		</tr>";

	echo "<tr>";
	echo "<td align='center'>".$row['guest_no']."</td>";
	echo "<td align='center'>".$row['guest_name']."</td>";
	echo "<td align='center'>".$row['room_no']."</td>";
	echo "<td align='center'>".$row['floor']."</td>";
	echo "<td align='center'>".$row['capacity']."</td>";
	echo "<td align='center'>".$row['current']."</td>";
	echo "<td align='center'>".$row['ac']."</td>";
	echo "<td align='center'>".$row['booked_from']."</td>";
	echo "<td align='center'>".$row['booked_till']."</td>";
	echo "<td align='center'>".$row['contact_no']."</td>";
	echo "</tr>";
	echo "</table><br/>";
}

echo "<br/><a href=\"rooms_allot.php\"><button>Go Back</button></a>";
session_destroy();
?>
