<?php namespace app\CustomClass;

class Debt {
	protected $debtName;			//Name of debt for user undestanding
	protected $startingAmount;
	protected $apr;
	protected $minimumMonthly;
	protected $monthlyDecimal;
	protected $monthstoFinish;
	protected $interestPaid;
	protected $totalPrincipal;
	protected $totalPaid;
	protected $minPercent;     
	protected $debtAmount;
	protected $monthsPriority;
	public $priority;
	
	function __construct($debtnm, $strt, $aprct, $minMo) {
		$this->debtName = $debtnm;
		$this->startingAmount = $strt;
		$this->apr = $aprct;
		$this->minimumMonthly = $minMo;
		$this->monthlyDecimal = $aprct/12/100; //This will be the multiplier used to started
		$this->minPercent = $minMo / $strt;
		$this->monthstoFinish = 0;
		$this->interestPaid = 0;
		$this->totalPrincipal = 0;
		$this->totalPaid = 0;
		$this->debtAmount = $strt;
		$this->monthsPriority = 0;
	}
	//The calculation controller calls this method month to month to assess which debts are paid and
	//changes debt priorities if necessary.
	public function passOneMonth($commitment, $isPriority = false){
		//this will incremement one month, with an array being returned of the 
		//month No, the starting Balance, the Amount Paid, the Principal Paid, the Interest Paid, the New Balance,
		//the Accrued Principal Paid, the Accrued Interest Paid, the total Money Paid, and if it was priority
		$startBalance = $this->debtAmount;
		$monthlyInterest = $this->monthlyDecimal * $startBalance;  //calculate monthly interest
		$this->interestPaid += $monthlyInterest;					   //add this to total interest paid throughout
		$principalPaid = $commitment - $monthlyInterest;			   //calculate how much of monthly commitment goes toward principal
		$this->debtAmount = $this->debtAmount - $principalPaid;			
		$this->monthstoFinish += 1;
		$this->totalPrincipal += $principalPaid;
		$this->totalPaid += $commitment;
		//Make new minimum monthly based on the minPercent
		$this->minimumMonthly = $this->debtAmount * $this->minPercent; 
		//The following will assume a floor of $15 or the statement balance if the normal min monthly payment is too low
		if ($this->minimumMonthly < 15) {
			//if less than 15 is left in the account, min monthly will just be the statement balance.
			if ($this->debtAmount < 15){
				$this->minimumMonthly = $this->debtAmount;
			}
			else {				
				$this->minimumMonthly = 15;
			}
		}
		if ($isPriority == true){
			$this->monthsPriority += 1;
			$priorityString = 'Priority';
		}
		else {
			$priorityString = 'Min Monthly';
		}
		return array($this->monthstoFinish, round($startBalance,2), round($commitment,2), $priorityString, round($principalPaid,2),
		round($monthlyInterest,2), round($this->debtAmount,2), round($this->totalPrincipal,2), round($this->interestPaid,2), 
		round($this->totalPaid,2));	
	}
	
	//method isEmergency is used to determine if the debt is in emergency state.  This is when interest is accumulating faster
	//than you are paying it off.  These will take priority over higher APR accounts until it is no longer losing money
	public function isEmergency($commitment){
		$monthlyInterest = $this->monthlyDecimal * $this->debtAmount;
		if ($commitment <= $monthlyInterest) {
			return true;
		}
		else {
			return false;
		}
	}
	
	//this will return the current minimum monthly payment
	public function getMinMo() {
		return $this->minimumMonthly;
	}
	
	public function getBalance() {
		return $this->debtAmount;
	}
	
	public function getDebtName(){
		return $this->debtName;
	}
	
	public function getAPR() {
		return $this->apr;
	}
	
	public function getStartBal() {
		return $this->startingAmount;
	}
	
	public function getIntPaid(){
		return $this->interestPaid;
	}
	
	public function getMonthsPri(){
		return $this->monthsPriority;
	}
	
	public function getTotalPaid(){
		return $this->totalPaid;
	}
	
	public function isDone() {
		if ($this->debtAmount == 0){
			return true;
		}
		else if ($this->debtAmount <= 5) {
			$this->debtAmount = 0; //We assume the debt will not finish exactly at 0, and will make it 0 for cleanliness
			return true;
		}
		else {
			return false;
		}
	}
	
	public function __toString(){
		return "Debt: " . $this->debtName;
	}
	public function displayInfo(){
		echo "This debt is " . $this->debtName . "<br/>";
		echo "It started at " . $this->startingAmount . " and is currently at " . $this->debtAmount . 
		" after " . $this->monthstoFinish . " months<br/>";
		echo "The APR is " . $this->apr . " and the monthly decimal is " . $this->monthlyDecimal . "<br/>";
		echo "So far, the interest paid is $" . $this->interestPaid . "<br/>";
		echo "The priority of this is " . $this->priority . '<hr/>';
	}
}