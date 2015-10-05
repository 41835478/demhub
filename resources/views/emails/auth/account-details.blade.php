<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">

	</head>
	<body>
		<div>
			<h3>Hey Jen, DEMHUB system update</h3>

				<p>New signup request.  Here are the details. </p>
				<p>Username: {{$user_name}}</p>
				<p>Email: {{$user_email}}</p>
				<p>First Name: {{$first_name}}</p>
				<p>Last Name: {{$last_name}}</p>
				<p>Org/Agency: {{$org_agency}}</p>
				<p>Specialization: {{$specialization}}</p>
				<p>Phone Number: {{$phone_number}}</p>
				<a type="button" href="beta.demhub.ca/auto-login?username={{$user_name}}&email={{$user_email}}&createUser="> GRANT THEM ACCESS BY CLICKING HERE
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
