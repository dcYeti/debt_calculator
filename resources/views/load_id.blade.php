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
        <p class="lead">{{$owner_name}}, Your Profile is Complete</p>
	</div>
	
		<h1><span class="label label-success">Summary </span></h1>
		<h3>With your current payment plan of <span class = "label label-default">${{$mnthCommit}} per month</span>, 
		it will take you <span class="label label-info">{{$timeTook}} months</span> to pay your debts.</h3>
		<h3>You will have paid a total of <span class="label label-warning">${{$totalPaid}}</span></h3>
		<h3>Including, <span class="label label-danger">${{$totalInterest}} interest</span> on  
		<span class="label label-primary">original balances totaling ${{$totalBalances}}.</h3>
	<hr/>
	<h3>Account by Account Summary</h3>
	<table class="table table-condensed">
		<tr>
			<th>Priority #</th>
			<th>Debt Name</th>
			<th>APR</th>
			<th>Starting Balance</th>
			<th>Total Paid</th>
			<th>Total Interest Paid</th>
			<th>Months to Finish</th>
			<th>Months Spent as Priority</th>
			<th></th>
		</tr>
	@for ($i = 0; $i < $noDebts; $i++)	
		<tr>
		@for ($j = 0; $j < 9; $j++)
			<td>{!!$summary[$i][$j]!!}</td>
		@endfor
		</tr>
	@endfor	
	</table>
	<hr/>

</div>	
	
<!-- BEGIN MODAL WINDOWS FOR DETAILED DEBT VIEWS  -->
@for ($i = 0; $i < $noDebts; $i++)
	<div class="modal_container" id="backdrop{{$i+1}}">
		<div class="modal_content" id = "window{{$i+1}}">
			<h3><u>Month by Month Detail for {{$summary[$i][1]}} with priority #{{$i+1}}</u>
			<span class="modal_close" id="closebox{{$i+1}}">xx_CLOSE_xx</span></h3>
			<h4>Starting Balance: {{$summary[$i][3]}} with APR of {{$summary[$i][2]}}.</h4>
			<h4>It will take {{$summary[$i][6]}} months to complete after paying {{$summary[$i][5]}} of interest.</h4>
			<h4>You will pay the minimum monthly payment for {{$summary[$i][6] - $summary[$i][7]}} months until it becomes priority</h4>
			<h4>This will then be your priority debt for {{$summary[$i][7]}} months until paid off.</h4>
			<table class="table table-bordered">
				<tr>
				<th>Month No</th>
				<th>Starting Balance</th>
				<th>Amount Paid</th>
				<th>Paid as</th>
				<th>Principal Paid</th>
				<th>Interest Paid</th>
				<th>Ending Bal</th>
				<th>Total Accrued Principal</th>
				<th>Total Accrued Interest</th>
				<th>Total Paid Overall</th>
				</tr>
			@for ($j = 0; $j < $debt_length[$i]; $j++)
				<tr>
				@for ($k = 0; $k < 10; $k++)
					<td>{{$monthly_detail[$i][$j][$k]}}</td>
				@endfor
				</tr>
			@endfor
			</table>
		</div>
	</div>
@endfor
		
	
	<footer>All Rights Reserved anthonyahn.com</footer>	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('../../bootstrap/js/bootstrap.min.js')}}"></script>
	<!--The following script will add event listeners to the view detail buttons and open/close modals-->
	<script src="{{asset('js/debt_detail.js')}}"></script>
    <script>activateDetailButton({{$noDebts}});</script> 
  </body>
</html>