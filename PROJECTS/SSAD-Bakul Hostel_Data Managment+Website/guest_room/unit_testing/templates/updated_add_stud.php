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
<link rel="stylesheet" type="text/css" href="menu.css">
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
                        $con=mysql_connect("localhost","","");

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

			//echo "SESSION room_no=".$_SESSION["room_no"];
			$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
			$row = mysql_fetch_array($result);

			/*$error_result = mysql_query("select room_no from student_room where student1=".$_POST["stud"]." or student2=".$_POST["stud"]." or student3=".$_POST["stud"].";");
			$error_row = mysql_fetch_array("$error_result");
			if($error_row["room_no"] != NULL)
			{
				header("Location: error_add_stud.php?room_no=".$error_row["room_no"]);
				exit;
			}*/
                        ////////////////////////


		?>
	</head>
	<body id="dt_example">
		<div id="container">
			<div class="full_width big">
				<?php echo $row['current']?> guest/s were staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
<!--			<th>Room Number</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>
-->
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
		
		<td class="center"><?php echo $row['guest_no']?></td>
                        <td class="center"><?php echo $row['guest_name']?></td>
                        <td class="center"><?php echo $row['room_no']?></td>
                        <td class="center"><?php echo $row['floor']?></td>
                        <td class="center"><?php echo $row['capacity']?></td>
                        <td class="center"><?php echo $row['current']?></td>
                        <td class="center"><?php echo $row['ac']?></td>
                        <td class="center"><?php echo $row['booked_from']?></td>
                        <td class="center"><?php echo $row['booked_till']?></td>
                        <td class="center"><?php echo $row['contact_no']?></td>
	
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
	if($row['guest_name'] == NULL)
	{
	$update_result = mysql_query("update guestroom set guest_name=\"".$_POST["guest_name"]."\", booked_from=\"".$_POST["booked_from"]."\",booked_till=\"".$_POST["booked_till"]."\",contact_no=\"".$_POST["contact_no"]."\", current=\"".$_POST["current"]."\" where room_no=\"".$row['room_no']."\";");

	//$count_result = mysql_query("update Rooms set occupancy_status = occupancy_status+1 where room_no=\"".$row['room_no']."\";");
}
/*else if($row['student2'] == NULL)
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
}*/

$result = mysql_query("select * from guestroom where room_no=".$_SESSION["room_no"]);
$row = mysql_fetch_array($result);
?>
			<div class="full_width big">
				<br /><br />After updating,<br /><?php echo $row['current']?> guest/s are staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>

			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
<!--			<th>Room Number</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>-->
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
		<td class="center"><?php echo $row['guest_no']?></td>
                        <td class="center"><?php echo $row['guest_name']?></td>
                        <td class="center"><?php echo $row['room_no']?></td>
                        <td class="center"><?php echo $row['floor']?></td>
                        <td class="center"><?php echo $row['capacity']?></td>
                        <td class="center"><?php echo $row['current']?></td>
                        <td class="center"><?php echo $row['ac']?></td>
                        <td class="center"><?php echo $row['booked_from']?></td>
                        <td class="center"><?php echo $row['booked_till']?></td>
                        <td class="center"><?php echo $row['contact_no']?></td>
	
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
