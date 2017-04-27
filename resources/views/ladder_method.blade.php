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
          </div>
        <div id="navbar" class="navbar-collapse collapse">
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	  
	  <div class="container">
		<br/><br/><br/>
		<div class="page-header">
        <h1>The Get Outta Debt Calculator</h1>
		<h3><u>The Ladder Methodology to Paying Debt</u></h3>
        <p class="lead">The ladder methodology to paying debt is the mathematically-proven best way to pay off your debts
		across multiple accounts.  Instead of paying $10 more here and there while paying your accounts, or paying the accounts
		with the highest balances, the ladder method assigns your highest APR debt as the priority.  The idea is that you pay 
		the monthly minimum for all non-priority accounts, and then use any extra money towards the highest APR account.  
		After that account is paid, the priority will move towards the next	highest APR account until all debts are gone.  Of course,
		the calculation assumes that no new debt is added to these accounts along the way.<br/><br/>
		<h3><u>About the Calculator</u></h3>
        <p class="lead">The calculator automatically prioritizes your accounts for you.  It then details which debts to pay first,
		and which ones to only pay the monthly minimum.  The calculator automatically calculates your future monthly minimum payments. 
		After calculation, you can view month-by-month analysis of each account.<br/>
		Warning:  There is not a whole lot of exception handling on this app.  We're assuming your debts are lawful, and that you
		pay at least a little bit if principal each month.  Furthermore, this calculator cannot handle variable APR or accounts
		with APR that changes after certain periods of time.<br/><br/>
		</div>		
      </div>	
</div>	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('../../bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>