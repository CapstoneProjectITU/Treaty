<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<!-- Meta tag Keywords -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Classic Forms Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } 
		</script>
		<!-- Meta tag Keywords -->
		<!-- css files -->
		<link href="css/login-style.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="css/font-awesome.css">
		<!-- Font-Awesome-Icons-CSS -->
		<!-- //css files -->
		<!-- Web-Fonts -->
		<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<!-- //Web-Fonts -->
		<?php 
			include 'header.php';
			require 'config.php';
			
			$signInemail = $_POST['signInemail'];
			$signInpassword = $_POST['signInpassword'];
			
			$signUpemail = $_POST['signUpemail'];
			$signUppassword= $_POST['signUppassword'];
			$signUpcpassword = $_POST['signUpcpassword'];
			$signUprole = $_POST['user'];
			
			// database connection
			$mysqli = new mysqli($HOST_NAME, $DATABASE_USERNAME, $DATABASE_PASSWORD, $DATABASE_NAME);
			if (!$mysqli) {
			    die('Could not connect: ' . mysql_error());
			}
			
			if(!empty($signInemail)) {
			    $query = "SELECT role FROM user where email=\"".$signInemail."\" and encryptedpassword=\"". $signInpassword."\"";
			    // Sign In
			    $result = $mysqli->query($query);
			    if ($result->num_rows > 0) {
			        echo '<script>window.location.href = "index.php";</script>';
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
			            $query = "INSERT INTO user (email,role,encryptedpassword) 
			                        VALUES (\"".$signUpemail."\",\"".$signUprole."\",\"". $signUppassword."\")";            
			            $result = $mysqli->query($query);
			            if ($result) {
			                echo '<script>window.location.href = "user/customer.php#horizontalTab4";</script>';
			            } else {
			                $signupresponse="Failed to signup";
			            }
			        }
			    }
			}
			?>
	</head>
	<body>
		<div class="navbar" style="position: fixed;width: 100%;">
			<div class="navbar-inner">
				<div class="container">
					<a href="#" class="brand">
						<img src="images/logo.png" width="120" height="40" alt="Logo" />
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
							<li><a href="">Find Locations</a></li>
							<li><a href="index.php#service">Services</a></li>
							<li><a href="index.php#portfolio">Portfolio</a></li>
							<li><a href="index.php#about">About</a></li>
							<li><a href="index.php#clients">Clients</a></li>
							<li><a href="index.php#price">Price</a></li>
							<li><a href="index.php#contact">Contact</a></li>
							<li class="active"><a href="login.php">Login</a></li>
						</ul>
					</div>
					<!-- End main navigation -->
				</div>
			</div>
		</div>
		<br>
		<h1 style="margin-top: 5%;">Welcome to Login Portal.</h1>
		<br>
		<div class="main" style="margin-bottom: 2%;">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<div class="img-w3l-agile">
					<img src="images/1.jpg" alt=" ">
					<form style="color: black!important;"></form>
				</div>
				<ul class="resp-tabs-list" style="margin-left: 0px;">
					<li class="resp-tab-item">
						<h3><span>Sign In</span></h3>
					</li>
					<li class="resp-tab-item">
						<h3><span>Sign Up</span></h3>
					</li>
				</ul>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content">
						<div class="login-top">
							<form method="post">
								<input type="email" name="signInemail" class="email" placeholder="Email" required/>
								<input type="password" name="signInpassword" class="password" placeholder="Password" required/>	
								<label style="color:red;">
								<?php echo $response; ?>
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
								<input type="submit" value="Sign In">
							</form>
							<img src="images/google-login.png" width="200" height="50" style="width: 60%; height: 40%; padding-top: 2%;"><br>
							<img src="images/facebook.png" width="200" height="50" style="width: 62%; height: 40%;">
						</div>
					</div>
					<div class="tab-1 resp-tab-content">
						<div class="login-top sign-top">
							<form method="post" style="color: black!important;">
								<input type="radio" name="user" style="margin: 0px;" value="Customer" required> <span>Customer</span> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								<input type="radio" name="user" style="margin: 0px;" value="Business Owner"> <span>Business Owner</span><br><br>
								<input type="email" name="signUpemail" class="email" placeholder="Email" required/>
								<input type="password" name="signUppassword" class="password" placeholder="Password" required/>
								<input type="password" name="signUpcpassword" class="password" placeholder="Confirm Password" required/>
								<label style="color:red;">
								<?php echo $signupresponse; ?>
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
								<input type="submit" value="Sign Up">							
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
		<?php include 'footer.php'; ?>
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
		<!-- //tabs -->
		<!-- //js-scripts -->	
	</body>
</html>