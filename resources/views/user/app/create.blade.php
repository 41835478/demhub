@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
    	<h3>Create an App</h3>
        <hr>
        
    </div>
    <div class="col-md-6">
    	@include ('forms.user.createapp')
    </div>
</div>

@endsection('content')
