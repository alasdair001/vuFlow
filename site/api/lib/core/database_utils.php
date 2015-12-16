<?php

	/*

		Name: database_utils
		Description: Used to connect and run set queries from database
		Author: Breeze
		
	*/	

	$MYSQL_HOST = ""; // Define the address for the MySQL server
	$MYSQL_USER = ""; // Define the user for the MySQL server
	$MYSQL_PASSWORD = ""; // Define the user's password for the MySQL server
	$MYSQL_DATABASE = ""; // Define the database for the MySQL server 

	function db_connect() // Create a fucntion to connect to MySQL database
	{
		$link = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD); // Connect to MySQL server, using details defined
		if(!$link)
		{
			return false;
		}
		
		$db = mysql_select_db($MYSQL_DATABASE); // Select MySQL database, using details defined
		if(!$db)
		{
			return false;
		}
		
		return true;
		
	}
	
	
	function db_close() // Create function to close the connection to MySQL
	{
		mysql_close(); // Close MySQL connection
	}
	
?>