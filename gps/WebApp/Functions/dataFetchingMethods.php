<?php

    include_once("DBInteractor.php");
    
    function getCurrentLocation()
    {
        // $strQuery = 'select lat,lon,recorded_time from current_location where id = 1520';
        $strQuery = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_time from current_location order by id desc limit 1";
        $resId = executeQuery($strQuery);
        if($resId)
        {
            $data = getRecordsArray($resId);        
            return json_encode(array('user'=>$data["username"],'lat'=>$data["lat"],'lon'=>$data["lon"],'time'=>$data["recorded_time"]));
        }
    }
	

	 function getLastLocation()
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time 
				from current_location where (username,id) in (
				select username, max(id) as id
				from current_location
				group by username
			)" ;
        
        $resId = executeQuery($str);
        if($resId)
        {
            $arr = array();
            $i = 0;
            while($data = getRecordsArray($resId))
            {
                $arr[$i] = array('user'=>$data["username"],'lat'=>$data["lat"], 'lon'=>$data["lon"],
                    'date'=>$data["recorded_date"], 'time'=>$data["recorded_time"]);
                $i++;
            }
            
            return json_encode($arr);
        }        
    }

	
	
	
    function getLocationByDate($date)
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time from current_location where STR_TO_DATE(recorded_datetime,'%Y-%m-%d')= '".$date.
                "' order by id";
        
        $resId = executeQuery($str);
        if($resId)
        {
            $arr = array();
            $i = 0;
            while($data = getRecordsArray($resId))
            {
                $arr[$i] = array('user'=>$data["username"],'lat'=>$data["lat"], 'lon'=>$data["lon"],
                    'date'=>$data["recorded_date"], 'time'=>$data["recorded_time"]);
                $i++;
            }
            
            return json_encode($arr);
        }        
    }
	
	
	function getLocationByUser($user)
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time from current_location 
				WHERE username LIKE '".$user."' order by id";
        
        $resId = executeQuery($str);
        if($resId)
        {
            $arr = array();
            $i = 0;
            while($data = getRecordsArray($resId))
            {
                $arr[$i] = array('user'=>$data["username"],'lat'=>$data["lat"], 'lon'=>$data["lon"],
                    'date'=>$data["recorded_date"], 'time'=>$data["recorded_time"]);
                $i++;
            }
            
            return json_encode($arr);
        }        
    }
	
	function getLocationByMulti($date,$user)
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time from current_location 
				WHERE username LIKE '".$user."' and STR_TO_DATE(recorded_datetime,'%Y-%m-%d')= '".$date."' order by id";
        
        $resId = executeQuery($str);
        if($resId)
        {
            $arr = array();
            $i = 0;
            while($data = getRecordsArray($resId))
            {
                $arr[$i] = array('user'=>$data["username"],'lat'=>$data["lat"], 'lon'=>$data["lon"],
                    'date'=>$data["recorded_date"], 'time'=>$data["recorded_time"]);
                $i++;
            }
            
            return json_encode($arr);
        }        
    }
	
	
	
	
?>
