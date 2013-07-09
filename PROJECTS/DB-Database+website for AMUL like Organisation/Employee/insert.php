<html>
<body>

<h3>
<p style="text-align:right" align="top">
<a href ="../logout.php" style="text-decoration:none">
logout</a>
</p>
</h3>

<?php

        require_once("../dbconnect.php"); //Include Database Connection Script
        session_start();
        
        //Check Fields
        if (empty($_POST["username"]) || empty($_POST["password"])) {
          //      echo "Please Fill Out All Fields";
		header("location:index.php");
                exit;
        }
        
        $username = mysql_real_escape_string($_POST["username"]); //Escape Username
        $password = mysql_real_escape_string($_POST["password"]); //EScape Password
       // $password = sha1($password); //Convert Password To Sha1
		
	$sql = "SELECT * FROM Employee WHERE Username='$username' and Password='$password'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) == 1) {
                $_SESSION["username"] = $username;
		header('location:main_page.php');
}
	else
{
	header("location:index.php");
}
?>
</body>
</html>

