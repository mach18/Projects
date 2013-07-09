<?php
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
//phpCAS::setNoCasServerValidation();
//phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
        
	session_start();
	$i=0;
        $complete_user=phpCAS::getuser();
	$_SESSION['uu']=$complete_user;
        while($complete_user[$i]!='@')
                $i++;
        $user_name=substr($complete_user,0,$i);
	$con=mysql_connect();
	mysql_select_db("test",$con);
	$result=mysql_query("select admin_id from admin where admin_id='$complete_user'");
	$a=mysql_fetch_array($result);	
	if($a['admin_id'])
	{	$isadmin=1;}
	else
	{	$isadmin=0;}
?>
<html>
<!--body background="bg.jpg"-->
<style type="text/css">

.menucontainer
{
        position : absolute; 
	position:fixed;
        width : 100%;
        background-color :#0060a7;
        top : 0px;
        left: 0px;
	padding-top:5px;
	padding-bottom:5px;
}
.menu
{
        list-style : none;
        margin-top: 4px;
}
.menu li a
{
        display : inline;
        padding-left : 10px;
        padding-right : 10px;
        font-family : helvetica;
        font-size : 10pt;
        color : #FFFFFF;
        text-decoration : none;

}
/*table.menutable
{

display:block;
margin-right:auto;
margin-left:auto;
}*/
table.menutable td
{
        font-family : helvetica;
        font-size : 10pt;
        color : #FFFFFF;
        text-decoration : none;
	text-align:center;
}
.text-label {
	color: #cdcdcd;
}
.menutd a
{
	display:block;
padding:2px;
border:1px solid #0060a7;
}

.menutd a:hover
{
border:1px solid #e5e5e5;
-moz-border-radius:4px;
-webkit-border-radius:5px; 
	-khtml-border-radius: 5px; 
	border-radius:5px;
-moz-box-shadow:0px 0px 6px #e5e5e5;
-webkit-box-shadow:0px 0px 6px #e5e5e5;
-khtml-box-shadow:0px 0px 6px #e5e5e5;
box-shadow:0px 0px 6px #e5e5e5;
}
table.menutable td a
{
        font-family : helvetica;
        font-size : 10pt;
        color : #FFFFFF;
        text-decoration : none;
}
</style>
<!--frameset cols="20%, 40%"-->
<!--frameset rows="20%, 40%"-->
<div class = "menucontainer">
<table width='95%' cellpadding='2px;' class="menutable">
<tr width='100%'>
<td width='2%'></td>
<td  class='menutd'>
<a href = "../frame22.php">Home</a>
</td>
<td class='menutd'>
<a href = "../complaints/decide.php">Complaints</a>
</td>
<!--td  class='menutd'>
<a href = "#">Campus feed</a>
</td-->
<td class='menutd' >
<a href = "../send_mail/index.php">Send mail</a>
</td>
<?php 
if($isadmin==1)
{
?>
<td class='menutd' >
<a href = "../Rooms/index.php">Rooms</a>
</td>
<td class='menutd' >
<a href = "../guest_room/index.php">Guest rooms</a>
</td>
<td width='45%'></td>
<?php
}
else
{
?>
<td width='60%'></td>
<?php
}
?>
<td class ='menutd' style='text-align:right;'>
<a href="../personal_form/index.php">
<?php 
echo $user_name ;
?>
</a>
</td>
<!--
<td style='text-align:right;'>
<form action="#" style="display:inline"><input type="text" name="search" size="14" title="Search .." /></form>
</td>
-->
<td class='menutd' >
<a href ="../logout.php">Logout</a>
</td>
<td class='menutd' >
<a href = "../help/index.php">Help(S)</a>
</td>
</tr>
</table>
</div>
<!--/frameset>
</frameset-->
</html>
