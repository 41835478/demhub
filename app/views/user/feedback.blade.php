@extends('structure.main')

@section('content')
<div id="user-settings" class="row">
	<div class="col-md-12">
    	<h1>Questionaire</h1>
        <hr>
    </div>
    <div class="col-md-6 col-md-offset-3 text-center">
    	@include ('forms.user.feedback')
    </div>
</div>

@endsection('content')
