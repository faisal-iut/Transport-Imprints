<?php
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 * Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("main_home.php");
?>

<html>
<title>Account Info | jQuery, AJAX, PHP, MySQL, javascript, web design tutorials & demos | php login script demo</title>
<body>
 
<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !eregi("^([0-9a-z])+$", $req_user) ||
   !$database->usernameTaken($req_user)){
   die("Username not registered");
}
?>

 <div style="margin-left:450px;margin-top:-150px;font-size:18px;font-family: Helvetica, 'Trebuchet MS', Tahoma, sans-serif;">
 <?php
if(strcmp($session->username,$req_user) == 0){
   echo "<h1><img src=\"images/user_info.png\" width=\"32\" height=\"32\">My Account</h1>";
}
/* Visitor not viewing own account */
else{
   echo "<h1>User Info</h1>";
}

/* Display requested user information */
$req_user_info = $database->getUserInfo($req_user);
?>
<br/>

<?php
/* Username */
echo "<b>Username: ".$req_user_info['username']."</b><br>";
?>
<br/>

<?php
/* Email */
echo "<b>Email:</b> ".$req_user_info['email']."<br>";

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
?>


<?php
if(strcmp($session->username,$req_user) == 0){
   echo "<br><a href=\"useredit.php\">Update Information</a><br>";
}



?>
</div>
</body>
</html>
