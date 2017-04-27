/*  Note by Anthony Ahn:  This is the Javascript used to validate form data.   
	validateIncome is for the form on page 1, and validateDebts does so for page 2
*/


function validateIncome() {
		var errorMessage;
		var errorExists;
		
		var name, noDebts, mnthCommitment;
		noDebts = document.forms["user_pg1"]["debtcount"].value;
		mnthCommitment = document.forms["user_pg1"]["monthly_commitment"].value;
		name = document.forms["user_pg1"]["username"].value;
		//make integers of variables that must be input data to check if the entered values are numbers
		noDebts = parseInt(noDebts);
		mnthCommitment = parseInt(mnthCommitment);
				
		//first check is for blank fields, then for correct data types, then for correct picture extension
	   if ((noDebts == null || mnthCommitment == null) ||(name == "" || mnthCommitment == "" || noDebts == "")) {
			errorExists = true;
			errorMessage = "You Have Blank Fields - Please re-check your entry.";
	   }
		else if (isNaN(noDebts) || isNaN(mnthCommitment)) {
			errorExists = true;
			errorMessage = "You have invalid data types in one or more fields.  Please make sure only numbers are entered when asked"; 
		}
		else if (noDebts <= 0 || mnthCommitment <= 0) {
			errorExists = true;
			errorMessage = "You have zero or negative values in one or more fields.  Please re-check."; 
		}
		else {
			errorExists = false;
		}
		
		if (errorExists){
			alert(errorMessage);
			return false;
		}
		else{
			return true;
		}
}


function validateDebts(noDebts, monthlyCommit) {
		var errorMessage;
		var errorExists = false;
		var formName = "debts_pg2";
		var monthMins = 0;
		
	for (var i = 1; i <= noDebts; i++){	
		//the variable debtField will match the 'name' attribute in HTML form.
		var debtField = "debt";
		debtField = debtField.concat(i);
		var debtName = document.forms[formName][debtField].value;
		debtField = "debt_apr";
		debtField = debtField.concat(i);
		var apr = document.forms[formName][debtField].value;
		debtField = "start_bal";
		debtField = debtField.concat(i);
		var startingAmount = document.forms[formName][debtField].value;
		debtField = "mo_payment";
		debtField = debtField.concat(i);
		var minimumMonthly = document.forms[formName][debtField].value;
		
		//make integers of variables that must be input data to check if the entered values are numbers
		apr = parseInt(apr); 
		startingAmount = parseInt(startingAmount);
		minimumMonthly = parseInt(minimumMonthly);

		//add to monthly minimum summation to make sure it does not exceed monthly commitment
		monthMins += minimumMonthly;		
		//first check is for blank fields, then for correct data types, then for correct picture extension
	   if (errorExists){
		   //Do nothing, this is used to prevent the error flag from resetting during loop interations
	   }
	   else if ((debtName == null || apr == null || startingAmount == null || minimumMonthly == null) ||
	   (debtName == "" || apr == "" || startingAmount == "" || minimumMonthly == "")) {
			errorExists = true;
			errorMessage = "You Have Blank Fields - Please re-check your entry.";
	   }
		else if (isNaN(apr) || isNaN(minimumMonthly) || isNaN(startingAmount)) {
			errorExists = true;
			errorMessage = "You have invalid data types in one or more fields.  Please make sure only numbers are entered when asked"; 
		}
		else if (apr <= 0 || minimumMonthly <= 0 || startingAmount <= 0) {
			errorExists = true;
			errorMessage = "You have zero or negative values in one or more fields.  Please re-check."; 
		}
		else {
			errorExists = false;
		}
	}
		//This final check makes sure the sum of the monthly minimum payments does not exceed the user-submitted
		//amount that is paid towards debts
		if (monthlyCommit < monthMins){
			errorExists = true;
			errorMessage = "The monthly minimum payments you have entered exceed the amount that you commit towards debt every month.  Please either recheck this form, or start over.";
		}
		
		
		if (errorExists){
			alert(errorMessage);
			return false;
		}
		else{
			return true;
		}
}
