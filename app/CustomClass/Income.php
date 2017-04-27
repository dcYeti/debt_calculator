<?php namespace App\CustomClass;

class Income {
	protected $username;
	protected $monthlyCommitment;
	protected $noDebts;	
	function __construct($name, $totDebts, $commitment) {
		$this->username = $name;
		$this->monthlyCommitment = $commitment;	
		$this->noDebts = $totDebts;
	}
	public function getDebtCount(){
		return $this->noDebts;
	}
	public function getMonthlyCommit(){
		return $this->monthlyCommitment;
	}
	public function getName(){
		return $this->username;
	}
	
	public function __toString(){
		$message = "The username is $this->username and he/she has $this->noDebts debts!<br/>" . 
		"$this->monthlyCommitment is his debt contribution";
		return $message; 
	}
}


