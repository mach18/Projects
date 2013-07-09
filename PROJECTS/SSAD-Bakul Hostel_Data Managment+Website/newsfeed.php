<html>
    <head>


    </head>

    <body>
<link rel="stylesheet" type="text/css" href="menu.css">
<div class="newsholder">
HOSTEL BUZZ
<?php// echo "  Time:  ".date('H:i:s',time());?>
</div>
        <div class="box">
       <script type="text/javascript">

/***********************************************
* Fading Scroller- © scrollingtext DHTML code library (http://scrollingtext.blogspot.com/)
* This notice MUST stay intact for legal use
* Visit scrolling text at http://scrollingtext.blogspot.com/ for full source code
***********************************************/

var delay = 2000; //set delay between message change (in miliseconds)
var maxsteps=30; // number of steps to take to change from start color to endcolor
var stepdelay=40; // time in miliseconds of a single step
//**Note: maxsteps*stepdelay will be total time in miliseconds of fading effect
var startcolor= new Array(255,255,255); // start color (red, green, blue)
var endcolor=new Array(0,0,0); // end color (red, green, blue)

var fcontent=new Array();
begintag='<div style="font: normal 14px Arial; padding: 5px;">'; //set opening tag, such as font declarations
<?
$con=mysql_connect("localhost","","");

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

                        session_start();
                        $result = mysql_query("select * from newsfeed");
            //            $row = mysql_fetch_array($result);

//            if($row)
$i=0;
while($row = mysql_fetch_array($result))
{
?>

<?php
$result1 = mysql_query("select curdate()");
  while($row1 = mysql_fetch_array($result1))
            {
                $a = $row1['curdate()'];
        }
if($row['start_date'] <=  $a and  $a <= $row['finish_date'])
{
?>
fcontent[<? echo $i ?>]="<? echo $row['description']?>";

<?php
}
?>






<? $i++;
}
?> 
/*
fcontent[0]="<b>Janamashthmi Celebration</b><br> There's Janmastmi celebration today at 7:00 pm all the students are invited<br><br>More has been updated. <a href='http://scrollingtext.blogspot.com/'>Click here to visit</a>";
fcontent[1]="<b>Electricity</b><br>Today there will be no electricity from 3:00pm - 3:30pm due to maintenance work";
fcontent[2]=" More hostel Activities will be mentioned here</a>";*/
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
</script><br />
</div>
<div>
<?
if($_SESSION['admin_id'])
{
	echo "<a href='newsform/'>EDIT</a>";
}
?>
</div>


</body>
