
<form action="delete.php" method="POST">
<input type="text" name="uid">
<input type="submit">
</form>
<?
session_start();
require_once('../dbconnect.php');
if(isset($_POST['uid']) and !empty($_POST['uid']))
{
if($_SESSION['tablename']=="branch1")
{
mysql_query('delete from branch1 where uid='.$_POST['uid']);
mysql_query('delete from branch2 where uid='.$_POST['uid']);
}
else
{
mysql_query('delete from '.$_SESSION['tablename'].' where uid='.$_POST['uid']);
}
header('location:main_page.php');
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
<!--div id="content">
<div id="leftPan">
<div id="signup-form"-->
<!--/div>
</div>
</div-->

