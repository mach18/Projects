<?php

include('menu.php');
echo "<br /><br />";
session_start();
//echo "<br/>Received Request<br/>Session room_no - ".$_SESSION["room_no"]."<br/>";
$connect = mysql_connect();
if(!$connect)
	die("Error in connecting the database ".mysql_error());

mysql_select_db("test",$connect);
$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

if($row)
{
	echo "<br/>".$row['occupancy_status']." student/s were staying in room no. ".$_GET["room_no"]." -<br/>";
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
}

//echo "<br/>Stud1 = ".$_POST["student1"]."<br/>Stud2 = ".$_POST["student2"]."<br/>Stud3 = ".$_POST["student3"]."<br/>";

if($_POST["student1"] != NULL)
{
	//echo "<br/>student1 is not null<br/>";
	$delete_result = mysql_query("update student_room set student1=NULL , occupancy_status=occupancy_status-1 where room_no=\"".$_SESSION["room_no"]."\";");
}
if($_POST["student2"] != NULL)
{
	//echo "<br/>student2 is not null<br/>";
	$delete_result = mysql_query("update student_room set student2=NULL , occupancy_status=occupancy_status-1 where room_no=\"".$_SESSION["room_no"]."\";");
}
if($_POST["student3"] != NULL)
{
	//echo "<br/>student3 is not null<br/>";
	$delete_result = mysql_query("update student_room set student3=NULL , occupancy_status=occupancy_status-1 where room_no=\"".$_SESSION["room_no"]."\";");
}

$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

if($row["student1"] == NULL && $row["student2"] != NULL && $row["student3"] != NULL)
{
	$modify_result = mysql_query("update student_room set student1=student2 , student2=student3 , student3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["student1"] != NULL && $row["student2"] == NULL && $row["student3"] != NULL)
{
	$modify_result = mysql_query("update student_room set student2=student3 , student3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["student1"] == NULL && $row["student2"] == NULL && $row["student3"] != NULL)
{
	$modify_result = mysql_query("update student_room set student1=student3 , student3=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}
else if($row["student1"] == NULL && $row["student2"] != NULL && $row["student3"] == NULL)
{
	$modify_result = mysql_query("update student_room set student1=student2 , student2=NULL where room_no=\"".$_SESSION["room_no"]."\";");
}

$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);

if($row)
{
	echo "<h4>After Updating,</h4>".$row['occupancy_status']." student/s are currently staying in room no. ".$_GET["room_no"]." -<br/>";
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
}

echo "<br/><a href=\"rooms_allot.php?room_no=".$row["room_no"]."&submit=View\"><button>Go Back</button></a>";
?>
