
Enter The UID of Farmer whose data you want to retrieve
<form action="view.php" method="POST">
<input type="text" name="uid">
<input type="submit">
</form>
<?php
       require_once("../dbconnect.php"); //Include Database Connection Script
        session_start();

if(isset($_POST['uid']) and !empty($_POST['uid']))
{
$result = mysql_query("select * from ". $_SESSION['tablename'] ." where uid=".$_POST['uid']);
$row = mysql_fetch_array($result);

if($row)
{
	$var=mysql_num_fields($result);
	echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>";
        echo "<tr>";

	for ($i=0; $i<$var; $i++)
	{
		echo "<th>".mysql_field_name($result,$i)."</th>";
	}

	echo "</tr>";
	echo "<tr>";
$count=1;	
foreach($row as $i) 
{
$count++;
if($count%2==0)
  echo "<td>".$i."</td>";
}
echo "</tr>";
echo "</table><br/>";

}
else
{
	echo "Uid Doesn't exist<br />";
}
}
else
{
$result = mysql_query("select * from ". $_SESSION['tablename']);

        $var=mysql_num_fields($result);
        echo "<table border='1' cellspacing='0' cellpadding='5' style='float:center'>";
        echo "<tr>";

        for ($i=0; $i<$var; $i++)
        {
                echo "<th>".mysql_field_name($result,$i)."</th>";
        }

        echo "</tr>";
while($row = mysql_fetch_array($result))
{
        echo "<tr>";
$count=1;
foreach($row as $i)
{
$count++;
if($count%2==0)
  echo "<td>".$i."</td>";
}
echo "</tr>";

}
echo "</table><br/>";

}
?>
