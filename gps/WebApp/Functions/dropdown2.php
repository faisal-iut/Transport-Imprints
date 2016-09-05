<?php

    include_once("DBInteractor.php");

    
    
	?>

	
	<?php
   
	$sql1 = 'SELECT * FROM current_location ';
        $result = mysql_query($sql1);
		$r=mysql_num_rows($result);
	

        if (mysql_num_rows($result) > 0) 
            {
                 $locations = array();
                $i = 0;
				
				while($row = mysql_fetch_array($result)) 
                    {
                        $locations[$i] = array('username' => $row['username'],'lat' => $row['lat'],'lon' => $row['lon'],'time' => $row['recorded_datetime']);
						$i++;
                    }
				echo json_encode($locations);
	
    }
	
	
	
    ?>