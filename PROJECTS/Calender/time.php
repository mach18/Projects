<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<?php 
session_start();
$main_time=0;

$months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$days=array('Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6,'Sun'=>7);
$leap_last_date=array('Jan'=>31,'Feb'=>29,'Mar'=>31,'Apr'=>30,'May'=>31,'Jun'=>30,'Jul'=>31,'Aug'=>31,'Sep'=>30,'Oct'=>31,'Nov'=>30,'Dec'=>31);

$non_leap_last_date=array('Jan'=>31,'Feb'=>28,'Mar'=>31,'Apr'=>30,'May'=>31,'Jun'=>30,'Jul'=>31,'Aug'=>31,'Sep'=>30,'Oct'=>31,'Nov'=>30,'Dec'=>31);

if((isset($_POST['form_month']) && !empty($_POST['form_month']))&& (isset($_POST['form_year']) && !empty($_POST['form_year'])))
{
$year_var=1970;
while($year_var!=$_POST['form_year'])
{
if($year_var%4==0)
	$main_time=$main_time+366*24*60*60;
else
	$main_time=$main_time+365*24*60*60;
$year_var++;
}
foreach ($months as $month_var)
{
	if($month_var!=$_POST['form_month'])
	{
		if($_POST['form_year']%4==0)
		{$main_time=$main_time+$leap_last_date[$month_var]*24*60*60;}
		else
		{$main_time=$main_time+$non_leap_last_date[$month_var]*24*60*60;}
	}
	else
	{	break;}
}
}
else
{
if(isset($_SESSION['time']))
$main_time=$_SESSION['time'];
else
$main_time=time();
}
if(isset($_POST['next']))
{	
	if($_SESSION['year']%4==0)
	{$main_time=$_SESSION['time']+$leap_last_date[$_SESSION['month']]*24*60*60;}
	else
	{$main_time=$_SESSION['time']+$non_leap_last_date[$_SESSION['month']]*24*60*60;}
}
if(isset($_POST['pre']))
{
	for($j=0;$j<12;$j++){if($months[$j]==$_SESSION['month']){break;}}
	if($j!=0){
	if($_SESSION['year']%4==0)
	{$main_time=$_SESSION['time']-$leap_last_date[$months[$j-1]]*24*60*60;}
	else
	{$main_time=$_SESSION['time']-$non_leap_last_date[$months[$j-1]]*24*60*60;}}
	else
	{
	if($_SESSION['year']%4==0)
	{$main_time=$_SESSION['time']-$leap_last_date[$months[11]]*24*60*60;}
	else
	{$main_time=$_SESSION['time']-$non_leap_last_date[$months[11]]*24*60*60;}}
}
$_SESSION['time']=$main_time+270*60;
$_SESSION['year']=date('Y',$_SESSION['time']);
$_SESSION['date']=date('d',$_SESSION['time']);
$_SESSION['today_day']=date('D',$_SESSION['time']);
$_SESSION['day']=date('D',$_SESSION['time']-(($_SESSION['date']-1)*24*60*60));
$_SESSION['month']=date('M',$_SESSION['time']);
if($_SESSION['year']%4==0){$_SESSION['last_date']=$leap_last_date[$_SESSION['month']];
}else{$_SESSION['last_date']=$non_leap_last_date[$_SESSION['month']];}
$var=$days[$_SESSION['day']];
$date=1;
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br>
<table cellspacing=30px class="main_table" id="txtHint">
<tr>
<td>
<h2>
<? echo $_SESSION['month'].','.$_SESSION['year'];?>
</h2>
<form action="./time.php" method="POST">
<select name="form_month" onchange="showUser(this.value)"> 
<? foreach ($months as $i)
{
if($i==$_SESSION['month'])
{
?>
<option name="<?echo $i?>" selected><? echo $i?> </option>
<?
}else
{
?>
<option name="<?echo $i?>"><? echo $i?> </option>
<?}}?>
</select>

<select name="form_year" onchange="showUser(this.value)">
<?
$years=1970;
while ($years!=2051){
        if($years==$_SESSION['year'])
        {
        ?>
                <option value="<? echo $years?>" selected><? echo $years++?></option>
                <?}
                else{?>
                <option value="<? echo $years?>"><? echo $years++?></option>
<?}}?>
</select>

<input type="submit" value="Submit">
</form>

<table cellspacing="0px" class="show_calender">
<tr>
<form method="POST" action="./time.php">
<td><input type="submit" value="<--" name="pre"></td>
<td></td><td></td><td></td><td></td><td></td>
<td><input type="submit" value="-->" name="next"></td>
</form>
</tr>
<tr>
<th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
</tr>

<tr>
<?$skipcounter=1;
while ($skipcounter!=$var){?><td></td><?$skipcounter++;}
while ($skipcounter!=8){
if($skipcounter!=7){
?>
<td><a href="date.php?date_var=<?echo $date?>"><?echo $date++;?></a></td>
<?}else{?>
<td><a href="date.php?date_var=<?echo $date?>" style="color:red"><?echo $date++;?></a></td>
<?}?>
<?$skipcounter++;}?>
</tr>

<? while ($date<=$_SESSION['last_date']){$counter=1;?>
<tr>
<?while ($counter<8){?>
<? if ($counter!=7){?>
			<? if($date <=$_SESSION['last_date']) {?>
			<td><a href="date.php?date_var=<?echo $date?>"><?echo $date++;?></a></td>
			<?}else{?>
			<td></td><?}?>
<?}else{?>
			<? if($date <=$_SESSION['last_date']) {?>
			<td><a href="date.php?date_var=<?echo $date?>" style="color:red"><?echo $date++;?></a></td>
			<?}else{?>
			<td></td><?}?>

<?}?>	
<?$counter++;}?>
</tr>
<?}?>
</table>
</td>
<td style="vertical-align: top">
<?include('time_date.php');?>
</td>
</tr>
<tr class="time" style="text-align:left;font-size:25;">
<td colspan="2"><?echo date('H:i D M,d Y',time()+270*60)?></td>
</tr>
</table>



<!--div class="fb-follow" data-href="https://www.facebook.com/mahavir.chopra" data-show-faces="true" data-width="250"></div-->
</body>
