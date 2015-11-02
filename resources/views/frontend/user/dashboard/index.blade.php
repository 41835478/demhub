@extends('frontend.layouts.master')

@section('content')

  <div id="user-settings" class="row">

  		<div class="col-md-2" style="background: rgba(0,0,0,0.85);">
  			@include('frontend.user.dashboard.menu._dashboard_menu')
  		</div>

      <div class="col-md-10">
      	@include ('forms.user._edit_profile')
  		</div>

  </div>

@endsection('content')
