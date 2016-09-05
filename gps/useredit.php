<?php
/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.
 *
 * Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("main_home.php");
?>

<html>

<body>
<br/>

  <?php
  
/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
   unset($_SESSION['useredit']);
   ?>
   <div style="margin-top:-120px;font-size:14px;font-family: Helvetica, 'Trebuchet MS', Tahoma, sans-serif;">
   <p>Account update successfully!</p>
   <br/>
   <p> <?php echo "<b>$session->username</b>"?>, account has been successfully updated. </p>
   </div>
   
     <?php
       
}
else{
?>
  
  <?php
/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */
if($session->logged_in){
?>


<div style="margin-left:400px; margin-top:-170px">

<h1><img src="images/user_edit.png" width="32" height="32" alt="Edit Account">User Account Edit : <?php echo $session->username; ?></h1>
<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<div >
<br/>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td><img src="images/key.png" width="32" height="32" alt="Current Password"></td>
<td>Current Password:</td>
<td><input type="password" name="curpass" maxlength="30" value="
<?php echo $form->value("curpass"); ?>"></td>
<td><?php echo $form->error("curpass"); ?></td>
</tr>
<tr>
<td><img src="images/key_add.png" width="32" height="32" alt="New Password"></td>
<td>New Password:</td>
<td><input type="password" name="newpass" maxlength="30" value="
<?php echo $form->value("newpass"); ?>"></td>
<td><?php echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td><img src="images/email_add.png" width="32" height="32" alt="New Email"></td>
<td>Email:</td>
<td><input type="text" name="email" maxlength="50" value="
<?php
if($form->value("email") == ""){
   echo $session->userinfo['email'];
}else{
   echo $form->value("email");
}
?>">
</td>
<td><?php echo $form->error("email"); ?></td>
</tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subedit" value="1">
<input type="submit" value="Edit Account"></td></tr>
<tr><td colspan="2" align="left"></td></tr>
</table>
</form>

<?php
}
}

?>
</div>
</div>
</body>
</html>
