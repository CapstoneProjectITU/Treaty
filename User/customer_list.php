<?php
	// Start the session
	session_start();
?>
<!DOCTYPE html>
<html class=" js cssanimations csstransitions">
	<head>
	<title>Your Customers</title>

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
	?>		
	<style type="text/css">
		.customerTable{
			width: 100%;
			height: 400px;
			background-color: #f1f1f2;
			padding: 3%;
			overflow: auto;
			text-align: center;
			
		}
		.customerTable th{
			text-align: center;
		}
		body{
			padding: 0px!important;
		}
		.custTable{
			border: 1px solid green;
			padding: 2%;
			border-collapse: collapse!important;
    		border-spacing: 1px!important;
		}
		.heading{
			font-size: 150%;
			margin-bottom: 3%;
		}
	</style>

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
                                    echo "<li><a href='business.php'>Dashboard</a></li>";
                                }
                            ?> 
                            <li class="active"><a href="customer_list.php">Customers</a></li>                                                       
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

		<div class="tabs" style="padding:20px;">
			<p class="secHead" style="padding:0px;">Your Customers</p>
			<?php 
				$userid = $_SESSION['userid']; 

		$query = "SELECT c.userid, c.balance, c.businessid, u.firstname, u.lastname
					  FROM customerbusiness c, userdetail u
					  WHERE u.userid = c.userid and c.businessid = ".$userid." order by c.modified desc";
			$result = $mysqli->query($query);
			$last_id = $conn->insert_id;
			echo $last_id;
			?>
			<table border='1' class="table-sort table-sort-search table-sort-show-search-count">
				<thead>
						<tr>
							<th>Name</th>
							<th>Rewards</th>
						</tr>
				</thead>
				
			<?php
			if ($result->num_rows > 0) {
				while($row = $result->fetch_array()){	  
			?>
				<tr>
					<td><?php echo $row["firstname"]." ".$row["lastname"];?></td>
					<td><?php echo $row["balance"];?></td>	
				</tr>	
					<?php	
				}
			}	
			?>
		</table>	
		</div>
	</div>
	<?php include 'footer.php' ?>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="searchBoxPlugin/tablesort.js"></script> 
<script type="text/javascript">
            // For Demo Purposes
            $(function () {
                $('table.table-sort').tablesort();
                hljs.initHighlightingOnLoad(); // Syntax Hilighting
            });
        </script>
</body>
</html>