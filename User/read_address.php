
<?php
    
    session_start();        
    require "../config.php";

    $user_lat = number_format(($_REQUEST['user_lat']),6);
    $user_lon = number_format(($_REQUEST['user_lon']),6);
    $businesssector_id = $_REQUEST['businesssector_id'];
    
       
    // Calculate the distance between user location and all businesses.
    if ( $businesssector_id == "" or $businesssector_id == "all" ){
    	$query = "SELECT id,businessname,businesssector,address1,address2,city,state,country,zipcode,phonenumber,latitude,longitude,isactive, round(( 3959 * acos( cos( radians(".$user_lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$user_lon.") ) + sin( radians(".$user_lat.") ) * sin( radians( latitude ) ) ) ),1) AS distance FROM treaty.businessdetail HAVING distance < 8 ORDER BY distance LIMIT 0 , 20;";    
	}
	else{
		$query = "SELECT id,businessname,businesssector,address1,address2,city,state,country,zipcode,phonenumber,latitude,longitude,isactive, round(( 3959 * acos( cos( radians(".$user_lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$user_lon.") ) + sin( radians(".$user_lat.") ) * sin( radians( latitude ) ) ) ),1) AS distance FROM treaty.businessdetail WHERE businesssector =" . $businesssector_id . " HAVING distance < 8 ORDER BY distance LIMIT 0 , 20;";
	}
     
    $result = $mysqli->query($query);       
    $markers=array();
    $tagCount=0;
    while($row = mysqli_fetch_array($result)){

        if($row['address2'] == ""){
            $full_address = $row['address1'] . "," . $row['city'] .",". $row['state'] .",". $row['country'] ." ". $row['zipcode'];
        }
        else{
            $full_address = $row['address1'].",".$row['address2'].",".$row['city'].",".$row['state'].",".$row['country']." ".$row['zipcode'];
        }
        $tempArray=array();
        
        //Build a array with all info
        array_push($tempArray,++$tagCount);
        array_push($tempArray,$row['latitude']);
        array_push($tempArray,$row['longitude']);
        array_push($tempArray,$row['businessname']);
        array_push($tempArray,$full_address);
        array_push($tempArray,$row['phonenumber']);
        array_push($tempArray,$row['distance']);
        array_push($markers, $tempArray);
    }
    //Build a Json object
    $makersObject = (object) $markers;
    $markerJson = json_encode($makersObject);

    echo $markerJson; 
?>