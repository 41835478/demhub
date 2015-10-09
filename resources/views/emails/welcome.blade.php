<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<!--load custom CSS-->
		{{HTML::style('css/template.css')}}

		<!--Google jquery-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

		<!--FONT Family-->
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,500' rel='stylesheet' type='text/css'>

	</head>
	<body>
		<div id="user-email" class="row">
			<h1>Hi, {{$user}}!<br></h1>
			<div>
				<p>We like to personally welcome you to Cerial. Thank you for registering.</p>
				<br>
				<a href="{{URL::route('home')}}">
					{{HTML::image('images/logo/logo_welcome.png', 'Cerial Logo')}}
				</a>
			</div>
			<br>
			<span class="text-warning">This E-Mail address does not accept any incoming email. Please do not reply back.</span>
		</div>
	</body>
</html>
