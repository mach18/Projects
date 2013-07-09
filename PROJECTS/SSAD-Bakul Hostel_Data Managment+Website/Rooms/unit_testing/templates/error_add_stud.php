<?php
	 
?>
<html>
	<head>
		
		<title>DataTables unit testing</title>
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
                        $con=mysql_connect("localhost","parin","parin");

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("bakul",$con);

			//echo "SESSION room_no=".$_SESSION["room_no"];
			$result = mysql_query("select * from student_room where room_no=".$_SESSION["room_no"]);
			$row = mysql_fetch_array($result);

                        ////////////////////////


		?>
	</head>
	<body id="dt_example">
		<div id="container">
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
	<!--<tfoot>
		<tr>
			<th>Room Number</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>

		</tr>
	</tfoot>-->
</table>

<?php
	if($row['student1'] == NULL)
	{
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
	<!--<tfoot>
		<tr>
			<th>Room Number</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>

		</tr>
	</tfoot>-->
</table>

<?php
	    echo "<br/><a href=\"updated_rooms_allot.php?room_no=".$row["room_no"]."&submit=View\"><button>Go Back</button></a>";
?>
			</div>
			<div class="spacer"></div>
		</div>

	</body>
</html>
