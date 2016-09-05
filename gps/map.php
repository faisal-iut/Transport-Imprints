<?php
   include_once("main_home.php");
   $latitude   = $_GET['lt'];
   $longitude  = $_GET['ln'];
   
?>

<html>
  <head>
    <title>GeoLog</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
 html, body{
         height: 90%;
        
     
		width:99%;
      }
	  #map {
       height: 100%;
        margin-top:-200px;
		margin-left:20px;
		wi
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=it"></script>
    <script>
	   var initialize = function(){
           var latlng = new google.maps.LatLng(<?php echo $latitude, ",", $longitude;?>);
           var options = { zoom: 18,
                           center: latlng,
                           mapTypeId: google.maps.MapTypeId.ROADMAP
                         };
           var map = new google.maps.Map(document.getElementById('map'), options);
		   
		   var marker = new google.maps.Marker({ position: latlng,
                                                 map: map, 
                                                 title: '<?php echo $latitude;?>' });
	   }
	   
	   window.onload = initialize;
    </script>
  </head>
  <body>
  <br/>
     <div id="map"></div>
  </body>
</html>