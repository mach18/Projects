<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Doctor Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/styles2.css" rel="stylesheet" type="text/css" />
<!--<title>Simple Sign Up Form by PremiumFreeibes.eu</title>-->

<link rel="stylesheet" type="text/css" href="../../css/style1.css">

</head>

<body>
<?php
       require_once("../../dbconnect.php"); //Include Database Connection Script
        session_start();

if(isset($_POST['uid']) and !empty($_POST['uid']))
{
$result = mysql_query("select * from village where uid=".$_POST['uid']);
$row = mysql_fetch_array($result);
if($row)
{
?>




<h4>
<p style="text-align:right" align="top">
<a href ="index.php" style="text-decoration:none">
move to admin page</a>
</p>
</h4>

	
<!--<div id="container">
  <div id="header">
<div id="container" >
		<ul id="nav">
		<li><a href="index.html">Home</a></li>
		<li><a href="upload.html">Upload</a></li>
		<li><a href="sign_in.html">Sign In</a></li>
		<li><a href="sign_up.html">Sign Up</a></li>
		<li><a href="about.html">About</a></li>
	</ul>
</div>-->
  <!--  <ul class="menu">
      <li class="btn_1"><a href="#">lucky</a></li>
      <li class="line"></li>
      <li class="btn_2"><a href="#">keluuuu</a></li>
      <li class="line"></li>
      <li class="btn_3"><a href="#">akash agarwal</a></li>
      <li class="line"></li>
      <li class="btn_4"><a href="#">our team</a></li>
      <li class="line"></li>
      <li class="btn_5"><a href="#">contacts</a></li>
    </ul>
    <img src="images/logo.jpg" alt="" name="logo" width="244" height="52" id="logo"/> </div>-->
  <div id="content">
    <div id="leftPan">
      <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
       <div id="signup-inner">
          <h2>Insert Farmer<br/> </h2>

        <!--	<div class="clearfix" id="header">
        	
       		<img id="signup-icon" src="./images/signup.png" alt="" />-->
                   
            
            </div>
		<!--	<p>Please complete the fields below, ensuring you use a valid email address as you will be sent a validation code which you will need the first time you login to the site.</p>-->

            
            <form id="send" action="vh_insert.php" method="post" enctype="multipart/form-data">
            	
                <p>

                <label for="name">Uid </label>
                <input id="name" type="text" name="uid" readonly="readonly" value="<? echo $row['uid'] ?>" />
                </p>

		<p>
                <label for="salary">Name </label>
                <input id="name" type="text" name="name" value="<? echo $row['name'] ?>" />
                </p>
		<p>

                <label for="age">Village</label>
                <input id="age" type="text" name="village" value="<? echo $row['village'] ?>" />
                </p>

		<p>
               <label for="address">Address</label>
                <input id="address" type="text" name="address" value="<? echo $row['address'] ?>" />
                </p>
  
 	             
             <p>	
		<label for="speciality">Rate/lt</label>
                <input id="speciality" type="int" name="rateperlt" value="<? echo $row['rateperlt'] ?>" />
                </p>
                

		<p>
               <label for="dept">Daily Supply</label>
                <input id="dept" type="int" name="supplyperlt" value="<? echo $row['supplyperlt'] ?>" />
                </p>
                
      
    <!--      <p>
                <label for="company">Company Name</label>
                <input id="company" type="text" name="company" value="" />
                </p>-->
                
                
        <!--        <p>
                <label for="website">Website</label>
                <input id="website" type="text" name="website" value="http://" />
                </p>
                
                <p>

                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" value="" />
                </p>
                
                <p>
                <label for="country">Country</label>
                <input id="Country" type="text" name="country" value="" />
                </p>-->
                
                
          <!--      <p>
                <label for="profile">Tell Something about song</label>
                <textarea name="profile" id="profile" cols="3" rows="3"></textarea>

                </p>-->
<input type="hidden" name="submitted" value="2">  
                
                <p>

                <button id="submit" type="submit">Submit</button>
                </p>
                
            </form>
            
		
            </div>
        
        <!--END #signup-inner -->
        </div>
        
    <!--END #signup-form -->   
    </div>

    </div>
    <div id="rightPan">
      <div id="news">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p><a href="#">s</a></p>
      </div>
      <div id="shows">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="clear" id="end"></div>

  </div>



 <!-- <div align=center id="footer">
    <p><a href="#">HOME PAGE</a> | <a href="#">ABOUT</a> | <a href="#">PLAYLIST</a> | <a href="#">OUR TEAM</a> | <a href="#">CONTACTS</a><br/>
      Copyright &copy; Your Company Name | Design by <a href="http://freshtemplates.com/">Website Templates</a></p>
  </div>-->
</div>
<?php
}
else
{
	echo "uid doesn't exist";
}
}
?>

  <div id="content">
    <div id="leftPan">
      <div id="signup-form">
        
<form id="send" action="vh_update.php" method="post" enctype="multipart/form-data">
<p>
<label for="name">Uid</label>
<input id="name" type="text" name="uid" />
</p>
<input id="submit" type="submit">
</form>
</div>
</div>
</div>
</body>
</html>
