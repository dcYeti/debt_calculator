<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CustomClass\Income;
use App\CustomClass\Debt;



class InitialCalculation extends Controller
{
   	public function performInitCalc() {
	//The user's info, entered in page 1, is passed through the $_SESSION array in key 'debtorInfo'
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	$numDebts = $_SESSION['debtorInfo']->getDebtCount();
	//First, assign form variables to Debt objects and make an array of them
	$debtArray = array($numDebts);
	
	//Totals
	$grandTotalBalances = 0;
	$grandTotalPaid = 0;
	$grandTotalInterest = 0;
	
	
	for ($i = 1; $i <= $numDebts; $i++){
		//the following strings match the HTML form's name attribute and use to retrieve data
		$fName = "debt" . $i;
		$fAPR = "debt_apr" . $i;
		$fStart = "start_bal" . $i;
		$fMin = "mo_payment" . $i;
		//The key will be the string "debt" followed by the number in $i
		$debtObject = new Debt($_POST[$fName], $_POST[$fStart], $_POST[$fAPR], $_POST[$fMin]);
		$debtArray[$i] = array($debtObject, 0); //The 0 will be populated by months to finish
		$grandTotalBalances += $_POST[$fStart];
		//This will sorty and assign the correct priority as each debt is added to the array
		if ($i > 1){
			$aprNow = $debtArray[$i][0]->getAPR();
			$aprPrv = $debtArray[$i - 1][0]->getAPR();
			$debtArray[$i][0]->priority = $i;
			if ($aprNow > $aprPrv) {
				for ($j = $i; $j > 1; $j--){		
					$nowIndex = $j;
					$prvIndex = $j - 1;
					$nowRate = $debtArray[$nowIndex][0]->getAPR();
					$prvRate = $debtArray[$prvIndex][0]->getAPR();
					if ($nowRate > $prvRate){
						$objNow = clone $debtArray[$nowIndex][0];
						$debtArray[$nowIndex][0] = $debtArray[$prvIndex][0];
						$debtArray[$nowIndex][0]->priority += 1;
						$debtArray[$prvIndex][0] = $objNow;
						$debtArray[$prvIndex][0]->priority -= 1;
					}					
				}
			}
		}
		else {
			$debtArray[$i][0]->priority = $i;
		}
	}
	/*
	//This is test the integrity of the priority sort
	for ($i = 1; $i <= $numDebts; $i++){
		$debtArray[$i][0]->displayInfo();
		$debtArray[$i][0]->passOneMonth(200);
		$debtArray[$i][0]->displayInfo();
		echo "<br/>()()()()()()()()()(<br/>";
	} */
	
	
	//Now that debts are added to array with correct priority, calculation can begin
	$totalMonths = 0;
	
	$monthlyTotalCommit = $_SESSION['debtorInfo']->getmonthlyCommit();
	$debtsRemaining = $numDebts;
	//Each loop iteration will be a month that passes
	while ($debtsRemaining > 0){
		//assign monthlyTotalCommit to accounts, with highest priority receiving lion's share
		$monthlyCommits = 0;
		//loop goes backwards to know how much money remains from monthly Commit to put towards debt priority 1
		for ($k = $numDebts; $k >= 1; $k--){
			if ($debtArray[$k][0]->isDone() == false){
				//Call Pass One month
				//Minimum payment is automatically paid for priorities 2 through higher
				//With the remaining money sent to priority 1.  In the event priority 1 finishes payment, then priority 2
				//will receive the extra money
				if ($debtArray[$k][0]->priority > 2){
					$accountCommit = $debtArray[$k][0]->getMinMo();
					$monthlyCommits += $accountCommit;
					$debtArray[$k][] = $debtArray[$k][0]->passOneMonth($accountCommit); //pushes monthly stats to array
					$debtArray[$k][1] += 1; //Adds to account month count
					$grandTotalPaid += $accountCommit;
				}
				else {
					if ($debtArray[$k][0]->priority == 2){
						//If priority is 2, the following will check if $accountCommit exceeds balance of priority 1
						for ($m = $k - 1; $m >= 1; $m--){
							if ($debtArray[$m][0]->priority == 1){
								$pri1Balance = $debtArray[$m][0]->getBalance();
								$pri1Balance += $debtArray[$m][0]->getBalance() * $debtArray[$m][0]->getAPR() / 12;
								$fundsAvailable = $monthlyTotalCommit - $monthlyCommits;
								if ($pri1Balance < $fundsAvailable) {
									$pri1Commit = $pri1Balance;
									$pri2Commit = $fundsAvailable - $pri1Commit;
									$priChange = true;
								}
								else {
									$pri2Commit = $debtArray[$k][0]->getMinMo();
									$pri1Commit = $fundsAvailable - $pri2Commit;
									$priChange = false;
								}
							}
						}
						//Make payment to priority 2 item based on info above
						$debtArray[$k][] = $debtArray[$k][0]->passOneMonth($pri2Commit, $priChange);
						$debtArray[$k][1] += 1; //Adds to account month count
						$grandTotalPaid += $pri2Commit;
					}
					else if ($debtArray[$k][0]->priority == 1) {
						//This will set $pri1Commit to Whatever's Available if there is only 1 debt
						//For more than one debt, the amount paid to debt priority 1 is set when paying debt priority 2
						if ($debtsRemaining == 1){
							$pri1Commit = $monthlyTotalCommit;
						}
						$pri1Balance = $debtArray[$k][0]->getBalance();
						if ($pri1Balance < $pri1Commit){
							$pri1Commit = $pri1Balance;
						}
						$debtArray[$k][] = $debtArray[$k][0]->passOneMonth($pri1Commit, true); //sends priority 1
						$debtArray[$k][1] += 1; //Adds to account month count
						$grandTotalPaid += $pri1Commit;
					}
				}
				
				//If a debt changes after passing one month to Done, priorities will reset and debt count reduces by one
				if ($debtArray[$k][0]->isDone() == true){
					$debtsRemaining -= 1;
					$debtArray[$k][0]->priority = -1;
					//Now that debt is done, priority set to negative, and following debts are bumped up in priority
					if (!($k == $numDebts)){
						for ($l = $k + 1; $l <= $numDebts; $l++){
							if ($debtArray[$l][0]->priority > 0)
							{
								$debtArray[$l][0]->priority -= 1;
							}
						}
					}
				}
			}
		}
		
	$totalMonths++;	
	}		
	//Calculate and Round Grand Totals for sending to view
	$grandTotalInterest = $grandTotalPaid - $grandTotalBalances;
	$grandTotalInterest = round($grandTotalInterest, 2);
	$grandTotalPaid = round($grandTotalPaid, 2);
	$grandTotalBalances = round($grandTotalBalances, 2);
	$monthlyTotalCommit = round($monthlyTotalCommit, 2);
		
	//Create the summary array for display
	//This will be a single dimension array of the 7 column attributes in the display
	$summaryArray = array();
	for ($i = 0; $i < $numDebts; $i++){
		for ($j = 1; $j <= 9; $j++) {
			$arrayKey = $i * 9 + $j;
			switch($j){
				case 1:
					$summaryArray[$arrayKey] = $i + 1;
				break;
				case 2:
					$summaryArray[$arrayKey] = $debtArray[$i + 1][0]->getDebtName();
				break;
				case 3:
					$apr = $debtArray[$i + 1][0]->getAPR();
					$summaryArray[$arrayKey] = round($apr, 2) . '%';
				break;
				case 4:
					$startBalance = $debtArray[$i + 1][0]->getStartBal();
					$summaryArray[$arrayKey] = '$' . round($startBalance, 2);
				break;
				case 5:
					$totalPaid = $debtArray[$i + 1][0]->getTotalPaid();
					$summaryArray[$arrayKey] = '$' . round($totalPaid, 2);
				break;
				case 6:
					$intPaid = $debtArray[$i + 1][0]->getIntPaid();
					$summaryArray[$arrayKey] = '$' . round($intPaid, 2);
				break;
				case 7:
					$summaryArray[$arrayKey] = $debtArray[$i + 1][1];
				break;
				case 8:
					$summaryArray[$arrayKey] = $debtArray[$i + 1][0]->getMonthsPri();
				break;
				case 9:
					$htmlID = $i + 1;
					$htmlID = 'detailDebt' . $htmlID;
					$forEcho = '<button type="button" class="btn btn-default btn-xs" id = "' . $htmlID . 
					'">View Detail</button>';
					$summaryArray[$arrayKey] = $forEcho;
				break;				
			}
		}
	}
	//The debt display array is saved to write to MySQL if user wants to saved
	$_SESSION['debtSummaries'] = $summaryArray;
	//The debt owner info is saved in an array for writing in MySQL
	$reAssess = 0;  //Indicates that this is an original assessment
	$orgInfo = array($reAssess, $totalMonths, $grandTotalPaid, $grandTotalInterest, $grandTotalBalances);
	$_SESSION['originalInfo'] = $orgInfo;
	$_SESSION['debtMDA'] = $debtArray;
	
	
	//Final step is to send to view with the debtArray and grand Totals;
	return view('disp_init_calc', array('debts'=>$debtArray, 'totalPaid'=> $grandTotalPaid, 'summary'=>$summaryArray,
				'totalInterest'=>$grandTotalInterest, 'totalBalances'=>$grandTotalBalances, 'mnthCommit'=>$monthlyTotalCommit,
				'timeTook'=>$totalMonths,'noDebts'=>$numDebts));
	
	
}	
	
	
	
	
	
	
	
}