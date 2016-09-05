<?php
/**
 * ForgotPass.php
 *
 * This page is for those users who have forgotten their
 * password and want to have a new password generated for
 * them and sent to the email address attached to their
 * account in the database. The new password is not
 * displayed on the website for security purposes.
 *
 * Note: If your server is not properly setup to send
 * mail, then this page is essentially useless and it
 * would be better to not even link to this page from
 * your website.
 *
 *  Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("include/session.php");
?>

<html>
<head>
<title>Track Me!</title>
 <link rel="stylesheet" type="text/css" media="all" href="css/admin.css">
 </head>
<body>

<?php
/**
 * Forgot Password form has been submitted and no errors
 * were found with the form (the username is in the database)
 */
if(isset($_SESSION['forgotpass'])){
   /**
    * New password was generated for user and sent to user's
    * email address.
    */
   if($_SESSION['forgotpass']){
   ?>
      <div class="foo">
	   <?php
      echo "New Password Generated";
      echo "<p>Your new password has been generated. "
          ."and sent to the email <br>associated with your account. "
          ."<a href=\"main1.php\">Log in</a>.</p>";
		  ?>
		  </div>
		    <?php
   }
   /**
    * Email could not be sent, therefore password was not
    * edited in the database.
    */
   else{
      echo "<h1>New Password Failure</h1>";
      echo "<p>There was an error sending you the "
          ."email with the new password,<br> so your password has not been changed. "
          ."<a href=\"main1.php\">Main</a>.</p>";
   }
       
   unset($_SESSION['forgotpass']);
}
else{

/**
 * Forgot password form is displayed, if error found
 * it is displayed.
 */
?>
<div style="background-color: rgba(192,192,192,1.0);  margin-left:400px; margin-right:400px;margin-top:90px;padding:10px;">
<h1>Forgot Password</h1>
<br/><br/>
<div style="font-size:16px;">
A new password will be generated for you and sent to the email address<br>
associated with your account, all you have to do is enter your
username.
</div><br/><br/>
<?php echo $form->error("user"); ?>
<form action="process.php" method="POST">
<b>Username:</b> <input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>">
<input type="hidden" name="subforgot" value="1">
<input type="submit" value="Get New Password">
</form>

<?php
}
?>
</div>
</body>
</html>
