<?php
	 
?>

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

<html>
	<head>
		
		<title>DataTables unit testing</title>
		<link rel="stylesheet" type="text/css" href="menu.css">
		<style type="text/css" title="currentStyle">
			@import "../../css/demo_page.css";
			@import "../../css/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="../unit_test.js"></script>
		<?php
			$aScripts = explode( ":", $_GET['scripts'] );
			for ( $i=0 ; $i<count($aScripts) ; $i++ )
			{
				echo '<script type="text/javascript" language="javascript" src="../'.$aScripts[$i].'?rand='.rand().'"></script>'."\n";
			}

                        /////////////////////////////////////////
                        include('menu.php');
                        echo "<br /><br />";
                        //session_start();
                        $con=mysql_connect();

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

			session_start();
			//echo "GET room_no = ".$_GET["room_no"];
                        $result = mysql_query("select * from student_room where room_no=".$_GET["room_no"]);
			$row = mysql_fetch_array($result);
                            
                        ////////////////////////


		?>
	</head>
	<body id="dt_example">
		<div id="container">

			<form name="room_enter" action="updated_rooms_allot.php" onsubmit="return Validate_Room()" method="get">
				<h4>Manually allot a room no. -<br/></h4>
				<input type="text" name="room_no">
				<input type="submit" name="submit" value="View">
			</form>
				<a href="../index.php"><button>View all rooms</button></a><br/><br/><br/>
<?php
            if($row)
	    {
		    $_SESSION["room_no"] = $row['room_no'];
?>
			<div class="full_width big">
			<?php echo $row['occupancy_status']?> student/s are currently staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Room</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>

		</tr>
	</thead>
	<tbody>

           <!-- ////////////////////-->
           <!-- ///////////////-->

		<tr class="gradeA">
			<td class="center"><?php echo $row['room_no']?></td>
			<td class="center"><?php echo $row['floor']?></td>
			<td class="center"><?php echo $row['capacity']?></td>
			<td class="center"><?php echo $row['occupancy_status']?></td>
			<td class="center"><?php echo $row['student1']?></td>
                        <td class="center"><?php echo $row['student2']?></td>
                        <td class="center"><?php echo $row['student3']?></td>
		</tr>
<?php
            
?>
		
	</tbody>
</table>
<?php
	if($row['capacity'] == $row['occupancy_status'] )
	{
?>
			<br/><h4>You cannot add more students</h4>
<?php
	}
	else
	{
?>
		<form name="roll_enter" action="updated_add_stud.php" method="post" onsubmit="return Validate_Roll_no()" align="left">
		<br/><h4>Add students</h4>
		Student Roll no. - <input type="text" name="stud"><br/>
		<input type="submit" name="submit" value="Add Student"><br/>
		</form>
<?php
	}

	if($row['occupancy_status'] == 0)
	{
?>
		<br/><h4>You cannot delete more students</h4>
<?php
	}
	else
	{
		if($row['occupancy_status'] == 1)
		{
?>
			<form action="updated_del_stud.php" method="post">
			<br/><h4>Delete Students<h4/>
			<input type="checkbox" name="student1" value="1">Student 1<br/>
			<input type="submit" name="submit" value="Delete" onclick="if(!this.form.student1.checked){alert('Please select a student');return false}"><br/>
			</form>
<?php
		}
		else if($row['occupancy_status'] == 2)
		{
?>
			<form action="updated_del_stud.php" method="post">
			<br/><h4>Delete Students</h4>
			<input type="checkbox" name="student1" value="1">Student 1<br/>
			<input type="checkbox" name="student2" value="2">Student 2<br/>
			<input type="submit" name="submit" value="Delete" onclick="if(!this.form.student1.checked && !this.form.student2.checked){alert('Please select a student');return false}"><br/>
			</form>
<?php
		}
		else if($row['occupancy_status'] == 3)
		{
?>
			<form action="updated_del_stud.php" method="post">
			<br/><h4>Delete Students</h4>
			<input type="checkbox" name="student1" value="1">Student 1<br/>
			<input type="checkbox" name="student2" value="2">Student 2<br/>
			<input type="checkbox" name="student3" value="3">Student 3<br/>
			<input type="submit" name="submit" value="Delete" onclick="if(!this.form.student1.checked && !this.form.student2.checked && !this.form.student3.checked){alert('Please select a student');return false}"><br/>
			</form>
<?php
		}
	}
	    }
?>
			</div>
			<div class="spacer"></div>
		</div>
	</body>
</html>
