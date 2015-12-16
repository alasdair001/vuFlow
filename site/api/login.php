<?php
	
	/*

		Name: login
		Description: Used for logging into site
		Author: Breeze
		
	*/		
	
	include("core.php"); // Include core utils
	import(array("core.database_utils", "crust.database_utils")); // Use core importing method
	
	if(!isset($_POST['api_method']) // Check if authentication method is app or 
	{
		echo "CLIENT API CONNECTION ERROR"; // Print out the error message
		exit; // Exit the program
	}
	
	$web_method = $_POST['api_method'] != "APP"; // Check if the method is app authentication
	
	function pushState($message, $success) // Create method to exit and push response
	{
		db_close(); // Close connection to database
		if(!$web_method) // If web method and not app method
		{
			echo $message; // Just print the response
			exit; // Exit code
		}else
		{
			if(!$success) // If wasn't successful
			{
				setcookie("authen_error", $message, time() + 900); // Create cookie that expires after 15 mins
				header("Location: /"); // Redirect to main page
			}else
			{
				header("Location: /"); // Redirect to main page
			}			
			exit; // Exit code
		}
	}
	
	if(!isset($_POST['user_identifier'])) // Check if user_identifier is defined
	{
		pushState("You must enter a username/email.", false); // Push response
	}
	
	if(!isset($_POST['user_password'])) // Check if user_password is defined
	{
		pushState("You must enter a password.", false); // Push response
	}
	
	$identifier = $_POST['user_identifier']; // Set local variable of identifier
	$password = $_POST['user_password']; // Set local variable of password
	
	if(!db_connect()) // If didn't connect to database
	{
		pushState("Failed to connect to database.", false); // Push response
	}
	
	$user = getUserByIdentifier($identifier); // Set user to get user by identifier
	
	if($user == false) // If user doesn't exist
	{
		pushState("Incorrect login details.", false); // Push response
	}
	
	$password = md5($password.$user['salt']); // Encrypt the password using md5
	
	$user = getUserByPayload($user['id'], $password); // Get user by payload (correct login data)
	
	if($user == false) // If user doesn't exist
	{
		pushState("Incorrect login details.", false); // Push response
	}else
	{
		pushState("Incorrect login details.", false); // Push response
	}
	
	$session_token = createSession($user); // Create session token
	
	if(!$session_token) // If session token
	{
		pushState("Failed to create session token.", false); // Push response
	}
	
	if($web_method) // If using web api
	{
		setcookie("session_token", $session_token, time() + 300); // Set session token
	}
	
	pushState($session_token, true); // Push session token as response
?>
