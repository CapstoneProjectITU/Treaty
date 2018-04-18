<?php
	
	if(session_id() == '') {
    	session_start();
	}

	if(isset($_SESSION['google_access_token'])){
		unset($_SESSION['google_access_token']);
	}

	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientID("694841583247-srsrijmik54nqirunj921a892a8v82q2.apps.googleusercontent.com");
	$gClient->setClientSecret("Ix0PbjMPOTZUh88VW-SsXDWx");

	$gClient->setApplicationName("Treaty Google Login");
	//$gClient->setRedirectUri("http://localhost/Treaty/social_login/google-callback.php");	
	$gClient->setRedirectUri("https://www.ruchirkute.com/Treaty/social_login/google-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

?>