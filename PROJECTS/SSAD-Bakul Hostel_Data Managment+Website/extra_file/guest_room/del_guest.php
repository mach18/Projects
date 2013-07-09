<?php

include('menu.php');
echo "<br /><br />";
session_start();
//echo "<br/>Received Request<br/>Session room_no - ".$_SESSION["room_no"]."<br/>";
$connect = mysql_connect();
if(!$connect)
	die("Error in connecting the database ".mysql_error());

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

//echo "<br/>Stud1 = ".$_POST["student1"]."<br/>Stud2 = ".$_POST["student2"]."<br/>Stud3 = ".$_POST["student3"]."<br/>";

if($_POST["guest_name"] != NULL)
{
	//echo "<br/>stud1 is not null<br/>";
	$delete_result = mysql_query("update guestroom set guest_name=NULL ,booked_from=NULL,booked_till=NULL,contact_no=NULL,  current= 0 where room_no=\"".$_SESSION["room_no"]."\";");
}
/*if($_POST["stud2"] != NULL)
{
	//echo "<br/>stud2 is not null<br/>";
	$delete_result = mysql_query("update Rooms set stud2=NULL , guar2=NULL , current=current-1 where room_no=\"".$_SESSION["room_no"]."\";");
}
if($_POST["stud3"] != NULL)
{
	//echo "<br/>stud3 is not null<br/>";
	$delete_result = mysql_query("update Rooms set stud3=NULL , guar3=NULL , current=current-1 where room_no=\"".$_SESSION["room_no"]."\";");
}
*/
$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

/*if($row["guestname"] == NULL)
{
	$modify_result = mysql_query("update Rooms set stud1=stud2 , guar1=guar2 , stud2=stud3 , guar2=guar3 , stud3=NULL , guar3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["stud1"] != NULL && $row["stud2"] == NULL && $row["stud3"] != NULL)
{
	$modify_result = mysql_query("update Rooms set stud2=stud3 , guar2=guar3 , stud3=NULL , guar3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["stud1"] == NULL && $row["stud2"] == NULL && $row["stud3"] != NULL)
{
	$modify_result = mysql_query("update Rooms set stud1=stud3 , guar1=guar3 , stud3=NULL , guar3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["stud1"] == NULL && $row["stud2"] != NULL && $row["stud3"] != NULL)
{
	$modify_result = mysql_query("update Rooms set stud1=stud2 , guar1=guar2 , stud2=NULL , guar2=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
*/
//$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
//$row = mysql_fetch_array($result);

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
