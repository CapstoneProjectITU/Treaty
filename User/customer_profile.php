<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html class=" js cssanimations csstransitions">
	<head>
	<title>Customer Account</title>

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
	<?php
	include 'header.php';
	?>
</head>

	<?php
		//include 'customer_profile_nav.php';
		require '../config.php';

		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
		$email_id = $_SESSION['email'];

		if(isset($_POST['fname'])){
			$fname = $_POST['fname'];
		}
		if(isset($_POST['lname'])){
			$lname = $_POST['lname'];
		}
		if(isset($_POST['phone'])){
			$phone = $_POST['phone'];
		}
		if(isset($_POST['street1'])){
			$street1= $_POST['street1'];
		}
		if(isset($_POST['street2'])){
			$street2 = $_POST['street2'];
		}
		if(isset($_POST['city'])){
			$city = $_POST['city'];
		}
		if(isset($_POST['state'])){
			$state = $_POST['state'];
		}
		if(isset($_POST['country'])){
			$country = $_POST['country'];
		}
		if(isset($_POST['zip'])){
			$zip = $_POST['zip'];
		}

        if(isset($_POST['old-pwd'])){
            $oldpwd = $_POST['old-pwd'];
        }
        if(isset($_POST['new-pwd'])){
            $newpwd = $_POST['new-pwd'];
        }
        if(isset($_POST['conf-new-pwd'])){
            $confnewpwd = $_POST['conf-new-pwd'];
        }


        $userid = $_SESSION["userid"];
        if(isset($_POST['save']) && !empty($oldpwd)){
            if (strcmp($newpwd,$confnewpwd) != 0) {
                $message = "New password and Confirm new password are not same";
            } else {
                //check if old password is correct
                //get the userid from user table
    			$query = "SELECT email FROM user where id=\"".$userid."\" and encryptedpassword=\"".$oldpwd."\"";
    			// Sign In
    			$result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    $query = "UPDATE user
                              SET encryptedpassword = \"".$newpwd."\", modified = sysdate()
                              WHERE id=".$userid;
                              echo $query;
                    $result = $mysqli->query($query);
                    if ($result) {
                        echo '<script>window.location.href = "/Treaty/User/customer.php";</script>';
                    } else {
                        $message = "Failed to update password";
                    }
                } else {
                    $message = "Incorrect old password";
                }
            }
        } else if(isset($_POST['deactivate'])) {
            $query = "UPDATE user
                      SET isactive = 0 , modified = sysdate()
                      WHERE id=".$userid;
            $result = $mysqli->query($query);
            if ($result) {
                echo '<script>window.location.href = "/Treaty/index.php";</script>';
            } else {
                $message = "Failed to update password";
            }
        } else if(!empty($fname)) {
			//get the userid from user table
			$query = "SELECT id FROM user where phonenumber=\"".$phone."\"";
			// Sign In
			$result = $mysqli->query($query);

            $query2 = "SELECT id FROM userdetail where userid=\"".$userid."\"";
            $result2 = $mysqli->query($query2);
			// Sign In
			if ($result2->num_rows == 0 && $result->num_rows > 0) {
				$row = $result->fetch_array();
				$user_id = $row["id"];
				//insert the entry in userdetail table
				// insert into table
				$query = "INSERT INTO userdetail(userid, firstname, lastname, phonenumber,
					address1, address2, city, state, country, zipcode, modified, created) VALUES (\"".$user_id."\",\"".$fname."\",\"". $lname."\",\"". $phone."\",\"". $street1."\",\"". $street2."\"
							,\"". $city."\",\"". $state."\",\"". $country."\",\"". $zip."\", sysdate(), sysdate())";
				echo $query;
				$result = $mysqli->query($query);
				if ($result) {
					echo '<script>window.location.href = "/Treaty/User/customer.php";</script>';
				} else {
					echo "Failed to update profile";
				}
			} else {
                $query = "UPDATE userdetail
                          SET firstname = \"".$fname."\", lastname = \"".$lname."\",  phonenumber= \"".$phone."\", address1 = \"".$street1."\",
                             address2 = \"".$street2."\", city = \"".$city."\", state = \"".$state."\", country = \"".$country."\", zipcode = \"".$zip."\",
                             modified = sysdate()
                          WHERE userid=".$userid;
                $result = $mysqli->query($query);
                if ($result) {
                    echo '<script>window.location.href = "/Treaty/User/customer.php";</script>';
                } else {
                    echo "Failed to update profile";
                }
			}
		}  else {

			$query = "SELECT id,firstname,lastname, phonenumber, address1, address2, city, state, country, zipcode
					  FROM userdetail
					  WHERE userid=\"".$userid."\"";

			$result = $mysqli->query($query);
			$profileresultset = array();
			// if yes, display dashboard link
			if ($result->num_rows > 0) {
				$_SESSION['customerdashboard'] = true;
				// output data of each row
                $row = $result->fetch_array();
                array_push($profileresultset, $row["firstname"]);
    			array_push($profileresultset, $row["lastname"]);
    			array_push($profileresultset, $row["phonenumber"]);
    			array_push($profileresultset, $row["address1"]);
    			array_push($profileresultset, $row["address2"]);
                array_push($profileresultset, $row["city"]);
    			array_push($profileresultset, $row["state"]);
    			array_push($profileresultset, $row["country"]);
    			array_push($profileresultset, $row["zipcode"]);

			} else {
				// donot display dashboard link
				$_SESSION['customerdashboard'] = false;
			}
		}
		/* close connection */
		$mysqli->close();
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
                                if(isset($_SESSION['customerdashboard'])){
                                    echo "<li><a href='customer.php'>Dashboard</a></li>";
                                }
                            ?>                                                        
                            <li><a href="find_location.php">Find Location</a></li>
                            <li class="active"><a href="customer_profile.php">Profile</a></li>
                            <li><a href="../index.php">Logout</a></li>                           
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
				</script>

				<div class="tabs">

					<div class="tab-left">
						<ul class="resp-tabs-list">
                            <?php
                                 if(!isset($profileresultset)) {
		                              echo "<li class=\"resp-tab-item-profile\"><i class=\"fa fa-plane\" aria-hidden=\"true\"></i>Create Account</li>";
                                  } else{
                                      echo "<li class=\"resp-tab-item-profile\"><i class=\"fa fa-plane\" aria-hidden=\"true\"></i>Update Account</li>";
                                  }
                            ?>
							<li class="resp-tab-item-profile"><i class="fa fa-ship" aria-hidden="true"></i>Change Password</li>
							<li class="resp-tab-item-profile"><i class="fa fa-plane" aria-hidden="true"></i>Deactivate Account</li>
						</ul>
					</div>

					<div class="tab-right">
						<div class="resp-tabs-container">
							<!-- Customer Profile section -->
							<div class="tab-1 resp-tab-content">
								<?php
									 if(isset($profileresultset)) {
										 echo "<p class=\"secHead\"> Update Account</p>";
									 } else {
									 	echo "<p class=\"secHead\"> Create Account</p>";
									 }
								?>
								<div class="w3l-sign-in">
									<form method="post" class="agile_form">
										<input type="text" placeholder="First Name" name="fname" class="name agileits"
				                              value="<?php echo !isset($profileresultset[0]) ? '' : $profileresultset[0]; ?>" required=""/>
										<input type="text" placeholder="Last Name" name="lname" class="name agileits"
                                              value="<?php echo !isset($profileresultset[1]) ? '' : $profileresultset[1]; ?>" required=""/>
										<input type="text" placeholder="Phone Number" name="phone" class="name agileits"
                                              value="<?php echo !isset($profileresultset[2]) ? '' : $profileresultset[2]; ?>" required=""/>
										<input type="text" placeholder="Address : Street 1" name="street1" class="name agileits"
                                              value="<?php echo !isset($profileresultset[3]) ? '' : $profileresultset[3]; ?>" required=""/>
										<input type="text" placeholder="Address : Street 2" name="street2" class="name agileits"
                                              value="<?php echo !isset($profileresultset[4]) ? '' : $profileresultset[4]; ?>" required=""/>
										<input type="text" placeholder="City" name="city" class="name agileits"
                                              value="<?php echo !isset($profileresultset[5]) ? '' : $profileresultset[5]; ?>" required=""/>
										<input type="text" placeholder="State" name="state" class="name agileits"
                                              value="<?php echo !isset($profileresultset[6]) ? '' : $profileresultset[6]; ?>" required=""/>
										<input type="text" placeholder="Country" name="country" class="name agileits"
                                              value="<?php echo !isset($profileresultset[7]) ? '' : $profileresultset[7]; ?>" required=""/>
										<input type="text" placeholder="Zip" name="zip" class="name agileits"
                                              value="<?php echo !isset($profileresultset[8]) ? '' : $profileresultset[8]; ?>" required=""/>
										<p class="notPara"><br><input type="checkbox" name="notifyCheck" checked>&nbsp&nbsp&nbspDo you want offer notifications?</p>
										<div class="submit"><br>
										  <input type="submit" value="Save">
										  <input type="submit" value="Cancel">
                                        <br><br>                                           
										</div>
									</form>
								</div>
							</div>

							<!--Change Password-->
							<div class="tab-1 resp-tab-content">
								<p class="secHead">Change Password</p>
								<div class="agile-send-mail">
									<form method="post" class="agile_form">
										<input type="text" placeholder="Old Password" name="old-pwd" class="name agileits" required=""/>
										<input type="text" placeholder="New Password" name="new-pwd" class="name agileits" required=""/>
										<input type="text" placeholder="Confirm New Password" name="conf-new-pwd" class="name agileits" required=""/>
                                        <div>
                                            <br>
                                            <label style="color:red;font-weight:bold;">
                                            <?php
                                                if(isset($message)) {
                                                    echo $message;
                                                }
                                            ?>
                                            </label>
                                        </div>
										<div class="submit"><br>
										  <input type="submit" name="save" value="Save">
										  <input type="submit" name="cancel" value="Cancel">                                       
										</div>

									</form>
								</div>
							</div>

							<!-- Deactivate customer account -->
							<div class="tab-1 resp-tab-content">
								<p class="secHead">Deactivate Account</p><br>
								<img class="settingImg" src="images/deactive.png" width="100" height="100">
								<div class="agile-send-mail">
									<form method="post" class="agile_form">
										<p class="b_name" style="color: white;text-align: center;">Click on below button to Deactivate your account.</p><br>
										<div class="submit"><br>
										  <input type="submit" name="deactivate" value="Deactivate">
										  <input type="submit" name="cancel" value="Cancel">
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
	<?php
		include 'footer.php';
	?>
	<!--start-date-piker-->
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script src="js/jquery-ui.js"></script>
			<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6,#datepicker7" ).datepicker();
				});
			</script>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
        <script type="text/javascript" src="../js/modernizr.custom.js"></script>            
<!-- 97-rgba(0, 0, 0, 0.75)/End-date-piker -->
</body>
</html>
