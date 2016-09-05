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
include("include/session.php");
?>

<html>
<head>
<title>Track Me!</title>
 <link rel="stylesheet" type="text/css" media="all" href="css/admin.css">
 </head>
<body>
<br/>
<div style="margin-top:20px"
<?php
/**
 * The user is already logged in, not allowed to register.
 */
 
if($session->logged_in){
   echo "Registered";
   echo "We're sorry <b>$session->username</b>, but you've already registered. "
       ."<a href=\"main1.php\">Main</a>.";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
   ?>
   <div class="foo">
   <?php
      echo "Registered! <br/>";
      echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your information has been added to the database, "
          ."you may now <a href=\"main1.php\">log in</a>.</p>";
		  ?>
		  </div>
   
  
   
     <?php
	 }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>
<br/>
<h9><img src="images/user_add.png" width="32" height="32" alt="Login">Register</h9>

<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<div style="background-color: rgba(192,192,192,1.0);  margin-left:300px; margin-right:200px;margin-top:-20px;padding:120px;">
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3" style="margin-left:80px; margin-right:150px;margin-top:-50px; position:fixed;">
<tr><td><img src="images/user_info.png" width="40" height="32" alt="Username"></td><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
<tr><td><img src="images/key.png" width="40" height="32" alt="Password"></td><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
<tr><td><img src="images/email.png" width="40" height="32" alt="Email"></td><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"></td><td><?php echo $form->error("email"); ?></td>
</tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1">
<input type="submit" value="Register!"></td></tr>
<td></td>
<td></td>

</table>
</form>
<br/>
<br/>
<p class="back"><a href="main1.php">Back to Home</a></p>
<?php
}
?>
</div>
</div>
</body>
</html>
