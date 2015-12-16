<?php
	
	/*

		Name: connection_utils
		Description: Used for connection details and methods
		Author: Breeze
		
	*/	
	
	function getClientIP() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}else
    	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else  {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
?>