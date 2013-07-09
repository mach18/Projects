<script>
function Validate_Room()
{
	var x=document.forms["room_enter"]["room_no"].value;
	if (x==null || x=="")
	{
		alert("Please enter a room number");
		return false;
	}
}
</script>

<?php
//$connect = mysql_connect("localhost","parin","parin");
include('menu.php');
echo "<br /><br />";
session_start();
$con=mysql_connect();

if(!$con)
	die("Could not connect to the database ".mysql_error());

mysql_select_db("test",$con);

$result = mysql_query("select * from student_room order by floor, room_no");

echo "The full list of all the rooms and their occupants - <br/><br/><br/>";
echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
	<tr>
	<th>Room no.</th>
	<th>Floor</th>
	<th>Capacity</th>
	<th>Status</th>
	<th>Student 1</th>
	<th>Student 2</th>
	<th>Student 3</th>
	</tr>";

while($row = mysql_fetch_array($result))
{
	echo "<tr>";
	echo "<td align='center'>".$row['room_no']."</td>";
	echo "<td align='center'>".$row['floor']."</td>";
	echo "<td align='center'>".$row['capacity']."</td>";
	echo "<td align='center'>".$row['occupancy_status']."</td>";
	echo "<td align='center'>".$row['student1']."</td>";
	echo "<td align='center'>".$row['student2']."</td>";
	echo "<td align='center'>".$row['student3']."</td>";
	echo "</tr>";
}
echo "</table>";

echo "<form name=\"room_enter\" action=\"rooms_allot.php\" onsubmit=\"return Validate_Room()\" method=\"get\">";
echo "<h4>Manually search a room no. -<br/></h4>";
echo "<input type=\"text\" name=\"room_no\">";
echo "<input type=\"submit\" name=\"submit\" value=\"View\">";
echo "</form>";

//echo "<br/><a href=\"rooms_allot.php\"><button>Allot Rooms</button></a>";
/*echo "<br/><form action=\"rooms_allot.php\" method=\"post\">";
echo "<input type=\"button\" name=\"edit\" value=\"Allot Rooms\">";
echo "</form>";*/


?>
