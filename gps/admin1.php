<?php
/**
 * Admin.php
 *
 * This is the Admin Center page. Only administrators
 * are allowed to view this page. This page displays the
 * database table of users and banned users. Admins can
 * choose to delete specific users, delete inactive users,
 * ban users, update user levels, etc.
 *
 * Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("main_home.php");

/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers(){
  include("disp_user.php");
}

/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers(){
   include("ban_user.php");
}
   
/**
 * User not an administrator, redirect to main page
 * automatically.
 */
if(!$session->isAdmin()){
   header("Location: main_home.php");
}
else{
/**
 * Administrator is viewing page, so display all
 * forms.
 */
?>
<html>
<body>
<br/>
<div style="margin-left:400px;margin-top:-150px;font-size:20px">
<h1>Admin Center</h1>


<table align="left" border="0" cellspacing="5" cellpadding="5">
  <tr><td>
<?php
/**
 * Display Users Table
 */
?>
<br/>
<h3>Users Table Contents:</h3>
<?php
displayUsers();
?>
</td></tr>
<tr>
<td>
<br>
<?php
/**
 * Update User Level
 */
?>
<h3>Update User Level</h3>
<br/>
<?php echo $form->error("upduser"); ?>
<table>
<form action="adminprocess1.php" method="POST">
<tr><td>
Username:<br>
<input type="text" name="upduser" maxlength="30" value="<?php echo $form->value("upduser"); ?>">
</td>
<td>
Level:<br>
<select name="updlevel">
<option value="1">1
<option value="9">9
</select>
</td>
<td>
<br>
<input type="hidden" name="subupdlevel" value="1">
<input type="submit" value="Update Level">
</td></tr>
</form>
</table>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php
/**
 * Delete User
 */
?>
<h3>Delete User</h3>
<br/>
<?php echo $form->error("deluser"); ?>
<form action="adminprocess1.php" method="POST">
Username:<br>
<input type="text" name="deluser" maxlength="30" value="<?php echo $form->value("deluser"); ?>">
<input type="hidden" name="subdeluser" value="1">
<input type="submit" value="Delete User">
</form>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php
/**
 * Delete Inactive Users
 */
?>
<h3>Delete Inactive Users</h3>
<br/>
<table>
<form action="adminprocess1.php" method="POST">
<tr><td>
Days:<br>
<select name="inactdays">
<option value="3">3
<option value="7">7
<option value="14">14
<option value="30">30
<option value="100">100
<option value="365">365
</select>
</td>
<td>
<br>
<input type="hidden" name="subdelinact" value="1">
<input type="submit" value="Delete All Inactive">
</td>
</form>
</table>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php
/**
 * Ban User
 */
?>
<br/>
<h3>Ban User</h3>
<br/>
<?php echo $form->error("banuser"); ?>
<form action="adminprocess1.php" method="POST">
Username:<br>
<input type="text" name="banuser" maxlength="30" value="<?php echo $form->value("banuser"); ?>">
<input type="hidden" name="subbanuser" value="1">
<input type="submit" value="Ban User">
</form>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr><td>
<?php
/**
 * Display Banned Users Table
 */
?>
<br/>
<h3>Banned Users Table Contents:</h3>
<?php
displayBannedUsers();
?>
</td></tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php
/**
 * Delete Banned User
 */
?>
<br/>
<h3>Delete Banned User</h3>
<?php echo $form->error("delbanuser"); ?>
<form action="adminprocess1.php" method="POST">
Username:<br>
<input type="text" name="delbanuser" maxlength="30" value="<?php echo $form->value("delbanuser"); ?>">
<input type="hidden" name="subdelbanned" value="1">
<input type="submit" value="Delete Banned User">
</form>
</td>
</tr>
</table>
</div>
</body>
</html>
<?php
}
?>

