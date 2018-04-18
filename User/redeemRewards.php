<?php
    require '../config.php';
    
    $points = $_POST['redeemPoints'];
    $bid = $_GET['bid'];
    $cid = $_GET['cid'];
    //added this offerid in rewardstransaction table
    $offerid = $_POST['offer_id'];

    //get current balance rewards of customer
    $query = "Select balance from customerbusiness
     		where userid = ".$cid." and businessid=".$bid;
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){ 
        $bal = $row['balance'] . '<br />';
    }
    $balance = $bal - $points;
    
    //get business name
    $query = "select businessname from businessdetail
     		where userid=".$bid." LIMIT 1";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()){ 
        $businessname = $row['businessname'];
    }
    
    //redeem rewards from customer account
    //old query that create new rows for every redeem reward activity.             
    $qryTrans  = "INSERT INTO rewardtransaction(userid, businessid,
            earnedpoints, redeemedpoints, balance, isactive, modified, created,offerid)
            VALUES (\"" . $cid . "\",\"" . $bid . "\", 0, \"" . $points . "\",\"" . $balance . "\", 1, sysdate(), sysdate()," . $offerid . ")";
    $resTrans = $mysqli->query($qryTrans);

    //query change from insert to update to make only one entry in customer business table with updated redeemed balance
    $qry = "UPDATE customerbusiness SET earnedpoints= 0, redeemedpoints= ".$points.", balance= ".$balance.", modified = sysdate() WHERE userid=".$cid." and businessid=".$bid;
    $res = $mysqli->query($qry);
    if ($res) {        
        //send text message to customer
        $queryPhone = "Select phonenumber from user
                where id = ".$cid;
        $resultPhone = $mysqli->query($queryPhone);
        while($rowPhone = $resultPhone->fetch_assoc()){ 
            $phone = $rowPhone['phonenumber'];
            $text = $points. " rewards redeemed from your treaty account. \nYour current Treaty Rewards are - ".$balance."\n\n\n";
            
            //echo '<script>window.location.href = "send_sms.php?flag=redeem&phone='.$phone.'&points='.$points.'&balance='.$balance.'";</script>'; 

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
            
            $query = "SELECT email FROM user WHERE id=\"" . $cid . "\" and isactive=1";
            $result = $mysqli->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                $email = $row["email"];
                //send email
                $subject = "Reward points redeemed!!";
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                             <html xmlns="http://www.w3.org/1999/xhtml">
                             <head>
                             <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                             </head>
                             <body style="background-color:#a9c750;margin:0 auto;text-align: center;width: 500px;padding-top:5%; font-size: 18px;">
                             <img src="https://s-media-cache-ak0.pinimg.com/originals/b0/a0/a3/b0a0a33dee17c0640f3db16940447c39.jpg">
                             <div>
                                 <p> Congratulations '.$points.' rewards redeemed from your treaty account for business '.$businessname.'!!<br>
                                 Your current Treaty Rewards are - '.$balance.'</p>
                             </div>
                             </body>
                             </html>';
                $headers = 'From: Treaty <treatyrewards@gmail.com>' . "\r\n";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                mail($email, $subject, $message, $headers,  "-f treatyrewards@gmail.com");
            }            
            echo '<script>alert("Rewards redeemed successfully.");</script>';
            echo '<script>window.location.href = "business.php";</script>';
        }
    } else {
        echo "Failed to redeem rewards.";
    }
?>