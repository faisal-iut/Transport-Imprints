<?php
    
    include 'dataFetchingMethods.php';
    
    if(isset($_GET['action']) && !empty($_GET['action'])) 
    {
        $action = $_GET['action'];        
        switch ($action){
            case 'getCurrentLocation':
                echo getCurrentLocation();
                break;
			case 'getLastLocation':
                echo getLastLocation($_GET['cat']);
                break;
				
            case 'getLocationByDate':                   
                echo getLocationByDate($_GET['date']);
                break;
			case 'getLocationByUser':                   
                echo getLocationByUser($_GET['user']);
                break;
			case 'getLocationByUserLast':                   
                echo getLocationByUserLast($_GET['user']);
                break;	
			case 'getLocationByMulti':                   
                echo getLocationByMulti($_GET['date'],$_GET['user']);
                break;
			case 'getLocationAll':                   
                echo getLocationAll();
                break;
            default:
                break;
        }
    }      
?>