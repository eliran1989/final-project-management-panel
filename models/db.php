<?php
	
	if ($_SERVER['HTTP_HOST']=="127.0.0.1"){
	define('DB_HOST',"localhost");
	define('DB_NAME', "spacegym");
	define('DB_USER', "root");
	define('DB_PASS', ""); 
	}
	else{
	define('DB_HOST',"mysql.hostinger.co.il");
	define('DB_NAME', "u893376912_space");
	define('DB_USER', "u893376912_elira");
	define('DB_PASS', "201643202"); 
	}


?>