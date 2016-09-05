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

<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

   <script>
   $(window).scroll(function(){
    if ($(window).scrollTop() >= 100) {
       $('nav').addClass('fixed-header');
    }
    else {
       $('nav').removeClass('fixed-header');
    }
});
   </script>
   </head>
    <body>
	
	<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){


?>

	<header>
  <div class="header-banner">
    <a href="/" class="logo"></a>
    <!--
    <h1>Art in Finland</h1>
    -->
  </div>
  <div class="clear"></div>
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

         <li><a href="group.php">New Group</a>
   
            
        </li>
          <li><a href="admin1.php">Admin Center</a>
   
            
        </li>
			<?php
					}
					?>
		
		
		 <li><a href="process.php">Logout</a>
   
            
        </li>
		
	
		
	</header>
		
		
		
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
<header>
  <div class="header-banner">
    <a href="/" class="logo"></a>
    <!--
    <h1>Art in Finland</h1>
    -->
  </div>
  <div class="clear"></div>

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
		

		
		
		 <li><a href="login.php">LogIn</a>
   
            
        </li>
		<li><a href="register.php">Sign In</a>
   
            
        </li>
		
	
		
		
		
      </ul>
    </div>
  </nav>
</header>
 
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
	<br/>
	<br/>
	<br/>
<?php




}
?>
    </body>
</html>