<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Outtadebt Calculator - Profile Saved</title>

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
  <script>function closeTab(){
			close();
			}
  </script>
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
		 <p class="navbar-brand" onclick="closeTab()">Return to Debt Assessment</p>
          </div>
        <div id="navbar" class="navbar-collapse collapse">
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	  
	  <div class="container">
		<br/><br/><br/>
		<div class="page-header">
        <h1>The Get Outta Debt Calculator</h1>
        <p class="lead">Thanks.  Your profile has been saved.</p>
		<p class="lead">You can now access your debt assessment by entering your profileID in the home page.</p>
		<p class="lead">Your Profile ID is {{$profID}}.  <br/>You can also access directly with this URL: <br/>
    http://webdev.anthonyahn.com/outtadebt/public/index.php/loadprofile?idSubmit={{$profID}}</p>
    <p class="lead">{{$uEmail}}</p>
		<button class="btn btn-primary" onclick="closeTab()">Return to Debt Assessment</button>
		</div>		
      </div>	
</div>	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('../../bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>