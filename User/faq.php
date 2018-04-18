<?php
	session_start();
	?>
<!DOCTYPE html>
<html class=" js cssanimations csstransitions">

<head>
<style>
.accordion {
    background-color: #A9C750;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: center;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    margin-bottom: 10px!important;
}
.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}
.activeClass:after {
    content: "\2212";
}

.activeClass:after {
    content: "\2212";
}

.activeClass, .accordion:hover {
    color: white;
}

.panelContainer{
	display: none;

}
.panel {
    display: none;
}
.panel p{
	color: black;
	text-align: center;
}
</style>

	<title>Frequently Asked Questions</title>

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
                        <li class="active"><a href="#">FAQ</a></li>
                        <?php if(isset($_SESSION['userid'])): ?>
                          <li><a href='logout.php'>Logout</a></li>
                        <?php else: ?>
                           <li><a href='../login.php'>Login</a></li>
                        <?php endif; ?>
                       <!-- <li><a href="find_location.php">Find Location</a></li>
                        <li><a href="customer_profile.php">Profile</a></li>
                        <li><a href="../logout.php">Logout</a></li>       -->                     
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
							<li class="resp-tab-faq-item"><i class="fa fa-suitcase" aria-hidden="true"></i>Customer</li>
							<li class="resp-tab-faq-item"><i class="fa fa-university" aria-hidden="true"></i>Business Owner</li>
						</ul>
					</div>

					<div class="tab-right">
						<div class="resp-tabs-container">
							<!-- QR Code -->
							<div class="tab-1 resp-tab-content gallery-images">
								<div class="wthree-subscribe">
									<p class="secHead">About Treaty</p>
									<button class="accordion">What is Treaty?</button>
										<div class="panel">
										  <p>Treaty is a loyalty rewards program that offers platform for business owners and customers to improve their bonding through reward program. 
										  </p>
										</div>

										<button class="accordion">How do I become a Treaty Member?</button>
										<div class="panel">
										  <p>Sign up on Treaty.com as a customer and you are all set to subscribe to your favorite bisnesses who supports Treaty.</p>
										</div>

										<button class="accordion"> How does Treaty work?</button>
										<div class="panel">
										  <p>Earn points : The business owner will scan your QR code. And you will get points according to your purchase. For eg. 30 points for $30 you spent. <br>
										  Note : points are specific to each business and can only be used for redemption at any branch of that business.<br> 
										  Redeem rewards : The business owner will scan your QR code. He will select the offer of your choice and you want to redeem. The offer will get redeemed and those points will get subtracted from your rewards balance.</p>
										</div>
										<button class="accordion">Where can I find places to Treaty at?</button>
										<div class="panel">
										  <p>You can check out Treaty locations at Find locations link on website. Treaty businesses are tagged with a red pin. You can find all the Treaty businesses near you. Also get address and direction to go to that place.</p>
										</div>
										<button class="accordion"> I got a new phone Number. Did I lose all of my Treaty Points?</button>
										<div class="panel">
										  <p>No, You can change your mobile number. As long as you are logged into your account with the same email address and password, and update your mobile number in Treaty profile you will have all of your points.</p>
										</div>

										<p class="secHead">Treaty Account</p>
										<button class="accordion">  I forgot my password.</button>
										<div class="panel">
										  <p>To reset your password follow the instructions below:

											1. Click on “Log In”<br>
											2. Click "Forgot password?"<br>
											3. Enter in the email address linked to your Treaty account<br>
											4. Once submitted, you’ll receive an email and will get redirect to reset password page.<br>
											5. Open up the email copy the temporary password provided.<br>
											6. Enter in the temporary password on reset password page.<br>
											7. Enter new password you want to set twice.<br>
											8. Your password is updated now!! </p>
										</div>
										<button class="accordion"> I don't want email and text messages from Treaty.</button>
										<div class="panel">
										  <p> This makes us sad. But if you really want to update your notification settings, follow these steps:

											Sign into your account at Treaty<br>
											In the profile section uncheck "Do you want offer notifications?"<br>
											Click on save button.
										  </p>
										</div>

										<p class="secHead">Treay Rewards</p>
										<button class="accordion"> How do I earn points?</button>
										<div class="panel">
										  <p> The business owner will scan your QR code. And you will get points according to your purchase. For eg. 30 points for $30 you spent. </p>
										</div>
										<button class="accordion"> If I don’t have my mobile with me‚ how do I earn points for my visit?</button>
										<div class="panel">
										  <p>You can send your mobile number along with the purchase receipt from your registerd email address to our support - treatyrewards@gmail.com and you will get your points.</p>
										</div>
										<button class="accordion"> I want to see all of the points I have earned at different stores. How do I do that?</button>
										<div class="panel">
										  <p>Visit Treaty website:<br>

											Sign into your account<br>
											Click on Rewards tab on Dashboard<br>
											Scroll down and you’ll see your total earned points for each business.</p>
										</div>
										<button class="accordion"> Do I need to purchase something to get my Treaty Points?</button>
										<div class="panel">
										  <p>Yes. You will get 1 points per $ you spent at business.</p>
										</div>
										<button class="accordion"> Do Treaty Points expire?</button>
										<div class="panel">
										  <p>Your Treaty Points will never expire and can be redeemed at your leisure for as long as the business has its loyalty program.</p>
										</div>
										<button class="accordion"> My favorite business just uninstalled Treaty. What happens to my points?</button>
										<div class="panel">
										  <p>Unfortunately there’s not much we can do if a business decides to end their loyalty program. However, if you earned points at a multi-location business and one decides to no longer use Belly, you can redeem your points at one of their locations that still uses Treaty.</p>
										</div>
										<button class="accordion">How do I redeem points for rewards?</button>
										<div class="panel">
										  <p>The business owner will scan your QR code. He will select the offer of your choice and you want to redeem. The offer will get redeemed and those points will get subtracted from your rewards balance.</p>
										</div>
										<button class="accordion">  What happens to my point total after I redeem points for a reward?</button>
										<div class="panel">
										  <p>The point value of the reward is subtracted from your total points. For example, if you have 20 points and redeem a reward for 20 points, then you will have 0 points at that business. If you have 20 points and redeem a reward for 15 points, you will have 5 points remaining at that location.</p>
										</div>
								</div>
							</div>
				 
	 


							<div class="tab-1 resp-tab-content">
								<p class="secHead">About Treaty</p>
								<div class="agileinfo-recover">
									<button class="accordion">Do I need WiFi for Treaty?</button>
										<div class="panel">
										  <p>Yes, WiFi is critical for Treaty to work. You cannot add or redeem points for rewards if there isn’t a WiFi connection.</p>
									</div>
									<button class="accordion">How does the redemption process work?</button>
										<div class="panel">
										  <p> 1. Customer needs to log in to his Treaty account from mobile, he/she will have QR code that you will scan in add/redeem rewards section on dashboard. <br>
										  2. After scanning customer QR code you will see dropdown list of offers which the customer is eligible and redeem. <br>
										  3. Ask customer which offer they want to redeem and select that from dropdown list.<br> 4. At last click on Redeem Rewards button.</p>
									</div>
									<button class="accordion">Can customers redeem points at my business that they have earned at other Treaty Businesses?</button>
										<div class="panel">
										  <p>No, points are specific to the location they were earned at.</p>
									</div>
									<p class="secHead">Treaty Account</p>
									<button class="accordion">Where can I see my subscribed customers and thier current reward points?</button>
										<div class="panel">
										  <p> You can view your subscribed customers and thier current reward points - <br>
										  Log In on Treaty<br>
										  Click on Customers tab on Dashboard</p>
									</div>
									<button class="accordion">Where can I view and update my current offers?</button>
										<div class="panel">
										  <p> Follow the below steps - <br>
										  	1. Log in to Treaty<br>
										 	2. Click on Offers tab on dashboard<br>
										 	3. To edit offer details click on settings icon infront of the offer name
										</p>
									</div>

									<button class="accordion">Where can I view and update my business branches?</button>
										<div class="panel">
										  <p> Follow the below steps - <br>
										  	1. Log in to Treaty<br>
										 	2. Click on Business tab on dashboard<br>
										 	3. To edit business details click on settings icon infront of the branch
										</p>
									</div>
									<button class="accordion">Where can I register my business branches?</button>
										<div class="panel">
										  <p> Follow the below steps - <br>
										  	1. Log in to Treaty<br>
										 	2. Click on Register Business tab on dashboard<br>
										 	3. Fill up the branch details and click on Save
										</p>
									</div>
									<button class="accordion">Where can I create new offer?</button>
										<div class="panel">
										  <p> Follow the below steps - <br>
										  	1. Log in to Treaty<br>
										 	2. Click on Create offer tab on dashboard<br>
										 	3. Fill up the offer details and click on Save
										</p>
									</div>
									<button class="accordion">The offer I created will be applicable for my all branches?</button>
										<div class="panel">
										  <p> Yes, The offers you create will be applicable for your all branches and customer can redeem that offer at any branch of your business
										</p>
									</div>
									
									<p class="secHead">Add Redeem Treay Rewards</p>
									<button class="accordion">How can I add points to customer account?</button>
										<div class="panel">
										  <p>Follow the below steps : <br> Login to your Treaty account<br>Go to dashboard<br>In add/redeem rewards section scan the QR code from customer mobile phone<br>add amount the customer has spent on your business<br>Click on Add Rewards button</p>
									</div>
									<button class="accordion">How can I redeem points for customer?</button>
										<div class="panel">
										  <p><p>Follow the below steps : <br> Login to your Treaty account<br>Go to dashboard<br>In add/redeem rewards section scan the QR code from customer mobile phone<br>Select the offer customer want to redeem<br>Click on Redeem Rewards button</p></p>
									</div>
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
	
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("activeClass");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>
</body>
</html>
