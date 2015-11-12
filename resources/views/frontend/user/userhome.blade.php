
@extends('frontend.layouts.master')

@section('body-class')userhome-body @endsection

@section('content')
	@include('division._restricted_access_modal')

	@if(Request::url() == url('divisions/results'))
		@include('division._search_feed')
	@else
		@include('division._feeds')
		@if($total_count > 0)
			@include('division._pagination')
		@else
			@include('division._contribute_article')
		@endif
	@endif
@endsection('content')
