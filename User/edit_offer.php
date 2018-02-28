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

	<?php
	include 'header.php';
	?>
</head>

	<?php 
		require '../config.php';
		$offerid = $_GET["offerid"];
		
		if (isset($_POST['oName'])) {
			$oName = $_POST['oName'];
		}
		if (isset($_POST['oDesc'])) {
			$oDesc = $_POST['oDesc'];
		}
		if (isset($_POST['oPoints'])) {
			$oPoints = $_POST['oPoints'];
		}
		if (isset($_POST['datepicker1'])) {
			$datepicker1 = $_POST['datepicker1'];
		}
		if (isset($_POST['datepicker2'])) {
			$datepicker2 = $_POST['datepicker2'];
		}
		if (isset($_POST['cancel'])) {
			$cancel = $_POST['cancel'];
		}
		if (isset($_POST['delete'])) {
			$delete = $_POST['delete'];
		}
		if(!empty($delete)) {
			$query = "UPDATE businessoffer
					 SET isactive=0 
					 WHERE id=".$offerid;
			print $query;
			$result = $mysqli->query($query);
			if ($result) {
				echo '<script>window.location.href = "business.php#horizontalTab2";</script>';
			} else {
				echo "Failed to delete profile";
			}
		} else if(!empty($cancel)){
			echo '<script>window.location.href = "business.php#horizontalTab2";</script>';
		} else if(!empty($oName)) {
			$query = "UPDATE businessoffer
					 SET offername=\"".$oName."\", offerdescription=\"".$oDesc."\", creditedpoints=\"".$oPoints."\", startdate=\"".$datepicker1."\", expirationdate=\"".$datepicker2."\", modified=sysdate() 
					 WHERE id=".$offerid;
			
			$result = $mysqli->query($query);
			if ($result) {
				echo '<script>window.location.href = "business.php#horizontalTab2";</script>';
			} else {
				echo "Failed to update profile";
			}
		} else if(!empty($offerid)) {
			$query = "SELECT offername, offerdescription, creditedpoints, startdate, expirationdate
					  FROM businessoffer
					  WHERE id=".$offerid;
			$result = $mysqli->query($query);
			$businessofferresultset = array();
			if ($result->num_rows > 0) {
				$row = $result->fetch_array();
				array_push($businessofferresultset, $row["offername"]);
				array_push($businessofferresultset, $row["offerdescription"]);
				array_push($businessofferresultset, $row["creditedpoints"]);
				array_push($businessofferresultset, $row["startdate"]);
				array_push($businessofferresultset, $row["expirationdate"]);
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
                                if($_SESSION['displaydashboard']){
                                    echo "<li class='active'><a href='business.php'>Dashboard</a></li>";
                                }
                            ?> 
                            <li><a href="customer_list.php">Customers</a></li>                                                       
                            <li><a href="business_profile.php">Profile</a></li>
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
							<!-- Create Offer section -->
							<div class="tab-1 resp-tab-content gallery-images">
								<p class="secHead">Edit Offer</p>
								<div class="wthree-subscribe">	
									<form action="#" method="post" class="agile_form">
										<input type="text" placeholder="Offer Name" name="oName" class="name agileits" required=""
										 	value="<?php echo !isset($businessofferresultset[0]) ? '' : $businessofferresultset[0] ?>" />
										<input type="text" placeholder="Offer Description" name="oDesc" class="name agileits" required=""
											value="<?php echo !isset($businessofferresultset[1]) ? '' : $businessofferresultset[1] ?>" />
										<input type="text" placeholder="Offer Points" name="oPoints" class="name agileits" required=""
											value="<?php echo !isset($businessofferresultset[2]) ? '' : $businessofferresultset[2] ?>" />
										<input placeholder="Start Date" class="date" name="datepicker1" id="datepicker1" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""
											value="<?php echo !isset($businessofferresultset[3]) ? '' : $businessofferresultset[3] ?>" />
										<input placeholder="End Date" class="date" name="datepicker2" id="datepicker2" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" required=""
											value="<?php echo !isset($businessofferresultset[4]) ? '' : $businessofferresultset[4] ?>" />
										<div class="submit"><br>
											<!--After click on save button redirect to offers page - http://localhost:8888/Treaty/User/business.php#horizontalTab2-->
										  <input type="submit" value="Save">
										  <input name="cancel" type="submit" value="Cancel">
										</div>   
									</form>
								</div>
							</div>
							<!-- delete offer -->
							<!-- Deactivate customer account -->
							<div class="tab-1 resp-tab-content">
								<p class="secHead">Delete offer</p><br>
								<img class="settingImg" src="images/deactive.png" width="100" height="100">
								<div class="agile-send-mail">
									<form action="#" method="post" class="agile_form">
										<p class="b_name" style="color: white;text-align: center;">Click on below button to Delete your Offer.</p><br>	
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