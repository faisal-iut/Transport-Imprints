<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

    include_once("Functions/DBInteractor.php");
    include_once("main_home.php");

    
    $sql = "SELECT username FROM blog_users";
    $rs = mysql_query($sql) or die(mysql_error());
	?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAQo3Z34xa-XpPgSnedfvDvhSRbwlFkjvaX2DEjohWzWeLWFX8PxRCppfcsK8Y56qDrYquk-NU_oAing"></script>
	<link type="text/css" href="css/redmond/jquery-ui-1.8.12.custom.css" rel="stylesheet" />	
  <script type="text/javascript" src="js/jquery-ui.js"></script>

	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		google.load("maps", "2.x");
	</script>
		<script type="text/javascript">
			$(function(){
					var user='all';
					var date = new Date();
					var currentMonth = date.getMonth();
					var currentDate = date.getDate();
					var currentYear = date.getFullYear();
					var baseUrl = "Functions/getLatLon.php";
					var dateFormat = 'yy-mm-dd';
					var map, marker, timerId;
					var markers = [];
					var records = [];
					var index = -1;                            
					map = new GMap2(document.getElementById('mapDiv'));					
					map.addControl(new GMapTypeControl());
					map.addControl(new GLargeMapControl3D());
					var center = new GLatLng(23.7804, 90.404);
					map.setCenter(center, 10);
					$.ajaxSetup({cache: false});
					$( "#datepicker" ).datepicker({
						maxDate : new Date(currentYear, currentMonth, currentDate),
						onSelect: function(dateText, inst){                                    
							// clear any #message div as well
							$("#message").hide();
							// stop if timer is running 
							 if (timerId != null){
								clearInterval(timerId);                                            
							}
							
							if ($( "#play" ).text() == "Pause"){
								$("#play").click();
																	 
							}
							//alert(user);
							// loading new locations.
							if(user=="all")
							{
								var jsonUrl = baseUrl + "?action=getLocationByDate&date=" + dateText;
							}
							
							if(user!="all")
							{
							var jsonUrl = baseUrl + "?action=getLocationByMulti&date="+dateText+"&user="+user;
							}
							$.getJSON(jsonUrl, function(json){                                        
								map.clearOverlays();                                        
								timerId = null;
								markers = [];
								records = [];
								//var markerBounds = new GLatLngBounds();
								index = -1;
								$.each(json, function(key, value){                                          
								  var point = new GLatLng(value.lat, value.lon);                                          
								  marker = new GMarker(point);
								  map.addOverlay(marker);
								  markers[key] = marker;
								  records[key] = value;
								  //markerBounds.extend(marker);
								});
								//map.setCenter(markerBounds.getCenter(), 
								//map.getBoundsZoomLevel(markerBounds));
								if (markers.length == 0){                                            
									$("#dialog-message").text("No Gps Trace is recorded for "+ dateText +
									". Please try again. For example, May,15,2011 has a number of GPS traces."); 
									$( "#dialog-message" ).dialog('open');                
								}
								else{
									$(markers).each(function(i,marker){
									GEvent.addListener(marker, "click", function(){
											displayPointAndUpdateIndex(marker, records[i], i);											
									});
								  });
								}                                        
							})
						}});
					$("#dialog-message").dialog({
						autoOpen: false,
						modal: true,
						resizable: false,
						buttons: {
							Ok: function(){
								$(this).dialog("close");
							}
						}
					});
					
					$("#dialog-help").dialog({
						autoOpen: false,
						width: 500,
						modal: true,                                
						buttons: {
							Ok: function(){
								$(this).dialog("close");
							}
						}
					});
					
					$( "#datepicker" ).datepicker("option", "dateFormat",dateFormat);                            
					$("#message").appendTo(map.getPane(G_MAP_FLOAT_SHADOW_PANE));					
					$( "#info" ).button({
						text:false,
						lable: "How to play",
						icons: {
							primary: "ui-icon-lightbulb"
						}
					})
					.click(function(){
						$("#dialog-help").dialog('open');
					})
					$( "#beginning" ).button({
							text: false,
							label: "First trace",
							icons: {
									primary: "ui-icon-seek-start"
							}
					})
					.click(function(){
					if (markers.length > 0)
						{
							index = 0;
							displayPoint(markers[index], records[index]);
						}
					});                           
					$( "#previous" ).button({
							text: false,
							label: "Previous trace",
							icons: {
									//primary: "ui-icon-seek-prev"
									primary: "ui-icon-triangle-1-w"
							}
					})
					.click(function(){
						if (markers.length > 0)
							{
								if (index <= 0)
										{
											return;
										}
										index = index - 1;
									displayPoint(markers[index], records[index]);                                            
							}});
					$( "#play" ).button({
							text: false,
							icons: {
									primary: "ui-icon-play"
							}
					})
					.click(function() {
							var options;
							if ( $( this ).text() == "Play" ) {
									options = {
											label: "Pause",
											icons: {
													primary: "ui-icon-pause"
											}
									};
									$( this ).button( "option", options );
									
									timerId = setInterval(function(){                                                
										if(markers.length > 0){                                                        
												$('#forward').click();
												if (index == markers.length - 1){                                                            
													clearInterval(timerId);
													timerId = null;
													var option = {
														label:"Play",
														icons: {
															primary: "ui-icon-play"
														}
													};                                                            
													$("#play").button( "option", option );
												}
											}                                            
										}, 3000);
									} else {
									options = {
											label: "Play",
											icons: {
													primary: "ui-icon-play"
											}
									};
									clearInterval(timerId);
									timerId = null;
									$( this ).button( "option", options );
							}
							
					});
					$( "#forward" ).button({
							text: false,
							label: "Next trace",
							icons: {
									// primary: "ui-icon-seek-next"
									primary: "ui-icon-triangle-1-e"
							}
					})
					.click(function(){
						if (markers.length > 0)
							{
								if (index >= markers.length - 1)
										{
											return;
										}
									index++;
									displayPoint(markers[index], records[index]);
									
							}});
					$( "#end" ).button({
							text: false,
							label: "Last trace",
							icons: {
									primary: "ui-icon-seek-end"
							}
					})
					.click(function(){
						if (markers.length > 0)
							{
								index = markers.length - 1;
								displayPoint(markers[index], records[index]);                                        
							}
					});
						$("#user").change(function () {
						var end = this.value;
						user=end;
					});
					
					function displayPointAndUpdateIndex(marker, record, i){
						index = i;
						displayPoint(marker, record);
					}

					function displayPoint(marker, record){
					  map.panTo(marker.getPoint());
					  var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());
					  $("#message").show().css({ top:markerOffset.y, left:markerOffset.x }).html(record.user).append("   ").append(record.time); 
					}	 

	
			});
	</script>
	<style>
		#toolbar {
				
				
		}
		#message { position:absolute; padding:10px; background:#555; color:#fff; width:75px; font-size: 13px; }
	</style>
</head>
<body>
<br/>
	<div style="text-align: center; margin-top:-200px"  >
		<span id="toolbar"  >
			Date: <input id="datepicker" type="text"></input>
			<button id="beginning">First trace</button>
			<button id="previous">Previous trace</button>
			<button id="play">Play</button>
			<!--<button id="stop">stop</button>-->
			<button id="forward">Next</button>
			<button id="end">Last Trace</button>
			<button id="info">How to use</button>
			
		</span>  
	</div>
	<form id="submitForm" action="" method='post' style="margin-left:200px;margin-top:-35px ">
						<select id="user" name=username onchange="showUser(this.value)" style="width: 175px;font-size:25px">
						<option value="all">All</option>
						<?php
						while($row = mysql_fetch_array($rs)){
						echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
						}mysql_free_result($rs);
						?>
						</select>

					</form>
					<br/>
					<br/>
	
	<div id ="mapDiv" style=" text-align: center;  width:1320px; height:550px;">
	</div>
	<div id="message" style="display:none;">
    </div>
</body>
</html>
