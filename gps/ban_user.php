 <head>
    
  <link rel="stylesheet" type="text/css" media="all" href="css/acenter.css">

   
   </head>
<?php  
global $database;
  $q = "SELECT username,timestamp "
       ."FROM ".TBL_BANNED_USERS." ORDER BY username";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = mysql_numrows($result);
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }
   ?>
      <form name="frmUser" method="post" action="">
<div style="width:1100px;">
<table border="1" cellpadding="10" cellspacing="1" height="20" width="500" class="tblListForm">
<tr class="listheader">


<td width="56">Username</td>
<td width="56">Time Banned</td>


</tr>
<?php


$i=0;
while($row=mysql_fetch_array($result))
{
 
if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">

<td><?php echo $row["username"]; ?></td>
<td><?php echo $row["timestamp"]; ?></td>


</tr>
<?php
$i++;
}
?>

</table>
</form>
   
 