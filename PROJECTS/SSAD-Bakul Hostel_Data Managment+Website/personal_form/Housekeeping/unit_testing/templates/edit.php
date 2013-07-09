<?php
$iidd=$_GET["roll_no"];
                $con=mysql_connect();
                        if(!$con)
                                die("Could not connect to the database ".mysql_error());
                        mysql_select_db("test",$con);
                        $result = mysql_query("select * from students where id='".$iidd."'");
                        ?>
<html>
    <body>
<?php
        while($row = mysql_fetch_array($result))
            {
             ?>
 


        <form action="update.php" method="post">

        <table align="right" width="1086" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="370" height="585">&nbsp;</td>
    <td width="360" valign="top"><table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
      
      <tr>
        <td width="104" height="52">&nbsp;</td>
          <td width="26">&nbsp;</td>
          <td width="16">&nbsp;</td>
          <td width="67">&nbsp;</td>
          <td width="80">&nbsp;</td>
          <td width="67">&nbsp;</td>
        </tr>
        <tr>
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

        </tr>
      <tr>
        <td height="24" valign="top"><div align="center">Name</div></td>
          <td>&nbsp;</td>
          <td colspan="3" valign="top"><label>
            <input name="name" type="text" id="name" value="<?php echo $row['name'] ?>" />
          </label></td>
          <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="17"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="22" valign="top"><div align="center">Birth-Date</div></td>
          <td></td>
          <td colspan="3" valign="top"><label>
            <input name="bdate" type="text" id="bdate" value="<?php  echo $row['bdate'] ?>" />
          </label></td>
          <td></td>
        </tr>
      <tr>
        <td height="15"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>



        <?php
        if($fl==1)
        {
        ?>
      <tr>
        <td height="25" valign="top"><div align="center">Gender</div></td>
          <td></td>
          <td colspan="2" valign="top">Male
            <label>
            <input name="sex" type="radio" value="M"  />
                </label></td>
          <td valign="top">Female
            <label>
            <input name="sex" type="radio" value="F" checked="checked"/>
          </label></td>
          <td></td>
        </tr>
        <?php
        }else{
        ?>
      <tr>
        <td height="25" valign="top"><div align="center">Gender</div></td>
          <td></td>
          <td colspan="2" valign="top">Male
            <label>
            <input name="sex" type="radio" value="M" checked="checked" />
                </label></td>
          <td valign="top">Female
            <label>
            <input name="sex" type="radio" value="F" />
          </label></td>
          <td></td>
        </tr>
      <?php } ?>


        
      <tr>
        <td height="19"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="22" valign="top">Responsibility</td>
          <td></td>
          <td colspan="3" rowspan="2" valign="top"><label>
            <textarea name="responsibility" rows="4" id="responsibility"><?php  echo $row['responsibility'] ?></textarea>
          </label></td>
          <td></td>
        </tr>
      <tr>
        <td height="53">&nbsp;</td>
          <td></td>
          <td></td>
        </tr>

      <tr>
        <td height="15"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="22" valign="top">Job</td>
          <td></td>
          <td colspan="3" valign="top"><label>
            <input type="text" name="job" value="<?php  echo $row['job'] ?>" />
          </label></td>
          <td></td>
        </tr>
      <tr>
        <td height="21">&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="23" valign="top">Address</td>
          <td></td>
          <td colspan="3" rowspan="2" valign="top"><label>
            <textarea name="address" rows="4"><?php  echo $row['address'] ?></textarea>
          </label></td>
          <td></td>
        </tr>
      <tr>
        <td height="62">&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="29">&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>

      <tr>
        <td height="23" valign="top">Contact number </td>
          <td></td>
          <td colspan="3" valign="top"><label>
            <input name="contact" type="text" id="contact" value="<?php  echo $row['contact_no'] ?>"/>
          </label></td>
          <td></td>
        </tr>
      <tr>
        <td height="34">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="top"><label>
          <input name="update" type="submit" id="update" value="Update" />
        </label></td>
        <td></td>
        <td></td>
      </tr>
      










    </table></td>
    <td width="702">&nbsp;</td>
  </tr>
  
</table>
        </form>
<?php
            }
            ?>
    </body>
