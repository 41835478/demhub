@extends('layouts.master')

@section('content')

<div id="welcome_login" class="row" style='background: url("images/backgrounds/sign-up.jpg") no-repeat center center;'>
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
</div>

@endsection('content')
