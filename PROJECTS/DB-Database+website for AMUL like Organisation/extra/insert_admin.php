<?php

        require_once("dbconnect.php"); //Include Database Connection Script
        session_start();
        
        //Check Fields
        if (empty($_POST["username"]) || empty($_POST["password"])) {
          //      echo "Please Fill Out All Fields";
		header("location:index_admin.php");
                exit;
        }
        
        $username = mysql_real_escape_string($_POST["username"]); //Escape Username
        $password = mysql_real_escape_string($_POST["password"]); //EScape Password
       // $password = sha1($password); //Convert Password To Sha1
	echo "\n";
        echo $username;
	echo $password;	
 //       $sql = "SELECT * FROM Admin WHERE username=&#39;$username&#39; and password=&#39;$password&#39;";	
	$sql = "SELECT * FROM Admin WHERE username='$username' and password='$password'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) == 1) {
          //      session_register("username");
                $_SESSION["username"] = $username;
            //    echo "Hello ".$_SESSION["username"]."!";
                header("location:index_staff.php");
        }
	else
{
     //   echo "Invalid Username and/or Password.";
	header("location:index_admin.php");
                
}

?>
