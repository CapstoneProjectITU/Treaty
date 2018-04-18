<?php
	
	require '../config.php';
	$bid = $_GET['bid'];
	$cid = $_GET['cid'];

	//subscribe for business
	$query  = "INSERT INTO customerbusiness(userid, businessid,earnedpoints, redeemedpoints, balance, isactive, modified, created)
	         VALUES (\"" . $cid . "\",\"" . $bid . "\", 20, 0, 20, 1, sysdate(), sysdate())";
	
	$result = $mysqli->query($query);
    if ($result) {

    		//to display initial transaction in transaction table
    		$query_trans  = "INSERT INTO rewardtransaction(userid, businessid,earnedpoints, redeemedpoints, balance, isactive, modified, created)
	         VALUES (\"" . $cid . "\",\"" . $bid . "\", 20, 0, 20, 1, sysdate(), sysdate())";
			$result = $mysqli->query($query_trans);
    		
    		//send text message and email to customer, limiting to 1 because there are multiple business entries in businessdetail table
		    $query = "Select phonenumber,businessname,email from user u,businessdetail b
			 		where u.id = ".$cid." and b.userid= ". $bid ." LIMIT 1";			 
			$result = $mysqli->query($query);
			while($row = $result->fetch_assoc()){ 
				
				$phone = $row['phonenumber'];
				$businessname = $row['businessname'];
			    //$businessname = $row['email'];
				$email = $row['email'];
			    $text = "You are Successfully subscribed for ".$businessname.". 20 rewards added to your Treaty account. \nYour current Treaty Rewards - 20.\n\n\n"; 

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
					//Code end 
					
					//send email
					$subject = "You have subscribed to a new business on Treaty!";
					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
												 <html xmlns="http://www.w3.org/1999/xhtml">
												 <head>
												 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
												 </head>
												 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding-top:5%; font-size: 20px;">
												 <img src="http://www.kajenconsulting.com/wp-content/themes/kajen/images/fullySubscribed1.png">
												 <div>
														 <p> You have subscribed to a new business : '.$businessname.'.<br>
														 20 rewards added to your Treaty account.<br>
														 Your current Treaty Rewards - 20.</p>
												 </div>
												 </body>
												 </html>';
					$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					mail($email, $subject, $message, $headers, "-f treatyrewards@gmail.com");
					
					echo "<script>alert('Subscribed Successfully.');</script>";
    			echo '<script>window.location.href = "customer.php#horzontalTab3";</script>';
			}
    	
    } 
    else 
    {
		echo $query;
        echo "Failed to subscribe rewards.";
    }

?>