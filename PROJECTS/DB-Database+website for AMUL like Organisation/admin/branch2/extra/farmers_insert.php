<?php
include('../../dbconnect.php');
if(isset($_POST['submitted']))
{
if ($_POST['submitted']==1) 
{  
if(isset($_POST['uid']) and isset($_POST['name']) and isset($_POST['sex']) and isset($_POST['village']) and isset($_POST['rateperlt']) and isset($_POST['supplyperlt']) and isset($_POST['address']))
{
$sql="INSERT INTO farmers VALUES('$_POST[uid]', '$_POST[name]' , '$_POST[sex]', '$_POST[village]', '$_POST[rateperlt]','$_POST[supplyperlt]','$_POST[address]')";
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
if(isset($_POST['uid']) and isset($_POST['name']) and isset($_POST['sex']) and isset($_POST['village']) and isset($_POST['rateperlt']) and isset($_POST['supplyperlt']) and isset($_POST['address']))
{
mysql_query("delete from farmers where uid=".$_POST['uid']);
$sql="INSERT INTO farmers VALUES('$_POST[uid]', '$_POST[name]' , '$_POST[sex]', '$_POST[village]', '$_POST[rateperlt]','$_POST[supplyperlt]','$_POST[address]')";
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
