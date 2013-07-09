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
                        $con=mysql_connect("localhost","","");

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

			//echo "SESSION room_no=".$_SESSION["room_no"];
			$result = mysql_query("select * from booking where room_no=".$_SESSION["room_no"]);
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
<?php
	$sql="INSERT INTO booking
VALUES
('$_POST[room_no]','$_POST[guest_name]','$_POST[booked_from]','$_POST[booked_till]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<meta http-equiv=\"refresh\" content=\"0; url=guest_book?room_no=".$_SESSION["room_no"]."&submit=View\">";

?>
	</body>
</html>
