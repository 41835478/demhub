
@extends('frontend.layouts.master')

@section('content')
@include('division._restricted_access_modal')

@if(Request::url() == url('divisions/results'))
	@include('division._search_feed')
@else
	@include('frontend.user._userhome_feeds')
	@if($total_count > 0)
		@include('division._pagination')
	@else
		@include('division._contribute_article')
	@endif
@endif

@endsection('content')
