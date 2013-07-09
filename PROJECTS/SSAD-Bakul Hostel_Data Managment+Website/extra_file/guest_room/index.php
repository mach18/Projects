<?php

include('menu.php');
echo "<br /><br />";
$connect = mysql_connect();

if(!$connect)
	die("Could not connect to the database ".mysql.error());

mysql_select_db("test",$connect);

$result = mysql_query("select * from guestroom order by floor, room_no");

echo "<b>The full list of all the rooms and currently staying guests - </b><br/><br/><br/>";
echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
	<tr>
	<th>Guest No.</th>
	<th>Guest Name</th>
	<th>Room no.</th>
	<th>Floor</th>
	<th>Capacity</th>
	<th>Current</th>
	<th>AC</th>
	<th>Booked from</th>
	<th>Booked till</th>
	<th>contact no</th>
	</tr>";

while($row = mysql_fetch_array($result))
{
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
}
echo "</table>";
echo "</br></br>";
echo "To Allot room to new guest click the button below";
echo "<br/></br><a href=\"rooms_allot.php\"><button>Allot Rooms</button></a>";
/*echo "<br/><form action=\"rooms_allot.php\" method=\"post\">";
echo "<input type=\"button\" name=\"edit\" value=\"Allot Rooms\">";
echo "</form>";*/
echo "</br></br></br>";
echo "<b>Rent of room according to occupancy_type and facility</b>";
echo "</br></br></br>";
echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
	<tr>
	<th>Capacity</th>
	<th>AC/Non-AC</th>
	<th>Rent</th>
	</tr>
	<tr>
	<th>2</th>
	<th>0</th>
	<th>500</th>
	</tr>
	<tr>
	<th>3</th>
	<th>0</th>
	<th>750</th>
	</tr>
	<tr>
	<th>2</th>
	<th>1</th>
	<th>1000</th>
	</tr>
	<tr>
	<th>3</th>
	<th>1</th>
	<th>1250</th>
	</tr>
	</th>";
?>
