<?php
$email=phpCAS::getUser();
$con = mysql_connect();
mysql_select_db("test", $con);
mysql_query("INSERT INTO Persons VALUES ('$email','$email',45)");
$result=mysql_query("SELECT * FROM Persons");
echo "<br><br><br>you are at the last :((((<br>";
while($row = mysql_fetch_array($result))
{
  print_r($row);
  echo "<br />";
}
?>
