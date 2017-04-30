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
          <a class="navbar-brand" href="../">Home (Start Over)</a>
		  </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	  
	<div class="container">
		<br/><br/><br/>
	<div class="page-header">
        <h1>The Get Outta Debt Calculator</h1>
        <p class="lead">Hi {{$name}}, just a little further to see your debt profile</p>
		<p></p>
	</div>
		<h1><span class="label label-warning">Step 2: Enter Your Debts ({{$noDebts}})</span></h1>
		<h3>Enter your debts (in any order) and their current information</h3>

	<form name="debts_pg2" action="calc_initial" enctype="multipart/form-data" onsubmit="return validateDebts({{$noDebts}},{{$moCommit}})" method="post">	
		<!--The following line will run the loop with blade template -->
	@for ($i = 1; $i <= $noDebts; $i++)	
		<div class="col-md-6">
		<h4><u>Debt #{{$i}}</u></h4>
		<label for="nameofdebt{{$i}}">Enter Name of Debt:</label>
		<input type="text" class="form-control" id="nameofdebt{{$i}}" name = "debt{{$i}}" placeholder="eg Bank of America Rewards Card">
		<br/>
		<label for="prc{{$i}}">Enter the APR as a percent:</label>
		<input type="text" class="form-control" id="prc{{$i}}" name = "debt_apr{{$i}}" placeholder="Numbers only, eg for 15% apr, enter 15">
		</div>
		<!-- BEGIN form column 2 for committed and discretionary costs-->
		<div class="col-md-6">
		<br/><br/>
		<label for="beg_bal{{$i}}">Enter your most recent statement balance:</label>
		<input type="text" class="form-control" id="beg_bal{{$i}}" name = "start_bal{{$i}}" placeholder="Numbers only please">
		<br/>
		<label for="min_Mo{{$i}}">Enter your most recent minimum monthly payment:</label>
		<input type="text" class="form-control" id="min_Mo{{$i}}" name = "mo_payment{{$i}}" placeholder="Numbers only">
		<br/>		
		</div>
	@endfor	
		<button type="submit" name = "smit" class="btn btn-default" id="button_left">Start Calculation</button>
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
		