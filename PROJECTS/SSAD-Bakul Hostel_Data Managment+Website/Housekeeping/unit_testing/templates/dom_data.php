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

                        /////////////////////////////////
                        include('menu.php');
                        echo "<br /><br />";
                        //session_start();
                        $con=mysql_connect();

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

                        $result = mysql_query("select * from staff");
                        //////////////////////////////////////////
		?>
	</head>
	<body id="dt_example">
		<div id="container">
			<div class="full_width big">
				House Keeping Details
			</div>
			
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Birth-Date</th>
			<th>Gender</th>
			<th>Responsibility</th>
			<th>JOB</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Edit Details</th>

		</tr>
	</thead>
        <tbody>
            <?php
        while($row = mysql_fetch_array($result))
            {
             ?>

		<tr class="gradeA">
			<td class="center"><?php  echo $row['id'] ?></td>
			<td class="center"><?php  echo $row['name'] ?></td>
			<td class="center"><?php  echo $row['bdate'] ?></td>
			<td class="center"><?php  echo $row['sex'] ?></td>
			<td class="center"><?php  echo $row['responsibility'] ?></td>
                        <td class="center"><?php  echo $row['job'] ?></td>
                        <td class="center"><?php  echo $row['address'] ?></td>
                        <td class="center"><?php  echo $row['contact_no'] ?></td>
                        <td><a href="edit.php?idd=<?php echo $row['id'] ?>">Edit Details</a></td>
                </tr>

                <?php
            }
            ?>

	</tbody>
        <tfoot>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Birth-Date</th>
                        <th>Gender</th>
			<th>Responsibility</th>
			<th>JOB</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Edit Details</th>
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
		</div>
	</body>
</html>
