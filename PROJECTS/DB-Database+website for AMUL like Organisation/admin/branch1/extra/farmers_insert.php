<?php
include('../../dbconnect.php');
if(isset($_POST['submitted']))
{
if ($_POST['submitted']==1) 
{  
if(isset($_POST['uid']) and isset($_POST['manager']) and isset($_POST['revenue']) and isset($_POST['address']))
{
$sql="INSERT INTO branch1 VALUES('$_POST[uid]', '$_POST[manager]', '$_POST[revenue]','$_POST[address]')";
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
if(isset($_POST['uid']) and isset($_POST['manager']) and isset($_POST['revenue']) and isset($_POST['address']))
{
mysql_query("delete from farmers where uid=".$_POST['uid']);
$sql="INSERT INTO farmers VALUES('$_POST[uid]', '$_POST[manager]' , '$_POST[revenue]','$_POST[address]')";
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
