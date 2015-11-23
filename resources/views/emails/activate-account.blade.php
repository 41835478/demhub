<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<!--load custom CSS-->
		<!-- {{HTML::style('css/template.css')}} -->

		<!--Google jquery-->

		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		 -->
		<!-- Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->

		<!-- Latest compiled and minified JavaScript -->
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
 -->

<!--		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->

		<!--FONT Family-->
		<!-- <link href='http://fonts.googleapis.com/css?family=Raleway:400,500' rel='stylesheet' type='text/css'> -->

	</head>
	<body>
		<div>
			<h3>Hello, {{$user_name}}!</h3>

				<p>Your DEMHUB account has been activated.  You can now access your acccount. </p>
				<p>Confirm your account here: {{ url('account/confirm/' . $token) }}</p>

				<!-- <p>Your hub for disaster and emergency management resources.  DEMHUB is the online destination for disaster and emergency industry professionals.  We must verify your profile before you can access to the application.  The DEMHUB staff will evaluate within 48 hours of your registration.</p> -->
				<p>
					If you have any questions, concerns, or comments please contact us at demhubcontact@gmail.com
				</p>
				<br>
				<a href="{{route('home')}}">
						{!! HTML::image("/images/logo/demhub_logo-05.svg", "DEMHUB logo", array('class' => 'img-responsive demhub-logo-landing', 'width' => '340')) !!}

				</a>

			<br>
			<!-- <span><i>This E-Mail address does not accept any incoming email. Please do not reply back.</i></span> -->
		</div>
	</body>
</html>
