<?php
	require '../config.php';
	session_start();
	$userid = $_SESSION['userid'];
	$bid = $_GET['bid'];
	
	//old query that sets isactie flag to 0 without deleting record
	// $query = "UPDATE customerbusiness SET isactive=0 , modified = sysdate() WHERE userid=".$userid." and businessid=".$bid;

	//new query that deletes entire record from table
	$query = "DELETE from customerbusiness where userid=".$userid." and businessid=".$bid;

	$result = $mysqli->query($query);
    if ($result) { 
    	//query to send sms after unsubscribe
    	$query = "Select phonenumber,businessname,email from user u,businessdetail b
		 	 		where u.id = ".$userid." and b.userid= ". $bid. " LIMIT 1";		
		$result = $mysqli->query($query);
		while($row = $result->fetch_assoc()){
			$phone = $row['phonenumber'];
			$businessname = $row['businessname'];
		    //$businessname = $row['email'];
			$email = $row['email'];
		    $text = "You are Successfully unsubscribed for ".$businessname."\n\n\n"; 

		    //actual code to send text msg
		    $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
			        'api_key' => e4add77b,
			        'api_secret' => '6LWxE3X9EaiKil32',
			        'to' => $phone,
			        'from' => 12015946271,
			        'text' => $text
			    ]);
		    $ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			
			//send email
			$subject = "You have successfully unsubscribed to " . $businessname . "!";
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						 <html xmlns="http://www.w3.org/1999/xhtml">
						 <head>
						 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						 </head>
						 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding:5%; font-size: 20px;">
						 <img src="http://img.eliteemail.com/subcenter/unsubscribe.jpg">
						 <div>
							 <p> You have successfully unsubscribed to ' . $businessname . ' on Treaty.</p>
						 </div>
						 </body>
						 </html>';
			$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			mail($email, $subject, $message, $headers, "-f treatyrewards@gmail.com");
			
			echo "<script>alert('Unsubscribed Successfully.');</script>";
			echo '<script>window.location.href = "customer.php#horizontalTab2";</script>'; 
	   }
	}
?>