
@extends('frontend.layouts.master')

@section('content')
<div id="user-settings" class="row">
	
		<div class="col-md-2" style="background: rgba(0,0,0,0.85);">
			@include('frontend.user.user_dashboard.menu.dashboard_menu')
		</div>
    	<div style="padding-top:50px">
		<!-- <h1>{{Auth::user()->user_name}}'s Profile</h1> -->
    		@include ('forms.user.settings')
		</div>
</div>
@endsection('content')