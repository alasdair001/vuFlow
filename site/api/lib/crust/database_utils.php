<?php

	/*

		Name: database_utils
		Description: Used for site creator's special functions
		Author: Breeze
		
	*/	
	
	$LOGIN_TABLE = "`logins`"; // Create reference for logins table
	$SESSION_TABLE = "`sessions`"; // Create reference for sessions table
	
	
	function getUserByIdentifier($identifier)
	{
		$identifier = mysql_real_escape_string($identifier);
		
		return mysql_fetch_array(mysql_query("SELECT * FROM $LOGIN_TABLE WHERE `username` = '$identifier' OR `email` = '$identifier';"));
	}
	
	function getUserByPayload($id, $password)
	{
		$id = mysql_real_escape_string($id);
		$password = mysql_real_escape_string($password);
		
		return mysql_fetch_array(mysql_query("SELECT * FROM $LOGIN_TABLE WHERE `id` = $id AND `password` = '$password';"));
	}
	
	function getUserBySession($session_token)
	{
		$session_token = mysql_real_escape_string($session_token);
		$session = mysql_fetch_array(mysql_query("SELECT `user_id` FROM $SESSION_TABLE WHERE `session_token` = '$session_token';"));
		
		if(!is_int($user_id))
		{
			return false;
		}
		
		return mysql_fetch_array(mysql_query("SELECT * FROM $LOGIN_TABLE WHERE `id` = $user_id;"));
	}
	
	function removeUserSession($user_id)
	{
		$user_id = mysql_real_escape_string($user_id);
		return mysql_query("DELETE FROM $SESSION_TABLE WHERE `user_id` = $user_id;");
	}
	
	function generateSession($length)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    
	    return $randomString;
	}
	
	function createSession($user)
	{
		$session_token = generateSession(45);
		$user_id = $user['id'];
		$insert_session = mysql_query("INSERT INTO $SESSION_TABLE (`user_id`, `session_token`) VALUES ('$user_id', '$session_token');");
		if(!$insert_session)
		{
			return false;
		}
		
		return $session_token;
	}
	
	
?>
