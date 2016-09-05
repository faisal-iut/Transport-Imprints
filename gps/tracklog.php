<?php

    include_once("Functions/DBInteractor.php");
    include_once("main_home.php");

    
    $sql = "SELECT username FROM blog_users";
    $rs = mysql_query($sql) or die(mysql_error());
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Google Maps Demo</title>
	
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.dynatable.js"></script>
 	
  	<link type="text/css" href="css/jquery.dynatable.css" rel="stylesheet" />
 

    <script type="text/javascript">

        $(document).ready(function(){
		

				var jsonUrl = "Functions/getLatLon.php?action=getLocationAll";
				var dat=[];
							$.ajax({
							  url: jsonUrl,
							  dataType: 'json',
							  success: function(data){
							    
								 for (var i = 0; i < data.length; i++) {
                                       data[i].link = '<a href="map.php?lt='+data[i].lat+'&ln='+data[i].lon+'">Map</a>';
										   //alert(data[i].link);
                                            }
								
								var dynatable = $('#my-final-table').dynatable({
								  dataset: {
									records: data
								  }
								  
								  

								  
								 
								  
								}).data('dynatable');;
								

																$('#user').change( function() {
																
											  var value = $(this).val();
											  if (value === "") {
												dynatable.queries.remove("user");
											  } else {
												dynatable.queries.add("user",value);
											  }
											  dynatable.process();
											  
											  
											});
											
									$('#info').click(function(){
									
									domColumns.removeFromTable('col1');
									
									
									});
											
								
								
								

								
							  }
							});
							
				
							



				
			
				
			
        });

    </script>
	
	
</head>
<style>

</style>


<body>
</br>
<div style="margin-top:-200px;">

<h1>&darr; TRACKLOG &darr;</h1>
</br>
<select id="user" name=username onchange="showUser(this.value)" style="font-size:16px">
						<option value="">All</option>
						<?php
						while($row = mysql_fetch_array($rs)){
						echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
						}mysql_free_result($rs);
						?>
						</select>


<table class="blue" >
<table id="my-final-table" style="font-size:16px">

 <thead>
 <tr>
     <th>Id</th>
    <th>user</th>
    <th>lat</th>
	<th>lon</th>
	<th>date</th>
	<th>link</th>
 </tr>
  </thead>
  
 
  <tbody>
 
  
  </tbody>
</table></table>

</div>

</body>
</html>	