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
	var x=document.forms["booked_from"]["booked_till"].value;
	if (x==null || x=="")
	{
		alert("Correct date format is yyyy-mm-dd");
		return false;
	}
}
</script>

<html>
	<head>
		
		<title>DataTables unit testing</title>
		<style type="text/css" title="currentStyle">
			@import "../../css/demo_page.css";
			@import "../../css/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
		<link rel="stylesheet" type="text/css" href="menu.css">
		<script type="text/javascript" language="javascript" src="../unit_test.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
        window.onload = function(){
                
                
                g_globalObject = new JsDatePick({
                        useMode:1,
                        isStripped:true,
                        target:"booked_from1"
                });             
                
                g_globalObject.setOnSelectedDelegate(function(){
                        var obj = g_globalObject.getSelectedDay();
                        alert("a date was just selected and the date is : " + obj.day + "-" + obj.month + "-" + obj.year);
                        document.getElementById("booked_from").innerHTML = obj.year + "-" + obj.month + "-" + obj.day;
                });
//                window.onload = function(){
                
                
                g_globalObject2 = new JsDatePick({
                        useMode:1,
                        isStripped:true,
                        target:"booked_till1"
                });             
                
                g_globalObject2.setOnSelectedDelegate(function(){
                        var obj = g_globalObject2.getSelectedDay();
                        alert("a date was just selected and the date is : " + obj.day + "-" + obj.month + "-" + obj.year);
                        document.getElementById("booked_till").innerHTML = obj.year + "-" + obj.month + "-" + obj.day;
                });
 
                
                
                
        };
</script>

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

			session_start();
			//echo "GET room_no = ".$_GET["room_no"];
                        $result = mysql_query("select * from booking where room_no=".$_GET["room_no"]." order by booked_till");
			$row = mysql_fetch_array($result);
			$booked_from=date('Y-m-d',time());
			$booked_till=date('Y-m-d',time());
                            
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
			<?php echo $row['current']?> guest/s are currently staying in room no. <?php echo $row['room_no']?> - <br/>
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
                <th>Room no</th>
                <th>Guest Name</th>
                <th>Booked from</th>
                <th>Booked till</th>
		</tr>
	</thead>
	<tbody>

           <!-- ////////////////////-->
           <!-- ///////////////-->

		<tr class="gradeA">
			<td class="center"><?php echo $row['room_no']?></td>
			<td class="center"><?php echo $row['name']?></td>
                        <td class="center"><?php echo $row['booked_from']?></td>
                        <td class="center"><?php echo $row['booked_till']?></td>
		</tr>
<?php
            
?>
		
	</tbody>
</table>
<?php
//	if($row['current'] == $row['current'] )
//	{
?>
<!--			<br/><h4>You cannot add more guests</h4>
--><?php
//	}
//	else
	if($row['current']==0)
	{
?>
		<form name="roll_enter" action="updated_add_stud.php" method="post" onsubmit="return Validate_Roll_no()" align="left">
		<br/><h4>Add Guests</h4>
		<tr><td>Guest Name - </td><td><input type="text" name="guest_name"></td></tr><br/>
		<tr><td>Current - </td><td><input type="text" name="current"></td></tr><br/>
		<tr><td>Booked from - </td><td><input type="text" name="booked_from"></td><td>(yyyy-mm-dd)</td></tr><br/>
	<!--	<tr><td>Booked from - </td><td><div id="booked_from"><input type="text" name="booked_from"></div></td><td>(yyyy-mm-dd)</td></tr><br/>
		 <div id="booked_from1" name="booked_from" style="margin:10px 0 30px 0; border:dashed 1px red; width:205px; height:230px;">

    </div>-->
  <!--  <div id="div3_example_result" name="booked_from" style="height:20px; line-height:20px; margin:10px 0 0 0; border:dashed 1px #666;"></div>
-->
		<tr><td>Booked till - </td><td><input type="text" name="booked_till"></td><td>(yyyy-mm-dd)</td></tr><br/>
<!-- <div id="booked_till1" name="booked_till" style="margin:10px 0 30px 0; border:dashed 1px red; width:205px; height:230px;">

    </div>-->
<!--		<tr><td>Booked from - </td><td><div id="div3_example_result"><input type="text" name="booked_from"></div></td></tr><br/>
    <div id="div4_example_result" name="booked_till" style="height:20px; line-height:20px; margin:10px 0 0 0; border:dashed 1px #666;"></div>
-->
		<tr><td>Contact no. - </td><td><input type="text" name="contact_no"></td></tr><br/>
		<input type="submit" name="submit" value="Add Guest"><br/>
		</form>
<?php
	}

	if($row['current'] == 0)
	{
?>
		<br/><h4>You cannot delete more students</h4>
<?php
	}
	else
	{
		if($row['current'] != 0)
		{
?>
			<form action="updated_del_stud.php" method="post">
			<br/><h4>Delete Students<h4/>
			<input type="checkbox" name="guest_name" value="1">Guest<br/>
			<input type="submit" name="submit" value="Delete" onclick="if(!this.form.student1.checked){alert('Please select a student');return false}"><br/>
			</form>
<?php
		}
		else if($row['current'] == 324235)
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
		else if($row['current'] == 63534)
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
