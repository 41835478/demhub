@extends('structure.main')

@section('content')
<div id="welcome_login" class="row">
	<div class="col-md-12">
        <h1>Log-In</h1>
    </div>

	<div class="col-md-6 col-md-offset-3">
        @include('forms.login')
    </div>
<!--     <div class="col-md-2">
        <h5>Or</h5>
    </div>
    <div class="col-md-5">
    	<h3>Log-In with your Social Networks</h3><br />
        @include('guest.menu-social-signin.socialmenu')

    </div>
 -->    
   <!--  <div class="col-md-12">
        <hr>
        <p class="lead">Or</p>
        <h2>Log in with<br><a href="{{URL::route('linkedin-login')}}"><i class="fa fa-linkedin-square"></i></a></h2>
    </div> -->

	<div id="welcome_sign-up_footer" class="col-md-12">
        <hr>
    	<h2>Dont have an account? Sign-Up Today</h2><br>
        <a href="{{URL::route('sign-up')}}">
    		<button type="button" class="btn btn-primary">Sign-Up</button>
        </a>

    </div>

</div>

@endsection('content')