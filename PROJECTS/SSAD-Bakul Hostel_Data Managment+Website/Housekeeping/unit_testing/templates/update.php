<?php
include("../../../CAS.php");
phpCAS::client(CAS_VERSION_2_0,"login.iiit.ac.in",443,"../../../cas");
phpCAS::setNoCasServerValidation();
phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,1);
phpCAS::forceAuthentication();
$iidd=$_POST['id'];
 $con=mysql_connect();

                        if(!$con)
                                die("Could not connect to the database ".mysql_error());

                        mysql_select_db("test",$con);

                        $result = mysql_query("update staff set id='".$iidd."' ,name='".$_POST['name']."' , bdate='".$_POST['bdate']."' ,sex='".$_POST['sex']."',responsibility='".$_POST['responsibility']."',job='".$_POST['job']."',address='".$_POST['address']."',contact_no='".$_POST['contact']."'  where id='".$iidd."'");
			$filename="../../housekeeping_log.txt";
			$user=$_SESSION["user"];
			
			$file_pointer = fopen($filename, "a");
			fwrite($file_pointer, date('M d, H:i:s')." UPDATE: $user updated staff with id=".$_POST["id"].".\n");
			fclose($filename);

                       header("Location: ../index.php");
?>
