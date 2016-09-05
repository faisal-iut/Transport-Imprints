<?php

    include_once("Functions/DBInteractor.php");

    
    $sql = "SELECT distinct(groupname) FROM blog_users where catagory like 'bus'";
    $rs = mysql_query($sql) or die(mysql_error());
	
	$sql1 = "SELECT distinct(groupname) FROM blog_users where catagory like 'train'";
    $rs1 = mysql_query($sql1) or die(mysql_error());
	
	$sql2 = "SELECT username FROM blog_users order by username asc ";
    $rs2 = mysql_query($sql2) or die(mysql_error());
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<meta name="viewport" content="width=device-width,user-scalable=no" />
    <script type="text/javascript">

        $(document).ready(function(){
		
		    var coordinates, parsedCoordinates;
            var map;
            var marker;
			var infostr;
			var username;
            var markers = [];
			var data = [];
			var record = [];
            var bounds = new google.maps.LatLngBounds();
            var coords = new google.maps.LatLng(23.2778, 90.77777);
            var infowindow = new google.maps.InfoWindow();
            var st;
			var baseUrl = "Functions/getLatLon.php";
			map_initialize(); // load map

            function map_initialize(){
				
				//alert("Hel");
				                //Google map option
                var googleMapOptions = 
                {
                    center: coords,
                    zoom: 13, //zoom level, 0 = earth view to higher value
                    panControl: true, //enable pan Control
                    zoomControl: true, //enable zoom control
					
					
                    scaleControl: true, // enable scale control
                    mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
                };

                map = new google.maps.Map(document.getElementById("map"), googleMapOptions);
                //  Fit these bounds to the map
                map.fitBounds(bounds);

				//relodeFunction();

            }
			
			 $("#busgroup").on('change',function(){
			
					
					var e1 = document.getElementById("traingroup");
					e1.value='train';
					var e2 = document.getElementById("user");
					e2.value='user';
					
			  
				latestFunc();
			});
			
			$("#traingroup").on('change',function(){
			
					
					var e = document.getElementById("busgroup");
					e.value='bus';
					var e2 = document.getElementById("user");
					e2.value='user';
					
			  
				latestFunc();
			});
			
			$('#user').on('change', function(){
			
					
					var e = document.getElementById("busgroup");
					e.value='bus';
					var e1 = document.getElementById("traingroup");
					e1.value='train';
					
				
			  
				latestFunc();
			});
			
							

            setInterval(function latestFunc(){ // This event fires when a button is clicked
                     
					
					var e = document.getElementById("busgroup");
					var str = e.options[e.selectedIndex].text;
					
					var e1 = document.getElementById("traingroup");
					var str1 = e1.options[e1.selectedIndex].text;
					
					var e2 = document.getElementById("user");
					var str2 = e2.options[e2.selectedIndex].text;
					//alert(str2);
					st=str+str1;
					//alert(st);
					
					 
					if(str!='BUS')
					{
						st=str;
					}
					else if(str1!='TRAIN')
					{
						
						st=str1;
					
					}
					//alert(st);

					while(markers[0])
						{
						  markers.pop().setMap(null);
						}
					    //alert(st);  
						  
						 // map.clearOverlays();
						  //setMapOnAll(null);
						  
					if(str=='BUS'&&str1=='TRAIN') 
					{
					   var jsonUrl = 'Functions/getLatLon.php?action=getLocationByUserLast&user='+str2;
					   
					}
					else
					{
						
							var jsonUrl = 'Functions/getLatLon.php?action=getLastLocation&cat='+st;
					
					}
					 //var jsonUrl='Functions/dropdown2.php';

                $.ajax({ // ajax call starts
                      url: jsonUrl, // JQuery loads allCoordinates.php
                      dataType: 'json', // Choosing a JSON datatype
                      success: function(data) // Variable data contains the data we get from serverside
                      {
                          
						  for (i = 0; i < data.length; i++) {
						    //alert(data[i].lat);
						    
                            bounds.extend(new google.maps.LatLng(data[i].lat, data[i].lon));

                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data[i].lat, data[i].lon),
                                map: map
                                //icon: 'http://maps.google.com/mapfiles/ms/icons/red.png'
                            });
							//marker.setTitle('new title');
							infostr=data[i].date;
							//username= "<p>" + data[i].user + "<br />" +data[i].date + "</p>";
							username=data[i].user+":"+data[i].date;
                           // google.maps.event.addListener(marker, 'click', (function(marker,username) {
                             //   return function() {
                                    //infowindow.setContent(username);
                                    //infowindow.close(map, marker);
									 
									
                               // }
                            //})(marker,username));
							
							 var infowindow2 = new google.maps.InfoWindow({
													  content: username
												  });
												  infowindow2.open(map, marker);


                            markers.push(marker);
                          }
                          // Fit these bounds to the map
                          map.fitBounds(bounds);

                        
                      }
                });
                return false; // keeps the page from not refreshing 

            }, 5000);
			
			
        });

    </script>
    <style>
      html, body{
        height: 99%;
        
     
		width:99%;
      }
	  #map {
	  
        height: 80%;
        margin-left:20px;
		width:99%;
      }
	  
    </style>	
	
</head>

<body>



<form id="submitForm" action="" method='post' style="margin-left:420px;margin-top:-78px ">
						<select id="busgroup" name=username onchange="relodeFunction(this.value)" style="width: 170px;font-size:20px;background:#41E391">
						<option value="bus">BUS</option>
						<?php
						while($row = mysql_fetch_array($rs)){
						echo "<option value='".$row["groupname"]."'>".$row["groupname"]."</option>";
						
						}mysql_free_result($rs);
						?>
						</select>

					</form>
					<br/>
					<br/>
					<form id="submitForm1" action="" method='post' style="margin-left:620px;margin-top:-57px">
					<select id="traingroup" name=username onchange="relodeFunction(this.value)" style="width: 170px;font-size:20px;background:#41E391">
						<option value="train">TRAIN</option>
						<?php
						while($row = mysql_fetch_array($rs1)){
						echo "<option value='".$row["groupname"]."'>".$row["groupname"]."</option>";
						}mysql_free_result($rs1);
						?>
						</select>

					</form>
					<br/>
					<br/>
				<form id="submitForm2" action="" method='post' style="margin-left:230px;margin-top:-60px ">
					<select id="user" name=username onchange="relodeFunction(this.value)" style="width: 170px;font-size:20px;background:#41E391">
						<option value="user">USER</option>
						<?php
						while($row = mysql_fetch_array($rs2)){
						echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
						}mysql_free_result($rs2);
						?>
						</select>

					</form>

	<br/>
	<br/>
	<br/>
        <div id="map"></div>



</body>
</html>