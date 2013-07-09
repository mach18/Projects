<div class = "menucontainer">
<table width='95%' cellpadding='2px;' class="menutable">
<tr width='100%'>
<td  class='menutd'><a href = "frame2.php">Home</a></td>
<td class='menutd'><a href = "complaints/decide.php">Complaints</a></td>
<td class='menutd' ><a href = "send_mail/">Send mail</a></td>
<? if($_SESSION['admin_id']) {?>
<td class='menutd' ><a href = "Rooms/unit_testing/">Rooms</a></td>
<td class='menutd' ><a href = "guest_room/unit_testing/">Guest rooms</a></td>
<?}?>
<td class ='menutd'><a href="personal_form/index.php"><?php echo $_SESSION['user'];?></a></td>
<td class='menutd' ><a href ="logout.php">Logout</a></td>
<td class='menutd' ><a href = "help/index.php">Help(S)</a></td>
</tr></table>
</div>

