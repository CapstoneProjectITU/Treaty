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
			
			$email = $_POST['email'];
			$tpassword = $_POST['tpassword'];
			$npassword = $_POST['npassword'];
			$cpassword = $_POST['cpassword'];
			
			// database connection
			$mysqli = new mysqli($HOST_NAME, $DATABASE_USERNAME, $DATABASE_PASSWORD, $DATABASE_NAME);
			if (!$mysqli) {
			    die('Could not connect: ' . mysql_error());
			}
			
			if(!empty($email)) {
			    if(strcmp($npassword, $cpassword) != 0) {
			        $response = "Passwords dont match";
			    } else {
			        $query = "SELECT role FROM user where email=\"".$email."\" and encryptedpassword=\"". $tpassword."\"";
			        // Sign In
			        $result = $mysqli->query($query);
			        if ($result->num_rows > 0) {
			            $query = "UPDATE user 
			                      SET encryptedpassword=\"".$npassword."\"
			                      WHERE email=\"".$email."\"";
			            
			            $result = $mysqli->query($query);
			            if ($result) {
			                echo '<script>window.location.href = "index.php";</script>';
			            }
			        } else {
			            $response = "Unable to find email. Please try again.";
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
		<div class="main" style="margin-bottom: 2%;margin-top: 5%;">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<div class="img-w3l-agile">
					<img src="images/1.jpg" alt=" ">
					<form style="color: black!important;"></form>
				</div>
				<div class="resp-tab-item" style="width:100%; padding:0px;">
					<h3><span>Reset Password</span></h3>
				</div>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content">
						<div class="login-top">
							<form method="post">
								<input type="email" name="email" class="email" placeholder="Email" required/>
								<input type="password" name="tpassword" class="password" placeholder="Temporary password" required/>
								<input type="password" name="npassword" class="password" placeholder="New password" required/>
								<input type="password" name="cpassword" class="password" placeholder="Confirm password" required/>
								<label style="color:red;">
								<?php echo $response; ?>
								</label>
								<input type="submit" value="Submit">
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
		<div class="footer" style="padding: 0.5em 0;">
			<p style="color: #fece1a;">Treaty.com © copyright 2018</p>
		</div>
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