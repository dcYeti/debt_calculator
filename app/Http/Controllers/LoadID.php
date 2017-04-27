<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoadID extends Controller
{
    //This method will extract the info from the DB and Create what's needed for display
	public function loadIt(){
		require(app_path() . "/Includes/dbConfig.php");
		$idSubmit = strtolower($_GET['idSubmit']);
		//Validate the ID using regular expression
		$checkExistQ = "SELECT * FROM $userTable WHERE profile_ID = '$idSubmit'";
		if($isThere = @mysqli_query($dbc,$checkExistQ)){
			//if the profileID doesn't exist, the error page will load.
			if (mysqli_num_rows($isThere) == 0){
				return view('id_load_error');
				mysqli_free_result($isThere);
				exit();
			}
		}
		//After profileID is validated, variable extraction begins
		//This will extract the info from the owner's array for the summary header
		while($dbResult = mysqli_fetch_array($isThere, MYSQLI_ASSOC)){
			$ownerID = $dbResult['owner_id'];
			$debtorName = $dbResult['name'];
			$numDebts = $dbResult['num_debts'];
			$reAssess = $dbResult['reAssess'];
			$orgCommit = $dbResult['org_commit'];
			$userTotals = unserialize($dbResult['org_totals']);
			//Collect additional info if this is a reassessment
			if ($reAssess == 1){
				$reCommit = $dbResults['reCommit'];
				$reConLoan = $dbResults['reConLoan'];
				$reTotals = unserialize($dbResult['re_totals']);
				$savings = unserialize($dbResult['savings']);
			}	
		}
		mysqli_free_result($isThere);
		//Extract the debt summaries
		$debtExtractQ = "SELECT debt_id, months_finish, summary_array FROM $debtTable WHERE owner_id=$ownerID";
		$debtThere = @mysqli_query($dbc,$debtExtractQ);
		//This is the summaries multi dimensional array
		$summaryArray = array();
		$debtLengths = array();
		$monthlyArray = array();
		$debtIndex = 0;
		while($debtResult = mysqli_fetch_array($debtThere, MYSQLI_ASSOC)){
			//Push value to summary array
			array_push($summaryArray, unserialize($debtResult['summary_array']));
			array_push($debtLengths, $debtResult['months_finish']);
			//Get debtID and extract monthly info
			$debtID = $debtResult['debt_id'];
			$monthlyQ = "SELECT monthly_array FROM $monthlyTable WHERE debt_id=$debtID";
			$monthlyThere = @mysqli_query($dbc, $monthlyQ);
			while($monthlyResult = mysqli_fetch_array($monthlyThere, MYSQLI_ASSOC)){
				$monthlyArray[$debtIndex][] = unserialize($monthlyResult['monthly_array']);
			}
		$debtIndex += 1;
		}
		//The following will direct which display to send.
		if($reAssess == 1){
			
		}	
		else {
			//Extract totals for the top summary
			$totMonth = $userTotals[1];
			$totPaid = $userTotals[2];
			$totInterest = $userTotals[3];
			$totBalances = $userTotals[4];
			
			
			return view('load_id',array('owner_name'=>$debtorName,'mnthCommit'=>$orgCommit,'timeTook'=>$totMonth,
			'totalPaid'=>$totPaid, 'totalInterest'=>$totInterest,'totalBalances'=>$totBalances,'summary'=>$summaryArray,
			'debt_length'=>$debtLengths,'noDebts'=>$numDebts,'monthly_detail'=>$monthlyArray));	
		}
				
		
	}
			
		
}
	