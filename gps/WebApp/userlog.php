<?php

    include_once("Functions/DBInteractor.php");

    
    $sql = "SELECT username FROM blog_users";
    $rs = mysql_query($sql) or die(mysql_error());
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Google Maps Demo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

    <script type="text/javascript">

        $(document).ready(function(){
            var coordinates, parsedCoordinates;
            var map;
            var marker;
			var infostr;
            var markers = [];
			var data = [];
			var record = [];
            var bounds = new google.maps.LatLngBounds();
            var coords = new google.maps.LatLng(23.2778, 90.77777);
            var infowindow = new google.maps.InfoWindow();
            map_initialize(); // load map
			var baseUrl = "Functions/getLatLon.php";
            function map_initialize(){

                //Google map option
                var googleMapOptions = 
                {
                    center: coords,
                    zoom: 0, //zoom level, 0 = earth view to higher value
                    panControl: true, //enable pan Control
                    zoomControl: true, //enable zoom control
					
					
                    scaleControl: true, // enable scale control
                    mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
                };

                map = new google.maps.Map(document.getElementById("map"), googleMapOptions);
                //  Fit these bounds to the map
                map.fitBounds(bounds);

                
    


            }
			
			
			

            $(':submit').on('click', function() { // This event fires when a button is clicked
                     
					 var e = document.getElementById("user");
					var str = e.options[e.selectedIndex].text;
					

					while(markers[0])
						{
						  markers.pop().setMap(null);
						}
					      
						  
						 // map.clearOverlays();
						  //setMapOnAll(null);
					 var jsonUrl = baseUrl + "?action=getLocationByUser&user=" +str;
					 //var jsonUrl='Functions/dropdown2.php';

                $.ajax({ // ajax call starts
                      url: jsonUrl, // JQuery loads allCoordinates.php
                      dataType: 'json', // Choosing a JSON datatype
                      success: function(data) // Variable data contains the data we get from serverside
                      {
                          
						  for (i = 0; i < data.length; i++) {
						    
						    var username=str;	
                            bounds.extend(new google.maps.LatLng(data[i].lat, data[i].lon));

                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data[i].lat, data[i].lon),
                                map: map
                                //icon: 'http://maps.google.com/mapfiles/ms/icons/red.png'
                            });
							infostr=data[i].date;
							username=infostr;
                            google.maps.event.addListener(marker, 'click', (function(marker,username) {
                                return function() {
                                    infowindow.setContent(username);
                                    infowindow.open(map, marker);
                                }
                            })(marker,username));

                            markers.push(marker);
                          }
                          // Fit these bounds to the map
                          map.fitBounds(bounds);

                        
                      }
                });
                return false; // keeps the page from not refreshing 
            });
			
			
        });

    </script>
    <style>
      html, body, #map {
        height: 95%;
        margin: 2px;
        padding: 2px;
		width:99%;
      }
	  
    </style>	
	
</head>

<body>
    <div class="container">
        <div id="filters_container">
                <fieldset>
                    <legend>Zona</legend>
                  
					<form id="submitForm" action="dr.php" method='post'>
						<select id="user" name=username onchange="showUser(this.value)">
						<option value="">undefined</option>
						<?php
						while($row = mysql_fetch_array($rs)){
						echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
						}mysql_free_result($rs);
						?>
						</select>
						<input type="submit" name="Search"  value="Search" onClick='getValue()'/>

					</form>
					
                </fieldset>

        </div>
        <div id="map"></div>
    </div>
  

</body>
</html>