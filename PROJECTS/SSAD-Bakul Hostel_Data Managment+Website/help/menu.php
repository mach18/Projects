<?
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
        $i=0;
        $complete_user=phpCAS::getuser();

        while($complete_user[$i]!='@')
                $i++;
        $user_name=substr($complete_user,0,$i);
        $_SESSION['user']=$user_name;
        $con=mysql_connect();
        mysql_select_db("test",$con);
        $result=mysql_query("select admin_id from admin where admin_id='$complete_user'");
        $a=mysql_fetch_array($result);
        $_SESSION['admin_id']=$a['admin_id'];
?>
<div class = "menucontainer">
<table width='95%' cellpadding='2px;' class="menutable">
<tr width='100%'>
<td  class='menutd'><a href = "../frame2.php">Home</a></td>
<td class='menutd'><a href = "../complaints/decide.php">Complaints</a></td>
<td class='menutd' ><a href = "../send_mail/">Send mail</a></td>
<? if($_SESSION['admin_id']) {?>
<td class='menutd' ><a href = "../Rooms/unit_testing/">Rooms</a></td>
<td class='menutd' ><a href = "../guest_room/unit_testing">Guest rooms</a></td>
<?}?>
<td class ='menutd'><a href="../personal_form/index.php"><?php echo $_SESSION['user'];?></a></td>
<td class='menutd' ><a href ="../logout.php">Logout</a></td>
<td class='menutd' ><a href = "../help/index.php">Help(S)</a></td>
</tr></table>
</div>

