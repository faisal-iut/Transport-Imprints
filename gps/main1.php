<?php


include("main_home.php");
?>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
</head>
<body>
	
	<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
?>
 

<br/>
<table cellspacing="0" cellpadding="0" style="margin-top:-205px"> <tr> 
<td align="center" width="300" height="60" bgcolor="#000091" style=" margin-left:800px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: black; display: block;">
<a href="gps1/gps.htm" style=" font-size:24px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block"><span style="color:white">Track Now!</span></a>
</td> 
</tr> </table> 
<br/>

<?php
include("latest1.php");
}
else{
?>


<?php
include("latest.php");

}
?>

</body>