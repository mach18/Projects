<?php
if(!isset($_SESSION['uu']))
{
require('menu.php');
//echo "<br /><br />";
session_start();
}

/////////////////////////////////////////////
if(isset($_REQUEST['ty']))
{
$fil=$_REQUEST['ty'];
    $fff=1;
    if($fil=='All')
    {
        $fff=0;
    }
    //echo "jghgjhgjhghj";
    //echo $fil;
}
else
{
    $fff=0;

}
//echo "flag=";
//echo $fff;
////////////////////////////////////////




$ff=$_SESSION['flag'];
$usr=$_SESSION['uu'];
$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);
///////////////////
if($fff==0)
{
$result = mysql_query("SELECT * FROM students s,complaints c,student_room r where s.roll_no=c.student_id and (s.roll_no=r.student1 or s.roll_no=r.student2 or s.roll_no=r.student3) order by c.status,c.complaint_date desc,c.complaint_time desc");
}
else
{
$result = mysql_query("SELECT * FROM students s,complaints c,student_room r where c.complaint_type='".$fil."' and s.roll_no=c.student_id and (s.roll_no=r.student1 or s.roll_no=r.student2 or s.roll_no=r.student3) order by c.status,c.complaint_date desc,c.complaint_time desc");


}

//$aaa=mysql_num_rows($result);
//echo $aaa;
//echo "hahahahahahaha";

?>
<html>
<head>
<title>Collapsible Message Panels</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	//hide message_body after the first one
	$(".message_list .message_body:gt(0)").hide();

	//hide message li after the 5th
//	$(".message_list li:gt(4)").hide();


	//toggle message_body
	$(".message_head").click(function(){
		$(this).next(".message_body").slideToggle(500)
		return false;
	});

	//collapse all messages
	$(".collpase_all_message").click(function(){
		$(".message_body").slideUp(500)
		return false;
	});

	//show all messages
	$(".show_all_message").click(function(){
		$(this).hide()
		$(".show_recent_only").show()
		$(".message_list li:gt(4)").slideDown()
		return false;
	});

	//show recent messages only
	$(".show_recent_only").click(function(){
		$(this).hide()
		$(".show_all_message").show()
		$(".message_list li:gt(4)").slideUp()
		return false;
	});

});
</script>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
body {
	margin: 8px auto;
	width: 1300px;
}
p {
	padding: 0 0 1em;
}
/* message display page */
.message_list {
	list-style: none;
	margin: 0;
	padding: 0;
	width: 383px;
}
.message_list li {
	padding: 0;
	margin: 0;
	background: url(images/message-bar.gif) no-repeat;
}
.message_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
}
.message_head .timestamp {
	color: #666666;
	font-size: 95%;
	position: absolute;
	right: 10px;
	top: 5px;
}
.message_head cite {
	font-size: 100%;
	font-weight: bold;
	font-style: normal;
}
.message_body {
	padding: 5px 10px 15px;
}
.collapse_buttons {
	text-align: right;
	border-top: solid 1px #e4e4e4;
	padding: 5px 0;
	width: 383px;
}
.collapse_buttons a {
	margin-left: 15px;
	float: right;
}
.show_all_message {
	background: url(images/tall-down-arrow.gif) no-repeat right center;
	padding-right: 12px;
}
.show_recent_only {
	display: none;
	background: url(images/tall-up-arrow.gif) no-repeat right center;
	padding-right: 12px;
}
.collpase_all_message {
	background: url(images/collapse-all.gif) no-repeat rights center;
	padding-right: 12px;
	color: #666666;
}
</style>
</head>
<link rel="stylesheet" type="text/css" href="menu.css">

<body>
<center>
<h2><strong>Complaints</strong></h2>
<br>
<!-- ************************************************-->
    <form action="mainadmin.php" method="post">

        <table width="358" border="0" cellpadding="0" cellspacing="0">
         
    <tr>
    <td width="124" height="23" valign="top">Filter By : </td>
    <td width="17">&nbsp;</td>
    <td width="119" valign="top"><label>
      <select name="ty">
        <option value="All">All</option>
        <option value="Carpenter">Carpenter</option>
        <option value="Plumber">Plumber</option>
        <option value="Electritian">Electritian</option>
        <option value="HouseKeeping">HouseKeeping</option>
        <option value="Other">Other</option>
      </select>
    </label></td>
    <td width="42">&nbsp;</td>
    <td width="56" rowspan="2" valign="top"><label>
      <input name="filter" type="submit" id="filter" value="Filter " />
    </label></td>
    </tr>
    <tr>
      <td height="1"></td>
      <td></td>
      <td></td>
      <td></td>
      </tr>
    <tr>
      <td height="2"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      </tr>
</table>
    </form>

    <!-- ************************************************-->

<a href="lodge.php">Lodge Complaint</a>
<br />

<div style="height:500px;overflow-y:scroll">
  <ol class="message_list">

            <?php
while($row = mysql_fetch_array($result))
{
?>

  <li>
  <p class="message_head"><cite>
   <strong>Name</strong>:  <font color="Brown">   <?php echo $row['name'];?><br />
   </font>Complaint Type: <?php echo $row['complaint_type'];?><br />
   </cite></p>
	 <div class="message_body">
	 <table>
  <tr>
    <td height="19" colspan="3" valign="top"><strong>Description</strong>:</td>
     </tr>
  <tr>
    <td height="33" colspan="13" valign="top" ><p align="left"><em><?php echo $row['description'];?> </em></p></td>
  </tr>
  <tr>
      <?php if($usr==$row['email_id']){ ?>

            <?php if($row['status']=="False"){ ?>
      <td height="23" colspan="6" valign="top"> <a href="close.php?idd=<?php echo $row['complain_id'] ?>">Close Complaint</a> </td>
            <?php }else{ ?>
    <td height="23" colspan="6" valign="top">Complaint Resolved<br></td>
            <?php } ?>

     <?php }else{ ?>
            <?php if($row['status']=="False"){ ?>
    <td height="23" colspan="6" valign="top">Complaint Unresolved<br></td>
            <?php }else{ ?>
    <td height="23" colspan="6" valign="top">Complaint Resolved</td>
            <?php } ?>

    <?php } ?>
  </tr>
            <tr>
                <td>Room Number:<?php echo $row['room_no'];?></td>
            </tr>
            <tr>
             <td>Place:<?php echo $row['place'];?></td>
            </tr>
             <tr>
             <td>Date:<?php echo $row['complaint_date'];?></td>
            </tr>
             <tr>
             <td>Time:<?php echo $row['complaint_time'];?></td>
            </tr>

  </table>
  </div>
  </li>

<?php
}mysql_close($con);
?>


</ol>
</div>
<p class="collapse_buttons"><a href="#" class="show_all_message"></a> <a href="#" class="collpase_all_message">Collapse all</a></p>

</center>
</body>
</html>
