
<!DOCTYPE html>
<html class=" js cssanimations csstransitions"><head>
	<title>Customer Dashboard</title>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<link href="css/font-awesome.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/user-dashboard.js"></script>

	<!-- Web-Fonts -->
		<link href='//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<!-- //Web-Fonts -->
    <style>
	.address-list{width: 30%;float: right;height: 690px;overflow-y: auto;} @media (max-width: 1200px) {.address-list{width: 30%;float: left;height: 1000px;overflow-y: auto;}}
	</style>
	<?php
	include 'header.php';
	?>
</head>

<body>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="../index.php" class="brand">
                        <img src="../images/logoIcon.png" width="240" height="80" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="customer.php">Dashboard</a></li>
                            <li class="active"><a href="find_location.php">Find Location</a></li>
                            <li><a href="customer_profile.php">Profile</a></li>
                            <li><a href="../index.php">Logout</a></li>                           
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        
        <br><br>
        
        <div class="container">
			<div class="row">        

               <div align = "right">
                
                <?php
                    require '../config.php';

                    $query = "SELECT id , businesssector FROM businesssector;";
                    $result = $mysqli->query($query); 
                    $show_select = "Filter Results for &nbsp;&nbsp;&nbsp;<select name='businessCategory' onChange = 'selectedSector(this.value);'>";
                    $show_select = $show_select . "<option value='all'>All</option>";
                    
                    while($row = mysqli_fetch_array($result)){
                        $show_select = $show_select . "<option value='".$row['id']."'>".$row['businesssector']."</option>";              
                    }
                    $show_select = $show_select . "</select><br><br>";
                    echo $show_select; 
                ?>
                
                </div> 
               
               <div id="error"></div>
               
                <div class="col-md-8">
                    <div id="map" style="float:left;margin-right: 20px;margin-bottom: 20px;"></div>
                </div>
                
                <div class="col-md-4 address-list">
                	<div id="details_div"></div>
            	</div>
			</div>
        </div>                 
           
    <script type="text/javascript">

        var businesssector_id = '';
        function selectedSector(selected_value){
            businesssector_id = selected_value;  
            initMap();          
        }

        function initMap(){
            
            //Find user location
            var x = document.getElementById("error");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(userPosition, showError);
            } 
            else 
            { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

            function userPosition(position) {
                var user_lat = position.coords.latitude;
                var user_lon = position.coords.longitude;
                var user_latlon = new google.maps.LatLng(user_lat, user_lon)

                //Show map
                var options = {
                    zoom:14,
                    center:user_latlon
                }
                var map = document.getElementById('map')
                map.style.height = '700px';
                map.style.width = '790px';
                
                //Center with user Location and place a marker on his position
                var map = new google.maps.Map(document.getElementById('map'),options);
                var marker = new google.maps.Marker({animation: google.maps.Animation.DROP,position:user_latlon,map:map,label:{text:"You",color:"#ffffff",fontWeight: "bold"}});
                
                // Ajax Call to read locations from DB
                $.ajax({
                    url: "read_address.php", 
                    method: "POST", 
                    data: { user_lat:user_lat,user_lon:user_lon,businesssector_id:businesssector_id},
                    success: function(data){
                        //alert (data)
                        var obj = JSON.parse(data);
						var detail="";
						// For every row build a marker.
						for (var key in obj) {
						  if (obj.hasOwnProperty(key)) {
							var val = obj[key];
							
							var latlng = new google.maps.LatLng(val[1], val[2]);
							var storeMarker = new google.maps.Marker({position:latlng,map:map,label:{text:val[0].toString(),color:"#FFF",fontWeight: "bold"}});							
						
							detail+="<div style='font-size:18px;'>"+val[0]+". "+val[3]+"&nbsp;&nbsp;&nbsp;&nbsp;<span class='pull-right' style='font-size:14px;'>"+val[6]+" Miles</span></div><div style='font-size: 14px;margin: 5px 1px;'><i class='fa fa-map-marker' style='font-size: 17px;color: #006dcc;'></i>  "+val[4]+"<div style='margin: 5px 1px;'><i class='fa fa-phone' style='font-size: 17px;color: #006dcc;'></i>  "+ val[5]+"</div><div><a class='btn btn-primary btn-xs' target='_blank' href='https://www.google.com/maps/dir/"+user_lat+","+user_lon+"/"+val[1]+","+val[2]+"'style='padding: 0px 5px;font-size: 12px;'>Get Direction</a></div><hr>";	
						  }
						}   
						$('#details_div').html(detail);
                    },
                    error: function() {
                        x.innerHTML = "Error occured. Unable to make a Ajax call."
						//Add bootstrap to display error on page
                    } 
                });
                                
            }

            //If error occurs
            function showError(error) {

                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        x.innerHTML = "User denied the request for Geolocation."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        x.innerHTML = "Location information is unavailable."
                        break;
                    case error.TIMEOUT:
                        x.innerHTML = "The request to get user location timed out."
                        break;
                    case error.UNKNOWN_ERROR:
                        x.innerHTML = "An unknown error occurred."
                        break;
                }
            }
        }
    </script>
     
        <br><br><br>  

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0qpryTItej9VssEJCtYPwddIIjdtqwu8&callback=initMap"
    async defer></script>   

    <!-- js-scripts -->
    <!-- js -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- tabs -->
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true   // 100% fit in a container
            });
        });
    </script>  
    
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="../js/modernizr.custom.js"></script>
        <script type="text/javascript" src="../js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="../js/jquery.cslider.js"></script>
        <script type="text/javascript" src="../js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="../js/jquery.inview.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmIHbU9xj413vxhL-oJHz8ybTyF60KQ&callback=initializeMap"></script>


        <!-- <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script> -->
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../js/app.js"></script>           
    
        <div class="footer">
            <p style="color: white;">Treaty.com © copyright 2018</p>
        </div>    
    
</body>
</html>