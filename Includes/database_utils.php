<?php

	/*
		
		
		File 2 - PHP
		by Alasdair Gallacher
		
		MySQL Server Utils...
		
		
		Languages Used:
		
		- PHP, MSQL	
		
		
		
		Please annotate your code!
		
	*/	


	$MYSQL_HOST = ""; // Define the address for the MySQL server
	$MYSQL_USER = ""; // Define the user for the MySQL server
	$MYSQL_PASSWORD = ""; // Define the user's password for the MySQL server
	$MYSQL_DATABASE = ""; // Define the database for the MySQL server 

	function db_connect() // Create a fucntion to connect to database
	{
		$link = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD);
		if(!$link)
		{
			return False;
		}
		
		$db = mysql_select_db($MYSQL_DATABASE);
		if(!$db)
		{
			return False;
		}
		
		return True;
		
	}
	
	
	function db_close()
	{
		mysql_close();
	}

	
	
?>