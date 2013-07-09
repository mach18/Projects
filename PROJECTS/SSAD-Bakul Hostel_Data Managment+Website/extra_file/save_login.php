<?php
$filename = "infile.txt" ;
$complete_user=phpCAS::getuser()."\n";
file_put_contents($filename,$complete_user,FILE_APPEND);
/*$lines = file($filename); 
echo '<ul>' ;
foreach ($lines as $line) 
{
	echo "<li>$line</li>" ;
}
echo '</ul>' ;
*/
?>

