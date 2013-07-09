<?php
       require_once("../../dbconnect.php"); //Include Database Connection Script
        session_start();

if(isset($_POST['uid']) and !empty($_POST['uid']))
{
$result = mysql_query("select * from farmers where uid=".$_POST['uid']);
$row = mysql_fetch_array($result);

if($row)
{
        echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>
                <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Sex</th>
                <th>Village</th>
                <th>Rate/lt</th>
                <th>Supply/lt</th>
                <th>Address</th>
                </tr>";

        echo "<tr>";
        echo "<td align='center'>".$row['uid']."</td>";
        echo "<td align='center'>".$row['name']."</td>";
        echo "<td align='center'>".$row['sex']."</td>";
        echo "<td align='center'>".$row['village']."</td>";
        echo "<td align='center'>".$row['rateperlt']."</td>";
        echo "<td align='center'>".$row['supplyperlt']."</td>";
        echo "<td align='center'>".$row['address']."</td>";
        echo "</tr>";
        echo "</table><br/>";
}
}
?>
Enter The UID of Farmer whose data you want to retrieve
<form action="farmer_view.php" method="POST">
<input type="text" name="uid">
<input type="submit">
</form>
