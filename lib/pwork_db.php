<?php

	// Connects to the database
    function pwork_connect(&$config) {
    	$config = parse_ini_file('config/pwork.ini', TRUE);
		if ($config) {
			// Load the database settings. 
			$dbsettings = $config['db-settings'];
			$host       = $dbsettings['db-host']; 
			$dbname     = $dbsettings['db-dbname']; 
			$user       = $dbsettings['db-user']; 
			$password   = $dbsettings['db-password']; 

			$db = pg_connect("host=$host dbname=$dbname user=$user password=$password")
    			or die('Connection to database failed: ' . pg_last_error());

			return $db;
		} else {
			die('could not read pwork.ini file\n'); 
			return nil;
		}
    }    
?>
