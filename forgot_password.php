<!DOCTYPE html>
<html class=" js cssanimations csstransitions">
	<head>
	<title>Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/favicon.ico">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } 
    </script>

		<link href="css/login-style.css" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="css/font-awesome.css">

	<!-- Web-Fonts -->
		<link href='//fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<!-- //Web-Fonts -->
	<?php
	include 'header.php';
	?>
</head>

		<?php 
			require 'config.php';
			
			if(isset($_POST['email'])){
				$email = $_POST['email'];
			}		
			
				
			//send email
			if(!empty($email)) {
			    //generate password
			    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			    $password = substr( str_shuffle( $chars ), 0, 8);
			    //update table
			    $query = "UPDATE user 
			              SET encryptedpassword=\"".$password."\"
			              WHERE email=\"".$email."\"";
			    
			    $result = $mysqli->query($query);
			    if ($result) {
			        //send email
			        $subject = "Your Recovered Password";
			        //$message = "Please use this password to login ".$password."<br> Please click on this link";
			        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			                       <html xmlns="http://www.w3.org/1999/xhtml">
			                       <head>
			                       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			                       </head>
			                       <body style="background-color:#ffb900;margin:0 auto;text-align: center;width: 500px;">
			                       <img src="https://i2.wp.com/beanexpert.online/wp-content/uploads/2017/06/reset-password.jpg?resize=380%2C240&ssl=1">
			                       <div>
			                               <p>Please use this password to login : <b>'.$password.'</b><br>
			                                Please click the following link to proceed to the Questionnaire <a href ="http://localhost:8888/Treaty/reset_password.php">Click here</a></p>
			                       </div>
			                       </body>
			                       </html>';
			        $headers = "From : poonam.6788@gmail.com";
			        $headers  = 'MIME-Version: 1.0' . "\r\n";
			        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			        if(mail($email, $subject, $message, $headers)){
			            echo '<script>window.location.href = "reset_password.php";</script>';
			        }
			        
			    } else {
			        $emailresponse = "User does not exist. Please signup.";
			    }
			}
			?>
	</head>
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
                            <li><a href="index.php#portfolio">Business</a></li>
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
        
		<div class="main" style="margin-bottom: 4%;margin-top: 2%;">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<div class="img-w3l-agile">
					<img src="images/1.jpg" alt=" ">
					<form style="color: black!important;"></form>
				</div>
				<div class="resp-tab-item" style="width:100%; padding:0px;">
					<h3><span>Forgot Password ?</span></h3>
				</div>
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content">
						<div class="login-top">
							<form method="post">
								<input type="email" name="email" class="email" placeholder="Email" required/>
								<label style="color:red;">
								<?php 
									if(isset($response)){
										echo $response;
									}
								?>
								</label>
								<input class="button" type="submit" value="Submit">
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