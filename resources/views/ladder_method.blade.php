<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Outtadebt Calculator</title>

    <!-- Bootstrap -->
  <link href="{{asset('../../bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('../../jumbotron.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/debtstyles.css')}}" rel="stylesheet" type="text/css">>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  
 <body>
     <nav class="navbar navbar-inverse navbar-fixed-top">
	 <div class="container">
	 <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
		 <a class="navbar-brand" href="../">Home</a>
     <a class="navbar-brand" href="https://github.com/dcYeti/debt_calculator">View the open source repository</a>
          </div>
        <div id="navbar" class="navbar-collapse collapse">
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	  
	  <div class="container">
		<br/><br/><br/>
		<div class="page-header">
    <h2>The Get Outta Debt Calculator</h2>

    <h3><u>What it Does</u></h3>
        <p class="custom_front">This calculator computes the length of time and total interest paid for multiple debts with different
        interest rates.  This uses the "avalanche method" of paying multiple debts.  You are asked information about your debts and how
        much you commit every month towards your debts.</p>
 
        <p class="custom_front">Then, the calculator pays all the minimum payments each month and gives any excess towards the highest-interest
        balances.  This, of course, assumes that the interest rate will not fluctuate during the payment period.  You are then given a month-to-month detail of how your monthly payment is used and the total interest paid and time taken. </p>

    <h3><u>The Avalanche Method of Paying Debt </u></h3>
		    <p class="custom_front">The Avalanche method is mathematically proven to be the best choice for paying off multiple debts.  However,
        anecdotally, the snowball method is sometimes deemed more effective.  This method puts any excess payments towards the smallest
        balances - the idea being that the psychological bump of paying off accounts increases discipline towards your goal.</p>
		
    <h3><u>Calculator Accuracy</u></h3>
        <p class="custom_front">The calculator is accurate as long as the interest rates do not fluctuate during the repayment period.  Also,
        this assumes that no new purchases or advances are taken on those credit lines.  This also assumes that minimum payment is a fixed
        percentage of the statement balance and that the minimum payment will change incrementally every month.  However, in practice this
        varies account by account.  Many companies like to round minimum payments to be more consumer-friendly.</p>

        <p class="custom_front">You may also notice in your monthly detail that there may be small amounts remaining even after the calculator determines an account to be paid.  This is because some credit lines will charge you the accumulated interest for the month you pay off your bill.  This varies by creditor, but for our purposes we assume that you are charged and consider those amounts negligible.</p>

    <h3><u>Open Source</u></h3>
        <p class="custom_front">This calculator is open source <a href="https://github.com/dcYeti/debt_calculator"> View the Repository </a>.  
        I currently plan on including a calculator to handle the snowball method of debt repayment, as well as add features such as improving
        debt repayment plans by using debt reconsolidation or by increasing your monthly contribution.  Thanks for checking this out!</p>
		</div>		
      </div>	
</div>	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('../../bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>