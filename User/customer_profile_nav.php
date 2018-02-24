<?php
    // Start the session
    session_start();
?>
<link rel="stylesheet" type="text/css" href="css/navigation.css" />
<link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">
<style type="text/css">
.brand{
	display: block;
    float: left;
    padding: 10px 20px 10px;
    margin-left: -20px;
    font-size: 20px;
    font-weight: 200;
    color: #777777;
    text-shadow: 0 1px 0 #ffffff;
}
</style>
<header class="clearfix">
    <div class="container">
			<div class="header-left">
				<a href="#" class="brand">
                        <img src="images/logoIcon.png" width="120" height="40" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
			</div>
			<div class="header-right">
				<label for="open">
					<span class="hidden-desktop"></span>
				</label>
				<input type="checkbox" name="" id="open">
				<nav style="padding-top: 2%;" >
					<a href="../index.php">Home</a>
					<?php
						if(isset($_SESSION['customerdashboard'])){
							echo "<a href='customer.php'>Dashboard</a>";
						}
					?>
					<a href="../index.php">Logout</a>
				</nav>
			</div>
		</div>
	</header>
