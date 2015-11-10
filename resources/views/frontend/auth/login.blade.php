@extends('frontend.layouts.master')

@section('body-class')js-fullheight-body @endsection
@section('container-class')fullheight-div @endsection

@section('body-style')
	<style>
	body {
		padding-top: 0px !important;
	}
	</style>
@endsection

@section('content')
	@include('frontend.includes._fullscreen', ['form' => '_login'])
@endsection
