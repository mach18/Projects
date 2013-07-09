<?php
session_start();
if(isset($_POST['d']) and isset($_POST['table']))
{
	$x=$_POST['d'];
	$y=$_POST['table'];
	echo $x;
	$y=$y.'/'.$y;
	echo $y;
	echo $_SESSION['tablename']=$_POST['table'];

	echo $_SESSION['tablename']=$_POST['table'];
	if($_POST['d']=="retrieve")
	{
		header('location:view.php');
	}
	if($_POST['d']=="insert")
	{
		header('location:'.$y.'_insert.html');
	}
	if($_POST['d']=="update")
	{
		header('location:'.$y.'_update.php');
	}
	if($_POST['d']=="delete")
	{
		header('location:delete.php');
	}
}
?>
