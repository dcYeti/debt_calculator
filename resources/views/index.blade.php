<!DOCTYPE html>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
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
	<!--SCRIPT FOR FORM VALIDATION -->
	<script src="{{asset('js/formValidations.js')}}"></script>
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
		 <a class="navbar-brand" href="index.php/ladder_method">About the Calculator</a>
     	<a class="navbar-brand" href="https://github.com/dcYeti/debt_calculator">View the open source repository</a>
          </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" action="index.php/loadprofile" method="get">
            <div class="form-group">
              <span class="whitetext_nav">Load An Existing Profile:</span>
			  <input type="text" placeholder="Enter Profile ID" name="idSubmit" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Enter</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	  
	 <div class="container">
		<br/><br/><br/>
		<div class="page-header">
        <h1>The Get Outta Debt Calculator</h1>
        <p class="lead">Hi.  The get outtadebt calculator is a detailed debt calculation tool that
		allows users to enter in any amount of debts and see how long it will take to pay off.  
		The calculation is accurate with any kind of debts as long as it's APR remains fixed,
		and no further debts are added during the repayment period.</p>
		<p></p>
		</div>
		<h1><span class="label label-primary">Start Here</span></h1>
		
		<!-- Begin form area column 1 for name and income-->
		<div class="col-md-6">
	<form name="user_pg1" action="index.php/add_debts" enctype="multipart/form-data" onsubmit="return validateIncome()" method="post">	
		<label for="nameofuser">Enter your name:</label>
		<input type="text" class="form-control" id="nameofuser" name = "username" placeholder="Give us something to call you">
		<br/>
		<label for="numberdebts">How many debt accounts do you want to add:</label>
		<p>Enter how many debt accounts you want to calculate.</p>
		<input type="text" class="form-control" id="numberdebts" name = "debtcount" placeholder="Numbers only please">
		<br/>
		<label for="commitment">Enter your monthly commitment to pay off debt (for all accounts listed above)</label>
		<p>Add up all the money paid towards debt per month.</p>
		<input type="text" class="form-control" id="commitment" name = "monthly_commitment" placeholder="Numbers only please">
		<br/>
		</div>
		<!-- BEGIN form column 2 for committed and discretionary costs-->
		<div class="col-md-6">
		<br/><br/><br/><br/><br/>
		<button type="submit" class="btn btn-primary" id="button_left">Proceed to Step 2</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</div>
	</form>
	</div>
	<footer>All Rights Reserved anthonyahn.com</footer>
		
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('../../bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/add_highlights.js')}}"></script>
  </body>
</html>