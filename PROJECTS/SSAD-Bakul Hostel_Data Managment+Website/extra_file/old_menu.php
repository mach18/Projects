<?php
	$i=0;
	$complete_user=phpCAS::getuser();
//	$p_user=phpCAS::$complete_user.getPassword();
//	echo $p_user;
	$complete_user=phpCAS::getuser();
	while($complete_user[$i]!='@')
	{		
		$i++;
	}
	$user_name=substr($complete_user,0,$i);
?>
<html>
<style type="text/css"> 
/*a { color:#021f25; text-decoration:none}
h1 {
	font-size: 30px;
color: #FB9802;
       padding-bottom: 10px;
       background-image: url(sys_cpanel/images/bottombody.jpg);
       background-repeat: repeat-x;
padding:5px 0 10px 15px;
margin:0;
}
#body-content p {
	padding-left: 150px;
	padding-right: 105px;
	line-height: 18px;
	padding-top: 5px;
	padding-bottom: 5px;
}
h2 {
	font-size: 14px;
	font-weight: bold;
color: #FF9900;
       padding-left: 15px;
}*/
#button {
/*padding: 10px;*/
}
#button li {
	display: inline;
	font-size:21px;
	background-color: #2175bc;
}

#button li a {
	font-family: Arial;
	font-size:30px;
	text-decoration: none;
	padding-left: 20px;
	padding-right: 20px;
	color: #fff;
}

#button li a:hover 
{
	margin-top:0px;
	padding-bottom:0px;
background-color: #2586d7;
}
</style>
<body>
<div style="background-color:#2175bc">
<ul id="button" >
<li><a href="#">Home</a></li>
<li ><a href="#">Complaint</a></li>
<li style="text-align:right"><a href='personal_form/index.php' ><?php echo "<strong>$user_name</strong>"?></a></li>
<li><a href="logout.php" >logout</a></li>
<li ><a href="#">Help</a></li>
</ul>
</div>
</body>
</html>
