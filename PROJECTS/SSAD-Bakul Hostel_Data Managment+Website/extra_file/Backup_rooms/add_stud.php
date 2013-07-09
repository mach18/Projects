<?php
//include('../menu.php');
/*include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
//phpCAS::setNoCasServerValidation();
//phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
*/
include('menu.php');
echo "<br /><br />";
session_start();
//echo "<br/>Received Request<br/>Session room_no - ".$_SESSION["room_no"]."<br/>Stud name = ".$_GET["stud"]."<br/>Guar name = ".$_GET["guar"]."<br/>";
$connect = mysql_connect();
if(!$connect)
	die("Could not connect to the database ".mysql_error());

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

if($row['student1'] == NULL)
{
	//echo "<br/>Entered if 1<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set student1=\"".$_POST["stud"]."\", guar1=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"])."\";";
	//echo "update Rooms set student1= ,guar1= where room_no= ;";
	
	$update_result = mysql_query("update student_room set student1=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set occupancy_status = occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
else if($row['student2'] == NULL)
{
	//echo "<br/>Entered if 2<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set stud2=\"".$_POST["stud"]."\", guar2=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"])."\";";
	//echo "update Rooms set stud2= ,guar2= where room_no= ;";
	
	$update_result = mysql_query("update student_room set student2=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set occupancy_status = occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
else if($row['student3'] == NULL)
{
	//echo "<br/>Entered if 3<br/>stud = ".$_POST["stud"]."<br/>guar = ".$_POST["guar"]."<br/>";
	//echo "update Rooms set stud3=\"".$_POST["stud"]."\", guar3=\"".$_POST["guar"]."\" where room_no=\"".$row["room_no"]."\";";
	
	$update_result = mysql_query("update student_room set student3=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
	//$count_result = mysql_query("update Rooms set occupancy_status = occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
//else
//{
//	echo "student1 = ".$row['student1']."<br/>";
//	echo "stud2 = ".$row['stud2']."<br/>";
//	echo "stud3 = ".$row['stud3']."<br/>";
//}

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
