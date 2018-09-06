<?php

class Debug {
	
	function show($arg) 
	{
		if (gettype($arg) == "array") 
		{
			echo '<br>'."\n";
			echo '<pre>';
			print_r($arg).'</pre>';
			echo '<br>'."\n";
			exit();
		}
		else 
		{
			echo '<br>'."\n";
			var_dump($arg);
			echo '<br>'."\n";
			exit();
		}
	}
}