@extends('frontend.layouts.master')

@section('content')
	
		
			
<div id="user-settings" class="row">
	
		<div class="col-md-2" style="background: rgba(0,0,0,0.85);">
			@include('user_dashboard.menu.dashboard_menu')
		</div>
    	
       
		
    <div class="col-md-6">
		<h1>PRIVACY SETTINGS</h1>
    	
    </div>
</div>

@endsection('content')
