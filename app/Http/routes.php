<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

	
Route::get('/', function () {
    return view('index');
});

Route::get('backhome', function () {
    return view('index');
});

Route::get('loadprofile', 'LoadID@loadIt');

Route::post('add_debts', 'EnterDebts@addDebtForms');

Route::get('add_debts', function(){
	echo "Error - Please start from page 1";
});

Route::post('calc_initial', 'InitialCalculation@performInitCalc');

Route::get('calc_initial', function(){
	echo "Error - Please start from page 1";
});

Route::get('ladder_method', function(){
	return view('ladder_method');
});

Route::post('save_profile', 'SaveProfile@dbWrite');




?>