<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CustomClass\Income;


class EnterDebts extends Controller
{
    //Default method
	public function addDebtForms(){
		session_start();
		header('Content-Type: text/html; charset=utf-8');
		//Make an object of the user's income and monthly expenditures data
		$username = $_POST['username'];
		$debtCount = $_POST['debtcount'];
		$moCommitment = $_POST['monthly_commitment'];
		//$theDebtor is the user at the time
		$theDebtor = new Income($username, $debtCount, $moCommitment);
		$_SESSION['debtorInfo'] = $theDebtor;
	return view('debtform', array('name' => $username, 'noDebts' => $debtCount, 'moCommit'=>$moCommitment));
	}
	
}
