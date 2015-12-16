<?php
	
	function import($libraries)
	{
		if(is_array($libraries))
		{
			foreach($libraries as $library)
			{
				if(is_string($library))
				{
					include("lib/".str_replace(".", "/", $library).".php");
				}
			}
		}else 
		if(is_string($libraries))
		{
			include("lib/".str_replace(".", "/", $libraries).".php");
		}
	}