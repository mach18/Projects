<?php
if(!isset($_SESSION['uu']))
{
//require_once('menu.php');
echo "<br /><br />";
session_start();
}
$ff=$_SESSION['flag'];
$usr=$_SESSION['uu'];
//echo "flag= $ff";
$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);
$result = mysql_query("SELECT * FROM students s,complaints c,student_room r where s.roll_no=c.student_id and (s.roll_no=r.student1 or s.roll_no=r.student2 or s.roll_no=r.student3) order by c.status,c.complaint_date desc,c.complaint_time desc");
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
</head>

<body>

  <ol class="message_list">

      <?php
while($row=mysql_fetch_array($result))
{
?>

  <li>
  <p class="message_head"><cite>
	<center>
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
</center>
  </li>

<?php
}mysql_close($con);
?>

</ol>
<p class="collapse_buttons"><a href="#" class="show_all_message"></a> <a href="#" class="collpase_all_message">Collapse all</a></p>

</body>
</html>
