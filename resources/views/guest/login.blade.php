@extends('layouts.master')

@section('content')
<div id="welcome_login" class="row"> 
<div class="row">
	<div class="col-md-12" >
		<br><br>
        <h2 style="font-size:290%;color:#fff">WELCOME BACK!</h2>
		<br>
    </div>
</div>
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
        @include('forms.login')
    </div>
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
        <h2>Log in with<br><a href="{{url('linkedin-login')}}"><i class="fa fa-linkedin-square"></i></a></h2>
    </div> -->

	<!-- <div id="welcome_sign-up_footer" class="col-md-12">
        <hr>
    	<h2>Dont have an account? Sign-Up Today</h2><br>
        <a href="{{url('sign-up')}}">
    		<button type="button" class="btn btn-default btn-style">Sign-Up</button>
        </a>

    </div> -->

</div>

@endsection('content')