<?php

	/*

		Name: validation_utils
		Description: Used for data validation
		Author: Breeze
		
	*/	
	
	function isValid($string) { // Create method to check if string matches certain pattern
    	return !preg_match('/[^A-Za-z0-9]/', $string); // Return if it matches
	}
	
	
?>