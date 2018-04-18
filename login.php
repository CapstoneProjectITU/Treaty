<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="keywords" content="Classic Forms Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        	function hideURLbar(){ window.scrollTo(0,1); }
    	</script>

		<link href="css/font-awesome.css" rel="stylesheet">
	    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
	    <link href="css/login-style.css" rel="stylesheet" type="text/css" media="all">

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<!-- 	<script type="text/javascript" src="js/user-dashboard.js"></script>
		 -->
		<!-- Web-Fonts -->
			<link href='//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
			<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<!-- //Web-Fonts -->
	    <style>
			.hr-sect {
				display: flex;
				flex-basis: 100%;
				align-items: center;
				color: #000;
			}
			.hr-sect::before,
			.hr-sect::after {
				content: "";
				flex-grow: 1;
				background: rgba(0, 0, 0, 0.35);
				height: 1px;
				font-size: 0px;
				line-height: 0px;
				margin: 0px 8px;
			}
		</style>
	</head>
	<?php
		include 'header.php';
		require 'config.php';
		require_once "social_login/fb_config.php";
		require_once "social_login/google_config.php";

		if(isset($_POST['signInemail'])){
			$signInemail = $_POST['signInemail'];
		}

		if(isset($_POST['signInpassword'])){
			$signInpassword = $_POST['signInpassword'];
		}

		if(isset($_POST['signUpemail'])){
			$signUpemail = $_POST['signUpemail'];
		}

		if(isset($_POST['signUppassword'])){
			$signUppassword= $_POST['signUppassword'];
		}

		if(isset($_POST['signUpcpassword'])){
			$signUpcpassword = $_POST['signUpcpassword'];
		}

		if(isset($_POST['user'])){
			$signUprole = $_POST['user'];
		}

		if(isset($_POST['signUpPhone'])){
			$signUpPhone = $_POST['signUpPhone'];
		}

		if(isset($_SESSION['signupresponse_social'])){
			$signupresponse_social = $_SESSION['signupresponse_social'];
		}

		if(isset($_POST['user_social'])){
			$signUprole_social = $_POST['user_social'];
			$_SESSION['signUprole_social'] = $_POST['user_social'];
		}

		// database connection
		if(!empty($signInemail)) {
		    $query = "SELECT id, role FROM user where email=\"".$signInemail."\" and encryptedpassword=\"". $signInpassword."\"";
		    // Sign In
		    $result = $mysqli->query($query);
		    if ($result->num_rows > 0) {
				$row = $result->fetch_array();
				//Store userid in Session
				//Use $_SESSION['userid'] wherever u want to access the userid
		        $_SESSION['userid'] = $row['id'];
				$role = $row['role'];
				// check if there if exists an entry in user_detail table
				$query = "SELECT id FROM userdetail where userid=\"".$row['id']."\" and isactive=1";
				$result = $mysqli->query($query);
				// if yes, do not take him to profile page
				if ($result->num_rows > 0) {
					if(strcasecmp($role, 'Business Owner') == 0) {
						echo '<script>window.location.href = "User/business.php";</script>';
					} else {
						echo '<script>window.location.href = "User/customer.php#horizontalTab3";</script>';
					}
				} else {
					//if no, take him to profile page
					if(strcasecmp($role, 'Business Owner') == 0) {
							echo '<script>window.location.href = "User/business_profile.php";</script>';
					} else {
							echo '<script>window.location.href = "User/customer_profile.php";</script>';
					}
				}
		    } else {
		        $response="Invalid username/password";
		    }
		} else if(!empty($signUpemail)) {
		    //check if both the passwords are same
		    if(strcmp($signUppassword, $signUpcpassword) != 0) {
		        $signupresponse="Passwords dont match";
		    } else {
		        //check if user already exist
		        $query = "SELECT role FROM user where email=\"".$signUpemail."\" and encryptedpassword=\"". $signUppassword."\"";
		        $result = $mysqli->query($query);
		        if ($result->num_rows > 0) {
		            $signupresponse="User with email already exists. Please sign in.";
		        } else {
		            // insert into table
		            $query = "INSERT INTO user (email,role,phonenumber,encryptedpassword)
		                        VALUES (\"".$signUpemail."\",\"".$signUprole."\",\"".$signUpPhone."\",\"". $signUppassword."\")";
		            $result = $mysqli->query($query);
		            if ($result) {
						//send email
						$subject = "Congratulations! Welcome to Treaty!";
						$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
													 <html xmlns="http://www.w3.org/1999/xhtml">
													 <head>
													 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
													 </head>
													 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding:5%; font-size: 20px;">
															 <div>
																	 <p> Thank you for creating an account with Treaty. We are here to serve you better! </p>
															 </div>
													 </body>
													 </html>';
						$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
						$headers = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

						//Fetch user id to set it in session.
						$query = "SELECT id FROM user where email=\"".$signUpemail."\"";
				        $result = $mysqli->query($query);
				        if ($result->num_rows > 0) {
				        	$row = $result->fetch_array();
				            $_SESSION['userid'] = $row['id'];
				        }
						if(mail($signUpemail, $subject, $message, $headers, "-f treatyrewards@gmail.com")){
								if(strcasecmp($signUprole, 'Business Owner') == 0) {
										echo '<script>window.location.href = "User/business_profile.php";</script>';
								} else {
										echo '<script>window.location.href = "User/customer_profile.php";</script>';
								}
						}
		            } else {
		                $signupresponse="Failed to signup";
		            }
		        }
		    }
		}

		//Social Login
		//Facebook Sign In
		if (isset($_POST['fb_signin_btn'])) {
			$_SESSION['fb_signin_btn'] = $_POST['fb_signin_btn'];

		    if (isset($_SESSION['fb_access_token'])) {
				//Check user role
				$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";

				$result = $mysqli->query($query);
				if ($result->num_rows > 0) {
					$row = $result->fetch_array();
					$_SESSION['userid'] = $row['id'];

					if(strcasecmp($row['role'], 'Business Owner') == 0) {
						//header('Location: User/business_profile.php');
						//exit();
						echo '<script>window.location.href = "User/business_profile.php";</script>';
					} else {
						//header('Location: User/customer_profile.php');
						//exit();
						echo '<script>window.location.href = "User/customer_profile.php";</script>';
					}
				}
			}
			//$redirectURL = "http://localhost/Treaty/social_login/fb-callback.php";
			$redirectURL = "https://www.ruchirkute.com/Treaty/social_login/fb-callback.php";
			$permissions = ['email'];
			$fb_loginURL = $helper->getLoginUrl($redirectURL, $permissions);
			//echo "URL:".$fb_loginURL;die;
			//header('Location:'.$fb_loginURL);
			//exit();
			echo '<script>window.location.href = "'.$fb_loginURL.'";</script>';
		}

		//Facebook Sign Up
		if (isset($_POST['fb_signup_btn'])){
			$_SESSION['fb_signup_btn'] = $_POST['fb_signup_btn'];

		    if (isset($_SESSION['fb_access_token'])) {
				//Check user exists
				$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";
				$result = $mysqli->query($query);
				if ($result->num_rows > 0) {
					 $signupresponse_social="User with email already exists. Please sign in.";
					 //header('Location: login.php');
					 //exit();
					 echo '<script>window.location.href = "login.php";</script>';

				}
				else
				{
					$signUpPhone = '1234567890';
					$signUppassword = 'test1234';
					$query = "INSERT INTO user (email,role,phonenumber,encryptedpassword)
		                       VALUES (\"".$_SESSION['email']."\",\"".$signUprole_social."\",\"".$signUpPhone."\",\"". $signUppassword."\")";
		            $result = $mysqli->query($query);

		            if ($result) {

		            	//Fetch user id to set it in session.
						$query_userid = "SELECT id FROM user where email=\"".$signUpemail."\"";
				        $result_userid = $mysqli->query($query_userid);
				        if ($result_userid->num_rows > 0) {
				        	$row = $result_userid->fetch_array();
				            $_SESSION['userid'] = $row['id'];				           
				        }

						if(strcasecmp($signUprole_social, 'Business Owner') == 0) {
							//header('Location: User/business_profile.php');
							//exit();
							echo '<script>window.location.href = "User/business_profile.php";</script>';
						}
						else
						{
							//header('Location: User/customer_profile.php');
							//exit();
							echo '<script>window.location.href = "User/customer_profile.php";</script>';
						}
		            }
		            else
		            {
		                $signupresponse_social="Failed to signup";
		            }
				}
			}
			//$redirectURL = "http://localhost/Treaty/social_login/fb-callback.php";
			$redirectURL = "https://www.ruchirkute.com/Treaty/social_login/fb-callback.php";
			$permissions = ['email'];
			$fb_loginURL = $helper->getLoginUrl($redirectURL, $permissions);

			//header('Location:'.$fb_loginURL);
			//exit();
			echo '<script>window.location.href = "'.$fb_loginURL.'";</script>';
			exit;
		}

		//Google Sign In
		if (isset($_POST['google_signin_btn'])) {
			$_SESSION['google_signin_btn'] = $_POST['google_signin_btn'];

			if(isset($_SESSION['google_access_token'])){
				$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";

			    $result = $mysqli->query($query);
			    if ($result->num_rows > 0) {
					$row = $result->fetch_array();
					$_SESSION['userid'] = $row['id'];

					if(strcasecmp($row['role'], 'Business Owner') == 0) {
						//header('Location: User/business_profile.php');
						echo '<script>window.location.href = "User/business_profile.php";</script>';
						//exit();
					} else {
						//header('Location: User/customer_profile.php');
						echo '<script>window.location.href = "User/customer_profile.php";</script>';
                        //exit();
					}
				}
			}
			
			$google_loginURL = $gClient->createAuthUrl();			
			//header('Location:'.$google_loginURL);			
			//exit();
			//echo "Google login url:".$google_loginURL;die;
			echo '<script>window.location.href = "'.$google_loginURL.'";</script>';
			exit;
			
		}

		//Google Sign up
		if (isset($_POST['google_signup_btn'])){
			$_SESSION['google_signup_btn'] = $_POST['google_signup_btn'];

		    if (isset($_SESSION['google_access_token'])) {
				//Check user exists
				$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";
				$result = $mysqli->query($query);
				if ($result->num_rows > 0) {
					 $signupresponse_social="User with email already exists. Please sign in.";
					 //header('Location: login.php');
					 //exit();
					 echo '<script>window.location.href = "login.php";</script>';
				}
				else
				{
					$signUpPhone = '1234567890';
					$signUppassword = 'test1234';
					$query = "INSERT INTO user (email,role,phonenumber,encryptedpassword)
		                       VALUES (\"".$_SESSION['email']."\",\"".$signUprole_social."\",\"".$signUpPhone."\",\"". $signUppassword."\")";
		            $result = $mysqli->query($query);
		            if ($result) {

		            	//Fetch user id to set it in session.
						$query_userid = "SELECT id FROM user where email=\"".$signUpemail."\"";
				        $result_userid = $mysqli->query($query_userid);
				        if ($result_userid->num_rows > 0) {
				        	$row = $result_userid->fetch_array();
				            $_SESSION['userid'] = $row['id'];				           
				        }

						if(strcasecmp($signUprole_social, 'Business Owner') == 0) {
							//header('Location: User/business_profile.php');
							//exit();
							echo '<script>window.location.href = "User/business_profile.php";</script>';
							exit;
						}
						else
						{
							//header('Location: User/customer_profile.php');
							//exit();
							echo '<script>window.location.href = "User/customer_profile.php";</script>';
							exit;
						}
		            }
		            else
		            {
		                $signupresponse_social="Failed to signup";
		            }
				}
			}
			$google_loginURL = $gClient->createAuthUrl();

			//header('Location:'.$google_loginURL);
			//exit();
			echo '<script>window.location.href = "'.$google_loginURL.'";</script>';
			exit;

		}
	?>
	</head>
	<body>

		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a href="index.php" class="brand">
						<img src="images/logoIcon.png" width="240" height="80" alt="Logo" />
						<!-- This is website logo -->
					</a>
					<!-- Navigation button, visible on small resolution -->
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<i class="icon-menu"></i>
					</button>
					<!-- Main navigation -->
					<div class="nav-collapse collapse pull-right">
						<ul class="nav" id="top-navigation">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="index.php#service">Customer</a></li>
                            <li><a href="index.php#portfolio">Businesses</a></li>
                            <li><a href="index.php#about">About</a></li>
                            <li><a href="index.php#clients">Clients</a></li>
                            <li><a href="index.php#price">Price</a></li>
                            <li><a href="index.php#contact">Contact</a></li>
                            <li class="active"><a href='login.php'>Login</a></li>
						</ul>
					</div>
					<!-- End main navigation -->
				</div>
			</div>
		</div>
		<br>
		<h2 style="color:#000">Welcome to Treaty</h2>

		<div class="main" style="margin-bottom: 2%;">
			<div id="horizontalTab" style="display: block; width: 100%; ">
				<div class="img-w3l-agile">
<!-- 					<img src="images/1.jpg" alt=" ">
 -->					<form style="color: black!important;"></form>
				</div>
				<ul class="resp-tabs-list" style="margin-left: 0px;">
					<li class="resp-tab-item">
						<h4><span>Sign In</span></h4>
					</li>
					<li class="resp-tab-item">
						<h4><span>Sign Up</span></h4>
					</li>
				</ul>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content">
						<div class="login-top">
							<form method="post">
								<input type="email" name="signInemail" class="email" placeholder="Email" required/>
								<input type="password" name="signInpassword" class="password" placeholder="Password" required/>
								<label style="color:red;">
								<?php
									if(isset($response)){
										echo $response;
									}
								?>
								</label>
								<div class="login-bottom">
									<ul>
										<li>
											<input type="checkbox" id="brand" value="">
											<label for="brand"><span></span> Remember me?</label>
										</li>
										<li>
											<a href="forgot_password.php">Forgot password?</a>
										</li>
									</ul>
									<div class="clear"></div>
								</div>
								<input class="button" type="submit" value="Sign In">

							</form>

							<form method="post">
                                <div id="social" class="row" style="margin-left: 0px; margin-bottom:10px">
                                    <div class="col-md-12">
                                        <img src="images/fb.png" width="25px" height="25px" class="fb-img" alt="">
                                        <input name="fb_signin_btn" class="form-control btn btn-fb fb-btn-bg" type="submit" value="Sign in with Facebook">

                                    </div>
                                </div>

                                <div id="social" class="row" style="margin-left: 0px; margin-bottom:10px">
                                    <div class="col-md-12">
                                        <img src="images/google.jpg" width="25px" height="25px" class="google-img" alt="">
                                        <input name="google_signin_btn" class="form-control btn btn-google google-btn-bg" type="submit" value="Sign in with Google">
                                    </div>
                                </div>
							</form>

						</div>
					</div>
					<div class="tab-1 resp-tab-content">
						<div class="login-top sign-top">
							<form method="post" style="color: black!important;">
								<input type="radio" name="user" style="margin: 0px;" value="Customer" required checked="checked"> <span>Customer</span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="radio" name="user" style="margin: 0px;" value="Business Owner"> <span>Business Owner</span><br><br>
								<input type="email" name="signUpemail" class="email" placeholder="Email" required/>
								<input type="text" name="signUpPhone" class="" placeholder="Phone" required/>
								<input type="password" name="signUppassword" class="password" placeholder="Password" required/>
								<input type="password" name="signUpcpassword" class="password" placeholder="Confirm Password" onkeyup="comparePasswords();" required/>
								<label style="color:red;">
								<?php
									if(isset($signupresponse)){
										echo $signupresponse;
									}
								?>
								</label>
								<div class="login-bottom">
									<ul>
										<li>
											<input type="checkbox" id="brand1" value="">
											<label for="brand1"><span></span> Remember me?</label>
										</li>
										<li>
											<a href="forgot_password.php">Forgot password?</a>
										</li>
									</ul>
									<div class="clear"></div>
								</div>

								<input class="button" type="submit" value="Sign Up">
								<br><br>
							</form>

                            <div class="hr-sect">OR</div>

							<form method="post" style="color: black!important;">
								<br>
								<input type="radio" name="user_social" style="margin: 0px;" value="Customer" required checked="checked"> <span>Customer</span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="radio" name="user_social" style="margin: 0px;" value="Business Owner"> <span>Business Owner</span>
								<label style="color:red;">
								<?php
									if(isset($signupresponse_social)){
										echo $signupresponse_social;
									}
								?>
								</label>
								<br><br>
								<div id="social" class="row" style="margin-left: 0px; margin-bottom:10px">
                    <div class="col-md-12">
                        <img src="images/fb.png" width="25px" height="25px" class="fb-img" alt="">
                        <input name="fb_signup_btn" class="form-control btn btn-fb fb-btn-bg" type="submit" value="Sign up with Facebook">
                    </div>
                </div>

                <div id="social" class="row" style="margin-left: 0px; margin-bottom:10px">
                    <div class="col-md-12">
                        <img src="images/google.jpg" width="25px" height="25px" class="google-img" alt="">
                        <input name="google_signup_btn" class="form-control btn btn-google google-btn-bg" type="submit" value="Sign up with Google">
                    </div>
                </div>
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
        <br><br>

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

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>


        <!-- <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script> -->
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->

        <div class="footer">
            <p style="color: white;">Treaty.com © copyright 2018</p>
        </div>
		<!-- //tabs -->
		<!-- //js-scripts -->
	</body>
</html>
