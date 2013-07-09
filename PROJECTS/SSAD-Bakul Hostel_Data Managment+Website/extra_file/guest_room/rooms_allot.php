<?php
//include('menu.php');
//echo "<br /><br />";

session_start();
echo "<b>Enter the room no. from the given list of rooms below - </b>";
echo "</br></br>";
echo "<form action=\"rooms_allot.php\" method=\"post\">";
echo "<input type=\"text\" name=\"room_no\">";
echo "<input type=\"submit\" name=\"submit\">";
echo "</form>";
/////////////////////


////////////////////
$connect = mysql_connect();
if(!$connect)
	die("Could not connect the database ".mysql_error());

mysql_select_db("test",$connect);

//echo "<br/>Room no. entered - ".$_POST["room_no"]."<br/>";
$result = mysql_query("select * from guestroom where room_no=".$_POST["room_no"]);

$row=mysql_fetch_array($result);
if($row)
{
	echo "<br/>".$row['current']." guests are currently staying in room no. ".$_POST["room_no"]." -<br/>";
	echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
		<tr>
		<th>guest no</th>
		<th>guest name</th>
		<th>Room no</th>
		<th>Floor</th>
		<th>Capacity</th>
		<th>Current</th>
		<th>AC</th>
		<th>Booked from</th>
		<th>Booked till</th>
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


	$_SESSION["room_no"] = $row["room_no"];
  //	if($row['current'] != NULL )
//	{
//		echo "<br/>You cannot add more guests to current room<br/>";
//	}
//	else
  	if($row['current'] == 0 )
	{
	//	echo '$_SESSION["room_no"]  = '.$_SESSION["room_no"]; 
		/*echo "<form action=\"add_stud.php\" method=\"post\" align=\"left\">";
		echo "<br/><h4>Add Guests</h4>";
		echo "Guest Name  - "."<input type=\"text\" name=\"guest_name\"><br/>";
		echo "Booked from - "."<input type=\"text\" name=\"booked_from\"><br/>";
		echo "Booked till - "."<input type=\"text\" name=\"booked_till\"><br/>";
		echo "Contact No. - "."<input type=\"text\" name=\"contact_no\"><br/>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Add Guest\">";
		echo "</form>";*/
		echo "<form action=\"add_guest.php\" method=\"post\" align=\"left\">";
		echo "<br/><h4>Add Guests</h4>";
		echo "<table>";
		echo "<tr>";
		echo "<td>Guest Name  - </td>"."<td><input type=\"text\" name=\"guest_name\"></td><br/>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Booked from - </td>"."<td><input type=\"text\" name=\"booked_from\"></td><br/>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Booked till - </td>"."<td><input type=\"text\" name=\"booked_till\"></td><br/>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Contact No. - </td>"."<td><input type=\"text\" name=\"contact_no\"></td><br/>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Add Guest\">";
		echo "</form>";
	}
//	if($row['current'] == 0)
//	{
//		echo "<br/>You cannot delete more guests<br/>";
//	}
	else
//	{
		if($row['current'] != 0)
		{
			echo "<form action=\"del_guest.php\" method=\"post\">";
			echo "<br/><h4>Delete Guests<h4/>";
			echo "<input type=\"checkbox\" name=\"guest_name\" value=\"1\">Guest<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\"><br/>";
			echo "</form>";
		}
//	}
	/*	else if($row['occupancy_status'] == 2)
		{
			echo "<form action=\"del_stud.php\" method=\"post\">";
			echo "<br/><h4>Delete Students</h4>";
			echo "<input type=\"checkbox\" name=\"stud1\" value=\"1\">Student 1<br/>";
			echo "<input type=\"checkbox\" name=\"stud2\" value=\"2\">Student 2<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\"><br/>";
			echo "</form>";
		}
		else if($row['occupancy_status'] == 3)
		{
			echo "<form action=\"del_stud.php\" method=\"post\">";
			echo "<br/><h4>Delete Students</h4>";
			echo "<input type=\"checkbox\" name=\"stud1\" value=\"1\">Student 1<br/>";
			echo "<input type=\"checkbox\" name=\"stud2\" value=\"2\">Student 2<br/>";
			echo "<input type=\"checkbox\" name=\"stud3\" value=\"3\">Student 3<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\"><br/>";
			echo "</form>";
		}
	}*/
}


$connect = mysql_connect();

if(!$connect)
        die("Could not connect to the database ".mysql.error());

mysql_select_db("test",$connect);

$result = mysql_query("select * from guestroom order by floor, room_no");

echo "<b>List of all rooms - </b><br/><br/><br/>";
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
?>
