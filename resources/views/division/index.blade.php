@extends('frontend.layouts.master')

@section('content')

	@include('division._welcome_division')

	@include('division._restricted_access_modal')

	@include('division._feeds')
	@if($total_count > 0)
		@include('division._pagination')
	@else
		<p>
		  No results to show
		</p>

		{{-- TODO: Add form for adding article --}}
	@endif
@stop
