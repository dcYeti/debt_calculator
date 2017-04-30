<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CustomClass\Income;
use App\CustomClass\Debt;

class SaveProfile extends Controller
{
    //The following method will package data for saving to MySQL database
	public function dbWrite(){
		require(app_path() . '/CustomClass/Income.php');
		require(app_path() . '/CustomClass/Debt.php');
		session_start();
		header('Content-Type: text/html; charset=utf-8');
		$debtorName = $_SESSION['debtorInfo']->getName();
		$orgInfo = $_SESSION['originalInfo'];
		require(app_path() . '/Includes/dbConfig.php');
		//sanitize e-mail entry
		$userEmail = $_POST['user_email'];
		$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
		//The Profile ID will be randomly generated based on debt owner's name(first 4 letters),
		//a random number 1000 to 9999 and a suffix to indicate if this is an original assessment or hypothetical
		//The suffix is 'o' if original, 'r' if reassess
		//Array $orgInfo[0] holds the "reassess" value of true or false
		$suffix = ($orgInfo[0] == true)? 'r':'o';
		//connect to MySQL db using the following configuration
		//Generate profile ID and check for uniqueness
		$profileID = SaveProfile::getProfileID($debtorName,$suffix);
		$isUnique = SaveProfile::checkUniqueness($profileID, $dbc, $userTable);
		//If profile ID already exists, a new profileID is generated
		while ($isUnique == false){
			$profileID = SaveProfile::getProfileID($debtorName,$suffix);
			$isUnique = SaveProfile::checkUniqueness($profileID, $dbc, $userTable);
		}
		$profileID = strtolower($profileID);
	//Write the data into users Table
		$packageTotals = serialize($orgInfo);
		$insertUserQuery = 'INSERT INTO ' . $userTable . '(profile_id, name, user_email, num_debts, org_commit, org_totals, reAssess) VALUES 
		(' . "'$profileID','" . $_SESSION['debtorInfo']->getName() . "','" . $userEmail . "'," . $_SESSION['debtorInfo']->getDebtCount() . ',' . 
		$_SESSION['debtorInfo']->getMonthlyCommit() . ",'" . $packageTotals . "'," . $orgInfo[0] . ')';
		if (!@mysqli_query($dbc, $insertUserQuery)){
			echo "Problem inserting User: " . mysqli_error($dbc);
		}
	//Write the debt summaries
		//First, owner_id is extracted from userTable, this will be foreign key in debt_summary table	
		$ownerQ  = "SELECT owner_id FROM $userTable WHERE profile_ID = '$profileID'";
		$ownerResult = @mysqli_query($dbc,$ownerQ);
		$ownerArray = mysqli_fetch_array($ownerResult, MYSQLI_NUM);
		$ownerID = $ownerArray[0];
		//Now, create prepared statement
		$summaryQ = "INSERT INTO $debtTable (owner_id, months_finish, summary_array) VALUES ($ownerID,?, ?)";
		$stmt = mysqli_prepare($dbc, $summaryQ);
		mysqli_stmt_bind_param($stmt, 'is', $months2Finish, $packageSummary);
		//Execute statements (1 query per debt) with summary data as serialized array
		$sumArray = $_SESSION['debtSummaries'];
		$numDebts = $_SESSION['debtorInfo']->getDebtCount();
		for ($i = 0; $i < $numDebts; $i++){
			$tempArray = array();
			for ($j = 1; $j <= 9; $j++){
				array_push($tempArray, $sumArray[$i * 9 + $j]);
				if ($j == 7){ //This will put months to finish (at element 7 of array) at separate variable 
					$months2Finish = $sumArray[$i * 9 + $j];	
				}
			}
			$packageSummary = serialize($tempArray);
			//$packageSummary = mysqli_real_escape_string($dbc, $packageSummary);
			@mysqli_stmt_execute($stmt);
			unset($tempArray);
		}
		
	  //Now, time to write to monthly detail table
		//Get big array from session array
		$debtArray = $_SESSION['debtMDA'];
		//Get debt_id for use as foreign key
		$debtQ  = "SELECT debt_id, months_finish FROM $debtTable WHERE owner_ID = $ownerID";
		$debtResult = @mysqli_query($dbc,$debtQ);
		$debtTracker = 1; //Debt Priority Number - This will iterate and write monthly data for each debt
		//Prepare the Prepared Statements
		$monthlyQ = "INSERT INTO $monthlyTable (debt_id, month_no, monthly_array) VALUES (?,?,?)";
		$stmt = mysqli_prepare($dbc, $monthlyQ);
		mysqli_stmt_bind_param($stmt, 'iis', $debtID, $monthNo, $packageMonth);
		//Start Going through and adding
		while($debtRow = mysqli_fetch_array($debtResult, MYSQLI_ASSOC)){
			$debtID = $debtRow['debt_id'];
			$months2Finish = $debtRow['months_finish'];
			for ($monthNo = 1; $monthNo <= $months2Finish; $monthNo++){
				$monthlyDetails = $debtArray[$debtTracker][1 + $monthNo];
				$packageMonth = serialize($monthlyDetails);
				@mysqli_stmt_execute($stmt);
			}
			$debtTracker += 1;
		}
		//PHP mail function here
		$mailTo = $userEmail;
		$mailSubject = "Outtadebt Calc - Access Your Debt Assessment at Any Time";
		$mailBody = "Hi:\nYour debt Assessment is Saved and can be accessed at any time!\n
		Your Profile ID is $profileID, which can be entered at: 
		webdev.anthonyahn.com/outtadebt/public and enter your profileID at the top.\n
		You can also use this URL: http://webdev.anthonyahn.com/outtadebt/public/index.php/loadprofile?idSubmit=$profileID
		Thanks again for using the outtadebt calculator!";
		$mailHeader = "From: outtadebt_calc@anthonyahn.com";
		if (empty($_POST['user_email']) && $_POST['smit'] == "Save Assessment with E-Mail") {
			$userEmail = "Sorry, no E-mail address was entered.  We could not send an e-mail to you at this time";
		}
		if ($mailServerSetup && $_POST['smit'] == "Save Assessment with E-Mail") {
			//mail($mailTo, $mailSubject, $mailBody, $mailHeader);
			$userEmail = "We have also e-mailed you your profile ID at $userEmail";
		}
		else if($_POST['smit'] == "Save Assessment with E-Mail") {
			$userEmail = "Sorry, the e-mail server is having problems or not properly configured.  We could not send you an e-mail at this time";
		}
		else {
			$userEmail = '';
		}


		//Call view
		return view('save_confirm',array('profID'=>$profileID, 'uEmail'=>$userEmail));
		
	}
		
	public function getProfileID($debtorName, $suffix){
		$profileID = substr($debtorName,0,4) . rand(10000,99999) . $suffix;
		return $profileID;
	}
	
	public function checkUniqueness($profileID, $dbc, $userTable){
		$uniquenessQuery = "SELECT * FROM $userTable WHERE profile_ID='$profileID'";
		$uniqueResult = @mysqli_query($dbc, $uniquenessQuery);
		if (mysqli_num_rows($uniqueResult) > 0){
			return false;			
		}
		else {
			return true;
		}
	}
	
}
