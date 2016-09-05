<?php
/**
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 *
 * Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("main_home.php");
?>

<html>
<head>
<title>Track Me!</title>
 <link rel="stylesheet" type="text/css" media="all" href="css/admin.css">
 <link rel="stylesheet" type="text/css" media="all" href="css/acenter.css">
 <style>
 tr.spaceUnder > td
{
  padding-bottom: 1em;
}


 </style>
 </head>
<body>
<br/>
<div style="margin-top:-150px"
<?php
/**
 * The user is already logged in, not allowed to register.
 */
 
if($session->logged_in){


if(isset($_SESSION['grsuccess'])){
   /* Registration was successful */
   if($_SESSION['grsuccess']){
   ?>
   <div class="foo">
   <?php
	 global $database;
      echo "Congratulation <br/>";
      echo "<p> <b>".$_SESSION['regugroup']."</b>, group has been created, ";
          
		  $term=$_SESSION['regugroup'];
		 
$sql= "SELECT * FROM `blog_users` WHERE groupname='$term'";
$result = mysql_query($sql);
 $num_rows = mysql_numrows($result);

		  
		  ?>
   <form name="frmUser" method="post" action="">
<div style="width:1100px;">
<table border="1" cellpadding="10" cellspacing="1" height="20" width="500" class="tblListForm">
<tr class="listheader">


<td width="56">Username</td>
<td width="56">category</td>
<td width="98">Group Name</td>


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
<td><?php echo $row["catagory"]; ?></td>
<td><?php echo $row["groupname"]; ?></td>


</tr>
<?php
$i++;
}
?>

</table>
</div>
</form>
   
  
   
     <?php
	
	 }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['grsuccess']);
   unset($_SESSION['regugroup']);
}

else{
?>
<br/>
<h9><img src="images/user_add.png" width="32" height="32" alt="Login">Group</h9>

<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<div style=" margin-left:300px; margin-right:250px;margin-top:-40px;padding:120px;">
<form action="process.php" method="POST">
<table align="left" border="1" cellspacing="1" cellpadding="5" style="margin-left:80px; margin-right:150px;margin-top:-50px; position:fixed;">
<tr class="spaceUnder"><td><img src="images/user_info.png" width="40" height="32" alt="Groupname"></td><td>Groupname:</td><td><input type="text" name="groupname" maxlength="30" value="<?php echo $form->value("group"); ?>"></td><td><?php echo $form->error("group"); ?></td></tr>
<tr><td><img src="images/email.png" width="40" height="32" alt="Catagory"></td><td>Catagory:</td>
<td><select name="catagory" size="1" style="width:175px;font-size:20px">
 <option value="bus">Bus</option>
<option value="train">Train</option>
<option value="person">Person</option>
</select></td><td><?php echo $form->error("catagory"); ?></td>
</tr>
<tr class="spaceUnder"><td></td><td></td></tr>
<tr ><td></td><td>Required id:</td><td><input type="text" name="id" maxlength="50" value="<?php echo $form->value("id"); ?>"></td><td><?php echo $form->error("id"); ?></td>
</tr>
<tr class="spaceUnder"><td></td><td></td></tr>
<tr><td colspan="3" align="left">
<input type="hidden" name="subgroup" value="1">
<input type="submit" value="Register Group!"></td></tr>
<td></td>
<td></td>

</table>
</form>
<br/>
<br/>

<?php
}

   
}

?>
</div>

</body>
</html>