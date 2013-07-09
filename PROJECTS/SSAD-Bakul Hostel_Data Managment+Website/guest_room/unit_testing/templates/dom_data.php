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
                        //session_start();
                        $con=mysql_connect("localhost","","");

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

                        $result = mysql_query("select * from guestroom order by floor, room_no");

                            
                        ////////////////////////


		?>
	</head>
	<body id="dt_example">
		<div id="container">
			<div class="full_width big">
				<form name="room_enter" action="updated_rooms_allot.php" onsubmit="return Validate_Room()" method="get">
				The full list of all the guest rooms and their occupants -
				<div style="float:right">Edit room details:</div><br/>
				<input type="submit" name="submit" value="View" style="float:right">
				<input type="text" name="room_no" style="float:right"><br/>
				</form>
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
<!--			<th>Room</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>-->
        <th>Room no.</th>
        <th>Guest Name</th>
        <th>Floor</th>
        <th>Capacity</th>
        <th>Current</th>
        <th>AC</th>
        <th>Booked from</th>
        <th>Booked till</th>
        <th>Contact</th>
	<th>Book</th>


		</tr>
	</thead>
	<tbody>

           <!-- ////////////////////-->
        <?php
            while($row = mysql_fetch_array($result))
            {
            ?>
           <!-- ///////////////-->

		<tr class="gradeA">
                        <td class="center"><?php echo $row['room_no']?></td>
                        <td class="center"><?php echo $row['guest_name']?></td>
                        <td class="center"><?php echo $row['floor']?></td>
                        <td class="center"><?php echo $row['capacity']?></td>
                        <td class="center"><?php echo $row['current']?></td>
                        <td class="center"><?php echo $row['ac']?></td>
                        <td class="center"><?php echo $row['booked_from']?></td>
                        <td class="center"><?php echo $row['booked_till']?></td>
                        <td class="center"><?php echo $row['contact_no']?></td>
                        <td class="center"><a href="guest_book.php?room_no=<?php echo $row['room_no']?>&submit=View"><button>View</button></a></td>
		</tr>
                <?php
            }
            ?>
		
	</tbody>
	<tfoot>
		<tr>
<!--			<th>Room</th>
			<th>Floor</th>
			<th>Capacity</th>
			<th>Status</th>
			<th>Student1</th>
                        <th>Student2</th>
                        <th>Student3</th>-->
        <th>Room no.</th>
        <th>Guest Name</th>
        <th>Floor</th>
        <th>Capacity</th>
        <th>Current</th>
        <th>AC</th>
        <th>Booked from</th>
        <th>Booked till</th>
        <th>Contact</th>
	<th>Book</th>

		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
		</div>

            


	</body>
</html>
