<?php
/*
include("../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
*/

include('menu.php');


session_start();
		//$urs=$_REQUEST["t1"];
$usr=phpCAS::getuser();
		//$usr="default user";
$_SESSION['uu']=$usr;
//echo $_SESSION['uu'];
$con = mysql_connect();
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);

$flag=0;
$result = mysql_query("SELECT * FROM students");
while($row = mysql_fetch_array($result))
  {
    if(($row['email_id']==$usr))
    {$flag=1;}
  }
if($flag==1)
{
$result = mysql_query("SELECT * FROM admin");
while($row = mysql_fetch_array($result))
  {
    if($row['admin_id']==$usr)
    {$flag=2;}
  }
}

$_SESSION['flag']=$flag;

?>




<title>Untitled Document</title>
</head>

<link rel="stylesheet" type="text/css" href="menu.css">
<center>
<body style="position:relative;width:100%;height:100%;overflow-y:scroll">
<table width="500px" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="300px"><?php if($flag==1)
                            {
				require 'mainuser.php';}
                            else if($flag==2)
                            {
                          require 'mainadmin.php';
			//	echo "$_SESSION['uu']";
                         //   echo "main admin";
			//	header('Location:mainadmin.php');
				
                            }
                            else
                            { 
					header('Location:new.php'); 
				}
                            ?></td>
  </tr>
 </table>
</body>
</center>
</html>



