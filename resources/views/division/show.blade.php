@extends('frontend.layouts.master')

@section('content')

	@include('division._welcome_division')

	@include('division._restricted_access_modal')

	@include('division._discussion')


	@if(Request::url() == url('divisions/results'))
		@include('division._search_feed')
	@else
		@include('division._feeds')
	@endif
@stop
