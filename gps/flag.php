<?php
/**
 * Main.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 * Please subscribe to our feeds at http://blog.geotitles.com for more such tutorials
 */
include("include/session.php");

$c=$session->username;

echo $c;


?>