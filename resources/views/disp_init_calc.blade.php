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
        <p class="lead">{{$_SESSION['debtorInfo']->getName()}}, Your Profile is Complete</p>
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
		@for ($j = 1; $j <= 9; $j++)
			<td>{!!$summary[$i * 9 + $j]!!}</td>
		@endfor
		</tr>
	@endfor	
	</table>
	<hr/>
	<!--This form will route to the assessment saving script -->
	<form name="initSave" action="save_profile" method="post" target="_blank">	
		<h2><span class="label label-primary">Save this Debt Assessment --></h2></span>
		<p>Enter Your E-mail address, and we'll e-mail you a ProfileID you can use to look up this debt assessment in the future
		 (confirmation opens in new browser tab or window)</p>
		<input type="email" class="form-control" name = "user_email" placeholder="example@ISP.com" />
		<h3><input type="submit" class="btn btn-success" name="smit" value="Save Assessment with E-Mail">
		    <input type="submit" class="btn btn-success" name="smit" value="Continue without E-Mail"</h3>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>	
	
</div>	
	
<!-- BEGIN MODAL WINDOWS FOR DETAILED DEBT VIEWS  -->
@for ($i = 1; $i <= $noDebts; $i++)
	<div class="modal_container" id="backdrop{{$i}}">
		<div class="modal_content" id = "window{{$i}}">
			<h3><u>Month by Month Detail for {{$debts[$i][0]->getDebtName()}} with priority #{{$i}}</u>
						<span class="modal_close" id="closebox{{$i}}">xx_CLOSE_xx</span></h3>
			<h4>Starting Balance: {{$summary[($i-1)*9 + 4]}} with APR of {{$summary[($i-1)*9 + 3]}}.</h4>
			<h4>It will take {{$debts[$i][1]}} months to complete after paying {{$summary[($i-1)*9 + 6]}} of interest.</h4>
			<h4>You will pay the minimum monthly payment for {{$debts[$i][1] - $summary[($i-1)*9+8]}} months until it becomes priority</h4>
			<h4>This will then be your priority debt for {{$summary[($i-1)*9+8]}} months until paid off.</h4>
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
			@for ($j = 1; $j <= $debts[$i][1]; $j++)
				<tr>
				@for ($k = 0; $k < 10; $k++)
					<td>{{$debts[$i][1+$j][$k]}}</td>
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