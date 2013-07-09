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

function Validate_Roll_no()
{
	var x=document.forms["roll_enter"]["stud"].value;
	if (x==null || x=="")
	{
		alert("Please enter a roll number");
		return false;
	}
}
</script>

<?php
/*
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
//phpCAS::setNoCasServerValidation();
//phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
*/
include('menu.php');
echo "<br /><br />";
session_start();
echo "Enter the room no. - ";
echo "<form name=\"room_enter\" action=\"rooms_allot.php\" onsubmit=\"return Validate_Room()\" method=\"get\">";
echo "<input type=\"text\" name=\"room_no\">";
echo "<input type=\"submit\" name=\"submit\" value=\"View\"><br/>";
echo "</form>";
echo "<br/><a href=\"index.php\"><button>View all</button></a>";

$connect = mysql_connect();
if(!$connect)
	die("Could not connect the database ".mysql_error());

mysql_select_db("test",$connect);

$result = mysql_query("select * from student_room where room_no=".$_GET["room_no"]);

$row=mysql_fetch_array($result);
if($row)
{
	echo "<br/>".$row['occupancy_status']." student/s are currently staying in room no. ".$_GET["room_no"]." -<br/>";
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

	echo "<tr>";
	echo "<td align='center'>".$row['room_no']."</td>";
	echo "<td align='center'>".$row['floor']."</td>";
	echo "<td align='center'>".$row['capacity']."</td>";
	echo "<td align='center'>".$row['occupancy_status']."</td>";
	echo "<td align='center'>".$row['student1']."</td>";
	echo "<td align='center'>".$row['student2']."</td>";
	echo "<td align='center'>".$row['student3']."</td>";
	echo "</tr>";
	echo "</table><br/>";


	$_SESSION["room_no"] = $row["room_no"];
	if($row['capacity'] == $row['occupancy_status'] )
	{
		echo "<br/>You cannot add more students<br/>";
	}
	else
	{
		echo "<form name=\"roll_enter\" action=\"add_stud.php\" method=\"post\" onsubmit=\"return Validate_Roll_no()\" align=\"left\">";
		echo "<br/><h4>Add students</h4>";
		echo "Student Roll no. - "."<input type=\"text\" name=\"stud\"><br/>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Add Student\"><br/>";
		echo "</form>";

	}

	if($row['occupancy_status'] == 0)
	{
		echo "<br/>You cannot delete more students<br/>";
	}
	else
	{
		if($row['occupancy_status'] == 1)
		{
			echo "<form action=\"del_stud.php\" method=\"post\">";
			echo "<br/><h4>Delete Students<h4/>";
			echo "<input type=\"checkbox\" name=\"student1\" value=\"1\">Student 1<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\" onclick=\"if(!this.form.student1.checked){alert('Please select a student');return false}\"><br/>";
			echo "</form>";
		}
		else if($row['occupancy_status'] == 2)
		{
			echo "<form action=\"del_stud.php\" method=\"post\">";
			echo "<br/><h4>Delete Students</h4>";
			echo "<input type=\"checkbox\" name=\"student1\" value=\"1\">Student 1<br/>";
			echo "<input type=\"checkbox\" name=\"student2\" value=\"2\">Student 2<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\" onclick=\"if(!this.form.student1.checked && !this.form.student2.checked){alert('Please select a student');return false}\"><br/>";
			echo "</form>";
		}
		else if($row['occupancy_status'] == 3)
		{
			echo "<form action=\"del_stud.php\" method=\"post\">";
			echo "<br/><h4>Delete Students</h4>";
			echo "<input type=\"checkbox\" name=\"student1\" value=\"1\">Student 1<br/>";
			echo "<input type=\"checkbox\" name=\"student2\" value=\"2\">Student 2<br/>";
			echo "<input type=\"checkbox\" name=\"student3\" value=\"3\">Student 3<br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"Delete\" onclick=\"if(!this.form.student1.checked && !this.form.student2.checked && !this.form.student3.checked){alert('Please select a student');return false}\"><br/>";
			echo "</form>";
		}
	}
}

?>
