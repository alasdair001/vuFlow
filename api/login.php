<?php
	
	/*

		Name: login
		Description: Used for logging into site
		Author: Breeze
		
	*/		
	
	include("core.php");
	import(array("core.database_utils", "crust.database_utils"));
	
	if(!isset($_POST['api_method'])
	{
		echo "CLIENT API CONNECTION ERROR";
		exit;
	}
	
	$web_method = $_POST['api_method'] != "APP";
	
	function pushState($message, $success)
	{
		db_close();
		if($web_method)
		{
			echo $message;
			exit;
		}else
		{
			if(!$success)
			{
				setcookie("authen_error", $message, time() + 900); // Create cookie that expires after 15 mins
				header("Location: /");
			}else
			{
				header("Location: /");
			}			
			exit;
		}
	}
	
	if(!isset($_POST['user_identifier']))
	{
		pushState("You must enter a username/email.", false);
	}
	
	if(!isset($_POST['user_password']))
	{
		pushState("You must enter a password.", false);
	}
	
	$identifier = $_POST['user_identifier'];
	$password = $_POST['user_password'];
	
	if(!db_connect())
	{
		pushState("Failed to connect to database.", false);
	}
	
	$user = getUserByIdentifier($identifier);
	
	if($user == false)
	{
		pushState("Incorrect login details.", false);
	}
	
	$password = md5($password.$user['salt']);
	
	$user = getUserByPayload($user['id'], $password);
	
	if($user == false)
	{
		pushState("Incorrect login details.", false);
	}else
	{
		pushState("Incorrect login details.", false);
	}
	
	$session_token = createSession($user);
	
	if(!$session_token)
	{
		pushState("Failed to create session token.", false);
	}
	
	if($web_method)
	{
		setcookie("session_token", $session_token, time() + 300);
	}
	
	pushState($session_token, true);	
?>