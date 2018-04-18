<?php
    // Start the session
    session_start();
?>
<!DOCTYPE html>
<html class=" js cssanimations csstransitions">
	<head>
	<title>Business Owner Profile</title>

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
      
      require '../config.php';

      if(isset($_SESSION['first_name'])){
        $first_name = $_SESSION['first_name'];
      }        
      if(isset($_SESSION['last_name'])){
        $last_name = $_SESSION['last_name'];
      }
    	if(isset($_SESSION['email'])){
        $email_id = $_SESSION['email'];
      }	
      if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
      }

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
      $notifyCheck = 0;
      if(isset($_POST['notifyCheck'])) {
        $notifyCheck = 1;
      }
    	
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
                  $row = $result->fetch_array();
				  $email = $row["email"];
                  $query = "UPDATE user
                            SET encryptedpassword = \"".$newpwd."\", modified = sysdate()
                            WHERE id=".$userid;
                            //echo $query;
                  $result = $mysqli->query($query);
                  if ($result) {
                      //send email
      								$subject = "Your password has been updated";
      								$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      															 <html xmlns="http://www.w3.org/1999/xhtml">
      															 <head>
      															 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      															 </head>
      															 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding-top:5%; font-size: 20px;">
      															 <img src="https://i.pinimg.com/474x/1a/54/78/1a5478269e366828ee609b8ff07ba331--tips-and-tricks-shells.jpg">
      															 <div>
      																	<p>Your password for Treaty has been updated. If you have not updated your password, please call our customer care.</p>
      															 </div>
      															 </body>
      															 </html>';
      								$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
      								$headers = 'MIME-Version: 1.0' . "\r\n";
      								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      								mail($email, $subject, $message, $headers, "-f treatyrewards@gmail.com");
                      echo '<script>alert("Password Changed Sucessfully");</script>';
                      echo '<script>window.location.href = "/Treaty/User/business_profile.php";</script>';
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
              $query2 = "UPDATE userdetail
                        SET isactive = 0 , modified = sysdate()
                        WHERE userid=".$userid;
              $result2 = $mysqli->query($query2);
              if($result2) {
                  echo '<script>window.location.href = "/Treaty/User/business_profile.php";</script>';
              }
          } else {
              $message = "Failed to deactivate account";
          }
      } else if(isset($_POST['activate'])) {
          $query = "UPDATE user
                    SET isactive = 1 , modified = sysdate()
                    WHERE id=".$userid;
          $result = $mysqli->query($query);
          if ($result) {
              $query2 = "UPDATE userdetail
                        SET isactive = 1 , modified = sysdate()
                        WHERE userid=".$userid;
              $result2 = $mysqli->query($query2);
              if($result2) {
                  echo '<script>window.location.href = "/Treaty/User/business_profile.php";</script>';
              }
          } else {
              $message = "Failed to activate account";
          }
      } else if(isset($_POST['cancel'])) {
          echo '<script>window.location.href = "/Treaty/User/business_profile.php";</script>';
      } else if(!empty($fname)) {

      //get the userid from user table
      //If user enters diffrent phone numbers on SignUp page and Update profile this logic doesn't work.
            $query2 = "SELECT id FROM userdetail where userid=\"".$userid."\"";
            $result2 = $mysqli->query($query2);

            if ($result2->num_rows == 0) {
        		//insert the entry in userdetail table
        		// insert into table
        		$query = "INSERT INTO userdetail(userid, firstname, lastname, phonenumber,
        			address1, address2, city, state, country, zipcode, is_send_sms, modified, created) VALUES (\"".$userid."\",\"".$fname."\",\"". $lname."\",\"". $phone."\",\"". $street1."\",\"". $street2."\"
        					,\"". $city."\",\"". $state."\",\"". $country."\",\"". $zip."\",". $notifyCheck .", sysdate(), sysdate())";
        		$result = $mysqli->query($query);
        		if ($result) {                 
        			echo '<script>window.location.href = "business.php#horizontalTab4";</script>';
        		} else {
        			echo "Failed to update profile";
        		}
            } else {
                $query = "UPDATE userdetail
                          SET firstname = \"".$fname."\", lastname = \"".$lname."\",  phonenumber= \"".$phone."\", address1 = \"".$street1."\",
                             address2 = \"".$street2."\", city = \"".$city."\", state = \"".$state."\", country = \"".$country."\", zipcode = \"".$zip."\",
                             is_send_sms = ".$notifyCheck.",
                             modified = sysdate()
                          WHERE userid=".$userid;
                $result = $mysqli->query($query);
                if ($result) {                   
                    echo '<script>window.location.href = "business.php#horizontalTab3";</script>';
                } else {
                    echo "Failed to update profile";
                }
            }
    	} else {
            $query2 = "SELECT isactive
					  FROM user
					  WHERE id=\"".$userid."\"";
			$result2 = $mysqli->query($query2);
            if ($result2 -> num_rows > 0) {
                $row2 = $result2->fetch_array();
                $isactive = $row2["isactive"];
                $activationFlag = true;
                if($isactive == 0) {
                    $activationFlag = false;
                }
            }
            
            $query = "SELECT id,firstname,lastname, phonenumber, address1, address2, city, state, country, zipcode, is_send_sms
					  FROM userdetail
					  WHERE userid=\"".$userid."\"";
            $result = $mysqli->query($query);
            $profileresultset = array();
            // if yes, display dashboard link
            if ($result->num_rows > 0) {
                $_SESSION['displaydashboard'] = true;
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
          array_push($profileresultset, $row["is_send_sms"]);
            } else {
                // donot display dashboard link
                $_SESSION['displaydashboard'] = false;
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
                                if($_SESSION['displaydashboard'] == true and $activationFlag == true){
                                    echo "<li><a href='business.php'>Dashboard</a></li>";
                                }
                            ?> 
                            <!-- <li><a href="customer_list.php">Customers</a></li>  -->
                            <li class="active"><a href="business_profile.php">Profile</a></li>
                            <li><a href="../logout.php">Logout</a></li>                           
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <div class="container">        
            <div class="loginName">
                <?php 
                    $Qry = "SELECT firstname, lastname
                              FROM userdetail
                              WHERE userid=\"" . $userid . "\" and isactive = 1";
                    $result = $mysqli->query($Qry);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "Hello, ". $row['firstname']." ".$row['lastname'];
                    }
                ?>    	
            </div>
        </div>             
        
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
		                              echo "<li class=\"resp-tab-item-profile\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>Create Account</li>";
                                  } else{
                                      echo "<li class=\"resp-tab-item-profile\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i>Update Account</li>";
                                  }
                            ?>
							<li class="resp-tab-item-pro"><i class="fa fa-key" aria-hidden="true"></i>Change Password</li>
							<li class="resp-tab-item-pro"><i class="fa fa-user-times" aria-hidden="true"></i>
                                <?php  echo $activationFlag  ? 'Deactivate Account' : 'Activate account' ?></li>
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
                                              value="<?php echo !isset($profileresultset[4]) ? '' : $profileresultset[4]; ?>"/>
										<input type="text" placeholder="City" name="city" class="name agileits"
                                              value="<?php echo !isset($profileresultset[5]) ? '' : $profileresultset[5]; ?>" required=""/>
										<input type="text" placeholder="State" name="state" class="name agileits"
                                              value="<?php echo !isset($profileresultset[6]) ? '' : $profileresultset[6]; ?>" required=""/>
										<input type="text" placeholder="Country" name="country" class="name agileits"
                                              value="<?php echo !isset($profileresultset[7]) ? '' : $profileresultset[7]; ?>" required=""/>
										<input type="text" placeholder="Zip" name="zip" class="name agileits"
                                              value="<?php echo !isset($profileresultset[8]) ? '' : $profileresultset[8]; ?>" required=""/>
                                        <p class="notPara"><br><input type="checkbox" name="notifyCheck" <?php echo (isset($profileresultset[9])==1 ? 'checked' : '');?>>&nbsp&nbsp&nbspDo you want offer notifications?</p>
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
										<input type="password" placeholder="Old Password" name="old-pwd" class="name agileits" required="" /><br>
										<input type="password" placeholder="New Password" name="new-pwd" class="name agileits" required=""/><br>
										<input type="password" placeholder="Confirm New Password" name="conf-new-pwd" class="name agileits" required=""/>
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
								<p class="secHead">
                                <?php echo $activationFlag ? 'Deactivate Account' : 'Activate Account' ?>
                                </p><br>
								<img class="settingImg" src="<?php echo $activationFlag ? 'images/deactive.png ' : 'images/activate.jpg' ?>" width="100" height="100">
								<div class="agile-send-mail">
									<form method="post" class="agile_form">
										<p class="b_name" style="color: white;text-align: center;">Click on below button to <?php echo $activationFlag ? 'Deactivate' : 'Activate' ?>
                                        your account.</p><br>
										<div class="submit"><br>
										  <input type="submit" name="<?php echo $activationFlag ? 'deactivate' : 'activate' ?>" value="<?php echo $activationFlag ? 'Deactivate' : 'Activate' ?>">
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
       /* close connection */
        $mysqli->close();
	?>
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
