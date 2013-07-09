<?
include("CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"/cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
        $i=0;
        $complete_user=phpCAS::getuser();

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
<link rel="stylesheet" type="text/css" href="menu.css">

<div class = "menucontainer">
<table width='95%' cellpadding='2px;' class="menutable">
<tr width='100%'>
<td  class='menutd'><a href = "frame22.php">Home</a></td>
<td class='menutd'><a href = "complaints/">Complaints</a></td>
<td class='menutd' ><a href = "send_mail/">Send mail</a></td>
<td class='menutd' ><a href = "Rooms/">Rooms</a></td>
<td class='menutd' ><a href = "guest_room/">Guest rooms</a></td>
<td class ='menutd'><a href="personal_form/index.php"><?php echo $user_name;?></a></td>
<td class='menutd' ><a href ="logout.php">Logout</a></td>
<td class='menutd' ><a href = "help/index.php">Help(S)</a></td>
</tr></table>
</div>



<div style="position:relative;width:100%;height:90%;overflow-x:hidden;overflow:auto;">
<div>
<div style="height-max:50px">
<?include('slideshow.php')?>
</div>

<div style="position:relative;float:right;width:55%;top:15px;">
<center>
<div class="newsholder">
HOSTEL BUZZ
<?php// echo "  Time:  ".date('H:i:s',time());?>
</div>
<div class="box">
<script type="text/javascript">

var delay = 2000; 
var maxsteps=30; 
var stepdelay=40; 
var startcolor= new Array(255,255,255); 
var endcolor=new Array(0,0,0); 
var fcontent=new Array();
begintag='<div style="font: normal 14px Arial; padding: 5px;">'; //set opening tag, such as font declarations
fcontent[0]="<b>Janamashthmi Celebration</b><br> There's Janmastmi celebration today at 7:00 pm all the students are invited<br><br>More has been updated. <a href='http://scrollingtext.blogspot.com/'>Click here to visit</a>";
fcontent[1]="<b>Electricity</b><br>Today there will be no electricity from 3:00pm - 3:30pm due to maintenance work";
fcontent[2]=" More hostel Activities will be mentioned here</a>";
closetag='</div>';

var fwidth='275px'; //set scroller width
var fheight='170px'; //set scroller height

var fadelinks=1;  //should links inside scroller content also fade like text? 0 for no, 1 for yes.



var ie4=document.all&&!document.getElementById;
var DOM2=document.getElementById;
var faderdelay=0;
var index=0;


function changecontent(){
if (index>=fcontent.length)
index=0
if (DOM2){
document.getElementById("fscroller").style.color="rgb("+startcolor[0]+", "+startcolor[1]+", "+startcolor[2]+")"
document.getElementById("fscroller").innerHTML=begintag+fcontent[index]+closetag
if (fadelinks)
linkcolorchange(1);
colorfade(1, 15);
}
else if (ie4)
document.all.fscroller.innerHTML=begintag+fcontent[index]+closetag;
index++
}


function linkcolorchange(step){
var obj=document.getElementById("fscroller").getElementsByTagName("A");
if (obj.length>0){
for (i=0;i<obj.length;i++)
obj[i].style.color=getstepcolor(step);
}
}

var fadecounter;
function colorfade(step) {
if(step<=maxsteps) {
document.getElementById("fscroller").style.color=getstepcolor(step);
if (fadelinks)
linkcolorchange(step);
step++;
fadecounter=setTimeout("colorfade("+step+")",stepdelay);
}else{
clearTimeout(fadecounter);
document.getElementById("fscroller").style.color="rgb("+endcolor[0]+", "+endcolor[1]+", "+endcolor[2]+")";
setTimeout("changecontent()", delay);

}
}

function getstepcolor(step) {
var diff
var newcolor=new Array(3);
for(var i=0;i<3;i++) {
diff = (startcolor[i]-endcolor[i]);
if(diff > 0) {
newcolor[i] = startcolor[i]-(Math.round((diff/maxsteps))*step);
} else {
newcolor[i] = startcolor[i]+(Math.round((Math.abs(diff)/maxsteps))*step);
}
}
return ("rgb(" + newcolor[0] + ", " + newcolor[1] + ", " + newcolor[2] + ")");
}

if (ie4||DOM2)
document.write('<div id="fscroller" style="border:0px solid black;width:'+fwidth+';height:'+fheight+'"></div>');

if (window.addEventListener)
window.addEventListener("load", changecontent, false)
else if (window.attachEvent)
window.attachEvent("onload", changecontent)
else if (document.getElementById)
window.onload=changecontent
</script>


</div>
</center>
</div>

<div style="position:relative;top:15px;width:45%;">
<center> Complaints </center>
<div>
<? include('frame2_complaints/mainadmin.php')?>
</div>
</div>

</div>

<div>
<br>
<br>
<div style="position:relative;bottom:0px;width:100%;background-color:#0060a7;color:#ffffff;">

<center>
Footer
</center>
</div>
<div>

</div>
</html>
