<?php

	//Fill in your MySQL settings
	DEFINE('DB_USER', 'username');					//MySQL database username
	DEFINE('DB_PASS', 'password');					//MySQL database password
	DEFINE('DB_HOST', 'localhost');					//Host - usually this is localhost
	DEFINE('DB_NAME', 'outtadebtDB');				//MySQL database name (your host may require prefixes)
	
	//The names of the 3 tables used for this program
	$userTable = 'users_table';
	$debtTable = 'debt_summary';
	$monthlyTable = 'monthly_detail';

	//Set to true or false depending on whether you have a mail server set up.  the mail function is used to e-mail
	//debt profile IDs.  If you set this to 'true' without having a working mail server, an error will result
	$mailServerSetup = false;