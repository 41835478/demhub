<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">

	</head>
	<body>
		<div>
			<h3>Hello, {{$user_name}}!</h3>

				<p>Your DEMHUB account has been activated.  You can now access your acccount. </p>
				<p>Use the login page to access your account.  Or click the button below to go directly to your account.</p>
				<a type="button" href="beta.demhub.ca/auto-login?username={{$user_name}}&autoLogin="> ACCOUNT ACCESS
				</a>
				<!-- <p>Your hub for disaster and emergency management resources.  DEMHUB is the online destination for disaster and emergency industry professionals.  We must verify your profile before you can access to the application.  The DEMHUB staff will evaluate within 48 hours of your registration.</p> -->
				<p>
					If you have any questions, concerns, or comments please contact us at demhubcontact@gmail.com
				</p>
				<br>
				<a href="{{url('division',1)}}">
					{!! HTML::image('http://beta.demhub.ca/images/logo/logo-black.png', 'DEMHUB Logo') !!}
				</a>

			<br>
			<!-- <span><i>This E-Mail address does not accept any incoming email. Please do not reply back.</i></span> -->
		</div>
	</body>
</html>
