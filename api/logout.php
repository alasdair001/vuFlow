<?php
	
	/*

		Name: logout
		Description: Used for logging out of site
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
	
	function pushState($message) // Create method to exit and push response
	{
		db_close(); // Close connection to database
		if(!$web_method) // If web method and not app method
		{
			echo $message; // Just print the response
			exit; // Exit code
		}else
		{
			header("Location: /"); // Redirect to main 	
			exit; // Exit code
		}
	}
	
	if(!isset($_POST['session_token'])) // Check if session token is defined
	{
		pushState("Command requires session token."); // Push response
	}
	
	$session_token = $_POST['session_token']; // Create reference to session token
	
	$session_user = getUserBySession($session_token); // Attempt to grab the user from the session token given
	
	if($session_user == false) // Check if user doesn't exist
	{
		pushState("You are not logged in."); // Push response
	}
	
	$removed_session = removeUserSession($session_user['id']); // Attempt to remove session
	
	if(!$removed_session) // Check if managed to remove session
	{
		pushState("Failed to logout user. Already logged in?"); // Push response
	}
	
	if($web_method) // If using web api
	{
		setcookie("session_token", null); // Set session token to null
	}
	
	pushState("Logged out."); // Push response
?>
