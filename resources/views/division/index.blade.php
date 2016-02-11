@extends('frontend.layouts.master')

@section('content')
	@include('division._welcome_division')
	@include('division._feeds')
	@if($total_count > 0)
		@include('division._pagination')
	@else
		<p>No results to show</p>
	@endif
@endsection

@section('modal')
	@include('modals._restricted_access')
@stop
