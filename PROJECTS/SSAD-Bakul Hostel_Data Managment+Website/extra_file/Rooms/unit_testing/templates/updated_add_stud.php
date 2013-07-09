<?php
	 
?>
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
                        session_start();
                        $con=mysql_connect();

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

			//echo "SESSION room_no=".$_SESSION["room_no"];
			$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
			$row = mysql_fetch_array($result);

			$error_result = mysql_query("select * from student_room where student1=".$_POST["stud"]." or student2=".$_POST["stud"]." or student3=".$_POST["stud"]);
			$error_row = mysql_fetch_array($error_result);
                        ////////////////////////


		?>
	</head>
	<body id="dt_example">
		<div id="container">
<?php
			if($error_row["room_no"] == NULL)
			{
?>
			<div class="full_width big">
				<?php echo $row['occupancy_status']?> student/s were staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Room Number</th>
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
        <?php
            if($row)
            {
            ?>
           <!-- ///////////////-->

		<tr class="gradeA">
			<td><?php echo $row['room_no']?></td>
			<td><?php echo $row['floor']?></td>
			<td><?php echo $row['capacity']?></td>
			<td class="center"><?php echo $row['occupancy_status']?></td>
			<td class="center"><?php echo $row['student1']?></td>
                        <td class="center"><?php echo $row['student2']?></td>
                        <td class="center"><?php echo $row['student3']?></td>
		</tr>
                <?php
            }
            ?>
		
	</tbody>
</table>

<?php
	if($row['student1'] == NULL)
	{
	$update_result = mysql_query("update student_room set student1=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
else if($row['student2'] == NULL)
{
	$update_result = mysql_query("update student_room set student2=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
else if($row['student3'] == NULL)
{
	$update_result = mysql_query("update student_room set student3=\"".$_POST["stud"]."\", occupancy_status=occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}

$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);
?>
			<div class="full_width big">
				<br /><br />After updating,<br /><?php echo $row['occupancy_status']?> student/s are staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>

			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Room Number</th>
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
        <?php
            if($row)
            {
            ?>
           <!-- ///////////////-->

		<tr class="gradeA">
			<td><?php echo $row['room_no']?></td>
			<td><?php echo $row['floor']?></td>
			<td><?php echo $row['capacity']?></td>
			<td class="center"><?php echo $row['occupancy_status']?></td>
			<td class="center"><?php echo $row['student1']?></td>
                        <td class="center"><?php echo $row['student2']?></td>
                        <td class="center"><?php echo $row['student3']?></td>
		</tr>
                <?php
            }
            ?>
		
	</tbody>
</table>

			<div class="full_width big">
				<br /><br />Redirecting in a second ...
			</div>
<?php
	    echo "<meta http-equiv=\"refresh\" content=\"3; url=updated_rooms_allot.php?room_no=".$row["room_no"]."&submit=View\">";
//	    echo "<br/><a href=\"updated_rooms_allot.php?room_no=".$row["room_no"]."&submit=View\"><button>Go Back</button></a>";
?>
			</div>
			<div class="spacer"></div>
<?php
			}
			else
			{
?>
			<div class="full_width big">
				<br /><br />ERROR -<br />The roll number you entered already exists in the database:<br/><br/>
			</div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Room Number</th>
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
			<td><?php echo $error_row['room_no']?></td>
			<td><?php echo $error_row['floor']?></td>
			<td><?php echo $error_row['capacity']?></td>
			<td class="center"><?php echo $error_row['occupancy_status']?></td>
			<td class="center"><?php echo $error_row['student1']?></td>
                        <td class="center"><?php echo $error_row['student2']?></td>
                        <td class="center"><?php echo $error_row['student3']?></td>
		</tr>
		
	</tbody>
</table>
<?php
				echo "<br/><a href=\"updated_rooms_allot.php?room_no=".$row["room_no"]."&submit=View\"><button>Go Back</button></a>";
			}
?>
		</div>

	</body>
</html>
