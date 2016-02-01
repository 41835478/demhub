@extends('frontend.layouts.master')

@section('content')
	@include('division._welcome_division')
	@include('division._restricted_access_modal')
	@include('division._feeds')
@stop
