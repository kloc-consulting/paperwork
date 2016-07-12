<?php
/*
    Copyright (C) 2016 Karsten Lueth
    This file is part of paperwork.

    Paperwork is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Paperwork is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Paperwork.  If not, see <http://www.gnu.org/licenses/>.
*/ 

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
