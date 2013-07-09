<?php
 $con=mysql_connect();
                        if(!$con)
                                die("Could not connect to the database ".mysql_error());
                        mysql_select_db("test",$con);
                        $result = mysql_query("update staff set ");
                       header("Location: ../../../../index.php");
?>
