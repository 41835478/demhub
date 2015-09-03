@extends('structure.main')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>{{Auth::user()->user_name}}'s Settings</h1>
        <hr>
    </div>
    <div class="col-md-6">
    	@include ('forms.user.settings')
    </div>
</div>

@endsection('content')
