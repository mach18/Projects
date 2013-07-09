<?php
if(!isset($_SESSION['uu']))
{
include('menu.php');
echo "<br /><br />";
session_start();
}
$usr=$_SESSION['uu'];
//echo 'Welcome  ';
//echo $_SESSION['uu'];


$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);
$result = mysql_query("SELECT * FROM students");

while($row = mysql_fetch_array($result))
{
    if($row['email_id']==$usr)
    {
        $roll=$row['roll_no'];
    }
}
echo $roll;
$_SESSION['roll']=$roll;
mysql_close($con);
?>
<html>
    <body>
    <form action="print.php" method="post">

        <table width="1096" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="381" height="16"></td>
    <td width="124"></td>
    <td width="14"></td>
    <td width="32"></td>
    <td width="24"></td>
    <td width="125"></td>
    <td width="396"></td>
    </tr>
    <tr>
    <td height="37"></td>
    <td colspan="5" valign="top"><div align="center">
      <h1 class="style1">Post Complaint </h1>
    </div></td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td height="45"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>

    <tr>
    <td height="23">&nbsp;</td>
    <td valign="top">Complaint About: </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><label>
      <select name="type">
        <option value="Carpenter">Carpenter</option>
        <option value="Plumber">Plumber</option>
        <option value="Electritian">Electritian</option>
        <option value="HouseKeeping">HouseKeeping</option>
        <option value="Other">Other</option>
      </select>
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td height="22"></td>
    <td valign="top">Related Place </td>
    <td></td>
    <td></td>
    <td colspan="2" valign="top"><label>
      <select name="place">
        <option value="Room">Room</option>
        <option value="Lobby">Lobby</option>
        <option value="Other">Other</option>
      </select>
    </label></td>
    <td></td>
  </tr>
  <tr>
    <td height="17"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="19"></td>
    <td valign="top">Description</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="18"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="163"></td>
    <td colspan="5" valign="top"><label>
      <textarea name="desc" cols="50" rows="10"></textarea>
    </label></td>
    <td></td>
  </tr>
  <tr>
    <td height="33"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="28"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><label>
      <input type="submit" name="Submit" value="Post" />
    </label></td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td height="68"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
    </form>
</body>
</html>
