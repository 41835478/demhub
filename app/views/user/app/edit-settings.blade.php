@extends('structure.main')

@section('content')
<div id="user-app-settings" class="row">
	<div class="col-md-12">
    	<h1>{{$userapp->app_name}}</h>
        <hr>
    </div>
@if ($userapp)
    @include('forms.user.apps-settings')
@endif

</div>
@endsection('content')
