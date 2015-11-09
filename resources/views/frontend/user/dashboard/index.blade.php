@extends('frontend.layouts.master')

@section('content')

  <div id="user-settings" class="row">
    <div class="col-md-12" style="padding:0px">
  		<div class="col-sm-3" style="padding:0px">
  			@include('frontend.user.dashboard.menu._dashboard_menu')

  		</div>

      <div class="col-sm-9" style="padding:0px;margin-left:-5%">
      	@include ('forms.user._edit_profile')
  		</div>
    </div>
  </div>

@endsection('content')
