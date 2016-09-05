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
	

	 function getLastLocation($cat)
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time 
				from current_location where (username,id) in (
				select username, max(id) as id 
				from current_location WHERE username LIKE '%".$cat."%'
				group by username
			)" ;
		 /*$str = "select current_location.username as username,current_location.lat as lat, current_location.lon as lon, date_format(current_location.recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(current_location.recorded_datetime, '%h:%i:%s %p') as recorded_time
				from current_location inner join blog_users 
				on current_location.username=blog_users.username and blog_users.groupname like '".$cat."' order by id ";	
			*/
			
		/*$str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time from current_location 
				WHERE username LIKE '".$cat."' order by id";	*/
        
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
	
    function getLocationAll()
    {
        $str = "select id,username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i:%s %p') as recorded_date
               from current_location order by id desc";
        
        $resId = executeQuery($str);
        if($resId)
        {
            $arr = array();
            $i = 0;
            while($data = getRecordsArray($resId))
            {
                $arr[$i] = array('id'=>$data["id"],'user'=>$data["username"],'lat'=>$data["lat"], 'lon'=>$data["lon"],'link'=>"ss",
                    'date'=>$data["recorded_date"]);
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
	
	function getLocationByUserLast($user)
    {
        $str = "select username,lat, lon, date_format(recorded_datetime, '%M %d %Y %h:%i %p') as recorded_date,
                date_format(recorded_datetime, '%h:%i:%s %p') as recorded_time from current_location 
				where id=(select max(id) from current_location where username like '".$user."') ";
        
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