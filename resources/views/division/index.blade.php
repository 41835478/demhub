@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<ul>
			@foreach($divisions as $division)
        <li>{{ $division->name }}</li>
    	@endforeach
		</ul>

	</div><!-- row -->
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop
