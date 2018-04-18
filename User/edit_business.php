<?php
	// Start the session
	session_start();
?>
<!DOCTYPE html>
<html class=" js cssanimations csstransitions">
	<head>
		<title>Business Dashboard</title>

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link rel="shortcut icon" href="../images/favicon.ico">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

		<link href="css/font-awesome.css" rel="stylesheet">
	    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
	    <link rel="stylesheet" href="css/user-dashboard.css" type="text/css" media="all" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/user-dashboard.js"></script>

		<!-- Web-Fonts -->
			<link href='//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
			<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<!-- //Web-Fonts -->

		<!-- Script for image display after selection -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript">
			function displayImage(input) {
	    		if (input.files && input.files[0]) {
	        	var reader = new FileReader();
	        	reader.onload = function (e) {
	        	$('#image').attr('src', e.target.result);
	       		}
	        reader.readAsDataURL(input.files[0]);
	       }
	    }
		</script>
		<!-- Script for image display after selection -->
		
		<?php include 'header.php'; ?>
        <style>
		.agile_form textarea {
			padding: 0.5em 1em;
			color: #000;
			width: 90.1%;
			font-size: 13px;
			outline: none;
			border: 1px solid #ccc;
			border-radius: 3px;
			letter-spacing: 1px;
			-webkit-appearance: none;
			margin: 5px;
		}		
		</style>
	</head>
		<?php 

			require '../config.php';
			$businessid = $_GET["businessid"];
			
			if (isset($_POST['businessname'])) {
                $businessname = $_POST['businessname'];
            }
            if (isset($_SESSION['userid'])) {
                $userid = $_SESSION['userid'];
            }
            if (isset($_POST['address1'])) {
                $address1 = $_POST['address1'];
            }
            if (isset($_POST['address2'])) {
                $address2 = $_POST['address2'];
            }
            if (isset($_POST['city'])) {
                $city = $_POST['city'];
            }
            if (isset($_POST['state'])) {
                $state = $_POST['state'];
            }
            if (isset($_POST['country'])) {
                $country = $_POST['country'];
            }
            if (isset($_POST['zipcode'])) {
                $zipcode = $_POST['zipcode'];
            }
            if (isset($_POST['businessphonenumber'])) {
                $businessphonenumber = $_POST['businessphonenumber'];
            }
            if (isset($_POST['businessdescription'])) {
                $businessdescription = $_POST['businessdescription'];
            }
			if (isset($_POST['cancel'])) {
				$cancel = $_POST['cancel'];
			}
			if (isset($_POST['delete'])) {
				$delete = $_POST['delete'];
			}
			if(!empty($delete)) {
				$query = "UPDATE businessdetail
						 SET isactive=0 
						 WHERE id=".$businessid;
				print $query;
				$result = $mysqli->query($query);
	            if ($result) {
	                echo '<script>window.location.href = "business.php#horizontalTab3";</script>';
	            } else {
	                echo "Failed to delete profile";
	            }
			} else if(!empty($cancel)) {
				echo '<script>window.location.href = "business.php#horizontalTab3";</script>';
			} else if(!empty($businessname)) {
				//Find Lon and Lat of the adrress.
				if($address2 == ''){
					$complete_business_address = $address1.",".$city.",".$state.",".$country.",".$zipcode;					
				}			
				else{
					$complete_business_address = $address1.",".$address2.",".$city.",".$state.",".$country.",".$zipcode;					
				}			
				
				$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($complete_business_address)."&key=AIzaSyD1-5rKx9dW1LUrOwXnrI8_cF3PTcLdaHY";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);
				if (isset($response_a->status) && ($response_a->status == 'OK')) {
					$latitude = number_format($response_a->results[0]->geometry->location->lat,6);
					$longitude = number_format($response_a->results[0]->geometry->location->lng,6);					
				}
				else{
					echo '<script>alert("Please Check your address. Enter valid address.");</script>';	
					$latitude = 0;
				    $longitude = 0;
				}
				
				//Check if Image file has been changed: Y Update table with Image. N Update table without Image.
				if($_FILES['image']['error'] == 0){
					$filename = addslashes($_FILES["image"]["name"]);
					$tmp_name = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
					$file_type = addslashes($_FILES["image"]["type"]);
					$ext_array = array('jpg','jpeg','png');
					$ext = pathinfo($filename,PATHINFO_EXTENSION);
					if(in_array($ext,$ext_array)){
						$query = "UPDATE businessdetail
						 SET address1=\"".$address1."\", address2=\"".$address2."\", city=\"".$city."\", state=\"".$state."\", zipcode=\"".$zipcode."\", businessimage=\"".$tmp_name."\",latitude=".$latitude.",longitude=".$longitude.", modified=sysdate() 
						 WHERE id=".$businessid;
					} else {
						echo 'Only JPEG and PNG Images can be uploaded';
					}
				} else {
					$query = "UPDATE businessdetail
						 SET address1=\"".$address1."\", address2=\"".$address2."\", city=\"".$city."\", state=\"".$state."\", zipcode=\"".$zipcode."\",businessphonenumber=\"".$businessphonenumber."\" ,latitude=".$latitude.",longitude=".$longitude.",businessdescription=\"".$businessdescription."\",modified=sysdate()
						 WHERE id=".$businessid;
				}

    			$result = $mysqli->query($query);
    			if ($result) {
    				//-------Added to solve email error-----
					$query = "SELECT email FROM user WHERE id=\"" . $userid . "\" and isactive=1";
					$result = $mysqli->query($query);
      				if ($result->num_rows > 0) {
      					$row = $result->fetch_array();
			    		$email = $row["email"];
			    	}
			    	//-------Added to solve email error end-----

					//send email
					$subject = "You have updated business details on Treaty!";
					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
												 <html xmlns="http://www.w3.org/1999/xhtml">
												 <head>
												 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
												 </head>
												 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding-top:5%; font-size: 20px;">
												 <img src="http://blog.tyang.org/wp-content/uploads/2010/09/update.jpg">
												 <div>
													 <p> You have updated your business details on Treaty!<br><br><br>
													 [If you have not taken this action. Please contact our customer care.]</p>
												 </div>
												 </body>
												 </html>';
					$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					if(mail($email, $subject, $message, $headers, "-f treatyrewards@gmail.com")) {
            			echo '<script>window.location.href = "business.php#horizontalTab3";</script>';
					}
    			}else {
        				echo "Failed to update profile";
    			}
        		
			} else if(!empty($businessid)) {
				$query = "SELECT a.businessname, a.address1, a.address2, a.city, a.state, a.country, a.zipcode,a.businessphonenumber, a.businessimage,a.businessdescription, b.businesssectortext FROM businessdetail as a JOIN businesssector as b ON a.businesssector = b.id WHERE a.id=".$businessid;
				$result = $mysqli->query($query);
				$businessresultset = array();
				if ($result->num_rows > 0) {
					$row = $result->fetch_array();
					array_push($businessresultset, $row["businessname"]);
					array_push($businessresultset, $row["businesssectortext"]);
					//array_push($businessresultset, $row["businesssector"]);
					array_push($businessresultset, $row["address1"]);
					array_push($businessresultset, $row["address2"]);
					array_push($businessresultset, $row["city"]);
					array_push($businessresultset, $row["state"]);
					array_push($businessresultset, $row["country"]);
					array_push($businessresultset, $row["zipcode"]);
					array_push($businessresultset, $row["businessphonenumber"]);
					array_push($businessresultset, base64_encode($row["businessimage"]));
					array_push($businessresultset, $row["businessdescription"]);
				}
			}
		?>
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
							<?php
                                //if(isset($_SESSION['displaydashboard'])){
                                    echo "<li class='active'><a href='business.php'>Dashboard</a></li>";
                                //}
                            ?> 
                            <!-- <li><a href="customer_list.php">Customers</a></li> -->                                                       
                            <li><a href="business_profile.php">Profile</a></li>
                            <li><a href="../logout.php">Logout</a></li>                           
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <br><br>
		<h1></h1>
		<div class="container">
			<div class="tab">
				<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
					<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#horizontalTab').easyResponsiveTabs({
								type: 'default', //Types: default, vertical, accordion
								width: 'auto', //auto or any width like 600px
								fit: true,   // 100% fit in a container
								closed: 'accordion', // Start closed if in accordion view
								activate: function(event) { // Callback function if tab is switched
									var $tab = $(this);
									var $info = $('#tabInfo');
									var $name = $('span', $info);
									$name.text($tab.text());
									$info.show();
								}
							});
						
							$('#verticalTab').easyResponsiveTabs({
								type: 'vertical',
								width: 'auto',
								fit: true
							});
						});					
						
						function editOffer(){
							alert('hi');
						}
						
						
					</script>
					<div class="tabs">
						<div class="tab-left">
							<ul class="resp-tabs-list" style="margin: 0px;">
								<li class="resp-tab-item-edit" onclick="loadScan();"><i class="fa fa-car" aria-hidden="true"></i>Edit</li>
								<li class="resp-tab-item-edit"><i class="fa fa-university" aria-hidden="true"></i>Delete</li>
							</ul>
						</div>
						<div class="tab-right">
							<div class="resp-tabs-container">
								<!-- Edit Business section -->
								<div class="tab-1 resp-tab-content">
									<p class="secHead">Edit Your Business</p>
									<div class="register agileits">
										
										<form method="post" class="agile_form" enctype="multipart/form-data" runat="server">
											<table style="width: 91.6%;">
                                        	<tr>
                                            	<td style="padding-left: 6px;">
                                            		<div style="width: 100px;height: 100px;border: 1px solid #ccc;margin-bottom: 5px;">
                                            		<img src = <?php if(isset($businessresultset[9])) echo 'data:image/jpeg;base64,'.$businessresultset[9] ?>  alt = "Image not Available" id = "image" width="100px" style="height:100%"/>
                                            		</div>
                                            	</td>
                                            	<td style="vertical-align: bottom;width: 100%;">                                        
                                            		<input type="file" name="image" onchange= "displayImage(this)" style="padding: 0.5em 0.6em;margin-bottom: 6px;"/>                                                  
                                            	</td>
                                            </tr>
                                        	</table>

											<input type="text" placeholder="Business Name" name="businessname" class="name agileits" required="" 
												value="<?php echo !isset($businessresultset[0]) ? '' : $businessresultset[0] ?>" readonly />
											<input type="text" placeholder="Business Sector" name="businesssectortext" class="name agileits" required="" value="<?php echo !isset($businessresultset[1]) ? '' : $businessresultset[1] ?>" readonly />
											<input type="text" placeholder="Address : Street 1" name="address1" class="name agileits" required=""
												value="<?php echo !isset($businessresultset[2]) ? '' : $businessresultset[2] ?>" />
											<input type="text" placeholder="Address : Street 2" name="address2" class="name agileits"
												value="<?php echo !isset($businessresultset[3]) ? '' : $businessresultset[3] ?>" />
											<input type="text" placeholder="City" name="city" class="name agileits" required=""
												value="<?php echo !isset($businessresultset[4]) ? '' : $businessresultset[4] ?>" />
											<input type="text" placeholder="State" name="state" class="name agileits" required=""
												value="<?php echo !isset($businessresultset[5]) ? '' : $businessresultset[5] ?>" />
											<input type="text" placeholder="Country" name="country" class="name agileits" required=""
												value="<?php echo !isset($businessresultset[6]) ? '' : $businessresultset[6] ?>" />
											<input type="text" placeholder="Zip" name="zipcode" class="name agileits" required=""
												value="<?php echo !isset($businessresultset[7]) ? '' : $businessresultset[7] ?>" />
											<input type="text" placeholder="Business Phone Number" name="businessphonenumber" class="name agileits" required=""	value="<?php echo !isset($businessresultset[8]) ? '' : $businessresultset[8] ?>" />
											<textarea placeholder="Say somthing about your business(200 Characters)..." id="businessdescription" name="businessdescription" rows="4" columns ="500" maxlength="200" class="name agileits" required <?php echo !isset($businessresultset[10]) ? '' : 'readonly'?>><?php echo !isset($businessresultset[10]) ? '' : $businessresultset[10] ?></textarea>
											<div class="submit"><br>
												<input type="submit" value="Save">
												<input name="cancel" type="submit" value="Cancel">
											</div>
										</form>
									</div>
                                    <br>
								</div>
								<!-- Delete business -->
								<div class="tab-1 resp-tab-content">
									<p class="secHead">Delete Business</p>
									<br>
									<img class="settingImg" src="images/deactive.png" width="100" height="100">
									<div class="agile-send-mail">
										<form action="#" method="post" class="agile_form">
											<p class="b_name" style="color: white;text-align: center;">Click on below button to Delete your business.</p>
											<br>	
											<div class="submit"><br>
												<input name="delete" type="submit" value="Delete">
												<input name="cancel" type="submit" value="Cancel">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<?php include 'footer.php' ?>
		</div>
		<!--start-date-piker-->
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery-ui.js"></script>
		<script>
			$(function() {
			$( "#datepicker,#datepicker1,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6,#datepicker7" ).datepicker();
			});
		</script>
		<!-- 97-rgba(0, 0, 0, 0.75)/End-date-piker -->	
	</body>
</html>