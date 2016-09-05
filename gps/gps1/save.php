<?php

require_once 'library.php';

db_connect();

$runnerId = mysqli_real_escape_string($link, $_GET['file']);
$lat = mysqli_real_escape_string($link, $_POST['lat']);
$lon = mysqli_real_escape_string($link, $_POST['lon']);
$time = mysqli_real_escape_string($link, $_POST['time']);

$query = mysqli_query($link, "INSERT INTO current_location SET username='$runnerId', lat='$lat', lon='$lon', recorded_datetime='$time'");
$query1 = mysqli_query($link, "UPDATE latest_location SET  lat='$lat', lon='$lon', recorded_datetime='$time' where username='$runnerId'");

?>


