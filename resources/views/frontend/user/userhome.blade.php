
@extends('frontend.layouts.master')

@section('content')
@include('division._restricted_access_modal')

@if(Request::url() == url('divisions/results'))
	@include('division._search_feed')
@else
	@include('division._feeds')
@endif

@endsection('content')
