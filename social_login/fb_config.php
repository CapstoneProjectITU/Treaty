<?php 
	if(session_id() == '') {
    	session_start();
	}
	
	if(isset($_SESSION['fb_access_token'])){
		unset($_SESSION['fb_access_token']);
	}
	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '790076827852146',
		'app_secret' => 'fad787dd76c3b7017065510c9063b124',
		'default_graph_version' => 'v2.11'
	]);

	$helper = $FB->getRedirectLoginHelper();
	$_SESSION['FBRLH_state']=$_GET['state'];
?>