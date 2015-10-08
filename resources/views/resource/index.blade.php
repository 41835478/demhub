@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<ul>
			@foreach($resources as $resource)
        <li>{{ $resource->name }}</li>
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
