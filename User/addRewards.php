<?php	
	require '../config.php';
	$amount = round($_POST['amount']); 
	$bid = $_GET['bid'];
	$cid = $_GET['cid'];
//get current balance rewards of customer
	$query = "Select balance from customerbusiness
	 		where userid = ".$cid." and businessid=".$bid;
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){ 
	    $bal = $row['balance'] . '<br />';
	}
	$balance = $bal + $amount;

//add rewards to customer account  
//old query that create new rows for every add reward activity.
            
	$qryTrans  = "INSERT INTO rewardtransaction(userid, businessid,
	         earnedpoints, redeemedpoints, balance, isactive, modified, created)
	         VALUES (\"" . $cid . "\",\"" . $bid . "\", \"" . $amount . "\", 0,\"" . $balance . "\", 1, sysdate(), sysdate())";
	$qryResult = $mysqli->query($qryTrans);
	//echo $qryTrans;die;

	//get business name
    $query = "select businessname from businessdetail
     		where userid=".$bid." LIMIT 1";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){ 
        $businessname = $row['businessname'];
    }
	
	//query change from insert to update to make only one entry in customer business table with updated added balance
 	$qry = "UPDATE customerbusiness SET earnedpoints= ".$amount.", redeemedpoints= 0, balance= ".$balance.", modified = sysdate() WHERE userid=".$cid." and businessid=".$bid;
	$res = $mysqli->query($qry);
    if ($res) {
    		//send text message to customer
		    $queryPhone = "Select phonenumber from user
			 		where id = ".$cid;
			$resultPhone = $mysqli->query($queryPhone);
			while($rowPhone = $resultPhone->fetch_assoc()){ 
			    $phone = $rowPhone['phonenumber'];
			    $text = $amount. " rewards added to your treaty account. \nYour current Treaty Rewards are - ".$balance."\n\n\n";
			    
			    //echo '<script>window.location.href = "send_sms.php?flag=add&phone='.$phone.'&amount='.$amount.'&balance='.$balance.'";</script>'; 
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
				
				//send mail to business owner
				$query = "SELECT email FROM user WHERE id=\"" . $cid . "\" and isactive=1";
				$result = $mysqli->query($query);
				if ($result->num_rows > 0) {
					$row = $result->fetch_array();
					$email = $row["email"];
					//send email
					$subject = "Rewards point added to your account!!";
					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								 <html xmlns="http://www.w3.org/1999/xhtml">
								 <head>
								 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								 </head>
								 <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding-top:5%; font-size: 20px;">
								 <img src="https://s-media-cache-ak0.pinimg.com/originals/b0/a0/a3/b0a0a33dee17c0640f3db16940447c39.jpg">
								 <div>
										 <p> Congratulations '.$amount.' points have been added to your rewards account for '.$businessname.'! <br>
									 		 Your total rewards balance is '.$balance.'</p>
								 </div>
								 </body>
								 </html>';
					$headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					mail($email, $subject, $message, $headers, "-f treatyrewards@gmail.com");
				}
				
				//Code end 
				echo '<script>alert("Rewards Added successfully.");</script>';
				echo '<script>window.location.href = "business.php";</script>';
			}
    } else {
        echo "Failed to add rewards.";
    }

?>