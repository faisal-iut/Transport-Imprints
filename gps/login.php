<?php

include("include/session.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
<title>Track Me!!</title> 
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="css/admin.css">
  <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
   <meta name="viewport" content="width=device-width,user-scalable=no" />
   </head>
    <body>
	
	<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){


?>

	
	 <nav>
	
    <div class="wrapper">
      <ul id="menu" class="clearfix">
		
	   <li><a href="main1.php">Home</a>
   
            
        </li>
		
		<li><a href="">Search</a>
			<ul>
			  <li class="purple"><a href="daylog.php">By Day</a>
              
            </li>
             <li class="green"><a href="userlog.php">By User</a>
             
            </li>
			</ul>
        </li>
		
		<li><a href="tracklog.php">Track Log</a>
   
            
        </li>
		
        <li><a href="">My Account</a>
		<ul>
			  <li class="purple"><a href="userinfo.php? <?php echo "user=$session->username"?>">Info</a>
              
            </li>
             <li class="green"><a href="useredit.php">Update</a>
             
            </li>
			</ul>
		</li>
        
		<?php
					if($session->isAdmin()){
					?>
          <li><a href="admin1.php">Admin Center</a>
   
            
        </li>
			<?php
					}
					?>
		
		
		 <li><a href="process.php">Logout</a>
   
            
        </li>
		
	
		
		
		
      </ul>
    </div>
  </nav>

 
       <script type="text/javascript">
$(function(){
  $('a[href="#"]').on('click', function(e){
    e.preventDefault();
  });
  
  $('#menu > li').on('mouseover', function(e){
    $(this).find("ul:first").show();
    $(this).find('> a').addClass('active');
  }).on('mouseout', function(e){
    $(this).find("ul:first").hide();
    $(this).find('> a').removeClass('active');
  });
  
  $('#menu li li').on('mouseover',function(e){
    if($(this).has('ul').length) {
      $(this).parent().addClass('expanded');
    }
    $('ul:first',this).parent().find('> a').addClass('active');
    $('ul:first',this).show();
  }).on('mouseout',function(e){
    $(this).parent().removeClass('expanded');
    $('ul:first',this).parent().find('> a').removeClass('active');
    $('ul:first', this).hide();
  });
});
</script>
		<?php
		}
	else{
?>

<h9><img src="images/lock_locked.png" width="32" height="32" alt="Login">Track Me</h9>
<?php
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>

<div style="background-color: rgba(192,192,192,1.0); margin-left:400px; margin-right:350px;margin-top:40px;padding:0.3px">

 <form method="post" action="process.php" class="login">
    <p>
      
     <tr><td>Username: </td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
 </p>

    <p>
      <tr><td>Password: </td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
 </p>

    <p class="login-submit">
      <button 
	  type="hidden" name="sublogin" value="1"
	  type="submit"  class="login-button">Login</button>
    </p>
<input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>
<font size="3">Remember me next time &nbsp;
<br/>
<br/>
    <p class="forgot-password"><a href="forgotpass.php">Forgot your password?</a></p>
    <p class="forgot-password"><a href="register.php">Sign Up!!</a></p>

<p class="back"><a href="main1.php">Back to Home</a></p>


<?php
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */




?>
    </body>
</html>