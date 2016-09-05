<html>
   <head>
      <title>GeoLog</title>
      
      <style>
         *{
            font: normal 12px 'Segoe UI';
         }
         
         table{
            border: 1px solid lightgray;
            border-spacing: 0px;
         }
         
         th{
            font-weight: bold;
            background-color:#DDD;
            padding: 0 10px 0 10px;
         }
         
         td{
            border: 1px solid lightgray;
            padding: 6px;
         }
      </style>
   </head>


   <body>

      <table>
         <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Lat.</th>
            <th>Long.</th>
            <th>Device</th>
            <th>Annotations</th>
            <th>Map</th>
         </tr>
         
         <?php

         $mysqli = new mysqli('sql303.byethost6.com', 'b6_16388729', '1qhs6rkz', 'b6_16388729_db');
          if ($mysqli->connect_errno) {
             echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
             exit();
          }

          $query = "SELECT * FROM current_location ORDER BY id";
          $result = $mysqli->query($query);
          
          while($row = $result->fetch_array()){ ?>
          
             <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['recorded_datetime'];?></td>
                <td><?php echo $row['lat'];?></td>
                <td><?php echo $row['lon'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['Annotation'];?></td>
                <td>[<a href="map.php?lt=<?php echo $row['lat'];?>&ln=<?php echo $row['lon'];?>&d=<?php echo $row['username'];?>&n=<?php echo $row['Annotation'];?>">Link</a>]</td>
             </tr>
          <?php }

          $result->close();
          $mysqli->close();
         ?>
   
   </body>
</html>