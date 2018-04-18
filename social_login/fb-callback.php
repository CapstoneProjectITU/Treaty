<?php
	session_start();
	include '../config.php';
	require_once "fb_config.php";


	try {
		//$fb_access_token = $helper->getAccessToken('http://localhost/Treaty/social_login/fb-callback.php');
		$fb_access_token = $helper->getAccessToken('https://www.ruchirkute.com/Treaty/social_login/fb-callback.php');
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$fb_access_token){
		//header('Location: ../login.php');
		//exit();
		echo '<script>window.location.href = "../login.php";</script>';
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$fb_access_token->isLongLived())
		$fb_access_token = $oAuth2Client->getLongLivedAccessToken($fb_access_token);

	$response = $FB->get("/me?fields=id, first_name, last_name, email", $fb_access_token);
	$fb_user_data = $response->getGraphNode()->asArray();
	//Set session Variables
	$_SESSION['email'] = $fb_user_data['email'];
	$_SESSION['first_name'] = $fb_user_data['first_name'];
	$_SESSION['last_name'] = $fb_user_data['last_name'];	
	$_SESSION['fb_access_token'] = (string) $fb_access_token;
	

	// Sign In
	 if (isset($_SESSION['fb_signin_btn'])){

		$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";
			
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_array();
			$_SESSION['userid'] = $row['id']; 
	    	if(strcasecmp($row['role'], 'Business Owner') == 0) {
				//header('Location: ../User/business_profile.php');				
				//exit();
				echo '<script>window.location.href = "../User/business_profile.php";</script>';
			} 
			else 
			{
				//header('Location: ../User/customer_profile.php');
				//exit();
				echo '<script>window.location.href = "../User/customer_profile.php";</script>';
			}
		}
		
	}	

	//Facebook Sign Up
	if (isset($_SESSION['fb_signup_btn'])){
		//Check user exists				
		$query = "SELECT id, role FROM user where email=\"".$_SESSION['email']."\"";
					
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
			 $_SESSION['signupresponse_social'] = "User with email already exists. Please sign in.";
			 //header('Location: ../login.php');
			 //exit();
			 echo '<script>window.location.href = "../login.php";</script>';
		}
		else
		{
			$signUpPhone = '1234567890';
			$signUppassword = 'test1234';
			$query = "INSERT INTO user (email,role,phonenumber,encryptedpassword)
						VALUES (\"".$_SESSION['email']."\",\"".$_SESSION['signUprole_social']."\",\"".$signUpPhone."\",\"". $signUppassword."\")";
		    
		    $result = $mysqli->query($query);		    
		    if ($result){

		    	//Fetch user id to set it in session.
				$query_userid = "SELECT id FROM user where email=\"".$_SESSION['email']."\"";
		        $result_userid = $mysqli->query($query_userid);
		        if ($result_userid->num_rows > 0) {
		        	$row = $result_userid->fetch_array();
		            $_SESSION['userid'] = $row['id'];		                        
		        }
		    	
				if(strcasecmp($_SESSION['signUprole_social'], 'Business Owner') == 0){
					//header('Location: ../User/business_profile.php');
					//exit();
					echo '<script>window.location.href = "../User/business_profile.php";</script>';
				} 
				else
				{
					//header('Location: ../User/customer_profile.php');
					//exit();
					echo '<script>window.location.href = "../User/customer_profile.php";</script>';
					
				}
			}
			else 
			{
			    $_SESSION['signupresponse_social'] = "Failed to signup";
			}
		}								
	}			
?>