<?php
include('../../dbconnect.php');
if(isset($_POST['submitted']))
{
if ($_POST['submitted']==1) 
{  
if(isset($_POST['uid']) and isset($_POST['item']))
{
$sql="INSERT INTO branch2 VALUES('$_POST[uid]','$_POST[item]')";
mysql_query($sql); 
header('location: ../main_page.php');
}
else
{
	echo "All values not set";
}
}
else
{
if ($_POST['submitted']==2)
{
if(isset($_POST['uid']) and isset($_POST['item']) )
{
mysql_query("delete from branch2 where uid=".$_POST['uid']);
$sql="INSERT INTO branch2 VALUES('$_POST[uid]', '$_POST[item]')";
mysql_query($sql);
header('location: ../main_page.php');
}
else
{
        echo "All values not set";
}
}

}
}
else
{
	header('location: ../main_page.php');
}
?> 
