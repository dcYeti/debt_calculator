<?php
	//This will connect to the database and make sure that the tables are created
require(app_path() . '/Includes/db_settings.php');  //Brings in credentials from db_settings.php
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die('Failure to connect to MySQL Server');
$createDBQuery = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME;
	
if(@mysqli_query($dbc, $createDBQuery)){       //Checks for DB and create if not there
	//Query to create table
	$userTableQuery = "CREATE TABLE IF NOT EXISTS $userTable (owner_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	profile_ID VARCHAR(10) NOT NULL, name VARCHAR(40) NOT NULL, user_email VARCHAR(40) NOT NULL, num_debts SMALLINT UNSIGNED NOT NULL, 
	org_commit FLOAT(15,2) UNSIGNED NOT NULL, org_totals VARCHAR(400) NOT NULL,reAssess TINYINT(1) NOT NULL, reCommit FLOAT(15,2) UNSIGNED, 
	reConLoan FLOAT(15,2) UNSIGNED,	re_totals VARCHAR(400), savings VARCHAR(400), reg_date TIMESTAMP NOT NULL default NOW())";
	//Select DB
	@mysqli_select_db($dbc, DB_NAME);
	//Create users table	
	if(@mysqli_query($dbc, $userTableQuery)){
		//Initiate creation of debt summaries table;
		$debtTableQuery = "CREATE TABLE IF NOT EXISTS $debtTable (debt_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
						owner_id MEDIUMINT UNSIGNED NOT NULL, months_finish SMALLINT UNSIGNED NOT NULL, summary_array VARCHAR(1000) NOT NULL)";
		if(@mysqli_query($dbc, $debtTableQuery)){
			//With debtTable added, this will add the monthly details
			$monthlyTableQuery = "CREATE TABLE IF NOT EXISTS $monthlyTable (monthly_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			debt_id MEDIUMINT UNSIGNED NOT NULL, month_no SMALLINT NOT NULL, monthly_array VARCHAR(1000) NOT NULL)";
			if(!@mysqli_query($dbc, $monthlyTableQuery)){
				echo "Error inserting at monthly table" . mysqli_error($dbc);
			}		
		}
		else {
			echo "Error at inserting debt summary table " . mysqli_error($dbc);
		}
	}
	else {
		echo "Not successful with $userTable:" . mysqli_error($dbc);
	}
}
else{
	echo "Error creating database";
}	
	

	
	
