@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		{{ $division->name }}

	</div><!-- row -->
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop
